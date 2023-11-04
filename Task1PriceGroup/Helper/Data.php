<?php
namespace Perspective\Task1PriceGroup\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data extends AbstractHelper
{
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }
    public function isModuleFunctionality($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/ModuleFunctionality',
            $scope
        );
    }

    public function isBasePriceShow($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/BasePriceShow',
            $scope
        );
    }
    
    public function isFinalPriceShow($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/FinalPriceShow',
            $scope
        );
    }
    
    public function isSpecialPriceShow($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/SpecialPriceShow',
            $scope
        );
    }

    public function isTierPriceShow($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/TierPriceShow',
            $scope
        );
    }

    public function isCatalogRulePriceShow($scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT)
    {
        return $this->scopeConfig->isSetFlag(
            'perspective/general/CatalogRulePriceShow',
            $scope
        );
    }
}
