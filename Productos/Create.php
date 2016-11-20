<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 3/09/16
 * Time: 10:54 AM
 */

require '../Db/Conexion.php';
require '../Crud.php';

$mensaje = null;
if (isset($_POST["create"])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $categoria = htmlspecialchars($_POST['categoria']);
    $precio = $_POST['precio'];

    if (!is_numeric($precio)) {
        $mensaje = '<div class="alert alert-danger">El campo precio debe ser numérico</div>';
    } else if ($nombre == '') {
        $mensaje = '<div class="alert alert-danger">El campo nombre es requerido</div>';
    } else if ($descripcion == '') {
        $mensaje = '<div class="alert alert-danger">El campo descripción es requerido</div>';
    } else if ($categoria == '') {
        $mensaje = '<div class="alert alert-danger">El campo categoría es requerido</div>';
    } else {
        $model = new Crud;
        $model->insertInto = 'productos';
        $model->insertColumns = 'nombre, descripcion, categoria, precio';
        $model->insertValues = "'$nombre', '$descripcion', '$categoria', $precio";
        $model->Create();
        $mensaje = $model->mensaje;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear</title>
    <?php include '../Base/HeaderBase.php' ?>
</head>
<body>

    <div class="container">
        <h1>Crear Productos</h1>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <?php echo $mensaje; ?>
            </div>
            <div class="form-group">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control" rows="5" name="descripcion" placeholder="Descripción"></textarea>
            </div>
            <div class="form-group">
                <label for="">Categoría</label>
                <input type="text" class="form-control" name="categoria" placeholder="Categoría">
            </div>
            <div class="form-group">
                <label for="">Precio</label>
                <input type="text" class="form-control" name="precio" placeholder="Precio">
            </div>
            <input type="hidden" name="create">
            <input type="submit" value="Guardar" class="btn btn-primary">
        </form>
    </div>

</body>
</html>
