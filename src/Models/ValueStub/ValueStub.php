<?php

namespace kosuha606\Yii2BaseKit\Models\ValueStub;

class ValueStub
{
    public $data = [];

    public function __get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : '';
    }

    public function __call($name, $arguments)
    {
        return '';
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function field($key)
    {
        return json_decode($this->data[$key], true);
    }

    public function saveJson($key, $array)
    {
        $this->data[$key] = json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}