<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Communication\Plugin\Event;

use Orm\Zed\Product\Persistence\Map\SpyProductAbstractStoreTableMap;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\EventBehavior\Dependency\Plugin\EventResourceQueryContainerPluginInterface;
use Spryker\Zed\ProductPageSearch\Communication\Plugin\Event\ProductPageEventResourceQueryContainerPlugin as SprykerProductPageEventResourceQueryContainerPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface getRepository()()
 * @method \Spryker\Zed\ProductPageSearch\Business\ProductPageSearchFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Communication\ProductPageSearchCommunicationFactory getFactory()
 * @method \Spryker\Zed\ProductPageSearch\ProductPageSearchConfig getConfig()
 */
class ProductPageEventResourceQueryContainerPlugin extends SprykerProductPageEventResourceQueryContainerPlugin implements EventResourceQueryContainerPluginInterface
{
    /**
     * @var bool
     */
    protected $isOverwritten = false;

    /**
     * @param int[] $ids
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria|null
     */
    public function queryData(array $ids = []): ?ModelCriteria
    {
        $query = $this->getQueryContainer()->queryProductAbstractIdsByProductIds($ids);
        $this->isOverwritten = false;
        if ($ids === []) {
            $query->clear();
            $this->isOverwritten = true;
            $query = $this->getQueryContainer()->queryProductAbstractIdsByCurrentStore();
        }

        return $query;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return string|null
     */
    public function getIdColumnName(): ?string
    {
        $name = SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT;

        if ($this->isOverwritten) {
            $name = SpyProductAbstractStoreTableMap::COL_FK_PRODUCT_ABSTRACT;
        }

        return $name;
    }
}
