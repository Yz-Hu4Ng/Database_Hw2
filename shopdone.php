<?php

session_start();
include "db_conn.php";



$OID=$_SESSION['order_id'];
$current_time = date('Y-m-d H:i:s');
$finisher=$_SESSION['user_name'];



#alter the order and alter the finish labels

$altersql="UPDATE Orders SET order_finish_time='$current_time',order_finisher='$finisher' ,order_status='Finished' WHERE order_id=$OID";
if($conn->query($altersql)){
    echo "Database successfully updated";
}else{
    echo "update order table failed";
    echo "<br>";
}

header('Refresh: 2;URL=shoporder.php');
exit();
/*

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
echo $oldnum;
echo"<br>total<br>";
echo $addbackamount;
echo"<br>";
echo"<br>";


#add it back
$addbacksql="UPDATE Shop SET mask_count='$addbackamount' WHERE shop_id=$shopid";
$addbackresult=$conn->query($addbacksql);

if($addbackresult){
    "success!";
    header('Refresh: 2;URL=shoporder.php');
}else{
    echo"final step fail";
    echo "<br>";
}
*/
