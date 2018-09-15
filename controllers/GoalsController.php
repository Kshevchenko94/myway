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

        if ($model->load(Yii::$app->request->post())) {

            $model->doc = UploadedFile::getInstance($model, 'doc');

            if ($model->doc) {
                $docUrl = Yii::$app->storage->saveUploadedFile($model->doc);
                if($docUrl)
                {
                    $model->doc = $docUrl;
                }
            }

            $model->id_user = Yii::$app->user->id;
            $model->status = self::ACTIVEGOAL;

            $Stages = \app\models\Model::createMultiple(Stages::classname());
            Model::loadMultiple($Stages, Yii::$app->request->post());

            // validate person and houses models
            $valid = $model->validate();

            $valid = Model::validateMultiple($Stages) && $valid;

            if (isset($_POST['Substage'][0][0])) {
                foreach ($_POST['Substage'] as $indexStage => $Substages) {
                    foreach ($Substages as $indexSubstage => $Substage) {
                        $data['Substage'] = $Substage;
                        $Substage = new Substage;
                        $Substage->load($data);
                        $Substage->id_user = Yii::$app->user->id;
                        $subStages[$indexStage][$indexSubstage] = $Substage;
                        $valid = $Substage->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($Stages as $indexStage => $Stage) {

                            if ($flag === false) {
                                break;
                            }

                            $Stage->goal_id = $model->id;
                            $Stage->id_user = Yii::$app->user->id;

                            if (!($flag = $Stage->save(false))) {
                                break;
                            }

                            if (isset($subStages[$indexStage]) && is_array($subStages[$indexStage])) {
                                foreach ($subStages[$indexStage] as $indexSubstage => $Substage) {
                                    $Substage->id_stage = $Stage->id;
                                    if (!($flag = $Substage->save(false))) {
                                        break;
                                    }
                                }

                            }

                        }

                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
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
        $modelsStage = $model->stages;
        $modelsSubStage = [];
        $oldSubStages = [];

        if (!empty($modelsStage)) {
            foreach ($modelsStage as $indexStage => $modelStage) {
                $subStages = !empty($modelStage->subStages)? $modelStage->subStages: [new Substage()];
                $modelsSubStage[$indexStage] = $subStages;
                $oldSubStages = ArrayHelper::merge(ArrayHelper::index($subStages, 'id'), $oldSubStages);
            }
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->doc = UploadedFile::getInstance($model, 'doc');

            if ($model->doc) {
                $docUrl = Yii::$app->storage->saveUploadedFile($model->doc);
                if($docUrl)
                {
                    $model->doc = $docUrl;
                }
            }else{
                $model->doc = $model->oldAttributes['doc'];
            }

            // reset
            $modelsSubStage = [];

            $oldStageIDs = ArrayHelper::map($modelsStage, 'id', 'id');
            $modelsStage = \app\Models\Model::createMultiple(Stages::classname(), $modelsStage);
            Model::loadMultiple($modelsStage, Yii::$app->request->post());
            $deletedStageIDs = array_diff($oldStageIDs, array_filter(ArrayHelper::map($modelsStage, 'id', 'id')));

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsStage) && $valid;

            $subStagesIDs = [];

            if (isset($_POST['Substage'][0][0])) {
                foreach ($_POST['Substage'] as $indexStage => $subStages) {
                    $subStagesIDs = ArrayHelper::merge($subStagesIDs, array_filter(ArrayHelper::getColumn($subStages, 'id')));
                    foreach ($subStages as $indexSubStage => $subStage) {
                        $data['Substage'] = $subStage;
                        $subStageModel = (isset($subStage['id']) && isset($oldSubStages[$subStage['id']])) ? $oldSubStages[$subStage['id']] : new Substage();
                        $subStageModel->id_user = Yii::$app->user->id;
                        $subStageModel->load($data);
                        $modelsSubStage[$indexStage][$indexSubStage] = $subStageModel;
                        $valid = $subStageModel->validate();
                    }
                }
            }

            $oldSubStagesIDs = ArrayHelper::getColumn($oldSubStages, 'id');
            $deletedSubStagesIDs = array_diff($oldSubStagesIDs, $subStagesIDs);

            if ($valid) {

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        if (! empty($deletedSubStagesIDs)) {
                            Substage::deleteAll(['id' => $deletedSubStagesIDs]);
                        }

                        if (! empty($deletedStageIDs)) {
                            Stages::deleteAll(['id' => $deletedStageIDs]);
                        }

                        foreach ($modelsStage as $indexStage => $stage) {

                            if ($flag === false) {
                                break;
                            }

                            $stage->goal_id = $model->id;

                            if (!($flag = $stage->save(false))) {
                                break;
                            }

                            if (isset($modelsSubStage[$indexStage]) && is_array($modelsSubStage[$indexStage])) {
                                foreach ($modelsSubStage[$indexStage] as $indexSubStage => $SubStage) {
                                    $SubStage->id_stage = $stage->id;
                                    if (!($flag = $SubStage->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'stages' => empty($modelsStage)?[new Stages()]:$modelsStage,
            'subStages'=>empty($modelsSubStage)?[[new Substage()]]:$modelsSubStage,
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
