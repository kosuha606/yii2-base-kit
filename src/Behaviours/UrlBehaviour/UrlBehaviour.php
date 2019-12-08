<?php

namespace kosuha606\Yii2BaseKit\Behaviours\UrlBehaviour;

use yii\base\Behavior;

/**
 * Class UrlBehaviour
 * @package kosuha606\Yii2BaseKit\Behaviours\UrlBehaviour
 */
class UrlBehaviour extends Behavior
{
    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->owner->id.'-'.$this->owner->slug;
    }

    /**
     * @param $url
     * @return array
     */
    public function getUrlParts($url)
    {
        $parts = explode('-', $url);
        $id = array_shift($parts);
        $slug = implode('-', $parts);
        return [
            'id' => $id,
            'slug' => $slug,
        ];
    }
}