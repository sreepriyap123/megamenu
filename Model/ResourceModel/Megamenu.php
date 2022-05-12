<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\ResourceModel;

class Megamenu extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
   
    /**
     * Define main table
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('hp_megamenu', 'menu_id');
    }
}
