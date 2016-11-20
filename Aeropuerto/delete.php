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

$mensaje = null;

if (isset($_REQUEST['id_aeropuerto'])) {
    $id_aeropuerto = htmlspecialchars($_REQUEST['id_aeropuerto']);
    if (!is_numeric($id_aeropuerto)) {
        header("location: index");
    } else {
        $model = new Crud;
        $model->deleteFrom = "aeropuertos";
        $model->condition = "id_aeropuerto = $id_aeropuerto";
        $model->Delete();
        push_notification("Eliminado", "El aeropuerto " . $id_aeropuerto . " ha sido eliminado correctamente");
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index");
    }
}
