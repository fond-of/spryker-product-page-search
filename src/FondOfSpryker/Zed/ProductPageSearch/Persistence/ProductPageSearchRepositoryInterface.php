<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface as SprykerProductPageSearchRepositoryInterface;

/**
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchPersistenceFactory getFactory()
 */
interface ProductPageSearchRepositoryInterface extends SprykerProductPageSearchRepositoryInterface
{
    /**
     * @param int[] $productIds
     * @param int[] $localeIds
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return array
     */
    public function queryProductAbstractIdsByProductIds(array $productIds, array $localeIds): array;
}
