<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\BrandsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\Helpers;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class AttributesController extends \backend\core\controller\BackendController
{   
    
    public function actionValue() {
        $attributeValueCombination = \backend\models\AttributeValueCombination::find()
                ->with([
                    "attributes",
                    "attributeValue"
                ])
                ->where(["attribute_value_combination.attribute_id" => $_POST['attribute_id']])
                ->all();
        
        
        return $this->renderFile('@app/views/attributes/value.php', array("attributeValueCombination" => $attributeValueCombination));
    }
    
}
