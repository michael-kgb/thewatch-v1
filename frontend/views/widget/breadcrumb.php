<section id="breadcrumb">
    <div class="container breadcrumb-page">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page">
                <?php 
                    $breadcrumbs = $this->context->breadcrumb;
                    if(count($breadcrumbs) > 0){
                        $i = 0;
                        $len = count($breadcrumbs);
                        foreach($breadcrumbs as $breadcrumb) {
                ?>
                <a href="#"><?php echo strtoupper(str_replace('-', ' ', $breadcrumb)); ?></a>
                <?php if ($i != $len - 1) { ?>
                    <span>/</span>
                <?php } ?>
                <?php $i++; ?>
                        <?php } ?>
                    <?php } ?>
            </div>
        </div>
    </div>
</section>