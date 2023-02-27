-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 16 фев 2023 в 10:20
-- Версия на сървъра: 10.4.25-MariaDB
-- Версия на PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `web_chords`
--

CREATE DATABASE IF NOT EXISTS `web_chords` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `web_chords`;

-- --------------------------------------------------------

--
-- Структура на таблица `chords`
--

CREATE TABLE `chords` (
  `name` varchar(10) NOT NULL,
  `notation` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `chords`
--

INSERT INTO `chords` (`name`, `notation`) VALUES
('A', 'x02220'),
('Am', 'x02210'),
('B', 'x13331'),
('Bm', 'x13321'),
('C', 'x32010'),
('Cm', 'x35543'),
('D', 'xx0232'),
('Dm', 'xx0231'),
('E', '022100'),
('Em', '022000'),
('F', 'xx3211'),
('Fm', '133111'),
('G', '320003'),
('Gm', '355333');

-- --------------------------------------------------------

--
-- Структура на таблица `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `files`
--

INSERT INTO `files` (`id`, `owner_id`, `filename`) VALUES
(14, 7, 'LoveMeDo.json'),
(42, 8, 'WickedGame.json'),
(43, 7, 'WhatsUp.json');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `email`) VALUES
(7, 'ivan', 'ivan', '$2y$10$deyJHhl15CUnt02NPDIAC.07OpLnzIE/TIyWzU5r4ZMHvZb6JBcsC', 'ivan@gmail.com'),
(8, 'asd', 'asd', '$2y$10$3LFEy8RoV4pfi0fOumZTfel4ChqvT6tmmXNVa8LMHLMHuFg12YZMm', 'asd@asd');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
