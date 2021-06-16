<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Business\Publisher;

use Exception;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface;
use FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapperInterface;
use Spryker\Zed\ProductPageSearch\Business\Model\ProductPageSearchWriterInterface;
use Spryker\Zed\ProductPageSearch\Business\Publisher\ProductAbstractPagePublisher as SprykerProductAbstractPagePublisher;
use Spryker\Zed\ProductPageSearch\ProductPageSearchConfig;

class ProductAbstractPagePublisher extends SprykerProductAbstractPagePublisher implements ProductAbstractPagePublisherInterface
{
    use LoggerTrait;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface $queryContainer
     * @param array $pageDataExpanderPlugins
     * @param array $productPageDataLoaderPlugins
     * @param \Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapperInterface $productPageSearchMapper
     * @param \Spryker\Zed\ProductPageSearch\Business\Model\ProductPageSearchWriterInterface $productPageSearchWriter
     * @param \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface $storeFacade
     * @param \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface $repository
     * @param \Spryker\Zed\ProductPageSearch\ProductPageSearchConfig $productPageSearchConfig
     * @param \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        ProductPageSearchQueryContainerInterface $queryContainer,
        array $pageDataExpanderPlugins,
        array $productPageDataLoaderPlugins,
        ProductPageSearchMapperInterface $productPageSearchMapper,
        ProductPageSearchWriterInterface $productPageSearchWriter,
        ProductPageSearchToStoreFacadeInterface $storeFacade,
        ProductPageSearchRepositoryInterface $repository,
        ProductPageSearchConfig $productPageSearchConfig,
        ProductPageSearchToLocaleFacadeInterface $localeFacade
    ) {
        parent::__construct(
            $queryContainer,
            $pageDataExpanderPlugins,
            $productPageDataLoaderPlugins,
            $productPageSearchMapper,
            $productPageSearchWriter,
            $productPageSearchConfig,
            $storeFacade
        );
        $this->storeFacade = $storeFacade;
        $this->queryContainer = $queryContainer;
        $this->repository = $repository;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param int[] $productAbstractIds
     *
     * @return array
     */
    protected function findProductAbstractLocalizedEntities(array $productAbstractIds)
    {
        $allProductAbstractLocalizedEntities = [];
        $localesByStore = [];
        $storeTransfer = $this->storeFacade->getCurrentStore();
        $productAbstractLocalizedEntities = $this
            ->queryContainer
            ->queryProductAbstractLocalizedEntitiesByProductAbstractIdsAndStore($productAbstractIds, $storeTransfer)
            ->find()
            ->getData();

        if (!isset($localesByStore[$storeTransfer->getName()])) {
            $localesByStore[$storeTransfer->getName()] = $storeTransfer->getAvailableLocaleIsoCodes();
        }
        $productConcreteEntities = $this->getProductConcreteEntitiesWithProductSearchEntities(
            $productAbstractIds,
            $localesByStore[$storeTransfer->getName()]
        );
        $allProductAbstractLocalizedEntities[] = $this->hydrateProductAbstractLocalizedEntitiesWithProductConcreteEntities(
            $productConcreteEntities,
            $productAbstractLocalizedEntities
        );

        return array_merge(...$allProductAbstractLocalizedEntities);
    }

    /**
     * @param int[] $productConcreteIds
     * @param string[] $localeIsoCodes
     *
     * @return array
     */
    protected function getProductSearchEntitiesByProductConcreteIdsAndLocaleIsoCodes(
        array $productConcreteIds,
        array $localeIsoCodes
    ): array {
        $locales = $this->localeFacade->getAvailableLocales();
        $localeIds = [];
        foreach ($localeIsoCodes as $isoCode) {
            if (in_array($isoCode, $locales)) {
                $localeIds[] = array_search($isoCode, $locales);
            }
        }

        try {
            $entities = $this->repository->queryProductAbstractIdsByProductIds($productConcreteIds, $localeIds);
        } catch (Exception $exception) {
            $entities = [];
            $this->getLogger()->info($exception->getMessage(), $exception->getTrace());
        }

        return $entities;
    }

    /**
     * @param array $productCategories
     * @param array $productAbstractLocalizedEntities
     *
     * @return array
     */
    protected function hydrateProductAbstractLocalizedEntitiesWithProductCategories(array $productCategories, array $productAbstractLocalizedEntities)
    {
        $productCategoriesByProductAbstractId = [];

        foreach ($productCategories as $productCategory) {
            $productCategoriesByProductAbstractId[$productCategory['fk_product_abstract']][] = $productCategory;
        }

        foreach ($productAbstractLocalizedEntities as $key => $productAbstractLocalizedEntity) {
            $productAbstractId = (int)$productAbstractLocalizedEntity['fk_product_abstract'];
            if (array_key_exists($productAbstractId, $productCategoriesByProductAbstractId)) {
                $productAbstractLocalizedEntities[$key]['SpyProductAbstract']['SpyProductCategories'] = $productCategoriesByProductAbstractId[$productAbstractId];
            }
        }

        return $productAbstractLocalizedEntities;
    }
}
