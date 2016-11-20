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

$mensaje = null;

if (isset($_REQUEST['id_aerolinea'])) {
    $id_aerolinea = htmlspecialchars($_REQUEST['id_aerolinea']);
    if (!is_numeric($id_aerolinea)) {
        header("location: index");
    } else {
        $model = new Crud;
        $model->deleteFrom = "aerolineas";
        $model->condition = "id_aerolinea = $id_aerolinea";
        $model->Delete();
        push_notification("Eliminado", "El aerolinea " . $id_aerolinea . " se elimino correctamente");
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index");
    }
}
