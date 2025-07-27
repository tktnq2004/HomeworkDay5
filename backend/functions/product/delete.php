<?php
include_once(__DIR__ . '/../../../dbconnect.php');

$productID = $_GET['id'] ?? null;

if (!$productID) {
    echo "<script>alert('Thiếu ID sản phẩm'); window.location.href = 'index.php';</script>";
    exit;
}

$sqlDelete = "DELETE FROM products WHERE id = $productID";
$result = mysqli_query($conn, $sqlDelete);

if ($result) {
    echo "<script>alert('Xóa sản phẩm thành công!'); window.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Lỗi khi xóa: " . mysqli_error($conn) . "'); window.location.href = 'index.php';</script>";
}
?>
