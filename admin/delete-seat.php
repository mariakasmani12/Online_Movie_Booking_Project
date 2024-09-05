
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['st_id'])){
   $id=$_GET['st_id'];

   $sql_delete="DELETE FROM seat_class WHERE `seat_class`.`seat_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: seat-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>