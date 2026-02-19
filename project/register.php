<?php
// 1. Logic goes at the TOP before any HTML
if (isset($_POST['submit'])) {
    include 'db.php';

    $fname = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (full_name, email, password)
            VALUES ('$fname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $conn->close();
        // 2. Redirect happens here
        header("Location: index.php");
        exit();
    } else {
        $error_msg = "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nordic Essence | Timeless Finnish Design</title>
    <link rel="stylesheet" href="stylem.css">
</head>
<body>

    <h3>User Form</h3>
    
    <?php if(isset($error_msg)) echo "<p style='color:red;'>$error_msg</p>"; ?>

    <form method="post" class="mb-3">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

    <footer>
        <p>&copy; 2026 Nordic Essence Studio.</p>
    </footer>
</body>
</html>