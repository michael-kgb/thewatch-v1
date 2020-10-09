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

<script>
    var likecommentss = <?php echo $likecomments; ?>;
    var likecomments = [];

    for (i = 0; i < likecommentss.length; i++) {
        likecomments[i] = likecommentss[i].split(",");
    }
    var obj = [];
    for (i = 0; i < likecomments.length; i++) {
        obj[i] = {y: likecomments[i][0], item1: likecomments[i][1], item2: likecomments[i][2]};
    }
    likecomments = [obj[0], obj[1], obj[2], obj[3], obj[4], obj[5], obj[6]];
    
    var tagss = <?php echo $tags; ?>;
    var tags = [];

    for (i = 0; i < tagss.length; i++) {
        tags[i] = tagss[i].split(",");
    }
    
    var obj = [];
    for (i = 0; i < tags.length; i++) {
        obj[i] = {y: tags[i][0], a: tags[i][1]};
    }
    
    tags = [
            obj[0],
            obj[1],
            obj[2],
            obj[3],
            obj[4],
            
        ];

</script>


<section class="content">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header">
                        <b>Likes & Comments</b>
                    </div>
                    <div class="box-body">
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>    
                    </div>
                </div>
            </div><!-- /.col -->

            <div class="col-xs-6">
                <div class="box box-info">
                    <div class="box-header">
                        <b>Most used hashtag</b>
                    </div>
                    <div class="box-body">
                        <div class="chart" id="bar-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</section>
