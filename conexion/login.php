<?php

//iniciar la session y la conexion a bd
require_once 'includes/connection.php';

//recoger datos del formulario 
if(!empty($_POST)) {

    // borrar error antiguo si existe
    if(isset($_SESSION['error_login'])) {
        //session_unset() -> Libera todas las variables y no espera argumento
        //unset() -> Libera la variable pasada como argumento
        //elimina session para limpiarla:
		unset($_SESSION['error_login']);
    }

    //recoger datos del formulario
    //trim para q no guarde espacios
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    /* si login da true y contamos el numero de filas 
    q tiene la consulta login es = a 1 */
    if($login && mysqli_num_rows($login) == 1) {
        /* mysqli_fetch_assoc saca el array asociativo de la consulta, o sea, 
        del usuario , de ahi voy a necesitar el password */
        $user = mysqli_fetch_assoc($login);

        // comprobar la contraseña
        /*verifica q sea un sifrado, un hash, y $usuario es un array asociativo con 
        todo el contenido del usuario esntonces saco el password $usuario['password'] */
        //password_verify tambien compara las passwords
        $verify = password_verify($password, $user['password']);
        if($verify) {
            //si da true
			// Utilizar una sesión para guardar los datos del usuario logueado
            //guardo el array asociativo en esta session
            $_SESSION['user'] = $user;
        }else {
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Login has failed";
        }
    }else {
        // Si algo falla enviar una sesión con el fallo
        $_SESSION['error_login'] = "Login has failed";
    }
}

// Redirigir al index.php
header('Location: index.php');