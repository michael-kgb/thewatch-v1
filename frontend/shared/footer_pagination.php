<section id="all-product-footer">
    <div class="container product-box">
        <div class="row font-paging">
            <?php
            if(!isset($_GET['limit'])){
                $limit = 20;
                $total_page = ceil($count / $limit);
            }else{
                $total_page = ceil($count / $limit);
            }

            if(!isset($_GET['page'])){
                $current = 1;
            }else{
                $current = $_GET['page'];
            }
            ?>

            <?php
                
                echo Yii::$app->view->renderFile('@app/views/brands/page_number_custom.php', array(
                    "current" => $current,
                    "breadcrumbs" => $breadcrumbs,
                    "total_page" => $total_page,
                    "limit" => $limit,
                    "params"=> $params,
                    "sortby"=> $sortby,
                    "currentAc"=>$currentAc,
                ));
            ?>
        </div>

    </div>
    <hr>
    <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright" style="text-align: center;">
        <a href="#" class="scrolls" style="color:#a8a9ad;">TOP</a>
    </div>
</section>

<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" class="scrollup"></a>