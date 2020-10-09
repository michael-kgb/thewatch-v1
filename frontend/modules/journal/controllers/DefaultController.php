<?php

namespace app\modules\journal\controllers;

use frontend\core\controller\FrontendController;

class DefaultController extends FrontendController {
	
	public $title = 'The Watch Co.';

    public function actionIndex() {

        $journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
        $limit = 8;
		if(isset($_GET['page'])){
			$pages = $_GET["page"];
		}else{
			$pages = "";
		}
        
                if($pages=='' || $pages == "1"){
                    $pages=0;
                }  else {
                    $pages = ($pages*$limit)-$limit;
                }
        
        $journalList = \backend\models\Journal::find()
                ->with([
                    "journalAuthor",
                    "journalCategory",
                    "journalDetail",
                    "journalImage",
                    "journalRelated"
                ])
				->orderBy('journal_id DESC')
                ->where(["journal_status" => 1])
                ->limit($limit)
                ->offset($pages)
                ->all();
        
        $active = "";
        $journalList1 = \backend\models\Journal::find()
                ->with([
                    "journalAuthor",
                    "journalCategory",
                    "journalDetail",
                    "journalImage",
                    "journalRelated"
                ])
                ->where(["journal_status" => 1])
                ->all();
        
        
        return $this->render('index', array("journalCategory" => $journalCategory, "journalList" => $journalList, "journalList1"=>$journalList1, "limit"=>$limit));
    }

    public function actionDetail($title) {
		
		
		
        $limit = 6;
        $pages = $_GET["page"];
                if($pages=='' || $pages == "1"){
                    $pages=0;
                }  else {
                    $pages = ($pages*$limit)-$limit;
                }

        $journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
		if(isset($_GET['cat'])){
			
			$journalCategoryId = \backend\models\JournalCategory::findOne(["journal_category_name" => $_GET['cat']]);
			$journalDetailCategory = \backend\models\JournalDetailCategory::find()->where(['journal_category_id' => $journalCategoryId['journal_category_id']])->all();
			
			foreach($journalDetailCategory as $row){
				$journaldetail[] = $row->journal_detail_id;
				//$i++;
			}
			
			$journalList = \backend\models\Journal::find()
					->joinWith([  
						'journalDetail',
					])
					->with([
						"journalAuthor",
						"journalCategory",
						"journalImage",
						"journalRelated"
					])
					->orderBy('journal_id DESC')
					->where(["journal_status" => 1])
					->andWhere(['journal_detail.journal_detail_id'=> $journaldetail])
					->limit(3)
					->all();
		}else{
			$journalList = \backend\models\Journal::find()
					->with([
						"journalAuthor",
						"journalCategory",
						"journalDetail",
						"journalImage",
						"journalRelated"
					])
					->orderBy('journal_id DESC')
					->where(["journal_status" => 1])
					->limit(3)
					->all();

		}
							
        if (isset($title)) {

            $journalDetail = \backend\models\JournalDetail::find()
                    ->where(["link_rewrite" => $title])
                    ->one();

            $journal = \backend\models\Journal::find()
                    ->where(["journal_id" => $journalDetail->journal_id])
                    ->one();

            $category = \backend\models\JournalDetailCategory::find()->where(['journal_detail_id' => $journalDetail->journal_detail_id])->all();
            $active = array();
            $i = 0;
            foreach($category as $row){
                $active[$i] = $row->journalCategory->journal_category_id;
                $i++;
            }


            $journalCategoryId = \backend\models\JournalCategory::find()->where(["journal_category_id" => $active])->andWhere(["journal_category_status" => '1'])->all();
			// $journalcate = [];
			// $s = 0;
			// foreach($journalCategoryId as $row){
			//     $journalcate[$s] = $row->journal_detail_id;
			//     $s++;
			// }
			$journalDetailCategory = \backend\models\JournalDetailCategory::find()->where(['journal_category_id' => $active])->all();
			
			$limit = 6;
			$pages = $_GET["page"];

					if($pages == '' || $pages == "1"){
						$pages=0;
					}  else {
						$pages = ($pages*$limit)-$limit;
					}
			$j = 0;
			$journaldetail = [];
			foreach($journalDetailCategory as $row){
				$journaldetail[$j] = $row->journal_detail_id;
				$j++;
			}
        
			$related = \backend\models\Journal::find()
                
                ->joinWith([  
                    'journalDetail',
                ])
                ->orderBy('journal_id DESC')
                ->where(['journal_status' => 1])
                ->andWhere(['journal_detail.journal_detail_id'=> $journaldetail])
                ->limit($limit)
                ->offset($pages)
                ->all();
				
			// echo ($journalCategoryId['journal_category_id']);
			// print_r($related);die();
        
			$detail_substr = substr($journal->journalDetail->journal_short_description, 3, strlen($journal->journalDetail->journal_short_description)-9);
			
			\Yii::$app->view->title = 'The Watch Co. - ' . $journal->journalDetail->journal_detail_title;
			
			\Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $journal->journalDetail->journal_detail_title . ' - The Watch Co.']);
			\Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => strip_tags($journal->journalDetail->journal_short_description)]);
			\Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $journal->journalDetail->journal_detail_title]);
        
			\Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => 'The Watch Co.']);
			\Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $journal->journalDetail->journal_detail_title ]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $detail_substr ]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:type', 'content' => 'article']);
			\Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => 'https://thewatch.co/journal/detail/' . $journal->journalDetail->link_rewrite ]);
			\Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => 'https://thewatch.co/img/journal/' . $journal->journal_id . '/small_cover_' . $journal->journalImage->journal_image_id . '.jpg' ]);
            
			
			if ($journal->journal_status == 1) {
                return $this->render('detail', array(
				"journalCategory" => $journalCategory, 
				"journal" => $journal, 
				"active" => $active, 
				"journalList" => $journalList,
				"related" => $related, 
				"limit"=>$limit
				));
            }
            else{
                return $this->redirect('../../journal');
            }
        }
    }

    public function actionPreview($title) {

        $journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);

        if (isset($title)) {

            $journalDetail = \backend\models\JournalDetail::find()
                    ->where(["link_rewrite" => $title])
                    ->one();

            $journal = \backend\models\Journal::find()
                    ->where(["journal_id" => $journalDetail->journal_id])
                    ->one();

            $related = \backend\models\JournalRelated::find()->limit(3)->where(["journal_parent_id" => $journal->journal_id])->all();

            $active = $journal->journalCategory->journal_category_name;

            return $this->render('detail', array("journalCategory" => $journalCategory, "journal" => $journal, "active" => $active, "related" => $related));
        }
    }

}
