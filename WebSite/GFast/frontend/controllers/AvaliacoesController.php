<?php

namespace frontend\controllers;

use common\models\Avaliacoes;
use common\models\Guitarras;
use frontend\models\AvaliacoesSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AvaliacoesController implements the CRUD actions for Avaliacoes model.
 */
class AvaliacoesController extends Controller
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
     * Lists all Avaliacoes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvaliacoesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaliacoes model.
     * @param int $id Ava ID
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
     * Creates a new Avaliacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $user_id = Yii::$app->user->identity;


        $model = new Avaliacoes();

        $model->ava_iduser = $user_id->getId();
        $model->ava_idguitarra = $id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $guitarra = Guitarras::find()->where(['gui_id' => $model->ava_idguitarra])->one();
                $guitarras = Guitarras::find()->where(['gui_inativo' => 0])->all();
                return $this->render('../site/produto', [
                    'model' => $guitarra, 'guitarras' => $guitarras
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Avaliacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Ava ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('crudOwnAvaliacao', ['post' => $model])) {

            $guitarra = Guitarras::find()->where(['gui_id' => $model->ava_idguitarra])->one();
            $guitarras = Guitarras::find()->where(['gui_inativo' => 0])->all();

            if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

                return $this->render('../site/produto', [
                    'model' => $guitarra, 'guitarras' => $guitarras
                ]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);

        } else {

            echo $this->render('error', ['name' => 'Não Autorizado(401)', 'message' => 'Não está autorizado a aceder a esta página']);
        }

    }

    /**
     * Deletes an existing Avaliacoes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Ava ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (\Yii::$app->user->can('crudOwnAvaliacao', ['post' => $model])) {

            $guitarra = Guitarras::find()->where(['gui_id' => $model->ava_idguitarra])->one();
            $guitarras = Guitarras::find()->where(['gui_inativo' => 0])->all();

            $this->findModel($id)->delete();

            return $this->render('../site/produto', [
                'model' => $guitarra, 'guitarras' => $guitarras
            ]);
        } else {

            echo $this->render('error', ['name' => 'Não Autorizado(401)', 'message' => 'Não está autorizado a aceder a esta página']);
        }
    }


    /**
     * Finds the Avaliacoes model based on its primary key value.
     * If the model is not found, a 404 HyTTP exception will be thrown.
     * @param int $id Ava ID
     * @return Avaliacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaliacoes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
