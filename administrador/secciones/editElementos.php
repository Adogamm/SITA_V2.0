<?php include("../template/cabecera.php"); ?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:""; //ID
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:""; //Nombre
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:""; //Imagen
$accion=(isset($_POST['accion']))?$_POST['accion']:""; //Boton de accion

include("../config/bd.php");

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO elementos(nombre,imagen) VALUES (:nombre,:imagen);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        
        $fecha= new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:elementos.php");
    break;

    case "Modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE elementos SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->execute();

        if($txtImagen!=""){

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            
            move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);

            $sentenciaSQL= $conexion->prepare("SELECT * FROM elementos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $elemento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($elemento["imagen"]) &&($elemento["imagen"]!="imagen.jpg") ){
                
                if(file_exists("../../img/".$elemento["imagen"])){
                    unlink("../../img/".$elemento["imagen"]);
                }
            }

            $sentenciaSQL= $conexion->prepare("UPDATE elementos SET imagen=:imagen WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->execute();

            header("Location:elementos.php");
        }
    break;

    case "Cancelar":
        header("Location:elementos.php");
    break;
    
    case "Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM elementos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $elemento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre=$elemento['nombre'];
        $txtImagen=$elemento['imagen'];
    break;

    case "Borrar":
        
        $sentenciaSQL= $conexion->prepare("SELECT * FROM elementos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $elemento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if(isset($elemento["imagen"]) &&($elemento["imagen"]!="imagen.jpg") ){
            
            if(file_exists("../../img/".$elemento["imagen"])){
                unlink("../../img/".$elemento["imagen"]);
            }
        }

        $sentenciaSQL= $conexion->prepare("DELETE FROM elementos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        
        header("Location:elementos.php");
    break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM elementos");
$sentenciaSQL->execute();
$listaElementos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

    <!-- Formulario de agregar academico -->

    <div class="card">
        <div class="card-header">
            Datos de elementos
        </div>
        <div class="card-body">
            
            <form method="POST" enctype="multipart/form-data">

                <div class = "form-group">
                    <label for="txtID">ID</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class = "form-group">
                    <label for="txtNombre">Nombre</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nomb">
                </div>
                <div class = "form-group">
                    <label for="txtImagen">Imagen</label>

                    </br>

                    <div align="center">
                    <?php if($txtImagen!=""){ ?>

                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="100" alt="" srcset="">

                        <?php } ?>
                    </div>

                    </br>

                    <input type="file" class="form-control" value="<?php echo $txtImagen; ?>" name="txtImagen" id="txtImagen" placeholder="imagen">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>
        
        </div>
    </div>

</div>

<div class="col-md-7">
<?php include("../template/tablaAcademicos.php"); ?> <!-- Tabla que muestra los academicos registrados -->
</div>

<?php include("../template/pie.php"); ?>