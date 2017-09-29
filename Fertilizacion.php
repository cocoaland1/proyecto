<?php
class Fertilizacion{
    
    private $_conexion;
    private $_IdFertilizacion;
    private $_FechaFertilizacion;
    private $_CantidadFertilizante;
    private $_IdFertilizanteFertilizacion;
    private $_IdArbolFertilizacion;
    private $_paginacion = 10;
    
    function __construct($conexion, $IdFertilizacion, $FechaFertilizacion,  $CantidadFertilizante, $IdFertilizanteFertilizacion, $IdArbolFertilizacion){
        
        
        $this->_conexion = $conexion;
        $this->_IdFertilizacion          = $IdFertilizacion;
        $this->_FechaFertilizacion       = $FechaFertilizacion;
        $this->_CantidadFertilizante     = $CantidadFertilizante;
        $this->_IdFertilizanteFertilizacion   = $IdFertilizanteFertilizacion;
        $this->_IdArbolFertilizacion        = $IdArbolFertilizacion;
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Fertilizacion (IdFertilizacion,FechaFertilizacion  ,CantidadFertilizante,IdFertilizanteFertilizacion,IdArbolFertilizacion )VALUES (NULL,'$this->_FechaFertilizacion','$this->_CantidadFertilizante','$this->_IdFertilizanteFertilizacion','$this->_IdArbolFertilizacion')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Fertilizacion SET FechaFertilizacion='$this->_FechaFertilizacion',CantidadFertilizante='$this->_CantidadFertilizante',IdFertilizanteFertilizacion='$this->_IdFertilizanteFertilizacion', IdArbolFertilizacion='$this->_IdArbolFertilizacion' WHERE IdFertilizacion ='$this->_IdFertilizacion '")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Fertilizacion  WHERE IdFertilizacion =$this->_IdFertilizacion ")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdFertilizacion )/$this->_paginacion)AS cantidad FROM Fertilizacion ") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Fertilizacion  ORDER BY IdFertilizacion ") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Produccion ORDER BY IdFertilizacion  LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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

