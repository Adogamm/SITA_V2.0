<!-- Tabla de academicos (Muestra los datos de los academicos) -->
<form action="" method="get">
    <input type="text" name="busqueda">
    <input type="submit" name="enviar" value="buscar">
</form>

</br>

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
        
        <?php
            if(isset($_GET['enviar'])) {
                $busqueda = $_GET['busqueda'];
                $sentenciaSQL= $conexion->query("SELECT * FROM elementos WHERE nombre LIKE '%$busqueda%'");
                while ($row = $sentenciaSQL->fetch(PDO::FETCH_LAZY)) { ?>
                    <td><?php echo $elementos['id']; ?></td>
                    <td><?php echo $elementos['nombre']; ?></td>
                    <td>
                        <div align="center">
                            <img class="img-thumbnail rounded" src="../../img/<?php echo $elementos['imagen']; ?>" width="100" alt="" srcset="">
                        </div>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" value="<?php echo $elementos['id']; ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                        </form>
                    </td>
                    <?php } ?>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>