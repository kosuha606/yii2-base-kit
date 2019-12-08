<?php

namespace kosuha606\Yii2BaseKit\Widgets\InfiniteScroll;

use kosuha606\Yii2BaseKit\Assets\JqueryUnderscoreAsset\JqueryUnderscoreAsset;
use kosuha606\Yii2BaseKit\Widgets\AbstractJsWidget;

class InfiniteScroll extends AbstractJsWidget
{
    public $allData;

    public $viewCount;

    public $synchronizationUrl;

    public $templates;

    public $assets = [
        JqueryUnderscoreAsset::class,
    ];

    public function config()
    {
        return __DIR__ . '/config.php';
    }
}