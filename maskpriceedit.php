<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['mskpriceedit'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	

	$mskpriceeidt = validate($_POST['mskpriceedit']);
	if($mskpriceeidt<0){
        header("Location: shop.php?error=price must be greater than 0");
		//error=price must be greater than 0
	    exit();
	}

	
	$shoppid=$_SESSION['shop_id'];

	$sql = "UPDATE Shop SET mask_price='$mskpriceeidt' WHERE shop_id='$shoppid'";

	if ($conn->query($sql) === TRUE) {
		header("Location: shop.php?");
		
		exit();
		
	} else {
		header("Location: shop.php?");
		exit();
	}
}
