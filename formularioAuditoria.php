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
        $formulario = 'Auditoria';
          include_once("menu.php");
         
        ?>
    
        </header>
       <div class="container-fluid">
        <h1>Formulario  Auditoria </h1>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">FechaAuditoria</th>
                    <th scope="col">DescripcionAuditoria</th>
                    <th scope="col">IdUsuarioAuditoria</th>                 
                    
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/Usuario.php");
        $objetoUsuario = new Usuario($conexion,'IdUsuario','nombreusuario','emailusuario','claveusuario','fecharegistrousuario','fechaultimaclaveusuario', 'idrolusuario');      
        $listaUsuario= $objetoUsuario->listar(0);
            
                
        include_once("../modelo/Auditoria.php");
        $objetoAuditoria = new Auditoria ($conexion,'IdAuditoria ', 'FechaAuditoria ','DescripcionAuditoria','IdUsuarioAuditoria');
        $listaAuditoria = $objetoAuditoria ->listar(0);
                
        while($unRegistro = mysqli_fetch_array($listaAuditoria)){
            
                echo '<tr><form id="fModificarAuditoria"'.$unRegistro["IdAuditoria"].' action="../controlador/controladorAuditoria.php "method="post">';
                echo '<td><input    type="hidden"  name="fIdAuditoria"                   value="'.$unRegistro['IdAuditoria'].'">';
                echo '<input        type="date"  class="form-control"   name="fFechaAuditoria"                value="'.$unRegistro['FechaAuditoria'].'"></td>';
                echo '<td><input    type="text" class="form-control"  name="fDescripcionAuditoria"            value="'.$unRegistro['DescripcionAuditoria'].'"></td>';
            
               echo '<td><select class="form-control"  name="fIdUsuario">';
                while($registroUsuario= mysqli_fetch_array($listaUsuario)){
                echo '<option value="'.$registroUsuario['IdUsuario'].'"';
                if($unRegistro['IdUsuarioAuditoria']==$registroUsuario['IdUsuario']){
                echo " selected ";
            }
             echo '>'.$registroUsuario['NombreUsuario'].'</option>';
        }
        echo '</select></td>';
        mysqli_data_seek($listaUsuario,0);
            
            
               
                echo '</form></tr>';
                }
            ?>
                
            
            </tbody>
        </table>
         <nav><ul class="pagination">
<?php
$cantPaginas=$objetoAuditoria->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioAuditoria.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaAuditoria);
        mysqli_free_result($listaUsuario);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  

