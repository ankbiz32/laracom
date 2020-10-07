-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 02:46 PM
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
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `img_src` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `img_src`, `created_at`, `updated_at`) VALUES
(4, 'Agro health', 'brands/eYL2skKt2FV4HnWjebqpMTPFH2loghPSHREw4u2V.jpeg', '2020-10-06 02:00:13', '2020-10-06 02:00:13'),
(5, 'Parle Agro', 'brands/2OAm6aJbzB2AtlplRrY9WaJ5FtpSBTZwv1uowtZv.png', '2020-10-05 02:00:24', '2020-10-06 02:00:24');

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
(79, 'Agro products', 0, 'categories/iFWj2l8vI3zaC79tqgAK0VtcPKkgP0ZG94W4dbfn.jpeg', 'agro-products', NULL, '2020-10-02 02:35:40', '2020-10-02 02:35:40'),
(80, 'Health products', 0, 'categories/X15lcmsVSsnnsGDqZZaM936FY1pwBjFTI8xdEWYp.jpeg', 'health-products', NULL, '2020-10-02 02:35:53', '2020-10-02 02:35:53'),
(81, 'Organic fertilizers', 79, NULL, 'organic-fertilizers', NULL, '2020-10-02 02:36:07', '2020-10-02 02:36:07'),
(82, 'Immunity boosters', 80, NULL, 'immunity-boosters', NULL, '2020-10-02 02:36:21', '2020-10-02 02:36:21'),
(83, 'D100', 81, NULL, 'd100', NULL, '2020-10-06 05:44:49', '2020-10-06 05:44:49');

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
(28, '2020_09_28_115317_create_categories_table', 2),
(29, '2020_10_07_104409_create_payment_table', 3);

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
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT 1,
  `payment_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ORDERED',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `amount`, `cart`, `phonenumber`, `country`, `city`, `address`, `zipcode`, `is_paid`, `payment_type`, `payment_id`, `order_status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dawn Roe', '500', 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:1;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:275;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:3;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"\";s:5:\"price\";i:275;s:5:\"image\";s:14:\"products/3.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:3;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"\";s:5:\"price\";i:275;s:5:\"image\";s:14:\"products/3.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:3;}}s:13:\"totalQuantity\";i:1;s:10:\"totalPrice\";i:275;}', '8215551234', 'Indonesia', 'Medan', 'Danau Toba', 27321, 1, 'COD', NULL, 'ORDERED', '2020-10-07 00:05:27', '2020-10-07 00:05:27'),
(4, 2, 'Dawn Roe', '400', 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:1:{i:0;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:1375;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:1;}}s:13:\"totalQuantity\";i:1;s:10:\"totalPrice\";i:1375;}', '8215551234', 'Indonesia', 'Medan', 'Danau Toba', 27321, 1, NULL, NULL, 'ORDERED', '2020-10-07 00:29:59', '2020-10-07 00:29:59'),
(5, 2, 'Dawn Roe', '300', 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:2:{i:0;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:1375;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:1;}i:1;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:225;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:2;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:48:\"STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"\";s:5:\"price\";i:225;s:5:\"image\";s:14:\"products/2.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:2;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:48:\"STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"\";s:5:\"price\";i:225;s:5:\"image\";s:14:\"products/2.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:2;}}s:13:\"totalQuantity\";i:2;s:10:\"totalPrice\";i:1600;}', '8215551234', 'Indonesia', 'Medan', 'Danau Toba', 27321, 1, NULL, NULL, 'ORDERED', '2020-10-07 00:31:46', '2020-10-07 00:31:46'),
(6, 2, 'Test', '2655', 'O:8:\"App\\Cart\":3:{s:5:\"items\";a:4:{i:1;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:275;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:3;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"\";s:5:\"price\";i:275;s:5:\"image\";s:14:\"products/3.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:3;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"\";s:5:\"price\";i:275;s:5:\"image\";s:14:\"products/3.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:3;}i:2;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:780;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:6;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:26:\"YEEZY BOOST 350 V2 \"CREAM\"\";s:5:\"price\";i:780;s:5:\"image\";s:14:\"products/6.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:6;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:26:\"YEEZY BOOST 350 V2 \"CREAM\"\";s:5:\"price\";i:780;s:5:\"image\";s:14:\"products/6.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:6;}i:3;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:1375;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:1;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:44:\"AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"\";s:5:\"price\";i:1375;s:5:\"image\";s:14:\"products/1.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:1;}i:4;a:4:{s:8:\"quantity\";i:1;s:5:\"price\";i:225;s:4:\"item\";O:11:\"App\\Product\":27:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:13:\"\0*\0attributes\";a:23:{s:2:\"id\";i:2;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:48:\"STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"\";s:5:\"price\";i:225;s:5:\"image\";s:14:\"products/2.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:11:\"\0*\0original\";a:23:{s:2:\"id\";i:2;s:11:\"category_id\";s:1:\"0\";s:8:\"brand_id\";i:0;s:4:\"name\";s:48:\"STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"\";s:5:\"price\";i:225;s:5:\"image\";s:14:\"products/2.jpg\";s:3:\"sku\";s:0:\"\";s:8:\"in_stock\";i:1;s:12:\"has_discount\";i:0;s:13:\"discount_type\";s:1:\"0\";s:13:\"discount_rate\";i:0;s:13:\"max_order_qty\";i:0;s:11:\"is_featured\";i:0;s:14:\"is_todays_deal\";i:0;s:4:\"tags\";s:0:\"\";s:8:\"url_slug\";s:0:\"\";s:11:\"short_descr\";s:0:\"\";s:10:\"full_descr\";s:0:\"\";s:10:\"meta_title\";s:0:\"\";s:10:\"meta_descr\";s:0:\"\";s:9:\"is_active\";i:1;s:10:\"created_at\";N;s:10:\"updated_at\";s:19:\"2020-10-06 09:45:42\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:8:\"\0*\0dates\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:1;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:10:\"product_id\";i:2;}}s:13:\"totalQuantity\";i:4;s:10:\"totalPrice\";i:2655;}', '8215551234', 'Indonesia', 'Medan', 'Danau Toba', 27321, 1, NULL, NULL, 'ORDERED', '2020-10-07 07:15:09', '2020-10-07 07:15:09');

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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_errors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(255) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_stock` tinyint(4) NOT NULL DEFAULT 1,
  `has_discount` tinyint(4) NOT NULL DEFAULT 0,
  `discount_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_rate` int(11) DEFAULT NULL,
  `max_order_qty` smallint(4) NOT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_todays_deal` tinyint(4) NOT NULL DEFAULT 0,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_slug` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_descr` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_descr` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_descr` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `price`, `image`, `sku`, `in_stock`, `has_discount`, `discount_type`, `discount_rate`, `max_order_qty`, `is_featured`, `is_todays_deal`, `tags`, `url_slug`, `short_descr`, `full_descr`, `meta_title`, `meta_descr`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '0', 0, 'AIR JORDAN 1 X OFF-WHITE NRG \"OFF WHITE UNC\"', 1375, 'products/1.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(2, '0', 0, 'STUSSY X AIR ZOOM SPIRIDON CAGED \"PURE PLATINUM\"', 225, 'products/2.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(3, '0', 0, 'SUPREME X AIR FORCE 1 LOW \"BOX LOGO - WHITE\"', 275, 'products/3.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(4, '0', 0, 'SACAI X LDV WAFFLE \"BLACK NYLON\"', 190, 'products/4.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(5, '0', 0, 'AIR JORDAN 1 RETRO HIGH \"SHATTERED BACKBOARD\"', 980, 'products/5.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(6, '0', 0, 'YEEZY BOOST 350 V2 \"CREAM\"', 780, 'products/6.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(7, '0', 0, 'YEEZY BOOST 350 V2\"YECHEIL NON-REFLECT\"', 978, 'products/7.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(8, '0', 0, 'YEEZY BOOST 350 V2 \"FROZEN YELLOW\"', 1100, 'products/8.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(9, '0', 0, 'AIR JORDAN 5 RETRO SP \"MUSLIN\"', 1499, 'products/9.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:42'),
(10, '0', 0, 'AIR JORDAN 1 RETRO HIGH ZOOM \"RACER BLUE\"', 625, 'products/10.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(11, '0', 0, 'FENTY SLIDE \"PINK BOW \"', 399, 'products/11.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(12, '0', 0, 'WMNS RS-X TRACKS \"FAIR AQUA\"', 499, 'products/12.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(13, '0', 0, 'OLD SKOOL \'BLACK WHITE\' \"BLACK WHITE\"', 239, 'products/13.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(14, '0', 0, 'OLD SKOOL \"YACHT CLUB\"', 359, 'products/14.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(15, '0', 0, 'VANS OLD SKOOL \"RED CHECKERBOARD \"', 419, 'products/15.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(16, '0', 0, 'ALL STAR 70S HI \"MILK\"', 579, 'products/16.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(17, '0', 0, 'ALL-STAR 70S HI \"PLAY\"', 619, 'products/17.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 04:15:41'),
(18, '0', 0, 'FEAR OF GOD CHUCK 70 HI \"NATURAL\"', 1259, 'products/18.jpg', '', 1, 0, '0', 0, 0, 0, 0, '', '', '', '', '', '', 1, NULL, '2020-10-06 06:42:03'),
(40, '[\"79\"]', 4, 'New', 499, 'products/kpa51Lge0t96jsVrMt6U3kmYVR9npeFvgHb0rJYY.jpeg', NULL, 1, 0, '', NULL, 5, 0, 0, '[\"seeds\"]', 'new', NULL, NULL, NULL, NULL, 1, '2020-10-07 05:43:46', '2020-10-07 05:43:46'),
(41, '[\"79\",\"81\"]', 4, 'test2', 566, 'products/bPkN6mtAYa2ByGZGFkYrxzcBQ4kKxUs1ycFWXfDF.jpeg', NULL, 1, 0, '', NULL, 5, 0, 0, '[\"health products\",\"protien\"]', 'test2', NULL, NULL, NULL, NULL, 1, '2020-10-07 05:45:54', '2020-10-07 05:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_src` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `created_at`, `updated_at`) VALUES
(1, 'health products', '2020-10-03 11:46:35', '2020-10-05 01:55:45'),
(2, 'protien', '2020-10-03 11:46:35', '2020-10-03 11:46:35'),
(3, 'fertilizers', '2020-10-03 11:47:15', '2020-10-03 11:47:15'),
(4, 'seeds', '2020-10-03 11:47:15', '2020-10-03 11:47:15'),
(20, 'new', '2020-10-06 05:29:23', '2020-10-06 05:29:23');

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
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag` (`tag`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
