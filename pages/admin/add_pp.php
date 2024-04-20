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
$shop_name = $_POST['shop_name'];
$shop_description = $_POST['shop_description'];
$shop_type = $_POST['shop_type'];
$shop_photo = $_POST['shop_photo'];
$shop_price = $_POST['shop_price'];


// SQL запрос для добавления мероприятия
$sql = "INSERT INTO shops (name, description, type, photo, price) VALUES ('$shop_name', '$shop_description', '$shop_type', '$shop_photo', '$shop_price')";

if ($conn->query($sql) === TRUE) {
    // Редирект на страницу администратора
    header('Location: /admin.php');
    exit; // Убедимся, что дальнейшее выполнение прекращается
} else {
    echo "Ошибка при добавлении мероприятия: " . $conn->error;
}

$conn->close();
?>
