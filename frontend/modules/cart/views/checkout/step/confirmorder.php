<?php 
    echo "<button id=\"midtrans-pay\" onclick=\"pay()\" style=\"display:none;\">Pay</button>";

?>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?=Yii::$app->params['midtrans_conf']['clnt_key'];?>"></script> 
<script>
    function pay(){
        alert("Cobain Midtrans");
        snap.pay('<?=$snapToken;?>', {gopayMode:'auto'});
    }

    window.onload= document.getElementById("midtrans-pay").click();


</script>