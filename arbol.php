<?php
class arbol{
    
    private $_conexion;
    private $_idarbol;
    private $_alturaarbol;
    private $_fechasiembra;
    private $_msnmarbol;
    private $_idSueloarbol;
    private $_idVariedadarbol;
    private $_ubicacionarbol;
    private $_paginacion = 10;
    
    function __construct($conexion, $idarbol, $alturaarbol, $fechasiembra, $msnmarbol, $idSueloarbol, $idvariedadarbol, $ubicacionarbol){
        $this->_conexion = $conexion;
        $this->_idarbol = $idarbol;
        $this->_alturaarbol = $alturaarbol;
        $this->_fechasiembra = $fechasiembra;
        $this->_msnmarbol = $msnmarbol;
        $this->_idSueloarbol = $idSueloarbol;
        $this->_idVariedadarbol = $idvariedadarbol;
        $this->_ubicacionarbol = $ubicacionarbol;

    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function insertar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO arbol (idarbol,alturaarbol,fechasiembra,msnmarbol,idSueloarbol,idvariedadarbol,ubicacionarbol) VALUES (NULL,'$this->_alturaarbol','$this->_fechasiembra','$this->_msnmarbol','$this->_idSueloarbol','$this->_idVariedadarbol',ST_GeomFromText('$this->_ubicacionarbol'))") or die (mysqli_error ($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    
    $modificacion = mysqli_query($this->_conexion,"UPDATE arbol SET alturaarbol='$this->_alturaarbol',fechasiembra='$this->_fechasiembra',msnmarbol='$this->_msnmarbol',idSueloarbol='$this->_idSueloarbol',idvariedadarbol='$this->_idVariedadarbol',ubicacionarbol=ST_GeomFromText('$this->_ubicacionarbol') WHERE idarbol='$this->_idarbol'") or die (mysqli_error ($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM arbol WHERE idArbol=$this->_idarbol");
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $eliminacion;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idarbol)/$this->_paginacion)AS cantidad FROM arbol") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT IdArbol,AlturaArbol,FechaSiembra,MsnmArbol,IdSueloArbol,IdVariedadArbol,  ST_AsText(ubicacionarbol) As UbicacionArbol FROM arbol ORDER BY idarbol") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT IdArbol,AlturaArbol,FechaSiembra,MsnmArbol,IdSueloArbol,IdVariedadArbol,  ST_AsText(ubicacionarbol) As UbicacionArbol FROM arbol ORDER BY idarbol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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







