<?php include("../template/cabecera.php"); ?>
<?php
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:""; //ID
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:""; //Nombre

$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:""; //Imagen

$accion=(isset($_POST['accion']))?$_POST['accion']:""; //Boton de accion

echo $txtID."<br/>";
echo $txtNombre."<br/>";
echo $txtImagen."<br/>";
echo $accion."<br/>";

$host="localhost";
$bd="SITAv2";
$usuario="root";
$contrasenia="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    if($conexion){ echo "Conectado... a sistema";}
} catch ( Exception $ex){
    echo $ex->getMessage();
}

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `elementos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'ejemplo_1', 'imagen_ejemplo1.jpg');");
        $sentenciaSQL->execute();
        echo "Presionado el boton Agregar";
        //INSERT INTO `elementos` (`id`, `nombre`, `imagen`) VALUES (NULL, 'ejemplo_1', 'imagen_ejemplo1.jpg');
    break;

    case "Modificar":
        echo "Presionado el boton Modificar";
    break;

    case "Cancelar":
        echo "Presionado el boton Cancelar";
    break;

}

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
            <tr>
                <td>2</td>
                <td>Aprende php</td>
                <td>imagen.jpg</td>
                <th>Seleccionar | Borrar</th>
            </tr>
        </tbody>
    </table>

</div>

<?php include("../template/pie.php"); ?>