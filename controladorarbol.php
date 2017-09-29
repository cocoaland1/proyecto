<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/arbol.php");

$opcion =  $_POST["fEnviar"];
$idarbol = $_POST["fidarbol"];
$alturaarbol = $_POST["falturaarbol"];
$fechasiembra = $_POST["fFechasiembra"];
$msnmArbol = $_POST["fmsnmarbol"];
$idSueloarbol = $_POST["fidSueloarbol"];
$idVariedadArbol = $_POST["fIdVariedadArbol"];
$ubicacionarbol = $_POST["fubicacionarbol"];

$alturaarbol = htmlspecialchars($alturaarbol);
$fechasiembra = htmlspecialchars($fechasiembra);
$msnmArbol = htmlspecialchars($msnmArbol);
$idSueloarbol = htmlspecialchars($idSueloarbol);
$idVariedadArbol = htmlspecialchars($idVariedadArbol);

$ubicacionarbol = htmlspecialchars($ubicacionarbol);


$objetoarbol = new arbol($conexion, $idarbol, $alturaarbol, $fechasiembra, $msnmArbol,  $idSueloarbol, $idVariedadArbol, $ubicacionarbol);

switch($opcion){
        case 'Ingresar';
        $objetoarbol->insertar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoarbol->modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoarbol->eliminar();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioarbol.php?msj=$mensaje");
?>
