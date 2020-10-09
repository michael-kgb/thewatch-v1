<?php

namespace backend\controllers;

use Yii;
use common\models\tags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * tagsController implements the CRUD actions for tags model.
 */
class NewsletterController extends Controller {

    public $layout = "dashboard";
	
	public $enableCsrfValidation = false;

    public function behaviors() {
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        if ($permissions['view_access'] != '1') {
            return $this->redirect('../permissionscheck');
        }

        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all tags models.
     * @return mixed
     */
    public function actionIndex() {
        $data = \backend\models\Newsletter::find()->all();
        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        return $this->render('index', [
            'data' => $data, 'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access']
        ]);
    }

    /**
     * Displays a single tags model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        
        $data = $_POST['Newsletter'];
        
        if($data){
            
            $newsletter = new \backend\models\Newsletter();
            
            $imagePoster = UploadedFile::getInstance($newsletter, 'posterImage');
            $imageJournalPoster = UploadedFile::getInstance($newsletter, 'journalPoster');
            $imageBrandPoster1 = UploadedFile::getInstance($newsletter, 'brandPoster1');
            $imageBrandPoster2 = UploadedFile::getInstance($newsletter, 'brandPoster2');
            
            $filenamePoster = round(microtime(true)) . '_poster.' . $imagePoster->extension;
            $filenameJournalPoster = round(microtime(true)) . '_journal.' . $imageJournalPoster->extension;
            $filenameBrandPoster1 = round(microtime(true)) . '_brand1.' . $imageJournalPoster->extension;
            $filenameBrandPoster2 = round(microtime(true)) . '_brand2.' . $imageJournalPoster->extension;
            
            $newsletter->newsletter_poster = $filenamePoster;
            $newsletter->newsletter_poster_url = $data['posterImageUrl'];
            $newsletter->journal_poster = $filenameJournalPoster;
            $newsletter->journal_poster_url = $data['journalPosterUrl'];
            $newsletter->brand_poster1 = $filenameBrandPoster1;
            $newsletter->brand_poster1_url = $data['brandPosterUrl1'];
            $newsletter->brand_poster2 = $filenameBrandPoster2;
            $newsletter->brand_poster2_url = $data['brandPosterUrl2'];
            
            $newsletter->newsletter_subject = $data['subject'];
            $newsletter->save();
            
            // upload newsletter poster image
            $this->upload($imagePoster, $filenamePoster, $newsletter->newsletter_id);
            
            // upload newsletter journal image
            $this->upload($imageJournalPoster, $filenameJournalPoster, $newsletter->newsletter_id);
            
            // upload newsletter brand image 1
            $this->upload($imageBrandPoster1, $filenameBrandPoster1, $newsletter->newsletter_id);
            
            // upload newsletter brand image 2
            $this->upload($imageBrandPoster2, $filenameBrandPoster2, $newsletter->newsletter_id);
            
            $productList = \backend\models\Product::find()
            ->joinWith([
                "brands",
                "productDetail",
                "productImage" => function ($query) {
                    $query->andWhere(['cover' => 1]);
                }
            ])
            ->where(['product.product_id' => $_POST['productItems']])
            ->all();
            
//            $customerEmail = \backend\models\NewsletterSignup::findAll();
            
            // $customerList = \backend\models\Customer::find()->where(['newsletter' => 1])->all();
            
			// if(count($customerList) > 0){
				// foreach($customerList as $customer){
					//send newsletter in customer email 
					// \common\components\Helpers::sendEmailMandrillUrlAPI(
						// $this->renderFile('@app/views/template/mail/newsletter.php', array(
							// 'baseUrl' => \yii\helpers\Url::base(),
							// 'posterImage' => $filenamePoster,
							// 'journalImage' => $filenameJournalPoster,
							// 'brandImage1' => $filenameBrandPoster1,
							// 'brandImage2' => $filenameBrandPoster2,
							// 'posterUrl' => $data['posterImageUrl'],
							// 'journalUrl' => $data['journalPosterUrl'],
							// 'brandPosterUrl1' => $data['brandPosterUrl1'],
							// 'brandPosterUrl2' => $data['brandPosterUrl2'],
							// 'productList' => $productList,
							// 'id' => $newsletter->newsletter_id
						// )), $data['subject'], 'notification@thewatch.co', $customer->email, ''
					// );
				// }
			// }
            
            $newsletterSignupList = \backend\models\NewsletterSignup::find()->all();
            
			if(count($newsletterSignupList) > 0){
				foreach($newsletterSignupList as $customer){
					// send newsletter in newsletter signup email 
					\common\components\Helpers::sendEmailMandrillUrlAPI(
						$this->renderFile('@app/views/template/mail/newsletter.php', array(
							'baseUrl' => \yii\helpers\Url::base(),
							'posterImage' => $filenamePoster,
							'journalImage' => $filenameJournalPoster,
							'brandImage1' => $filenameBrandPoster1,
							'brandImage2' => $filenameBrandPoster2,
							'posterUrl' => $data['posterImageUrl'],
							'journalUrl' => $data['journalPosterUrl'],
							'brandPosterUrl1' => $data['brandPosterUrl1'],
							'brandPosterUrl2' => $data['brandPosterUrl2'],
							'productList' => $productList,
							'id' => $newsletter->newsletter_id,
							'email' => $customer->newsletter_signup_email
						)), $data['subject'], 'notification@thewatch.co', $customer->newsletter_signup_email, ''
					);
				}
			}
            
            return $this->redirect('index');
            
        } else {
            return $this->render('create');
        }
        
    }
    
    private function upload($image, $filename, $id) {
        $path = '../../frontend/web/img/newsletter/poster/' . $id;
		if(!file_exists($path)){
			mkdir($path);
		}
        $image->saveAs('../../frontend/web/img/newsletter/poster/' . $id . '/' . $filename);
    }

    /**
     * Updates an existing tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        
    }

    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {

    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\CartRule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionGetemaillist($draw){
        
        $total_email = \backend\models\NewsletterSignup::find()->all();
        $total_find = \backend\models\NewsletterSignup::find()->where(['like', 'newsletter_signup_email', $_GET['search']['value']])->all();
        
        $table = array('newsletter_signup_id', 'newsletter_signup_email', 'active');

        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];

        $data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . count($total_email) . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';

        $columns = array();
        $numbering = $_GET['start'];
        
        $emailListSubscribe = \backend\models\NewsletterSignup::find()->where(['like', 'newsletter_signup_email', $_GET['search']['value']])->offset($_GET['start'])->limit($_GET['length'])->all();
        
        foreach ($emailListSubscribe as $row) {
            $active = 'Active';
            $numbering++;

            $customer_array = array($numbering, $row->newsletter_signup_email, $active);
            array_push($columns, $customer_array);
        }
        
        $data = $data . json_encode($columns) . '}';
        return $data;
    }

}
