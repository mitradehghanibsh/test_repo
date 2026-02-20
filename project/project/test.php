<?php
$error=''; // Variable To Store Error Message
$errorName='';
$errorPass='';
$errorEmail='';
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password1']) || empty($_POST['password2']) ||  empty($_POST['email'])) {
        $error = "Semua data harus terisi";
    }
    else    {
        /////////// changes -- start - SHAZ ////////////////
        $username=trim($_POST['username']);
        $password1=trim($_POST['password1']);
        $password2=trim($_POST['password2']);
        $email=trim($_POST['email']);
        // Establishing Connection with Server using PDO by passing server_name, user_id and password as a parameter
        $host = "localhost"; 
        $dbname = 'TugasPPW'; 
        $user = "root"; 
        $pass="";
        // Connect to DB
        try {
            $connection = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
            $connection->exec("SET NAMES utf8");
        } 
        catch (PDOException $e) {
            die ('ERROR : SORRY! Unable to connect with database >>');
        }

        $sltQuery = "SELECT * FROM users WHERE email= ? AND username = ?";
        $stmt = $connection->prepare($sltQuery);
        $stmt->bindParam(1,$email);
        $stmt->bindParam(1,$username);
        $stmt->execute();
        // Here to check if record already present
        if($stmt->rowCount()) {
            // Record found in DB
            $error = 'Email/Username already Exists';
        }
        else {
            // no record found in DB
            if($password1 != $password2) {
                $errorPass = "Password yang anda masukkan tidak sama";
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) // Validate email address
            {
                $errorEmail =  "Invalid email address please type a valid email!!";
            }
            else if($numResults>=1){
                $errorName = "Username or email already exsist";
            }
            else{
                $password = md5($password1);
                $insQuery = 'INSERT INTO users SET name = ?, email = ?, password = ?';
                $smt = $connection->prepare($insQuery);
                $smt->bindParam(1,$username);
                $smt->bindParam(2,$email);
                $smt->bindParam(3,$password);
                $smt->execute();
                if($smt->rowCount()){
                    //Data Inserted Successfully
                }
                else{
                    // Failed to insert data
                }
                header("location: login.php");
            }
        }    
    }
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Login Form in PHP with Session</title>
   <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="main">
<h1>Pendaftaran</h1>
<span><?php echo $error; ?></span>

<div id="login">
<form action="" method="post">
    <label>UserName :</label>
    <input id="name" name="username" placeholder="username" type="text"><span><?php echo $errorName; ?></span><br>
    <label>Password :</label>
    <input id="password1" name="password1" placeholder="**********" type="password"><span><?php echo $errorPass; ?></span><br>
    <label>Ulangi Password :</label>
    <input id="password2" name="password2" placeholder="**********" type="password"><span><?php echo $errorPass; ?></span><br>
    <label>Email :</label>
    <input id="email" name="email" placeholder="yourname@email.com" type="email"><span><?php echo $errorEmail; ?></span><br>
    <input name="submit" type="submit" value=" Submit ">

</form>
</div>
</div>
</body>
</html>
