<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainer as SprykerProductPageSearchQueryContainer;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchPersistenceFactory getFactory()
 */
class ProductPageSearchQueryContainer extends SprykerProductPageSearchQueryContainer implements ProductPageSearchQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractIdsByCurrentStore(): SpyProductAbstractStoreQuery
    {
        return $this->getFactory()->getProductQueryContainer()
            ->queryProductAbstractStore()
            ->filterByFkStore($this->getFactory()->getStoreFacade()->getCurrentStore()->getIdStore());
    }
}
