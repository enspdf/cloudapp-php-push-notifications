<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 2:16 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$model = new Crud;
$model->select = '*';
$model->from = 'productos';
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>

    <div class="container">
        <h1>Listado de productos</h1>
        <label for="">Total de productos:  <span class="badge"><?php echo $total ?></span> </label>
        <div>
            <?php
                session_start();
                $mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
                echo $mensaje;
            ?>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($filas as $fila) {
                    echo "<tr>";
                    echo "<td>" .  $fila['id_producto'] . "</td>";
                    echo "<td>" .  $fila['nombre'] . "</td>";
                    echo "<td>" .  $fila['descripcion'] . "</td>";
                    echo "<td>" .  $fila['categoria'] . "</td>";
                    echo "<td>" .  $fila['precio'] . "</td>";
                    echo "<td><a href='update.php?id_producto=" . $fila['id_producto'] . "'class='btn btn-success'>Actualizar</a></td>";
                    echo "<td><a href='delete.php?id_producto=" . $fila['id_producto'] . "'class='btn btn-danger'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
