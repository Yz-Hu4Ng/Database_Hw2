<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['user_id']) 
    && isset($_SESSION['user_name'])
    && isset($_POST['searchshopname']) 
    && isset($_POST['selectcity'])
    && (isset($_POST['searchpricea']) || isset($_POST['searchpriceb']))
    && isset($_POST['searchamount'])
    ){

    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // three situations :
    // only > a 
    // only < b
    // a <= x <= b

    $userid = validate($_SESSION['user_id']);
    $username = validate($_SESSION['user_name']);
    
    $searchshopname = validate($_POST['searchshopname']);//user's input to search for shop name
    $searchcity = validate($_POST['selectcity']);
    $searchpricea = validate($_POST['searchpricea']);//price lower bound a
    $searchpriceb = validate($_POST['searchpriceb']);//price upper bound b
    $searchamount = validate($_POST['searchamount']);//user's input to search for masks amount
    $search_shop_i_work = validate($_POST['search_shop_i_work']);//only showing shop that user works at or showing all 
    /*
    $sql = "search Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price from Shop natural join Manager natural join Clerk where Shop.shop_name like %$searchshopname% and city = '$searchcity' ";
    */
    $sql = "select Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price from Shop natural join Manager inner join Clerk on Manager.shop_id = Clerk.shop_id ";
    
    if($searchamount == "l") $sql .= "and mask_count >= 100 ";
    if($searchamount == "m") $sql .= "and mask_count < 100 and mask_count > 50 ";
    if($searchamount == "s") $sql .= "and mask_count <= 50 ";
    
    if(!empty($searchpricea)) $sql .= "and mask_price > $searchpricea ";
    if(!empty($searchpriceb)) $sql .= "and mask_price < $searchpriceb ";

    if(isset($_POST['search_shop_i_work'])) $sql .= "and Manager.user_id = '$userid' or Clerk.user_id = '$userid' ";
    
    

  
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
  $result = mysqli_query($conn , $sql);
  if(!$result)echo "fuckyou";
  if ($result){
    
      while ($row=mysqli_fetch_row($result))
      {
          echo "<div text-size=25px>shopname : $row[0] , city : $row[1] , mask amount : $row[2] , mask price : $row[3]</div>";
          echo "<br>";
      }
      
      mysqli_free_result($result);
  }

  ?>
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
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
      echo "<script>alert('Please check your condition');location.href = 'home.php';</script>";
    }
    else {
      header("Location: shop.php");
      exit();
    }
}
?>
