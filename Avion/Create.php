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

$mensaje = null;
if (isset($_POST['create'])) {
    $modelo = htmlspecialchars($_POST['modelo']);
    $fabricacion = htmlspecialchars($_POST['fabricacion']);

    if ($modelo == '') {
        $mensaje = '<div class="alert alert-danger">El campo modelo es requerido</div>';
    } else if ($fabricacion == '') {
        $mensaje = '<div class="alert alert-danger">El campo año de fabricación es requerido</div>';
    } else {
        $model = new Crud;
        $model->insertInto = 'aviones';
        $model->insertColumns = 'modelo, fabricacion';
        $model->insertValues = "'$modelo', '$fabricacion'";
        $model->Create();
        push_notification("Avión creado", "Se ha registrado con modelo " . $modelo . " - " . $fabricacion);
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
        <h1>Crear nuevo avión</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="modelo" placeholder="Modelo">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" name="fabricacion" placeholder="Año de fabricación">
            </div>
            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
