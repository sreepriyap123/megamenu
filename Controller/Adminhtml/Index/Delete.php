<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Controller\Adminhtml\Index;

class Delete extends \HP\Megamenu\Controller\Adminhtml\Index
{
    /**
     * @var \HP\Megamenu\Api\MegamenuRepositoryInterface
     */
    private $megamenuRepository;

     /**
      * Authorization level of a basic admin session
      *
      * @see _isAllowed()
      */
    public const ADMIN_RESOURCE = 'HP_Megamenu::delete';

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository
    ) {
            $this->megamenuRepository = $megamenuRepository;
            parent::__construct($context, $registry);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('menu_id');
        if ($id) {
            try {
                $this->megamenuRepository->deleteById($id);
                $this->messageManager->addSuccess(__('You deleted the item.'));
                return $resultRedirect->setPath('megamenu/index/menu');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['menu_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find the item to delete.'));
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check delete Permission.
     *
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
    }
}
