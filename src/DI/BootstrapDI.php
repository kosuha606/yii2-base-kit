<?php

namespace kosuha606\Yii2BaseKit\DI;

use yii\base\Component;

/**
 * Class BootstrapDI
 * @package kosuha606\Yii2BaseKit\DI
 */
class BootstrapDI extends Component
{
    /**
     *
     */
    public function init()
    {
        parent::init();
        $config = require_once __DIR__ . '/di_singletons_configuration.php';
        \Yii::$container->setSingletons($config);
    }
}