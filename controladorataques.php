<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/ataques.php");

$opcion           = $_POST["fEnviar"];
$idAtaques        = $_POST["fidAtaques"];
$fechaAtaque      = $_POST["ffechaataque"];
$porcentajeinfestacion    = $_POST["fporcentajeinfestacion"];
$IdEnfermedadAtaque   = $_POST["fIdEnfermedadAtaque"];
$idArbolAtaque     = $_POST["fidArbolAtaque"];

$fechaAtaque = htmlspecialchars($fechaAtaque);
$porcentajeinfestacion = htmlspecialchars($porcentajeinfestacion);
$IdEnfermedadAtaque = htmlspecialchars($IdEnfermedadAtaque);
$idArbolAtaque = htmlspecialchars($idArbolAtaque);


$objetoataques = new ataques($conexion, $idAtaques, $fechaAtaque, $porcentajeinfestacion,  $IdEnfermedadAtaque, $idArbolAtaque);

switch($opcion){
        case 'Ingresar';
        $objetoataques->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoataques-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoataques->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioataques.php?msj=$mensaje");
?>
