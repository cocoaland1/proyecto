<?php
class Usuario{
    
    private $_conexion;
    private $_idusuario;
    private $_nombreusuario;
    private $_emailusuario;
    private $_claveusuario;
    private $_fecharegistrousuario;
    private $_fechaultimaclaveusuario;
    private $_idrolusuario;
    private $_paginacion = 10;
    
    function __construct($conexion, $idusuario, $nombreusuario, $emailusuario, $claveusuario, $fecharegistrousuario, $fechaultimaclaveusuario, $idrolusuario){
        $this->_conexion = $conexion;
        $this->_idusuario = $idusuario;
        $this->_nombreusuario = $nombreusuario;
        $this->_emailusuario = $emailusuario;
        $this->_claveusuario = $claveusuario;
        $this->_fecharegistrousuario = $fecharegistrousuario;
        $this->_fechaultimaclaveusuario = $fechaultimaclaveusuario;
        $this->_idrolusuario = $idrolusuario;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO usuario (idusuario, nombreusuario, emailusuario, claveusuario, fecharegistrousuario, fechaultimaclaveusuario, idrolusuario) VALUES (NULL,'$this->_nombreusuario', '$this->_emailusuario', '".hash('sha256', $this->_claveusuario)."', '$this->_fecharegistrousuario', '$this->_fechaultimaclaveusuario', '$this->_idrolusuario')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE usuario SET nombreusuario='$this->_nombreusuario',emailusuario='$this->_emailusuario',claveusuario='".hash('sha256', $this->_claveusuario)."',fecharegistrousuario='$this->_fecharegistrousuario',fechaultimaclaveusuario='$this->_fechaultimaclaveusuario',idrolusuario='$this->_idrolusuario' WHERE idusuario='$this->_idusuario'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM usuario WHERE idusuario=$this->_idusuario")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idusuario)/$this->_paginacion)AS cantidad FROM usuario") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM usuario ORDER BY idusuario LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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



