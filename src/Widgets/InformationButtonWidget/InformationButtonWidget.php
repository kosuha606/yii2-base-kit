<?php

namespace kosuha606\Yii2BaseKit\Widgets\InformationButtonWidget;

use yii\base\Widget;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\InformationButtonWidget
 */
class InformationButtonWidget extends Widget
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string|null
     */
    public $className = null;

    public function run()
    {
        return $this->render('template', [
            'title' => $this->title,
            'content' => $this->content,
            'class' => $this->className,
            'id' => $this->getId(true),
        ]);
    }
}