<?php
namespace OpenTechiz\InfluencerAffiliate\Block\Affiliate;

use Magento\Store\Model\ScopeInterface;
use Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;


class Influencer extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory
     */
    protected $_agreementCollectionFactory;

    /**
     * @params \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
     */
    protected $_countryCollectionFactory;
    
    /**
     * @params \OpenTechiz\InfluencerAffiliate\Model\InfluenceFactoryy
     */
    protected $_influenceFactory;

    /**
     * @param 
     */
    protected $_getDataCountry;


    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\CollectionFactory $agreementCollectionFactory,
        \OpenTechiz\InfluencerAffiliate\Model\InfluenceFactory  $influenceFactory,
        \Magento\Directory\Block\Data $getDataCountry, 
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        array $data = []
    ) 
    {  
        $this->_agreementCollectionFactory = $agreementCollectionFactory;
        $this->_countryCollectionFactory = $countryCollectionFactory;
        $this->_getDataCountry = $getDataCountry;
        $this->_influenceFactory = $influenceFactory;
        parent::__construct($context, $data);
    }

    /**
    * @param getPostCollection()
    */
   public function getPostCollection()
   {
       $post = $this->_influenceFactory->create();
       return $post->getCollection();
   }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->getUrl('influencer/affiliate/save');
    }

    public function getCountries(){
        $post = $this->_influenceFactory->create();
        return $post->getCollection();
    }
    
    /**
     * get Selected Gender Follow Hightest
     */
    public function getGenderOptions()
    {
        return [
            ['value' => 'female', 'label' => __('Female')],
            ['value' => 'male', 'label' => __('Male')],
            ['value' => 'other', 'label' => __('Prefer not to answer')],
        ];
    }

    public function getQuestionSelect(){
        return [
            ['value' => 1, 'label' => __('Yes')],
            ['value' => 2, 'label' => __('No')]
        ];
    }

    public function getBrandSocial(){
        return [
            ['value' => 'instagram', 'label' => __('Instagram')],
            ['value' => 'facebook', 'label' => __('Facebook')],
            ['value' => 'snapchat', 'label' => __('Snapchat')],
            ['value' => 'tiktok', 'label' => __('Tiktok')],
            ['value' => 'youtube', 'label' => __('Youtube')],
            ['value' => 'pinterest', 'label' => __('Pinterest')],
        ];
    }

    public function getCountryOption(){
        return [
            ['value' => 'DE', 'label' => __(' Germany')],
            ['value' => 'GB', 'label' => __('United Kingdom')],
            ['value' => 'US', 'label' => __('Usa')],
            ['value' => 'FR', 'label' => __('France')],
            ['value' => 'ES', 'label' => __('Spain')],
            ['value' => 'IT', 'label' => __('Italy')],
            ['value' => 'NO', 'label' => __('Norway')],
            ['value' => 'DK', 'label' => __('Denmark')],
            ['value' => 'OT', 'label' => __('Other')],
        ];
    }       

    public function getAvailableCountries()
    {
        $collection = $this->_countryCollectionFactory->create();
        $collection->addFieldToSelect('*');

        return $collection;
    }
    
    public function getAgreements()
    {
        if (!$this->hasAgreements()) {
            $agreements = [];
            if ($this->_scopeConfig->isSetFlag('checkout/options/enable_agreements', ScopeInterface::SCOPE_STORE)) {
                /** @var \Magento\CheckoutAgreements\Model\ResourceModel\Agreement\Collection $agreements */
                $agreements = $this->_agreementCollectionFactory->create();
                $agreements->addStoreFilter($this->_storeManager->getStore()->getId());
                $agreements->addFieldToFilter('is_active', 1);
            }
            $this->setAgreements($agreements);
        }
        return $this->getData('agreements');
    }
}

