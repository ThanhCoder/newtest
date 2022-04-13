<?php

namespace OpenTechiz\InfluencerAffiliate\Ui\Component\Listing\Column;

class Status implements \Magento\Framework\Option\ArrayInterface
{
/**
 * Options getter
 *
 * @return array
 */
   public function toOptionArray()
   {
       return [['value' => 1, 'label' => __('Pending')], ['value' => 2, 'label' => __('Approved')], ['value' => 3, 'label' => __('Disapproved')]];
   }
}