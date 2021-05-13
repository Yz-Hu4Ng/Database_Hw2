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

    $_searchshopname = mysqli_real_escape_string($conn , $searchshopname);
    $_searchcity = mysqli_real_escape_string($conn , $searchcity);

    //$search_shop_i_work = validate($_POST['search_shop_i_work']);//only showing shop that user works at or showing all 
    /*
    $sql = "search Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price from Shop natural join Manager natural join Clerk where Shop.shop_name like %$searchshopname% and city = '$searchcity' ";
    */

    $searchshopname=$conn->real_escape_string($searchshopname);
    $searchcity=$conn->real_escape_string($searchcity);

    $sql = "select Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price 
            from Shop natural join Manager
            where Shop.shop_name like '%$_searchshopname%' and city = '$_searchcity' ";
    $sql2 = "select Shop.shop_name , Shop.city , Shop.mask_count , Shop.mask_price 
            from Shop natural join Clerk
            where Shop.shop_name like '%$_searchshopname%' and city = '$_searchcity' ";


    if($searchamount == "l") {$sql .= "and mask_count >= 100 ";$sql2 .= "and mask_count >= 100 ";}
    if($searchamount == "m") {$sql .= "and mask_count < 100 and mask_count > 50 ";$sql .= "and mask_count < 100 and mask_count > 50 ";}
    if($searchamount == "s") {$sql .= "and mask_count <= 50 ";$sql2 .= "and mask_count <= 50 ";}
    
    $searchpricea=$conn->real_escape_string($searchpricea);
    if(empty($searchpricea)){
       $sql .= "and mask_price >= 0 ";
       $sql2 .= "and mask_price >= 0 ";
    }
    else {
      $sql .= "and mask_price >= $searchpricea ";
      $sql2 .= "and mask_price >= $searchpricea ";
    }
    $searchpriceb=$conn->real_escape_string($searchpriceb);
    if(empty($searchpriceb)) {
      $sql .= "and mask_price < 99999999999999 ";
      $sql2 .= "and mask_price < 99999999999999 ";
    }
    else{
      $sql .= "and mask_price < $searchpriceb ";
      $sql2 .= "and mask_price < $searchpriceb ";
    }

    $userid=$conn->real_escape_string($userid);
    if(isset($_POST['search_shop_i_work'])) {$sql .= "and Manager.user_id = '$userid' "; $sql2 .= "and Clerk.user_id = '$userid' ";}
    
    

  
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
  //echo $sql;
  $result = mysqli_query($conn , $sql);
  $result2 = mysqli_query($conn , $sql2);
  
  if ($result->num_rows === 0 && $result2->num_rows === 0){
      echo "<a>Sorry , result not found.</a>";
      echo "<br>";
    //echo "<a herf='home.php'>Press me</a>";
  }
  else { ?>
    <table>
      <thead class="thead-dark">
        <tr>
          <th scope="col">Shop name</th>
          <th scope="col">City</th>
          <th scope="col">Mask amount</th>
          <th scope="col">Mask price</th>
        </tr>
      </thead>
  <?php
      while ($row= $result->fetch_row()){
          //echo "I'm inside while loop";
          echo "<div id='contentItem'>";
          echo "Shop name : $row[0] , city : $row[1] , mask amount = $row[2] , mask_price = $row[3]";
          echo "</div>";
      }
      if(isset($_SESSION['search_shop_i_work'])){
      while ($row= $result2->fetch_row()){

            //echo "I'm inside while loop";
            echo "<div id='contentItem'>";
            echo "Shop name : $row[0] , city : $row[1] , mask amount = $row[2] , mask_price = $row[3]";
            echo "</div>";
        }
      }
      mysqli_free_result($result2);
      mysqli_free_result($result);
  }
  
  ?>
</table>
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