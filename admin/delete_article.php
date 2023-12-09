<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $articleId = (int)$_GET["id"];

    // Delete the article in the database
    if (deleteArticle($pdo, $articleId)) {
        header("Location: articles.php"); // Redirect back to the articles list after deletion
        exit();
    } else {
        echo "Failed to delete the article.";
    }
} else {
    echo "Invalid request.";
}

function deleteArticle($pdo, $articleId) {
    try {
        //prevent SQL injection
        $stmt = $pdo->prepare("DELETE FROM articles WHERE id = :articleId");

        // Bind parameter
        $stmt->bindParam(':articleId', $articleId);

        // Execute the statement
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}


?>

