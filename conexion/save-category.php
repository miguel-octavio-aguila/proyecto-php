<?php

if(!empty($_POST)) {
    require_once 'includes/connection.php';

    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;

    // validacion
    $errors = array();

    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        // validar categorias duplicadas
        $name_check_query = "SELECT id FROM categorias WHERE nombre = '$name';";
        $result = mysqli_query($db, $name_check_query);
        if(mysqli_num_rows($result) > 0) {
            $validated_name = false;
            $errors['name'] = 'The category already exists';
        }else {
            $validated_name = true;
        }
    } else {
        $validated_name = false;
        $errors['name'] = 'The name is not valid';
    }

    // si hay o no errores
    if(count($errors) == 0) {

        $sql = "INSERT INTO categorias VALUES(null, '$name');";
        $save = mysqli_query($db, $sql);

        header("Location: index.php");
    }else {
        // creo sesion para mostrarla en el archivo create-category cuando haya error
        $_SESSION['errors_category'] = $errors;
        header("Location: create-category.php");
    }

} else {
    header("Location: create-category.php");
}