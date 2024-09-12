<?php
include("admin-layouts/header.php");

// Check if an ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $screenId = $_GET['id'];


    $sql = "DELETE FROM screen WHERE screen_Id='$screenId'";


    if (mysqli_query($conn, $sql)) {
        header("Location: list-screen.php");
    } else {

        echo "Error deleting screen: " . mysqli_error($conn);
    }
} else {

    header("Location: list-screen.php");
}
