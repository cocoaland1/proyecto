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
        $formulario = 'fertilizante';
          include_once("menu.php");
         
        ?>
        </header>
        <div class="container-fluid">
        <h1>Formulario Fertilizante </h1>
     <table class="table">
            <tbody>
                <tr>
                    
                    <th scope="col">DescripcionFertilizante</th>
                </tr>
   <?php
       include_once("../modelo/conexion.php");
       $objetoConexion = new Conexion ();
       $conexion = $objetoConexion->conectar();
                
        include_once("../modelo/Fertilizante.php");
        $objetoFertilizante = new Fertilizante($conexion,0,'IdFertilizante','DescripcionFertilizante');
                
        $listaFertilizante= $objetoFertilizante->listar(0);
        while($unRegistro = mysqli_fetch_array($listaFertilizante)){
            
                echo '<tr><form id="fModificarFertilizante"'.$unRegistro["IdFertilizante"].' action="../controlador/controladorFertilizante.php"method="post">';
                echo '<td><input    type="hidden"  name="fIdFertilizante"                    value="'.$unRegistro['IdFertilizante'].'">';
                echo '<input        type="text"   class="form-control"  name="fDescripcionFertilizante"           value="'.$unRegistro['DescripcionFertilizante'].'"></td>';
                 echo '<td><button type="submit" class="btn btn-success" name="fEnviar" value="Modificar"><i class="fa fa-pencil" aria-hidden="true"></i></button> 
                      <button type="submit" class="btn btn-danger" name="fEnviar" value="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
            
                echo '</form></tr>';
                }
            ?>
                
            <tr><form id="fIngresarFertilizante" action="../controlador/controladorFertilizante.php" method="post">
                <td><input  type="hidden" class="form-control" name="fIdFertilizante" value="0">
                    <input  type="text"   class="form-control" name="fDescripcionFertilizante"></td>
                <td><button  type="submit" class="btn btn-primary" name= "fEnviar" value="Ingresar"><i class="fa fa-clone" aria-hidden="true"></i></button> 
                <button type="reset"   class="btn btn-warning" name="fEnviar" value="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i></button> </button></td>
                </form></tr>    
            </tbody>
        </table>
         <nav><ul class="pagination">
<?php
$cantPaginas=$objetoFertilizante->cantidadPaginas();
if ($cantPaginas>1){
if ($pagina>1){ //mostrar el de ir atras cuando no sea la primer pagina
echo '<li><a heref="#" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
}
for($i=1;$i<=$cantPaginas;$i++){
if($i==$pagina){
echo '<li class="active"><a heref="#">'.$i. '</a></li>';
}else{
echo '<li><a heref="formulariofertilizante.php?pag=' .$i. '</a></li>';
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
        mysqli_free_result($listaFertilizante);
        //$objetoConexion->desconectar($conexion);
        ?>
    </body>
</html>
<?php
}else{
    header("location:../index.html");
}
                
  

