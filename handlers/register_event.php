<?php
session_start();
include_once("../src/functions.php");

// Проверяем, если пользователь аутентифицирован, и получаем его идентификатор
$user_id = null;
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

// Проверяем, что получен POST запрос и user_id не пустой
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id !== null) {
    // Получаем eventId из тела запроса
    $data = json_decode(file_get_contents('php://input'), true);
    $eventId = $data['eventId'];

    // Вставляем запись в базу данных
    $result = query("INSERT INTO event_registrations (event_id, user_id) VALUES ('$eventId', '$user_id')");

    // Проверяем результат вставки
    if ($result) {
        // Отправляем успешный статус
        http_response_code(200);
    } else {
        // Отправляем ошибку
        http_response_code(500);
    }
} else {
    // Если запрос не POST или user_id пустой, отправляем ошибку
    http_response_code(400);
}
?>
