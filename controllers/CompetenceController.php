<?php

namespace app\controllers;

use Yii;
use app\models\Competence;
use app\models\CompetenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompetenceController implements the CRUD actions for Competence model.
 */
class CompetenceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index','create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Competence models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompetenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Competence model.
     * @param integer $person
     * @param integer $role
     * @return mixed
     */
    public function actionView($person, $role)
    {
        return $this->render('view', [
            'model' => $this->findModel($person, $role),
        ]);
    }

    /**
     * Creates a new Competence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Competence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person' => $model->person, 'role' => $model->role]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Competence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $person
     * @param integer $role
     * @return mixed
     */
    public function actionUpdate($person, $role)
    {
        $model = $this->findModel($person, $role);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'person' => $model->person, 'role' => $model->role]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Competence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $person
     * @param integer $role
     * @return mixed
     */
    public function actionDelete($person, $role)
    {
        $this->findModel($person, $role)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Competence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $person
     * @param integer $role
     * @return Competence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($person, $role)
    {
        if (($model = Competence::findOne(['person' => $person, 'role' => $role])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
