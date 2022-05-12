<?php declare(strict_types=1);
/**
 * Copyright © 2022 HP. All rights reserved.
*/

namespace HP\Megamenu\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class MegamenuActions extends Column
{
    public const URL_PATH_EDIT = 'megamenu/index/edit';
    public const URL_PATH_DELETE = 'megamenu/index/delete';
     
    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Constructor
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['menu_id'])) {
                    $item[$this->getData('name')]['edit'] = [
                        
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                    'menu_id' => $item['menu_id']
                                ]
                            ),
                            'label' => __('Edit'),
                           'hidden'=>false,
                        
                    ];
                    $item[$this->getData('name')]['delete'] = [
                      
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'menu_id' => $item['menu_id']
                                ]
                            ),
                            'label' => __('Delete'),
                            'hidden'=>false,
                        
                     ];
                        
                }
            }
        }
        return $dataSource;
    }
}
