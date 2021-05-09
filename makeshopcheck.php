<?php
session_start();
include "db_conn.php";

if(isset($_POST['shopname']) && isset($_POST['maskamount']) && isset($_POST['maskprice'])
	&& isset($_POST['shoploc'])){

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$shopid = mt_rand(1000000,99999999);
	$shoploc = validate($_POST['shoploc']);
	$shopname = validate($_POST['shopname']);
	$maskprice = validate($_POST['maskprice']);
	$maskamount = validate($_POST['maskamount']);

	//information to insert into manager table
	$userid = $_SESSION['user_id'];
	$managerid=mt_rand(1000000,9999999);
	//we accept all kinds of id and location
	//reject when price and amount are not numeric or if they are less than zero
	//reject when shopname has been taken

	if (empty($shoploc) || empty($shopname) || empty($maskprice) || empty($maskamount)) {
		echo "<script>alert('Register failed: Please fill in every slots.');location.href = 'shop.php';</script>";
	}

	if(!(is_numeric($_POST['maskamount']) && $_POST['maskamount'] > 0)){
		echo "<script>alert('Register failed: Invalid maskamount.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=invalid_maskamount");
		//exit();
	}

	if(!(is_numeric($_POST['maskprice']) && $_POST['maskprice'] > 0)){
		echo "<script>alert('Register failed: Invalid maskprice.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=invalid_maskprice");
		//exit();
	}

	//echo "<script>alert('指令碼學堂,www.jbxue.com')</script>"; 

	$sql = "select shop_name from Shop where shop_name='$shopname'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Register failed: Used shop name.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=used_shopname");
		//exit();
	}
	else{
		//insert data into Shop table and Manager table
		$to_insert_to_Shop = "insert into Shop value('$shopid','$shopname','$shoploc', '$maskamount', '$maskprice')";
		$to_insert_to_Manager = "insert into Manager value('$managerid' , '$userid' , '$shopid')";
		$result2 = mysqli_query($conn, $to_insert_to_Shop);
		$result3 = mysqli_query($conn, $to_insert_to_Manager);
           if ($result2 && $result3) {
           	 header("Location: shop.php?success=Congrats!! Your are now a shop owner");
           	 $_SESSION['is_owner'] = true;
	         exit();
           }else {
	         header("Location: shop.php?error=Sorry, something went wrong...");
		     exit();
        }
	}


}else{
	header("Location: shop.php");
	exit();
}
?>