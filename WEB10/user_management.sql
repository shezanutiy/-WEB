-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 08 2024 г., 11:54
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `user_management`
--

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `price`, `image`, `created_at`) VALUES
(2, 'Консультация с психологом', 'Заполните анкету — мы подберем специалистов, которые умеют работать с вашим запросом', 2399.00, 'uploads/opera_JjDfa9GNOH.png', '2024-12-08 10:29:50'),
(3, 'Психологический тест', '«В основе этих тестов — книги и научные публикации всемирно известных психологов. Результат теста не является диагнозом; его цель — помочь вам задать себе правильные вопросы, подтолкнуть к исследованию себя — самостоятельному или с помощью профессионального психолога»', 0.00, 'uploads/images.jpg', '2024-12-08 10:32:14');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$8RLMmKkwDU456qEqQVvBJO1dTwB1Ytkt2fHKKr/0YydK4pmYnLHY.', 'admin', '2024-12-08 09:20:20'),
(2, 'artemchik68', '$2y$10$tN/V34c/4kwZ29UNbkRvdOzrJ55btb/gsz1m/HTVwWugV8Ub42EpW', 'admin', '2024-12-08 09:21:44'),
(3, 'iluha228', '$2y$10$.CIkC4Y75ddxdiigIkbxluu/2rVQUD4w5Bqe4YXbI9oo68LPutxtu', 'user', '2024-12-08 09:34:22'),
(4, '123', '$2y$10$ce2tdjdm7kXKzPQ88CwdqOgHFocTFYkGv4f2ivkR0U.cF4GgeJHQ.', 'user', '2024-12-08 10:24:23');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
