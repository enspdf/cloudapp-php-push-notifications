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
$statement = $conexion->prepare("SELECT res.asiento, res.fecha, vuel.codigo_vuelo, usu.nombre FROM reservas res inner join vuelos vuel on vuel.id_vuelo = res.id_vuelo inner join usuarios usu on usu.id_usuario = res.usuario");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);