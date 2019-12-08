<?php

namespace kosuha606\Yii2BaseKit\Widgets\ConditionFormFieldsWidget;

use yii\base\Widget;

/**
 * @package kosuha606\Yii2BaseKit\Widgets\ConditionFormFieldsWidget
 */
class ConditionFormFieldsWidget extends Widget
{
    /**
     * here you must to provide name
     * of field on which we must to show
     * formHtml value
     *
     * @var string
     */
    public $condition;

    /**
     * here you must to define value
     * what will be used when we will
     * compare condition value
     *
     * @var string
     */
    public $conditionValue;

    /**
     * here must be html what need to
     * be shown by condition
     *
     * @var string
     */
    public $formHtml;

    /**
     * Condition can be in some
     * concrete wrapper
     *
     * @var null
     */
    public $wrapper = null;

    public function init()
    {
        ConditionFormFieldsWidgetAsset::register($this->getView());
        parent::init();
        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        $content = ob_get_clean();
        return $this->render('template', [
            'formHtml' => $this->formHtml ?: $content,
            'condition' => $this->condition,
            'conditionValue' => $this->conditionValue,
            'wrapper' => $this->wrapper,
        ]);
    }
}