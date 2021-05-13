<?php
session_start();

include "db_conn.php";
?>

<?php
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}
?>

<?php
//if this is a shop owner
if (isset($_SESSION['is_owner']) && $_SESSION['is_owner'] == true) {
?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<head>
  <label>You are the owner of a shop!!</label>
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
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</header>
<h1 style="text-align:left">Myshop</h1>
<body>
      <?php
          $sql = "select * from User natural join Manager natural join Shop where user_name='$_SESSION[user_name]'";
          $result = $conn->query($sql);
          if($result->num_rows>0){
            $row = $result->fetch_assoc();
            $shopnametoshow=$row["shop_name"];
            
            $shopcitytoshow=$row["city"];
            $shopmask=$row["mask_count"];
            
            $maskprice=$row["mask_price"];

            $_SESSION['shop_id'] = $row['shop_id'];
            
          }                
      ?>
      <p><b>Shop:</b> <?php echo $shopnametoshow; ?></p>
      <p><b>City:</b> <?php echo $shopcitytoshow; ?></p>
</body>

<?php // this is where to change the mask price?>
<body>
  <?php 
      $error1="";
      if (isset($_GET['error'])&&$_GET['error']==="price must be greater than 0") {
          $error1="price must be greater than 0";
        }
  ?>

  <form action="maskpriceedit.php" method="post">
  <label>Mask Price</label>
          <input type="text"
                 name="mskpriceedit"
                 placeholder=<?php echo $maskprice; ?>
           style="color:#DCFF3C;"><?php echo $error1?></p>


          <button type="submit">edit</button>
  </form>
</body>

<?php // this is where to change the mask amount?>
<body>
  <?php 
      $error2="";
      if (isset($_GET['error'])&&$_GET['error']==="amount must be greater than 0") {
          $error2="amount must be greater than 0";
        }
  ?>
  <form action="maskamountedit.php" method="post">
  <label>Mask Amount</label>
          <input type="text"
                 name="mskamountedit"
                 placeholder=<?php echo $shopmask; ?>
           style="color:#DCFF3C;"><?php echo $error2?></p>

          <button type="submit">edit</button>
  </form>
</body>
<h2> Employee</h2>

<body>
<?php //this is where to add the employee?>
  
  <?php 
    // error issue
    $error3="";
    if (isset($_GET['error'])&&$_GET['error']!=="price must be greater than 0"&&$_GET['error']!=="amount must be greater than 0") {
      $error3=$_GET['error'];
    }
  ?>

  <form action="employeeadd.php" method="post">
  <label>Add Employee</label>
          <input type="text"
                 name="addemployee"
                 placeholder="Type account"
           style="color:#DCFF3C;"><?php echo $error3?></p>

          <button type="submit">Add</button>

  </form>
</body>


<body>
<form type="text/css" action="deleteclerk.php" method="post">
    
  <?php 
    $shoppid=$_SESSION['shop_id'];
    $shoppid=$conn->real_escape_string($shoppid);
    $sql="SELECT * FROM Clerk natural join User WHERE shop_id='$shoppid'";
    $result=$conn->query($sql);
    ?>



    <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Account</th>
        <th scope="col">Phone</th>
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

      
</html>
<?php
}
?>



<?php
//if this is not a shop owner
if (!isset($_SESSION['is_owner']) || $_SESSION['is_owner'] == false) {
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<head>
  <label>Shop page when you are not an owner</label>
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
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</header>

<body>
    <form action="makeshopcheck.php" method="post">
    <label>You are not a shop owner</label>


    <p><b>Wanna register?</b> <?php //echo $_SESSION['user_name']; ?></p>
    <label>Where is your shop?</label>
    <input type="shoploc" id="shoploc" name="shoploc" size="25">
    <label>What is your shop name?</label>
    <input type="shopname" id="shopname" name="shopname" size="25">
    <label>How many mask do you have?</label>
    <input type="maskamount" id="maskamount" name="maskamount" size="25">
    <label>What is your desired price?</label>
    <input type="maskprice" id="maskprice" name="maskprice" size="25">



    <button type="submit">Push this buttom to register!</button>



    </form>
<style>
  input {
    width : 200px;
  }
</style>
</body>
</html>


  
<?php
}
?>