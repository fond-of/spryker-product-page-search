<?php

namespace FondOfSpryker\Zed\ProductPageSearch\Dependency\Facade;

use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class ProductPageSearchToLocaleFacadeBridge implements ProductPageSearchToLocaleFacadeInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * ProductPageSearchToLocaleFacadeBridge constructor.
     * @param  \Spryker\Zed\Locale\Business\LocaleFacadeInterface  $localeFacade
     */
    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @return array
     */
    public function getAvailableLocales()
    {
        return $this->localeFacade->getAvailableLocales();
    }
}
