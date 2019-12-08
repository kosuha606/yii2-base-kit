<?php

namespace kosuha606\Yii2BaseKit\Modificators\BaseModelModificator;

use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use yii\base\Behavior;
use yii\base\Event;

/**
 * Базовый модификатор для ActiveRecord
 * @see ActiveRecord
 */
class BaseModelModificator extends Behavior
{
    protected $modificatorErrors = [];

    protected $isApiRequest = false;

    /**
     * @return array
     */
    public function getModificatorErrors(): array
    {
        return $this->modificatorErrors;
    }

    /**
     * @param array $modificatorErrors
     */
    public function addModificatorError($message)
    {
        $this->modificatorErrors[] = $message;
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_INIT => 'handleBeforeInit',
            ActiveRecord::EVENT_AFTER_FIND => 'handleAfterFind',
            ActiveRecord::EVENT_BEFORE_SAVE => 'handleBeforeSave',
            ActiveRecord::EVENT_AFTER_SAVE => 'handleAfterSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'handleBeforeDelete',
            ActiveRecord::EVENT_AFTER_DELETE => 'handleAfterDelete',
        ];
    }

    /**
     * Меняем модель подставляя недостающие данные
     */
    public function handleAfterFind(Event $event)
    {
    }

    /**
     * Меняем модель подставляя недостающие данные
     */
    public function handleBeforeInit(Event $event)
    {
    }

    /**
     * Сохраняем связанные с моделью данные
     */
    public function handleBeforeSave(Event $event)
    {
    }

    /**
     * Сохраняем связанные с моделью данные
     */
    public function handleAfterSave(Event $event)
    {
    }

    /**
     * Проверяем есть ли возможность удалить модель
     */
    public function handleBeforeDelete(Event $event)
    {
        $this->isApiRequest = isset($event->data['type']) && $event->data['type'] === 'api';
    }

    /**
     * Здесь обычно выполняются операции по удалению связанных
     * моделей
     * @param Event $event
     */
    public function handleAfterDelete(Event $event)
    {

    }
}