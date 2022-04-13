<?php
namespace OpenTechiz\InfluencerAffiliate\Model\ResourceModel\Influence;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'influencer_id';
    protected $_eventPrefix = 'opentechiz_influenceraffiliate_influence_collection';
    protected $_eventObject = 'influence_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\InfluencerAffiliate\Model\Influence', 'OpenTechiz\InfluencerAffiliate\Model\ResourceModel\Influence');
    }
}
