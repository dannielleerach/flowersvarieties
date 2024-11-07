<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flower Records</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Flower Stock Records</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="registration.php">Register New Flower</a>
            <a href="flower_records.php">View Flower Records</a>
        </nav>
    </header>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Flower Name</th>
                    <th>Flower Type</th>
                    <th>Arrival Date</th>
                    <th>Quantity</th>
                    <th>Price (RM)</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Read the flower records from the file
                $records = file("floristrecord.txt");
                foreach ($records as $record) {
                    $data = explode(",", $record);
                    $flower_name = $data[0];
                    $flower_type = $data[1];
                    $arrival_date = $data[2];
                    $quantity = $data[3];
                    $price = $data[4];
                    $flower_image = $data[5];
                    ?>
                    <tr>
                        <td><?php echo $flower_name; ?></td>
                        <td><?php echo $flower_type; ?></td>
                        <td><?php echo $arrival_date; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo "RM " . $price; ?></td>
                        <td><img src="uploads/<?php echo $flower_image; ?>" alt="<?php echo $flower_name; ?>" class="flower-img"></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <a href="index.php">Back to Home</a>
    </div>
</body>
</html>