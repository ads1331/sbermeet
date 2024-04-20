-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 20 2024 г., 22:31
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sbermeet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date` date NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `points` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `visitor_id` int NOT NULL,
  `visitor_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `date`, `location`, `points`, `photo`, `visitor_id`, `visitor_address`, `registration_date`) VALUES
(1, 'технострелка 2', 'технострелка хакатон 2', '2024-04-16', '321', 444, 'https://talant32.ru/wp-content/uploads/2024/02/maxresdefault-1200x675.jpg', 1, '1', '2024-04-17 07:17:53'),
(2, 'технострелка', 'Хакатон нижний новгород', '2024-04-18', '123', 123, 'https://bluescreen.kz/content/images/2023/10/main_image_post_3664.png', 1, '123', '2024-04-17 07:17:53'),
(3, 'Олимпиада', 'с++, python, c#', '2024-04-23', '2126', 250, 'https://d3j0t7vrtr92dk.cloudfront.net/namma/1587662792_Screen%20Shot%202020-04-23%20at%201.24.09%20PM.png', 1, 'Пушкина 10', '2024-04-17 07:28:13'),
(4, 'Олимпиада технокубок', 'с++, python, c#', '2024-04-23', '2126', 250, 'https://olymp.bmstu.ru/sites/default/files/pictures/%D0%9C%D0%B0%D0%BA%D0%B5%D1%82%20%D0%B4%D0%BB%D1%8F%20%D1%81%D0%B0%D0%B9%D1%82%D0%B0.png', 1, 'Пушкина 10', '2024-04-17 07:28:25');

-- --------------------------------------------------------

--
-- Структура таблицы `event_attendees`
--

CREATE TABLE `event_attendees` (
  `id` int NOT NULL,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `place` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `item`, `place`, `size`, `date`, `status`) VALUES
(1, 1, 'кепка', 'Русских 11', 'L', '2024-04-24', '1'),
(2, 1, 'футболка', 'Весенняя 6', 'M', '2024-04-25', NULL),
(3, 1, 'кепка', 'Русских 11', 'L', '2024-04-24', '1'),
(4, 1, 'футболка', 'Весенняя 6', 'M', '2024-04-25', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id`, `name`, `description`, `type`, `photo`, `price`) VALUES
(1, 'футболка', 'ткань', 'оверсайз', 'https://sbershop.ru/upload/iblock/468/8u4hbgqy11dkghq1qi4zkfgsedmc4qna/sber1909_114773.jpg', '1200.00'),
(2, 'Зипка', 'хлопок', 'тип', 'https://sbershop.ru/upload/iblock/254/vprwas2msqj3j98yswa6txnnfiqm6zn5/sber1212_167579.jpg', '2000.00'),
(3, 'футболка', 'ткань', 'оверсайз', 'https://tbtbo.agency/wp-content/uploads/2022/10/sber_eapteka_8-07_0122.png', '1200.00'),
(4, 'Зипка', 'хлопок', 'тип', 'https://sbershop.ru/upload/iblock/1ea/4e91v34kqzwputsgubmclfdxq9v5khim/sber1212_167350.jpg', '2000.00'),
(5, 'кепка', 'ткань', 'оверсайз', 'https://sbershop.ru/upload/iblock/25b/3vrd257auxu475h4p0njvqkou40hin64/1b.jpg', '1200.00'),
(6, 'Штаны', 'хлопок', 'тип', 'https://cdn1.ozone.ru/s3/multimedia-j/6821782471.jpg', '2000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `patronymic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `workplace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `points` int NOT NULL DEFAULT '0',
  `currently_points` int NOT NULL DEFAULT '0',
  `counts_event_attendet` int NOT NULL DEFAULT '0',
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `patronymic`, `address`, `workplace`, `points`, `currently_points`, `counts_event_attendet`, `role`, `email`, `position`, `avatar_path`, `phone`) VALUES
(1, 'asd', '123', 'Денис', 'Афанасьев', 'Сергеевич', 'Восточная 2', 'Восточная 12', 0, 0, 0, '1', 'iskra@mail.ru', NULL, NULL, '79120204900'),
(2, '', '', '', '', '', '', '', 0, 0, 0, '0', '', NULL, '../media/uploads/avatar/', '52');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_id` (`visitor_id`);

--
-- Индексы таблицы `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`visitor_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `event_attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_attendees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
