<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use HP\Megamenu\Model\MegamenuFactory;
use HP\Megamenu\Api\Data\MegamenuInterface;
use HP\Megamenu\Model\ResourceModel\Megamenu;
use HP\Megamenu\Api\Data\MegamenuInterfaceFactory;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteriaInterface;
use HP\Megamenu\Api\Data\MegamenuSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use HP\Megamenu\Model\ResourceModel\Megamenu\CollectionFactory;

class MegamenuRepository implements \HP\Megamenu\Api\MegamenuRepositoryInterface
{
    
    /**
     * @var megamenuFactory
     */
    private $megamenuFactory;
    /**
     * @var ResourceModel\Megamenu
     */
    private $megamenuResource;
    /**
     * @var \HP\Megamenu\Api\Data\MegamenuInterfaceFactory
     */
    private $megamenuDataFactory;
    /**
     * @var \Magento\Framework\Api\ExtensibleDataObjectConverter
     */
    private $dataObjectConverter;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;
    /**
     * @var MegamenuSearchResultsInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * MegamenuRepository constructor.
     * @param MegamenuFactory $megamenuFactory
     * @param Megamenu $megamenuResource
     * @param MegamenuInterfaceFactory $megamenuDataFactory
     * @param ExtensibleDataObjectConverter $dataObjectConverter
     * @param DataObjectHelper $dataObjectHelper
     * @param MegamenuSearchResultsInterfaceFactory $searchResultFactory
     * @param DataObjectProcessor $dataObjectProcessor
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        MegamenuFactory $megamenuFactory,
        Megamenu $megamenuResource,
        MegamenuInterfaceFactory $megamenuDataFactory,
        ExtensibleDataObjectConverter $dataObjectConverter,
        DataObjectHelper $dataObjectHelper,
        MegamenuSearchResultsInterfaceFactory $searchResultFactory,
        DataObjectProcessor $dataObjectProcessor,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory
    ) {
        $this->megamenuFactory = $megamenuFactory;
        $this->megamenuResource = $megamenuResource;
        $this->megamenuDataFactory = $megamenuDataFactory;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->searchResultFactory = $searchResultFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get By Id
     *
     * @param int $menu_id
     * @return MegamenuInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($menu_id)
    {
        $megamenuObj = $this->megamenuFactory->create();
        $this->megamenuResource->load($megamenuObj, $menu_id);
        if (!$megamenuObj->getId()) {
            throw new NoSuchEntityException(__('Item with id "%1" does not exist.', $menu_id));
        }
        $data = $this->megamenuDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $megamenuObj->getData(),
            MegamenuInterface::class
        );
        $data->setId($megamenuObj->getId());
        return $data;
    }

    /**
     * Save Megamenu Data
     *
     * @param MegamenuInterface $megamenuInterface
     * @return MegamenuInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(MegamenuInterface $megamenuInterface)
    {
        try {
            $this->megamenuResource->save($megamenuInterface);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the data: %1',
                $exception->getMessage()
            ));
        }
        return $megamenuInterface;
    }

    /**
     * Delete the Megamenu by Menu id
     *
     * @param int $menuId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($menuId)
    {
        $megamenuObj = $this->megamenuFactory->create();
        $this->megamenuResource->load($megamenuObj, $menuId);
        $this->megamenuResource->delete($megamenuObj);
        if ($megamenuObj->isDeleted()) {
            return true;
        }
        return false;
    }

    /**
     * Get List
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \HP\Megamenu\Api\Data\MegamenuSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
