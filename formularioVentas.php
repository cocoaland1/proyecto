<?php
session_start();
if (isset($_SESSION['id'])){
    
?>
<!DOCTYPE thml>
<html>
  <head>
      <meta charset="utf-8">
      <title>cocoaland</title>
       <link rel="stylesheet" href="css/bootstrap.min.css">
       <link rel="stylesheet" href="css/font-awesome.css">
      <script src="js/jquery-3.1.1.slim.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
<header>
   <?php
        $formulario = 'ventas';
          include_once("menu.php");
         
        ?>
        </header>
        <div class="container-fluid">
        <h1>Formulario Ventas</h1><br>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">NumeroFactura</th>
                    <th scope="col">KilosVenta</th>
                    <th scope="col">FechaVenta</th>
                    <th scope="col">IdClientesVenta</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
                
        include_once("../modelo/Cliente.php");
        $objetoCliente= new Cliente($conexion,0,'IdCliente', 'NombreCliente','CelularCliente','DireccionCliente');
        $listaCliente= $objetoCliente->listar(0);
                
                
        include_once("../modelo/Ventas.php");
        $objetoVentas = new Ventas($conexion,0,'IdVentas', 'NumeroFactura','KilosVenta','FechaVenta','IdClientesVenta');
        $listaVentas= $objetoVentas->listar(0);
        while($unRegistro = mysqli_fetch_array($listaVentas)){
            
                echo '<tr><form id="fModificarVentas"'.$unRegistro["IdVentas"].' action="../controlador/controladorVentas.php" method="post">';
                echo '<td><input  type="hidden"    name="fIdVentas"              value="'.$unRegistro['IdVentas'].'">';
                echo '<input      type="number"   class="form-control"  name="fNumeroFactura"            value="'.$unRegistro['NumeroFactura'].'"></td>';
                echo '<td><input  type="number"  class="form-control"   name="fKilosVenta"  value="'.$unRegistro['KilosVenta'].'"></td>';
                echo '<td><input  type="date"    class="form-control"   name="fFechaVenta"     value="'.$unRegistro['FechaVenta'].'"></td>'; 
            
            
             echo '<td><select class="form-control"  name="fIdClientesVenta">';
                while($registroCliente= mysqli_fetch_array($listaCliente)){
                echo '<option value="'.$registroCliente['IdCliente'].'"';
                if($unRegistro['IdClientesVenta']==$registroCliente['IdCliente']){
                echo " selected ";
            }
             echo '>'.$registroCliente['NombreCliente'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaCliente,0);
            
            
               echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarVentas" action="../controlador/controladorVentas.php" method="post">
                <td><input  type="hidden"  class="form-control" name="fIdVentas" value="0">
                <input      type="number"   class="form-control"  name="fNumeroFactura"></td>
                <td><input  type="number"    class="form-control" name="fKilosVenta"></td>
                <td><input  type="date"  class="form-control" name="fFechaVenta"></td>
                
                
                <td><select class="form-control" name="fIdClientesVenta">
                   <?php
                while($ClientesRegistro=mysqli_fetch_array($listaCliente)){
                   echo '<option value="'.$ClientesRegistro['IdCliente'].'">'.$ClientesRegistro['NombreCliente'].'</option>';
                }
                ?>
                </select></td>
                
                
                <td><button  type="submit" class="btn btn-primary" name= "fEnviar" value="Ingresar"><i class="fa fa-clone" aria-hidden="true"></i></button> 
                <button type="reset"   class="btn btn-warning" name="fEnviar" value="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i></button> </button></td>
                </form></tr>   
            </tbody>
        </table>
 <nav><ul class="pagination">
<?php
$cantPaginas=$objetoVentas->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioventas.php?pag=' .$i. '</a></li>';
     }
}
if ($pagina<$cantPagina){ //moatrar el de ir adelante cuando no sea la ultima pagina
echo '<li><a heref="#" aria-label="siguiente"><span aria-hidden="true">&raquo;</span></a></li>';

     }
}
?>
</ul></nav>
</div>
        <?php
        mysqli_free_result($listaVentas);
        mysqli_free_result($listaCliente);
        //$objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
?>  