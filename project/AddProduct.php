<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image = $_POST["image"];

    $sql = "INSERT INTO products (name, description, price, image)
            VALUES ('$name', '$description', '$price', '$image')";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>

<h1>Add New Product</h1>

<form method="POST">

    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Image filename (example: Artek.jpg):</label><br>
    <input type="text" name="image" required><br><br>

    <button type="submit">Add Product</button>

</form>

<br>
<a href="products.php">Back to Products</a>

</body>
</html>
