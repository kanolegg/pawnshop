-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 26 2024 г., 16:40
-- Версия сервера: 10.1.48-MariaDB
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pawnshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `address` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `text` varchar(128) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `branches`
--

INSERT INTO `branches` (`id`, `address`, `image`, `text`) VALUES
(1, 'пр-т Московский, ТРК Тулпар', '/uploads/branch.webp', '2 этаж, пав. 46'),
(2, 'пр-т Сююмбике, 2/19 ТЦ Омега', '/uploads/branch-2.jpg', '1 этаж, пав. 5');

-- --------------------------------------------------------

--
-- Структура таблицы `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_estonian_ci NOT NULL,
  `phone` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consultation`
--

INSERT INTO `consultation` (`id`, `name`, `phone`, `time`) VALUES
(4, 'asd', 'asd', 1716324606);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `rating` int(11) NOT NULL,
  `text` text CHARACTER SET utf8mb4 NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `phone` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `address` varchar(256) CHARACTER SET utf8mb4 NOT NULL,
  `products` text CHARACTER SET utf8mb4 NOT NULL,
  `sum` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `products`, `sum`, `status`, `date`) VALUES
(2, 'Имя', 'email', '+7(999) 999-9999', 'asd', '{\"29\":\"1\"}', 10440, 1, 1713457619),
(3, 'Имя', 'email', '+7(999) 999-9999', 'фыв', '{\"1\":\"1\"}', 2000, 1, 1716543428);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `image` text CHARACTER SET utf8mb4 NOT NULL,
  `vendor_code` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `price` double NOT NULL,
  `content` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `metal` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `weight` varchar(16) CHARACTER SET utf8mb4 NOT NULL,
  `category` varchar(32) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `vendor_code`, `price`, `content`, `metal`, `weight`, `category`) VALUES
(1, 'кольцо', 'описание', '/uploads/uMlx3S5O8F.webp', 'fawefa', 2000, '585', 'Золото', '34', 'rings'),
(2, 'asd', 'dfsfsgrtghr', '/uploads/qNu4Qt2k73.webp', 'asd', 234, 'asd234', 'Золото', '345', 'earrings'),
(3, '', '', '', '', 0, '', '', '', ''),
(4, 'asd', 'asd', '', 'asd', 0, 'asd', '', '', ''),
(6, 'Кольцо', '', '/uploads/Ic5zCEr6nP.webp', 'fewtile', 8000, '585', 'Золото', '123', 'rings');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(128) CHARACTER SET utf8 NOT NULL,
  `time` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `token`, `time`, `ip`, `active`) VALUES
(1, 1, 'Z7X4aZ4s:3307eb97ad7323b55359c3b9633c1f10', 1716545420, 2130706433, 1),
(2, 1, 'Xo1gYHvS:61fc417dde11759b42bb2ff80691461e', 1716669471, 2130706433, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` varchar(64) CHARACTER SET utf8mb4 DEFAULT NULL,
  `last_name` varchar(64) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `birthdate` varchar(16) CHARACTER SET utf8mb4 DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `password`, `first_name`, `last_name`, `email`, `birthdate`, `admin`) VALUES
(1, '$SHA$b7c1238f8fafb085$aaaeda2c4be7eb689acc678a5235e8bb84fd86b3f6849b283b51ea590ba4bd36', 'Админ', 'Проверка', 'admin@lux.ru', '2024-04-02', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
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
-- AUTO_INCREMENT для таблицы `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
