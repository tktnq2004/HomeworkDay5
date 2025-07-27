<?php
    session_start();
    include_once(__DIR__ ."/../../dbConnect.php");

    $id = $_POST["id"];
    $quantity = $_POST["quantity"];

    if ( isset($_SESSION["cart"]) ) {
        $cart = $_SESSION["cart"];
        $tmp = $cart["$id"];
        $cart["id"] = [
            'id' => $tmp['id'],
            'name' => $tmp['name'],
            'price'=> $tmp['price'],
            'quantity'=> $quantity,
            'image' => $tmp['image'],
            'subTotal' => $tmp['price'] * $quantity,
        ];
        $_SESSION['cart'] = $cart;
    }
    echo json_encode($_SESSION["cart"]);

?>