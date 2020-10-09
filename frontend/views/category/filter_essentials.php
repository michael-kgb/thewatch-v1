<?php
$params = ''; 
    
if(isset($_GET['sort'])){
    $params = 'sort=' . $_GET['sort'];
}

if(isset($_GET['brands'])){
    $params = $params . '&brands=' . $_GET['brands'];
    $brands_selection = explode('--', $_GET['brands']);
}

if(isset($_GET['price'])){
    $params = $params . '&price=' . $_GET['price'];
    $price_selection = explode('--', $_GET['price']);
}

if(isset($_GET['gender'])){
    $params = $params . '&gender=' . $_GET['gender'];
    $genders_selection = explode('--', $_GET['gender']);
}

if(isset($_GET['category'])){
    $params = $params . '&category=' . $_GET['category'];
}

if(isset($_GET['type'])){
    $params = $params . '&type=' . $_GET['type'];
    $types_selection = explode('--', $_GET['type']);
}

if(isset($_GET['movement'])){
    $params = $params . '&movement=' . $_GET['movement'];
    $movements_selection = explode('--', $_GET['movement']);
}

if(isset($_GET['bandwidth'])){
    $params = $params . '&bandwidth=' . $_GET['bandwidth'];
    $bandwidth_selection = explode('--', $_GET['bandwidth']);
}

if(isset($_GET['water'])){
    $params = $params . '&water=' . $_GET['water'];
    $waters_selection = explode('--', $_GET['water']);
}

?>

<section id="breadcrumb">
    <div class="container breadcrumb-page">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 breadcrumb-page clearleft clearright">
                <?php 
                    // if user filter something
                    if(isset($_GET['brands']) && isset($_GET['sort'])){ 
                ?>
                <div class="fleft clearleft pright2 hidden-xs hidden-sm hidden-md">SHOW</div>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page=1&limit=20'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?>">20</span></a>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page=1&limit=40'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?>">40</span></a>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params . '&page=1&limit=60'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?>">60</span></a>
                <?php } else { ?>
                <div class="fleft clearleft pright2 hidden-xs hidden-sm hidden-md">SHOW</div>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?page=1&limit=20'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo!isset($_GET['limit']) || $_GET['limit'] == 20 ? 'medium' : 'light'; ?>">20</span></a>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?page=1&limit=40'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 40 ? 'medium' : 'light'; ?>">40</span></a>
                <a href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?page=1&limit=60'; ?>" class="fleft pright2 hidden-xs hidden-sm hidden-md"><span class="gotham-<?php echo isset($_GET['limit']) && $_GET['limit'] == 60 ? 'medium' : 'light'; ?>">60</span></a>
                <?php } ?>
                <?php 
                    $breadcrumbs = $this->context->breadcrumb;
                    if(count($breadcrumbs) > 0){
                        $i = 0;
                        $len = count($breadcrumbs);
                        foreach($breadcrumbs as $breadcrumb) {
                ?>
                <a href="#" <?php echo $i == 0 ? 'class="pleft7 remove-padding"' : ''; ?>><?php echo strtoupper(str_replace('-', ' ', $breadcrumb)); ?></a>
                <?php if ($i != $len - 1) { ?>
                    <span>/</span>
                <?php } ?>
                <?php $i++; ?>
                        <?php } ?>
                    <?php } ?>
                <a href="#" class="filter hidden-xs hidden-sm hidden-md" id="filter">
                    <span class="text-filter">FILTER</span>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-white.png" id="down-white" style="display: inline;padding-right: 10%;float: right;padding-top: 6%;">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/down-black.png" id="down-black" style="display: none;padding-right: 10%;float: right;padding-top: 6%;">
                </a>
                    <br>
                <div class="arrow-filter-all-product" id="arrow-filter"></div>
                <div class="hidden-xs filter-box-all-product" id="box-filter">
                <div class="row box-parent">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-4 filter-parent right">
                            <div class="radio-btn">
                                <input type="radio" value="all-product" id="rc1" name="sort" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'all-product' ? "checked" : ""; ?> <?php echo !isset($_GET['sort']) ? "checked" : ""; ?>>
                                <label for="rc1" onclick="">ALL PRODUCTS</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent center">
                            <div class="radio-btn">
                                <input type="radio" value="new-arrival" id="rc2" name="sort" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'new-arrival' ? "checked" : ""; ?>>
                                <label for="rc2" onclick="">NEW ARRIVAL</label>
                            </div>
                        </div>
                        <div class="col-lg-4 filter-parent left">
                            <div class="radio-btn">
                                <input type="radio" value="sale" id="rc3" name="sort" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'sale' ? "checked" : ""; ?>>
                                <label for="rc3" onclick="">SALE</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="filter-brand title left brand">BRAND</div>
                            <div id="ex3" class="col-lg-12 filter-parent brand left scroll-custom" style="overflow:scroll;overflow-x: hidden;">
                                <?php
                                $category = backend\models\ProductCategory::findOne(['product_category_name' => $category]);
                                $brands = \backend\models\ProductCategoryBrands::find()
                                    ->joinWith([
                                        "brands"
                                    ])
                                    ->orderBy('brands.brand_name ASC')
                                    ->where(['product_category_category_id' => $category->product_category_id])
                                    ->all();
                                $no = 4;
                                
                                foreach ($brands as $row) {
                                    ?>
                                    <div class="checkbox-btn lspace2">
                                        <?php  
                                        $checked = FALSE;
                                        foreach($brands_selection as $brand){
                                            if($row->brands->link_rewrite == $brand){
                                                $checked = TRUE;
                                            }
                                        }
                                        ?>
                                        <input <?php echo $checked ? "checked='checked'" : ""; ?> class="filter" type="checkbox" value="<?php echo $row->brands->link_rewrite; ?>" id="rc<?php echo $no; ?>" name="brands">
                                        <label for="rc<?php echo $no; ?>" onclick=""><?php echo $row->brands->brand_name; ?></label>
                                    </div>
                                    <?php
                                    $no++;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <?php
                            $feature = \backend\models\Feature::find()->all();
                            foreach ($feature as $row) {
                                $product_feature_value = backend\models\ProductFeatureValue::find()->where(['feature_id' => $row->feature_id])->orderBy('feature_value_name ASC')->all();
                                if (strtoupper($row->feature_name) != 'SIZE' && strtoupper($row->feature_name) != 'BANDWIDTH' && strtoupper($row->feature_name) != 'WATER RESISTANT' && strtoupper($row->feature_name) != 'GENDER' && strtoupper($row->feature_name) != 'MOVEMENT') {
                                    ?>
                                        <div class="filter-brand title left brand"><?php echo strtoupper($row->feature_name); ?></div>
                                        <div class="col-lg-12 filter-parent brand left">
                                            <?php
                                            foreach ($product_feature_value as $roww) {
                                                ?>
                                                <div class="checkbox-btn lspace2">
                                                    <?php 
                                                    $checked = FALSE;
                                                    if($row->feature_name == 'Gender'){
                                                        foreach($genders_selection as $selection){
                                                            if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                                $checked = TRUE;
                                                            }
                                                        }
                                                    }
                                                    else if($row->feature_name == 'Type'){
                                                        foreach($types_selection as $selection){
                                                            if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                                $checked = TRUE;
                                                            }
                                                        }
                                                    }
                                                    else if($row->feature_name == 'Movement'){
                                                        foreach($movements_selection as $selection){
                                                            if(strtolower(str_replace(' ', '-', $roww->feature_value_name)) == $selection){
                                                                $checked = TRUE;
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <input <?php echo $checked ? "checked='checked'" : ""; ?> type="checkbox" data-id="<?php echo explode(' ', strtolower(trim($row->feature_name)))[0]; ?>" value="<?php echo strtolower(str_replace(' ', '-', $roww->feature_value_name)); ?>" id="rc<?php echo $no; ?>" name="category">
                                                    <label for="rc<?php echo $no; ?>" onclick=""><?php echo $roww->feature_value_name; ?></label>
                                                </div>
                                                <?php
                                                $no++;
                                            }
                                            ?>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <?php 
                            if(count($price_selection) > 0){
                            ?>
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[<?php echo str_replace(".", "", $price_selection[0]); ?>,<?php echo str_replace(".", "", $price_selection[1]); ?>]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left"><?php echo $price_selection[0]; ?></div>
                                    <div id="bar-right" class="pull-right"><?php echo $price_selection[1]; ?></div>
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="filter-brand title left brand">PRICE</div>
                            <div class="filter-brand title left brand" style="border-bottom: 0px; padding-top: 2%;">
                                <input id="foo" type="text" class="span2" value="" data-slider-handle="triangle" data-slider-min="300000" data-slider-max="15000000" data-slider-step="10000" data-slider-value="[300000,15000000]"/>
                                <div style="font-family: gotham-light; padding-top: 13%;">
                                    <div id="bar-left" class="pull-left">300.000</div>
                                    <div id="bar-right" class="pull-right">15.000.000</div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row box-parent bottom">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 right">
                            <input class="btn-clear" type="reset" value="CLEAR ALL" name="clear" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 left">
                            <input class="btn-apply" type="submit" id="apply-filter" value="APPLY" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>