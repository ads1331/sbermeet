<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sbermeet";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$event_id = $_POST['event_id'];
$event_title = $_POST['title'];
$event_description = $_POST['description'];
$event_date = $_POST['date'];
$event_location = $_POST['location'];
$event_points = $_POST['points'];
$event_photo = $_POST['photo'];

// SQL запрос для обновления данных мероприятия
$sql_update_event = "UPDATE events SET title='$event_title', description='$event_description', date='$event_date', location='$event_location', points='$event_points', photo='$event_photo' WHERE id=$event_id";

if ($conn->query($sql_update_event) === TRUE) {
    echo "Event updated successfully";
    header('Location: /pages/admin/admin.php');
} else {
    echo "Error updating event: " . $conn->error;
}

$conn->close();
?>