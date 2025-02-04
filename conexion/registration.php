<?php
// si existe algo que me llego por post
if(!empty($_POST)) {
    //conexion a la base de datos 
    require_once 'includes/connection.php';

    //iniciar sesion
    if(!isset($_SESSION)) {
        session_start();
    }

    // recogemos los valores del formulario de registro
    // abreviamos el codigo
    // con esto ? obtenemos el valor y lo guardmaos en la variable
    // si existe el post lo pone en la variable si no pone false 
    /*en la variable mysqli_real_escape_string me quita los caracteres especiales,inutiliza los caracteres 
    especiales que se usan para MySQL que podría poner el usuario */
    /*mysqli_real_escape_string también interpreta que todo lo q pase sea como string y no lo interpreta 
    como parte de la consulta de mysql asi se evita intento de hakeo */
    //trim es para q se guarde sin espacios
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $last_name = isset($_POST['l-name']) ? mysqli_real_escape_string($db, $_POST['l-name']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //array de errores
    $errors = array();

    // validar los datos antes de guardarlos en la base de datos
    // validar nombre
    //preg_match expresion regular 1er parametro patron de busqueda
    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        $validated_name = true;
    }else {
        $validated_name = false;
        $errors['name'] = 'The name is not valid';
    }

    //validar apellidos
    if(!empty($last_name) && !is_numeric($last_name) && !preg_match("/[0-9]/", $last_name)) {
        $validated_last_name = true;
    }else {
        $validated_last_name = false;
        $errors['l-name'] = 'The last name is not valid';
    }

    // validar email
    /*filter_var funcion predefinida, le digo q me valide con FILTER_VALIDATE_EMAIL 
    (constante predefinida) q sea email */
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // validar email duplicados
        $email_check_query = "SELECT id FROM usuarios WHERE email = '$email';";
        $result = mysqli_query($db, $email_check_query);
        if(mysqli_num_rows($result) > 0) {
            $validated_email = false;
            $errors['email'] = 'The email is already in use';
        }else {
            $validated_email = true;
        }
    }else {
        $validated_email = false;
        $errors['email'] = 'The email is not valid';
    }

    // validar contraseña 
    if(!empty($password)) {
        $validated_password = true;
    }else {
        $validated_password = false;
        $errors['password'] = 'The password is empty';
    }

    // si hay o no errores
    if(count($errors) == 0) {

        //cifrar contraseña
        /* La función password_hash se utiliza para generar un hash seguro de la contraseña que 
        puede ser almacenado en una base de datos. Los hashes son unidireccionales, lo que significa 
        que no se puede convertir directamente el hash a la contraseña original, lo cual protege la 
        seguridad de las contraseñas incluso si alguien accede a la base de datos. */
        /*PASSWORD_BCRYPT:
        Es el algoritmo de hashing que se utilizará. En este caso, se utiliza el algoritmo bcrypt, que es uno 
        de los algoritmos recomendados por su alta seguridad y resistencia a ataques como fuerza bruta. */
        /*['cost' => 10]:
        Es un arreglo asociativo que especifica las opciones adicionales para el algoritmo bcrypt.
        La clave cost indica la complejidad computacional del proceso de hashing. El valor 10 indica el número 
        de iteraciones para reforzar el hash. */
        $secure_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        // insertamos el usuario en la tabla usuarios de la BBDD
        //el id null ,curdate() es una funcion de mysql q te da la fecha actual, las comillas es porque sql acepta los string con comillas
        $sql = "INSERT INTO usuarios VALUES(null, '$name', '$last_name', '$email', '$secure_password', CURDATE());";
        $save = mysqli_query($db, $sql);

        // saber si se guardo con exito o no
        if($save) {
            $_SESSION['completed'] = 'The registration was succed';
        }else {
            $_SESSION['errors']['general'] = 'Sign up has failed';
        }
    }else {
        $_SESSION['errors'] = $errors;
    }
}

// nos redirije
header('Location: index.php');