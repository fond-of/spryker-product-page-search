<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\QueryContainer;

use FondOfSpryker\Zed\Product\Persistence\ProductQueryContainerInterface;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery;
use Spryker\Zed\ProductPageSearch\Dependency\QueryContainer\ProductPageSearchToProductQueryContainerBridge as SprykerProductPageSearchToProductQueryContainerBridge;

class ProductPageSearchToProductQueryContainerBridge extends SprykerProductPageSearchToProductQueryContainerBridge implements ProductPageSearchToProductQueryContainerInterface
{
    /**
     * @var \FondOfSpryker\Zed\Product\Persistence\ProductQueryContainerInterface
     */
    protected $productQueryContainer;

    /**
     * @param \FondOfSpryker\Zed\Product\Persistence\ProductQueryContainerInterface $productQueryContainer
     */
    public function __construct(ProductQueryContainerInterface $productQueryContainer)
    {
        parent::__construct($productQueryContainer);
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery
     */
    public function queryProductAbstract(): SpyProductAbstractQuery
    {
        return $this->productQueryContainer->queryProductAbstract();
    }

    /**
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractStoreQuery
     */
    public function queryProductAbstractStore(): SpyProductAbstractStoreQuery
    {
        return $this->productQueryContainer->queryProductAbstractStore();
    }
}
