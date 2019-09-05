<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface;
use Generated\Shared\Transfer\AllowedProductQuantityResponseTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge
     */
    protected $allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductAbstractTransfer
     */
    protected $productAbstractTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->allowedProductQuantityFacadeInterfaceMock = $this->getMockBuilder(AllowedProductQuantityFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productAbstractTransferMock = $this->getMockBuilder(ProductAbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge = new AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge($this->allowedProductQuantityFacadeInterfaceMock);
    }

    /**
     * @return void
     */
    public function testFindProductAbstractAllowedQuantity(): void
    {
        $this->assertInstanceOf(AllowedProductQuantityResponseTransfer::class, $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge->findProductAbstractAllowedQuantity($this->productAbstractTransferMock));
    }
}
