<?php

namespace kosuha606\Yii2BaseKit\Widgets\EntityButtonWidget;

use yii\base\Widget;

class EntityButtonWidget extends Widget
{
    public $labels = [
        'new' => 'Создать',
        'update' => 'Обновить',
    ];

    public $isNew = false;

    public function run()
    {
        return $this->render('../template', [
            'labels' => $this->labels,
            'isNew' => $this->isNew,
        ]);
    }
}