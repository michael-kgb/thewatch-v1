<?php
// Store the global variable here
$brandId = 48;
$current_date = date('Y-m-d H:i:s');
$currentUrl = explode('?',$_SERVER[REQUEST_URI])[0];
$currentAc = "//$_SERVER[HTTP_HOST]$currentUrl";

if(isset($_GET['isadmin'])){
    $current_date = '2017-12-12 00:00:00';
}