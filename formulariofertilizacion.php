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
        $formulario = 'fertilizacion';
          include_once("menu.php");
         
        ?>
        </header>
       <div class="container-fluid">
        <h1>Formulario Fertilizacion </h1>
       <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">FechaFertilizacion </th>
                    <th scope="col">CantidadFertilizante</th>                 
                    <th scope="col">IdFertilizanteFertilizacion</th>
                    <th scope="col">IdArbolFertilizacion</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/Fertilizante.php");
        $objetoFertilizante = new Fertilizante($conexion,0,'IdFertilizante','DescripcionFertilizante');      
        $listaFertilizante= $objetoFertilizante->listar(0);
                
        include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/Fertilizacion.php");
        $objetoFertilizacion = new Fertilizacion($conexion,0,'IdFertilizacion', 'FechaFertilizacion ','CantidadFertilizante','IdFertilizanteFertilizacion','IdArbolFertilizacion');
                
        $listaFertilizacion= $objetoFertilizacion->listar(0);
        while($unRegistro = mysqli_fetch_array($listaFertilizacion)){
            
                echo '<tr><form id="fModificarFertilizacion"'.$unRegistro["IdFertilizacion"].' action="../controlador/controladorFertilizacion.php "method="post">';
                echo '<td><input    type="hidden"  name="fIdFertilizacion"                   value="'.$unRegistro['IdFertilizacion'].'">';
                echo '<input        type="Date"   class="form-control"  name="fFechaFertilizacion"                value="'.$unRegistro['FechaFertilizacion'].'"></td>';
                echo '<td><input    type="number" class="form-control"  name="fCantidadFertilizante"               value="'.$unRegistro['CantidadFertilizante'].'"></td>';
            
                echo '<td><select class="form-control"  name="fIdFertilizanteFertilizacion">';
                while($registrofertilizante = mysqli_fetch_array($listaFertilizante)){
                echo '<option value="'.$registrofertilizante['IdFertilizante'].'"';
                if($unRegistro['IdFertilizanteFertilizacion']==$registrofertilizante['IdFertilizante']){
                echo " selected ";
            }
             echo '>'.$registrofertilizante['DescripcionFertilizante'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaFertilizante,0);
            
                echo '<td><select class="form-control"  name="fIdArbolFertilizacion">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['IdArbol'].'"';
                if($unRegistro['IdArbolFertilizacion']==$registroarbol['IdArbol']){
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
                
            <tr><form id="fIngresarFertilizacion" action="../controlador/controladorFertilizacion.php" method="post">
                <td><input  type="hidden" class="form-control" name="fIdFertilizacion" value="0">
                    <input  type="Date"   class="form-control" name="fFechaFertilizacion"></td>
                <td><input  type="number" class="form-control" name="fCantidadFertilizante"></td>
                
                <td><select class="form-control" name="fIdFertilizanteFertilizacion">
                    <?php
                while($fertilizanteRegistro=mysqli_fetch_array($listaFertilizante)){
                   echo '<option value="'.$fertilizanteRegistro['IdFertilizante'].'">'.$fertilizanteRegistro['DescripcionFertilizante'].'</option>';
                }
                ?>
                </select></td>
                
                <td><select class="form-control" name="fIdArbolFertilizacion">
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
$cantPaginas=$objetoFertilizacion->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariofertilizacion.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaFertilizacion);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  

