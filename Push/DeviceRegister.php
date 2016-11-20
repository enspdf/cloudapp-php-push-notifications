<?php

    require '../Db/Conexion.php';
    require '../Crud.php';

    if (isset($_POST['Token'])) {
        $token = $_POST['Token'];

        $model = new Conexion();
        $conexion = $model->conectar();
        $statement = $conexion->prepare("INSERT INTO users (Token) VALUES ('$token') ON DUPLICATE KEY UPDATE Token = '$token'");
        $statement->execute();


    }