<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\AllowedProductQuantityCartConnectorBusinessFactory getFactory()
 */
class AllowedProductQuantityCartConnectorFacade extends AbstractFacade implements AllowedProductQuantityCartConnectorFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()->createQuoteValidator()->validate($quoteTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\MessageTransfer[]
     */
    public function validateQuoteItem(ItemTransfer $itemTransfer): array
    {
        return $this->getFactory()->createQuoteItemValidator()->validate($itemTransfer);
    }
}
