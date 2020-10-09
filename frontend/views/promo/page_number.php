<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright" style="padding-top:20px;color:#59595b;">

    <!-- <div class="hidden-lg hidden-md hidden-sm hidden-xs remove-padding clearleft pleftpage-4">
        <span class="gotham-light position-left">
            <?php echo!isset($_GET['page']) || $_GET['page'] == 1 ? 1 : (($_GET['limit'] * $_GET['page']) - $_GET['limit']) + 1; ?>
            -
            <?php echo!isset($_GET['limit']) ? 20 : ($_GET['limit'] * $_GET['page']); ?>
            From <?php echo $count; ?> Products
        </span>
    </div> -->
    <?php
  $url = explode("/",$_SERVER['REQUEST_URI']);

  $urls = explode("?",$url[1]);
  // echo $urls[0];
?>
    <?php


        if($total_page > 8){
            if($current < 5){
            ?>
            <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=5;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                            <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                        </span>
                        <?php
                    }
                ?>
                        <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                            <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
                        </span>
                        <span class="hidden-lg hidden-mdgotham-light pleft13-5">
                            <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                        </span>
                        <span class="gotham-light pleft13-5">
                            <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">LAST</a>
                        </span>
            </div>

            <?php

          } if(($current >= 5) && ($current < $total_page-3)){
                ?>
                <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="gotham-light pleft13-5">
                        <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">FIRST</a>
                  </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                          <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">PREV</a>
                    </span>
                    <span class="hidden-lg hidden-md gotham-light pleft13-5">
                          <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                    </span>

                <?php

                    for($i= $current - 2;$i<=$current + 2;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                            <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                        </span>
                        <?php
                    }
                ?>

                      <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                          <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
                      </span>
                      <span class="hidden-lg hidden-mdgotham-light pleft13-5">
                          <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                      </span>
                      <span class="gotham-light pleft13-5">

                          <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">LAST</a>
                      </span>

            </div>
                <?php
             }if($current >= $total_page-3){
                ?>
                <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                  <span class="gotham-light pleft13-5">
                      <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">FIRST</a>
                  </span>
                  <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                      <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">PREV</a>
                  </span>
                  <span class="hidden-lg hidden-md gotham-light pleft13-5">
                      <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                  </span>

                <?php

                    for($i= $total_page - 3;$i<=$total_page;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                            <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                        </span>
                        <?php
                    }
                ?>
                    </div>
                <?php
             }
        }if($total_page <= 5){
            ?>
            <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php if($current > 1){ ?>
                  <span class="gotham-light pleft13-5">

                      <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current-1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">PREV</a>
                  </span>
                <?php } ?>
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                                <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                            </span>

                        <?php
                    }
                    ?>
                    <?php if($current < $total_page){ ?>
                      <span class="gotham-light pleft13-5">

                          <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current+1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
                      </span>
                    <?php } ?>
                    </div>
           <?php

        }if(($total_page > 5) && ($total_page <= 8)){
            if($total_page == 5){
                ?>
                <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                <?php
                for($i= 1;$i<=$total_page;$i++){
                        ?>

                            <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                                <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                            </span>

                        <?php
                    }
                    ?>
                    </div>
                    <?php
            }else{


            if($current < 5){
                ?>
                <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">

                <?php

                    for($i = 1;$i<=5;$i++){
                        ?>
                        <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                            <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
                        </span>
                        <?php
                    }
                ?>


                         <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                            <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">NEXT</a>
                        </span>
                        <span class="hidden-lg hidden-mdgotham-light pleft13-5">
                            <a style="color:#59595b;" class="mright3" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current + 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/next.png" class="nexticonpagin"></a>
                        </span>
                        <span class="gotham-light pleft13-5">

                            <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $total_page; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">LAST</a>
                        </span>

            </div>

                    <?php
                    }else{

                         ?>
                  <div style="text-align:center;width:100%;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding text-to-right col-lg-offset-2 right-float clearright pleftpage0 clearrightcopy pleftpagemobilepag1">
                    <span class="gotham-light pleft13-5">
                        <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=1&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">FIRST</a>
                    </span>
                    <span class="hidden-sm hidden-xs gotham-light pleft13-5">
                        <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>">PREV</a>
                    </span>
                    <span class="hidden-lg hidden-md gotham-light pleft13-5">
                        <a style="color:#59595b;" href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $current - 1; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/prev.png" class="nexticonpagin"></a>
                    </span>


                      <?php
                          for($i= $total_page - 4;$i<=$total_page;$i++){
                              ?>
                              <span class="<?php if($current == $i){ echo 'gotham-medium';}else{ echo 'gotham-light';}?> pleft13-5">

                                  <a <?php if($current == $i){ echo 'style="color:#1d6269;"';}else{ echo 'style="color:#59595b;"';}?> href="<?php echo \yii\helpers\Url::base() . '/' . $urls[0] . '?' . $params; ?>&page=<?php echo $i; ?>&amp;limit=<?php echo $limit; ?>&sortby=<?php echo $sortby;?>"><?php echo $i; ?></a>
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
