<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Poda.php");

$opcion               = $_POST["fEnviar"];
$IdPoda              = $_POST["fIdPoda"];
$FechaPoda            = $_POST["fFechaPoda"];
$IdTiposPoda          = $_POST["fIdTiposPoda"];
$IdArbolPoda          = $_POST["fIdArbolPoda"];


$FechaPoda=htmlspecialchars ($FechaPoda );
$IdTiposPoda=htmlspecialchars ($IdTiposPoda);
$IdArbolPoda=htmlspecialchars ($IdArbolPoda);
     



$objetoPoda = new Podas  ($conexion, $IdPoda , $FechaPoda, $IdTiposPoda, $IdArbolPoda);

switch($opcion){
        case 'Ingresar';
        $objetoPoda ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoPoda  -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoPoda  ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioPoda.php?msj=$mensaje");
?>