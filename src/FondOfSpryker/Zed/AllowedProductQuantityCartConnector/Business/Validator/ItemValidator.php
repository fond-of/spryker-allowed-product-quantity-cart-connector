<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface;
use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;

class ItemValidator implements ItemValidatorInterface
{
    /**
     * @var string
     */
    public const MESSAGE_TYPE_ERROR = 'error';

    /**
     * @var string
     */
    public const INTERVAL_TRANSLATION_PARAMETER = '%interval%';

    /**
     * @var string
     */
    public const MESSAGE_QUANTITY_MIN_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_min_not_fulfilled';

    /**
     * @var string
     */
    public const MESSAGE_QUANTITY_MAX_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_max_not_fulfilled';

    /**
     * @var string
     */
    public const MESSAGE_QUANTITY_INTERVAL_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_interval_not_fulfilled';

    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface
     */
    protected $allowedProductQuantityReader;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface $allowedProductQuantityReader
     */
    public function __construct(
        AllowedProductQuantityReaderInterface $allowedProductQuantityReader
    ) {
        $this->allowedProductQuantityReader = $allowedProductQuantityReader;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\AllowedProductQuantityTransfer|null $allowedProductQuantityTransfer
     *
     * @return array<\Generated\Shared\Transfer\MessageTransfer>
     */
    public function validate(
        ItemTransfer $itemTransfer,
        ?AllowedProductQuantityTransfer $allowedProductQuantityTransfer = null
    ): array {
        if ($allowedProductQuantityTransfer !== null) {
            return $this->doValidate($itemTransfer, $allowedProductQuantityTransfer);
        }

        $allowedProductQuantityTransfer = $this->allowedProductQuantityReader->getByItem($itemTransfer);

        if ($allowedProductQuantityTransfer === null) {
            return [];
        }

        return $this->doValidate($itemTransfer, $allowedProductQuantityTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\AllowedProductQuantityTransfer $allowedProductQuantityTransfer
     *
     * @return array<\Generated\Shared\Transfer\MessageTransfer>
     */
    protected function doValidate(
        ItemTransfer $itemTransfer,
        AllowedProductQuantityTransfer $allowedProductQuantityTransfer
    ): array {
        $min = $allowedProductQuantityTransfer->getQuantityMin();
        $max = $allowedProductQuantityTransfer->getQuantityMax();
        $interval = $allowedProductQuantityTransfer->getQuantityInterval();
        $quantity = $itemTransfer->getQuantity();
        $messages = [];

        if ($min !== null && $quantity < $min) {
            $messages[] = (new MessageTransfer())
                ->setType(static::MESSAGE_TYPE_ERROR)
                ->setValue(static::MESSAGE_QUANTITY_MIN_NOT_FULFILLED);
        }

        if ($max !== null && $quantity > $max) {
            $messages[] = (new MessageTransfer())
                    ->setType(static::MESSAGE_TYPE_ERROR)
                    ->setValue(static::MESSAGE_QUANTITY_MAX_NOT_FULFILLED);
        }

        if ($interval !== null && $quantity % $interval !== 0) {
            $messages[] = (new MessageTransfer())
                ->setType(static::MESSAGE_TYPE_ERROR)
                ->setValue(static::MESSAGE_QUANTITY_INTERVAL_NOT_FULFILLED)
                ->setParameters([static::INTERVAL_TRANSLATION_PARAMETER => $interval]);
        }

        return $messages;
    }
}
