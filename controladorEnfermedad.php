<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Enfermedad.php");

$opcion                    = $_POST["fEnviar"];
$IdEnfermedad              = $_POST["fIdEnfermedad"];
$DescripcionEnfermedad     = $_POST["fDescripcionEnfermedad"];



$DescripcionEnfermedad=htmlspecialchars($DescripcionEnfermedad );



$objetoEnfermedad= new Enfermedad  ($conexion, $IdEnfermedad , $DescripcionEnfermedad);

switch($opcion){
        case 'Ingresar';
        $objetoEnfermedad ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoEnfermedad -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoEnfermedad ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioEnfermedad.php?msj=$mensaje");
?>
