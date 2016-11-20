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

$mensaje = null;

if (isset($_REQUEST['id_avion'])) {
    $id_avion = htmlspecialchars($_REQUEST['id_avion']);
    if (!is_numeric($id_avion)) {
        header("location: index");
    } else  {
        $model = new Crud;
        $model->deleteFrom = "aviones";
        $model->condition = "id_avion = " . $id_avion;
        $model->Delete();
        push_notification("Avión eliminado", "El avión con identificador " . $id_avion . " ha sido eliminado");
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index");
    }
}