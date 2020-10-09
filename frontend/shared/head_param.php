<?php
$breadcrumbs = $this->context->breadcrumb;

  $url = explode("/",$_SERVER['REQUEST_URI']);

  $urls = explode("?",$url[1]);
  // echo $urls[0];

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
if(isset($_GET['size'])){
    $params = $params . '&size=' . $_GET['size'];
    $size_selection = explode('--', $_GET['size']);
}

if(!isset($_GET['limit'])){
	$limit = 20;

}else{
	$limit = $_GET['limit'];
}

if(!isset($_GET['page'])){
	$current = 1;
}else{
	$current = $_GET['page'];
}

$sortby = 'product_sort';
if(isset($_GET['sortby'])){
	$sort_name = str_replace('-', ' ', $_GET['sortby']);
	$sort_name = strtoupper($sort_name);
	$sortby = $_GET['sortby'];
}else{
	$sort_name = 'NONE';
}

?>