<?php

require __DIR__ . "/template/header.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/comment.php";

if (isset($_GET["id"])) {
    $commentId = (int)$_GET["id"];
    $comment = getCommentById($pdo, $commentId);

    if (!$comment) {
        header("Location: check_comment.php");
        exit();
    }
} else {
    header("Location: check_comment.php");
    exit();
}

?>

<h1 class="py-5">Commentaire de <?= $comment["first_name"]; ?> <?= $comment["last_name"]; ?></h1>

<div>
    <h2>Email: <?= $comment["email"]; ?></h2>
    <p>Prénom: <?= $comment["first_name"]; ?></p>
    <p>Nom: <?= $comment["last_name"]; ?></p>
    <p>Téléphone: <?= $comment["phone"]; ?></p>
    <p>Commentaire: <br> <?= $comment["text_field"]; ?></p>
</div>

<a href="delete_comment.php?id=<?= $comment["id"]?>" onclick="return confirm('Supprimer le commentaire?')">Supprimer le commentaire</a>
<a href="comments.php">Retour aux commentaires</a>

<?php require __DIR__ . "/template/footer.php"; ?>
