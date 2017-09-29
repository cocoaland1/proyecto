<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/usuario.php");

$opcion                  = $_POST["fEnviar"];
$idusuario               = $_POST["fidusuario"];
$nombreusuario           = $_POST["fnombreusuario"];
$emailusuario            = $_POST["femailusuario"];
$claveusuario            = $_POST["fclaveusuario"];
$fecharegistrousuario    = $_POST["ffecharegistrousuario"];
$fechaultimaclaveusuario = $_POST["ffechaultimaclaveusuario"];
$idrolusuario            = $_POST["fidrolusuario"];

$nombreusuario = htmlspecialchars($nombreusuario);
$emailusuario = htmlspecialchars($emailusuario);
$claveusuario = htmlspecialchars($claveusuario);
$fecharegistrousuario = htmlspecialchars($fecharegistrousuario);
$fechaultimaclaveusuario = htmlspecialchars($fechaultimaclaveusuario);
$idrolusuario = htmlspecialchars($idrolusuario);


$objetousuario = new usuario($conexion, $idusuario, $nombreusuario, $emailusuario, $claveusuario,  $fecharegistrousuario, $fechaultimaclaveusuario, $idrolusuario);

switch($opcion){
        case 'Ingresar';
        $objetousuario->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetousuario-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetousuario->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariousuario.php?msj=$mensaje");
?>
