<?php
       $title="HomePage";
       $md="Use an appropriate md";
       include 'header.php';
       ?>
       <?php include 'sidebar.php';?>
       <html>
    <body>
        <h3>"Hello World!";<h3>
             <!-- Navigation / Sidebar -->
        
    </body>
</html>


<?php
$vehicles = array(
    'cars' => array(
        'Toyota' => 'Corolla',
        'BMW'    => 'M5',
        'Volvo'  => 'V40cc'
    ),
    'vans' => array(
        'Toyota' => 'Hiace',
        'Honda'  => '---',
        'Fiat'   => 'Ducato'
    )
);

foreach ($vehicles as $vehicle => $data) {
    foreach ($data as $key => $value) {
        echo "<b>$key</b> has a " . $vehicle . " model $value <br/>";
    }
}
?>
    <?php include 'footer.php'; ?>