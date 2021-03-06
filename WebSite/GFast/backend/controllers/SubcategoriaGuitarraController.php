<?php

namespace backend\controllers;

use common\models\SubcategoriaGuitarra;
use backend\models\SubcategoriaGuitarraSearch;
use yii\filters\AccessControl;
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
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['index','update', 'delete', 'create', 'view'],
                            'allow' => true,
                            'roles' => ['admin', 'gestor'],
                        ],
                        [
                            'actions' => ['logout', 'index'],
                            'allow' => false,
                            'roles' => ['funcionario', 'gestor'],
                        ],
                    ],
                ],

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
     * @param int $id Sub ID
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
     * Creates a new SubcategoriaGuitarra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubcategoriaGuitarra();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->sub_id]);
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
     * @param int $id Sub ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
     * @param int $id Sub ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubcategoriaGuitarra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Sub ID
     * @return SubcategoriaGuitarra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubcategoriaGuitarra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
