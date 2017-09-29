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
        $formulario = 'produccion';
          include_once("menu.php");
         
        ?>
        </header>
        <div class="container-fluid">
        <h1>Formulario Produccion</h1>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">FechaProduccion</th>
                    <th scope="col">KilosPepaProduccion</th>
                    <th scope="col">LitrosBabaProduccion</th>
                    <th scope="col">KilosCascaraProduccion</th>
                    <th scope="col">IdArbolProduccion</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/Produccion.php");
        $objetoProduccion = new Produccion($conexion,0,'IdProduccion', 'FechaProduccion','KilosPepaProduccion','LitrosBabaProduccion','KilosCascaraProduccion','IdArbolProduccion');
        $listaProduccion= $objetoProduccion->listar(0);
        while($unRegistro = mysqli_fetch_array($listaProduccion)){
            
                echo '<tr><form id="fModificarProduccion"'.$unRegistro["IdProduccion"].' action="../controlador/controladorProduccion.php "method="post">';
                echo '<td><input    type="hidden"  name="fIdProduccion"               value="'.$unRegistro['IdProduccion'].'">';
                echo '<input        type="Date"   class="form-control"  name="fFechaProduccion"            value="'.$unRegistro['FechaProduccion'].'"></td>';
                echo '<td><input    type="number" class="form-control"  name="fKilosPepaProduccion"      value="'.$unRegistro['KilosPepaProduccion'].'"></td>';
                echo '<td><input    type="number" class="form-control"  name="fLitrosBabaProduccion"      value="'.$unRegistro['LitrosBabaProduccion'].'"></td>'; 
                echo '<td><input    type="number" class="form-control"  name="fKilosCascaraProduccion"      value="'.$unRegistro['KilosCascaraProduccion'].'"></td>';
            
                echo '<td><select  class="form-control" name="fIdArbolProduccion">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['IdArbol'].'"';
                if($unRegistro['IdArbolProduccion']==$registroarbol['IdArbol']){
                echo " selected ";
            }
             echo '>'.$registroarbol['AlturaArbol'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaarboles,0);
            
                 echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarProduccion" action="../controlador/controladorProduccion.php" method="post">
                <td><input  type="hidden" class="form-control" name="fIdProduccion" value="0">
                    <input  type="Date"   class="form-control" name="fFechaProduccion"></td>
                <td><input  type="number" class="form-control" name="fKilosPepaProduccion"></td>
                <td><input  type="number" class="form-control" name="fLitrosBabaProduccion"></td>
                <td><input  type="number" class="form-control" name="fKilosCascaraProduccion"></td>
                
                <td><select class="form-control" name="fIdArbolProduccion">
                    <?php 
             while($registroarbol = mysqli_fetch_array($listaarboles)){
                 echo '<option value="'.$registroarbol['IdArbol'].'">'.$registroarbol['AlturaArbol'].'</option>';
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
$cantPaginas=$objetoProduccion->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioproduccion.php?pag=' .$i. '</a></li>';
     }
}
if ($pagina<$cantPagina){ //moatrar el de ir adelante cuando no sea la ultima pagina
echo '<li><a heref="#" aria-label="siguiente"><span aria-hidden="true">&raquo;</spana></a></li>';

     }
}
?>
</ul></nav>
        </div>
        <?php
        mysqli_free_result($listaProduccion);
        mysqli_free_result($listaarboles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  