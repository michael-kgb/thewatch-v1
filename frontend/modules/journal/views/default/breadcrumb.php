<?php
$exURL = explode("/category/", $_SERVER['REQUEST_URI']);
$countUrl = count($exURL);
?>

<div class="journal-menu">
     <a href="<?php echo \yii\helpers\Url::base() . '/journal';?>" class="journal-menu-item">
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal-icons/all.png" alt="journal menu icon">
        Semua
		
		<?php if($countUrl == 1){ ?>
		<img class="selected-category" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/selected-mobile.png"/>
		<?php } ?>
   </a>


    <?php
    $len = count($journalCategory);
	
    if (count($journalCategory) > 0) { 
        foreach ($journalCategory as $category) { ?>
		
			<a href="<?php echo \yii\helpers\Url::base() . '/journal/category/' . $category->journal_category_name; ?>" class="journal-menu-item">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/journal-icons/<?php echo $category->journal_category_img; ?>" alt="journal menu icon">
                <?php echo ucfirst($category->journal_category_name); ?>
				
				<?php if($countUrl > 1 && ($exURL[1] == $category->journal_category_name)){ ?>
					<img class="selected-category" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/selected-mobile.png"/>
				<?php } ?>
            </a> 
            
    <?php 
        } 
    }
    ?>
	<!--
    <div class="journal-menu-item">
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" alt="journal menu icon">
        Submissions
    </div>
    <div class="journal-menu-item">
        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icon_top.png" alt="journal menu icon">
        Contributors
    </div> -->
</div>
