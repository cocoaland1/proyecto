<?php
class Ataques{
    
    private $_conexion;
    private $_idAtaques;
    private $_fechaAtaque;
    private $_porcentajeinfestacion;
    private $_IdEnfermedadAtaque;
     private $_idArbolAtaque;
    private $_paginacion = 10;
    
    function __construct($conexion, $idAtaques, $fechaAtaque, $porcentajeinfestacion, $IdEnfermedadAtaque, $idArbolAtaque){
        $this->_conexion = $conexion;
        $this->_idAtaques = $idAtaques;
        $this->_fechaAtaque = $fechaAtaque;
        $this->_porcentajeinfestacion = $porcentajeinfestacion;
        $this->_IdEnfermedadAtaque = $IdEnfermedadAtaque;
        $this->_idArbolAtaque = $idArbolAtaque;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO ataques (idAtaques,FechaAtaques,porcentajeinfestacion,IdEnfermedadAtaque,idArbolAtaque)VALUES (NULL,'$this->_fechaAtaque','$this->_porcentajeinfestacion','$this->_IdEnfermedadAtaque','$this->_idArbolAtaque')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE ataques SET FechaAtaques='$this->_fechaAtaque',porcentajeinfestacion='$this->_porcentajeinfestacion',IdEnfermedadAtaque='$this->_IdEnfermedadAtaque',idArbolAtaque='$this->_idArbolAtaque' WHERE idAtaques='$this->_idAtaques'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM ataques WHERE idAtaques=$this->_idAtaques")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idAtaques)/$this->_paginacion)AS cantidad FROM ataques") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM ataques ORDER BY idAtaques") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM ataques ORDER BY idAtaques LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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



