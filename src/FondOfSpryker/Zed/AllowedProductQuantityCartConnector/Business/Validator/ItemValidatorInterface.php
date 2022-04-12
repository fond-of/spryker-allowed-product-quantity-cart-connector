<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator;

use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;

interface ItemValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\AllowedProductQuantityTransfer|null $allowedProductQuantityTransfer
     *
     * @return array<\Generated\Shared\Transfer\MessageTransfer>
     */
    public function validate(
        ItemTransfer $itemTransfer,
        ?AllowedProductQuantityTransfer $allowedProductQuantityTransfer = null
    ): array;
}
