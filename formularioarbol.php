<?php
session_start();
if (isset($_SESSION['id'])){
    
?>
<!DOCTYPE html>
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
           $formulario = 'arbol';
           include_once("menu.php");
        ?>
        </header>
        
        
         <div class="container-fluid">
        <h1>Formulario Arbol</h1>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">alturaarbol</th>
                    <th scope="col">fechasiembra</th>
                    <th scope="col">msnmarbol</th>
                    <th scope="col">idsueloarbol</th>
                    <th scope="col">idvariedadarbol</th>
                    <th scope="col">ubicacionarbol</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/Suelo.php");
        $objetoSuelo = new Suelo($conexion,0,'IdSuelo','DescripcionSuelo');      
        $listaSuelo= $objetoSuelo->listar(0);
                
        include_once("../modelo/Variedad.php");
        $objetoVariedad= new Variedad($conexion,0,'IdVariedad','DescripcionVariedad');
        $listaVariedad= $objetoVariedad->listar(0);
                
        include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
        while($unRegistro = mysqli_fetch_array($listaarboles)){
                echo '<tr><form id="fModificarArbol"'.$unRegistro["IdArbol"].' action="../controlador/controladorarbol.php "method="post">';
                echo  '<td><input type="hidden"  name="fidarbol"       value="'.$unRegistro['IdArbol'].'">';
                echo '     <input type="number" class="form-control" name="falturaarbol"   value="'.$unRegistro['AlturaArbol'].'"></td>';
                echo '<td><input type="date"   class="form-control" name="fFechasiembra"  value="'.$unRegistro['FechaSiembra'].'"></td>';
                echo '<td><input type="number"  class="form-control" name="fmsnmarbol"     value="'.$unRegistro['MsnmArbol'].'"></td>';
            
                echo '<td><select  name="fidSueloarbol" class="form-control">';
                while($registroSuelo = mysqli_fetch_array($listaSuelo)){
                echo '<option value="'.$registroSuelo['IdSuelo'].'"';
                if($unRegistro['IdSueloArbol']==$registroSuelo['IdSuelo']){
                echo " selected ";
            }
             echo '>'.$registroSuelo['DescripcionSuelo'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaSuelo,0);
            
                echo '<td><select name="fIdVariedadArbol" class="form-control">';
                while($registroVariedad = mysqli_fetch_array($listaVariedad)){
                echo '<option value="'.$registroVariedad['IdVariedad'].'"';
                if($unRegistro['IdVariedadArbol']==$registroVariedad['IdVariedad']){
                echo " selected ";
            }
             echo '>'.$registroVariedad['DescripcionVariedad'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaVariedad,0);
            
            
                 echo '<td><input type="text" class="form-control" name="fubicacionarbol" value="'.$unRegistro['UbicacionArbol'].'"></td>';
            
                    
                 echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                    echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarArbol" action="../controlador/controladorarbol.php" method="post">
                <td><input type="hidden" class="form-control"name="fidarbol" value="0">
                    <input type="number" class="form-control"name="falturaarbol"></td>
                <td><input type="date" class="form-control" name="fFechasiembra"></td>
                <td><input type="number" class="form-control" name="fmsnmarbol"></td>
                
                <td><select class="form-control" name="fidSueloarbol">
                   <?php 
             while($registroSuelo = mysqli_fetch_array($listaSuelo)){
                 echo '<option value="'.$registroSuelo['IdSuelo'].'">'.$registroSuelo['DescripcionSuelo'].'</option>';
             }
            ?>
            </select></td> 
                
                <td><select class="form-control" name="fIdVariedadArbol">
                   <?php
                while($variedadRegistro=mysqli_fetch_array($listaVariedad)){
                   echo '<option value="'.$variedadRegistro['IdVariedad'].'">'.$variedadRegistro['DescripcionVariedad'].'</option>';
                }
                ?>
                </select></td>
                    
                <td><input type="text" class="form-control" name="fubicacionarbol"></td>
                
                <td><button  type="submit" class="btn btn-primary" name= "fEnviar" value="Ingresar"><i class="fa fa-clone" aria-hidden="true"></i></button> 
                <button type="reset"   class=" btn btn-warning" name="fEnviar" value="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i></button> </button></td>
                
                
                </form></tr>   
            </tbody>
        </table>
         <nav><ul class="pagination">
<?php
$cantPaginas=$objetoarbol->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioarbol.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaarboles);
        mysqli_free_result($listaSuelo);
         mysqli_free_result($listaVariedad);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                