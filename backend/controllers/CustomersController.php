<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * groupController implements the CRUD actions for group model.
 */
class CustomersController extends Controller {

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
        $data = \backend\models\Customer::find()->all();
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

        if ($model->load(Yii::$app->request->post())) {
            $data = $_POST['Customer'];
            try {
                $checkemail = \backend\models\Customer::find()->where(['email' => $data['email']])->one();

                if (!empty($checkemail)) {
                    return $this->render('create', [
                                'model' => $model, 'error' => "Duplicate email"
                    ]);
                }

                if (isset($_POST['Customer']['active']) == 1) {
                    $active = 1;
                } else {
                    $active = 0;
                }
                if (isset($_POST['Customer']['newsletter']) == 1) {
                    $newsletter = 1;
                } else {
                    $newsletter = 0;
                }

                $customer = new \backend\models\Customer();
                $gender = \backend\models\Gender::find()->where(['name' => $data['gender']])->one();
                $customer->gender_id = $gender->gender_id;
                $customer->customer_group_id = $data['customer_group'];
                $customer->apps_language_id = $gender->apps_language_id;
                $customer->firstname = $data['firstname'];
                $customer->lastname = $data['lastname'];
                $customer->email = $data['email'];
                $customer->passwd = md5($data['password']);
                $customer->birthday = $data['birthday_year'] . '-' . $data['birthday_month'] . '-' . $data['birthday_day'];
                $customer->active = $active;
                $customer->newsletter = $newsletter;
                $customer->date_add = date("Y-m-d H:i:s");
                $customer->date_upd = "0000-00-00 00:00:00";
                $customer->save();

                $log = new \backend\models\Log();
                $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
                $log->module = Yii::$app->controller->id;
                $log->action = 'create';

                $log->id_onChanged = $customer->customer_id;

                $log->save();

                return $this->redirect('index');
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $data = $_POST['Customer'];
            if (isset($_POST['Customer']['active']) == 1) {
                $active = 1;
            } else {
                $active = 0;
            }
            if (isset($_POST['Customer']['newsletter']) == 1) {
                $newsletter = 1;
            } else {
                $newsletter = 0;
            }

            $customer = \backend\models\Customer::findOne($id);
            $customer->gender_id = $data['gender'];
            $customer->firstname = $data['firstname'];
            $customer->lastname = $data['lastname'];
            $customer->email = $data['email'];
            $customer->birthday = $data['birthday_year'] . '-' . $data['birthday_month'] . '-' . $data['birthday_day'];
            $customer->active = $active;
            $customer->newsletter = $newsletter;
            $customer->customer_group_id = $data['customer_group'];
            $customer->save();

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect(['view', 'id' => $model->customer_id]);
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
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        $customeraddress = \backend\models\CustomerAddress::deleteAll(['customer_id' => $id]);

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
        if (($model = \backend\models\Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateprivatenote($id) {
        $privatenote = $_POST['privatenote'];

        $customer = \backend\models\Customer::findOne($id);
        $customer->note = $privatenote;
        $customer->save();
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

    public function actionGetallcustomers($draw) {
        $total_customer = \backend\models\Customer::find()->all();
        $total_find = \backend\models\Customer::find()->where(['like', 'firstname', $_GET['search']['value']])->orWhere(['like', 'lastname', $_GET['search']['value']])->orWhere(['like', 'email', $_GET['search']['value']])->all();

        $table = array('customer_id', 'gender_id', 'firstname', 'lastname', 'email', 'active', 'newsletter', 'customer_id');
        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];

        $customer = \backend\models\Customer::find()->where(['like', 'firstname', $_GET['search']['value']])->orWhere(['like', 'lastname', $_GET['search']['value']])->orWhere(['like', 'email', $_GET['search']['value']])->orderBy($order)->offset($_GET['start'])->limit($_GET['length'])->all();
        $data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . count($total_customer) . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';

        $columns = array();
        $numbering = $_GET['start'];

        foreach ($customer as $row) {
            $gender = $row->gender_id != 0 ? $row->gender->name : '-';
            $active = $row->active != 0 ? 'Active' : 'Inactive';
            $newsletter = $row->newsletter != 0 ? 'Yes' : 'No';
            $numbering++;
            $button = '<div class="btn-group">'
                    . '<button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->customer_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>'
                    . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
                    . '<ul class="dropdown-menu" role="menu">'
                    . '<li><a href="update/' . $row->customer_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>'
                    . '<li><a style="cursor: pointer;" onclick="deletecustomer(' . $row->customer_id . ')"><i class="fa fa-fw fa-trash"></i> Delete</a></li>'
                    . '</ul>'
                    . '</div>';

            $customer_array = array($numbering, $gender, $row->firstname, $row->lastname, $row->email, $active, $newsletter, $button);
            array_push($columns, $customer_array);
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

}
