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
      <a class="navbar-brand" href="#">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="login.php">Shop</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</header>

<body>
     <h1 style="text-align:left">Profile</h1>
     <p><b>Account:</b> <?php echo $_SESSION['user_name']; ?></p>
     <p><b>Phone:</b> <?php echo $_SESSION['phone']; ?></p>


</body>
<body>

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?> 