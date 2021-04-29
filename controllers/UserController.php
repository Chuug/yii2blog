<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use app\models\user\LoginForm;
use app\models\user\SignupForm;
use yii\filters\AccessControl;

class UserController extends Controller
{
   public function behaviors()
   {
      return [
         'access' => [
            'class' => AccessControl::class,
            'only' => ['login','logout','signup','membre'],
            'rules' => [
               [
                  'allow' => true,
                  'actions' => ['login','signup'],
                  'roles' => ['?']
               ],
               [
                  'allow' => true,
                  'actions' => ['logout','membre'],
                  'roles' => ['@']
               ]
            ]
         ]
      ];
   }
   
   public function actionLogin()
   {
      if (!Yii::$app->user->isGuest) {
         return $this->goHome();
      }

      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {
         return $this->goHome();
      }

      return $this->render('login', [
         'model' => $model,
      ]);
   }

   public function actionSignup()
   {
      $model = new SignupForm();

      if($model->load(Yii::$app->request->post()) && $model->validate()){
         if($model->signup($model)) 
            return $this->redirect(Url::toRoute('user/login'));
      }

      return $this->render('signup', [
         'model' => $model
      ]);
   }

   public function actionLogout()
   {
      Yii::$app->user->logout();

      return $this->goHome();
   }

   public function actionMembre()
   {
      $this->layout = 'membre';
      return $this->render('membre');
   }

   public function actionAdmin()
   {
      $this->layout = 'membre';
      return $this->render('admin');
   }
}