<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\Data;

use HP\Megamenu\Api\Data\MegamenuInterface;
use HP\Megamenu\Model\Megamenu as MegamenuModel;
use HP\Megamenu\Model\ResourceModel\Megamenu as ResourceModel;

class Megamenu extends MegamenuModel implements MegamenuInterface
{

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::MENU_ID);
    }

     /**
      * Set Id
      *
      * @param int $id
      * @return $this
      */
    public function setId($id)
    {
        return $this->setData(self::MENU_ID, $id);
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * Set Image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Get Link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->getData(self::LINK);
    }

    /**
     * Set Link
     *
     * @param string $link
     * @return $this
     */
    public function setLink($link)
    {
        return $this->setData(self::LINK, $link);
    }

     /**
      * Get Parent Id
      *
      * @return string
      */
    public function getParentId()
    {
        return $this->getData(self::PARENT_ID);
    }

    /**
     * Set Parent id
     *
     * @param int $parentId
     * @return $this
     */
    public function setParentId($parentId)
    {
        return $this->setData(self::PARENT_ID, $parentId);
    }

    /**
     * Get Postion
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * Set Position
     *
     * @param  int $position
     * @return $this
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Get Type
     *
     * @return string
     */
    public function getMenuType()
    {
        return $this->getData(self::MENU_TYPE);
    }

    /**
     * Set Type
     *
     * @param string $type
     * @return $this
     */
    public function setMenuType($type)
    {
        return $this->setData(self::MENU_TYPE, $type);
    }

    /**
     * Get Status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set Status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

     /**
      * Get IsNewTab
      *
      * @return string
      */
    public function getIsNewTab()
    {
        return $this->getData(self::ISNEWTAB);
    }

    /**
     * Set IsNewTab
     *
     * @param string $isNewTab
     * @return $this
     */
    public function setIsNewTab($isNewTab)
    {
        return $this->setData(self::ISNEWTAB, $isNewTab);
    }
}
