<?php
// Include necessary files
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/comment.php";
require_once __DIR__ . "/template/header.php";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are set
    if (
        isset($_POST["first_name"]) &&
        isset($_POST["last_name"]) &&
        isset($_POST["phone"]) &&
        isset($_POST["email"]) &&
        isset($_POST["message"])
    ) {
        // Sanitize and validate input data
        $first_name = filter_var($_POST["first_name"]); //DONT FORGET TO SANITIZE
        $last_name = filter_var($_POST["last_name"]);
        $phone = filter_var($_POST["phone"]);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $message = filter_var($_POST["message"]);

        // Insert the new contact form entry into the database and set validated to 2
        if (insertContactFormEntry($pdo, $first_name, $last_name, $phone, $email, $message)) {
            echo "Form submitted successfully.";
        } else {
            echo "Failed to submit the form.";
        }
    } else {
        echo "All fields are required.";
    }
}

// Function to insert contact form entry into the database
function insertContactFormEntry(PDO $pdo, $first_name, $last_name, $phone, $email, $message): bool
{
    try {
        // Prevent SQL injection
        $stmt = $pdo->prepare("
            INSERT INTO comments (first_name, last_name, phone, email, text_field, validated)
            VALUES (:first_name, :last_name, :phone, :email, :message, 2)
        ");

        // Bind parameters
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        return false;
    }
}
?>

<?php require_once __DIR__ . "/template/footer.php"; ?>
