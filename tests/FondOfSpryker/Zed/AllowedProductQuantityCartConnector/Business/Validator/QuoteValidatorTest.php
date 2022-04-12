<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidatorTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\QuoteValidator
     */
    protected $quoteValidator;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface
     */
    protected $itemValidatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ItemTransfer
     */
    protected $itemTransferMock;

    /**
     * @var array
     */
    private $itemTransfers;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\MessageTransfer
     */
    protected $messageTransferMock;

    /**
     * @var array
     */
    private $messageTransfers;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->itemValidatorMock = $this->getMockBuilder(ItemValidatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->messageTransferMock = $this->getMockBuilder(MessageTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransfers = [
            $this->itemTransferMock,
        ];

        $this->messageTransfers = [
            $this->messageTransferMock,
        ];

        $this->quoteValidator = new QuoteValidator($this->itemValidatorMock);
    }

    /**
     * @return void
     */
    public function testValidate(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getItems')
            ->willReturn($this->itemTransfers);

        $this->itemValidatorMock->expects($this->atLeastOnce())
            ->method('validate')
            ->willReturn($this->messageTransfers);

        $this->itemTransferMock->expects($this->atLeastOnce())
            ->method('addValidationMessage')
            ->willReturn($this->itemTransferMock);

        $this->assertInstanceOf(QuoteTransfer::class, $this->quoteValidator->validate($this->quoteTransferMock));
    }
}
