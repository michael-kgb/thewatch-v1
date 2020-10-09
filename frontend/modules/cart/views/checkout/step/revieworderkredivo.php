<?php



use yii\web\Session;



$sessionOrder = new Session();

$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

$cart = $sessionOrder->get("cart");

$items = $cart['items'];



$transaction_id = \backend\models\Orders::find()->where(['reference' => $_SESSION['lastOrder']['order_number']])->one();

$items = backend\models\OrderDetail::find()->where(['orders_id' => $transaction_id['orders_id']])->all();



$orderCartRule = \backend\models\OrderCartRule::findOne(["orders_id" => $transaction_id->orders_id]);



$weight = 0;



foreach($items as $row){

    $item[0] = array('weight' => $row->product_weight, 'quantity' => $row->product_quantity);

    $weight = $weight + common\components\Helpers::generateWeightOrder($item);

}



$totalItems = count([$items]);



?>



<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/MDFjYjljZDktZjMwZS00YWIyLWFhYjgtZTNlNzhmMTVlZTk4"></script>-->



<script>

var dataLayer = [],

	items = [];



var totalCart = <?php echo $totalItems; ?>;



if(totalCart > 0){

	<?php $i = 1; ?>

	<?php foreach ($items as $item) { ?>

	<?php $productId = backend\models\Product::findOne(["product_id" => $item['product_id']]); ?>

	

	items.push({

		"id": <?php echo $item['product_id']; ?>,

		"name": "<?php echo $item['product_name']; ?>",

		"price": "<?php echo $item['original_product_price']; ?>",

		"brand": "<?php echo $productId->brands->brand_name; ?>",

		"category": "<?php echo $productId->productCategory->product_category_name; ?>",

		"position": <?php echo $i; ?>,

		"quantity": <?php echo $item['product_quantity']; ?>

	});

	<?php $i++; ?>

	<?php } ?>



	dataLayer.push({

		"event": "checkout",

		"ecommerce": {

			"checkout": {

				"actionField": {

					"step": 4

				},

				"products": items,

			}

		}

	});

}

</script>





<script>

// var baseUrl = '<?php echo \Yii::$app->params['frontendUrl']; ?>';
var baseUrl = '<?= \yii\helpers\Url::home(true); ?>';

// function redirect() {

  window.location.replace(baseUrl + '/payment/kredivo-checkout');

  // return false;

// }    

</script>