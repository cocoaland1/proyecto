<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Suelo.php");

$opcion                    = $_POST["fEnviar"];
$IdSuelo               = $_POST["fIdSuelo"];
$DescripcionSuelo     = $_POST["fDescripcionSuelo"];



$DescripcionSuelo=htmlspecialchars($DescripcionSuelo );



$objetoSuelo = new Suelo  ($conexion, $IdSuelo , $DescripcionSuelo);

switch($opcion){
        case 'Ingresar';
        $objetoSuelo ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoSuelo -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoSuelo ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioSuelo.php?msj=$mensaje");
?>
