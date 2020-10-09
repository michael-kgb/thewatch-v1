<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$validtransaction = \backend\models\Orders::find()->where(['customer_id' => $model->customer_id, 'valid' => 1])->all();
$invalidtransaction = \backend\models\Orders::find()->where(['customer_id' => $model->customer_id, 'valid' => 0])->all();

$totalspent = 0;

foreach ($validtransaction as $row) {
    $totalspent = $totalspent + $row->total_product_price;
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Information about Customer: <?php echo strtoupper($model->firstname) . ' ' . strtoupper($model->lastname); ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i>Customers</a></li>
        <li><a href="#">Customers</a></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-sm-6">
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-user"></i> <?php echo strtoupper($model->firstname) . ' ' . strtoupper($model->lastname); ?> [<?php echo $model->customer_id; ?>] - <a href="mailto:<?php echo $model->email; ?>"><i class="fa fa-envelope"></i> <?php echo strtoupper($model->email); ?></a> <button type="button" class="btn btn-default pull-right" onclick="location.href = '<?php echo Yii::$app->request->baseUrl .'/customers/update/' . $model->customer_id; ?>'"><i class="fa fa-fw fa-pencil"></i> Edit</button>
                    <hr/>
                </div>
                <?php
                $gender = \backend\models\Gender::find()->where(['gender_id' => $model->gender_id, 'apps_language_id' => $model->apps_language_id])->one();
                $customer_group = \backend\models\CustomerGroup::findOne($model->customer_group_id);
                $customer_address = backend\models\CustomerAddress::find()->where(['customer_id' => $model->customer_id])->all();
                if ($model->newsletter == 0) {
                    $newsletter = "No";
                } else {
                    $newsletter = "Yes";
                }
                $age = floor((time() - strtotime($model->birthday)) / 31556926);
                ?>
                <div class="box-body">
                    <div class="col-sm-5" style="padding-bottom: 20px"><div class="pull-right">Social Title :</div></div>
                    <div class="col-sm-7" style="padding-bottom: 20px"><div class="pull-left"><?php if (!empty($gender)) echo $gender->name;
                else echo '-'; ?></div></div>
                    <div class="col-sm-5" style="padding-bottom: 20px"><div class="pull-right">Age :</div></div>
                    <div class="col-sm-7" style="padding-bottom: 20px"><div class="pull-left"><?php echo $age; ?> years old (birth date: <?php echo $model->birthday; ?>)</div></div>
                    <div class="col-sm-5" style="padding-bottom: 20px"><div class="pull-right">Registration Date :</div></div>
                    <div class="col-sm-7" style="padding-bottom: 20px"><div class="pull-left"><?php if (!empty($model->date_add)) echo $model->date_add;
                else echo '-'; ?></div></div>
                    <div class="col-sm-5" style="padding-bottom: 20px"><div class="pull-right">Newsletter :</div></div>
                    <div class="col-sm-7" style="padding-bottom: 20px"><div class="pull-left"><?php echo $newsletter; ?></div></div>
                    <div class="col-sm-5" style="padding-bottom: 20px"><div class="pull-right">Group :</div></div>
                    <div class="col-sm-7" style="padding-bottom: 20px"><div class="pull-left"><?php echo $customer_group->name; ?></div></div>
                </div><!-- /.box-body -->
            </div>
            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-sticky-note"></i> ORDERS
                    <hr/>
                </div>
                <div class="box-body">
                    <div class="alert alert-default alert-dismissable">
                        <div class="col-sm-6"><i class="fa fa-check-circle"></i> Valid orders <div class="label bg-green"><?php echo count($validtransaction); ?></div> for a total amount of Rp. <?php echo common\components\Helpers::getPriceFormat($totalspent); ?></div>
                        <div class="col-sm-6"><i class="fa fa-ban"></i> Invalid orders <div class="label bg-red"><?php echo count($invalidtransaction); ?></div></div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Total Spents</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($validtransaction as $row) {
                                $order_history = backend\models\OrderHistory::find()->where(['orders_id' => $row->orders_id])->orderBy('order_history_id DESC')->one();
                                $order_state_lang = \backend\models\OrderStateLang::find()->where(['apps_language_id' => $row->apps_language_id, 'payment_method_id' => $row->paymentmethoddetail->payment_method_id])->one();
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row->date_add)); ?></td>
                                    <td><?php echo $row->paymentmethoddetail->paymentMethod->payment_method_name; ?></td>
                                    <td><?php echo $order_state_lang->name; ?></td>
                                    <td><?php echo $row->total_cart_item; ?></td>
                                    <td><?php echo \common\components\Helpers::getPriceFormat($row->total_product_price); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div>

            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-eye"></i> VIEWED PRODUCTS (15)
                    <hr/>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Classy Glasgow</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Classy Glasgow</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Classy Glasgow</td>
                            </tr>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div>
        </div>

        <div class="col-sm-6">
            <div id="private-note" class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-comment"></i> ADD A PRIVATE NOTE
                    <hr/>
                </div>
                <div class="box-body">
                    <textarea class="form-control" id="customer-private-note"><?php echo $model->note; ?></textarea><br/><a onclick="updateCustomerPrivatenote(<?php echo $model->customer_id; ?>)" class="btn btn-default pull-right"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                </div><!-- /.box-body -->
            </div>

            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-envelope"></i> MESSAGES (0)
                    <hr/>
                </div>
                <div class="box-body">

                </div>
            </div>

            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-ticket"></i> VOUCHERS (0)
                    <hr/>
                </div>
                <div class="box-body">

                </div>
            </div>

            <div class="box box-info" style="margin-top: 20px;">
                <div class="box-header">
                    <i class="fa fa-clock-o"></i> LAST CONNECTIONS
                    <hr/>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Date</th>
                                <th>Page viewed</th>
                                <th>Total time</th>
                                <th>Origin</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2016-01-25</td>
                                <td>0</td>
                                <td></td>
                                <td>thewatch.co</td>
                                <td>127.0.0.1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div  id="customer-address" class="box box-info" style="margin-top: 20px;">
                <div class="box-header" id="total-address">
                    <i class="fa fa-map-marker"></i> ADDRESSES (<?php echo count($customer_address); ?>)
                    <hr/>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-customer-address">
                            <?php
                            $names = json_decode(file_get_contents("http://country.io/names.json"), true);

                            foreach ($customer_address as $row) {
                                $country = backend\models\Country::findOne($row->country_id);
                                ?>
                                <tr>
                                    <td><?php echo $row->company ?></td>
                                    <td><?php echo $row->firstname . ' ' . $row->lastname; ?></td>
                                    <td><?php echo $row->address1 ?></td>
                                    <td><?php echo $names[$country->iso_code]; ?></td>
                                    <td><?php echo $row->phone; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" onclick="javascript:location.href = ' <?php echo Yii::$app->request->baseUrl . '/customersaddress/update/' . $row->customer_address_id; ?>'">
                                                <i class="fa fa-fw fa-pencil"></i> Edit</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a style="cursor: pointer" onclick="deletecustomeraddress(<?php echo $row->customer_address_id; ?>)"><i class="fa fa-fw fa-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
