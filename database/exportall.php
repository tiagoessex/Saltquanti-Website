<?php include_once('../settings/fields.php'); ?>
<?php include('../settings/defaults.php'); ?>
<?php include('../settings/saved.php'); ?>
<?php
  /* ************************************
    export all products either to csv or to excel

    called by: exportallproducts.php
  ************************************ */
	require_once '../settings/config.php';

  //include the file that loads the PhpSpreadsheet classes
  require '../external/vendor/autoload.php';

  //include the classes needed to create and write .xlsx file
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\IOFactory;

  $fields = explode(",", $_GET["fields"]);

  $link = db_start();

	$query = "SELECT * from " .  DB_TABLE_FOOD;
	$result = mysqli_query($link, $query);

  if (!$result) {
      Error("Problemas com a base de dados: " . mysqli_error($link));
      die();
  }    

  // object of the Spreadsheet class to create the excel data
  $spreadsheet = new Spreadsheet();

  // HEADER
  $l = 'A';
  for ($i = 0; $i < mysqli_num_fields($result); $i++) {
      if (!in_array (mysqli_field_name($result, $i), $fields)) continue;
      $spreadsheet->setActiveSheetIndex(0)->setCellValue(($l++).'1', $COLUMN2NAME[mysqli_field_name($result, $i)]);
  }

  $cell_st =[
         'font' =>['bold' => true],
         'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
         'borders'=>['bottom' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
  ];
  $spreadsheet->getActiveSheet()->getStyle('A1:'.$l.'1')->applyFromArray($cell_st);


  $line = 2;
  while($row = mysqli_fetch_row($result))
  {
      $l = 'A';
      for($j=0; $j<mysqli_num_fields($result); $j++)
      {
          if (!in_array (mysqli_field_name($result, $j), $fields)) continue;
          $spreadsheet->setActiveSheetIndex(0)->setCellValue((($l++) . strval($line)), (isset($row[$j])?$row[$j] : ''));    
      }
      $line += 1;
  }

  $spreadsheet->getActiveSheet()->setTitle('produtos');


if ($_GET["format"] == "csv") {  

       //set a title for Worksheet
      header('Content-Type: text/csv; charset=utf-8');
      header('Content-Disposition: attachment;filename="alimentos.csv"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');
      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0

      $writer = IOFactory::createWriter($spreadsheet, 'Csv')->setDelimiter(',')->setEnclosure('"')->setSheetIndex(0);
      $writer->save('php://output');
   

    } else if ($_GET["format"] == "excel") {  

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="utilizadores.xlsx"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');
      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0

     $writer = new Xlsx($spreadsheet);
      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
    } 

    die();      


	function mysqli_field_name($result, $field_offset)
	{
	    $properties = mysqli_fetch_field_direct($result, $field_offset);
	    return is_object($properties) ? $properties->name : null;
	}

?>