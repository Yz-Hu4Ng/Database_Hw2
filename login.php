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

	$_uname = mysqli_real_escape_string($conn , $uname);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
	
		$uname=$conn->real_escape_string($uname);
		$sql = "select * from User where user_name='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);

			$pass=hash('sha256',$pass.strval($row['salt']));
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$userid = $_SESSION['user_id'] = $row['user_id'];
				$_SESSION['phone']=$row['phone'];
				$userid=$conn->real_escape_string($userid);
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