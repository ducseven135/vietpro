<?php session_start(); ?>
<?php
    if(isset($_POST['txtName'])){
        $error = '';
        if(isset($_POST['txtCaptcha']) and $_POST['txtCaptcha'] !=''){
            if($_SESSION['captcha'] == $_POST['txtCaptcha']){
                // Action of form...
                echo $_POST['txtName'].' is successfully processed';
                exit;
            }else{
                $error = '<font color="red">Sorry Incorrect captcha entered...</font>';
            }
        }else{
            $error = '<font color="red">You have not entered captcha.</font>';
        }
    }
?>
<html>
<head><title>Captcha</title></head>
<body>
    <?php if(isset($error)){ echo $error; } ?>
<form action="myform.php" method="post">
    <input type="text" name="txtName" value="" placeholder="Enter your name" />
    <br /><br />
    <img src="captcha.php" />&nbsp;&nbsp;&nbsp;<input type="text" name="txtCaptcha" value="" placeholder="Enter the number you see in the image" />
    <br /><br/>
    <input type="submit" value="Submit Data" />
</form>
</body>
</html>