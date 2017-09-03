<?php

namespace app\controllers;

use Yii;
use app\models\PersonCity;
use app\models\PersonCitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonCityController implements the CRUD actions for PersonCity model.
 */
class PersonCityController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PersonCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonCity model.
     * @param integer $personId
     * @param integer $cityId
     * @return mixed
     */
    public function actionView($personId, $cityId)
    {
        return $this->render('view', [
            'model' => $this->findModel($personId, $cityId),
        ]);
    }

    /**
     * Creates a new PersonCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonCity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'personId' => $model->personId, 'cityId' => $model->cityId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PersonCity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $personId
     * @param integer $cityId
     * @return mixed
     */
    public function actionUpdate($personId, $cityId)
    {
        $model = $this->findModel($personId, $cityId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'personId' => $model->personId, 'cityId' => $model->cityId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PersonCity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $personId
     * @param integer $cityId
     * @return mixed
     */
    public function actionDelete($personId, $cityId)
    {
        $this->findModel($personId, $cityId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PersonCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $personId
     * @param integer $cityId
     * @return PersonCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($personId, $cityId)
    {
        if (($model = PersonCity::findOne(['personId' => $personId, 'cityId' => $cityId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
