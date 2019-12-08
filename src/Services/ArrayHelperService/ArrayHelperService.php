<?php

namespace kosuha606\Yii2BaseKit\Services\ArrayHelperService;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class ArrayHelperService
{
    /**
     * Sorts array by provided field
     *
     * @param $array
     * @param $field
     * @param $sort
     */
    public function arraySort(&$array, $field, $sort)
    {
        $sort = $sort == SORT_ASC ? 1 : -1;
        uasort($array, function ($a, $b) use ($field, $sort) {
            return $a[$field] > $b[$field] ? $sort : -1 * $sort;
        });
    }

    /**
     * Rotates array by 90 deg
     *
     * @param $mat
     * @return array
     */
    public function rotate90($mat)
    {
        $height = count($mat);
        $width = count($mat[0]);
        $mat90 = [];
        for ($i = 0; $i < $width; $i++) {
            for ($j = 0; $j < $height; $j++) {
                $mat90[$height - $i - 1][$j] = $mat[$height - $j - 1][$i];
            }
        }

        return $mat90;
    }

    /**
     * Encode array to json with needed options
     *
     * @param $data
     * @return string
     */
    public function toJson($data)
    {
        return json_encode($data ?: [], JSON_UNESCAPED_UNICODE);
    }

    public function fromJson($data)
    {
        return json_decode($data, true);
    }

    /**
     * Search of array item in array
     * with needed value in specified column
     *
     * @param $array
     * @param $column
     * @param $value
     * @return null
     */
    public function arraySearch($array, $column, $value)
    {
        foreach ($array as $key => $item) {
            if ($item[$column] == $value) {
                $item['array_search_key'] = $key;
                return $item;
            }
        }

        return null;
    }

    public function merge($one, $two)
    {
        return ArrayHelper::merge($one, $two);
    }

    public function arraySearchAll($array, $column, $value)
    {
        $result = [];
        foreach ($array as $key => $item) {
            if ($item[$column] == $value) {
                $item['array_search_key'] = $key;
                $result[] = $item;
            }
        }

        return $result;
    }

    public function arrayColumn($array, $column)
    {
        return array_column($array, $column);
    }

    /**
     * Just return value of key, and
     * set default value if there is no key.
     *
     * @param $array
     * @param $key
     * @param null $default
     * @return null
     */
    public function getValue($array, $key, $default = null)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}