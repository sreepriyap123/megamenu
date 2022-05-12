<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
 */

namespace HP\Megamenu\Helper;

use HP\Megamenu\Model\MegamenuFactory;
use Magento\Store\Model\StoreManagerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    
    /**
     * @var MegamenuFactory $megamenuFactory
     */
    private $megamenuFactory;
    
    /**
     * @var $menuTree
     */
    private $menuTree = [[
        'label' => 'Please Select',
        'value' => 0,
    ]];

    /**
     * @var $separator
     */
    private $separator;

    /**
     * Megamenu constructor.
     *
     * @param MegamenuFactory $megamenuFactory
     */
    public function __construct(
        MegamenuFactory $megamenuFactory
    ) {
        $this->megamenuFactory = $megamenuFactory;
    }

    /**
     * Format menu collection.
     *
     * @param string $type
     * @param int $menuId
     * @return array
     */
    public function getMenus($type, $menuId)
    {
        $childMenus = [];
        $menuCollection = $this->megamenuFactory->create()->getCollection()
                        ->addFieldToFilter('parent_id', ['neq' => 0]) ;
                        
        if ($menuId) {
            $menuCollection->addFieldToFilter('menu_id', ['neq' =>$menuId]);
        }
        if ($type) {
            $menuCollection->addFieldToFilter('menu_type', $type);
        }
        $menuCollection->setOrder('position', 'ASC');

        foreach ($menuCollection as $menu) {
            $childMenus[] = $menu->getData();
        }
        $menuCollection = $this->megamenuFactory->create()->getCollection()
                    ->addFieldToFilter('parent_id', 0);
        if ($type) {
            $menuCollection->addFieldToFilter('menu_type', $type);
        }
        if ($menuId) {
            $menuCollection->addFieldToFilter('menu_id', ['neq' =>$menuId]);
        }
        $menuCollection->setOrder('position', 'ASC');

        foreach ($menuCollection as $menu) {
            $this->separator = '--';
                $this->menuTree[] = [
                'value' => $menu->getMenuId(),
                'label' => $menu->getTitle()
                ];
                $this->getMenuTree($menu->getMenuId(), $childMenus, $this->separator);
        }
        return $this->menuTree;
    }
  
    /**
     * Format menu tree.
     *
     * @param array $mainMenuId
     * @param array $childMenus
     * @param array $separator
     * @return array
     */
    private function getMenuTree($mainMenuId, $childMenus, $separator)
    {
        if ($mainMenuId) {
            if (!empty($childMenus)) {
                foreach ($childMenus as $k => $param) {
                    if ($param['parent_id'] == $mainMenuId) {
                        $this->menuTree[] =
                            [
                                'value' => $param['menu_id'],
                                'label' => $separator.' '.$param['title']
                            ];
                            $this->separator .= '--';
                           $this->getMenuTree($param['menu_id'], $childMenus, $this->separator);
                    }
                }
            }
        }
        
        return $this->menuTree;
    }
}
