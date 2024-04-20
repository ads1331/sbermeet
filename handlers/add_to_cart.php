<?php
session_start();
include_once("../src/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['user_id']; // Assuming you have a user ID in the session

    // Perform the insertion into the orders table
    $result = query("INSERT INTO orders (user_id, item, place, size, date, status) VALUES ('$userId', '$productId', '', '', NOW(), 'pending')");}

    header("Location: /");

