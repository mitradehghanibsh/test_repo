<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main class="content">

    <h3>Exercise 3: Variables, Strings & Operators</h3>

    <!-- Task 1:  -->
    <h3>Task 1: User Form</h3>

    <form method="post" class="mb-3">
        <div class="mb-2">
            <label class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" required>
        </div>

        <div class="mb-2">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
    if (!empty($_POST['firstname']) && !empty($_POST['lastname'])) {
        echo "<h3>Hello " . $_POST['firstname'] . " " . $_POST['lastname'] . ", You are welcome to my site.</h3>";
    }
    ?>

    <!-- Task 2: Bootstrap Table -->
    <h3>Task 2: Bootstrap Styled Table</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>S.n.</th>
                <th>Name</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>5</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Alice</td>
                <td>4</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Bob</td>
                <td>5</td>
            </tr>
        </tbody>
    </table>

    <!-- Task 3: String Variables -->
    <h3>Task 3: String Variables</h3>

    <?php
    $str1 = "Hello";
    $str2 = "World";
    $combined = $str1 . " " . $str2;

    echo "<p>Combined String: $combined</p>";
    echo "<p>String Length: " . strlen($combined) . "</p>";
    ?>

    <!-- Task 4: Number Addition -->
    <h3>Task 4: Number Addition</h3>

    <?php
    $n1 = 298;
    $n2 = 234;
    $n3 = 46;
    $sum = $n1 + $n2 + $n3;

    echo "<p>The sum of the numbers is: $sum</p>";
    ?>

    <!-- Task 5: Browser Detection -->
    <h3>Task 5: Browser Detection</h3>

    <?php
    echo "<p>Your browser is: " . $_SERVER['HTTP_USER_AGENT'] . "</p>";
    ?>

</main>

<?php include 'footer.php'; ?>  