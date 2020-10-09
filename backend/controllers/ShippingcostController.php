<?php

namespace backend\controllers;

use Yii;
use common\models\group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * groupController implements the CRUD actions for group model.
 */
class ShippingcostController extends Controller {

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
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {

        $data = \backend\models\CarrierCost::find()
                ->joinWith([
                    "carrier",
                    "carrierPackageDetail",
                    "district",
                ])
                ->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();
        return $this->render('index', [
                    'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single group model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $data = \backend\models\CarrierCost::find()
                ->joinWith([
                    "carrier",
                    "carrierPackageDetail",
                    "district",
                ])
                ->where(['carrier_cost_id' => $id])
                ->one();

        if (isset($_POST['CarrierCost'])) {
            $carriercost = $_POST['CarrierCost'];
            $data->day = $carriercost['day'];
            $data->price = $carriercost['price'];
            $data->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $data->carrier_cost_id;

            return $this->redirect('../index');
        } else {
            return $this->render('view', [
                        'model' => $data,
            ]);
        }
    }

    /**
     * Creates a new group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\CarrierCost();

        if (isset($_POST['CarrierCost'])) {

            try {
                $carriercost = $_POST['CarrierCost'];
                $model->district_id = $carriercost['district'];
                $model->carrier_id = $carriercost['carrier'];
                $model->price = $carriercost['price'];
                $model->day = $carriercost['day'];
                $model->carrier_package_detail_id = $carriercost['carrier_package_detail'];
                $model->active = $carriercost['status'];
                $model->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $model->carrier_cost_id;

                $log->save();

                return $this->redirect(['index']);
            } catch (Exception $ex) {
                print_r($model->getErrors());
                die();
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

    /**
     * Updates an existing group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $model->id;

            $log->save();

            return $this->redirect(['index']);
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
     * Deletes an existing group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {
        $this->findModel($_POST['id'])->delete();

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $_POST['id'];

        $log->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\CarrierCost::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheckpackage($id) {
        $package = \backend\models\CarrierPackageDetail::find()->where(['carrier_id' => $id])
                        ->joinWith([
                            "carrierPackage"
                        ])->all();

        $text = "";

        foreach ($package as $row) {
            $text = $text . '<option value="' . $row->carrier_package_detail_id . '">' . $row->carrierPackage->carrier_package_name . '</option>';
        }

        return $text;
    }

    public function actionCheckprovince($id) {
        $province = \backend\models\Province::find()->where(['country_id' => $id])->all();

        $text = "";
        if (!empty($province)) {
            foreach ($province as $row) {
                $text = $text . '<option value="' . $row->province_id . '">' . $row->name . '</option>';
            }
        } else {
            $text = '<option value="0">Please select</option>';
        }

        return $text;
    }

    public function actionCheckstate($id) {
        $state = \backend\models\State::find()->where(['province_id' => $id])->all();

        $text = "";
        if (!empty($state)) {
            foreach ($state as $row) {
                $text = $text . '<option value="' . $row->state_id . '">' . $row->name . '</option>';
            }
        } else {
            $text = '<option value="0">Please select</option>';
        }

        return $text;
    }

    public function actionCheckdistrict($id) {
        $district = \backend\models\District::find()->where(['state_id' => $id])->all();

        $text = "";
        if (!empty($district)) {
            foreach ($district as $row) {
                $text = $text . '<option value="' . $row->district_id . '">' . $row->name . '</option>';
            }
        } else {
            $text = '<option value="0">Please select</option>';
        }

        return $text;
    }

    public function actionGetallshippingcost($draw) {
        $total_shippingcost = \backend\models\CarrierCost::find()->all();

        $table = array('carrier_cost_id', 'carrier.name', 'district.name', 'carrier_cost_id', 'price', 'carrier_cost_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];

        $shippingcost = \backend\models\CarrierCost::find()->joinWith(['carrier', 'district'])->where(['like', 'carrier.name', $_GET['search']['value']])->orWhere(['like', 'district.name', $_GET['search']['value']])->orderBy($order)->offset($_GET['start'])->limit($_GET['length'])->all();
        $data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . count($total_shippingcost) . ',
            "recordsFiltered": ' . count($total_shippingcost) . ',
            "data": ';

        $columns = array();
        $numbering = $_GET['start'];

        if (!empty($shippingcost)) {
            foreach ($shippingcost as $row) {
                if($row->price != '-'){
                    $price = \common\components\Helpers::getPriceFormat($row->price);
                }
                else{
                    $price = '-';
                }
                $numbering++;
                $button = '<div class="btn-group">'
                        . '<button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->carrier_cost_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>'
                        . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
                        . '<ul class="dropdown-menu" role="menu">'
                        . '<li><a href="update/' . $row->carrier_cost_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>'
                        . '<li><a style="cursor: pointer;" onclick="deletecustomer(' . $row->carrier_cost_id . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>'
                        . '</ul>'
                        . '</div>';

                $customer_array = array($numbering, $row->carrier->name, $row->district->name, $row->carrierPackageDetail->carrierPackage->carrier_package_name, $price, $button);
                array_push($columns, $customer_array);
            }
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

}
