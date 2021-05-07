<?php
session_start();
?>

<?php
if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}
?>

  
<?php
//if this is a shop owner
if (isset($_SESSION['is_owner'])) {
?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<head>
  <label>Shop page when you are an owner</label>
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

<body>

      <h1 style="text-align:left">Profile</h1>
      <p><b>Account:</b> <?php echo $_SESSION['user_name']; ?></p>
      <p><b>Phone:</b> <?php echo $_SESSION['phone']; ?></p>
      <?php
      //Todo: list all clerks
      //      add clerks
      //      delete clerks
          $userid = $_SESSION['user_id'];
          $to_find_clerk_userid =   "select * from Manager inner join 
                                    Clerk on Manager.shop_id == Clerk.shop_id 
                                    where Manager.user_id == '$ userid'";

          $result = $mysqli->query($to_find_clerk_userid);

          $rows = $result->fetch_all(MYSQLI_ASSOC);
          /*
          foreach ($rows as $row) {
          printf("%s (%s)\n", $row["Clerk.user_id"], $row[""]);
          }
          */
      }
      ?>
      
</body>
</html>
<?php
}
?>


<?php
//if this is not a shop owner
if (!isset($_SESSION['is_owner'])) {
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

