<?php

namespace frontend\controllers;

use common\models\Encomendas;
use common\models\EncomendaUser;
use common\models\Favoritos;
use common\models\Guitarras;
use frontend\models\EncomendasSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EncomendasController implements the CRUD actions for Encomendas model.
 */
class EncomendasController extends Controller
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
     * Lists all Encomendas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user_id = Yii::$app->user->identity;
        $model = Encomendas::find()->where(['enc_iduser' => $user_id, 'enc_estado' => 2])->all();

        return $this->render('index', [
            'model' => $model,

        ]);
    }

    /**
     * Lists all Encomendas models.
     *
     * @return string
     */
    public function actionCarrinho()
    {
        $user_id = Yii::$app->user->identity;
        $model = Encomendas::find()->where(['enc_iduser' => $user_id, 'enc_estado' => 1])->all();

        return $this->render('carrinho', [

            'model' => $model,

        ]);
    }



    public function actionView()
    {
        $user_id = Yii::$app->user->identity;
        $model = Encomendas::find()->where(['enc_iduser' => $user_id->getId(), 'enc_estado' => 1])->all();
        $relacao = new EncomendaUser();
        foreach ($model as $encomenda)
        {

            $encomenda->enc_estado = 2;
            $relacao->iduser = $user_id->getId();
            $relacao->enc_id = $encomenda->enc_id;

            if ($this->request->isPost && $encomenda->load($this->request->post()) && $encomenda->save() && $relacao->save()) {
               // return $this->redirect(['view', 'gui_id' => $encomenda->gui_id]);

            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Encomendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($idguitarra)
    {
        $model = new Encomendas();
        $user_id = Yii::$app->user->identity;
        $model->enc_iduser = $user_id->getId();
        $model->enc_estado = 1;
        $model->enc_idguitarra = $idguitarra;

            if ($model->save()) {

                $model = Encomendas::find()->where(['enc_iduser' => $user_id, 'enc_estado' => 1])->all();

                return $this->render('carrinho', [

                    'model' => $model,

                ]);

            }
    }

    /**
     * Updates an existing Encomendas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Enc ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->enc_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Encomendas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Enc ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {


        $this->findModel($id)->delete();

        return $this->redirect(['carrinho']);
    }

    /**
     * Finds the Encomendas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Enc ID
     * @return Encomendas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encomendas::findOne(['enc_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
