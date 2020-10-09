<?php 
    if($quantity->quantity !== 0) {
        echo '<select onChange="changeQuantityCustom()" class="qty" name="qty">';
        echo '<option value="0">';
        echo 'Jumlah'; 
        echo '</option>';
        for($i = 1; $i <= $quantity->quantity; $i++){
            echo '<option value="'.$i.'">'.$i.'</option>';
            if($i >= 10){
                break;
            }
        }
        echo '</select>';
    } else {
        echo '<div class="col-lg-3 col-md-3 col-sm-3 qty gotham-medium fsize-1 quantity-out-of-stock pleft1">';
        echo 'Out Of Stock'; 
        echo '</div>';
    }
?>
    
