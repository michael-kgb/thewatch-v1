<section id="product">
    <div class="hidden-sm container product-box clearleft">
    <div class="row">
        <!-- Filter Desktop -->
        <?php
            echo Yii::$app->view->renderFile('@app/views/promo/filter.php', array(
            "feature" => $feature,
            "brands" => $brands,
            "brands_selection" => $brands_selection,
            "types_selection" => $types_selection,
            "genders_selection" => $genders_selection,
            "size_selection" => $size_selection,
            "bandwidth_selection" => $bandwidth_selection,
            "movements_selection" => $movements_selection,
            "waters_selection" => $waters_selection,
            "limit"=>$limit,
                "sortby"=>$sortby,
            ));
        ?>
        <div class="col-lg-10 col-md-10 col-sm-10 ptop5 pbottom3">
            <center><span class="gotham-light fsize-1">PRODUCT NOT FOUND</span></center>
        </div>
    </div>
    </div>
</section>