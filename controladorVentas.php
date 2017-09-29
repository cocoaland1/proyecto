<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Ventas.php");

$opcion                    = $_POST["fEnviar"];
$IdVentas                  = $_POST["fIdVentas"];
$NumeroFactura          = $_POST["fNumeroFactura"];
$KilosVenta    = $_POST["fKilosVenta"];
$FechaVenta       = $_POST["fFechaVenta"];
$IdClientesVenta =$_POST["fIdClientesVenta"];

$NumeroFactura  = htmlspecialchars($NumeroFactura);
$KilosVenta  = htmlspecialchars($KilosVenta);
$FechaVenta = htmlspecialchars($FechaVenta);
$IdClientesVenta = htmlspecialchars($IdClientesVenta);



$objetoVentas = new Ventas($conexion, $IdVentas, $NumeroFactura , $KilosVenta,  $FechaVenta, $IdClientesVenta);

switch($opcion){
        case 'Ingresar';
        $objetoVentas->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoVentas-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoVentas->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioVentas.php?msj=$mensaje");
?>
