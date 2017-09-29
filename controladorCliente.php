<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Cliente.php");

$opcion             = $_POST["fEnviar"];
$IdCliente          = $_POST["fIdCliente"];
$NombreCliente      = $_POST["fNombreCliente"];
$CelularCliente            = $_POST["fCelularCliente"];
$DireccionCliente        = $_POST["fDireccionCliente"];



$NombreCliente= htmlspecialchars($NombreCliente);
$CelularCliente  = htmlspecialchars($CelularCliente);
$DireccionCliente = htmlspecialchars($DireccionCliente);


$objetoCliente   = new Cliente  ($conexion, $IdCliente, $NombreCliente , $CelularCliente,  $DireccionCliente);

switch($opcion){
        case 'Ingresar';
        $objetoCliente->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoCliente-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoCliente->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioCliente.php?msj=$mensaje");
?>
