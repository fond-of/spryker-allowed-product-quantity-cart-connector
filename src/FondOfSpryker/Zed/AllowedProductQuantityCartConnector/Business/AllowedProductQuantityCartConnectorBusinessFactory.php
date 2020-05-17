<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorDependencyProvider;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidator;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteValidator;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig getConfig()
 */
class AllowedProductQuantityCartConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator($this->createQuoteItemValidator());
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Model\QuoteItemValidatorInterface
     */
    public function createQuoteItemValidator(): QuoteItemValidatorInterface
    {
        return new QuoteItemValidator($this->getAllowedProductQuantityFacade());
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
     */
    protected function getAllowedProductQuantityFacade(): AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
    {
        return $this->getProvidedDependency(AllowedProductQuantityCartConnectorDependencyProvider::FACADE_ALLOWED_PRODUCT_QUANTITY);
    }
}
