<?php

namespace kosuha606\Yii2BaseKit\Widgets\InlineViewWidget;

use yii\base\Widget;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\InlineViewWidget
 */
class InlineViewWidget extends Widget
{
    /**
     * @var int
     */
    public $fixedCol = 0;

    /**
     * @var array
     */
    public $data = [];

    public function run()
    {
        return $this->render('template', [
            'data' => $this->data,
            'fixedCol' => $this->fixedCol,
        ]);
    }
}