<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Auditoria.php");

$opcion                   = $_POST["fEnviar"];
$IdAuditoria              = $_POST["fIdAuditoria"];
$FechaAuditoria           = $_POST["fFechaAuditoria"];
$DescripcionAuditoria     = $_POST["fDescripcionAuditoria"];
$IdUsuarioAuditoria       = $_POST["fIdUsuarioAuditoria"];



$FechaAuditoria         = htmlspecialchars($FechaAuditoria);
$DescripcionAuditoria   = htmlspecialchars($DescripcionAuditoria);
$IdUsuarioAuditoria     = htmlspecialchars($IdUsuarioAuditoria);


$objetoAuditoria   = new Auditoria  ($conexion, $IdAuditoria , $FechaAuditoria , $DescripcionAuditoria ,  $IdUsuarioAuditoria);

switch($opcion){
        case 'Ingresar';
        $objetoAuditoria ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoAuditoria -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoAuditoria ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioAuditoria.php?msj=$mensaje");
?>
