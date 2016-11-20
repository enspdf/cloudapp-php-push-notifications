<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 5:18 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';
$mensaje = null;

if (isset($_REQUEST['id_producto'])) {
    $id_producto = htmlspecialchars($_REQUEST['id_producto']);
    if (!is_numeric($id_producto)) {
        header("location: index.php");
    } else {
        $model = new Crud;
        $model->deleteFrom = "productos";
        $model->condition = "id_producto = $id_producto";
        $model->Delete();
        $mensaje = $model->mensaje;
        session_start();
        $_SESSION['mensaje'] = $mensaje;
        header("location: index.php");
    }
}