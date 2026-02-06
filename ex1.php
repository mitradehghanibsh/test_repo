<?php
       $title="HomePage";
       $md="Use an appropriate md";
       include 'header.php';
       ?>
       <?php include  'sidebar.php'; ?>
       <html>
    <body>
        <h3>"Hello world! My name is "David";<h3>
    </body>
</html>
<?php
echo "My name is Mitra";
?>
<h4>
   <?php
   $title = "PHP is intresting.";
echo $title;
?>
</h4>

<?php
$g1 = 5;
$g2 = 4;
$g3 = 5;
?>
 
<table border="5" cellpadding="8">
    <tr>
        <th>S.n.</th>
        <th>Name</th>
        <th>Grade</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Mitra</td>
        <td><?php echo $g1; ?></td>
    </tr>
    <tr>
        <td>2</td>
        <td>Mehrsam</td>
        <td><?php echo $g2; ?></td>
    </tr>
    <tr>
        <td>3</td>
        <td>Neky</td>
        <td><?php echo $g3; ?></td>
    </tr>

    </tr>

   
</table>



    <?php include 'footer.php'; ?>