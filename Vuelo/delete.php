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

if (isset($_REQUEST['id_vuelo'])) {
    $id_vuelo = htmlspecialchars($_REQUEST['id_vuelo']);
    if (!is_numeric($id_vuelo)) {
        header("location: index");
    } else {
        $model = new Crud;
        $model->deleteFrom = "vuelos";
        $model->condition = "id_vuelo = $id_vuelo";
        $model->Delete();
        push_notification("Vuelo eliminado", "El vuelo " . $id_vuelo . " ha sido eliminado correctamente");
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index");
    }
}
