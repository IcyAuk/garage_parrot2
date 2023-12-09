<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (
        isset($_POST["article_id"]) &&
        isset($_POST["year"]) &&
        isset($_POST["km"]) &&
        isset($_POST["price"]) &&
        isset($_POST["description"])
    ) {
        // Sanitize and validate input data
        $articleId = (int)$_POST["article_id"];
        $year = filter_var($_POST["year"]);
        $km = filter_var($_POST["km"],);
        $price = filter_var($_POST["price"]);
        $description = filter_var($_POST["description"]);

        // Update the article in the database
        if (updateArticle($pdo, $articleId, $year, $km, $price, $description)) {
            echo "Article updated successfully.";
        } else {
            echo "Failed to update the article.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

// article.php

function updateArticle($pdo, $articleId, $year, $km, $price, $description) {
    try {
        //prevent SQL injection
        $stmt = $pdo->prepare("
            UPDATE articles
            SET year = :year, km = :km, price = :price, description = :description
            WHERE id = :articleId
        ");

        // Bind parameters
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':km', $km);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':articleId', $articleId);

        // Execute the statement
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

?>
