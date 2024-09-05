
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['sh_id'])){
   $id=$_GET['sh_id'];

   $sql_delete="DELETE FROM shows WHERE `shows`.`show_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: show-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>