<?php
namespace app\controllers;

use Yii;
use app\models\Blog;
use yii\helpers\Url;
use app\models\Comment;
use yii\web\Controller;
use app\models\blog\BlogForm;
use app\models\comment\CommentForm;
use yii\web\ForbiddenHttpException;

class BlogController extends Controller
{
   public function beforeAction($action)
   {
      if($action->id != 'admin')
         $this->layout = 'membre';
      return parent::beforeAction($action);
   }

   public function actionIndex($order = 'DESC')
   {
      $articles = Blog::listAll(Yii::$app->user->id, $order);
      return $this->render('index', [
         'articles' => $articles,
         'order' => $order
      ]);
   }

   public function actionView($id)
   {
      $this->layout = "main";
      $article = Blog::get($id);
      $commentForm = null;
      if(\Yii::$app->user->can('createComment')) {
         $commentForm = new CommentForm();
         if($commentForm->load(Yii::$app->request->post()) && $commentForm->validate()) {
            if($commentForm->create($id))
               return $this->refresh();
         }
      }
      return $this->render('view', [
         'article' => $article,
         'commentForm' => $commentForm
      ]);
   }

   public function actionCreate()
   {
      if (\Yii::$app->user->can('createArticle')) {
         $createForm = new BlogForm();

         if ($createForm->load(Yii::$app->request->post()) && $createForm->validate()) {
            if($createForm->create())
               return $this->redirect(Url::toRoute(['blog/index']));     
         }
   
         return $this->render('create', [
            'createForm' => $createForm
         ]);
      } else {
         throw new ForbiddenHttpException("Vous devez avoir un compte utilisateur pour créer un article",403);
      }
   }

   public function actionUpdate($id, $adm = false)
   {
      $article = Blog::get($id);
      if (Yii::$app->user->can('ownArticle', ['target' => $article])) {     
         $updateForm = new BlogForm($article);
   
         if ($updateForm->load(Yii::$app->request->post()) && $updateForm->validate()) {
            if ($updateForm->update($article))
               return $this->redirect(Url::toRoute('blog/'.(($adm) ? 'admin' : 'index')));
         }
         return $this->render('update', [
            'updateForm' => $updateForm
         ]);
      } else {
         throw new ForbiddenHttpException("Accès refusé",403);
      }
   }

   public function actionPublish($id, $adm = false)
   {
      if (Yii::$app->user->can('ownArticle', ['target' => Blog::get($id)]) && Blog::publish($id))
         return $this->redirect(Url::toRoute('blog/'.(($adm) ? 'admin' : 'index')));
      else
         throw new ForbiddenHttpException("Accès refusé",403);
   }

   public function actionDelete($id, $adm = false)
   {
      if (Yii::$app->user->can('ownArticle', ['target' => Blog::get($id)]) && Blog::destroy($id))
         return $this->redirect(Url::toRoute('blog/'.(($adm) ? 'admin' : 'index')));
      else
         throw new ForbiddenHttpException("Accès refusé",403);
   }

   public function actionAdmin($order = 'DESC')
   {
      if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'admin')) {
         $articles = Blog::listAll(null, $order);
         return $this->render('admin', [
            'articles' => $articles,
            'order' => $order
         ]);
      } else {
         throw new ForbiddenHttpException("Accès refusé",403);
      }
   }

   public function actionDeleteComment($id)
   {
      $comment = Comment::get($id);
      if(Yii::$app->user->can('ownArticle', ['target' => $comment]) && Comment::destroy($id))
         return $this->redirect(Url::toRoute(['blog/view', 'id' => $comment->article->id]));        
      else
         throw new ForbiddenHttpException("Accès refusé", 403);
   }
}