<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /demoshop/frontend/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once(__DIR__ . '/../../dbConnect.php');
    $conn = connectDB();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = 
?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_array(MYSQLI_NUM);
        if (password_verify($password, $user[2])) {
            header('Location: /demoshop/frontend/index.php');
            exit();
        } else {
            $error = "Invalid Username or Password!";
        }
    } else {
        $error = "Invalid Username or Password!";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial
scale=1.0">
    <title>Login</title>

    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <main style="margin-top: 120px">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <h1 class="h2 mb-3 fw-normal text-center"> Please sign in</h1>
                    <?php
                    if (isset($error)) :
                    ?>
                        <div class="error-message"></div>
                        <?= $error ?>
                </div>
            <?php endif ?>
            <form method="POST">

                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="Password" name="password" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary mt-2">Login</button>
            </form>
            <p class="text-center mt-3">Not a memeber? <a
                    href="/demoshop/frontend/pages/register.php">Register</a></p>
            </div>
        </div>
        </div>
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>