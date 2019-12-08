<?php

namespace kosuha606\Yii2BaseKit\Widgets\JsChartWidget;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JsChartWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}