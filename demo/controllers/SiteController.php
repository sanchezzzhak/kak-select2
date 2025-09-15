<?php
namespace app\controllers;

use app\models\TestModel;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionAjaxCountry(): array
    {
        $this->response->format = 'json';


        return [];
    }

    public function actionAjaxCity(): array
    {
        $this->response->format = 'json';
        return [];
    }

    public function actionIndex(): string
    {
        $model = new TestModel();

        return $this->render('index', compact('model'));
    }

}
