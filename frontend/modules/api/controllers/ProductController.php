<?php

namespace app\modules\api\controllers;

use Yii;
use frontend\core\controller\FrontendController;
// use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use common\components\Helpers;
use yii\helpers\Url;
use yii\web\Session;

use common\models\Product;

class ProductController extends FrontendController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                // 'actions' => [
                //     'delete' => ['post'],
                // ],
            ],
        ];
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * action for list product
     */
	public function actionGetRegistrants()
    {

    }
}