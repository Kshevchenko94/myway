<?php

namespace app\controllers;

use Yii;
use app\models\Goals;
use app\models\Stages;
use app\models\Substage;
use app\models\News;
use app\models\GoalsSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * GoalsController implements the CRUD actions for Goals model.
 */
class GoalsController extends ProfileController
{

    const ACTIVEGOAL = 1;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only'=>['update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'matchCallback' => function ($rule, $action) {
                            return $this->findModel(Yii::$app->request->get('id'))->id_user == Yii::$app->user->id;
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Goals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoalsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goals model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'report' => new News(),
        ]);
    }

    /**
     * Creates a new Goals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goals;
        $Stages = [new Stages()];
        $subStages = new Substage();

        if ($model->load(Yii::$app->request->post())) {
            die(print_r(Yii::$app->request->post('Stages')));
			$model->id_user = Yii::$app->user->id;
			$model->status = self::ACTIVEGOAL;
			$model->doc = UploadedFile::getInstance($model, 'doc');

			if ($model->doc) {
			    $docUrl = Yii::$app->storage->saveUploadedFile($model->doc);
				if($docUrl)
				{
					$model->doc = $docUrl;
				}
			}

			if($model->save())
			{
                $items = Yii::$app->request->post('Stages')['Stages'];
                for($i = 0; $i<count($items); $i++){
                    $Stages[$i] = new Stages();
                }
				if(Model::loadMultiple($Stages, Yii::$app->request->post('Stages')) && Model::validateMultiple($Stages))
				{
					foreach ($Stages as $key=>$Stage) {
                        $Stage->id_user = Yii::$app->user->id;
                        $Stage->goal_id = $model->id;
                        $Stage->save(false);


                    }
				}
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdateStatus($id,$status)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isAjax && $status)
        {
            $model->status = Yii::$app->request->get('status');
            if($model->save())
            {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['msg'=>'ok', 'id'=>$model->id];
            }
        }
    }

    /**
     * Updates an existing Goals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $Stages = Stages::find()->where(['goal_id'=>$model->id])->indexBy('id')->all();
        //$Stages = $model->stages;

        //die(print_r($Stages));
        //$Substages = [new Substage];

        if ($model->load(Yii::$app->request->post())) {

			$model->doc = UploadedFile::getInstance($model, 'doc');
            if ($model->doc) {
                Yii::$app->storage->deleteUploadedFile($model->oldAttributes['doc']);
                $model->doc = Yii::$app->storage->saveUploadedFile($model->doc);
            }else{
                $model->doc = $model->oldAttributes['doc'];
            }
			if($model->save())
			{
                //Model::loadMultiple($Stages, Yii::$app->request->post('Goals')['stages']);
                //print_r(Yii::$app->request->post('Goals'));
			    //die();
                if(Model::loadMultiple($Stages, Yii::$app->request->post('Goals')))
                {
                    foreach ($Stages as $key => $Stage) {
                        $Stage->save(false);
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'stages' => $Stages,
        ]);
    }

    /**
     * Deletes an existing Goals model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteFile($id)
    {
        $model = $this->findModel($id);

        if(Yii::$app->storage->deleteUploadedFile($model->doc))
        {
            $model->doc = null;
            if($model->save())
            {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['msg'=>'ok', 'id'=>$model->id];
            }

        }
    }

    /**
     * Finds the Goals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddStages()
    {

        $model = new Stages();
        if(Yii::$app->request->isPost)
        {
            if($model->saveStages())
            {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['status'=>true];
            }
        }
        return $this->renderAjax('_stage', ['model'=>$model]);
    }

    public function actionDeleteStage()
    {
        if(Yii::$app->request->isAjax)
        {
            Stages::deleteStage(Yii::$app->request->post('stageId'));
        }
    }


}
