<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface MegamenuInterface extends ExtensibleDataInterface
{
   
    public const MENU_ID      = 'menu_id';
    public const TITLE        = 'title';
    public const IMAGE        = 'image';
    public const LINK         = 'link';
    public const PARENT_ID    = 'parent_id';
    public const POSITION     = 'position';
    public const MENU_TYPE    = 'menu_type';
    public const STATUS       = 'status';
    public const ISNEWTAB     = 'is_new_tab';
    
     /**
      * Get Id
      *
      * @return int
      */
    public function getId();
 
    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle();
   
    /**
     * Get Image
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Get Link
     *
     * @return string|null
     */
    public function getLink();

     /**
      * Get Parent Id
      *
      * @return int
      */
    public function getParentId();

     /**
      * Get Position
      *
      * @return int
      */
    public function getPosition();

    /**
     * Get MenuType
     *
     * @return string|null
     */
    public function getMenuType();

    /**
     * Get Status
     *
     * @return string|null
     */
    public function getStatus();

    /**
     * Get IsNewTab
     *
     * @return string|null
     */
    public function getIsNewTab();

    /**
     * Set id
     *
     * @param int $id
     * @return MegamenuInterface
     */
    public function setId($id);

    /**
     * Set title
     *
     * @param string $title
     * @return MegamenuInterface
     */
    public function setTitle($title);

    /**
     * Set Image
     *
     * @param string $image
     * @return MegamenuInterface
     */
    public function setImage($image);

    /**
     * Set Link
     *
     * @param string $link
     * @return MegamenuInterface
     */
    public function setLink($link);

    /**
     * Set parent Id
     *
     * @param int $parentId
     * @return MegamenuInterface
     */
    public function setParentId($parentId);

    /**
     * Set position
     *
     * @param int $position
     * @return MegamenuInterface
     */
    public function setPosition($position);

    /**
     * Set MenuType
     *
     * @param string $menuType
     * @return MegamenuInterface
     */
    public function setMenuType($menuType);

    /**
     * Set Status
     *
     * @param boolean $status
     * @return MegamenuInterface
     */
    public function setStatus($status);

    /**
     * Set IsNewTab
     *
     * @param boolean $isNewTab
     * @return MegamenuInterface
     */
    public function setIsNewTab($isNewTab);
}
