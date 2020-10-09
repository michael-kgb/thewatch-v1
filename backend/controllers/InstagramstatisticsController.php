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
class InstagramstatisticsController extends Controller {

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

        $module = \backend\models\Module::find()->where(['module_controller' => Yii::$app->controller->id])->one();
        $permissions = \backend\models\Permissions::find()->where(['group_id' => Yii::$app->session->get('userInfo')['group_id'], 'module_id' => $module->id])->one();

        $today = date("Y-m-d");
        $ago = (date('Y-m-d', strtotime('-7 day', strtotime(date("Y-m-d")))));

        $data = \backend\models\Instagram::find()->where(['>=', 'post_date', $ago])->andWhere(['<=', 'post_date', $today])->orderBy('post_date ASC')->all();

        $commentlike = array();

        for ($i = 0; $i <= 6; $i++) {
            $like = 0;
            $comment = 0;
            $past = '-' . $i . ' day';
            $ago = (date('Y-m-d', strtotime($past, strtotime(date("Y-m-d")))));
            $data = \backend\models\Instagram::find()->where(['>=', 'post_date', $ago . ' 00:00:00'])->andWhere(['<=', 'post_date', $ago . ' 23:59:59'])->orderBy('post_date ASC')->all();
            
            foreach ($data as $row) {
                $like = $like + $row->image_like_count;
                $comment = $comment + $row->image_comment_count;
            }

            $commentlike[$i] =  $ago . ', ' . $like . ', ' . $comment;
        }
        
        $data_tags = \backend\models\InstagramTags::find()->select(['tags_name', 'COUNT(*) AS total'])->groupBy('tags_name')->orderBy('COUNT(*) DESC')->limit(10)->all();
        
        $tags = array();
        
        $i = 0;
        foreach($data_tags as $row){
            $tags[$i] =  $row->tags_name . ',' . $row->total;
            $i++;
        }
        
        return $this->render('index', [
                    'add_access' => $permissions['add_access'], 'update_access' => $permissions['update_access'], 'delete_access' => $permissions['delete_access'], 'likecomments' => json_encode($commentlike), 'tags' => json_encode($tags)
        ]);
    }

}
