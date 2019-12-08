<?php

namespace kosuha606\Yii2BaseKit\Services\StaticViewService;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class StaticViewService
{
    const SCENARIO_ALL_DATA_IN_PARAMS = 'all_data_params';

    const SCENARIO_ONLY_OBJECTS_IN_PARAMS = 'objects_params';

    public $expressionLanguage;

    public $scenario = self::SCENARIO_ALL_DATA_IN_PARAMS;

    public function setScenario($scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * Рендерит JS файлы заменяя переменные $something$
     * на переменные из $params
     *
     * @param \yii\base\View $view
     * @param $fileName
     * @param $params
     * @return mixed
     */
    public function render(\yii\base\View $view, $fileName, $params)
    {
        $content = $view->render($fileName);

        return $this->renderLogic($content, $params);
    }

    public function renderFile($fileName, $params, $wrapper = '$')
    {
        $content = file_get_contents($fileName);

        return $this->renderLogic($content, $params, $wrapper);
    }

    public function renderContent($content, $params, $wrapper = '$')
    {
        return $this->renderLogic($content, $params, $wrapper);
    }

    private function renderLogic($content, $params, $wrapper = '$')
    {
        $this->expressionLanguage = new ExpressionLanguage();

        $paramKeys = $paramValues = [];
        $openWrapper = $closeWrapper = $wrapper;
        /**
         * Враппером может быть массив с ключами
         * open и close соотвтственно для открывающего
         * и закрывающего набора символов
         * например open - {{; close - }}
         */
        if (is_array($wrapper)) {
            if(!empty($wrapper['open'])) {
                $openWrapper = $wrapper['open'];
            }
            if (!empty($wrapper['close'])) {
                $closeWrapper = $wrapper['close'];
            }
        }

        $matches = [];
        $open = preg_quote($openWrapper);
        $openLen = strlen($openWrapper);
        $close = preg_quote($closeWrapper);
        $closeLen = strlen($closeWrapper);
        preg_match_all('#'.$open.'[^'.$open.$close.']+'.$close.'#m', $content, $matches);

        switch ($this->scenario) {
            case self::SCENARIO_ONLY_OBJECTS_IN_PARAMS:
                array_map(function($item) {
                    return json_decode(json_encode($item));
                }, $params);
                $params = json_decode(json_encode($params));
                $params = get_object_vars($params);
                break;
        }

        if (isset($matches[0])) {
            foreach ($matches[0] as $match) {
                $paramKeys[] = $match;
                $value = substr(substr($match, $openLen), 0, -$closeLen);
                $paramValues[] = $this->expressionLanguage->evaluate($value, $params);
            }
        }

        return str_replace($paramKeys, $paramValues, $content);
    }
}