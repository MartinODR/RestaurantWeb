<?php

session_start();
session_destroy();
header("Location:./login.php");

echo "salir, cerrar sesion";

?>