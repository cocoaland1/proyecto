<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/TiposPoda.php");

$opcion                    = $_POST["fEnviar"];
$IdTiposPoda              = $_POST["fIdTiposPoda"];
$DescripcionTipoPoda     = $_POST["fDescripcionTipoPoda"];



$DescripcionTipoPoda=htmlspecialchars($DescripcionTipoPoda );



$objetoTiposPoda= new TiposPoda  ($conexion, $IdTiposPoda , $DescripcionTipoPoda);

switch($opcion){
        case 'Ingresar';
        $objetoTiposPoda ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoTiposPoda -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoTiposPoda ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioTiposPoda.php?msj=$mensaje");
?>
