<?php

namespace kosuha606\Yii2BaseKit\Views\Grid;

use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;

class LinkColumn extends DataColumn
{
    public $linkTemplate;

    protected function renderDataCellContent($model, $key, $index)
    {
        $attribute = $this->attribute;
        $link = ['update', 'id' => $model->id];
        if (is_callable($this->linkTemplate)) {
            $link = $this->linkTemplate($model, $key, $index);
        }

        return Html::a($model->$attribute, Url::toRoute($link));
    }
}
