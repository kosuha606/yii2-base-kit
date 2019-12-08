<?php

namespace kosuha606\Yii2BaseKit\Controllers\BaseCRUDController;

use app\services\SL;
use kartik\grid\EditableColumnAction;
use kosuha606\Yii2BaseKit\Controllers\BaseController;
use kosuha606\Yii2BaseKit\Events\ARManipulationEvent;
use kosuha606\Yii2BaseKit\Forms\FilterForm;
use kosuha606\Yii2BaseKit\Helpers\AdminHelper;
use kosuha606\Yii2BaseKit\Services\Base\BaseModelService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Response;

/**
 * Class BaseCRUDController
 * @package kosuha606\Yii2BaseKit\Controllers\BaseCRUDController
 */
class BaseCRUDController extends BaseController
{
    const EVENT_BEFORE_CHANGE_ENTITY = 'event.before.change.entity';

    const EVENT_AFTER_CHANGE_ENTITY = 'event.after.change.entity';

    const EVENT_ON_CHANGE_ENTITY = 'event.on.change.entity';

    const EVENT_AFTER_DELETE_ENTITY = 'event.after.delete.entity';

    const EVENT_AFTER_CHANGE_AND_MESSAGE_SENT = 'event.after.change.and.message.sent';

    const EVENT_AFTER_BREADCRUMBS_SET = 'event.after.breadcrumbs.set';

    const EVENT_AFTER_UPDATE_MODEL_INIT = 'event.after.update.model.init';

    const EVENT_AFTER_CREATE_MODEL_INIT = 'event.after.create.model.init';

    const EVENT_AFTER_INDEX_QUERY_CREATED = 'event.after.index.query.created';

    const EVENT_AFTER_INDEX_PROVIDER_CREATED = 'event.after.index.provider.created';

    const EVENT_ON_GET_STATE = 'event.on.get.state';

    /**
     * @var bool
     */
    public $enableCsrfValidation = false;

    /**
     * @var array
     */
    protected $state = [];

    /** @var  ActiveRecord */
    protected $model;

    /** @var  BaseModelService */
    protected $modelService;

    /** @var int Items per page */
    protected $ipp = 10;

    /**
     * @var array
     */
    public $params = [
        'breadcrumbs' => []
    ];

    /**
     * @param $key
     * @param $value
     */
    public function addStateIfNotExists($key, $value)
    {
        if (!isset($this->state[$key])) {
            $this->state[$key] = $value;
        }
    }

    /**
     * @return array
     */
    public function getState()
    {
        $this->trigger(self::EVENT_ON_GET_STATE);

        return $this->state;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getStateItem($key)
    {
        return isset($this->state[$key]) ? $this->state[$key] : null;
    }

    /**
     * @var array
     */
    public $availableGroups = ['admin'];

    /**
     * @var array
     */
    public $views = [
        'create' => 'create',
        'update' => 'create',
        'index' => 'index'
    ];

    /**
     * @param FilterForm $filterForm
     * @return FilterForm
     */
    protected function onFilter(FilterForm $filterForm)
    {
        return $filterForm;
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $modelClass = $this->model;
        $filters = array_merge(
            Yii::$app->request->get('FilterForm', []),
            Yii::$app->request->post('Fil   terForm', [])
        );
        $filterForm = new FilterForm($filters);
        $this->params['breadcrumbs'][] = ['label' => $modelClass::name()];
        $this->trigger(
            self::EVENT_AFTER_BREADCRUMBS_SET,
            (new ARManipulationEvent(['entity' => null]))
        );
        $ipp = Yii::$app->request->get('ipp', $this->ipp);
        $filterForm = $this->onFilter($filterForm);
        $query = $modelClass::search($filterForm->filters);
        $this->trigger(
            self::EVENT_AFTER_INDEX_QUERY_CREATED,
            (new ARManipulationEvent(['entity' => &$query]))
        );
        $order = ['id' => SORT_ASC];
        if ($query->orderBy) {
            $order = $query->orderBy;
        }
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $ipp,
            ],
            'sort' => [
                'defaultOrder' => $order,
            ],
        ]);
        $this->trigger(
            self::EVENT_AFTER_INDEX_PROVIDER_CREATED,
            (new ARManipulationEvent(['entity' => &$provider]))
        );
        $filterForm->setProvider($provider);
        $this->addStateIfNotExists('provider', $provider);
        $this->addStateIfNotExists('modelClass', $modelClass);
        $this->addStateIfNotExists('filterForm', $filterForm);
        $this->addStateIfNotExists('context', $this);
        return $this->render($this->views['index'], $this->getState());
    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $modelClass = $this->model;
        /** @var ActiveRecord $model */
        $model = new $modelClass();
        $this->trigger(self::EVENT_ON_CHANGE_ENTITY, (new ARManipulationEvent(['entity' => &$model])));
        $this->trigger(
            self::EVENT_AFTER_CREATE_MODEL_INIT,
            (new ARManipulationEvent(['entity' => &$model]))
        );
        $this->params['breadcrumbs'][] = ['label' => $modelClass::name(), 'url' => Url::toRoute(['index'])];
        $this->params['breadcrumbs'][] = ['label' => $model->getMenuName()];
        $this->trigger(
            self::EVENT_AFTER_BREADCRUMBS_SET,
            (new ARManipulationEvent(['entity' => $model]))
        );
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->trigger(
                self::EVENT_BEFORE_CHANGE_ENTITY,
                (new ARManipulationEvent(['entity' => $model]))
            );
            $this->triggerModelServiceBeforeSave($model);
            $model->save();
            $this->trigger(
                self::EVENT_AFTER_CHANGE_ENTITY,
                (new ARManipulationEvent(['entity' => $model]))
            );
            $modelName = ' ';
            if ($model instanceof \kosuha606\Yii2BaseKit\Models\ActiveRecord) {
                $modelName .= $model::name();
            }
            Yii::$app->session->setFlash('success', 'Успешно создано'.$modelName);
            $this->trigger(
                self::EVENT_AFTER_CHANGE_AND_MESSAGE_SENT,
                (new ARManipulationEvent(['entity' => $model, 'advanced' => 'create']))
            );
            return $this->redirect('index');
        }
        $this->addStateIfNotExists('model', $model);
        return $this->render($this->views['create'], $this->getState());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelClass = $this->model;
        $model = $modelClass::findOne($id);
        $this->trigger(self::EVENT_ON_CHANGE_ENTITY, (new ARManipulationEvent(['entity' => &$model])));
        if (!$model) {
            throw new \LogicException('Entity not found!');
        }
        $this->trigger(
            self::EVENT_AFTER_UPDATE_MODEL_INIT,
            (new ARManipulationEvent(['entity' => &$model]))
        );
        $this->params['breadcrumbs'][] = ['label' => $modelClass::name(), 'url' => Url::toRoute(['index'])];
        $this->params['breadcrumbs'][] = ['label' => $model->getMenuName()];
        $this->trigger(
            self::EVENT_AFTER_BREADCRUMBS_SET,
            (new ARManipulationEvent(['entity' => $model]))
        );
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->trigger(
                self::EVENT_BEFORE_CHANGE_ENTITY,
                (new ARManipulationEvent(['entity' => $model]))
            );
            $this->triggerModelServiceBeforeSave($model);
            $model->save();
            $this->trigger(
                self::EVENT_AFTER_CHANGE_ENTITY,
                (new ARManipulationEvent(['entity' => $model]))
            );
            $modelName = ' ';
            if ($model instanceof \kosuha606\Yii2BaseKit\Models\ActiveRecord) {
                $modelName .= $model::name();
            }
            Yii::$app->session->setFlash('success', 'Успешно обновлено'.$modelName);
            if (isset($_POST['apply']) && $_POST['apply'] === '1') {
                $this->trigger(
                    self::EVENT_AFTER_CHANGE_AND_MESSAGE_SENT,
                    (new ARManipulationEvent(['entity' => $model]))
                );
                return $this->refresh();
            }
            $this->trigger(
                self::EVENT_AFTER_CHANGE_AND_MESSAGE_SENT,
                (new ARManipulationEvent(['entity' => $model]))
            );
            return $this->refresh();
        }
        $this->addStateIfNotExists('model', $model);
        return $this->render($this->views['update'], $this->getState());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $modelClass = $this->model;
        /** @var ActiveRecord $model */
        $model = $modelClass::findOne($id);
        if ($model instanceof SoftDeletableAR) {
            if ($model->isDeleted) {
                Yii::$app->session->setFlash('success', 'Успешно удалено');
            } else {
                if ($model->softDelete()) {
                    Yii::$app->session->setFlash('success', 'Успешно удалено');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка удаления');
                }
            }
        } else {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', 'Успешно удалено');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка удаления');
            }
        }
        $this->trigger(
            self::EVENT_AFTER_DELETE_ENTITY,
            (new ARManipulationEvent(['entity' => $model]))
        );
        return $this->redirect('index');
    }

    /**
     * Массовое удаление
     */
    public function actionBatchRemove()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->model;
        $ids = Yii::$app->request->post('ids');
        $models = $modelClass::findAll(['id' => $ids]);
        $deletedCount = 0;
        foreach ($models as $model) {
            if ($model instanceof SoftDeletableAR) {
                $model->softDelete();
                $deletedCount++;
            }
        }
        return ['result' => $deletedCount];
    }

    /**
     * Массовая активация
     */
    public function actionBatchActive()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->model;
        $ids = Yii::$app->request->post('ids');
        $models = $modelClass::findAll(['id' => $ids]);
        foreach ($models as $model) {
            $model->is_active = !$model->is_active;
            $model->save();
        }
        return count($models);
    }

    /**
     * @param $id
     * @return ActiveRecord
     */
    private function getModel($id)
    {
        /** @var ActiveRecord $modelClass */
        $modelClass = $this->model;
        $model = $modelClass::findOne($id);
        return $model;
    }

    /**
     * Информируем сервис модели о том, что
     * модель скоро сохранится
     *
     * @param $model
     * @throws \yii\base\InvalidConfigException
     */
    protected function triggerModelServiceBeforeSave($model)
    {
        if (!$this->modelService) {
            return;
        }
        $serviceName = AdminHelper::serviceClassToServiceName($this->modelService);
        Yii::$app->get($serviceName)->trigger(
            BaseModelService::EVENT_BEFORE_MODEL_SAVE,
            (new ARManipulationEvent(['entity' => $model]))
        );
    }
}