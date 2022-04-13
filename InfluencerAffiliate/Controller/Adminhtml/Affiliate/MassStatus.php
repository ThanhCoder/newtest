<?php

namespace OpenTechiz\InfluencerAffiliate\Controller\Adminhtml\Affiliate;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\Auth\Session;
use OpenTechiz\InfluencerAffiliate\Model\InfluenceFactory;
use OpenTechiz\InfluencerAffiliate\Model\HistoryInfluenceFactory;
use OpenTechiz\InfluencerAffiliate\Model\ResourceModel\Influence\CollectionFactory;


class MassStatus extends Action
{
    protected $logger;
    protected $filter;
    protected $resultPageFactory;
    protected $collectionFactory;
    protected $influenceFactory;
    protected $authSession;
    protected $historyInfluencerFactory;
    private $scopeConfig;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Filter $filter,
        Session $authSession,
        \Psr\Log\LoggerInterface $logger,
        ScopeConfigInterface $scopeConfig,
        InfluenceFactory $influenceFactory,
        HistoryInfluenceFactory $historyInfluencerFactory,
        CollectionFactory $collectionFactory
    )
    {
        parent::__construct($context);
        $this->historyInfluencerFactory = $historyInfluencerFactory;
        $this->logger = $logger;
        $this->resultPageFactory = $resultPageFactory;
        $this->filter = $filter;
        $this->scopeConfig = $scopeConfig;
        $this->authSession = $authSession;
        $this->influenceFactory = $influenceFactory;
        $this->collectionFactory = $collectionFactory;

    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $updated = 0;
            foreach ($collection as $item) {
                $influencer = $this->historyInfluencerFactory->create();
                $influencer->setData('status_id', $item->getData('status_id'));
                $influencer->setData('user_access', $item->getData('user_access'));
                $influencer->setData('influencer_id', $item->getData('influencer_id'));
                $influencer->save();
                $item->setData('status_id', $this->getRequest()->getParam('status'));
                $item->setData('user_access', $this->authSession->getUser()->getUsername());
                $item->save();
                $updated++;
            }
            if ($updated) {
                $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $updated));
            }

        } catch (\Exception $e) {
            \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info($e->getMessage());
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    protected function _isAllowed()
    {
        return true;
    }
}
