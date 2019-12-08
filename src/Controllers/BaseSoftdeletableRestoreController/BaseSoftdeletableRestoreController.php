<?php

namespace kosuha606\Yii2BaseKit\Controllers\BaseSoftdeletableRestoreController;

use kosuha606\Yii2BaseKit\Controllers\BaseController;
use yii\data\ActiveDataProvider;

/**
 * Контроллер восстановления сущностей
 * унаследованных от SoftDeletableAR
 *
 * @see SoftDeletableAR
 */
class BaseSoftdeletableRestoreController extends BaseController
{
    /**
     * @var array
     */
    public $views = [
        'index' => null,
    ];

    /**
     * @param $modelClass
     * @return mixed
     */
    public function actionIndex($modelClass)
    {
        $this->getConfigurationChecker()->valueNotEmpty($this->views, 'index');
        $this->beforeActionChecks($modelClass);
        $ipp = \Yii::$app->request->get('ipp', 10);
        $order = ['id' => SORT_ASC];
        $provider = new ActiveDataProvider([
            'query' =>  $modelClass::find()->where(['isDeleted' => 1]),
            'pagination' => [
                'pageSize' => $ipp,
            ],
            'sort' => [
                'defaultOrder' => $order,
            ],
        ]);
        return $this->render($this->views['index'], [
            'provider' => $provider,
            'modelClass' => $modelClass,
        ]);
    }

    /**
     * @param $modelClass
     * @param $id
     * @return mixed
     */
    public function actionRestore($modelClass, $id)
    {
        /** @var SoftDeletableAR $modelClass */
        $this->getConfigurationChecker()->valueNotEmpty($this->views, 'detail');
        $this->beforeActionChecks($modelClass);
        $object = $modelClass::find()->where(['id' => $id, 'isDeleted' => 1])->one();
        $object->isDeleted = null;
        $object->save();
        \Yii::$app->session->addFlash('success', 'Сущность успешно восстановлена');
        return $this->redirect(['index', 'modelClass' => $modelClass]);
    }

    /**
     * @param $modelClass
     */
    private function beforeActionChecks($modelClass)
    {
        $this->getConfigurationChecker()->classExists($modelClass);
        $this->getConfigurationChecker()->classInstanceOf($modelClass, SoftDeletableAR::class);
    }
}