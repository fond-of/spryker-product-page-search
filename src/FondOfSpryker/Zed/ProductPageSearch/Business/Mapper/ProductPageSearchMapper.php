<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Business\Mapper;

use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Shared\ProductPageSearch\ProductPageSearchConstants;
use Spryker\Zed\ProductPageSearch\Business\Mapper\ProductPageSearchMapper as SprykerProductPageSearchMapper;

class ProductPageSearchMapper extends SprykerProductPageSearchMapper implements ProductPageSearchMapperInterface
{
    /**
     * @param array $productAbstractLocalizedData
     *
     * @return \Generated\Shared\Transfer\ProductPageSearchTransfer
     */
    public function mapToProductPageSearchTransfer(array $productAbstractLocalizedData)
    {
        $concreteData = $this->getConcreteProductData(
            $productAbstractLocalizedData['SpyProductAbstract']['SpyProducts'],
            $productAbstractLocalizedData['Locale']['id_locale']
        );
        $attributes = $this->productPageAttributes->getCombinedProductAttributes(
            $productAbstractLocalizedData['SpyProductAbstract']['attributes'],
            $productAbstractLocalizedData['attributes'],
            $concreteData['concreteAttributes'],
            $concreteData['concreteLocalizedAttributes']
        );

        $productPageSearchTransfer = new ProductPageSearchTransfer();
        $productPageSearchTransfer->setIdProductAbstract($productAbstractLocalizedData['fk_product_abstract']);
        $productPageSearchTransfer->setIdImageSet($productAbstractLocalizedData['id_image_set']);
        if (array_key_exists('SpyProductCategories', $productAbstractLocalizedData['SpyProductAbstract'])) {
            $productPageSearchTransfer->setCategoryNodeIds($this->getCategoryNodeIds($productAbstractLocalizedData['SpyProductAbstract']['SpyProductCategories']));
        }
        $productPageSearchTransfer->setIsActive(true);
        $productPageSearchTransfer->setSku($productAbstractLocalizedData['SpyProductAbstract']['sku']);
        $productPageSearchTransfer->setName($productAbstractLocalizedData['name']);
        $productPageSearchTransfer->setUrl($productAbstractLocalizedData['url']);
        $productPageSearchTransfer->setAbstractDescription($productAbstractLocalizedData['description']);
        $productPageSearchTransfer->setConcreteDescription($concreteData['concreteDescriptions']);
        $productPageSearchTransfer->setConcreteSkus($concreteData['concreteSkus']);
        $productPageSearchTransfer->setConcreteNames($concreteData['concreteNames']);
        $productPageSearchTransfer->setType(ProductPageSearchConstants::PRODUCT_ABSTRACT_RESOURCE_NAME);
        $productPageSearchTransfer->setLocale($productAbstractLocalizedData['Locale']['locale_name']);
        $productPageSearchTransfer->setAttributes($attributes);

        return $productPageSearchTransfer;
    }
}
