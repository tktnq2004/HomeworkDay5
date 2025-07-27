<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once(__DIR__ . '/../../dbConnect.php');
    $conn = connectDB();
    $username = $_POST['username'];
    $password = $_POST['password'];

    $confirm = $_POST['confirmpassword'];
    $email = $_POST['email'];

    if ($password != $confirm) {
        $error = 'Passwords do not match';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = 'Username already exists';
            } else {
             $sql = "INSERT INTO users (username,password,email,role) VALUES (?,?,?,?)";
             $stmt = $conn->prepare($sql);
             $role = "user";
             $stmt->bind_param("ssss",$username,$hashed_password,$email,$role);   
             if ($stmt->execute()) {
                header("Location:login.php");
                exit();
            }else {
                $error = "An error occurred. Please try again";
            }
        }
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
    <title>Register</title>

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
                    <h1 class="h2 mb-3 fw-normal text-center"> Register</h1>
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
                <div class="form-group">
                    <label for="confirmpassword" class="form-label">Confirm Password</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" id="email" name="email" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-primary mt-2">Register</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a
                    href="/demoshop/frontend/pages/login.php">Login</a></p>
            </div>
        </div>
        </div>
    </main>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>

</html>