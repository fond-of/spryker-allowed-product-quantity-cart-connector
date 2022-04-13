<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator;

use ArrayObject;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface;

class ItemsValidator implements ItemsValidatorInterface
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface
     */
    protected $allowedProductQuantityReader;

    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface
     */
    protected $itemValidator;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface $allowedProductQuantityReader
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface $itemValidator
     */
    public function __construct(
        AllowedProductQuantityReaderInterface $allowedProductQuantityReader,
        ItemValidatorInterface $itemValidator
    ) {
        $this->allowedProductQuantityReader = $allowedProductQuantityReader;
        $this->itemValidator = $itemValidator;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return \ArrayObject<string, \ArrayObject<\Generated\Shared\Transfer\MessageTransfer>>
     */
    public function validate(ArrayObject $itemTransfers): ArrayObject
    {
        $groupedMessages = new ArrayObject();
        $allowedProductQuantities = $this->allowedProductQuantityReader->getGroupedByItems($itemTransfers);

        foreach ($itemTransfers as $itemTransfer) {
            $groupKey = $itemTransfer->getGroupKey() ?? $itemTransfer->getSku();
            $abstractSku = $itemTransfer->getAbstractSku();

            if ($groupKey === null || !isset($allowedProductQuantities[$abstractSku])) {
                continue;
            }

            $messageTransfers = $this->itemValidator->validate($itemTransfer, $allowedProductQuantities[$abstractSku]);

            if ($messageTransfers->count() === 0) {
                continue;
            }

            $groupedMessages->offsetSet($groupKey, $messageTransfers);
        }

        return $groupedMessages;
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\ItemTransfer>
     */
    public function validateAndAppendResult(ArrayObject $itemTransfers): ArrayObject
    {
        $allowedProductQuantities = $this->allowedProductQuantityReader->getGroupedByItems($itemTransfers);

        foreach ($itemTransfers as $itemTransfer) {
            $groupKey = $itemTransfer->getGroupKey() ?? $itemTransfer->getSku();
            $abstractSku = $itemTransfer->getAbstractSku();

            if ($groupKey === null || !isset($allowedProductQuantities[$abstractSku])) {
                continue;
            }

            $messages = $this->itemValidator->validate($itemTransfer, $allowedProductQuantities[$abstractSku]);

            foreach ($messages as $message) {
                $itemTransfer->addValidationMessage($message);
            }
        }

        return $itemTransfers;
    }
}
