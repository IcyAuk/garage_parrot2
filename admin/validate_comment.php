<?php

require __DIR__ . "/template/header.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/comment.php";

if (isset($_GET["id"])) {
    $commentId = (int)$_GET["id"];

    // Assuming validateComment is a function in your comment.php file
    if (validateComment($pdo, $commentId)) {
        echo "Comment validated successfully.";
    } else {
        echo "Failed to validate the comment.";
    }
} else {
    echo "Invalid comment ID.";
}

// Redirect to the page where you display the comments after validation
header("Location: comments.php");
exit();

// comment.php

function validateComment(PDO $pdo, int $commentId): bool {
    try {
        $stmt = $pdo->prepare("UPDATE comments SET validated = 1 WHERE id = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

?>