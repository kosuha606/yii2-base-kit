<?php

namespace kosuha606\Yii2BaseKit\Widgets\LinkSelectValueWidget;

use yii\base\Widget;

/**
 * This is widget what render link. after click on link
 * you can see popup with provided form, after change form
 * data will be sent to labelSyncPoint and link text will
 * be changed.
 *
 * @package kosuha606\Yii2BaseKit\Widgets\LinkSelectValueWidget
 */
class LinkSelectValueWidget extends Widget
{
    /**
     * @var string
     */
    public $formTemplate;

    /**
     * @var string
     */
    public $formTemplateData = [];

    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $index;

    /**
     * @var string
     */
    public $saveTo;

    /**
     * @var string
     */
    public $saveToRelations;

    /**
     * @var string
     */
    public $attribute;

    public $labelSyncPoint;

    public function init()
    {
        LinkSelectValueWidgetAsset::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'value' => $this->value,
            'formTemplate' => $this->formTemplate,
            'formTemplateData' => $this->formTemplateData,
            'labelSyncPoint' => $this->labelSyncPoint,
            'model' => $this->model,
            'index' => $this->index,
            'saveTo' => $this->saveTo,
            'saveToRelations' => $this->saveToRelations,
            'attribute' => $this->attribute,
        ]);
    }
}