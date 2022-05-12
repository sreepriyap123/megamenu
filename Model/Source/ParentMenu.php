<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class ParentMenu implements OptionSourceInterface
{
    /**
     * @var \Magento\Framework\App\Request\Http $request
     */
    private $request;

    /**
     * @var \HP\Megamenu\Model\MegamenuFactory $megamenuFactory
     */
    private $megamenuFactory;

    /**
     * @var \HP\Megamenu\Helper\Data $helperData
     */
    private $helperData;
    
    /**
     * ParentMenu constructor.
     *
     * @param \HP\Megamenu\Model\MegamenuFactory $megamenuFactory
     * @param \Magento\Framework\App\Request\Http $request
     * @param \HP\Megamenu\Helper\Data $helperData
     */
    public function __construct(
        \HP\Megamenu\Model\MegamenuFactory $megamenuFactory,
        \Magento\Framework\App\Request\Http $request,
        \HP\Megamenu\Helper\Data $helperData
    ) {
        $this->megamenuFactory = $megamenuFactory;
        $this->request = $request;
        $this->helperData = $helperData;
    }

    /**
     * Option Array
     */
    public function toOptionArray()
    {
        $type = '';
        $menuId = 0;
        if ($menuId = $this->request->getParam('menu_id')) {
            $menu = $this->megamenuFactory->create()->load($menuId);
            $type = $menu->getMenuType();
        }
        return $this->helperData->getMenus($type, $menuId);
    }
}
