<?php
namespace OpenTechiz\InfluencerAffiliate\Model\ResourceModel;

class HistoryInfluence extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('history_change_influencer', 'history_id');
    }
}
