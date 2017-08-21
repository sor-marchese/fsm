<?php

namespace app\controllers;

use Yii;
use app\models\Competence;
use app\models\CompetenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

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
     * @param integer $personId
     * @param integer $roleId
     * @return mixed
     */
    public function actionView($personId, $roleId)
    {
        return $this->render('view', [
            'model' => $this->findModel($personId, $roleId),
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
            return $this->redirect(['view', 'personId' => $model->personId, 'roleId' => $model->roleId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new Competence for (not the CRUD default one).
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddCompetence()
    {
        $model = new Competence;

        $people = $model->getPeople();
        $listPeople = ArrayHelper::map($people,'personId','name');

        $roles = $model->getRoles();
        $listRoles = ArrayHelper::map($roles,'roleId','name');

        // IMPORTANTE: check che non stia aggiungendo una competenza gia esistente!!!

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'personId' => $model->personId, 'roleId' => $model->roleId]);
        } else {
            return $this->render('add', [
                'model' => $model,
                'listPeople' => $listPeople,
                'listRoles' => $listRoles,
            ]);
        }
    }

    /**
     * Updates an existing Competence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $personId
     * @param integer $roleId
     * @return mixed
     */
    public function actionUpdate($personId, $roleId)
    {
        $model = $this->findModel($personId, $roleId);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'personId' => $model->personId, 'roleId' => $model->roleId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Competence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $personId
     * @param integer $roleId
     * @return mixed
     */
    public function actionDelete($personId, $roleId)
    {
        $this->findModel($personId, $roleId)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Competence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $personId
     * @param integer $roleId
     * @return Competence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($personId, $roleId)
    {
        if (($model = Competence::findOne(['personId' => $personId, 'roleId' => $roleId])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
