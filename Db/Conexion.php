<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 10:42 AM
 */
class Conexion {
    public function conectar() {
        $user = 'adminYiR14Wv';
        $password = '_LfDvZlMv1zA';
        $host = '127.4.249.2';
        $dbname = 'cloudapp';

        return $conexion = new PDO("mysql:host=$host;dbname=$dbname;",$user, $password);
    }
}