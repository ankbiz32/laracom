-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 07:24 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhukyra`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(255) NOT NULL,
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `img_src`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(43, 'Clothes', 0, NULL, 'clothes', NULL, '2020-09-29 11:41:56', '2020-09-29 11:41:56'),
(47, 'Shoes', 0, NULL, 'shoes', NULL, '2020-09-29 11:44:45', '2020-09-29 11:44:45'),
(48, 'Appliances', 0, NULL, 'appliances', NULL, '2020-09-29 11:44:57', '2020-09-29 11:44:57'),
(49, 'Watches', 0, NULL, 'watches', NULL, '2020-09-29 11:45:03', '2020-09-29 11:45:03'),
(51, 'Chronograph', 49, NULL, 'chronograph', NULL, '2020-09-29 11:49:31', '2020-09-29 11:49:31'),
(52, 'Analog', 49, NULL, 'analog', NULL, '2020-09-29 11:49:46', '2020-09-29 11:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(19, '2014_10_12_000000_create_users_table', 1),
(20, '2014_10_12_100000_create_password_resets_table', 1),
(21, '2019_08_19_000000_create_failed_jobs_table', 1),
(22, '2020_04_18_101953_create_products_table', 1),
(23, '2020_04_18_132841_create_profiles_table', 1),
(24, '2020_04_21_154729_create_stocks_table', 1),
(25, '2020_04_24_084350_create_orders_table', 1),
(26, '2020_04_26_123151_create_reminders_table', 1),
(27, '2020_04_27_044831_create_newsletters_table', 1),
(28, '2020_09_28_115317_create_categories_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(255) NOT NULL,
  `brand_id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `has_discount` tinyint(4) NOT NULL DEFAULT 0,
  `discount_type` int(10) NOT NULL,
  `discount_rate` double NOT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_todays_deal` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `max_selling_qty` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `brand`, `price`, `image`, `sku`, `description`, `gender`, `category`, `quantity`, `has_discount`, `discount_type`, `discount_rate`, `is_featured`, `is_todays_deal`, `is_active`, `max_selling_qty`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 'AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"', 'Nike', 1375, 'products/1.jpg', '', '', 'Female', 'Shoes', 1, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(2, 0, 0, 'STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"', 'Nike', 225, 'products/2.jpg', '', '', 'Unisex', 'Shoes', 12, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(3, 0, 0, 'SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"', 'Nike', 275, 'products/3.jpg', '', '', 'Male', 'Shoes', 1, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(4, 0, 0, 'SACAI X LDV WAFFLE \"BLACK NYLON\"', 'Nike', 190, 'products/4.jpg', '', '', 'Male', 'Shoes', 1, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:52'),
(5, 0, 0, 'AIR JORDAN 1 RETRO HIGH \"SHATTERED BACKBOARD\"', 'Nike', 980, 'products/5.jpg', '', '', 'Male', 'Shoes', 14, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(6, 0, 0, 'YEEZY BOOST 350 V2 \"CREAM\"', 'Adidas', 780, 'products/6.jpg', '', '', 'Unisex', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(7, 0, 0, 'YEEZY BOOST 350 V2\"YECHEIL NON-REFLECT\"', 'Adidas', 978, 'products/7.jpg', '', '', 'Male', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(8, 0, 0, 'YEEZY BOOST 350 V2 \"FROZEN YELLOW\"', 'Adidas', 1100, 'products/8.jpg', '', '', 'Unisex', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(9, 0, 0, 'AIR JORDAN 5 RETRO SP \"MUSLIN\"', 'Nike', 1499, 'products/9.jpg', '', '', 'Male', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(10, 0, 0, 'AIR JORDAN 1 RETRO HIGH ZOOM \"RACER BLUE\"', 'Nike', 625, 'products/10.jpg', '', '', 'Male', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(11, 0, 0, 'FENTY SLIDE \"PINK BOW \"', 'Puma', 399, 'products/11.jpg', '', '', 'Female', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(12, 0, 0, 'WMNS RS-X TRACKS \"FAIR AQUA\"', 'Puma', 499, 'products/12.jpg', '', '', 'Female', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:45:03'),
(13, 0, 0, 'OLD SKOOL \'BLACK WHITE\' \"BLACK WHITE\"', 'Vans', 239, 'products/13.jpg', '', '', 'Unisex', 'Shoes', 6, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(14, 0, 0, 'OLD SKOOL \"YACHT CLUB\"', 'Vans', 359, 'products/14.jpg', '', '', 'Unisex', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(15, 0, 0, 'VANS OLD SKOOL \"RED CHECKERBOARD \"', 'Vans', 419, 'products/15.jpg', '', '', 'Unisex', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(16, 0, 0, 'ALL STAR 70S HI \"MILK\"', 'Converse', 579, 'products/16.jpg', '', '', 'Unisex', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(17, 0, 0, 'ALL-STAR 70S HI \"PLAY\"', 'Puma', 619, 'products/17.jpg', '', '', 'Unisex', 'Shoes', 3, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(18, 0, 0, 'FEAR OF GOD CHUCK 70 HI \"NATURAL\"', 'Converse', 1259, 'products/18.jpg', '', '', 'Female', 'Shoes', 5, 0, 0, 0, 0, 0, 1, 0, NULL, '2020-09-28 02:41:51'),
(23, 0, 0, 'Whatsapp', 'Nike', 999, 'products/sShCHttCz5sIzyvdUxzFc3NR7duDB8gDi77gcPE3.jpeg', '', '', 'Male', 'Shoes', 1, 0, 0, 0, 0, 0, 1, 0, '2020-09-26 01:02:26', '2020-09-28 02:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phonenumber` bigint(20) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `phonenumber`, `country`, `city`, `address`, `zipcode`, `created_at`, `updated_at`) VALUES
(1, 1, 11151552928, 'Singapore', 'Singapore', 'Buangkok Green 512-4a', 42132, NULL, NULL),
(2, 2, 8215551234, 'Indonesia', 'Medan', 'Danau Toba', 27321, NULL, NULL),
(3, 3, 42912345, 'United State of America', 'Seattle', 'Downtown Seattle ST 17', 78231, NULL, NULL),
(4, 4, 32912345, 'China', 'Guangzhou', 'ST 23a', 78213, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reminder` text COLLATE utf8mb4_unicode_ci DEFAULT 'Type Something',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `reminder`, `created_at`, `updated_at`) VALUES
(1, 'Put your reminders here.', NULL, '2020-09-26 00:55:19');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, '32', 0, NULL, NULL),
(2, 1, '33', 10, NULL, NULL),
(3, 1, '34', 10, NULL, NULL),
(4, 1, '35', 10, NULL, NULL),
(5, 1, '36', 10, NULL, NULL),
(6, 1, '37', 10, NULL, NULL),
(7, 1, '38', 10, NULL, NULL),
(8, 2, '39', 10, NULL, NULL),
(9, 2, '40', 10, NULL, NULL),
(10, 2, '32', 0, NULL, NULL),
(11, 2, '33', 10, NULL, NULL),
(12, 2, '34', 10, NULL, NULL),
(13, 2, '35', 10, NULL, NULL),
(14, 3, '36', 10, NULL, NULL),
(15, 3, '37', 10, NULL, NULL),
(16, 3, '38', 10, NULL, NULL),
(17, 3, '39', 10, NULL, NULL),
(18, 3, '40', 10, NULL, NULL),
(19, 4, '32', 0, NULL, NULL),
(20, 4, '33', 10, NULL, NULL),
(21, 4, '34', 10, NULL, NULL),
(22, 4, '35', 10, NULL, NULL),
(23, 4, '36', 10, NULL, NULL),
(24, 4, '37', 10, NULL, NULL),
(25, 4, '38', 10, NULL, NULL),
(26, 5, '39', 10, NULL, NULL),
(27, 5, '40', 10, NULL, NULL),
(28, 5, '32', 0, NULL, NULL),
(29, 5, '33', 10, NULL, NULL),
(30, 6, '34', 10, NULL, NULL),
(31, 6, '35', 10, NULL, NULL),
(32, 6, '36', 10, NULL, NULL),
(33, 6, '37', 10, NULL, NULL),
(34, 7, '38', 10, NULL, NULL),
(35, 7, '39', 10, NULL, NULL),
(36, 7, '40', 10, NULL, NULL),
(37, 7, '32', 0, NULL, NULL),
(38, 7, '33', 10, NULL, NULL),
(39, 7, '34', 10, NULL, NULL),
(40, 8, '35', 10, NULL, NULL),
(41, 8, '36', 10, NULL, NULL),
(42, 8, '37', 10, NULL, NULL),
(43, 8, '38', 10, NULL, NULL),
(44, 9, '39', 10, NULL, NULL),
(45, 9, '40', 10, NULL, NULL),
(46, 9, '32', 0, NULL, NULL),
(47, 10, '33', 10, NULL, NULL),
(48, 11, '34', 10, NULL, NULL),
(49, 12, '35', 10, NULL, NULL),
(50, 13, '36', 10, NULL, NULL),
(51, 14, '37', 10, NULL, NULL),
(52, 15, '38', 10, NULL, NULL),
(53, 16, '39', 10, NULL, NULL),
(54, 17, '39', 10, NULL, NULL),
(55, 17, '40', 10, NULL, NULL),
(56, 18, '38', 10, NULL, NULL),
(57, 18, '39', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@bhukyra.com', NULL, '$2y$10$/sJ80JyKsrfKRcFSOibpNOe6E08jYIY511yvar3kD8ixL6Qlr1m.e', 'Admin', NULL, NULL, NULL),
(2, 'Dawn Roe', 'user@gmail.com', NULL, '$2y$10$/sJ80JyKsrfKRcFSOibpNOe6E08jYIY511yvar3kD8ixL6Qlr1m.e', 'Customer', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_index` (`user_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_index` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
