<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Business;

use FondOfSpryker\Zed\ProductPageSearch\Business\Publisher\ProductAbstractPagePublisher;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface;
use FondOfSpryker\Zed\ProductPageSearch\ProductPageSearchDependencyProvider;
use Spryker\Zed\ProductPageSearch\Business\ProductPageSearchBusinessFactory as SprykerProductPageSearchBusinessFactory;

/**
 * @method \Spryker\Zed\ProductPageSearch\ProductPageSearchConfig getConfig()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\ProductPageSearch\Persistence\ProductPageSearchRepositoryInterface getRepository()
 * @method \Spryker\Zed\ProductPageSearch\Persistence\ProductPageSearchEntityManagerInterface getEntityManager()
 */
class ProductPageSearchBusinessFactory extends SprykerProductPageSearchBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductPageSearch\Business\Publisher\ProductAbstractPagePublisher|\Spryker\Zed\ProductPageSearch\Business\Publisher\ProductAbstractPagePublisherInterface
     */
    public function createProductAbstractPagePublisher()
    {
        return new ProductAbstractPagePublisher(
            $this->getQueryContainer(),
            $this->getProductPageDataExpanderPlugins(),
            $this->getProductPageDataLoaderPlugins(),
            $this->createProductPageMapper(),
            $this->createProductPageWriter(),
            $this->getStoreFacade2(),
            $this->getRepository(),
            $this->getConfig(),
            $this->getLocaleFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToStoreFacadeInterface
     */
    public function getStoreFacade2(): ProductPageSearchToStoreFacadeInterface
    {
        return $this->getProvidedDependency(ProductPageSearchDependencyProvider::FACADE_STORE);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade\ProductPageSearchToLocaleFacadeInterface
     */
    public function getLocaleFacade(): ProductPageSearchToLocaleFacadeInterface
    {
        return $this->getProvidedDependency(ProductPageSearchDependencyProvider::FACADE_LOCALE);
    }
}
