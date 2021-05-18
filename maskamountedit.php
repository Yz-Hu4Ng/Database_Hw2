<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['mskamountedit'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$mskamountedit = validate($_POST['mskamountedit']);
	if($mskamountedit<0){
        header("Location: shop.php?error=amount must be greater than 0");
		//error=amount must be greater than 0
	    exit();
	}

	
	$shoppid=$_SESSION['shop_id'];

	$sql = "UPDATE Shop SET mask_count='$mskamountedit' WHERE shop_id='$shoppid'";

	if ($conn->query($sql) === TRUE) {
		header("Location: shop.php?");
		
		exit();
		
	} else {
		header("Location: shop.php?");
		exit();
	}
}
