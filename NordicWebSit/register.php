<?php
session_start();
include 'db.php';
$error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    if($stmt->get_result()->num_rows>0){
        $error="Email already registered.";
    } else {
        $stmt2 = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
        $stmt2->bind_param("sss",$name,$email,$password);
        if($stmt2->execute()){
            $_SESSION['user']=$name;
            $_SESSION['email']=$email;
            header("Location:index.php");
            exit();
        } else {
            $error="Database error.";
        }
        $stmt2->close();
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Register</title></head>
<body>
<h2>Register</h2>
<?php if($error!=""){echo "<p style='color:red;'>$error</p>";} ?>
<form method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <input type="submit" value="Register">
</form>
<a href="login.php">Login</a>
</body>
</html>