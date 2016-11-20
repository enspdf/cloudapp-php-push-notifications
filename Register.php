<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 4/09/16
 * Time: 9:20 AM
 */

require './Db/Conexion.php';
require './Crud.php';
require 'Push/GeneratePushNotification.php';

$mensaje = null;
if (isset($_POST['register'])) {
    $nombre = htmlspecialchars($_POST['nombre']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if ($nombre == '') {
        $mensaje = '<div class="alert alert-danger">El campo nombre es requerido</div>';
    } else if ($username == '') {
        $mensaje = '<div class="alert alert-danger">El campo usuario es requerido</div>';
    } else if ($password == '') {
        $mensaje = '<div class="alert alert-danger">El campo contraseña es requerido</div>';
    } else {
        $model = new Crud;
        $model->insertInto = 'usuarios';
        $model->insertColumns = 'usuario, contrasena, nombre';
        $model->insertValues = "'$username', '$password', '$nombre'";
        $model->Create();
        push_notification("Bienvenido " . $nombre, "Tu usuario: " . $username . " esta listo para inicar sesión");
        $mensaje = $model->mensaje;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <?php include './Base/HeaderBase.php' ?>
</head>
<body>
    <br><br>
    <div id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="well">
                        <h3 class="text-center">Registro</h3>
                        <hr>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
                            <div class="form-group">
                                <?php echo $mensaje; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Usuario" name="username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                            </div>
                            <input type="hidden" name="register">
                            <input type="submit" class="btn btn-success btn-block" value="Registrarse" />
                        </form>
                    </div>
                    <div class="row">
                        <h5 class="text-center">
                            <a href="/" data-turbolinks-action="replace">Iniciar sesión &#8594;</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
