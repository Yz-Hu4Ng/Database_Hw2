<?php

session_start();
include "db_conn.php";



$OID=$_SESSION['order_id'];
$current_time = date('Y-m-d H:i:s');
$canceler=$_SESSION['user_name'];

$checksql = "select order_status from Orders where order_id = $OID";
$result = $conn -> query($checksql);
$row = $result->fetch_assoc();
if($row['order_status'] === "Finished" || $row['order_status'] === "Cancelled"){
	echo "Sorry, This order has been finished or cancelled.";
	header('Refresh: 2;URL=myorder.php');
	exit();
}

#alter the order and alter the finish labels

$altersql="UPDATE Orders SET order_finish_time='$current_time',order_finisher='$canceler' ,order_status='Cancelled'WHERE order_id=$OID";
if($conn->query($altersql)){
    echo "update the table";
}else{
    echo "update order table failed";
    echo "<br>";
}


#add the mask back
$ordersql="SELECT * FROM Orders WHERE order_id=$OID";
$result=$conn->query($ordersql);

$shopid="";
$ordermasktoaddback="";


if($result){
    $row = $result->fetch_assoc();
    $shopid=$row['shop_id'];
    $ordermasktoaddback=$row['order_num'];



}else{
    echo"add back find order step 1 fail";
}

#look for the minused mask in the shop
$ordersql="SELECT * FROM Shop WHERE  shop_id=$shopid";
$result=$conn->query($ordersql);
$oldnum="";
if($result){
    $row = $result->fetch_assoc();
    $oldnum=$row['mask_count'];



}else{
    echo"add back find retain mask count fail!";
    echo "<br>";
}


$addbackamount=(int)$ordermasktoaddback+(int)$oldnum;
echo"<br>ordermasktoaddback:<br>";
echo $ordermasktoaddback;

echo"<br>oldnum:<br>";
echo$oldnum;
echo"<br>total<br>";
echo $addbackamount;
echo"<br>";
echo"<br>";


#add it back
$addbacksql="UPDATE Shop SET mask_count='$addbackamount' WHERE shop_id=$shopid";
$addbackresult=$conn->query($addbacksql);

if($addbackresult){
    "success!";
    header('Refresh: 2;URL=myorder.php');


}else{
    echo"final step fail";
    echo "<br>";
}
