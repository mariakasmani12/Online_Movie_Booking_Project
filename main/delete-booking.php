
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['bookid'])){
   $id=$_GET['bookid'];
   
   $sql_delete="DELETE FROM `bookings` WHERE `bookings`.`b_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: profile.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>