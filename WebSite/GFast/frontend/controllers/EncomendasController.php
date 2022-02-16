<?php

namespace frontend\controllers;

use common\models\Carrinho;

use common\models\Encomendas;


use common\models\Guitarras;

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
        $model = Encomendas::find()->where(['enc_iduser' => $user_id, 'enc_estado' => 1])->all();

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
        $model = Carrinho::find()->where(['iduser' => $user_id, 'inativo' => 0])->all();

        return $this->render('carrinho', [

            'model' => $model,

        ]);
    }


    public function actionView()
    {
        $user_id = Yii::$app->user->identity;

        //$user_id = Yii::$app->user->identity;
        $model = Encomendas::find()->where(['enc_iduser' => $user_id->getId(), 'enc_estado' => 1])->all();
        $relacao = new EncomendaUser();
        foreach ($model as $encomenda) {

            $encomenda->enc_estado = 2;


            if ($this->request->isPost && $encomenda->load($this->request->post()) && $encomenda->save() && $relacao->save()) {
                // return $this->redirect(['view', 'gui_id' => $encomenda->gui_id]);

            }
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCarrinhoEncomenda()
    {

        $user_id = Yii::$app->user->identity;
        $carts = Carrinho::find()->where(['iduser' => $user_id->getId(), 'inativo' => 0])->all();


        $model = new Encomendas();
        if ($this->request->isPost) {

            $model->enc_estado = 1;
            $model->enc_iduser = $user_id->getId();
            if ($model->load($this->request->post()) && $model->save()) {

                foreach ($carts as $cart) {
                    $cart->enc_id =  $model->enc_id;
                    $cart->inativo = 1;
                    $cart->save();
                }
                 return $this->redirect(['index']);
            }

        } else {
            $model->loadDefaultValues();
        }


        return $this->render('view', [
            'carrinhos' => $carts
        ]);
    }


    /**
     * Creates a new Encomendas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($idguitarra)
    {
        $carrinho = new Carrinho();

        $user_id = Yii::$app->user->identity;
        $carrinho->iduser = $user_id->getId();
        $carrinho->gui_id = $idguitarra;
        $carrinho->inativo = 0;


        if ($carrinho->save()) {

            $model = Carrinho::find()->all();
            return $this->redirect(['carrinho', 'model' => $model]);

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

    protected function findModel($id)
    {
        if (($model = Encomendas::findOne(['enc_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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


        $this->findModelCarrinho($id)->delete();

        return $this->redirect(['carrinho']);
    }

    protected function findModelCarrinho($id)
    {
        if (($model = Carrinho::findOne(['id' => $id])) !== null) {
            return $model;


        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
