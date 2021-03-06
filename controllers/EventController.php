<?php

namespace app\controllers;

use Yii;
use app\models\Event;
use app\models\EventDay;
use app\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper; // DEBUG

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
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
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // Event::getEventDates($id); // DEBUG
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();
        $days = array(); // DELLA GIUSTA CLASSE???
        // $eventDay = new EventDay();

        if ($model->load(Yii::$app->request->post()))
        {
            // $model->start_date = Yii::$app->formatter->asDate($model->start_date, 'yyyy-MM-dd HH:mm:ss'); // 2014-10-06 15:22:34
            // $model->end_date = Yii::$app->formatter->asDate($model->end_date, 'yyyy-MM-dd HH:mm:ss'); // 2014-10-06 15:22:34
            $daysString = $model->getSingleDays();
            $isValid = $model->validate();
            // false to validateInput parameter because already validated
            $model->save(false);
            $id = $model->getPrimaryKey();

            foreach ($daysString as $dayStr) {
                $eventDay = new EventDay();
                $eventDay->eventId = $id;
                $eventDay->date = $dayStr;
                $eventDay->activity = 'Undefined';
                $isValid = $eventDay->validate() && $isValid;
                $days[] = $eventDay;
                // d('dayStr: '.$dayStr); // DEBUG
                // d('eventDays: '.count($days)); // DEBUG
            }
            // d($days); // DEBUG
            if ($isValid)
            {
                foreach ($days as $eventDay) {
                    $eventDay->save(false);
                    // d('date: '.$eventDay->date); // DEBUG
                }
                // dd('isValid TRUE!'); // DEBUG
                return $this->redirect(['view', 'id' => $model->eventId]);
            }
            else {
                // d(isValid è falso!');
                // dd($days[0]);
            }
        }
        else {
            // dd(\app\models\City::getMolise()); // DEBUG
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdd()
    {
        $model = new Event();
        $days = array(); // DELLA GIUSTA CLASSE???

        if ($model->load(Yii::$app->request->post()))
        {

            $daysString = $model->getSingleDays();
            $isValid = $model->validate();
            // false to validateInput parameter because already validated
            $model->save(false);
            $id = $model->getPrimaryKey();

            foreach ($daysString as $dayStr) {
                $eventDay = new EventDay();
                $eventDay->eventId = $id;
                $eventDay->date = $dayStr;
                $eventDay->activity = 'Undefined';
                $isValid = $eventDay->validate() && $isValid;
                $days[] = $eventDay;
            }
            if ($isValid)
            {
                foreach ($days as $eventDay) {
                    $eventDay->save(false);
                }
                return $this->redirect(['view', 'id' => $model->eventId]);
            }
        }
        else {
            $map = ArrayHelper::map(\app\models\City::getMolise(), 'cityId', 'name');
            // dd(\app\models\City::getMolise()); // DEBUG
            return $this->render('add', [
                'model' => $model, 'cities' => $map,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->eventId]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Displays all Events in a list.
     * @param integer $id
     * @return mixed
     */
    public function actionList()
    {
        $dataProvider = Event::getEventsForView();
        return $this->render('list', ['listDataProvider' => $dataProvider]);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
