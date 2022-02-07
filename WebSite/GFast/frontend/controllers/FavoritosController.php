<?php

namespace frontend\controllers;

use common\models\Favoritos;
use common\models\Guitarras;
use frontend\models\FavoritosSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FavoritosController implements the CRUD actions for Favoritos model.
 */
class FavoritosController extends Controller
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
     * Lists all Favoritos models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $user_id = Yii::$app->user->identity;
        $model = Favoritos::find()->where(['fav_iduser' => $user_id])->all();
        $guitarras = [];
        foreach ($model as $guitarra) {

            $guitarraaux = Guitarras::find()->where(['gui_id' => $guitarra->fav_idguitarras])->one();

            array_push($guitarras, $guitarraaux);


        }

        return $this->render('index', [
            'guitarras' => $guitarras,
            'model' => $model,

        ]);
    }

    /**
     * Displays a single Favoritos model.
     * @param int $fav_id Fav ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fav_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($fav_id),
        ]);
    }

    /**
     * Finds the Favoritos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $fav_id Fav ID
     * @return Favoritos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fav_id)
    {
        if (($model = Favoritos::findOne(['fav_idguitarras' => $fav_id])) !== null) {
            return $model;
        } else {
            return null;
        }

        //throw new NotFoundHttpException('Esta página não existe.');
    }

    /**
     * Creates a new Favoritos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Favoritos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'fav_id' => $model->fav_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Favoritos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $fav_id Fav ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fav_idguitarras)
    {
        $fav_iduser = Yii::$app->user->identity;
        $favorito = new Favoritos();
        $model = $this->findFavoritos($fav_idguitarras);

        if ($model === null) {
            $favorito->fav_idguitarras = $fav_idguitarras;
            $favorito->fav_iduser = $fav_iduser->getId();

            if ($favorito->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }

        } else {

            $this->findFavoritos($fav_idguitarras)->delete();
            return $this->redirect(Yii::$app->request->referrer);

        }


    }


    protected function findFavoritos($fav_idguitarras)
    {
        $fav_iduser = Yii::$app->user->identity;

        if (($model = Favoritos::findOne(Favoritos::findOne(['fav_iduser' => $fav_iduser->getId(), 'fav_idguitarras' => $fav_idguitarras,]))) !== null) {

            return $model;
        } else {
            return null;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing Favoritos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $fav_id Fav ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idguitarra)
    {


        $this->findFavoritos($idguitarra)->delete();

        return $this->redirect(['index']);
    }
}
