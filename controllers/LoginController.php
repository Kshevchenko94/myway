<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Signup;
use yii\filters\AccessControl;

class LoginController extends Controller
{
	/* public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    } */
	
	 public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/profile');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/profile');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
	
	public function actionSignup()
    {
        $model = new Signup();
		if ($model->load(Yii::$app->request->post())) {
			$model->password = Yii::$app->getSecurity()->generatePasswordHash(Yii::$app->request->post('Signup')['password']);
			if($model->save()){
				Yii::$app->session->setFlash('signed');
				return $this->goHome();
			}
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
	public function actionLogout($id)
    {
		$model = new LoginForm();
        $model->logout($id);

        return $this->goHome();
    }

}
