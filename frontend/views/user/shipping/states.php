<select class="year" id="state-profile" name="state_id" onchange="checkDistrict()">
    <option value="0" selected="selected">Kota</option>
    <?php if(count($states) > 0) { ?>
    <?php foreach ($states as $state) { ?>
    <option value="<?php echo $state->state_id; ?>"><?php echo $state->name; ?></option>
    <?php } ?>
    <?php } ?>
</select>