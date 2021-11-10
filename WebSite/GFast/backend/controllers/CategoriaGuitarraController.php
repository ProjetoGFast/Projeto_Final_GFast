<?php

namespace backend\controllers;

use common\models\CategoriaGuitarra;
use backend\models\CategoriaGuitarraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriaGuitarraController implements the CRUD actions for CategoriaGuitarra model.
 */
class CategoriaGuitarraController extends Controller
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
     * Lists all CategoriaGuitarra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaGuitarraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoriaGuitarra model.
     * @param int $cat_id Cat ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cat_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($cat_id),
        ]);
    }

    /**
     * Creates a new CategoriaGuitarra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoriaGuitarra();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'cat_id' => $model->cat_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CategoriaGuitarra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $cat_id Cat ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cat_id)
    {
        $model = $this->findModel($cat_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cat_id' => $model->cat_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CategoriaGuitarra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $cat_id Cat ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cat_id)
    {
        $this->findModel($cat_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CategoriaGuitarra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $cat_id Cat ID
     * @return CategoriaGuitarra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cat_id)
    {
        if (($model = CategoriaGuitarra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}