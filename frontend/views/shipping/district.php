<select class="shipping" id="district" name="district_id">
    <option value="0" selected="selected">DISTRICT</option>
    <?php if(count($districts) > 0) { ?>
    <?php foreach ($districts as $district) { ?>
    <option value="<?php echo $district->district_id; ?>"><?php echo $district->name; ?></option>
    <?php } ?>
    <?php } ?>
</select>

<script>
$('select#district').on('change', function(e){
    
    e.preventDefault();
    
    if($('select#district')[0].value !== "0") {
        
        var district_id = $('select#district')[0].value;
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-shipping-method',
            data: { "district_id" : district_id },
            beforeSend: function(){

            },
            success: function(data){
                $("div.carrier-method").html(data);
            }
        });
    } else {
        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }
    
});
</script>