<?php

namespace app\modules\journal\controllers;

use frontend\core\controller\FrontendController;

class AuthorController extends FrontendController {
    
     public function actionIndex() 
    {
        	$journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
            $author = \backend\models\JournalAuthor::find()->where(["journal_author_status" =>1 ])->all();
            $active = [];
            $active[0] = 'contributors';
            return $this->render("index", array("journalCategory" => $journalCategory, "authors" => $author, "active"=> $active));
       
    }
    
    public function actionDetail($username) 
    {   
        $journalCategory = \backend\models\JournalCategory::findAll(["journal_category_status" => '1']);
        $active = [];
        $active[0] = 'contributors';
        if(isset($username)){
            $author = \backend\models\JournalAuthor::findOne(['link_rewrite' => $username]);
            $author_exc = \backend\models\JournalAuthor::find()->where(['<>','link_rewrite', $username])->all();
            $related = \backend\models\Journal::find()->with([
                    "journalAuthor",
                    "journalCategory",
                    "journalDetail",
                    "journalImage",
                    "journalRelated"
                ])->limit(4)->where(["journal_author_id" => $author->journal_author_id])->andWhere(["journal_status" => 1])->orderBy('journal_id DESC')->all();
            

            // $journalList = \backend\models\Journal::find()
                
                
            //     ->limit($limit)
            //     ->offset($pages)
            //     ->all();
                // echo $author->journal_author_id;die();
            return $this->render("detail", array("author_exc" => $author_exc, "journalCategory" => $journalCategory,"author" => $author, "related" => $related, "active"=> $active));
        }
    }
    
}
