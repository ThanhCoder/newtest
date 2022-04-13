<?php
namespace OpenTechiz\InfluencerAffiliate\Model\ResourceModel\HistoryInfluence;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'history_id';
    protected $_eventPrefix = 'opentechiz_influenceraffiliate_history_influence_collection';
    protected $_eventObject = 'history_influence_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\InfluencerAffiliate\Model\HistoryInfluence', 'OpenTechiz\InfluencerAffiliate\Model\ResourceModel\HistoryInfluence');
    }
}
