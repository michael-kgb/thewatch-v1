
<!-- Main content -->
<section class="content">
	<h1>Manage Products</h1>
    <br>
	<div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter Product</h3>
                </div>
                
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12" style="padding-left: 0; margin-bottom: 3%;">
                                        <label for="exampleInputEmail1">Filter By Category :</label>
                                    </div>
                                    <label for="exampleInputEmail1">Category</label>
                                    <select class="form-control" id="product_category_id" name="product_category_id">
                                        <option value="0">Please select</option>
                                        <?php
                                        $productCategory = \backend\models\ProductCategory::find()->all();
                                        foreach ($productCategory as $row) {
                                            ?>
                                            <option value="<?php echo $row->product_category_id; ?>"><?php echo $row->product_category_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brands</label>
                                    <select class="form-control" id="product-brands_brand_id" name="brands_brand_id" onchange="checkcollection()" required>
                                        <option value="0">Please select</option>
                                        <?php
                                        $brands = \backend\models\Brands::find()->orderBy('brand_name')->all();
                                        foreach ($brands as $row) {
                                            ?>
                                            <option value="<?php echo $row->brand_id; ?>"><?php echo $row->brand_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Collections</label>
                                    <select class="form-control" id="product-brands_brand_collection_id" name="brands_collection_id">
                                        <option value="">Please select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Filter By Promotion :</label>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 5%;">
                                        <div class="col-md-4" style="padding-left: 0; padding-right: 0;">
                                            <label for="exampleInputEmail1">Discount Type :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="radio" id="discountTypePercent" name="SpesificPrice[value]" onclick="openvalue('percent')" value="percent"> Percent(%)<br>
                                            <input type="radio" id="discountTypeAmount" name="SpesificPrice[value]" onclick="openvalue('amount')" value="amount"> Amount<br>
                                            <input type="radio" id="discountTypeAll" name="SpesificPrice[value]" onclick="openvalue('all')" value="all">All Discount Type<br>
                                            <input type="radio" name="SpesificPrice[value]" onclick="openvalue('none')" value="none" checked="">None<br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group" style="padding: 2% 0px 3%; display: none;" id="disc-input">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Value</label>
                                        <div class="col-sm-10">
                                            <div class="input-group margin" style="margin: 0px;">
                                                <span class="input-group-addon" id="disc-type"></span>
                                                <input type="text" id="DiscountValue" class="form-control" name="SpesificPrice[amount]" value="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" style="padding: 6% 0 3% 0;">
                                        <label for="inputEmail3" class="col-sm-12 control-label">Discount Periode :</label>
                                        <div class="col-sm-12" style="margin-bottom: 5%;margin-top: 5%;">
                                            <div class="col-sm-3">
                                                <label for="exampleInputEmail1">From</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                                    <input type="text" class="form-control" placeholder="click to set date" id="example1" name="FromDateDiscount" value="">
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <label for="exampleInputEmail1">To</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group margin" id="datetimepicker2" style="margin: 0px;">
                                                    <input type="text" class="form-control" placeholder="click to set date" id="example2" name="ToDateDiscount" value="">
                                                    <!--<input type="text" class="form-control" name="cartrule[date_to]" required>-->
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Filter By Price :</label>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 5%;">
                                            <label for="exampleInputEmail1">Price Range :</label>
                                        <div class="col-md-12" style="margin-top: 5%;">
                                            <div class="col-sm-3">
                                                <label for="exampleInputEmail1">From</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                                    <input type="text" id="FilterPriceFrom" class="form-control" name="Filter[from_price]" value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="margin-top: 5%;">
                                            <div class="col-sm-3">
                                                <label for="exampleInputEmail1">To</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group margin" id="datetimepicker1" style="margin: 0px;">
                                                    <input type="text" id="FilterPriceTo" class="form-control" name="Filter[to_price]" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12" style="margin-top: 5%;">
                                        <label for="exampleInputEmail1">Export :</label>
                                    </div>
									<div class="col-sm-12" style="margin-bottom: 5%;margin-top: 5%;">
										<div class="col-sm-3">
											<label for="exampleInputEmail1">Format</label>
										</div>
										<div class="col-sm-9">
											<select class="form-control" id="export_to" name="export_to">
												<option value="">Please select</option>
												<option value="Excel">Excel</option>
											</select>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" id="filterBtnProduct" class="btn btn-primary pull-right">Submit</button>
                    </div>
            </div>
        </div>
    </div>
	
	<div class="row">
		<div class="col-xs-12">
			<?php
			if ($add_access == 1) {
				?>
				<button class="btn btn-info" onclick="location.href = '<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/products/create'">Create New Product</button>
				<?php
			}
			?>
			<div class="box" style="margin-top: 20px;">
				<div class="box-body">
					<table id="data-products" class="table table-responsive table-bordered table-striped">
						<thead>
							<tr>
                                <th>No</th>
                                <th width="10%">Image</th>
                                <th>SKU Number</th>
                                <th>Name</th>
                                <th>Brand Name</th>
                                <th>Brand Id</th>
                                <th>Brand Collection</th>
                                <th>Brands Collection Id</th>
                                <th>Category</th>
                                <th>Product Category Id</th>
                                <th>Price</th>
                                <th>Filter Discount</th>
                                <th>From Date Discount</th>
                                <th>To Date Discount</th>
                                <th>Filter Price From</th>
                                <th>Filter Price To</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->
