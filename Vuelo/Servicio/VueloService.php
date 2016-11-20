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
$statement = $conexion->prepare("SELECT vuel.id_vuelo, vuel.codigo_vuelo, vuel.partida, vuel.partida, vuel.llegada, vuel.asientos, vuel.valor, aero.id_aerolinea, aero.nombre_aerolinea, avio.id_avion, avio.modelo, origen.id_aeropuerto id_aeropuerto_origen, origen.nombre_aeropuerto aeropuerto_origen, destino.id_aeropuerto id_aeropuerto_destino, destino.nombre_aeropuerto aeropuerto_destino FROM vuelos vuel inner join aerolineas aero on aero.id_aerolinea = vuel.id_aerolinea inner join aviones avio on avio.id_avion = vuel.id_avion inner join aeropuertos origen on origen.id_aeropuerto = vuel.id_origen inner join aeropuertos destino on destino.id_aeropuerto = vuel.id_destino");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($result, JSON_PRETTY_PRINT);