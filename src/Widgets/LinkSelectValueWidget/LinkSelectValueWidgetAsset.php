<?php

namespace kosuha606\Yii2BaseKit\Widgets\LinkSelectValueWidget;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\LinkSelectValueWidget
 */
class LinkSelectValueWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'LinkSelectValueWidget.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        BootstrapAsset::class
    ];
}