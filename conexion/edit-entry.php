<?php
require_once 'includes/redirection.php';
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$current_entry = getEntry($db, $_GET['id']);

// validacion
if(!isset($current_entry['id'])) {
    header("Location: index.php");
}
?>
<?php require_once 'includes/header.php'; ?>

<!--breadcrumb-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item">
            <a href="index.php">
                Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="">
                Edit entry
            </a>
        </li>
    </ol>
</nav>

<!-- CAJA PRINCIPAL -->

<div id="principal">
    <h1>Edit entry</h1>
    <p class="text-dark text-center">
        Edit your entry <?=$current_entry['titulo']?>
    </p>
    <br>
    <div class="row justify-content-lg-center">
        <div class="col-10 col-m-6 col-lg-4 m-3">
            <form action="save-entry.php?edit=<?=$current_entry['id']?>" method="POST">
                <label class="col-form-label" for="title">
                    Title:
                </label>
                <input type="text" class="form-control" name="title" value="<?=$current_entry['titulo']?>">
                <!-- validate errors -->
                <?php echo isset($_SESSION['errors_entry']) ? showErrors($_SESSION['errors_entry'], 'title') : ''; ?>
                <label class="col-form-label" for="description">
                    Description:
                </label>
                <textarea name="description" class="form-control"><?=$current_entry['descripcion']?></textarea>
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
                    <!-- igualando los id de las categorias pongo el enfoque en la cotegoria actual y selected="selected" me selecciona el elemento -->
                    <option value="<?=$category['id']?>" <?=($category['id'] == $current_entry['categoria_id']) ? 'selected="selected"' : '' ?>>
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
