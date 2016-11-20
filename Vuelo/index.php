<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 5/09/16
 * Time: 11:24 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$model = new Crud;
$model->select = 'vuel.id_vuelo, vuel.codigo_vuelo, vuel.partida, vuel.partida, vuel.llegada, vuel.asientos, vuel.valor, aero.id_aerolinea, aero.nombre_aerolinea, avio.id_avion, avio.modelo, origen.id_aeropuerto id_aeropuerto_origen, origen.nombre_aeropuerto aeropuerto_origen, destino.id_aeropuerto id_aeropuerto_destino, destino.nombre_aeropuerto aeropuerto_destino';
$model->from = 'vuelos vuel inner join aerolineas aero on aero.id_aerolinea = vuel.id_aerolinea  inner join aviones avio on avio.id_avion = vuel.id_avion inner join aeropuertos origen on origen.id_aeropuerto = vuel.id_origen inner join aeropuertos destino on destino.id_aeropuerto = vuel.id_destino';
$model->Read();
$filas = $model->rows;
$total = count($filas);
$mensaje = null;

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vuelos</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1>Vuelos</h1>
        <label for="">Total de vuelos: <span class="badge"><?php echo $total;?></span></label>
        <div class="row">
            <a href="Create" data-turbolinks-action="replace" class="btn btn-success">Nuevo vuelo</a>
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
                    <th>Aerolinea</th>
                    <th>Avión</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Partida</th>
                    <th>Llegada</th>
                    <th>Asientos</th>
                    <th>Valor</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($filas as $fila) {
                        echo "<tr>";
                        echo "<td>" . $fila['codigo_vuelo'] . "</td>";
                        echo "<td>" . $fila['nombre_aerolinea'] . "</td>";
                        echo "<td>" . $fila['modelo'] . "</td>";
                        echo "<td>" . $fila['aeropuerto_origen'] . "</td>";
                        echo "<td>" . $fila['aeropuerto_destino'] . "</td>";
                        echo "<td>" . $fila['partida'] . "</td>";
                        echo "<td>" . $fila['llegada'] . "</td>";
                        echo "<td>" . $fila['asientos'] . "</td>";
                        echo "<td>" . $fila['valor'] . "</td>";
                        echo "<td><a href='update.php?id_vuelo=" . $fila['id_vuelo'] . "'class='btn btn-success'>Actualizar</a></td>";
                        echo "<td><a href='delete.php?id_vuelo=" . $fila['id_vuelo'] . "'class='btn btn-danger'>Eliminar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
