
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['sht_id'])){
   $id=$_GET['sht_id'];

   $sql_delete="DELETE FROM `show_timing` WHERE `show_timing`.`show_time_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: show-tim-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>