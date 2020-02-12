<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Persistence;

use FondOfSpryker\Zed\ProductPageSearch\ProductPageSearchDependencyProvider;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface;
use Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchPersistenceFactory as SprykerProductPageSearchPersistenceFactory;

/**
 * @method \Spryker\Zed\ProductPageSearch\ProductPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchEntityManagerInterface getEntityManager()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface getRepository()
 */
class ProductPageSearchPersistenceFactory extends SprykerProductPageSearchPersistenceFactory
{
    public function getStoreFacade(): ProductPageSearchToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ProductPageSearchDependencyProvider::FACADE_STORE);
    }
}
