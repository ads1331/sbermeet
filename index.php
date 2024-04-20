<?php
require_once 'src/functions.php';

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$nameSite = apache_getenv('sbermeet');

if ($urls[0] === '' && sizeof($urls) == 1) {
    require_once 'main.php'; // Главная страница
    exit();
}

if ($urls[0] === 'profile' && sizeof($urls) == 1) {
    require_once 'pages/profile.php';
    exit();
}
if ($urls[0] === 'profile' && sizeof($urls) == 1) {
    require_once 'pages/admin.php';
    exit();
}
if ($urls[0] === 'profile' && sizeof($urls) == 1) {
    require_once 'pages/shop.php';
    exit();
}

if ($urls[0] === 'exit' && sizeof($urls) == 1) {
    require_once '/handlers/exit.php';
    exit();
}

if ($urls[0] === 'add' && sizeof($urls) == 1) {
    require_once '/handlers/add_to_cart.php';
    exit();
}

if ($urls[0] === 'update' && sizeof($urls) == 1) {
    require_once '/handlers/update_profile.php';
    exit();
}

if ($urls[0] === 'reg' && sizeof($urls) == 1) {
    require_once '/handlers/reg.php';
    exit();
}

if ($urls[0] === 'autorisation' && sizeof($urls) == 1) {
    require_once '/handlers/autorisation.php';
    exit();
}

if ($urls[0] === '404' && sizeof($urls) == 1) {
    require_once 'pages/events.php';
    exit();
}
if ($urls[0] === 'profile' && isset($urls[1])) {
    require_once 'pages/profile.php';
    exit();
}


http_response_code(404);
include_once 'pages/404.php'; // 404 страница
