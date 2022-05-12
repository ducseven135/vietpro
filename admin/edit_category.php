<?php 
if(!defined("SECURITY")){
	die("khong co quyen truy cap");
}
?>
<?php
$cat_id = $_GET['cat_id'];
$sql = "SELECT * FROM category WHERE cat_id ='$cat_id'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($query);
$check = TRUE;
if(isset($_POST['sbm'])){
    $cat_name = $_POST['cat_name'];
    $sql_check = "SELECT * FROM category";
    $query_check = mysqli_query($conn,$sql_check);
    while($row_check = mysqli_fetch_array($query_check)){
        if($cat_name == $row_check['cat_name']){
            $check = FALSE;
        break;
        }
    }
    if($check){
        $sql_update = "UPDATE category SET cat_name = '$cat_name' WHERE cat_id = $cat_id " ;
        $query_update = mysqli_query($conn,$sql_update);
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active"><?php echo $row['cat_name']; ?></li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục:<?php echo $row['cat_name']; ?></h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <?php 
                            if(isset($_POST['sbm'])){
                                if($check){
                                    echo '<div class="alert alert-success">Danh mục chỉnh sửa thành công !</div>';
                                }else{
                                    echo '<div class="alert alert-danger">Danh mục đã tồn tại !</div>' ;
                                }
                            }
                             ?>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="cat_name" required value="<?php echo $row['cat_name']; ?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	
