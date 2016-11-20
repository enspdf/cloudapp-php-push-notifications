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
$model->select = "res.asiento, res.fecha, res.id_reserva, vuel.id_vuelo, vuel.codigo_vuelo, usu.id_usuario, usu.nombre";
$model->from = "reservas res INNER JOIN vuelos vuel ON res.id_vuelo = vuel.id_vuelo INNER JOIN usuarios usu ON res.usuario = usu.id_usuario";
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1>Reservas</h1>
        <label for="">Total de reservas: <span class="badge"><?php echo $total; ?></span></label>
        <div class="row">
            <a href="Create" data-turbolinks-action="replace" class="btn btn-success">Nueva reserva</a>
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
                    <th>Vuelo</th>
                    <th>Usuario</th>
                    <th>Asiento</th>
                    <th>Fecha</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($filas as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['codigo_vuelo'] . "</td>";
                        echo "<td>" . $fila['nombre'] . "</td>";
                        echo "<td>" . $fila['asiento'] . "</td>";
                        echo "<td>" . $fila['fecha'] . "</td>";
                        echo "<td><a href='delete.php?id_reserva=" . $fila['id_reserva'] . "'class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
