<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface as SprykerProductPageSearchToStoreFacadeInterface;

interface ProductPageSearchToStoreFacadeInterface extends SprykerProductPageSearchToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
