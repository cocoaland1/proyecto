<?php
class Produccion{
    
    private $_conexion;
    private $_IdProduccion;
    private $_FechaProduccion;
    private $_KilosPepaProduccion;
    private $_LitrosBabaProduccion;
    private $_KilosCascaraProduccion;
    private $_IdArbolProduccion;
    private $_paginacion = 10;
    
    function __construct($conexion, $IdProduccion, $FechaProduccion, $KilosPepaProduccion, $LitrosBabaProduccion, $KilosCascaraProduccion, $IdArbolProduccion){
        
        
        $this->_conexion = $conexion;
        $this->_IdProduccion = $IdProduccion;
        $this->_FechaProduccion = $FechaProduccion;
        $this->_KilosPepaProduccion = $KilosPepaProduccion;
        $this->_LitrosBabaProduccion = $LitrosBabaProduccion;
        $this->_KilosCascaraproduccion = $KilosCascaraProduccion;
        $this->_IdArbolProduccion = $IdArbolProduccion;
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Produccion (IdProduccion,FechaProduccion,KilosPepaProduccion,LitrosBabaProduccion,KilosCascaraProduccion,IdArbolProduccion)VALUES (NULL,'$this->_FechaProduccion','$this->_KilosPepaProduccion','$this->_LitrosBabaProduccion','$this->_KilosCascaraProduccion','$this->_IdArbolProduccion')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Produccion SET FechaProduccion='$this->_FechaProduccion',KilosPepaProduccion='$this->_KilosPepaProduccion',LitrosBabaProduccion='$this->_LitrosBabaProduccion',KilosCascaraProduccion='$this->_KilosCascaraProduccion', IdArbolProduccion='$this->_IdArbolProduccion' WHERE idProduccion='$this->_IdProduccion'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Produccion WHERE IdProduccion=$this->_IdProduccion")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdProduccion)/$this->_paginacion)AS cantidad FROM Produccion") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Produccion ORDER BY IdProduccion") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Produccion ORDER BY IdProduccion LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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



