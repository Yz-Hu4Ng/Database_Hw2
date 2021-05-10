<?php 
session_start(); 
include "db_conn.php";



$clerktodeleteid=$_SESSION['clerk_id'];

$sql = "delete  FROM Clerk WHERE = clerk_id='$clerktodeleteid'";
$result=$conn->query($sql);
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: shop.php?");
    exit();
  } else {
    echo "Error deleting record: " . $conn->error;
    header("Location: index.php");
    exit();
}

