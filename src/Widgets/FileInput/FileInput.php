<?php

namespace kosuha606\Yii2BaseKit\Widgets\FileInput;

use yii\base\Widget;

class FileInput extends Widget
{
    public $config = [];

    public $model;

    public $src = [];

    public $srcLabels = [];

    public function run()
    {
        $this->config['attribute'] = 'file';
        $this->config['model'] = $this->model;
        $this->config['pluginOptions'] = [];
        $src = array_filter($this->src);
        if ($src) {
            $this->config['pluginOptions']['initialPreview'] = $src;
            $this->config['pluginOptions']['initialPreviewConfig'] = $this->srcLabels;
            $this->config['pluginOptions']['initialPreviewAsData'] = true;
        }

        return \kartik\widgets\FileInput::widget($this->config);
    }
}