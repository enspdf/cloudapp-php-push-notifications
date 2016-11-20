<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 4:03 PM
 */

require '../Db/Conexion.php';
require '../Crud.php';

if (isset($_REQUEST['id_producto'])) {
    $id_producto = htmlspecialchars($_REQUEST['id_producto']);
    $model = new Crud();
    $model->select = "*";
    $model->from = "productos";
    $model->condition = "id_producto = $id_producto";
    $model->Read();
    $filas = $model->rows;
    foreach($filas as $fila) {
        $nombre = $fila['nombre'];
        $descripcion = $fila['descripcion'];
        $categoria = $fila['categoria'];
        $precio = $fila['precio'];
    }
}

$mensaje = null;
if (isset($_POST['update'])) {
    $id_producto = $_POST['id_producto'];
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $categoria = htmlspecialchars($_POST['categoria']);
    $precio = htmlspecialchars($_POST['precio']);

    $model = new Crud;
    $model->update = "productos";
    $model->set = "nombre='$nombre', descripcion='$descripcion', categoria='$categoria', precio=$precio";
    $model->condition = "id_producto = " . $id_producto;
    $model->update();
    $mensaje = $model->mensaje;
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>
    <div class="container">
        <h1>Actualizar: <?php echo $nombre ?></h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?php echo $nombre?>" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control" rows="5" name="descripcion" placeholder="Descripción"><?php echo $descripcion?></textarea>
            </div>
            <div class="form-group">
                <label for="">Categoría</label>
                <input type="text" class="form-control" name="categoria" value="<?php echo $categoria?>" placeholder="Categoría">
            </div>
            <div class="form-group">
                <label for="">Precio</label>
                <input type="text" class="form-control" name="precio" value="<?php echo $precio?>" placeholder="Precio">
            </div>
            <input type="hidden" name="update">
            <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
            <input type="submit" value="Actualizar" class="btn btn-primary">
        </form>
    </div>
</body>
</html>
