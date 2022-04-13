<?php
namespace OpenTechiz\InfluencerAffiliate\Controller\Affiliate;

use OpenTechiz\InfluencerAffiliate\Model\Influence;
use OpenTechiz\InfluencerAffiliate\Model\ResourceModel\Influence as InfluenceResourceModel;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

       /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_helperCmsPage;

    /**
     * @param \OpenTechiz\InfluencerAffiliate\Model\Influencer $_influencer
     */
    private $_influence;

    /**
     * @param \OpenTechiz\InfluencerAffiliate\Model\ResourceModel\Influencer $_influencerResourceModel
     */
    private $_influenceResourceModel;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Cms\Helper\Page                   $helperCmsPage,
        \Magento\Framework\App\Action\Context      $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        Influence                                 $influence,
        InfluenceResourceModel                    $influenceResourceModel
    )
    {
        $this->_helperCmsPage = $helperCmsPage;
        $this->_influence = $influence;
        $this->_influenceResourceModel = $influenceResourceModel;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** 
         * Get Request Send, Get Params
         */
        $params = $this->getRequest()->getParams();
        //TODO: Challenge Modify here to support the edit save functionality
        $influence = $this->_influence->setData($params);
   
        
        try {
            $this->_influenceResourceModel->save($influence);
                  /* Redirect to display page register successful */
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('influencer/affiliate/success');
            return $redirect;
        } 
        catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Something went wrong."));
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setUrl($this->_redirect->getRefererUrl());
            return $redirect;
        }
    }
}
