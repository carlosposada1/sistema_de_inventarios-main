<?php

require_once('PHPExcel/IOFactory.php');
require 'conexion.php';

//cargar nuestra hoja de excel//
$excel = PHPExcel_IOFactory::load('archivoprueba.xlsx');

//cargar la hoja de calculo que queremos
$excel -> setActiveSheetIndex(0);

//obtener el numero de filas de nuestro archivo excel
$numerofila = $excel -> setActivveSheetIndex(0)-> getHighestRow();
echo $numerofila;



for($i=2; $i <=$numerofila; $i++){
    $identificacion = $excel -> getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
    if($identificacion==""){

    }else{
    $nombres = $excel -> getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
    $apellidos = $excel -> getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
    $fechainicio = $excel -> getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
    $descripcioncargohomologado = $excel -> getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
    $cargohomologado = $excel -> getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
    $sede = $excel -> getActiveSheet()->getCell('G'.$i)->getCalculatedValue(); 
    $ciudad = $excel -> getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
    $genero = $excel -> getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
    $talla = $excel -> getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
    $CONSULTA = "INSERT INTO informacionDotaciones(identificacion,nombres,apellidos,fechainicio,descripcion,cargohomologado,sede,ciudad,genero,talla)
    value($identificacion,$nombres,$apellidos,$fechainicio,$descripcion,$cargohomologado,$sede,$ciudad,$genero,$talla)";

    $resultado = $sqlsrv->query($CONSULTA);
    }
}



?>


<?php
$conn = mysqli_connect("localhost","root","test","phpsamples");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{
       
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $name = "";
                if(isset($Row[0])) {
                    $name = mysqli_real_escape_string($conn,$Row[0]);
                }
                
                $description = "";
                if(isset($Row[1])) {
                    $description = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                if (!empty($name) || !empty($description)) {
                    $query = "insert into tbl_info(name,description) values('".$name."','".$description."')";
                    $result = mysqli_query($conn, $query);
                
                    if (! empty($result)) {
                        $type = "success";
                        $message = "Excel Data Imported into the Database";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
}
?>