<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorDependencyProvider;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\QuoteValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Spryker\Zed\Kernel\Container;

class AllowedProductQuantityCartConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorBusinessFactory
     */
    protected $allowedProductQuantityCartConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig
     */
    protected $allowedProductQuantityCartConnectorConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->allowedProductQuantityCartConnectorConfigMock = $this->getMockBuilder(AllowedProductQuantityCartConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock = $this->getMockBuilder(AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityCartConnectorBusinessFactory = new AllowedProductQuantityCartConnectorBusinessFactory();
        $this->allowedProductQuantityCartConnectorBusinessFactory->setContainer($this->containerMock);
        $this->allowedProductQuantityCartConnectorBusinessFactory->setConfig($this->allowedProductQuantityCartConnectorConfigMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidator(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(AllowedProductQuantityCartConnectorDependencyProvider::FACADE_ALLOWED_PRODUCT_QUANTITY)
            ->willReturn($this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock);

        $this->assertInstanceOf(QuoteValidatorInterface::class, $this->allowedProductQuantityCartConnectorBusinessFactory->createQuoteValidator());
    }
}
