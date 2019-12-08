<?php

namespace kosuha606\Yii2BaseKit\Widgets\DataTableWidget;

use kosuha606\Yii2BaseKit\Assets\DataTableAsset\DataTableAsset;
use yii\web\AssetBundle;

class DataTableWidgetAsset extends AssetBundle
{
    /**
     * @var array
     */
    public $depends = [
        DataTableAsset::class,
    ];
}