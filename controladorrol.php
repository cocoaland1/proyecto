<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/rol.php");

$opcion = $_POST["fEnviar"];
$idrol = $_POST["fidrol"];
$nombrerol = $_POST["fnombrerol"];
$arbolrol = $_POST["farbolrol"];
$variedadrol = $_POST["fvariedadrol"];
$suelorol = $_POST["fsuelorol"];
$enfermedadrol = $_POST["fenfermedadrol"];
$produccionrol = $_POST["fproduccionrol"];
$ataquerol = $_POST["fataquerol"];
$clienterol = $_POST["fclienterol"];
$ventasrol = $_POST["fventasrol"];
$tratamientorol = $_POST["ftratamientorol"];
$podasrol = $_POST["fpodasrol"];
$tipopodarol = $_POST["ftipopodarol"];
$floracionrol = $_POST["ffloracionrol"];
$fertilizantesrol = $_POST["ffertilizantesrol"];
$fertilizacionrol = $_POST["ffertilizacionrol"];
$usuariosrol = $_POST["fusuariosrol"];
$auditoriarol = $_POST["fauditoriarol"];
$rolrol = $_POST["frolrol"];


$nombrerol =  htmlspecialchars($nombrerol);
$arbolrol =   htmlspecialchars($arbolrol);
$variedadrol =htmlspecialchars($variedadrol);
$suelorol =   htmlspecialchars($suelorol);
$enfermedadrol = htmlspecialchars($enfermedadrol);
$produccionrol = htmlspecialchars($produccionrol);
$ataquerol =  htmlspecialchars($ataquerol);
$clienterol = htmlspecialchars($clienterol);
$ventasrol =  htmlspecialchars($ventasrol);
$tratamientorol = htmlspecialchars($tratamientorol);
$podasrol =   htmlspecialchars($podasrol);
$tipopodasrol = htmlspecialchars($tipopodarol);
$floracionrol = htmlspecialchars($floracionrol);
$fertilizantesrol = htmlspecialchars($fertilizantesrol);
$fertilizacionrol = htmlspecialchars($fertilizacionrol);
$usuariosrol =  htmlspecialchars($usuariosrol);
$auditoriarol = htmlspecialchars($auditoriarol);
$rolrol =       htmlspecialchars($rolrol);


$objetorol = new rol($conexion, $idrol, $nombrerol, $arbolrol, $variedadrol, $suelorol, $enfermedadrol, $produccionrol, $ataquerol, $clienterol, $ventasrol, $tratamientorol, $podasrol, $tipopodarol, $floracionrol, $fertilizantesrol, $fertilizacionrol, $usuariosrol, $auditoriarol, $rolrol);

switch($opcion){
        case 'Ingresar';
        $objetorol->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetorol->modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetorol->eliminar();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariorol.php?msj=$mensaje");
?>
