<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set("Asia/Bangkok");

if (PHP_SAPI == 'cli') die('This example should only be run from a Web Browser');
// require_once APPPATH."/third_party/PHPExcel-1.8/Classes/PHPExcel.php";
// require_once APPPATH."/third_party/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php"; 
// // Create new PHPExcel object 
// $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
// $excel2 = $excel2->load(dirname(__FILE__, 4).'/excel_report/template/tmp_report.xlsx'); // Empty Sheet
// $excel2->setActiveSheetIndex(0);
// $excel2->getActiveSheet()->setCellValue('A6', '4');
require APPPATH."/third_party/PHPSpreadsheet/vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(dirname(__FILE__, 4).'/excel_report/template/tmp_report.xlsx');

//change it
$sheet = $spreadsheet->getActiveSheet();
for($i = 0 ; $i < count($data); $i++){
    $row = $i + 4;
    $sheet->setCellValue("A{$row}", $i+1);
    $sheet->setCellValue("B{$row}", $data[$i]->date);
    $sheet->setCellValue("C{$row}", $data[$i]->pd);
    $sheet->setCellValue("D{$row}", $data[$i]->fourm_number);
    $sheet->setCellValue("E{$row}", $data[$i]->lineName);
    $sheet->setCellValue("F{$row}", $data[$i]->processName);
    $sheet->setCellValue("G{$row}", $data[$i]->rel_production);
    $sheet->setCellValue("H{$row}", $data[$i]->changeTypeCode);
    $sheet->setCellValue("I{$row}", $data[$i]->description);
    $sheet->setCellValue("J{$row}", $data[$i]->permanent);
    $sheet->setCellValue("K{$row}", $data[$i]->temporary);
    $sheet->setCellValue("L{$row}", $data[$i]->start);
    $sheet->setCellValue("M{$row}", $data[$i]->duaDate);
    $sheet->setCellValue("N{$row}", $data[$i]->status); 
}


//write it again to Filesystem with the same name (=replace)
$writer = new Xlsx($spreadsheet);
header("Content-Description: File Transfer"); 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename={$filename}" ); 
$writer->save('php://output');
// ob_end_clean();
// $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
// $objWriter->save('php://output'); 
//Redirect output to a client’s web browser (Excel2007)
//output_file("asdasd.xlsx");


//var_dump(dirname(__FILE__, 4)); 
exit;
$objPHPExcel = new PHPExcel();
$data_col = array();
$col_name = array();

foreach ( range('A', 'Z') as $cm ) { array_push($col_name, $cm); }
foreach ( range('A', 'Z') as $cm ) { array_push($col_name, "A".$cm); }
foreach ( range('A', 'Z') as $cm ) { array_push($col_name, "B".$cm); }
$i   = 0;   
$ind = 0;
foreach ($title as $inTil => $til) 
{
             $objPHPExcel->createSheet();
             $objPHPExcel->setActiveSheetIndex($ind);
             $objPHPExcel->getActiveSheet()->setTitle( "$til ( ". date('Y-m-d') . " )" );

    $sheetIndex  =  strtolower(str_replace(' ', '_', $title[$ind])); 
    $count_index = 0;
    $count_data  =  count($list_act_report[$sheetIndex]) + 2;
    if ($count_data - 2  > 0) 
    {      
            $count_index =  count($list_act_report[$sheetIndex][0]) - 1 ;
            $objPHPExcel->getActiveSheet()->getRowDimension( 1 )->setRowHeight( 35 );
            $objPHPExcel->getActiveSheet()->getRowDimension( 2 )->setRowHeight( 12 );
            $objPHPExcel->getActiveSheet()
                ->getStyle('1')
                ->getAlignment()
                ->setWrapText(true)
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);       
                                   


            $objPHPExcel->getActiveSheet()->getSheetView()->setZoomScale(80);    
            $objPHPExcel->getActiveSheet()->setAutoFilter('A2:'.$col_name[$count_index].'2');
            $objPHPExcel->getActiveSheet()->freezePane('A3');

            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$col_name[$count_index].'1')->applyFromArray(array('fill'    => Style_Fill($colhead)));
            $objPHPExcel->getActiveSheet()->getStyle('A2:'.$col_name[$count_index].'2')->applyFromArray(array('fill'    => Style_Fill('FFFFCC')));
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$col_name[$count_index].'2')->applyFromArray(array('borders' => array('allborders' => Style_border(PHPExcel_Style_Border::BORDER_THIN,'FFFF99'))));

            foreach ( $list_act_report[$sheetIndex][0] as $key => $val ) 
            {
                //var_dump($key); 
                $objPHPExcel->setActiveSheetIndex($inTil)->setCellValue($col_name[$i++]."1", str_replace("_", " ", strtoupper($key)));       
            }            
            //exit;
    $row = 3;
            foreach ($list_act_report[$sheetIndex] as $key => $value) 
            {
                
                $col = 0;
                foreach ($value as $body => $val)
                {
                        $objPHPExcel->setActiveSheetIndex($ind)->setCellValue($col_name[$col++].($row), $val);                                                                    
                }
                $row++;
                
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:'.$col_name[$count_index]."1")->applyFromArray(array('font' => Style_Font(11,$colhead_font,true,'Franklin Gothic Book')));  
            $objPHPExcel->getActiveSheet()->getStyle('A3:'.$col_name[$count_index].$count_data)->applyFromArray(array('font' => Style_Font(10,'000000',false,'Ebrima')));

            foreach(range(0 , $count_index) as $columnID) 
                $objPHPExcel->getActiveSheet()->getColumnDimension($col_name[$columnID]) ->setAutoSize(true);    


            $objPHPExcel->getActiveSheet()
                ->getStyle('A3:'.$col_name[$count_index].$count_data)
                ->getAlignment()
                ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('J3:J'.$count_data)->getNumberFormat()->setFormatCode('_-* #,##0_-;[RED](#,##0)_-;_-* "-"??_-;_-@_-');
            $objPHPExcel->getActiveSheet()->getStyle('L3:O'.$count_data)->getNumberFormat()->setFormatCode('_-* #,##0.00_-;[RED](#,##0.00)_-;_-* "-"??_-;_-@_-');

            //var_dump($list_act_report); exit;
    } else {

                    $objPHPExcel->setActiveSheetIndex($ind)->setCellValue('A1', "No data ".$til.".");
                    $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(array('font' => Style_Font(48,'000000',true,'Franklin Gothic Book')));
                    //echo "Non data."; exit;
    }
// $objPHPExcel->getActiveSheet()->setTitle($title);
$ind++;


}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->removeSheetByIndex(count($title));
$today = date("My");
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save('php://output');
// //Redirect output to a client’s web browser (Excel2007)
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// $con = 'Content-Disposition: attachment;filename='.$filename.$today.'.xlsx';
// header($con);
// header('Cache-Control: max-age=0');
// header('Cache-Control: max-age=1');
// header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
// header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
// header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
// header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('excel/'.$filename.'-'.date('dmy').'.xlsx');


output_file("excel/".$filename.'-'.date('dmy').'.xlsx');
exit;
function output_file($namefile){
        //$namefile = "Query_pods_data.sql";
        $file = $namefile; 
        //echo basename($file); exit;
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=".basename($file) ); 
        readfile ($file);
        exit;
}
function Style_Fill($color=null) {

    return array( 'type'  => PHPExcel_Style_Fill::FILL_SOLID,                           
                  'color' => array('rgb' => $color)                                    
                );                                   
}

function Style_Font($size=11, $color='FFFFFF', $bol=false, $fname='Consolas') {

    return  array(
                    'name' => $fname,
                    'size' => $size,
                    'bold' => $bol,
                    'color' => array('rgb' => $color)
    );                               
}

function Style_border($line='BORDER_THICK', $color='000000')
{
    return array( 'style' => $line, 'color' => array('rgb' => $color)) ;
}
// END Template Class

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */