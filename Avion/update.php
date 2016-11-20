<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 7/09/16
 * Time: 11:04 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
require '../Push/GeneratePushNotification.php';

if (isset($_REQUEST['id_avion'])) {
    $id_avion = htmlspecialchars($_REQUEST['id_avion']);
    $model = new Crud;
    $model->select = "*";
    $model->from = "aviones";
    $model->condition = "id_avion = " . $id_avion;
    $model->Read();
    $filas = $model->rows;
    foreach ($filas as $fila) {
        $modelo = $fila['modelo'];
        $fabricacion = $fila['fabricacion'];
    }
}

$mensaje = null;
if (isset($_POST['update'])) {
    $id_avion = $_POST['id_avion'];
    $modelo = $_POST['modelo'];
    $fabricacion = $_POST['fabricacion'];

    $model = new Crud;
    $model->update = "aviones";
    $model->set = "modelo = '$modelo', fabricacion = '$fabricacion'";
    $model->condition = "id_avion = " . $id_avion;
    $model->Update();
    push_notification("Avión actualizado", "Especificaciones: modelo " . $modelo . " - fabricación " . $fabricacion);
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
        <h1>Actualizar: <?php echo $modelo ?></h1>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="modelo" value="<?php echo $modelo ?>" placeholder="Modelo">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="fabricacion" value="<?php echo $fabricacion ?>" placeholder="Año de fabricación">
            </div>
            <input type="hidden" name="update">
            <input type="hidden" name="id_avion" value="<?php echo $id_avion ?>">
            <input type="submit" value="Actualizar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
