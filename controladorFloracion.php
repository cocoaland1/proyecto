<?php
include_once("../modelo/conexion.php");
$objetoConexion = new conexion();
$conexion = $objetoConexion->conectar();

include_once("../modelo/Floracion.php");

$opcion                    = $_POST["fEnviar"];
$IdFloracion               = $_POST["fIdFloracion"];
$CantidadFloresFruto       = $_POST["fCantidadFloresFruto"];
$FechaFloracion            = $_POST["fFechaFloracion"];
$IdArbolFloracion          = $_POST["fIdArbolFloracion"];



$CantidadFloresFruto= htmlspecialchars($CantidadFloresFruto );
$FechaFloracion   = htmlspecialchars($FechaFloracion );
$IdArbolFloracion = htmlspecialchars($IdArbolFloracion  );


$objetoFloracion   = new Floracion  ($conexion, $IdFloracion , $CantidadFloresFruto , $FechaFloracion ,  $IdArbolFloracion);

switch($opcion){
        case 'Ingresar';
        $objetoFloracion ->ingresar();
        $mensaje = "Ingresado";
        break;
        
        case 'Modificar';
        $objetoFloracion -> modificar();
        $mensaje = "Modificado";
        break;
        
        case 'Eliminar';
        $objetoFloracion ->eliminar ();
        $mensaje = "Eliminado";
        break;
}

$objetoConexion->desconectar($conexion);
header("location:../vista/formularioFloracion.php?msj=$mensaje");
?>
