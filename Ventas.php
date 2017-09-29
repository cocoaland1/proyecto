<?php
class Ventas{
    
    private $_conexion;
    private $_IdVentas;
    private $_NumeroFactura;
    private $_KilosVenta;
    private $_FechaVenta;
    private $_IdClientesVenta;
    private $_paginacion = 10;
    
    function __construct($conexion, $IdVentas, $NumeroFactura, $KilosVenta, $FechaVenta, $IdClientesVenta){
        
        
        $this->_conexion = $conexion;
        $this->_IdVentas= $IdVentas;
        $this->_IdClientes = $NumeroFactura;
        $this->_KilosVenta= $KilosVenta;
        $this->_FechaVenta = $FechaVenta;
        $this->_IdClientesVenta = $IdClientesVenta;
   
    }
function __get($k){
    return $this->$k;
}

function __set($k,$v){

    $this->$k =$v;
}

function Ingresar(){
    $insercion = mysqli_query($this->_conexion,"INSERT INTO Ventas (IdVentas,NumeroFactura,KilosVenta,FechaVenta,IdClientesVenta)VALUES (NULL,'$this->_NumeroFactura','$this->_KilosVenta','$this->_FechaVenta','$this->_IdClientesVenta')")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $insercion;
    
}

function modificar(){
    $modificacion = mysqli_query($this->_conexion,"UPDATE Ventas SET NumeroFactura='$this->_NumeroFactura',KilosVenta='$this->_KilosVenta',FechaVenta='$this->_FechaVenta',IdClientesVenta='$this->_IdClientesVenta' WHERE IdVentas ='$this->_IdVentas'")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Modifico ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return $modificacion;
    
}



function eliminar (){
    $eliminacion = mysqli_query($this->_conexion, "DELETE FROM Ventas  WHERE IdVentas =$this->_IdVentas ")or die(mysqli_error($this->_conexion));
    //$auditoria = mysqli_query($this->_conexion,"INSERT INTO  auditoria (idAuditoria,detalleAuditoria,idUsuarioAuditoria,fechaAuditoria) VALUES (NULL,'Inserto ".static::class.",".$_SESSION['idUsuario'].",'CURDATE()')");
    return  $eliminacion ;
    
    
  
    
}

function cantidadPaginas (){
    $cantidadBloques=mysqli_query($this->_conexion, "SELECT CEIL(COUNT(IdVentas )/$this->_paginacion)AS cantidad FROM Ventas ") or die(mysqli_error($this->_conexion));
    $unRegistro=mysqli_fetch_array($cantidadBloques);
    return $unRegistro['cantidad'];
}

function listar ($pagina){
    if ($pagina<=0){
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Ventas  ORDER BY IdVentas ") or die (mysqli_error ($this->_conexion));        
    }else{
        $paginacionMax = $pagina * $this->_paginacion;
        $paginacionMin = $paginacionMax - $this->_paginacion;
        $listado = mysqli_query($this->_conexion,"SELECT * FROM Ventas  ORDER BY IdVentas LIMIT $paginacionMin, $paginacionMax") or die (mysqli_error($this->_conexion));
        
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
