<?php

require_once 'vendor/autoload.php';


include 'conexion.php';

if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $fileName = $_FILES['excel_file']['name'];
    $fileTmpName = $_FILES['excel_file']['tmp_name'];

    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);


    if (in_array(strtolower($fileExt), array('xlsx', 'xlsm', 'xltx', 'xltm'))) {

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpName);


        $worksheet = $spreadsheet->getActiveSheet();

        $rowsInserted = 0;
        $rowsUpdated = 0;

        foreach ($worksheet->getRowIterator() as $row) {
    
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

           
            $data = array();
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }

         
            if (!empty($data) && array_filter($data)) {
               
                $data = array_map('trim', $data);

                
                $codigo = isset($data[0]) ? intval($data[0]) : null;
                $nombre = isset($data[1]) ? $data[1] : null;
                $apellido = isset($data[2]) ? $data[2] : null;
                $email = isset($data[3]) ? $data[3] : null;
                $edad = isset($data[4]) ? $data[4] : null;

              
                if (preg_match('/\s/', $nombre) || preg_match('/\s/', $apellido) || preg_match('/\s/', $email)) {
                    die('Los datos de entrada no deben contener espacios en blanco.');
                }

                $query = "SELECT * FROM usuarios WHERE codigo = $codigo";
                $result = sqlsrv_query($conn, $query);

                if ($result === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                if (sqlsrv_has_rows($result)) {
                    // La fila ya existe, actualizar registro existente
                  //  $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, edad = ?, WHERE codigo = ?";
                    //$params = array($nombre, $apellido, $email, $edad, $codigo);
                    //$stmt = sqlsrv_query($conn, $sql, $params);
                
                    //if ($stmt === false) {
                      //  die(print_r(sqlsrv_errors(), true));
                    //}
                
                    $mensaje = "Registro actualizado correctamente.";
                    echo "<script>alert('$mensaje');</script>";
                    echo "<script>window.location.href = 'leer_usuario.php';</script>";
                } else {
                    // La fila no existe, insertar nuevo registro
                    $sql = "INSERT INTO usuarios (codigo, nombre, apellido, email, edad, fecha_registro, password) VALUES (?, ?, ?, ?, ?, GETDATE(), 0)";
                    $params = array($codigo, $nombre, $apellido, $email, $edad);
                    $stmt = sqlsrv_query($conn, $sql, $params);
                
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                
                    $mensaje = "Registro agregado correctamente.";
                    echo "<script>alert('$mensaje');</script>";
                    echo "<script>window.location.href = 'leer_usuario.php';</script>";
                }
                
                // Redirigir al index con el mensaje
               // header("Location: index.php?mensaje=" . urlencode($mensaje));
                //exit();
            } else {
                die(print_r(sqlsrv_errors(), true));
                }
                } 
                } else {
             
                die("El archivo no es válido.");
                }
                } else {
              
                die("El formulario no ha sido enviado.");
                }
                ?>   
                

