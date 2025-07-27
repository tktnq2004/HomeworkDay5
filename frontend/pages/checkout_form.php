<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: /demoshop/frontend/view_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <?php include_once(__DIR__ ."/../layouts/styles.php"); ?>
</head>
<body>
<?php include_once(__DIR__ ."/../layouts/partials/header.php"); ?>

<main class="container mt-5">
    <h2>Checkout</h2>

    <form action="checkout.php" method="post">
        <div class="mb-3">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address">Shipping Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>

        <h4>Your Order:</h4>
        <ul class="list-group mb-3">
            <?php
            $total = 0;
            foreach ($cart as $item):
                $subTotal = $item['price'] * $item['quantity'];
                $total += $subTotal;
            ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?>
                    <span><?= number_format($subTotal) ?> đ</span>
                </li>
            <?php endforeach; ?>
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total</strong>
                <strong><?= number_format($total) ?> đ</strong>
            </li>
        </ul>

        <button type="submit" class="btn btn-success">Confirm & Place Order</button>
        <a href="view_cart.php" class="btn btn-secondary">Back to Cart</a>
    </form>
</main>

<?php include_once(__DIR__ ."/../layouts/partials/footer.php"); ?>
<?php include_once(__DIR__ ."/../layouts/scripts.php"); ?>
</body>
</html>
