<?php

namespace kosuha606\Yii2BaseKit\Widgets\JsTreeWidget;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JsTreeWidgetAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = __DIR__.'/resources';

    /**
     * @var array
     */
    public $js = [
        'jstree_package/dist/jstree.js',
    ];

    /**
     * @var array
     */
    public $css = [
        'jstree_package/dist/themes/default/style.css',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class
    ];
}
