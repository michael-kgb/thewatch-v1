<div class="hidden-xs">
<div class="">
<div class="padding-homebanner"></div>
<video id="my-video" class="video-home hidden-xs" muted loop>
  <source src="<?php echo \yii\helpers\Url::base(); ?>/img/jewelry-looping.m4v" type="video/mp4">
  <!-- <source src="media/demo.ogv" type="video/ogg"> -->
  <!-- <source src="<?php echo \yii\helpers\Url::base(); ?>/img/timex/lemonade-video.webm" type="video/webm"> -->
</video>
<script>
(function() {
  /**
   * Video element
   * @type {HTMLElement}
   */
  var video = document.getElementById("my-video");
   
  video.addEventListener( "canplay", function() {
    video.play();
  });
})();
</script>
<style>
    .video-home {
  /*position: fixed;*/
      margin-top: 45px;
  top: 50%;
  left: 50%;
  z-index: 1;
 /* min-width: 100%;
  min-height: 100%;*/
  width: 100%;
  height: auto;
  -webkit-transform: translate(0%, -10%);
      -ms-transform: translate(0%, -10%);
          transform: translate(0%, -10%);
}
    .video {
  /*position: absolute;*/
  top: 0;
  left: 0;
  width: 100% !important;
  height: auto;
  min-height: 600px;
  overflow: hidden;
}
@media only screen and (min-width : 1920px){
    .video-home {
        margin-top: 60px;
    }
}
@media only screen and (min-width : 2560px){
    .video-home {
        margin-top: 75px;
    }
}
@media only screen and (min-width : 5120px){
    .video-home {
        margin-top: 153px;
    }
}
</style>
</div>
</div>