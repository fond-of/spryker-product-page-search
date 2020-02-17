<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\QueryContainer;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Spryker\Zed\ProductPageSearch\Dependency\QueryContainer\ProductPageSearchToProductQueryContainerInterface as SprykerProductPageSearchToProductQueryContainerInterface;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;

interface ProductPageSearchToProductQueryContainerInterface extends SprykerProductPageSearchToProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStoreWithStoresByFkProductAbstract(): SpyProductAbstractStoreQuery;

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstract(): SpyProductAbstractQuery;

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery;
}
