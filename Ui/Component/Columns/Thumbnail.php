<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Ui\Component\Columns;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{

  /**
   *
   * @var StoreManagerInterface
   */
    protected $storeManagerInterface;

    /**
     * Thumbnail constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManagerInterface
     * @param array $components = []
     * @param array $data = []
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManagerInterface,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManagerInterface = $storeManagerInterface;
    }
    
    /**
     * Get Image Source
     *
     * @param array $dataSource
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $url = '';
                if (isset($item['image'])) {
                    $url = $this->storeManagerInterface->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .'menuimage/'. $item['image'];
                }
                $item['image' . '_src'] = $url;
                $item['image'. '_orig_src'] = $url;
            }
        }

        return $dataSource;
    }
}
