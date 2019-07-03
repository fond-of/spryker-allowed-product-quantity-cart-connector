<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;

interface QuoteValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
