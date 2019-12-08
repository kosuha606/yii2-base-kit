<?php

namespace kosuha606\Yii2BaseKit\Widgets\JsTreeWidget;

use kosuha606\Yii2BaseKit\Services\ArrayHelperService\ArrayHelperService;
use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use yii\base\Widget;

/**
 * Виджет jquery библиотеки jsTree
 * https://www.jstree.com/
 *
 * @package kosuha606\Yii2BaseKit\Widgets\JsTreeWidget
 */
class JsTreeWidget extends Widget
{
    /**
     * Адрес от которого будут браться
     * данные для построения дерева
     *
     * @var string
     */
    public $dataUrl;

    /**
     * Статические данные JSON
     *
     * @var string
     */
    public $dataJson;

    /**
     * Имя объекта с помощью которого можно управлять деревом динамически
     * Например можно вызывать TreeManager.build({}) - для построения дерева
     * или TreeManager.getSelectedNode() - Для получения выбранных узлов
     *
     * @var string
     */
    public $jsWidgetName = 'JsTreeWidget';

    /**
     * JS выражение которое будет вызывано при
     * выборе в пункта\ов в дереве
     *
     * @var string
     */
    public $jsOnSelectExpression = 'console.log("node selected");';

    /**
     * Первичные данные которые будут отправлены при
     * первом запросе к серверу за получением данных для дерева.
     * При последующих построениях дерева через TreeManager
     * передавайте эти данные в аргументе метода build
     * Пример: TreeManager.build(Ваши данные здесь)
     *
     * @var array
     */
    public $initialDataToServer = [];

    /**
     * Заголовки, использованные в виджете
     *
     * @var array
     */
    public $labels = [
        'loading' => 'Идет загрузка дерева...'
    ];

    /**
     * Дополнительные опции виджета
     *
     * @var array
     */
    public $options = [
        'multiple' => 'false',
    ];

    /**
     * Плагины jsTree
     *
     * @var array
     */
    public $plugins = [
        'search' => [
            'class' => 'form-control'
        ]
    ];

    /** @var StaticViewService */
    public $staticViewService;

    /** @var ArrayHelperService */
    public $arrayHelperService;

    public function __construct(
        ArrayHelperService $arrayHelperService,
        StaticViewService $staticViewService,
        array $config = []
    ) {
        $this->arrayHelperService = $arrayHelperService;
        $this->staticViewService = $staticViewService;
        parent::__construct($config);
    }

    public function init()
    {
        JsTreeWidgetAsset::register( $this->getView() );
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'dataUrl' => $this->dataUrl,
            'dataJson' => $this->dataJson,
            'widgetName' => $this->jsWidgetName,
            'jsOnSelectExpression' => $this->jsOnSelectExpression,
            'initialDataToServer' => $this->initialDataToServer,
            'labels' => $this->labels,
            'options' => $this->options,
            'plugins' => $this->plugins,
            'id' => $this->getId(),
            'widget' => $this,
        ]);
    }
}
