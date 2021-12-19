<?php

namespace frontend\controllers;

use common\models\Guitarras;
use common\models\Marcas;
use frontend\models\MarcasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarcasController implements the CRUD actions for Marcas model.
 */
class MarcasController extends Controller
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
     * Lists all Marcas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $marcas = Marcas::find()->where(['mar_inativo' => 0])->all();

        return $this->render('index', [
           'marcas' => $marcas,

        ]);
    }

    /**
     * Displays a single Marcas model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $marca = $this->findModel($id);
        $guitarras = Guitarras::find()->where(['gui_idmarca' => $id])->all();

        return $this->render('view', [
            'guitarras' => $guitarras,
            'marca' => $marca,
        ]);
    }

    /**
     * Creates a new Marcas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Marcas();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'mar_id' => $model->mar_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Marcas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $mar_id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($mar_id)
    {
        $model = $this->findModel($mar_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'mar_id' => $model->mar_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Marcas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $mar_id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($mar_id)
    {
        $this->findModel($mar_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Marcas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Marcas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marcas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
