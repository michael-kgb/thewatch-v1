<?php

use yii\web\Session;
use app\assets\VeritransAsset;
use backend\models\CustomerAddress;

// use yii\widgets\ActiveForm;
$_SESSION['customerInfo']['shippingMethod']['shipping_insurance'] = 1;

$sessionOrder = new Session();
$sessionOrder->open();
$cart = $sessionOrder->get("cart");
$items = $cart['items'];
$reduction = 0;
$discount = 0;
$total_discount = 0;
$reduction_xtra = 0;
$discount_extra = 0;
$reduction_plus_xtra = 0;
$discount_plus_extra = 0;
$subtotal = 0;
$subtotal_original = 0;
$shippingInsurance = 0;
$grandTotal = 0;
$grandOriginalTotal = 0;

VeritransAsset::register($this);

$totalItems = count($cart['items']);
$voucherInfo = $sessionOrder->get("voucherInfo");
$payment_restrict = 0;
if(isset($voucherInfo)){
    $cart_rule = \backend\models\CartRule::find()->where(['cart_rule_id'=>$voucherInfo['cart_rule_id']])->one();
    if($cart_rule->payment_restriction == 1){
        $cart_rule_payment = \backend\models\CartRulePaymentMethod::find()->where(['cart_rule_id'=>$voucherInfo['cart_rule_id']])->one();
        $payment_restrict = $cart_rule_payment->payment_method_id;
    }
}
// CHECK IF FLASH SALE
$flash_cart = 0;
if($totalItems > 0){
    foreach ($items as $item) {
        if($item['flash_sale'] == 1){
            $flash_cart = 1;
            $reduction += $item['discount'];
            $discount += $item['discount_amount'];
            $reduction_xtra += $item['discount_extra'];
            $discount_extra += $item['discount_amount_extra'];
            $reduction_plus_xtra += $item['discount_plus_extra'];
            $discount_plus_extra += $item['discount_amount_plus_extra'];
            $subtotal += $item['total_price'];
            $subtotal_original += $item['original_total_price'];
        }else{
			if($voucherInfo['code']=="17AGUSTUS"){
				
				$reduction += $item['discount'];
			
				$discount = $voucherInfo['reduction_amount'];
			
				$subtotal += $item['total_price'];
				$subtotal_original += $item['original_total_price'];
			}else{
				$reduction += $item['discount'];
				$discount += ($voucherInfo['reduction_percent'] / 100) * $item['total_price'];
				
				$subtotal += $item['total_price'];
				$subtotal_original += $item['original_total_price'];
			}
			
		}
    }

    $discount += $voucherInfo['reduction_amount'];
} else {
	// logic for empty items
}

// CHECK IF PRE ORDER
$pre_order = 0;
if($totalItems > 0){
    foreach ($items as $item) {
        if($item['pre_order'] == 1){
            $pre_order = 1;
        }
    }
}

?>

<?php 
$current_date = date('Y-m-d H:i:s');
/*
if($grandTotal >= 1000000 && $current_date >= '2018-12-01 00:00:00' && $current_date <= '2018-12-16 23:59:59'){
	$vospayPromoAmount = ($grandTotal * 0.70);
	$vospayDiscount = 70;
	$vospayGrossAmount = round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount);

	if($vospayPromoAmount >= 500000){
		$vospayPromoAmount = $vospayMaxDiscount;
		$vospayGrossAmount = round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount);
	}
}

elseif($grandTotal >= 1000000 && $current_date >= '2019-02-09 00:00:00' && $current_date <= '2019-03-31 23:59:59'){
	$vospayPromoAmount = ($grandTotal * 0.30);
	$vospayDiscount = 30;
	$vospayGrossAmount = round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount);

	if($vospayPromoAmount >= 500000){
		$vospayPromoAmount = $vospayMaxDiscount;
		$vospayGrossAmount = round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount);
	}
}

else{
	$vospayGrossAmount = round(($grandTotal + $shippingCost + $shippingInsurance) - $discount);
}
*/

?>

<!--<script async="true" src="//ssp.adskom.com/tags/third-party-async/OWZmY2IxY2MtODQzZC00NzFjLTk5ZmMtY2E4ZWIzYzA0M2Vk"></script>-->

<script>
//var hasPromoPermata = 0;
//var promoMandiriAmount = 0;
var items = [];
/**/
var permataBin = [
	'46400588', '48938588', '471295', '46400577',
	'48938577', '48948577', '426254', '464005',
    '426254323', '549846', '554302', '461785', 
    '544741', '518943', '518881', '520142', '520143', 
    '520153', '540889', '498853', '528872',
    '510505', '520366', '520370', '520371', '520383', 
    '543972', '542167', '454633', '498885', 
    '461753', '49885329', '49885327', '5408', '476334', 
    '453574'
];
var mandiriBin = [
	'490284', '490283', '437527', '437528', '437529', '450183', '450184', '450185',
	'400376', '489764', '400378', '415031', '415016', '415030', '415032', '415018',
	'415017', '416230', '416231', '416232', '400385', '400479', '400481', '479929',
	'479930', '479931', '421195', '427797', '421313', '445076', '425945', '413719', 
	'413718', '557338', '524325', '512676', '414931', '537793', '356350'
];

var citibankBin = [
    '454179', '454178', '414009', '552042', '540184', '542177', '461778', '425864', 
	'529758', '559742', '559909', '508249'
];

var megaBin = [
	'420191', '420192', '420194', '472670', '478487', '489087', '426211',
	'524261', '431226', '420194041'
];

var bcaBin = [
	'455633', '483545', '477377', '455632', '542643', '445377'
];


/**/

var totalCart = <?php echo $totalItems; ?>;
<?php $hasPromoBCACC = 0; ?>
<?php $promoBCAAmountCC = 0; ?>
<?php $hasPromoMandiriCC = 0; ?>
<?php $promoMandiriAmountCC = 0; ?>
<?php $hasPromoPermataCC = 0; ?>
<?php $promoPermataAmountCC = 0; ?>
<?php $hasPromoCIMBCC = 0; ?>
<?php $promoCIMBAmountCC = 0; ?>
<?php $hasPromoDanamonCC = 0; ?>
<?php $promoDanamonAmountCC = 0; ?>
<?php $hasPromoHSBCCC = 0; ?>
<?php $promoHSBCAmountCC = 0; ?>
<?php $hasPromoCharteredCC = 0; ?>
<?php $promoCharteredAmountCC = 0; ?>
<?php $hasPromoPaninCC = 0; ?>
<?php $promoPaninAmountCC = 0; ?>
<?php $promoCreditCardAmount = 0; ?>
<?php $reductionDiscount = 0; ?>

if(totalCart > 0){
	
	<?php $i = 1; ?>
	<?php foreach ($cart['items'] as $item) { ?>
	<?php $product = \backend\models\Product::findOne(['product_id' => $item['id']]); ?>
	
	<?php 
    /* Temporary Comment
	   // discount 10%
	    $product_promos = \backend\models\Product::find()
			->where(['product.brands_brand_id'=>[48,44,79,2]])->all();
        $promoCreditCard = [];
        $i = 0;
        foreach ($product_promos as $product_promo) {
            $promoCreditCard[$i] = $product_promo->product_id;
            $i++;
        }
		
		
        // discount 5%
        $now = date('Y-m-d H:i:s');
        $product_promos_plus = \backend\models\Product::find()->joinWith(["specificPrice"])
				->where(['product.brands_brand_id'=>[48,44,79,2]])
				->andWhere('specific_price.from <= "'. $now . '"')
                ->andWhere('specific_price.to > "'. $now . '"')->all();
        $promoCreditCardDiscount = [];
        $i = 0;
        foreach ($product_promos_plus as $product_promo) {
            $promoCreditCardDiscount[$i] = $product_promo->product_id;
            $i++;
        }         
        
        
        // if($_SESSION['customerInfo']['customer_id'] == 22764){
            if($now >= '2019-04-01 00:00:01' && $now <= '2019-04-31 23:59:59'){
                if(in_array($item['id'], $promoCreditCardDiscount)){ 
                    $promoCreditCardAmount += ((0.05 * $item['unit_price']) * $item['quantity']); 
                    $haspromoCreditCard = 1; 
                    $reductionDiscount = 5;
                }else{
                    if(in_array($item['id'], $promoCreditCard)){ 
                        $promoCreditCardAmount += ((0.10 * $item['unit_price']) * $item['quantity']); 
                        $haspromoCreditCard = 1; 
                        $reductionDiscount = 10;
                    }
                }
            }
        // }
    */
		
		// special promo bank/payment bca credit card
		$promo_alias = 'bca-10-cc';
		$brands = array(48,44,79,85); // brands restrictions
		$is_discount_price = FALSE; // normal price
		$promo_bca_cc = \common\components\Helpers::getSpecialPromoProducts($promo_alias, $brands, $is_discount_price);
		if(in_array($item['id'], $promo_bca_cc['results'])){
			$promo_discount = ( (int)$promo_bca_cc['special_promo']['promo_amount']/100 );
			$promoBCAAmountCC += (($promo_discount * $item['unit_price']) * $item['quantity']);
			$hasPromoBCACC = 1; 
			$reductionDiscount = (int)$promo_bca_cc['special_promo']['promo_amount'];
		}
        
        
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
		
		$promoMandiriKomono = [
			2226, 2224, 2130, 2136, 2137, 2140, 2141, 2227, 2143, 2144, 2145, 2146, 2147, 2387,
			2389, 2148, 2149, 2151, 2152, 2153, 2154, 2158, 2160, 2161, 2162, 2163, 2164, 2165,
			2166, 2167, 2392, 2398, 2201, 2202, 2204, 2205, 2206, 2207, 2208, 2209, 2210, 2211,
			2212, 2213, 2214, 2215, 2216, 2217, 2218, 2219, 2220, 2221, 2445, 2446, 2447, 2231,
			2232, 2233, 2234, 2235, 2236, 2237, 2238, 2239, 2240, 2241, 2242, 2243, 2244, 2245,
			2246, 2247, 2248, 2249, 2250, 2251, 2252, 2253, 2378, 2379, 2380, 2381, 2382, 2383,
			2384, 2385, 2386, 2449, 2450, 2451, 2452, 2453, 2454, 2455, 2456, 2457, 2458, 2459,
			2460, 2461, 2462, 2463 
		];
		
		$promoMandiriTimex = [
			2048, 2049, 1788, 2090, 2097, 2098, 1792, 2099, 1793, 2111, 2112, 2113, 2114, 2115, 
			2116, 2092, 2094, 2102, 2104, 1803, 2168, 2107, 2109, 2110, 2254, 2169, 1736, 1737, 
			2171, 2091, 1802, 1743, 1746, 1748, 1749, 1750, 1751, 2100, 2101, 1731, 1732, 1786, 
			1794, 2172, 2173
		];
		
		if(in_array($item['id'], $promoPermata)){ 
			$hasPromoPermata = 1; 
		}
		
		if(in_array($item['id'], $promoMandiriKomono)){ 
			$promoMandiriAmount += ((0.20 * $item['unit_price']) * $item['quantity']); 
			round($promoMandiriAmount);
		}
		
		if(in_array($item['id'], $promoMandiriTimex)){ 
			$promoMandiriAmount += ((0.20 * $item['unit_price']) * $item['quantity']); 
			round($promoMandiriAmount);
		}
		
		
		// tambahan diskon +5%
		$promoTambahanMandiri = [
			1030, 1029, 1028, 1027, 1025, 1024, 88, 89, 90, 91, 92, 93, 94, 100, 101, 129, 
			130, 131, 133, 170, 172, 2201, 2202, 2203, 2204, 2205, 2215, 2213, 2456, 2219, 
			2218, 2451, 2463, 2119, 2139, 2150, 2153, 2154, 2155, 2156, 2157, 2158, 2159, 
			2392, 2393, 2095, 1789, 1790, 1791, 2096, 2097, 2098, 1792, 2099, 1793, 1787, 
			1788, 2090, 2170, 2092, 2093, 2094, 1733, 2048, 2049, 2102, 2103, 2104, 1809, 
			1803, 2168, 2105, 2106, 2107, 2108, 2109, 2110, 2111, 2112, 2113, 2114, 2115, 
			2116, 1738, 2254, 2169, 2100, 2101, 1731, 1732, 2171, 2091, 1801, 1802, 1786, 
			1794, 1796, 1797, 1798, 1799, 1800, 1734, 1735, 1736, 1737, 1741, 1742, 1743, 
			1744, 1745, 1746, 1747, 1748, 1749, 1750, 1751, 1804, 1805, 2172, 2173, 1806, 
			1807, 1808, 592, 608, 619, 621, 622, 633, 1010, 1012, 1187, 1188, 1192, 1195,
			1197, 1203, 1204, 1205, 1209, 1210, 1214, 1232, 1235, 1236, 1237, 1239, 1240, 
			1242, 1243, 1244, 1245, 1246, 1252, 1255, 1256, 1257, 1258, 1259, 1260, 1261, 
			1262, 1268, 1279, 1283, 1284, 1285, 656, 698, 699, 700, 701, 702, 890, 898, 
			899, 905, 906, 907, 908, 913, 914, 918, 919, 920, 926, 930, 939, 941, 949, 
			963, 968, 1529, 1533, 1535, 1538, 1539, 1541, 464, 458, 457, 456, 455, 454,
			452, 451, 450, 449
		];
		
		// promo mandiri brand normal price +10%
		$promoNormalPriceMandiri = [
			"Timex", "Daniel Wellington", "Komono", "Casio", "Citizen", "Welder", "Nam Watches", "Lima", "Sirocco"
		];
		
		if(in_array($item['id'], $promoTambahanMandiri)){ 
			$promoMandiriAmount += ((0.05 * $item['unit_price']) * $item['quantity']); 
			round($promoMandiriAmount);
		}
		
		elseif(in_array($item['brand_name'], $promoNormalPriceMandiri)){ 
			$promoMandiriAmount += ((0.10 * $item['unit_price']) * $item['quantity']); 
			round($promoMandiriAmount);
		}
		*/
	?>
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
    <?php
        $promoCreditCardAmount = $promoBCAAmountCC + $promoMandiriAmountCC + $promoPermataAmountCC + $promoCIMBAmountCC + $promoDanamonAmountCC + $promoHSBCAmountCC + $promoCharteredAmountCC + $promoPaninAmountCC;
    ?>
	
	var hasPromoBCACC = <?php echo $hasPromoBCACC; ?>;
	var promoBCAAmountCC = <?php echo $promoBCAAmountCC; ?>;
	var hasPromoMandiriCC = <?php echo $hasPromoMandiriCC; ?>;
    var promoMandiriAmountCC = <?php echo $promoMandiriAmountCC; ?>;
	var hasPromoPermataCC = <?php echo $hasPromoPermataCC; ?>;
    var promoPermataAmountCC = <?php echo $promoPermataAmountCC; ?>;
	var hasPromoCIMBCC = <?php echo $hasPromoCIMBCC; ?>;
    var promoCIMBAmountCC = <?php echo $promoCIMBAmountCC; ?>;
	var hasPromoDanamonCC = <?php echo $hasPromoDanamonCC; ?>;
    var promoDanamonAmountCC = <?php echo $promoDanamonAmountCC; ?>;
	var hasPromoHSBCCC = <?php echo $hasPromoHSBCCC; ?>;
    var promoHSBCAmountCC = <?php echo $promoHSBCAmountCC; ?>;
	var hasPromoCharteredCC = <?php echo $hasPromoCharteredCC; ?>;
    var promoCharteredAmountCC = <?php echo $promoCharteredAmountCC; ?>;
	var hasPromoPaninCC = <?php echo $hasPromoPaninCC; ?>;
    var promoPaninAmountCC = <?php echo $promoPaninAmountCC; ?>;
    var promoCreditCardAmount = <?php echo $promoCreditCardAmount; ?>;
	var reductionDiscount = <?php echo $reductionDiscount; ?>;
	var vospay_env = "<?php echo Yii::$app->params['vospay_conf']['environment'];?>" // vospay env
	var vospay_mrchnt = "<?php echo Yii::$app->params['vospay_conf']['mrchnt_key'];?>" // vospay merchant_key

	dataLayer.push({
	  "event": "checkout",
	  "ecommerce": {
		"checkout": {
		  "actionField": {
			"step": 2
		  },
		  "products": items,
		}
	  }
	});
}

fbq('track', 'AddPaymentInfo');
</script>
<?php 

?>
<?php if($sessionOrder->get("cart") == null){ ?>
<section id="" style="padding-bottom: 0;padding-top: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden-sm hidden-xs shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-1.png" class="width100" style="padding-top: 0;">
            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-1-mobile.png" class="width100" style="padding-top: 0;">
            </div>
            
        </div>
    </div>
</section>
<section id="" style="padding-top: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright">
                <div class="col-xs-12 remove-padding padding-top-2 padding-bottom-2 clearleft clearright">
                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 gotham-light shopping-bag clearleft ">
                        PRODUK
                    </div>
                    <div class="hidden-xs col-lg-4 col-md-4 col-sm-4 col-xs-4 gotham-light shopping-bag remove-padding ">
                        DESKRIPSI PRODUK
                    </div>
                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag remove-padding quantity ">
                        JUMLAH
                    </div>
                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag unit-price remove-padding unit-price ">
                        HARGA PRODUK
                    </div>
                    <div class="hidden-xs col-lg-2 col-md-2 col-sm-2 col-xs-4 gotham-light shopping-bag unit-price remove-padding unit-price ">
                        HAPUS
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>
        </div>
        
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                
                        KERANJA BELANJA KOSONG
            
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xs-12 hidden-md hidden-sm shopping-bag product separator clearleft clearright" style="padding-top: 1%;"></div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 shopping-bag clearleft clearright" style="text-align: center;padding-top: 20px;padding-bottom: 20px;">
                
                        <a href="http://thewatch.co" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">LANJUT BELANJA</a>
            
            </div>
        </div>
        
    </div>
</section>
<?php }else{ ?>
<section id="" style="padding-bottom: 0;padding-top: 20px;">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden-sm hidden-xs shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-2.png" class="width100" style="padding-top: 0;">
            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 shopping-bag clearleft clearright">
                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/step/step-2-mobile.png" class="width100" style="padding-top: 0;">
            </div>
            
        </div>
    </div>
</section>
<section id="shopping-bag" class="payment-info" style="padding-top: 20px;">
    <div class="container clearleft clearright">
        <div class="col-lg-6 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile payment-layout-1" style="">
            <div class="col-lg-6 col-xs-12 clearleft clearleft-mobile clearright-mobile pdr75" style="">
                <div class="col-lg-12 col-xs-12 clearright clearleft clearleft-mobile clearright-mobile payment-method rgb243 metode-pembayaran-title-mobile bradius5" style="min-height:39px;">
                    <label class="metode-pembayaran-title">
                        METODE PEMBAYARAN
                    </label>
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/bulkhead/installment_black.png" class="" style="width: 15px;margin-left: 8px;">
                    
                </div>
                <?php 
					session_start();                           
					$unique_code = \common\components\Helpers::generateUniqueCode();
					$_SESSION['customerInfo']['unique_code'] = $unique_code;
				?>
                <div class="hidden-lg col-xs-12 hidden-sm hidden-md rgb243 payment-detail-mobile" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;z-index: 1;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright gotham-medium clearleft-mobile clearright-mobile fcolor69" style="font-size:14px;padding-bottom: 10px;">
                            Detail Tagihan
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile fcolor69">
                                Sub Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
									if($flash_cart !== 1){
										echo 'IDR ' . common\components\Helpers::getPriceFormat($subtotal);
									}else{
										echo 'IDR ' . common\components\Helpers::getPriceFormat($subtotal_original);
									}
                                ?>
                            </div>
                        </div>
						<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Voucher Diskon
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                if($flash_cart !== 0){
                                    $discount = $reduction;
                                } 
                                echo $discount != 0 ? 
                                'IDR ' . common\components\Helpers::getPriceFormat($discount) 
                                : 
                                '-' ; 
                                $total_discount += $discount;
                                ?>
                            </div>
                        </div>-->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                
                                if($flash_cart !== 0){
                                    $discount = $reduction;
                                } 
                                
                                echo $discount != 0 ? 
                                'IDR ' . common\components\Helpers::getPriceFormat($discount) 
                                : 
                                '-' ; 
                                $total_discount += $discount;
                                ?>
                            </div>
                        </div>
                        <?php if ($reduction_xtra > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon Ekstra
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php echo $reduction_xtra == 0 ? '-' :  'IDR ' . common\components\Helpers::getPriceFormat($reduction_xtra); 
                                $total_discount += $reduction_xtra;
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($reduction_plus_xtra > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon Plus Ekstra
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php echo $reduction_plus_xtra == 0 ? '-' :  'IDR ' . common\components\Helpers::getPriceFormat($reduction_plus_xtra); 
                                $total_discount += $reduction_plus_xtra;
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 unique separator clearleft clearright clearleft-mobile clearright-mobile" style="display: none;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Unique Code
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright unique_code clearleft-mobile clearright-mobile" style="text-align: right;">
                               <?php
                                echo $unique_code;
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Biaya Kirim
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                    echo  'IDR ' . \common\components\Helpers::getPriceFormat($shippingCost);
                                ?>
                            </div>
                        </div>
                        <?php $shippingInsurance = 0; ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Asuransi Pengiriman
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
									$shippingInsurance = $_SESSION['customerInfo']['shippingMethod']['shipping_insurance'];
									if($shippingInsurance){
										$shippingInsurance = $subtotal_original;
										$shippingInsurance = (($shippingInsurance * 0.5) / 100);
									}
                                    echo  'IDR ' . \common\components\Helpers::getPriceFormat($shippingInsurance);
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator special-promo clearleft clearright clearleft-mobile clearright-mobile" style="display:none;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator special-promo-name clearleft gotham-light clearleft-mobile clearright-mobile">
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator special-promo-amount clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright" style="border-bottom: solid 0.5px rgb(69,69,69);padding-bottom: 10px;">
                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;padding-bottom: 15px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Grand Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-without-trf clearright clearleft gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php 
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                
                                ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-trf clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php 
                                
                                    if($flash_cart !== 1){
										echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}else{
										echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}
									
								?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-special-promo clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                 ?>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding padding-top-5 margin-top-1" style="padding-top:5px;">
                            <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryinformation" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">Kembali</a>
                        
                        </div> -->
                    </div>

                <div class="hidden-lg col-xs-12 hidden-sm rgb243 payment-detail-mobile-close" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;z-index: 1;display: none;">
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;padding-bottom: 15px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-medium clearleft-mobile clearright-mobile">
                                Grand Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-without-trf clearright clearleft gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php 
                                    
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                
                                 ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-trf clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php 
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}else{
										echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}
                                
                                
                                 ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-special-promo clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php 
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                
                                ?>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding padding-top-5 margin-top-1" style="padding-top:5px;">
                            <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryinformation" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">Kembali</a>
                        
                        </div> -->
                    </div>

                
                <?php if($payment_restrict == 0 || $payment_restrict == 1){ ?>
                    <?php
                        // hide Bank Transfer only for Flash Sale 
                        if($flash_cart == 0){?>
				<!--HAFIIZH HIDDEN BANK TRANSFER-->
                <div id="bt_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="margin-top: 15px;">
                    <div class="col-lg-12 col-xs-6">
                        <label class="metode-pembayaran-title list">
                            Bank Transfer
                        </label>
                    </div>
                    <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                        <label class="metode-lain">
                            <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                        </label>               
                    </div>
                        <?php if($pre_order == 0){ ?>
                            <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 1]); ?>
                            <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 1])->andWhere(['<>','payment_id',26])->andWhere(['<>','payment_id',30])->all(); ?>
                            <?php foreach($payment_method_detail as $row){ ?> 
                                <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id,'active'=>1]); ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                                <div class="radio-btn" style="margin-left: 18px;">
                                    <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                    <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                        <div class="img-bank">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 70px;">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 1]); ?>
                            <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 1])->andWhere(['payment_id'=>30])->all(); ?>
                            <?php foreach($payment_method_detail as $row){ ?> 
                                <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                                <div class="radio-btn" style="margin-left: 18px;">
                                    <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                    <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                        <div class="img-bank">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 70px;">
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <div class="col-lg-12 col-xs-12" style="padding-top: 15px;"></div>

                                         
                </div>
                <div class="col-lg-12 col-xs-12 padding-all-method" style="padding-top: 15px;"></div>
                <?php   }?>
                <?php } ?>
                
                <?php if($payment_restrict == 0 || $payment_restrict == 3){ ?>
                <div id="i_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="">
                    <div class="col-lg-12 col-xs-6">
                        <label class="metode-pembayaran-title list">
                            Cicilan 0%
                        </label>
                    </div>
                    <?php if($pre_order == 0){ ?>
                        <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                            <label class="metode-lain">
                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                            </label>               
                        </div>
                        <div class="col-lg-12 col-xs-12" style="padding-top: 10px;"></div>
                        <?php $boundary = 0; ?>
                        <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 3]); ?>
                        <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 3])->andWhere(['<>','payment_id',[19,13,26]])->all(); ?>
                        <?php foreach($payment_method_detail as $row){ ?> 
                        <!-- 16 danamon
                        14 cimb 
                        7 mandiri
                        18 standard chartered
                        29 panin
                        17 hsbc-->

                        <?php if($row->payment_id != 13 && $row->payment_id != 12 && $row->payment_id != 18){ ?>
                            <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                           
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                            <!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
                            <div class="img-bank">
                                <img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
                            </div>-->
                            <div class="radio-btn" style="margin-left: 18px;">
                                <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                    <div class="img-bank">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 70px;">
                                    </div>
                                </label>
                            </div>
                        </div>
                      
                        <?php $boundary++; ?>
                        <?php if($boundary == 2){ ?>
                            <div class="col-lg-12 col-xs-12" style="padding-top: 15px;"></div>
                            <?php $boundary = 0; } ?>
                        <?php } ?>
                        <?php } ?>
                      
                    <?php } ?>
                                         
                </div>
                <?php } ?>

            </div>
            <div class="col-lg-6 col-xs-12 clearright clearleft-mobile clearright-mobile pdl75" style="">
                <div class="hidden-lg col-xs-12 padding-all-method" style="padding-top: 15px;"></div>
                
                <?php if($payment_restrict == 0 || $payment_restrict == 6){ ?>
                <div id="va_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="">
                        <div class="col-lg-12 col-xs-6">
                            <label class="metode-pembayaran-title list">
                                Virtual Account
                            </label>
                        </div>
                        
                    <?php if($pre_order == 0){ ?>
                    
                        <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                            <label class="metode-lain">
                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                            </label>               
                        </div>
                        
                        <div class="col-lg-12 col-xs-12" style="padding-top: 15px;"></div>
                        <?php $boundary = 0; ?>
                        <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 6]); ?>
                        <?php 
                            $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 6])->all(); 
                            // $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 6])->andWhere(['<>','payment_id',[23]])->all(); 
                        ?>
                        <?php foreach($payment_method_detail as $row){ ?> 
                            <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                            <!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
                            <div class="img-bank">
                                <img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
                            </div>-->
                            <div class="radio-btn" style="margin-left: 18px;">
                                <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                    <div class="img-bank">
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 70px;">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <?php $boundary++; ?>
                        <?php if($boundary == 2){ ?>
                            <div class="col-lg-12 col-xs-12" style="padding-top: 12px;"></div>
                            <?php $boundary = 0; } ?>
                        <?php } ?>
						
						
						
                        <div class="hidden-lg col-xs-12" style="padding-top: 12px;"></div>
                    <?php } ?>
                                         
                </div>

                <div class="col-lg-12 col-xs-12 padding-all-method" style="padding-top: 15px;"></div>
                <?php } ?>
                
                <?php if($payment_restrict == 0 || $payment_restrict == 9){ ?>
                 <div id="w_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="">
                    <div class="col-lg-12 col-xs-6">
                        <label class="metode-pembayaran-title list">
                            E-Wallet
                        </label>
                    </div>
                    
                    <?php if($pre_order == 0){ ?>
                    
                        <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                            <label class="metode-lain">
                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                            </label>               
                        </div>
                       
						<?php $boundary = 0; ?>
                        <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 9]); ?>
                        <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 9])->all(); ?>
                        <?php foreach($payment_method_detail as $row){ ?> 
                            <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                            <div class="radio-btn" style="margin-left: 18px;">
                                <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                    <div class="img-bank" style="width: 130px;">
                                        <?php
                                            if((date("Y-m-d H:i:s") > date('Y-m-10 00:00:00')) && (date("Y-m-d H:i:s") <= date('Y-m-17 23:59:59'))){
                                                echo "<span class='gotham-medium'></span>";
                                            }
                                        ?>
                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 70px;display: inline;padding-bottom: 5px;">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <?php $boundary++; ?>
                        <?php if($boundary == 2){ ?>
                            <div class="col-lg-12 col-xs-12" style="padding-top: 12px;"></div>
                            <?php $boundary = 0; } ?>
                        <?php } ?>
						
						<?php ?>
					<?php } ?>
                                         
                </div>

                <div class="col-lg-12 col-xs-12 padding-all-method" style="padding-top: 15px;"></div>
                <?php } ?>
                
                
                <div id="mf_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="">
                    
                        <div class="col-lg-12 col-xs-6">
                            <label class="metode-pembayaran-title list">
                                Multi Finance
                            </label>
                        </div>
                    <?php if($pre_order == 0){ ?>
                        <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                            <label class="metode-lain">
                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                            </label>               
                        </div>
                            <div class="col-lg-12 col-xs-12" style="padding-top: 4px;"></div>
                        
                        <?php if($payment_restrict == 0 || $payment_restrict == 4){ ?>
                        
                            <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 4]); ?>
                            <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 4])->andWhere(['<>','payment_id',26])->all(); ?>
                            <?php foreach($payment_method_detail as $row){ ?> 
                                <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                                <!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
                                <div class="img-bank">
                                    <img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
                                </div>-->
                                <div class="radio-btn" style="margin-left: 18px;">
                                    <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                    <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                        <div class="img-bank">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 60px;">
                                        </div>
                                    </label>
                                </div>
                            </div>
                      
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if($payment_restrict == 0 || $payment_restrict == 5){ ?>
                        
                            <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 5]); ?>
                            <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 5])->andWhere(['<>','payment_id',26])->all(); ?>
                            <?php foreach($payment_method_detail as $row){ ?> 
                                <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding">
                                <!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
                                <div class="img-bank">
                                    <img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
                                </div>-->
                                <div class="radio-btn" style="margin-left: 18px;">
                                    <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                    <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 0px;margin-bottom: 0;">
                                        <div class="img-bank">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 33px;">
                                        </div>
                                    </label>
                                </div>
                            </div>
                      
                            <?php } ?>
                        <?php } ?>
                            
    					<?php if($payment_restrict == 0 || $payment_restrict == 8){ ?>
    						<?php //if($flash_cart == 0){ ?>
    					
    						<?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 8]); ?>
    						<?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 8])->andWhere(['<>','payment_id',26])->all(); ?>
    						<?php foreach($payment_method_detail as $row){ ?> 
    							<?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
    						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding" style="padding-top: 15px;">
    							<!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
    							<div class="img-bank">
    								<img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
    							</div>-->
    							<div class="radio-btn" style="margin-left: 18px;">
    								<input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
    								<label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 0px;margin-bottom: 0;">
    									<div class="img-bank" style="width: 120px;">
    										<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 105px; margin-top: 9px;">
    									</div>
    								</label>
    							</div>
    						</div>
    				  
    						<?php } ?>
    						<?php //} ?>
    					<?php } ?>
    						
    					<div class="col-lg-12 col-xs-12" style="padding-top: 15px;"></div>
                    <?php } ?>
                                         
                </div>
                
            </div>
            <div class="col-lg-12 col-xs-12 padding-all-method" style="padding-top: 15px;"></div>

            <?php if($payment_restrict == 0 || $payment_restrict == 2){ ?>
                <div id="cc_frame" class="col-lg-12 col-xs-12 clearleft-mobile clearright-mobile clearright clearleft rgb243 bradius5" style="">
                    
                        <div class="col-lg-12 col-xs-6">
                            <label class="metode-pembayaran-title list">
                                Credit Card
                            </label>
                        </div>
                    <?php if($pre_order == 0){ ?>
                        <div class="hidden-lg col-xs-6" style="min-height: 50px;">
                            <label class="metode-lain">
                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                            </label>               
                        </div>
                           
                            <?php $boundary = 0; ?>
                            <?php $payment_method = \backend\models\PaymentMethod::findOne(['payment_method_id' => 2]); ?>
                            <?php $payment_method_detail = \backend\models\PaymentMethodDetail::find()->where(['payment_method_id' => 2])->andWhere(['payment_id'=>3])->all(); ?>
                            <?php foreach($payment_method_detail as $row){ ?> 
                                <?php $payment = \backend\models\Payment::findOne(['payment_id' => $row->payment_id]); ?>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6 clearleft remove-padding">
                                <!--    <input type="radio" id="bt" name="payment_method" class="payment-method-radio" value="1">
                                <div class="img-bank">
                                    <img src="/thewatchco1/img/icons/bca.png" class="img-responsive logo-payment">
                                </div>-->
                                <div class="radio-btn" style="margin-left: 18px;">
                                    <input type="radio" data-id="<?php echo $payment_method->payment_method_alias; ?>" id="<?php echo $row->payment_id; ?>" name="payment_method" method-id="<?php echo $payment_method->payment_method_id; ?>" class="payment-method-radio payment_method_u" value="<?php echo $row->payment_id; ?>" style="pointer-events: none;">
                                    <label for="<?php echo $row->payment_id; ?>" class="black-style" onclick="choose_payment(<?php echo $row->payment_id; ?>,<?php echo $payment_method->payment_method_id; ?>)" style="color: #000;padding-left: 10px;padding-top: 7px;">
                                        <div class="img-bank" style="width: 180px;">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $payment->filename;?>" class="img-responsive" style="width: 45px;display: inline-block;">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" class="img-responsive" style="cursor: pointer;width: 45px;display: inline-block;padding-top: 5px;">
                                            <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/jcb.png" class="img-responsive" style="cursor: pointer;width: 40px;display: inline-block;padding-left:5px;">
                                          
                                        </div>
                                    </label>
                                </div>
                            </div>
                           
                            <?php $boundary++; ?>
                            <?php if($boundary == 2){ ?>
                                <!- - <div class="col-lg-12" style="padding-top: 12px;"></div> - ->
                                <?php $boundary = 0; } ?>
                            <?php } ?>
                    <?php } ?>                 
                </div>

                <div class="col-lg-12 col-xs-12 padding-all-method" style="padding-top: 15px;"></div>
            <?php } ?>
        </div>
        <div class="col-lg-6 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile payment-layout-2" style="">
            <div class="col-lg-6 col-xs-12 clearright clearleft-mobile clearright-mobile payment-layout-3" style="">
                <div class="hidden-lg hidden-sm hidden-md col-xs-12" style="border-top:solid 1px rgb(151,151,151);z-index: 1;margin-left:15px;margin-right: 15px;width: 90%;"></div>
                <div id="metode-preview" class="col-lg-12 clearleft clearright clearleft-mobile clearright-mobile rgb243 bradius5" style="">
                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/bulkhead/installment_black.png" class="" style="position: absolute;top: 35%;left: 32%;">
                    <div class="fcolor69" style="position: absolute;top:60%;width:100%;left:15%;font-size: 20px;font-family: gotham-medium;">
                        Pilih Metode Pembayaran
                    </div>
                </div>
                
                
            </div>
            <div class="hidden-lg col-md-12 col-xs-12" style="padding-top: 15px;"></div>
            <div class="col-lg-6 col-xs-12 clearright clearleft-mobile clearright-mobile payment-layout-4" style="">
                <div id="detail-pembayaran" class="col-lg-12 col-xs-12 clearleft clearleft-mobile clearright-mobile clearright rgb243 bradius5" style="">
                    <div class="col-lg-12 hidden-xs" style="padding-left: 30px;padding-right: 30px;padding-top: 20px;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright gotham-medium clearleft-mobile clearright-mobile fcolor69" style="font-size:14px;padding-bottom: 10px;">
                            Detail Tagihan
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile fcolor69">
                                Sub Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                    if($flash_cart !== 1){
                                        echo 'IDR ' . common\components\Helpers::getPriceFormat($subtotal);
                                    }else{
                                        echo 'IDR ' . common\components\Helpers::getPriceFormat($subtotal_original);
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                if($flash_cart !== 0){
                                    $discount = $reduction;
                                } 
                                echo $discount != 0 ? 
                                'IDR ' . common\components\Helpers::getPriceFormat($discount) 
                                : 
                                '-' ; 
                                $total_discount += $discount;
                                ?>
                            </div>
                        </div>
						
						<div class="cc-diskon col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Credit Card Diskon
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                
                                $promoCreditCardAmount = $promoBCAAmountCC + $promoMandiriAmountCC + $promoPermataAmountCC + $promoCIMBAmountCC + $promoDanamonAmountCC + $promoHSBCAmountCC + $promoCharteredAmountCC + $promoPaninAmountCC;
                                echo $promoCreditCardAmount != 0 ? 
                                'IDR ' . common\components\Helpers::getPriceFormat($promoCreditCardAmount) 
                                : 
                                '-' ; 
                               
                                ?>
                            </div>
                        </div>
						
                        <?php if ($reduction_xtra > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon Ekstra
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php echo $reduction_xtra == 0 ? '-' :  'IDR ' . common\components\Helpers::getPriceFormat($reduction_xtra); 
                                $total_discount += $reduction_xtra;
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if ($reduction_plus_xtra > 0) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Diskon Plus Ekstra
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php echo $reduction_plus_xtra == 0 ? '-' :  'IDR ' . common\components\Helpers::getPriceFormat($reduction_plus_xtra); 
                                $total_discount += $reduction_plus_xtra;
                                ?>
                            </div>
                        </div>
                        <?php } ?>
                      
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 unique separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;display: none;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Unique Code
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright unique_code clearleft-mobile clearright-mobile" style="text-align: right;">
                               <?php
                                echo $unique_code;
                            ?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Biaya Kirim
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
                                   
                                    echo  'IDR ' . \common\components\Helpers::getPriceFormat($shippingCost);
                                ?>
                            </div>
                        </div>
                        <?php $shippingInsurance = 0; ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Asuransi Pengiriman
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                <?php
									$shippingInsurance = $_SESSION['customerInfo']['shippingMethod']['shipping_insurance'];
									if($shippingInsurance){
										$shippingInsurance = $subtotal_original;
										$shippingInsurance = (($shippingInsurance * 0.5) / 100);
									}
                                    echo  'IDR ' . \common\components\Helpers::getPriceFormat($shippingInsurance);
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator special-promo clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;display:none;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator special-promo-name clearleft gotham-light clearleft-mobile clearright-mobile">
                                
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator special-promo-amount clearright clearleft-mobile clearright-mobile" style="text-align: right;">
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright" style="border-bottom: solid 0.5px rgb(69,69,69);padding-bottom: 10px;">
                          
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearleft clearright clearleft-mobile clearright-mobile" style="padding-top: 10px;">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearleft gotham-light clearleft-mobile clearright-mobile">
                                Grand Total
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-without-trf clearright clearleft gotham-medium clearleft-mobile clearright-mobile " style="text-align: right;">
								<?php 
                                
                                    if($flash_cart !== 1){
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										 echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                
                                ?>
							</div>
							<!--
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator clearright clearleft gotham-medium clearleft-mobile clearright-mobile cc-diskon"  style="text-align: right;">
                                <input type="hidden" class="disc_extra" name="disc_extra" value="<?php echo $reductionDiscount; ?>">
								<?php echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance - $promoCreditCardAmount); ?>
                            </div>
							-->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-trf clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php
                                
                                    if($flash_cart !== 1){
										  echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}else{
										  echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $unique_code + $shippingInsurance);
									}
                                
                                ?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 separator total-with-special-promo clearright gotham-medium clearleft-mobile clearright-mobile" style="text-align: right;display: none;">
                                <?php 
                                
                                    if($flash_cart !== 1){
										  echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal - $discount + $shippingCost + $shippingInsurance);
									}else{
										  echo  'IDR ' . \common\components\Helpers::getPriceFormat($subtotal_original - $discount + $shippingCost + $shippingInsurance);
									}
                                
                                 ?>
                            </div>
                        </div>
                        
                        
                        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding padding-top-5 margin-top-1" style="padding-top:5px;">
                            <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/deliveryinformation" class="shipping-information lanjut position-left" style="width:100%;text-align: center;">Kembali</a>
                        </div> -->
                    </div>
                    
                    <!-- Input for Flag Flash Sale -->
                    <input type="hidden" name="flash_sale_flag" value="<?php echo $flash_cart; ?>">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 step-purchase shipping box pay clearleft-mobile clearright-mobile" style="">
                        <div class="hidden-lg col-xs-12" style="padding-top: 15px;"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright payment-error clearleft-mobile clearright-mobile" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright" style="">
                                <span id="payment-error" class="gotham-light" style="font-size: 12px;font-style: italic;padding-left: 0;">* Silahkan pilih metode pembayaran</span>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright agreement-error clearleft-mobile clearright-mobile" style="display: none;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                                <span id="agreement-error" class="gotham-light" style="font-size: 12px;font-style: italic;padding-left: 0;">* Silahkan isi Syarat & Ketentuan</span>
                            </div>
                        </div>
                        <div class="checkbox-btn agreement-checkbox ipad col-xs-12">
                                <input type="checkbox" id="agreement" name="payment_method">
                                <label for="agreement" class="black-style gotham-light" style="color:rgb(69,69,69);font-style: italic;padding-left: 13px;padding-top: 2px;" onclick>Setuju dengan <span style="color:rgb(0,140,211);text-decoration: underline;">Syarat & Ketentuan</span></label>
                        </div>
                        
                        <form action="<?php echo \yii\helpers\Url::base() . '/cart/checkout/step/confirmorder';?>" id="confirmorder-form" method="POST">
                            <input type="hidden" name="_csrf" value="<?php echo $_COOKIE['_csrf']; ?>">
                            <input type="hidden" name="special_promo" value="0">
                            <input type="hidden" name="reduction_percent" value="<?php echo $reductionDiscount; ?>">
                        </form>
                            <!-- <?php $form //= ActiveForm::begin(['action' => \yii\helpers\Url::base() . '/cart/checkout/step/confirmorder', "id" => "confirmorder-form"]) ?> -->
                            <!-- <a href="<?php echo \yii\helpers\Url::base(); ?>/cart/checkout/step/paymentinformation" class="shipping-information position-left">DETAIL PEMBAYARAN</a> -->
                            <!--                <a href="#" class="edit" id="confirm-order">CONFIRM ORDER</a>-->
                           
                            
							<button id="vospay" type="button" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px; display: none;">Bayar</button>
                            <a href="#" id="payment-info" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px;">
                                <span id="pay-default-text" style="">Bayar</span>
                                <span id="pay-gopay-text" style="display: none;">Pay Now with <img id="gopay-img" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/gopay-white.png" class="img-responsive" style="display: inline;width: 35%;"></span>
                            </a>
                        </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<style type="text/css">
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::before,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::before,
    .radio-btn.agreement-checkbox input[type="checkbox"]:checked+label::before,
    .radio-btn.agreement-checkbox input[type="radio"]:checked+label::before {
        opacity: 1;
        background-color: rgb(158,131,97);
        width: 11px;
        border-radius: 25px;
        height: 11px;
        top: 9px;
        left: 8px;
    }
    .checkbox-btn.agreement-checkbox input[type="checkbox"]:checked+label::after,
    .checkbox-btn.agreement-checkbox input[type="radio"]:checked+label::after,
    .radio-btn input[type="checkbox"]:checked+label::after,
    .radio-btn input[type="radio"]:checked+label::after {
        border: 1px solid rgb(158,131,97);
    }

    .checkbox-btn label.black-style::after {
        position: absolute;
        content: "";
        width: 15px;
        height: 15px;
        left: 0;
        top: 0;
        margin-left: -9px;
        margin-top: 6px;
        background-color: transparent;
        border: 1px solid rgb(158,131,97);
        border-radius: 25px;
        background-clip: padding-box;
        cursor: pointer
    }
    .radio-btn label.black-style::before {
        background: rgb(158,131,97);
        border: 1px solid rgb(158,131,97);
        width: 8px;
        height: 8px;
        top: 9px;
        left: 9px;
    }
    .radio-btn label.black-style::after {
    
        border: 1px solid rgb(158,131,97);
        width: 12px;
        height: 12px;
    }
    .checkbox-btn.agreement-checkbox{
        padding-left: 12px;
        padding-top: 0;
    }
    #payment-error,#agreement-error{
        color:rgb(161,29,33);
    }
</style>
<?php } ?>
<style type="text/css">
    a.shipping-information.lanjut{
        background:#c2b9b4;
        color:#fff;
    }
    a.shipping-information.lanjut:hover{
        background:#fff;
        color:#c2b9b4;
    }
</style>
<div class="hidden-lg hidden-xs" style="padding-top:20px;"></div>
<div class="portfolio-modal modal fade forgot agreement" id="kredivoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content agreement" style="border-radius: 5px;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="height: 45px;">
            <a href="#">
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">-->
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email remove-padding clearright terms-condition-description">
						<span class="gotham-medium">Beli sekarang, bayar nanti dengan Kredivo</span> <br><br>
						
                        Kredivo adalah solusi kredit instan untuk belanja online.<br><br>
						Dengan Kredivo, kamu bisa belanja hingga Rp 20.000.000 di The Watch Co & membayar dalam 30 hari
						atau dengan cicilan 3 bulan / 6 bulan.
						<br><br>
						Berikut cara pembayaran dengan Kredivo:
						<br><br>
						1. Anda akan di arahkan ke halaman Checkout Kredivo dengan rincian pembelian Anda di thewatch.co.<br>
						2. Jika nominal transaksi telah sesuai silahkan Login untuk melanjutkan transaksi.<br>
						3. Login dengan cara masukkan <span class="gotham-medium">No.Handphone yang terdaftar</span> pada kolom yang tersedia.<br>
						4. Masukkan PIN Anda pada kolom yang tersedia, lalu klik tombol <span class="gotham-medium">"Masuk"</span>.<br>
						5. Sistem akan mengirimkan kode OTP ke <span class="gotham-medium">No.Handphone yang terdaftar</span>, lalu masukkan kedalam kolom yang tersedia, lalu klik tombol <span class="gotham-medium">"Confirm OTP"</span>.<br>
						6. Transaksi selesai, cek kembali status transaksi Anda di akun thewatchco pada halaman <span class="gotham-medium">"Order Transaksi"</span>.<br>
						<br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 5%;border-top:solid 1px rgb(128,128,128);">
                        <a href="#" data-dismiss="modal" class="editpay hidden-md hidden-sm hidden-xs" style="width: 15%;text-align: center;border-radius: 25px;">OK</a>
                        <a data-dismiss="modal" class="editpay hidden-lg" style="float:left;width: 60%;text-align: center;border-radius: 25px;margin-left: 20%;margin-top: 20px;">OK</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-modal modal fade forgot agreement" id="gopayModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content agreement" style="border-radius: 5px;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="height: 45px;">
            <a href="#">
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">-->
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs customer-login email remove-padding clearright terms-condition-description">
						<br><br>
						Berikut cara pembayaran dengan GO-PAY:
						<br><br>
						1. Click <b>Pay Now with GO-PAY</b>.<br>
						2. Open <b>GO-JEK</b> app on your phone.<br>
						3. Click <b>Scan QR</b>.<br>
						4. Point your camera to the <b>QR Code</b>.<br>
						5. Check your payment details in the <b>GO-JEK</b> app and then tap <b>Pay</b>.<br>
						6. Your transaction is done.<br>
						<br>
                    </div>
                </div>
				
				<div class="hidden-lg hidden-md hidden-sm col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 customer-login email remove-padding clearright terms-condition-description">
						<br><br>
						Berikut cara pembayaran dengan GO-PAY:
						<br><br>
						1. Click <b>Pay Now with GO-PAY</b>.<br>
						2. <b>GO-JEK</b> app will open.<br>
						3. Check your payment details then click Pay and your transaction is done.<br>
						<br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 5%;border-top:solid 1px rgb(128,128,128);">
                        <a href="#" data-dismiss="modal" class="editpay hidden-md hidden-sm hidden-xs" style="width: 15%;text-align: center;border-radius: 25px;">OK</a>
                        <a data-dismiss="modal" class="editpay hidden-lg" style="float:left;width: 60%;text-align: center;border-radius: 25px;margin-left: 20%;margin-top: 20px;">OK</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-modal modal fade forgot agreement" id="vospayModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content agreement" style="border-radius: 5px;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="height: 45px;">
            <a href="#">
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">-->
            </a>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email remove-padding clearright terms-condition-description">
						<span class="gotham-medium">Vospay, Kredit Digital Untuk Anda </span> <br><br>
						
                        Menghadirkan layanan kredit digital agar Anda dapat berbelanja online dengan cicilan hingga 12 bulan di merchant - merchant partner Kami. <br><br>
						Anda harus terdaftar sebagai user Vospay pada Mitra Multifinance Vospay dan sudah mengaktifkan akun Anda.<br>
                        Saat ini layanan kami hanya tersedia bagi customer terpilih dari berbagai Mitra Multifinance yang bekerjasama dengan VOSPAY dan belum terbuka untuk umum.  

						<br><br>
						Untuk informasi lengkap, kunjungi <a href="//www.vospay.id">www.vospay.id</a>
						<br><br>
						
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-terms-conditions">
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="color: #000;padding-top: 2%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 5%;border-top:solid 1px rgb(128,128,128);">
                        <a href="#" data-dismiss="modal" class="editpay hidden-md hidden-sm hidden-xs" style="width: 15%;text-align: center;border-radius: 25px;">OK</a>
                        <a data-dismiss="modal" class="editpay hidden-lg" style="float:left;width: 60%;text-align: center;border-radius: 25px;margin-left: 20%;margin-top: 20px;">OK</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">

.modal-content.agreement::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 6px;
    margin-left: 5px;
}
.modal-content.agreement::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: rgba(128,128,128,1);
    -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
    left:30px;
    direction: ltr;
}.modal-content.agreement::-webkit-scrollbar-track {
    /*border-radius: 6px;
    background-color: rgba(0,0,0,.5);
    -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);*/
}

</style>
<div class="portfolio-modal modal fade forgot agreement bradius5" id="agreementModal" tabindex="-1" role="dialog" aria-hidden="true">


    <div class="modal-content agreement bradius5" style="border-radius: 5px;">
        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="">
            <a href="#"> -->
                <!--<img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/close-white.png" class="close-button-terms-conditions">-->
            <!-- </a>
        </div> -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearleft clearright" style="position: relative;">
            <div class="modal-body hidden-md hidden-sm hidden-xs" id="terms-title" style="position: fixed;width: auto;left:25%;right:25%;margin-right:25px;background-color: #fff;z-index: 1;">
                <div class="terms-conditions-title">TERMS AND CONDITIONS</div>
                
            </div>
            <div class="modal-body hidden-lg" id="terms-title" style="position: fixed;width: auto;left:5%;right:5%;margin-right:0px;background-color: #fff;z-index: 1051;border-radius: 5px;top: 32px;">
                <div class="terms-conditions-title">TERMS AND CONDITIONS</div>
                
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
            <div class="modal-body">
                <div style="padding-top: 20px;"></div>
                <div class="terms-conditions-sub-title">PERSYARATAN REGISTRASI</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove-padding clearright terms-condition-description">
                        Registrasi diperlukan untuk kelancaran beberapa fitur layanan yang terdapat pada website ini. 
                        Dengan segala hormat kami membutuhkan informasi yang benar dan terkini mengenai Anda. 
                        Jika Anda ingin mengubah informasi yang sudah terdaftar silahkan kirimkan email ke 
                        <b>cs@thewatch.co</b>.
                        Password yang Anda pilih harus bersifat unik dan simpanlah dengan aman untuk kebutuhan verifikasi.
                    </div>
                </div>
                <div class="terms-conditions-sub-title">KETENTUAN GARANSI</div>
                <div class="col-lg-12 col-md-12 col-sm-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 remove-padding clearright terms-condition-description">
                        Garansi baterai berlaku seumur hidup sejak tanggal pembelian. 
                        Garansi atas kerusakan mesin berlaku selama 2 tahun terhitung sejak tanggal pembelian. 
                        Pengajuan garansi, baik baterai maupun mesin, harus menyertakan kartu garansi resmi dari The Watch Co. 
                        yang telah diisi dengan lengkap dan benar serta nota penjualan yang asli.
                        Garansi ini tidak mencakup kerusakan berupa goresan, cacat kosmetik, kerusakan akibat terkena air, kerusakan strap/tali jam tangan, kerusakan akibat penanganan pihak lain selain layanan purna jual The Watch Co., 
                        atau kerusakan apapun yang diakibatkan dari pemakaian dan penuaan.
                        <br>
                        Pengajuan garansi dapat dilakukan di seluruh retail store The Watch Co.
                        <br>
                        
                        <b>
                        Garansi tidak berlaku jika Anda tidak dapat menunjukkan kartu garansi resmi dari The Watch Co. 
                        dan nota penjualan yang asli, atau email bukti pembelian (untuk pembelian secara online).
                        </b>
                    </div>
                </div>
                <div class="terms-conditions-sub-title">PERSYARATAN PEMBELIAN</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding terms-condition-description">
                        Untuk dapat melakukan pembelian pada website kami, 
                        Anda wajib memberikan data berupa nama lengkap sesuai KTP, 
                        nomor telepon dan alamat email yang aktif dan dapat dihubungi, 
                        dan informasi lainnya yang diminta pada proses registrasi. 
                        Anda juga diwajibkan untuk memberikan informasi pembayaran dan/atau kartu kredit yang valid dan benar. 
                        The Watch Co. hanya menjual kepada individu perorangan yang memenuhi syarat pembelian seperti yang kami jelaskan di atas. Sebagai tambahan, 
                        Anda setuju untuk memberikan kami ijin untuk menggunakan informasi pembayaran Anda untuk kebutuhan pengecekan keaslian data guna menghindari penyalahgunaan dan penipuan data.
                        <br>
                    </div>
                </div>
                <div class="terms-conditions-sub-title">PEMBAYARAN</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding terms-condition-description">

                        Anda dapat memilih metode pembayaran yang diinginkan. 
                        Transfer melalui rekening bank, kartu kredit, atau cicilan. 
                        Pembayaran menggunakan kartu kredit dan cicilan dikelola oleh IPAY88 dan Veritrans.

                        <br>
                    </div>
                </div>
                <div class="terms-conditions-sub-title">PEMBAYARAN MENGGUNAKAN KARTU KREDIT</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding terms-condition-description">

                        Pembayaran kartu kredit Visa dan MasterCard Anda dilakukan dengan aman dan rahasia sesuai standar perbankan menggunakan jasa IPAY88 dan Veritrans. 
                        Data kartu kredit Anda dikirim langsung ke bank tanpa dapat dibaca atau diakses oleh siapapun selain bank Anda.

                        <br>
                    </div>
                </div>
                <div class="terms-conditions-sub-title">KONFIRMASI</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;padding-bottom: 3%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding terms-condition-description">

                        Setelah kami menerima pesanan Anda kami akan mengirimkan email konfirmasi ke alamat email yang telah Anda daftarkan. 
                        Oleh sebab itu, sangatlah penting untuk Anda memberikan alamat email yang benar dan aktif ketika membuat pesanan. 
                        Simpanlah email konfirmasi pesanan tersebut untuk kebutuhan purna jual dan hubungan lain dengan layanan pelanggan kami. 
                        Ketahuilah bahwa email bukti pembelian juga berlaku sebagai syarat pengajuan garansi.

                        <br>
                    </div>
                </div>
                <div class="terms-conditions-sub-title">KELUHAN DAN PENGEMBALIAN</div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright remove-padding" style="padding-top: 1%;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearright remove-padding terms-condition-description" style="padding-bottom: 3%;">

                        Sangatlah penting bagi Anda sebagai pembeli untuk melakukan pengecekan pada barang atau produk yang Anda terima sesaat setelah pengiriman dilakukan. 
                        Periksalah kondisi dan kesesuaian produk tersebut dengan rincian pesanan yang Anda lakukan. Untuk segala keluhan silahkan mengirimkan email ke <b>cs@thewatch.co. </b>
                        Harap diperhatikan bahwa setiap <b>produk yang sudah dibeli tidak dapat ditukar atau dikembalikan.</b>
                        
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-login email clearright remove-padding terms-condition-description" style="padding-bottom: 5%;border-top:solid 1px rgb(128,128,128);">
                        <a data-dismiss="modal" class="editpay hidden-md hidden-sm hidden-xs" style="width: 15%;text-align: center;border-radius: 25px;">AGREE</a>
                        <a data-dismiss="modal" class="editpay hidden-lg" style="float:left;width: 60%;text-align: center;border-radius: 25px;margin-left: 20%;margin-top: 20px;">AGREE</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <div class="modal-body">
                
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <div class="modal-body">
                
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <div class="modal-body">
                
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <div class="modal-body">
                
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
            <div class="modal-body">
                
            </div>
        </div> -->
    </div>
</div>
<?php
$vospayPromoAmount = 0;
$vospayDiscount = 0;
$vospayMaxDiscount = 500000;
$vospayGrossAmount = 0;

function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 5);
}

if($current_date >= '2019-05-01 00:00:00' && $current_date <= '2019-07-31 00:00:00'){
	
	if($subtotal >= 1000000){
        $shippingCost = 0;
		//if( isWeekend($current_date) ){
		//	$vospayDiscount = 50;
		//	$vospayPromoAmount = ($subtotal * 0.50);
		//}else{
			$vospayDiscount = 30;
			$vospayPromoAmount = ($subtotal * 0.30);
		//}
		
		if($vospayPromoAmount >= 500000){
			$vospayPromoAmount = $vospayMaxDiscount;
		}
		$vospayGrossAmount = round((($subtotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount);
	}else{
		$vospayGrossAmount = round(($subtotal + $shippingCost + $shippingInsurance) - $discount);
	}
}
else{
	$vospayGrossAmount = round(($subtotal + $shippingCost + $shippingInsurance) - $discount);
}
?>
<style type="text/css">
 
    label.black-style{
        font-size: 12px;
    }
    @media only screen and (max-width : 1365px) and (min-width: 1280px) {
        label.black-style{
            font-size: 10px;
        }
    }
</style>

<script>
	var vospayConfig = vospayConfig || {};
    var grossamount = '<?php
//$weight = common\components\Helpers::generateWeightOrder($items);
//$shippingPrice = $shippingCost;

if($flash_cart !== 1){
    echo round(($subtotal + $shippingCost + $shippingInsurance) - $discount);
}else{
    echo round(($subtotal_original + $shippingCost + $shippingInsurance) - $discount);
}

?>';
    var vospayOrderItems = [],
        vospayOrderItemsCat = vospayOrderItemsCat || {},
		vospayCustomerDetails = vospayCustomerDetails || {},
		vospayConfig = vospayConfig || {},
		vospayPromoAmount = 0,
		vospayGrossAmount = <?php echo $vospayGrossAmount; ?>,
		vospayShipping = <?php echo $shippingCost + $shippingInsurance; ?>;
	//promoMandiriAmount = <?php echo $promoMandiriAmount; ?>;
	
	<?php if (count($items) > 0) { ?>
        <?php foreach ($items as $item) { ?>
        vospayOrderItemsCat = {
            id: '<?php echo intval($item['category_id']);?>',
            name: '<?php echo $item['category'];?>'
        };
        vospayOrderItems.push({
            id: '<?php echo $item['id']; ?>',
            name: '<?php echo str_replace("'", "", $item['name']); ?>',
            price: '<?php echo $item['unit_price']; ?>',
            quantity: <?php echo $item['quantity']; ?>,
            category: vospayOrderItemsCat
        });
        <?php } ?>
	<?php } ?>
    
    /*
    //try to not using this functions, because it is complicated !
	<?php if($grandTotal >= 1000000 && $current_date >= '2018-12-01 00:00:00' && $current_date <= '2018-12-16 23:59:59'){ ?>
	vospayGrossAmount = '<?php echo round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount); ?>';
    vospayOrderItemsCat = {
        id: '<?php echo intval($item['category_id']);?>',
        name: '<?php echo $item['category'];?>'
    };
	vospayOrderItems.push({
		id: '0',
		name: 'discount 70% vospay',
		price: -<?php echo $vospayPromoAmount ?>,
        quantity: 1,
        category: vospayOrderItemsCat
    });
	<?php }elseif($grandTotal >= 1000000 && $current_date >= '2019-02-09 00:00:00' && $current_date <= '2019-03-31 23:59:59'){ ?>
	vospayGrossAmount = '<?php echo round((($grandTotal + $shippingCost + $shippingInsurance) - $discount) - $vospayPromoAmount); ?>';
    vospayOrderItemsCat = {
        id: '<?php echo intval($item['category_id']);?>',
        name: '<?php echo $item['category'];?>'
    };
	vospayOrderItems.push({
		id: '0',
		name: 'discount 30% vospay',
		price: -<?php echo $vospayPromoAmount ?>,
        quantity: 1,
        category: vospayOrderItemsCat
    });
	<?php } else { ?>
	    // vospayGrossAmount = '<?php echo round(($grandTotal + $shippingCost + $shippingInsurance) - $discount); ?>';
	<?php } ?>
	*/
	<?php if(isset($voucherInfo)){ ?>
        vospayOrderItemsCat = {
            id: '<?php echo intval($item['category_id']);?>',
            name: '<?php echo $item['category'];?>'
        };
        vospayOrderItems.push({
            id: '0',
            name: 'discount voucher',
            price: -<?php echo $discount ?>,
            quantity: 1,
            category: vospayOrderItemsCat
        });
	<?php } ?>
	
	vospayCustomerDetails = {
		id: '<?php echo $_SESSION['customerInfo']['customer_id']; ?>',
		name: '<?php echo $_SESSION['customerInfo']['fname'] . ' ' . $_SESSION['customerInfo']['lname']; ?>',
		email: '<?php echo $_SESSION['customerInfo']['email']; ?>',
		phone: '<?php echo CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->phone; ?>',
		shippingAddress: '<?php echo trim(preg_replace('/\s+/', ' ', CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->address1)); ?>',
		billingAddress: '<?php echo trim(preg_replace('/\s+/', ' ', CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->address1)); ?>'
	};
	
	var transactionDetails = {
		orderDescription: 'The Watch Co. - Order Information',
		items: vospayOrderItems,
		currency: 'IDR',
		shipping: vospayShipping,
		grossAmount: vospayGrossAmount,
		customerDetails: vospayCustomerDetails
	};
	
document.getElementById('vospay').addEventListener('click', () => {
	//confirmVospayOrder(transactionDetails);
	//clickHandler();
	  getSessionSpecialPromo(transactionDetails);
});
</script>