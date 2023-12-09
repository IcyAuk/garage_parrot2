<?php
require __DIR__ . "/template/header.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";
?>

<h1 class="py-5">Créer un nouvel article</h1>

<form method="post" action="insert_article.php" enctype="multipart/form-data">
    <label for="title">Titre:</label>
    <input type="text" name="title" required>
    <br>

    <label for="year">Année:</label>
    <input type="text" name="year" required>
    <br>

    <label for="km">Kilométrage:</label>
    <input type="text" name="km" required>
    <br>

    <label for="price">Prix:</label>
    <input type="text" name="price" required>
    <br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <br>

    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*">
    <br>

    <input type="submit" value="Créer l'article">
</form>

<?php require __DIR__ . "/template/footer.php"; ?>
