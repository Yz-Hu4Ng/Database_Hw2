<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['phone']) && isset($_POST['re_password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$re_pass = validate($_POST['re_password']);
	$phone = validate($_POST['phone']);

	if (empty($uname)) {
		header("Location: signup.php?error=noun");
		//error=User Name is required
	    exit();
	}else if(empty($pass)){
        header("Location: signup.php?error=nopw");
		//error=Password is required
	    exit();
	}
	else if(!preg_match("/^([0-9A-Za-z]+)$/",$pass)){
		header("Location: signup.php?error=pwinvalid");
		//error=Password is required
	    exit();

	}
	else if(empty($re_pass)){
        header("Location: signup.php?error=norepw");
		//error=Re Password is required
	    exit();
	}

	else if(empty($phone)){
        header("Location: signup.php?error=noph");
		//error=Phone Number is required
	    exit();
	}
	else if(!is_numeric($phone)){
		header("Location: signup.php?error=phinval");
		//error=Phone Number format invalid
	    exit();
	}

	else if($pass !== $re_pass){
        header("Location: signup.php?error=pwrepw");
		//error=The confirmation password  does not match
	    exit();
	}

	else{

		// hashing the password
		$salt=mt_rand(1000,9999);

        $pass =hash('sha256',$pass.strval($salt));
		$id=mt_rand(10000000000,99999999999);

		$uname=$conn->real_escape_string($uname);
		

	    $sql = "select * from User where user_name='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: signup.php?error=pwoc");
			//error=The username is taken try another
	        exit();
		}else {
			$id=$conn->real_escape_string($id);
			$uname=$conn->real_escape_string($uname);
			$salt=$conn->real_escape_string($salt);
			$pass=$conn->real_escape_string($pass);
			$phone=$conn->real_escape_string($phone);


           $sql2 = "insert into User value('$id','$uname','$salt', '$pass', '$phone')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
				echo "<script>alert('successfully sign up');" ;
				echo  "window.location.href='login.php'";
				echo "</script>";
				sleep(0.5);
				//header("Location: login.php?success=Your account has been created successfully");
				
	         exit();
           }else {
	           	header("Location: signup.php?error=unknown error occurred");
		        exit();
           }
		}
	}
	
}else{
	header("Location: signup.php");
	exit();
}