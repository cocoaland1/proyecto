<?php
class Tratamiento{
    
    private $_conexion;
    private $_IdTratamiento;
    private $_FechaTratamiento;
    private $_DescripcionTratamiento;
    private $_IdAtaqueTratamiento;
    private $_paginacion = 10;
    
    function __construct($conexion, $IdTratamiento, $FechaTratamiento, $DescripcionTratamiento, $IdAtaqueTratamiento){
        
        
        $this->_conexion = $conexion;
        $this->_IdTratamiento = $IdTratamiento;
        $this->_FechaTratamiento = $FechaTratamiento;
        $this->_DescripcionTratamiento = $DescripcionTratamiento;
        $this->_IdAtaqueTratamiento = $IdAtaqueTratamiento;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Tratamiento (IdTratamiento,FechaTratamiento,DescripcionTratamiento,IdAtaqueTratamiento)VALUES (NULL,'$this->_FechaTratamiento','$this->_DescripcionTratamiento','$this->_IdAtaqueTratamiento')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Tratamiento SET FechaTratamiento='$this->_FechaTratamiento',DescripcionTratamiento='$this->_DescripcionTratamiento',IdAtaqueTratamiento='$this->_IdAtaqueTratamiento' WHERE IdTratamiento='$this->_IdTratamiento'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Tratamiento WHERE IdTratamiento=$this->_IdTratamiento")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdTratamiento)/$this->_paginacion)AS cantidad FROM Tratamiento") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Tratamiento ORDER BY IdTratamiento") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Tratamiento ORDER BY IdTratamiento LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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
