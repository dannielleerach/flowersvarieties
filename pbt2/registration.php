<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flower Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Register New Flower Stock</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="registration.php">Register New Flower</a>
            <a href="flower_records.php">View Flower Records</a>
        </nav>
    </header>
    <div class="container">
        <?php
        // Display success or error messages
        if (isset($_SESSION['message'])) {
            echo '<p class="success">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']); 
        }
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']); 
        }
        ?>

        <form action="new_stock.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="flower_name">Flower Name:</label>
                <input type="text" name="flower_name" id="flower_name" required>
            </div>

            <div class="form-group">
                <label for="flower_type">Flower Type:</label>
                <select name="flower_type" id="flower_type" required>
                    <option value="Rose">Rose</option>
                    <option value="Lily">Lily</option>
                    <option value="Tulip">Tulip</option>
                    <option value="Sunflower">Sunflower</option>
                    <option value="Orchid">Orchid</option>
                </select>
            </div>

            <div class="form-group">
                <label for="arrival_date">Stock Arrival Date:</label>
                <input type="date" name="arrival_date" id="arrival_date" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" required>
            </div>

            <div class="form-group">
                <label for="price">Price (RM):</label>
                <input type="number" step="0.01" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="flower_image">Flower Image:</label>
                <input type="file" name="flower_image" id="flower_image" accept="image/*" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
