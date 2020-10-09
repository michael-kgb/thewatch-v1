<?php
namespace console\controllers;
use yii\console\Controller;

/**
 * Site controller
 */
class ScheduleController extends Controller
{
    public function actionMake(){
		$rootyii = realpath(dirname(__FILE__).'/../../');
		
		$filename = date('H:i:s'). '.txt';
		$folder = $rootyii . '/cronjob/' . $filename;
		$f = fopen($folder, 'w');
		$fw = fwrite($f, 'now : ' . $filename);
		fclose($f);
	}
}
