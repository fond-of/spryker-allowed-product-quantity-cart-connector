<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\PostReloadItemsPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig getConfig()
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorFacadeInterface getFacade()
 */
class AllowedProductQuantityPostReloadItemsPlugin extends AbstractPlugin implements PostReloadItemsPluginInterface
{
    /**
     * Specification:
     *   - This plugin is execute after reloading cart items, with this plugin you can modify quote after reloaded it.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function postReloadItems(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFacade()->validateQuoteAfterReloadItems($quoteTransfer);
    }
}
