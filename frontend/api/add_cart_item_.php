<?php 
    session_start();

    include(__DIR__ . "../../dbConnect.php");

    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $quantity = $_POST["quantity"];
    $total = $price * $quantity;

    if (isset($_SESSION["cart"])) {
        $cart = $_SESSION["cart"];
        $cart[$id] = [
            'id' => $id,
            'name' => $name,
            'price'=> $price,
            'image'=> $image,
            'quantity' => $quantity,
            'subTotal'=> $total
        ];
    }else {
        $cart[$id] = [
            'id' => $id,
            'name' => $name,
            'price'=> $price,
            'image'=> $image,
            'quantity' => $quantity,
            'subTotal'=> $total
        ];
    }
?>