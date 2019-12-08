<?php

namespace kosuha606\Yii2BaseKit\Widgets\AddelWidget;

use yii\web\AssetBundle;

class AddelWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'js/addel.js',
        'js/AddelWidget.js',
    ];
}