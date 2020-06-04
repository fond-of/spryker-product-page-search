<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Business\Mapper;

use Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapperInterface as SprykerProductPageSearchMapperInterface;

interface ProductPageSearchMapperInterface extends SprykerProductPageSearchMapperInterface
{
    /**
     * @param array $productAbstractLocalizedData
     *
     * @return \Generated\Shared\Transfer\ProductPageSearchTransfer
     */
    public function mapToProductPageSearchTransfer(array $productAbstractLocalizedData);
}
