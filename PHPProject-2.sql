-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июл 12 2022 г., 09:50
-- Версия сервера: 5.7.34
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `PHPProject-2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '15', 1652221441),
('manager', '6', 1652221441);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1652221441, 1652221441),
('fullWorkWithOrders', 2, NULL, NULL, NULL, 1652221441, 1652221441),
('fullWorkWithProducts', 2, NULL, NULL, NULL, 1652221441, 1652221441),
('manager', 1, NULL, NULL, NULL, 1652221441, 1652221441),
('orderStatusChangeOnly', 2, NULL, NULL, NULL, 1652221441, 1652221441);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'fullWorkWithOrders'),
('manager', 'fullWorkWithProducts'),
('admin', 'manager'),
('manager', 'orderStatusChangeOnly');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `baskets`
--

CREATE TABLE `baskets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `baskets`
--

INSERT INTO `baskets` (`id`, `user_id`, `product_id`) VALUES
(5, 14, 2),
(6, 3, 4),
(7, 6, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `lecture`
--

INSERT INTO `lecture` (`id`, `topic`, `number`, `name`, `content`) VALUES
(1, 'Введение в PHP', 'Лекция 112', 'Знакомство с PHP', 'В первой части лекции рассмотрим, как создать новую страницу, отображающую\r\nданные, полученные из таблицы базы данных. Для достижения этой цели будет необходимо\r\nнастроить подключение к базе данных, создать класс Active Record, определить action, и\r\nсоздать view. Т.е. фактически работа сведется к:\r\n− Настраиванию подключения к БД;\r\n− Определению класса Active Record;\r\n− Запросу данных, используя класс Active Record;\r\n− Отображению данных во view с использованием пагинации (разбивки по страницам).\r\nПодготовка базы данных\r\nДля начала, создайте базу данных под определенным названием, например, yii2basic, из которой вы будете получать данные в вашем приложении. Вы можете создать базу данных SQLite, MySQL, PostgreSQL, MSSQL или Oracle, так как Yii имеет встроенную поддержку для многих баз данных. В дальнейшем описании будет подразумеваться и использоваться MySQL.\r\nПосле этого создайте в базе данных таблицу lecture со следующей структурой.'),
(2, 'Продолжение PHP', 'Лекция 2', 'Продолжение знакомства с PHP', 'Настройка подключение к БД\r\nПеред продолжением убедитесь, что у вас установлены PHP-расширение PDO и драйвер PDO для используемой вами базы данных (pdo_mysql для MySQL). Это базовое требование в случае использования вашим приложением реляционной базы данных. После того, как они установлены, откройте файл common/config/main-local.php (или\r\n \r\n   \r\nconfig/db.php) и измените параметры на верные для вашей базы данных. По умолчанию этот файл содержит следующее:'),
(3, 'Настройка Yii', 'Лекция 3', 'Настройка Yii. Первая проба пера', 'фыворадм фдгнапдшгпвА ДШГВП ФЫДШГВП  дшфапг фдшвапя ыкп..впмыва ы пав!!!');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `product_id`, `user_id`) VALUES
(3, 3, 14),
(16, 6, 14),
(17, 5, 14),
(18, 5, 3),
(20, 2, 3),
(21, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1650612713),
('m130524_201442_init', 1650612716),
('m140506_102106_rbac_init', 1652201291),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1652201291),
('m180523_151638_rbac_updates_indexes_without_prefix', 1652201291),
('m190124_110200_add_verification_token_column_to_user_table', 1650612716),
('m200409_110543_rbac_update_mssql_trigger', 1652201291),
('m220422_072906_create_lecture_table', 1650615771),
('m220422_082504_create_lecture_table', 1650615949),
('m220426_064937_create_user_table', 1652221441),
('m220510_171531_create_rbac_data', 1652221441),
('m220510_233450_create_products_table', 1652225723),
('m220520_174625_create_baskets_table', 1653068911),
('m220521_084632_create_orders_table', 1653122806),
('m220601_184155_create_likes_table', 1654109034);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kol` float DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `number`, `product_id`, `user_id`, `kol`, `cost`, `address`, `phone`, `status`) VALUES
(20, 1, 2, 3, 2, 8.68, 'Минск, Белорусская 21', '+375 44 333-22-11', 'передан курьеру'),
(21, 1, 3, 3, 2, 15.98, 'Минск, Белорусская 21', '+375 44 333-22-11', 'передан курьеру'),
(22, 2, 2, 3, 2, 8.68, 'Минск, Белорусская 19', '+375 44 333-22-11', 'доставлен');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `sort` varchar(255) NOT NULL,
  `price` decimal(19,2) NOT NULL,
  `max_kol` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category`, `sort`, `price`, `max_kol`, `image`) VALUES
(2, 'Картофель', 'Волат', '4.34', 520, '99d1d25dc07b0f09936ce4b2356af028.png'),
(3, 'Огурец', 'Длиный', '7.99', 193, 'e071a93c08518de70613174dbf5edf94.png'),
(4, 'Лук', 'Обычный', '3.56', 228, '60b68f78169730ad9d02c37fb2193fcf.png'),
(5, 'Морковь', 'Полезная', '4.48', 423, '8e31f7858bac373aa2d6ab1a9e4a75c1.png'),
(6, 'Чеснок', 'Зимний', '10.74', 239, 'd306e760b639ece970d8340d0df22b93.png');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `code`) VALUES
(3, 'Kiroy', 'cajugXVpWGbOiyp-iOQ8PtXKAqa-RJCe', '$2y$13$Pu6mlQiMnDUib/tGcI3zzOY3QQJPsv9DA8VLgnhUVAj/1juqFfRDG', NULL, 'sah-n@mail.ru', 10, 1650959526, 1654070551, 'KaHuevw3v0Lvp4RhxiLwWpm8gHnkisHR_1650959526', 0),
(6, 'Manager', '9ldgk65BrZ4Ud1qhG-QKdkL0I34_N1MP', '$2y$13$Y5E3E8p4frHOQBHu/e43vObqDY8m8xcDMcf2/tS4KxH9QjOqHI4ui', NULL, 'qwe@qwe.qwe', 10, 1650982173, 1650982173, 'jby_0CUQZjpG_Txy1VswBd0BB954zTrM_1650982173', 0),
(14, 'kirill', 'mBVRst2RSMrDPAuSOMhCr9GHYR_kBmJX', '$2y$13$Y5E3E8p4frHOQBHu/e43vObqDY8m8xcDMcf2/tS4KxH9QjOqHI4ui', NULL, 'kirill-yur@mail.ru', 10, 1651912809, 1651912809, '23fCyAdQnpGEOXDbqAyKfeyc_ZqDw8cP_1651912809', NULL),
(15, 'Admin', 'Ai8kqxnOdy4TraDIkTWQWAMkVRc13O9n', '$2y$13$Y5E3E8p4frHOQBHu/e43vObqDY8m8xcDMcf2/tS4KxH9QjOqHI4ui', NULL, 'admin@admin.com', 10, 1652221441, 1652221441, NULL, NULL),
(16, 'kulakova_tt', 'PhsCCP6oVBt47sLSHJFiLtKNAenkmXPT', '$2y$13$AwH1ZdlwpIQmPu6diu1pU.zmAF9MKlrYURSfX7458JboPpWucG/qK', NULL, 'kulakova.tatyana12@gmail.com', 10, 1654070503, 1654070503, 'DcVViVewUeal3649W9Zfpv3PbEJhQuIf_1654070503', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `baskets`
--
ALTER TABLE `baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baskets_ibfk_1` (`product_id`),
  ADD KEY `baskets_ibfk_2` (`user_id`);

--
-- Индексы таблицы `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topic` (`topic`),
  ADD UNIQUE KEY `number` (`number`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `baskets`
--
ALTER TABLE `baskets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `baskets`
--
ALTER TABLE `baskets`
  ADD CONSTRAINT `baskets_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baskets_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
