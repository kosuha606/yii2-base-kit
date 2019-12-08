<?php

namespace kosuha606\Yii2BaseKit\Menu;

class BaseMenuPrinter
{
    public $items = [];

    public $mainWrapTag = [
        'open' => '<ul>',
        'close' => '</ul>',
    ];

    public $subMenuWrapTag = [
        'open' => '<ul>',
        'close' => '</ul>',
    ];

    public $menuType = 'main';

    private function __construct()
    {
    }

    public static function create()
    {
        return new static();
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function printMenu()
    {
        $result = $this->mainWrapTag['open'];

        $items = $this->items;
        foreach ($items as $item) {
            $result .= $this->printItem($item);
        }

        return $result.$this->mainWrapTag['close'];
    }

    protected function printItem(BaseMenuItem $item) {
        $children = '';
        if ($item->hasChildren()) {
            $children .= $this->subMenuWrapTag['open'];
            foreach ($item->getChildren() as $child) {
                $children .= $this->printItem($child);
            }
            $children .= $this->subMenuWrapTag['close'];
        }
        $item->setRenderedChildren($children);
        $result = $item->__toString();

        return $result;
    }
}