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
        $formulario = 'usuario';
          include_once("menu.php");
         
        ?>
        </header>
           <div class="container-fluid">
        <h1>Formulario usuario</h1>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">nombreususario</th>
                    <th scope="col">emailusuario</th>
                    <th scope="col">claveusuario</th>
                    <th scope="col">fecharegistrousuario</th>
                    <th scope="col">fechaultimaclaveusuario</th>
                    <th scope="col">idrolusuario</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/rol.php");
                $objetorol = new rol($conexion,0, 'nombrerol', 'arbolrol','variedadrol', 'suelorol', 'enfermedadrol', 'produccionrol', 'ataquerol', 'clienterol', 'ventasrol', 'tratamientorol', 'podarol', 'tipopodarol', 'floracionrol', 'fertilizantesrol', 'fertilizacionrol', 'usuariosrol', 'auditoriarol', 'rolrol');
                $listaroles = $objetorol->listar(0);           
                
        include_once("../modelo/Usuario.php");
        $objetousuario = new Usuario($conexion,0,'idusuario', 'nombreusuario','emailusuario','claveusuario','fecharegistrousuario','fechaultimaclaveusuario','idrolusuario');
        $listausuarios= $objetousuario->listar(0);
        while($unRegistro = mysqli_fetch_array($listausuarios)){
                echo '<tr><form id="fModificarUsuario"'.$unRegistro["IdUsuario"].' action="../controlador/controladorusuario.php "method="post">';
                echo  '<td><input type="hidden" name="fidusuario"     value="'.$unRegistro['IdUsuario'].'">';
                echo '     <input type="text"  class="form-control"  name="fnombreusuario" value="'.$unRegistro['NombreUsuario'].'"></td>';
                echo '<td><input type="text"   class="form-control"  name="femailusuario"  value="'.$unRegistro['EmailUsuario'].'"></td>';
                echo '<td><input type="password" class="form-control"  name="fclaveusuario"  value="'.$unRegistro['ClaveUsuario'].'"></td>';
                echo '<td><input type="Date"   class="form-control"  name="ffecharegistrousuario"    value="'.$unRegistro['FechaRegistroUsuario'].'"></td>';
                echo '<td><input type="Date"    class="form-control" name="ffechaultimaclaveusuario" value="'.$unRegistro['FechaUltimaClaveUsuario'].'"></td>';
            
                echo '<td><select class="form-control"  name="fidrolusuario">';
                while($registrorol = mysqli_fetch_array($listaroles)){
                echo '<option value="'.$registrorol['IdRol'].'"';
                if($unRegistro['IdRolUsuario']==$registrorol['IdRol']){
                     echo " selected ";
                }
                echo '>'.$registrorol['NombreRol'].'</option>';
            }
             mysqli_data_seek($listaroles,0);
            echo '</select></td>';
                    
                  echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarUsuario" action="../controlador/controladorusuario.php" method="post">
                <td><input type="hidden" class="form-control" name="fidusuario" value="0">
                    <input type="text" class="form-control" name="fnombreusuario"></td>
                <td><input type="text" class="form-control" name="femailusuario"></td>
                <td><input type="number" class="form-control" name="fclaveusuario"></td>
                <td><input type="Date" class="form-control" name="ffecharegistrousuario"></td>
                <td><input type="Date" class="form-control" name="ffechaultimaclaveusuario"></td>
                
                <td><select class="form-control" name="fidrolusuario">
                    <?php
                while($rolRegistro=mysqli_fetch_array($listaroles)){
                   echo '<option value="'.$rolRegistro['IdRol'].'">'.$rolRegistro['NombreRol'].'</option>';
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
$cantPaginas=$objetousuario->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariousuario.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listausuarios);
        mysqli_free_result($listaroles);
        
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>   
<?php
}else{
    header("location:../index.html");
}
                
  