<select name="ProductAttribute[attribute_value]" id="attribute_value_id" class="form-control">
    <?php if (count($attributeValueCombination) > 0) { ?>
    <option value="0" selected="selected">Select Attribute</option>
    <?php $i = 0; ?>
    <?php foreach ($attributeValueCombination as $attributes) { ?>
    <option value="<?php echo $attributes->attributeValue->attribute_value_id; ?>"><?php echo $attributes->attributeValue->value; ?></option>
    <?php $i++; ?>
    <?php } ?>
    <?php } ?>
</select>

<?php // print_r($attributeValueCombination[0]->attributeValue->value); die(); ?>