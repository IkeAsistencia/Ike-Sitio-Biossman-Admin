<?php
session_start();
require_once "../conexion/conexion.php";
$conexion = new conexion;

$email = $_POST['email'];
$pass = $_POST['pass'];
$passEncript = hash('sha512', $pass);

$query = "SELECT * FROM usuarios_biu WHERE correo = '$email' AND password = '$passEncript'";
$result =  $conexion->getData($query);

$count_row = count($result);

if ($count_row > 0) {
    foreach($result as $val){    
        $_SESSION['nombre'] = $val['nombre'];
        $_SESSION['correo'] = $val['correo'];
        $_SESSION['id_usuario'] = $val['id_usuario'];
        $estatus = $val['estatus'];
    }
    
    if($estatus == 1){
        echo "Acceso Correcto";
    }else{
        echo "Usuario Inactivo";
    }
    exit;
} else {
    echo "Acceso denegado";
    exit;
}
