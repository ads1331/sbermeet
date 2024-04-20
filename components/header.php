<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\styles\style.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <div class="wrapper container">
            <nav class="nav">   
                <a href="/pages/events.php">Мероприятия</a>
                <a href="/pages/shop.php">Магазин</a>
                <a href="/main.php"><img src="/imgs/logo.png" alt="СБЕР-лого" width="150"></a>
                    <?php
                        if (!isset($_SESSION['user'])) { ?>
                            <a id="openModal">Вход</a>
                    <a id="OpenRegModal">Регистрация</a>
            </nav>
        </div>
        <div id="loginModal" class="loginModal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <form action="/handlers/reg.php" class="regForm">
                    <h3>Вход в аккаунт</h3>
                    <div class="regDiv-1 column">
                        <div class="regDiv__1-title">
                            <label for="login">Логин:</label>
                            <input type="text" id="login" name="login">
                        </div>
                        <div class="regDiv__1-title" style="margin-top: 10px;">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password">
                        </div>
                    </div>
                    <button type="submit" class="login-btn" onclick="reg(event)">Войти</button>
                </form>
            </div>
          </div>
        <div id="regModal" class="regModal">
            <div class="modal-content">
                <span class="close" id="closeModalReg">&times;</span>
                <form action="/handlers/reg.php" method="POST" class="regForm">
                    <h3>Регистрация</h3>
                    <div class="regDiv-1 column">
                        <div class="regDiv__1-title">
                            <label for="login">Логин:</label>
                            <input type="text" id="login" name="login">
                        </div>
                        <div class="regDiv__1-title">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password">
                        </div>
                    </div>

                    <div class="regDiv-1">
                        <div class="regDiv__1-title">
                            <label for="first_name">Имя:</label>
                            <input type="text" id="first_name" name="name">
                        </div>
                        <div class="regDiv__1-title">
                            <label for="last_name">Фамилия:</label>
                            <input type="text" id="last_name" name="surname">
                        </div>
                        <div class="regDiv__1-title">
                            <label for="middle_name">Отчество:</label>
                            <input type="text" id="middle_name" name="patronymic">
                        </div>
                    </div>
                    <label for="number">Номер телефона:</label>
                    <input type="number" id="number" name="phone">

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">

                    <label for="role">Роль:</label>
                    <input type="text" id="role" name="position">

                    <label for="workplace">Место работы:</label>
                    <input type="text" id="workplace" name="workplace">

                    <label for="address">Адрес проживания:</label>
                    <input type="text" id="address" name="address">

                    <button type="submit" onclick="reg(event)">Зарегестрироваться</button>
                    <p id="error">
            </p>
                </form>
            </div>
          </div>
                    <?php } else { ?>
                            <?php if ($_SESSION['user']['role'] == 1) { ?>
            <a href="pages/admin/admin.php">Админ панель</a>
        <?php } ?>
                            <a href="/pages/profile.php">Профиль</a>
                            <a href="/handlers/exit.php">Выйти</a>
                    <?php } ?>
            </nav>
            <script src="/scripts/app.js"></script>
            
    </header>
</body>