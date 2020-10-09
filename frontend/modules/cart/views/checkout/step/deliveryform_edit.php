<?php
//use yii\web\Session;
//
//$sessionOrder = new Session();
//$customerInfo = $sessionOrder->get("customerInfo");
//
//print_r($_SESSION);
use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");
$totalItems = count($cart['items']);
?>
<script>
var items = [];

var totalCart = <?php echo $totalItems; ?>;

if(totalCart > 0){
    <?php $i = 1; ?>
    <?php foreach ($cart['items'] as $item) { ?>
    <?php $product = \backend\models\Product::findOne(['product_id' => $item['id']]); ?>
    items.push({
        "id": <?php echo $item['id']; ?>,
        "name": "<?php echo $item['name']; ?>",
        "price": "<?php echo $item['total_price']; ?>",
        "brand": "<?php echo $item['brand_name']; ?>",
        "category": "<?php echo $product->productCategory->product_category_name; ?>",
        "position": <?php echo $i; ?>,
        "quantity": <?php echo $item['quantity']; ?>
    });
    <?php $i++; ?>
    <?php } ?>

    dataLayer.push({
      "event": "checkout",
      "ecommerce": {
        "checkout": {
          "actionField": {
            "step": 1
          },
          "products": items,
        }
      }
    });
}

fbq('track', 'InitiateCheckout');
</script>



<section id="shopping-bag" class="payment-info">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-12 clearleft clearright">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase title">SHIPPING INFORMATION</div>
                <div class="col-lg-12 hidden-md hidden-sm col-xs-12 clearleft clearright"></div>
                <form method="post" action="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/editaddress/<?php echo $customerAddress['customer_address_id']; ?>">
<div class="form-input-wrap col-md-12 col-sm-12 remove-padding">

	<div class="rounded-input-wrap">
		<label for="firstname">First Name</label>
		<input class="rounded-input remove-margin-top" type="text" name="address[fname]" placeholder="First Name" value="<?php echo $customerAddress['firstname']; ?>" pattern="[a-zA-Z0-9\s]+" required/>
		<span class="dnone gotham-light error-input-message">* First Name Required</span>
	</div>

	<div class="rounded-input-wrap">
		<label for="lastname">Last Name</label>
		<input class="rounded-input" type="text" name="address[lname]" placeholder="Last Name"  value="<?php echo $customerAddress['lastname']; ?>" pattern="[a-zA-Z0-9\s]+" required/>
		<span class="dnone gotham-light error-input-message">* Last Name Required</span>
	</div>

	<div class="rounded-input-wrap">
		<label for="address1">Address</label>
		<textarea rows="4" class="rounded-input" name="address[address1]" placeholder="Address" required> <?php echo $customerAddress['address1']; ?></textarea>
		<span class="dnone gotham-light error-input-message">* Address Required</span>
	</div>

	<div class="rounded-input-wrap">
		<label for="phone">Mobile Phone</label>
		<input class="rounded-input" type="number" name="address[phone]" placeholder="Mobile Phone" value="<?php echo $customerAddress['phone']; ?>" required/>
		<span class="dnone gotham-light error-input-message">* Mobile Phone Required </span>
	</div>

	<div class="rounded-input-wrap">
		<label for="postcode">Zip Code</label>
		<input class="rounded-input" type="number" name="address[zip]" placeholder="Zip Code" value="<?php echo $customerAddress['postcode']; ?>" pattern="[0-9]{5}" maxlength="5" required/>
		<span class="dnone gotham-light error-input-message">* Zip Code Required </span>
	</div>

	<div class="rounded-input-wrap">
		<label for="province_id">Province</label>
		<select class="year" id="province-profile" name="address[province]" required>
			<option value="0" selected="selected">PROVINCE</option>
			<?php if (count($provinces) > 0) { ?>
				<?php foreach ($provinces as $province) { ?>
					<option value="<?php echo $province->province_id; ?>" <?php echo $province->province_id == $customerAddress['province_id'] ? 'selected' : ''; ?>><?php echo $province->name; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		<span class="dnone gotham-light error-input-message">* Province Required</span>
	</div>
	
	<div class="rounded-input-wrap state">
		<label for="state">State</label>
		<select class="year" id="state-profile" name="state_id" onchange="checkDistrict()" required>
			<option value="0" selected="selected">STATE</option>
			<?php
			$states = \backend\models\State::find()->where(['province_id' => $customerAddress['province_id'], 'active' => '1'])->all();
			if (count($states) > 0) {
				?> 
				<?php foreach ($states as $state) { ?>
					<option value="<?php echo $state->state_id; ?>" <?php echo $state->state_id == $customerAddress['state_id'] ? 'selected' : ''; ?>><?php echo $state->name; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		<span class="dnone gotham-light error-input-message">* State Required </span>
	</div>
	
	<div class="rounded-input-wrap district">
		<label for="district">District</label>
		<select class="year" id="district-profile" name="district_id" required>
			<option value="0" selected="selected">DISTRICT</option>
			<?php
			$districts = \backend\models\District::find()->where(['state_id' => $customerAddress['state_id'], 'active' => '1'])->all();
			if (count($districts) > 0) {
				?>
				<?php foreach ($districts as $district) { ?>
					<option value="<?php echo $district->district_id; ?>" <?php echo $district->district_id == $customerAddress['district_id'] ? 'selected' : ''; ?>><?php echo $district->name; ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		<span class="dnone gotham-light error-input-message">* District Required </span>
	</div>

</div>
       
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myprofile customer-info clearleft clearright" style="padding-top: 30px;">
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright clearleft">
	<input type="submit" value="UPDATE" id="submit-installment" class="round-btn-blue" style="width:100%;"> 
</div>

</form> 
            </div>
        </div>
    </div>
</section>
<style type="text/css">
        .btn-submit-o:hover {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #fff;
        color: #9e8463;
        font-family: "gotham-light";
        font-size: 0.8em;
        float: right;
    }
    .btn-submit-o {
        border: 1px solid;
        cursor: pointer;
        padding: 11px 20px;
        letter-spacing: 2px;
        background: #9e8463;
        color: #fff;
        font-family: "gotham-light";
        font-size: 0.8em;
        float: right;
    }
    select.year{
        height:40px;
    }
</style>
<script>
    function checkDistrict() {
        var state_id = document.getElementById('state-profile').value;

        if (state_id != 0) {
            $.ajax({
                type: "POST",
                url: baseUrl + '/shipping/generate-district-profile',
                data: {"state_id": state_id},
                beforeSend: function () {

                },
                success: function (data) {
                    $("div.district").html(data);
                }
            });
        }
    }
</script>