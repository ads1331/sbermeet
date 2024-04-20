<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbermeet";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$event_title = $_POST['event_title'];
$event_description = $_POST['event_description'];
$event_date = $_POST['event_date'];
$event_location = $_POST['event_location'];
$event_points = $_POST['event_points'];
$event_photo = $_POST['event_photo'];

// SQL запрос для добавления мероприятия
$sql = "INSERT INTO events (title, description, date, location, points, photo) VALUES ('$event_title', '$event_description', '$event_date', '$event_location', '$event_points', '$event_photo')";

if ($conn->query($sql) === TRUE) {
    // Редирект на страницу администратора
    header('Location: /admin.php');
    exit; // Убедимся, что дальнейшее выполнение прекращается
} else {
    echo "Ошибка при добавлении мероприятия: " . $conn->error;
}

$conn->close();
?>
