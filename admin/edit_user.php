<?php
if(!defined("SECURITY")){
    die ("ban khong co quyen truy cap");
}
$user_id = $_GET['user_id'];
$sql = "SELECT * FROM user WHERE user_id = $user_id";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$check_mail = TRUE;
$check_pass = TRUE;
$check_update = FALSE;
if(isset($_POST['sbm'])){
    $user_full = $_POST['user_full'];
    $user_mail = $_POST['user_mail'];
    $user_pass = $_POST['user_pass'];
    $user_re_pass = $_POST['user_re_pass'];
    $user_level = $_POST['user_level'];
    $sql_check = "SELECT * FROM user";
    $query_check = mysqli_query($conn,$sql_check);
    while($row_check = mysqli_fetch_array($query_check)){
        if($row_check['user_mail'] == $user_mail and $row_check['user_id'] != $user_id ){
            $check_mail = FALSE;
        break;
        }
    }
    if($user_pass != $user_re_pass){
        $check_pass = FALSE;
    }
    if($check_mail and $check_pass){
        $check_update = TRUE;
        $sql_update = "UPDATE user SET user_full = '$user_full', user_mail = '$user_mail', 
        user_pass = '$user_pass', user_level = $user_level WHERE user_id = $user_id";
        mysqli_query($conn,$sql_update);
    }
}

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý thành viên</a></li>
				<li class="active"><?php echo $row['user_full']; ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thành viên: <?php echo $row['user_full'] ?></h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-8">
                                <?php
                                if(!$check_mail){
                                    echo '<div class="alert alert-danger">Email đã tồn tại !</div>';
                                }
                                if(!$check_pass){
                                    echo '<div class="alert alert-danger">Mật khẩu không khớp !</div>';
                                }
                                if($check_update){
                                    echo '<div class="alert alert-success">Người dùng chỉnh sửa thành công !</div>';
                                }
                                ?>
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Họ & Tên</label>
                                    <input type="text" name="user_full" required class="form-control" value="<?php echo $row['user_full']; ?>" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="user_mail" required value="<?php echo $row['user_mail']; ?>" class="form-control">
                                </div>                       
                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" name="user_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" name="user_re_pass" required  class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Quyền</label>
                                    <select name="user_level" class="form-control">
                                        <option value=1 <?php if($row['user_level'] == 1 ){echo 'selected';} ?> >Admin</option>
                                        <option value=2 <?php if($row['user_level'] == 2 ){echo 'selected';} ?>>Member</option>
                                    </select>
                                </div>
                                <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	
