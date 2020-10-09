<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Homebanner */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="content-header">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                    <li><a href="#sendlist" data-toggle="tab">Send List</a></li>
                </ul>
                <div class="tab-content">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="tab-pane active" id="information">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Newsletter[subject]" id="inputEmail3" placeholder="Name" required="true">
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new Poster</label>
                                <div class="col-sm-3">
                                    <input type="file" name="Newsletter[posterImage]" id="Newsletter[posterImage]" class="user-image" />
                                </div>
                                <div class="col-sm-7">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Poster Url</label>
                                    <input style="width: 250px;" type="text" name="Newsletter[posterImageUrl]" id="Newsletter[posterImageUrl]" class="user-image" />
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new Brand Poster</label>
                                <div class="col-sm-3">
                                    <input type="file" name="Newsletter[brandPoster1]" id="Newsletter[brandPoster1]" class="user-image" />
                                </div>
                                <div class="col-sm-7">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Brand Url</label>
                                    <input style="width: 250px;" type="text" name="Newsletter[brandPosterUrl1]" id="Newsletter[brandPosterUrl1]" class="user-image" />
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new Brand Poster</label>
                                <div class="col-sm-3">
                                    <input type="file" name="Newsletter[brandPoster2]" id="Newsletter[brandPoster2]" class="user-image" />
                                </div>
                                <div class="col-sm-7">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Brand Url</label>
                                    <input style="width: 250px;" type="text" name="Newsletter[brandPosterUrl2]" id="Newsletter[brandPosterUrl2]" class="user-image" />
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product Selection</label>
                                <div class="box-body">
                                    <div class="col-sm-10">
                                        <select multiple="multiple" class="productItems" name="productItems[]" id="113multiselect">
                                            <?php 
                                            $productRelated = \backend\models\Product::getAllProducts();
                                            ?>
                                            <?php if (count($productRelated) > 0) { ?>
                                                <?php foreach ($productRelated as $product) { ?>
                                                    <option value="<?php echo $product->product_id; ?>"><?php echo $product->productDetail->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Add a new Journal Poster</label>
                                <div class="col-sm-3">
                                    <input type="file" name="Newsletter[journalPoster]" id="Newsletter[journalPoster]" class="user-image" />
                                </div>
                                <div class="col-sm-7">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Journal Url</label>
                                    <input style="width: 250px;" type="text" name="Newsletter[journalPosterUrl]" id="Newsletter[journalPosterUrl]" class="user-image" />
                                </div>
                            </div>
<!--                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Shop Social Selection</label>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <div class="box-body">
                                    <table id="data-instagram-selection" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="1%"></th>
                                                <th width="1%">No</th>
                                                <th width="5%">Image</th>
                                                <th width="15%">Caption</th>
                                                <th width="5%">Total Like</th>
                                                <th width="5%">Total Comment</th>
                                                <th width="5%">Post Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php // $instagram = \backend\models\Instagram::find()->orderBy('post_date DESC')->limit(50)->all(); ?>
                                            <?php // if(count($instagram) > 0){ ?>
                                            <?php // $i = 1; ?>
                                            <?php // foreach ($instagram as $data) { ?>
                                            <tr>
                                                <td></td>
                                                <td><?php // echo $i; ?></td>
                                                <td><img src="<?php // echo $data->image_file; ?>" class="img-responsive"></td>
                                                <td><?php // echo $data->image_caption; ?></td>
                                                <td><?php // echo $data->image_like_count; ?></td>
                                                <td><?php // echo $data->image_comment_count; ?></td>
                                                <td><?php // echo $data->post_date; ?></td>
                                            </tr>
                                            <?php // $i++; ?>
                                            <?php // } ?>
                                            <?php // } ?>
                                        </tbody>
                                    </table>
                                </div> /.box-body 
                            </div>-->
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        Send Newsletter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="sendlist">
                        <div class="box-body">
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Sending List</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="send_all"> Send All in the list<br/>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">Sending List</label>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <div class="col-sm-10">
                                    <div class="box-body">
                                        <table id="data-list-email" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="1%">No</th>
                                                    <th width="1%">Email</th>
                                                    <th width="1%">Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="form-group" style="padding: 2% 0 3% 0;">
                                <label for="inputEmail3" class="col-sm-2 control-label">
                                    Spesific List <br>
                                    <i>(use comma separated for multiple list)</i>
                                </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="send_spesific" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1" style="margin-top: 5%; margin-left: 2%;">
                                    <button onclick="window.history.back();" type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                </div>
                                <div class="col-sm-1" style="margin-top: 5%; float: right;">
                                    <button type="submit" name="submitAddproduct" class="btn btn-default pull-right">
                                        Send Newsletter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div><!-- /tab-content -->
        </div><!-- /tabbable -->
    </div><!-- /col -->
</section>