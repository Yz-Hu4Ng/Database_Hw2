<?php
session_start();
include "db_conn.php";

if (isset($_POST['order_amount']) && is_numeric($_POST['order_amount']) && $_POST['order_amount'] > 0) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$order_shop_name = validate($_POST['order_shop_name']);
	$order_amount = validate($_POST['order_amount']);
	$order_shop_id = validate($_POST['order_shop_id']);
	$user_id = $_SESSION['user_id'];
	if(is_numeric($order_amount) && $order_amount > 0){
		$orderidgenerated=rand(0,10000000000);
		$current_time = date('Y-m-d H:i:s');
		$check_if_enough = "select Shop.mask_count from Shop where Shop.shop_name = '$order_shop_name'";
		$result=$conn->query($check_if_enough);
		$row = $result->fetch_assoc();
	    $mask_shop_have=$row['mask_count'];
		if($order_amount > $mask_shop_have){
			echo "Sorry, we don't have that much masks...";
			header('Refresh: 2;URL=shop_search.php');
			exit();
		}
		#changed
		# get the mask price
		$order_price=-1;
		$checkpricesql="SELECT * FROM Shop WHERE shop_id='$order_shop_id'";
		$checkpriceresult=$conn->query($checkpricesql);
		if($result->num_rows!==1){
			echo "The price asked has some error!!";
			header('Refresh: 2;URL=shop_search.php');

		}else{
			$thisrow=$checkpriceresult->fetch_assoc();
			$order_price=$thisrow["mask_price"];
		}



		#changed now the table insets the order amount and the order price

		$insertsql= "insert into Orders value('$orderidgenerated','$current_time', 'None' , 'NotFinished' , '$user_id' , '$order_shop_id','$order_amount','$order_price','None')";
		$result2 = mysqli_query($conn, $insertsql);
	    if ($result2) {
			$updatesql = "UPDATE Shop SET mask_count = ($mask_shop_have - $order_amount) WHERE shop_id='$order_shop_id'";
			if($conn->query($updatesql) === TRUE){
				echo '<script>alert("Successful!!")</script>';
				header('Refresh: 2;URL=shop_search.php');
				exit();
			}

	    }else {
			echo '<script>alert("Sorry, something went wrong...")</script>';
	        header('Refresh: 2;URL=shop_search.php');
	        exit();
	    }

	}
	else {
		header("Location: shop_search.php?error=invalid");
		exit();
	}
}else {
	echo '<script>alert("Please input a number!!")</script>';
	header('Refresh: 2;URL=shop_search.php');
}

?>
