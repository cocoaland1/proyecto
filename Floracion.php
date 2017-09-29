<?php
class Floracion {
    
    private $_conexion;
    private $_IdFloracion;
    private $_CantidadFloresFruto;
    private $_FechaFloracion;
    private $_IdArbolFloracion;
    private $_paginacion = 10;

    function __construct($conexion, $IdFloracion, $CantidadFloresFruto, $FechaFloracion, $IdArbolFloracion){
        
        
        $this->_conexion = $conexion;
        $this->_IdFloracion         = $IdFloracion;
        $this->_CantidadFloresFruto      = $CantidadFloresFruto;
        $this->_FechaFloracion      = $FechaFloracion;
        $this->_IdArbolFloracion     = $IdArbolFloracion;
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Floracion (IdFloracion,CantidadFloresFruto  ,FechaFloracion  ,IdArbolFloracion )VALUES (NULL,'$this->_CantidadFloresFruto ','$this->_FechaFloracion ','$this->_IdArbolFloracion')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Floracion SET CantidadFloresFruto='$this->_CantidadFloresFruto',FechaFloracion='$this->_FechaFloracion    ',IdArbolFloracion='$this->_IdArbolFloracion' WHERE IdFloracion ='$this->_IdFloracion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Floracion WHERE IdFloracion =$this->_IdFloracion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdFloracion )/$this->_paginacion)AS cantidad FROM Floracion ") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Floracion  ORDER BY IdFloracion ") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Floracion ORDER BY IdFloracion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
    }
    return $listado;
}
    function getPermiso($idUsuario){
        $permisos=mysqli_query($this->conexion,"SELECT".static::class."rol AS elPermiso  FROM roles WHERE idRol IN(SELECT idRolUsuario FROM Usuario WHERE idUsuario = $idUsuario"); 
        $unRegistro=$cantidadBloques->mysqli_fetch_array($permisos);
        return $unRegistro["elPermiso"];
    }
}
?>

