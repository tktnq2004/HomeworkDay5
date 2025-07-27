<?php
session_start();
include_once(__DIR__ . "/../../dbConnect.php");

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: /demoshop/frontend/view_cart.php");
    exit();
}

$cart = $_SESSION['cart'];

// Tùy bạn: có thể thêm thông tin user nếu đã đăng nhập
$userId = $_SESSION['user_id'] ?? null; // nếu có login hệ thống

// Tạo đơn hàng trong bảng orders
$sql_order = "INSERT INTO orders (user_id, created_at) VALUES (?, NOW())";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("i", $userId);
$stmt->execute();
$orderId = $stmt->insert_id;

// Chèn từng sản phẩm vào bảng order_items
$sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt_item = $conn->prepare($sql_item);

foreach ($cart as $item) {
    $productId = $item['id'];
    $quantity = $item['quantity'];
    $price = $item['price'];
    $stmt_item->bind_param("iiid", $orderId, $productId, $quantity, $price);
    $stmt_item->execute();
}

// Xóa giỏ hàng sau khi checkout
unset($_SESSION['cart']);

// Chuyển hướng tới trang cảm ơn
header("Location: /demoshop/frontend/thank_you.php?order_id=" . $orderId);
exit();
?>
