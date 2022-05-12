<?php
session_start();
// tạo chuỗi captcha
function generate_string($length){
    $chars = '0123456789QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm'; //chuỗi kí tự để tạo captcha
    $size = strlen($chars); // độ dài chuỗi kí tự
    // tạo chuỗi ngẫu nhiên
    $random_string = "";
    for($i = 0; $i< $length; $i ++){
        $pos = rand(0, $size - 1); //lấy ngẫu nhiên vị trí kí tự trong chuỗi
        $random_string .= $chars[$pos]; //nối kí tự theo vị trí được lấy
    }
    return $random_string;
}
$_SESSION['captcha'] = generate_string(6);
// tạo nền captcha
$image = imagecreatetruecolor(200,50); //tạo hình ảnh với chiều dài 200, chiều cao 50 px
$text_color = imagecolorallocate($image, 255, 255, 255); // màu của chữ
$bg_color = imagecolorallocate($image, 231, 100, 18); // màu nền
$font = 'fonts/arial.ttf'; // đường dẫn đến font chữ
imagefilledrectangle($image, 0, 0, 200, 50, $bg_color); // tạo hình chữ nhật với toạ độ 4 góc và màu nền
imagettftext($image, 20, 0, 50, 40, $text_color, realpath($font), $_SESSION['captcha'] );// Viết chữ lên hình, cỡ chữ 20, 
// góc nghiêng 0, bắt đầu từ pixel 50 tính từ bên trái, phần dưới của chữ nằm ở pixel 40 từ trên xuống.
header('Content-type: image/png');// báo cho trình duyệt biết đây là file ảnh định dạng png
imagepng($image);// xuất ra trình duyệt ảnh định dạng png
imagedestroy($image);// xoá dữ liệu về hình ảnh đã xuất

?>