<?php
namespace Perspective\Task1PriceGroup\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Pricing\Price;
use Perspective\Task1PriceGroup\Helper\Data;


class Task1PriceGroup implements ArgumentInterface
{
    private $helper;
    
    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $product;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    public function __construct(Data $helper,
        \Magento\Catalog\Model\Product $product,
        \Magento\Framework\Registry $registry)
    {
        $this->helper = $helper;
        $this->product = $product;
        $this->registry = $registry;
    }
    public function isModuleFunctionality()
    {
        return $this->helper->isModuleFunctionality();
    }

    public function isBasePriceShow()
    {
        return $this->helper->isBasePriceShow();
    }

    public function isFinalPriceShow()
    {
        return $this->helper->isFinalPriceShow();
    }

    public function isSpecialPriceShow()
    {
        return $this->helper->isSpecialPriceShow();
    }

    public function isTierPriceShow()
    {
        return $this->helper->isTierPriceShow();
    }

    public function isCatalogRulePriceShow()
    {
        return $this->helper->isCatalogRulePriceShow();
    }

    /*
    * Get current product 
    */
    public function getCurrentProduct()
    {
    return $this->registry->registry('current_product');
    }

    /*
    * Get product by current product ID
    */
    public function getProduct()
    {  
        return $this->product->load($this->getCurrentProduct()->getId());
    }

    /*
    * Get base price
    */
    public function getBasePrice()
    {   $BasePrice = $this->getProduct()->getPrice();
        if (!empty($BasePrice))
        {
            return round($BasePrice)."$";
        }
        else return "---";
    }

    /*
    * Get final price
    */
    public function getFinalPrice()
    {   $FinalPrice = $this->getProduct()->getFinalPrice();
        if (isset($FinalPrice))
        {
            return $FinalPrice."$";
        }
        else return "---";
    }

    /*
    * Get special price
    */
    public function getSpecialPrice()
    {   $SpecialPrice = $this->getProduct()->getSpecialPrice();
        if (isset($SpecialPrice))
        {
            return round($SpecialPrice)."$";
        }
        else return "---";
    }

    /*
    * Get tier price
    */
    public function getTierPrice()
    {   $Price = "";
        $TierPrice = $this->getProduct()->getTierPrices($this->getCurrentProduct());
        if (sizeof($TierPrice)){
        foreach($TierPrice as $TierPrices){
            $Price .= "</br>Price ".round($TierPrices->getValue())."$ for ".round($TierPrices->getQty());
        } 
        return $Price;
    }
        else return "---";
    }

    /*
    * Get catalog rule price
    */
    public function getCatalogRulePrice()
    {
        if ($this->getProduct()->getPriceInfo()->getPrice('catalog_rule_price')->getAmount()->getValue())
        {
            return $this->getProduct()->getPriceInfo()->getPrice('catalog_rule_price')->getAmount()->getValue()."$";
        }
        else return "---";
    }


}
