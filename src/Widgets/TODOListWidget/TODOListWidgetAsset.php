<?php

namespace kosuha606\Yii2BaseKit\Widgets\TODOListWidget;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\TODOListWidget
 */
class TODOListWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $css = [
        'css/style.css',
    ];

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
        BootstrapAsset::class
    ];
}
