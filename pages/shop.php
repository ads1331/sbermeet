<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сбер - Магазин</title>
    <link rel="stylesheet" href="\styles\style.css">
</head>
<body>
<?php
include_once("../components/header.php");
?>
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сбер - Магазин</title>
    <link rel="stylesheet" href="\styles\style.css">
</head>
<body>
    <?php
    include_once("../components/header.php");
    include_once("../src/functions.php");

    // Запросить все товары из базы данных
    $products = query("SELECT * FROM shops");

    ?>
<main class="main">
    <div class="shop__header container">
        <a href="#" id="priceSort">Сортировка по цене ↑</a>
        <div class="shop__filter">
            <p>Тип товара:</p>
            <select class="dropdown" id="productType">
                <option value="all">Все товары</option>
                <option value="t-shirt">Футболка</option>
                <option value="cup2">Термокружка</option>
                <option value="panama">Панама</option>
                <option value="note">Блокнот</option>
                <option value="pen">Ручка</option>
                <option value="power">Powerbank</option>
            </select>
        </div>
    </div>
    <div class="shop__wrap">
        <h2>Ассортимент нашего магазина</h2>
        <div class="shop__cards container" id="productContainer">
            <?php foreach ($products as $product): ?>
                <div class="product" data-price="<?= $product['price'] ?>">
                    <img src="<?= $product['photo'] ?>" alt="<?= $product['name'] ?>">
                    <div class="product-info">
                        <h4><?= $product['name'] ?></h4>
                        <p><?= $product['description'] ?></p>
                        <p>Получишь: <?= $product['price'] ?> баллов</p>
                        <button action="/handlers/add_to_cart.php" method="post" class="shop-btn" data-product-id="<?= $product['id'] ?>">Добавить</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<script src="/scripts/app.js"></script>
<script>
    document.querySelectorAll('.shop-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/handlers/add_to_cart.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Товар добавлен в корзину!');
                } else {
                    alert('Ошибка при добавлении товара в корзину');
                }
            };
            xhr.send('product_id=' + encodeURIComponent(productId));
        });
    });
</script>
</body>
</html>