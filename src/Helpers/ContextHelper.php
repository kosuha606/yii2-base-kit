<?php

namespace kosuha606\Yii2BaseKit\Helpers;

use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;

/**
 * Class ContextHelper
 * @package kosuha606\Yii2BaseKit\Helpers
 */
class ContextHelper
{
    /**
     * Получить массив контроллеров из корневой директории
     *
     * @param $dir
     * @param $alias
     * @return array
     */
    public static function controllerMapFromDir($dir, $alias)
    {
        $items = array_filter(FileHelper::findFiles($dir), function($item) {
            return strpos($item, 'Controller.php') !== false;
        });
        $controllers = [];
        foreach ($items as &$item) {
            $item = str_replace([$dir, '/', '.php'], [$alias, '\\', ''], $item);
            $controllerName = explode('\\', $item);
            $controllerName = array_pop($controllerName);
            $controllerId = str_replace('Controller', '', $controllerName);
            $controllerId = Inflector::camel2id($controllerId);
            $controllers[$controllerId] = $item;
        }
        return $controllers;
    }

    /**
     * Получить массив компонентов из конфигурационных файлов директории
     *
     * @param $dir
     * @return array
     */
    public static function componentsMapFromDir($dir)
    {
        $items = array_filter(FileHelper::findFiles($dir), function($item) {
            return strpos($item, 'config.php') !== false;
        });
        $components = [];
        foreach ($items as $item) {
            $contextConfig = require_once($item);
            $components = ArrayHelper::merge($components, $contextConfig['components']);
        }
        return $components;
    }

    /**
     * Выполнить слияние конфига со всеми конфигами, найденными в директории
     *
     * @param $dir
     */
    public static function mergeConfigsFromDir($dir, &$mainConfig, $exclude = [])
    {
        $items = array_filter(FileHelper::findFiles($dir), function($item) {
            return strpos($item, 'config.php') !== false;
        });
        foreach ($items as $item) {
            $contextConfig = require($item);
            foreach ($contextConfig as $key => $params) {
                if ($key === 'commands') {
                    continue;
                }
                if (in_array($key, $exclude)) {
                    continue;
                }
                if (!isset($mainConfig[$key])) {
                    $mainConfig[$key] = [];
                }
                $mainConfig[$key] = ArrayHelper::merge($mainConfig[$key], $params);
            }
        }
    }

    /**
     * @param $dir
     * @param $mainConfig
     */
    public static function mergeCommandsFromDir($dir, &$mainConfig)
    {
        $items = array_filter(FileHelper::findFiles($dir), function($item) {
            return strpos($item, 'config.php') !== false;
        });
        $key = 'controllerMap';
        foreach ($items as $item) {
            $contextConfig = require($item);
            foreach ($contextConfig as $paramsKey => $params) {
                if (!isset($mainConfig[$key])) {
                    $mainConfig[$key] = [];
                }
                if ($paramsKey === 'commands') {
                    $mainConfig[$key] = ArrayHelper::merge($mainConfig[$key], $params);
                }
            }
        }
    }
}