<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeBridge as SprykerProductPageSearchToStoreFacadeBridge;

class ProductPageSearchToStoreFacadeBridge extends SprykerProductPageSearchToStoreFacadeBridge implements ProductPageSearchToStoreFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer
    {
        return $this->storeFacade->getCurrentStore();
    }
}
