<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class AllowedProductQuantityReader implements AllowedProductQuantityReaderInterface
{
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
     * @return \Generated\Shared\Transfer\AllowedProductQuantityTransfer|null
     */
    public function getByItem(ItemTransfer $itemTransfer): ?AllowedProductQuantityTransfer
    {
        $idProductAbstract = $itemTransfer->getIdProductAbstract();

        if ($idProductAbstract === null) {
            return null;
        }

        $productAbstractTransfer = (new ProductAbstractTransfer())
            ->setIdProductAbstract($idProductAbstract);

        $allowedProductQuantityResponseTransfer = $this->allowedProductQuantityFacade
            ->findProductAbstractAllowedQuantity($productAbstractTransfer);

        $allowedProductQuantityTransfer = $allowedProductQuantityResponseTransfer->getAllowedProductQuantityTransfer();

        if ($allowedProductQuantityTransfer === null || !$allowedProductQuantityResponseTransfer->getIsSuccessful()) {
            return null;
        }

        return $allowedProductQuantityTransfer;
    }
}
