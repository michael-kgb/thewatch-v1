<select class="shipping" id="state" name="state_id">
    <option value="0" selected="selected">STATE</option>
    <?php if(count($states) > 0) { ?>
    <?php foreach ($states as $state) { ?>
    <option value="<?php echo $state->state_id; ?>"><?php echo $state->name; ?></option>
    <?php } ?>
    <?php } ?>
</select>

<script>
$('select#state').on('change', function(e){
    
    e.preventDefault();
    
    if($('select#state')[0].value !== "0") {
        
        var state_id = $('select#state')[0].value;
        
        $.ajax({
            type: "POST",
            url: baseUrl + '/shipping/generate-district',
            data: { "state_id" : state_id },
            beforeSend: function(){

            },
            success: function(data){
                $("div.district").html(data);
            }
        });
    } else {
        $('select#district').val(0);
        $('select#district').prop("disabled", true);
        
        $('select#shipping-method').val(0);
        $('select#shipping-method').prop("disabled", true);
    }
    
});
</script>