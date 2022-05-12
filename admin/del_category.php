<?php
session_start();
define("SECURITY", TRUE);
include_once("../config/connect.php");
$cat_id = $_GET['cat_id'];
if(isset($_SESSION['mail']) and isset($_SESSION['pass'])){
    $sql = "DELETE FROM category WHERE cat_id = '$cat_id'";
    mysqli_query($conn,$sql);
    header("location: index.php?page_layout=category");
}else{
    include_once("index.php");
}
?>