<?php

$servidor="sql212.infinityfree.com";
$baseDatos="if0_36348325_restaurante";
$usuario="if0_36348325";
$contrasenia="HccCPNPBpbPLwNz";

try{
//instruccion de conexion mediante PDO
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario,$contrasenia); 
    //echo"conectado"; //prueba de conexion
}catch(Exeption $error){
    echo $error->getMessage();

}

?>