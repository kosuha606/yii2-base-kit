<?php

namespace kosuha606\Yii2BaseKit\Widgets\ColumnButtonWidget;

use yii\base\Widget;
use yii\widgets\ActiveForm;

/**
 * This is the widget with modal window. After select
 * value in modal window we can see changed button
 *
 * @package kosuha606\Yii2BaseKit\Widgets\ColumnButtonWidget
 */
class ColumnButtonWidget extends Widget
{
    /**
     * @var array
     */
    public $options;

    /**
     * @var ActiveForm
     */
    public $form;

    /**
     * @var string
     */
    public $value;

    public function init()
    {
        ColumnButtonWidgetAsset::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        $id = $this->getId();
        $label = '';
        $modalTitle = '';
        if ($this->options['label']) {
            $label = $this->options['label'];
        }
        if ($this->options['modalTitle']) {
            $modalTitle = $this->options['modalTitle'];
        }
        $jsCallback = '';
        if ($this->options['jsCallback']) {
            $jsCallback = $this->options['jsCallback'];
        }

        return $this->render('template', [
            'formHtml' => $this->form,
            'id' => $id,
            'label' => $label,
            'modalTitle' => $modalTitle,
            'jsCallback' => $jsCallback,
        ]);
    }
}