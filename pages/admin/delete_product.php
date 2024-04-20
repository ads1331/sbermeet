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

// Получение ID товара из формы
$product_id = $_POST['product_id'];

// SQL запрос для удаления товара
$sql_delete_product = "DELETE FROM shops WHERE id=$product_id";

if ($conn->query($sql_delete_product) === TRUE) {
    echo "Product deleted successfully";
    header('Location: /admin.php');
} else {
    echo "Error deleting product: " . $conn->error;
}

$conn->close();
?>