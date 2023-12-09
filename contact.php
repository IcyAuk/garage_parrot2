<?php
include __DIR__."/template/header.php";
include __DIR__."/lib/pdo.php";
include __DIR__."/lib/article.php";

// Retrieve values from URL parameters
$articleId = isset($_GET["id"]) ? $_GET["id"] : null;
$title = isset($_GET["title"]) ? $_GET["title"] : null;
$year = isset($_GET["year"]) ? $_GET["year"] : null;
$km = isset($_GET["km"]) ? $_GET["km"] : null;
$price = isset($_GET["price"]) ? $_GET["price"] : null;
$description = isset($_GET["description"]) ? $_GET["description"] : null;

// Create a message based on article details
$message = "I am interested in the article: $title - $year - $km KM - $price €";

?>

<div class="container px-5">
    <h1 class="py-5">Contact Form for <?= $title; ?></h1>

    <form method="post" action="post_contact.php">
        <input type="hidden" name="article_id" value="<?= $articleId; ?>">
        
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required>
        <br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required>
        <br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required>
        <br>

        <label for="email">Your Email:</label>
        <input type="email" name="email" required>
        <br>

        <label for="message">Your Message:</label>
        <textarea name="message" required><?= $message; ?></textarea>
        <br>

        <input type="submit" value="Send Message" class="btn btn-primary rounded-pill px-3">
    </form>
</div>

<?php include __DIR__."/template/footer.php"; ?>
