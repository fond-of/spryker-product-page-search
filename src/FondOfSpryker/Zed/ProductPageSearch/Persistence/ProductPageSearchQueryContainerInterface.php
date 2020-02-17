<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface as SprykerProductPageSearchQueryContainerInterface;

interface ProductPageSearchQueryContainerInterface extends SprykerProductPageSearchQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function queryProductAbstractIdsByCurrentStore(): SpyProductAbstractStoreQuery;
}
