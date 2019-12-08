<?php

namespace kosuha606\Yii2BaseKit\Assets\JqueryInitializePluginAsset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryInitializePluginAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'jquery.initialize.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];
}
