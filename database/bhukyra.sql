-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 02:28 PM
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
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `country_iso_code`, `created_at`, `updated_at`) VALUES
(1, 'Size', 'IN', '2021-06-05 04:17:38', '2021-06-05 04:17:38'),
(2, 'Weight', 'IN', '2021-06-05 04:19:02', '2021-06-05 04:19:12'),
(3, 'Volume', 'IN', '2021-06-05 04:19:27', '2021-06-05 04:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_details`
--

CREATE TABLE `attribute_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `describe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_details`
--

INSERT INTO `attribute_details` (`id`, `attribute_id`, `name`, `describe`, `created_at`, `updated_at`) VALUES
(1, 1, 'S', NULL, '2021-06-05 04:17:38', '2021-06-05 04:17:38'),
(2, 1, 'M', NULL, '2021-06-05 04:18:12', '2021-06-05 04:18:12'),
(3, 1, 'L', NULL, '2021-06-05 04:18:12', '2021-06-05 04:18:12'),
(4, 1, 'XL', NULL, '2021-06-05 04:18:12', '2021-06-05 04:18:12'),
(5, 2, '100gms', NULL, '2021-06-05 04:19:02', '2021-06-05 04:19:02'),
(6, 2, '250gms', NULL, '2021-06-05 04:19:02', '2021-06-05 04:19:02'),
(7, 3, '100ml', NULL, '2021-06-05 04:19:27', '2021-06-05 04:19:27'),
(8, 3, '250ml', NULL, '2021-06-05 04:19:27', '2021-06-05 04:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `img_src`, `country_iso_code`, `created_at`, `updated_at`) VALUES
(1, 'Bhukyra', 'brands/yVVq9SIDCWWLmGFEogYKht27IMTk3DSHGl10mZjD.png', 'IN', NULL, '2021-03-13 00:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `country_iso_code`, `img_src`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(3, '0', 'Skin care', 'IN', 'categories/9aKecyJOjQGD64aqey92IOU3kckh4TFpHWhP13eV.jpeg', 'skin-care', NULL, '2021-03-13 00:43:03', '2021-03-13 00:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(28, 3, 6, NULL, '2021-03-13 00:57:35'),
(31, 3, 8, NULL, '2021-06-18 02:36:24'),
(32, 3, 9, '2021-06-19 01:15:28', '2021-06-19 01:15:28'),
(41, 3, 10, NULL, '2021-06-19 01:28:27'),
(51, 3, 7, NULL, '2021-06-19 04:52:40'),
(68, 3, 11, NULL, '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `country_iso_code`, `currency`, `currency_symbol`, `locale_code`, `locale_name`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFN', '؋', 'FA', 'farsi', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(2, 'Argentina', 'AR', 'ARS', '$', 'ES', 'spanish', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(3, 'Australia', 'AU', 'AUD', 'A$', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(4, 'Austria', 'AT', 'EUR', '€', 'DE', 'german', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(5, 'Azerbaijan', 'AZ', 'AZN', '₼', 'AZ', 'azeri', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(6, 'Bangladesh', 'BD', 'BDT', '৳', 'BN ', 'Bengali', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(7, 'Bhutan', 'BT', 'BTN', 'Nu.', 'EN ', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(8, 'Brazil', 'BR', 'BRL', 'R$', 'PT', 'portuguese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(9, 'Canada', 'CA', 'CAD', 'C$', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(10, 'China', 'CN', 'CNY', '¥', 'ZH', 'chinese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(11, 'Egypt', 'EG', 'EGP', 'E£', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(12, 'France', 'FR', 'EUR', '€', 'FR', 'french', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(13, 'Germany', 'DE', 'EUR', '€', 'DE', 'german', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(14, 'India', 'IN', 'INR', '₹', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(15, 'Japan', 'JP', 'JPY', '¥', 'JA', 'japanese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(16, 'Malaysia', 'MY', 'MYR', 'RM', 'MS', 'malay', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(17, 'Mexico', 'MX', 'MXN', '$', 'ES', 'spanish', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(18, 'Nepal', 'NP', 'NPR', 'रू', 'NE', 'nepali', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(19, 'New Zealand', 'NZ', 'NZD', '$', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(20, 'Nigeria', 'NG', 'NGN', '₦', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(21, 'Oman', 'OM', 'OMR', 'ر.ع.', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(22, 'Pakistan', 'PK', 'PKR', 'Rs.', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(23, 'Portugal', 'PT', 'EUR', '€', 'PT', 'portuguese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(24, 'Qatar', 'QA', 'QAR', 'ر.ق', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(25, 'Saudi Arabia', 'SA', 'SAR', 'ر.س', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(26, 'Singapore', 'SG', 'SGD', 'S$', 'ZH', 'chinese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(27, 'South Africa', 'ZA', 'ZAR', 'R', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(28, 'Sri Lanka', 'LK', 'LKR', 'Rs.', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(29, 'United Arab Emirates', 'AE', 'AED', 'د.إ', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(30, 'United Kingdom', 'GB', 'GBP', '£', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(31, 'United States', 'US', 'USD', '$', 'EN', 'english', '2021-03-06 00:53:25', '2021-03-12 07:09:54'),
(32, 'Vietnam', 'VN', 'VND', '₫', 'VI', 'Vietnamese', '2021-03-06 00:53:25', '2021-03-06 00:53:25'),
(33, 'Yemen', 'YE', 'YER', '﷼', 'AR', 'arabic', '2021-03-06 00:53:25', '2021-03-06 00:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_18_101953_create_products_table', 1),
(5, '2020_04_18_132841_create_profiles_table', 1),
(6, '2020_04_24_084350_create_orders_table', 1),
(7, '2020_04_26_123151_create_reminders_table', 1),
(8, '2020_04_27_044831_create_newsletters_table', 1),
(9, '2020_09_28_115317_create_categories_table', 1),
(10, '2020_10_06_060841_create_brands_table', 1),
(11, '2020_10_06_061024_create_product_images_table', 1),
(12, '2020_10_06_061443_create_tags_table', 1),
(13, '2020_10_07_104409_create_payment_table', 1),
(14, '2020_10_12_075024_create_attributes_table', 1),
(15, '2020_10_12_075202_create_attribute_details_table', 1),
(17, '2020_10_29_183141_create_countries_table', 1),
(18, '2020_11_03_061822_create_product_descriptions_table', 1),
(19, '2020_11_03_062214_create_product_seos_table', 1),
(20, '2020_11_03_062527_create_product_discounts_table', 1),
(21, '2020_11_03_062928_create_product_inventories_table', 1),
(22, '2020_12_10_113548_create_category_product_table', 1),
(23, '2020_12_15_180102_create_order_details_table', 1),
(24, '2020_12_18_073803_create_wishlists_table', 1),
(25, '2021_04_12_083004_create_enquiries_table', 2),
(26, '2020_10_12_075345_create_product_attributes_table', 3);

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
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ship_to_different_address` tinyint(4) NOT NULL DEFAULT 0,
  `ship_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_zipcode` int(11) DEFAULT NULL,
  `ship_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT 1,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'COD',
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ORDERED',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `amount`, `phone`, `zipcode`, `address`, `country`, `ship_to_different_address`, `ship_phone`, `ship_zipcode`, `ship_address`, `ship_country`, `is_paid`, `payment_type`, `payment_id`, `order_status`, `note`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ankur test', 'test@gmail.com', '599', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 0, 'ONLINE', '1616056047', 'REJECTED', NULL, '2021-03-18 02:57:27', '2021-03-18 02:57:27'),
(2, 3, 'Ankur test', 'test@gmail.com', '258', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 0, 'ONLINE', '310007004158', 'REJECTED', NULL, '2021-03-18 03:05:42', '2021-03-18 03:05:57'),
(3, 3, 'Ankur test', 'test@gmail.com', '258', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 0, 'ONLINE', '310007004585', 'REJECTED', NULL, '2021-03-18 04:13:28', '2021-03-18 04:14:00'),
(4, 3, 'Ankur test', 'test@gmail.com', '129', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 1, 'ONLINE', '310007004605', 'ORDERED', NULL, '2021-03-18 04:16:05', '2021-03-18 04:16:21'),
(5, 3, 'Ankur test', 'test@gmail.com', '599', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 1, 'ONLINE', '310007005785', 'ORDERED', NULL, '2021-03-18 07:01:41', '2021-03-18 07:01:54'),
(6, 3, 'Ankur test', 'test@gmail.com', '599', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 1, 'COD', NULL, 'ORDERED', NULL, '2021-03-19 03:53:41', '2021-03-19 03:53:41'),
(7, 3, 'Ankur test', 'test@gmail.com', '2055', '8888888888', 789456, 'Somewhere, Raipur', 'in', 0, NULL, NULL, NULL, NULL, 1, 'ONLINE', 'pay_GoTWHPmSAmANjT', 'ORDERED', NULL, '2021-03-19 04:42:32', '2021-03-19 04:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(54, 59, '6', '3', '599', '2021-03-17 05:13:32', '2021-03-17 05:13:32'),
(55, 60, '7', '1', '129', '2021-03-17 05:14:13', '2021-03-17 05:14:13'),
(56, 61, '6', '1', '599', '2021-03-17 05:18:11', '2021-03-17 05:18:11'),
(57, 62, '6', '1', '599', '2021-03-17 05:21:32', '2021-03-17 05:21:32'),
(58, 62, '7', '2', '129', '2021-03-17 05:21:33', '2021-03-17 05:21:33'),
(59, 63, '7', '1', '129', '2021-03-17 06:40:26', '2021-03-17 06:40:26'),
(60, 64, '6', '1', '599', '2021-03-17 06:46:59', '2021-03-17 06:46:59'),
(61, 65, '6', '1', '599', '2021-03-17 06:58:35', '2021-03-17 06:58:35'),
(62, 1, '6', '1', '599', '2021-03-18 02:57:27', '2021-03-18 02:57:27'),
(63, 2, '7', '2', '129', '2021-03-18 03:05:42', '2021-03-18 03:05:42'),
(64, 3, '7', '2', '129', '2021-03-18 04:13:28', '2021-03-18 04:13:28'),
(65, 4, '7', '1', '129', '2021-03-18 04:16:05', '2021-03-18 04:16:05'),
(66, 5, '6', '1', '599', '2021-03-18 07:01:41', '2021-03-18 07:01:41'),
(67, 6, '6', '1', '599', '2021-03-19 03:53:41', '2021-03-19 03:53:41'),
(68, 7, '7', '2', '129', '2021-03-19 04:42:32', '2021-03-19 04:42:32'),
(69, 7, '6', '3', '599', '2021-03-19 04:42:32', '2021-03-19 04:42:32');

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
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_errors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hdfc_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hdfc_pay_mode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `vendor`, `payment_amount`, `vendor_order_id`, `vendor_payment_id`, `vendor_signature`, `vendor_errors`, `status`, `currency`, `hdfc_tracking_id`, `bank_ref_no`, `hdfc_pay_mode`, `created_at`, `updated_at`) VALUES
(38, '1', 'HDFC', '599', NULL, '1616056047', NULL, '', 'Aborted', 'INR', '1616056047', NULL, NULL, '2021-03-18 02:57:27', '2021-03-18 02:57:27'),
(39, '2', 'HDFC', '258', NULL, '310007004158', NULL, '', 'Aborted', 'INR', '310007004158', 'null', 'null', '2021-03-18 03:05:42', '2021-03-18 03:05:58'),
(40, '3', 'HDFC', '258', NULL, '310007004585', NULL, '', 'Failure', 'INR', '310007004585', '1616060622595', 'Net Banking', '2021-03-18 04:13:28', '2021-03-18 04:14:00'),
(41, '4', 'HDFC', '129', NULL, '310007004605', NULL, '', 'Success', 'INR', '310007004605', '1616060779971', 'Net Banking', '2021-03-18 04:16:05', '2021-03-18 04:16:21'),
(42, '5', 'HDFC', '599', NULL, '310007005785', NULL, '', 'Success', 'INR', '310007005785', '1616070710303', 'Net Banking', '2021-03-18 07:01:41', '2021-03-18 07:01:54'),
(43, '7', 'Razorpay', '2055', 'order_GoTWAZCwyFbkbB', 'pay_GoTWHPmSAmANjT', 'dd9cb77108dce88628aa7a24a9553c650ee978a4212460b71b62bdf4214df329', '', 'Success', 'INR', NULL, NULL, NULL, '2021-03-19 04:42:32', '2021-03-19 04:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_order_qty` smallint(6) NOT NULL DEFAULT 5,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_todays_deal` tinyint(4) NOT NULL DEFAULT 0,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `name`, `price`, `image`, `max_order_qty`, `is_featured`, `is_todays_deal`, `tags`, `url_slug`, `country_iso_code`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 1, 'Test product 1', '599', 'products/JnVvsC2wRj2IlmeRvEdxRe4YbxweVJ5ucLIppwMZ.jpeg', 3, 0, 0, '[\"Skin care\"]', 'test-product-1', 'IN', 1, '2021-03-13 00:51:04', '2021-03-13 00:51:04'),
(7, 1, 'Test product 2', '199', 'products/Vpo7J2eFifVBAOxYCDcr8NGI1Ircc4I0kpwObQWz.jpeg', 2, 0, 0, '[\"Skin care\"]', 'test-product-2', 'IN', 1, '2021-03-13 00:52:46', '2021-06-04 05:13:28'),
(11, 1, 'Attributer sand', '400', 'products/Ix6dt1H4YmPq8Dtpn7X0XHFEYxoXtcVPyxZhmblE.jpeg', 5, 0, 0, '[\"Skin care\"]', 'attributer-sand', 'IN', 1, '2021-06-19 01:30:31', '2021-06-19 04:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_id`, `attribute_detail_id`, `attribute_price`, `created_at`, `updated_at`) VALUES
(3, 8, 1, 4, 200, '2021-06-18 02:36:24', '2021-06-18 02:36:24'),
(4, 8, 1, 2, 300, '2021-06-18 02:36:24', '2021-06-18 02:36:24'),
(17, 10, 3, 7, 600, '2021-06-19 01:28:28', '2021-06-19 01:28:28'),
(18, 10, 3, 8, 650, '2021-06-19 01:28:28', '2021-06-19 01:28:28'),
(95, 11, 2, 5, 600, '2021-06-19 05:36:44', '2021-06-19 05:36:44'),
(96, 11, 2, 6, 1050, '2021-06-19 05:36:44', '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_descriptions`
--

CREATE TABLE `product_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `short_des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_descriptions`
--

INSERT INTO `product_descriptions` (`id`, `product_id`, `short_des`, `full_des`, `created_at`, `updated_at`) VALUES
(6, 6, 'it is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout', '<div class=\"PA-z\" style=\"margin-top: 16px; display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;\"><h5 style=\"padding: 0px 32px 0px 0px; margin-right: 8px; margin-bottom: 5px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; position: relative;\">Item Information</h5><p style=\"padding: 0px 32px 0px 0px; margin-right: 8px; margin-bottom: 5px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; position: relative;\"><br></p></div><div class=\"PA-z\" style=\"margin-top: 16px; display: flex; justify-content: space-between; align-items: baseline; flex-wrap: wrap;\"><p style=\"padding: 0px 32px 0px 0px; margin-right: 8px; margin-bottom: 5px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; position: relative;\"><br></p></div><div class=\"FA-z\" style=\"padding: 0px 0px 32px; position: relative; clear: left;\"><ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 24px;\"><li class=\"EA-z\" style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">The A/O Lug Chukka boot by will send your thoughts to the sea with its classic nautical details.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Waterproof leather upper.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Waterproof construction with full membrane protection to keep out the wet elements.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Genuine hand-sewn with true moccassin construction to ensure longevity of wear.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Cushioned footbed with EVA heel cup for enhanced shock absorption and supportive comfort.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Nonmarking, molded rubber cupsole with heavy lugs and Wave-Siping™ technology for the ultimate traction on both dry and wet surfaces.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Imported.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Product measurements were taken using size 9, width M (D). Please note that measurements may vary by size.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Weight of footwear is based on a single item, not a pair.</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Measurements:<ul style=\"list-style-type: disc; padding: 0px; margin-right: 0px; margin-left: 0px; line-height: 24px;\"><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Heel Height: 1 in</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Weight: 1 lb 1 oz</li><li style=\"list-style-type: disc; padding: 0px; margin: 0px 0px 6px 20px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal;\">Platform Height:&nbsp;<font color=\"#1f1f1f\" face=\"Open Sans, sans-serif\"><span style=\"font-size: 16px; letter-spacing: 0px;\">1</span></font>⁄2 in</li></ul></li></ul></div>', '2021-03-13 00:51:05', '2021-03-13 00:57:35'),
(7, 7, NULL, NULL, '2021-03-13 00:52:46', '2021-06-19 04:52:40'),
(8, 8, NULL, NULL, '2021-06-18 01:34:52', '2021-06-18 02:36:24'),
(9, 9, NULL, NULL, '2021-06-19 01:15:28', '2021-06-19 01:15:28'),
(10, 10, NULL, NULL, '2021-06-19 01:16:00', '2021-06-19 01:28:27'),
(11, 11, NULL, NULL, '2021-06-19 01:30:31', '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `has_discount` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_discounts`
--

INSERT INTO `product_discounts` (`id`, `product_id`, `has_discount`, `type`, `rate`, `new_price`, `created_at`, `updated_at`) VALUES
(6, 6, 0, '', '599', '599', '2021-03-13 00:51:04', '2021-03-13 00:57:35'),
(7, 7, 1, 'PERCENT', '9.75', '180', '2021-03-13 00:52:46', '2021-06-19 04:52:40'),
(8, 8, 0, '', '800', '800', '2021-06-18 01:34:52', '2021-06-18 02:36:24'),
(9, 9, 0, '', '440', '440', '2021-06-19 01:15:28', '2021-06-19 01:15:28'),
(10, 10, 0, '', '560', '560', '2021-06-19 01:16:00', '2021-06-19 01:28:27'),
(11, 11, 1, 'PERCENT', '5', '380', '2021-06-19 01:30:31', '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `img_src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `img_src`, `created_at`, `updated_at`) VALUES
(1, 6, 'products/2CggFtoUzQbqgbVr16gdI2JF9GnaAPMVsNLgTmnK.jpeg', NULL, NULL),
(2, 7, 'products/br9N3n20ComedcBkxgtX61YdmtAaxW3uXYIKXa7A.jpeg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventories`
--

CREATE TABLE `product_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_stock` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_inventories`
--

INSERT INTO `product_inventories` (`id`, `product_id`, `sku`, `in_stock`, `created_at`, `updated_at`) VALUES
(6, 6, NULL, 1, '2021-03-13 00:51:05', '2021-03-13 00:57:35'),
(7, 7, NULL, 1, '2021-03-13 00:52:47', '2021-06-19 04:52:40'),
(8, 8, NULL, 1, '2021-06-18 01:34:52', '2021-06-18 02:36:24'),
(9, 9, NULL, 1, '2021-06-19 01:15:28', '2021-06-19 01:15:28'),
(10, 10, NULL, 1, '2021-06-19 01:16:00', '2021-06-19 01:28:28'),
(11, 11, NULL, 1, '2021-06-19 01:30:31', '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_seos`
--

CREATE TABLE `product_seos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_seos`
--

INSERT INTO `product_seos` (`id`, `product_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(6, 6, 'Test product 1', NULL, '2021-03-13 00:51:05', '2021-03-13 00:57:35'),
(7, 7, 'Test product 2', NULL, '2021-03-13 00:52:46', '2021-06-19 04:52:40'),
(8, 8, 'Attr test', NULL, '2021-06-18 01:34:52', '2021-06-18 02:36:24'),
(9, 9, 'No attr', NULL, '2021-06-19 01:15:28', '2021-06-19 01:15:28'),
(10, 10, 'With attr', NULL, '2021-06-19 01:16:00', '2021-06-19 01:28:28'),
(11, 11, 'W/O attr', NULL, '2021-06-19 01:30:31', '2021-06-19 05:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phonenumber` bigint(20) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `phonenumber`, `address`, `zipcode`, `created_at`, `updated_at`) VALUES
(1, 1, 11151552928, 'Buangkok Green,\r\n12-4a,\r\nBangkok', 42132, NULL, '2021-03-10 02:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reminder` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `reminder`, `created_at`, `updated_at`) VALUES
(1, 'Type Something', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`, `country_iso_code`, `created_at`, `updated_at`) VALUES
(3, 'Skin care', 'IN', '2021-03-13 00:51:05', '2021-03-13 00:51:05');

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
  `country_iso_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'IN',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `country_iso_code`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$HzenwZltlCi1wOaQJaGQYOqTjdG3qZRYFhg7UyjCvHwkLr7XK6pkG', 'Admin', 'IN', 1, 'mKSekTTMvfLBfzJOlcjNnXgQ2h1BVLG08vpWenA22D7L3PZ9MDOXxNltXTFv', NULL, '2021-06-03 02:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_details`
--
ALTER TABLE `attribute_details`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_country_iso_code_unique` (`country_iso_code`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
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
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
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
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_descriptions`
--
ALTER TABLE `product_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_inventories`
--
ALTER TABLE `product_inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_seos`
--
ALTER TABLE `product_seos`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_details`
--
ALTER TABLE `attribute_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product_descriptions`
--
ALTER TABLE `product_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_inventories`
--
ALTER TABLE `product_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_seos`
--
ALTER TABLE `product_seos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
