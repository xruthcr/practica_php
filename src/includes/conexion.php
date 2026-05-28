<?php 
$servidor = "mysql";
$usuario = "root";
$password = "root";
$bd = "bd_goukies";

$conexion = mysqli_connect(
    $servidor,
    $usuario,
    $password,
    $bd
);

if(!$conexion){
    die("Error de conexion");
}

?>