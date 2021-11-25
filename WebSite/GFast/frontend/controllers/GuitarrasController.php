<?php

namespace frontend\controllers;

use common\models\Guitarras;
use common\models\GuitarrasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GuitarrasController implements the CRUD actions for Guitarras model.
 */
class GuitarrasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Guitarras models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuitarrasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guitarras model.
     * @param int $gui_id ID Guitarra
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($gui_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($gui_id),
        ]);
    }

    /**
     * Creates a new Guitarras model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Guitarras();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'gui_id' => $model->gui_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Guitarras model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $gui_id ID Guitarra
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($gui_id)
    {
        $model = $this->findModel($gui_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'gui_id' => $model->gui_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Guitarras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $gui_id ID Guitarra
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($gui_id)
    {
        $this->findModel($gui_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Guitarras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $gui_id ID Guitarra
     * @return Guitarras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($gui_id)
    {
        if (($model = Guitarras::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
