<?php

namespace kosuha606\Yii2BaseKit\Widgets\JsChartWidget;

use kosuha606\Yii2BaseKit\Services\ArrayHelperService\ArrayHelperService;
use kosuha606\Yii2BaseKit\Services\ColorHelperService\ColorHelperService;
use kosuha606\Yii2BaseKit\Services\StaticViewService\StaticViewService;
use yii\base\Widget;

class JsChartWidget extends Widget
{
    public $height = '500px';

    public $width = '500px';

    public $type = 'bar';

    public $label = 'Заголовок';

    public $borderWidth = '1';

    public $data = [
        'one' => [
            'value' => 12,
        ]
    ];

    /** @var ColorHelperService  */
    public $colorHelperService;

    /** @var ArrayHelperService  */
    public $arrayHelperService;

    /** @var StaticViewService  */
    public $staticViewService;

    public function __construct(
        ColorHelperService $colorHelperService,
        ArrayHelperService $arrayHelperService,
        StaticViewService $staticViewService,
        array $config = []
    ) {
        $this->colorHelperService = $colorHelperService;
        $this->arrayHelperService = $arrayHelperService;
        $this->staticViewService = $staticViewService;
        parent::__construct($config);
    }

    public function init()
    {
        JsChartWidgetAsset::register($this->getView());
        parent::init();
    }

    public function run()
    {
        return $this->render('template', [
            'id' => $this->getId(),
            'height' => $this->height,
            'width' => $this->width,
            'data' => $this->data,
            'type' => $this->type,
            'label' => $this->label,
            'borderWidth' => $this->borderWidth,
            'widget' => $this,
        ]);
    }
}