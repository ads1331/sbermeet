<?php
include_once('../src/functions.php');

$name = validate($_POST['name']);
$surname = validate($_POST['surname']);
$patronymic = validate($_POST['patronymic']);
$login = validate($_POST['login']);
$email = validate($_POST['email']);
$phone = validate($_POST['phone']);
$address = validate($_POST['address']);
$workplace = validate($_POST['workplace']);
$role = validate($_POST['position']);
$password = validate($_POST['password']);

if (query("SELECT * FROM `users` WHERE `login` = ?", [$login])) {
    $_SESSION['er'] = "Этот логин занят";
    header("Location: /");
    exit();
}
if (query("SELECT * FROM `users` WHERE `email` = ?", [$email])) {
    $_SESSION['er'] = "Этот email занят";
    header("Location: /");
    exit();
}

if (query("SELECT * FROM `users` WHERE `phone` = ?", [$email])) {
    $_SESSION['er'] = "Этот телефон занят";
    header("Location: /");
    exit();
}

if (make("INSERT INTO `users`(`name`, `surname`, `patronymic`, `login`, `email`, `phone`, `address`, `workplace`, `position`, `password`, `role` ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)", [$name, $surname, $patronymic, $login, $email, $phone, $address, $workplace, $position, $password])) {
    $_SESSION['user'] = query("SELECT * FROM `users` WHERE `login` = ? && `password` = ?", [$login, $password])[0];
}


header("Location: /");
