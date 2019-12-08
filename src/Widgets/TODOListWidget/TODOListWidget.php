<?php

namespace kosuha606\Yii2BaseKit\Widgets\TODOListWidget;

use yii\base\Widget;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\TODOListWidget
 */
class TODOListWidget extends Widget
{
    /**
     * @var array
     */
    public $items;

    /**
     * @var string
     */
    public $title = 'Не задано';

    /**
     * @var 
     */
    public $values;

    public $model;

    public $name;

    public $form;

    public $addButton = true;

    /**
     * HTML формы, которая будет
     * открываться в попапе по нажитии
     * кнопки довабить
     */
    public $formHTML;

    public function init()
    {
        TODOListWidgetAsset::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'id' => $this->getId(),
            'title' => $this->title,
            'items' => $this->items,
            'model' => $this->model,
            'name' => $this->name,
            'form' => $this->form,
            'formHTML' => $this->formHTML,
            'values' => $this->values,
            'addButton' => $this->addButton,
        ]);
    }
}
