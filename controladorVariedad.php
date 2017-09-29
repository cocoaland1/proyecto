<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Variedad.php");

$opcion                    = $_POST["fEnviar"];
$IdVariedad               = $_POST["fIdVariedad"];
$DescripcionVariedad     = $_POST["fDescripcionVariedad"];



$DescripcionVariedad=htmlspecialchars($DescripcionVariedad);



$objetoVariedad = new Variedad  ($conexion, $IdVariedad , $DescripcionVariedad);

switch($opcion){
        case 'Ingresar';
        $objetoVariedad ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoVariedad -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoVariedad->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioVariedad.php?msj=$mensaje");
?>
