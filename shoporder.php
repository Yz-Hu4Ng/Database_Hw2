<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {

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
      <li><a class="navbar-brand" href=home.php>Home</a></li>
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

<!--
this is the top selecting area
-->

<body>
  	<form action="?" method="post">
      	<h1 style="text-align:left">Shop Order</h1>

      	<p><b>Status</b> </p>
          	<select name="searchstatus" size="1" id="amount">
          	<option value="a"> All </option>
          	<option value="nf"> Not Finished </option>
          	<option value="f"> Finished </option>
          	<option value="c"> Cancelled </option></select>
		<p><b>Shops</b></p>
			<select name="searchshop" size="1">
			<option value="all"> All </option>
			<?php
				// search results both the user work as a manager and as a clerk
				$user_id = $_SESSION['user_id'];
				$find_shop_sql1 = 	"select Shop.shop_name
									from Shop natural join Manager
									where Manager.user_id = $user_id order by Shop.shop_name ";
				$find_shop_sql2 = 	"select Shop.shop_name
									from Shop natural join Clerk
									where Clerk.user_id = $user_id order by Shop.shop_name ";

				$result_manager = $conn->query($find_shop_sql1);
				$result_clerk = $conn->query($find_shop_sql2);

				while($row = $result_manager->fetch_assoc()){
					$temp = $row['shop_name'];
					echo '<option value =' . "$temp>" . "$temp" . '</option>';
				}
				while($row = $result_clerk->fetch_assoc()){
					$temp = $row['shop_name'];
					echo '<option value =' . "$temp>" . "$temp" . '</option>';
				}

			?>
			</select>
      	<button type="submit">search</button>
  	</form>


  <?php
	$sql = "SELECT * FROM Orders INNER JOIN Clerk on Orders.shop_id = Clerk.shop_id
									inner join Shop on Orders.shop_id = Shop.shop_id where Clerk.user_id = {$_SESSION['user_id']} ";
	$sql2 = "SELECT * FROM Orders INNER JOIN Manager on Orders.shop_id = Manager.shop_id
									inner join Shop on Orders.shop_id = Shop.shop_id where Manager.user_id = {$_SESSION['user_id']} ";
	if(isset($_POST['searchstatus'])){
        if($_POST['searchstatus']==="a"){
            $sql .= "";
			$sql2 .= "";
        }
        if($_POST['searchstatus']==="nf"){
            $sql .= "and Orders.order_status='NotFinished' ";
			$sql2 .= "and Orders.order_status='NotFinished' ";
        }
        if($_POST['searchstatus']==="f"){
            $sql .= "and Orders.order_status='Finished' ";
			$sql2 .= "and Orders.order_status='Finished' ";
        }
        if($_POST['searchstatus']==="c"){
            $sql .= "and Orders.order_status='Cancelled' ";
			$sql2 .= "and Orders.order_status='Cancelled' ";
        }
    }
	if(isset($_POST['searchshop'])){
		$temp = $_POST['searchshop'];
		if($temp==="all"){

		}
		else {
			$sql .= "and shop_name = '$temp' ";
			$sql2 .= "and shop_name = '$temp' ";
		}
	}

    $result=$conn->query($sql);
	$result2=$conn->query($sql2);
    ?>



    <table class="table">
    <thead class="thead-dark">
      <tr>
	  <th scope="col">OID</th>
        <th scope="col">Status</th>
        <th scope="col">Start time</th>
        <th scope="col">End time</th>
        <th scope="col">canceller/finsher</th>
        <th scope="col">Shop</th>
        <th scope="col">#</th>
        <th scope="col">$$</th>
        <th scope="col">price</th>
        <th scope="col">Action</th>

      </tr>
    </thead>
<?php
	//echo $sql;
	//echo $sql2;
	$printed = [];
    if ($result) {
      while($row = $result->fetch_assoc()) {
		if(array_key_exists($row['order_id'] , $printed))continue;
		else {
			$printed[$row['order_id']] = true;
		}
        echo 	"<tbody>";
        echo  	"<tr>";
        echo 	"<th scope='col'>" . $row['order_id'] . "</th>";
		    echo  "<th scope='col'>" . $row['order_status'] . "</th>";
        echo 	"<th scope='col'>" . $row['order_create_time'] . "</th>";
    	  echo 	"<th scope='col'>" . $row['order_finish_time'] . "</th>";
        echo 	"<th scope='col'>" . $row['order_finisher'] . "</th>";
        echo 	"<th scope='col'>" . $row['shop_name'] . "</th>";
        echo 	"<th scope='col'>" . $row['order_num'] . "</th>";
        echo 	"<th scope='col'>" . $row['order_price'] . "</th>";
        echo 	"<th scope='col'>" .(int)$row['order_num']*(int)$row['order_price'] . "</th>";
		if($row['order_finish_time'] === "None" ){
		 $_SESSION['order_id']=$row['order_id'];
		echo 	"<th scope='col'><form method='post' action='shopdone.php'>";
    	echo 	'<button type="submit">Done</button>';
		echo    '</form>';
		echo 	"<form method='post' action='shopcancel.php'>";
		echo 	'<button type="submit">Cancel</button>';
		echo    '</form></th>';
		}
		echo 	'</tr>';
		echo 	'</tbody>';
      }
  	}
	if ($result2) {
      while($row = $result2->fetch_assoc()) {
		if(array_key_exists($row['order_id'] , $printed))continue;
  		else {
  			$printed[$row['order_id']] = true;
  		}
        echo 	"<tbody>";
        echo  	"<tr>";
		echo 	"<th scope='col'>" . $row['order_id'] . "</th>";
		echo  "<th scope='col'>" . $row['order_status'] . "</th>";
	echo 	"<th scope='col'>" . $row['order_create_time'] . "</th>";
	  echo 	"<th scope='col'>" . $row['order_finish_time'] . "</th>";
	echo 	"<th scope='col'>" . $row['order_finisher'] . "</th>";
	echo 	"<th scope='col'>" . $row['shop_name'] . "</th>";
	echo 	"<th scope='col'>" . $row['order_num'] . "</th>";
	echo 	"<th scope='col'>" . $row['order_price'] . "</th>";
	echo 	"<th scope='col'>" .(int)$row['order_num']*(int)$row['order_price'] . "</th>";
	if($row['order_finish_time'] === "None" ){
	 $_SESSION['order_id']=$row['order_id'];
	echo 	"<th scope='col'><form method='post' action='shopdone.php'>";
	echo 	'<button type="submit">Done</button>';
	echo    '</form>';
	echo 	"<form method='post' action='shopcancel.php'>";
	echo 	'<button type="submit">Cancel</button>';
	echo    '</form></th>';
	}
		echo 	'</tr>';
		echo 	'</tbody>';
      }
  	}
?>

  </table>


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
}else{
     header("Location: index.php");
     exit();
}
 ?>
