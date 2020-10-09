<?php

namespace common\components;

use Yii;
use yii\base\Component;

class PHPWord_Helper extends Component {
    
	public static function saveSticker($type, $orderId, $data){
		switch ($type){
            
            case "Word":
                
                require_once 'PHPWord.php';
                
                include 'PHPWord/Writer/Word2007.php';

                // New Word Document
                $PHPWord = new \PHPWord();

                // New portrait section
                $section = $PHPWord->createSection();

                $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'size'=>10, 'name' => 'Futura lt light'));
                $PHPWord->addParagraphStyle('pStyle', array('align'=>'center'));
                
                $tableStyle = array('align' => 'center');
                
                $PHPWord->addTableStyle('myTableStyle', $tableStyle);
                $table = $section->addTable('myTableStyle');
                $table->addRow(30);
                $table->addCell(2200);
                $table->addCell(2500)->addText('', 'rStyle', 'pStyle');           
                $table->addCell(2400)->addText('', 'rStyle', 'pStyle');
                
                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(2500)->addText($data['customerName'], 'rStyle', 'pStyle');           
                $table->addCell(2400)->addText($data['phoneNumber'], 'rStyle', 'pStyle');

                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(1500)->addText('', 'rStyle', 'pStyle');          
                $table->addCell(1500)->addText('', 'rStyle', 'pStyle');

                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(1500)->addText(
                    $data['customerAddressFl'] . ' ' . $data['customerAddress'] . ', ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode'], 
                    'rStyle', 
                    array('align' => 'left'
                ));
                
             
                $cell = $table->addCell(1500);
				
				if($data['shipmentPackage'] == 'YES'){
					$cell->addText('ONS', 'rStyle', 'pStyle');
				} else {
					$cell->addText($data['shipmentPackage'], 'rStyle', 'pStyle');
				}
                $cell->addText('', 'rStyle', 'pStyle');
                $cell->addText('HUSNUL', 'rStyle', 'pStyle');
                $cell->addText('0813 6800 1010', 'rStyle', 'pStyle');
                
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('DIAN', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('0813 6800 1010', 'rStyle', 'pStyle');
//                $section->addText($data['customerName'], 'rStyle', 'pStyle');
                
                header('Content-Type: application/vnd.ms-word');
                
                // At least write the document to webspace:
                $objWriter = \PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
                
				$savePath = \Yii::getAlias("@backend" . '/web/dist/delivery_slip/' . $orderId);
				
				$orderDeliverySlip = new \backend\models\OrderDeliverySlip();
				$orderDeliverySlip->customer_id = $data['customerId'];
				$orderDeliverySlip->orders_id = $data['orderId'];
				$orderDeliverySlip->shipping_cost_amount = $data['shipmentCost'];
				$orderDeliverySlip->user_sender_id = '13';
				$orderDeliverySlip->partial = 0;
				$orderDeliverySlip->date_add = date("Y-m-d H:i:s");
				$orderDeliverySlip->date_upd = date("Y-m-d H:i:s");
				$orderDeliverySlip->save();
				
				$orderDetailModel = \backend\models\OrderDetail::findAll(["orders_id" => $data['orderId']]);
				
				if(count($orderDetailModel) > 0){
					foreach($orderDetailModel as $row){
						$orderDeliverySlipDetail = new \backend\models\OrderDeliverySlipDetail();
						$orderDeliverySlipDetail->order_delivery_slip_id = $orderDeliverySlip->order_delivery_slip_id;
						$orderDeliverySlipDetail->order_detail_id = $row->order_detail_id;
						$orderDeliverySlipDetail->product_quantity = $row->product_quantity;
						$orderDeliverySlipDetail->save();
					}
				}
				
				if(!file_exists($savePath)){
					mkdir($savePath);
				}
				
				$objWriter->save($savePath . '/' . 'sticker '.$orderId." ".$data['customerName'].'.docx');
				
                break;
        }
	}
	
    public static function generateSticker($type, $orderId, $data){
        switch ($type){
            
            case "Word":
                
                require_once 'PHPWord.php';
                
                include 'PHPWord/Writer/Word2007.php';

                // New Word Document
                $PHPWord = new \PHPWord();

                // New portrait section
                // $section = $PHPWord->createSection();
                $section = $PHPWord->createSection(array("marginTop" => "0.7cm"));

                $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'size'=>10, 'name' => 'Futura lt light'));
                $PHPWord->addParagraphStyle('pStyle', array('align'=>'center'));
                
                $tableStyle = array('align' => 'center');
                
                $PHPWord->addTableStyle('myTableStyle', $tableStyle);
                $table = $section->addTable('myTableStyle');
                $table->addRow(30);
                $table->addCell(2200);
                $table->addCell(2500)->addText('', 'rStyle', 'pStyle');           
                $table->addCell(2400)->addText('', 'rStyle', 'pStyle');
                
                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(2500)->addText($data['customerName'], 'rStyle', 'pStyle');           
                $table->addCell(2400)->addText($data['phoneNumber'], 'rStyle', 'pStyle');

                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(1500)->addText('', 'rStyle', 'pStyle');          
                $table->addCell(1500)->addText('', 'rStyle', 'pStyle');

                $table->addRow(50);
                $table->addCell(2200);
                $table->addCell(1500)->addText(
                    $data['customerAddressFl'] . ' ' . $data['customerAddress'] . ', ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode'], 
                    'rStyle', 
                    array('align' => 'left'
                ));
                
             
                $cell = $table->addCell(1500);
				
				if($data['shipmentPackage'] == 'YES'){
					$cell->addText('ONS', 'rStyle', 'pStyle');
				} else {
					$cell->addText($data['shipmentPackage'], 'rStyle', 'pStyle');
				}
                $cell->addText('', 'rStyle', 'pStyle');
                $cell->addText('HUSNUL', 'rStyle', 'pStyle');
                $cell->addText('0813 6800 1010', 'rStyle', 'pStyle');
                
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('DIAN', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('0813 6800 1010', 'rStyle', 'pStyle');
//                $section->addText($data['customerName'], 'rStyle', 'pStyle');
                
                $filename = "sticker ".$orderId." ".$data['customerName'].".docx";

                header('Content-Type: application/vnd.ms-word');
                header('Content-Disposition: attachment;filename="sticker '.$orderId." ".$data['customerName'].'.docx"');
                // header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0
                
                // At least write the document to webspace:
                $objWriter = \PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
                $objWriter->save('php://output');
                // $objWriter->save($filename);
                exit();
                
                break;
        }
    }

    public static function generateStickerNew($type, $orderId, $data){
        switch ($type){
            
            case "Word":
                
                require_once 'PHPWord.php';
                
                include 'PHPWord/Writer/Word2007.php';

                // New Word Document
                $PHPWord = new \PHPWord();

                // New portrait section
                // $section = $PHPWord->createSection();
                // $section = $PHPWord->createSection(array("marginTop" => "0.7cm"));
                // $section = $PHPWord->createSection(array("marginTop" => "0.7cm", "pageSizeH" => "20500"));
                // $section = $PHPWord->createSection(array("marginTop" => "0.7cm", "pageSizeW" => "5669.291338583", "pageSizeH" => "5952.755905512"));
                $section = $PHPWord->createSection(array("marginTop" => "1.2cm", "marginLeft" => "0cm", "marginRight" => "0cm", "pageSizeW" => "5669.291338583", "pageSizeH" => "5952.755905512"));

                // $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'size'=>10, 'name' => 'Futura lt light'));
                $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'size'=>8, 'name' => 'Futura lt light'));
                $PHPWord->addParagraphStyle('pStyle', array('align'=>'left'));
                
                $tableStyle = array('align' => 'left'); 
                
                $PHPWord->addTableStyle('myTableStyle', $tableStyle);
                $table = $section->addTable('myTableStyle');
                // $table->addRow(30);
                // $table->addCell(1500);
                // $table->addCell(4500)->addText('', 'rStyle', 'pStyle');           
                // $table->addCell(2500)->addText('', 'rStyle', 'pStyle');
                
                $table->addRow(900);
                $table->addCell(600);
                $table->addCell(3900)->addText($data['customerName'], 'rStyle', 'pStyle');
				$table->addCell(200);
                $table->addCell(3000)->addText($data['phoneNumber'], 'rStyle', 'pStyle');

                $table->addRow(900);
                $table->addCell(600);
                $table->addCell(3900)->addText(
                    $data['customerAddressFl'] . ' ' . $data['customerAddress'] . ', ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode'], 
                    'rStyle', 
                    array('align' => 'left'
                ));
				$table->addCell(200);
                
             
                $cell = $table->addCell(3000);
				
				if($data['shipmentPackage'] == 'YES'){
					$cell->addText('ONS', 'rStyle', 'pStyle');
				} else {
					$cell->addText($data['shipmentPackage'], 'rStyle', 'pStyle');
				}
                $cell->addText('', 'rStyle', 'pStyle');
                $cell->addText('HUSNUL', 'rStyle', 'pStyle');
                $cell->addText('0813 6800 1010', 'rStyle', 'pStyle');
                
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('DIAN', 'rStyle', 'pStyle');
                // $table->addRow(50);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');
                // $table->addCell(550);
                // $table->addCell(1500)->addText('0813 6800 1010', 'rStyle', 'pStyle');
//                $section->addText($data['customerName'], 'rStyle', 'pStyle');
                
                $filename = "sticker ".$orderId." ".$data['customerName'].".docx";

                header('Content-Type: application/vnd.ms-word');
                header('Content-Disposition: attachment;filename="sticker '.$orderId." ".$data['customerName'].'.docx"');
                // header('Content-Disposition: attachment;filename="'.$filename.'"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0
                
                // At least write the document to webspace:
                $objWriter = \PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
                $objWriter->save('php://output');
                // $objWriter->save($filename);
                exit();
                
                break;
        }
    }
    
    public static function generateWarrantysticker($type,$name,$address,$telp,$id){
        switch ($type){
            
            case "Word":

            $model = \backend\models\Stores::find()->where(['store_id'=>$id])->one();    
                require_once 'PHPWord.php';
                
                include 'PHPWord/Writer/Word2007.php';

                // New Word Document
                $PHPWord = new \PHPWord();

                // New portrait section
                $section = $PHPWord->createSection();
                $PHPWord->addFontStyle('spacemargin', array('bold'=>true, 'size'=>5, 'name' => 'Futura lt light'));

                $section->addTextBreak(1, 'spacemargin');
                
                $PHPWord->addFontStyle('rStyle', array('bold'=>true, 'size'=>10, 'name' => 'Futura lt light'));
                $PHPWord->addParagraphStyle('pStyle', array('align'=>'center'));
                
                $tableStyle = array('align' => 'center');

                
                $PHPWord->addTableStyle('myTableStyle', $tableStyle);
                $table = $section->addTable('myTableStyle');

                // $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center');
                // $cellRowContinue = array('vMerge' => 'continue');

                $table->addRow(50);
                $table->addCell(2000)->addText('Detail Pengirim', 'rStyle');
               
                $table->addRow();
                $table->addCell(2000)->addText('Nama', 'rStyle');
                $table->addCell(200)->addText(':', 'rStyle');           
                $table->addCell(5000)->addText($name, 'rStyle');

                $table->addRow(50);
                $table->addCell(2000)->addText('Alamat', 'rStyle'); 
                $table->addCell(200)->addText(':', 'rStyle');          
                $table->addCell(5000)->addText($address, 'rStyle');

                $table->addRow(50);
                $table->addCell(2000)->addText('Telp', 'rStyle'); 
                $table->addCell(200)->addText(':', 'rStyle');          
                $table->addCell(5000)->addText($telp, 'rStyle');


             
                $table->addRow(1000);
                $table->addCell(2000)->addText('', 'rStyle');
                $table->addCell(200)->addText('', 'rStyle');
                $table->addCell(5000)->addText('', 'rStyle');

                $table->addRow(50);
                $table->addCell(2000)->addText('Detail Penerima', 'rStyle');

                $table->addRow();
                $table->addCell(2000)->addText('Nama', 'rStyle');
                $table->addCell(200)->addText(':', 'rStyle');           
                $table->addCell(5000)->addText($model->store_name, 'rStyle');

                $table->addRow(50);
                $table->addCell(2000)->addText('Alamat', 'rStyle'); 
                $table->addCell(200)->addText(':', 'rStyle');          
                $table->addCell(5000)->addText(strip_tags($model->store_address), 'rStyle');

                $table->addRow(50);
                $table->addCell(2000)->addText('Telp', 'rStyle'); 
                $table->addCell(200)->addText(':', 'rStyle');          
                $table->addCell(5000)->addText($model->store_contact_number, 'rStyle');

                // $table->addRow(50);
                // $table->addCell(2200);
                // $table->addCell(1500)->addText(
                //     $data['customerAddress'] . ', ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode'], 
                //     'rStyle', 
                //     array('align' => 'left'
                // ));
                
             
                // $cell = $table->addCell(1500);
                // $cell->addText($data['shipmentPackage'], 'rStyle', 'pStyle');
                // $cell->addText('', 'rStyle', 'pStyle');
                // $cell->addText('DIAN', 'rStyle', 'pStyle');
                // $cell->addText('0813 6800 1010', 'rStyle', 'pStyle');
//////
                // $table->addRow(10);
                // $table->addCell(1750);
                // $table->addCell(null);
                // $table->addCell(1500)->addText('', 'rStyle', 'pStyle');

                // $table->addRow(50);
                // $table->addCell(1750);
                // $table->addCell(null);      
                // $table->addCell(1500)->addText('DIAN', 'rStyle', 'pStyle');

                // $table->addRow(50);
                // $table->addCell(1750);
                // $table->addCell(null,$cellRowContinue);      
                // $table->addCell(1500)->addText('0813 6800 1010', 'rStyle', 'pStyle');
//                $section->addText($data['customerName'], 'rStyle', 'pStyle');
                
                header('Content-Type: application/vnd.ms-word');
                header('Content-Disposition: attachment;filename="sticker '." ".$name.'.docx"');
                header('Cache-Control: max-age=0');
                
                // At least write the document to webspace:
                $objWriter = \PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
                $objWriter->save('php://output');
                exit();

              break;

                case "Pdf":

                $model = \backend\models\Stores::find()->where(['store_id'=>$id])->one();    
                $model->store_address = strip_tags($model->store_address);
                require_once 'tcpdf_include.php';
                include 'tcpdf.php';
                $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('The Watch Co.');
                $pdf->SetTitle('Warranty Sticker');
                $pdf->SetSubject('Warranty Sticker The Watch Co.');
                $pdf->SetKeywords('Warranty, PDF, Sticker, The Watch Co.');
                
                // set default header data
                // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 009', PDF_HEADER_STRING);
                
                // set header and footer fonts
                // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                
                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                
                // set margins
                $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(0);
                $pdf->SetFooterMargin(0);
                
                // set auto page breaks
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                
                // set image scale factor
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                
                // set some language-dependent strings (optional)
                if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
                    require_once(dirname(__FILE__).'/lang/eng.php');
                    $pdf->setLanguageArray($l);
                }
                
                // -------------------------------------------------------------------
                
                // add a page
                $pdf->AddPage();
                
                // // set JPEG quality
                // $pdf->setJPEGQuality(75);
                
                // // Image method signature:
                // // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
                
                // // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                
                // // Example of Image from data stream ('PHP rules')
                // $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
                
                // // The '@' character is used to indicate that follows an image data stream and not an image file name
                // $pdf->Image('@'.$imgdata);
                
                // // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                
                // // Image example with resizing
                // $pdf->Image('https://thewatch.co/img/promo/weeksale/weeksale-detail-maret.jpg', 15, 140, 75, 113, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
                $style3 = array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '5,12', 'color' => array(0, 0, 0));




$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
    h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;
        text-decoration: underline;
    }
    p.first {
        color: #003300;
        font-family: helvetica;
        font-size: 12pt;
    }
    p.first span {
        color: #006600;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
    p#second > span {
        background-color: #FFFFAA;
    }
    table.first {
     
        font-family: helvetica;
        font-size: 8pt;
    }
    td {
      font-size: 7pt;
    }
    td.second {
        border: 2px dashed green;
    }
    div.test {
     
    
        font-family: helvetica;
        font-size: 10pt;
 
        border-width: 2px 2px 2px 2px;

        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
</style>

<div style="">
    <table class="first" cellpadding="4" cellspacing="0" style="width:100%;border:solid 1px #000;border-radius:5pt;">
        <tr style="background-color:#000;">
            <td width="15"></td>
            <td width="420" colspan="4" align="left"><img src="https://thewatch.co/img/logos/logo-putih-04.png" border="0" style="width:150px;" /></td>
            <td width="20" align="left"><img src="https://thewatch.co/img/warranty/icons/setting-white.png" border="0" style="" /></td>
            <td width="15"></td>
       </tr>
       
       <tr style="line-height:10px;">
        <td width="15"></td>
        <td width="20" align="left"></td>
        <td width="65" align="left"></td>
        <td width="20" align="left"></td>
        <td width="335" align="left"></td>
       </tr>
       
        <tr>
            <td width="470" colspan="5" align="center" style="font-size:12px;">Warranty Package</td>
       </tr>
       
       <tr style="line-height:10px;">
        <td width="15" align="left"></td>
        <td width="100" colspan="4">TUJUAN</td>
       </tr>
       
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/warranty/icons/store.png" border="0" style="" /></td>
        <td width="390" align="left" colspan="3"><strong>$model->store_name</strong></td>
       </tr>
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/warranty/icons/location.png" border="0" style="" /></td>
        <td width="390" align="left" colspan="3">$model->store_address</td>
       </tr>
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/warranty/icons/customer_service.png" border="0" style="" /></td>
        <td width="390" align="left" colspan="3">$model->store_contact_number</td>
       </tr>
       <tr style="line-height:10px;">
        <td width="15" align="left"></td>
        <td width="100" colspan="4"></td>
       </tr>
       
       
       <tr style="">
        <td width="15" align="left"></td>
        <td width="100" colspan="4">DARI</td>
       </tr>
       
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/icons/account-mobile.png" border="0" style="" /></td>
            <td width="70" align="left">NAMA</td>
        <td width="15" align="left">:</td>
        <td width="340" align="left">$name</td>
       </tr>
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/warranty/icons/location.png" border="0" style="" /></td>
        <td width="70" align="left">ALAMAT</td>
        <td width="15" align="left">:</td>
        <td width="340" align="left">$address</td>
       </tr>
       <tr>
        <td width="15"></td>
        <td width="17" align="left"><img src="https://thewatch.co/img/icons/telephone.png" border="0" style="" /></td>
        <td width="70" align="left">NO. TELEPON</td>
        <td width="15" align="left">:</td>
        <td width="340" align="left">$telp</td>
       </tr>
  
       <tr>
        <td width="15"></td>
        <td width="305" align="center" colspan="3"></td>
        <td width="140" align="center">
             Nama pengirim & Tanda tangan
        <br>
        <br>
        <br>
        <br>
        <div style="border-bottom: solid 1px #000;"></div>
        </td>
       </tr>
       
    </table>
 </div>   
      
     
EOF;

                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->Image('https://thewatch.co/img/icons/scissors.png', 24, 24, 2, 2, '', '', 'T', true, 300, '', false, false, 1, false, false, false);
                $pdf->Image('https://thewatch.co/img/icons/scissors.png', 130, 122, 2, 2, '', '', 'T', true, 300, '', false, false, 1, false, false, false);
                $pdf->Rect(15, 25, 137, 98, 'D', array('all' => $style3));
                
                //Close and output PDF document
                
                // attach an external file
                                $pdf->Annotation(85, 27, 5, 5, 'text file', array('Subtype'=>'FileAttachment', 'Name' => 'PushPin', 'FS' => 'data/utf8test.txt'));
                
                $pdf->Output('warranty_sticker.pdf', 'D');
              exit();

              break;
            }
    }
}