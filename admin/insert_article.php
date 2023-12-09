<?php
require_once __DIR__ . "/../lib/config.php";
require_once __DIR__ . "/../lib/pdo.php";
require_once __DIR__ . "/../lib/article.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (
        isset($_POST["title"]) &&
        isset($_POST["year"]) &&
        isset($_POST["km"]) &&
        isset($_POST["price"]) &&
        isset($_POST["description"])
    ) {
        // Sanitize and validate input data
        $title = filter_var($_POST["title"]);
        $year = filter_var($_POST["year"]);
        $km = filter_var($_POST["km"]);
        $price = filter_var($_POST["price"]);
        $description = filter_var($_POST["description"]);

        // Handle image upload
        $imagePath = handleImageUpload();

        // Insert the new article into the database
        if (insertArticle($pdo, $title, $year, $km, $price, $description, $imagePath)) {
            echo "Article created successfully.";
        } else {
            echo "Failed to create the article.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request method.";
}

function handleImageUpload() {
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $name = basename($_FILES["image"]["name"]);
        $target_path = "../uploads/articles/" . $name;

        if (move_uploaded_file($tmp_name, $target_path)) {
            return $target_path;
        } else {
            echo "Failed to upload image.";
            exit();
        }
    }

    return null;
}

function insertArticle($pdo, $title, $year, $km, $price, $description, $imagePath) {
    try {
        // Extract filename from the image path
        $imageName = basename($imagePath);

        //prevent nasty bad SQL injection
        $stmt = $pdo->prepare("
            INSERT INTO articles (title, year, km, price, description, image)
            VALUES (:title, :year, :km, :price, :description, :image)
        ");

        // Bind parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':km', $km);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $imageName);

        // Execute the statement
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}

?>
