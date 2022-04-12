<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator;

use Generated\Shared\Transfer\QuoteTransfer;

class QuoteValidator implements QuoteValidatorInterface
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface
     */
    protected $itemValidator;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface $quoteItemValidator
     */
    public function __construct(ItemValidatorInterface $quoteItemValidator)
    {
        $this->itemValidator = $quoteItemValidator;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function validate(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $messages = $this->itemValidator->validate($itemTransfer);

            foreach ($messages as $message) {
                $itemTransfer->addValidationMessage($message);
            }
        }

        return $quoteTransfer;
    }
}
