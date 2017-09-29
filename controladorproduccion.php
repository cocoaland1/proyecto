<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Produccion.php");

$opcion           = $_POST["fEnviar"];
$IdProduccion        = $_POST["fIdProduccion"];
$FechaProduccion      = $_POST["fFechaProduccion"];
$KilosPepaProduccion    = $_POST["fKilosPepaProduccion"];
$LitrosBabaProduccion   = $_POST["fLitrosBabaProduccion"];
$KilosCascaraProduccion     = $_POST["fKilosCascaraProduccion"];
$IdArbolProduccion   = $_POST["fIdArbolProduccion"];

$FechaProduccion = htmlspecialchars($FechaProduccion );
$KilosPepaProduccion  = htmlspecialchars($KilosPepaProduccion);
$LitrosBabaProduccion = htmlspecialchars($LitrosBabaProduccion);
$KilosCascaraProduccion  = htmlspecialchars($KilosCascaraProduccion );
$IdArbolProduccion  =htmlspecialchars ($IdArbolProduccion );


$objetoProduccion = new Produccion($conexion, $IdProduccion, $FechaProduccion, $KilosPepaProduccion,  $LitrosBabaProduccion, $KilosCascaraProduccion, $IdArbolProduccion);

switch($opcion){
        case 'Ingresar';
        $objetoProduccion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoProduccion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoProduccion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioproduccion.php?msj=$mensaje");
?>
