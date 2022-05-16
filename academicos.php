<?php include("template/cabecera.php"); ?>

<?php
include ("administrador/config/bd.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM elementos");
$sentenciaSQL->execute();
$listaElementos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

            <div class="jumbotron">
                <h1 class="display-3">Zona de academicos</h1>
                <p class="lead">Aqui falta contenido</p>
                <hr class="my-2">
            </div>

            <?php foreach($listaElementos as $elemento) { ?>
                <div class="col-md-2">
                    <div class="card">
                        <img class="card-img-top" src="./img/<?php echo $elemento['imagen'];?>" alt="">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $elemento['nombre'];?></h4>
                            <div class="col text-center">
                                </br>
                                <a name="" id="" class="btn btn-primary" href="administrador/secciones/editElementos.php" role="button">Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

<?php include("template/pie.php"); ?>