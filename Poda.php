<?php
class Podas{
    
    private $_conexion;
    private $_IdPoda;
    private $_FechaPoda;
    private $_IdTiposPoda;
    private $_IdArbolPoda;
    private $_paginacion =10;
    
    function __construct($conexion, $IdPoda, $FechaPoda, $IdTiposPoda, $IdArbolPoda){
        
        
        $this->_conexion        = $conexion;
        $this->_IdPoda         = $IdPoda;
        $this->_FechaPoda       = $FechaPoda;
        $this->_IdTiposPoda     = $IdTiposPoda;
        $this->_IdArbolPoda     = $IdArbolPoda;
       
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Podas (IdPoda,FechaPoda,IdTiposPoda,IdArbolPoda )VALUES(NULL,'$this->_FechaPoda','$this->_IdTiposPoda','$this->_IdArbolPoda')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Podas SET FechaPoda='$this->_FechaPoda',IdTiposPoda='$this->_IdTiposPoda',IdArbolPoda='$this->_IdArbolPoda' WHERE IdPoda ='$this->_IdPoda'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion,"DELETE FROM Podas  WHERE IdPoda=$this->_IdPoda")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdPoda )/$this->_paginacion)AS cantidad FROM Podas") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Podas ORDER BY IdPoda") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Podas ORDER BY IdPoda LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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
