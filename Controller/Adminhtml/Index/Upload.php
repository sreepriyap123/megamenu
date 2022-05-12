<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/
 
namespace HP\Megamenu\Controller\Adminhtml\Index;
 
use Magento\Framework\Controller\ResultFactory;
 
class Upload extends \Magento\Backend\App\Action
{

    /**
     * @var \HP\Megamenu\Model\ImageUploader
     */
    public $imageUploader;

    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \HP\Megamenu\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \HP\Megamenu\Model\ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }
    
    /**
     * Authorization
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('HP_Megamenu::menuimage');
    }
 
    /**
     * Upload Image
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'image');

        try {
            $result = $this->imageUploader->saveFileToTmpDir($imageId);
        } catch (Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
