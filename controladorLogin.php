<?php
$emailUsuario = $_POST["fEmail"];
$claveUsuario = $_POST["fClave"];

include_once("../modelo/conexion.php");
$objetoConexion =  new Conexion();
$conexion = $objetoConexion->conectar();

$emailUusario = mysqli_real_escape_string($conexion, $emailUsuario);

include_once("../modelo/login.php");
$objetoLogin = new Login($conexion, $emailUsuario, $claveUsuario);
$usuarioEsValido = $objetoLogin->verificarUsuario();
$objetoConexion->desconectar($conexion);
if($usuarioEsValido==true){
    session_start();
    $_SESSION['id']   =$objetoLogin->getIdUsuario();
    $_SESSION['nombre']   =$objetoLogin->getNombreUsuario();
    $_SESSION['rol']   =$objetoLogin->getIdRolUsuario();
    
    header("location:../vista/formularioventas.php");
}else{
    header("location:../vista/formulariologin.php?mensaje=incorrecto");
    
}
?>