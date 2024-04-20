<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styles/style.css">
    <title>SberHack</title>
</head>
<body>  
<div id="loginModal" class="loginModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <form action="/handlers/update_profile.php" class="regForm" method = "post">
                <h3>Редактирование профиля</h3>
                <div class="regDiv-1 column">
                    <div class="regDiv__1-title" style="margin-top: 10px;">
                        <label for="address">Рабочий адрес:</label>
                        <input type="address" id="address" name="workplace">
                    </div>
                    <div class="regDiv__1-title" style="margin-top: 10px;">
                        <label for="address">Домашний адресс:</label>
                        <input type="address" id="address" name="address">
                    </div>
                    <div class="regDiv__1-title" style="margin-top: 10px;">
                        <label for="number">Номер телефона</label>
                        <input type="number" id="number" name="phone">
                    </div>
                    <div class="regDiv__1-title" style="margin-top: 10px;">
                        <label for="file">Обновление фото профиля</label>
                        <input type="file" id="file" name="avatar_path">
                    </div>
                </div>
                <button type="submit" class="login-btn">Сохранить</button>
            </form>
        </div>
      </div>
<?php
include_once('../src/functions.php');
$id_user = $_SESSION['user']['id'];
$info = query("SELECT name, surname, patronymic, address, workplace, points, currently_points, counts_event_attendet, email, position, avatar_path, phone FROM users WHERE id = $id_user");
$user = $info[0];
$rate = query("SELECT name, surname, patronymic, address, workplace, points, currently_points, counts_event_attendet, email, position, avatar_path, phone FROM users ORDER BY points DESC LIMIT 5");

// Получаем мероприятия пользователя
$user_events = query("SELECT * FROM events WHERE visitor_id = $id_user");

// Получаем покупки пользователя
$user_orders = query("SELECT * FROM orders WHERE user_id = $id_user");

include_once("../components/header.php");
?>
<main>
    <main class="main">
        <div class="main__wrap container">
            <div class="main__wrap-left">
                <div class="lc">
                    <div class="lc__left">
                        <span class="photo"></span>
                        <div class="lc__left-title1">
                            <h3><?= $user['surname'] . ' ' . $user['name'] . ' ' . $user['patronymic'] ?></h3>
                            <p style="margin-bottom: 20px"><?= $user['position'] ?></p>
                            <button class="profile_modal" id="profileModal">
                                    Редактирование профиля
                            </button>
                        </div>
                        <div class="lc__left-title">
                            <div class="lc__left-title2">
                                <p><span style="font-weight: 600">Рабочий адрес:</span><?= $user['workplace'] ?></p>
                                <p><span style="font-weight: 600">E-mail:</span><?= $user['email'] ?></p>
                                <p><span style="font-weight: 600">Рабочий телефон:</span><a href="tel:<?= $user['phone'] ?>"> <?= $user['phone'] ?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="lc__right">
                        <div class="rate">
                            <h3>Мои баллы:</h3>
                            <p><?= $user['currently_points'] ?></p>
                        </div>
                        <h3>Рейтинг:</h3>
                        <div class="lc__right-box">
                            <?php
                            $user_rank = 0;
                            foreach ($rate as $key => $user) {
                                $user_rank++;
                                $fullName = $user['surname'] . ' ' . $user['name'] . ' ' . $user['patronymic'];
                                $boldStyle = ($user['id'] == $id_user) ? 'font-weight: bold;' : '';
                                echo '
                                <div class="lc__right-item">
                                    <span class="photo1"></span>
                                    <p style="' . $boldStyle . '">' . $fullName . '</p>
                                    <p><b>№ ' . $user_rank . '</b></p>
                                </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                    <div class="about">
                        <div class="about__wrap">
                            <div class="about__box">
                                <h3>Достижения</h3>
                                <div class="about__box-items">
                                    <div class="about__box-item">
                                        <img src="/imgs/pic5.png" alt="pic5" width="30">
                                        <p>Название</p>
                                        <p>Описание</p>
                                    </div>
                                    <div class="about__box-item">
                                        <img src="/imgs/pic5.png" alt="pic5" width="30">
                                        <p>Название</p>
                                        <p>Описание</p>
                                    </div>
                                </div>
                            </div>
                            <div class="about__box">
                                <h3>Другое</h3>
                                <div class="about__box-item">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main__wrap-right">
    <div class="main__wrap-push">
        <div class="main__wrap-item">
            <h3>Мои мероприятия:</h3>
            <div class="push__item-box">
                <?php foreach ($user_events as $event): ?>
                    <div class="push__item">
                    <img src="<?= $event['photo'] ?>" alt="<?= $order['item'] ?>" width="100">
                        <h4 style="margin-bottom: 10px"><?= $event['title'] ?></h4>
                        <p><?= $event['description'] ?></p>
                        <p><b>Дата проведения:</b><?= $event['date'] ?></p>
                        <p><b>кол-во баллов за участие:</b><?= $event['points'] ?></p>
                        <a class="sub" href="#">Отказаться</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="main__wrap-item">
            <div class="push__item">
                <h3 style="margin-bottom: 20px">Мои покупки:</h3>
                <div class="shop__item-box">
                    <?php foreach ($user_orders as $order): ?>
                        <?php
                            // Получаем данные о товаре по его id из заказа
                            $shop_id = $order['item'];
                            $shop_item = query("SELECT * FROM shops WHERE id = $shop_id")[0];
                            var_dump($shop_item);
                        ?>
                        <div class="shop__item">
                            <img src="<?= $shop_item['photo'] ?>" alt="<?= $shop_item['name'] ?>" width="50">
                            <div class="shop__item-about">
                                <p><?= $shop_item['name'] ?></p>
                                <p><b>Стоимость:</b> <br> <?= $shop_item['price'] ?> баллов</p>
                            </div>
                            <div class="btn">
                                <?php if ($order['status'] == 'pending'): ?>
                                    <a class="sub1" href="#">Принять заказ</a>
                                <?php else: ?>
                                    <span class="sub1">Заказ выполнен</span>
                                <?php endif; ?>
                                <a class="sub" href="#">Отменить заказ</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
        </main>
    </main>
    <footer>
        <footer class="footer">
            <div class="footer__wrap container">

            </div>
        </footer>
    </footer>
<script src="/scripts/app.js"></script>
<script src="/scripts/profileModal.js"></script>
</body>
</html>