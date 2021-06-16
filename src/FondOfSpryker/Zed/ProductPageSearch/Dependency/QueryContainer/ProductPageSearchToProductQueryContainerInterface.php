<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\QueryContainer;

use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Dependency\QueryContainer\ProductPageSearchToProductQueryContainerInterface as SprykerProductPageSearchToProductQueryContainerInterface;

interface ProductPageSearchToProductQueryContainerInterface extends SprykerProductPageSearchToProductQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstract(): SpyProductAbstractQuery;

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery;
}
