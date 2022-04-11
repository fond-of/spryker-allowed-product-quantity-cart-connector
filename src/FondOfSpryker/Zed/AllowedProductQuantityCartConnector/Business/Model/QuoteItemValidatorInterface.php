<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model;

use Generated\Shared\Transfer\ItemTransfer;

interface QuoteItemValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return array<\Generated\Shared\Transfer\MessageTransfer>
     */
    public function validate(ItemTransfer $itemTransfer): array;
}
