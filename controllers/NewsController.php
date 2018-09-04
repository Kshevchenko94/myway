<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\Users;
use app\models\Goals;
use app\models\Comments;
use yii\data\ActiveDataProvider;
use app\controllers\ProfileController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends ProfileController
{

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new News();
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['id_user'=>Yii::$app->user->id]),
			'sort'=>['defaultOrder'=>['id' => SORT_DESC]],
			'pagination' => [
				'pageSize' => 10,
			],
        ]);
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
		$model->id_user = Yii::$app->user->id;
		$model->date_create = date('Y-m-d H:i:s');
		if(Yii::$app->request->get('id_goal'))
        {
            $model->section = 'report';
            $model->id_goal = Yii::$app->request->get('id_goal');
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
			$model->file = UploadedFile::getInstance($model, 'file');
			
			if ($model->file) {
                $fileUrl = Yii::$app->storage->saveUploadedFile($model->file);
                $model->file = $fileUrl;
			}
			if($model->save(false))
			{
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true, 'model'=>$model];
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file)
            {
                if($model->oldAttributes['file'])
                {
                    Yii::$app->storage->deleteUploadedFile($model->oldAttributes['file']);
                }
               $model->file = Yii::$app->storage->saveUploadedFile($model->file);
            }else{
                $model->file = $model->oldAttributes['file'];
            }
            if($model->save())
            {

                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true, 'id'=>$model->id];
            }
        }

        
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_news)
    {
        if(Yii::$app->request->isAjax)
        {
            $model = $this->findModel($id_news);
            if($model->file)
            {
                Yii::$app->storage->deleteUploadedFile($model->file);
            }
            if($model->delete())
            {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true];
            }

        }
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteFile($id_news)
    {
        $model = $this->findModel($id_news);
        if ($model->file && Yii::$app->storage->deleteUploadedFile($model->file))
        {
            $model->file = null;
            if($model->save(false, ['file']))
            {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true];
            }
        }
    }
}
