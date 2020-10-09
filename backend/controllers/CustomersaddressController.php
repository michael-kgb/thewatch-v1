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
class CustomersaddressController extends Controller {

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
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all group models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\CustomerAddress::find()->joinWith([
                    "country",
                    "state"
                ])->all();
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
        $model = \backend\models\CustomerAddress::find()->joinWith([
                    "country",
                    "province",
                    "state",
                    "district"
                ])->where(['customer_address_id' => $id])->one();

        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new \backend\models\Customer();

        if (isset($_POST['Customeraddress'])) {
            $data = $_POST['Customeraddress'];

            try {
                $customeraddress = new \backend\models\CustomerAddress();
                $customeraddress->customer_id = $data['customer_id'];
                $customeraddress->firstname = $data['firstname'];
                $customeraddress->lastname = $data['lastname'];
                $customeraddress->company = $data['company'];
                $customeraddress->address1 = $data['address1'];
                $customeraddress->address2 = $data['address2'];
                $customeraddress->country_id = $data['country'];
                $customeraddress->province_id = $data['province'];
                $customeraddress->state_id = $data['state'];
                $customeraddress->district_id = $data['district'];
                $customeraddress->postcode = $data['postcode'];
                $customeraddress->phone = $data['phone'];
                $customeraddress->phone_mobile = $data['phone_mobile'];
                $customeraddress->other = $data['other'];
                $customeraddress->save();
                
                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $customeraddress->customer_address_id;

                $log->save();

                return $this->redirect('index');
            } catch (Exception $ex) {
                print_r($customeraddress->getErrors());
                die();
            }
        } else {

            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['add_access'] != '1') {
                return $this->redirect('../permissionscheck');
            }

            return $this->render('create', [
                        'model' => $model, 'error' => ""
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
        $model = \backend\models\CustomerAddress::findOne($id);

        if (isset($_POST['Customeraddress'])) {

            $data = $_POST['Customeraddress'];

            $customeraddress = \backend\models\CustomerAddress::findOne($id);
            $customeraddress->firstname = $data['firstname'];
            $customeraddress->lastname = $data['lastname'];
            $customeraddress->company = $data['company'];
            $customeraddress->address1 = $data['address1'];
            $customeraddress->address2 = $data['address2'];
            $customeraddress->country_id = $data['country'];
            $customeraddress->province_id = $data['province'];
            $customeraddress->state_id = $data['state'];
            $customeraddress->district_id = $data['district'];
            $customeraddress->postcode = $data['postcode'];
            $customeraddress->phone = $data['phone'];
            $customeraddress->phone_mobile = $data['phone_mobile'];
            $customeraddress->other = $data['other'];
            $customeraddress->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update address';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect(['view', 'id' => $model->customer_address_id]);
        } else {

            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update_address', ['model' => $model]);
        }
    }

    public function actionDelete($id) {
        $this->findModel($id)->delete();

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

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
        if (($model = \backend\models\CustomerAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeletecustomeraddress() {
        $customer_address_id = $_POST['customer_address'];
        $customer_address = \backend\models\CustomerAddress::find()->where(['customer_address_id' => $customer_address_id])->one();
        $customer_id = $customer_address->customer_id;
        $customer_address->delete();

        $customeraddress = \backend\models\CustomerAddress::find()->where(['customer_id' => $customer_id])->all();
        $names = json_decode(file_get_contents("http://country.io/names.json"), true);
        $table = "";

        $totaladdress = '<i class="fa fa-map-marker"></i> ADDRESSES (' . count($customeraddress) . ')<hr/>';

        foreach ($customeraddress as $row) {
            $country = backend\models\Country::findOne($row->country_id);

            $table = $table . '<tr><td>' . $row->company . '</td>'
                    . '<td>' . $row->firstname . ' ' . $row->lastname . '</td>'
                    . '<td>' . $row->address1 . '</td>'
                    . '<td>' . $names[$country->iso_code] . '</td>'
                    . '<td>' . $row->phone . '</td><td><div class="btn-group"><button type="button" class="btn btn-default" onclick="'
                    . "javascript:location.href = '/twcnew/backend/web/customers/updateaddress/" . $row->customer_address_id
                    . "'" . '">'
                    . '<i class="fa fa-fw fa-pencil"></i> Edit</button><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button><ul class="dropdown-menu" role="menu"><li>'
                    . '<a onclick="deletecustomeraddress(' . $row->customer_address_id . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li></ul></div></td></tr>';
        }

        $text = array($totaladdress, $table);
        return json_encode($text);
    }

    public function actionCheckprovince($id) {
        $province = \backend\models\Province::find()->where(['country_id' => $id])->all();

        $select = "";
        if (!empty($province)) {
            foreach ($province as $row) {
                $select = $select . '<option value="' . $row->province_id . '">' . $row->name . '</option>';
            }
        } else {
            $select = '<option value="0">Please select</option>';
        }
        return $select;
    }

    public function actionCheckstate($id) {
        $state = \backend\models\State::find()->where(['province_id' => $id])->all();

        $select = "";
        if (!empty($state)) {
            foreach ($state as $row) {
                $select = $select . '<option value="' . $row->state_id . '">' . $row->name . '</option>';
            }
        } else {
            $select = '<option value="0">Please select</option>';
        }
        return $select;
    }

    public function actionCheckdistrict($id) {
        $district = \backend\models\District::find()->where(['state_id' => $id])->all();

        $select = "";
        if (!empty($district)) {
            foreach ($district as $row) {
                $select = $select . '<option value="' . $row->district_id . '">' . $row->name . '</option>';
            }
        } else {
            $select = '<option value="0">Please select</option>';
        }
        return $select;
    }

    public function actionSearchcustomer() {
        $customer = \backend\models\Customer::find()->where(['email' => $_POST['email']])->one();
        
        if(empty($customer)){
            $text = array(0,0,0,0);
        }
        else{
            $text = array(1, $customer->customer_id, $customer->firstname, $customer->lastname);
        }
        
        return json_encode($text);
    }

}
