<?php

namespace backend\controllers;

use Yii;
use common\models\tags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * tagsController implements the CRUD actions for tags model.
 */
class Specificprice extends Controller {

    public $layout = "dashboard";

    public function behaviors() {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect('../permissionscheck');
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all tags models.
     * @return mixed
     */
    public function actionIndex() {
        
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
		
		 $data = \backend\models\Specificprice::find()->all();

        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single tags model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\CartRule();
        if (isset($_POST['cartrule'])) {

            $percent = 0;
            $amount = 0;

            if ($_POST['cartrule']['value'] == 'percent') {
                $percent = $_POST['cartrule']['amount'];
            } else if ($_POST['cartrule']['value'] == 'amount') {
                $amount = $_POST['cartrule']['amount'];
            }
            //
			
			// generate bulk voucher code
			if($_POST['cartrule']['generator'] == 'bulk'){
				
				$bulkQty = $_POST['cartrule']['bulk_quantity'];
				if($bulkQty > 0){
					for($i=1; $i <= $bulkQty; $i++){
						$cartrule = new \backend\models\CartRule();

						$customer_id = 0;

						if (!empty($_POST['cartrule']['customer'])) {
							$customer = \backend\models\Customer::find()->where(['email' => $_POST['cartrule']['customer']])->one();
							if (!empty($customer)) {
								$customer_id = $customer['customer_id'];
							} else {
								$customer_id = 0;
							}
						}
						$cartrule->customer_id = $customer_id;
						$cartrule->date_from = $_POST['cartrule']['date_from'];
						$cartrule->date_to = $_POST['cartrule']['date_to'];
						$cartrule->description = $_POST['cartrule']['description'];
						$cartrule->quantity = $_POST['cartrule']['quantity'];
						$cartrule->quantity_per_user = $_POST['cartrule']['quantity_customer'];
						$cartrule->priority = $_POST['cartrule']['priority'];
						$cartrule->partial_use = $_POST['cartrule']['partialuse'];
						$cartrule->code = \common\components\Helpers::generateVoucherCode();
						$cartrule->minimum_amount = $_POST['cartrule']['minimum_amount'];
						$cartrule->minimum_amount_currency = 1;

						if (!empty($_POST['cartrule']['product_restriction'])) {
							$cartrule->product_restriction = 1;
						} else {
							$cartrule->product_restriction = 0;
						}
						
						$cartrule->free_shipping = $_POST['cartrule']['free_shipping'];
						$cartrule->reduction_percent = $percent;
						$cartrule->reduction_amount = $amount;
						$cartrule->reduction_currency = 1;
						$cartrule->highlight = $_POST['cartrule']['highlight'];
						$cartrule->active = $_POST['cartrule']['active'];
						$cartrule->date_add = date('Y-m-d H:i:s');
						$cartrule->date_upd = '0000-00-00 00:00:00';
						
						if(isset($_POST['cartrule']['product_category_restriction']) == 1){
							$cartrule->product_category_restriction = 1;
						}
						
						if(isset($_POST['cartrule']['brand_restriction']) == 1){
							$cartrule->brand_restriction = 1;
						}
						
						$cartrule->save();
						
						if(isset($_POST['cartrule']['brand_restriction']) == 1){
							$cartRuleBrand = new \backend\models\CartRuleBrand();
							
							$cartRuleBrand->cart_rule_id = $cartrule->cart_rule_id;
							$cartRuleBrand->brand_id = $_POST['Brand']['brand_id'];
							$cartRuleBrand->save();
						}
						
						if(isset($_POST['cartrule']['product_category_restriction']) == 1){
							$cartRuleProductCategory = new \backend\models\CartRuleProductCategory();
							
							$cartRuleProductCategory->cart_rule_id = $cartrule->cart_rule_id;
							$cartRuleProductCategory->product_category_id = $_POST['ProductCategory']['product_category_id'];
							$cartRuleProductCategory->save();
						}

						$cartrulelang = new \backend\models\CartRuleLang;
						$cartrulelang->cart_rule_id = $cartrule->cart_rule_id;
						$cartrulelang->apps_language_id = 1;
						$cartrulelang->name = $_POST['cartrule']['name'] . '-' . $i;
						$cartrulelang->source = 'bulk';
						$cartrulelang->save();
						
						if (!empty($_POST['cartrule']['product_restriction'])) {

							$cartrule_product_group = new \backend\models\CartRuleProductRuleGroup();
							$cartrule_product_group->cart_rule_id = $cartrule->cart_rule_id;
							$cartrule_product_group->quantity = $_POST['cartrule']['product_restriction_contain'];
							$cartrule_product_group->save();

							if (!empty($_POST['products'])) {
								$cartrule_product = new \backend\models\CartRuleProductRule();
								$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
								$cartrule_product->type = 'products';
								$cartrule_product->save();

								for ($i = 0; $i < count($_POST['products']); $i++) {
									$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
									$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
									$cartrule_productvalue->product_id = $_POST['products'][$i];
									$cartrule_productvalue->save();
								}
							}
							if (!empty($_POST['attributes'])) {
								$cartrule_product = new \backend\models\CartRuleProductRule();
								$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
								$cartrule_product->type = 'attributes';
								$cartrule_product->save();

								for ($i = 0; $i < count($_POST['attributes']); $i++) {
									$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
									$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
									$cartrule_productvalue->product_id = $_POST['attributes'][$i];
									$cartrule_productvalue->save();
								}
							}
							if (!empty($_POST['category'])) {
								$cartrule_product = new \backend\models\CartRuleProductRule();
								$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
								$cartrule_product->type = 'category';
								$cartrule_product->save();

								for ($i = 0; $i < count($_POST['category']); $i++) {
									$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
									$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
									$cartrule_productvalue->product_id = $_POST['category'][$i];
									$cartrule_productvalue->save();
								}
							}
							if (!empty($_POST['brands'])) {
								$cartrule_product = new \backend\models\CartRuleProductRule();
								$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
								$cartrule_product->type = 'brands';
								$cartrule_product->save();

								for ($i = 0; $i < count($_POST['brands']); $i++) {
									$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
									$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
									$cartrule_productvalue->product_id = $_POST['brands'][$i];
									$cartrule_productvalue->save();
								}
							}
						}

						$log = new \backend\models\Log();
						$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
						$log->module = Yii::$app->controller->id;
						$log->action = 'create';

						$log->id_onChanged = $cartrule->cart_rule_id;

						$log->save();
					}
				}
				
				return $this->redirect('https://thewatch.co/backend/web/cartrules/bulklist?name=' . $_POST['cartrule']['name']);
				
			} else {
			
				$cartrule = new \backend\models\CartRule();

				$customer_id = 0;

				if (!empty($_POST['cartrule']['customer'])) {
					$customer = \backend\models\Customer::find()->where(['email' => $_POST['cartrule']['customer']])->one();
					if (!empty($customer)) {
						$customer_id = $customer['customer_id'];
					} else {
						$customer_id = 0;
					}
				}
				$cartrule->customer_id = $customer_id;
				$cartrule->date_from = $_POST['cartrule']['date_from'];
				$cartrule->date_to = $_POST['cartrule']['date_to'];
				$cartrule->description = $_POST['cartrule']['description'];
				$cartrule->quantity = $_POST['cartrule']['quantity'];
				$cartrule->quantity_per_user = $_POST['cartrule']['quantity_customer'];
				$cartrule->priority = $_POST['cartrule']['priority'];
				$cartrule->partial_use = $_POST['cartrule']['partialuse'];
				$cartrule->code = $_POST['cartrule']['vouchercode'];
				$cartrule->minimum_amount = $_POST['cartrule']['minimum_amount'];
				$cartrule->minimum_amount_currency = 1;

				if (!empty($_POST['cartrule']['product_restriction'])) {
					$cartrule->product_restriction = 1;
				} else {
					$cartrule->product_restriction = 0;
				}
				
				$cartrule->free_shipping = $_POST['cartrule']['free_shipping'];
				$cartrule->reduction_percent = $percent;
				$cartrule->reduction_amount = $amount;
				$cartrule->reduction_currency = 1;
				$cartrule->highlight = $_POST['cartrule']['highlight'];
				$cartrule->active = $_POST['cartrule']['active'];
				$cartrule->date_add = date('Y-m-d H:i:s');
				$cartrule->date_upd = '0000-00-00 00:00:00';
				
				if(isset($_POST['cartrule']['product_category_restriction']) == 1){
					$cartrule->product_category_restriction = 1;
				}
				
				if(isset($_POST['cartrule']['brand_restriction']) == 1){
					$cartrule->brand_restriction = 1;
				}
				
				$cartrule->save();
				
				if(isset($_POST['cartrule']['brand_restriction']) == 1){
					$cartRuleBrand = new \backend\models\CartRuleBrand();
					
					$cartRuleBrand->cart_rule_id = $cartrule->cart_rule_id;
					$cartRuleBrand->brand_id = $_POST['Brand']['brand_id'];
					$cartRuleBrand->save();
				}
				
				if(isset($_POST['cartrule']['product_category_restriction']) == 1){
					$cartRuleProductCategory = new \backend\models\CartRuleProductCategory();
					
					$cartRuleProductCategory->cart_rule_id = $cartrule->cart_rule_id;
					$cartRuleProductCategory->product_category_id = $_POST['ProductCategory']['product_category_id'];
					$cartRuleProductCategory->save();
				}

				$cartrulelang = new \backend\models\CartRuleLang;
				$cartrulelang->cart_rule_id = $cartrule->cart_rule_id;
				$cartrulelang->apps_language_id = 1;
				$cartrulelang->name = $_POST['cartrule']['name'];
				$cartrulelang->save();
				
				if (!empty($_POST['cartrule']['product_restriction'])) {

					$cartrule_product_group = new \backend\models\CartRuleProductRuleGroup();
					$cartrule_product_group->cart_rule_id = $cartrule->cart_rule_id;
					$cartrule_product_group->quantity = $_POST['cartrule']['product_restriction_contain'];
					$cartrule_product_group->save();

					if (!empty($_POST['products'])) {
						$cartrule_product = new \backend\models\CartRuleProductRule();
						$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
						$cartrule_product->type = 'products';
						$cartrule_product->save();

						for ($i = 0; $i < count($_POST['products']); $i++) {
							$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
							$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
							$cartrule_productvalue->product_id = $_POST['products'][$i];
							$cartrule_productvalue->save();
						}
					}
					if (!empty($_POST['attributes'])) {
						$cartrule_product = new \backend\models\CartRuleProductRule();
						$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
						$cartrule_product->type = 'attributes';
						$cartrule_product->save();

						for ($i = 0; $i < count($_POST['attributes']); $i++) {
							$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
							$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
							$cartrule_productvalue->product_id = $_POST['attributes'][$i];
							$cartrule_productvalue->save();
						}
					}
					if (!empty($_POST['category'])) {
						$cartrule_product = new \backend\models\CartRuleProductRule();
						$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
						$cartrule_product->type = 'category';
						$cartrule_product->save();

						for ($i = 0; $i < count($_POST['category']); $i++) {
							$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
							$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
							$cartrule_productvalue->product_id = $_POST['category'][$i];
							$cartrule_productvalue->save();
						}
					}
					if (!empty($_POST['brands'])) {
						$cartrule_product = new \backend\models\CartRuleProductRule();
						$cartrule_product->cart_rule_product_rule_group = $cartrule_product_group->cart_rule_product_rule_group_id;
						$cartrule_product->type = 'brands';
						$cartrule_product->save();

						for ($i = 0; $i < count($_POST['brands']); $i++) {
							$cartrule_productvalue = new \backend\models\CartRuleProductRuleValue();
							$cartrule_productvalue->product_rule_id = $cartrule_product->cart_rule_product_rule_id;
							$cartrule_productvalue->product_id = $_POST['brands'][$i];
							$cartrule_productvalue->save();
						}
					}
				}

				$log = new \backend\models\Log();
				$log->fullname = Yii::$app->session->get('userInfo')['fullname'];
				$log->module = Yii::$app->controller->id;
				$log->action = 'create';

				$log->id_onChanged = $cartrule->cart_rule_id;

				$log->save();
				
				return $this->redirect('index');
			}

        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }
	
	public function actionBulklist(){
		return $this->render('bulklist');
	}

    /**
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (isset($_POST['cartrule'])) {

            $percent = 0;
            $amount = 0;

            if ($_POST['cartrule']['value'] == 'percent') {
                $percent = $_POST['cartrule']['amount'];
            } else if ($_POST['cartrule']['value'] == 'amount') {
                $amount = $_POST['cartrule']['amount'];
            }
            //
            $cartrule = \backend\models\CartRule::findOne($id);

            $customer_id = 0;

            if (!empty($_POST['cartrule']['customer'])) {
                $customer = \backend\models\Customer::find()->where(['email' => $_POST['cartrule']['customer']])->one();
                if (!empty($customer)) {
                    $customer_id = $customer['customer_id'];
                } else {
                    $customer_id = 0;
                }
            }
            $cartrule->customer_id = $customer_id;
            $cartrule->date_from = $_POST['cartrule']['date_from'];
            $cartrule->date_to = $_POST['cartrule']['date_to'];
            $cartrule->description = $_POST['cartrule']['description'];
            $cartrule->quantity = $_POST['cartrule']['quantity'];
            $cartrule->quantity_per_user = $_POST['cartrule']['quantity_customer'];
            $cartrule->priority = $_POST['cartrule']['priority'];
            $cartrule->partial_use = $_POST['cartrule']['partialuse'];
            $cartrule->code = $_POST['cartrule']['vouchercode'];
            $cartrule->minimum_amount = $_POST['cartrule']['minimum_amount'];
            $cartrule->minimum_amount_currency = 1;

            if (!empty($_POST['cartrule']['product_restriction'])) {
                $cartrule->product_restriction = 1;
            } else {
                $cartrule->product_restriction = 0;
            }

            $cartrule->free_shipping = $_POST['cartrule']['free_shipping'];
            $cartrule->reduction_percent = $percent;
            $cartrule->reduction_amount = $amount;
            $cartrule->reduction_currency = 1;
            $cartrule->highlight = $_POST['cartrule']['highlight'];
            $cartrule->active = $_POST['cartrule']['active'];
            $cartrule->date_upd = date('Y-m-d H:i:s');
            $cartrule->save();

            $cartrulelang = \backend\models\CartRuleLang::findOne($id);
            $cartrulelang->apps_language_id = 1;
            $cartrulelang->name = $_POST['cartrule']['name'];
            $cartrulelang->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'create';

            $log->id_onChanged = $cartrule->cart_rule_id;

            $log->save();

            return $this->redirect('../index');
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {

        $id = $_POST['cartrule_id'];

        $this->findModel($id)->delete();
        $cart_rule_lang = \backend\models\CartRuleLang::deleteAll(['cart_rule_id' => $id]);
        $cart_rule_product_group = \backend\models\CartRuleProductRuleGroup::find(['cart_rule_id' => $id])->one();
        $cart_rule_product = \backend\models\CartRuleProductRule::find(['cart_rule_product_rule_group' => $cart_rule_product_group['cart_rule_product_rule_group_id']])->all();

        foreach ($cart_rule_product as $row) {
            $cart_rule_product_rule_value = \backend\models\CartRuleProductRuleValue::deleteAll(['product_rule_id' => $row->cart_rule_product_rule_id]);
            $row->delete();
        }
        
        if (!empty($cart_rule_product_group)) {
            $cart_rule_product_group->deleteAll();
        }
        
        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return 1;
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\CartRule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFindcustomer() {

        $customer = \backend\models\Customer::find()->where(['like', 'email', $_GET['email']])->orWhere(['like', 'firstname', $_GET['email']])->limit(10)->all();

        $dataa = array();
        $i = 0;
        foreach ($customer as $row) {
            $dataa[$i] = $row->email;
            $i++;
        }

        return json_encode($dataa);
    }

}
