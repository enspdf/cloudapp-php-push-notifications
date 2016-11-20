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
$model->select = '*';
$model->from = 'aeropuertos';
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aeropuertos</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1>Aeropuertos</h1>
        <label for="">Total de aeropuertos: <span class="badge"><?php echo $total; ?></span></label>
        <div class="row">
            <a href="Create" data-turbolinks-action="replace" class="btn btn-success">Nuevo aeropuerto</a>
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
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Pais</th>
                    <th>Zona horaria</th>
                    <th>Código postal</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($filas as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['nombre_aeropuerto'] . "</td>";
                        echo "<td>" . $fila['ciudad'] . "</td>";
                        echo "<td>" . $fila['pais'] . "</td>";
                        echo "<td>" . $fila['zona_horaria'] . "</td>";
                        echo "<td>" . $fila['codigo_postal'] . "</td>";
                        echo "<td><a href='update.php?id_aeropuerto=" . $fila['id_aeropuerto'] . "'class='btn btn-success'>Actualizar</a></td>";
                        echo "<td><a href='delete.php?id_aeropuerto=" . $fila['id_aeropuerto'] . "'class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
