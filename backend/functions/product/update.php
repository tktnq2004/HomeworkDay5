<?php
include_once(__DIR__ . '/../../../dbconnect.php');

$productID = $_GET['id'] ?? null;

if (!$productID) {
    echo "<script>alert('Thiếu ID sản phẩm'); window.location.href = 'index.php';</script>";
    exit;
}

// Lấy dữ liệu sản phẩm cần sửa
$sqlSelect = "SELECT * FROM products WHERE id = $productID";
$result = mysqli_query($conn, $sqlSelect);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<script>alert('Không tìm thấy sản phẩm'); window.location.href = 'index.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'] ?? '';
    $productDesc = $_POST['product_desc'] ?? '';
    $price = $_POST['price'] ?? 0;

    $sqlUpdate = "UPDATE products 
                  SET product_name = '$productName', product_desc = '$productDesc', price = $price 
                  WHERE id = $productID";
    $updateResult = mysqli_query($conn, $sqlUpdate);

    if ($updateResult) {
        echo "<script>alert('Cập nhật thành công!'); window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container mt-4">
    <h3>Cập nhật Sản Phẩm</h3>
    <form method="post">
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên sản phẩm</label>
            <input type="text" name="product_name" id="product_name" class="form-control" required value="<?= htmlspecialchars($product['product_name']) ?>">
        </div>
        <div class="mb-3">
            <label for="product_desc" class="form-label">Mô tả</label>
            <textarea name="product_desc" id="product_desc" class="form-control" rows="4"><?= htmlspecialchars($product['product_desc']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" name="price" id="price" class="form-control" required min="0" value="<?= $product['price'] ?>">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php include_once(__DIR__ . '/../../../layouts/partials/footer.php'); ?>
