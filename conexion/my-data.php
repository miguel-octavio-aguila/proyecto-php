<?php
require_once 'includes/redirection.php';
require_once 'includes/header.php';
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="">My data</a>
        </li>
    </ol>
</nav>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <h1>My data</h1>
    <!-- Show success or error messages -->
    <?php
    if(isset($_SESSION['completed'])) {
        echo '<div class="alert alert-success">'.$_SESSION['completed'].'</div>';
    } elseif(isset($_SESSION['errors']['general'])) {
        echo '<div class="alert alert-danger">'.$_SESSION['errors']['general'].'</div>';
    }
    ?>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="update-user.php" method="POST">
                <label class="col-form-label" for="name">
                    Name
                </label>
                <input type="text" class="form-control" name="name" value="<?=$_SESSION['user']['nombre']?>">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'name') : ''; ?>
                <label class="col-form-label" for="l-name">
                    Last name
                </label>
                <input type="text" class="form-control" name="l-name" value="<?=$_SESSION['user']['apellidos']?>">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'l-name') : ''; ?>
                <label class="col-form-label" for="email">
                    Email
                </label>
                <input type="email" class="form-control" name="email" value="<?=$_SESSION['user']['email']?>">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>

                <input type="submit" class="btn btn-dark mt-3" value="Update">
            </form>
            <?php deleteErrors(); ?>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>