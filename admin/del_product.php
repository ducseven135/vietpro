<?php
session_start();
define("SECURITY", True);
include_once("../config/connect.php");
$prd_id = $_GET['prd_id'];
$prd_image=$_GET['prd_image'];
if(isset($_SESSION['mail']) and isset($_SESSION['pass'])){
    $url='img/products/'.$prd_image;
    $sql = "DELETE FROM product WHERE prd_id = '$prd_id'";
    mysqli_query($conn,$sql);
    unlink($url);
    header("location: index.php?page_layout=product");
}else{
    include_once("index.php");
}
?>