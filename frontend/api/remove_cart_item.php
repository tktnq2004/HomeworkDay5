<?php
     session_start();

     $id = $_POST["id"];
     if(isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];

        if(isset($cart[$id])){
            unset($cart[$id]);
     }
    }
    echo json_encode($_SESSION["cart"]);
?>