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

// Получение ID мероприятия из URL
$event_id = $_GET['id'];

// SQL запрос для получения информации о выбранном мероприятии
$sql_select_event = "SELECT * FROM events WHERE id = $event_id";
$result_select_event = $conn->query($sql_select_event);

// Обработка запроса на редактирование мероприятия
if ($result_select_event->num_rows > 0) {
    // Вывод данных выбранного мероприятия для редактирования
    while($row_selected_event = $result_select_event->fetch_assoc()) {
        $event_title = $row_selected_event["title"];
        $event_description = $row_selected_event["description"];
        $event_date = $row_selected_event["date"];
        $event_location = $row_selected_event["location"];
        $event_points = $row_selected_event["points"];
        $event_photo = $row_selected_event["photo"];
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h2>Edit Event</h2>
    <form action="update_event.php" method="post">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo $event_title; ?>"><br>
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" value="<?php echo $event_description; ?>"><br>
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $event_date; ?>"><br>
        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" value="<?php echo $event_location; ?>"><br>
        <label for="points">Points:</label><br>
        <input type="number" id="points" name="points" value="<?php echo $event_points; ?>"><br>
        <label for="photo">Photo:</label><br>
        <input type="text" id="photo" name="photo" value="<?php echo $event_photo; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
