<?php

namespace kosuha606\Yii2BaseKit\Controllers;

use yii\web\Controller;

/**
 * Class BaseController
 * @package kosuha606\Yii2BaseKit\Controllers
 */
class BaseController extends Controller
{
    /**
     * @return ConfigurationCheckService
     */
    public function getConfigurationChecker()
    {
        return \Yii::$app->get('configurationCheckService');
    }

    /**
     * @param $view
     * @param array $params
     * @return mixed
     */
    public function render($view, $params = [])
    {
        if (isset($this->views[$view])) {
            $view = $this->views[$view];
        }
        return parent::render($view, $params);
    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public function get($serviceName)
    {
        return \Yii::$app->get($serviceName);
    }
}