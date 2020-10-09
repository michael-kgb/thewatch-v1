<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\core\controller;
use backend\models\BrandsBanner;
use backend\models\BrandsBannerDetail;
use DrewM\MailChimp\MailChimp;

class ContactController extends controller\FrontendController {

    public $breadcrumb = ["Contact"];
    public $title = "";

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
		
		\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => 'Customer Service Kami Siap Membantu Anda Hubungi Kami Sekarang!']);
		
        return $this->render('index');
    }
	
	public function actionImportmcproduct(){
		//$apiKey = Yii::$app->getModule('mailchimp')->apiKey;
        //$MailChimp = new MailChimp($apiKey);
        
        //$importCustomerMailchimp = \common\components\Helpers::importProductMailchimp();
        
        //print_r($importCustomerMailchimp); die();
        
        //if(count($importCustomerMailchimp) > 0){
            //foreach($importCustomerMailchimp as $customer){
                //$MailChimp->post('ecommerce/stores/twc1/products', $customer);
            //}
        //}
		
		$products = \backend\models\Product::find()
			->limit(500)
			->offset(1500)
			//->where(['active' => 1])
			->all();
		
		if(count($products) > 0){
			foreach($products as $product){
				\common\components\Helpers::updateProductMailchimp($product->product_id);
			}
		}
	}
	
	public function actionChecksession(){
		session_start();
		print_r($_SESSION);
		die();
	}
	
	public function actionChangeflash(){
		session_start();
		$i = 0;
            // if($_SESSION['customerInfo']['customer_id'] == 6181){
                foreach ($_SESSION['cart']['items'] as $item) {
                    $_SESSION['cart']['items'][$i]['flash_sale'] = 1;
                    $i++;
                }    
            // }
        print_r($_SESSION);
		die();
	}
	
	public function actionGeneratesitemap(){
		$action = $_GET['action'];
		$slug = $_GET['slug'];
		$category = $_GET['category'];
		
		if($action == "brand"){
			
			$url_prefix = "https://www.thewatch.co/";
			$now = date('Y-m-d');
			
			$output .= '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
			$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
			
			$brands = \backend\models\Brands::findAll(["brand_status" => "active"]);
			if(count($brands) > 0){
				foreach($brands as $row){
					$output .= '<url>' . "\n";
					$output .= '<loc>' . $url_prefix . 'brand/' . $row->link_rewrite . '</loc>' . "\n";
					$output .= '<priority>0.9</priority>' . "\n";
					$output .= '<changefreq>daily</changefreq>' . "\n";
					$output .= '<lastmod>' . $now . '</lastmod>' . "\n";
					$output .= '</url>' . "\n";
				}
			}
			
			$output .= '</urlset>';
			
			echo $output;
			
		}
		
		if($action == "journal"){
			
			if(isset($category)){
			
				$url_prefix = "https://www.thewatch.co/";
				$now = date('Y-m-d');
				
				$output .= '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
				$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
				
				if($slug == "all"){
				
					$brands = \backend\models\Journal::find()
						->joinWith([
							"journalDetail"
						])
						->where(["journal_status" => 1])
						->all();
					
					if(count($brands) > 0){
						foreach($brands as $row){
							$output .= '<url>' . "\n";
							$output .= '<loc>' . $url_prefix . 'journal/detail/' . str_replace('&', '', $row->journalDetail->link_rewrite) . '</loc>' . "\n";
							$output .= '<priority>0.9</priority>' . "\n";
							$output .= '<changefreq>daily</changefreq>' . "\n";
							$output .= '<lastmod>' . $now . '</lastmod>' . "\n";
							$output .= '</url>' . "\n";
						}
					}
					
				}
				
				if($slug == "category"){
					
					$journalCategory = \backend\models\JournalCategory::findOne(["journal_category_name" => strtolower($category)]);
					$journalCategoryId = 0;
					
					if($journalCategory != NULL){
						$journalCategoryId = $journalCategory->journal_category_id;
					}
					
					$brands = \backend\models\JournalDetail::find()
						->joinWith([
							"journal",
							"journalDetailCategory"
						])
						->andWhere(["=", "journal.journal_status", 1])
						->andWhere(["=", "journal_detail_category.journal_category_id", $journalCategoryId])
						->orderBy('journal_detail_id DESC')
						->all();
						
					if(count($brands) > 0){
						foreach($brands as $row){
							$output .= '<url>' . "\n";
							$output .= '<loc>' . $url_prefix . 'journal/detail/' . str_replace('&', '', $row->link_rewrite) . '</loc>' . "\n";
							$output .= '<priority>0.9</priority>' . "\n";
							$output .= '<changefreq>daily</changefreq>' . "\n";
							$output .= '<lastmod>' . $now . '</lastmod>' . "\n";
							$output .= '</url>' . "\n";
						}
					}
				}
				
				$output .= '</urlset>';
				
				echo $output;
			}
			
		}
		
		if($action == "brands"){
			
			if(isset($category)){
				
				$productCategory = \backend\models\ProductCategory::findOne(["product_category_name" => $category]);
				$productCategoryId = 0;
				
				if($productCategory != NULL){
					$productCategoryId = $productCategory->product_category_id;
				}
				
				$url_prefix = "https://www.thewatch.co/";
				$now = date('Y-m-d');
				
				$output .= '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
				$output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
				
				if($slug == "all"){
				
					$brands = \backend\models\Product::find()
						->joinWith([
							"productDetail"
						])
						->where(["active" => 1, "product_category_id" => $productCategoryId])
						->all();
					
				}
				
				if($slug == "new"){
					$brands = \backend\models\Product::find()
						->joinWith([
							"productDetail",
							"productNewArrival",
						])
						->where(["active" => 1, "product_category_id" => $productCategoryId])
						->andWhere(['<=', 'product_newarrival.product_newarrival_start_date',$now])
						->andWhere(['>=', 'product_newarrival.product_newarrival_end_date',$now])
						->all();
				}
				
				if($slug == "best"){
					$brands = \backend\models\Product::find()
						->joinWith([
							"productDetail",
							"productBestSeller",
						])
						->where(["active" => 1, "product_category_id" => $productCategoryId])
						->andWhere('product_bestseller.product_bestseller_start_date <= "'. $now . '"')
						->andWhere('product_bestseller.product_bestseller_end_date > "'. $now . '"')
						->all();
				}
				
				if($slug == "sale"){
					$brands = \backend\models\Product::find()
						->joinWith([
							"productDetail",
							"specificPrice",
						])
						->where(["active" => 1, "product_category_id" => $productCategoryId])
						->andWhere('specific_price.from <= "'. $now . '"')
						->andWhere('specific_price.to > "'. $now . '"')
						->all();
				}
				
				if(count($brands) > 0){
					foreach($brands as $row){
						$output .= '<url>' . "\n";
						$output .= '<loc>' . $url_prefix . 'product/' . str_replace('&', '', $row->productDetail->link_rewrite) . '</loc>' . "\n";
						$output .= '<priority>0.9</priority>' . "\n";
						$output .= '<changefreq>daily</changefreq>' . "\n";
						$output .= '<lastmod>' . $now . '</lastmod>' . "\n";
						$output .= '</url>' . "\n";
					}
				}
				
				$output .= '</urlset>';
				
				echo $output;
				
			}
		}
	}

    public function actionSendinquiries() {
        try {
            \common\components\Helpers::sendEmailMandrillUrlInquiriesAPI(
                    $this->renderFile('@app/views/template/mail/inquiries.php', array(
                        "name" => htmlspecialchars(stripslashes(trim($_POST['name']))),
                        "email" => htmlspecialchars(stripslashes(trim($_POST['email']))),
                        "subject" => htmlspecialchars(stripslashes(trim($_POST['subject']))),
                        "message" => htmlspecialchars(stripslashes(trim($_POST['message']))),
                        )),
                    htmlspecialchars(stripslashes(trim($_POST['subject']))), htmlspecialchars(stripslashes(trim($_POST['email']))), htmlspecialchars(stripslashes(trim($_POST['name']))), 'cs@thewatch.co', ''
            );
        } catch (Exception $ex) {
            
        }
        
        return $this->render('success');
    }
	
	public function actionConfirmreceipt(){
		//$akulaku = new \common\components\Akulaku();
		//$akulaku->setEnvironment('production');
		//$akulaku->setCredentials("626809194", "qeJjLw49bZkMlCAersNan2g-Ji7cQ8utPAxDoPy3hS0");
		
		//$receipt = $akulaku->confirmReceipt('TR171126151532');
		//print_r($receipt);
		
		$orderReminder = new \backend\models\OrdersReminder();
		$orderReminder->orders_id = '111';
		$orderReminder->orders_reminder_date = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . ' +1 day'));
		$orderReminder->save();
	}

}
