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

$mensaje = null;
if (isset($_POST['create'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $ciudad = htmlspecialchars($_POST['ciudad']);
    $pais = htmlspecialchars($_POST['pais']);
    $zona = htmlspecialchars($_POST['zona']);
    $codigo = htmlspecialchars($_POST['codigo']);

    if ($nombre == '') {
        $mensaje = '<div class="alert alert-danger">El campo nombre es requerido</div>';
    } else if ($ciudad == '') {
        $mensaje = '<div class="alert alert-danger">El campo ciudad es requerido</div>';
    } else if ($pais == '') {
        $mensaje = '<div class="alert alert-danger">El campo pais es requerido</div>';
    } else if ($zona == '') {
        $mensaje = '<div class="alert alert-danger">El campo zona horaria es requerido</div>';
    } else if ($codigo == '') {
        $mensaje = '<div class="alert alert-danger">El campo código postal es requerido</div>';
    } else if (!is_numeric($codigo)) {
        $mensaje = '<div class="alert alert-danger">El campo código postal debe ser numerico</div>';
    } else {
        $model = new Crud;
        $model->insertInto = "aeropuertos";
        $model->insertColumns = "nombre_aeropuerto, ciudad, pais, zona_horaria, codigo_postal";
        $model->insertValues = "'$nombre', '$ciudad', '$pais', '$zona', '$codigo'";
        $model->Create();
        push_notification("Correcto", "El aeropuerto " . $nombre . " se ha creado correctamente");
        $mensaje = $model->mensaje;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo aeropuerto</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index" data-turbolinks-action="replace">Regresar</a></li>
        </ol>
        <h1>Crear nuevo aeropuerto</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="pais" placeholder="País">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="zona" placeholder="Zona horaria">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="codigo" placeholder="Código postal">
            </div>
            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
