<?php

namespace kosuha606\Yii2BaseKit\Assets\DataTableAsset;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class DataTableAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'js/datatables.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
    ];
}