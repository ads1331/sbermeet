<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\styles\style.css">
    <title>Сбер - Главная</title>
</head>
<body>
<?php
include_once("components/header.php");
?>
    <main class="main">
        <div class="info__block container">
            <h1>Сбер - Корпоратив</h1>
            <p>Для комфортной и насыщенной корпоративной жизни</p>
            <div class="fon">

            </div>
            <p>Лучшее приложение для персонала. Присутствует доступ к мероприятиям, магазину с собственным мерчом оплачиваемый очками заработанными за посещение мероприятий.<br>Быстро, комфортно, удобно!</p>
            <img src="/imgs/eco.jpg" alt="eco-system">
        </div>
        <section class="plusses">
            <h2>Почему нужно выбирать "Сбер - Корпоратив?</h2>
            <div class="plusses_wrap container">
                <div class="plusses_btn">
                    <a href="#" class="plusses_item">
                        <img src="/imgs/event_black.png" alt="pic1" width="100">
                        <div class="plusses_title">
                            <h3>Мероприятия</h3>
                            <p>Записывайся и участвуй в мероприятиях, зарабатывая очки</p>
                        </div>
                    </a>
                    <a href="#" class="plusses_item">
                        <img src="/imgs/clothe.png" alt="pic2" width="100">
                        <div class="plusses_title">
                            <h3>Магазин</h3>
                            <p>Магазин с мерчом "Сбер" который не стоит ни рубля! Стоит лишь обменять его на свои очки.</p>
                        </div>
                    </a>
                    <a href="#" class="plusses_item">
                        <img src="/imgs/tg.png" alt="pic3" width="100">
                        <div class="plusses_title">
                            <h3>Телеграмм бот</h3>
                            <p>Не удобно заходить в браузер? Авторизуйся в свой кабинет через телеграмм бота. Быстрый и удобный доступ до полного функционала приложения.</p>
                        </div>
                    </a>
                </div>
                <div class="plusses_img">
                    <img src="/imgs/jober.png" alt="fon1">
                </div>
            </div>
        </section>
        <section class="line">
            <div class="line_wrapp container">
                <div class="line_wrapp-parts">
                    <div class="line_wrapp-item">
                        <i>
                            <span>1</span>
                        </i>
                        <span>Авторизация</span>
                    </div>
                    <div class="line_wrapp-item">
                        <i>
                            <span>2</span>
                        </i>
                        <span>Заработок очков в мероприятиях</span>
                    </div>
                    <div class="line_wrapp-item">
                        <i>
                            <span>3</span>
                        </i>
                        <span>Магазин</span>
                    </div>
                    <div class="line_wrapp-item">
                        <i>
                            <span>4</span>
                        </i>
                        <span>Покупка мерча за очки</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="tg__bot">
            <a href="https://t.me/Da_Bratan_52Bot">Приложение в телеграмм</a>
            <div class="tg__wrap">
                <div class="tg__left-info">
                    <div class="info__title">
                        <h3>Вход в приложение по клику</h3>
                        <img src="/imgs/click.png" alt="click">
                    </div>
                    <div class="info__title">
                        <h3>Быстрый серфинг по приложению</h3>
                        <img src="/imgs/sirf.png" alt="click">
                    </div>
                    <div class="info__title">
                        <h3>Быстрый доступ</h3>
                        <img src="/imgs/lock.png" alt="click">
                    </div>
                </div>
                <div class="tg__qr">
                    <img src="/imgs/telegram-bot.png" alt="qr-code">
                </div>
                <div class="tg__right-info">
                    <div class="info__title">
                        <img src="/imgs/synhr.png" alt="click">
                        <h3>Синхронизация с мессенджером</h3>
                    </div>
                    <div class="info__title">
                        <img src="/imgs/sms.png" alt="click">
                        <h3>Мгновенное уведомление</h3>
                    </div>
                    <div class="info__title">
                        <img src="/imgs/event.png" alt="click">
                        <h3>Все мероприятия под рукой</h3>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
<?php include_once("components/footer.php"); ?>