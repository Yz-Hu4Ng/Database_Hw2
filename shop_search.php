<?php
session_start();
include "db_conn.php";
if((isset($_SESSION['user_id'])
    && isset($_SESSION['user_name']))

){
	/*
	( isset($_POST['searchshopname'])
	|| isset($_POST['selectcity'])
	|| isset($_POST['searchpricea'])
	|| isset($_POST['searchpriceb'])
	|| isset($_POST['searchamount']))
	*/
    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $userid = validate($_SESSION['user_id']);
    $username = validate($_SESSION['user_name']);

	$sql = "select Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price , Shop.shop_id
            from Shop natural join Manager ";
    $sql2 = "select Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price , Shop.shop_id
            from Shop natural join Clerk ";

    if(isset($_POST['searchshopname'])){
		$searchshopname = validate($_POST['searchshopname']);
		$sql .= "where Shop.shop_name like '%$searchshopname%' ";
		$sql2 .= "where Shop.shop_name like '%$searchshopname%' ";
	}
    if(isset($_POST['selectcity']) && $_POST['selectcity'] != ""){
		$selectcity = validate($_POST['selectcity']);
		$sql .= "and Shop.city = '$selectcity' ";
		$sql2 .= "and Shop.city = '$selectcity' ";
	}
	if(isset($_POST['searchpricea'])){
		$searchpricea = validate($_POST['searchpricea']);
		if(empty($searchpricea)){
	       $sql .= "and mask_price >= 0 ";
	       $sql2 .= "and mask_price >= 0 ";
	    }
		else{
			$sql .= "and mask_price >= $searchpricea ";
  	      	$sql2 .= "and mask_price >= $searchpricea ";
		}
	}
	if(isset($_POST['searchpriceb'])){
		$searchpriceb = validate($_POST['searchpriceb']);
		if(!empty($searchpriceb)){
			$sql .= "and mask_price < $searchpriceb ";
  	      	$sql2 .= "and mask_price < $searchpriceb ";
	    }
	}



    if(isset($_POST['searchamount'])){
		$searchamount = validate($_POST['searchamount']);
		if($searchamount == "l") {
			$sql .= "and mask_count >= 100 ";
			$sql2 .= "and mask_count >= 100 ";
		}
	    else if($searchamount == "m") {
			$sql .= "and mask_count < 100 and mask_count > 50 ";
			$sql2 .= "and mask_count < 100 and mask_count > 50 ";
		}
	    else if($searchamount == "s") {
			$sql .= "and mask_count <= 50 ";
			$sql2 .= "and mask_count <= 50 ";
		}
	}

    if(isset($_POST['search_shop_i_work'])) {
		$sql .= "and Manager.user_id = '$userid' ";
		$sql2 .= "and Clerk.user_id = '$userid' ";
	}

?>

<!DOCTYPE html>
<html>

<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <li><a class="navbar-brand" href="home.php">Home</a></li>
    </div>
    <ul class="nav navbar-nav">
		<li><a href="shop.php">Shop</a></li>
          <li><a href="myorder.php">Myorder</a></li>
          <li><a href="shoporder.php">Shoporder</a></li>
          <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</header>

<body>
  <h1 style="text-align:left">Profile</h1>
  <p><b>Account:</b> <?php echo $_SESSION['user_name']; ?></p>
  <p><b>Phone:</b> <?php echo $_SESSION['phone']; ?></p>
  <div class="container-fluid">
  <?php
  //echo $sql;
  $result = mysqli_query($conn , $sql);
  $result2 = mysqli_query($conn , $sql2);

  if ($result->num_rows === 0 && $result2->num_rows === 0){
      echo "<a>Sorry , result not found.</a>";
      echo "<br>";
    //echo "<a herf='home.php'>Press me</a>";
  }
  else { ?>
    <ul class = "list-group list-group-flush">
      	<li>
  <?php

      while ($row = $result->fetch_row()){
         echo 	"<li class='list-group-item'>"."Shop name : $row[0] , city : $row[1] , mask amount = $row[2] , mask_price = $row[3]".
		 		"<form class='example' action='order_handling.php' method = 'post'>".
				"<input type = 'hidden' name = 'order_shop_name' value = '$row[0]'>".
				"<input type = 'hidden' name = 'order_shop_id' , value = '$row[4]'>".
				"<input type='text' placeholder='Amount...' name= 'order_amount' >".
				"<button type='submit'>Place Order</button>".
				"</form></li>";
      }
      if(isset($_SESSION['search_shop_i_work'])){
      while ($row= $result2->fetch_row()){
            echo 		"<li class='list-group-item'> Shop name : $row[0] , city : $row[1] , mask amount = $row[2] , mask_price = $row[3]
						<form class='example' action='order_handling.php' method = 'post'>
						<input type = 'hidden' name = 'order_shop_name' value = '$row[0]'>
						<input type = 'hidden' name = 'order_shop_id' value = '$row[4]'>
					  	<input type='text' placeholder='Amount...' name= 'order_amount'>
					  	<button type='submit'>Place Order</button>
						</form></li>";
        }
      }
      mysqli_free_result($result2);
      mysqli_free_result($result);
  }

  ?>
	</ul>
  </div>

<style>
  .scrollsearch{
  overflow-x: hidden;
  overflow-y: scroll;
  }
  input {
      width : 200px;
  }
</style>

</body>



</html>

<?php
}
else
{
	echo "<script>alert('Please check your condition');location.href = 'home.php';</script>";
	/*
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
      echo "<script>alert('Please check your condition');location.href = 'home.php';</script>";
    }
    else {
      header("Location: shop.php");
      exit();
    }
*/
}
?>
