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
    <form method="post" class="mb-3">
        <div class="mb-2">
            <label class="form-label">Full name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-2">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

    </form>

    <footer>
        <p>&copy; 2026 Nordic Essence Studio. Built for Web Programming Course.</p>
    </footer>

</body>
</html>