<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 4/09/16
 * Time: 5:32 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$usuarios = new Crud;
$usuarios->select = '*';
$usuarios->from = 'usuarios';
$usuarios->Read();
$filas_usuarios = $usuarios->rows;
$total_usuarios = count($filas_usuarios);

$aerolineas = new Crud;
$aerolineas->select = '*';
$aerolineas->from = 'aerolineas';
$aerolineas->Read();
$filas_aerolineas = $aerolineas->rows;
$total_aerolineas = count($filas_aerolineas);

$aeropuertos = new Crud;
$aeropuertos->select = '*';
$aeropuertos->from = 'aeropuertos';
$aeropuertos->Read();
$filas_aeropuertos = $aeropuertos->rows;
$total_aeropuertos = count($filas_aeropuertos);

$aviones = new Crud;
$aviones->select = '*';
$aviones->from = 'aviones';
$aviones->Read();
$filas_aviones = $aviones->rows;
$total_aviones = count($filas_aviones);

$reservas = new Crud;
$reservas->select = '*';
$reservas->from = 'reservas';
$reservas->Read();
$filas_reservsas = $reservas->rows;
$total_reservas = count($filas_reservsas);

$vuelos = new Crud;
$vuelos->select = '*';
$vuelos->from = 'vuelos';
$vuelos->Read();
$filas_vuelos = $vuelos->rows;
$total_vuelos = count($filas_vuelos);

session_start();
if (!isset($_SESSION['nombre'])) {
    header("location: /");
}

if ($_GET['logout'] == 'true') {
    unset($_SESSION['nombre']);
    session_destroy();
    header("location: /");
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de administración</title>
    <?php include '../Base/HeaderBase.php' ?>


</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <h1 class="text-center">Bienvenido al sistema de compra de tickets</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Usuarios</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_usuarios; ?></span>
                            Registrados
                        </div>
                    </div>
                </div>
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Aerolineas</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_aerolineas; ?></span>
                            Registradas
                        </div>
                    </div>
                </div>
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Aeropuertos</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_aeropuertos; ?></span>
                            Registrados
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Aviones</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_aviones; ?></span>
                            Registrados
                        </div>
                    </div>
                </div>
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Reservas</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_reservas; ?></span>
                            Registradas
                        </div>
                    </div>
                </div>
                <div class="col-md-4 panel panel-primary">
                    <div class="panel-heading">Vuelos</div>
                    <div class="panel-body">
                        <div style="font-size: 50px" class="text-center">
                            <span class="label label-success label-as-badge"><?php echo $total_vuelos; ?></span>
                            Registrados
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
