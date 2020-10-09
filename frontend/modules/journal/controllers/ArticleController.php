<?php

namespace app\modules\journal\controllers;

use frontend\core\controller\FrontendController;

class ArticleController extends FrontendController {
    
    public function actionSubmit() 
    {
        if($_POST){
            
            $submit = new \backend\models\JournalSubmission();
            $submit->journal_submission_category = $_POST['submission_journal_category'];
            $submit->journal_submission_email = $_POST['submission_email'];
            $submit->journal_submission_name = $_POST['submission_name'];
            $submit->journal_submission_phone = $_POST['submission_phone'];
            $submit->journal_submission_material = $_POST['submission_material'];
            
            try {
                $submit->save();
            } catch (\yii\base\Exception $ex) {
                return $this->render("submit-success", array("message" => "Journal Submission Failed"));
            }
            
            return $this->render("submit-success", array("message" => "Thank you your Journal Submission has been successfully received"));

        } else {
            return $this->render("submit");
        }
    }
    
}
