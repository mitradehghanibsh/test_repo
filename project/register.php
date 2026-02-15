<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];     // First name
    $email = $_POST['email'];     // email
    $password = $_POST['password'];       // password
    $groupid = $_POST['groupid']; // Group ID

    include 'db.php';

    $sql = "INSERT INTO studentsinfo (first_name, last_name, city, groupId)
            VALUES ('$fname', '$lname', '$city', '$groupid')";

    if ($conn->query($sql) === TRUE) {
        echo "New record added"; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>