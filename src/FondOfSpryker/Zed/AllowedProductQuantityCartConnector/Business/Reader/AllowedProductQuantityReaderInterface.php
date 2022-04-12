<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader;

use Generated\Shared\Transfer\AllowedProductQuantityTransfer;
use Generated\Shared\Transfer\ItemTransfer;

interface AllowedProductQuantityReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\AllowedProductQuantityTransfer|null
     */
    public function getByItem(ItemTransfer $itemTransfer): ?AllowedProductQuantityTransfer;
}
