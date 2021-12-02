<?php

namespace backend\controllers;

use app\models\UploadForm;
use common\models\Guitarras;
use backend\models\GuitarrasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
     * @param int $id Gui ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $foto = new UploadForm();
        if ($this->request->isPost) {

            $foto->gui_fotopath = UploadedFile::getInstance($model, 'gui_fotopath');
            //$foto->gui_qrcodepath = UploadedFile::getInstance($model, 'gui_qrcodepath');

            if ($model->load($this->request->post()) && $model->validate()) {
                $caminhofoto = $foto->uploadphoto();
                if ($caminhofoto != null) {
                    $model->gui_fotopath = $caminhofoto;
                    $model->save();
                }
                return $this->redirect(['view', 'id' => $model->gui_id]);
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
     * @param int $id Gui ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = new Guitarras();
        $foto = new UploadForm();

        $foto->gui_fotopath = UploadedFile::getInstance($model, 'gui_fotopath');


        $model = $this->findModel($id);
        if ($this->request->isPost) {
            $old = $model->gui_fotopath;
            // var_dump($old);
            //die
            $model->gui_fotopath = $old;

            $model->load($this->request->post());
            if ($model->oldAttributes['gui_fotopath'] != null && $model->gui_fotopath == null) {
                $model->gui_fotopath = $model->oldAttributes['gui_fotopath'];
            }

            if ($model->save()) {

                $caminhofoto = $foto->uploadphoto();
                if ($caminhofoto != null) {
                    $model->gui_fotopath = $caminhofoto;
                    $model->save();

                }
                return $this->redirect(['view', 'id' => $model->gui_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Guitarras model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Gui ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Guitarras model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Gui ID
     * @return Guitarras the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guitarras::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
