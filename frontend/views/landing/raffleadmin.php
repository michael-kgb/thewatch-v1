<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use app\assets\VueAsset;

VueAsset::register($this);
?>
<section class="nopadding" id="sectionTimexBeam2" style="background:none;"> 



<div class="container" id="dataRegistrant">
    <span id="sessionLogin" style="display:none;"><?=$_SESSION['verificator']['fullname']?></span>
    
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-inline">
      <button style="float:left;" id="verificationBtn" type="submit" class="blue-round btn" data-toggle="modal" data-target="#myModal">Verifikasi</button>
      <button style="float:left;margin-left:20px;" class="blue-round btn" onclick="exportTableToExcel('dataTbl')">Export</button>
      <select id="num_per_page" style="float:left;margin-left:20px;" class="form-control" onchange="setView(this)">
        <option value="0" selected disabled>Select View per Page</option>
        <option value="10">10</option>
        <option value="100">100</option>
        <option value="1000">1000</option>
        <option value="all">All</option>
      </select>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="filter" class="sr-only">Filter</label>
            <input type="text" class="form-control" v-model="filter" placeholder="Filter" style="width:100%;">
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 table-responsive">
        <datatable :columns="columns" :data="rows" :filter-by="filter" id="dataTbl"></datatable>
        <datatable-pager v-model="page" type="long" :per-page="per_page"></datatable-pager>
    </div>
    
    <div class="text-center">
    <div class="lds-dual-ring" style="width:100px;"></div>
    </div>

    

</div>

 <!-- Modal -->
 <div id="modal-verifikator">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Verifikasi</h4>
      </div>
      <div class="modal-body"  >
            <label><b>Kode Verifikasi</b></label>
            <input type="text" class="form-control" placeholder="ABC123" name="kode" maxlength="6" required>
            <small class="form-text text-muted">Harus memiliki 6 karakter.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="blue-round btn" id='submitKodeVerifikasi' v-on:click="verifikasi">Submit</button>
      </div>
    </div>
  </div>
</div>
</div>

</section> 


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

  if($('#sessionLogin').html()==""){
    window.location.href = "https://www.thewatch.co/timexraffle/verifikator/login";
  }

</script>
 

<style>
/*Loading Screen*/
 
.lds-dual-ring {
  display: inline-block;
  width: 64px;
  height: 64px;
}

.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 46px;
  height: 46px;
  margin: 1px;
  border-radius: 50%;
  border: 5px solid #1D6068;
  border-color: #1D6068 transparent #1D6068 transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}

@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}


</style>
