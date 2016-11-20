<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 4/09/16
 * Time: 9:20 AM
 */

require './Db/Conexion.php';
require './Crud.php';

session_start();
if (isset($_SESSION['username']) && isset($_SESSION['nombre'])) {
    header("location: /panel/index");
} else {
    $mensaje = null;
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        if ($username == '') {
            $mensaje = '<div class="alert alert-danger">El campo usuario es requerido</div>';
        } else if ($password == '') {
            $mensaje = '<div class="alert alert-danger">El campo contraseña es requerido</div>';
        } else {
            $model = new Crud;
            $model->select = '*';
            $model->from = 'usuarios';
            $model->Login($username, $password);
            $filas = $model->rows;
            if (count($filas) > 0) {
                $_SESSION['username'] = $filas[0]['usuario'];
                $_SESSION['nombre'] = $filas[0]['nombre'];
                header("location: /panel/index");
            } else {
                $mensaje = '<div class="alert alert-danger">El usuario o contraseña son incorrectos</div>';
            }
        }
    }
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <?php include './Base/HeaderBase.php' ?>
</head>
<body>
    <br><br>
    <div id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="well">
                        <h3 class="text-center">Iniciar Sesión</h3>
                        <hr>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" role="form">
                            <div class="form-group">
                                <?php echo $mensaje; ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Usuario" autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                            </div>
                            <div class="checkbox">
                                <label for="">
                                    <input type="checkbox"> Recordarme
                                </label>
                            </div>
                            <input type="hidden" name="login">
                            <input type="submit" class="btn btn-success btn-block" value="Iniciar sesión" />
                            <br>
                        </form>
                        <div class="links">
                            <a href="#">Olvido la contraseña?</a>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="text-center">
                            <a href="/Register" data-turbolinks-action="replace">Crear cuenta &#8594;</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
