<?php
session_start();
include 'db.php';
$error = "";

// Redirect if already logged in
if(isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Email not found.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Nordic Essence</title>
    <!-- Link main CSS for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container" style="max-width:400px; margin:80px auto; padding:25px; border:1px solid #ccc; border-radius:10px; background:#f9f9f9;">
    <h2 style="text-align:center;">Login</h2>

    <?php if($error != ""): ?>
        <p style="color:red; text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" style="display:flex; flex-direction:column;">
        <input type="email" name="email" placeholder="Email" required style="margin:10px 0; padding:10px;">
        <input type="password" name="password" placeholder="Password" required style="margin:10px 0; padding:10px;">
        <input type="submit" value="Login" style="margin:10px 0; padding:10px; background:#333; color:#fff; border:none; border-radius:5px; cursor:pointer;">
    </form>

    <p style="text-align:center; margin-top:15px;">
        Don't have an account? <a href="register.php" style="text-decoration:underline;">Register here</a>
    </p>
</div>

</body>
</html>