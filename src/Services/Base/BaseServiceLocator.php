<?php

namespace kosuha606\Yii2BaseKit\Services\Base;

use kosuha606\Yii2BaseKit\Services\ArHelperService\ArHelperService;
use kosuha606\Yii2BaseKit\Services\ArrayHelperService\ArrayHelperService;
use kosuha606\Yii2BaseKit\Services\Base\ServiceLocator\ServiceLocatorGetMagic;
use kosuha606\Yii2BaseKit\Services\ColorHelperService\ColorHelperService;
use kosuha606\Yii2BaseKit\Services\ConfigurationCheckService\ConfigurationCheckService;
use kosuha606\Yii2BaseKit\Services\ObjectHelperService\ObjectHelperService;
use kosuha606\Yii2BaseKit\Services\PaginatorHelperService\PaginatorHelperService;
use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use kosuha606\Yii2BaseKit\Services\TreeService\TreeService;
use Yii;

/**
 * @see SLBootstarper
 */
class BaseServiceLocator extends ServiceLocatorGetMagic
{
    /** @var ObjectHelperService */
    public $objectHelperService = ObjectHelperService::class;

    /** @var ArrayHelperService */
    public $arrayHelperService = ArrayHelperService::class;

    /** @var PaginatorHelperService */
    public $paginatorHelperService = PaginatorHelperService::class;

    /** @var ConfigurationCheckService */
    public $configurationCheckService = ConfigurationCheckService::class;

    /** @var StaticViewService */
    public $staticViewService = StaticViewService::class;

    /** @var TreeService */
    public $treeService = TreeService::class;

    /** @var ColorHelperService */
    public $colorHelperService = ColorHelperService::class;

    /** @var ArHelperService */
    public $arHelperService = ArHelperService::class;

    /**
     * Place all registerd compoentns to
     * Yii2 container
     *
     * @see SLBootstarper
     */
    public static function loadSLComponents()
    {
        $properties = get_class_vars(static::class);
        unset($properties['instance']);

        $compoentns = Yii::$app->getComponents();
        Yii::$app->setComponents(array_merge($compoentns, $properties));
    }
}