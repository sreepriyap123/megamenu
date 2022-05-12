<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Block\Adminhtml\Megamenu\Edit\Button;

use HP\Megamenu\Api\Data\MegamenuInterface;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Generic implements ButtonProviderInterface
{
    /**
     * Url Builder
     *
     * @var Context
     */
    public $context;
    
    /**
     * @var Registry
     */
    public $registry;
    
    /**
     * Generic constructor
     *
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->context = $context;
        $this->registry = $registry;
    }
    
    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }
    
    /**
     * Get Request
     *
     * @return ProductInterface
     */
    public function getRequest()
    {
        return $this->registry->registry('current_id');
    }
    
    /**
     * @inheritdoc
     */
    public function getButtonData()
    {
        return [];
    }
}
