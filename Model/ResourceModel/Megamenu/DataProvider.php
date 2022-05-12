<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Model\ResourceModel\Megamenu;

use HP\Megamenu\Model\ResourceModel\Megamenu\Grid\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var StoreManagerInterface
     */
    public $storeManager;

    /**
     * @var UrlInterface
     */
    public $url;

    /**
     * Dataprovider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param UrlInterface $url
     * @param CollectionFactory $megamenuCollectionFactory
     * @param StoreManagerInterface $storeManager
     * @param array $meta = []
     * @param array $data = []
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        UrlInterface $url,
        CollectionFactory $megamenuCollectionFactory,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->url = $url;
        $this->collection = $megamenuCollectionFactory->create();
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    /**
     * Get Meta Function
     *
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        $meta['menu_details']['children']['menu_type']['arguments']['data']['config']['url'] =
            $this->url->getUrl('megamenu/index/parentmenu/');

        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $data = $item->getData();
            if ($item->getImage()) {
                $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'menuimage/';
                $data['image'] = [
                    0=>['name'=>$item->getImage(),'url' =>$mediaUrl.$item->getImage()]
                ];
            }
            $this->loadedData[$item->getId()] = $data;
        }
        return $this->loadedData;
    }
}
