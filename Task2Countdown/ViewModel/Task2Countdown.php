<?php
namespace Perspective\Task2Countdown\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\CatalogRule\Model\Rule;

class Task2Countdown implements ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Model\Product
     */
    private $product;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;
    
    /**
     * @var \Magento\CatalogRule\Model\RuleFactory
     */
    private $ruleFactory;

    /**
     * @var \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;

    public function __construct(
    \Magento\Catalog\Model\Product $product,
    \Magento\Framework\Registry $registry,
    \Magento\CatalogRule\Model\RuleFactory $ruleFactory,
    \Magento\CatalogRule\Model\ResourceModel\Rule\CollectionFactory $collectionFactory,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->product = $product;
        $this->registry = $registry;
        $this->ruleFactory = $ruleFactory;
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
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



    public function getMinEndTime()
    {
        return $this->getProduct()->getSpecialToDate();
    }

    public function getCatalogPriceRuleCollection()
    {   $currentDateTime = $this->timezone->date()->format('Y-m-d H:i:s');
        $ruleCollection = $this->collectionFactory->create()
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('from_date', ['lteq' => $currentDateTime])
                ->addFieldToFilter('to_date', ['gteq' => $currentDateTime])
                ->getItems();
    
        return $ruleCollection;
    }
   
    public function countdown()
    {$ruleCollection = $this->getCatalogPriceRuleCollection();
        if($this->getMinEndTime()>reset($ruleCollection)->getToDate())
            return reset($ruleCollection )->getToDate();
        else return $this->getMinEndTime();
    }
}
