<?php

namespace app\controllers;

use Yii;
use app\models\Goals;
use app\models\Stages;
use app\models\Substage;
use app\models\News;
use app\models\GoalsSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
        $subStages = [[new Substage()]];

        $items = Yii::$app->request->post('Stages');
        for($i = 0; $i<count($items); $i++){
            $Stages[$i] = new Stages();
        }

        if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($Stages, Yii::$app->request->post()) && Model::validateMultiple($Stages)) {

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
                foreach ($Stages as $key=>$Stage) {
                    $Stage->id_user = Yii::$app->user->id;
                    $Stage->goal_id = $model->id;
                    $Stage->save(false);
                }
				return $this->redirect(['view', 'id' => $model->id]);
			}
        }
        return $this->render('create', [
            'model' => $model,
            'stages'=>$Stages,
            'subStages'=>$subStages,
        ]);
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
        $Stages = $model->stages;

        if ($model->load(Yii::$app->request->post())) {

            $model->doc = UploadedFile::getInstance($model, 'doc');

            if ($model->doc) {
                $docUrl = Yii::$app->storage->saveUploadedFile($model->doc);
                if($docUrl)
                {
                    $model->doc = $docUrl;
                }
            }

            $oldIDs = ArrayHelper::map($Stages, 'id', 'id');
            $Stages = \app\models\Model::createMultiple(Stages::classname(), $Stages);
            Model::loadMultiple($Stages, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($Stages, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($Stages) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            Stages::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($Stages as $Stage) {
                            $Stage->goal_id = $model->id;
                            $Stage->id_user = Yii::$app->user->id;
                            if (! ($flag = $Stage->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'stages' => $Stages
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



}
