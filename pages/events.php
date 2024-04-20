<?php
session_start();
include_once("../components/header.php");
include_once("../src/functions.php");

// Проверяем, если пользователь аутентифицирован, и получаем его идентификатор
$user_id = null;
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
}

// Обработка добавления нового мероприятия
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id !== null) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $location = $_POST["location"];
    $points = $_POST["points"];
    $photo = $_POST["photo"];

    query("INSERT INTO events (title, description, date, location, points, photo, visitor_id) 
           VALUES ('$title', '$description', '$date', '$location', '$points', '$photo', '$user_id')");
}

// Запросить все мероприятия из базы данных
$events = query("SELECT * FROM events");

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сбер - Мероприятия</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="main">
    <div class="shop__header container">
        <a href="#" id="dateSort">Сортировка по дате ↑</a>
        <div class="shop__filter">
            <p>Вид мероприятия:</p>
            <select class="dropdown" id="eventType">
                <option value="all">Все мероприятия</option>
                <option value="offline">Оффлайн</option>
                <option value="online">Онлайн</option>
            </select>
        </div>
    </div>
    <div class="shop__wrap">
        <h2>Список доступных мероприятий</h2>
        <div class="shop__cards container" id="productContainer">
            <?php foreach ($events as $event): ?>
                <div class="product" data-date="<?= $event['date'] ?>">
                    <img src="<?= $event['photo'] ?>" alt="<?= $event['title'] ?>">
                    <div class="product-info">
                        <h4><?= $event['title'] ?></h4>
                        <p><?= $event['description'] ?></p>
                        <p>Дата: <?= $event['date'] ?></p>
                        <p>Место проведения: <?= $event['location'] ?></p>
                        <p>Баллы: <?= $event['points'] ?></p>
                        <button class="shop-btn" data-event-id="<?= $event['id'] ?>">Записаться</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</main>

<script src="/scripts/app.js"></script>

<script>
    // Сортировка мероприятий по дате
    document.getElementById('dateSort').addEventListener('click', function() {
        var container = document.getElementById('productContainer');
        var events = Array.from(container.getElementsByClassName('product'));
        events.sort(function(a, b) {
            return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
        });
        container.innerHTML = '';
        events.forEach(function(event) {
            container.appendChild(event);
        });
    });

    // Обработка нажатия на кнопку "Записаться"
    document.querySelectorAll('.shop-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var eventId = button.getAttribute('data-event-id');
            // Отправить запрос на сервер для записи пользователя на мероприятие
            fetch('/register_event.php', {
                method: 'POST',
                body: JSON.stringify({eventId: eventId}),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(function(response) {
                if (response.ok) {
                    // Успешно записано
                    alert('Вы успешно записались на мероприятие!');
                } else {
                    // Произошла ошибка
                    alert('Произошла ошибка при записи на мероприятие');
                }
            }).catch(function(error) {
                console.error('Произошла ошибка при выполнении запроса:', error);
                alert('Произошла ошибка при выполнении запроса');
            });
        });
    });
</script>
</body>
</html>
