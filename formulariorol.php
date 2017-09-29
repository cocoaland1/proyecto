<?php
session_start();
if (isset($_SESSION['id'])){
    
?>
<!DOCTYPE thml>
<html>
  <head>
      <meta charset="utf-8">
      <title> cocoaland</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/font-awesome.css">
      <script src="js/jquery-3.1.1.slim.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
<header>
        <?php
            $formulario = 'rol';
            include_once("menu.php");
        ?>
        </header>

        <div class="container-fluid">
         <h1>Formulario Rol</h1>
        <table class="table table-striped table-responsive">
            <tbody>
                <tr>
                    <th scope="col">nombrerol</th>
                    <th scope="col">arbolrol</th>
                    <th scope="col">variedadrol</th>
                    <th scope="col">suelorol</th>
                    <th scope="col">enfermedadrol</th>
                    <th scope="col">produccionrol</th>
                    <th scope="col">ataquerol</th>
                    <th scope="col">clienterol</th>
                    <th scope="col">ventasrol</th>
                    <th scope="col">tratamientorol</th>
                    <th scope="col">podarol</th>
                    <th scope="col">tipopodarol</th>
                    <th scope="col">floracionrol</th>
                    <th scope="col">fertilizantesrol</th>
                    <th scope="col">fertilizacionrol</th>
                    <th scope="col">usuariosrol</th>
                    <th scope="col">auditoriarol</th>
                    <th scope="col">rolrol</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/rol.php");
                $objetorol = new rol($conexion,0, 'nombrerol', 'arbolrol','variedadrol', 'suelorol', 'enfermedadrol', 'produccionrol', 'ataquerol', 'clienterol', 'ventasrol', 'tratamientorol', 'podarol', 'tipopodarol', 'floracionrol', 'fertilizantesrol', 'fertilizacionrol', 'usuariosrol', 'auditoriarol', 'rolrol');
                $listaroles = $objetorol->listar(0);
                while($unRegistro = mysqli_fetch_array($listaroles)){
                    echo '<tr><form id="fModificarArbol'.$unRegistro["IdRol"].'" action="../controlador/controladorrol.php" method="post">';
                    echo '<td><input type="hidden" name="fidrol"          value="'.$unRegistro['IdRol'].'">';
                    echo '<input     type="text" class="form-control" name="fnombrerol"        value="'.$unRegistro['NombreRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="farbolrol"         value="'.$unRegistro['ArbolRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fvariedadrol"      value="'.$unRegistro['VariedadRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fsuelorol"         value="'.$unRegistro['SueloRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fenfermedadrol"    value="'.$unRegistro['EnfermedadRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fproduccionrol"    value="'.$unRegistro['ProduccionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fataquerol"        value="'.$unRegistro['AtaqueRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fclienterol"       value="'.$unRegistro['ClienteRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fventasrol"        value="'.$unRegistro['VentasRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="ftratamientorol"   value="'.$unRegistro['TratamientoRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fpodasrol"         value="'.$unRegistro['PodasRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="ftipopodarol"      value="'.$unRegistro['TipoPodaRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="ffloracionrol"     value="'.$unRegistro['FloracionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="ffertilizantesrol" value="'.$unRegistro['FertilizantesRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="ffertilizacionrol" value="'.$unRegistro['FertilizacionRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fusuariosrol"      value="'.$unRegistro['UsuariosRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="fauditoriarol"     value="'.$unRegistro['AuditoriaRol'].'"></td>';
                    echo '<td><input type="text" class="form-control" name="frolrol"           value="'.$unRegistro['RolRol'].'"></td>';                    
                  echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarrol" action="../controlador/controladorrol.php" method="post">
                
                <td><input type="hidden" class="form-control" name="fidrol" value="0">
                    <input type="text" class="form-control" name="fnombrerol"></td>
                <td><input type="text" class="form-control" name="farbolrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fvariedadrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fsuelorol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fenfermedadrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fproduccionrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fataquerol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fclienterol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fventasrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="ftratamientorol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fpodasrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="ftipopodarol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="ffloracionrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="ffertilizantesrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="ffertilizacionrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fusuariosrol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="fauditoriarol" placeholder="crud"></td>
                <td><input type="text" class="form-control" name="frolrol" placeholder="crud"></td>
                 <td><button  type="submit" class="btn btn-primary" name= "fEnviar" value="Ingresar"><i class="fa fa-clone" aria-hidden="true"></i></button> 
                <button type="reset"   class="btn btn-warning" name="fEnviar" value="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i></button> </button></td>
                </form></tr>   
            </tbody>
        </table>
         <nav><ul class="pagination">
<?php
$cantPaginas=$objetorol->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formularioRol.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaroles);
        $objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  
                