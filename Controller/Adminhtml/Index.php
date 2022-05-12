<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Controller\Adminhtml;

abstract class Index extends \Magento\Backend\App\Action
{
    
    /**
     * Registry key where current label ID is stored
     */
    public const CURRENT_ID = 'current_id';

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry = null;

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'HP_Megamenu::menulist';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('HP_Megamenu::megamenu')
            ->addBreadcrumb(__('Megamenu'), __('Megamenu'));
        return $resultPage;
    }

    /**
     * Check view permission
     *
     * @return boolean
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }

    /**
     * Question initialization
     *
     * @return string  id
     */
    public function initCurrentItem()
    {
        $menuId = (int)$this->getRequest()->getParam('menu_id');
        if ($menuId) {
            $this->coreRegistry->register(self::CURRENT_ID, $menuId);
        }
        return $menuId;
    }
}
