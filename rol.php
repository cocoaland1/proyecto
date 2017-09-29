<?php
class rol{
    
    private $_conexion;
    private $_idrol;
    private $_nombrerol;
    private $_arbolrol;
    private $_variedadrol;
    private $_suelorol;
    private $_enfermedadrol;
    private $_produccionrol;
    private $_ataquerol;
    private $_clienterol;
    private $_ventasrol;
    private $_tratamientorol;
    private $_podasrol;
    private $_tipopodarol;
    private $_floracionrol;
    private $_fertilizantesrol;
    private $_fertilizacion;
    private $_usuariosrol;
    private $_auditoriarol;
    private $_rolrol;
    private $_paginacion = 10;
    
    function __construct($conexion, $idrol, $nombrerol, $arbolrol, $variedadrol, $suelorol, $enfermedadrol, $produccionrol, $ataquerol, $clienterol, $ventasrol, $tratamientorol, $podasrol, $tipopodarol, $floracionrol, $fertilizantesrol, $fertilizacionrol, $usuariosrol, $auditoriarol, $rolrol){
        
    $this->_conexion = $conexion;
    $this->_idrol = $idrol;
    $this->_nombrerol = $nombrerol;
    $this->_arbolrol = $arbolrol;
    $this->_variedadrol = $variedadrol;
    $this->_suelorol = $suelorol;
    $this->_enfermedadrol = $enfermedadrol;
    $this->_produccionrol = $produccionrol;
    $this->_ataquerol = $ataquerol;
    $this->_clienterol = $clienterol;
    $this->_ventasrol = $ventasrol;
    $this->_tratamientorol = $tratamientorol;
    $this->_podasrol = $podasrol;
    $this->_tipopodarol = $tipopodarol;
    $this->_floracionrol = $floracionrol;
    $this->_fertilizantesrol = $fertilizantesrol;
    $this->_fertilizacionrol = $fertilizacionrol;
    $this->_usuariosrol = $usuariosrol;
    $this->_auditoriarol = $auditoriarol;
    $this->_rolrol = $rolrol;
    
}
function __get($k){
    return $this->$k;
}

function __set($k,$v){
    
    $this->$k =$v;
}

function ingresar (){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO rol (idrol,nombrerol,arbolrol,variedadrol,suelorol,enfermedadrol,produccionrol,ataquerol,clienterol,ventasrol,tratamientorol,podasrol,tipopodarol,floracionrol,fertilizantesrol,fertilizacionrol,usuariosrol,auditoriarol,rolrol)VALUES (NULL,'$this->_nombrerol','$this->_arbolrol','$this->_variedadrol','$this->_suelorol','$this->_enfermedadrol','$this->_produccionrol','$this->_ataquerol','$this->_clienterol','$this->_ventasrol','$this->_tratamientorol','$this->_podasrol','$this->_tipopodarol','$this->_floracionrol','$this->_fertilizantesrol','$this->_fertilizacionrol','$this->_usuariosrol','$this->_auditoriarol','$this->_rolrol')") or die (mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE rol SET nombrerol='$this->_nombrerol',arbolrol='$this->_arbolrol',variedadrol='$this->_variedadrol',suelorol='$this->_suelorol',enfermedadrol='$this->_enfermedadrol',produccionrol='$this->_produccionrol', ataquerol='$this->_ataquerol',clienterol='$this->_clienterol',ventasrol='$this->_ventasrol',tratamientorol='$this->_tratamientorol',podasrol='$this->_podasrol',tipopodarol='$this->_tipopodarol',floracionrol='$this->_floracionrol',fertilizantesrol='$this->_fertilizantesrol',fertilizacionrol='$this->_fertilizacionrol',usuariosrol='$this->_usuariosrol',auditoriarol='$this->_auditoriarol', rolrol='$this->_rolrol' WHERE idrol=$this->_idrol")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM rol WHERE idrol=$this->_idrol");
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $insercion;
    
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(idrol)/$this->_paginacion)AS cantidad FROM rol") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY idrol") or die (mysqli_error ($this->coexion));
        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $lista = mysqli_query($this->_conexion,"SELECT * FROM rol ORDER BY idrol LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->conexion));
        
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

