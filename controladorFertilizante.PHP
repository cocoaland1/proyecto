<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Fertilizante.php");

$opcion                    = $_POST["fEnviar"];
$IdFertilizante               = $_POST["fIdFertilizante"];
$DescripcionFertilizante     = $_POST["fDescripcionFertilizante"];



$DescripcionFertilizante=htmlspecialchars($DescripcionFertilizante );



$objetoFertilizante = new Fertilizante  ($conexion, $IdFertilizante , $DescripcionFertilizante);

switch($opcion){
        case 'Ingresar';
        $objetoFertilizante ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoFertilizante -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoFertilizante ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioFertilizante.php?msj=$mensaje");
?>
