<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 5/09/16
 * Time: 11:23 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$model = new Crud;
$model->select = "*";
$model->from = "aviones";
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aviones</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1>Aviones</h1>
        <label for="">Total de aerolineas: <span class="badge"><?php echo $total; ?></span></label>
        <div class="row">
            <a href="Create" data-turbolinks-action="replace" class="btn btn-success">Nuevo avión</a>
        </div>
        <br>
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
                    <th>Modelo</th>
                    <th>Año de fabricación</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($filas as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['modelo'] . "</td>";
                        echo "<td>" . $fila['fabricacion'] . "</td>";
                        echo "<td><a href='update.php?id_avion=" . $fila['id_avion'] . "'class='btn btn-success'>Actualizar</a></td>";
                        echo "<td><a href='delete.php?id_avion=" . $fila['id_avion'] . "'class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
