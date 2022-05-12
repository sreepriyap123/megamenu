<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use HP\Megamenu\Api\Data\MegamenuInterface;

interface MegamenuRepositoryInterface
{

    /**
     * Get Data
     *
     * @param int $menu_id
     * @return \HP\Megamenu\Api\Data\MegamenuInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($menu_id);

    /**
     * Save label Data
     *
     * @param \HP\Megamenu\Api\Data\MegamenuInterface $title
     * @return \HP\Megamenu\Api\Data\MegamenuInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(MegamenuInterface $title);

     /**
      * Load data collection by given search criteria
      *
      * @param SearchCriteriaInterface $searchCriteria
      * @return \HP\Megamenu\Api\Data\MegamenuSearchResultInterface
      */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete the name by menu id
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}
