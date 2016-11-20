<?php
/**
 * Created by PhpStorm.
 * User: SHACKOX
 * Date: 4/09/16
 * Time: 10:11 PM
 */

session_start();
if (!isset($_SESSION['nombre'])) {
    header("location: /");
}

if ($_GET['logout'] == 'true') {
    unset($_SESSION['nombre']);
    session_destroy();
    header("location: /");
}

?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" data-turbolinks-action="replace">AeroVelero</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/Aerolinea/index" data-turbolinks-action="replace">Aerolineas</a></li>
                <li><a href="/Aeropuerto/index" data-turbolinks-action="replace">Aeropuertos</a></li>
                <li><a href="/Avion/index" data-turbolinks-action="replace">Aviones</a></li>
                <li><a href="/Reserva/index" data-turbolinks-action="replace">Reservas</a></li>
                <li><a href="/Vuelo/index" data-turbolinks-action="replace">Vuelos</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php  echo $_SESSION['nombre']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $_SERVER['PHP_SELF'] . '?logout=true'; ?>">Cerrar sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
