-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Авг 30 2017 г., 06:41
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activate`
--

CREATE TABLE `activate` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE `block` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_block_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (`id`, `id_user`, `id_block_user`) VALUES
(3, 13, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `name_img` text NOT NULL,
  `src` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `id_user`, `name_img`, `src`) VALUES
(21, 2, 'keep calm.jpg', '/template/foto/keep calm.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_like_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `likes`
--

INSERT INTO `likes` (`id`, `id_user`, `id_like_user`) VALUES
(21, 13, 3),
(22, 3, 13),
(28, 2, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_sec_user` int(10) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `id_user`, `id_sec_user`, `msg`, `time`, `status`) VALUES
(4, 3, 13, 'здаров агал\n\n\n\n\n', '30.8.2017 15:26', 1),
(5, 3, 13, 'фівфі', '30.8.2017 15:26', 1),
(6, 3, 13, 'ячсясч', '30.8.2017 15:26', 1),
(7, 3, 13, '&lt;h1&gt;ебоцкая душа&lt;/h1&gt;', '30.8.2017 15:26', 1),
(8, 13, 3, 'йційці', '30.8.2017 15:27', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `user_rating` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`id`, `id_user`, `user_rating`) VALUES
(1, 1, 105),
(2, 2, 85),
(3, 3, 55),
(4, 4, 30),
(5, 5, 35),
(6, 6, 65),
(7, 8, 50),
(8, 9, 0),
(9, 10, 50),
(10, 11, 0),
(12, 13, 35),
(13, 14, 0),
(14, 15, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `search_tag`
--

CREATE TABLE `search_tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tag`
--

CREATE TABLE `tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `tag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `active` int(1) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `name`, `surname`, `password`, `email`, `avatar`, `active`, `status`) VALUES
(2, 'yanki', 'Viktor', 'Geviksman', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'fanxfar@gmail.com', '/template/foto/keep calm.jpg', 1, 1504098231),
(3, 'awrevbfs', 'Nastya', 'Galushkina', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'aaa@a.a', '/template/images/default-avatar.png', 1, 1504096037),
(4, 'Bodya', 'Bodya', 'Polovnikov', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'Bodya@Bodya.Bodya', '/template/images/default-avatar.png', 1, 1504009656),
(5, 'user', 'John', 'Smith', '4925da7da7a56260baf1c37925a8fa24e46ad8b107dcd21f44e39e4751bae1304fc70de7acb847ffa96126bb372de005f5320f1ede6f9df07c7d53f9c160f022', 'v66z66@gmail.com', '/template/images/default-avatar.png', 1, 1502973280),
(6, 'rkonoval', 'Ruslan', 'Konovalenko', '1b33a651ec9636efa0e5ef4d40a76e5f36ed20514c84bae4dd6c4ec785788d0da25543cede16490ce400dc7831f39b7fda72f0f63e8ac5ac7a579e09011710fc', 'maryankiyanitsya@gmail.com', '/template/images/default-avatar.png', 1, 1504009844),
(7, 'test', 'test', 'test', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'test@te.st', '/template/images/default-avatar.png', 1, 1504010957),
(8, 'ya', 'ty', 'vy', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'v@v.v', '/template/images/default-avatar.png', 0, 1504010977),
(10, 'final', 'Last', 'Register', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'final@a.a', '/template/images/default-avatar.png', 1, 1504087625),
(11, 'qwerty', 'qwerty', 'qwerty', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'rkonoval@student.unit.ua', '/template/images/default-avatar.png', 0, 1504092067),
(13, 'ruslan', 'Ruslan', 'KONOVAlENKO', '0510f5c19493084e7ed1c20366baff172d7d37d6b5456ae21f10097b46ce6695b312e054ef0f6e4bcda497c87fb8fba73a069a0f9e989992c5f2c6ac35281fa1', 'yibu@p33.org', '/template/images/default-avatar.png', 1, 1504096034),
(14, 'vitalii', 'vitalii', 'rudenko', '0510f5c19493084e7ed1c20366baff172d7d37d6b5456ae21f10097b46ce6695b312e054ef0f6e4bcda497c87fb8fba73a069a0f9e989992c5f2c6ac35281fa1', 'rvsrudiK@gmail.com', '/template/images/default-avatar.png', 0, 1504095590),
(15, '1ogon1', 'Ruslan', 'Konovalenko', 'e58e7af344db4cedaae80b77b1743906453ea2e83b76a42d0d333ae3fc118f8051f20f3d7ea482c22a89477a6139a7c49ac70b8c58be8dc349f0c57b39fc1074', 'konovalenkoruslan@gmail.com', '/template/images/default-avatar.png', 1, 1504098871);

-- --------------------------------------------------------

--
-- Структура таблицы `user_info`
--

CREATE TABLE `user_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `gender` int(1) NOT NULL,
  `sex_pref` int(1) NOT NULL,
  `biography` text NOT NULL,
  `birthday` date NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_info`
--

INSERT INTO `user_info` (`id`, `id_user`, `gender`, `sex_pref`, `biography`, `birthday`, `lat`, `lng`) VALUES
(1, 1, 1, 0, 'efrhntbgvfdefsd', '1994-04-03', '49.7416816', '16.16223660000003'),
(2, 2, 2, 0, 'sdfghjkljhgeaq', '1989-06-17', '50.46949919999999', '30.5171335'),
(3, 3, 2, 0, '', '1995-10-20', '50.25465', '28.65866690000007'),
(6, 4, 0, 0, '', '1999-05-22', '50.4444465', '30.54540410000004'),
(7, 5, 0, 0, '', '1996-01-12', '50.468818', '30.462225999999987'),
(8, 6, 1, 0, 'Люблю котят', '1995-09-21', '49.839683', '24.029717000000005'),
(9, 7, 2, 0, '', '1997-09-23', '50.468818', '30.462225999999987'),
(10, 8, 1, 0, '', '1970-01-01', '50.468818', '30.462225999999987'),
(12, 10, 1, 0, '', '1970-01-01', '50.468818', '30.462225999999987'),
(13, 11, 0, 0, '', '1970-01-01', '50.468818', '30.462225999999987'),
(14, 12, 1, 1, 'sdfgmnnvbvbnvbm,mfdasdfghj', '1989-06-02', '50.46949919999999', '30.5171335'),
(15, 13, 0, 0, '', '1970-01-01', '50.468818', '30.462225999999987'),
(16, 14, 0, 0, '', '1970-01-01', '50.468818', '30.462225999999987'),
(17, 15, 0, 0, '', '1970-01-01', '50.468818', '30.462225999999987');

-- --------------------------------------------------------

--
-- Структура таблицы `visitor`
--

CREATE TABLE `visitor` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_visitor` int(10) NOT NULL,
  `type` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `visitor`
--

INSERT INTO `visitor` (`id`, `id_user`, `id_visitor`, `type`, `status`) VALUES
(6, 3, 13, 1, 1),
(7, 3, 13, 2, 1),
(8, 3, 13, 1, 1),
(9, 13, 3, 1, 1),
(10, 13, 3, 2, 1),
(11, 13, 3, 1, 1),
(12, 13, 3, 1, 1),
(13, 13, 3, 1, 1),
(14, 13, 3, 1, 1),
(15, 13, 3, 1, 1),
(16, 13, 3, 1, 1),
(17, 13, 3, 1, 1),
(18, 7, 2, 1, 0),
(19, 6, 2, 1, 0),
(20, 6, 2, 1, 0),
(21, 6, 2, 2, 0),
(22, 6, 2, 1, 0),
(23, 6, 2, 1, 0),
(24, 6, 2, 3, 0),
(25, 6, 2, 2, 0),
(26, 6, 2, 3, 0),
(27, 6, 2, 2, 0),
(28, 6, 2, 3, 0),
(29, 6, 2, 2, 0),
(30, 6, 2, 3, 0),
(31, 6, 2, 2, 0),
(32, 6, 2, 3, 0),
(33, 6, 2, 2, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activate`
--
ALTER TABLE `activate`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `search_tag`
--
ALTER TABLE `search_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activate`
--
ALTER TABLE `activate`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `search_tag`
--
ALTER TABLE `search_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
