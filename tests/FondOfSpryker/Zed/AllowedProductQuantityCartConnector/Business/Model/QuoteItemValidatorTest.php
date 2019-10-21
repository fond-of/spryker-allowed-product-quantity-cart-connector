<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Generated\Shared\Transfer\AllowedProductQuantityResponseTransfer;
use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class QuoteItemValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidator
     */
    protected $quoteItemValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AllowedProductQuantityResponseTransfer
     */
    protected $allowedProductQuantityResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\AllowedProductQuantityTransfer
     */
    private $allowedProductQuantityTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock = $this->getMockBuilder(AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityResponseTransferMock = $this->getMockBuilder(AllowedProductQuantityResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityTransferMock = $this->getMockBuilder(AllowedProductQuantityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteItemValidator = new QuoteItemValidator($this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock);
    }

    /**
     * @return void
     */
    public function testValidateQuantitySmallerMin(): void
    {
        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductAbstractAllowedQuantity')
            ->willReturn($this->allowedProductQuantityResponseTransferMock);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getAllowedProductQuantityTransfer')
            ->willReturn($this->allowedProductQuantityTransferMock);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMin')
            ->willReturn(5);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMax')
            ->willReturn(6);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityInterval')
            ->willReturn(2);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(2);

        $this->assertIsArray($this->quoteItemValidator->validate($this->itemTransferMock));
    }

    /**
     * @return void
     */
    public function testValidateQuantityBiggerMax(): void
    {
        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductAbstractAllowedQuantity')
            ->willReturn($this->allowedProductQuantityResponseTransferMock);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getAllowedProductQuantityTransfer')
            ->willReturn($this->allowedProductQuantityTransferMock);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMin')
            ->willReturn(5);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMax')
            ->willReturn(6);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityInterval')
            ->willReturn(2);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(10);

        $this->assertIsArray($this->quoteItemValidator->validate($this->itemTransferMock));
    }

    /**
     * @return void
     */
    public function testValidateQuantityModuloInterval(): void
    {
        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductAbstractAllowedQuantity')
            ->willReturn($this->allowedProductQuantityResponseTransferMock);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getAllowedProductQuantityTransfer')
            ->willReturn($this->allowedProductQuantityTransferMock);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMin')
            ->willReturn(5);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityMax')
            ->willReturn(6);

        $this->allowedProductQuantityTransferMock->expects($this->atLeastOnce())
            ->method('getQuantityInterval')
            ->willReturn(2);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getQuantity')
            ->willReturn(3);

        $this->assertIsArray($this->quoteItemValidator->validate($this->itemTransferMock));
    }

    /**
     * @return void
     */
    public function testValidateIsNotSuccessful(): void
    {
        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductAbstract')
            ->willReturn(1);

        $this->allowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterfaceMock->expects($this->atLeastOnce())
            ->method('findProductAbstractAllowedQuantity')
            ->willReturn($this->allowedProductQuantityResponseTransferMock);

        $this->allowedProductQuantityResponseTransferMock->expects($this->atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(false);

        $this->assertIsArray($this->quoteItemValidator->validate($this->itemTransferMock));
    }
}
