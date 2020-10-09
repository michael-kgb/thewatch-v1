<div class="col-lg-12 col-md-12 hidden-sm hidden-xs clearleft clearright ptop20">

    <!-- <div class="hidden-lg hidden-md hidden-sm hidden-xs remove-padding clearleft pleftpage-4">
        <span class="gotham-light position-left">
            <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
            -
            <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
            From <?php echo $count; ?> Products
        </span>
    </div> -->
    <?php


        if($total_page > 8){
            if($current < 4){
            ?>
            <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=4;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>

                        <?php
                    }
                ?>      <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>
                        <span class="gotham-light hidden-lg hidden-md fcolorblue pleft-paging">...</span>

                        <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                            <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>
                        <span class="gotham-light hidden-lg hidden-md pleft-paging">

                            <a class="circle-sprites25 fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>

                        <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                            <a class="" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites"></i></a>
                        </span>
                        <span class="hidden-lg hidden-md gotham-light pleft-paging">
                            <a class=" fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                        </span>
                        <span class="gotham-light pleft-paging">
                            <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                        </span>
            </div>

            <?php

          } if(($current >= 4) && ($current < $total_page-2)){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="fcolorwhite">
                        <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                  </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                          <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites"></i></a>
                    </span>


                <?php

                    for($i= $current - 1;$i<=$current + 1;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>

                        <?php
                    }
                ?>
                        <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>

                        <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                            <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>


                      <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                          <a class="fcolorwhite" class="" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites"></i></a>
                      </span>

                      <span class="gotham-light pleft-paging">

                          <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                      </span>

            </div>
                <?php
             }if($current >= $total_page-2){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="gotham-light pleft-paging">
                      <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                  </span>
                  <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                      <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites"></i></a>
                  </span>

                  <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                    <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">1</span></a>
                  </span>


                  <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>

                <?php

                    for($i= $total_page - 3;$i<=$total_page;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>

                        <?php
                    }
                ?>
                    </div>
                <?php
             }
        }if($total_page <= 5){
            ?>
            <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php if($current > 1){ ?>
                  <span class="gotham-light pleft-paging">

                      <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current-1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites"></i></a>
                  </span>
                <?php } ?>
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>


                        <?php
                    }
                    ?>
                    <?php if($current < $total_page){ ?>
                      <span class="gotham-light pleft-paging">

                          <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current+1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites"></i></a>
                      </span>
                    <?php } ?>
                    </div>
           <?php

        }if(($total_page > 5) && ($total_page <= 8)){
            if($total_page == 5){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>
                 
                        <?php
                    }
                    ?>
                    </div>
                    <?php
            }else{


            if($current < 5){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=5;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>

                        <?php
                    }
                ?>


                         <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                            <a class="fcolorwhite" class="" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites"></i></a>
                        </span>

                        <span class="gotham-light pleft-paging">

                            <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                        </span>

            </div>

                    <?php
                    }else{

                         ?>
                  <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                    <span class="gotham-light pleft-paging">
                        <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                    </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                        <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites"></i></a>
                    </span>
 
                      <?php
                          for($i= $total_page - 4;$i<=$total_page;$i++){
                              ?>
                              <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                  <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                              </span>
    
                          <?php
                          }
                      ?>
                  </div>
                <?php

            }
         }
        }

     ?>

</div>


<div class="hidden-lg hidden-md col-sm-12 col-xs-12 clearleft clearright ptop20">

    <!-- <div class="hidden-lg hidden-md hidden-sm hidden-xs remove-padding clearleft pleftpage-4">
        <span class="gotham-light position-left">
            <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
            -
            <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
            From <?php echo $count; ?> Products
        </span>
    </div> -->
    <?php


        if($total_page > 8){
            if($current < 2){
            ?>
            <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=2;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <?php
                    }
                ?>      <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>
                        <span class="gotham-light hidden-lg hidden-md fcolorblue pleft-paging">...</span>

                        <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                            <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>
                        <span class="gotham-light hidden-lg hidden-md pleft-paging">

                            <a class="circle-sprites25 fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>

                        <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                            <a class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                        </span>
                        <span class="hidden-lg hidden-md gotham-light pleft-paging">
                            <a class="mright3 fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                        </span>
                        <span class="gotham-light pleft-paging">
                            <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                        </span>
            </div>

            <?php

          } if(($current >= 2) && ($current < $total_page-1)){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="fcolorwhite">
                        <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                  </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                          <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                    </span>
                    <span class="hidden-lg hidden-md gotham-light pleft-paging">
                          <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                    </span>

                <?php

                    for($i= $current - 1;$i<=$current;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <?php
                    }
                ?>
                        <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>
                        <span class="gotham-light hidden-lg hidden-md fcolorblue pleft-paging">...</span>

                        <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                            <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>
                        <span class="gotham-light hidden-lg hidden-md pleft-paging">

                            <a class="circle-sprites25 fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $total_page; ?></span></a>
                        </span>

                      <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                          <a class="fcolorwhite" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                      </span>
                      <span class="hidden-lg hidden-mdgotham-light pleft-paging">
                          <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                      </span>
                      <span class="gotham-light pleft-paging">

                          <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                      </span>

            </div>
                <?php
             }if($current >= $total_page-1){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="gotham-light pleft-paging">
                      <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                  </span>
                  <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                      <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                  </span>
                  <span class="hidden-lg hidden-md gotham-light pleft-paging">
                      <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                  </span>


                  <span class="gotham-light hidden-sm hidden-xs pleft-paging">

                    <a class="circle-sprites fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">1</span></a>
                  </span>
                  <span class="gotham-light hidden-lg hidden-md pleft-paging">

                    <a class="circle-sprites25 fcolorblue" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging">1</span></a>
                  </span>

                  <span class="gotham-light hidden-sm hidden-xs fcolorblue pleft-paging">...</span>
                  <span class="gotham-light hidden-lg hidden-md fcolorblue pleft-paging">...</span>

                <?php

                    for($i= $total_page - 1;$i<=$total_page;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <?php
                    }
                ?>
                    </div>
                <?php
             }
        }if($total_page <= 5){
            ?>
            <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php if($current > 1){ ?>
                  <span class="gotham-light pleft-paging">

                      <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current-1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                  </span>
                <?php } ?>
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>
                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>

                        <?php
                    }
                    ?>
                    <?php if($current < $total_page){ ?>
                      <span class="gotham-light pleft-paging">

                          <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current+1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                      </span>
                    <?php } ?>
                    </div>
           <?php

        }if(($total_page > 5) && ($total_page <= 8)){
            if($total_page == 5){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>
                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                                <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                            </span>

                        <?php
                    }
                    ?>
                    </div>
                    <?php
            }else{


            if($current < 5){
                ?>
                <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=5;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                            <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                        </span>
                        <?php
                    }
                ?>


                         <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                            <a class="fcolorwhite" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                        </span>
                        <span class="hidden-lg hidden-mdgotham-light pleft-paging">
                            <a class="fcolorwhite" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="right-fill-sprites25"></i></a>
                        </span>
                        <span class="gotham-light pleft-paging">

                            <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">Last</a>
                        </span>

            </div>

                    <?php
                    }else{

                         ?>
                  <div class="talign-center width100 col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding col-lg-offset-2 clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                    <span class="gotham-light pleft-paging">
                        <a class="fcolorwhite blue-round paging" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">First</a>
                    </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft-paging">
                        <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                    </span>
                    <span class="hidden-lg hidden-md gotham-light pleft-paging">
                        <a class="fcolorwhite" href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><i class="left-fill-sprites25"></i></a>
                    </span>


                      <?php
                          for($i= $total_page - 4;$i<=$total_page;$i++){
                              ?>
                              <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-sm hidden-xs pleft-paging">

                                  <a <?php if($current == $i){ echo ' class="circle-fill-sprites fcolorfff"';}else{ echo 'class="circle-sprites fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                              </span>
                              <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> hidden-lg hidden-md pleft-paging">

                                  <a <?php if($current == $i){ echo ' class="circle-fill-sprites25 fcolorfff"';}else{ echo 'class="circle-sprites25 fcolorblue"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $breadcrumbs[0] . '/' . $breadcrumbs[2] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><span class="lheight-paging"><?php echo $i; ?></span></a>
                              </span>
                          <?php
                          }
                      ?>
                  </div>
                <?php

            }
         }
        }

     ?>

</div>

