<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Backend\App\Action\Context;
use HP\Megamenu\Model\MegamenuFactory;
use HP\Megamenu\Helper\Data;

class Parentmenu extends \Magento\Backend\App\Action
{
    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var Data $helperData
     */
    private $helperData;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param Data $helperData
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        Data $helperData
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helperData = $helperData;
        return parent::__construct($context);
    }
    /**
     * ParentMenu action
     *
     * @return \Magento\Framework\Controller\Result\JsonFactory
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $menus = $this->helperData->getMenus(
            $this->getRequest()->getParam('type'),
            $this->getRequest()->getParam('menu_id')
        );

        $response = ['success' => false];
        if (! empty($menus)) {
            $response = ['success' => true, 'menu' => $menus];
        }
        return $result->setData($response);
    }
}
