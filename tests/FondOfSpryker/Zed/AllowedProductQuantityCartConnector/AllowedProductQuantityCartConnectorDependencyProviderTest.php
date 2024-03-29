<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class AllowedProductQuantityCartConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorDependencyProvider
     */
    protected $allowedProductQuantityCartConnectorDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'offsetSet', 'offsetGet', 'set', 'get'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityFacadeMock = $this->getMockBuilder(AllowedProductQuantityFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityCartConnectorDependencyProvider = new AllowedProductQuantityCartConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testAddAllowedProductQuantityFacade(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('allowedProductQuantity')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->allowedProductQuantityFacadeMock);

        $this->assertEquals(
            $this->containerMock,
            $this->allowedProductQuantityCartConnectorDependencyProvider->provideBusinessLayerDependencies($this->containerMock),
        );

        $this->assertInstanceOf(
            AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge::class,
            $this->containerMock[AllowedProductQuantityCartConnectorDependencyProvider::FACADE_ALLOWED_PRODUCT_QUANTITY],
        );
    }
}
