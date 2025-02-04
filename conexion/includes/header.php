<?php require_once "connection.php" ?>
<?php require_once "helpers.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videogames Blog</title>
    <!-- unimos los links de estilos de css y bootstrap-->
    <link rel="stylesheet" href="CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
</head>

<body>
    
    <!-- dentro del div para ajustar en medio el contenedor-->
    <div class="container">

        <!--header-->
        <header class="col-md-12 mt-2">
            <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
                <div class="container-fluid">
                    <!--logo-->
                    <div id="logo">
                        <a class="navbar-brand" href="index.php">Games</a>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                            </li>
                            <!--categories-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- <li><a class="dropdown-item" href="#">Action</a></li> -->
                                    <?php 
                                    $categories = getCategories($db);
                                    // convierto a un array asociativo a categorias si es que no está vacío
                                    if(!empty($categories)):
                                        while($category = mysqli_fetch_assoc($categories)):
                                    ?>
                                    <li>
                                        <a class="dropdown-item" href="category.php?id=<?=$category['id']?>">
                                            <?=$category['nombre']?>
                                        </a>
                                    </li>
                                    <?php
                                        endwhile;
                                    endif;
                                    ?>
                                </ul>
                            </li>
                        </ul>
    
                        <!--log in y sign up del lado derecho-->
                        <!-- welcome -->
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <!-- si no existe la sesion esto no se muestra -->
                            <?php if(!isset($_SESSION['user'])): ?>
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#log-in">
                                    Log in
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- Button trigger modal -->
                                <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#sign-up">
                                    Sign up
                                </a>
                            </li>
                            <?php endif; ?>
                            <!-- si existe la sesion -->
                            <?php if(isset($_SESSION['user'])): ?>
                            <li class="nav-item dropdown">
                                <!-- Button trigger modal -->
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Welcome, 
                                    <!-- muestro nombre y apellido -->
                                    <?=$_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos']; ?>
                                </a>
                                <!-- botones -->
                                 <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href=""></a>
                                        <a class="dropdown-item" href="create-entries.php">Create a Post</a>
                                        <a class="dropdown-item" href="create-category.php">Create Category</a>
                                        <a class="dropdown-item" href="my-data.php">My Data</a>
                                        <a class="dropdown-item" href="log-out.php">Log out</a>
                                    </li>
                                 </ul>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <!--input search-->
                        <form class="d-flex" role="search" action="search.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

                    <!-- log in start-->
                    <!-- Modal -->
                    <div class="modal fade" id="log-in" tabindex="-1" aria-labelledby="log-in" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="login.php" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Identify</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--mail-->
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email"
                                        name="email" class="form-control" id="email">
                                        <!--passwrod-->
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password"
                                        name="password" class="form-control" id="password">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- log in end-->

                    <!-- sign up start-->
                    <!-- Modal -->
                    <div class="modal fade" id="sign-up" tabindex="-1" aria-labelledby="sign-up" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="registration.php" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registration</h1>
                                        <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!--name-->
                                        <label for="name" class="form-label">Name</label>
                                        <input type="name" name="name" class="form-control" id="name">
                                        <!-- validate errors -->
                                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'name') : ''; ?>
                                        <!--last name-->
                                        <label for="l-name" class="form-label">Last Name</label>
                                        <input type="l-name" name="l-name"class="form-control" id="l-name">
                                        <!-- validate errors -->
                                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'l-name') : ''; ?>
                                        <!--mail-->
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email">
                                        <!-- validate errors -->
                                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
                                        <!--passwrod-->
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        <!-- validate errors -->
                                        <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- sign up end-->
                </div>
            </nav>
        </header>
