<?php
// Kết nối CSDL
include_once(__DIR__ . '/../../../dbconnect.php');

include_once(__DIR__ . '/../../../layouts/partials/header.php');
include_once(__DIR__ . '/../../../layouts/partials/sidebar.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $productDesc = $_POST['product_desc'] ?? '';
    $price = $_POST['price'] ?? 0;


    $sql = "INSERT INTO products (product_name, product_desc, price) 
            VALUES ('$productName', '$productDesc', '$price')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Thêm sản phẩm thành công!'); window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container mt-4">
    <h3>Thêm Sản Phẩm</h3>
    <form method="post">
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="product_name" id="product_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="product_desc" class="form-label">Mô tả</label>
            <textarea name="product_desc" id="product_desc" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php
// Footer (nếu có)
include_once(__DIR__ . '/../../../layouts/partials/footer.php');
?>
