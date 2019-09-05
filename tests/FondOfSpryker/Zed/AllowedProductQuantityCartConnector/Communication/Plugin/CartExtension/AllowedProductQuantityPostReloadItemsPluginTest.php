<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;

class AllowedProductQuantityPostReloadItemsPluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Communication\Plugin\CartExtension\AllowedProductQuantityPostReloadItemsPlugin
     */
    protected $allowedProductQuantityPostReloadItemsPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorFacade
     */
    protected $allowedProductQuantityCartConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->allowedProductQuantityCartConnectorFacadeMock = $this->getMockBuilder(AllowedProductQuantityCartConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->allowedProductQuantityPostReloadItemsPlugin = new AllowedProductQuantityPostReloadItemsPlugin();
        $this->allowedProductQuantityPostReloadItemsPlugin->setFacade($this->allowedProductQuantityCartConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostReloadItems(): void
    {
        $this->assertInstanceOf(QuoteTransfer::class, $this->allowedProductQuantityPostReloadItemsPlugin->postReloadItems($this->quoteTransferMock));
    }
}
