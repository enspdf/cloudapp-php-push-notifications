<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 5/09/16
 * Time: 11:15 PM
 */

require '../../Db/Conexion.php';
require '../../Crud.php';

$model = new Conexion();
$conexion = $model->conectar();
$statement = $conexion->prepare("SELECT * FROM aviones");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);