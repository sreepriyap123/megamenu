<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\ResourceModel\Megamenu\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use HP\Megamenu\Model\Megamenu;
use Magento\Framework\Api;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Psr\Log\LoggerInterface as Logger;
use Magento\Eav\Api\AttributeRepositoryInterface;

class Collection extends SearchResult
{
    /**
     * @var Megamenu Model
     */
    private $megamenuModel;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attrRepoInt;

    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param AttributeRepositoryInterface $attrRepoInt
     * @param string $mainTable
     * @param string $resourceModel
     * @param Megamenu $megamenuModel
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        AttributeRepositoryInterface $attrRepoInt,
        $mainTable,
        $resourceModel,
        Megamenu $megamenuModel
    ) {
        $this->megamenu = $megamenuModel;
        $this->attrRepoInt = $attrRepoInt;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
    
     /**
      * Get total count.
      *
      * @return int
      */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }
}
