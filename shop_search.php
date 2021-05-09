<?php
session_start();

if  (isset($_SESSION['user_id']) 
    && isset($_SESSION['user_name'])
    && isset($_POST['searchshopname']) 
    && isset($_POST['selectcity'])
    && (isset($_POST['searchpricea']) || isset($_POST['searchpriceb']))
    && isset($_POST['searchamount'])
    )
{

    function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    $userid = validate($_SESSION['user_id']);
    $username = validate($_SESSION['user_name']);
    
    $searchshopname = validate($_POST['searchshopname']);//user's input to search for shop name
    $searchpricea = validate($_SESSION['searchpricea']);//price lower bound a
    $searchpriceb = validate($_SESSION['searchpriceb']);//price upper bound b
    $searchamount = validate($_SESSION['searchamount']);//user's input to search for masks amount
    $search_shop_i_work = validate($_POST['search_shop_i_work']);//only showing shop that user works at or showing all 

    $sql = "";
    /*
    //unfinished 
        
        


        if(empty($search_shop_i_work)){
        $sql = "select shop_name , city , mask_count , mask_price 
                from Shop 
                inner join Clerk 
                on Shop.shop_id == Manager.shop_id
                inner join "; 

        $result = mysqli_query($conn, $sql);

    
    }
    */

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
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
</header>

<body>
    
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
    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
      echo "<script>alert('Please check your condition');location.href = 'home.php';</script>";
    }
    else {
      header("Location: shop.php");
      exit();
    }
}
?>
