<?php
if (isset($_GET['id'])) {
    include_once(__DIR__ . '/../../../dbconnect.php');

    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: index.php");
exit();
