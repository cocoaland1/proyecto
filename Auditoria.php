<?php
class Auditoria {
    
    private $_conexion;
    private $_IdAuditoria;
    private $_FechaAuditoria;
    private $_DescripcionAuditoria;
    private $_IdUsuarioAuditoria;
    private $_paginacion = 10;

    function __construct($conexion, $IdAuditoria, $FechaAuditoria, $DescripcionAuditoria, $IdUsuarioAuditoria){
        
        
        $this->_conexion                  = $conexion;
        $this->_IdAuditoria               = $IdAuditoria;
        $this->_FechaAuditoria            = $FechaAuditoria;
        $this->_DescripcionAuditoria      = $DescripcionAuditoria;
        $this->_IdUsuarioAuditoria        = $IdUsuarioAuditoria;
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Auditoria (IdAuditoria,FechaAuditoria,DescripcionAuditoria,IdUsuarioAuditoria)VALUES (NULL,'$this->_FechaAuditoria','$this->_DescripcionAuditoria ','$this->_IdUsuarioAuditoria')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Auditoria SET FechaAuditoria='$this->_FechaAuditoria',DescripcionAuditoria='$this->_DescripcionAuditoria',IdUsuarioAuditoria='$this->_IdUsuarioAuditoria' WHERE IdAuditoria ='$this->_IdAuditoria'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Auditoria WHERE IdAuditoria =$this->_IdAuditoria")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdAuditoria )/$this->_paginacion)AS cantidad FROM Auditoria ") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Auditoria  ORDER BY IdAuditoria ") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Auditoria ORDER BY IdAuditoria LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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

