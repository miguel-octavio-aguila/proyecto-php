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
            <a href="">Create a post</a>
        </li>
    </ol>
</nav>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <h1>Create posts</h1>
    <p class="text-dark text-center">
        Keep the blog updated with new posts so users can read and enjoy great content!
    </p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="save-entry.php" method="POST">
                <label class="col-form-label" for="title">
                    Title:
                </label>
                <input type="text" class="form-control" name="title">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'title') : ''; ?>
                <label class="col-form-label" for="description">
                    Description:
                </label>
                <textarea name="description" class="form-control"></textarea>
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'description') : ''; ?>
                <label class="col-form-label" for="category">
                    Category
                </label>
                <select class="form-select" name="category">
                    <option selected disabled>
                        Category
                    </option>
                    <?php
                    $categories = getCategories($db);
                    if(!empty($categories)):
                        while($category = mysqli_fetch_assoc($categories)):
                    ?>
                    <!-- desplegar el menu de categorias y manda el id de la categoria cuando lo elijo -->
                    <option value="<?=$category['id']?>">
                        <?=$category['nombre']?>
                    </option>
                    <?php
                        endwhile;
                    endif;
                    ?>
                </select>
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'category') : ''; ?>
                <br>

                <input type="submit" class="btn btn-dark mt-3" value="Save">
            </form>
            <?php deleteErrors(); ?>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>