<?php

require __DIR__ . "/template/header.php";

require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/comment.php";

if (isset($_GET["page"])) {
    $page = (int)$_GET["page"];
} else {
    $page = 1;
}

$comments = getComments($pdo, ADMIN_ITEM_PER_PAGE, $page);

$totalComments = getTotalComments($pdo);

$totalPages = ceil($totalComments / ADMIN_ITEM_PER_PAGE);

?>

<h1 class="py-5">Messages</h1>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) { ?>
            <?php if ($comment["validated"] == 2) { ?>
                <tr>
                    <th scope="row"><?= $comment["id"]; ?></th>
                    <td><?= $comment["email"]; ?></td>
                    <td><?= $comment["first_name"]; ?></td>
                    <td><?= $comment["last_name"]; ?></td>
                    <td><?= $comment["phone"]; ?></td>
                    <td><?= substr($comment["text_field"], 0, 100); ?><?= strlen($comment["text_field"]) > 100 ? "..." : ""; ?></td>
                    <td>
                        <a href="check_message.php?id=<?= $comment["id"] ?>">Voir plus</a>
                        <a href="delete_messaget.php?id=<?= $comment["id"] ?>" onclick="return confirm('Delete message ?')">Supprimer</a>
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

<?php require __DIR__ . "/template/footer.php"; ?>
