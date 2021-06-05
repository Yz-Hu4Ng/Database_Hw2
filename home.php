<?php
session_start();

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

<body>
  <form action="shop_search.php" method="post">
      <h1 style="text-align:left">Profile</h1>
      <p><b>Account:</b> <?php echo $_SESSION['user_name']; ?></p>
      <p><b>Phone:</b> <?php echo $_SESSION['phone']; ?></p>
      <h3 style="text-align:left">Shop List</h3>

      <p><b>Shop</b> <?php //echo $_SESSION['user_name']; ?></p>
          <label>Search for shop name</label>
          <input type="searchshopname" id="shopname" name="searchshopname" size="25">

      <p><b>City</b> <?php //echo $_SESSION['phone']; ?></p>
          <select name="selectcity" size="1" id="city">
          <option value="">- Please select a city -</option>
          <option value="Taipei">Taipei</option>
          <option value="Hsinchu">Hsinchu</option>
          </select>

      <p><b>Price</b> <?php //echo $_SESSION['user_name']; ?></p>
          <label>Ranging</label>
          <input type="searchpricea" id="pricea" name="searchpricea" size="25">
          from
          <input type="searchpriceb" id="priceb" name="searchpriceb" size="25">

      <p><b>Amount</b> <?php //echo $_SESSION['phone']; ?></p>
          <select name="searchamount" size="1" id="amount">
          <option value=""> Please select amount </option>
          <option value="s"> < 50 </option>
          <option value="m"> 50 ~ 100 </option>
          <option value="l"> > 100 </option></select>

      <p><b>Search where I work</b>
          <input type="checkbox" name="search_shop_i_work" value="yes" size="25">

      <button type="submit">Find</button>
  </form>
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
