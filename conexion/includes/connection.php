<?php

//conexion
$server = 'localhost';
$user = 'root';
$password = '';
$data_base = 'blog';
$db = mysqli_connect($server, $user, $password, $data_base);

//query para que funcionene los caracteres en español
mysqli_query($db, "SET NAMES 'utf8'");

//iniciar sesion
if(!isset($_SESSION)) {
    session_start();
}