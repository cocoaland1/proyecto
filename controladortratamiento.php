<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Tratamiento.php");

$opcion           = $_POST["fEnviar"];
$IdTratamiento       = $_POST["fIdTratamiento"];
$FechaTratamiento      = $_POST["fFechaTratamiento"];
$DescripcionTratamiento    = $_POST["fDescripcionTratamiento"];
$IdAtaqueTratamiento   = $_POST["fIdAtaqueTratamiento"];


$FechaTratamiento  = htmlspecialchars($FechaTratamiento );
$DescripcionTratamiento  = htmlspecialchars($DescripcionTratamiento );
$IdAtaqueTratamiento = htmlspecialchars($IdAtaqueTratamiento);



$objetoTratamiento = new Tratamiento($conexion, $IdTratamiento, $FechaTratamiento, $DescripcionTratamiento,  $IdAtaqueTratamiento);

switch($opcion){
        case 'Ingresar';
        $objetoTratamiento->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoTratamiento-> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoTratamiento->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formulariotratamiento.php?msj=$mensaje");
?>
