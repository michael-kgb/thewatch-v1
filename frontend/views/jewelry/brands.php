<section id="featured-brands">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands caption left"></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 featured-brands caption remove-padding gotham-light">JEWELRY BRANDS</div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3 featured-brands caption right"></div>
        </div>
    </div>
    <div class="container brands">
        <div class="hidden-xs row">
            <?php $i = 1; ?>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 <?php if($i != 1){ echo 'col-lg-offset-1 col-md-offset-1 col-sm-offset-1'; } ?> brand">
                        <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                            <img src="img/brands/black/<?php echo $row->brand_logo; ?>" class="img-brands">
                        </a>
                    </div>
                    <?php $i++;
                    if($i == 6) break; ?>
                <?php } ?>
           <?php } ?>
        </div>
        
        <div class="hidden-lg hidden-md hidden-sm row">
            <?php $i = 1; ?>
            <?php if (count($data) > 0) { ?>
                <?php foreach ($data as $row) { ?>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 <?php if($i != 1){ echo 'col-lg-offset-1 col-md-offset-1 col-sm-offset-1'; } ?> brand">
                        <a href="<?php echo \yii\helpers\Url::base() . '/brand/' . $row->link_rewrite; ?>">
                            <img src="img/brands/black/<?php echo $row->brand_logo; ?>" class="img-brands">
                        </a>
                    </div>
                    <?php $i++; ?>
                <?php } ?>
           <?php } ?>
        </div>
        
        <!-- <div class="row btn-brands">
            <a id="all-brands-btn" class="all-brands-btn" href="<?php echo \yii\helpers\Url::base() . '/brands'; ?>">SEMUA BRANDS</a>
        </div> -->
    </div>
</section>