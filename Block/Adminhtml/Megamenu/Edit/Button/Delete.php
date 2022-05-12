<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Block\Adminhtml\Megamenu\Edit\Button;

use HP\Megamenu\Api\Data\MegamenuInterface;

class Delete extends Generic
{
    
    /**
     * Get Delete Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getRequest()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    
    /**
     * Get Delete Url
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('megamenu/index/delete', ['menu_id' => $this->getRequest()]);
    }
}
