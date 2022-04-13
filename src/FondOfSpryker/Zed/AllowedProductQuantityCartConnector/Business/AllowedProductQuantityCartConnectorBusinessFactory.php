<?php

namespace FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business;

use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorDependencyProvider;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilter;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilterInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReader;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemsValidator;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemsValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidator;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\QuoteValidator;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\QuoteValidatorInterface;
use FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\AllowedProductQuantityCartConnectorConfig getConfig()
 */
class AllowedProductQuantityCartConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\QuoteValidatorInterface
     */
    public function createQuoteValidator(): QuoteValidatorInterface
    {
        return new QuoteValidator($this->createItemsValidator());
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemValidatorInterface
     */
    public function createItemValidator(): ItemValidatorInterface
    {
        return new ItemValidator(
            $this->createAllowedProductQuantityReader(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Validator\ItemsValidatorInterface
     */
    protected function createItemsValidator(): ItemsValidatorInterface
    {
        return new ItemsValidator(
            $this->createAllowedProductQuantityReader(),
            $this->createItemValidator(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Reader\AllowedProductQuantityReaderInterface
     */
    protected function createAllowedProductQuantityReader(): AllowedProductQuantityReaderInterface
    {
        return new AllowedProductQuantityReader(
            $this->createAbstractSkuFilter(),
            $this->getAllowedProductQuantityFacade(),
        );
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Business\Filter\AbstractSkuFilterInterface
     */
    protected function createAbstractSkuFilter(): AbstractSkuFilterInterface
    {
        return new AbstractSkuFilter();
    }

    /**
     * @return \FondOfSpryker\Zed\AllowedProductQuantityCartConnector\Dependency\Facade\AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
     */
    protected function getAllowedProductQuantityFacade(): AllowedProductQuantityCartConnectorToAllowedProductQuantityFacadeInterface
    {
        return $this->getProvidedDependency(AllowedProductQuantityCartConnectorDependencyProvider::FACADE_ALLOWED_PRODUCT_QUANTITY);
    }
}
