<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết địa điểm - DemoShop</title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
    <style>
        .map-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 tỷ lệ khung hình */
            height: 0;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
</head>
<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>

    <div class="container py-5">
        <div class="map-container mt-4">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.126492844511!2d106.71187561012754!3d10.801622758685026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a459cb43ab%3A0x6c3d29d370b52a7e!2zSFVURUNIIC0gxJDhuqFpIGjhu41jIEPDtG5nIG5naOG7hyBUUC5IQ00gKFNhaSBHb24gQ2FtcHVzKQ!5e0!3m2!1svi!2s!4v1753270377001!5m2!1svi!2s"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
</body>
</html>
