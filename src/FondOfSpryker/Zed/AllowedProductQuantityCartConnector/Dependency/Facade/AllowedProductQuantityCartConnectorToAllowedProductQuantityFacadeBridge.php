<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade;

use FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface;
use Generated\Shared\Transfer\AllowedProductQuantityResponseTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;

class AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeBridge implements AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface
     */
    protected $allowedProductQuantityFacade;

    /**
     * @param \FondOfSpryker\Zed\AllowedProductQuantity\Business\AllowedProductQuantityFacadeInterface $allowedProductQuantityFacade
     */
    public function __construct(AllowedProductQuantityFacadeInterface $allowedProductQuantityFacade)
    {
        $this->allowedProductQuantityFacade = $allowedProductQuantityFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\AllowedProductQuantityResponseTransfer
     */
    public function findProductAbstractAllowedQuantity(
        ProductAbstractTransfer $productAbstractTransfer
    ): AllowedProductQuantityResponseTransfer {
        return $this->allowedProductQuantityFacade->findProductAbstractAllowedQuantity($productAbstractTransfer);
    }

    /**
     * @param array<string> $abstractSkus
     *
     * @return array<string, \Generated\Shared\Transfer\AllowedProductQuantityTransfer>
     */
    public function findGroupedProductAbstractAllowedQuantitiesByAbstractSkus(array $abstractSkus): array
    {
        return $this->allowedProductQuantityFacade->findGroupedProductAbstractAllowedQuantitiesByAbstractSkus(
            $abstractSkus,
        );
    }
}
