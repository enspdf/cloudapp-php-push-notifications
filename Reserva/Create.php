<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 7/09/16
 * Time: 10:41 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
require '../Push/GeneratePushNotification.php';

$vuelos = new Crud;
$vuelos->select = '*';
$vuelos->from = 'vuelos';
$vuelos->Read();
$filas_vuelos = $vuelos->rows;

$usuarios = new Crud;
$usuarios->select = '*';
$usuarios->from = 'usuarios';
$usuarios->Read();
$filas_usuarios = $usuarios->rows;

$mensaje = null;
if (isset($_POST['create'])) {
    $vuelo = htmlspecialchars($_POST['vuelo']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $asiento = htmlspecialchars($_POST['asiento']);
    $fecha = htmlspecialchars($_POST['fecha']);

    if ($vuelo == '') {
        $mensaje = '<div class="alert alert-danger">Debes seleccionar un vuelo</div>';
    } else if ($usuario == '') {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar el usuario</div>';
    } else if ($asiento == '') {
        $mensaje = '<div class="alert alert-danger">Debe ingresar un asiento</div>';
    } else if (!is_numeric($asiento)) {
        $mensaje = '<div class="alert alert-danger">El asiento debe ser númerico</div>';
    } else if ($fecha == '') {
        $mensaje = '<div class="alert alert-danger">Debe seleccionar la fecha de la reserva</div>';
    }
    else {
        $model = new Crud;
        $model->insertInto = 'reservas';
        $model->insertColumns = 'id_vuelo, usuario, asiento, fecha';
        $model->insertValues = "$vuelo, $usuario, '$asiento', '$fecha'";
        $model->Create();
        push_notification($usuario . " su reserva ha sido creada", "Vuelo: " . $vuelo . " Asiento: " . $asiento . " Fecha: " . $fecha);
        $mensaje = $model->mensaje;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo avión</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index" data-turbolinks-action="replace">Regresar</a></li>
        </ol>
        <h1>Crear reserva</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>

            <div class="form-group">
                <label for="vuelo">Seleccione el vuelo</label>
                <?php
                echo "<select name='vuelo' class='form-control' id='vuelo'>";
                    foreach ($filas_vuelos as $vuelo) {
                        echo "<option value='{$vuelo['id_vuelo']}'>{$vuelo['codigo_vuelo']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>

            <div class="form-group">
                <label for="usuario">Seleccione el cliente</label>
                <?php
                    echo "<select name='usuario' class='form-control' id='usuario'>";
                        foreach ($filas_usuarios as $usuario) {
                            echo "<option value='{$usuario['id_usuario']}'>{$usuario['nombre']}</option>";
                        }
                    echo "</select>";
                ?>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="asiento" placeholder="Ingrese el número del asiento">
            </div>

            <div class="form-group">
                <label for="fecha">Ingrese la fecha de la reserva</label>
                <input type="date" class="form-control" name="fecha" id="fecha">
            </div>

            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
