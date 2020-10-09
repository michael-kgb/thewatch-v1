<?php

use yii\web\Session;

$sessionOrder = new Session();
$sessionOrder->open();
$customerInfo = $sessionOrder->get("customerInfo");
$cart = $sessionOrder->get("cart");
$items = $cart['items'];

/*
$promoPermata = [
    850, 851, 813, 814, 817, 818, 819, 872, 823, 824, 881, 873, 1064, 1063, 826,
	1060, 884, 828, 1688, 1495, 1494, 1493, 1491, 1488, 1487, 1499, 1500, 1484,
	1503, 876, 877, 832, 1125, 804, 1127, 840, 842, 845, 1507, 1315, 1316, 1317, 
	1318, 1319, 1320, 1321, 1322, 1323, 1324, 1325, 1326, 1685, 1687, 1468, 1403, 
	1404, 88, 89, 90, 91, 92, 93, 94, 95, 97, 98, 99, 100, 101, 102, 103, 104, 105,
	106, 107, 108, 109, 110, 114, 115, 117, 118, 119, 120, 121, 122, 123, 124, 125,
	126, 127, 128, 129, 130, 131, 133, 170, 172, 365, 367, 378, 382, 438, 439, 440,
	441, 442, 443, 444, 445, 446, 447, 448, 449, 450, 451, 452, 454, 455, 456, 457,
	458, 459, 460, 461, 462, 463, 464, 465, 466, 467, 468, 469, 470, 471, 472, 1024,
	1025, 1027, 1028, 1029, 1030, 1032, 1034, 1327, 1328, 1329, 1330, 1332, 1333, 1334,
	1335, 1337, 1338, 1339, 1340, 1341, 1342, 1457, 1458, 1459, 1460, 1581, 1582, 1583,
	1584, 1683, 1684, 1692, 1693, 1816, 1819, 1820, 1821, 1822, 1823, 1824, 1825, 1826,
	1827, 2026, 2028, 2029, 2030, 2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 
	2040, 2041, 2130, 2132, 2134, 2136, 2137, 2139, 2140, 2141, 2143, 2144, 2145, 2146,
	2147, 2148, 2149, 2150, 2151, 2152, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 2160,
	2161, 2162, 2163, 2164, 2165, 2166, 2167, 2201, 2202, 2203, 2204, 2205, 2206, 2207,
	2208, 2209, 2210, 2211, 2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221,
	2222, 2223, 2224, 2225, 2226, 2227, 2228, 2229, 2230, 2231, 2232, 2233, 2234, 2235,
	2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245, 2246, 2247, 2248, 2249,
	2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383, 2384, 2385, 2386, 2387,
	2388, 2389, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2445, 2446, 2447, 2449, 2450, 
	2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459, 2460, 2461, 2462, 2463, 194, 
	193, 300, 302, 308, 7, 8, 1811, 1461, 6, 9, 312, 313, 314, 315, 555, 556, 1512, 1520,
	2057, 2058, 2059, 2061, 2062, 2063, 2064, 2065, 2067, 2068, 2070, 2073, 2074, 2075,
	2076, 2077, 2078, 2079, 2080, 2081, 2082, 2083, 2084, 2085, 2086, 2087, 2088, 2089,
	2403, 2405, 2406, 2407, 2408, 2409, 2410, 2441, 2442, 2443, 2444, 593, 596, 694, 695,
	113, 146, 153, 213, 217, 220, 225, 227, 228, 229, 232, 316, 317, 318, 319, 320, 321,
	322, 323, 325, 326, 327, 328, 329, 330, 331, 332, 334, 336, 338, 339, 340, 342, 343,
	344, 345, 346, 348, 349, 350, 351, 352, 353, 354, 355, 356, 357, 358, 359, 360, 361,
	362, 363, 364, 366, 368, 369, 370, 371, 374, 375, 376, 377, 379, 380, 381, 534, 535,
	537, 538, 539, 775, 776, 777, 778, 779, 780, 781, 782, 783, 784, 785, 787, 788, 789,
	793, 796, 797, 798, 801, 802, 2132, 2134, 2228, 2388, 2394, 2396, 2397, 1668, 1669,
	1670, 1671, 1672, 1673, 1676, 1677, 1154, 1177, 264, 1153, 981, 984, 985, 986, 990, 
	992, 995
];
$hasPromoPermata = FALSE;
$promoPermataCode = '';
*/
$transaction_id = \backend\models\Orders::find()->where(['reference' => $orders->reference])->one();
$items = backend\models\OrderDetail::find()->where(['orders_id' => $orders->orders_id])->all();

$orderCartRule = \backend\models\OrderCartRule::findOne(["orders_id" => $transaction_id->orders_id]);

$weight = 0;

function generateWeight(){
	$i = 0;
	$weight = 0;

	foreach ($items as $row) {
		$weight = $weight + ($row->product_weight * $row->product_quantity);
		$i++;
	}

	if ($weight < 1000) {
		$weight = 1000;
	}

	$weight = round($weight / 1000, 0, PHP_ROUND_HALF_UP);
	
	return $weight;
}

$weight = generateWeight($items);

function iPay88_signature($source) {
    return base64_encode(hex2bin2(sha1($source)));
}

function hex2bin2($hexSource) {
    $bin = '';
    for ($i = 0; $i < strlen($hexSource); $i = $i + 2) {
        $bin .= chr(hexdec(substr($hexSource, $i, 2)));
    }
    return $bin;
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

<section id="shopping-bag">


                       
                    
          

            <div class="col-lg-12 col-md-12 col-sm-12 step-purchase shipping box clearleft clearright">
				<!--
                <form method="post" name="ePayment" action="https://payment.ipay88.co.id/epayment/entry.asp" id="confirm-installment">
				-->
                <form method="post" name="ePayment" action="<?php echo \Yii::$app->params['ipay_conf']['api_url']; ?>" id="confirm-installment">
                    <?php
                    $refno = $orders->reference;
                    $amount = $grandtotal;
                    $amount00 = '00';
                    $currency = "IDR";
                    $xfield1 = '';

                    if(YII_ENV !== 'prod'){
                        $merchantcode = "ID00071";
                        $merchantkey = "Y2IoTLdbZu";
                    }else{
                        if ($_SESSION['customerInfo']['paymentMethod']['installment_plan'] == "i3m") {
                            $merchantkey = "OCz9QkknOC";
                            $merchantcode = "ID00071_S0001";
                            $xfield1 = "||IPP:3||";
                        } else if ($_SESSION['customerInfo']['paymentMethod']['installment_plan'] == "i6m") {
                            $merchantkey = "yyoKGX6b35";
                            $merchantcode = "ID00071_S0002";
                            $xfield1 = "||IPP:6||";
                        } else if ($_SESSION['customerInfo']['paymentMethod']['installment_plan'] == "i12m") {
                            $merchantkey = "ObaoTJs1Hx";
                            $merchantcode = "ID00071_S0003";
                            $xfield1 = "||IPP:12||";
                        } else {
                            $merchantkey = "Y2IoTLdbZu";
                            $merchantcode = "ID00071";
                        }
                    }
					
					//if($hasPromoPermata){
						//$promoPermataCode = '||promopermata:5||';
						//$source = $merchantkey . $merchantcode . $refno . $amount . $amount00 . $currency . $xfield1 . $promoPermataCode;
					//} else {
						$source = $merchantkey . $merchantcode . $refno . $amount . $amount00 . $currency . $xfield1;
					//}
                    
                    

                    ?>

                    <input type="hidden" name="MerchantCode" value="<?php echo $merchantcode; ?>">
                    <input type="hidden" name="PaymentId" value="1">
                    <input type="hidden" name="RefNo" value="<?php echo $orders->reference; ?>">
                    <input type="hidden" name="Amount" value="<?php echo $amount . '00'; ?>">
                    <input type="hidden" name="Currency" value="IDR">
                    <input type="hidden" name="ProdDesc" value="Pembayaran Menggunakan Credit Card">
                    <input type="hidden" name="UserName" value="<?php echo $_SESSION['customerInfo']['fname'] . ' '. $_SESSION['customerInfo']['lname']; ?>">
                    <input type="hidden" name="UserEmail" value="<?php echo $_SESSION['customerInfo']['email']; ?>">
                    <input type="hidden" name="UserContact" value="<?php echo $_SESSION['customerInfo']['shippingInformation'][0]['phone']; ?>">
                    <input type="hidden" name="Remark" value="Pembayaran Menggunakan Credit Card">
                    <input type="hidden" name="Lang" value="UTF-8">
                    <input type="hidden" name="Signature" value="<?php echo iPay88_signature($source); ?>">
					<?php //if($hasPromoPermata){ ?>
					<!--<INPUT type="hidden" name="xfield1" value="<?php echo $xfield1.$promoPermataCode; ?>">-->
					<?php //} else { ?>
					<input type="hidden" name="xfield1" value="<?php echo $xfield1; ?>">
					<?php //} ?>
                    <input type="hidden" name="ResponseURL" value="<?php echo \Yii::$app->params['frontendUrl'];?>/tools/respon">
                    <input type="hidden" name="BackendURL" value="<?php echo \Yii::$app->params['frontendUrl'];?>/tools/responbackend">
                    <!-- <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/paymentinformation" class="shipping-information position-left">PAYMENT DETAILS</a> -->
                    
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="loadingScreen" tabindex="-1" role="dialog" aria-hidden="true">
        
    </div>
<script type="text/javascript">
    // document.getElementById('loadingScreen').modal('show');
    document.getElementById('confirm-installment').submit(function() {
  // your code here
  document.getElementById('loadingScreen').modal('show');
});
    // document.getElementById('confirm-installment').submit(); 
    // document.getElementById('loadingScreen').modal('show');

</script>