<?php
include_once('../src/functions.php');

$login = validate($_POST['login']);
$password = md5(validate($_POST['password']));

$user = query("SELECT * FROM `users` WHERE `login` = ? && `password` = ?", [$login, $password])[0];

if($user){
    $_SESSION['user'] = $user;
}
else{
    $_SESSION['er'] = "Неверные данные";
    header("Location: /login");
    exit();
}

header("Location: /");
