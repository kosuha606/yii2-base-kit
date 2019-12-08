<?php

namespace kosuha606\Yii2BaseKit\Widgets;

use kosuha606\Yii2BaseKit\Services\ObjectHelperService\ObjectHelperService;
use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use yii\base\Widget;
use yii\helpers\Html;

class AbstractJsWidget extends Widget
{
    public $id;

    public $assets = [];

    public $useContent = false;

    public $viewFile = 'template';

    public $jsRepresentation;

    public $widgetName;

    public $instance;

    public $bufferContent;

    /** @var StaticViewService StaticViewService  */
    public $staticViewService;

    /** @var ObjectHelperService */
    public $objectHelperService;

    public function __construct(
        StaticViewService $staticViewService,
        ObjectHelperService $objectHelperService,
        array $config = []
    ) {
        $this->staticViewService = $staticViewService;
        $this->objectHelperService = $objectHelperService;
        parent::__construct($config);
    }

    public function init()
    {
        /** @var [] $config */
        $config = $this->config();
        if ($config) {
            $config = require_once $config;
            foreach ($config as $property => $value) {
                if ($this->$property) {
                    unset($config[$property]);
                }
            }
            \Yii::configure($this, $config);
        }
        $this->widgetName = $this->objectHelperService->getShortClass($this);
        $this->id = $this->getId();
        $view = $this->getView();
        foreach ($this->assets as $asset) {
            $asset::register($view);
        }
        parent::init();
        if ($this->useContent) {
            ob_start();
            ob_implicit_flush(false);
        }
    }

    public function config()
    {

    }

    public function getContent()
    {
        $content = '';
        if ($this->useContent) {
            $content = str_replace("\n", '', ob_get_clean());
        }
        $this->bufferContent = $content;

        return $content;
    }

    public function run()
    {
        $content = $this->getContent();
        if ($this->jsRepresentation) {
            $this->getView()->registerJs(
                $this->staticViewService->renderFile(
                    $this->jsRepresentation,
                    ['widget' => $this],
                    ['open' => 'x/*', 'close' => '*/']
                )
            );
        }

        return $this->render($this->viewFile, [
            'content' => $content,
            'id' => $this->getId(),
            'widget' => $this,
        ]);
    }

    public function toJson($field)
    {
        if ($field === 'widget') {
            return json_encode(get_object_vars($this));
        }
        return json_encode($this->$field);
    }

    public function field($field)
    {
        return $this->$field;
    }
}