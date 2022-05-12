<?php
session_start();
define("SECURITY", TRUE);
include_once("../config/connect.php");
if(isset($_SESSION['mail']) and $_SESSION['pass']){
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM user WHERE user_id = $user_id";
    mysqli_query($conn,$sql);
    header("location: index.php?page_layout=user");
}else{
    include_once("index.php");
}
?>