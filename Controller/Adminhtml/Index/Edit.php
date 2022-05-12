<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Controller\Adminhtml\Index;

class Edit extends \HP\Megamenu\Controller\Adminhtml\Index
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Megamenu::edit';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \HP\Megamenu\Api\MegamenuRepositoryInterface
     */
    private $megamenuRepository;
    
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \HP\Megamenu\Model\MegamenuFactory
     */
    private $megamenuFactory;
    
    /**
     * Edit constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository
     * @param \HP\Megamenu\Model\MegamenuFactory $megamenuFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository,
        \HP\Megamenu\Model\MegamenuFactory $megamenuFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->megamenuRepository = $megamenuRepository;
        $this->coreRegistry = $coreRegistry;
        $this->megamenuFactory = $megamenuFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit item
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->initCurrentItem();
     
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Item') : __('New Item'),
            $id ? __('Edit Item') : __('New Item')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Megamenu Manager'));
        $resultPage->getConfig()->getTitle()->prepend($id? ('Edit Item') : __('New Item'));
        return $resultPage;
    }

    /**
     * Check Edit Permission.
     *
     * @return bool
     */
    public function _isAllowed()
    {
        if (($this->_authorization->isAllowed('HP_Megamenu::add')) ||
            ($this->_authorization->isAllowed('HP_HP_Megamenu::edit'))) {
            return true;
        }
        return false;
    }
}
