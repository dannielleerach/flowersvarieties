<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $flower_name = $_POST["flower_name"];
    $flower_type = $_POST["flower_type"];
    $arrival_date = $_POST["arrival_date"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $flower_image = $_FILES["flower_image"]["name"];

    // Create the "uploads" directory if it doesn't exist
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Move the uploaded image file to the "uploads" directory
    $target_file = $upload_dir . basename($_FILES["flower_image"]["name"]);
    if (move_uploaded_file($_FILES["flower_image"]["tmp_name"], $target_file)) {
        // Save the flower details to a file (e.g., floristrecord.txt)
        $record = "$flower_name,$flower_type,$arrival_date,$quantity,$price,$flower_image\n";
        file_put_contents("floristrecord.txt", $record, FILE_APPEND);

        // Store the success message in the session
        $_SESSION['message'] = "New flower stock added successfully!";

        // Redirect to the new stock details page
        header("Location: new_stock.php?flower_name=" . urlencode($flower_name) . "&flower_type=" . urlencode($flower_type) . "&arrival_date=" . urlencode($arrival_date) . "&quantity=" . urlencode($quantity) . "&price=" . urlencode($price) . "&flower_image=" . urlencode($flower_image));
        exit;
    } else {
        // Store the error message in the session
        $_SESSION['error'] = "Error uploading the flower image.";
        header("Location: registration.php");
        exit;
    }
} else {
    // If the form was not submitted, check if the flower details were passed via GET parameters
    if (isset($_GET['flower_name']) && isset($_GET['flower_type']) && isset($_GET['arrival_date']) && isset($_GET['quantity']) && isset($_GET['price']) && isset($_GET['flower_image'])) {
        $flower_name = $_GET['flower_name'];
        $flower_type = $_GET['flower_type'];
        $arrival_date = $_GET['arrival_date'];
        $quantity = $_GET['quantity'];
        $price = $_GET['price'];
        $flower_image = $_GET['flower_image'];
    } else {
        // If the flower details were not passed, redirect to the registration page
        header("Location: registration.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Flower Stock</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>New Flower Stock Added</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="registration.php">Register New Flower</a>
            <a href="flower_records.php">View Flower Records</a>
        </nav>
    </header>
    <div class="container">
        <?php
        // Display the details of the newly added flower stock
        echo "<h2>Flower Details:</h2>";
        echo "<p>Flower Name: " . $flower_name . "</p>";
        echo "<p>Flower Type: " . $flower_type . "</p>";
        echo "<p>Arrival Date: " . $arrival_date . "</p>";
        echo "<p>Quantity: " . $quantity . "</p>";
        echo "<p>Price: RM " . $price . "</p>";
        echo "<img src='uploads/" . $flower_image . "' alt='" . $flower_name . "' class='flower-img'>";
        ?>
        </b>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>