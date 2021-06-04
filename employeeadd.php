<?php
session_start();
include "db_conn.php";

if (isset($_POST['addemployee'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$addemployee = validate($_POST['addemployee']);
    $shoppid=$_SESSION['shop_id'];

	$sql = "SELECT * FROM User WHERE user_name='$addemployee'";
    $result=$conn->query($sql);
    if($result->num_rows!=1){
        header("Location: shop.php?error=no such person");
		//error=no such person
	    exit();
    }
    $row = $result->fetch_assoc();
    $employeeuserid=$row['user_id'];


    $checkalreadyexistsql="SELECT * FROM Clerk WHERE user_id=$employeeuserid and shop_id=$shoppid";
    $checkresult=$conn->query($checkalreadyexistsql);
    if($checkresult->num_rows>0){
        header("Location: shop.php?error=he is already a employee!");
		//error=employee already in this shop
        exit();
    }

    $clerkidgenerated=rand(0,100000000000);
    $insertsql="INSERT into Clerk value('$employeeuserid','$employeeuserid','$shoppid')";

    $result2 = mysqli_query($conn, $insertsql);
    if ($result2) {

        header("Location: shop.php?");
        exit();
    }else {
            header("Location: shop.php?error=fail to insert");
            exit();
    }
    header("Location: shop.php?");
	exit();

}
