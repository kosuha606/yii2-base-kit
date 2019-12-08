<?php

namespace kosuha606\Yii2BaseKit\Widgets\AddelWidget;

use yii\base\Widget;

/**
 * Widget for jquery.addel plugin
 *
 * TODO move resources/addel.js to BaseKit assets
 * @package kosuha606\Yii2BaseKit\Widgets\AddelWidget
 */
class AddelWidget extends Widget
{
    /**
     * @var string
     */
    public $formId;

    /**
     * @var string
     */
    public $formTemplate;

    /**
     * @var array
     */
    public $items;

    public function init()
    {
        AddelWidgetAsset::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'formId' => $this->formId,
            'formTemplate' => $this->formTemplate,
            'items' => $this->items,
        ]);
    }
}