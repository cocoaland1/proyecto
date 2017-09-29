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
        $formulario = 'tratamiento';
          include_once("menu.php");
         
        ?>
        </header>
           <div class="container-fluid">
        <h1>Formulario Tratamiento</h1>
      <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">FechaTratamiento</th>
                    <th scope="col">DescripcionTratamiento</th>
                    <th scope="col">IdAtaqueTratamiento</th>
       
                
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
       include_once("../modelo/ataques.php");
        $objetoataques = new ataques($conexion,0,'idAtaques', 'fechaAtaque','porcentajeinfestacion','IdEnfermedadaAtaque','idArbolAtaque');
        $listaataques= $objetoataques->listar(0);
                
        include_once("../modelo/Tratamiento.php");
        $objetoTratamiento = new Tratamiento($conexion,0,'IdTratamiento', 'FechaTratamiento','DescripcionTratamiento','IdAtaqueTratamiento');
        $listaTratamiento= $objetoTratamiento->listar(0);
        while($unRegistro = mysqli_fetch_array($listaTratamiento)){
            
                echo '<tr><form id="fModificarTratamiento"'.$unRegistro["IdTratamiento"].' action="../controlador/controladorTratamiento.php "method="post">';
                echo '<td><input  type="hidden"  name="fIdTratamiento"              value="'.$unRegistro['IdTratamiento'].'">';
                echo '<input      type="Date"  class="form-control"   name="fFechaTratamiento"            value="'.$unRegistro['FechaTratamiento'].'"></td>';
                echo '<td><input  type="text"  name="fDescripcionTratamiento"  value="'.$unRegistro['DescripcionTratamiento'].'"></td>';
            
                echo '<td><select class="form-control"  name="fIdAtaqueTratamiento">';
                while($registroataque = mysqli_fetch_array($listaataques)){
                echo '<option value="'.$registroataque['IdAtaques'].'"';
                if($unRegistro['IdAtaqueTratamiento']==$registroataque['IdAtaques']){
                echo " selected ";
            }
             echo '>'.$registroataque['FechaAtaques'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaataques,0);
            
                 echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarTratamiento" action="../controlador/controladorTratamiento.php" method="post">
                <td><input  type="hidden"  class="form-control" name="fIdTratamiento" value="0">
                <input      type="Date"    class="form-control" name="fFechaTratamiento"></td>
                <td><input  type="text"    class="form-control" name="fDescripcionTratamiento"></td>
                
                <td><select  class="form-control" name="fIdAtaqueTratamiento">
                     <?php 
             while($registroataque = mysqli_fetch_array($listaataques)){
                 echo '<option value="'.$registroataque['IdAtaques'].'">'.$registroataque['FechaAtaques'].'</option>';
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
$cantPaginas=$objetoTratamiento->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariotratamiento.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaTratamiento);
        mysqli_free_result($listaataques);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  