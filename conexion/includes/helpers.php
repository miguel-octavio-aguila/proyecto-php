<?php

/*son funciones globales la cual se puede utilizar en cualquier 
parte del proyecto que se necesite, el principal objetivo 
del helper es «ayudar» a no repetir código*/

function getCategories($connection) {
    //conexion es db q la agarro gracias al include en cabecera
    //lo ordena de manera ascendente al id
    $sql = "SELECT * FROM categorias ORDER BY id ASC";
    $categories = mysqli_query($connection, $sql);

    // creo un array
    $result = array();

    if($categories && mysqli_num_rows($categories) >= 1) {
        //si $categorias es true (si hay algo dentro) y contando las filas de ese array, si es mayor igual a 1
        $result = $categories;
    }

    return $result;
}

function getCategory($connection, $id) {
    //conecto y traigo el id de la categoria
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $category = mysqli_query($connection, $sql);

    $result = array();
    if($category && mysqli_num_rows($category) >= 1) {
        // si hay algo lo pongo como asosiativo
        $result = mysqli_fetch_assoc($category);
    }

    return $result;
}

function showErrors($errors, $index) {
    //le paso el array errores y un campo o sea el nombre del campo del indice q quiero mostrar
    $alert = '';

    //si existe el array con ese campo y no esta vacio
    if(isset($errors[$index]) && !empty($index)) {
        //o sea el campo muestra el nombre del indice del array
        $alert = '<div class="alert alert-danger">'.$errors[$index].'</div>';
    }

    return $alert;
}

function deleteErrors() {
    $delete = true;

    if(isset($_SESSION['errors'])) {
        $_SESSION['errors'] = null;
        $delete = true;
    }

    if(isset($_SESSION['errors_entry'])) {
        $_SESSION['errors_entry'] = null;
        $delete = true;
    }

    if(isset($_SESSION['errors_category'])) {
        $_SESSION['errors_category'] = null;
        $delete = true;
    }

    if(isset($_SESSION['completed'])) {
        $_SESSION['completed'] = null;
        $delete = true;
    }

    return $delete;
}

function getEntries($connection, $limit = null, $category = null, $search = null) {
    /*la funcion es de un parametro el
    parametro categoria es el id */
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
    "INNER JOIN categorias c ON e.categoria_id = c.id ";

    // agregamos la parte de la categoria
    if(!empty($category)) {
        $sql .= "WHERE e.categoria_id = $category ";
    }

    // agregamos la parte de busqueda para encontrar la entrada
    if(!empty($search)) {
        $sql .= "WHERE e.titulo LIKE '%$search%' ";
    }

    $sql .= "ORDER BY e.id DESC ";

    if($limit) {
        // le agrego a la query un limite de 4 entradas
        $sql .= "LIMIT 4";
    }

    $entries = mysqli_query($connection, $sql);

    $result = array();
    if($entries && mysqli_num_rows($entries) >= 1) {
        $result = $entries;
    }

    // mostramos las entradas
    return $result;
}

function getEntry($connection, $id) {
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario ".
            "FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ".
		    "INNER JOIN usuarios u ON e.usuario_id = u.id ".
		    "WHERE e.id = $id";

    $entry = mysqli_query($connection, $sql);

    $result = array();
    if($entry && mysqli_num_rows($entry) >= 1) {
        $result = mysqli_fetch_assoc($entry);
    }

    return $result;
}