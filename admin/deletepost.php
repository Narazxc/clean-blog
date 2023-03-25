<?php
require_once '../models/Post.php';
include 'dbcon.php';

    // Start PHP session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['auth'])) {
        header("Location: ../index.php");
        exit();
    }

    if (isset($_GET['id'])){
        $id = $_GET['id'];
    


    $query = "delete from `blogs` where `id` = '$id'";
    // $stmt = mysqli_prepare($connection, $query);
    // mysqli_stmt_bind_param($stmt)

    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed".mysqli_error());
    } else {

        header('location: ./posts.php');


    }

}