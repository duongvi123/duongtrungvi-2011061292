<?php include_once("header.php"); ?>
<ul class="menu">
    <li>
        <a href="/phpb6/list_product.php">THONG TIN NHAN VIEN</a>
    </li>

    <?php
    // Kết nối CSDL
    $conn = mysqli_connect("localhost", "root", "", "ql_nhansu");

    // Phân trang
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $records_per_page = 5;
    $offset = ($page - 1) * $records_per_page;

    // Truy vấn lấy dữ liệu nhân viên với phân trang
    $sql = "SELECT * FROM nhanvien LIMIT $offset, $records_per_page";
    $result = mysqli_query($conn, $sql);

    // Tạo bảng HTML
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>";
    echo "<th>Mã Nhân Viên</th>";
    echo "<th>Tên Nhân Viên</th>";
    echo "<th>Giới tính</th>";
    echo "<th>Nơi Sinh</th>";
    echo "<th>Tên Phòng</th>";
    echo "<th>Lương</th>";
    echo "</tr>";

    // Duyệt qua kết quả và hiển thị từng nhân viên
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['MA_NV'] . "</td>";
        echo "<td>" . $row['Ten_NV'] . "</td>";
        echo "<td>";
        if ($row['phai'] == "NAM") {
            echo "<img src='nam.png' alt='NAM'>";
        } else {
            echo "<img src='nu.png' alt='NU'>";
        }
        echo "</td>";
        echo "<td>" . $row['Noi_Sinh'] . "</td>";
        echo "<td>" . $row['Ma_Phong'] . "</td>";
        echo "<td>" . $row['Luong'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Phân trang
    $sql_total = "SELECT COUNT(*) AS total FROM nhanvien";
    $result_total = mysqli_query($conn, $sql_total);
    $row_total = mysqli_fetch_assoc($result_total);
    $total_records = $row_total['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Hiển thị các nút phân trang
    echo "<div>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='/phpb6/list_product.php?page=" . $i . "'>" . $i . "</a> ";
    }
    echo "</div>";

    // Đóng kết nối CSDL
    mysqli_close($conn);
    ?>

</ul>
<?php include_once("footer.php"); ?>
