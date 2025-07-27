<?php
include_once(__DIR__ . '/../../../dbconnect.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = intval($_GET['id']);

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Nếu người dùng nhập password mới thì cập nhật
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=?, role=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $password, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $role, $id);
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}

// Lấy thông tin người dùng hiện tại
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>

        <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
            <h1 class="h2 mt-3">Edit User</h1>

            <form method="POST">
                <div class="form-group">
                    <label>Name:</label>
                    <input name="name" type="text" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required />
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required />
                </div>

                <div class="form-group">
                    <label>New Password (leave blank to keep current):</label>
                    <input name="password" type="password" class="form-control" />
                </div>

                <div class="form-group">
                    <label>Role:</label>
                    <select name="role" class="form-control">
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
                        <option value="customer" <?= $user['role'] === 'customer' ? 'selected' : '' ?>>Customer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-2">Update</button>
                <a href="index.php" class="bt
