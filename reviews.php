<?php

require __DIR__ . "/template/header.php";

require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/comment.php";

if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}

$comments = getComments($pdo, ADMIN_ITEM_PER_PAGE, $page);

$totalComments = getTotalComments($pdo);

$totalPages = ceil($totalComments / ADMIN_ITEM_PER_PAGE);

?>

<div class="container px-5">

<h1 class="py-5">Commentaires</h1>

<table class="table">
    <thead>
        <tr>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) { ?>
            <?php if ($comment["validated"] == 1) { ?>
                <tr>
                    <td><?= $comment["first_name"]; ?></td>
                    <td><?= $comment["last_name"]; ?></td>
                    <td><?= substr($comment["text_field"], 0, 500); ?><?= strlen($comment["text_field"]) > 500 ? "..." : ""; ?></td>
                    <td>
                        <a href="check_comment.php?id=<?= $comment["id"] ?>">Voir plus</a>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>

<?php if ($totalPages > 1) { ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if ($i === $page) {echo "active";} ?> "><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>

</div>

<?php require __DIR__ . "/template/footer.php"; ?>
