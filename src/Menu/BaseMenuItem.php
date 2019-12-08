<?php

namespace kosuha606\Yii2BaseKit\Menu;

/**
 * Class BaseMenuItem
 * @package kosuha606\Yii2BaseKit\Menu
 */
class BaseMenuItem
{
    protected $name;

    protected $link;

    protected $children;

    protected $renderedChildren;

    protected $strictLinkAlignment = false;

    protected $customCompareLink = null;

    protected $activeClass = 'active';

    public static function create($name, $link = null, $children = null)
    {
        $item = new static;
        $item->setName($name);
        $item->setLink($link);
        $item->setChildren($children);

        return $item;
    }

    public function toStringTemplate()
    {
        return '<li><a href="%s">%s</a>%s</li>';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $itemTemplate = sprintf($this->toStringTemplate(), $this->link, $this->name, $this->renderedChildren);

        $relativeBaseUrl = \Yii::$app->request->getUrl();
        if (!$this->isStrictLinkAlignment()) {
            if (strpos($relativeBaseUrl, $this->getLink()) !== false) {
                $itemTemplate = str_replace('{{active}}', $this->activeClass, $itemTemplate);
            } else {
                $itemTemplate = str_replace('{{active}}', '', $itemTemplate);
            }
        } else {
            if ($relativeBaseUrl == $this->getLink()) {
                $itemTemplate = str_replace('{{active}}', $this->activeClass, $itemTemplate);
            } else {
                $itemTemplate = str_replace('{{active}}', '', $itemTemplate);
            }
        }

        return $itemTemplate;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $link
     * @return MenuItem
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return null
     */
    public function getCustomCompareLink()
    {
        return $this->customCompareLink;
    }

    /**
     * @param null $customCompareLink
     */
    public function setCustomCompareLink($customCompareLink)
    {
        $this->customCompareLink = $customCompareLink;

        return $this;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function isStrictLinkAlignment()
    {
        return $this->strictLinkAlignment;
    }

    /**
     * @param $strictLinkAlignment
     * @return $this
     */
    public function setStrictLinkAlignment($strictLinkAlignment)
    {
        $this->strictLinkAlignment = $strictLinkAlignment;

        return $this;
    }

    /**
     * @param mixed $renderedChildren
     */
    public function setRenderedChildren($renderedChildren)
    {
        $this->renderedChildren = $renderedChildren;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->customCompareLink ?: $this->link;
    }

    /**
     * @return mixed
     */
    public function getRenderedChildren()
    {
        return $this->renderedChildren;
    }
}