-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 08:18 AM
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
(6, 'BhuKyra', 'brands/kjXtSfUtbfI288MCnMUzD8hFoXw0FdNQY46fcjPP.jpeg', 'AU', '2021-01-02 05:23:44', '2021-01-02 05:23:44'),
(7, 'BhuKyra', 'brands/kjXtSfUtbfI288MCnMUzD8hFoXw0FdNQY46fcjPP.jpeg', 'CA', '2021-01-02 05:23:44', '2021-01-02 05:23:44'),
(8, 'BhuKyra', 'brands/kjXtSfUtbfI288MCnMUzD8hFoXw0FdNQY46fcjPP.jpeg', 'IN', '2021-01-02 05:23:44', '2021-01-02 05:23:44'),
(9, 'BhuKyra', 'brands/kjXtSfUtbfI288MCnMUzD8hFoXw0FdNQY46fcjPP.jpeg', 'US', '2021-01-02 05:23:44', '2021-01-02 05:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
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
(10, '0', 'Agro', 'AU', 'categories/3cLAcx3jpVsoRZrQmTLeeknsgmiGamj2nAnI3sBf.jpeg', 'agro', NULL, '2021-01-02 05:17:49', '2021-01-02 05:17:49'),
(11, '0', 'Agro', 'CA', 'categories/3cLAcx3jpVsoRZrQmTLeeknsgmiGamj2nAnI3sBf.jpeg', 'agro', NULL, '2021-01-02 05:17:49', '2021-01-02 05:17:49'),
(12, '0', 'Agro', 'IN', 'categories/3cLAcx3jpVsoRZrQmTLeeknsgmiGamj2nAnI3sBf.jpeg', 'agro', NULL, '2021-01-02 05:17:49', '2021-01-02 05:17:49'),
(13, '0', 'Agro', 'US', 'categories/3cLAcx3jpVsoRZrQmTLeeknsgmiGamj2nAnI3sBf.jpeg', 'agro', NULL, '2021-01-02 05:17:49', '2021-01-02 05:17:49');

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
(1, 1, 1, '2021-01-02 00:45:01', '2021-01-02 00:45:01'),
(2, 2, 2, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(3, 2, 3, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(6, 2, 4, NULL, '2021-01-02 02:16:05'),
(7, 10, 5, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(8, 11, 5, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(9, 12, 5, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(10, 13, 5, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(11, 10, 6, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(12, 11, 6, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(13, 12, 6, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(14, 13, 6, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(15, 10, 7, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(16, 11, 7, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(17, 12, 7, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(18, 13, 7, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(19, 10, 8, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(20, 11, 8, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(21, 12, 8, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(22, 13, 8, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(24, 12, 10, '2021-01-02 06:04:18', '2021-01-02 06:04:18'),
(27, 12, 11, NULL, '2021-01-02 06:32:52'),
(29, 11, 9, NULL, '2021-01-04 05:19:52');

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
(1, 'Afghanistan', 'AF', 'AFN', '؋', 'FA', 'farsi', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(2, 'Argentina', 'AR', 'ARS', '$', 'ES', 'spanish', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(3, 'Australia', 'AU', 'AUD', 'A$', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(4, 'Austria', 'AT', 'EUR', '€', 'DE', 'german', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(5, 'Azerbaijan', 'AZ', 'AZN', '₼', 'AZ', 'azeri', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(6, 'Bangladesh', 'BD', 'BDT', '৳', 'BN ', 'Bengali', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(7, 'Bhutan', 'BT', 'BTN', 'Nu.', 'EN ', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(8, 'Brazil', 'BR', 'BRL', 'R$', 'PT', 'portuguese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(9, 'Canada', 'CA', 'CAD', 'C$', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(10, 'China', 'CN', 'CNY', '¥', 'ZH', 'chinese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(11, 'Egypt', 'EG', 'EGP', 'E£', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(12, 'France', 'FR', 'EUR', '€', 'FR', 'french', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(13, 'Germany', 'DE', 'EUR', '€', 'DE', 'german', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(14, 'India', 'IN', 'INR', 'Rs.', 'EN', 'english', '2020-12-31 05:49:35', '2021-01-04 07:00:27'),
(15, 'Japan', 'JP', 'JPY', '¥', 'JA', 'japanese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(16, 'Malaysia', 'MY', 'MYR', 'RM', 'MS', 'malay', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(17, 'Mexico', 'MX', 'MXN', '$', 'ES', 'spanish', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(18, 'Nepal', 'NP', 'NPR', 'रू', 'NE', 'nepali', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(19, 'New Zealand', 'NZ', 'NZD', '$', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(20, 'Nigeria', 'NG', 'NGN', '₦', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(21, 'Oman', 'OM', 'OMR', 'ر.ع.', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(22, 'Pakistan', 'PK', 'PKR', 'Rs.', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(23, 'Portugal', 'PT', 'EUR', '€', 'PT', 'portuguese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(24, 'Qatar', 'QA', 'QAR', 'ر.ق', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(25, 'Saudi Arabia', 'SA', 'SAR', 'ر.س', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(26, 'Singapore', 'SG', 'SGD', 'S$', 'ZH', 'chinese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(27, 'South Africa', 'ZA', 'ZAR', 'R', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(28, 'Sri Lanka', 'LK', 'LKR', 'Rs.', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(29, 'United Arab Emirates', 'AE', 'AED', 'د.إ', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(30, 'United Kingdom', 'GB', 'GBP', '£', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(31, 'United States', 'US', 'USD', '$', 'EN', 'english', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(32, 'Vietnam', 'VN', 'VND', '₫', 'VI', 'Vietnamese', '2020-12-31 05:49:35', '2020-12-31 05:49:35'),
(33, 'Yemen', 'YE', 'YER', '﷼', 'AR', 'arabic', '2020-12-31 05:49:35', '2020-12-31 05:49:35');

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
(28, '2014_10_12_000000_create_users_table', 1),
(29, '2014_10_12_100000_create_password_resets_table', 1),
(30, '2019_08_19_000000_create_failed_jobs_table', 1),
(31, '2020_04_18_101953_create_products_table', 1),
(32, '2020_04_18_132841_create_profiles_table', 1),
(33, '2020_04_24_084350_create_orders_table', 1),
(34, '2020_04_26_123151_create_reminders_table', 1),
(35, '2020_04_27_044831_create_newsletters_table', 1),
(36, '2020_09_28_115317_create_categories_table', 1),
(37, '2020_10_06_060841_create_brands_table', 1),
(38, '2020_10_06_061024_create_product_images_table', 1),
(39, '2020_10_06_061443_create_tags_table', 1),
(40, '2020_10_07_104409_create_payment_table', 1),
(41, '2020_10_12_075024_create_attributes_table', 1),
(42, '2020_10_12_075202_create_attribute_details_table', 1),
(43, '2020_10_12_075345_create_product_attributes_table', 1),
(44, '2020_10_29_183141_create_countries_table', 1),
(45, '2020_11_03_061822_create_product_descriptions_table', 1),
(46, '2020_11_03_062214_create_product_seos_table', 1),
(47, '2020_11_03_062527_create_product_discounts_table', 1),
(48, '2020_11_03_062928_create_product_inventories_table', 1),
(49, '2020_12_10_113548_create_category_product_table', 1),
(50, '2020_12_15_180102_create_order_details_table', 1),
(51, '2020_12_18_073803_create_wishlists_table', 1);

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
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
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
(9, 8, 'Chyavanprash CA', 250, 'products/CQaNz1nCrR5ysWv3kGLgpucyLFuUKIO1ZoTAz34E.jpeg', 3, 0, 0, '[\"health\",\"chyanprash\"]', 'chyavanprash-ca', 'DE', 1, '2021-01-02 06:04:18', '2021-01-04 05:00:18'),
(10, 8, 'Chyavanprash', 250, 'products/CQaNz1nCrR5ysWv3kGLgpucyLFuUKIO1ZoTAz34E.jpeg', 3, 0, 0, '[\"health\",\"chyanprash\"]', 'chyavanprash', 'IN', 1, '2021-01-02 06:04:18', '2021-01-02 06:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_id` bigint(20) UNSIGNED DEFAULT NULL,
  `attribute_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, NULL, NULL, '2021-01-02 00:45:01', '2021-01-02 00:45:01'),
(2, 2, NULL, NULL, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(3, 3, NULL, NULL, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(4, 4, NULL, NULL, '2021-01-02 01:53:37', '2021-01-02 02:16:05'),
(5, 5, NULL, NULL, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(6, 6, NULL, NULL, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(7, 7, NULL, NULL, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(8, 8, NULL, NULL, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(9, 9, NULL, NULL, '2021-01-02 06:04:18', '2021-01-04 05:19:53'),
(10, 10, NULL, NULL, '2021-01-02 06:04:18', '2021-01-02 06:04:18'),
(11, 11, NULL, NULL, '2021-01-02 06:04:19', '2021-01-02 06:32:52');

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
(1, 1, 0, '', '500', '500', '2021-01-02 00:45:01', '2021-01-02 00:45:01'),
(2, 2, 0, '', '199', '199', '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(3, 3, 0, '', '199', '199', '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(4, 4, 0, '', '199', '199', '2021-01-02 01:53:37', '2021-01-02 02:16:05'),
(5, 5, 0, '', '500', '500', '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(6, 6, 0, '', '500', '500', '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(7, 7, 0, '', '500', '500', '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(8, 8, 0, '', '500', '500', '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(9, 9, 0, '', '250', '250', '2021-01-02 06:04:18', '2021-01-04 05:19:52'),
(10, 10, 0, '', '250', '250', '2021-01-02 06:04:18', '2021-01-02 06:04:18'),
(11, 11, 0, '', '250', '250', '2021-01-02 06:04:19', '2021-01-02 06:32:52');

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
(1, 1, NULL, 1, '2021-01-02 00:45:01', '2021-01-02 00:45:01'),
(2, 2, NULL, 1, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(3, 3, NULL, 1, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(4, 4, NULL, 1, '2021-01-02 01:53:37', '2021-01-02 02:16:05'),
(5, 5, NULL, 1, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(6, 6, NULL, 1, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(7, 7, NULL, 1, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(8, 8, NULL, 1, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(9, 9, NULL, 1, '2021-01-02 06:04:18', '2021-01-04 05:19:53'),
(10, 10, NULL, 1, '2021-01-02 06:04:19', '2021-01-02 06:04:19'),
(11, 11, NULL, 1, '2021-01-02 06:04:19', '2021-01-02 06:32:52');

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
(1, 1, 'New', NULL, '2021-01-02 00:45:01', '2021-01-02 00:45:01'),
(2, 2, 'Jelly', NULL, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(3, 3, 'Jelly', NULL, '2021-01-02 01:53:36', '2021-01-02 01:53:36'),
(4, 4, 'Jelly', NULL, '2021-01-02 01:53:37', '2021-01-02 02:16:05'),
(5, 5, 'Test', NULL, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(6, 6, 'Test', NULL, '2021-01-02 05:26:26', '2021-01-02 05:26:26'),
(7, 7, 'Test', NULL, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(8, 8, 'Test', NULL, '2021-01-02 05:26:27', '2021-01-02 05:26:27'),
(9, 9, 'Chyavanprash', NULL, '2021-01-02 06:04:18', '2021-01-04 05:19:53'),
(10, 10, 'Chyavanprash', NULL, '2021-01-02 06:04:18', '2021-01-02 06:04:18'),
(11, 11, 'Chyavanprash', NULL, '2021-01-02 06:04:19', '2021-01-02 06:32:52');

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
(1, 1, 11151552928, 'Buangkok Green 512-4a', 42132, NULL, NULL),
(2, 2, 8215551234, 'Danau Toba', 27321, NULL, NULL);

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
(44, 'health', 'IN', '2021-01-02 06:04:18', '2021-01-02 06:04:18'),
(45, 'chyanprash', 'IN', '2021-01-02 06:04:18', '2021-01-02 06:04:18');

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
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$jYdaQxQYkosRXM8IaedTqe9kGLM3fGk/KMtZDyraIKLwe1Mr1IxVG', 'Admin', '0', 1, NULL, NULL, NULL),
(2, 'Dawn Roe', 'user@gmail.com', NULL, '$2y$10$WzJQd7lguqX4bQLp3NVeJetTrFtlXCkLyUlxRoNb9k7WSycrz9Tw6', 'Customer', 'IN', 1, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_details`
--
ALTER TABLE `attribute_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
