<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model;

use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidator implements QuoteValidatorInterface
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface
     */
    protected $quoteItemValidator;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface $quoteItemValidator
     */
    public function __construct(QuoteItemValidatorInterface $quoteItemValidator)
    {
        $this->quoteItemValidator = $quoteItemValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $messages = $this->quoteItemValidator->validate($itemTransfer);

            foreach ($messages as $message) {
                $itemTransfer->addValidationMessage($message);
            }
        }

        return $quoteTransfer;
    }
}
