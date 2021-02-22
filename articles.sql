-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Lut 2021, 14:44
-- Wersja serwera: 10.4.16-MariaDB
-- Wersja PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `articles`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL ,
  `description` text NOT NULL,
  `publicStatus` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `articles`
--

INSERT INTO `articles` (`id`, `categoryId`, `userId`, `title`, `description`, `publicStatus`, `created_at`) VALUES
(1, 2, 10, 'Lern PHP', 'PHP is one of the most used languages to build web applications', 1, '2021-02-20 01:52:46'),
(3, 1, 10, 'First step to Building Web', 'Lern HTML, CSS , JS  ', 1, '2021-02-20 01:53:35'),
(4, 1, 8, 'Fullstack dev', 'A full stack web developer is a person who can develop both client and server software, In addition to mastering HTML and CSS, he/she also knows how to Program a browser (using JavaScript, Angular, or Vue),Program a server (PHP), Program a database (SQL, ', 1, '2021-02-20 12:50:57'),
(5, 4, 8, 'PHP Symfony', 'SYMFONY', 1, '2021-02-21 10:43:09'),
(6, 2, 8, 'Node js Express ', 'Javascript for backend', 1, '2021-02-21 10:56:01'),
(7, 4, 10, 'Laravel vs Symfony', 'Symfony is designed for a bit larger-scale or more complex projects which contain huge features and used by a significant amount of clients. Whereas Laravel is related to MVC design pattern which was aforementioned. When it goes for scalability if you cho', 1, '2021-02-21 15:06:53'),
(8, 2, 10, 'Cross-platform mobile development', 'cross-platform development allows covering two operating systems with one code. It doesn’t assume writing code with a native programming language; however, if you take a closer look at it, you’ll notice that it ensures much a near-native experience thanks', 1, '2021-02-21 15:08:19'),
(9, 3, 12, 'Lern JavaScript', 'JavaScript is the world&#39;s most popular programming language.  JavaScript is the programming language of the Web.  JavaScript is easy to learn.  This tutorial will teach you JavaScript from basic to advanced.', 1, '2021-02-21 16:07:38'),
(10, 4, 12, 'Node js', 'Node.js is an open source server environment.  Node.js allows you to run JavaScript on the server.', 1, '2021-02-21 16:08:51'),
(14, 6, 10, 'How Relational Databases Are Structured', '    The relational model means that the logical data structures—the data tables, views, and indexes—are separate from the physical storage structures. This separation means that database administrators can manage physical data storage without affecting access to that data as a logical structure. For example, renaming a database file does not rename the tables stored within it. The distinction between logical and physical also applies to database operations, which are clearly defined actions that enable applications to manipulate the data and structures of the database. Logical operations allow an application to specify the content it needs, and physical operations determine how that data should be accessed and then carries out the task.', 1, '2021-02-22 09:16:23'),
(15, 4, 12, 'backend developer', ' &#13;&#10;What is Backend Development?&#13;&#10;Back-end Development refers to the server-side development. It focuses on databases, scripting, website architecture. It contains behind-the-scene activities that occur when performing any action on a website. It can be an account login or making a purchase from an online store. Code written by back-end developers helps browsers to communicate with database information.', 1, '2021-02-22 10:56:29');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(6, 'Database'),
(3, 'JavaScript'),
(5, 'PHP '),
(2, 'Programming'),
(4, 'Server Side'),
(1, 'Web Building');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(8, 'Mateusz1', 'Mat@gamil.com', '$2y$10$ZGt.3psodbTxqD6muZRJRuqAPPh4VF6SEM8M5ujAJuBMfk7erPY46'),
(10, 'newUser', 'newUser@gmail.com', '$2y$10$VAT5m/VSXw8.R0ERDQTnh.incbTv8rS9ykitCq9tP5nvPzs6lxu9u'),
(11, 'newUser2', 'newuser2@gmail.com', '$2y$10$ipv8hK8rrtZTwisLaZTIze9npvuJf4CjbU.3Evp/EobLIcVx9w8nq'),
(12, 'Pawel', 'pawel@gmail.com', '$2y$10$ylr7Q1SZ8Hs3eWK5Teoq7OYyJEZOc64PKC7pe/udRRBsHCI6tV1Iu'),
(16, 'Jonh', 'Jonnh89@gamil.com', '$2y$10$SKgpy3CoqmqpXswbPmVKAuXILTji5itC9Yzp8HUiD6jUdSVAZHzv.');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `post_categoryID_fk` (`categoryId`),
  ADD KEY `post_user_fk` (`userId`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_category_name` (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unigue_email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `post_categoryID_fk` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_user_fk` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
