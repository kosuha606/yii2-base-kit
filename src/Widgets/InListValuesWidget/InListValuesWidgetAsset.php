<?php

namespace kosuha606\Yii2BaseKit\Widgets\InListValuesWidget;

use kosuha606\Yii2BaseKit\Assets\JqueryUnderscoreAsset\JqueryUnderscoreAsset;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class InListValuesWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'js/main.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        JqueryUnderscoreAsset::class,
        BootstrapAsset::class
    ];
}
