<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use yii\data\ActiveDataProvider;

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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionShow_users()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('users', [
            'data' => $dataProvider,
        ]);
    }


    public function actionUpdate()
    {
        $id = Yii::$app->request->get('id');
        $model = User::findOne($id);
        $model->scenario = 'updateWithoutPassword';


        if (isset(Yii::$app->request->post('User')['password'])) {
            print_r("updateWithoutPassword");
        }
        $model->scenario = !empty(Yii::$app->request->post('User')['password']) ? 'updateWithPassword' : 'updateWithoutPassword';
        //print_r($modelll);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
            }
        }

        return $this->render('edit_user', [
            'model' => $model,
        ]);
    }

    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        $model = User::findOne($id);

        return $this->render('edit_user', [
            'model' => $model,
            'view' => true,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();
        $model->scenario = 'updateWithPassword';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Usuario creado con éxito.');
            $dataProvider = new ActiveDataProvider([
                'query' => User::find(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            return $this->render('users', [
                'data' => $dataProvider,
            ]);

            return $this->render('users', [
                'data' => $dataProvider,
            ]);
        }

        return $this->render('edit_user', [
            'model' => $model,

        ]);
    }
}
