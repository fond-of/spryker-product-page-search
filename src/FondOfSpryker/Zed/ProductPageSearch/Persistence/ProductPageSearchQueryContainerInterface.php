<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface as SprykerProductPageSearchQueryContainerInterface;

interface ProductPageSearchQueryContainerInterface extends SprykerProductPageSearchQueryContainerInterface
{
    /**
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractIdsByCurrentStore(): SpyProductAbstractStoreQuery;
}
