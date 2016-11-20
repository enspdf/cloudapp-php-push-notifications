<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 6/09/16
 * Time: 11:23 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
require '../Push/GeneratePushNotification.php';

if (isset($_REQUEST['id_aerolinea'])) {
    $id_aerolinea = htmlspecialchars($_REQUEST['id_aerolinea']);
    $model = new Crud;
    $model->select = "*";
    $model->from = "aerolineas";
    $model->condition = "id_aerolinea = $id_aerolinea";
    $model->Read();
    $filas = $model->rows;
    foreach ($filas as $fila) {
        $nombre_aerolinea = $fila['nombre_aerolinea'];
        $abreviatura = $fila['abreviatura'];
    }
}

$mensaje = null;
if (isset($_POST['update'])) {
    $id_aerolinea = $_POST['id_aerolinea'];
    $nombre_aerolinea = $_POST['nombre'];
    $abreviatura = $_POST['abreviatura'];

    $model = new Crud;
    $model->update = "aerolineas";
    $model->set = "nombre_aerolinea = '$nombre_aerolinea', abreviatura = '$abreviatura'";
    $model->condition = "id_aerolinea = " . $id_aerolinea;
    $model->Update();
    push_notification("Aerolinea " . $nombre_aerolinea . " actualizada", "Ha sido actualizada a " . $nombre_aerolinea . " - " . $abreviatura);
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
        <h1>Actualizar: <?php echo $nombre_aerolinea; ?></h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <?php echo $mensaje; ?>
                </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre_aerolinea; ?>" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="abreviatura" value="<?php echo $abreviatura ?>" placeholder="Abreviatura">
            </div>
            <input type="hidden" name="update">
            <input type="hidden" name="id_aerolinea" value="<?php echo $id_aerolinea ?>">
            <input type="submit" value="Actualizar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
