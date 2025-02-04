<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

//desde la cabecera me traigo el id de la categoria y con la funcion consigo la categoria
$current_category = getCategory($db, $_GET['id']);

// si no existe lo pateo por si pone cualquier id en la url
if(!isset($current_category['id'])) {
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
                Categories
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="">
                <?=$current_category['nombre']?>
            </a>
        </li>
    </ol>
</nav>

<h1>Posts of <?=$current_category['nombre']?></h1>

<!-- CAJA PRINCIPAL -->
<div class="row">
    <?php
    $entries = getEntries($db, null, $_GET['id']);

    // si existe y hay una o mas entradas
    if(!empty($entries) && mysqli_num_rows($entries) >= 1):
        //lo hacemos asociativo
        while($entry = mysqli_fetch_assoc($entries)):
    ?>

    <div class="col-sm-6">
        <div class="card m-4">
            <img src="..." alt="..." class="card-img-top">
            <a href="entry.php?id=<?=$entry['id']?>">
                <div class="card-body">
                    <h5 class="card-title">
                        <?=$entry['titulo']?>
                    </h5>
                    <p class="card-text">
                        <small class="text-dark">
                            <?=substr($entry['descripcion'], 0, 180)."..."?>
                        </small>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            <?=$entry['categoria'].' | '.$entry['fecha']?>
                        </small>
                    </p>
                </div>
            </a>
        </div>
    </div>
    <?php
        endwhile;
    // si no hay entradas
    else:
    ?>
    <div class="alert alert-dark" role="alert">
        There is no posts on this category
    </div>
    <?php
    endif;
    ?>

</div>
<!-- FIN DE LA CAJA PRICIPAL -->

<?php require_once 'includes/footer.php'; ?>