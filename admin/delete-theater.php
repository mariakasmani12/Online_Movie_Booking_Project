
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['t_id'])){
   $id=$_GET['t_id'];

   $sql_delete="DELETE FROM `theater` WHERE `theater`.`theater_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: theater-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>