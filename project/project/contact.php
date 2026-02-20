<?php
// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    $errors = [];

    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($message)) $errors[] = "Message cannot be empty";

    if (empty($errors)) {
        // 这里简单处理，可以保存到数据库或者发邮件
        $success = "Thank you, $name! Your message has been received.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact | Nordic Essence</title>
<link rel="stylesheet" href="style.css">
<script>
function validateForm() {
    let name = document.forms["contactForm"]["name"].value.trim();
    let email = document.forms["contactForm"]["email"].value.trim();
    let message = document.forms["contactForm"]["message"].value.trim();
    let errors = [];

    if (name == "") errors.push("Name is required");
    if (email == "") errors.push("Email is required");
    else {
        // 简单邮箱正则
        let re = /\S+@\S+\.\S+/;
        if (!re.test(email)) errors.push("Enter a valid email");
    }
    if (message == "") errors.push("Message cannot be empty");

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
    return true;
}
</script>
</head>
<body>

<nav>
    <div class="container">
        <a href="index.php" class="logo">NORDIC ESSENCE</a>
        <ul class="nav-links">
            <li><a href="products.php">Collections</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </div>
</nav>

<h1 style="text-align:center; margin-top:40px;">Contact Us</h1>

<div style="width:400px; margin:40px auto;">
    <?php 
    if (!empty($errors)) {
        echo "<p style='color:red;'>".implode("<br>", $errors)."</p>";
    }
    if (!empty($success)) {
        echo "<p style='color:green;'>$success</p>";
    }
    ?>
    <form name="contactForm" method="post" onsubmit="return validateForm()">
        <label>Name:</label><br>
        <input type="text" name="name" style="width:100%; margin-bottom:10px;"><br>

        <label>Email:</label><br>
        <input type="text" name="email" style="width:100%; margin-bottom:10px;"><br>

        <label>Message:</label><br>
        <textarea name="message" rows="5" style="width:100%; margin-bottom:10px;"></textarea><br>

        <input type="submit" value="Send Message" class="btn">
    </form>
</div>

</body>
</html>
