<?php

namespace backend\controllers;

use common\models\SubcategoriaGuitarra;
use backend\models\SubcategoriaGuitarraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubcategoriaGuitarraController implements the CRUD actions for SubcategoriaGuitarra model.
 */
class SubcategoriaGuitarraController extends Controller
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
     * Lists all SubcategoriaGuitarra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubcategoriaGuitarraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubcategoriaGuitarra model.
     * @param int $sub_id Sub ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sub_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sub_id),
        ]);
    }

    /**
     * Creates a new SubcategoriaGuitarra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubcategoriaGuitarra();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sub_id' => $model->sub_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SubcategoriaGuitarra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sub_id Sub ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sub_id)
    {
        $model = $this->findModel($sub_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sub_id' => $model->sub_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SubcategoriaGuitarra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sub_id Sub ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sub_id)
    {
        $this->findModel($sub_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubcategoriaGuitarra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sub_id Sub ID
     * @return SubcategoriaGuitarra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sub_id)
    {
        if (($model = SubcategoriaGuitarra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
