<?php

namespace kosuha606\Yii2BaseKit\Widgets\OutFormSubmitButtons;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class OutFormSubmitButtonsAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';
    /**
     * @var array
     */
    public $js = [
        'OutFormSubmitButtons.js',
    ];

    public $depends = [
        YiiAsset::class,
    ];
}