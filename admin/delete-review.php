
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['r_id'])){
   $id=$_GET['r_id'];

   $sql_delete="DELETE FROM reviews WHERE `reviews`.`review_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: reviews-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>