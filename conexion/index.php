<?php require_once 'includes/header.php'; ?>

<!--content-->
<div class="container mt-3 row justify-content-center">
    <!--breadcrumb-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        </ol>
    </nav>

    <!--slider carousel-->
    <div class="slider col-lg-6 col-md-4 col-sm-6 col-xs-12 m-3">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/assassins creed ac GIF.gif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/Assassins Creed Night GIF by Xbox.gif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/Flying Here I Come GIF by Assassin's Creed.gif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
            
</div>

<h1>Latest posts</h1>

<!--cards-->
<div class="card-group">
    <?php
    $entries = getEntries($db, true);
    if(!empty($entries)):
        // lo hacemos asociativo
        while($entry = mysqli_fetch_assoc($entries)):
    ?>
    <div class="card m-1">
        <img src="..." class="card-img-top" alt="...">
        <?php // me lleva a ver la entrada ?>
        <a href="entry.php?id=<?=$entry['id']?>" class="text-decoration-none">
            <div class="card-body">
                <h5 class="card-title"><?=$entry['titulo']?></h5>
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
    <?php
        endwhile;   
    endif;
    ?>
</div>

<!-- button -->
<div id="ver-todas">
    <a href="entries.php">
        See all posts
    </a>
</div>

<?php require_once 'includes/footer.php'; ?>
