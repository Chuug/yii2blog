<?php

namespace app\controllers;

use app\models\Blog;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class SiteController extends Controller
{
   /**
    * {@inheritdoc}
    */
   public function behaviors()
   {
      return [
         'access' => [
               'class' => AccessControl::class,
               'only' => ['logout'],
               'rules' => [
                  [
                     'actions' => ['logout'],
                     'allow' => true,
                     'roles' => ['@'],
                  ],
               ],
         ],
         'verbs' => [
               'class' => VerbFilter::class,
               'actions' => [
                  'logout' => ['post'],
               ],
         ],
      ];
   }

   /**
    * {@inheritdoc}
    */
   public function actions()
   {
      return [
         'error' => [
               'class' => 'yii\web\ErrorAction',
         ],
         'captcha' => [
               'class' => 'yii\captcha\CaptchaAction',
               'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
         ],
      ];
   }

   /**
    * Displays homepage.
    *
    * @return string
    */
   public function actionIndex()
   {
      $articles = Blog::find()->where(['published' => true])->all();
      return $this->render('index', [
         'articles' => $articles
      ]);
   }
}
