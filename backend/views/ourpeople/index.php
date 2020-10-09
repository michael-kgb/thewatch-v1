<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Our People 
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
      <li><a href="#">Our People Setting</a></li>
    </ol>
</section>

<section class="content">
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info" onclick="location.href='<?php echo Yii::$app->getUrlManager()->getBaseUrl(); ?>/ourpeople/create'">Add New</button>
          <div class="box" style="margin-top: 20px;">
            <div class="box-body">
              <table id="homebanner" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Product List</th>
					<th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach($data as $row){ ?>
                        <?php 
                            echo '<tr>';
                            echo '<td>'; 
                            echo $no;
                            echo '</td>';
                            echo '<td>'; 
                            echo '<img width="200" src="/frontend/web/img/ourpeople/'.$row->our_people_profile_picture.'">';
                            echo '</td>';
                            echo '<td>'; 
                            echo $row->our_people_name;
                            echo '</td>';
                            echo '<td>'; 
                            $products = '';
                            $productList = \backend\models\OurPeopleProduct::findAll(['our_people_id' => $row->our_people_id]);
                            if(count($productList) > 0){
                                $i = 1;
                                foreach($productList as $product){
                                    if($i != 1){
                                        $products .= ' , ';
                                    }
                                    $products .= $product->product->productDetail->name;
                                    $i++;
                                }
                            }
                            echo $products;
                            echo '</td>';
							echo '<td>';
							echo $row->our_people_status === 0 ? 'Inactive' : 'Active';
							echo '</td>';
                            echo '<td>'; 
                            echo '<div class="btn-group">'
                                . '<a href="' . \yii\helpers\Url::base() . '/ourpeople/view/' . $row->our_people_id . '" class="btn btn-default"><i class="fa fa-fw fa-search"></i> Preview</a>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    <li><a href="' . \yii\helpers\Url::base() . '/ourpeople/update/' . $row->our_people_id . '"><i class="fa fa-fw fa-edit"></i> Edit</a></li>
                                    <li><a href="' . \yii\helpers\Url::base() . '/ourpeople/delete/' . $row->our_people_id . '"><i class="fa fa-fw fa-trash"></i> Delete</a></li>';
                            echo '</td>';
                            echo '</tr>';
                            $no++;
                        ?>
                    <?php } ?>
                </tbody>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
</section>