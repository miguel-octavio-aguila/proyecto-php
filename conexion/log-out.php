<?php
session_start();

//borra las sesiones si existe una sesion activa
if(isset($_SESSION['user'])) {
    session_destroy();
}

header("Location: index.php");