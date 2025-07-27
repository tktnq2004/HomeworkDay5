<?php
include_once(__DIR__ . '/../../../dbconnect.php');
$sql = "SELECT id, name, email, role FROM users ORDER BY id DESC";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_array(MYSQLI_NUM)) {
    $users[] = $row;
}
$result->free_result();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>

        <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
            <h1 class="h2 mt-3">User List</h1>
            <a href="create.php" class="btn btn-primary mb-3">Create New User</a>

            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user[0] ?></td>
                            <td><?= $user[1] ?></td>
                            <td><?= $user[2] ?></td>
                            <td><?= $user[3] ?></td>
                            <td>
                                <a href="update.php?id=<?= $user[0] ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="delete.php?id=<?= $user[0] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
