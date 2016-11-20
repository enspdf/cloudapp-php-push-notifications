<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 8:28 PM
 */

require '../../Db/Conexion.php';
require '../../Crud.php';

$model = new Conexion();
$conexion = $model->conectar();
$statement = $conexion->prepare("SELECT * FROM productos");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);
