<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 7/09/16
 * Time: 7:51 PM
 */

include '../Db/Conexion.php';
include '../Crud.php';
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

$mensaje = null;
if (isset($_POST['create'])) {
    $codigo = htmlspecialchars($_POST['codigo_vuelo']);
    $aerolinea = htmlspecialchars($_POST['aerolinea']);
    $avion = htmlspecialchars($_POST['avion']);
    $origen = htmlspecialchars($_POST['origen']);
    $destino = htmlspecialchars($_POST['destino']);
    $partida = htmlspecialchars($_POST['partida']);
    $llegada = htmlspecialchars($_POST['llegada']);
    $asientos = htmlspecialchars($_POST['asientos']);
    $valor = htmlspecialchars($_POST['valor']);

    if ($codigo == null) {
        $mensaje = '<div class="alert alert-danger">El campo codigo es requerido</div>';
    } else if ($aerolinea == null) {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar una aerolinea</div>';
    } else if ($avion == null) {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar un avión</div>';
    } else if ($origen == null) {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar un aeropuerto de origen</div>';
    } else if ($destino == null) {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar un aeropuerto de destino</div>';
    } else if ($partida == null) {
        $mensaje = '<div class="alert alert-danger">Debe ingresar una fecha de partida</div>';
    } else if ($llegada == null) {
        $mensaje = '<div class="alert alert-danger">Debe ingresar una fecha de llegada</div>';
    } else if ($asientos == null) {
        $mensaje = '<div class="alert alert-danger">El campo asientos es requerido</div>';
    } else if (!is_numeric($asientos)) {
        $mensaje = '<div class="alert alert-danger">El campo asientos debe ser numerico</div>';
    } else if ($valor == null) {
        $mensaje = '<div class="alert alert-danger">El campo valor es requerido</div>';
    } else if (!is_numeric($valor)) {
        $mensaje = '<div class="alert alert-danger">El campo valor debe ser numerico</div>';
    } else {
        $model = new Crud;
        $model->insertInto = "vuelos";
        $model->insertColumns = "codigo_vuelo, id_aerolinea, id_avion, id_origen, id_destino, partida, llegada, asientos, valor";
        $model->insertValues = "'$codigo', $aerolinea, $avion, $origen, $destino, '$partida', '$llegada', '$asientos', $valor";
        $model->Create();
        push_notification("Vuelo " . $codigo . " creado correctamente", "Origen: " . $origen . " - Destino: " . $destino);
        $mensaje = $model->mensaje;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo vuelo</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index" data-turbolinks-action="replace">Regresar</a></li>
        </ol>
        <h1>Crear nuevo vuelo</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="col-md-12">
                <div class="col-md-6" style="padding-right:20px; border-right: 1px solid #ccc;">
                    <div class="form-group">
                        <input type="text" class="form-control" name="codigo_vuelo" placeholder="Ingrese el código del vuelo">
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
                        <input type="date" class="form-control" name="partida" id="partida">
                    </div>
                    <div class="form-group">
                        <label for="llegada">Fecha de llegada</label>
                        <input type="date" class="form-control" name="llegada" id="llegada">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="asientos" placeholder="Número de asientos">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="valor" placeholder="Precio del vuelo">
                    </div>
                </div>
            </div>
            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-success">
        </form>
    </div>
    <br><br><br>
</body>
</html>
