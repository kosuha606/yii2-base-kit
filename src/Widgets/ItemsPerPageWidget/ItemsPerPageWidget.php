<?php

namespace kosuha606\Yii2BaseKit\Widgets\ItemsPerPageWidget;

use kartik\widgets\Select2;
use yii\base\Widget;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\ItemsPerPageWidget
 */
class ItemsPerPageWidget extends Widget
{
    public $items = [5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100];

    public function run()
    {
        $ipp = \Yii::$app->request->get('ipp', 0);
        return '<form class="ipp-form" method="get" action="">Показывать по: ' .
            Select2::widget([
                'name' => 'ipp',
                'value' => $ipp,
                'data' => $this->items,
                'options' => [
                    'multiple' => false,
                    'data-todo' => 'value',
                    'class' => 'select2-inblock',
                    'width' => 'auto',
                    'onchange' => 'this.form.submit()',
                    'placeholder' => '10'
                ]
            ]) .
            '</form>';
    }
}