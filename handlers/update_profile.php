<?php
session_start();
include_once('../src/functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['user']['id'];
    $address = $_POST['address'];
    $workplace = $_POST['workplace'];
    $phone = $_POST['phone'];

    // Обновление данных профиля
    query("UPDATE users SET address = '$address', workplace = '$workplace', phone = '$phone' WHERE id = $id_user");

    // Сохранение загруженной фотографии
    $target_dir = 'media/uploads/avatar/';
    $target_file = $target_dir . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

    $avatar_path = '../' . $target_file;
    query("UPDATE users SET avatar_path = '$avatar_path' WHERE id = $id_user");

    // Перенаправление на страницу профиля после обновления
    header('Location: /pages/profile.php');
    exit;
}

header('Location: /pages/profile.php');
