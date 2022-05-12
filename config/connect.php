<?php
if(!defined("SECURITY")){
    die("ban khong co quyen truy cap");
}
$conn = mysqli_connect("localhost","root","","vietpro_mobile_shop");
if($conn){
    mysqli_query($conn,"SET NAMES 'utf8'");
}else{
    echo" ket noi that bai";
}

?>