<?php

namespace kosuha606\Yii2BaseKit\Forms;

use yii\base\Model;
use yii\data\BaseDataProvider;

/**
 * Class FilterForm
 * @package kosuha606\Yii2BaseKit\Forms
 */
class FilterForm extends Model
{
    /**
     * @var array
     */
    public $filters = [];

    /**
     * @var mixed
     */
    private $provider;

    /**
     * @var array
     */
    private $advancedData = [];

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['filters'], 'safe'],
        ];
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getValue($key)
    {
        return isset($this->filters[$key]) ? $this->filters[$key] : null;
    }

    /**
     * @param $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return BaseDataProvider|null
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return bool
     */
    public function isFiltered()
    {
        return count($this->filters) > 0;
    }

    /**
     * @return array
     */
    public function getAdvancedData(): array
    {
        return $this->advancedData;
    }

    /**
     * @param array $advancedData
     */
    public function setAdvancedData(array $advancedData)
    {
        $this->advancedData = $advancedData;
    }
}