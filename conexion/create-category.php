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
            <a href="">Create category</a>
        </li>
    </ol>
</nav>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <h1>Create category</h1>
    <p class="text-dark text-center">
        Add new categories to the blog so that users can use them when creating their posts.    
    </p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="save-category.php" method="POST">
                <label class="col-form-label" for="title">
                    Name of the new category:
                </label>
                <input type="text" class="form-control" name="name" style="font-size: 30px; color: black;">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors_category']) ? showErrors($_SESSION['errors_category'], 'name') : ''; ?>
                

                <input type="submit" class="btn btn-dark mt-3" value="Save">
            </form>
            <?php deleteErrors(); ?>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>