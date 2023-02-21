<?php

require_once 'model.php';

//instancia
$model = new Model();

$model->usuario=$_POST['txtUsuario'];
$model->clave=$_POST["txtPassword"];

$filaController=$model->Logear();

if ($filaController>0) {
    header("location:home.html");

} else{
    
    include("index.html");
    echo "<h1>ERROR EN LA AUTENTICACION</h1>";
}


?>