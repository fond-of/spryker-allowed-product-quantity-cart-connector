<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MessageTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class QuoteItemValidator implements QuoteItemValidatorInterface
{
    protected const MESSAGE_TYPE_ERROR = 'error';
    protected const INTERVAL_TRANSLATION_PARAMETER = '%interval%';

    protected const MESSAGE_QUANTITY_MIN_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_min_not_fulfilled';
    protected const MESSAGE_QUANTITY_MAX_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_max_not_fulfilled';
    protected const MESSAGE_QUANTITY_INTERVAL_NOT_FULFILLED = 'allowed_product_quantity_cart_connector.quantity_interval_not_fulfilled';

    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityFacade;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface $allowedProductQuantityFacade
     */
    public function __construct(
        AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface $allowedProductQuantityFacade
    ) {
        $this->allowedProductQuantityFacade = $allowedProductQuantityFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\MessageTransfer[]
     */
    public function validate(ItemTransfer $itemTransfer): array
    {
        $productAbstractTransfer = (new ProductAbstractTransfer())
            ->setIdProductAbstract($itemTransfer->getIdProductAbstract());

        $allowedProductQuantityResponseTransfer = $this->allowedProductQuantityFacade
            ->findProductAbstractAllowedQuantity($productAbstractTransfer);

        if ($allowedProductQuantityResponseTransfer->getIsSuccessful() === false) {
            return [];
        }

        $allowedProductQuantityTransfer = $allowedProductQuantityResponseTransfer->getAllowedProductQuantityTransfer();

        return $this->validateQuantity($itemTransfer, $allowedProductQuantityTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\AllowedProductQuantityTransfer $allowedProductQuantityTransfer
     *
     * @return \Generated\Shared\Transfer\MessageTransfer[]
     */
    protected function validateQuantity(
        ItemTransfer $itemTransfer,
        AllowedProductQuantityTransfer $allowedProductQuantityTransfer
    ): array {
        $min = $allowedProductQuantityTransfer->getQuantityMin();
        $max = $allowedProductQuantityTransfer->getQuantityMax();
        $interval = $allowedProductQuantityTransfer->getQuantityInterval();
        $quantity = $itemTransfer->getQuantity();
        $messages = [];

        if ($min !== null && $quantity < $min) {
            $messages[] = $this->createMessage(
                static::MESSAGE_TYPE_ERROR,
                static::MESSAGE_QUANTITY_MIN_NOT_FULFILLED
            );
        }

        if ($max !== null && $quantity > $max) {
            $messages[] = $this->createMessage(
                static::MESSAGE_TYPE_ERROR,
                static::MESSAGE_QUANTITY_MAX_NOT_FULFILLED
            );
        }

        if ($interval !== null && $quantity % $interval !== 0) {
            $messages[] = $this->createMessage(
                static::MESSAGE_TYPE_ERROR,
                static::MESSAGE_QUANTITY_INTERVAL_NOT_FULFILLED,
                [
                    static::INTERVAL_TRANSLATION_PARAMETER => $interval,
                ]
            );
        }

        return $messages;
    }

    /**
     * @param string $type
     * @param string $value
     * @param array $parameters
     *
     * @return \Generated\Shared\Transfer\MessageTransfer
     */
    protected function createMessage(string $type, string $value, array $parameters = []): MessageTransfer
    {
        return (new MessageTransfer())
            ->setType($type)
            ->setValue($value)
            ->setParameters($parameters);
    }
}
