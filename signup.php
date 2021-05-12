<!DOCTYPE html>
<html>
<head>

	<title>SIGN UP</title>
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
      <a class="navbar-brand" href="#">masksystem</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="login.php">Login</a></li>
      <li><a href="signup.php">signup</a></li>
    </ul>
  </div>
</nav>
</header>
<body>

     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
          <?php
               $er1="";
               $er2="";
               $er3="";
               $er4="";
          ?>


     	<?php if (isset($_GET['error'])) {

               switch($_GET['error']){
                    case"noun":
                         $er1="User Name is required";
                         break;
                    case"nopw":
                         $er3="Password is required";
                         break;
                    case"pwinvalid":
                         $er3="Invalid Format(Only letters and numbers are available)";
                         break;
                    case"norepw":
                         $er4="Please confirm the password";
                         break;
                    case"noph":
                         $er2="Phone Number is required";
                         break;
                    case"pwrepw":
                         $er3="The password does not match";
                         $er4="The password does not match";
                         break;
                    case"pwoc":
                         $er1="The username is taken, please try another one =)";
                         break;
                    case"phinval":
                         $er2="The password form is invalid";
                         break;

               }


     	 } ?>

          <?php if (isset($_GET['error'])) { ?>
     		       <p class="error">Sign up Failed</p>
     	    <?php } ?>
          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>


          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text"
                      name="uname"
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>"><br>
          <?php }else{ ?>
               <input type="text"
                      name="uname"
                      placeholder="User Name"><br>
          <?php }?>

          <p style="color:#DC143C;"><?php echo $er1?></p>

          <label>PhoneNumber</label>
     	<input type="text"
                 name="phone"
                 placeholder="Phone Number"><br>

          <p style="color:#DC143C;"><?php echo $er2?></p>



     	<label>Password</label>
     	<input type="text"
                 name="password"
                 placeholder="Password"><br>
          <p style="color:#DC143C;"><?php echo $er3?></p>

          <label>Confirm Password</label>
          <input type="text"
                 name="re_password"
                 placeholder="Password"><br>
          <p style="color:#DCFF3C;"><?php echo $er4?></p>


          <button type="submit">Sign Up</button>
     </form>
</body>
</html>
