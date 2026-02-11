<?php
// Set the page title dynamically
$title = "Voting Eligibility";

// Include header and sidebar
include 'header.php';
include 'sidebar.php';

// Initialize message
$text = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'] ?? "";
    $age  = $_POST['age'] ?? "";

    if (!empty($name) && is_numeric($age)) {
        if ($age >= 18) {
            $text = "$name, you are eligible for voting.";
        } else {
            $text = "$name, you are NOT eligible for voting.";
        }
    } else {
        $text = "Invalid input. Please enter a valid name and age.";
    }
}
?>
<article>
    <h3>Voting Eligibility Form</h3>

    <form method="post" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Age:</label><br>
        <input type="number" name="age" required><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>

    <?php if ($text != ""): ?>
        <h3><?php echo $text; ?></h3>
    <?php endif; ?>
</article>
<?php

 echo "Switch Case Example:<br>";
 $currentMonth = date("F");
switch ($currentMonth){
   case "Agust":
        echo  "Yes This month is Agust So I have a holidays.";
        break;
   default :
    echo  "Not August, this is Month-name so I don't have any holidays.";
        break;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Multiplication Table</title>
</head>
<body>
    <h3>Enter a number to see its multiplication table:</h3>

    <!-- Form to get user input -->
    <form method="post" action="">
        <input type="number" name="number" required>
        <input type="submit" value="Show Table">
    </form>
    <?php
    // Check if the form is submitted
    if (isset($_POST['number'])) {
        $n = $_POST['number'];
        echo "<h3>Multiplication Table of $n:</h3>";

        // For loop to print the multiplication table
        for ($i = 1; $i <= 10; $i++) {
            $result = $n * $i;
            echo "$n × $i = $result<br>";
        }
    }
    ?>
<html>
<body>
    <h3>Enter a number : </h3>
    <form method="post" action="">
        <input type="number" name="number" min="1" required>
        <input type="submit" value="Show Numbers">
    </form>

    <?php

    if (isset($_POST['number'])) {
        $n = $_POST['number'];
        $i = 1;
        echo "<h3>Numbers from 1 to $n:</h3>";

        while ($i <= $n) {
            echo $i . ",";
            $i++; 
        }
    }
    ?>
</body>

<?php
// Define the array
$myarray = array("HTML", "CSS", "PHP", "JavaScript");
echo "<h3>foreach Example :<br></h3>";
echo "<h4>Elements of the array:</h4>";


foreach ($myarray as $element) {
    echo $element . ";";
}
?>
<?php
// Include footer
include 'footer.php';
?>
