
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['movie_id'])){
   $id=$_GET['movie_id'];

   $sql_delete="DELETE FROM `movies` WHERE `movies`.`movie_id` = $id";
   if(mysqli_query($conn,$sql_delete)){
    header("Location: movie-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}


?>