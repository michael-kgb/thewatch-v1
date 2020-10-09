    <?php 
        $bottom = 0;
        foreach($bulkhead as $bulk){
            if($bulk['marketing_bulkhead_type'] !='top'){
                $bottom++;
            }
    } ?>
    <?php if($bottom != 0){ ?>
    <div class="foot-box mobile hidden-lg hidden-md hidden-sm alert alert-success alert-dismissable fade in" style="margin:0;">
    <a style="color:white;font-weight:10;" href="#" class="close bulkhead-close" data-dismiss="alert" aria-label="close">X</a>
        <div id="this-carousel-id" class="carousel carousel-fade slide col-lg-6 col-md-6 col-sm-6 clearright">
      <div class="carousel-inner">
         <?php
        $t = 0; 
        foreach($bulkhead as $bulkheads){ ?>
            <?php if($bulkheads['marketing_bulkhead_type'] !='top'){?>
        <div class="item <?php if($t == 0){ echo 'active';} ?> items">
          <div class="carousel-caption carousel-bulkhead-mobile text-foot-mobile" style="color:white;text-align:left;">
            <style>.carousel-bulkhead-mobile p a {margin-bottom: 0;color:#206069;text-decoration: underline;}</style><?php echo $bulkheads['marketing_bulkhead_text']; ?>
          </div>
          
        </div>
        <?php $t++; }} ?>
      </div>   
    </div>
  </div>

  <div class="foot-box desktop hidden-xs alert alert-success alert-dismissable fade in" style="margin:0;border:none;border-radius:0;">
        <div class="col-lg-1 col-md-1 col-sm-1"></div>
        <div id="this-carousel-id" class="carousel carousel-fade slide col-lg-10 col-md-10 col-sm-10 clearright">
      <div class="carousel-inner">
        <?php
        $t = 0; 
        foreach($bulkhead as $bulkheads){ ?>
        <?php if($bulkheads['marketing_bulkhead_type'] !='top'){?>
        <div class="item <?php if($t == 0){ echo 'active';} ?> items">
          <div class="carousel-caption carousel-bulkhead-mobile text-foot-desktop" style="color:white;">
            <style>.carousel-bulkhead-mobile p a {margin-bottom: 0;color:#206069;text-decoration: underline;}</style><?php echo $bulkheads['marketing_bulkhead_text']; ?>
          </div>
          
        </div>
        <?php $t++; }} ?>
      </div> 

    </div><a href="#" style="text-align:right;padding-top:5px;color:white;" class="close bulkhead-close col-lg-1 col-md-1 col-sm-1" data-dismiss="alert" aria-label="close">X</a> 
  </div>
  <?php } ?>