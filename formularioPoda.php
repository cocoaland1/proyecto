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
        $formulario = 'poda';
          include_once("menu.php");
         
        ?>
        </header>
       <div class="container-fluid">
        <h1>Formulario Poda</h1>
       <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    
                    <th scope="col">FechaPoda</th>
                    <th scope="col">IdTiposPoda</th>
                    <th scope="col">IdArbolPoda</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/TiposPoda.php");
        $objetoTiposPoda = new TiposPoda($conexion,0,'IdTiposPoda','DescripcionTipoPoda');      
        $listaTiposPoda= $objetoTiposPoda->listar(0);
                
        include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/Poda.php");
        $objetoPoda =new Podas($conexion,0,'IdPoda','FechaPoda','IdTiposPoda','IdArbolPoda');
                
        $listaPoda=$objetoPoda->listar(0);
        while($unRegistro = mysqli_fetch_array($listaPoda)){
            
                echo '<tr><form id="fModificarPoda"'.$unRegistro["IdPoda"].' action="../controlador/controladorPoda.php"method="post">';
                echo '<input    type="hidden"    name="fIdPoda"               value="'.$unRegistro['IdPoda'].'">';
                echo '<td><input        type="date"  class="form-control"     name="fFechaPoda"             value="'.$unRegistro['FechaPoda'].'"></td>';
            
                echo '<td><select   class="form-control"  name="fIdTiposPoda">';
                while($registrotipospoda = mysqli_fetch_array($listaTiposPoda)){
                echo '<option value="'.$registrotipospoda['IdTiposPoda'].'"';
                if($unRegistro['IdTiposPoda']==$registrotipospoda['IdTiposPoda']){
                echo " selected ";
            }
             echo '>'.$registrotipospoda['DescripcionTipoPoda'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaTiposPoda,0);
            
                echo '<td><select class="form-control"    name="fIdArbolPoda">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['IdArbol'].'"';
                if($unRegistro['IdArbolPoda']==$registroarbol['IdArbol']){
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
                
            <tr><form id="fIngresarPoda" action="../controlador/controladorPoda.php" method="post">
                <td><input  type="hidden" class="form-control" name="fIdPoda" value="0">
                    <input      type="date"  class="form-control"  name="fFechaPoda"></td>
                
                <td><select   class="form-control" name="fIdTiposPoda">
                    <?php
                while($tipospodaRegistro=mysqli_fetch_array($listaTiposPoda)){
                   echo '<option value="'.$tipospodaRegistro['IdTiposPoda'].'">'.$tipospodaRegistro['DescripcionTipoPoda'].'</option>';
                }
                ?>
                </select></td>
                
                <td><select   class="form-control" name="fIdArbolPoda">
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
$cantPaginas=$objetoPoda->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariopoda.php?pag=' .$i. '</a></li>';
     }
}
if ($pagina<$cantPagina){ //moatrar el de ir adelante cuando no sea la ultima pagina
echo '<li><a heref="#" aria-label="siguiente"><span aria-hidden="true">&raquo;</spana></a></li>';

     }
}
?>
</ul></nav>
        <?php
        mysqli_free_result($listaPoda);
        mysqli_free_result($listaTiposPoda);
        mysqli_free_result($listaarboles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  

