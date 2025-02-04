<?php
// si no existe entra en el if
if(!isset($_POST['search'])) {
    header("Location: index.php");
}

require_once 'includes/header.php';
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="">Search</a>
        </li>
    </ol>
</nav>

<h1>Search: <?=$_POST['search']?></h1>

<!-- CAJA PRINCIPAL -->
<div class="row">
    <?php
    $entries = getEntries($db, null, null,  $_POST['search']);

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
        There is no posts on this search
    </div>
    <?php
    endif;
    ?>

</div>
<!-- FIN DE LA CAJA PRICIPAL -->

<?php
require_once 'includes/footer.php';
?>