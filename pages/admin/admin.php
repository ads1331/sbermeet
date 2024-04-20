
<?php


$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Имя пользователя базы данных
$password = ""; // Пароль базы данных
$dbname = "sbermeet"; // Имя базы данных

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL запрос для получения имени и отчества из базы данных
$sql = "SELECT name, patronymic FROM users WHERE id = 1"; // Предполагается, что данные пользователя с id=1

$result = $conn->query($sql);

if ($result->num_rows > 0) { 
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        $first_name = $row["name"];
        $last_name = $row["patronymic"];
    }
} else {
    echo "0 results";
}
$sql_events = "SELECT * FROM events";
$result_events = $conn->query($sql_events);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../styles/style.css">
    <title>SberHack</title>
</head>
<?php
include_once("../../components/header.php");
?>
<body>
    <div id="loginModal" class="loginModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <div class="add-event container">
        <h2>Добавить новое мероприятие</h2>
        <form method="post">
            <label for="title">Название мероприятия:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="description">Описание мероприятия:</label><br>
            <textarea id="description" name="description" required></textarea><br>
            <label for="date">Дата проведения:</label><br>
            <input type="date" id="date" name="date" required><br>
            <label for="location">Место проведения:</label><br>
            <input type="text" id="location" name="location" required><br>
            <label for="points">Баллы:</label><br>
            <input type="number" id="points" name="points" required><br>
            <label for="photo">Ссылка на фото:</label><br>
            <input type="text" id="photo" name="photo" required><br>
            <button type="submit" class="shop-btn">Добавить мероприятие</button>
        </form>
    </div>
                </div>
                
            
        </div>
      </div>
<main class="main__admin">
    <div class="main__admin-wrapper">
        <div class="main__admin-left">
            <div class="profile">
                <span class="photo1"></span>
                <div class="profile__title">
                    <h4>Админ</h4>
                    <p><?php echo $first_name . " " . $last_name; ?></p> 
                </div>
            </div>
            <div class="part">
                <h5>Разделы</h5>
                <div class="area">
                    <ul class="area__nav">
                        <a href="#" class="area__nav-link" data-content="content1">
                            <li>Добавление мероприятий</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content2">
                            <li>Редактирование мероприятий</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content3">
                            <li>Добавление товаров</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content4">
                            <li>Удаление товаров</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content5">
                            <li>Подтверждение присутствия</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content6">
                            <li>Удаление из присутствующих</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content7">
                        <li>Просмотр статистики</li>
                        </a>
                        <a href="#" class="area__nav-link" data-content="content8">
                            <li>Количество участников</li>
                        </a>
                    </ul>
                </div>
            </div>


        </div>
        <div class="main__admin-right" id="content-container">
            <div id="content1">
                <h2>Добавление мероприятий</h2>
                <div class="content1__wrap">
                    <div class="content1__wrap-item" id="openAdminModal">
                        <a href="#" id="adminOpen"><img src="img/plus.png" alt="plus"></a>
                    </div>
                </div>
            </div>

           
            <div class="part__about" id="content2" style="display: none;">
    <h2>Редактирование мероприятий</h2>
    <ul>
        <?php
        if ($result_events->num_rows > 0) {
            // Вывод данных каждого мероприятия
            while($row_event = $result_events->fetch_assoc()) {
                echo "<li>" . "Название: ". $row_event["title"] . " Описание: " . $row_event["description"] . " Дата: " . $row_event["date"]  . " Место: " . $row_event["location"] . " Поинты: " . $row_event["points"] . " Фото: " . $row_event["photo"] . " <a href='edit_event.php?id=" . $row_event["id"] . "'>Редактировать</a></li>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </ul>
</div>
<div class="part__about" id="content3" style="display: none;">
    <h2>Добавление товаров</h2>
    <form action="add_pp.php" method="post">
        <label for="product_name">Название товара:</label>
        <input type="text" id="product_name" name="shop_name">
        
        <label for="product_description">Описание товара:</label>
        <input type="text" id="product_description" name="shop_description">
        
        <label for="shop_type">Описание типа:</label>
        <input type="text" id="shop_type" name="shop_type">

        <label for="shop_photo">фото:</label>
        <input type="file" id="shop_photo" name="shop_photo">

        <label for="shop_price">Цена товара:</label>
        <input type="number" id="shop_price" name="shop_price">
        
        <button type="submit">Добавить товар</button>
    </form>
</div>
                    <div class="content1__wrap-item">
                        <img src="../../imgs/plus.png" alt="plus">
                    </div>
                
<div class="part__about" id="content4">
    <h2>Удаление товаров</h2>
    
    <ul>
        <?php
        // Выполнение запроса к базе данных для получения списка товаров
        $sql_products = "SELECT * FROM shops"; // Изменение запроса на таблицу shops
        $result_products = $conn->query($sql_products);

        // Проверка наличия товаров
        if ($result_products->num_rows > 0) {
            // Вывод данных каждого товара
            while($row_product = $result_products->fetch_assoc()) {
                echo "<li>" . "Название: ". $row_product["name"] . " Описание: " . $row_product["description"] . " Цена: " . $row_product["price"]  . " <form action='delete_product.php' method='post'><input type='hidden' name='product_id' value='" . $row_product["id"] . "'><button type='submit'>Удалить</button></form></li>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </ul>
</div>
            <div class="part__about" id="content5" style="display: none;">
                <h2>Подтверждение присутствия</h2>
            </div>
            <div class="part__about" id="content6" style="display: none;">
                <h2>Удаление из присутствующих</h2>
            </div>
            <div class="part__about" id="content7" style="display: none;">
                <h2>Просмотр статистики</h2>
            </div>
            <div class="part__about" id="content8" style="display: none;">
                <h2>Количество участников</h2>
            </div>
        </div>
    </div>
</main>


<footer>

</footer>
<script src="/scripts/adminModal.js"></script>
<script src="/scripts/app.js"></script>
</body>
</html>
