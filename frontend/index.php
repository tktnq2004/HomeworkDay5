<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemoShop - Trang Chủ</title>
    <?php include_once(__DIR__ . '/layouts/styles.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>

    <main>
        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/demoshop/assets/uploads/slider/DMX1.jpg" class="d-block w-100" alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block text-start">
                        <h1 class="text-light">Chào mừng đến DemoShop</h1>
                        <p>Sản phẩm chất lượng - Giao hàng nhanh chóng</p>
                        <a class="btn btn-primary" href="#">Mua ngay</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/demoshop/assets/uploads/slider/DMX2.jpg" class="d-block w-100" alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="text-light">Ưu đãi lớn trong tháng</h1>
                        <p>Khuyến mãi lên đến 50% cho nhiều sản phẩm</p>
                        <a class="btn btn-warning" href="#">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container py-5 text-center">
            <div class="row">
                <div class="col-md-4">
                    <i class="fa fa-credit-card fa-3x text-primary mb-3"></i>
                    <h4>Thanh toán dễ dàng</h4>
                    <p>Hỗ trợ nhiều hình thức thanh toán tiện lợi và an toàn.</p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-truck fa-3x text-success mb-3"></i>
                    <h4>Giao hàng nhanh</h4>
                    <p>Miễn phí giao hàng toàn quốc với đơn từ 500K.</p>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-headphones fa-3x text-danger mb-3"></i>
                    <h4>Hỗ trợ 24/7</h4>
                    <p>Đội ngũ tư vấn viên nhiệt tình luôn sẵn sàng hỗ trợ bạn.</p>
                </div>
            </div>
        </div>

        <div class="bg-light py-5">
            <div class="container">
                <h3 class="mb-4 text-center">Sản phẩm mới nhất</h3>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
                    <?php
                    include_once(__DIR__ . '/../dbConnect.php');
                    $conn = connectDB();
                    $sql = "SELECT id, name, price, image_url FROM products ORDER BY id DESC LIMIT 8";
                    $result = $conn->query($sql);
                    $data = [];
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_array(MYSQLI_NUM)) {
                            $data[] = $row;
                        }
                        $result->free_result();
                    }
                    $conn->close();
                    ?>

                    <?php foreach ($data as $item): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="/demoshop/assets/<?= htmlspecialchars($item[3]) ?>" class="card-img-top" alt="<?= htmlspecialchars($item[1]) ?>">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title"><?= htmlspecialchars($item[1]) ?></h6>
                                    <p class="card-text text-danger fw-bold"><?= number_format($item[2], 0, ',', '.') ?> đ</p>
                                    <button class="btn btn-sm btn-outline-secondary btn-add-cart"
                                    data-id="<?= $item[0]?>"
                                    data-name="<?= $item[1]?>"
                                    data-price="<?= $item[2]?>"
                                    data-image="<?= $item[3]?>">
                                       Add Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/layouts/scripts.php'); ?>

    <script>
        $(document).ready(function(){
            $('.btn-add-cart').click(function(e){
                e.preventDefault();
                const id = $(this).data('id');
                const name = $(this).data('name');
                const price = $(this).data('price');
                const image = $(this).data('image');
                const data = {
                    id,
                    name,
                    price,
                    image,
                    quantity:1,
                }

                $.ajax({
                    url: 'demoshop/frontend/api/add_cart_item.php',
                    method: 'post',
                    dataType: 'json',
                    data: data,
                    success:function(data){
                        alert('Add product to cart success');
                    }, error:function(jqXHR, textStatus, errorThrown){
                        alert(textStatus);
                    }
                })
            })
        });
    </script>

</body>
</html>
