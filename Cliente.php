<?php
class Cliente {
    
    private $_conexion;
    private $_IdCliente;
    private $_NombreCliente;
    private $_CelularCliente;
    private $_DireccionCliente;
    private $_paginacion = 10;

    function __construct($conexion, $IdCliente, $NombreCliente, $CelularCliente, $DireccionCliente){
        
        
        $this->_conexion = $conexion;
        $this->_IdCliente         = $IdCliente;
        $this->_NombreCliente      = $NombreCliente;
        $this->_CelularCliente      = $CelularCliente;
        $this->_DireccionCliente    = $DireccionCliente;
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Cliente (IdCliente,NombreCliente,CelularCliente,DireccionCliente)VALUES (NULL,'$this->_NombreCliente','$this->_CelularCliente','$this->_DireccionCliente')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    
    $modificacion = mysqli_query($this->_conexion,"UPDATE Cliente SET NombreCliente='$this->_NombreCliente',CelularCliente='$this->_CelularCliente',DireccionCliente='$this->_DireccionCliente' WHERE IdCliente='$this->_IdCliente'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Cliente WHERE IdCliente=$this->_IdCliente")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdCliente)/$this->_paginacion)AS cantidad FROM Cliente") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Cliente  ORDER BY IdCliente ") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Cliente ORDER BY IdCliente LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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

