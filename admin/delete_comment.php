<?php

require __DIR__ . "/template/header.php";
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/comment.php";

if (isset($_GET["id"])) {
    $commentId = (int)$_GET["id"];

    // Assuming deleteComment is a function in your comment.php file
    if (deleteComment($pdo, $commentId)) {
        echo "Comment deleted successfully.";
    } else {
        echo "Failed to delete the comment.";
    }
} else {
    echo "Invalid comment ID.";
}

// Redirect to the page where you display the comments after deletion
header("Location: index.php");
exit();

// comment.php

function deleteComment(PDO $pdo, int $commentId): bool {
    try {
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = :commentId");
        $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

?>
