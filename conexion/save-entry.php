<?php

if(!empty($_POST)) {
    require_once 'includes/connection.php';

    $title = isset($_POST['title']) ? mysqli_real_escape_string($db, $_POST['title']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
    $category = isset($_POST['category']) ? (int)$_POST['category'] : false;

    $user = $_SESSION['user']['id'];

    // validacion
    $errors = array();

    if(empty($title)) {
        $errors['title'] = 'The title is not valid';
    }

    if(empty($description)) {
        $errors['description'] = 'The description is not valid';
    }

    if(empty($category)) {
        $errors['category'] = 'The category is not valid';
    }

    // si hay o no errores
    if(count($errors) == 0) {

        // este get viene de edit-entry.php
        if(isset($_GET['edit'])) {
            $entry_id = $_GET['edit'];
            $user_id = $_SESSION['user']['id'];

            $sql = "UPDATE entradas SET titulo = '$title', descripcion = '$description', categoria_id = $category WHERE id = $entry_id AND usuario_id = $user_id;";
        } else {
            $sql = "INSERT INTO entradas VALUES(null, '$user', '$category', '$title', '$description', CURDATE());";
        }

        $save = mysqli_query($db, $sql);
        header("Location: index.php");
    }else {
        // creo sesion para mostrarla en el archivo create-entries cuando haya error
        $_SESSION['errors_entry'] = $errors;
        if(isset($_GET['edit'])) {
            header("Location: edit-entry.php?id=".$_GET['edit']);
        } else {
            header("Location: create-entries.php");
        }
    }

} else {
    header("Location: create-entries.php");
}