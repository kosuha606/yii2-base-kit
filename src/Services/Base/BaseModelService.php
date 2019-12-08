<?php

namespace kosuha606\Yii2BaseKit\Services\Base;

use app\services\SL;
use kosuha606\Yii2BaseKit\Behaviours\BaseModelModificator;
use kosuha606\Yii2BaseKit\Data\Pagination;
use kosuha606\Yii2BaseKit\Events\ARManipulationEvent;
use kosuha606\Yii2BaseKit\Events\QueryEvent;
use kosuha606\Yii2BaseKit\Models\ValueStub\ValueStub;
use kosuha606\Yii2BaseKit\Services\ObjectHelperService\ObjectHelperService;
use yii\base\Component;
use yii\base\Event;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Html;

class BaseModelService extends Component
{
    const EVENT_BEFORE_MODEL_SAVE = 'event.before.model.save';

    const EVENT_AFTER_QUERY_CREATE = 'event.after.query.create';

    /** @var AbstractRepository */
    protected $repository;

    /**
     * @var ActiveRecord
     */
    protected $modelClass;

    protected $useModelsRAMRepository = false;

    /**
     * Репозиторий, который хранит все запрошенные данне в памяти
     * для их последующего использвоания без обрашения к БД
     *
     * @var array
     */
    protected $modelsRAMRepository = [];

    public $objectService;

    /**
     * Поле модели, которое может быть
     * использовано для вывода моделей в
     * выпадающих списках
     *
     * @var string
     */
    protected $modelNameField = 'name';

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->objectService = ObjectHelperService::create();
    }

    public function init()
    {
        $this->on(self::EVENT_BEFORE_MODEL_SAVE, [$this, 'onBeforeModelSave']);
        parent::init();
    }

    /**
     * Фильтры для модели
     */
    public function filter(Query $query, $filterField, $filterValue)
    {
        $this->repository->filter($query, $filterField, $filterValue);
    }

    public function jsonName()
    {
        $shortName = \Yii::$app->get('objectHelperService')->getShortClass($this);

        return Html::encode(\json_encode([
            'class' => $shortName
        ]));
    }

    public function getMap($key, $valueKey, $filters = [])
    {
        $modelClass = $this->modelClass;
        $query = $modelClass::find();
        if($filters) {
            foreach ($filters as $filterField => $filterValue) {
                $this->filter($query, $filterField, $filterValue);
            }
        }
        $sql = $query->createCommand()->rawSql;
        $result = [];
        foreach ($query->all() as $item) {
            $result[$item->$key] = $item->$valueKey;
        }

        return $result;
    }

    public function getList($filters = [],Pagination &$pagination = null, $order = null)
    {
        $modelClass = $this->modelClass;
        $query = $modelClass::find();
        if($filters) {
            foreach ($filters as $filterField => $filterValue) {
                $this->filter($query, $filterField, $filterValue);
            }
        }
        $this->afterQuery($query);
        if ($pagination) {
            $pagination->totalRows = $query->count();
            $query
                ->offset($pagination->getOffset())
                ->limit($pagination->getLimit())
                ;
        }
        if ($order) {
            $query->orderBy($order);
        }

        return $query->all();
    }

    public function afterQuery(Query $query)
    {
        $event = new QueryEvent(['query' => $query]);
        $this->trigger(self::EVENT_AFTER_QUERY_CREATE, $event);
    }

    public function checkNotSet($value)
    {
        return !$value || $value === 'false';
    }

    /**
     * API метод, который отвечает за проверку того
     * возможно ли удалить сущность
     */
    public function apiCheckDelete()
    {
        $id = \Yii::$app->request->post('id');
        $model = $this->getOne($id);
        $errors = [];
        foreach ($model->getBehaviors() as $behavior) {
            if ($behavior instanceof BaseModelModificator) {
                $behavior->handleBeforeDelete((new Event(['data' => ['type' => 'api']])));
                $errors = array_merge($errors, $behavior->getModificatorErrors());
            }
        }

        return ['errors' => $errors];
    }

    public function apiHandleEntity()
    {
        $method = \Yii::$app->request->getMethod();
        $result = [];
        switch ($method) {
            case 'GET':
                if ($id = \Yii::$app->request->get('id')) {
                    $result = $this->apiGet($id);
                } else {
                    $page = \Yii::$app->request->get('page', 1);
                    $pageCount = \Yii::$app->request->get('pageCount', 10);
                    $order = \Yii::$app->request->get('order', 'id');
                    $result = $this->apiList($page, $pageCount, $order);
                }
                break;
            case 'POST':
                $result = $this->apiCreate();
                break;
            case 'PUT':
                $id = \Yii::$app->request->get('id', null);
                $result = $this->apiUpdate($id);
                break;
            case 'DELETE':
                $id = \Yii::$app->request->get('id', null);
                $result = $this->apiDelete($id);
                break;
        }

        return $result;
    }

    /**
     * API метод получения одной сущности
     */
    public function apiGet($id)
    {
        $model = $this->getOne($id);

        return [
            'status' => (bool)$model->hasAttribute('id'),
            'entity' => $model,
        ];
    }

    /**
     * API метод получения списка сущностей
     */
    public function apiList($page, $pageCount, $order)
    {
        $total = $this->countByCondition();
        $fromLimit = \Yii::$app->get('paginatorHelperService')->getFromLimit($page - 1, $pageCount, $total);
        $orderDirection = 'ASC';
        if (substr($order, 0, 1) === '-') {
            $orderDirection = 'DESC';
        }
        $order = str_replace('-', '', $order) . ' ' . $orderDirection;
        $models = $this->getAllCondition([], true, $order, $fromLimit);
        if (BaseServiceLocator::o()->arrayHelperService->getValue($_GET, 'plain', false)) {
            foreach ($models as &$model) {
                $model = array_values($model);
            }
        }

        return [
            'status' => (bool)count($models),
            'total' => (int)$total,
            'pageCount' => (int)$pageCount,
            'data' => $models,
        ];
    }

    /**
     * API метод создания новой сущности
     */
    public function apiCreate()
    {
        $modelClass = $this->modelClass;
        /** @var ActiveRecord $object */
        $object = new $modelClass;
        $shortName = \Yii::$app->get('objectHelperService')->getShortClass($object);
        $data = [
            $shortName => \Yii::$app->request->post(),
        ];
        $status = $errors = false;
        if ($object->load($data) && $object->validate()) {
            $status = true;
            $object->save();
        } else {
            $errors = $object->getErrors();
        }

        return [
            'status' => $status,
            'errors' => $errors,
            'entity' => $object,
        ];
    }

    /**
     * API метод изменения сущности
     */
    public function apiUpdate($id)
    {
        if (!\Yii::$app->request->isPut) {
            return [
                'status' => false,
            ];
        }
        /** @var ActiveRecord $object */
        $object = $this->findOne($id);
        $status = $errors = false;
        $data = $this->plainDataToARData(
            json_decode(\Yii::$app->request->getRawBody()),
            $object
        );
        if ($object) {
            if ($object->load($data) && $object->validate()) {
                $status = true;
            } else {
                $errors = $object->getErrors();
            }
        }

        return [
            'status' => $status,
            'errors' => $errors,
            'entity' => $object,
        ];
    }

    /**
     * API метод удаления сущности
     */
    public function apiDelete($id)
    {
        if (!\Yii::$app->request->isDelete) {
            return [
                'status' => false,
            ];
        }
        /** @var ActiveRecord $object */
        $object = $this->findOne($id);
        $status = $errors = false;
        if ($object->delete()) {
            $status = true;
        } else {
            $object->getErrors();
        }

        return [
            'status' => $status,
            'errors' => $errors,
        ];
    }

    /**
     * @deprecated Это была первая версия управления сущностями при их изменениях, лучше для этих целей
     * использовать ARModificators
     * @see ARModificators/
     */
    public function onBeforeModelSave(ARManipulationEvent $event)
    {
        // Реализуется потомками =)
    }

    public function plainDataToARData($data, $object)
    {
        $shortName = \Yii::$app->get('objectHelperService')->getShortClass($object);

        return [
            $shortName => $data,
        ];
    }

    /**
     * Обертка для удаления много записей
     *
     * @param array $condition
     * @return int
     */
    public function deleteAll($condition = [])
    {
        /** @var ActiveRecord $model */
        $model = $this->modelClass;
        return $model::deleteAll($condition);
    }

    /**
     * Вставляет много строк в Модель
     *
     * @param string $tableName
     * @param array $attributes
     * @param array $rows
     */
    public function insertAll($tableName, $attributes = [], $rows = [])
    {
        \Yii::$app->db->createCommand()->batchInsert($tableName, $attributes, $rows)->execute();
    }

    /**
     * Возвращает массив сущностей, готовых
     * для отображения в выпадающем списке
     *
     * @param array $exclude
     * @return array
     */
    public function findListItems($exclude = [])
    {
        /** @var ActiveRecord $model */
        $model = $this->modelClass;
        $query = $model::find();
        if ($exclude && $exclude[0] !== null) {
            $query->andWhere(['not in', 'id', $exclude]);
        }
        $groups = $query->all();
        $result = [0 => '-'];
        foreach ($groups as $group) {
            $result[$group['id']] = $group[$this->modelNameField];
        }

        return $result;
    }

    /**
     * @deprecated Плохое имя
     */
    public function getToList($exclude = [])
    {
        return $this->findListItems($exclude);
    }

    /**
     * Создать новый экземпляр модели
     *
     * @param array $data
     * @return mixed
     */
    public function newInstance($data = [])
    {
        $modelClass = $this->modelClass;
        $model = new $modelClass;
        foreach ($data as $property => $datum) {
            $model->$property = $datum;
        }

        return $model;
    }

    /**
     * Найти модель по условию или
     * создать новую пустую модель
     *
     * @param array $condition
     * @return array|null|ActiveRecord
     */
    public function findOrCreateNew($condition = [])
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        if ($model = $modelClass::find()->where($condition)->one()) {
            return $model;
        }

        return new $modelClass();
    }

    // TODO похоже на дубль предыдущего метода, нужно разобраться
    public function createIfNotExists($condition = [])
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        if ($model = $modelClass::find()->where($condition)->one()) {
            return false;
        }

        return new $modelClass();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createItem($data = [])
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        /** @var ActiveRecord $model */
        $model = \Yii::createObject($modelClass, $data);
        $model->updateAttributes($data);

        return $model;
    }

    /**
     * Получить одну сущность по ID
     *
     * @param $id
     * @return ValueStub|null|static
     */
    public function findOne($id)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $query = $modelClass::find()->where(['id' => $id])->limit(1);
        $this->afterQuery($query);
        $realModel = $query->one();
        $this->addToRepository($realModel);
        if (!$realModel) {
            return new ValueStub();
        }

        return $realModel;
    }

    /**
     * @deprecated Плохое имя
     */
    public function getOne($id)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $realModel = $modelClass::findOne($id);
        $this->addToRepository($realModel);
        if (!$realModel) {
            // TODO проверить что заглушка не ломает ничего
            return new ValueStub();
        }

        return $realModel;
    }

    /**
     * Получить один по условию
     *
     * @param array $condition
     * @return array|null|ActiveRecord
     */
    public function getOneByCondition($condition = [], $orderBy = null)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $query = $modelClass::find()->where($condition);
        if ($orderBy) {
            $query->orderBy($orderBy);
        }
        $realModel = $query->one();
        $this->addToRepository($realModel);

        return $realModel;
    }

    /**
     * Получить много сущностей
     *
     * @param bool $asArray
     * @return array|ActiveRecord[]
     */
    public function getAll($asArray = false)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $query = $modelClass::find();
        $this->afterQuery($query);
        if ($asArray) {
            $models = $query->asArray()->all();
        } else {
            $models = $query->all();
        }
        $this->addToRepository($models);

        return $models;
    }

    public function getAllCondition($condition = [], $asArray = false, $orderBy = false, $limit = false)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $query = $modelClass::find();
        if ($condition) {
            $query->where($condition);
        }
        if ($limit) {
            $query->limit($limit['limit'])->offset($limit['offset']);
        }
        if ($orderBy) {
            $query->orderBy($orderBy);
        }
        $this->afterQuery($query);
        if ($asArray) {
            $models = $query->asArray()->all();
        } else {
            $models = $query->all();
        }
        $this->addToRepository($models);

        return $models;
    }

    /**
     * Получить много сущностей по условию
     *
     * @param array $condition
     * @return static[]
     */
    public function getMany($condition = [])
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->modelClass;
        $models = $modelClass::findAll($condition);
        $this->addToRepository($models);

        return $models;
    }

    /**
     * Получить дерево родителей
     *
     * @param $startFromId
     * @return array
     */
    public function getTreeOfParents($startFromId)
    {
        $result = [];
        $items = $this->getMany(['parent_id' => $startFromId]);
        if ($items) {
            foreach ($items as $item) {
                $result[$startFromId]['children'] = $this->getTreeOfParents($item->id);
                $result[$startFromId]['item'] = $item;
            }
        }

        return $result;
    }

    /**
     * Получить аттрибут сущности,
     * если атрибута нет вернуть '-'
     * Полезно для вывода в таблицах
     *
     * @param $name
     * @param $id
     * @return mixed|string
     */
    public function findAttr($name, $id)
    {
        /** @var ActiveRecord $model */
        $model = $this->modelClass;
        $group = $model::findOne($id);

        return $group ? $group->$name : '-';
    }

    /**
     * Посчиттаь кол-во по условию
     *
     * @param $condition
     * @return mixed
     */
    public function countByCondition($condition = [])
    {
        $model = $this->modelClass;
        $query = $model::find()->andWhere($condition);
        $this->afterQuery($query);

        return $query->count();
    }

    /**
     * Построить Active провайдер по переданным
     * условиям, может быть полезно для таблиц
     *
     * $this->buildDataProviderWithConditions([
     *      [
     *          'type' => 'andWhere',
     *          'value' => ['id' => 10]
     *      ]
     * ])
     */
    public function buildDataProviderWithConditions($conditions = [])
    {
        $model = $this->modelClass;
        $query = $model::find();
        foreach ($conditions as $condition) {
            $type = $condition['type'];
            $query->$type($condition['value']);
        }
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }

    /**
     * @param array $data
     */
    public function insert($data = [])
    {
        $model = $this->modelClass;
        /** @var ActiveRecord $object */
        $object = \Yii::createObject($model);
        $object->updateAttributes($data);
        $result = $object->save();
        $errors = $object->getErrors();

        return [
            'result' => $result,
            'errors' => $errors,
        ];
    }

    public function update($data)
    {
        /** @var ActiveRecord $object */
        $object = $this->findOne($data['id']);
        $name = $this->objectService->getShortClass($object);
        $object->load([$name => $data]);
        $result = $object->save();
        $errors = $object->getErrors();

        return [
            'result' => $result,
            'errors' => $errors,
        ];
    }

    public function delete($data)
    {
        /** @var ActiveRecord $object */
        $object = $this->findOne($data['id']);
        $errors = $object->getErrors();

        return [
            'result' => $object->delete(),
            'errors' => $errors,
        ];
    }

    public function addToRepository($models)
    {
        if (!$this->useModelsRAMRepository) {
            return;
        }
        $models = is_array($models) ? $models : [$models];
        foreach ($models as $model) {
            if (is_array($model) && isset($model['id'])) {
                $this->modelsRAMRepository[$model['id']] = $model['id'];
                continue;
            }
            if ($model instanceof ActiveRecord) {
                $this->modelsRAMRepository[$model->id] = $model;
            }
        }
    }

    public function ensureAllRepositoryItemsAreObjects()
    {
        if (!$this->useModelsRAMRepository) {
            return;
        }
        $modelClass = $this->modelClass;
        $idsNotObjects = [];
        foreach ($this->modelsRAMRepository as $key => $model) {
            if (is_string($model)) {
                $idsNotObjects[] = $model;
                unset($this->modelsRAMRepository[$key]);
            }
        }
        if (count($idsNotObjects)) {
            $newObjects = $modelClass->find()->where(['id' => $idsNotObjects])->all();
            foreach ($newObjects as $newObject) {
                $this->modelsRAMRepository[$newObject->id] = $newObject;
            }
        }
    }

    public function getOneFromRepository($modelId)
    {
        $this->ensureAllRepositoryItemsAreObjects();

        return isset($this->modelsRAMRepository[$modelId]) ? $this->modelsRAMRepository[$modelId] : $this->findOne($modelId);
    }

    public function getAllFromRepository()
    {
        $this->ensureAllRepositoryItemsAreObjects();

        return $this->modelsRAMRepository ?: $this->getAll();
    }
}
