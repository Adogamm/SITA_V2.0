<?php
$decision=(isset($_POST['decision']))?$_POST['decision']:""; //Boton de decision
?>

<?php
switch($decision){

    case "acceder":
        session_start();
        if($_POST){
            if(($_POST['usuario']=="admin")&&($_POST['contrasenia']=="sistema")){
                $_SESSION['usuario']="ok";
                $_SESSION['nombreUsuario']="Administrador";
                header('Location:inicio.php');
            } else {
                $mensaje="Error: El usuario y/o contraseña son incorrectos";
            }
        }
    break;

    case "cancelar":
        header('Location:../index.php');
    break;
}?>

<!doctype html>
<html lang="en">
    <head>
        <title>Administrador</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                </br></br></br></br>
                    <div class="card">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">

                            <?php if(isset($mensaje)) {?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                            <?php } ?>

                            <form method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label>Usuario</label>
                                    <input type="text" class="form-control" name="usuario" placeholder="Escribe tu usuario">
                                </div>

                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu contraseña">
                                </div>
                                </br>
                                <button type="submit" name="decision" value="acceder" class="btn btn-primary">Acceder</button>
                                <button type="submit" name="decision" value="cancelar" class="btn btn-danger" style="float: right;">Cancelar</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>