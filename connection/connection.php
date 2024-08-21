<?php
$servername = "localhost";
$username="root";
$password="";
$database="theaterbooking_db";

$conn=mysqli_connect($servername,$username,$password,$database);
if($conn){
    echo "$database is connected sucessfully";
}

?>