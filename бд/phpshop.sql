-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2025 at 07:06 PM
-- Server version: 10.4.26-MariaDB
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(13, 'Ноутбуки', 1, 1),
(14, 'Планшети', 2, 1),
(15, 'Монітори', 3, 1),
(16, 'Ігрові комп’ютери', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `product_id`) VALUES
(6, 45);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(45, 'fsdfsd', '1', '123123123', 4, '2015-05-14 09:54:45', '{\"1\":1,\"2\":1,\"3\":2}', 3),
(46, 'САША1', 'g3424242342', '', 4, '2015-05-18 15:34:42', '{\"44\":3,\"43\":3}', 1),
(47, '123', '1232@gmail.co0m', '123', 3960, '2025-07-10 12:33:26', '\"123\"', 1),
(48, 'Ostap', 'gerasimovicostap@gmail.com', '123', 1320, '2025-07-10 12:37:00', '\"123asdz\"', 1),
(49, 'Ostap', '123', '123', 6, '2025-07-10 12:42:56', '[{\"id\":45,\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u2019\\u044e\\u0442\\u0435\\u0440 Everest Game\",\"category_id\":16,\"code\":1563832,\"price\":1320,\"availability\":1,\"brand\":\"Everest\",\"image\":\"\",\"description\":\"Everest Game 9085 \\u2014 \\u0446\\u0435 \\u043a\\u043e\\u043c\\u043f\\u2019\\u044e\\u0442\\u0435\\u0440\\u0438 \\u043f\\u0440\\u0435\\u043c\\u0456\\u0443\\u043c\\u043a\\u043b\\u0430\\u0441\\u0443, \\u0437\\u0456\\u0431\\u0440\\u0430\\u043d\\u0456 \\u043d\\u0430 \\u043e\\u0441\\u043d\\u043e\\u0432\\u0456 \\u0435\\u043a\\u0441\\u043a\\u043b\\u044e\\u0437\\u0438\\u0432\\u043d\\u0438\\u0445 \\u043a\\u043e\\u043c\\u043f\\u043e\\u043d\\u0435\\u043d\\u0442\\u0456\\u0432, \\u0440\\u0435\\u0442\\u0435\\u043b\\u044c\\u043d\\u043e \\u043f\\u0456\\u0434\\u0456\\u0431\\u0440\\u0430\\u043d\\u0438\\u0445 \\u0456 \\u043f\\u0440\\u043e\\u0442\\u0435\\u0441\\u0442\\u043e\\u0432\\u0430\\u043d\\u0438\\u0445 \\u043d\\u0430\\u0439\\u043a\\u0440\\u0430\\u0449\\u0438\\u043c\\u0438 \\u0444\\u0430\\u0445\\u0456\\u0432\\u0446\\u044f\\u043c\\u0438 \\u043d\\u0430\\u0448\\u043e\\u0457 \\u043a\\u043e\\u043c\\u043f\\u0430\\u043d\\u0456\\u0457. \\u0426\\u0435 \\u0442\\u043e\\u043f\\u043e\\u0432\\u0438\\u0439 \\u0441\\u0435\\u0433\\u043c\\u0435\\u043d\\u0442 \\u0441\\u0438\\u0441\\u0442\\u0435\\u043c, \\u0449\\u043e \\u0432\\u0456\\u0434\\u043f\\u043e\\u0432\\u0456\\u0434\\u0430\\u0454 \\u043d\\u0430\\u0439\\u0432\\u0438\\u0449\\u0438\\u043c \\u0441\\u0442\\u0430\\u043d\\u0434\\u0430\\u0440\\u0442\\u0430\\u043c \\u044f\\u043a\\u043e\\u0441\\u0442\\u0456 \\u0442\\u0430 \\u043f\\u0440\\u043e\\u0434\\u0443\\u043a\\u0442\\u0438\\u0432\\u043d\\u043e\\u0441\\u0442\\u0456.\",\"is_new\":0,\"is_recommended\":0,\"status\":1,\"quantity\":1,\"total_price\":1320}]', 1),
(50, 'Ostap', '123', '123123', 175, '2025-07-10 12:58:10', '[{\"id\":44,\"name\":\"\\u041c\\u043e\\u043d\\u0456\\u0442\\u043e\\u0440 23\\\" Dell E2314H Black\",\"category_id\":15,\"code\":355025,\"price\":175,\"availability\":1,\"brand\":\"Dell\",\"image\":\"\",\"description\":\"\\u0417 \\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\\u044c\\u043d\\u043e\\u044e \\u0437\\u0434\\u0430\\u0442\\u043d\\u0456\\u0441\\u0442\\u044e Full HD \\u0432\\u0438 \\u0437\\u043c\\u043e\\u0436\\u0435\\u0442\\u0435 \\u0440\\u043e\\u0437\\u0433\\u043b\\u0435\\u0434\\u0456\\u0442\\u0438 \\u043d\\u0430\\u0439\\u0434\\u0440\\u0456\\u0431\\u043d\\u0456\\u0448\\u0456 \\u0434\\u0435\\u0442\\u0430\\u043b\\u0456. Dell E2314H \\u043d\\u0430\\u0434\\u0430\\u0441\\u0442\\u044c \\u0432\\u0430\\u043c \\u0447\\u0456\\u0442\\u043a\\u0435 \\u0442\\u0430 \\u044f\\u0441\\u043a\\u0440\\u0430\\u0432\\u0435 \\u0437\\u043e\\u0431\\u0440\\u0430\\u0436\\u0435\\u043d\\u043d\\u044f, \\u0437 \\u044f\\u043a\\u0438\\u043c \\u0431\\u0443\\u0434\\u044c-\\u044f\\u043a\\u0430 \\u0440\\u043e\\u0431\\u043e\\u0442\\u0430 \\u0431\\u0443\\u0434\\u0435 \\u0432 \\u0437\\u0430\\u0434\\u043e\\u0432\\u043e\\u043b\\u0435\\u043d\\u043d\\u044f. Full HD 1920 x 1080 \\u043f\\u0440\\u0438 60 \\u0413\\u0446 (\\u043c\\u0430\\u043a\\u0441.)\",\"is_new\":0,\"is_recommended\":0,\"status\":1,\"quantity\":1,\"total_price\":175}]', 1),
(51, 'Ostap', '123', '123', 175, '2025-07-10 12:59:08', '[{\"id\":44,\"name\":\"\\u041c\\u043e\\u043d\\u0456\\u0442\\u043e\\u0440 23\\\" Dell E2314H Black\",\"category_id\":15,\"code\":355025,\"price\":175,\"availability\":1,\"brand\":\"Dell\",\"image\":\"\",\"description\":\"\\u0417 \\u0440\\u043e\\u0437\\u0434\\u0456\\u043b\\u044c\\u043d\\u043e\\u044e \\u0437\\u0434\\u0430\\u0442\\u043d\\u0456\\u0441\\u0442\\u044e Full HD \\u0432\\u0438 \\u0437\\u043c\\u043e\\u0436\\u0435\\u0442\\u0435 \\u0440\\u043e\\u0437\\u0433\\u043b\\u0435\\u0434\\u0456\\u0442\\u0438 \\u043d\\u0430\\u0439\\u0434\\u0440\\u0456\\u0431\\u043d\\u0456\\u0448\\u0456 \\u0434\\u0435\\u0442\\u0430\\u043b\\u0456. Dell E2314H \\u043d\\u0430\\u0434\\u0430\\u0441\\u0442\\u044c \\u0432\\u0430\\u043c \\u0447\\u0456\\u0442\\u043a\\u0435 \\u0442\\u0430 \\u044f\\u0441\\u043a\\u0440\\u0430\\u0432\\u0435 \\u0437\\u043e\\u0431\\u0440\\u0430\\u0436\\u0435\\u043d\\u043d\\u044f, \\u0437 \\u044f\\u043a\\u0438\\u043c \\u0431\\u0443\\u0434\\u044c-\\u044f\\u043a\\u0430 \\u0440\\u043e\\u0431\\u043e\\u0442\\u0430 \\u0431\\u0443\\u0434\\u0435 \\u0432 \\u0437\\u0430\\u0434\\u043e\\u0432\\u043e\\u043b\\u0435\\u043d\\u043d\\u044f. Full HD 1920 x 1080 \\u043f\\u0440\\u0438 60 \\u0413\\u0446 (\\u043c\\u0430\\u043a\\u0441.)\",\"is_new\":0,\"is_recommended\":0,\"status\":1,\"quantity\":1,\"total_price\":175}]', 1),
(52, 'Ostap', '123', '123', 430, '2025-07-10 13:01:50', '[{\"id\":40,\"name\":\"\\u041d\\u043e\\u0443\\u0442\\u0431\\u0443\\u043a Asus X751MA\",\"category_id\":13,\"code\":2028367,\"price\":430,\"availability\":1,\"brand\":\"Asus\",\"image\":\"\",\"description\":\"\\u0415\\u043a\\u0440\\u0430\\u043d 17.3\\\" (1600x900) HD+ LED, \\u0433\\u043b\\u044f\\u043d\\u0446\\u0435\\u0432\\u0438\\u0439 \\/ Intel Pentium N3540 (2.16 - 2.66 \\u0413\\u0413\\u0446) \\/ RAM 4 \\u0413\\u0411 \\/ HDD 1 \\u0422\\u0411 \\/ Intel HD Graphics \\/ DVD Super Multi \\/ LAN \\/ Wi-Fi \\/ Bluetooth 4.0 \\/ \\u0432\\u0435\\u0431-\\u043a\\u0430\\u043c\\u0435\\u0440\\u0430 \\/ DOS \\/ 2.6 \\u043a\\u0433 \\/ \\u0431\\u0456\\u043b\\u0438\\u0439\",\"is_new\":0,\"is_recommended\":1,\"status\":1,\"quantity\":1,\"total_price\":430}]', 1),
(53, 'Ostap', '123', '123', 6, '2025-07-10 13:05:36', '[{\"id\":45,\"name\":\"\\u041a\\u043e\\u043c\\u043f\\u2019\\u044e\\u0442\\u0435\\u0440 Everest Game\",\"category_id\":16,\"code\":1563832,\"price\":1320,\"availability\":1,\"brand\":\"Everest\",\"image\":\"\",\"description\":\"Everest Game 9085 \\u2014 \\u0446\\u0435 \\u043a\\u043e\\u043c\\u043f\\u2019\\u044e\\u0442\\u0435\\u0440\\u0438 \\u043f\\u0440\\u0435\\u043c\\u0456\\u0443\\u043c\\u043a\\u043b\\u0430\\u0441\\u0443, \\u0437\\u0456\\u0431\\u0440\\u0430\\u043d\\u0456 \\u043d\\u0430 \\u043e\\u0441\\u043d\\u043e\\u0432\\u0456 \\u0435\\u043a\\u0441\\u043a\\u043b\\u044e\\u0437\\u0438\\u0432\\u043d\\u0438\\u0445 \\u043a\\u043e\\u043c\\u043f\\u043e\\u043d\\u0435\\u043d\\u0442\\u0456\\u0432, \\u0440\\u0435\\u0442\\u0435\\u043b\\u044c\\u043d\\u043e \\u043f\\u0456\\u0434\\u0456\\u0431\\u0440\\u0430\\u043d\\u0438\\u0445 \\u0456 \\u043f\\u0440\\u043e\\u0442\\u0435\\u0441\\u0442\\u043e\\u0432\\u0430\\u043d\\u0438\\u0445 \\u043d\\u0430\\u0439\\u043a\\u0440\\u0430\\u0449\\u0438\\u043c\\u0438 \\u0444\\u0430\\u0445\\u0456\\u0432\\u0446\\u044f\\u043c\\u0438 \\u043d\\u0430\\u0448\\u043e\\u0457 \\u043a\\u043e\\u043c\\u043f\\u0430\\u043d\\u0456\\u0457. \\u0426\\u0435 \\u0442\\u043e\\u043f\\u043e\\u0432\\u0438\\u0439 \\u0441\\u0435\\u0433\\u043c\\u0435\\u043d\\u0442 \\u0441\\u0438\\u0441\\u0442\\u0435\\u043c, \\u0449\\u043e \\u0432\\u0456\\u0434\\u043f\\u043e\\u0432\\u0456\\u0434\\u0430\\u0454 \\u043d\\u0430\\u0439\\u0432\\u0438\\u0449\\u0438\\u043c \\u0441\\u0442\\u0430\\u043d\\u0434\\u0430\\u0440\\u0442\\u0430\\u043c \\u044f\\u043a\\u043e\\u0441\\u0442\\u0456 \\u0442\\u0430 \\u043f\\u0440\\u043e\\u0434\\u0443\\u043a\\u0442\\u0438\\u0432\\u043d\\u043e\\u0441\\u0442\\u0456.\",\"is_new\":0,\"is_recommended\":0,\"status\":1,\"quantity\":1,\"total_price\":1320}]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT 0,
  `is_recommended` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `image`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(34, 'Ноутбук Asus X200MA (X200MA-KX315D)', 13, 1839707, 395, 1, 'Asus', '', 'Екран 11.6\" (1366x768) HD LED, глянцевий / Intel Pentium N3530 (2.16 - 2.58 ГГц) / RAM 4 ГБ / HDD 750 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / синій', 0, 0, 1),
(35, 'Ноутбук HP Stream 11-d050nr', 13, 2343847, 305, 0, 'Hewlett Packard', '', 'Екран 11.6” (1366x768) HD LED, матовий / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / eMMC 32 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 + MS Office 365 / 1.28 кг / синій', 1, 1, 1),
(36, 'Ноутбук Asus X200MA White ', 13, 2028027, 270, 1, 'Asus', '', 'Екран 11.6\" (1366x768) HD LED, глянцевий / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Bluetooth 4.0 / Wi-Fi / LAN / веб-камера / без ОС / 1.24 кг / білий', 0, 1, 1),
(37, 'Ноутбук Acer Aspire E3-112-C65X', 13, 2019487, 325, 1, 'Acer', '', 'Екран 11.6\'\' (1366x768) HD LED, матовий / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / Linpus / 1.29 кг / сріблястий', 0, 1, 1),
(38, 'Ноутбук Acer TravelMate TMB115', 13, 1953212, 275, 1, 'Acer', '', 'Екран 11.6\'\' (1366x768) HD LED, матовий / Intel Celeron N2840 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / Linpus / 1.32 кг / чорний', 0, 0, 1),
(39, 'Ноутбук Lenovo Flex 10', 13, 1602042, 370, 0, 'Lenovo', '', 'Екран 10.1\" (1366x768) HD LED, сенсорний, глянцевий / Intel Celeron N2830 (2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 / 1.2 кг / чорний', 0, 0, 1),
(40, 'Ноутбук Asus X751MA', 13, 2028367, 430, 1, 'Asus', '', 'Екран 17.3\" (1600x900) HD+ LED, глянцевий / Intel Pentium N3540 (2.16 - 2.66 ГГц) / RAM 4 ГБ / HDD 1 ТБ / Intel HD Graphics / DVD Super Multi / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / DOS / 2.6 кг / білий', 0, 1, 1),
(41, 'Samsung Galaxy Tab S 10.5 16GB', 14, 1129365, 780, 1, 'Samsung', '', 'Samsung Galaxy Tab S створений для того, щоб зробити ваше життя кращим. Насолоджуйтесь своїм контентом із покриттям 94% кольорів Adobe RGB та контрастністю 100000:1, яку забезпечує sAmoled-екран із функцією оптимізації під зображення та освітлення. Яскравий 10.5” екран в ультратонкому корпусі вагою 467 г потішить вас високою портативністю. Робота стане простішою разом із Hancom Office та віддаленим доступом до ПК. E-Meeting і WebEx — чудові помічники для зустрічей поза офісом. Надійно зберігайте свої дані завдяки сканеру відбитків пальців.', 1, 1, 1),
(42, 'Samsung Galaxy Tab S 8.4 16GB', 14, 1128670, 640, 1, 'Samsung', '', 'Екран 8.4\" Super AMOLED (2560x1600) ємнісний Multi-Touch / Samsung Exynos 5420 (1.9 ГГц + 1.3 ГГц) / RAM 3 ГБ / 16 ГБ вбудованої пам’яті + підтримка карт пам’яті microSD / Bluetooth 4.0 / Wi-Fi 802.11 a/b/g/n/ac / основна камера 8 Мп, фронтальна 2.1 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / 294 г / білий', 0, 0, 1),
(43, 'Gazer Tegra Note 7', 14, 683364, 210, 1, 'Gazer', '', 'Екран 7\" IPS (1280x800) ємнісний Multi-Touch / NVIDIA Tegra 4 (1.8 ГГц) / RAM 1 ГБ / 16 ГБ вбудованої пам’яті + підтримка карт пам’яті microSD / Wi-Fi / Bluetooth 4.0 / основна камера 5 Мп, фронтальна - 0.3 Мп / GPS / ГЛОНАСС / Android 4.4.2 (KitKat) / вага 320 г', 0, 0, 1),
(44, 'Монітор 23\" Dell E2314H Black', 15, 355025, 175, 1, 'Dell', '', 'З роздільною здатністю Full HD ви зможете розгледіти найдрібніші деталі. Dell E2314H надасть вам чітке та яскраве зображення, з яким будь-яка робота буде в задоволення. Full HD 1920 x 1080 при 60 Гц (макс.)', 0, 0, 1),
(45, 'Комп’ютер Everest Game', 16, 1563832, 1320, 1, 'Everest', '', 'Everest Game 9085 — це комп’ютери преміумкласу, зібрані на основі ексклюзивних компонентів, ретельно підібраних і протестованих найкращими фахівцями нашої компанії. Це топовий сегмент систем, що відповідає найвищим стандартам якості та продуктивності.', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `text`, `rating`, `date`) VALUES
(1, 45, 6, 'Круто', 4, '2025-07-10 21:57:40'),
(2, 45, 7, 'чоткий комп рекомендую', 5, '2025-07-11 15:40:03'),
(3, 45, 8, '123', 1, '2025-07-11 17:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(6, '123', 'gerasimovicostap@gmail.com', '$2y$10$wdhLAtpFrp4E4/6FJGaOeOtU41/bZcVhTIvPx7U14VAWgXdqjY39W', 'user'),
(7, 'user1', 'user@mail.com', '$2y$10$pIquYEZ6TufFxW.4e9lbsOlBNiQZdinW.9bafTeSJAGqrVF..i9kG', 'user'),
(8, 'admin', 'admin@example.com', '$2y$10$6ZICfTf1j5yOLHPUfkqZIuvoPCLyn9GAM9JGOudUsx8.BmAhemnL2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
