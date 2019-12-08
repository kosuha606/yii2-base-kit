<?php

namespace kosuha606\Yii2BaseKit\Assets\JqueryUnderscoreAsset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryUnderscoreAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'underscore.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];
}