<?php include("../template/cabecera.php"); ?>

<?php
include ("../../administrador/config/bd.php");
?>

    <form action="" method="get">
        <input type="text" name="busqueda">
        <input type="submit" name="enviar" value="buscar">
    </form>

    </br>
    </br>

    <?php
    if(isset($_GET['enviar'])) {
        $busqueda = $_GET['busqueda'];
        $sentenciaSQL= $conexion->query("SELECT * FROM elementos WHERE nombre LIKE '%$busqueda%'");
        while ($row = $sentenciaSQL->fetch(PDO::FETCH_LAZY)) { 
            echo $row ['nombre'].'</br>';
        }
    }
    ?>

<?php include("../template/pie.php"); ?>