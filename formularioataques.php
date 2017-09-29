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
<header> <?php
          $formulario = 'ataques';
          include_once("menu.php");
         
        ?>
        </header>
       <div class="container-fluid">
        <h1>Formulario Ataques</h1>
       <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">FechaAtaque</th>
                    <th scope="col">Porcentajeinfestacion</th>
                    <th scope="col">IdEnfermedadAtaque</th>
                    <th scope="col">idArbolAtaque</th>
                   
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/Enfermedad.php");
        $objetoEnfermedad = new Enfermedad($conexion,0,'IdEnfermedad','DescripcionEnfermedad');        
        $listaEnfermedad= $objetoEnfermedad->listar(0);
                
        include_once("../modelo/arbol.php");
        $objetoarbol = new arbol($conexion,0,'idarbol', 'alturaarbol','fechasiembra','msnmarbol','idsueloarbol','idvariedadesarbol','ubicacionarbol');
        $listaarboles= $objetoarbol->listar(0);
                
        include_once("../modelo/ataques.php");
        $objetoataques = new ataques($conexion,0,'idAtaques', 'fechaAtaque','porcentajeinfestacion','IdEnfermedadaAtaque','idArbolAtaque');
        $listaataques= $objetoataques->listar(0);
        while($unRegistro = mysqli_fetch_array($listaataques)){
                echo '<tr><form id="fModificarAtaques"'.$unRegistro["IdAtaques"].' action="../controlador/controladorataques.php "method="post">';
                echo '<td><input type="hidden" name="fidAtaques"              value="'.$unRegistro['IdAtaques'].'">';
                echo '<input type="Date"  class="form-control"  name="ffechaataque"            value="'.$unRegistro['FechaAtaques'].'"></td>';
                echo '<td><input type="number" class="form-control"  name="fporcentajeinfestacion"  value="'.$unRegistro['PorcentajeInfestacion'].'"></td>';
            
                echo '<td><select class="form-control"  name="fIdEnfermedadAtaque">';
                while($registroEnfermedad = mysqli_fetch_array($listaEnfermedad)){
                echo '<option value="'.$registroERnfermedad['IdEnfermedad'].'"';
                if($unRegistro['IdEnfermedadAtaque']==$registroEnfermedad['IdEnfermedad']){
                echo " selected ";
            }
             echo '>'.$registroEnfermedad['DescripcionEnfermedad'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaEnfermedad,0);
            
                echo '<td><select class="form-control"  name="fidArbolAtaque">';
                while($registroarbol = mysqli_fetch_array($listaarboles)){
                echo '<option value="'.$registroarbol['IdArbol'].'"';
                if($unRegistro['IdArbolAtaque']==$registroarbol['IdArbol']){
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
                
            <tr><form id="fIngresarAtaques" action="../controlador/controladorataques.php" method="post">
                <td><input type="hidden" class="form-control" name="fidAtaques" value="0">
                    <input type="Date" class="form-control" name="ffechaataque"></td>
                <td><input type="number" class="form-control" name="fporcentajeinfestacion"></td>
                
                <td><select class="form-control" name="fIdEnfermedadAtaque">
                    <?php 
             while($registroEnfermedad = mysqli_fetch_array($listaEnfermedad)){
                 echo '<option value="'.$registroEnfermedad['IdEnfermedad'].'">'.$registroEnfermedad['DescripcionEnfermedad'].'</option>';
             }
            ?>
            </select></td>
                
                <td><select class="form-control" name="fidArbolAtaque">
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
$cantPaginas=$objetoataques->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioataques.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaataques);
        mysqli_free_result($listaEnfermedad);
        mysqli_free_result($listaarboles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  