<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

//desde la cabecera me traigo el id de la categoria y con la funcion consigo la categoria
$current_entry = getEntry($db, $_GET['id']);

// si no existe lo pateo por si pone cualquier id en la url
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
                Post
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="">
                <?=$current_entry['titulo']?>
            </a>
        </li>
    </ol>
</nav>

<!-- CAJA PRINCIPAL -->
<div class="card-group m-4">
    <div class="card m-1">
        <img src="..." alt="..." class="card-img-top">
        <div class="card-body">
            <h1 class="card-title">
                <?=$current_entry['titulo']?>
            </h1>
            <h2>
                <a class="text-success text-decoration-none" href="category.php?id=<?=$current_entry['categoria_id']?>">
                    <?=$current_entry['categoria']?>
                </a>
            </h2>
            <h4>
                <?=$current_entry['fecha']?> | <?=$current_entry['usuario']?>
            </h4>
            <p class="card-text">
                <small class="text-dark">
                    <?=$current_entry['descripcion']?>
                </small>
            </p>
        </div>
        <!-- editar y borrar -->
        <?php
        // si estoy logeado y soy yo igual al usuario actual
        if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $current_entry['usuario_id']):
        ?>
        <br>
        <a href="edit-entry.php?id=<?=$current_entry['id']?>" type="button" class="btn btn-outline-dark">
            Edit post
        </a>
        <a href="delete-entry.php?id=<?=$current_entry['id']?>" type="button" class="btn btn-outline-dark">
            Delete post
        </a>
        <?php
        endif;
        ?>
    </div>
</div>
<!-- FIN DE LA CAJA PRICIPAL -->

<?php require_once 'includes/footer.php'; ?>