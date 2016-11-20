<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 10:45 AM
 */

class Crud {
    public $insertInto;
    public $insertColumns;
    public $insertValues;
    public $mensaje;

    public $select;
    public $from;
    public $condition;
    public $rows;

    public $update;
    public $set;

    public $deleteFrom;

    public function Create() {
        $model = new Conexion();
        $conexion = $model->conectar();
        $insertInto = $this->insertInto;
        $insertColumns = $this->insertColumns;
        $insertValues = $this->insertValues;
        $sql = "INSERT INTO $insertInto ($insertColumns) VALUES ($insertValues)";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            $this->mensaje = '<div class="alert alert-danger">Ha ocurrido un error al crear el registro</div>';
        } else {
            $consulta->execute();
            $this->mensaje = '<div class="alert alert-success">Registro creado correctamente</div>';
        }
    }

    public function Read() {
        $model = new Conexion();
        $conexion = $model->conectar();
        $select = $this->select;
        $from = $this->from;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = " WHERE " . $condition;
        }
        $sql = "SELECT $select FROM $from $condition";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();

        while ($filas = $consulta->fetch()) {
            $this->rows[] = $filas;
        }
    }

    public function Update() {
        $model = new Conexion;
        $conexion = $model->conectar();
        $update = $this->update;
        $set = $this->set;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = " WHERE " . $condition;
        }
        $sql = "UPDATE $update SET $set $condition";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            $this->mensaje = '<div class="alert alert-danger">Ha ocurrido un error al actualizar el registro</div>';
        } else {
            $consulta->execute();
            $this->mensaje = '<div class="alert alert-success">Registro actualizado correctamente</div>';
        }
    }

    public function Delete() {
        $model = new Conexion;
        $conexion = $model->conectar();
        $deleteFrom = $this->deleteFrom;
        $condition = $this->condition;
        if ($condition != '') {
            $condition = " WHERE " . $condition;
        }
        $sql = "DELETE FROM $deleteFrom $condition";
        $consulta = $conexion->prepare($sql);
        if (!$consulta) {
            $this->mensaje = '<div class="alert alert-danger">Ha ocurrido un error al eliminar el registro</div>';
        } else {
            $consulta->execute();
            $this->mensaje = '<div class="alert alert-success">Registro eliminado correctamente</div>';
        }
    }

    public function Login($user, $password) {
        $model = new Conexion;
        $conexion = $model->conectar();
        $select = $this->select;
        $from = $this->from;
        $sql = "SELECT $select FROM $from WHERE usuario=:username AND contrasena=:password";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(":username", $user, PDO::PARAM_STR);
        $consulta->bindParam(":password", $password, PDO::PARAM_STR);
        $consulta->execute();
        while ($filas = $consulta->fetch()) {
            $this->rows[] = $filas;
        }
    }
}