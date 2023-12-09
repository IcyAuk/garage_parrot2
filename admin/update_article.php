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
        $km = filter_var($_POST["km"]);
        $price = filter_var($_POST["price"]);
        $description = filter_var($_POST["description"]);

        // Check if a new image is uploaded
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            // Handle the image upload
            $uploadDir = __DIR__ . "/../uploads/articles/";
            $imageName = basename($_FILES["image"]["name"]);
            $targetPath = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                // Update the article in the database with the new image
                if (updateArticle($pdo, $articleId, $year, $km, $price, $description, $imageName)) {
                    echo "Article updated successfully.";
                } else {
                    echo "Failed to update the article.";
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            // Update the article in the database without changing the image
            if (updateArticle($pdo, $articleId, $year, $km, $price, $description)) {
                echo "Article updated successfully.";
            } else {
                echo "Failed to update the article.";
            }
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

function updateArticle($pdo, $articleId, $year, $km, $price, $description, $imageName = null) {
    try {
        // Prevent SQL injection
        $stmt = $pdo->prepare("
            UPDATE articles
            SET year = :year, km = :km, price = :price, description = :description
            " . ($imageName ? ", image = :image" : "") . "
            WHERE id = :articleId
        ");

        // Bind parameters
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':km', $km);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':articleId', $articleId);

        if ($imageName) {
            $stmt->bindParam(':image', $imageName);
        }

        // Execute the statement
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}
?>
