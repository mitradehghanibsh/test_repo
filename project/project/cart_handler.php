<?php
include "db.php";
session_start();

if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

if(!isset($_POST['action'])) exit;

$action = $_POST['action'];
$pid = intval($_POST['product_id']??0);

switch($action){
    case 'add':
        if($pid){
            if(!isset($_SESSION['cart'][$pid])) $_SESSION['cart'][$pid]=1;
            else $_SESSION['cart'][$pid]++;
        }
        break;
    case 'subtract':
        if($pid && isset($_SESSION['cart'][$pid])){
            $_SESSION['cart'][$pid]--;
            if($_SESSION['cart'][$pid]<=0) unset($_SESSION['cart'][$pid]);
        }
        break;
    case 'remove':
        if($pid) unset($_SESSION['cart'][$pid]);
        break;
    case 'load':
        break;
}

// 返回购物车数据
$total=0;
$items=[];
foreach($_SESSION['cart'] as $id=>$qty){
    $res=$conn->query("SELECT * FROM products WHERE id=$id");
    if($res->num_rows>0){
        $p=$res->fetch_assoc();
        $p['quantity']=$qty;
        $p['subtotal']=$p['price']*$qty;
        $total+=$p['subtotal'];
        $items[]=$p;
    }
}
echo json_encode(['items'=>$items,'total'=>$total]);
