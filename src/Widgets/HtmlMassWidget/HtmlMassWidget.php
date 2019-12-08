<?php

namespace kosuha606\Yii2BaseKit\Widgets\HtmlMassWidget;

use yii\base\Widget;
use yii\helpers\Html;

class HtmlMassWidget extends Widget
{
    public $action = 'encode';

    public function init()
    {
        parent::init();
        ob_start();
        ob_implicit_flush(false);
    }

    public function run()
    {
        $action = $this->action;
        $content = ob_get_clean();
        $content = str_replace('[?php', '<?php', $content);
        $content = str_replace('?]', '?>', $content);

        return Html::$action($content);
    }
}