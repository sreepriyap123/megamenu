<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Block\Adminhtml\Megamenu\Edit\Button;

use HP\Megamenu\Api\Data\MegamenuInterface;

class Back extends Generic
{
    
    /**
     * Get Back Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('megamenu/index/menu')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}
