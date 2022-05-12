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
        $sentenciaSQL->bindParam(':imagen',$txtImagen);
        $sentenciaSQL->execute();
    break;

    case "Modificar":
        echo "Presionado el boton Modificar";
    break;

    case "Cancelar":
        echo "Presionado el boton Cancelar";
    break;
    
    case "Seleccionar":
        echo "Presionado el boton Seleccionar";
    break;

    case "Borrar":
        $sentenciaSQL= $conexion->prepare("DELETE FROM elementos WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        //echo "Presionado el boton Borrar";
    break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM elementos");
$sentenciaSQL->execute();
$listaElementos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

    Formulario de agregar academico

    <div class="card">
        <div class="card-header">
            Datos de elementos
        </div>
        <div class="card-body">
            
            <form method="POST" enctype="multipart/form-data">

                <div class = "form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" class="form-control" name="txtID" id="txtID" placeholder="ID">
                </div>
                <div class = "form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nomb">
                </div>
                <div class = "form-group">
                    <label for="exampleInputEmail1">Imagen</label>
                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="imagen">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>
        
        </div>
    </div>

</div>

<div class="col-md-7">

    Tabla de academicos (Muestra los datos de los academicos)

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listaElementos as $elementos){?>
            <tr>
                <td><?php echo $elementos['id']; ?></td>
                <td><?php echo $elementos['nombre']; ?></td>
                <td><?php echo $elementos['imagen']; ?></td>
                
                <td>

                    Seleccionar | Borrar
                
                    <form method="post">

                        <input type="hidden" name="txtID" value="<?php echo $elementos['id']; ?>" />

                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                    
                    </form>

                </td>

            </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include("../template/pie.php"); ?>