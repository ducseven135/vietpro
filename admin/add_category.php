<?php
if (!defined("SECURITY")) {
    die("khong co quyen truy cap");
}
?>
<?php
$sql = "SELECT * FROM category";
$query = mysqli_query($conn, $sql);
if (isset($_POST['sbm'])) {
    $check = TRUE;
    $cat_name = $_POST['cat_name'];
    while ($row = mysqli_fetch_array($query)) {
        if ($cat_name == $row['cat_name']) {
            $check = FALSE;
        }
    }
    if ($check) {
        $sql_add = "INSERT INTO category (cat_name) VALUE ('$cat_name')";
        $query_add = mysqli_query($conn, $sql_add);
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active">Thêm danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <?php
                        if (isset($_POST['sbm'])) {
                            if ($check) {
                                echo '<div class="alert alert-success">Danh mục thêm mới thành công !</div>';
                            } else {
                                echo '<div class="alert alert-danger">Danh mục đã tồn tại !</div>';
                            }
                        }
                        ?>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input required type="text" name="cat_name" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->