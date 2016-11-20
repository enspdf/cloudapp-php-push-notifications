<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 5/09/16
 * Time: 11:22 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$model = new Crud;
$model->select = '*';
$model->from = 'aerolineas';
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aerolineas</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1>Aerolineas</h1>
        <label for="">Total de aerolineas: <span class="badge"><?php echo $total; ?></span></label>
        <div class="row">
            <a href="Create" data-turbolinks-action="replace" class="btn btn-success">Nueva aerolinea</a>
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
                    <th>Aerolinea</th>
                    <th>Abreviatura</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($filas as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['nombre_aerolinea'] . "</td>";
                        echo "<td>" . $fila['abreviatura'] . "</td>";
                        echo "<td><a href='update.php?id_aerolinea=" . $fila['id_aerolinea'] . "'class='btn btn-success'>Actualizar</a></td>";
                        echo "<td><a href='delete.php?id_aerolinea=" . $fila['id_aerolinea'] . "'class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
