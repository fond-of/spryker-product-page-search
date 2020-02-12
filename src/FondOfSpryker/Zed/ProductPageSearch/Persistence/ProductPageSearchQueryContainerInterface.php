<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Category\Persistence\SpyCategoryNodeQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchQuery;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface as SprykerProductPageSearchQueryContainerInterface;

interface ProductPageSearchQueryContainerInterface extends SprykerProductPageSearchQueryContainerInterface
{
    /**
     * @api
     *
     * @param array $productIds
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery
     */
    public function queryProductAbstractIdsByProductIdsFilterByCurrentStore(array $productIds);
}
