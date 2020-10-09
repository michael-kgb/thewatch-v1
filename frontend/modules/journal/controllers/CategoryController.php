<?php

namespace app\modules\journal\controllers;

use frontend\core\controller\FrontendController;

class CategoryController extends FrontendController {
    
    public function actionIndex($categoryName)
    {
        $journalCategoryId = \backend\models\JournalCategory::findOne(["journal_category_name" => $categoryName]);
        $journalCategoryList = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
        $journalDetailCategory = \backend\models\JournalDetailCategory::find()->where(['journal_category_id' => $journalCategoryId['journal_category_id']])->all();
        
        $limit = 8;
        $pages = $_GET["page"];

                if($pages=='' || $pages == "1"){
                    $pages=0;
                }  else {
                    $pages = ($pages*$limit)-$limit;
                }
        foreach($journalDetailCategory as $row){
            $journaldetail[] = $row->journal_detail_id;
            //$i++;
        }
    
        $journalList = \backend\models\Journal::find()
                
                ->joinWith([  
                    'journalDetail',
                ])
				->orderBy('journal_id DESC')
                ->where(['journal_status' => 1])
                ->andWhere(['journal_detail.journal_detail_id'=> $journaldetail])
                ->limit($limit)
                ->offset($pages)
                ->all();

       $journalList1 =  \backend\models\Journal::find()
                
                ->joinWith([  
                    'journalDetail',
                ])
                ->where(['journal_status' => 1])
                ->andWhere(['journal_detail.journal_detail_id'=> $journaldetail])
                ->all();
        
        $active[0] = $journalCategoryId->journal_category_id;
        // print_r("JournalList1: "+count($journalList1));
        // die();
        return $this->render('index', array("journalCategory" => $journalCategoryList, "journalList" => $journalList, "active" => $active, "journalList1"=>$journalList1, "limit"=>$limit, "categoryName"=>$categoryName));
        
    }
    
}
