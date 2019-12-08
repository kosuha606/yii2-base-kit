<?php

namespace kosuha606\Yii2BaseKit\Widgets\InListValuesWidget;

use kosuha606\Yii2BaseKit\Widgets\AbstractJsWidget;

class InListValuesWidget extends AbstractJsWidget
{
    public $model;

    public $sortBy;

    public $attribute;

    public $selectedValues;

    public $allValues;

    public $labels;

    public $templates;

    public function config()
    {
        return __DIR__.'/config.php';
    }
}
