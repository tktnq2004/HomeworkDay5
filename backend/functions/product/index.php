<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash Board</title>
    <?php include_once(__DIR__ . '/../../../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__ . '/../../../layouts/partials/header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once(__DIR__ . '/../../../layouts/partials/sidebar.php'); ?>

            <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Product List</h1>
                </div>

                <?php
                include_once(__DIR__ . '/../../../../dbconnect.php');
                $sql = "SELECT id, name, price, stock_quantity, image_url, category FROM products ORDER BY id DESC";
                $result = $conn->query($sql);

                $prods = [];
                while ($row = $result->fetch_array(MYSQLI_NUM)) {
                    $prods[] = $row;
                }
                $result->free_result();
                $conn->close();
                ?>

                <a href="create.php" class="btn btn-primary">Create New</a>
                <table id="tblDanhSach" class="table table-bordered table-hover table-sm table-responsive mt-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prods as $item) : ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= $item[1] ?></td>
                                <td><?= number_format($item[2], 0, ',', '.') ?> VND</td>
                                <td><?= $item[3] ?></td>
                                <td><img src="/demoshop/assets/<?= htmlspecialchars($item[4]) ?>" alt="" style="width:120px;height:auto;" /></td>
                                <td><?= $item[5] ?></td>
                                <td>
                                    <a href="update.php?id=<?= $item[0] ?>" class="btn btn-sm btn-warning">Update</a>
                                    <a href="delete.php?id=<?= $item[0] ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <?php include_once(__DIR__ . '/../../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../../../layouts/scripts.php'); ?>
</body>
</html>
