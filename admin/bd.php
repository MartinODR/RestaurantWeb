<?php

$servidor="localhost";
$baseDatos="restaurante";
$usuario="root";
$contrasenia="";

try{
//instruccion de conexion mediante PDO
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario,$contrasenia); 
    //echo"conectado"; //prueba de conexion
}catch(Exeption $error){
    echo $error->getMessage();

}

?>