<?php

namespace kosuha606\Yii2BaseKit\Services\ConfigurationCheckService;

/**
 * Class ConfigurationCheckService
 * @package kosuha606\Yii2BaseKit\Services\ConfigurationCheckService
 */
class ConfigurationCheckService
{
    /**
     * Check set of options in configuration array
     *
     * @param $optionDataIterator
     * @param $arrayOfNeededKeys
     */
    public function checkOptions($optionDataIterator, $arrayOfNeededKeys)
    {
        foreach ($optionDataIterator as $optionData) {
            $keys = array_keys($optionData);
            foreach ($arrayOfNeededKeys as $neededKey) {
                if (!in_array($neededKey, $keys)) {
                    throw new \LogicException('You must specify key '.$neededKey);
                }
            }
        }
    }

    /**
     * Check one option in configurartoin array
     *
     * @param $optionDataIterator
     * @param $neededKey
     */
    public function checkValue($optionDataIterator, $neededKey)
    {
        $keys = array_keys($optionDataIterator);
        if (!in_array($neededKey, $keys)) {
            throw new \LogicException('You must specify key '.$neededKey);
        }
    }

    /**
     * @param $optionDataIterator
     * @param $neededKey
     */
    public function valueNotEmpty($optionDataIterator, $neededKey)
    {
        $this->checkValue($optionDataIterator, $neededKey);
        if (empty($optionDataIterator[$neededKey])) {
            throw new \LogicException('Value must not be empty!');
        }
    }

    /**
     * @param $className
     */
    public function classExists($className)
    {
        if (!class_exists($className)) {
            throw new \LogicException('Class does not exists');
        }
    }

    /**
     * @param $className
     * @param $neededInstance
     */
    public function classInstanceOf($className, $neededInstance)
    {
        $testObj = new $className;
        $this->classExists($neededInstance);
        if (!$testObj instanceof $neededInstance) {
            throw new \LogicException("Class $className is not instance of $neededInstance");
        }
    }
}