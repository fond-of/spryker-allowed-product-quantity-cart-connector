<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteValidatorInterface;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class AllowedProductQuantityCartConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorFacade
     */
    protected $allowedProductQuantityCartConnectorFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorBusinessFactory
     */
    protected $allowedProductQuantityCartConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteValidatorInterface
     */
    protected $quoteValidatorInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface
     */
    protected $quoteItemValidatorInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->allowedProductQuantityCartConnectorBusinessFactoryMock = $this->getMockBuilder(AllowedProductQuantityCartConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteValidatorInterfaceMock = $this->getMockBuilder(QuoteValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteItemValidatorInterfaceMock = $this->getMockBuilder(QuoteItemValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityCartConnectorFacade = new AllowedProductQuantityCartConnectorFacade();
        $this->allowedProductQuantityCartConnectorFacade->setFactory($this->allowedProductQuantityCartConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testValidateQuote(): void
    {
        $this->allowedProductQuantityCartConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createQuoteValidator')
            ->willReturn($this->quoteValidatorInterfaceMock);

        $this->assertInstanceOf(QuoteTransfer::class, $this->allowedProductQuantityCartConnectorFacade->validateQuote($this->quoteTransferMock));
    }

    /**
     * @return void
     */
    public function testValidateQuoteItem(): void
    {
        $this->allowedProductQuantityCartConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createQuoteItemValidator')
            ->willReturn($this->quoteItemValidatorInterfaceMock);

        $this->assertIsArray($this->allowedProductQuantityCartConnectorFacade->validateQuoteItem($this->itemTransferMock));
    }
}
