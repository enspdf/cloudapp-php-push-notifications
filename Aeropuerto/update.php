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

if (isset($_REQUEST['id_aeropuerto'])) {
    $id_aeropuerto =  htmlspecialchars($_REQUEST['id_aeropuerto']);
    $model = new Crud;
    $model->select = '*';
    $model->from = 'aeropuertos';
    $model->condition = 'id_aeropuerto = ' . $id_aeropuerto;
    $model->Read();
    $filas = $model->rows;
    foreach ($filas as $fila) {
        $nombre = $fila['nombre_aeropuerto'];
        $ciudad = $fila['ciudad'];
        $pais = $fila['pais'];
        $zona = $fila['zona_horaria'];
        $codigo = $fila['codigo_postal'];
    }
}

$mensaje = null;
if (isset($_POST['update'])) {
    $id_aeropuerto = $_POST['id_aeropuerto'];
    $nombre = $_POST['nombre'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $zona = $_POST['zona'];
    $codigo = $_POST['codigo'];

    $model = new Crud;
    $model->update = "aeropuertos";
    $model->set = "nombre_aeropuerto = '$nombre', ciudad = '$ciudad', pais = '$pais', zona_horaria = '$zona', codigo_postal = '$codigo'";
    $model->condition = "id_aeropuerto = " . $id_aeropuerto;
    $model->Update();
    push_notification("Actualizado correctamente", "El aeropuerto " . $nombre . " ha sido actualizado correctamente");
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
        <h1>Actualizar: <?php echo $nombre; ?></h1>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="ciudad" value="<?php echo $ciudad; ?>" placeholder="Ciudad">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="pais" value="<?php echo $pais; ?>" placeholder="País">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="zona" value="<?php echo $zona; ?>" placeholder="Zona horaría">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" placeholder="Código postal">
            </div>
            <input type="hidden" name="update">
            <input type="hidden" name="id_aeropuerto" value="<?php echo $id_aeropuerto; ?>">
            <input type="submit" value="Actualizar" class="btn btn-success">
        </form>
    </div>
</body>
</html>
