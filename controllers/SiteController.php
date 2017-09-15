<?php

namespace app\controllers;

use app\components\SimpleAjaxSaveTrait;
use app\models\Profile;
use Yii;
use app\models\News;
use app\models\search\News as NewsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class SiteController extends Controller
{
    use SimpleAjaxSaveTrait;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => ['view', 'profile'],
//                        'roles' => ['@'],
//                    ],
//                ]
//            ]
        ];
    }

    public function actionProfile()
    {
        if(Yii::$app->user->isGuest) throw new HttpException(403, 'No guest allowed');
        $model = Profile::findOne(['user_id'=>Yii::$app->user->id]);
        if(!$model){
            $model = new Profile();
            $model->user_id = Yii::$app->user->id;
            $model->notify_browser = false;
            $model->notify_email = false;
            $model->save();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
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
}
