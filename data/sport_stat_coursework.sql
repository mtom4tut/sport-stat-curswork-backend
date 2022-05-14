-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 14 2022 г., 18:51
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sport_stat_coursework`
--
CREATE DATABASE IF NOT EXISTS `sport_stat_coursework` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sport_stat_coursework`;

-- --------------------------------------------------------

--
-- Структура таблицы `spreadsheets`
--

CREATE TABLE `spreadsheets` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `spreadsheet` char(44) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `spreadsheets`
--

INSERT INTO `spreadsheets` (`id`, `id_user`, `spreadsheet`) VALUES
(8, 1, '10Lcptqohpmh7Ce7hbgiGf-jtw0ZhmM3gE_4dd4PhSVs'),
(10, 1, '1S3xtu0YE-gG_JirTMpCMqI2VOEr1uTKeV3cwPbWXIN8'),
(11, 2, '1S3xtu0YE-gG_JirTMpCMqI2VOEr1uTKeV3cwPbWXIN8'),
(12, 2, '1MjSXfjY3khqKwjl0IeCAGvi5m17LJuPey7ctAThb1UI');

-- --------------------------------------------------------

--
-- Структура таблицы `totaldata`
--

CREATE TABLE `totaldata` (
  `id` char(44) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_sportsmen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight_sportsmen` int NOT NULL,
  `age_sportsmen` int NOT NULL,
  `date_passing` date NOT NULL,
  `aerobic_p_legs` float NOT NULL,
  `aerobic_p_args` float NOT NULL,
  `heart_rate_aerobic_legs` float NOT NULL,
  `heart_rate_aerobic_args` float NOT NULL,
  `anaerobic_p_legs` float NOT NULL,
  `anaerobic_p_args` float NOT NULL,
  `heart_rate_anaerobic_legs` float NOT NULL,
  `heart_rate_anaerobic_args` float NOT NULL,
  `mpk_legs` float NOT NULL,
  `mpk_args` float NOT NULL,
  `yoc_max_legs` float NOT NULL,
  `yoc_max_args` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `totaldata`
--

INSERT INTO `totaldata` (`id`, `name_sportsmen`, `weight_sportsmen`, `age_sportsmen`, `date_passing`, `aerobic_p_legs`, `aerobic_p_args`, `heart_rate_aerobic_legs`, `heart_rate_aerobic_args`, `anaerobic_p_legs`, `anaerobic_p_args`, `heart_rate_anaerobic_legs`, `heart_rate_anaerobic_args`, `mpk_legs`, `mpk_args`, `yoc_max_legs`, `yoc_max_args`) VALUES
('1S3xtu0YE-gG_JirTMpCMqI2VOEr1uTKeV3cwPbWXIN8', 'Акимова Софья', 58, 18, '2021-04-22', 99.6, 83.93, 149.12, 170.36, 149.17, 108.17, 173.6, 184.25, 206.25, 200, 104.29, 62.83);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `mail` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `mail`, `password`) VALUES
(1, 'tutukovz@mail.ru', '$2y$10$8J468nb3GyyG76/DAJFhT.mkae7XOOXXF1V9qdDQWpq68Nmt/x6pi'),
(2, 'maks.tutukov@mail.ru', '$2y$10$On5rT8AqH16YLQzRBLA0KOtiikkuDNWFAoeU8DENtIVAMqhKPA8ou');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `spreadsheets`
--
ALTER TABLE `spreadsheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `totaldata`
--
ALTER TABLE `totaldata`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `spreadsheets`
--
ALTER TABLE `spreadsheets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `spreadsheets`
--
ALTER TABLE `spreadsheets`
  ADD CONSTRAINT `spreadsheets_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
