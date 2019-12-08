<?php

namespace kosuha606\Yii2BaseKit\Widgets\DataTableWidget;

use kosuha606\Yii2BaseKit\Assets\DataTableAsset\DataTableAsset;
use kosuha606\Yii2BaseKit\Services\Base\BaseServiceLocator;
use yii\base\Widget;

/**
 * TODO Добавить editor extension
 * @package kosuha606\Yii2BaseKit\Widgets\DataTableWidget
 */
class DataTableWidget extends Widget
{
    public $headers = [];

    public function init()
    {
        $view = $this->getView();
        $bundle = DataTableAsset::register($this->getView());
        $view->registerCss(
            BaseServiceLocator::o()->staticViewService->renderFile(
                __DIR__ . '/views/css/datatables.css',
                [
                    'path' => $bundle->baseUrl
                ]
            )
        );
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'id' => $this->getId(),
            'headers' => $this->headers,
        ]);
    }
}
