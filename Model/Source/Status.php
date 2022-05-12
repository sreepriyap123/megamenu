<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
 
class Status implements OptionSourceInterface
{

    /**
     * Option Array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => 'Please Select'],
            ['value' => '1', 'label' => 'Enabled'],
            ['value' => '0', 'label' => 'Disabled']
        ];
    }
}
