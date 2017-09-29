<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Fertilizacion.php");

$opcion                     = $_POST["fEnviar"];
$IdFertilizacion               = $_POST["fIdFertilizacion"];
$FechaFertilizacion           = $_POST["fFechaFertilizacion"];
$CantidadFertilizante       = $_POST["fCantidadFertilizante"];
$IdFertilizanteFertilizacion     = $_POST["fIdFertilizanteFertilizacion"];
$IdArbolFertilizacion         = $_POST["fIdArbolFertilizacion"];

$FechaFertilizacion= htmlspecialchars($FechaFertilizacion );
$CantidadFertilizante  = htmlspecialchars($CantidadFertilizante  );
$IdFertilizanteFertilizacion  = htmlspecialchars($IdFertilizanteFertilizacion);
$IdArbolFertilizacion =htmlspecialchars ($IdArbolFertilizacion  );


$objetoFertilizacion  = new Fertilizacion ($conexion, $IdFertilizacion , $FechaFertilizacion ,  $CantidadFertilizante, $IdFertilizanteFertilizacion, $IdArbolFertilizacion );

switch($opcion){
        case 'Ingresar';
        $objetoFertilizacion->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoFertilizacion-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoFertilizacion->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioFertilizacion.php?msj=$mensaje");
?>
