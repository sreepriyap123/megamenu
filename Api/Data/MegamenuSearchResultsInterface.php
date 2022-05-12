<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Api\Data;

interface MegamenuSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get Megamenu list.
     *
     * @return \HP\Megamenu\Api\Data\MegamenuInterface[]
     */
    public function getItems();

    /**
     * Set Megamenu list.
     *
     * @param \HP\Megamenu\Api\Data\MegamenuInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
