<?php

namespace kosuha606\Yii2BaseKit\Widgets\OutFormSubmitButtons;

use kosuha606\Yii2BaseKit\Services\Base\BaseServiceLocator;
use kosuha606\Yii2BaseKit\Services\ConfigurationCheckService\ConfigurationCheckService;
use yii\base\Widget;
use yii\web\View;

/**
 * Class OutFormSubmitButtons
 * @package kosuha606\Yii2BaseKit\Widgets\OutFormSubmitButtons
 */
class OutFormSubmitButtons extends Widget
{
    /**
     * 'buttons' => type, name, label, class
     * 'form_id' - Id of active form what need to be submit
     * 'action_field' - Field in what will be filled by submited button
     */
    public $options = [];

    /** @var ConfigurationCheckService */
    public $configurationCheckService;

    public function __construct(
        ConfigurationCheckService $configurationCheckService,
        array $config = []
    ) {
        $this->configurationCheckService = $configurationCheckService;
        parent::__construct($config);
    }

    public function init()
    {
        $this->configurationCheckService->checkOptions($this->options['buttons'], ['type', 'name', 'label', 'class']);
        $this->configurationCheckService->checkValue($this->options, 'form_id');
        $this->configurationCheckService->checkValue($this->options, 'action_field');
        OutFormSubmitButtonsAsset::register( $this->getView() );
        parent::init();
    }

    public function registerAssets(View &$view)
    {
        $formId = $this->options['form_id'];
        $actionField = $this->options['action_field'];
        $js = '';
        foreach ($this->options['buttons'] as $key => $button) {
            if ($button['type'] !== 'button') {
                continue;
            }
            $this->options['buttons'][$key]['id'] = 'outform-button-'.$key;
            $buttonOptionsJson = json_encode($this->options['buttons'][$key]);
            $js .= "new OutFormSubmitButton('{$formId}', '{$actionField}', {$buttonOptionsJson});";
        }
        $view->registerJs($js, $view::POS_LOAD);
    }

    public function run()
    {
        $view = $this->getView();
        $this->registerAssets($view);

        return $this->render('template', [
            'options' => $this->options,
        ]);
    }
}