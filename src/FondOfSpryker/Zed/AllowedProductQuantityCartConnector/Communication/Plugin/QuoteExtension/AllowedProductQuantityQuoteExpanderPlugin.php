<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Communication\Plugin\QuoteExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\QuoteExtension\Dependency\Plugin\QuoteExpanderPluginInterface;

/**
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig getConfig()
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorFacadeInterface getFacade()
 */
class AllowedProductQuantityQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands quote transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->validateQuote($quoteTransfer);
    }
}
