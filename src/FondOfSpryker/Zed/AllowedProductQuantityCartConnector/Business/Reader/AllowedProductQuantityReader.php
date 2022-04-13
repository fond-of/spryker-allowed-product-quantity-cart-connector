<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader;

use ArrayObject;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilterInterface;
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
     * @var \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilterInterface|null
     */
    protected $abstractSkuFilter;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface $allowedProductQuantityFacade
     * @param \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilterInterface|null $abstractSkuFilter
     */
    public function __construct(
        AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface $allowedProductQuantityFacade,
        ?AbstractSkuFilterInterface $abstractSkuFilter = null
    ) {
        $this->allowedProductQuantityFacade = $allowedProductQuantityFacade;
        $this->abstractSkuFilter = $abstractSkuFilter;
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

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<string, \Generated\Shared\Transfer\AllowedProductQuantityTransfer>
     */
    public function getGroupedByItems(ArrayObject $itemTransfers): array
    {
        if ($this->abstractSkuFilter === null) {
            return [];
        }

        $abstractSkus = $this->abstractSkuFilter->filterFromItems($itemTransfers);

        return $this->allowedProductQuantityFacade->findGroupedProductAbstractAllowedQuantitiesByAbstractSkus(
            $abstractSkus,
        );
    }
}
