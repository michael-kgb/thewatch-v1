<?php

namespace backend\controllers;

use Yii;
use common\models\tags;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * tagsController implements the CRUD actions for tags model.
 */
class InstagramController extends Controller {

    public $layout = "dashboard";

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

        $data = \backend\models\Instagram::find()->all();
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

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (isset($_POST['instagram'])) {
            $instagram = \backend\models\Instagram::findOne($id);
            $instagram->brand_id = $_POST['instagram']['brands'];
            $instagram->image_caption = $_POST['instagram']['caption'];
            $instagram->update();

            if (!empty($_POST['instagramproduct'])) {
                \backend\models\InstagramDetail::deleteAll(['instagram_id' => $id]);
            }

            for ($i = 0; $i < count($_POST['instagramproduct']); $i++) {
                $instagramDetail = new \backend\models\InstagramDetail();
                $instagramDetail->instagram_id = $id;
                $instagramDetail->product_id = $_POST['instagramproduct'][$i];
                $instagramDetail->save();
            }

            $log = new \backend\models\Log();
            $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
            $log->module = Yii::$app->controller->id;
            $log->action = 'update';

            $log->id_onChanged = $id;

            $log->save();

            return $this->redirect('../index');
        } else {
            $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
            $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

            if ($permissions['update_access'] != '1') {
                return $this->redirect('../../permissionscheck');
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete() {

        $id = $_POST['cartrule_id'];

        $this->findModel($id)->delete();
        $cart_rule_lang = \backend\models\CartRuleLang::deleteAll(['cart_rule_id' => $id]);
        $cart_rule_product_group = \backend\models\CartRuleProductRuleGroup::find(['cart_rule_id' => $id])->one();
        $cart_rule_product = \backend\models\CartRuleProductRule::find(['cart_rule_product_rule_group' => $cart_rule_product_group['cart_rule_product_rule_group_id']])->all();

        foreach ($cart_rule_product as $row) {
            $cart_rule_product_rule_value = \backend\models\CartRuleProductRuleValue::deleteAll(['product_rule_id' => $row->cart_rule_product_rule_id]);
            $row->delete();
        }

        if (!empty($cart_rule_product_group)) {
            $cart_rule_product_group->deleteAll();
        }

        $log = new \backend\models\Log();
        $log->fullname = Yii::$app->session->get('userInfo')['fullname'];
        $log->module = Yii::$app->controller->id;
        $log->action = 'delete';

        $log->id_onChanged = $id;

        $log->save();

        return 1;
    }

    /**
     * Finds the tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = \backend\models\Instagram::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionFetchallinstagram() {
        $profile = file_get_contents("https://api.instagram.com/v1/users/self/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
        $profile_decode = json_decode($profile, true);

        $total_media = $profile_decode['data']['counts']['media'];
        $total = $total_media / 20;

        if ($total_media % 20 != 0) {
            $total = $total + 1;
        }

        $max_id = 0;

        for ($i = 1; $i <= $total; $i++) {
            try {
                if ($i == 1) {
                    $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
                } else {
                    $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1&max_id=" . $max_id);
                }
                $media_decode = json_decode($media, true);
                $max_id = $media_decode['pagination']['next_max_id'];
            } catch (Exception $ex) {
                return json_encode($media_decode);
            }

            foreach ($media_decode['data'] as $row) {
                $instagram = \backend\models\Instagram::findOne(['image_id' => $row['id']]);
                if (!empty($instagram)) {
                    $instagram->image_caption = $row['caption']['text'];
                    $instagram->image_like_count = $row['likes']['count'];
                    $instagram->image_comment_count = $row['comments']['count'];
                    try {
                        $instagram->update();
                    } catch (Exception $ex) {
                        continue;
                    }

                    \backend\models\InstagramTags::deleteAll(['instagram_id' => $instagram->instagram_id]);

                    for ($j = 0; $j < count($row['tags']); $j++) {
                        $instagramtags = new \backend\models\InstagramTags();
                        $instagramtags->instagram_id = $instagram->instagram_id;
                        $instagramtags->tags_name = $row['tags'][$j];
                        $instagramtags->status = 1;
                        try {
                            if(!empty($instagram->instagram_id)){
                                $instagramtags->save();
                            }
                        } catch (Exception $ex) {
                            continue;
                        }
                    }
                } else {
                    $instagram = new \backend\models\Instagram();
                    $instagram->brand_id = 0;
                    $instagram->post_date = date('Y-m-d H:i:s', preg_replace('/[^\d]/', '', $row['created_time']));
                    $instagram->image_id = $row['id'];
                    $instagram->image_file = $row['images']['standard_resolution']['url'];
                    $instagram->image_caption = $row['caption']['text'];
                    $instagram->image_like_count = $row['likes']['count'];
                    $instagram->image_comment_count = $row['comments']['count'];
                    $instagram->active = 1;
                    try {
                        $instagram->save();
                    } catch (Exception $ex) {
                        continue;
                    }

                    for ($j = 0; $j < count($row['tags']); $j++) {
                        $instagramtags = new \backend\models\InstagramTags();
                        $instagramtags->instagram_id = $instagram->instagram_id;
                        $instagramtags->tags_name = $row['tags'][$j];
                        $instagramtags->status = 1;
                        try {
                            if(!empty($instagram->instagram_id)){
                                $instagramtags->save();
                            }
                        } catch (Exception $ex) {
                            continue;
                        }
                    }
                }
            }
        }

        return json_encode($media_decode['data']);
    }

    public function actionFetchinstagrambycount() {

        $total_media = $_POST['count'];
        print_r($total_media);
        $total = $total_media / 20;

        if ($total_media < 20) {
            $total = 1;
        } else if ($total_media % 20 != 0) {
            $total = $total + 1;
        }

        $max_id = 0;
        $count = 0;

        for ($i = 1; $i <= $total; $i++) {
            try {
                if ($i == 1) {
                    $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
                } else {
                    $media = file_get_contents("https://api.instagram.com/v1/users/22192614/media/recent/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1&max_id=" . $max_id);
                }
                $media_decode = json_decode($media, true);
                $max_id = $media_decode['pagination']['next_max_id'];
            } catch (Exception $ex) {
                return json_encode($media_decode);
            }

            foreach ($media_decode['data'] as $row) {
                $count++;
                if ($count == $_POST['count']) {
                    return json_encode($media_decode['data']);
                }
                $instagram = \backend\models\Instagram::findOne(['image_id' => $row['id']]);
                if (!empty($instagram)) {
                    $instagram->image_caption = $row['caption']['text'];
                    $instagram->image_like_count = $row['likes']['count'];
                    $instagram->image_comment_count = $row['comments']['count'];
                    try {
                        $instagram->update();
                    } catch (Exception $ex) {
                        continue;
                    }

                    \backend\models\InstagramTags::deleteAll(['instagram_id' => $instagram->instagram_id]);

                    for ($j = 0; $j < count($row['tags']); $j++) {
                        $instagramtags = new \backend\models\InstagramTags();
                        $instagramtags->instagram_id = $instagram->instagram_id;
                        $instagramtags->tags_name = $row['tags'][$j];
                        $instagramtags->status = 1;
                        try {
                            $instagramtags->save();
                        } catch (Exception $ex) {
                            continue;
                        }
                    }
                } else {
                    $instagram = new \backend\models\Instagram();
                    $instagram->brand_id = 0;
                    $instagram->post_date = date('Y-m-d H:i:s', preg_replace('/[^\d]/', '', $row['created_time']));
                    $instagram->image_id = $row['id'];
                    $instagram->image_file = $row['images']['standard_resolution']['url'];
                    $instagram->image_caption = $row['caption']['text'];
                    $instagram->image_like_count = $row['likes']['count'];
                    $instagram->image_comment_count = $row['comments']['count'];
                    $instagram->active = 1;
                    try {
                        $instagram->save();
                    } catch (Exception $ex) {
                        continue;
                    }

                    for ($j = 0; $j < count($row['tags']); $j++) {
                        $instagramtags = new \backend\models\InstagramTags();
                        $instagramtags->instagram_id = $instagram->instagram_id;
                        $instagramtags->tags_name = $row['tags'][$j];
                        $instagramtags->status = 1;
                        try {
                            $instagramtags->save();
                        } catch (Exception $ex) {
                            continue;
                        }
                    }
                }
            }
        }
        return json_encode($media_decode['data']);
    }

    public function actionGetalldata($draw) {
        $total_customer = \backend\models\Instagram::find()->all();
        $total_find = \backend\models\Instagram::find()->where(['like', 'image_caption', $_GET['search']['value']])->all();

        $table = array('post_date', 'image_file', 'image_caption', 'image_like_count', 'image_comment_count', 'active', 'post_date', 'instagram_id');

        $order = $table[$_GET['order'][0]['column']] . ' ' . $_GET['order'][0]['dir'];

        $customer = \backend\models\Instagram::find()->where(['like', 'image_caption', $_GET['search']['value']])->orderBy($order)->offset($_GET['start'])->limit($_GET['length'])->all();
        $data = '{
            "draw": ' . $_GET['draw'] . ',
            "recordsTotal": ' . count($total_customer) . ',
            "recordsFiltered": ' . count($total_find) . ',
            "data": ';

        $columns = array();
        $numbering = $_GET['start'];

        foreach ($customer as $row) {
            $active = $row->active != 0 ? 'Active' : 'Inactive';
            $image = '<img src="' . $row->image_file . '" class="img-responsive" />';
            $numbering++;
            $button = '<div class="btn-group">'
                    . '<button type="button" class="btn btn-default" onclick="javascript:location.href=&#39;view/' . $row->instagram_id . '&#39;"><i class="fa fa-fw fa-eye"></i> View</button>'
                    . '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>'
                    . '<ul class="dropdown-menu" role="menu">'
                    . '<li><a href="update/' . $row->instagram_id . '"><i class="fa fa-fw fa-pencil"></i> Update</a></li>'
                    . '</ul>'
                    . '</div>';

            $customer_array = array($numbering, $image, $row->image_caption, $row->image_like_count, $row->image_comment_count, $active, $row->post_date, $button);
            array_push($columns, $customer_array);
        }

        $data = $data . json_encode($columns) . '}';
        return $data;
    }

    public function actionFetchallinstagramcomment() {
        $instagram = \backend\models\Instagram::find()->where(['>=', 'instagram_id', 1])->all();

        foreach ($instagram as $roww) {
            $media = file_get_contents("https://api.instagram.com/v1/media/" . $roww->image_id . "/comments?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
            $media_decode = json_decode($media, true);

            foreach ($media_decode['data'] as $row) {
                $checkusername = \backend\models\InstagramHashtag::findOne(['user_id' => $row['from']['id']]);

                if (!empty($checkusername)) {
                    $checkusername->comment_count = $checkusername->comment_count + 1;
                    $checkusername->update();
                } else {
                    $instagram_hashtag = new \backend\models\InstagramHashtag();
                    $instagram_hashtag->user_id = $row['from']['id'];
                    $instagram_hashtag->user_photo = $row['from']['profile_picture'];
                    $instagram_hashtag->username = $row['from']['username'];
                    $instagram_hashtag->fullname = $row['from']['full_name'];
                    $instagram_hashtag->like_count = 0;
                    $instagram_hashtag->comment_count = 1;
                    $instagram_hashtag->save();
                }
            }
        }

        return json_encode($media_decode['data']);
    }

    public function actionFetchallinstagramlike() {
        $instagram = \backend\models\Instagram::find()->all();

        foreach ($instagram as $roww) {
            $media = file_get_contents("https://api.instagram.com/v1/media/" . $roww->image_id . "/likes?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
            $media_decode = json_decode($media, true);

            foreach ($media_decode['data'] as $row) {
                $checkusername = \backend\models\InstagramHashtag::findOne(['user_id' => $row['id']]);

                if (!empty($checkusername)) {
                    $checkusername->like_count = $checkusername->like_count + 1;
                    $checkusername->update();
                } else {
                    try {
                        $user = @file_get_contents("https://api.instagram.com/v1/users/" . $row['id'] . "/?access_token=22192614.51f0cd2.663a32f23dd54f7aa57d1afbc70c20d1");
                        if ($user == false) {
                            continue;
                        }
                    } catch (Exception $ex) {
                        continue;
                    }

                    $user_decode = json_decode($user, true);

                    if ($user_decode['meta']['code'] == 400) {
                        continue;
                    }

                    $instagram_hashtag = new \backend\models\InstagramHashtag();
                    $instagram_hashtag->user_id = $row['id'];
                    $instagram_hashtag->user_photo = $user_decode['data']['profile_picture'];
                    $instagram_hashtag->username = $user_decode['data']['username'];
                    $instagram_hashtag->fullname = $user_decode['data']['full_name'];
                    $instagram_hashtag->like_count = 1;
                    $instagram_hashtag->comment_count = 0;
                    $instagram_hashtag->save();
                }
            }
        }

        return json_encode($media_decode['data']);
    }

}
