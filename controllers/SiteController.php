<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use GuzzleHttp\Client;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

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

    public function actionIndex()
    {
        $client = new Client();
        $response = $client->get('http://localhost:3333/produto');
        $products = json_decode($response->getBody(), true);

        return $this->render('index', ['products' => $products]);
    }

    public function actionCreate()
    {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request;
            $productName = $request->post('productName');
            $productPrice = $request->post('productPrice');

            $client = new Client(['base_uri' => 'http://localhost:3333']);

            $response = $client->post('/produto', [
                'form_params' => [
                    'nome' => $productName,
                    'preco' => $productPrice
                ]
            ]);

            return $response->getStatusCode();
        }
    }

    public function actionListall()
    {
        $client = new Client(['base_uri' => 'http://localhost:3333']);

        $response = $client->get('/produto');

        return $response->getBody();
    }

    public function actionListone()
    {
        $request = Yii::$app->request;
        $productId = $request->post('productId');

        $client = new Client(['base_uri' => 'http://localhost:3333']);

        $response = $client->get("/produto/$productId");

        return $response->getBody();
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $productId = $request->post('productId');
        $productName = $request->post('productName');
        $productPrice = $request->post('productPrice');

        $client = new Client(['base_uri' => 'http://localhost:3333']);

        $response = $client->put("/produto/$productId", [
            'form_params' => [
                'nome' => $productName,
                'preco' => $productPrice
            ]
        ]);

        return $response->getStatusCode();
    }

    public function actionDelete()
    {
        $request = Yii::$app->request;
        $productId = $request->post('productId');

        $client = new Client(['base_uri' => 'http://localhost:3333']);

        $response = $client->delete("/produto/$productId");

        return $response->getStatusCode();
    }
}
