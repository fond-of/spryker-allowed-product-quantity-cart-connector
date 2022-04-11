<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AllowedProductQuantityCartConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_ALLOWED_PRODUCT_QUANTITY = 'FACADE_ALLOWED_PRODUCT_QUANTITY';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addAllowedProductQuantityFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addAllowedProductQuantityFacade(Container $container): Container
    {
        $container[static::FACADE_ALLOWED_PRODUCT_QUANTITY] = function (Container $container) {
            return new AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge(
                $container->getLocator()->allowedProductQuantity()->facade(),
            );
        };

        return $container;
    }
}
