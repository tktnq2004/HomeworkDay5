<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Cart</title>
    <?php include_once(__DIR__ ."/../layouts/styles.php"); ?>
</head>
<body>
    <?php include_once(__DIR__ ."/../layouts/partials/header.php"); ?>

    <main style="margin-top:100px;">
        <h2 class="text-center">View Cart</h2>
        <?php 
            include_once(__DIR__ ."/../../dbConnect.php");
            $cart = $_SESSION["cart"] ?? [];
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Sub total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($cart)): ?>
                            <?php 
                                $no = 1;
                                $total = 0;
                                foreach ($cart as $item): 
                                    $subTotal = $item['price'] * $item['quantity'];
                                    $total += $subTotal;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><img src="/demoshop/assets/<?= htmlspecialchars($item['image']) ?>" alt="" style="width:100px;height:auto"></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= number_format($item['price']) ?> đ</td>
                                    <td>
                                        <input type="number" class="form-control quantity-input" id="quantity_<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" min="1">
                                        <button class="btn btn-primary btn-sm btn-update-quantity mt-1" data-id="<?= $item['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
                                    </td>
                                    <td><?= number_format($subTotal) ?> đ</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm btn-delete-item" data-id="<?= $item['id'] ?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </td>
                                </tr>
                            <?php $no++; endforeach; ?>
                            <tr>
                                <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2"><strong><?= number_format($total) ?> đ</strong></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td class="text-center" colspan="7">Cart empty</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <a href="/demoshop/frontend" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Continue Shopping</a>
                    <?php if (!empty($cart)): ?>
                        <a href="/demoshop/frontend/checkout.php" class="btn btn-success btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Check Out</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include_once(__DIR__ ."/../layouts/partials/footer.php"); ?>
    <?php include_once(__DIR__ ."/../layouts/scripts.php"); ?>

    <script>
        $(document).ready(function () {
            // Cập nhật số lượng
            $('.btn-update-quantity').click(function () {
                const id = $(this).data('id');
                const quantity = $('#quantity_' + id).val();

                $.ajax({
                    url: '/demoshop/frontend/api/update_cart_item.php',
                    method: 'POST',
                    data: { id, quantity },
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            // Xóa sản phẩm khỏi giỏ hàng
            $('.btn-delete-item').click(function () {
                const id = $(this).data('id');

                $.ajax({
                    url: '/demoshop/frontend/api/remove_cart_item.php',
                    method: 'POST',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</body>
</html>
