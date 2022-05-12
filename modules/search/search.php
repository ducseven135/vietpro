<?php
if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $arr = array(); //khai bao mang
    $arr = explode(" ", $keyword); //bien chuoi thanh mang
    $str = "%" . implode("%", $arr) . "%"; //bien mang thanh chuoi
} elseif (isset($_GET['str'])) {
    $str = $_GET['str'];
    $arr = array();
    $arr = explode("%", $str);
    $keyword = implode(" ", $arr);
} else {
    header("location: index.php");
}
//phan trang
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$row_per_page = 9;
$per_row = $page * $row_per_page - $row_per_page;
$total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE prd_name like '$str'"));
$total_page = ceil($total_row / $row_per_page);
$list_page = "";
//prev
$prev = $page - 1;
if ($prev <= 1) {
    $prev = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&page=' . $prev . '&str=' . $str . '">Trang trước</a></li>';
//so trang
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        $active = 'active';
    } else {
        $active = '';
    }
    $list_page .= '<li class="page-item ' . $active . '"><a class="page-link" href="index.php?page_layout=search&page=' . $i . '&str=' . $str . '">' . $i . '</a></li>';
}
//next
$next = $page + 1;
if ($next >= $total_page) {
    $next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&page=' . $next . '&str=' . $str . '">Trang sau</a></li>';
?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <div class="product-list row">
        <?php
        $sql = "SELECT * FROM product WHERE prd_name LIKE '$str' ORDER BY prd_id DESC LIMIT $per_row, $row_per_page";
        $query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
                <div class="product-item card text-center">
                    <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                    <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                    <p>Giá Bán: <span><?php echo number_format($row['prd_price']); ?></span></p>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php
        echo $list_page;
        ?>
    </ul>
</div>