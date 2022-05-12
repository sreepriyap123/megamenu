<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model;

use Magento\Framework\Exception\LocalizedException as CoreException;

class Megamenu extends \Magento\Framework\Model\AbstractModel
{

   /**
    * Megamenu constructor
    *
    * @return void
    */
    public function _construct()
    {
        $this->_init(ResourceModel\Megamenu::class);
    }
}
