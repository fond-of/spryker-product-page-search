<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\QueryContainer;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Dependency\QueryContainer\ProductPageSearchToProductQueryContainerBridge as SprykerProductPageSearchToProductQueryContainerBridge;

class ProductPageSearchToProductQueryContainerBridge extends SprykerProductPageSearchToProductQueryContainerBridge implements ProductPageSearchToProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStoreWithStoresByFkProductAbstract(): SpyProductAbstractStoreQuery
    {
        return $this->productQueryContainer->queryProductAbstractStoreWithStoresByFkProductAbstract();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstract(): SpyProductAbstractQuery
    {
        return $this->productQueryContainer->queryProductAbstract();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery
    {
        return $this->productQueryContainer->queryProductAbstractStore();
    }
}
