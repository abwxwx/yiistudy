<?php

namespace frontend\controllers;

use Yii;
use common\models\Member;
use common\models\Post;
use common\models\PostSearch;
use common\models\Comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public $layout = 'blog';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        //参数过滤
        $params = Yii::$app->request->queryParams;
        $model = new Post();
        $params = $model->filterParam($params, 'PostSearch');

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($params);
        //倒序排列
        $dataProvider->query->orderBy('created_at DESC');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = intval($id);
        $commentmodel = new Comment();

        if($commentmodel->load(Yii::$app->request->post()))
        {
            if (Yii::$app->user->isGuest)
            {
                //登录后才能评论
                Yii::$app->user->returnUrl = Yii::$app->request->getUrl();//记录登录后要返回的地址
                return $this->redirect(['/site/login']);
            }
            else
            {
                $commentmodel->post_id = $id;
                $result = $commentmodel->dealContent(Yii::$app->request->post());
                if($result)
                {
                    $commentmodel->save();
                    $this->refresh();
                }
                else{
                    Yii::$app->getSession()->setFlash('error', '评论内容过多或盖楼太多，请调整后重新提交评论');
                }
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'commentmodel' => $commentmodel,
        ]);

    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $user_id = yii::$app->getUser()->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'model' => $model]);
            return $this->redirect(['index', 'user_id'=>$user_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*日志管理
    * @return mixed
    */
    public function actionAdmin()
    {
        $user_id = yii::$app->getUser()->id;
        $params = array_merge(Yii::$app->request->queryParams, ['PostSearch' => ['user_id' => $user_id]]);
        $user_name = Member::findIdentity($user_id)->name;
        $title = '用户'.$user_name.'下的日志';

        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($params);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'title' => $title,
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
