<?php
session_start();
if(isset($_SESSION['mail']) and isset($_SESSION['pass'])){
    session_destroy();
    header("location: index.php");
}
?>