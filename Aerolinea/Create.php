<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 6/09/16
 * Time: 10:25 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
require '../Push/GeneratePushNotification.php';

$mensaje = null;
if (isset($_POST['create'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $abreviatura = htmlspecialchars($_POST['abreviatura']);

    if ($nombre == '') {
        $mensaje = '<div class="alert alert-danger">El campo nombre es requerido</div>';
    } else if ($abreviatura == '') {
        $mensaje = '<div class="alert alert-danger">El campo abreviatura es requerido</div>';
    } else {
        $model = new Crud;
        $model->insertInto = "aerolineas";
        $model->insertColumns = "nombre_aerolinea, abreviatura";
        $model->insertValues = "'$nombre', '$abreviatura'";
        $model->Create();
        push_notification("Aerolinea " . $nombre . " creada", $nombre . " - " . $abreviatura);
        $mensaje = $model->mensaje;
        
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva aerolinea</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <?php include '../Base/MenuBase.php'; ?>
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="index" data-turbolinks-action="replace">Regresar</a></li>
        </ol>

        <h1>Crear nueva aerolinea</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="abreviatura" placeholder="Abreviatura">
            </div>
            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
