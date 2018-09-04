<?php

namespace app\controllers;

use Yii;
use app\models\Values;
use app\models\ValuesSearch;
use app\controllers\ProfileController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ValuesController implements the CRUD actions for Values model.
 */
class ValuesController extends ProfileController
{


    /**
     * Lists all Values models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValuesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing Values model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->request->isAjax)
        {
            $model = $this->findModel($id);

            if ($model->saveValue(Yii::$app->request->post())) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $model;
            }
        }

    }

    /**
     * Deletes an existing Values model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->request->isAjax)
        {
            if($this->findModel($id)->delete())
            {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true];
            }
        }

    }

    /**
     * Finds the Values model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Values the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Values::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
