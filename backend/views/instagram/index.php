<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Instagram
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="glyphicon glyphicon-tags"></i>Blog</a></li>
        <li><a href="#">Instagram</a></li>
    </ol>
</section>

<section class="content">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-6">
                    <div class="box box-info collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fetch all post</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <button class="btn btn-info" onclick="fetchallinstagram()">Fetch All Post</button>
                            <button class="btn btn-info" onclick="fetchallinstagramcomment()">Fetch All Comment</button>
                            <button class="btn btn-info" onclick="fetchallinstagramlike()">Fetch All Like</button>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="col-sm-6">
                    <div class="box box-info collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fetch post by count</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-sm-3">
                                <button class="btn btn-info form-control" onclick="fetchallinstagrambycount()">Fetch Post</button>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="count-post" value="0"/>
                            </div>
<!--                            <div class="clearfix"></div>
                            <div class="col-sm-3" style="margin-top: 30px">
                                <button class="btn btn-info form-control">Fetch Post</button>
                            </div>
                            <div class="col-sm-9" style="margin-top: 30px">
                                <input type="text" class="form-control"/>
                            </div>-->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
                <div class="clearfix"></div>
                <div class="box" style="margin-top: 20px;">
                    <div class="box-body">
                        <table id="data-instagram" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="5%">Image</th>
                                    <th width="15%">Caption</th>
                                    <th width="5%">Total Like</th>
                                    <th width="5%">Total Comment</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">Post Date</th>
                                    <th width="5%">Action</th>
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
</section>

<?php echo $this->render('/layouts/log', [ 'module' => Yii::$app->controller->id]); ?>