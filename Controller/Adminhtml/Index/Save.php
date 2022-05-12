<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Controller\Adminhtml\Index;

use HP\Megamenu\Api\Data\MegamenuInterface;

class Save extends \HP\Megamenu\Controller\Adminhtml\Index
{

    /**
     * @var \HP\Megamenu\Api\MegamenuRepositoryInterface
     */
    private $megamenuRepository;

    /**
     * @var  \HP\Megamenu\Api\Data\MegamenuInterfaceFactory
     */
    private $megamenuDataFactory;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * Save constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository
     * @param \HP\Megamenu\Api\Data\MegamenuInterfaceFactory $megamenuDataFactory
     * @param \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \HP\Megamenu\Api\MegamenuRepositoryInterface $megamenuRepository,
        \HP\Megamenu\Api\Data\MegamenuInterfaceFactory $megamenuDataFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
    ) {
        $this->megamenuRepository = $megamenuRepository;
        $this->megamenuDataFactory = $megamenuDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            if (isset($data['menu_id'])) {
                $menuId = $data['menu_id'];
                $megamenuRepository = $this->megamenuRepository->getById($menuId);
                $dataArray['id'] = $menuId;

                if (!$megamenuRepository->getId() && $menuId) {
                    $this->messageManager->addError(__('This menu no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $dataArray['image'] = null;
            if (isset($data['image']) && (isset($data['image'][0]['name']))) {
                $dataArray['image'] = $data['image'][0]['name'];
            }
            
            $dataArray['title'] = $data['title'];
            $dataArray['link'] = $data['link'];
            $dataArray['parent_id'] = $data['parent_id'];
            $dataArray['position'] = $data['position'];
            $dataArray['menu_type'] = $data['menu_type'];
            $dataArray['status'] = $data['status'];
            $dataArray['is_new_tab'] = $data['is_new_tab'];
            $megamenuInterface = $this->megamenuDataFactory->create();
            
            $this->dataObjectHelper->populateWithArray(
                $megamenuInterface,
                $dataArray,
                MegamenuInterface::class
            );
            try {
               
                $menuData = $this->megamenuRepository->save($megamenuInterface);
                $this->_getSession()->setFormData(false);
                $this->messageManager->addSuccess(__('You saved the Menu.'));
                return $resultRedirect->setPath('*/*/edit', ['menu_id' => $megamenuInterface->getId()]);
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->_getSession()->setFormData($data);
                return $resultRedirect->setPath(
                    '*/*/edit',
                    ['menu_id' => $megamenuInterface->getId()]
                );
            }
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Check save Permission.
     *
     * @return bool
     */
    public function _isAllowed()
    {
        if (($this->_authorization->isAllowed('HP_Megamenu::add')) ||
            ($this->_authorization->isAllowed('HP_Megamenu::edit'))) {
            return true;
        }
        return false;
    }
}
