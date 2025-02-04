<?php
if(!empty($_POST)) {
    require_once 'includes/conexion.php';
    
    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $last_name = isset($_POST['l-name']) ? mysqli_real_escape_string($db, $_POST['l-name']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    
    $errors = array();
    
    // Validate the data before saving it in the database
    if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        $name_validate = true;
    } else {
        $name_validate = false;
        $errors['name'] = 'The name is not valid';
    }
    
    if(!empty($last_name) && !is_numeric($last_name) && !preg_match("/[0-9]/", $last_name)) {
        $last_name_validate = true;
    } else {
        $last_name_validate = false;
        $errors['l-name'] = 'The last name is not valid';
    }
    
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validate = true;
    } else {
        $email_validate = false;
        $errors['email'] = 'The email is not valid';
    }
    
    // Check if there are no errors before updating the user
    if(count($errors) == 0) {
        $user = $_SESSION['user'];

        // Check if the email already exists
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $user['id'] || empty($isset_user)) {
            // Update user in the database
            $sql = "UPDATE usuarios SET nombre = '$name', apellidos = '$last_name', email = '$email' WHERE id = ".$user['id'];
            $save = mysqli_query($db, $sql);
            
            if($save) {
                // Update session data
                $_SESSION['user']['nombre'] = $name;
                $_SESSION['user']['apellidos'] = $last_name;
                $_SESSION['user']['email'] = $email;

                $_SESSION['completed'] = 'Your data has been updated successfully';
            } else {
                $_SESSION['errors']['general'] = 'The email already exists';
            }
        } else {
            $_SESSION['errors']['general'] = 'Failed to update your data'. mysqli_error($db);
        }
    }
}

header('Location: my-data.php');