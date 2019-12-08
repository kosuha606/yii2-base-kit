<?php

namespace kosuha606\Yii2BaseKit\Services\ObjectHelperService;

use ReflectionClass;

/**
 * Class ObjectHelperService
 * @package kosuha606\Yii2BaseKit\Services\ObjectHelperService
 */
class ObjectHelperService
{
    /**
     * @return ObjectHelperService
     */
    public static function create()
    {
        return new ObjectHelperService();
    }

    /**
     * Return class short name
     *
     * @param $object
     * @return string
     * @throws \ReflectionException
     */
    public function getShortClass($object)
    {
        return (new ReflectionClass($object))->getShortName();
    }

    /**
     * Sorts list of objects by provided property
     *
     * @param $array
     * @param $property
     * @param $sort
     */
    public function objectsSort(&$array, $property, $sort)
    {
        $sort = $sort == SORT_ASC ? 1 : -1;
        uasort($array, function ($a, $b) use ($property, $sort) {
            return $a->{$property} > $b->{$property} ? $sort : -1 * $sort;
        });
    }

    /**
     * It is like array_column for arrays but
     * it is for array of objects. Return
     * array of values specified in $object->$column
     *
     * @param $array
     * @param $column
     * @return array
     */
    public function arrayObjectColumn($array, $column)
    {
        $result = [];
        foreach ($array as $item) {
            $result[] = $item->$column;
        }

        return $result;
    }

    /**
     * Search of object with needed column value in array
     *
     * @param $array
     * @param $column
     * @param $value
     * @return null
     */
    public function arrayObjectSearch($array, $column, $value)
    {
        foreach ($array as $item) {
            if ($item->$column == $value) {
                return $item;
            }
        }

        return null;
    }

    /**
     * @param $object
     * @param string $condition
     * @param $attr
     * @param $value
     * @param null $conditionValue
     */
    public function setValueByCondition(&$object, $condition = '=', $attr, $value, $conditionValue = null)
    {
        $conditionComplete = false;
        switch ($condition) {
            case '=':
                $conditionComplete = $object->$attr == $conditionValue;
                break;
            case '!=':
                $conditionComplete = $object->$attr != $conditionValue;
                break;
            case 'empty':
                $conditionComplete = empty($object->$attr);
                break;
        }
        if ($conditionComplete) {
            $object->$attr = $value;
        }
    }
}