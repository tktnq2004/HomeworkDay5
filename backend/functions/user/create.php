<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once(__DIR__ . '/../../../dbconnect.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>
<body>
<?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>

        <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
            <h1 class="h2 mt-3">Create User</h1>

            <form method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name" type="text" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input name="email" type="email" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input name="password" type="password" class="form-control" required />
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success mt-2">Create</button>
                <a href="index.php" class="btn btn-secondary mt-2">Back</a>
            </form>
        </main>
    </div>
</div>

<?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
<?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
