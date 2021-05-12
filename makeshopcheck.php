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

	$_shoploc = mysqli_real_escape_string($conn , $shoploc);
	$_shopname = mysqli_real_escape_string($conn , $shopname);
	$_maskprice = mysqli_real_escape_string($conn , $maskprice);
	$_maskamount = mysqli_real_escape_string($conn , $maskamount);

	//information to insert into manager table
	$userid = $_SESSION['user_id'];
	$managerid=mt_rand(1000000,9999999);
	//we accept all kinds of id and location
	//reject when price and amount are not numeric or if they are less than zero
	//reject when shopname has been taken
	$flag = true;

	if (empty($shoploc) || empty($shopname) || empty($maskprice) || empty($maskamount)) {
		echo "<script>alert('You must fill in every slots.');" ;
		echo  "window.location.href='shop.php'";
		echo "</script>";
		$flag = false;
	    exit();
	}

	if(!(is_numeric($_POST['maskamount']) && $_POST['maskamount'] > 0)){
		echo "<script>alert('Register failed: Invalid maskamount.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=invalid_maskamount");
		$flag = false;
		exit();
	}

	if(!(is_numeric($_POST['maskprice']) && $_POST['maskprice'] > 0)){
		echo "<script>alert('Register failed: Invalid maskprice.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=invalid_maskprice");
		$flag = false;
		exit();
	}


	$sql = "select shop_name from Shop where shop_name='$_shopname'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		echo "<script>alert('Register failed: Used shop name.');location.href = 'shop.php';</script>";
		//header("Location: shop.php?error=used_shopname");
		exit();
	}
	else if($flag != false){
		//insert data into Shop table and Manager table
		$to_insert_to_Shop = "insert into Shop value('$shopid','$_shopname','$_shoploc', '$_maskamount', '$_maskprice')";
		$to_insert_to_Manager = "insert into Manager value('$managerid' , '$userid' , '$shopid')";
		$result2 = mysqli_query($conn, $to_insert_to_Shop);
		$result3 = mysqli_query($conn, $to_insert_to_Manager);
           if ($result2 && $result3) {
           	 $_SESSION['is_owner'] = true;
				echo "<script>alert('successfully create shop');" ;
				echo  "window.location.href='shop.php'";
				echo "</script>";
				sleep(0.5);
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