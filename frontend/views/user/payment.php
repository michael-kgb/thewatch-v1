<?php

use yii\web\Session;
use app\assets\VeritransAsset;

VeritransAsset::register($this);

$sessionOrder = new Session();
$sessionOrder->open();

$customerInfo = $sessionOrder->get("customerInfo");

$order_details = \backend\models\OrderDetail::find()->where(['orders_id'=>$orders->orders_id])->all();
$productModel = \backend\models\Product::find()
                            ->select('product_category_id')
                            ->where(['product_id' => $orders->product_id])
                            ->one();
$productCategoryModel = \backend\models\ProductCategory::find()
->select('product_category_id, product_category_description')
->where(['product_category_id' => $productModel->product_category_id])
->one();

$totalItems = count($order_details);
//print_r($_SESSION);
?>
<script>
//var hasPromoPermata = 0;
//var promoMandiriAmount = 0;
var items = [];
/*
var permataBin = [
    '48938588', '46400588', '48938588', '471295', '46400577',
    '48938577', '48948577', '489385', '426254', '464005',
    '489385', '489385', '489385', '489385', '4893 85', '426254323',
    '549846', '554302', '554302', '461785', '544741', '518943', '518881',
    '520142', '520143', '520153', '540889', '498853', '498853', '528872',
    '510505', '520366', '520370', '520371', '520383', '543972', '542167',
    '454633', '454633', '498885', '461753', '49885329', '49885327', '5408'
];
*/

var mandiriBin = [
    '490284', '490283', '437527', '437528', '437529', '450183', '450184', '450185',
    '400376', '489764', '400378', '415031', '415016', '415030', '415032', '415018',
    '415017', '416230', '416231', '416232', '400385', '400479', '400481', '479929',
    '479930', '479931', '421195', '427797', '421313', '445076', '445076', '445076', 
    '445076', '425945', '413719', '413718', '557338', '524325', '512676', '414931',
    '537793', '356350'
];

var totalCart = <?php echo $totalItems; ?>;
<?php $hasPromoPermata = 0; ?>
<?php $promoMandiriAmount = 0; ?>

if(totalCart > 0){
    <?php $i = 1; ?>
    <?php foreach ($order_details as $order_detail) { ?>
    <?php $product = \backend\models\Product::findOne(['product_id' => $order_detail->product_id]); ?>
    <?php 
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
        */
        
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
        
        if(in_array($order_detail->product_id, $promoTambahanMandiri)){ 
            $promoMandiriAmount += ((0.05 * $order_detail->original_product_price) * $order_detail->product_quantity); 
            round($promoMandiriAmount);
        }
        
        elseif(in_array($item['brand_name'], $promoNormalPriceMandiri)){ 
            $promoMandiriAmount += ((0.10 * $order_detail->original_product_price) * $order_detail->product_quantity); 
            round($promoMandiriAmount);
        }
    ?>

    <?php $i++; ?>
    <?php } ?>
    
    //hasPromoPermata = <?php echo $hasPromoPermata; ?>;
}

</script>
<section id="shopping-bag" style="padding-top: 0px;">
    <div class="container">
        <div class="row">
            <!-- <div class="hidden-xs col-lg-12 col-md-12 col-sm-12 shopping-bag title">MY ORDER</div> -->
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myaccount profile separator clearleft clearright"></div>
            <div class="hidden-xs col-lg-9 col-md-9 col-sm-9 shopping-bag product separator clearleft clearright" style="border-bottom: 0px solid;"></div>
            <div class="hidden-xs col-lg-3 col-md-3 col-sm-3 myprofile menu-left box clearleft">
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left active clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/orders">MY ORDER / CONFIRM PAYMENT</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</a>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left clearleft clearright">
                    <a href="<?php echo \yii\helpers\Url::base(); ?>/user/sign-out">SIGN OUT</a>
                </div>
                <!-- <div class="col-lg-12 col-md-12 col-sm-12 myprofile menu-left separator last clearleft clearright"></div> -->
            </div>

         <!--    <div class="hidden-lg hidden-md hidden-sm col-xs-12">
                <div class="col-xs-12 text-center select-menu-profile">
                    <select id="profile-menu" class="qty-dropdown" onchange="profile_menu()">
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/profile">MY PROFILE</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/orders" selected>MY ORDER</option>
                        <option value="<?php echo \yii\helpers\Url::base(); ?>/user/shipping">SHIPPING INFORMATION</option>
                    </select>
                </div>
            </div> -->

<style type="text/css">
    table tr td div{
        padding:15px;
    }
</style>
    <?php
        $orderDetail = backend\models\OrderDetail::findAll(["orders_id" => $orders->orders_id]);
        foreach ($orderDetail as $ordered) {
            $grandTotal += $ordered->original_product_price * $ordered->product_quantity;
        }
        $discount = backend\models\OrderCartRule::findOne(['orders_id' => $orders->orders_id]);
        if (!empty($discount)) {
            $grandTotal = $grandTotal - $discount['value'];
        }

        $grandTotal = $orders->total_shipping + $grandTotal + $orders->unique_code + $orders->total_shipping_insurance - $orders->total_special_promo;
    ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 clearleft clearright clearright-mobile clearleft-mobile">
            <?php if($orders->flash_sale_approved == 'APPROVED'){ ?>
                <?php
                    if($payment_method_id == 2){
                ?>    
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
    
                    <form action="<?php echo \yii\helpers\Url::base(); ?>/payment/credit-card-flash" method="POST" id="payment-form">
                            
                            <input type="hidden" name="installment" value="false">
                            <input type="hidden" name="installment_plan" value="0">
                            <input type="hidden" name="order_id" value="<?php echo $orders->orders_id; ?>">
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform clearleft-mobile clearright-mobile remove-padding" style="">
                                <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit">
                                    <label class="metode-pembayaran-title list">
                                        Credit Card
                                    </label>
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit" style="min-height: 50px;">
                                    <label class="metode-lain">
                                        <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                                    </label>               
                                </div>
                                <span class="gotham-medium no-spacing" style="font-size: 14px;">
                                    Credit Card Number & Information
                                </span>
                                <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                <input class="cardholder" type="text" name="email" placeholder="Card Holder Name" style="border-radius: 25px;border:0;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearright clearleft clearleft-mobile clearright-mobile">
                                    <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/lock.png" class="img-responsive lock-icon"> -->
                                    <span class="gotham-medium secure-text no-spacing no-lineheight ccil-text" style="margin-left: 0;position: relative;">
                                        Secure Credit Card Payment <br>
                                        This is a secure 128-bit SSL encrypted payment
                                    </span>
                                    <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                    <div style="position: relative;">
                                        <input class="cardholder card-number credit" type="text" name="card-number" placeholder="Credit Card Number" style="border-radius: 25px;border:0;">
                                        <div class="credit-valid" style="display: none;">false</div>
                                        <div class="credit-length" style="display: none;">false</div>
                                        <div class="credit-luhn" style="display: none;">false</div>
                                       <!--  <p class="log"></p> -->
                                        <img class="icon-mastercard" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                        <img class="icon-visa" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/visa.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                    </div>
             
                                    <span class="gotham-light line-height2 ccil-text" style="font-style: italic;">
                                        16 digits of credit card number
                                    </span>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mtop2 remove-padding">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-left">
                                            <select id="card-expiry-month" class="shipping mtop2 card-expiry-month" style="border:0;border-radius: 25px;height: 33px;">
                                                <option value="0" selected="selected">MONTH</option>
                                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                    <?php if($i <= 9){ ?>
                                                    <option value="<?php echo '0' . $i; ?>"><?php echo $i; ?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-right">
                                            <select id="card-expiry-year" class="shipping mtop2 card-expiry-year" style="border:0;border-radius: 25px;height: 33px;">
                                                <option value="0" selected="selected">YEAR</option>
                                                <?php
                                                $year = date('Y');
                                                for ($i = 1; $i <= 15; $i++) {
                                                    ?>
                                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php $year += 1;
                                                } ?>
    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                        <span class="gotham-light ccil-text" style="font-style: italic;">
                                            The date your credit card expires. Find this one on the front of your credit card.
                                        </span>
                                    </div>
                                    <input style="border-radius: 25px;border:0;" class="cardholder card-cvv" type="password" placeholder="Security Code" maxlength=4>
                                    <input id="token_id" name="token_id" type="hidden" />
                                    <input id="payment_id" name="payment_id" type="hidden" />
                                    <input id="payment_method_id" name="payment_method_id" type="hidden" />
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                        <span class="gotham-light ccil-text" style="font-style: italic;">
                                            or 'CVC' or 'CVV'. The last 3 digits displayed on the back of your credit card.
                                        </span>
                                    </div>
                                </div>
                            </div>
    
                    </form>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 remove-padding">
                                <a href="#" id="payment-flash-credit" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px;">
                                    <span id="pay-default-text" style="">Bayar</span>
                                </a>
                            </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
    
                        <script src="<?php echo \yii\helpers\Url::base(); ?>/js/validator/jquery.creditCardValidator.js"></script>
                        <script type="text/javascript">
                            jQuery(document).ready(function($){
                                $('input.cardholder.card-number.credit').validateCreditCard(function(result) {
                                   
                                    var card_name = result.card_type == null ? '-' : result.card_type.name;
                                    if(card_name == 'mastercard'){
                                        $('img.icon-mastercard').css("display","block");
                                        $('img.icon-visa').css("display","none");
                                        $('input[name=payment_id]').val(11);
                                    }
                                    else if(card_name == 'visa'){
                                        $('img.icon-mastercard').css("display","none");
                                        $('img.icon-visa').css("display","block");
                                        $('input[name=payment_id]').val(3);
                                    }else{
                                        $('img.icon-mastercard').css("display","none");
                                        $('img.icon-visa').css("display","none");
                                    }
                                    if(result.valid == '' || result.length_valid == '' || result.luhn_valid == ''){
                                        $('.cardholder.card-number.credit').css("border","solid 2px rgb(161,29,33)");
                                    }
                                    else{
                                        $('.cardholder.card-number.credit').css("border","none");
                                    }
                                    if($('.cardholder.card-number.credit').val() == ''){
                                        $('.cardholder.card-number.credit').css("border","none");
                                    }
                                    
                                    $('.credit-valid').html(result.valid);
                                    $('.credit-length').html(result.length_valid);
                                    $('.credit-luhn').html(result.luhn_valid);                               
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('input.cardholder.card-number').on('paste', function() {
                                  var $el = $(this);
                                  setTimeout(function() {
                                    $el.val(function(i, val) {
                                      return val.replace(/\s/g, '')
                                    })
                                  })
                                });
                        
                                $('input.cardholder.card-cvv').on('paste', function() {
                                
                                    $(this).val($(this).val().replace(' ', '') );
                                });
                               
                                $('input.cardholder.card-cvv').keypress(function( e ) {
                                
                                    if(e.which < 48 || e.which > 57) 
                                        return false;
                                });
                                $('input.cardholder.card-number').keypress(function( e ) {
                                
                                    if(e.which < 48 || e.which > 57) 
                                        return false;
                                });
                        
                        
                        
                            });
                        
                        </script> 
                    </div>
                <?php
                    }elseif($payment_method_id == 3){
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243 installment-section" style="display:none;">    
                            <form action="<?php echo \yii\helpers\Url::base() . '/cart/checkout/step/ordercompleteflash';?>" id="confirmorder-form" method="POST">
                                <input type="hidden" name="_csrf" value="<?php echo $_COOKIE['_csrf']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $orders->orders_id; ?>">
                                <input type="hidden" name="payment_method_id" value="<?php echo $payment_method_id; ?>">
                                <input type="hidden" name="payment_id" value="<?php echo $orders->paymentmethoddetail->payment_id; ?>">
                            </form>
                            
                            <form action="<?php echo \yii\helpers\Url::base(); ?>/payment/credit-card-flash" method="POST" id="payment-form">
                            
                                    <input type="hidden" name="installment" value="false">
                                    <?php 
                                        $installment_plan = 0;
                                        if($orders->payment_method_installment_detail_id == 1){
                                            $installment_plan = 1;
                                        }elseif($orders->payment_method_installment_detail_id == 2){
                                            $installment_plan = 6;
                                        }elseif($orders->payment_method_installment_detail_id == 3){
                                            $installment_plan = 12;
                                        }
                                    ?>
                                    <input type="hidden" name="installment_plan" value="<?php echo $installment_plan; ?>">
                                    <input type="hidden" name="order_id" value="<?php echo $orders->orders_id; ?>">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform clearleft-mobile clearright-mobile remove-padding" style="">
                                        <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit">
                                            <label class="metode-pembayaran-title list">
                                                Credit Card
                                            </label>
                                        </div>
                                        <div class="hidden-lg hidden-md hidden-sm col-xs-6 clearleft-mobile clearright-mobile" id="back-credit" style="min-height: 50px;">
                                            <label class="metode-lain">
                                                <a onclick="all_method()" style="color: rgb(0,140,211);">Pilih Metode Lain</a>
                                            </label>               
                                        </div>
                                        <span class="gotham-medium no-spacing" style="font-size: 14px;">
                                            Credit Card Number & Information
                                        </span>
                                        <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                        <input class="cardholder" type="text" name="email" placeholder="Card Holder Name" style="border-radius: 25px;border:0;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 separator clearright clearleft clearleft-mobile clearright-mobile">
                                            <!-- <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/lock.png" class="img-responsive lock-icon"> -->
                                            <span class="gotham-medium secure-text no-spacing no-lineheight ccil-text" style="margin-left: 0;position: relative;">
                                                Secure Credit Card Payment <br>
                                                This is a secure 128-bit SSL encrypted payment
                                            </span>
                                            <div class="hidden-lg hidden-md hidden-sm clearfix"></div>
                                            <div style="position: relative;">
                                                <input class="cardholder card-number credit" type="text" name="card-number" placeholder="Credit Card Number" style="border-radius: 25px;border:0;">
                                                <div class="credit-valid" style="display: none;">false</div>
                                                <div class="credit-length" style="display: none;">false</div>
                                                <div class="credit-luhn" style="display: none;">false</div>
                                               <!--  <p class="log"></p> -->
                                                <img class="icon-mastercard" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/mastercard.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                                <img class="icon-visa" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/visa.png" width=35 style="display:none;position: absolute;right: 5px;" />
                                            </div>
                     
                                            <span class="gotham-light line-height2 ccil-text" style="font-style: italic;">
                                                16 digits of credit card number
                                            </span>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright mtop2 remove-padding">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-left">
                                                    <select id="card-expiry-month" class="shipping mtop2 card-expiry-month" style="border:0;border-radius: 25px;height: 33px;">
                                                        <option value="0" selected="selected">MONTH</option>
                                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                            <?php if($i <= 9){ ?>
                                                            <option value="<?php echo '0' . $i; ?>"><?php echo $i; ?></option>
                                                            <?php } else { ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 clearleft remove-padding-right">
                                                    <select id="card-expiry-year" class="shipping mtop2 card-expiry-year" style="border:0;border-radius: 25px;height: 33px;">
                                                        <option value="0" selected="selected">YEAR</option>
                                                        <?php
                                                        $year = date('Y');
                                                        for ($i = 1; $i <= 15; $i++) {
                                                            ?>
                                                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                        <?php $year += 1;
                                                        } ?>
    
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft mtop2 remove-padding">
                                                <span class="gotham-light ccil-text" style="font-style: italic;">
                                                    The date your credit card expires. Find this one on the front of your credit card.
                                                </span>
                                            </div>
                                            <input style="border-radius: 25px;border:0;" class="cardholder card-cvv" type="password" placeholder="Security Code" maxlength=4>
                                            <input id="token_id" name="token_id" type="hidden" />
                                            <input id="payment_id" name="payment_id" type="hidden" value="<?php echo $orders->paymentmethoddetail->payment_id; ?>"  />
                                            <input id="payment_method_id" name="payment_method_id" value="<?php echo $orders->paymentmethoddetail->payment_method_id; ?>" type="hidden" />
                                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft remove-padding">
                                                <span class="gotham-light ccil-text" style="font-style: italic;">
                                                    or 'CVC' or 'CVV'. The last 3 digits displayed on the back of your credit card.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
    
                            </form>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            <div class="col-lg-12 col-md-12 col-sm-12 remove-padding">
                                        <a href="#" id="payment-flash-installment" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px;">
                                            <span id="pay-default-text" style="">Bayar</span>
                                        </a>
                                    </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
    
                            
                        
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                        <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js"></script>
                           <script src="<?php echo \yii\helpers\Url::base(); ?>/js/validator/jquery.creditCardValidator.js"></script>
                            <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    $('input.cardholder.card-number').validateCreditCard(function(result) {
                                       
                                        var card_name = result.card_type == null ? '-' : result.card_type.name;
                                        if(card_name == 'mastercard'){
                                            $('img.icon-mastercard').css("display","block");
                                            $('img.icon-visa').css("display","none");
                                            // $('input[name=payment_id]').val(11);
                                        }
                                        else if(card_name == 'visa'){
                                            $('img.icon-mastercard').css("display","none");
                                            $('img.icon-visa').css("display","block");
                                            // $('input[name=payment_id]').val(3);
                                        }else{
                                            $('img.icon-mastercard').css("display","none");
                                            $('img.icon-visa').css("display","none");
                                        }
                                        if(result.valid == '' || result.length_valid == '' || result.luhn_valid == ''){
                                            $('.cardholder.card-number').css("border","solid 2px rgb(161,29,33)");
                                        }
                                        else{
                                            $('.cardholder.card-number').css("border","none");
                                        }
                                        if($('.cardholder.card-number').val() == ''){
                                            $('.cardholder.card-number').css("border","none");
                                        }
                                        
                                        $('.credit-valid').html(result.valid);
                                        $('.credit-length').html(result.length_valid);
                                        $('.credit-luhn').html(result.luhn_valid);                               
                                    });
                                });
                            </script>
                            
                            <script>
                                var bank = $('input[name=payment_id]').val();
                                if (bank == 7 || bank == 14 || bank == 16 || bank == 17 || bank == 18 || bank == 19 || bank == 29) {
                                    $('.installment-section').css('display','block');
                                }else{
                                    $("#confirmorder-form").submit();
                                }
                            </script>
                    </div>
                <?php
                    }elseif($payment_method_id == 1){
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 remove-padding" style="">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $orders->paymentmethoddetail->payment->filename;?>">
                                <div class="fcolor69 gotham-medium" style="padding-top: 30px;">
                                    Anda akan melakukan pembayaran
                                    menggunakan Bank Transfer <?php echo $orders->paymentmethoddetail->payment->name_bank; ?>
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                    Silahkan melakukan transfer ke nomor rekening:
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium remove-padding" style="padding-top: 15px;padding-bottom: 15px;">
                                    <?php
                                    $payment_id = \backend\models\PaymentMethodDetail::findOne(["payment_method_detail_id" => $orders->payment_method_detail_id])->payment_id;
                                    $payment = \backend\models\Payment::findOne(["payment_id" => $payment_id]);
                                    echo $payment->account_number;
                                    if($payment->payment_id == 1 || $payment->payment_id == 2){
                                        echo ' - '.$payment->name_person;
                                    }
                                    ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   Once you have made your payment, please confirm at our webstore in the next 48 hours, and once we've verified your payment, we'll ship your package within the next five business days.
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding" style="padding-top: 20px;">
                                   <a href="<?php echo \yii\helpers\Url::base(); ?>/user/order/confirmation/<?php echo $orders->orders_id;?>" class="blue-round default">CONFIRM PAYMENT</a>
                                </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    </div>
                <?php }elseif ($payment_method_id == 9) { ?>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding talign-center" style="color:#9e8463;padding-bottom: 15px;">
                                        PEMBAYARAN GO-PAY
                                    </div>
                                    <?php
                                        $va_log = \backend\models\VaLog::find()->where(['order_id'=>$orders->reference])->orderBy('va_id DESC')->one();
                                        $now = date('Y-m-d H:i:s'); 
                                        $to = date($va_log->transaction_time);
                                        $expire_count = \common\components\Helpers::getDifferentMicrotime($now, $to);
                                        if($now > $to){
                                          
                                            $expire_count = 0;
                                        }
                                    ?>
                                    <div class="col-xs-12 col-md-12 col-sm-12 hidden-lg clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                        <a href="<?php echo $va_log->action_deeplink_redirect;?>" class="blue-round default" style="width: 100%;text-align: center;border-radius: 25px;">
                                            
                                            <span style="">Pay Now with <img id="gopay-img" src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/gopay-white.png" class="img-responsive" style="display: inline;width: 35%;"></span>
                                        </a>
                                    </div>
                                    <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                        Buka aplikasi <span class="gotham-medium">GO-JEK</span> di HP Anda dan scan kode QR di bawah. Selengkapnya cara membayar dengan Go-Pay Klik <a data-toggle="modal" href="#qr-gopay-modal">Disini</a>
                                    </div>
                                    <div class="col-lg-12 hidden-sm hidden-md hidden-xs clearleft clearright gotham-light" style="padding-bottom: 15px;">
                                        <img src="<?php echo $va_log->action_qr_code_url; ?>" class="img-responsive" style="width: 200px;margin: auto;">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright gotham-light talign-center" style="padding-bottom: 10px;">
                                        Mohon selesaikan pembayaran Anda sebelum <br>
                                        <?php
                                            $expire_time = strtotime('+15 minutes', strtotime($va_log->transaction_time));
                                        ?>
                                        <?php echo date('d F', $expire_time).' '.date('H:i', $expire_time); ?>
                                    </div>    
                                </div>
                    </div>
                    <div id="qr-gopay-modal" class="modal fade" role="dialog">
                        <div class="modal-dialog warranty fcolor69" style="vertical-align: middle;margin-top: 10%;margin-bottom: 10%;">
    
                            <!-- Modal content-->
                            <div class="modal-content" style="border-radius: 10px;background-color: #fff;">
                                <div class="modal-body" style="padding-top: 15px;">
                                    <button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 17px;"><img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/x-black-24.png" style="width: 17px;"> </button>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 clearleft clearright clearleft-mobile clearright-mobile">
    
                                          <span class="clearleft clearright clearleft-mobile clearright-mobile gotham-light title-warranty">
                                            Scan QR Go-Pay
                                        </span>
                                        <span class="clearleft clearright clearright-mobile gotham-medium">
    
                                        </span>
    
                                    </div>
    
                                </div>
                                <div class="modal-body title-warranty" style="height: 500px;margin-top:10px;padding-top:5px;overflow-y: scroll;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright">
                                        <hr style="margin-top: 0px;margin-bottom: 5px;border-top:1px solid rgb(69,69,69);">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile" style="">
    
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile">
    
                                            <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                                                Bagaimana cara membayarnya? <br>
                                                Silahkan selesaikan pembayaran <span class="gotham-medium">GO-PAY</span> Anda menggunakan aplikasi <span class="gotham-medium">GO-JEK.</span>
                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                            <div class="col-lg-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                                                <ol style="padding-left: 15px;">
                                                  <li style="margin-left: 0;">Klik <span class="gotham-medium">Pay Now with GO-PAY.</span></li>
                                                  <li style="margin-left: 0;">Buka aplikasi <span class="gotham-medium">GO-JEK</span> di handphone Anda.</li>
                                                  <li style="margin-left: 0;">
                                                    Klik <span class="gotham-medium">Scan QR.</span><br>
                                                    <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-1.png" class="img-responsive" style="width: 60%;margin: auto;">
                                                    <span class="fsize-11 gotham-medium">Catatan:</span><br>
                                                    <span class="fsize-11">Tombol Scan QR tidak akan muncul jika saldo
                                                        GO-PAY Anda kurang dari Rp10,000.</span>
                                                    </li>
                                                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 new-line"></div>
                                                    <li style="margin-left: 0;">
                                                        Arahkan kamera Anda ke <span class="gotham-medium">QR Code.</span><br>
                                                        <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/qr-instruction-2.png" class="img-responsive" style="width: 60%;margin: auto;">
                                                    </li>
                                                    <li style="margin-left: 0;">Cek detai pembayaran Anda di aplikasi <span class="gotham-medium">GO-JEK</span> lalu <span class="gotham-medium">klik Pay.</span></li>
                                                    <li style="margin-left: 0;">Transaksi Anda telah selesai.</li>
                                                </ol>
                                            </div>
                                        </div>    
                                    </div>
    
    
    
                                </div>
                                <div class="modal-footer">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 clearleft clearright clearleft-mobile clearright-mobile gotham-light">
                                        <a class="blue-round close title-warranty" data-dismiss="modal" style="width:30%;text-align: center;float: right;padding-top: 14px;padding-bottom: 11px;text-shadow: none;">Tutup</a>
                                    </div>
                                </div>
    
                            </div>
    
                        </div>
                    </div>
    
                <?php }elseif($payment_method_id == 4 || $payment_method_id == 5 || $payment_method_id == 8){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            <form action="<?php echo \yii\helpers\Url::base() . '/cart/checkout/step/ordercompleteflash';?>" id="confirmorder-form" method="POST">
                                <input type="hidden" name="_csrf" value="<?php echo $_COOKIE['_csrf']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $orders->orders_id; ?>">
                                <input type="hidden" name="payment_method_id" value="<?php echo $payment_method_id; ?>">
                            </form>
                            <div class="col-lg-12 col-md-12 col-sm-12 remove-padding" style="">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $orders->paymentmethoddetail->payment->filename;?>">
                                <div class="fcolor69 gotham-medium" style="padding-top: 30px;">
                                    Anda akan menggunakan pembayaran melalui:
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                    <?php if($orders->paymentmethoddetail->paymentMethod->payment_method_id == 2){ ?>
                                        <?php echo $orders->paymentmethoddetail->paymentMethod->payment_method_name; ?>
                                    <?php }elseif($orders->paymentmethoddetail->paymentMethod->payment_method_id == 3){ ?>
                                        <?php echo $orders->paymentmethoddetail->payment->name_bank; ?>
                                    
                                    <?php }else{ ?>
                                        <?php echo $orders->paymentmethoddetail->paymentMethod->payment_method_name.' '.$orders->paymentmethoddetail->payment->name_bank; ?>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   
                                </div>
                                
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding" style="padding-top: 20px;">
                                   <?php if($payment_method_id == 4 || $payment_method_id == 5){ ?>
                                    <a id="multipayment-flash" class="blue-round default">Bayar Sekarang</a>
                                   <?php } ?>
                                   
                                </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    </div>
    
                <?php
                    }elseif($payment_method_id == 6){
                ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                        
                            <div class="col-lg-12 col-md-12 col-sm-12 remove-padding" style="">
                                <img src="<?php echo \yii\helpers\Url::base(); ?>/img/icons/<?php echo $orders->paymentmethoddetail->payment->filename;?>">
                                <div class="fcolor69 gotham-medium" style="padding-top: 30px;">
                                    Anda akan melakukan pembayaran
                                    menggunakan <?php echo $orders->paymentmethoddetail->payment->name_bank; ?>
                                    
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light clearright remove-padding">
                                    Silahkan melakukan pembayaran virtual account ke:
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-medium remove-padding" style="padding-top: 15px;padding-bottom: 15px;">
                                    <?php
                                        $va_log = \backend\models\VaLog::find()->where(['order_id'=>$orders->reference])->orderBy('va_id DESC')->one();
                                        echo $va_log->va_number.' - '.$va_log->va_bank;
                                    ?>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 gotham-light remove-padding">
                                   
                                </div>
                               
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 rgb243">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
                            
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 shopping-bag creditcardform clearleft-mobile clearright-mobile remove-padding" style="">
                            Mohon Tunggu
                        </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 new-line"></div>
          
                </div>
            <?php } ?>
                <div>
                    <button id="vospay" type="button" class="editpay ipad col-xs-12" style="width: 100%;text-align: center;border-radius: 25px; <?php if($payment_method_id == 8){ echo 'display:block;';}else{ echo 'display: none;'; }?>">Bayar</button>

                </div>
            </div>
            
        </div>
    </div>
</section>
<style type="text/css">
    .non-active{
        display: none;
    }
    .active{
        display: block;
    }
</style>

                    

<style type="text/css">
    .payment-preview-img{
        position: absolute;top: 25%;left: 123px;
    }
    .title-payment-preview{
        position: absolute;top:53%;width:100%;text-align:center;font-size: 14px;font-family: gotham-light;
    }
    .detail-payment-preview{
        position: absolute;top:58%;width:100%;text-align:center;font-size: 14px;font-family: gotham-medium;
    }
    .payment-preview-installment-img{
        position: absolute;top: 15%;left: 30px;
    }
    .payment-preview-installment-title{
        position: absolute;top:37%;width:100%;font-size: 14px;left:30px;font-family: gotham-medium;
    }
    .payment-preview-installment-name{
        position: absolute;top:15px;width:100%;left:30px;font-size: 14px;font-family: gotham-medium;
    }
    #pilih_bulan{
        position: absolute;top:53%;width:100%;left:30px;font-size: 14px;font-family: gotham-light;
    }
    .payment-preview-installment-month{
        position: absolute;top:73%;
    }
    #installmentform{
        padding: 0;left: 37%;right: 37%;max-height: none;
    }
    .shopping-bag.creditcardform{
        padding-top: 15px;padding-bottom: 6px;padding-left: 30px;padding-right: 30px;
    }
    .icon-mastercard{
        top: -14px;
    }
    .icon-visa{
        top: -10px;
    }
    .icon-mastercard.install{
        top: -20px;
    }
    .icon-visa.install{
        top: -16px;
    }
    span.ccil-text{
        font-size: 12px;
    }
    @media only screen and (max-width : 1365px) and (min-width: 1280px) {
        span.ccil-text{
            font-size: 10px;
        }
    }
    @media only screen and (max-width : 1040px) and (min-width: 1033px){
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        #installmentform{
            left: 30%;right: 30%;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 0px;
        }
        .icon-visa,.icon-visa.install{
            top: 3px;
        }
        .secure-text{
            padding-left: 0;
        }
    }
    @media only screen and (max-width : 1032px) and (min-width: 768px){
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        #installmentform{
            left: 25%;right: 25%;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 0px;
        }
        .icon-visa,.icon-visa.install{
            top: 3px;
        }
        .secure-text{
            padding-left: 0;
        }
    }
    @media only screen and (max-width : 767px) {
        .payment-preview-img{
            left: 35%;
        }
        .title-payment-preview{
            top:50%;
        }
        .detail-payment-preview{
           top:62%;
        }
        .payment-preview-installment-img{
            position: relative;
        }
        .payment-preview-installment-title{
            position: relative;padding-top: 20px;padding-bottom: 15px;
        
        }
        .payment-preview-installment-name{
            position: relative;top:0px;padding-top: 20px;padding-bottom: 20px;
        }
        #pilih_bulan{
            position: relative;padding-bottom: 15px;
        }
        .payment-preview-installment-month{
            position: relative;padding-bottom: 15px;
        }
        #installmentform{
            left: 12px;right: 12px;top: 12px;bottom: 12px;border-radius: 5px;
        }
        .shopping-bag.creditcardform {
            margin-top: 0%;
        }
        .secure-text{
            padding-left: 0;
        }
        .shopping-bag.creditcardform{
            padding-left: 15px;padding-right: 15px;background-color: rgb(243,243,243);border-radius: 5px;
        }
        .payment-preview-img.akulaku{
            width: 60px;top: 15px;left: 41%;
        }
        .icon-mastercard,.icon-mastercard.install{
            top: 18px;
        }
        .icon-visa,.icon-visa.install{
            top: 22px;
        }
    }
</style>



<script>
    var vospayConfig = vospayConfig || {};
    var grossamount = '<?php
//$weight = common\components\Helpers::generateWeightOrder($items);
//$shippingPrice = $shippingCost;
echo round(($grandTotal));
?>';
    var vospayOrderItems = [],
        vospayCustomerDetails = vospayCustomerDetails || {},
        vospayConfig = vospayConfig || {},
        vospayShipping = <?php echo $shippingCost + $shippingInsurance; ?>;
    
    promoMandiriAmount = <?php echo $promoMandiriAmount; ?>;
    
    <?php if (count($order_details) > 0) { ?>
    <?php foreach ($order_details as $order_detail) { ?>
    vospayOrderItems.push({
        id: '<?php echo $order_detail->product_id; ?>',
        name: '<?php echo str_replace("'", "", $order_detail->product_name); ?>',
        price: '<?php echo $order_detail->original_product_price; ?>',
        quantity: <?php echo $order_detail->product_quantity; ?>,
        category: {id: <?php echo intval($productCategoryModel->product_category_id);?>, name: '<?php echo $productCategoryModel->product_category_description; ?>'},
    });
    <?php } ?>
    <?php } ?>
    
    <?php if(isset($voucherInfo)){ ?>
    vospayOrderItems.push({
        id: '0',
        name: 'discount voucher',
        price: -<?php echo $discount ?>,
        quantity: 1,
        category: {id: <?php echo intval($productCategoryModel->product_category_id);?>, name: '<?php echo $productCategoryModel->product_category_description; ?>'},
    });
    <?php } ?>
    
    vospayCustomerDetails = {
        id: '<?php echo $_SESSION['customerInfo']['customer_id']; ?>',
        name: '<?php echo $_SESSION['customerInfo']['fname'] . ' ' . $_SESSION['customerInfo']['lname']; ?>',
        email: '<?php echo $_SESSION['customerInfo']['email']; ?>',
        phone: '<?php echo \backend\models\CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->phone; ?>',
        shippingAddress: '<?php echo \backend\models\CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->address1; ?>',
        billingAddress: '<?php echo \backend\models\CustomerAddress::findOne($_SESSION['customerInfo']['shippingMethod']['customer_address_id'])->address1; ?>'
    };
    
    var transactionDetails = {
        orderDescription: 'The Watch Co. - Order Information',
        items: vospayOrderItems,
        currency: 'IDR',
        shipping: vospayShipping,
        grossAmount: grossamount,
        customerDetails: vospayCustomerDetails
    };
    
document.getElementById('vospay').addEventListener('click', () => {
    confirmVospayOrder(transactionDetails);
    //clickHandler();
});
</script>