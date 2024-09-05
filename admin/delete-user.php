
<?php
ob_start();
require('../connection/connection.php');
if(isset($_GET['u_id'])){
   $id=$_GET['u_id'];

   $sql_delete="DELETE FROM `user` WHERE `user`.`user_id` = $id";
 
   if($d=mysqli_query($conn,$sql_delete)){
    if($d){
    $sql_login="DELETE FROM `login` WHERE `login`.`user_id` = $id";
    if(mysqli_query($conn,$sql_login)){
    header("Location: user-admin.php");
    exit();
   }
   else{
    echo "does not del";
   }
}
}
}

?>