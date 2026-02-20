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
<?php
if (isset($_POST['submit'])) {
    include 'db.php';

    $fname = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

  

    $sql = "INSERT INTO users (full_name, email, password )
            VALUES ('$fname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "New record added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<a href="index.php" class="btn-home">← Back to Home</a>
   <form method="post" style="width:400px; margin:50px auto; padding:20px; border:1px solid #ccc; border-radius:10px; background:#f9f9f9;">
    <h2 style="text-align:center;">Register</h2>
    <label>Username</label><br>
    <input type="text" name="username" style="width:100%; padding:8px; margin:10px 0;"><br>
    
    <label>Email</label><br>
    <input type="email" name="email" style="width:100%; padding:8px; margin:10px 0;"><br>

    <label>Password</label><br>
    <input type="password" name="password" style="width:100%; padding:8px; margin:10px 0;"><br>

    <input type="submit" value="Register" class="btn" style="width:100%; padding:10px; background:#333; color:#fff; border:none; border-radius:5px; cursor:pointer;">
</form>


    <footer>
        <p>&copy; 2026 Nordic Essence Studio. Built for Web Programming Course.</p>
    </footer>

</body>
</html>