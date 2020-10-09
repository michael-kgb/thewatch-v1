<?php

namespace common\components;

use Yii;
use yii\base\Component;

class PHPExcel_Helper extends Component {
    
	public static function generateExportService($type, $from, $to, $data){
		 
		switch ($type){
            
            case "Excel":
			
				require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Warranty Service TheWatchCo")
                    ->setSubject("Excel Warranty Service TheWatchCo")
                    ->setDescription("Excel Warranty Service TheWatchCo")
                    ->setKeywords("Excel Warranty Service TheWatchCo")
                    ->setCategory("Warranty Service");
					
				$objPHPExcel->getActiveSheet()
					->setCellValue('A1', 'Service Number')
					->setCellValue('B1', 'Customer Name')
					->setCellValue('C1', 'Phone Number')
					->setCellValue('D1', 'Product Name')
					->setCellValue('E1', 'Brand Name')
					->setCellValue('F1', 'Service Fee')
					->setCellValue('G1', 'Status')
					->setCellValue('H1', 'Claim Service Date');
				
				$i = 2;
				if(count($data) > 0){
					foreach($data as $row){
						
						$objPHPExcel->getActiveSheet()
                            ->setCellValue('A'.$i, $row->service_code)
							->setCellValue('B'.$i, $row->orders->customer->firstname . ' ' . $row->orders->customer->lastname)
							->setCellValue('C'.$i, $row->orders->customer->phone_number)
							->setCellValue('D'.$i, $row->serviceDetail->orderDetailWarranty->orderDetail->product_name)
							->setCellValue('E'.$i, $row->serviceDetail->orderDetailWarranty->orderDetail->product->brands->brand_name)
							->setCellValue('F'.$i, $row->service_fee)
							->setCellValue('G'.$i, $row->serviceHistory->serviceStateLang->text)
							->setCellValue('H'.$i, $row->service_date_add);
						$i++;
					}
				}	
				
				// Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="service_claim_'.$from.'_'.$to.'.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
			break;
			
		}
	}
	
	public static function saveInvoice($type, $orderId, $data){
		switch ($type){
            
            case "Excel":
            
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Customer Orders TheWatchCo")
                    ->setSubject("Excel Customer Orders TheWatchCo")
                    ->setDescription("Excel Customer Orders TheWatchCo")
                    ->setKeywords("Excel Customer Orders TheWatchCo")
                    ->setCategory("Customer Orders");
                
                $styleArray1 = array(
                    'font'  => array(
                        'size'  => 8,
                        'name'  => 'Nexa Bold'
                    )
                );
                
                $styleArray2 = array(
                    'font'  => array(
                        'size'  => 8,
                        'name'  => 'Nexa Light'
                    )
                );
                
                $unique_code = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->unique_code;
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.71);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(3.5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.88);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                
                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A8:B8')
                        ->mergeCells('A10:B10');
                
                $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('A10:A20')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D8')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('D9:D12')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D15:D25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('E15:E25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('F15:F25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('G15:G25')->applyFromArray($styleArray2);
                
                $objPHPExcel->getActiveSheet()->getStyle('A21:A23')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('E14:G14')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D8:G8')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('A20:B20')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                
                
                if($unique_code == 0){
                    $objPHPExcel->getActiveSheet()
                        ->mergeCells('E38:G40');

                    $objPHPExcel->getActiveSheet()->getStyle('G33:G35')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('E37:E38')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('D33:D46')->applyFromArray($styleArray2);

                    $objPHPExcel->getActiveSheet()->getStyle('D35:G35')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D35:G35')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D45:G45')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E34')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('G33:G35')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E38')
                    ->getAlignment()
                    ->setWrapText(true); 

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E38')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

                }else{

                    $objPHPExcel->getActiveSheet()
                        ->mergeCells('E39:G41');

                    $objPHPExcel->getActiveSheet()->getStyle('G33:G36')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('E37:E39')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('D33:D46')->applyFromArray($styleArray2);

                    $objPHPExcel->getActiveSheet()->getStyle('D36:G36')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D36:G36')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D46:G46')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E35')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('G33:G36')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E39')
                    ->getAlignment()
                    ->setWrapText(true); 

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E39')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

                }
                
                
                
                $objPHPExcel->getActiveSheet()
                    ->getStyle('F15:F25')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                $objPHPExcel->getActiveSheet()
                    ->getStyle('G15:G25')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('F15:F25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('G15:G25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('D15:D25')
                    ->getAlignment()
                    ->setWrapText(true);
                
                $objPHPExcel->getActiveSheet()
                    ->getCell('A8')->setValue('T H E  W A T C H  C O .');
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo TWC');
                $objDrawing->setPath('./img/logo_twc_new.png');
                $objDrawing->setHeight(125);
                $objDrawing->setOffsetX(20);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo Twitter');
                $objDrawing->setDescription('Logo Twitter');
                $objDrawing->setPath('./img/twitter_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A21');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo FB');
                $objDrawing->setDescription('Logo FB');
                $objDrawing->setPath('./img/fb_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A22');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo Instagram');
                $objDrawing->setDescription('Logo Instagram');
                $objDrawing->setPath('./img/insta_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A23');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A10', 'cs@thewatch.co')
                    ->setCellValue('A11', '0813 6800 1010')
                    ->setCellValue('A12', '9AM - 5PM (+7GMT)')
                    ->setCellValue('A15', 'aftersales@thewatch.co')
                    ->setCellValue('A16', '0813 6800 1010')
                    ->setCellValue('A17', '9AM - 5PM (+7GMT)')
                    ->setCellValue('A20', 'www.thewatch.co');
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('D8', 'No. ' . $orderId) // no order
                    //->setCellValue('D9', 'Date. ' . date_format(date_create(\backend\models\Orders::findOne(['orders_id' => $data['orderId']])->date_add), 'j F Y g:i A')) // date order
                    ->setCellValue('D9', 'Date. ' . date_format(date_create(), 'j F Y g:i A')) // print date
                    ->setCellValue('D10', 'Hello, ' . $data['customerName']) // customer name
                    ->setCellValue('D12', 'You have acquired good(s) from The Watch Co. Webstore.');
                
                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $data['orderId']])->all();
                
                $totalProductPrice = 0;
                $i = 15;
                $productDiscountAmount = 0;
				$totalProduct = 0;
                $now = date("Y-m-d H:i:s");
                
                // list product orders
                if(count($orderdetail) > 0){
                    foreach ($orderdetail as $detail){
                        
                        $productattribute = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $detail->product_attribute_id])->one();
                        if (!empty($productattribute)) {
							$attribute = $productattribute->attributes->name;
							$value = $productattribute->attributeValue->value;
                            $attribute2 = $productattribute->attributes2->name;
                            $value2 = $productattribute->attributeValue2->value;
						} else {
							$attribute = '';
							$value = '';
                            $attribute2 = '';
                            $value2 = '';
						}
                        
                        $objPHPExcel->getActiveSheet()
                            ->setCellValue('D'.$i, $detail->product_name . ' ' . $value.' ' . $value2) 
                            ->setCellValue('E'.$i, $detail->product_quantity) 
                            ->setCellValue('F'.$i, "IDR " . number_format($detail->product_price, 0, '', ','))
                            ->setCellValue('G'.$i, "IDR " . number_format($detail->product_price * $detail->product_quantity, 0, '', ','));
                        
                        $totalProductPrice += ($detail->product_price * $detail->product_quantity);
						$totalProduct += $detail->product_quantity;
                        $i++;
                        
                        if($detail->reduction_percent != 0){
                            
                            // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                                $productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
                            //}
                                
                        }
                        
                        if($detail->reduction_amount != 0){
                            
                            // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                                $productDiscountAmount += $detail->reduction_amount;
                            //}
                            
                        }
						
						if($detail->reduction_percent_extra != 0){
					
							if($detail->reduction_percent != 0){    
								$discountAmount = ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 		
							}
									
							if($detail->reduction_amount != 0){
								$discountAmount = $detail->reduction_amount;
							}
							
							$afterDiscountAmount = $detail->product_price - $discountAmount;
							$productDiscountAmount += (($detail->reduction_percent_extra / 100) * $afterDiscountAmount);
						}
                    }
                }
                // echo $detail->reduction_percent;die();
                $voucherDiscount = 0;
                $orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $data['orderId']]);
                
                // discount voucher code
                if($orderCartRule != NULL){
                    $voucherDiscount = $orderCartRule->value;
                }
                
                $totalDiscount = $voucherDiscount + $productDiscountAmount;
                
                if($unique_code == 0){

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('D33', 'Discount')
                    ->setCellValue('D34', 'Shipping + Insurance')
                    ->setCellValue('D35', 'T O T A L')
                    ->setCellValue('D37', 'Shipping Information')
                    ->setCellValue('D41', 'Phone Number')
                    ->setCellValueExplicit('E41', $data['phoneNumber'], \PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('D43', 'Notes')
                    ->setCellValue('D45', 'Good(s) purchased cannot be exchanged, refunded, or returned.');
					
					$totalShipping = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping;
					$totalShippingInsurance = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping_insurance;
					$grandTotal = $totalProductPrice - $totalDiscount + $totalShipping + $unique_code;
					$grandTotal += $totalShippingInsurance;

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('G33', "IDR " . number_format($totalDiscount,  0, '', ',')) // discount
                    ->setCellValue('E34', substr($data['shipmentPackage'], 0, 3))
                    ->setCellValue('G34', "IDR " . number_format($totalShipping + $totalShippingInsurance, 0, '', ',')) // shipping
                    ->setCellValue('G35', "IDR " . number_format($grandTotal,  0, '', ',')) // grand total
                    ->setCellValue('E37', $data['customerName']) // customer name
                    ->setCellValue('E38', $data['customerAddressFl'] . ' ' . $data['customerAddress'] . ' ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode']); // customer address

           
                }else{

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('D33', 'Discount')
                    ->setCellValue('D34', 'Unique Code')
                    ->setCellValue('D35', 'Shipping + Insurance')
                    ->setCellValue('D36', 'T O T A L')
                    ->setCellValue('D38', 'Shipping Information')
                    ->setCellValue('D42', 'Phone Number')
                    ->setCellValueExplicit('E42', $data['phoneNumber'], \PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('D44', 'Notes')
                    ->setCellValue('D46', 'Good(s) purchased cannot be exchanged, refunded, or returned.');
					
					$totalShipping = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping;
					$totalShippingInsurance = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping_insurance;
					$grandTotal = $totalProductPrice - $totalDiscount + $totalShipping + $unique_code;
					$grandTotal += $totalShippingInsurance;

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('G33', "IDR " . number_format($totalDiscount,  0, '', ',')) // discount
                    ->setCellValue('G34', $unique_code)
                    ->setCellValue('E35', substr($data['shipmentPackage'], 0, 3))
                    ->setCellValue('G35', "IDR " . number_format($totalShipping + $totalShippingInsurance, 0, '', ',')) // shipping
                    ->setCellValue('G36', "IDR " . number_format($grandTotal,  0, '', ',')) // grand total
                    ->setCellValue('E38', $data['customerName']) // customer name
                    ->setCellValue('E39', $data['customerAddress'] . ' ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode']); // customer address
                }
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('D14', 'D E S C R I P T I O N')
                    ->setCellValue('E14', 'Q T Y')
                    ->setCellValue('F14', 'U N I T  P R I C E')
                    ->setCellValue('G14', 'S U B T O T A L');
                
              
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A21', '            T H E W A T C H C O _ I D')
                    ->setCellValue('A22', '            T H E W A T C H C O')
                    ->setCellValue('A23', '            T H E W A T C H C O');
                
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				
				// Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
				
				$savePath = \Yii::getAlias("@backend" . '/web/dist/invoice/' . $orderId);
				
				$orderInvoice = new \backend\models\OrderInvoice();
				$orderInvoice->orders_id = $data['orderId'];
				$orderInvoice->reference = $orderId;
				$orderInvoice->total_products = $totalProduct;
				$orderInvoice->note = '';
				$orderInvoice->date_add = date("Y-m-d H:i:s");
				$orderInvoice->save();
				
				if(!file_exists($savePath)){
					mkdir($savePath);
				}
				
                $objWriter->save($savePath . '/' . 'invoice '.$orderId.' '.$data['customerName'].'.xls');
                
                break;
            
        }
	}
	
    public static function generateInvoice($type, $orderId, $data){
        
        switch ($type){
            
            case "Excel":
            
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Customer Orders TheWatchCo")
                    ->setSubject("Excel Customer Orders TheWatchCo")
                    ->setDescription("Excel Customer Orders TheWatchCo")
                    ->setKeywords("Excel Customer Orders TheWatchCo")
                    ->setCategory("Customer Orders");
                
                $styleArray1 = array(
                    'font'  => array(
                        'size'  => 8,
                        'name'  => 'Nexa Bold'
                    )
                );
                
                $styleArray2 = array(
                    'font'  => array(
                        'size'  => 8,
                        'name'  => 'Nexa Light'
                    )
                );
                
                $unique_code = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->unique_code;
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.71);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(3.5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.88);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                
                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A8:B8')
                        ->mergeCells('A10:B10');
                
                $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('A10:A20')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('D8')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D8')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('D9:D12')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->applyFromArray($styleArray1);
                $objPHPExcel->getActiveSheet()->getStyle('D15:D25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('E15:E25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('F15:F25')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('G15:G25')->applyFromArray($styleArray2);
                
                $objPHPExcel->getActiveSheet()->getStyle('A21:A23')->applyFromArray($styleArray2);
                $objPHPExcel->getActiveSheet()->getStyle('E14:G14')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objPHPExcel->getActiveSheet()->getStyle('A8:B8')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D8:G8')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('D14:G14')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objPHPExcel->getActiveSheet()->getStyle('A20:B20')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                
                
                if($unique_code == 0){
                    $objPHPExcel->getActiveSheet()
                        ->mergeCells('E38:G40');

                    $objPHPExcel->getActiveSheet()->getStyle('G33:G35')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('E37:E38')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('D33:D46')->applyFromArray($styleArray2);

                    $objPHPExcel->getActiveSheet()->getStyle('D35:G35')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D35:G35')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D45:G45')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E34')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('G33:G35')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E38')
                    ->getAlignment()
                    ->setWrapText(true); 

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E38')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

                }else{

                    $objPHPExcel->getActiveSheet()
                        ->mergeCells('E39:G41');

                    $objPHPExcel->getActiveSheet()->getStyle('G33:G36')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('E37:E39')->applyFromArray($styleArray2);
                    $objPHPExcel->getActiveSheet()->getStyle('D33:D46')->applyFromArray($styleArray2);

                    $objPHPExcel->getActiveSheet()->getStyle('D36:G36')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D36:G36')->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                    $objPHPExcel->getActiveSheet()->getStyle('D46:G46')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E35')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('G33:G36')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E39')
                    ->getAlignment()
                    ->setWrapText(true); 

                    $objPHPExcel->getActiveSheet()
                    ->getStyle('E39')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

                }
                
                
                
                $objPHPExcel->getActiveSheet()
                    ->getStyle('F15:F25')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                $objPHPExcel->getActiveSheet()
                    ->getStyle('G15:G25')
                    ->getAlignment()
                    ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('E15:E25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('F15:F25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('G15:G25')
                    ->getAlignment()
                    ->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
                
                
                    
                $objPHPExcel->getActiveSheet()
                    ->getStyle('D15:D25')
                    ->getAlignment()
                    ->setWrapText(true);
                
                $objPHPExcel->getActiveSheet()
                    ->getCell('A8')->setValue('T H E  W A T C H  C O .');
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo TWC');
                $objDrawing->setPath('./img/logo_twc_new.png');
                $objDrawing->setHeight(125);
                $objDrawing->setOffsetX(20);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A1');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo Twitter');
                $objDrawing->setDescription('Logo Twitter');
                $objDrawing->setPath('./img/twitter_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A21');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo FB');
                $objDrawing->setDescription('Logo FB');
                $objDrawing->setPath('./img/fb_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A22');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objDrawing = new \PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo Instagram');
                $objDrawing->setDescription('Logo Instagram');
                $objDrawing->setPath('./img/insta_inv.png');
                $objDrawing->setHeight(15);
                $objDrawing->setOffsetX(10);
                $objDrawing->setOffsetY(5);
                
                $objDrawing->setCoordinates('A23');
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A10', 'cs@thewatch.co')
                    ->setCellValue('A11', '0813 6800 1010')
                    ->setCellValue('A12', '9AM - 5PM (+7GMT)')
                    ->setCellValue('A15', 'aftersales@thewatch.co')
                    ->setCellValue('A16', '0813 6800 1010')
                    ->setCellValue('A17', '9AM - 5PM (+7GMT)')
                    ->setCellValue('A20', 'www.thewatch.co');
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('D8', 'No. ' . $orderId) // no order
                    //->setCellValue('D9', 'Date. ' . date_format(date_create(\backend\models\Orders::findOne(['orders_id' => $data['orderId']])->date_add), 'j F Y g:i A')) // date order
                    ->setCellValue('D9', 'Date. ' . date_format(date_create(), 'j F Y g:i A')) // print date
                    ->setCellValue('D10', 'Hello, ' . $data['customerName']) // customer name
                    ->setCellValue('D12', 'You have acquired good(s) from The Watch Co. Webstore.');
                
                $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $data['orderId']])->all();
                
                $totalProductPrice = 0;
                $i = 15;
                $productDiscountAmount = 0;
                $now = date("Y-m-d H:i:s");
                
                // list product orders
                if(count($orderdetail) > 0){
                    foreach ($orderdetail as $detail){
                        
                        $productattribute = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $detail->product_attribute_id])->one();
                        if (!empty($productattribute)) {
							$attribute = $productattribute->attributes->name;
							$value = $productattribute->attributeValue->value;
                            $attribute2 = $productattribute->attributes2->name;
                            $value2 = $productattribute->attributeValue2->value;
						} else {
							$attribute = '';
							$value = '';
                            $attribute2 = '';
                            $value2 = '';
						}
                        
                        $objPHPExcel->getActiveSheet()
                            ->setCellValue('D'.$i, $detail->product_name . ' ' . $value.' ' . $value2) 
                            ->setCellValue('E'.$i, $detail->product_quantity) 
                            ->setCellValue('F'.$i, "IDR " . number_format($detail->product_price, 0, '', ','))
                            ->setCellValue('G'.$i, "IDR " . number_format($detail->product_price * $detail->product_quantity, 0, '', ','));
                        
                        $totalProductPrice += ($detail->product_price * $detail->product_quantity);
                        $i++;
                        
                        if($detail->reduction_percent != 0){
                            
                            // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                                $productDiscountAmount += ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 
                            //}
                                
                        }
                        
                        if($detail->reduction_amount != 0){
                            
                            // check if discount date still valid
                            //if($detail->product->specificPrice->from <= $now && $detail->product->specificPrice->to > $now){
                                $productDiscountAmount += $detail->reduction_amount;
                            //}
                            
                        }
						
						if($detail->reduction_percent_extra != 0){
					
							if($detail->reduction_percent != 0){    
								$discountAmount = ((($detail->reduction_percent / 100) * $detail->product_price) * $detail->product_quantity); 		
							}
									
							if($detail->reduction_amount != 0){
								$discountAmount = $detail->reduction_amount;
							}
							
							$afterDiscountAmount = $detail->product_price - $discountAmount;
							$productDiscountAmount += (($detail->reduction_percent_extra / 100) * $afterDiscountAmount);
						}
                    }
                }
                // echo $detail->reduction_percent;die();
                $voucherDiscount = 0;
                $orderCartRule = \backend\models\OrderCartRule::findOne(['orders_id' => $data['orderId']]);
                
                // discount voucher code
                if($orderCartRule != NULL){
                    $voucherDiscount = $orderCartRule->value;
                }
                
                $totalDiscount = $voucherDiscount + $productDiscountAmount + \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_special_promo;
                
                if($unique_code == 0){

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('D33', 'Discount')
                    ->setCellValue('D34', 'Shipping + Insurance')
                    ->setCellValue('D35', 'T O T A L')
                    ->setCellValue('D37', 'Shipping Information')
                    ->setCellValue('D41', 'Phone Number')
                    ->setCellValueExplicit('E41', $data['phoneNumber'], \PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('D43', 'Notes')
                    ->setCellValue('D45', 'Good(s) purchased cannot be exchanged, refunded, or returned.');
					
					$totalShipping = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping;
					$totalShippingInsurance = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping_insurance;
					$grandTotal = $totalProductPrice - $totalDiscount + $totalShipping + $unique_code;
					$grandTotal += $totalShippingInsurance;

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('G33', "IDR " . number_format($totalDiscount,  0, '', ',')) // discount
                    ->setCellValue('E34', substr($data['shipmentPackage'], 0, 3))
                    ->setCellValue('G34', "IDR " . number_format($totalShipping + $totalShippingInsurance, 0, '', ',')) // shipping
                    ->setCellValue('G35', "IDR " . number_format($grandTotal,  0, '', ',')) // grand total
                    ->setCellValue('E37', $data['customerName']) // customer name
                    ->setCellValue('E38', $data['customerAddressFl'] . ' ' . $data['customerAddress'] . ' ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode']); // customer address

           
                }else{

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('D33', 'Discount')
                    ->setCellValue('D34', 'Unique Code')
                    ->setCellValue('D35', 'Shipping + Insurance')
                    ->setCellValue('D36', 'T O T A L')
                    ->setCellValue('D38', 'Shipping Information')
                    ->setCellValue('D42', 'Phone Number')
                    ->setCellValueExplicit('E42', $data['phoneNumber'], \PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('D44', 'Notes')
                    ->setCellValue('D46', 'Good(s) purchased cannot be exchanged, refunded, or returned.');
					
					$totalShipping = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping;
					$totalShippingInsurance = \backend\models\Orders::findOne(['orders_id' => $data['orderId']])->total_shipping_insurance;
					$grandTotal = $totalProductPrice - $totalDiscount + $totalShipping + $unique_code;
					$grandTotal += $totalShippingInsurance;

                    $objPHPExcel->getActiveSheet()
                    ->setCellValue('G33', "IDR " . number_format($totalDiscount,  0, '', ',')) // discount
                    ->setCellValue('G34', $unique_code)
                    ->setCellValue('E35', substr($data['shipmentPackage'], 0, 3))
                    ->setCellValue('G35', "IDR " . number_format($totalShipping + $totalShippingInsurance, 0, '', ',')) // shipping
                    ->setCellValue('G36', "IDR " . number_format($grandTotal,  0, '', ',')) // grand total
                    ->setCellValue('E38', $data['customerName']) // customer name
                    ->setCellValue('E39', $data['customerAddress'] . ' ' . $data['customerAddressDistrict'] . ' - ' . $data['customerAddressCity'] . ' ' . $data['customerAddressProvince'] . ' ' . $data['customerAddressPostalCode']); // customer address
                }
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('D14', 'D E S C R I P T I O N')
                    ->setCellValue('E14', 'Q T Y')
                    ->setCellValue('F14', 'U N I T  P R I C E')
                    ->setCellValue('G14', 'S U B T O T A L');
                
              
                
                $objPHPExcel->getActiveSheet()
                    ->setCellValue('A21', '            T H E W A T C H C O _ I D')
                    ->setCellValue('A22', '            T H E W A T C H C O')
                    ->setCellValue('A23', '            T H E W A T C H C O');
                
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="invoice '.$orderId.' '.$data['customerName'].'.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateExport($type, $data, $from, $to){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Customer Orders TheWatchCo")
                    ->setSubject("Excel Customer Orders TheWatchCo")
                    ->setDescription("Excel Customer Orders TheWatchCo")
                    ->setKeywords("Excel Customer Orders TheWatchCo")
                    ->setCategory("Customer Orders");
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12.71);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.88);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11.88);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
				$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12);
				
				$objPHPExcel->getActiveSheet()
					->setCellValue('A1', 'Order Number')
					->setCellValue('B1', 'Customer Name')
					->setCellValue('C1', 'Customer Address')
					->setCellValue('D1', 'Email')
					->setCellValue('E1', 'Phone Number')
					->setCellValue('F1', 'Product Name')
					->setCellValue('G1', 'Product Url')
					->setCellValue('H1', 'Brand Name')
					->setCellValue('I1', 'Product Quantity')
					->setCellValue('J1', 'Product Real Price')
					->setCellValue('K1', 'Order Grand Total')
					->setCellValue('L1', 'Payment Method')
					->setCellValue('M1', 'Unique Code')
					->setCellValue('N1', 'Order Date')
					->setCellValue('O1', 'Order Status')
					->setCellValue('P1', 'Order Resi')
					->setCellValue('Q1', 'Order Last Update Date')
					->setCellValue('R1', 'Order Shipping')
					->setCellValue('S1', 'Order Free Shipping Cost')
					->setCellValue('T1', 'Order Shipping Insurance')
					->setCellValue('U1', 'Shipping Name')
					->setCellValue('V1', 'Shipping Method')
					->setCellValue('W1', 'Account Name')
					->setCellValue('X1', 'Flash Sale')
					->setCellValue('Y1', 'Special Promo')
					->setCellValue('Z1', 'Product After Discount');
                
                $i = 2;
                foreach ($data as $row){
                    
                    $installment = '';
                    $kredivo = '';
                    
                    if($row['payment_method_installment_detail_id'] != 0){
                        $installment = ' ' . $row['payment_method_installment_name'];
                    }
                    if($row['payment_method_detail_id'] == 10){
                        /*$kredivoPaymentType = \backend\models\KredivoNotify::findOne(['kredivo_order_id' => $row['reference']]);
                        if($kredivoPaymentType->kredivo_payment_type == '30_days'){
                            $kredivo = ' 30 days payment';
                        } elseif($kredivoPaymentType->kredivo_payment_type == '3_months'){
                            $kredivo = ' 3 month installment';
                        } elseif($kredivoPaymentType->kredivo_payment_type == '6_months'){
                            $kredivo = ' 6 month installment';
                        } elseif($kredivoPaymentType->kredivo_payment_type == '12_months'){
                            $kredivo = ' 12 month installment';
                        }*/
						$kredivo = ' ' . $row['kredivo_payment_type'] .' installment';
                    }
                    
                    $orderdetail = \backend\models\OrderDetail::find()->where(['orders_id' => $row['orders_id']])->all();
                    $status = \backend\models\OrderHistory::find()->where(['orders_id' => $row['orders_id']])->orderBy('date_add DESC')->one();
                    
                    $order_cart_rule = \backend\models\OrderCartRule::find()->where(['orders_id'=>$row['orders_id']])->one();
                    $voucher_value = 0;
                    if($order_cart_rule != null){
                        $voucher_value = $order_cart_rule->value;
                    }
					$finalTotal = 0;
					$finalTotal = (($row['total_product_price'] - $voucher_value) + $row['total_shipping'] + $row['unique_code'] - $row['total_special_promo']);
					$finalTotal += $row['total_shipping_insurance'];
					if($finalTotal <= 0){
						$finalTotal = 0;
					}
                    
                    if(count($orderdetail) > 1){
                        $flag = 1;
                        $last_merge = $i + count($orderdetail) - 1;
                        foreach($orderdetail as $detail){
                            
                            $productattribute = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $detail->product_attribute_id])->one();
                            if (!empty($productattribute)) {
                                $attribute = $productattribute->attributes->name;
                                $value = $productattribute->attributeValue->value;
                            } else {
                                $attribute = '';
                                $value = '';
                            }
							
							// calculate free shipping cost
							$freeShippingCost = 0;
							
							if($row['total_shipping'] == 0){
								$flatPrice = \backend\models\CarrierCostFlatPrice::findOne([
									'province_id' => $row['province_id'], 
									'carrier_package_id' => $row['carrier_package_id']
								])->price;
								$weight = \common\components\Helpers::generateWeightOrderDetail($orderdetail);
								
								$freeShippingCost = $flatPrice * $weight;
							}
                            
                            
                            $objPHPExcel->getActiveSheet()
                                ->setCellValue('A'.$i, $row['reference'])
                                ->setCellValue('B'.$i, $row['firstname'] . ' ' . $row['lastname'])
                                ->setCellValue('C'.$i, $row['address1'] . ', ' . $row['district_name'] . ' - ' . $row['state_name'] . ' ' . $row['province_name'] . ' ' . $row['postcode'])
                                ->setCellValue('D'.$i, $row['email'])
                                ->setCellValue('E'.$i, $row['phone'])
                                ->setCellValue('F'.$i, $detail->product_name . ' ' . $value)
                                ->setCellValue('G'.$i, $detail->product->productDetail->link_rewrite)
                                ->setCellValue('H'.$i, $detail->product->brands->brand_name)
                                ->setCellValue('I'.$i, $detail->product_quantity)
                                ->setCellValue('J'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($detail->product_price))
                                
                                ->setCellValue('L'.$i, $row['name_bank'] . $installment . $kredivo)
                                ->setCellValue('M'.$i, $row['unique_code'])
                                ->setCellValue('N'.$i, date_format(date_create($row['date_add']), 'j F Y g:i A'))
                                ->setCellValue('O'.$i, $status->orderStateLang->name)
                                ->setCellValue('P'.$i, $row['shipping_number'])
                                ->setCellValue('Q'.$i, date_format(date_create($status->date_add), 'j F Y g:i A'))
								->setCellValue('Z'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($detail->original_product_price));
                                
                                
								
								
								
                            if($flag == 1){
                             
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('K'.$i.':K'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('R'.$i.':R'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('S'.$i.':S'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('T'.$i.':T'.$last_merge);
                                    $objPHPExcel->getActiveSheet()
                                    ->mergeCells('U'.$i.':U'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('V'.$i.':V'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('W'.$i.':W'.$last_merge);
                                $objPHPExcel->getActiveSheet()
                                    ->mergeCells('X'.$i.':X'.$last_merge);
									
                                $objPHPExcel->getActiveSheet()
                                // ->setCellValue('K'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($row['total_product_price'] + $row['unique_code'] - $voucher_value + $row['total_shipping'] + $row['total_shipping_insurance']))
                                ->setCellValue('K'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($finalTotal))
                                ->setCellValue('R'.$i, $row['total_shipping'])
                                ->setCellValue('S'.$i, $freeShippingCost)
								->setCellValue('T'.$i, $row['total_shipping_insurance'])
								->setCellValue('U'.$i, $row['carrier_delivery_name'])
								->setCellValue('V'.$i, $row['carrier_package_name'])
								->setCellValue('W'.$i, $row['account_name'])
								->setCellValue('X'.$i, $row['flash_sale'] == 1 ? "Yes" : "No")
								->setCellValue('Y'.$i, $row['total_special_promo']);
								
								$flag = 0;
                            }
                            
                            
                            $i++;
                        }
                        
                    } else {
                        
                        foreach($orderdetail as $detail){
                            
                            $productattribute = \backend\models\ProductAttributeCombination::find()->where(['product_attribute_id' => $detail->product_attribute_id])->one();
                            if (!empty($productattribute)) {
                                $attribute = $productattribute->attributes->name;
                                $value = $productattribute->attributeValue->value;
                            } else {
                                $attribute = '';
                                $value = '';
                            }
							
							// calculate free shipping cost
							$freeShippingCost = 0;
							
							if($row['total_shipping'] == 0){
								$flatPrice = \backend\models\CarrierCostFlatPrice::findOne([
									'province_id' => $row['province_id'], 
									'carrier_package_id' => $row['carrier_package_id']
								])->price;
								$weight = \common\components\Helpers::generateWeightOrderDetail($orderdetail);
								
								$freeShippingCost = $flatPrice * $weight;
							}
                            
                            $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A'.$i, $row['reference'])
                                    ->setCellValue('B'.$i, $row['firstname'] . ' ' . $row['lastname'])
                                    ->setCellValue('C'.$i, $row['address1'] . ', ' . $row['district_name'] . ' - ' . $row['state_name'] . ' ' . $row['province_name'] . ' ' . $row['postcode'])
                                    ->setCellValue('D'.$i, $row['email'])
                                    ->setCellValue('E'.$i, $row['phone'])
                                    ->setCellValue('F'.$i, $detail->product_name . ' ' . $value)
                                    ->setCellValue('G'.$i, $detail->product->productDetail->link_rewrite)
                                    ->setCellValue('H'.$i, $detail->product->brands->brand_name)
                                    ->setCellValue('I'.$i, $detail->product_quantity)
                                    ->setCellValue('J'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($detail->product_price))
                                    // ->setCellValue('K'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($row['total_product_price'] + $row['unique_code'] - $voucher_value + $row['total_shipping'] + $row['total_shipping_insurance']))
                                    ->setCellValue('K'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($finalTotal))
                                    ->setCellValue('L'.$i, $row['name_bank'] . $installment . $kredivo)
                                    ->setCellValue('M'.$i, $row['unique_code'])
                                    ->setCellValue('N'.$i, date_format(date_create($row['date_add']), 'j F Y g:i A'))
                                    ->setCellValue('O'.$i, $status->orderStateLang->name)
                                    ->setCellValue('P'.$i, $row['shipping_number'])
                                    ->setCellValue('Q'.$i, date_format(date_create($status->date_add), 'j F Y g:i A'))
									->setCellValue('R'.$i, $row['total_shipping'])
									->setCellValue('S'.$i, $freeShippingCost)
									->setCellValue('T'.$i, $row['total_shipping_insurance'])
									->setCellValue('U'.$i, $row['carrier_delivery_name'])
									->setCellValue('V'.$i, $row['carrier_package_name'])
									->setCellValue('W'.$i, $row['account_name'])
									->setCellValue('X'.$i, $row['flash_sale'] == 1 ? "Yes" : "No")
									->setCellValue('Y'.$i, $row['total_special_promo'])
									->setCellValue('Z'.$i, 'IDR ' . \common\components\Helpers::getPriceFormat($detail->original_product_price));
                        }
                        
                        $i++;
                    }
                    
                    
                }
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="data_order_'.$from.'_'.$to.'.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateProduct($type,$data){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Product List")
                    ->setSubject("Excel Product List")
                    ->setDescription("Excel Product List")
                    ->setKeywords("Excel Product List")
                    ->setCategory("Product List");

                $objPHPExcel->getActiveSheet()
					->setCellValue('A1', 'sku_number')
					->setCellValue('B1', 'id')
					->setCellValue('C1', 'title')
					->setCellValue('D1', 'description')
					->setCellValue('E1', 'link')
					->setCellValue('F1', 'image link')
					->setCellValue('G1', 'price')
					->setCellValue('H1', 'sale price')
					->setCellValue('I1', 'condition')
					//->setCellValue('I1', 'availability')
					->setCellValue('J1', 'brand')																		
					->setCellValue('K1', 'status')
					->setCellValue('L1', 'gender')
					->setCellValue('M1', 'quantity');
									
                $i = 2;
				
				
                    
                /*$data = \backend\models\Product::find()
					//->limit(1000)
                    ->joinWith([
                        'brands',
                        'productDetail',
                        "productImage" => function ($query) {
                            $query->andWhere(['cover' => 1]);
                        }
                    ])
                    //->where([
                        //'product.active' => 1
                    //])
                    ->orderBy('product.product_id DESC')
                    ->all();
				*/
				
                $now = date('Y-m-d H:i:s');
                $saleAmount = 0;
                $availability = '';
                // print_r($data);die();
                foreach ($data as $row){
                    
                    $stock = \backend\models\ProductStock::findOne(['product_id' => $row['product_id']]);
                    $productStock = \backend\models\ProductStock::find()->where(['product_id' => $row['product_id']])->andWhere(['<>','quantity', 0])->all();
                    $spesificPrice = \backend\models\SpecificPrice::find()->where(['specific_price.product_id' => $row['product_id']])->andWhere('specific_price.from <= "'. $now . '"')->andWhere('specific_price.to > "'. $now . '"')->one();
                    $found = FALSE;
                    if(count($productStock) > 0){
                        $found = TRUE;
                    }
                    
                    // foreach ($productStock as $attribute){
                    //     $productattribute = \backend\models\ProductAttribute::findOne(['product_attribute_id' => $attribute->product_attribute_id]);
                    //     if($productattribute != NULL && $attribute->quantity != 0){
                    //         $found = TRUE;
                    //     }
                    // }
                    
					/*
                    if(!$found){
                        if($stock->quantity == 0){
                            $availability = 'out of stock';
                        } else {
                            $availability = 'in stock';
                        }
                    } else {
                        $availability = 'in stock';
                    }
					*/
                    
                    if ($spesificPrice != null) {
						if ($spesificPrice->reduction_type == 'percent') {
							$saleAmount = (($spesificPrice->reduction / 100) * $row['price']);
						} elseif ($spesificPrice->reduction_type == 'amount') {
							$saleAmount = $spesificPrice->reduction;
						}
                    } else {						$saleAmount = 0;					}
                    
                    $priceTotal = $row['price'] - $saleAmount;
					
					// get product attribut [gender]
					//$features = \backend\models\ProductFeature::find()->where(['product_id' => $row['product_id']])->all();
					//$no = count($feature);
					$gender = array();
					/*foreach ($features as $feature) {
						$title = \backend\models\Feature::findOne($feature->feature_id);
						$value = \backend\models\ProductFeatureValue::findOne($feature->feature_value_id);
						
						if($title->feature_name == "Gender"){
							$gender[] = $value->feature_value_name;
						}
					}*/
                    
                    $objPHPExcel->getActiveSheet()
                            ->setCellValue('A'.$i, trim($row['sku_number']))
                            ->setCellValue('B'.$i, $row['product_id'])
                            ->setCellValue('C'.$i, $row['name'])
                            ->setCellValue('D'.$i, strip_tags($row['description']))
                            ->setCellValue('E'.$i, 'https://www.thewatch.co/product/' . $row['link_rewrite'])
                            ->setCellValue('F'.$i, 'https://www.thewatch.co/img/product/' . $row['product_image_id'] . '/' . $row['product_image_id'] . '_medium.jpg')
                            ->setCellValue('G'.$i, $row['price'])
                            ->setCellValue('H'.$i, $priceTotal)
                            ->setCellValue('I'.$i, 'new')
                            //->setCellValue('I'.$i, $availability)
                            ->setCellValue('J'.$i, $row['brand_name'])
							->setCellValue('K'.$i, $row['active'] == 1 ? "active" : "inactive")
							->setCellValue('L'.$i, $row['gender'])
							->setCellValue('M'.$i, $stock->quantity);
                    
                    $i++;
                }
                   
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="productList.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateKontesSeo($type){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Peserta Kontes SEO")
                    ->setSubject("Excel Peserta Kontes SEO")
                    ->setDescription("Excel Peserta Kontes SEO")
                    ->setKeywords("Excel Peserta Kontes SEO")
                    ->setCategory("Kontes SEO");

                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A1:J1');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A1', 'DAFTAR PESERTA');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A3', 'No.')
                                    ->setCellValue('B3', 'ID Peserta')
                                    ->setCellValue('C3', 'Nama')
                                    ->setCellValue('D3', 'No. HP')
                                    ->setCellValue('E3', 'Email')
                                    ->setCellValue('F3', 'Alamat')
                                    ->setCellValue('G3', 'Link URL')
                                    ->setCellValue('H3', 'Facebook')
                                    ->setCellValue('I3', 'Instagram')
                                    ->setCellValue('J3', 'Status');

                $i = 4;
                $j = 1;
                $data = \backend\models\KontesSeo::find()->all();
                foreach ($data as $row){
                        
                            $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A'.$i, $j)
                                    ->setCellValue('B'.$i, $row->kontes_seo_id)
                                    ->setCellValue('C'.$i, $row->kontes_seo_name)
                                    ->setCellValueExplicit('D'.$i, $row->kontes_seo_hp, \PHPExcel_Cell_DataType::TYPE_STRING)
                                    ->setCellValue('E'.$i, $row->kontes_seo_email)
                                    ->setCellValue('F'.$i, $row->kontes_seo_address)
                                    ->setCellValue('G'.$i, $row->kontes_seo_url)
                                    ->setCellValue('H'.$i, $row->kontes_seo_fb)
                                    ->setCellValue('I'.$i, $row->kontes_seo_ig)
                                    ->setCellValue('J'.$i, $row->kontes_seo_status);
                            
                            $i++;$j++;
                        }
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);      
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(true);
                   
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="data_peserta_kontes_seo.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateBlogCompetition($type){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Peserta Kontes SEO")
                    ->setSubject("Excel Peserta Kontes SEO")
                    ->setDescription("Excel Peserta Kontes SEO")
                    ->setKeywords("Excel Peserta Kontes SEO")
                    ->setCategory("Kontes SEO");

                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A1:J1');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A1', 'DAFTAR PESERTA');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A3', 'No.')
                                    ->setCellValue('B3', 'ID Peserta')
                                    ->setCellValue('C3', 'Nama')
                                    ->setCellValue('D3', 'No. HP')
                                    ->setCellValue('E3', 'Email')
                                    ->setCellValue('F3', 'Alamat')
                                    ->setCellValue('G3', 'Link URL')
                                    ->setCellValue('H3', 'Facebook')
                                    ->setCellValue('I3', 'Instagram')
                                    ->setCellValue('J3', 'Status');

                $i = 4;
                $j = 1;
                $data = \backend\models\BlogCompetition::find()->all();
                foreach ($data as $row){
                        
                            $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A'.$i, $j)
                                    ->setCellValue('B'.$i, $row->kontes_seo_id)
                                    ->setCellValue('C'.$i, $row->kontes_seo_name)
                                    ->setCellValueExplicit('D'.$i, $row->kontes_seo_hp, \PHPExcel_Cell_DataType::TYPE_STRING)
                                    ->setCellValue('E'.$i, $row->kontes_seo_email)
                                    ->setCellValue('F'.$i, $row->kontes_seo_address)
                                    ->setCellValue('G'.$i, $row->kontes_seo_url)
                                    ->setCellValue('H'.$i, $row->kontes_seo_fb)
                                    ->setCellValue('I'.$i, $row->kontes_seo_ig)
                                    ->setCellValue('J'.$i, $row->kontes_seo_status);
                            
                            $i++;$j++;
                        }
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);      
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(true);
                   
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="data_peserta_kontes_seo.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateHeritage($type){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Heritage Order")
                    ->setSubject("Excel Heritage Order")
                    ->setDescription("Excel Heritage Order")
                    ->setKeywords("Excel Heritage Order")
                    ->setCategory("Heritage Order");

                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A1:K1');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A1', 'DAFTAR ORDER');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A3', 'No.')
                                    ->setCellValue('B3', 'Nama')
                                    ->setCellValue('C3', 'No. Telp')
                                    ->setCellValue('D3', 'Gender')
                                    ->setCellValue('E3', 'Email')
                                    ->setCellValue('F3', 'Tanggal Lahir')
                                    ->setCellValue('G3', 'Alamat')
                                    ->setCellValue('H3', 'Nama Produk')
                                    ->setCellValue('I3', 'Attribute')
                                    ->setCellValue('J3', 'Jumlah')
                                    ->setCellValue('K3', 'Harga');

                $i = 4;
                $j = 1;
                $data = \backend\models\OrderEvent::find()->all();
                foreach ($data as $row){
                        
                            $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A'.$i, $j)
                                    ->setCellValue('B'.$i, $row->order_event_name)
                                    ->setCellValueExplicit('C'.$i, $row->order_event_phone, \PHPExcel_Cell_DataType::TYPE_STRING)
                                    ->setCellValue('D'.$i, $row->order_event_gender)
                                    ->setCellValue('E'.$i, $row->order_event_email)
                                    ->setCellValue('F'.$i, $row->order_event_birth)
                                    ->setCellValue('G'.$i, $row->order_event_address)
                                    ->setCellValue('H'.$i, $row->order_event_product_name)
                                    ->setCellValue('I'.$i, $row->order_event_product_attribute)
                                    ->setCellValue('J'.$i, $row->order_event_quantity)
                                    ->setCellValue('K'.$i, $row->order_event_price);
                            
                            $i++;$j++;
                        }
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
                $objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);      
                $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:K3')->getFont()->setBold(true);
                   
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="heritage_order_data.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
    }
    
    public static function generateWarranty($type,$data){
        
        switch ($type){
            
            case "Excel":
                
                require_once 'PHPExcel/Classes/PHPExcel.php';
                
                include 'PHPExcel/Classes/Writer/Excel2007.php';
                
                // Create new PHPExcel object
                $objPHPExcel = new \PHPExcel();

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("PT Kami Gawi Berjaya")
                    ->setLastModifiedBy("PT Kami Gawi Berjaya")
                    ->setTitle("Excel Peserta Kontes SEO")
                    ->setSubject("Excel Peserta Kontes SEO")
                    ->setDescription("Excel Peserta Kontes SEO")
                    ->setKeywords("Excel Peserta Kontes SEO")
                    ->setCategory("Kontes SEO");

                $objPHPExcel->getActiveSheet()
                        ->mergeCells('A1:E1');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A1', 'Warranty Code List');

                $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A3', 'No.')
                                    ->setCellValue('B3', 'Date')
                                    ->setCellValue('C3', 'Warranty Type')
                                    ->setCellValue('D3', 'Status')
                                    ->setCellValue('E3', 'Code');
                                 

                $i = 4;
                $j = 1;
                $data = \backend\models\Warranty::find()->where(['warranty_description' => $data])->all();
                foreach ($data as $row){
                        
                            $objPHPExcel->getActiveSheet()
                                    ->setCellValue('A'.$i, $j)
                                    ->setCellValue('B'.$i, $row->warranty_date_add)
                                    ->setCellValue('C'.$i, $row->warrantyType->warranty_type_name)
                                    ->setCellValue('D'.$i, $row->warranty_status)
                                    ->setCellValue('E'.$i, $row->warranty_code);
                                    
                            
                            $i++;$j++;
                        }
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25.25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(11.14);
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);      
                $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(true);
                   
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle('Sheet1');

                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);

                // Redirect output to a client’s web browser (Excel5)
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="data_generate_warranty.xls"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                $objWriter->save('php://output');
                
                break;
            
        }
        
    }
}
