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
      <li><a class="navbar-brand" href=#>Home</a></li>
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
  <form action="myorder.php" method="post">
      <h1 style="text-align:left">My Order</h1>    
     
      <p><b>Status</b> </p>
          <select name="searchstatus" size="1" id="amount">
          <option value="a"> All </option>
          <option value="nf"> Not Finished </option>
          <option value="f"> Finished </option>
          <option value="c"> Cancelled </option></select>
      
    <br>
    <br>
      
      <button type="submit">search</button>
  </form>
  
<body>

<form type="text/css" action="deleteclerk.php" method="post">
    
  <?php 
    $order_creater=$_SESSION['user_id'];
    if(isset($_POST['searchstatus'])){
        if($_POST['searchstatus']==="a"){
            $sql="SELECT * FROM Orders  WHERE order_creater='$order_creater' ";
        }
        if($_POST['searchstatus']==="nf"){
            $sql="SELECT * FROM Orders  WHERE order_creater='$order_creater' and order_status='NotFinished'";
        }
        if($_POST['searchstatus']==="f"){
            $sql="SELECT * FROM Orders  WHERE order_creater='$order_creater' and order_status='Finishded'";
        }
        if($_POST['searchstatus']==="c"){
            $sql="SELECT * FROM Orders  WHERE order_creater='$order_creater' and order_status='Cancelled' ";
        }




        
    }

    
    $result=$conn->query($sql);
    ?>



    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">OID</th>
        <th scope="col">Status</th>
        <th scope="col">Start time</th>
        <th scope="col">creater</th>
        <th scope="col">End time</th>
        <th scope="col">canceller/finsher</th>
        <th scope="col">Shop</th>
        <th scope="col">#</th>
        <th scope="col">$$</th>
        <th scope="col">price</th>
        <th scope="col"></th>
      </tr>
    </thead>

<?php
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        //echo "name: " . $row["user_name"]. "Phone:" . $row["phone"];?>
        <tbody>
          <tr>
            <th scope="row"><?php echo $row["user_name"]?></th>
            <td><?php echo $row["phone"]?></td>
            <td><button  type="submit">delete</button></td>
          </tr>
        </tbody>
        <?php
        $_SESSION['clerk_id']=$row["clerk_id"];
               
        ?>

        <br>
      <?php
      }
    } else {
      echo "there is no employee";
    }
    
  ?>
  </table>
</form>
</body>
  
  <?php
    if(isset($_POST['searchstatus'])){
        echo $_POST['searchstatus'];}
  
  ?>

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
