<?php
namespace OpenTechiz\InfluencerAffiliate\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends \Magento\Ui\Component\Listing\Columns\Column
{
        protected $urlBuilder;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, UrlInterface $urlBuilder, array $components=[], array $data=[])
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {
            foreach($dataSource['data']['items'] as &$item)
            {   
                $item[$this->getData('name')]['view'] = [
                    'href' => $this->urlBuilder->getUrl('influencer/affiliate/view', ['id' => $item['influencer_id']]),
                    'label' => __('View'),
                    'hidden' => false
                ];
            }
        }

        return $dataSource;
    }
}
