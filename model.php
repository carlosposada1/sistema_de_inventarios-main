<?php

class Model 
{
    var $id;
    var $usuario;
    var $clave;

    function __construct(){

    }

    function Logear(){

        //variables conexion
        $cadenaCnx="sqlsrv:server=DESKTOP-IB90627\SQLEXPRESS;database=bd_sistemainventarios";
        $user="sa";
        $pass="posada1234";

        $conexion = new PDO($cadenaCnx,$user,$pass);

        try{

            $consulta=$conexion->prepare("SELECT * FROM administracion WHERE
            username=:parametro1 AND clave=(SELECT dbo.fun_encriptar(:parametro2))");

            $consulta->bindValue(":parametro1",$this->usuario);
            $consulta->bindValue(":parametro2",$this->clave);

            $consulta->execute();

            $filaModel=$consulta->fetch();
            
            return $filaModel;


        }catch(PDOException $e){

            echo "Error en la conexion->".$e;
        }

    }
}

?>