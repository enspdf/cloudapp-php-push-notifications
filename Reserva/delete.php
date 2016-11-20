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

if (isset($_REQUEST['id_reserva'])) {
    $id_reserva = htmlspecialchars($_REQUEST['id_reserva']);
    if (!is_numeric($id_reserva)) {
        header("location: index");
    } else  {
        $model = new Crud;
        $model->deleteFrom = "reservas";
        $model->condition = "id_reserva = " . $id_reserva;
        $model->Delete();
        push_notification("Reserva eliminada", "La reserva " . $id_reserva . " ha sido eliminada correctamente");
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index");
    }
}