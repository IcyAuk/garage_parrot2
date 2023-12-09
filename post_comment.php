<?php
// Include necessary files
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/comment.php";
require_once __DIR__ . "/template/header.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (
        isset($_POST["email"]) &&
        isset($_POST["first_name"]) &&
        isset($_POST["last_name"]) &&
        isset($_POST["phone"]) &&
        isset($_POST["text_field"])
    ) {
        // Sanitize and validate input data
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $first_name = filter_var($_POST["first_name"], FILTER_SANITIZE_STRING);
        $last_name = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
        $text_field = filter_var($_POST["text_field"], FILTER_SANITIZE_STRING);

        // Insert the new comment into the database
        if (insertComment($pdo, $email, $first_name, $last_name, $phone, $text_field)) {
            echo "Comment posted successfully.";
        } else {
            echo "Failed to post the comment.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>

<!-- HTML form for posting a comment -->
<h1 class="py-5">Post a Comment</h1>

<form method="post" action="post_comment.php">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <br>

    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>
    <br>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>
    <br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" required>
    <br>

    <!-- Hidden input fields for article details -->
    <input type="hidden" id="hiddenTitle" name="hiddenTitle">
    <input type="hidden" id="hiddenYear" name="hiddenYear">
    <input type="hidden" id="hiddenKm" name="hiddenKm">
    <input type="hidden" id="hiddenPrice" name="hiddenPrice">

    <label for="text_field">Comment:</label>
    <textarea name="text_field" id="commentText" required></textarea>
    <br>

    <input type="submit" value="Post Comment">
</form>

<script>
    // Set values for hidden fields based on JavaScript
    document.getElementById("hiddenTitle").value = "<?= htmlentities($article["title"]); ?>";
    document.getElementById("hiddenYear").value = "<?= htmlentities($article["year"]); ?>";
    document.getElementById("hiddenKm").value = "<?= htmlentities($article["km"]); ?>";
    document.getElementById("hiddenPrice").value = "<?= htmlentities($article["price"]); ?>";

    // Set text field value based on hidden fields
    document.getElementById("commentText").value = "<?= htmlentities($article["title"]); ?> - <?= htmlentities($article["year"]); ?> - <?= htmlentities($article["km"]); ?> KM - <?= htmlentities($article["price"]); ?> €";
</script>

<?php require_once __DIR__ . "/template/footer.php"; ?>

<?php
function insertComment(PDO $pdo, $email, $first_name, $last_name, $phone, $text_field): bool
{
    try {
        // Prevent SQL injection
        $stmt = $pdo->prepare("
            INSERT INTO comments (email, first_name, last_name, phone, text_field, validated)
            VALUES (:email, :first_name, :last_name, :phone, :text_field, 0)
        ");

        // Bind parameters
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':text_field', $text_field, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        // Check if the comment was inserted successfully
        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // Handle exceptions if necessary
        return false;
    }
}
?>
