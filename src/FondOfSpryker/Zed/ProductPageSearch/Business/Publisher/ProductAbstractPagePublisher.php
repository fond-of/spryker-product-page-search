<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Business\Publisher;

use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface;
use Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapperInterface;
use Spryker\Zed\ProductPageSearch\Business\Model\ProductPageSearchWriterInterface;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface;
use Spryker\Zed\ProductPageSearch\Business\Publisher\ProductAbstractPagePublisher as SprykerProductAbstractPagePublisher;

class ProductAbstractPagePublisher extends SprykerProductAbstractPagePublisher implements ProductAbstractPagePublisherInterface
{
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
     * ProductAbstractPagePublisher constructor.
     * @param  \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface  $queryContainer
     * @param  array  $pageDataExpanderPlugins
     * @param  array  $productPageDataLoaderPlugins
     * @param  \Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapperInterface  $productPageSearchMapper
     * @param  \Spryker\Zed\ProductPageSearch\Business\Model\ProductPageSearchWriterInterface  $productPageSearchWriter
     * @param  \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface  $storeFacade
     * @param  \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface  $repository
     * @param  \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface  $localeFacade
     */
    public function __construct(
        ProductPageSearchQueryContainerInterface $queryContainer,
        array $pageDataExpanderPlugins,
        array $productPageDataLoaderPlugins,
        ProductPageSearchMapperInterface $productPageSearchMapper,
        ProductPageSearchWriterInterface $productPageSearchWriter,
        ProductPageSearchToStoreFacadeInterface $storeFacade,
        ProductPageSearchRepositoryInterface $repository,
        ProductPageSearchToLocaleFacadeInterface $localeFacade
    ) {
        parent::__construct($queryContainer, $pageDataExpanderPlugins, $productPageDataLoaderPlugins,
            $productPageSearchMapper, $productPageSearchWriter, $storeFacade);
        $this->storeFacade = $storeFacade;
        $this->queryContainer = $queryContainer;
        $this->repository = $repository;
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param  int[]  $productAbstractIds
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
        $productConcreteEntities = $this->getProductConcreteEntitiesWithProductSearchEntities($productAbstractIds,
            $localesByStore[$storeTransfer->getName()]);
        $allProductAbstractLocalizedEntities[] = $this->hydrateProductAbstractLocalizedEntitiesWithProductConcreteEntities($productConcreteEntities,
            $productAbstractLocalizedEntities);


        return array_merge(...$allProductAbstractLocalizedEntities);
    }

    /**
     * @param  int[]  $productConcreteIds
     * @param  string[]  $localeIsoCodes
     *
     * @return array
     *
     * @throws \Propel\Runtime\Exception\PropelException
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
        return $this->repository->queryProductAbstractIdsByProductIds($productConcreteIds, $localeIds);
    }
}