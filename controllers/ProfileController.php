<?php

namespace app\controllers;
use app\models\City;
use Yii;
use yii\filters\AccessControl;
use app\models\Profile;
use app\models\Values;
use app\models\Goals;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class ProfileController extends \yii\web\Controller
{
	public $layout = 'profile.php';
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				'only'=>['index'],
                'rules' => [
                    [
						'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
	
	public function actions()
	{
		return [
			'error' => ['class' => 'yii\web\ErrorAction'],
		];
	}
	
	public function actionSearch()
	{
		$model = new Profile();
        $dataProvider = new ActiveDataProvider([
            'query' => Profile::find(),
			'sort'=>['defaultOrder'=>['id' => SORT_DESC]],
			'pagination' => [
				'pageSize' => 10,
			],
        ]);
		return $this->render('search',[
			'dataProvider' => $dataProvider,
			'model' => $model,
			]
		);
	}
	
    public function actionIndex()
    {
		$friends = null;
		$model = $this->findModel(Yii::$app->user->id);
        return $this->render('index',['model'=>$model,'friends'=>$friends]);
    }
	
	public function actionEdit($section)
    {
		$model = $this->findModel(Yii::$app->user->id);
		$values = new Values();

        if (($model->load(Yii::$app->request->post())) || ($values->saveValue(Yii::$app->request->post()))) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            //die(print_r($model->avatar));

            if ($model->avatar) {
                $model->avatar = Yii::$app->storage->saveUploadedFile($model->avatar);
            }else{
                $model->avatar = $model->oldAttributes['avatar'];
            }
            if($model->save())
            {
                Yii::$app->session->setFlash('dataEdited');
                return $this->redirect(['/profile/edit', 'section'=>$section]);
            }

        }


        return $this->render('edit',[
            'model'=>$model,
            'values'=>$values,
        ]);
    }

    public function actionSearchCities()
    {
        if(Yii::$app->request->isAjax)
        {
            $city = new City();
            return $city->searchCities(Yii::$app->request->get());
        }
    }
	
	protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        }


    }



}
