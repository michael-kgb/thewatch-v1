<?php
$count = count($journalList1);
$p = ceil($count/$limit);
$paramURL 	  = explode("?", $_SERVER['REQUEST_URI'])[0];
$currentPage  = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPage    = $p;
$numberLength = 3;
$jumpTen = floor($p / 10);
?>

<div class ="col-lg-12 col-md-12 col-sm-12 col-xs-12 pagination-item-list">

    <?php 
    if (!isset($_GET['page']) || $_GET['page'] == 1){
    ?>
    <div class="pagination-item">
        <a class="cicrle-page-number cicrle-page-number-grey" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=1">First</a>   
    </div>
    <?php
    }else{   
    ?>
    <div class="pagination-item">
        <a class="cicrle-page-number cicrle-page-number-blue-large" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=1">First</a>   
    </div>
    <?php
    }
    ?>

    <?php 
    if (isset($_GET['page'])){
		if($_GET['page'] != 1){
        $prevPage = $_GET['page'] - 1;
    ?>
	
    <div class="pagination-item">
        <a class="" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $prevPage ?>">
            <i class="left-fill-sprites"></i>
        </a>   
    </div>
    <?php
		}
    }
    ?>

    <?php
    if(($currentPage + $numberLength) > $totalPage){ 
        if(($currentPage != $totalPage) && (($currentPage - 1) > 0)){ 
        ?>
		<!--
        <div class="pagination-item">
            <a class="cicrle-page-number cicrle-page-number-round" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $currentPage -1 ?>">
                <?= $currentPage - 1 ; ?>
            </a>   
        </div> -->
        <?php
        } 
		
        for($a = ($totalPage - $numberLength); $a <= $totalPage; $a++) { 
			if($a > 0){
            ?>
            <div class="pagination-item">
                <a class="cicrle-page-number <?= $currentPage == $a ? 'cicrle-page-number-blue' : 'cicrle-page-number-round' ?>" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $a ?>">
                    <?= $a; ?>
                </a>   
            </div>
            <?php
			}
        }
    }else {
        if($currentPage != 1 ){
        ?>
        <div class="pagination-item">
            <a class="cicrle-page-number cicrle-page-number-round" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $currentPage -1 ?>">
                <?= $currentPage -1 ; ?>
            </a>   
        </div>
        <?php
        }

        for($a = $currentPage; $a<$currentPage + $numberLength; $a++) {
    ?>
        <div class="pagination-item">
            <a class="cicrle-page-number <?= $currentPage == $a ? 
				'cicrle-page-number-blue' : 
				'cicrle-page-number-round' ?>" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $a ?>">
                <?= $a; ?>
            </a>   
        </div>
        <?php
        }
    }

    if($currentPage < ($jumpTen * 10)){

        $jumpFound = false;
        
            for($j = 1; $j<=$jumpTen; $j++){

                if($jumpFound === false){

                $theJump = $j*10;
                if(($theJump) > $currentPage + $numberLength){
        ?>
            <div class="pagination-item">
                <a class="cicrle-page-number more-dots" href="#">
                   ...
                </a>    
            </div> 
            <div class="pagination-item">
                <a class="cicrle-page-number <?= $currentPage == $a ? 'cicrle-page-number-blue' : 'cicrle-page-number-round' ?>" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $theJump ?>">
                    <?= $theJump; ?> 
                </a>    
            </div> 
        <?php
                $jumpFound = true;
                }
            }
        }
    }
   
    if (isset($_GET['page'])){
		if($_GET['page'] != $p){
        $nextPage = $_GET['page'] + 1;
    ?>
    <div class="pagination-item">
        <a class="cicrle-page-number " href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $nextPage ?>">
            <i class="right-fill-sprites"></i>
        </a>   
    </div>
    <?php
		}
    }
    ?>

    <?php 
    if (isset($_GET['page']) && $_GET['page'] == $p){
    ?>
    <div class="pagination-item">
        <a class="cicrle-page-number cicrle-page-number-grey" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $p ?>">Last</a>   
    </div>
    <?php
    }else{   
    ?>
    <div class="pagination-item">
        <a class="cicrle-page-number cicrle-page-number-blue-large" href="<?php echo \yii\helpers\Url::base(); ?><?= $paramURL; ?>?page=<?= $p ?>">Last</a>   
    </div>
    <?php
    }
    ?>
</div>
