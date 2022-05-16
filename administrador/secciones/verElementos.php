<?php include("../template/cabecera.php"); ?> <!-- Cabecera -->

<?php //Coneccion con la base de datos
include("../config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM elementos");
$sentenciaSQL->execute();
$listaElementos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-12">
<?php include("../template/tablaAcademicos.php"); ?> <!-- Tabla que muestra los academicos registrados -->
</div>

<?php include("../template/pie.php"); ?> <!-- Pie de la pagina -->