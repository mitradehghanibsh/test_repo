<?php
session_start();
include 'db.php';
header('Content-Type: application/json');

$items=[];
$total=0;
if(!empty($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $id=>$qty){
        $res=$conn->query("SELECT name, price FROM products WHERE id=$id");
        $p=$res->fetch_assoc();
        $items[]=array_merge($p,['quantity'=>$qty]);
        $total+=$p['price']*$qty;
    }
}
echo json_encode(['items'=>$items,'total'=>$total]);
?>