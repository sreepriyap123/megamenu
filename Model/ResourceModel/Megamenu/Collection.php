<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\ResourceModel\Megamenu;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use HP\Megamenu\Model\Megamenu as MegaMenuModel;
use HP\Megamenu\Model\ResourceModel\Megamenu as MegaMenuResourceModel;

class Collection extends AbstractCollection
{
   /**
    * @var string
    */
    protected $_idFieldName = 'menu_id';

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            MegaMenuModel::class,
            MegaMenuResourceModel::class
        );
        $this->_idFieldName = 'menu_id';
    }
}
