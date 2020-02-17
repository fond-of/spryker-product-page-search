<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface as SprykerProductPageSearchRepositoryInterface;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchPersistenceFactory getFactory()
 */
interface ProductPageSearchRepositoryInterface extends SprykerProductPageSearchRepositoryInterface
{
    /**
     * @param  array|int[]  $productIds
     * @param  array|int[]  $localeIds
     * @return array
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function queryProductAbstractIdsByProductIds(array $productIds, array $localeIds): array;
}
