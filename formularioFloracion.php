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
        $formulario = 'floracion';
          include_once("menu.php");
         
        ?>
        </header>
       <div class="container-fluid">
        <h1>Formulario Floracion </h1>
       <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">CantidadFloresFruto</th>
                    <th scope="col">FechaFloracion</th>
                    <th scope="col">IdArbolFloracion</th>                 
                    
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/Floracion.php");
        $objetoFloracion= new Floracion($conexion,0,'IdFloracion', 'CantidadFloresFruto ','FechaFloracion','IdArbolFloracion');
        $listaFloracion= $objetoFloracion->listar(0);
                
        while($unRegistro = mysqli_fetch_array($listaFloracion)){
            
                echo '<tr><form id="fModificarFloracion"'.$unRegistro["IdFloracion"].' action="../controlador/controladorFloracion.php "method="post">';
                echo '<td><input    type="hidden"  name="fIdFloracion"                   value="'.$unRegistro['IdFloracion'].'">';
                echo '<input        type="number"  class="form-control"   name="fCantidadFloresFruto"         value="'.$unRegistro['CantidadFloresFruto'].'"></td>';
                echo '<td><input    type="date"  class="form-control" name="fFechaFloracion"                  value="'.$unRegistro['FechaFloracion'].'"></td>';
            
                echo '<td><select class="form-control"  name="fIdArbolFloracion">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['IdArbol'].'"';
                if($unRegistro['IdArbolFloracion']==$registroarbol['IdArbol']){
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
                
            <tr><form id="fIngresarFloracion" action="../controlador/controladorFloracion.php" method="post">
                <td><input  type="hidden" class="form-control" name="fIdFloracion" value="0">
                    <input  type="number"   class="form-control" name="fCantidadFloresFruto"></td>
                <td><input  type="date" class="form-control" name="fFechaFloracion"></td>
                
                <td><select class="form-control" name="fIdArbolFloracion">
                    <?php
                while($arbolRegistro=mysqli_fetch_array($listaarboles)){
                   echo '<option value="'.$arbolRegistro['IdArbol'].'">'.$arbolRegistro['AlturaArbol'].'</option>';
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
$cantPaginas=$objetoFloracion->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariofloracion.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaFloracion);
        mysqli_free_result($listaarboles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  

