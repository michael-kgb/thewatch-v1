 <?php
                        $prod_att_id = [];
                        $prod_att_i = '';
                        foreach ($quantity as $row) {
                            $prod_att_id[] = $row->product_attribute_id;
                            $prod_att_i = $row->product_attribute_id.'+'.$prod_att_i;
                        }
                        // print_r($prod_att_id);
                    ?>
<select id="size" class="size margin-bottom-5 fleft" name="size"?>>
                            <option value="0">Ukuran</option>
                            <?php foreach ($quantity as $attribute) { ?>
                                <?php if($attribute->attribute_id_2 != 0){
                                    ?>
                                    <option attrId="<?php echo $attribute->product_attribute_id; ?>" attributeId="<?php echo $prod_att_i; ?>" id="<?php echo $attribute->attributeValue2->value; ?>" value="<?php echo $attribute->attributeValue->attribute_value_id.'+'.$attribute->attributeValue2->attribute_value_id; ?>"><?php echo $attribute->attributeValue2->value; ?></option>
                                    <?php
                                } ?>
                                
                            <?php } ?>
                        </select>