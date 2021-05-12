<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	$_uname = mysql_real_escape_string($uname);
	$_pass = mysql_real_escape_string($pass);

	if (empty($_uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($_pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
	

		$sql = "select * from User where user_name='$_uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);

			$pass=hash('sha256',$pass.strval($row['salt']));
            if ($row['user_name'] === $_uname && $row['password'] === $_pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$userid = $_SESSION['user_id'] = $row['user_id'];
				$_SESSION['phone']=$row['phone'];
				$sql = "select * from Manager where user_id ='$userid'";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0) {
					$_SESSION['is_owner'] = true;
				}
				
				echo "success";
            	header("Location: home.php");
		        exit();
            }else{
				header("Location: index.php?error=Incorect User name or password!! Login Fail");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password, Login Fail");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}