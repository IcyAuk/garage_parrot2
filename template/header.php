<!-- MUST HAVE FILE FOR THE WHOLE WEBSITE. -->
<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/session.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Index</title>
</head>
<body>
    <!-- Header -->
    <header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3">
        <div class="container">
            <a href="index.php" class="navbar-brand">Garage V Parrot</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">

                <div class="d-flex">

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="actualites.php" class="nav-link">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a href="reviews.php" class="nav-link">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link">About us</a>
                        </li>
                    </ul>
                </div>
                
                <div class="col-md-3 text-end ms-auto">
                <?php
                
                if (isset($_SESSION["user"])){?>
                    <a href="logout.php" class="btn btn-outline-warning me-2">Administration</a>
                <?php }

                if (isset($_SESSION["user"])){?>
                    <a href="logout.php" class="btn btn-outline-danger me-2">Déconnexion</a>
                <?php } else { ?>
                    <a href="login.php" class="btn btn-outline-light me-2">Connexion</a>
                    <?php } ?>
            </div>
            </div>
        </div>
    </nav>


    </div>
    </header>