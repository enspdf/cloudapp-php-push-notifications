<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 7/09/16
 * Time: 8:25 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
require '../Push/GeneratePushNotification.php';

$aerolineas = new Crud;
$aerolineas->select = '*';
$aerolineas->from = 'aerolineas';
$aerolineas->Read();
$filas_aerolineas = $aerolineas->rows;

$aviones = new Crud;
$aviones->select = '*';
$aviones->from = 'aviones';
$aviones->Read();
$filas_aviones = $aviones->rows;

$origenes = new Crud;
$origenes->select = '*';
$origenes->from = 'aeropuertos';
$origenes->Read();
$filas_origenes = $origenes->rows;

$destinos = new Crud;
$destinos->select = '*';
$destinos->from = 'aeropuertos';
$destinos->Read();
$filas_destinos = $destinos->rows;

if (isset($_REQUEST['id_vuelo'])) {
    $id_vuelo =  htmlspecialchars($_REQUEST['id_vuelo']);
    $model = new Crud;
    $model->select = '*';
    $model->from = 'vuelos';
    $model->condition = 'id_vuelo = ' . $id_vuelo;
    $model->Read();
    $filas = $model->rows;
    foreach ($filas as $fila) {
        $vuelo = $fila['codigo_vuelo'];
        $aerolinea = $fila['id_aerolinea'];
        $avion = $fila['id_avion'];
        $origen = $fila['id_origen'];
        $destino = $fila['id_destino'];
        $partida = $fila['partida'];
        $llegada = $fila['llegada'];
        $asientos = $fila['asientos'];
        $valor = $fila['valor'];
    }
}

$mensaje = null;
if (isset($_POST['update'])) {
    $id_vuelo = $_POST['id_vuelo'];
    $vuelo = $_POST['vuelo'];
    $aerolinea = $_POST['aerolinea'];
    $avion = $_POST['avion'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $partida = $_POST['partida'];
    $llegada = $_POST['llegada'];
    $asientos = $_POST['asientos'];
    $valor = $_POST['valor'];

    $model = new Crud;
    $model->update = "vuelos";
    $model->set = "codigo_vuelo = '$vuelo', id_aerolinea = $aerolinea, id_avion = $avion, id_origen = $origen, id_destino = $destino, partida = '$partida', 	llegada = '$llegada', asientos = '$asientos', valor = $valor";
    $model->condition = "id_vuelo = " . $id_vuelo;
    $model->Update();
    push_notification("Vuelo " . $vuelo . " actualizado", "Nuevo origen: " . $origen . " - Nuevo destino: " . $destino);
    $mensaje = $model->mensaje;
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index" data-turbolinks-action="replace">Regresar</a></li>
        </ol>
        <h1>Actualizar: <?php echo $vuelo; ?></h1>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="padding-right:20px; border-right: 1px solid #ccc;">
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?php echo $vuelo; ?>" name="vuelo" placeholder="Ingrese el código del vuelo">
                    </div>
                    <div class="form-group">
                        <label for="aerolinea">Seleccione la aerolinea</label>
                        <?php
                        echo "<select name='aerolinea' class='form-control' id='aerolinea'>";
                        foreach ($filas_aerolineas as $aerolinea) {
                            echo "<option value='{$aerolinea['id_aerolinea']}'>{$aerolinea['nombre_aerolinea']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="avion">Seleccione el avión</label>
                        <?php
                        echo "<select name='avion' class='form-control' id='avion'>";
                        foreach ($filas_aviones as $avion) {
                            echo "<option value='{$avion['id_avion']}'>{$avion['modelo']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="origen">Seleccione el aeropuerto de origen</label>
                        <?php
                        echo "<select name='origen' class='form-control' id='origen'>";
                        foreach ($filas_origenes as $origen) {
                            echo "<option value='{$origen['id_aeropuerto']}'>{$origen['nombre_aeropuerto']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="destino">Seleccione el aeropuerto de destino</label>
                        <?php
                        echo "<select name='destino' class='form-control' id='destino'>";
                        foreach ($filas_destinos as $destino) {
                            echo "<option value='{$destino['id_aeropuerto']}'>{$destino['nombre_aeropuerto']}</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="partida">Fecha de partida</label>
                        <input type="date" class="form-control" name="partida" id="partida" value="<?php echo $partida;?>">
                    </div>
                    <div class="form-group">
                        <label for="llegada">Fecha de llegada</label>
                        <input type="date" class="form-control" name="llegada" id="llegada" value="<?php echo $llegada;?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="asientos" placeholder="Número de asientos" value="<?php echo $asientos;?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="valor" placeholder="Precio del vuelo" value="<?php echo $valor; ?>">
                    </div>
                </div>
            </div>
            <input type="hidden" name="update">
            <input type="hidden" name="id_vuelo" value="<?php echo $id_vuelo; ?>">
            <input type="submit" value="Actualizar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
