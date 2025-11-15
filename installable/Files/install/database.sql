-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2025 at 02:14 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `viserhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `email`, `username`, `email_verified_at`, `image`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'Super Admin', 'admin@site.com', 'admin', NULL, NULL, '$2y$12$HZoSH3ehSLA3qbeEAH6bKerANv3vxWmx6vIOvnIHFauQ1brqBTXEG', 'SMlw5KCSM1YtYXhesZFmTRlWGTb15FuBhje2tzjnUSDWOXfFr5hgbSpZ41so', 1, NULL, '2024-06-11 01:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `click_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE `admin_password_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applied_coupons`
--

CREATE TABLE `applied_coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `coupon_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bed_types`
--

CREATE TABLE `bed_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booked_rooms`
--

CREATE TABLE `booked_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_type_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booked_for` date DEFAULT NULL,
  `fare` decimal(28,8) DEFAULT NULL,
  `tax_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '1= success/active; 3 = cancelled; 9 = checked Out',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `booking_number` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `booking_info` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `tax_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `booking_fare` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'Total of room * nights fare ',
  `service_cost` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `extra_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `extra_charge_subtracted` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `paid_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `refunded_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `key_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0' COMMENT '1= success/active; 3 = cancelled; 9 = checked Out',
  `checked_in_at` datetime DEFAULT NULL,
  `checked_out_at` datetime DEFAULT NULL,
  `coupon_amount` decimal(28,8) DEFAULT NULL,
  `coupon_id` int UNSIGNED DEFAULT NULL,
  `guest_id` int UNSIGNED DEFAULT NULL,
  `total_adult` int DEFAULT NULL,
  `total_child` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_action_histories`
--

CREATE TABLE `booking_action_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `remark` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `guest_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booking_info` text COLLATE utf8mb4_unicode_ci,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `coupon_id` int UNSIGNED DEFAULT NULL,
  `coupon_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `tax_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `total_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `total_adult` int NOT NULL DEFAULT '0',
  `total_child` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending,\r\n1 = approved,\r\n3 = cancelled; ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `session_uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_type_id` int DEFAULT NULL,
  `quantity` int DEFAULT '0',
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `adult` int NOT NULL DEFAULT '0',
  `children` int NOT NULL DEFAULT '0',
  `fare` decimal(28,8) NOT NULL DEFAULT '0.00000000' COMMENT 'after discount',
  `total_fare` int NOT NULL COMMENT 'quantity * fare * number of days',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `coupon_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=fixed, 2=percent',
  `coupon_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `minimum_spend` decimal(28,8) DEFAULT NULL,
  `maximum_spend` decimal(28,8) DEFAULT NULL,
  `usage_limit_per_coupon` int DEFAULT NULL,
  `usage_limit_per_user` int DEFAULT NULL,
  `exclude_sale_items` tinyint NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_room_type`
--

CREATE TABLE `coupon_room_type` (
  `id` bigint NOT NULL,
  `coupon_id` int DEFAULT NULL,
  `room_type_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booking_id` int DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `method_code` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `method_currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `final_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `btc_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btc_wallet` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trx` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_try` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>success, 2=>pending, 3=>cancel',
  `from_api` tinyint(1) NOT NULL DEFAULT '0',
  `is_web` tinyint(1) NOT NULL DEFAULT '0' COMMENT ' This will be 1 if the request is from NextJs application',
  `admin_feedback` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_cron` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `is_app` tinyint(1) NOT NULL DEFAULT '0',
  `token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `script` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'object',
  `support` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'help section',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extensions`
--

INSERT INTO `extensions` (`id`, `act`, `name`, `description`, `image`, `script`, `shortcode`, `support`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'tawk-chat', 'Tawk.to', 'Key location is shown bellow', 'tawky_big.png', '<script>\r\n                        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n                        (function(){\r\n                        var s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\n                        s1.async=true;\r\n                        s1.src=\"https://embed.tawk.to/{{app_key}}\";\r\n                        s1.charset=\"UTF-8\";\r\n                        s1.setAttribute(\"crossorigin\",\"*\");\r\n                        s0.parentNode.insertBefore(s1,s0);\r\n                        })();\r\n                    </script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"------\"}}', 'twak.png', 0, NULL, '2019-10-18 17:16:05', '2022-03-21 23:22:24'),
(2, 'google-recaptcha2', 'Google Recaptcha 2', 'Key location is shown bellow', 'recaptcha3.png', '\n<script src=\"https://www.google.com/recaptcha/api.js\"></script>\n<div class=\"g-recaptcha\" data-sitekey=\"{{site_key}}\" data-callback=\"verifyCaptcha\"></div>\n<div id=\"g-recaptcha-error\"></div>', '{\"site_key\":{\"title\":\"Site Key\",\"value\":\"6LdPC88fAAAAADQlUf_DV6Hrvgm-pZuLJFSLDOWV\"},\"secret_key\":{\"title\":\"Secret Key\",\"value\":\"6LdPC88fAAAAAG5SVaRYDnV2NpCrptLg2XLYKRKB\"}}', 'recaptcha.png', 0, NULL, '2019-10-18 17:16:05', '2024-06-02 04:30:37'),
(3, 'custom-captcha', 'Custom Captcha', 'Just put any random string', 'customcaptcha.png', NULL, '{\"random_key\":{\"title\":\"Random String\",\"value\":\"SecureString\"}}', 'na', 0, NULL, '2019-10-18 17:16:05', '2024-05-23 06:23:39'),
(4, 'google-analytics', 'Google Analytics', 'Key location is shown bellow', 'google_analytics.png', '<script async src=\"https://www.googletagmanager.com/gtag/js?id={{measurement_id}}\"></script>\n                <script>\n                  window.dataLayer = window.dataLayer || [];\n                  function gtag(){dataLayer.push(arguments);}\n                  gtag(\"js\", new Date());\n                \n                  gtag(\"config\", \"{{measurement_id}}\");\n                </script>', '{\"measurement_id\":{\"title\":\"Measurement ID\",\"value\":\"------\"}}', 'ganalytics.png', 0, NULL, NULL, '2021-05-04 04:19:12'),
(5, 'fb-comment', 'Facebook Comment ', 'Key location is shown bellow', 'Facebook.png', '<div id=\"fb-root\"></div><script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v4.0&appId={{app_key}}&autoLogAppEvents=1\"></script>', '{\"app_key\":{\"title\":\"App Key\",\"value\":\"----\"}}', 'fb_com.png', 0, NULL, NULL, '2022-03-21 23:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontends`
--

CREATE TABLE `frontends` (
  `id` bigint UNSIGNED NOT NULL,
  `data_keys` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frontends`
--

INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"hotel\",\"booking\",\"room booking\",\"reservation\",\"room reservation\",\"hotel booking\",\"night\",\"day\",\"premium\",\"royal\"],\"description\":\"ViserHotel - Ultimate hotel booking solution.\",\"social_title\":\"Viserlab Limited\",\"social_description\":\"ViserHotel - Ultimate hotel booking solution.\",\"image\":\"6668271ed415e1718101790.png\"}', NULL, 'basic', '', '2020-07-04 23:42:52', '2024-06-11 04:29:51'),
(24, 'about.content', '{\"has_image\":\"1\",\"heading\":\"Welcome and Relax at Our Hotel\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"description\":\"posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet nonummy id, imperdiet ugiat pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo plentesque facilisis. Etiam imperdiet imperdiet orci.\\u00a0<div><br \\/><\\/div><div>Nunc nec neque.\\r\\nposuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis ve\\r\\n\\r\\nposuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nuncnc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ueros nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet nonummy id, imperdiet ugiat pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo plentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque.<\\/div>\",\"image_1\":\"664f2c3b83f241716464699.jpg\",\"image_2\":\"664f2c3b8938e1716464699.jpg\",\"image_3\":\"664f2c3b8b1a21716464699.jpg\",\"image_4\":\"664f2c3b8cf561716464699.jpg\"}', NULL, 'basic', '', '2020-10-28 00:51:20', '2024-05-23 05:44:59'),
(25, 'blog.content', '{\"heading\":\"Latest Blog Post\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\"}', NULL, 'basic', NULL, '2020-10-28 00:51:34', '2022-04-05 14:00:44'),
(26, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Retailers are hopping to see a rise in demand\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f3013d823e1716465683.jpg\"}', NULL, 'basic', 'retailers-are-hopping-to-see-a-rise-in-demand', '2020-10-28 00:57:19', '2024-05-23 06:01:24'),
(27, 'contact_us.content', '{\"has_image\":\"1\",\"title\":\"Get In Touch With Us\",\"short_details\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis.\",\"email_address\":\"viserhotel@gmail.com\",\"contact_number\":\"123 - 4567890\",\"latitude\":\"5555h\",\"longitude\":\"5555s\",\"address\":\"15205 North Kierland Blvd.\",\"image\":\"664f34825dcdf1716466818.jpg\"}', NULL, 'basic', '', '2020-10-28 00:59:19', '2024-05-23 06:20:19'),
(28, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', NULL, 'basic', NULL, '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(31, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"fab fa-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 'basic', '', '2020-11-12 04:07:30', '2024-06-11 04:34:01'),
(33, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', NULL, 'basic', NULL, '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(34, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', NULL, 'basic', NULL, '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(36, 'service.content', '{\"has_image\":\"1\",\"heading\":\"Our Hotel services\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"video_url\":\"https:\\/\\/www.youtube.com\\/embed\\/WOb4cj7izpE\",\"video_thumb\":\"664f2c6732f171716464743.jpg\"}', NULL, 'basic', '', '2021-03-06 01:27:34', '2024-05-23 05:45:43'),
(39, 'banner.content', '{\"heading\":\"SPEND YOUR BEAUTIFUL MOMENT\",\"has_image\":\"1\",\"banner_image\":\"664f2bf0345141716464624.jpg\",\"breadcrumb_image\":\"664f2bf05fc551716464624.jpg\"}', NULL, 'basic', '', '2021-05-02 06:09:30', '2024-05-23 05:43:44'),
(41, 'cookie.data', '{\"short_desc\":\"We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure.\",\"description\":\"<div><h3>What information do we collect?<\\/h3><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br><\\/p><\\/div><div><h3>How do we protect your information?<\\/h3><p>All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br><\\/p><\\/div><div><h3>Do we disclose any information to outside parties?<\\/h3><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or well being.<\\/p><p><br><\\/p><\\/div><div><h3>Children\'s Online Privacy Protection Act Compliance<\\/h3><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br><\\/p><\\/div><div><h3>Changes to our Privacy Policy<\\/h3><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br><\\/p><\\/div><div><h3>How long we retain your information?<\\/h3><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br><\\/p><\\/div><div><h3>What we don\\u2019t do with your data<\\/h3><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', NULL, 'basic', NULL, '2020-07-04 23:42:52', '2024-06-11 04:52:15'),
(42, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div><h3>What information do we collect?<\\/h3><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br \\/><\\/p><\\/div><div><h3>How do we protect your information?<\\/h3><p>All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br \\/><\\/p><\\/div><div><h3>Do we disclose any information to outside parties?<\\/h3><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or well being.<\\/p><p><br \\/><\\/p><\\/div><div><h3>Children\'s Online Privacy Protection Act Compliance<\\/h3><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br \\/><\\/p><\\/div><div><h3>Changes to our Privacy Policy<\\/h3><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br \\/><\\/p><\\/div><div><h3>How long we retain your information?<\\/h3><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br \\/><\\/p><\\/div><div><h3>What we don\\u2019t do with your data<\\/h3><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\"}', NULL, 'basic', 'privacy-policy', '2021-06-09 08:50:42', '2024-06-11 04:49:35'),
(43, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div>\\r\\n    <p>We claim all authority to dismiss, end,\\r\\n        or handicap any help with or without cause per administrator discretion. This is a Complete independent\\r\\n        facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by\\r\\n        submitting solicitations or protests we will impair your record. The solitary time you should reach us about the\\r\\n        seaward facilitating is if there is an issue with the worker. We have not many substance limitations and\\r\\n        everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything\\r\\n        contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time\\r\\n        by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Configuration requests - If you have a fully\\r\\n            managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs,\\r\\n            DNS, and httpd configurations.<\\/li>\\r\\n        <li>Software requests - Cpanel Extension Installation\\r\\n            will be granted as long as it does not interfere with the security, stability, and performance of other\\r\\n            users on the server.<\\/li>\\r\\n        <li>Emergency Support - We do not provide emergency\\r\\n            support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li>\\r\\n        <li>Webmaster help - We do not offer any support for\\r\\n            webmaster related issues and difficulty including coding, & installs, Error solving. if there is an\\r\\n            issue where a library or configuration of the server then we can help you if it\'s possible from our end.\\r\\n        <\\/li>\\r\\n        <li>Backups - We keep backups but we are not\\r\\n            responsible for data loss, you are fully responsible for all backups.<\\/li>\\r\\n        <li>We Don\'t support any child porn or such material.\\r\\n        <\\/li>\\r\\n        <li>No spam-related sites or material, such as email\\r\\n            lists, mass mail programs, and scripts, etc.<\\/li>\\r\\n        <li>No harassing material that may cause people to\\r\\n            retaliate against you.<\\/li>\\r\\n        <li>No phishing pages.<\\/li>\\r\\n        <li>You may not run any exploitation script from the\\r\\n            server. reason can be terminated immediately.<\\/li>\\r\\n        <li>If Anyone attempting to hack or exploit the server\\r\\n            by using your script or hosting, we will terminate your account to keep safe other users.<\\/li>\\r\\n        <li>Malicious Botnets are strictly forbidden.<\\/li>\\r\\n        <li>Spam, mass mailing, or email marketing in any way\\r\\n            are strictly forbidden here.<\\/li>\\r\\n        <li>Malicious hacking materials, trojans, viruses,\\r\\n            & malicious bots running or for download are forbidden.<\\/li>\\r\\n        <li>Resource and cronjob abuse is forbidden and will\\r\\n            result in suspension or termination.<\\/li>\\r\\n        <li>Php\\/CGI proxies are strictly forbidden.<\\/li>\\r\\n        <li>CGI-IRC is strictly forbidden.<\\/li>\\r\\n        <li>No fake or disposal mailers, mass mailing, mail\\r\\n            bombers, SMS bombers, etc.<\\/li>\\r\\n        <li>NO CREDIT OR REFUND will be granted for\\r\\n            interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Terms\\r\\n        & Conditions for Users<\\/h3>\\r\\n    <p>Before getting to this site, you are\\r\\n        consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and\\r\\n        guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you\\r\\n        disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Support\\r\\n    <\\/h3>\\r\\n    <p>Whenever you have downloaded our item,\\r\\n        you may get in touch with us for help through email and we will give a valiant effort to determine your issue.\\r\\n        We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center\\r\\n        bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and\\r\\n        Livechat.<\\/p>\\r\\n    <p>On the off chance\\r\\n        that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p>\\r\\n    <ul>\\r\\n        <li>Hang tight for additional update discharge.<\\/li>\\r\\n        <li>Or on the other hand, enlist a specialist (We offer\\r\\n            customization for extra charges).<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Ownership<\\/h3>\\r\\n    <p>You may not guarantee scholarly or\\r\\n        selective possession of any of our items, altered or unmodified. All items are property, we created them. Our\\r\\n        items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no\\r\\n        occasion will our juridical individual be subject to any harms including, however not restricted to, immediate,\\r\\n        roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the\\r\\n        utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Warranty\\r\\n    <\\/h3>\\r\\n    <p>We don\'t offer any guarantee or\\r\\n        assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with\\r\\n        all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show\\r\\n        formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component,\\r\\n        as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Unauthorized\\/Illegal Usage<\\/h3>\\r\\n    <p>You may not utilize our things for any\\r\\n        illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale\\r\\n        (counting yet not restricted to copyright laws) just as the laws of your nation and International law.\\r\\n        Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality,\\r\\n        illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming\\r\\n        joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of\\r\\n        the offered on our things, or admittance to the administration without the express composed consent by us or\\r\\n        item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement\\r\\n        that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we\\r\\n        will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for\\r\\n        keeping up the security of your record, and you are completely answerable for all exercises that happen under\\r\\n        the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved\\r\\n        employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Fiverr,\\r\\n        Seoclerks Sellers Or Affiliates<\\/h3>\\r\\n    <p>We do NOT ensure full SEO campaign\\r\\n        conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment\\r\\n        to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of\\r\\n        assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires\\r\\n        time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>\\r\\n        Payment\\/Refund Policy<\\/h3>\\r\\n    <p>No refund or cash back will be made.\\r\\n        After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on\\r\\n        requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t\\r\\n        document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or\\r\\n        chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you\\r\\n        from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your\\r\\n        record. There are no special cases.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h3>Free\\r\\n        Balance \\/ Coupon Policy<\\/h3>\\r\\n    <p>We offer numerous approaches to get FREE\\r\\n        Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your\\r\\n        record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free\\r\\n        Balance from your record balance, and your record balance becomes negative, at that point the record will\\r\\n        naturally be suspended. If your record is suspended because of a negative Balance you can request to make a\\r\\n        custom payment to settle your equilibrium to actuate your record.<\\/p>\\r\\n<\\/div>\"}', NULL, 'basic', 'terms-of-service', '2021-06-09 08:51:18', '2024-06-11 04:48:05'),
(44, 'topnav.content', '{\"email\":\"viserhotel@gmail.com\",\"telephone\":\"123 - 4567890\"}', NULL, 'basic', NULL, '2022-04-04 05:46:37', '2022-04-04 05:57:05'),
(45, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fab fa-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', NULL, 'basic', NULL, '2022-04-04 05:47:23', '2022-04-04 05:47:46'),
(46, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'basic', NULL, '2022-04-04 05:48:22', '2022-04-04 05:48:22'),
(47, 'social_icon.element', '{\"title\":\"LinkedIn\",\"social_icon\":\"<i class=\\\"fab fa-linkedin-in\\\"><\\/i>\",\"url\":\"https:\\/\\/www.linkedin.com\\/\"}', NULL, 'basic', NULL, '2022-04-04 05:49:00', '2022-04-04 05:49:00'),
(48, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Country is rapidly recovering from the impacts\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2ffd1a2b61716465661.jpg\"}', NULL, 'basic', 'country-is-rapidly-recovering-from-the-impacts', '2022-04-04 10:07:25', '2024-05-23 06:01:01'),
(49, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Il passaggio standard del Lorem Ipsum, utilizzato sin dal sedicesimo secolo\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\"><\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;font-weight:400;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h3 style=\\\"margin-top:15px;margin-bottom:15px;padding:0px;font-weight:700;font-size:14px;color:rgb(0,0,0);font-family:\'Open Sans\', Arial, sans-serif;\\\"><\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;font-weight:400;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2fe3a0e861716465635.jpg\"}', NULL, 'basic', 'il-passaggio-standard-del-lorem-ipsum-utilizzato-sin-dal-sedicesimo-secolo', '2022-04-05 07:43:11', '2024-05-23 06:00:35'),
(50, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Traduzione del 1914 di H. Rackham\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2fbf12db41716465599.jpg\"}', NULL, 'basic', 'traduzione-del-1914-di-h-rackham', '2022-04-05 07:43:37', '2024-05-23 05:59:59'),
(51, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"La sezione 1.10.33 del \\\"de Finibus Bonorum et Malorum\\\", scritto da Cicerone nel 45 AC\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2fa24bf4e1716465570.jpg\"}', NULL, 'basic', 'la-sezione-11033-del-de-finibus-bonorum-et-malorum-scritto-da-cicerone-nel-45-ac', '2022-04-05 07:44:01', '2024-05-23 05:59:30'),
(52, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Al contrario di quanto si pensi,  LoClintock\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2f7a038ec1716465530.jpg\"}', NULL, 'basic', 'al-contrario-di-quanto-si-pensi-loclintock', '2022-04-05 07:45:25', '2024-05-23 05:58:50'),
(53, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"\\u00c8 universalmente riconosciuto che un lettore che osserva il layout di una pagina viene distratto dal contenuto testuale\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><\\/div><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><h2 style=\\\"margin-bottom:10px;padding:0px;font-family:DauphinPlain;font-size:24px;line-height:24px;color:rgb(0,0,0);\\\"><\\/h2><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"font-size:16px;color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2d7029cf01716465008.jpg\"}', NULL, 'basic', 'e-universalmente-riconosciuto-che-un-lettore-che-osserva-il-layout-di-una-pagina-viene-distratto-dal-contenuto-testuale', '2022-04-05 07:50:57', '2024-05-23 05:50:08'),
(54, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The standard Lorem Ipsum passage\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2d58e617d1716464984.jpg\"}', NULL, 'basic', 'the-standard-lorem-ipsum-passage', '2022-04-05 07:52:10', '2024-05-23 05:49:45');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(55, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The consumers who did not spend\",\"description\":\"<h3 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.5rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Curabitur a felis in nunc fringilla tristique abot escrow.<\\/h3><div class=\\\"mt-4 contact-section__content-text\\\" style=\\\"color:rgb(0,42,71);font-family:Roboto, sans-serif;\\\"><p class=\\\"mt-4 contact-section__content-text\\\" style=\\\"margin-bottom:1.5rem;margin-right:0px;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui maosuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. fringilla tstique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem.<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><h4 style=\\\"margin-top:1.5rem;margin-bottom:1rem;font-weight:600;line-height:1.15;font-size:1.375rem;font-family:\'Josefin Sans\', sans-serif;color:rgb(0,42,71);\\\">Maecenas Dempuget condimentum rhoncus<\\/h4><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,<\\/p><p class=\\\"contact-section__content-text\\\" style=\\\"margin-right:0px;margin-bottom:1.5rem;margin-left:0px;color:rgb(0,42,71);font-size:16px;\\\">Dorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.<\\/p><\\/div>\",\"image\":\"664f2d402ada41716464960.jpg\"}', '{\"image\":null,\"description\":null,\"social_title\":null,\"social_description\":null,\"keywords\":null}', 'basic', 'the-consumers-who-did-not-spend', '2022-04-05 07:53:05', '2024-06-11 04:41:10'),
(56, 'subscribe.content', '{\"has_image\":\"1\",\"heading\":\"Subscribe Newsletter\",\"button_title\":\"Subscribe\",\"image\":\"664f30433be5e1716465731.jpg\"}', NULL, 'basic', '', '2022-04-05 08:49:16', '2024-05-23 06:02:11'),
(61, 'testimonial.content', '{\"has_image\":\"1\",\"heading\":\"Happy Client\'s Review\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"background_image\":\"665329ea808fc1716726250.jpg\"}', NULL, 'basic', '', '2022-04-05 12:55:06', '2024-05-26 06:24:10'),
(67, 'faq.content', '{\"heading\":\"FAQ\",\"subheading\":\"Please check the question and answer. If any further issues occured, please contact with us, we will solve the issue in correct time.\",\"button_text\":\"See More\",\"button_url\":\"\\/faq\"}', NULL, 'basic', NULL, '2022-04-05 13:34:46', '2022-06-19 07:15:02'),
(68, 'faq.element', '{\"question\":\"How to booking room?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', NULL, 'basic', NULL, '2022-04-05 13:35:20', '2022-04-05 13:35:20'),
(69, 'faq.element', '{\"question\":\"Hotel location?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', NULL, 'basic', NULL, '2022-04-05 13:35:37', '2022-04-05 13:35:37'),
(70, 'faq.element', '{\"question\":\"What we serve?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', NULL, 'basic', NULL, '2022-04-05 13:36:31', '2022-04-05 13:36:31'),
(71, 'login.content', '{\"has_image\":\"1\",\"title\":\"Hello! Welcome to Single Hotel Room Booking\",\"short_details\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis\",\"form_heading\":\"Sign In Account\",\"form_subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis\",\"image\":\"6652e36d5d89a1716708205.png\"}', NULL, 'basic', '', '2022-04-06 01:40:04', '2024-05-26 01:23:26'),
(72, 'register.content', '{\"has_image\":\"1\",\"title\":\"Hello! Welcome to Single Hotel Room Booking\",\"heading\":\"Register Your Account\",\"subheading\":\"When you create an account, it helps you book your perfect room.\",\"image\":\"66516e5b0762c1716612699.png\"}', NULL, 'basic', '', '2022-04-06 01:40:45', '2024-05-24 22:51:40'),
(74, 'code_verify.content', '{\"description\":\"A 6 digit verification code sent to your email address :\"}', NULL, 'basic', NULL, '2022-04-06 04:09:22', '2022-06-26 04:03:14'),
(75, 'service.element', '{\"name\":\"Health Care\",\"icon\":\"<i class=\\\"fas fa-ambulance\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-05-21 06:23:17', '2022-05-21 06:23:17'),
(76, 'service.element', '{\"name\":\"Swimming Pool\",\"icon\":\"<i class=\\\"fas fa-swimming-pool\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-05-21 06:23:45', '2022-05-21 06:23:45'),
(77, 'service.element', '{\"name\":\"Travelling\",\"icon\":\"<i class=\\\"fas fa-plane-departure\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-05-21 06:24:13', '2022-05-21 06:24:13'),
(78, 'service.element', '{\"name\":\"BBQ Resturant\",\"icon\":\"<i class=\\\"fas fa-hotel\\\"><\\/i>\"}', NULL, 'basic', NULL, '2022-05-21 06:25:33', '2022-05-21 06:26:16'),
(79, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Elvis Gentry\",\"designation\":\"Expedita tenetur vol\",\"feedback\":\"The hospitality and services provided by each staff of the hotel were excellent, they attended us well at all times and we were impressed by their courtesy. We enjoyed our stay and convey thanks to all associated with the hotel. Special thanks to Khun Gap, who took very good care of our group since the inspection day until the end of the trip. We really appreciate ka. We hope to come again soon.\\r\\n\\r\\nThanks for the memories!\",\"image\":\"664f2d05e14c51716464901.png\"}', NULL, 'basic', '', '2022-05-21 06:31:29', '2024-05-23 05:48:21'),
(80, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Mohammad Bright\",\"designation\":\"Nostrud repellendus\",\"feedback\":\"Thank you so much to the Royal Cliff team. I left something behind at the hotel and also wanted them to issue another receipt for tax purposes. They immediately worked on it and the receipt was sent in the hour by email. The item was returned within the day. Totally beyond my expectation. You can totally trust this hotel! Whilst staying there everything was so clean and the service was very attentive. Will always be a customer here.\",\"image\":\"664f2cfebc9a51716464894.png\"}', NULL, 'basic', '', '2022-05-21 06:31:44', '2024-05-23 05:48:14'),
(81, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Nasim Knapp\",\"designation\":\"In adipisci iste in\",\"feedback\":\"Thank you for a truly amazing stay! Your hospitality is quite outstanding. The sports centre is also very good with excellent quality tennis courts. Hope to be back soon.\",\"image\":\"664f2ce7547cf1716464871.png\"}', NULL, 'basic', '', '2022-05-21 06:31:53', '2024-05-23 05:47:51'),
(82, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Amy Vazquez\",\"designation\":\"Voluptatum sint volu\",\"feedback\":\"Beyond 5 stars! Stayed last week at this wonderful hotel. Everything exceeds ones wildest dream of a hotel. On top they have the most wonderful staff, extremely kind and helpful with every wish. This is indeed a place you do not want to leave, and when you do it is with one hope \\u2013 to come back.\",\"image\":\"664f2cd1b6d1d1716464849.png\"}', NULL, 'basic', '', '2022-05-21 06:32:00', '2024-05-23 05:47:29'),
(83, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Connor Cooke\",\"designation\":\"Amet error iure et\",\"feedback\":\"The service here has just been fantastic; whatever we needed was brought to us right away. Our event coordinator was amazing, she has been most helpful. The food was so delicious; the entire experience was really great.\",\"image\":\"664f2cbd2d2811716464829.png\"}', NULL, 'basic', '', '2022-05-21 06:32:09', '2024-05-23 05:47:09'),
(84, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Hope Mills\",\"designation\":\"Qui cillum illo aut\",\"feedback\":\"Good day! We would like to thank you for your sincere efforts and support in success of our recent Parts Conference held in your Hotel. Outstanding support was received from you, your team which is highly appreciated. Please find attached official Appreciation Letter for your kind reference. Thanks & Best Regards.\",\"image\":\"664f2ca6d59831716464806.png\"}', NULL, 'basic', '', '2022-05-21 06:32:16', '2024-05-23 05:46:46'),
(85, 'faq.element', '{\"question\":\"How to cancel booking?\",\"answer\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquam at lectus sed dignissim. In posuere ex dui, ac lacinia risus elementum non\"}', NULL, 'basic', NULL, '2022-05-21 06:40:42', '2022-05-21 06:40:42'),
(86, 'faq.element', '{\"question\":\"What is our refund policy?\",\"answer\":\"Curabitur gravida diam sed facilisis aliquet. Nam vel turpis metus. Fusce luctus convallis purus vel malesuada. Sed ultrices magna quis eros posuere.\"}', NULL, 'basic', NULL, '2022-05-21 06:41:17', '2022-05-21 06:41:17'),
(87, 'footer.content', '{\"has_image\":\"1\",\"description\":\"Maecenas nec odio et ante tincid empus. Donec vitae sapien ut libero venaucibus. Nullam quis ante. Etiam sit amet.\",\"image\":\"664f305dba2b31716465757.jpg\"}', NULL, 'basic', '', '2022-05-21 07:07:45', '2024-05-23 06:02:37'),
(88, 'maintenance.data', '{\"description\":\"<div style=\\\"font-family: Nunito, sans-serif;\\\">\\r\\n        <h2 style=\\\"font-family: Poppins, sans-serif; text-align: center;\\\">\\r\\n            We\'re Just Tuning Up a Few Things\\r\\n        <\\/h2>\\r\\n       \\r\\n        <p style=\\\"text-align: start; font-size:1rem;\\\">\\r\\n            We apologize for the inconvenience but Front is currently undergoing planned maintenance. Thanks for your patience\\r\\n        <\\/p>\\r\\n        \\r\\n    <\\/div>\",\"image\":\"6668270c9f0a91718101772.png\"}', NULL, 'basic', NULL, '2023-02-02 05:56:42', '2024-06-11 04:29:32'),
(89, 'faq.element', '{\"question\":\"Enim consequatur La ?\",\"answer\":\"It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}', NULL, 'basic', NULL, '2022-06-02 06:23:27', '2022-06-02 06:23:27'),
(90, 'faq.element', '{\"question\":\"Duis velit qui reru ?\",\"answer\":\"There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.\"}', NULL, 'basic', NULL, '2022-06-02 06:23:47', '2022-06-02 06:23:47'),
(91, 'faq.element', '{\"question\":\"Magni quas voluptate ?\",\"answer\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.\"}', NULL, 'basic', NULL, '2022-06-02 06:24:08', '2022-06-02 06:24:08'),
(92, 'faq.element', '{\"question\":\"Illum sint voluptat ?\",\"answer\":\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects.\"}', NULL, 'basic', NULL, '2022-06-02 06:24:37', '2022-06-02 06:24:37'),
(93, 'faq.element', '{\"question\":\"Iste asperiores illo ?\",\"answer\":\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.\"}', NULL, 'basic', NULL, '2022-06-02 06:24:48', '2022-06-19 07:13:41'),
(95, 'featured_room.content', '{\"heading\":\"Featured Rooms\",\"subheading\":\"Every room type has many rooms. Anyone can send booking requrest from this site.\"}', NULL, 'basic', NULL, '2022-06-19 07:05:06', '2022-06-23 06:37:14'),
(97, 'maintenance_mode.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b8578719e9e1656248199.png\"}', NULL, 'basic', NULL, '2022-06-26 06:48:45', '2022-06-26 06:56:39'),
(98, 'banned_page.content', '{\"has_image\":\"1\",\"heading\":\"You are banned\",\"image\":\"666827e9bf0771718101993.png\"}', NULL, 'basic', '', '2022-06-26 07:22:50', '2024-06-11 04:33:13'),
(99, 'maintenance_page.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b92e3bdf08d1656303163.png\"}', NULL, 'basic', NULL, '2022-06-26 22:12:43', '2022-06-26 22:12:44'),
(100, 'policy_pages.element', '{\"title\":\"Refund and Cancellation Policy\",\"details\":\"<h2>Cancellation And Refund Policies<br \\/><br \\/><\\/h2>\\r\\n<p>\\r\\n    To reduce last-minute cancellations and the risk of \\\"<a href=\\\"https:\\/\\/en.wikipedia.org\\/wiki\\/Chargeback\\\">chargebacks<\\/a>\\\" from customers, it is always a good idea\\r\\n    to have your customers agree to your cancellation and refund policy. This should be attached to the customers\'\\r\\n    orders for future reference. The occasion makes this easy for you and your customers.<\\/p>\\r\\n<p>\\r\\n    In this article, we will help you define your cancellation and refund policy. Let\'s start by answering the following\\r\\n    questions:<\\/p>\\r\\n<ol>\\r\\n    <li>When do they have to inform you by before the actual\\r\\n        event date starts to cancel?<\\/li>\\r\\n    <li>Do you want to keep their payment and give them store\\r\\n        credit instead?<br \\/><br \\/><\\/li>\\r\\n<\\/ol>\\r\\n<p>\\r\\n    By answering the questions above, you can come up with some very simple and basic policies, like this one:\\u00a0<i>To receive a refund, customers must notify at least 4 days before the start of\\r\\n        the event. In all other instances, only store credit is issued.<br \\/><br \\/><\\/i><\\/p>\\r\\n<p>\\r\\n    Below are\\u00a0<span><u>six<\\/u><\\/span>\\u00a0great examples of cancellation and refund policies:<\\/p>\\r\\n<ol>\\r\\n    <li>Due\\u00a0to limited seating, we request that you cancel\\r\\n        at least 48 hours before a scheduled class. This gives us the opportunity to fill the class. You may cancel by\\r\\n        phone or online here. If you have to cancel your class, we offer you a credit to your account if you cancel\\r\\n        before 48 hours, but do not offer refunds. You may use these credits for any future class. However, if you do\\r\\n        not cancel prior to the 48 hours, you will lose the payment for the class. The owner has the only right to be\\r\\n        flexible here.<\\/li>\\r\\n    <li>Cancellations made 7 days or more in advance of the\\r\\n        event date will receive a 100% refund. Cancellations made within 3 - 6 days will incur a 20% fee. Cancellations\\r\\n        made within 48 hours of the event will incur a 30% fee.<\\/li>\\r\\n    <li>I understand that I am holding a spot so reservations\\r\\n        for this event are nonrefundable. If I am unable to attend I understand that I can transfer to a friend.<\\/li>\\r\\n    <li>If your cancellation is at least 24 hours in advance of\\r\\n        the class, you will receive a full refund. If your cancellation is less than 24 hours in advance, you will\\r\\n        receive a gift certificate to attend a future class. We will do our best to accommodate your needs.<\\/li>\\r\\n    <li>You may cancel your class up to 24 hours before the\\r\\n        class begins and request receives a full refund. If cancellation is made the day of you will receive a credit to\\r\\n        reschedule at a later date. Credit must be used within 90 days.<\\/li>\\r\\n    <li>You may request to cancel your ticket for a full\\r\\n        refund, up to 72 hours before the date and time of the event. Cancellations between 25-72 hours before the event\\r\\n        may be transferred to a different date\\/time of the same class. Cancellation requests made within 24 hours of the\\r\\n        class date\\/time may not receive a refund or a transfer. When you register for a class, you agree to these terms\\r\\n    <\\/li>\\r\\n<\\/ol>\"}', NULL, 'basic', 'refund-and-cancellation-policy', '2022-07-04 08:52:24', '2024-06-11 04:45:46'),
(101, 'account_recovery.content', '{\"description\":\"Lorem ipsum dolor sit amet. Et consequatur corporis eum laudantium galisum ut nostrum perferendis. Ut tenetur neque eos vitae nulla id itaque possimus aut cupiditate maxime.\"}', NULL, 'basic', NULL, '2023-01-30 07:22:26', '2023-01-30 07:22:26'),
(102, 'about.content', '{\"heading\":\"WHO WE ARE\",\"subheading\":\"About Us\",\"description\":\"<p>Welcome to ViserHotel \\u2013 your trusted partner in discovering the perfect stay.<\\/p>\\r\\n<p>At ViserHotel, we believe that every journey deserves a smooth and enjoyable experience, starting with where you\\r\\n    stay. Whether you\'re traveling for business, vacation, or a special occasion, our platform connects you with a wide\\r\\n    range of hotels, resorts, and guesthouses to fit every taste and budget.<\\/p>\\r\\n<h6 class=\\\"mt-3\\\">Our Mission & Vision<\\/h6>\\r\\n<p>To simplify hotel booking by offering a fast, secure, and user-friendly platform that helps travelers find the right\\r\\n    accommodation while empowering hotel owners to manage their properties with ease.<\\/p><p>To build a global platform that transforms the hospitality experience by making hotel booking smarter, simpler, and more accessible for everyone.<\\/p>\"}', NULL, 'elegant', '', '2020-10-28 00:51:20', '2025-07-14 05:13:06'),
(103, 'about.element', '{\"has_image\":\"1\",\"image\":\"685d5d4338d991750949187.png\"}', NULL, 'elegant', '', '2024-11-23 04:43:09', '2025-06-26 08:46:27'),
(104, 'account_recovery.content', '{\"has_image\":\"1\",\"heading\":\"Restaurants Celebrating International Flavors\",\"short_details\":\"Distinct flavors from around the world come together to create a culinary journey at The Ritz-Carlton, Doha, each restaurant specializes in superlative experiences that celebrate the flavors of Qatar and beyond.\",\"image\":\"674efe4debded1733230157.png\"}', NULL, 'elegant', '', '2023-01-30 07:22:26', '2024-12-03 06:49:18'),
(105, 'acknowledgement.content', '{\"title\":\"I would like to receive promotions\",\"details\":\"I confirm that the information I have provided is accurate, and I have reviewed all booking details including check-in\\/check-out dates, guest information, and payment.\\r\\nI acknowledge and accept the hotel\\u2019s terms and conditions, cancellation policy, and refund guidelines.\"}', NULL, 'elegant', '', '2024-12-30 23:43:48', '2025-07-14 01:29:58'),
(106, 'banned_page.content', '{\"has_image\":\"1\",\"heading\":\"You are banned\",\"image\":\"666827e9bf0771718101993.png\"}', NULL, 'elegant', '', '2022-06-26 07:22:50', '2024-06-11 04:33:13'),
(107, 'banner.content', '{\"has_image\":\"1\",\"heading\":\"A place to call home on your next adventure\",\"subheading\":\"Experience the joy of an entire place to yourself\",\"review\":\"4\",\"review_short_comment\":\"Great\",\"review_text\":\"4.2 out of 5 based on 89,311 reviews\",\"reviews_company_name\":\"TrustPilot\",\"image\":\"686501ebdd9861751450091.png\"}', NULL, 'elegant', '', '2021-05-02 06:09:30', '2025-07-08 03:45:16'),
(108, 'blog.content', '{\"heading\":\"Our News & Blogs\",\"subheading\":\"Stay Updated with the Latest Stories and Announcements\"}', NULL, 'elegant', '', '2020-10-28 00:51:34', '2025-06-15 05:41:33'),
(109, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Not Just a Room: What Your Hotel Stay Says About You\",\"category\":\"Hotel Booking\",\"read_time\":\"5 min\",\"description\":\"<div class=\\\"mb-2\\\">In the silent language of hospitality, your choice of accommodations speaks volumes before you unpack\\r\\n    your suitcase. At ViserHotel, we understand that where you stay isn\'t just about location\\u2014it\'s a declaration of\\r\\n    values, priorities, and how you move through the world.<\\/div>\\r\\n\\r\\n<blockquote>\\\"Show me your hotel and I\'ll tell you who you aspire to be.\\\" The spaces we choose become mirrors of our best\\r\\n    selves.<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Conventional Luxury Traveler<\\/h6>\\r\\n<div>Those who choose predictable five-star chains seek safety in standardization\\u2014the marble lobbies and branded bath\\r\\n    amenities promise no surprises. While comfortable, this choice whispers \\\"I value recognition over revelation\\\" and\\r\\n    \\\"my comfort zone has golden edges.\\\"<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The ViserHotel Guest<\\/h6>\\r\\n<div>Our guests share an unspoken ethos: they understand true luxury lives in the details you can\'t photograph but can\'t\\r\\n    forget. The way your pillow remembers your sleep position from last visit. How the bartender anticipates your\\r\\n    cocktail evolution from evening one to three. This isn\'t accommodation\\u2014it\'s alchemy.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Boutique Aesthetic<\\/h6>\\r\\n<div>Design-forward boutique hotels attract those who believe aesthetics are philosophy. But often, the Instagrammable\\r\\n    lobby fades when room service takes 45 minutes. ViserHotel guests know better\\u2014we\'ve hidden profound functionality\\r\\n    behind our beauty, like outlets that appear when needed and vanish when not.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Business Traveler\'s Dilemma<\\/h6>\\r\\n<div>Convention says business trips demand efficiency over experience. Our corporate guests disprove this daily\\u2014they\\r\\n    understand a negotiation table tilts favorably when you arrive from a hotel that delivers perfect espresso without\\r\\n    being asked, and transforms your suit from travel-wrinkled to boardroom-ready by dawn.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Sustainability Statement<\\/h6>\\r\\n<div>Eco-conscious hotels often ask guests to sacrifice\\u2014towel reuse, weak showers, Spartan spaces. ViserHotel\\r\\n    demonstrates that true sustainability enhances luxury: organic linens softer than conventional cotton, zero-waste\\r\\n    cocktails more inventive than their wasteful counterparts, and silent climate systems that purify air while you\\r\\n    sleep.<\\/div>\\r\\n\\r\\n<div class=\\\"mt-3\\\">\\r\\n    <strong>The Unspoken Truth:<\\/strong> Your hotel choice reveals what you tolerate (mediocre service) and what you\\r\\n    demand (the extraordinary). At ViserHotel, we\'ve eliminated the former so you can focus on the latter. Because where\\r\\n    you stay isn\'t just where you sleep\\u2014it\'s where you become who you\'re meant to be.\\r\\n<\\/div>\",\"image\":\"684eb344ac3361749988164.jpg\"}', NULL, 'elegant', 'not-just-a-room-what-your-hotel-stay-says-about-you', '2020-10-28 00:57:19', '2025-07-14 06:40:28'),
(110, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"From Sunrise to Stargaze: A Day in the Life at ViserHotel\",\"category\":\"Hotel Booking\",\"read_time\":\"8 min\",\"description\":\"<div class=\\\"mb-2\\\">At ViserHotel, time doesn\'t just pass\\u2014it unfolds in carefully curated moments. Follow us through an\\r\\n    ideal day where every hour brings new opportunities for indulgence, discovery, and renewal.<\\/div>\\r\\n\\r\\n<blockquote>\\\"Luxury is time made visible.\\\" Our daily rhythm turns fleeting moments into lasting memories.<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">6:30 AM | Sunrise Salutation<\\/h6>\\r\\n<div>Greet the day on our private sunrise platform as our wellness guide leads a bespoke yoga flow. The morning air\\r\\n    carries the scent of jasmine from our rooftop garden as the Bosphorus shimmers with first light. Post-session,\\r\\n    warmed towels and a revitalizing elixir of ginger, turmeric, and local honey await.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">8:00 AM | Breakfast as Performance Art<\\/h6>\\r\\n<div>In our sun-drenched conservatory, chefs prepare your meal tableside\\u2014from flaky b\\u00f6rek baked in copper pans to\\r\\n    honeycomb harvested from our own hives. The seasonal juice trolley offers unexpected pairings like black carrot with\\r\\n    sumac, each glass a vibrant masterpiece.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">10:30 AM | Cultural Immersion<\\/h6>\\r\\n<div>Join our resident historian for \\\"Behind the Postcard\\\" tours to neighborhood gems even locals don\'t know.\\r\\n    Alternatively, our library\'s rare book collection (including Ottoman-era manuscripts) awaits with a personal curator\\r\\n    to guide your exploration.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">1:00 PM | Lunch with a View<\\/h6>\\r\\n<div>The poolside grill transforms simple ingredients into revelations\\u2014think octopus carpaccio with smoked olive oil or\\r\\n    melon salad with whipped feta. Every bite comes with panoramic views that redefine \\\"business lunch\\\" expectations.\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">3:30 PM | Afternoon Recalibration<\\/h6>\\r\\n<div>Choose between our signature hammam ritual (with gold-leaf body masks) or a private fragrance-blending session with\\r\\n    our perfumer. The spa\'s \\\"Time Suspended\\\" treatment rooms feature floating beds that respond to your breathing\\r\\n    patterns.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">6:00 PM | Golden Hour Aperitivo<\\/h6>\\r\\n<div>Our mixologist crafts sunset cocktails using ingredients foraged that morning\\u2014perhaps a fig leaf-infused gin or\\r\\n    bergamot foam. The rooftop\'s \\\"Golden Moment\\\" tradition includes a champagne sabrage as the sun dips below the\\r\\n    minarets.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">8:30 PM | Dinner Under the Stars<\\/h6>\\r\\n<div>The chef\'s tasting menu becomes theater as dishes arrive under aromatic smoke domes or with edible \\\"paint\\\" for\\r\\n    customization. Between courses, astronomers point out constellations through telescopic lenses at your table.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">10:45 PM | Nightcap with a Story<\\/h6>\\r\\n<div>The hidden speakeasy behind our library shelf serves rare rak\\u0131 accompanied by live rebab music. For a quieter\\r\\n    finale, your butler can arrange a moonlit bubble bath on your private terrace, complete with poetry selections\\r\\n    matching your mood.<\\/div>\",\"image\":\"6876000c03f461752563724.png\"}', NULL, 'elegant', 'from-sunrise-to-stargaze-a-day-in-the-life-at-viserhotel', '2022-04-04 10:07:25', '2025-07-15 01:15:24'),
(111, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Why Your Next Zoom Call Should Be from Our Rooftop Lounge\",\"category\":\"Entertainment\",\"read_time\":\"14 min\",\"description\":\"<div class=\\\"mb-2\\\">In the era of remote work, your background speaks volumes before you do. At ViserHotel, we\'ve\\r\\n    reimagined the \'work from anywhere\' experience with our Skyline Lounge - where professional meets extraordinary.\\r\\n    Here\'s why your next virtual meeting deserves our panoramic backdrop.<\\/div>\\r\\n\\r\\n<blockquote>\\\"First impressions are made in the first 7 seconds - make yours count with a view that says \'I\'ve arrived\'\\r\\n    without uttering a word.\\\"<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Ultimate Professional Backdrop<\\/h6>\\r\\n<div>Our floor-to-ceiling windows frame Istanbul\'s iconic Bosphorus panorama - an impressive but undistracting view that\\r\\n    commands attention. Sophisticated acoustic design eliminates echo and street noise, while 2700K temperature lighting\\r\\n    flatters all skin tones automatically. Every detail is engineered to make you look and sound your absolute best.\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Business-Class Amenities<\\/h6>\\r\\n<div>Borrow professional-grade ring lights, lapel mics, or even green screens from our Tech Concierge service. Enjoy\\r\\n    enterprise-grade WiFi (up to 1Gbps) with backup LTE connections, printer access, and soundproof booths for sensitive\\r\\n    calls. Our white-glove staff deliver coffee refills and snacks with military precision - never crossing into your\\r\\n    camera frame.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Post-Call Recharge<\\/h6>\\r\\n<div>Between meetings, recharge with 15-minute \\\"Screen Fatigue Relief\\\" massages administered right at your lounge chair.\\r\\n    The Brain Food menu offers chef-prepared focus boosters like matcha energy balls and turmeric lattes. For deep work\\r\\n    sessions, productivity pods feature adjustable standing desks with panoramic inspiration.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Networking Elevated<\\/h6>\\r\\n<div>Daily Serendipity Hours (5-6PM) connect professionals over artisanal mocktails. Our monthly Industry Insider Series\\r\\n    brings visiting executives for intimate talks - included with your lounge pass. NFC-enabled coasters allow instant\\r\\n    digital business card exchanges with fellow guests.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">How to Book Your Professional Upgrade<\\/h6>\\r\\n<div>Day Passes (8AM-6PM) include three beverage credits for remote workers. Reserved corner tables with premium tech\\r\\n    setups are available for critical meetings. Pro tip: Book consecutive days to receive complimentary blazer pressing\\r\\n    - because first impressions shouldn\'t wrinkle.<\\/div>\",\"image\":\"6875fffb333a81752563707.png\"}', NULL, 'elegant', 'why-your-next-zoom-call-should-be-from-our-rooftop-lounge', '2022-04-05 07:43:11', '2025-07-15 01:15:08'),
(112, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Travel Tips: Making the Most of Your Stay at ViserHotel\",\"category\":\"Travels\",\"read_time\":\"12 min\",\"description\":\"<div class=\\\"mb-2\\\">Your ViserHotel experience begins long before check-in and lingers well after checkout. These insider\\r\\n    tips\\u2014gathered from our most frequent guests and staff\\u2014will help you unlock hidden luxuries, avoid common oversights,\\r\\n    and craft a stay that feels personally tailored.<\\/div>\\r\\n\\r\\n<blockquote>\\\"The art of travel is the art of knowing what to overlook\\u2014and what to insist upon.\\\" At ViserHotel, we guide\\r\\n    you to the latter.<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Pre-Arrival Personalization<\\/h6>\\r\\n<div>Three days before your stay, our Guest Experience team will email a <em>preference portal<\\/em>. Few realize its\\r\\n    full potential: Beyond pillow choices, you can request everything from a curated vinyl selection for your in-room\\r\\n    record player to pre-stocking your fridge with local craft beers. Pro tip: Share your itinerary\\u2014we\\u2019ll quietly\\r\\n    upgrade complementary amenities (like preparing a post-hike muscle gel soak).<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Golden Hours<\\/h6>\\r\\n<div>Timing transforms your experience:\\r\\n    <ul>\\r\\n        <li><strong>7-8 AM:<\\/strong> Private pool access (before families arrive)<\\/li>\\r\\n        <li><strong>3-4 PM:<\\/strong> Secret high tea service in the library (not on menus)<\\/li>\\r\\n        <li><strong>9:30 PM:<\\/strong> Rooftop stargazing with our astronomer-concierge (Tues\\/Thurs)<\\/li>\\r\\n    <\\/ul>\\r\\n    Ask your butler for the current \\\"hidden hour\\\" offerings\\u2014they change seasonally.\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Tech Shortcuts Even Regulars Miss<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Double-tap your room tablet\\u2019s home button for instant requests (faster than calling)<\\/li>\\r\\n        <li>Use the \\\"Digital Butler\\\" chat\\u2019s <em>voice memo<\\/em> feature for complex asks (\\\"Find me a vintage watch\\r\\n            repair\\\")<\\/li>\\r\\n        <li>Enable \\\"Resume My Stay\\\" in the app to automatically recreate your perfect room setup on return visits<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Off-Menu Magic<\\/h6>\\r\\n<div>ViserHotel\\u2019s true luxuries aren\\u2019t advertised:\\r\\n    <ul>\\r\\n        <li><strong>For foodies:<\\/strong> Ask for the \\\"Chef\\u2019s Canvas\\\" tasting menu (5\\/7 courses of kitchen experiments)\\r\\n        <\\/li>\\r\\n        <li><strong>For wellness:<\\/strong> The spa offers \\\"Jet Lag Revival\\\" IV drips with custom nutrient blends<\\/li>\\r\\n        <li><strong>For families:<\\/strong> Request the \\\"Explorer\\u2019s Backpack\\\" with kid-friendly city treasure hunts<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\"> Departure Done Right<\\/h6>\\r\\n<div>Most guests miss these farewell perks:\\r\\n    <ul>\\r\\n        <li>Late checkout isn\\u2019t just about time\\u2014ask for a <em>dayroom reset<\\/em> (fresh linens\\/towels while you\\u2019re out)\\r\\n        <\\/li>\\r\\n        <li>Our \\\"Fragrance Memory\\\" service captures your favorite in-hotel scent as a take-home candle<\\/li>\\r\\n        <li>Unused minibar credits convert to donations for local schools\\u2014just initial your bill<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<div class=\\\"mt-3\\\">Remember: At ViserHotel, the only wrong question is the unasked one. Our staff\\u2019s pride comes from\\r\\n    fulfilling requests that surprise even us\\u2014so dream boldly.<\\/div>\",\"image\":\"6874ff7ba74cc1752498043.png\"}', NULL, 'elegant', 'travel-tips-making-the-most-of-your-stay-at-viserhotel', '2022-04-05 07:43:37', '2025-07-14 07:00:44'),
(113, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Before You Book Anywhere Else, Read This\",\"category\":\"Hotel Booking\",\"read_time\":\"8 min\",\"description\":\"<div class=\\\"mb-2\\\">In a world of lookalike luxury hotels, ViserHotel doesn\'t just meet expectations\\u2014we reinvent them.\\r\\n    Before you confirm that reservation elsewhere, discover what truly sets us apart (and what you might regret\\r\\n    missing).<\\/div>\\r\\n\\r\\n<blockquote>\\\"The difference between a good stay and an unforgettable experience often comes down to the details you\\r\\n    never knew to ask for.\\\"<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The ViserHotel Guarantee You Won\'t Find Elsewhere<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li><strong>100% Sleep Satisfaction:<\\/strong> If your custom sleep profile (assigned at check-in) doesn\'t\\r\\n            deliver perfect rest, we\'ll redesign your bedroom setup overnight<\\/li>\\r\\n        <li><strong>Bespoke City Guides:<\\/strong> Not just recommendations\\u2014we pre-reserve your tables, tickets, and\\r\\n            transportation before you arrive<\\/li>\\r\\n        <li><strong>Price Match Plus:<\\/strong> Find a comparable room elsewhere? We\'ll match the rate <em>and<\\/em>\\r\\n            upgrade your view<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\"> What Other Hotels Charge Extra For (That We Include)<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Premium WiFi that actually works for video calls (not the \\\"luxury hotel\\\" standard that buffers)<\\/li>\\r\\n        <li>Mini-bar with local artisan treats (replenished daily)<\\/li>\\r\\n        <li>In-room Nespresso with rare single-origin capsules<\\/li>\\r\\n        <li>Personalized welcome amenity based on your social media (yes, we discreetly check for allergies first)<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The ViserHotel Experiences You Can\'t Get Next Door<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li><strong>Dawn at the Bosphorus:<\\/strong> Private sunrise yoga on our floating platform (with heated towels\\r\\n            and matcha service)<\\/li>\\r\\n        <li><strong>Midnight Kitchen Raid:<\\/strong> After-hours access to create your own snack with our pastry chef\\r\\n        <\\/li>\\r\\n        <li><strong>Closet Switch:<\\/strong> Leave behind clothes you didn\'t wear\\u2014we\'ll clean and donate them, then gift\\r\\n            you boutique credit<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\"> What You\'ll Miss If You Stay Elsewhere<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Our legendary \\\"Pillow Librarian\\\" who will customize your bedding like a sommelier pairs wine<\\/li>\\r\\n        <li>The hidden rooftop bee hives that supply honey for your breakfast (and spa treatments)<\\/li>\\r\\n        <li>Silent check-out where we email your receipt and automatically extend checkout to 1 PM unless you say\\r\\n            otherwise<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">How to Book Smarter<\\/h6>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Our mobile app offers secret last-minute suites at 30% off (enable \\\"Alert Me\\\" notifications)<\\/li>\\r\\n        <li>Mention this blog when booking for a complimentary scent-memory candle of your favorite in-hotel aroma<\\/li>\\r\\n        <li>Third-night-free offers appear randomly\\u2014check with our chat agents even if unavailable online<\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n\\r\\n<div class=\\\"mt-3\\\">\\r\\n    <strong>Final Thought:<\\/strong> The best hotel isn\'t the one with the most Instagrammable lobby\\u2014it\'s the one that\\r\\n    remembers how you take your coffee two years later, the one where staff learn your name before you learn theirs.\\r\\n    That\'s the ViserHotel difference.\\r\\n<\\/div>\",\"image\":\"6874ff521fd251752498002.png\"}', NULL, 'elegant', 'before-you-book-anywhere-else-read-this', '2022-04-05 07:44:01', '2025-07-14 07:00:02'),
(114, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"What Makes ViserHotel Different from Other Hotels in the City?\",\"category\":\"Best\",\"read_time\":\"5 min\",\"description\":\"<div class=\\\"mb-2\\\">In a city brimming with luxury accommodations, ViserHotel stands apart\\u2014not just for what we offer, but for how we redefine hospitality. Where others follow trends, we set them by blending cutting-edge innovation with timeless elegance. Here\\u2019s why discerning travelers choose us as their urban sanctuary.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">Bespoke Service Beyond Concierge<\\/h6>\\r\\n    <div>While most hotels offer standard concierge services, ViserHotel provides a <em>Personal Experience Curator<\\/em> for each guest. Before arrival, they tailor everything from your minibar preferences to arranging exclusive access\\u2014like private museum viewings or a chef\\u2019s table at impossible-to-book restaurants. It\\u2019s hospitality that anticipates desires you haven\\u2019t even voiced.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">Seamless Tech Meets Human Touch<\\/h6>\\r\\n    <div>Our competitors tout \\\"smart rooms,\\\" but ours learn. The AI-powered system adjusts lighting and temperature to your rhythms, while discreet human staff ensure tech never feels cold. Want your room pre-chilled at 6 PM? Done. Forgot your tablet charger? A butler delivers one before you ask\\u2014no app required.<\\/div>\\r\\n    \\r\\n    <blockquote class=\\\"my-3\\\">\\\"Luxury is not about being noticed\\u2014it\\u2019s about being remembered.\\\" ViserHotel crafts experiences so personalized, guests don\\u2019t just stay\\u2014they belong.<\\/blockquote>\\r\\n    \\r\\n    <h6 class=\\\"mb-2\\\">Sustainability Without Compromise<\\/h6>\\r\\n    <div>Other \\\"eco-luxury\\\" hotels sacrifice comfort for credentials. ViserHotel\\u2019s carbon-neutral operations are invisible to guests: geothermal heating silky-smooth underfloor warmth, organic linens softer than conventional ones, and zero-waste dining that rivals Michelin-starred excess. Our green roof isn\\u2019t just for insulation\\u2014it\\u2019s a secret garden for moonlit cocktails.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">Hyper-Local Immersion<\\/h6>\\r\\n    <div>Chain hotels feel interchangeable; ViserHotel is unmistakably <em>of this city<\\/em>. From lobby art by emerging local painters to a scent signature distilled from native jasmine, every detail tells a story. Our \\\"Neighborhood Guides\\\" aren\\u2019t pamphlets\\u2014they\\u2019re curated audio walks narrated by resident poets and chefs.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">The Invisible Luxury of Space<\\/h6>\\r\\n    <div>In dense urban landscapes, we\\u2019ve sacrificed revenue to ensure no guest feels crowded. Suites feature 40% more square footage than competitors, with soundproofing so profound, the city\\u2019s buzz becomes a distant murmur. Even our spa\\u2019s hydrotherapy pool enforces strict capacity\\u2014because true luxury breathes.<\\/div>\\r\\n    \\r\\n    <div class=\\\"mt-3\\\">ViserHotel doesn\\u2019t compete with other hotels\\u2014we transcend comparison. It\\u2019s the difference between a place to sleep and a space that reawakens your senses, between service and soul, between staying and <em>staying inspired<\\/em>.<\\/div>\",\"image\":\"6874ff36ba63e1752497974.png\"}', NULL, 'elegant', 'what-makes-viserhotel-different-from-other-hotels-in-the-city', '2022-04-05 07:45:25', '2025-07-14 06:59:35'),
(115, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"Poolside Bliss: Relax, Dine, and Unwind at ViserHotel\",\"category\":\"Fresh Air\",\"read_time\":\"10 min\",\"description\":\"<div class=\\\"mb-2\\\">At ViserHotel, our infinity-edge pool isn\\u2019t just a place to swim\\u2014it\\u2019s a sanctuary of leisure and indulgence. Overlooking the breathtaking Bosphorus, our poolside oasis blends serene relaxation with world-class hospitality. Whether you\'re sipping handcrafted cocktails under the sun or enjoying gourmet bites as the sun sets, every moment here is designed for pure bliss.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2\\\">A Refreshing Escape with a View<\\/h6>\\r\\n    <div>Dive into our temperature-controlled infinity pool, where the horizon blends seamlessly with the sky. Lounge on plush, canopied daybeds with personalized service at your fingertips\\u2014fresh towels, chilled fruit skewers, and a curated playlist to set the mood. The pool\\u2019s sleek, minimalist design complements the natural beauty around it, creating an atmosphere of understated luxury.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">Alfresco Dining by the Water<\\/h6>\\r\\n    <div>Our poolside menu elevates casual dining with Mediterranean-inspired small plates, fresh seafood, and vibrant salads\\u2014all made with locally sourced ingredients. Sip on signature drinks like our *Bosphorus Breeze* (a refreshing mix of pomegranate, mint, and sparkling water) or indulge in a champagne brunch served right to your cabana. Dietary preferences? Our chefs craft bespoke dishes to suit every palate.<\\/div>\\r\\n    \\r\\n    <h6 class=\\\"mb-2 mt-2\\\">Sunset Soir\\u00e9es & Evening Ambiance<\\/h6>\\r\\n    <div>As daylight fades, the pool area transforms into an enchanting retreat. Soft lanterns and fire pits illuminate the space, while live acoustic music sets a soothing tone. Join us for weekly themed nights\\u2014from \\\"Moonlight Tapas\\\" to \\\"Jazz & Cocktails\\\"\\u2014where guests mingle under the stars in an effortlessly chic setting.<\\/div>   \\r\\n    \\r\\n    <blockquote class=\\\"my-3\\\">\\\"Water has no taste, no color, no odor; it cannot be defined, yet it is life itself.\\\" At ViserHotel, our poolside experience embodies this philosophy\\u2014simple yet transformative.<\\/blockquote>\\r\\n    \\r\\n    <h6 class=\\\"mb-2\\\">Private Cabanas for Ultimate Relaxation<\\/h6>\\r\\n    <div>For those seeking exclusivity, our premium cabanas offer privacy and luxury. Equipped with misting fans, mini-fridges, and direct pool access, they\\u2019re perfect for couples or small groups. Add a spa treatment to your day\\u2014our therapists provide massages and facials right at your cabana, blending wellness with leisure.<\\/div>\\r\\n    \\r\\n    <div class=\\\"mt-3\\\">At ViserHotel, poolside moments aren\\u2019t just an amenity\\u2014they\\u2019re a highlight of your stay. Whether you\'re here to unwind, socialize, or simply soak in the beauty around you, our aquatic sanctuary promises an unforgettable experience.<\\/div>\",\"image\":\"6874ff173e9981752497943.png\"}', NULL, 'elegant', 'poolside-bliss-relax-dine-and-unwind-at-viserhotel', '2022-04-05 07:50:57', '2025-07-14 06:59:03'),
(116, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"How ViserHotel Is Leading Eco-Friendly Hospitality\",\"category\":\"Hospitality\",\"read_time\":\"12 min\",\"description\":\"<div class=\\\"mb-2\\\">At ViserHotel, luxury and sustainability go hand in hand. We\'ve redefined upscale hospitality by\\r\\n    integrating cutting-edge eco-friendly practices without compromising on guest comfort or experience. Our green\\r\\n    initiatives span from energy-efficient operations to zero-waste dining, setting new standards for responsible\\r\\n    tourism in the luxury sector.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Green Architecture: Building With Nature<\\/h6>\\r\\n<div>Our property features a revolutionary biophilic design that reduces energy consumption by 40%. The building\'s\\r\\n    curved glass facade maximizes natural light while minimizing heat gain, complemented by a living wall system that\\r\\n    naturally filters air. We use only non-toxic, locally-sourced materials including reclaimed wood and recycled steel\\r\\n    throughout our spaces.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Zero-Waste Gastronomy<\\/h6>\\r\\n<div>The culinary team at ViserHotel has achieved 92% waste diversion through innovative practices. Our kitchens partner\\r\\n    with local organic farms, employ root-to-stem cooking techniques, and compost all food waste. Even our fine dining\\r\\n    menus feature carbon-neutral dishes, with plant-based options that rival traditional gourmet offerings in creativity\\r\\n    and flavor.<\\/div>\\r\\n\\r\\n\\r\\n\\r\\n<blockquote class=\\\"my-3\\\">\\\"True luxury leaves no footprint.\\\" Our sustainability mission ensures every guest enjoys indulgence that\\r\\n    respects our planet.<\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2\\\">Smart Energy Systems<\\/h6>\\r\\n<div>Behind the scenes, ViserHotel operates on a smart microgrid powered by solar panels and geothermal energy.\\r\\n    Motion-sensing LED lighting, AI-driven climate control, and water-recycling systems work seamlessly to reduce our\\r\\n    environmental impact. Guests can track their room\'s energy savings through in-room tablets - often discovering\\r\\n    they\'ve helped save enough water for 50 showers during a weekend stay.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Conscious Luxury Amenities<\\/h6>\\r\\n<div>From biodegradable packaging to refillable organic toiletries in glass containers, every detail reflects our\\r\\n    sustainability ethos. Our housekeeping uses only plant-based cleaning products, and guests receive digital rather\\r\\n    than paper receipts. The spa features 100% organic treatments, while our gift shop showcases sustainable local\\r\\n    crafts.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Community-First Sustainability<\\/h6>\\r\\n<div>Our commitment extends beyond property lines through partnerships with environmental NGOs and local conservation\\r\\n    projects. For every booking, we plant five native trees and fund clean water initiatives. Staff undergo extensive\\r\\n    sustainability training, and guests are invited to participate in weekly beach cleanups or urban farming\\r\\n    experiences.<\\/div>\\r\\n\\r\\n<div class=\\\"mt-3\\\">At ViserHotel, we prove daily that environmental responsibility enhances rather than limits luxury.\\r\\n    Our guests enjoy the satisfaction of knowing their stay contributes to meaningful change - sleeping better in every\\r\\n    sense of the phrase.<\\/div>\",\"image\":\"6874fefa4c2701752497914.png\"}', NULL, 'elegant', 'how-viserhotel-is-leading-eco-friendly-hospitality', '2022-04-05 07:52:10', '2025-07-14 06:58:34');
INSERT INTO `frontends` (`id`, `data_keys`, `data_values`, `seo_content`, `tempname`, `slug`, `created_at`, `updated_at`) VALUES
(117, 'blog.element', '{\"has_image\":[\"1\"],\"title\":\"The Ultimate Guide to a Luxurious Stay at ViserHotel\",\"category\":\"User Experience\",\"read_time\":\"10 min\",\"description\":\"<div class=\\\"mb-2\\\">Dining at ViserHotel is more than just a meal\\u2014it\'s an experience. Our contemporary dining room blends\\r\\n    modern design with timeless elegance, offering guests a comfortable yet sophisticated setting to enjoy gourmet\\r\\n    cuisine. Each dish is thoughtfully crafted using locally sourced ingredients, with seasonal menus that reflect\\r\\n    global flavors and culinary trends. The ambiance, enhanced by soft lighting and warm tones, makes it perfect for\\r\\n    both romantic dinners and casual conversations.<\\/div>\\r\\n\\r\\n<blockquote> \\\"A great meal isn\'t just tasted\\u2014it\'s remembered.\\\" Our dining space turns every plate into a story worth\\r\\n    sharing. <\\/blockquote>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">The Master Bedroom Retreat: A Private Escape of Luxury and Comfort<\\/h6>\\r\\n<div>Our master bedrooms are designed to offer guests the ultimate sanctuary. Featuring plush king-sized beds, luxurious\\r\\n    linens, and calming neutral tones, these rooms provide the perfect blend of relaxation and refinement. Large windows\\r\\n    flood the space with natural light, while blackout curtains ensure restful sleep. Whether you\'re waking up to city\\r\\n    skyline views or winding down after a long day, every element in the room\\u2014from the ergonomic furniture to the\\r\\n    tech-savvy features\\u2014is curated to enhance comfort and convenience.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Fine Dining by the Pool: Casual Alfresco Luxury<\\/h6>\\r\\n<div>Casual-yet-elegant alfresco dining can be enjoyed while relaxing alongside our expansive Bosphorus-front swimming\\r\\n    pool. Guests can sip handcrafted beverages, savor freshly prepared meals, and soak in the ambiance of open-air\\r\\n    luxury. The poolside dining setup is ideal for warm evenings and sunny afternoons, creating a relaxed yet elevated\\r\\n    experience that blends nature, flavor, and comfort effortlessly.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">Smart Comfort: Technology Enhancing the Guest Experience<\\/h6>\\r\\n<div>ViserHotel is not just a place to stay\\u2014it\'s a space designed around modern guest expectations. Our rooms feature\\r\\n    smart lighting, climate control, and in-room tablets that allow guests to order services, book spa appointments, or\\r\\n    adjust room settings with a tap. These thoughtful innovations are seamlessly integrated, ensuring that your stay\\r\\n    feels personalized, intuitive, and refreshingly easy.<\\/div>\\r\\n\\r\\n<h6 class=\\\"mb-2 mt-2\\\">A Place to Remember: Designed for Rest, Reflection, and Reconnection<\\/h6>\\r\\n<div>Every part of ViserHotel\\u2014from the welcoming lobby to the tranquil suites\\u2014is crafted to help guests unwind and\\r\\n    reconnect. Whether you\'re traveling for leisure or business, we provide an environment where elegance and comfort\\r\\n    come together effortlessly. It\'s not just where you stay\\u2014it\'s where you feel at home.<\\/div>\",\"image\":\"684eb2cba91101749988043.jpg\"}', NULL, 'elegant', 'the-ultimate-guide-to-a-luxurious-stay-at-viserhotel', '2022-04-05 07:53:05', '2025-07-14 06:08:36'),
(118, 'booking_advantage.content', '{\"heading\":\"Advantages of Booking from Our System\"}', NULL, 'elegant', '', '2024-11-23 04:06:51', '2025-06-15 06:33:09'),
(119, 'booking_advantage.element', '{\"has_image\":\"1\",\"advantage\":\"Remarkable offer price & easy booking process.\",\"icon\":\"6741a947249a41732356423.png\"}', NULL, 'elegant', '', '2024-11-23 04:07:03', '2025-06-15 06:38:57'),
(120, 'booking_advantage.element', '{\"has_image\":\"1\",\"advantage\":\"Exclusive rooms & Suites with remarkable facilities.\",\"icon\":\"6741a956ad03d1732356438.png\"}', NULL, 'elegant', '', '2024-11-23 04:07:18', '2025-06-15 06:39:18'),
(121, 'booking_advantage.element', '{\"has_image\":\"1\",\"advantage\":\"Regular price, special discount and coupon offers.\",\"icon\":\"6741a96817e7e1732356456.png\"}', NULL, 'elegant', '', '2024-11-23 04:07:36', '2025-06-15 06:40:31'),
(122, 'booking_advantage.element', '{\"has_image\":\"1\",\"advantage\":\"Easy booking cancellation and money back gurantee.\",\"icon\":\"6741a97a8b4e61732356474.png\"}', NULL, 'elegant', '', '2024-11-23 04:07:54', '2025-06-15 06:41:09'),
(123, 'breadcrumb_images.content', '{\"has_image\":\"1\",\"breadcrumb_image\":\"6864db5deba941751440221.png\",\"blog_breadcrumb_image\":\"6864dd5f3e8401751440735.png\",\"room_detail_breadcrumb_image\":\"67a377c40cd001738766276.png\"}', NULL, 'elegant', '', '2025-02-05 08:37:53', '2025-07-02 01:18:55'),
(124, 'code_verify.content', '{\"description\":\"A 6 digit verification code sent to your email address :\"}', NULL, 'elegant', NULL, '2022-04-06 04:09:22', '2022-06-26 04:03:14'),
(125, 'confirmation_page.content', '{\"has_image\":\"1\",\"heading\":\"Welcome to Our Hotel\",\"advise\":\"Keep patient! You will get a confirmation message quickly.\",\"image\":\"686f91127bda31752142098.png\"}', NULL, 'elegant', '', '2025-07-10 04:08:18', '2025-07-10 04:21:28'),
(126, 'contact_us.content', '{\"has_image\":\"1\",\"heading\":\"Contact With Us\",\"email_address\":\"viserhotel@gmail.com\",\"contact_number\":\"123 - 4567890\",\"address\":\"15205 North Kierland Blvd.\",\"image\":\"6755607518ead1733648501.png\"}', NULL, 'elegant', '', '2020-10-28 00:59:19', '2025-06-16 00:22:34'),
(127, 'cookie.data', '{\"short_desc\":\"We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure.\",\"description\":\"<div><h3>What information do we collect?<\\/h3><p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview, or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our site anonymously.<\\/p><p><br><\\/p><\\/div><div><h3>How do we protect your information?<\\/h3><p>All provided delicate\\/credit data is sent through Stripe.<br>After an exchange, your private data (credit cards, social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p><p><br><\\/p><\\/div><div><h3>Do we disclose any information to outside parties?<\\/h3><p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude confided in outsiders who help us in working our site, leading our business, or adjusting you, since those gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or well being.<\\/p><p><br><\\/p><\\/div><div><h3>Children\'s Online Privacy Protection Act Compliance<\\/h3><p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to individuals who are in any event 13 years of age or more established.<\\/p><p><br><\\/p><\\/div><div><h3>Changes to our Privacy Policy<\\/h3><p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p><p><br><\\/p><\\/div><div><h3>How long we retain your information?<\\/h3><p>At the point when you register for our site, we cycle and keep your information we have about you however long you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p><p><br><\\/p><\\/div><div><h3>What we don\\u2019t do with your data<\\/h3><p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for the promoting of their items or administrations.<\\/p><\\/div>\",\"status\":1}', NULL, 'elegant', NULL, '2020-07-04 23:42:52', '2024-06-11 04:52:15'),
(128, 'counter.content', '{\"heading\":\"Latest News\",\"sub_heading\":\"Register New Account\"}', NULL, 'elegant', NULL, '2020-10-28 01:04:02', '2020-10-28 01:04:02'),
(129, 'dining.content', '{\"has_image\":\"1\",\"heading\":\"Restaurants Celebrating International Flavors\",\"description\":\"Distinct flavors from around the world come together to create a culinary journey at The Ritz-Carlton, Doha, each restaurant specializes in superlative experiences that celebrate the flavors of Qatar and beyond.\",\"image\":\"674f00aa6dcfa1733230762.png\"}', NULL, 'elegant', '', '2024-12-03 06:59:22', '2024-12-03 07:03:24'),
(130, 'extra_service.content', '{\"heading\":\"Our ViserHotel\",\"subheading\":\"Because you deserve the best, especially when you stay with us.\"}', NULL, 'elegant', '', '2024-11-25 03:06:54', '2024-11-25 03:06:54'),
(131, 'facility.content', '{\"heading\":\"Unforgettable experience. Unmatched curations.\",\"subheading\":\"Because you deserve the best, especially when you stay with us.\"}', NULL, 'elegant', '', '2024-11-25 02:59:22', '2024-11-25 02:59:22'),
(132, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Rooms & Suites\",\"description\":\"Relax in our stylish rooms and suites designed for comfort and luxury.\\r\\nEach room includes modern amenities, cozy beds, and stunning views.\\r\\nIdeal for solo travelers, couples, and families.\",\"image\":\"684ea642a04431749984834.jpg\"}', NULL, 'elegant', '', '2025-06-15 04:53:54', '2025-06-15 04:53:54'),
(133, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Restaurant & Dining\",\"description\":\"Enjoy a delightful dining experience with local and international cuisine.\\r\\nOur in-house restaurant offers \\u00e0 la carte, buffet, and room service options.\\r\\nFresh ingredients and expert chefs make every meal memorable.\",\"image\":\"6874ffe7c29851752498151.png\"}', NULL, 'elegant', '', '2025-06-15 04:55:12', '2025-07-14 07:02:31'),
(134, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Spa & Wellness\",\"description\":\"Rejuvenate with our professional spa therapies and wellness treatments.\\r\\nChoose from massages, facials, steam baths, and more.\\r\\nPerfect for unwinding after a long journey or busy day.\",\"image\":\"6874ffe08539d1752498144.png\"}', NULL, 'elegant', '', '2025-06-15 04:56:29', '2025-07-14 07:02:24'),
(135, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Swimming Pool\",\"description\":\"Take a dip in our clean, temperature-controlled swimming pool.\\r\\nWhether you want to swim laps or relax poolside, we\\u2019ve got you covered.\\r\\nKids\' pool and loungers available for family fun.\",\"image\":\"684ea72c5174e1749985068.jpg\"}', NULL, 'elegant', '', '2025-06-15 04:57:48', '2025-06-15 04:57:48'),
(136, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Fitness Center\",\"description\":\"Stay fit during your stay with access to our fully equipped gym.\\r\\nCardio machines, weights, and personal training available.\\r\\nOpen daily for all registered guests.\",\"image\":\"684ea765f21e81749985125.jpg\"}', NULL, 'elegant', '', '2025-06-15 04:58:45', '2025-06-15 04:58:46'),
(137, 'facility.element', '{\"has_image\":\"1\",\"title\":\"Conference & Banquet Hall\",\"description\":\"Host business meetings, conferences, or special events with ease.\\r\\nOur halls are equipped with AV tech, Wi-Fi, and comfortable seating.\\r\\nCustomizable layouts and catering options provided.\",\"image\":\"684ea7aa66c5d1749985194.jpg\"}', NULL, 'elegant', '', '2025-06-15 04:59:54', '2025-06-15 04:59:54'),
(138, 'faq.content', '{\"heading\":\"What Our Customer Says\",\"subheading\":\"Because you deserve the best, especially when you stay with us.\"}', NULL, 'elegant', '', '2022-04-05 13:34:46', '2024-11-23 07:00:55'),
(139, 'faq.element', '{\"question\":\"Can I cancel or modify my booking?\",\"answer\":\"Yes, cancellations and modifications depend on the hotel\'s policy. You can manage your bookings through your account.\"}', NULL, 'elegant', '', '2022-04-05 13:35:20', '2025-07-14 04:58:29'),
(140, 'faq.element', '{\"question\":\"What we serve?\",\"answer\":\"Condimentum nec, nisi. Praesent nec nisl a purus blandit viverra.raesent ac massa at ligula laoreet iaculis. Nulla neque dolor sagittis eget iaculis quis molestie non velit. Mauris turpis nunc.\"}', NULL, 'elegant', NULL, '2022-04-05 13:36:31', '2022-04-05 13:36:31'),
(141, 'faq.element', '{\"question\":\"How to cancel booking?\",\"answer\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam aliquam at lectus sed dignissim. In posuere ex dui, ac lacinia risus elementum non\"}', NULL, 'elegant', NULL, '2022-05-21 06:40:42', '2022-05-21 06:40:42'),
(142, 'faq.element', '{\"question\":\"What is our refund policy?\",\"answer\":\"Curabitur gravida diam sed facilisis aliquet. Nam vel turpis metus. Fusce luctus convallis purus vel malesuada. Sed ultrices magna quis eros posuere.\"}', NULL, 'elegant', NULL, '2022-05-21 06:41:17', '2022-05-21 06:41:17'),
(143, 'faq.element', '{\"question\":\"Will I receive confirmation after booking?\",\"answer\":\"Yes, you will receive a confirmation email and can view your booking details in your ViserHotel dashboard.\"}', NULL, 'elegant', '', '2022-06-02 06:23:27', '2025-07-14 04:58:02'),
(144, 'faq.element', '{\"question\":\"I forgot my password. What should I do?\",\"answer\":\"Click on Forgot Password on the login page and follow the instructions to reset your password.\"}', NULL, 'elegant', '', '2022-06-02 06:23:47', '2025-07-14 04:57:35'),
(145, 'faq.element', '{\"question\":\"Is my personal and payment information secure?\",\"answer\":\"Yes, ViserHotel uses industry-standard encryption and security protocols to protect your data.\"}', NULL, 'elegant', '', '2022-06-02 06:24:08', '2025-07-14 04:57:09'),
(146, 'faq.element', '{\"question\":\"What payment methods are accepted?\",\"answer\":\"We accept credit\\/debit cards, mobile payments, and other local gateways depending on your country.\"}', NULL, 'elegant', '', '2022-06-02 06:24:37', '2025-07-14 04:56:11'),
(147, 'faq.element', '{\"question\":\"How do I book a room?\",\"answer\":\"Search for your destination and dates, browse available hotels, select your room, and proceed with payment to confirm the booking.\"}', NULL, 'elegant', '', '2022-06-02 06:24:48', '2025-07-14 04:55:55'),
(148, 'feature.content', '{\"heading\":\"asdf\",\"sub_heading\":\"asdf\"}', NULL, 'elegant', NULL, '2021-01-03 23:40:54', '2021-01-03 23:40:55'),
(149, 'feature.element', '{\"title\":\"asdf\",\"description\":\"asdf\",\"feature_icon\":\"asdf\"}', NULL, 'elegant', NULL, '2021-01-03 23:41:02', '2021-01-03 23:41:02'),
(150, 'featured_room.content', '{\"heading\":\"Featured Rooms\",\"subheading\":\"Every room type has many rooms. Anyone can send booking requrest from this site.\"}', NULL, 'elegant', NULL, '2022-06-19 07:05:06', '2022-06-23 06:37:14'),
(151, 'footer.content', '{\"has_image\":\"1\",\"description\":\"Maecenas nec odio et ante tincid empus. Donec vitae sapien ut libero venaucibus. Nullam quis ante. Etiam sit amet.\",\"image\":\"664f305dba2b31716465757.jpg\"}', NULL, 'elegant', '', '2022-05-21 07:07:45', '2024-05-23 06:02:37'),
(152, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de69dc53651737352861.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:01', '2025-01-20 00:01:02'),
(153, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6a3253b81737352867.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:07', '2025-01-20 00:01:07'),
(154, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6a814bc41737352872.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:12', '2025-01-20 00:01:12'),
(155, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6aeb19461737352878.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:18', '2025-01-20 00:01:19'),
(156, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6b385a751737352883.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:23', '2025-01-20 00:01:23'),
(157, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6b8efc441737352888.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:28', '2025-01-20 00:01:29'),
(158, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6bde51c61737352893.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:33', '2025-01-20 00:01:34'),
(159, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6c3207691737352899.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:39', '2025-01-20 00:01:39'),
(160, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6c96cdae1737352905.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:45', '2025-01-20 00:01:45'),
(161, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6d5396e31737352917.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:01:57', '2025-01-20 00:01:57'),
(162, 'gallery.element', '{\"has_image\":\"1\",\"image\":\"678de6dd293791737352925.jpg\"}', NULL, 'elegant', '', '2025-01-20 00:02:05', '2025-01-20 00:02:05'),
(163, 'hotel_overview.content', '{\"heading\":\"The Viserhotel\",\"subheading\":\"AT A GLANCE\"}', NULL, 'elegant', '', '2024-11-23 05:31:32', '2024-11-23 05:31:32'),
(164, 'hotel_overview.element', '{\"has_image\":\"1\",\"description\":\"Relax in the comfort of our master bedroom suites, featuring plush bedding, refined d\\u00e9cor, and private balconies overlooking serene landscapes.\",\"image\":\"6741bd66ba62a1732361574.png\"}', NULL, 'elegant', '', '2024-11-23 05:32:54', '2025-07-14 05:18:01'),
(165, 'hotel_overview.element', '{\"has_image\":\"1\",\"description\":\"Savor intimate dining experiences in our elegantly appointed restaurant, where ambient lighting and gourmet cuisine create the perfect evening retreat.\",\"image\":\"6741bd739a0c31732361587.png\"}', NULL, 'elegant', '', '2024-11-23 05:33:07', '2025-07-14 05:17:51'),
(166, 'hotel_overview.element', '{\"has_image\":\"1\",\"description\":\"Discover curated local flavors at our contemporary fine-dining restaurant, where every dish tells a story of taste and tradition.\",\"image\":\"6741bd7d7e6201732361597.png\"}', NULL, 'elegant', '', '2024-11-23 05:33:17', '2025-07-14 05:16:58'),
(167, 'hotel_overview.element', '{\"has_image\":\"1\",\"description\":\"Effortless comfort meets timeless design in our thoughtfully styled guest rooms, each offering breathtaking city or waterfront views.\",\"image\":\"6741beaf1fd1d1732361903.png\"}', NULL, 'elegant', '', '2024-11-23 05:38:23', '2025-07-14 05:16:05'),
(168, 'location.content', '{\"heading\":\"Our Location\",\"subheading\":\"Come visit our friendly team at one of our offices.\",\"map_embed_link\":\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d3152.138201728459!2d144.95789965174635!3d-37.81023176178767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642cae530b1c9%3A0x59444c336aced016!2sMelbourne%20Central!5e0!3m2!1sen!2sbd!4v1733296794058!5m2!1sen!2sbd\"}', NULL, 'elegant', '', '2024-11-23 06:41:55', '2025-06-15 07:27:35'),
(169, 'login.content', '{\"has_image\":\"1\",\"heading\":\"Log In Your Account\",\"image\":\"6744585fe25d41732532319.png\"}', NULL, 'elegant', '', '2022-04-06 01:40:04', '2025-06-25 04:02:36'),
(170, 'maintenance_mode.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b8578719e9e1656248199.png\"}', NULL, 'elegant', NULL, '2022-06-26 06:48:45', '2022-06-26 06:56:39'),
(171, 'maintenance_page.content', '{\"has_image\":\"1\",\"heading\":\"THE SITE IS UNDER MAINTENANCE\",\"image\":\"62b92e3bdf08d1656303163.png\"}', NULL, 'elegant', NULL, '2022-06-26 22:12:43', '2022-06-26 22:12:44'),
(172, 'maintenance.data', '{\"description\":\"<div style=\\\"font-family: Nunito, sans-serif;\\\">\\r\\n        <h2 style=\\\"font-family: Poppins, sans-serif; text-align: center;\\\">\\r\\n            We\'re Just Tuning Up a Few Things\\r\\n        <\\/h2>\\r\\n       \\r\\n        <p style=\\\"text-align: center; font-size: 1rem;\\\">\\r\\n            We apologize for the inconvenience but Front is currently undergoing planned maintenance. Thanks for your patience\\r\\n        <\\/p>\\r\\n        \\r\\n    <\\/div>\",\"image\":\"6668270c9f0a91718101772.png\"}', NULL, 'elegant', NULL, '2023-02-02 05:56:42', '2025-02-05 04:51:06'),
(173, 'offer_section_two.content', '{\"heading\":\"More rooms\",\"subheading\":\"Because you deserve the best, especially when you stay with us.\"}', NULL, 'elegant', '', '2025-07-10 04:00:39', '2025-07-10 04:00:39'),
(174, 'offer.content', '{\"heading\":\"OUR OFFERS\",\"subheading\":\"Book and get offers\"}', NULL, 'elegant', '', '2024-12-03 04:20:15', '2025-06-16 00:41:09'),
(175, 'planing.content', '{\"heading\":\"Planing\",\"subheading\":\"Your Special Day\"}', NULL, 'elegant', '', '2024-12-08 05:33:32', '2024-12-08 05:33:32'),
(176, 'planing.element', '{\"has_image\":\"1\",\"title\":\"A Superbly Romantic Location\",\"description\":\"Donec mollis hendrerit risus. Quisque id odio. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Proin pretium, leo ac pellentesque mollis, felis nunc ultrices eros, sed gravida augue augue mollis justo. Praesent ac sem eget est egestas volutpat.\\r\\n\\r\\nNulla consequat massa quis enim. Quisque ut nisi. Maecenas egestas arcu quis ligula mattis placerat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit.\",\"image\":\"675584369c6481733657654.png\"}', NULL, 'elegant', '', '2024-12-08 05:34:14', '2024-12-08 05:34:14'),
(177, 'planing.element', '{\"has_image\":\"1\",\"title\":\"A Superbly Romantic Location\",\"description\":\"Donec vitae orci sed dolor rutrum auctor. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Curabitur blandit mollis lacus. Nullam accumsan lorem in dui. Sed a libero.\\r\\n\\r\\nVestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Nullam accumsan lorem in dui. Suspendisse potenti.\",\"image\":\"675584673f01c1733657703.png\"}', NULL, 'elegant', '', '2024-12-08 05:35:03', '2024-12-08 05:35:03'),
(178, 'policy_pages.element', '{\"title\":\"Privacy Policy\",\"details\":\"<div>\\r\\n    <h4>What information do we collect?<\\/h4>\\r\\n    <p>We gather data from you when you register on our site, submit a request, buy any services, react to an overview,\\r\\n        or round out a structure. At the point when requesting any assistance or enrolling on our site, as suitable, you\\r\\n        might be approached to enter your: name, email address, or telephone number. You may, nonetheless, visit our\\r\\n        site anonymously.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>How do we protect your information?<\\/h4>\\r\\n    <p>All provided delicate\\/credit data is sent through Stripe.<br \\/>After an exchange, your private data (credit cards,\\r\\n        social security numbers, financials, and so on) won\'t be put away on our workers.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Do we disclose any information to outside parties?<\\/h4>\\r\\n    <p>We don\'t sell, exchange, or in any case move to outside gatherings by and by recognizable data. This does exclude\\r\\n        confided in outsiders who help us in working our site, leading our business, or adjusting you, since those\\r\\n        gatherings consent to keep this data private. We may likewise deliver your data when we accept discharge is\\r\\n        suitable to follow the law, implement our site strategies, or ensure our own or others\' rights, property, or\\r\\n        well being.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Children\'s Online Privacy Protection Act Compliance<\\/h4>\\r\\n    <p>We are consistent with the prerequisites of COPPA (Children\'s Online Privacy Protection Act), we don\'t gather any\\r\\n        data from anybody under 13 years old. Our site, items, and administrations are completely coordinated to\\r\\n        individuals who are in any event 13 years of age or more established.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Changes to our Privacy Policy<\\/h4>\\r\\n    <p>If we decide to change our privacy policy, we will post those changes on this page.<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>How long we retain your information?<\\/h4>\\r\\n    <p>At the point when you register for our site, we cycle and keep your information we have about you however long\\r\\n        you don\'t erase the record or withdraw yourself (subject to laws and guidelines).<\\/p>\\r\\n    <p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>What we don\\u2019t do with your data<\\/h4>\\r\\n    <p>We don\'t and will never share, unveil, sell, or in any case give your information to different organizations for\\r\\n        the promoting of their items or administrations.<\\/p>\\r\\n<\\/div>\"}', NULL, 'elegant', 'privacy-policy', '2021-06-09 08:50:42', '2025-07-09 00:28:22'),
(179, 'policy_pages.element', '{\"title\":\"Terms of Service\",\"details\":\"<div>\\r\\n    <p>We claim all authority to dismiss, end,\\r\\n        or handicap any help with or without cause per administrator discretion. This is a Complete independent\\r\\n        facilitating, on the off chance that you misuse our ticket or Livechat or emotionally supportive network by\\r\\n        submitting solicitations or protests we will impair your record. The solitary time you should reach us about the\\r\\n        seaward facilitating is if there is an issue with the worker. We have not many substance limitations and\\r\\n        everything is as per laws and guidelines. Try not to join on the off chance that you intend to do anything\\r\\n        contrary to the guidelines, we do check these things and we will know, don\'t burn through our own and your time\\r\\n        by joining on the off chance that you figure you will have the option to sneak by us and break the terms.<\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <ul>\\r\\n        <li>Configuration requests - If you have a fully\\r\\n            managed dedicated server with us then we offer custom PHP\\/MySQL configurations, firewalls for dedicated IPs,\\r\\n            DNS, and httpd configurations.<\\/li>\\r\\n        <li>Software requests - Cpanel Extension Installation\\r\\n            will be granted as long as it does not interfere with the security, stability, and performance of other\\r\\n            users on the server.<\\/li>\\r\\n        <li>Emergency Support - We do not provide emergency\\r\\n            support \\/ Phone Support \\/ LiveChat Support. Support may take some hours sometimes.<\\/li>\\r\\n        <li>Webmaster help - We do not offer any support for\\r\\n            webmaster related issues and difficulty including coding, & installs, Error solving. if there is an\\r\\n            issue where a library or configuration of the server then we can help you if it\'s possible from our end.\\r\\n        <\\/li>\\r\\n        <li>Backups - We keep backups but we are not\\r\\n            responsible for data loss, you are fully responsible for all backups.<\\/li>\\r\\n        <li>We Don\'t support any child porn or such material.\\r\\n        <\\/li>\\r\\n        <li>No spam-related sites or material, such as email\\r\\n            lists, mass mail programs, and scripts, etc.<\\/li>\\r\\n        <li>No harassing material that may cause people to\\r\\n            retaliate against you.<\\/li>\\r\\n        <li>No phishing pages.<\\/li>\\r\\n        <li>You may not run any exploitation script from the\\r\\n            server. reason can be terminated immediately.<\\/li>\\r\\n        <li>If Anyone attempting to hack or exploit the server\\r\\n            by using your script or hosting, we will terminate your account to keep safe other users.<\\/li>\\r\\n        <li>Malicious Botnets are strictly forbidden.<\\/li>\\r\\n        <li>Spam, mass mailing, or email marketing in any way\\r\\n            are strictly forbidden here.<\\/li>\\r\\n        <li>Malicious hacking materials, trojans, viruses,\\r\\n            & malicious bots running or for download are forbidden.<\\/li>\\r\\n        <li>Resource and cronjob abuse is forbidden and will\\r\\n            result in suspension or termination.<\\/li>\\r\\n        <li>Php\\/CGI proxies are strictly forbidden.<\\/li>\\r\\n        <li>CGI-IRC is strictly forbidden.<\\/li>\\r\\n        <li>No fake or disposal mailers, mass mailing, mail\\r\\n            bombers, SMS bombers, etc.<\\/li>\\r\\n        <li>NO CREDIT OR REFUND will be granted for\\r\\n            interruptions of service, due to User Agreement violations.<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Terms\\r\\n        & Conditions for Users<\\/h4>\\r\\n    <p>Before getting to this site, you are\\r\\n        consenting to be limited by these site Terms and Conditions of Use, every single appropriate law, and\\r\\n        guidelines, and concur that you are answerable for consistency with any material neighborhood laws. If you\\r\\n        disagree with any of these terms, you are restricted from utilizing or getting to this site.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Support\\r\\n    <\\/h4>\\r\\n    <p>Whenever you have downloaded our item,\\r\\n        you may get in touch with us for help through email and we will give a valiant effort to determine your issue.\\r\\n        We will attempt to answer using the Email for more modest bug fixes, after which we will refresh the center\\r\\n        bundle. Content help is offered to confirmed clients by Tickets as it were. Backing demands made by email and\\r\\n        Livechat.<\\/p>\\r\\n    <p>On the off chance\\r\\n        that your help requires extra adjustment of the System, at that point, you have two alternatives:<\\/p>\\r\\n    <ul>\\r\\n        <li>Hang tight for additional update discharge.<\\/li>\\r\\n        <li>Or on the other hand, enlist a specialist (We offer\\r\\n            customization for extra charges).<\\/li><li><br \\/><\\/li>\\r\\n    <\\/ul>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>\\r\\n        Ownership<\\/h4>\\r\\n    <p>You may not guarantee scholarly or\\r\\n        selective possession of any of our items, altered or unmodified. All items are property, we created them. Our\\r\\n        items are given \\\"with no guarantees\\\" without guarantee of any sort, either communicated or suggested. On no\\r\\n        occasion will our juridical individual be subject to any harms including, however not restricted to, immediate,\\r\\n        roundabout, extraordinary, accidental, or significant harms or different misfortunes emerging out of the\\r\\n        utilization of or powerlessness to utilize our items.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Warranty\\r\\n    <\\/h4>\\r\\n    <p>We don\'t offer any guarantee or\\r\\n        assurance of these Services in any way. When our Services have been modified we can\'t ensure they will work with\\r\\n        all outsider plugins, modules, or internet browsers. Program similarity ought to be tried against the show\\r\\n        formats on the demo worker. If you don\'t mind guarantee that the programs you use will work with the component,\\r\\n        as we can not ensure that our systems will work with all program mixes.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>\\r\\n        Unauthorized\\/Illegal Usage<\\/h4>\\r\\n    <p>You may not utilize our things for any\\r\\n        illicit or unapproved reason or may you, in the utilization of the stage, disregard any laws in your locale\\r\\n        (counting yet not restricted to copyright laws) just as the laws of your nation and International law.\\r\\n        Specifically, it is disallowed to utilize the things on our foundation for pages that advance: brutality,\\r\\n        illegal intimidation, hard sexual entertainment, bigotry, obscenity content or warez programming\\r\\n        joins.<br \\/><br \\/>You can\'t imitate, copy, duplicate, sell, exchange or adventure any of our segment, utilization of\\r\\n        the offered on our things, or admittance to the administration without the express composed consent by us or\\r\\n        item proprietor.<br \\/><br \\/>Our Members are liable for all substance posted on the discussion and demo and movement\\r\\n        that happens under your record.<br \\/><br \\/>We hold the chance of hindering your participation account quickly if we\\r\\n        will think about a particularly not allowed conduct.<br \\/><br \\/>If you make a record on our site, you are liable for\\r\\n        keeping up the security of your record, and you are completely answerable for all exercises that happen under\\r\\n        the record and some other activities taken regarding the record. You should quickly inform us, of any unapproved\\r\\n        employments of your record or some other penetrates of security.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Fiverr,\\r\\n        Seoclerks Sellers Or Affiliates<\\/h4>\\r\\n    <p>We do NOT ensure full SEO campaign\\r\\n        conveyance within 24 hours. We make no assurance for conveyance time by any means. We give our best assessment\\r\\n        to orders during the putting in of requests, anyway, these are gauges. We won\'t be considered liable for loss of\\r\\n        assets, negative surveys or you being prohibited for late conveyance. If you are selling on a site that requires\\r\\n        time touchy outcomes, utilize Our SEO Services at your own risk.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>\\r\\n        Payment\\/Refund Policy<\\/h4>\\r\\n    <p>No refund or cash back will be made.\\r\\n        After a deposit has been finished, it is extremely unlikely to invert it. You should utilize your equilibrium on\\r\\n        requests our administrations, Hosting, SEO campaign. You concur that once you complete a deposit, you won\'t\\r\\n        document a debate or a chargeback against us in any way, shape, or form.<br \\/><br \\/>If you document a debate or\\r\\n        chargeback against us after a deposit, we claim all authority to end every single future request, prohibit you\\r\\n        from our site. False action, for example, utilizing unapproved or taken charge cards will prompt the end of your\\r\\n        record. There are no special cases.<\\/p><p><br \\/><\\/p>\\r\\n<\\/div>\\r\\n<div>\\r\\n    <h4>Free\\r\\n        Balance \\/ Coupon Policy<\\/h4>\\r\\n    <p>We offer numerous approaches to get FREE\\r\\n        Balance, Coupons and Deposit offers yet we generally reserve the privilege to audit it and deduct it from your\\r\\n        record offset with any explanation we may it is a sort of misuse. If we choose to deduct a few or all of free\\r\\n        Balance from your record balance, and your record balance becomes negative, at that point the record will\\r\\n        naturally be suspended. If your record is suspended because of a negative Balance you can request to make a\\r\\n        custom payment to settle your equilibrium to actuate your record.<\\/p>\\r\\n<\\/div>\"}', NULL, 'elegant', 'terms-of-service', '2021-06-09 08:51:18', '2025-07-09 00:29:10'),
(180, 'policy_pages.element', '{\"title\":\"Cancellation Policy\",\"details\":\"<div class=\\\"cancellation-policy\\\">\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\">Standard Bookings<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <p><strong>Free Cancellation:<\\/strong> Up to <span class=\\\"highlight\\\">48 hours<\\/span> before check-in (local\\r\\n                time).<\\/p>\\r\\n            <p><strong>Late Cancellation\\/No-Show:<\\/strong><\\/p>\\r\\n            <ul>\\r\\n                <li>Cancellations within 48 hours of check-in or no-shows will incur a charge of <span class=\\\"highlight\\\">one night\'s room rate + taxes<\\/span>.<\\/li>\\r\\n                <li>Non-refundable rates (if selected) are charged in full at booking and <span class=\\\"highlight\\\">cannot<\\/span> be modified or refunded.<\\/li>\\r\\n            <\\/ul>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\">Group & Extended Stays (5+ rooms or 7+ nights)<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <p><strong>Free Cancellation:<\\/strong> Up to <span class=\\\"highlight\\\">7 days<\\/span> before arrival.<\\/p>\\r\\n            <p><strong>Late Cancellation:<\\/strong><\\/p>\\r\\n            <ul>\\r\\n                <li><span class=\\\"highlight\\\">50% charge<\\/span> for cancellations made 3-7 days before check-in.<\\/li>\\r\\n                <li><span class=\\\"highlight\\\">100% charge<\\/span> for cancellations within 72 hours or no-shows.<\\/li>\\r\\n            <\\/ul>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\">Peak Season & Special Events<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <p>During holidays, festivals, or high-demand periods:<\\/p>\\r\\n            <ul>\\r\\n                <li><strong>Stricter Policy:<\\/strong> Free cancellation only <span class=\\\"highlight\\\">14 days<\\/span>\\r\\n                    prior.<\\/li>\\r\\n                <li><strong>Within 14 days:<\\/strong> <span class=\\\"highlight\\\">Non-refundable<\\/span> (full stay charged).\\r\\n                <\\/li>\\r\\n            <\\/ul>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\">Early Departures<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <p>Guests checking out early will be charged for the <span class=\\\"highlight\\\">original reserved stay<\\/span>\\r\\n                unless management approves otherwise.<\\/p>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\">Modifications<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <ul>\\r\\n                <li>Changes to dates are subject to availability and <span class=\\\"highlight\\\">rate differences<\\/span>.\\r\\n                <\\/li>\\r\\n                <li><span class=\\\"highlight\\\">No fee<\\/span> if modified outside cancellation windows.<\\/li>\\r\\n            <\\/ul>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-section\\\">\\r\\n        <h6 class=\\\"section-title mt-3\\\"> Force Majeure Exceptions<\\/h6>\\r\\n        <div class=\\\"section-content\\\">\\r\\n            <p>Waivers may apply for <span class=\\\"highlight\\\">documented emergencies<\\/span> (medical, natural disasters,\\r\\n                flight cancellations) with proof provided within <span class=\\\"highlight\\\">48 hours<\\/span>.<\\/p>\\r\\n        <\\/div>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"refund-process\\\">\\r\\n        <h6>Refund Process<\\/h6>\\r\\n        <ul>\\r\\n            <li>Refunds (if applicable) are processed in <span class=\\\"highlight\\\">5-10 business days<\\/span> to the\\r\\n                original payment method.<\\/li>\\r\\n            <li><strong>Contact Us:<\\/strong> For urgent requests, email <a href=\\\"mailto:reservations@viserhotel.com\\\">reservations@viserhotel.com<\\/a> or call <span class=\\\"highlight\\\">+XXX-XXX-XXXX<\\/span>.<\\/li>\\r\\n        <\\/ul>\\r\\n    <\\/div>\\r\\n\\r\\n    <div class=\\\"policy-footer\\\">\\r\\n        <h6 class=\\\"mt-3\\\">Why This Policy?<\\/h6>\\r\\n        <ul>\\r\\n            <li><strong>Fairness:<\\/strong> Balances guest flexibility with operational needs.<\\/li>\\r\\n            <li><strong>Transparency:<\\/strong> No hidden fees - all terms are clear upfront.<\\/li>\\r\\n            <li><strong>Protection:<\\/strong> Ensures we can accommodate last-minute bookings fairly.<\\/li>\\r\\n        <\\/ul>\\r\\n\\r\\n        <h6 class=\\\"mt-3\\\">How to Cancel\\/Modify<\\/h6>\\r\\n        <ol>\\r\\n            <li><strong>Online:<\\/strong> Access your booking via our website\\/app.<\\/li>\\r\\n            <li><strong>Email\\/Phone:<\\/strong> Contact our reservations team.<\\/li>\\r\\n        <\\/ol>\\r\\n    <\\/div>\\r\\n<\\/div>\"}', NULL, 'elegant', 'cancellation-policy', '2022-07-04 08:52:24', '2025-07-14 06:49:35'),
(181, 'register.content', '{\"has_image\":\"1\",\"heading\":\"Provide the Below Information & Complete Your Registration Process\",\"image\":\"674d818e8971c1733132686.png\"}', NULL, 'elegant', '', '2022-04-06 01:40:45', '2025-07-15 02:17:02'),
(182, 'room_suite_menu.content', '{\"short_description\":\"Occupying four adjacent buildings along the Bosphorus, The Peninsula Istanbul offers guests a diverse array of accommodation choices.\"}', NULL, 'elegant', '', '2025-01-11 01:48:31', '2025-01-11 01:48:31'),
(183, 'room_type.content', '{\"heading\":\"Accommodations\",\"subheading\":\"Because you deserve the best, especially when you stay with us.\"}', NULL, 'elegant', '', '2024-11-23 05:16:24', '2024-11-23 05:16:24'),
(184, 'seo.data', '{\"seo_image\":\"1\",\"keywords\":[\"hotel\",\"booking\",\"room booking\",\"reservation\",\"room reservation\",\"hotel booking\",\"night\",\"day\",\"premium\",\"royal\"],\"description\":\"ViserHotel - Ultimate hotel booking solution.\",\"social_title\":\"Viserlab Limited\",\"social_description\":\"ViserHotel - Ultimate hotel booking solution.\",\"image\":\"6668271ed415e1718101790.png\"}', NULL, 'elegant', '', '2020-07-04 23:42:52', '2024-06-11 04:29:51'),
(185, 'service.content', '{\"has_image\":\"1\",\"heading\":\"Our Hotel services\",\"subheading\":\"Maecenas nec odio et ante tincidunt tempus. Donec vitae apitlibero venenatis faucibus. Nullam quis ante. Etiam sit amet orci\",\"video_url\":\"https:\\/\\/www.youtube.com\\/embed\\/WOb4cj7izpE\",\"video_thumb\":\"664f2c6732f171716464743.jpg\"}', NULL, 'elegant', '', '2021-03-06 01:27:34', '2024-05-23 05:45:43'),
(186, 'service.element', '{\"name\":\"Health Care\",\"icon\":\"<i class=\\\"fas fa-ambulance\\\"><\\/i>\"}', NULL, 'elegant', NULL, '2022-05-21 06:23:17', '2022-05-21 06:23:17'),
(187, 'service.element', '{\"name\":\"Swimming Pool\",\"icon\":\"<i class=\\\"fas fa-swimming-pool\\\"><\\/i>\"}', NULL, 'elegant', NULL, '2022-05-21 06:23:45', '2022-05-21 06:23:45'),
(188, 'service.element', '{\"name\":\"Travelling\",\"icon\":\"<i class=\\\"fas fa-plane-departure\\\"><\\/i>\"}', NULL, 'elegant', NULL, '2022-05-21 06:24:13', '2022-05-21 06:24:13'),
(189, 'service.element', '{\"name\":\"BBQ Resturant\",\"icon\":\"<i class=\\\"fas fa-hotel\\\"><\\/i>\"}', NULL, 'elegant', NULL, '2022-05-21 06:25:33', '2022-05-21 06:26:16'),
(190, 'social_icon.element', '{\"title\":\"Facebook\",\"social_icon\":\"<i class=\\\"lab la-facebook-f\\\"><\\/i>\",\"url\":\"https:\\/\\/www.facebook.com\\/\"}', NULL, 'elegant', '', '2020-11-12 04:07:30', '2024-11-23 03:45:28'),
(191, 'social_icon.element', '{\"title\":\"Twitter\",\"social_icon\":\"<i class=\\\"fa-brands fa-x-twitter\\\"><\\/i>\",\"url\":\"https:\\/\\/twitter.com\\/\"}', NULL, 'elegant', '', '2022-04-04 05:47:23', '2024-11-23 03:45:12'),
(192, 'social_icon.element', '{\"title\":\"Instagram\",\"social_icon\":\"<i class=\\\"fab fa-instagram\\\"><\\/i>\",\"url\":\"https:\\/\\/www.instagram.com\\/\"}', NULL, 'elegant', NULL, '2022-04-04 05:48:22', '2022-04-04 05:48:22'),
(193, 'social_icon.element', '{\"title\":\"Linkedin\",\"social_icon\":\"<i class=\\\"fab fa-linkedin\\\"><\\/i>\",\"url\":\"https:\\/\\/viserlab.com\\/\"}', NULL, 'elegant', '', '2025-07-12 02:38:53', '2025-07-12 02:38:53'),
(194, 'subscribe.content', '{\"has_image\":\"1\",\"heading\":\"Stay inspired with our newsletter\",\"policy_text\":\"All information provided will be handled in accordance with our\",\"button_text\":\"Subscribe\",\"background\":\"6744286ebf3f41732520046.png\"}', NULL, 'elegant', '', '2022-04-05 08:49:16', '2024-11-25 01:43:12'),
(195, 'testimonial.content', '{\"has_image\":\"1\",\"background_image\":\"68720f2a32cd61752305450.png\"}', NULL, 'elegant', '', '2022-04-05 12:55:06', '2025-07-12 01:30:50'),
(196, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Elvis Gentry\",\"rating\":\"2\",\"feedback\":\"Experience unparalleled luxury and personalized service at Almaris Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories.\",\"image\":\"6874feb1920dc1752497841.png\"}', NULL, 'elegant', '', '2022-05-21 06:31:29', '2025-07-14 06:57:21'),
(197, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Mohammad Bright\",\"rating\":\"5\",\"feedback\":\"Experience unparalleled luxury and personalized service at Almaris Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories.\",\"image\":\"6874feaaaf6801752497834.png\"}', NULL, 'elegant', '', '2022-05-21 06:31:44', '2025-07-14 06:57:14'),
(198, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Nasim Knapp\",\"rating\":\"5\",\"feedback\":\"Thank you for a truly amazing stay! Your hospitality is quite outstanding. The sports centre is also very good with excellent quality tennis courts. Hope to be back soon.\",\"image\":\"6874fea382a3c1752497827.png\"}', NULL, 'elegant', '', '2022-05-21 06:31:53', '2025-07-14 06:57:07'),
(199, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Amy Vazquez\",\"rating\":\"3\",\"feedback\":\"Experience unparalleled luxury and personalized service at Almaris Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories.\",\"image\":\"6874fe99ebe461752497817.png\"}', NULL, 'elegant', '', '2022-05-21 06:32:00', '2025-07-14 06:56:57'),
(200, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Connor Cooke\",\"rating\":\"5\",\"feedback\":\"Experience unparalleled luxury and personalized service at Almaris Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories.\",\"image\":\"6874fe92447a01752497810.png\"}', NULL, 'elegant', '', '2022-05-21 06:32:09', '2025-07-14 06:56:51'),
(201, 'testimonial.element', '{\"has_image\":[\"1\"],\"name\":\"Hope Mills\",\"rating\":\"4\",\"feedback\":\"Experience unparalleled luxury and personalized service at Almaris Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories.\",\"image\":\"6741cffddfdf21732366333.png\"}', NULL, 'elegant', '', '2022-05-21 06:32:16', '2025-07-10 06:39:54'),
(202, 'topnav.content', '{\"email\":\"viserhotel@gmail.com\",\"telephone\":\"123 - 4567890\"}', NULL, 'elegant', NULL, '2022-04-04 05:46:37', '2022-04-04 05:57:05'),
(203, 'video.element', '{\"has_image\":\"1\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/watch?v=qemqQHaeCYo\",\"image\":\"678df5fee44901737356798.png\"}', NULL, 'elegant', '', '2025-01-20 01:06:38', '2025-01-20 01:06:40'),
(204, 'video.element', '{\"has_image\":\"1\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/watch?v=mJVuZiK9a6I\",\"image\":\"678df609ec75a1737356809.png\"}', NULL, 'elegant', '', '2025-01-20 01:06:49', '2025-01-20 01:06:50'),
(205, 'video.element', '{\"has_image\":\"1\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/watch?v=lgweRLUXOE0\",\"image\":\"678df618cf41a1737356824.png\"}', NULL, 'elegant', '', '2025-01-20 01:07:04', '2025-01-20 01:07:04'),
(206, 'video.element', '{\"has_image\":\"1\",\"youtube_link\":\"https:\\/\\/www.youtube.com\\/watch?v=Hp2Hh-93IrA\",\"image\":\"678df624590bb1737356836.png\"}', NULL, 'elegant', '', '2025-01-20 01:07:16', '2025-01-20 01:07:16'),
(207, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"67557feb1e73f1733656555.png\"}', NULL, 'elegant', '', '2024-12-08 05:15:55', '2024-12-08 05:15:55'),
(208, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"67557ff782b981733656567.png\"}', NULL, 'elegant', '', '2024-12-08 05:16:07', '2024-12-08 05:16:08'),
(209, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"6755800375e9b1733656579.png\"}', NULL, 'elegant', '', '2024-12-08 05:16:19', '2024-12-08 05:16:19'),
(210, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"6755800e0c83a1733656590.png\"}', NULL, 'elegant', '', '2024-12-08 05:16:30', '2024-12-08 05:16:30'),
(211, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"6755801c795dc1733656604.png\"}', NULL, 'elegant', '', '2024-12-08 05:16:44', '2024-12-08 05:16:44'),
(212, 'wellness_slider.element', '{\"has_image\":\"1\",\"image\":\"6755802a45c291733656618.png\"}', NULL, 'elegant', '', '2024-12-08 05:16:58', '2024-12-08 05:16:58'),
(213, 'acknowledgement.content', '{\"title\":\"I would like to receive promotions\",\"details\":\"I confirm that the information I have provided is accurate, and I have reviewed all booking details including check-in\\/check-out dates, guest information, and payment.\\r\\nI acknowledge and accept the hotel\\u2019s terms and conditions, cancellation policy, and refund guidelines.\"}', NULL, 'basic', '', '2025-07-12 05:50:27', '2025-07-14 01:30:03'),
(214, 'confirmation_page.content', '{\"has_image\":\"1\",\"heading\":\"Welcome to Our Hotel\",\"advise\":\"Keep patient! You will get a confirmation message quickly.\",\"image\":\"6873938231dae1752404866.png\"}', NULL, 'basic', '', '2025-07-13 05:07:46', '2025-07-13 05:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` bigint UNSIGNED NOT NULL,
  `form_id` int UNSIGNED NOT NULL DEFAULT '0',
  `code` int DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NULL',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=>enable, 2=>disable',
  `gateway_parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `supported_currencies` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `crypto` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: fiat currency, 1: crypto currency',
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `form_id`, `code`, `name`, `alias`, `image`, `status`, `gateway_parameters`, `supported_currencies`, `crypto`, `extra`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 101, 'Paypal', 'Paypal', '663a38d7b455d1715091671.png', 1, '{\"paypal_email\":{\"title\":\"PayPal Email\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:13:53'),
(2, 0, 102, 'Perfect Money', 'PerfectMoney', '663a3920e30a31715091744.png', 1, '{\"passphrase\":{\"title\":\"ALTERNATE PASSPHRASE\",\"global\":true,\"value\":\"----------------\"},\"wallet_id\":{\"title\":\"PM Wallet\",\"global\":false,\"value\":\"\"}}', '{\"USD\":\"$\",\"EUR\":\"\\u20ac\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:02'),
(3, 0, 103, 'Stripe Hosted', 'Stripe', '663a39861cb9d1715091846.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:16'),
(4, 0, 104, 'Skrill', 'Skrill', '663a39494c4a91715091785.png', 1, '{\"pay_to_email\":{\"title\":\"Skrill Email\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:10'),
(5, 0, 105, 'PayTM', 'Paytm', '663a390f601191715091727.png', 1, '{\"MID\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"},\"merchant_key\":{\"title\":\"Merchant Key\",\"global\":true,\"value\":\"----------------\"},\"WEBSITE\":{\"title\":\"Paytm Website\",\"global\":true,\"value\":\"----------------\"},\"INDUSTRY_TYPE_ID\":{\"title\":\"Industry Type\",\"global\":true,\"value\":\"----------------\"},\"CHANNEL_ID\":{\"title\":\"CHANNEL ID\",\"global\":true,\"value\":\"----------------\"},\"transaction_url\":{\"title\":\"Transaction URL\",\"global\":true,\"value\":\"----------------\"},\"transaction_status_url\":{\"title\":\"Transaction STATUS URL\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:14:58'),
(6, 0, 106, 'Payeer', 'Payeer', '663a38c9e2e931715091657.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}', 0, '{\"status\":{\"title\": \"Status URL\",\"value\":\"ipn.Payeer\"}}', NULL, '2019-09-14 07:14:22', '2024-06-02 04:13:47'),
(7, 0, 107, 'PayStack', 'Paystack', '663a38fc814e91715091708.png', 1, '{\"public_key\":{\"title\":\"Public key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"NGN\":\"NGN\"}', 0, '{\"callback\":{\"title\": \"Callback URL\",\"value\":\"ipn.Paystack\"},\"webhook\":{\"title\": \"Webhook URL\",\"value\":\"ipn.Paystack\"}}\r\n', NULL, '2019-09-14 07:14:22', '2024-06-02 04:14:03'),
(9, 0, 109, 'Flutterwave', 'Flutterwave', '663a36c2c34d61715091138.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------------------\"},\"encryption_key\":{\"title\":\"Encryption Key\",\"global\":true,\"value\":\"------------------\"}}', '{\"BIF\":\"BIF\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CVE\":\"CVE\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"GHS\":\"GHS\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"KES\":\"KES\",\"LRD\":\"LRD\",\"MWK\":\"MWK\",\"MZN\":\"MZN\",\"NGN\":\"NGN\",\"RWF\":\"RWF\",\"SLL\":\"SLL\",\"STD\":\"STD\",\"TZS\":\"TZS\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"XAF\":\"XAF\",\"XOF\":\"XOF\",\"ZMK\":\"ZMK\",\"ZMW\":\"ZMW\",\"ZWD\":\"ZWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:12:18'),
(10, 0, 110, 'RazorPay', 'Razorpay', '663a393a527831715091770.png', 1, '{\"key_id\":{\"title\":\"Key Id\",\"global\":true,\"value\":\"----------------\"},\"key_secret\":{\"title\":\"Key Secret \",\"global\":true,\"value\":\"----------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:05'),
(11, 0, 111, 'Stripe Storefront', 'StripeJs', '663a3995417171715091861.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:21'),
(12, 0, 112, 'Instamojo', 'Instamojo', '663a384d54a111715091533.png', 1, '{\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"--------------------\"},\"auth_token\":{\"title\":\"Auth Token\",\"global\":true,\"value\":\"--------------------\"},\"salt\":{\"title\":\"Salt\",\"global\":true,\"value\":\"--------------------\"}}', '{\"INR\":\"INR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:11:10'),
(13, 0, 501, 'Blockchain', 'Blockchain', '663a35efd0c311715090927.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"55529946-05ca-48ff-8710-f279d86b1cc5\"},\"xpub_code\":{\"title\":\"XPUB CODE\",\"global\":true,\"value\":\"xpub6CKQ3xxWyBoFAF83izZCSFUorptEU9AF8TezhtWeMU5oefjX3sFSBw62Lr9iHXPkXmDQJJiHZeTRtD9Vzt8grAYRhvbz4nEvBu3QKELVzFK\"}}', '{\"BTC\":\"BTC\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:08:47'),
(15, 0, 503, 'CoinPayments', 'Coinpayments', '663a36a8d8e1d1715091112.png', 1, '{\"public_key\":{\"title\":\"Public Key\",\"global\":true,\"value\":\"---------------------\"},\"private_key\":{\"title\":\"Private Key\",\"global\":true,\"value\":\"---------------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"---------------------\"}}', '{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"USDT.BEP20\":\"Tether USD (BSC Chain)\",\"USDT.ERC20\":\"Tether USD (ERC20)\",\"USDT.TRC20\":\"Tether USD (Tron/TRC20)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}', 1, NULL, NULL, '2019-09-14 07:14:22', '2024-05-07 02:11:52'),
(16, 0, 504, 'CoinPayments Fiat', 'CoinpaymentsFiat', '663a36b7b841a1715091127.png', 1, '{\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:12:29'),
(17, 0, 505, 'Coingate', 'Coingate', '663a368e753381715091086.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:12:16'),
(18, 0, 506, 'Coinbase Commerce', 'CoinbaseCommerce', '663a367e46ae51715091070.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"},\"secret\":{\"title\":\"Webhook Shared Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"JPY\":\"JPY\",\"GBP\":\"GBP\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CNY\":\"CNY\",\"SEK\":\"SEK\",\"NZD\":\"NZD\",\"MXN\":\"MXN\",\"SGD\":\"SGD\",\"HKD\":\"HKD\",\"NOK\":\"NOK\",\"KRW\":\"KRW\",\"TRY\":\"TRY\",\"RUB\":\"RUB\",\"INR\":\"INR\",\"BRL\":\"BRL\",\"ZAR\":\"ZAR\",\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CDF\":\"CDF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NPR\":\"NPR\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}\r\n\r\n', 0, '{\"endpoint\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.CoinbaseCommerce\"}}', NULL, '2019-09-14 07:14:22', '2024-06-02 04:12:04'),
(24, 0, 113, 'Paypal Express', 'PaypalSdk', '663a38ed101a61715091693.png', 1, '{\"clientId\":{\"title\":\"Paypal Client ID\",\"global\":true,\"value\":\"----------------\"},\"clientSecret\":{\"title\":\"Client Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"$\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:13:57'),
(25, 0, 114, 'Stripe Checkout', 'StripeV3', '663a39afb519f1715091887.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"publishable_key\":{\"title\":\"PUBLISHABLE KEY\",\"global\":true,\"value\":\"----------------\"},\"end_point\":{\"title\":\"End Point Secret\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}', 0, '{\"webhook\":{\"title\": \"Webhook Endpoint\",\"value\":\"ipn.StripeV3\"}}', NULL, '2019-09-14 07:14:22', '2024-06-02 04:15:26'),
(27, 0, 115, 'Mollie', 'Mollie', '663a387ec69371715091582.png', 1, '{\"mollie_email\":{\"title\":\"Mollie Email \",\"global\":true,\"value\":\"----------------\"},\"api_key\":{\"title\":\"API KEY\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, '2019-09-14 07:14:22', '2024-06-02 04:13:06'),
(30, 0, 116, 'Cashmaal', 'Cashmaal', '663a361b16bd11715090971.png', 1, '{\"web_id\":{\"title\":\"Web Id\",\"global\":true,\"value\":\"----------------\"},\"ipn_key\":{\"title\":\"IPN Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"PKR\":\"PKR\",\"USD\":\"USD\"}', 0, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.Cashmaal\"}}', NULL, NULL, '2024-06-02 04:11:49'),
(36, 0, 119, 'Mercado Pago', 'MercadoPago', '663a386c714a91715091564.png', 1, '{\"access_token\":{\"title\":\"Access Token\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-06-02 04:12:53'),
(37, 0, 120, 'Authorize.net', 'Authorize', '663a35b9ca5991715090873.png', 1, '{\"login_id\":{\"title\":\"Login ID\",\"global\":true,\"value\":\"----------------\"},\"transaction_key\":{\"title\":\"Transaction Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"USD\":\"USD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"AUD\":\"AUD\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-06-02 04:11:23'),
(46, 0, 121, 'NMI', 'NMI', '663a3897754cf1715091607.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AED\":\"AED\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"RUB\":\"RUB\",\"SEC\":\"SEC\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}', 0, NULL, NULL, NULL, '2024-06-02 04:13:20'),
(50, 0, 507, 'BTCPay', 'BTCPay', '663a35cd25a8d1715090893.png', 1, '{\"store_id\":{\"title\":\"Store Id\",\"global\":true,\"value\":\"----------------\"},\"api_key\":{\"title\":\"Api Key\",\"global\":true,\"value\":\"----------------\"},\"server_name\":{\"title\":\"Server Name\",\"global\":true,\"value\":\"----------------\"},\"secret_code\":{\"title\":\"Secret Code\",\"global\":true,\"value\":\"----------------\"}}', '{\"BTC\":\"Bitcoin\",\"LTC\":\"Litecoin\"}', 1, '{\"webhook\":{\"title\": \"IPN URL\",\"value\":\"ipn.BTCPay\"}}', NULL, NULL, '2024-06-02 04:11:33'),
(51, 0, 508, 'Now payments hosted', 'NowPaymentsHosted', '663a38b8d57a81715091640.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"--------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------------\"}}', '{\"BTG\":\"BTG\",\"ETH\":\"ETH\",\"XMR\":\"XMR\",\"ZEC\":\"ZEC\",\"XVG\":\"XVG\",\"ADA\":\"ADA\",\"LTC\":\"LTC\",\"BCH\":\"BCH\",\"QTUM\":\"QTUM\",\"DASH\":\"DASH\",\"XLM\":\"XLM\",\"XRP\":\"XRP\",\"XEM\":\"XEM\",\"DGB\":\"DGB\",\"LSK\":\"LSK\",\"DOGE\":\"DOGE\",\"TRX\":\"TRX\",\"KMD\":\"KMD\",\"REP\":\"REP\",\"BAT\":\"BAT\",\"ARK\":\"ARK\",\"WAVES\":\"WAVES\",\"BNB\":\"BNB\",\"XZC\":\"XZC\",\"NANO\":\"NANO\",\"TUSD\":\"TUSD\",\"VET\":\"VET\",\"ZEN\":\"ZEN\",\"GRS\":\"GRS\",\"FUN\":\"FUN\",\"NEO\":\"NEO\",\"GAS\":\"GAS\",\"PAX\":\"PAX\",\"USDC\":\"USDC\",\"ONT\":\"ONT\",\"XTZ\":\"XTZ\",\"LINK\":\"LINK\",\"RVN\":\"RVN\",\"BNBMAINNET\":\"BNBMAINNET\",\"ZIL\":\"ZIL\",\"BCD\":\"BCD\",\"USDT\":\"USDT\",\"USDTERC20\":\"USDTERC20\",\"CRO\":\"CRO\",\"DAI\":\"DAI\",\"HT\":\"HT\",\"WABI\":\"WABI\",\"BUSD\":\"BUSD\",\"ALGO\":\"ALGO\",\"USDTTRC20\":\"USDTTRC20\",\"GT\":\"GT\",\"STPT\":\"STPT\",\"AVA\":\"AVA\",\"SXP\":\"SXP\",\"UNI\":\"UNI\",\"OKB\":\"OKB\",\"BTC\":\"BTC\"}', 1, '', NULL, NULL, '2024-05-07 02:20:40'),
(52, 0, 509, 'Now payments checkout', 'NowPaymentsCheckout', '663a38a59d2541715091621.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"---------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"-----------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\"}', 1, '', NULL, NULL, '2024-05-07 02:20:21'),
(53, 0, 122, '2Checkout', 'TwoCheckout', '663a39b8e64b91715091896.png', 1, '{\"merchant_code\":{\"title\":\"Merchant Code\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"}}', '{\"AFN\": \"AFN\",\"ALL\": \"ALL\",\"DZD\": \"DZD\",\"ARS\": \"ARS\",\"AUD\": \"AUD\",\"AZN\": \"AZN\",\"BSD\": \"BSD\",\"BDT\": \"BDT\",\"BBD\": \"BBD\",\"BZD\": \"BZD\",\"BMD\": \"BMD\",\"BOB\": \"BOB\",\"BWP\": \"BWP\",\"BRL\": \"BRL\",\"GBP\": \"GBP\",\"BND\": \"BND\",\"BGN\": \"BGN\",\"CAD\": \"CAD\",\"CLP\": \"CLP\",\"CNY\": \"CNY\",\"COP\": \"COP\",\"CRC\": \"CRC\",\"HRK\": \"HRK\",\"CZK\": \"CZK\",\"DKK\": \"DKK\",\"DOP\": \"DOP\",\"XCD\": \"XCD\",\"EGP\": \"EGP\",\"EUR\": \"EUR\",\"FJD\": \"FJD\",\"GTQ\": \"GTQ\",\"HKD\": \"HKD\",\"HNL\": \"HNL\",\"HUF\": \"HUF\",\"INR\": \"INR\",\"IDR\": \"IDR\",\"ILS\": \"ILS\",\"JMD\": \"JMD\",\"JPY\": \"JPY\",\"KZT\": \"KZT\",\"KES\": \"KES\",\"LAK\": \"LAK\",\"MMK\": \"MMK\",\"LBP\": \"LBP\",\"LRD\": \"LRD\",\"MOP\": \"MOP\",\"MYR\": \"MYR\",\"MVR\": \"MVR\",\"MRO\": \"MRO\",\"MUR\": \"MUR\",\"MXN\": \"MXN\",\"MAD\": \"MAD\",\"NPR\": \"NPR\",\"TWD\": \"TWD\",\"NZD\": \"NZD\",\"NIO\": \"NIO\",\"NOK\": \"NOK\",\"PKR\": \"PKR\",\"PGK\": \"PGK\",\"PEN\": \"PEN\",\"PHP\": \"PHP\",\"PLN\": \"PLN\",\"QAR\": \"QAR\",\"RON\": \"RON\",\"RUB\": \"RUB\",\"WST\": \"WST\",\"SAR\": \"SAR\",\"SCR\": \"SCR\",\"SGD\": \"SGD\",\"SBD\": \"SBD\",\"ZAR\": \"ZAR\",\"KRW\": \"KRW\",\"LKR\": \"LKR\",\"SEK\": \"SEK\",\"CHF\": \"CHF\",\"SYP\": \"SYP\",\"THB\": \"THB\",\"TOP\": \"TOP\",\"TTD\": \"TTD\",\"TRY\": \"TRY\",\"UAH\": \"UAH\",\"AED\": \"AED\",\"USD\": \"USD\",\"VUV\": \"VUV\",\"VND\": \"VND\",\"XOF\": \"XOF\",\"YER\": \"YER\"}', 0, '{\"approved_url\":{\"title\": \"Approved URL\",\"value\":\"ipn.TwoCheckout\"}}', NULL, NULL, '2024-06-02 04:15:30'),
(54, 0, 123, 'Checkout', 'Checkout', '663a3628733351715090984.png', 1, '{\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"------\"},\"public_key\":{\"title\":\"PUBLIC KEY\",\"global\":true,\"value\":\"------\"},\"processing_channel_id\":{\"title\":\"PROCESSING CHANNEL\",\"global\":true,\"value\":\"------\"}}', '{\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"AUD\":\"AUD\",\"CAN\":\"CAN\",\"CHF\":\"CHF\",\"SGD\":\"SGD\",\"JPY\":\"JPY\",\"NZD\":\"NZD\"}', 0, NULL, NULL, NULL, '2024-05-07 02:09:44'),
(56, 0, 510, 'Binance', 'Binance', '663a35db4fd621715090907.png', 1, '{\"api_key\":{\"title\":\"API Key\",\"global\":true,\"value\":\"----------------\"},\"secret_key\":{\"title\":\"Secret Key\",\"global\":true,\"value\":\"----------------\"},\"merchant_id\":{\"title\":\"Merchant ID\",\"global\":true,\"value\":\"----------------\"}}', '{\"BTC\":\"Bitcoin\",\"USD\":\"USD\",\"BNB\":\"BNB\"}', 1, '{\"cron\":{\"title\": \"Cron Job URL\",\"value\":\"ipn.Binance\"}}', NULL, NULL, '2024-06-02 04:11:41'),
(57, 0, 124, 'SslCommerz', 'SslCommerz', '663a397a70c571715091834.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"store_password\":{\"title\":\"Store Password\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"SGD\":\"SGD\",\"INR\":\"INR\",\"MYR\":\"MYR\"}', 0, NULL, NULL, NULL, '2024-05-07 02:23:54'),
(58, 0, 125, 'Aamarpay', 'Aamarpay', '663a34d5d1dfc1715090645.png', 1, '{\"store_id\":{\"title\":\"Store ID\",\"global\":true,\"value\":\"---------\"},\"signature_key\":{\"title\":\"Signature Key\",\"global\":true,\"value\":\"----------\"}}', '{\"BDT\":\"BDT\"}', 0, NULL, NULL, NULL, '2024-05-07 02:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `gateway_currencies`
--

CREATE TABLE `gateway_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_code` int DEFAULT NULL,
  `gateway_alias` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `max_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `percent_charge` decimal(5,2) NOT NULL DEFAULT '0.00',
  `fixed_charge` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `rate` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `gateway_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `site_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cur_text` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency text',
  `cur_sym` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'currency symbol',
  `email_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_template` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_from` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_template` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_color` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT 'email configuration',
  `sms_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firebase_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `global_shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kv` tinyint(1) NOT NULL DEFAULT '0',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email verification, 0 - dont check, 1 - check',
  `en` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'email notification, 0 - dont send, 1 - send',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'mobile verication, 0 - dont check, 1 - check',
  `sn` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'sms notification, 0 - dont send, 1 - send',
  `pn` tinyint(1) NOT NULL DEFAULT '1',
  `tax` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tax_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi_language` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1⇾Enable, 0⇾Disable',
  `maintenance_mode` tinyint NOT NULL DEFAULT '1',
  `force_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `secure_password` tinyint(1) NOT NULL DEFAULT '0',
  `agree` tinyint(1) NOT NULL DEFAULT '0',
  `registration` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Off	, 1: On',
  `active_template` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `socialite_credentials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `system_customized` tinyint(1) NOT NULL DEFAULT '0',
  `paginate_number` int NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>Both\r\n2=>Text Only\r\n3=>Symbol Only',
  `config_progress` text COLLATE utf8mb4_unicode_ci,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `upcoming_checkin_days` int UNSIGNED NOT NULL DEFAULT '1',
  `upcoming_checkout_days` int UNSIGNED NOT NULL DEFAULT '1',
  `available_version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `cur_text`, `cur_sym`, `email_from`, `email_from_name`, `email_template`, `sms_template`, `sms_from`, `push_title`, `push_template`, `base_color`, `mail_config`, `sms_config`, `firebase_config`, `global_shortcodes`, `kv`, `ev`, `en`, `sv`, `sn`, `pn`, `tax`, `tax_name`, `multi_language`, `maintenance_mode`, `force_ssl`, `secure_password`, `agree`, `registration`, `active_template`, `socialite_credentials`, `system_customized`, `paginate_number`, `currency_format`, `config_progress`, `checkin_time`, `checkout_time`, `upcoming_checkin_days`, `upcoming_checkout_days`, `available_version`, `created_at`, `updated_at`) VALUES
(1, 'Viser Hotel', 'USD', '$', 'info@viserlab.com', 'Viseradmin', '<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\r\n  <!--[if !mso]><!-->\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <!--<![endif]-->\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title></title>\r\n  <style type=\"text/css\">\r\n.ReadMsgBody { width: 100%; background-color: #ffffff; }\r\n.ExternalClass { width: 100%; background-color: #ffffff; }\r\n.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }\r\nhtml { width: 100%; }\r\nbody { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }\r\ntable { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }\r\ntable table table { table-layout: auto; }\r\n.yshortcuts a { border-bottom: none !important; }\r\nimg:hover { opacity: 0.9 !important; }\r\na { color: #0087ff; text-decoration: none; }\r\n.textbutton a { font-family: \'open sans\', arial, sans-serif !important;}\r\n.btn-link a { color:#FFFFFF !important;}\r\n\r\n@media only screen and (max-width: 480px) {\r\nbody { width: auto !important; }\r\n*[class=\"table-inner\"] { width: 90% !important; text-align: center !important; }\r\n*[class=\"table-full\"] { width: 100% !important; text-align: center !important; }\r\n/* image */\r\nimg[class=\"img1\"] { width: 100% !important; height: auto !important; }\r\n}\r\n</style>\r\n\r\n\r\n\r\n  <table bgcolor=\"#414a51\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tbody><tr>\r\n      <td height=\"50\"></td>\r\n    </tr>\r\n    <tr>\r\n      <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\r\n          <tbody><tr>\r\n            <td align=\"center\" width=\"600\">\r\n              <!--header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#0087ff\" style=\"border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;\" align=\"center\">\r\n                    <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;\">This is a System Generated Email</td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n              <!--end header-->\r\n              <table class=\"table-inner\" width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                <tbody><tr>\r\n                  <td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"35\"></td>\r\n                      </tr>\r\n                      <!--logo-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"vertical-align:top;font-size:0;\">\r\n                          <a href=\"#\">\r\n                            <img style=\"display:block; line-height:0px; font-size:0px; border:0px;\" src=\"https://i.imgur.com/Z1qtvtV.png\" alt=\"img\">\r\n                          </a>\r\n                        </td>\r\n                      </tr>\r\n                      <!--end logo-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n                      <!--headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"font-family: \'Open Sans\', Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;\">Hello {{fullname}} ({{username}})</td>\r\n                      </tr>\r\n                      <!--end headline-->\r\n                      <tr>\r\n                        <td align=\"center\" style=\"text-align:center;vertical-align:top;font-size:0;\">\r\n                          <table width=\"40\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n                            <tbody><tr>\r\n                              <td height=\"20\" style=\" border-bottom:3px solid #0087ff;\"></td>\r\n                            </tr>\r\n                          </tbody></table>\r\n                        </td>\r\n                      </tr>\r\n                      <tr>\r\n                        <td height=\"20\"></td>\r\n                      </tr>\r\n                      <!--content-->\r\n                      <tr>\r\n                        <td align=\"left\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;\">{{message}}</td>\r\n                      </tr>\r\n                      <!--end content-->\r\n                      <tr>\r\n                        <td height=\"40\"></td>\r\n                      </tr>\r\n              \r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n                <tr>\r\n                  <td height=\"45\" align=\"center\" bgcolor=\"#f4f4f4\" style=\"border-bottom-left-radius:6px;border-bottom-right-radius:6px;\">\r\n                    <table align=\"center\" width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n                      <tbody><tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                      <!--preference-->\r\n                      <tr>\r\n                        <td class=\"preference-link\" align=\"center\" style=\"font-family: \'Open sans\', Arial, sans-serif; color:#95a5a6; font-size:14px;\">\r\n                          © 2021 <a href=\"#\">Website Name</a> . All Rights Reserved. \r\n                        </td>\r\n                      </tr>\r\n                      <!--end preference-->\r\n                      <tr>\r\n                        <td height=\"10\"></td>\r\n                      </tr>\r\n                    </tbody></table>\r\n                  </td>\r\n                </tr>\r\n              </tbody></table>\r\n            </td>\r\n          </tr>\r\n        </tbody></table>\r\n      </td>\r\n    </tr>\r\n    <tr>\r\n      <td height=\"60\"></td>\r\n    </tr>\r\n  </tbody></table>', 'hi {{fullname}} ({{username}}), {{message}}', 'SMS From Viserlab Admin', NULL, NULL, 'ab8a62', '{\"name\":\"php\"}', '{\"name\":\"infobip\",\"clickatell\":{\"api_key\":\"----------------\"},\"infobip\":{\"username\":\"------------8888888\",\"password\":\"-----------------\"},\"message_bird\":{\"api_key\":\"-------------------\"},\"nexmo\":{\"api_key\":\"----------------------\",\"api_secret\":\"----------------------\"},\"sms_broadcast\":{\"username\":\"----------------------\",\"password\":\"-----------------------------\"},\"twilio\":{\"account_sid\":\"-----------------------\",\"auth_token\":\"---------------------------\",\"from\":\"----------------------\"},\"text_magic\":{\"username\":\"-----------------------\",\"apiv2_key\":\"-------------------------------\"},\"custom\":{\"method\":\"get\",\"url\":\"https:\\/\\/hostname\\/demo-api-v1\",\"headers\":{\"name\":[\"api_key\"],\"value\":[\"test_api 555\"]},\"body\":{\"name\":[\"from_number\"],\"value\":[\"5657545757\"]}}}', NULL, '{\n    \"site_name\":\"Name of your site\",\n    \"site_currency\":\"Currency of your site\",\n    \"currency_symbol\":\"Symbol of currency\"\n}', 0, 1, 1, 1, 0, 0, 10.00, 'Tax', 1, 0, 0, 0, 1, 1, 'elegant', '{\"google\":{\"client_id\":\"------------\",\"client_secret\":\"-------------\",\"status\":0},\"facebook\":{\"client_id\":\"------\",\"client_secret\":\"------\",\"status\":0},\"linkedin\":{\"client_id\":\"-----\",\"client_secret\":\"-----\",\"status\":0}}', 0, 20, 1, '[\"general_setting\",\"logo_favicon\",\"notification_template\", \"deposit_method\",\"seo\", \"policy_content\"]', '23:00:00', '10:00:00', 3, 5, '3.0.1', NULL, '2025-07-16 08:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: not default language, 1: default language',
  `image` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `is_default`, `image`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', NULL, 1, '664f2a37c3c341716464183.png', '2024-05-23 05:36:23', '2024-05-23 05:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_to` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notification_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_read` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `act` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sms_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `push_body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `shortcodes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_status` tinyint(1) NOT NULL DEFAULT '1',
  `email_sent_from_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_sent_from_address` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT '1',
  `sms_sent_from` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(3, 'DIRECT_PAYMENT_SUCCESSFUL', 'Payment- Automated - Successful', 'Payment Completed Successfully', NULL, '<div>Your payment for&nbsp;<span style=\"font-weight: 700; font-size: 1rem; text-align: var(--bs-body-text-align);\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}} {{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has&nbsp; been completed Successfully.</span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#000000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Paid via :&nbsp; {{method_name}}</div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} {{site_currency}} payment successfully by {{method_name}}', NULL, '{\r\n                \"booking_number\":\"Booking Number\",\r\n                \"amount\":\"Amount inserted by the user\",\r\n                \"charge\":\"Gateway charge set by the admin\",\r\n                \"rate\":\"Conversion rate between base currency and method currency\",\r\n                \"method_name\":\"Name of the deposit method\",\r\n                \"method_currency\":\"Currency of the deposit method\",\r\n                \"method_amount\":\"Amount after conversion between base currency and method currency\"\r\n            }', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 22:41:04'),
(4, 'PAYMENT_MANUAL_APPROVED', 'Payment - Manual - Approved', 'Your Payment is Approved', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}}{{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">is Approved .</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Payable : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Management Approve Your {{amount}} {{method_currency}} payment request by {{method_name}} Booking Number: {{booking_number}}', NULL, '{\"booking_number\":\"Booking Number\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 22:42:35'),
(6, 'PAYMENT_MANUAL_REQUEST', 'Payment - Manual - Requested', 'Payment Request Submitted Successfully', NULL, '<div>Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}} {{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">submitted successfully</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">&nbsp;.</span></div><div><span style=\"font-weight: bolder;\"><br></span></div><div><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div><br></div><div>Amount : {{amount}} {{site_currency}}</div><div>Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div><br></div><div>Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div>Payable : {{method_amount}} {{method_currency}}<br></div><div>Pay via :&nbsp; {{method_name}}</div><div><br></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', '{{amount}} Payment requested by {{method_name}}. Charge: {{charge}} . Booking Number: {{booking_number}}', NULL, '{\"booking_number\":\"Transaction number for the deposit\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 22:42:04'),
(7, 'PASS_RESET_CODE', 'Password - Reset - Code', 'Password Reset', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">We have received a request to reset the password for your account on&nbsp;<span style=\"font-weight: bolder;\">{{time}} .<br></span></div><div style=\"font-family: Montserrat, sans-serif;\">Requested From IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><br style=\"font-family: Montserrat, sans-serif;\"><div style=\"font-family: Montserrat, sans-serif;\"><div>Your account recovery code is:&nbsp;&nbsp;&nbsp;<font size=\"6\"><span style=\"font-weight: bolder;\">{{code}}</span></font></div><div><br></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"4\" color=\"#CC0000\">If you do not wish to reset your password, please disregard this message.&nbsp;</font><br></div><div><font size=\"4\" color=\"#CC0000\"><br></font></div>', 'Your account recovery code is: {{code}}', NULL, '{\"code\":\"Verification code for password reset\",\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:05'),
(8, 'PASS_RESET_DONE', 'Password - Reset - Confirmation', 'You have Reset your password', NULL, '<p style=\"font-family: Montserrat, sans-serif;\">You have successfully reset your password.</p><p style=\"font-family: Montserrat, sans-serif;\">You changed from&nbsp; IP:&nbsp;<span style=\"font-weight: bolder;\">{{ip}}</span>&nbsp;using&nbsp;<span style=\"font-weight: bolder;\">{{browser}}</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{operating_system}}&nbsp;</span>&nbsp;on&nbsp;<span style=\"font-weight: bolder;\">{{time}}</span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></p><p style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><font color=\"#ff0000\">If you did not changed that, Please contact with us as soon as possible.</font></span></p>', 'Your password has been changed successfully', NULL, '{\"ip\":\"IP address of the user\",\"browser\":\"Browser of the user\",\"operating_system\":\"Operating system of the user\",\"time\":\"Time of the request\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:25'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support - Reply', 'Reply Support Ticket', NULL, '<div><p><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\">A member from our support team has replied to the following ticket:</span></span></p><p><span style=\"font-weight: bolder;\"><span data-mce-style=\"font-size: 11pt;\" style=\"font-size: 11pt;\"><span style=\"font-weight: bolder;\"><br></span></span></span></p><p><span style=\"font-weight: bolder;\">[Ticket#{{ticket_id}}] {{ticket_subject}}<br><br>Click here to reply:&nbsp; {{link}}</span></p><p>----------------------------------------------</p><p>Here is the reply :<br></p><p>{{reply}}<br></p></div><div><br style=\"font-family: Montserrat, sans-serif;\"></div>', 'Your Ticket#{{ticket_id}} :  {{ticket_subject}} has been replied.', NULL, '{\"ticket_id\":\"ID of the support ticket\",\"ticket_subject\":\"Subject  of the support ticket\",\"reply\":\"Reply made by the admin\",\"link\":\"URL to view the support ticket\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:47:51'),
(10, 'EVER_CODE', 'Verification - Email', 'Please verify your email address', NULL, '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For join with us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Please use below code to verify your email address.<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your email verification code is:<font size=\"6\"><span style=\"font-weight: bolder;\">&nbsp;{{code}}</span></font></div></div>', '---', NULL, '{\"code\":\"Email verification code\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 20:49:35'),
(11, 'SVER_CODE', 'Verification - SMS', 'Verify Your Mobile Number', NULL, '---', 'Your phone verification code is: {{code}}', NULL, '{\"code\":\"SMS Verification Code\"}', 0, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-03-20 19:24:37'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', NULL, '{{message}}', '{{message}}', NULL, '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, NULL, NULL, 1, NULL, 0, '2019-09-14 13:14:22', '2021-11-04 09:38:55'),
(18, 'ACCOUNT_CREATE', 'Account Create', 'Your account has been created', NULL, '<br><div><div style=\"font-family: Montserrat, sans-serif;\">Thanks For join with us.<br></div><div style=\"font-family: Montserrat, sans-serif;\">Now you can log in by this credentials:<br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">username: {{username}}&nbsp;</div><div style=\"font-family: Montserrat, sans-serif;\">email: {{email}}</div><div style=\"font-family: Montserrat, sans-serif;\">password:{{password}}</div>\r\n</div>', '---', NULL, '{\"username\":\"username\", \r\n\"email\":\"email\", \"password\":\"password\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-04-10 08:30:01'),
(19, 'ROOM_BOOKED', 'Room_booked', 'Your room has been booked.', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Thanks for booking rooms here.</div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number: {{booking_number}},</div><div style=\"font-family: Montserrat, sans-serif;\">Total Amount:{{amount}}&nbsp;<span style=\"white-space: nowrap; font-family: Poppins, sans-serif; text-align: var(--bs-body-text-align);\"><font size=\"3\">{{site_currency}}</font></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">,</span></div><div style=\"\"><span style=\"font-family: Montserrat, sans-serif; color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Paid Amount :&nbsp;</span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{paid_amount}}&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{site_currency}}</font></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Check In Date : {{check_in}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">Check Out Date : {{check_out}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><u><b>Booked Rooms:</b></u></font></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">&nbsp;{{rooms}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>\r\n<div><div style=\"font-family: Montserrat, sans-serif;\">Thanks for being with us.</div></div>', 'Thanks for booking room here. Booking Number : {{booking_number}}, Paid Amount:{{paid_amount}} {{site_currency}} instead of \r\n Your booked rooms: {{rooms}} .', NULL, '{\"booking_number\":\"Booking number for the action\",\"amount\":\"Booking total amount\",\r\n\"paid_amount\":\"Paid amount for booking\", \"rooms\":\"booked rooms list\",\"check_in\":\"Check In date\", \"check_out\": \"Check Out Date\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2023-05-15 08:43:02'),
(20, 'APPROVE_BOOKING_REQUEST', 'Booking Request Approve', 'Your Booking Request has been approved.', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Thanks for booking room here.</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Payable Amount:&nbsp;</span><span style=\"font-weight: bolder; font-family: Poppins, sans-serif; white-space: nowrap;\"><font size=\"3\">{{amount}}</font></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); white-space: nowrap; font-family: Poppins, sans-serif;\"><b><font size=\"3\">{{site_currency}}</font></b></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">,</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Check-In date : {{check_in}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">Check-Out date : {{check_out}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Room Type : {{room_type}}</div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41);\">&nbsp;Rooms: {{rooms}}</span><br></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Thanks for booking room here. Your requesting rooms: {{rooms}}\r\npayable amount: {{amount}} {{site_currency}}', NULL, '{\"amount\":\"Total Payable Amount\",\r\n\"room_type\":\"Booked Room Type\", \"rooms\":\"booked room list\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-05-16 06:11:06'),
(21, 'BOOKING_REQUEST_CANCELLED', 'Booking Request Cancelled', 'Booking Request Cancelled', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking request for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{check_in}}&nbsp; to {{check_out}} for <b>{{room_type}}</b></span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been cancelled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{check_in}}  to {{check_out}} for {{room_type}} has been cancelled.', NULL, '{\"room_type\":\"Room Type\",\"number_of_rooms\":\"Number of Rooms\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 22:41:33'),
(22, 'BOOKING_CANCELLED', 'Booking Cancelled', 'Booking Cancelled', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking&nbsp; for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{check_in}}&nbsp; to {{check_out}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been canceled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booking Number:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booked rooms:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{rooms}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{check_in}}  to {{check_out}} has been canceled.\r\nBooking Number: {{booking_number}}', NULL, '{\"booking_number\":\"Booking Number\",\"rooms\":\"rooms\",\"check_in\":\"Check in date\", \"check_out\": \"Check Out Date\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 07:57:04'),
(23, 'PAYMENT_MANUAL_REJECT', 'Payment - Manual - Reject', 'Your Payment is Rejected', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your payment request&nbsp;<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align);\">for&nbsp;</span><span style=\"font-family: Poppins, sans-serif; font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: 700;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;of&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{amount}}{{site_currency}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">&nbsp;via&nbsp;&nbsp;</span><span style=\"font-size: 1rem; text-align: var(--bs-body-text-align); font-weight: bolder;\">{{method_name}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">is rejected.</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"font-weight: bolder;\">Details of your payment:<br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Amount : {{amount}} {{site_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Charge:&nbsp;<font color=\"#FF0000\">{{charge}} {{site_currency}}</font></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Conversion Rate : 1 {{site_currency}} = {{rate}} {{method_currency}}</div><div style=\"font-family: Montserrat, sans-serif;\">Payable : {{method_amount}} {{method_currency}}<br></div><div style=\"font-family: Montserrat, sans-serif;\">Paid via :&nbsp; {{method_name}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div>', 'Management reject your {{amount}} {{method_currency}} payment request by {{method_name}} Booking Number: {{booking_number}}', NULL, '{\"booking_number\":\"Booking Number\",\"amount\":\"Amount inserted by the user\",\"charge\":\"Gateway charge set by the admin\",\"rate\":\"Conversion rate between base currency and method currency\",\"method_name\":\"Name of the deposit method\",\"method_currency\":\"Currency of the deposit method\",\"method_amount\":\"Amount after conversion between base currency and method currency\",\"post_balance\":\"Balance of the user after this transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 12:00:00', '2022-06-29 23:01:10'),
(24, 'BOOKING_CANCELLED_BY_DATE', 'Booking Cancelled by Date', 'Booking Cancelled', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Your booking for&nbsp;<span style=\"color: rgb(33, 37, 41); font-size: 1rem; text-align: var(--bs-body-text-align);\">{{date}}&nbsp;</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">has been canceled</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">.</span></div></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booking Number:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{booking_number}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\">Booked rooms:</span></div><div style=\"font-family: Montserrat, sans-serif;\"><span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 12px; font-weight: 600; white-space: nowrap;\">{{rooms}}</span><span style=\"color: var(--bs-body-color); font-size: 1rem; text-align: var(--bs-body-text-align);\"><br></span></div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Your booking request for {{date}} has been canceled.\r\nBooking Number: {{booking_number}}', NULL, '{\"booking_number\":\"Booking Number\",\"rooms\":\"rooms\",\"date\":\"The Date of Booked For\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2022-07-03 09:46:50'),
(25, 'REFUND_AMOUNT', 'Refund Amount', 'Amount Refunded Successfully', NULL, '<div><div style=\"\"><font color=\"#d1d5db\" face=\"Söhne, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, sans-serif, Helvetica Neue, Arial, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji\"><span style=\"white-space: pre-wrap;\">We regret to inform you that your booking with reference number {{booking_number}} has been canceled. The amount paid for this booking was {{paid_amount}} {{site_currency}}, and as per our refund policy, you are entitled to receive {{refund_amount}} {{site_currency}} for canceling the booking. Please allow up to 5 business days for the refund to be processed and reflected in your account. If you have any further queries, please do not hesitate to contact our customer support team.</span></font><br></div></div>', 'We regret to inform you that your booking with reference number {{booking_number}} has been canceled. The amount paid for this booking was {{paid_amount}} {{site_currency}}, and as per our refund policy, you are entitled to receive {{refund_amount}} {{site_currency}} for canceling the booking. Please allow up to 5 business days for the refund to be processed and reflected in your account. If you have any further queries, please do not hesitate to contact our customer support team.', NULL, '{\"booking_number\":\"Booking Number\", \"paid_amount\": \"Paid Amount\", \"refund_amount\" : \"Refund Amount\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2023-04-30 10:04:53'),
(26, 'REFUND_FOR_ROOM_CANCELLATION', 'Refund for Room Cancellation', 'Refund for room cancellation', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number :&nbsp;<b>{{booking_number}}</b></div></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"\"><font size=\"3\" style=\"\"><font color=\"#212529\" face=\"Montserrat, sans-serif\">{{refund_amount}}&nbsp;</font></font><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{site_currency}} has been minimized from your total payable amount.&nbsp;</font></span><font size=\"3\" style=\"\"><br></font></div><div style=\"\"><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">Refund Charge :&nbsp;&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{refund_charge}}&nbsp;</font></span><span style=\"text-align: var(--bs-body-text-align);\"><font color=\"#212529\" face=\"Montserrat, sans-serif\" size=\"3\">{{site_currency}}</font></span></div>', 'Booking Number : {{booking_number}}\r\n\r\n{{refund_amount}} {{site_currency}} has been minimized from your total payable amount. \r\nRefund Charge :  {{refund_charge}} {{site_currency}}', NULL, '{\"booking_number\":\"Booking Number\", \"refund_charge\": \"Refund Charge\", \"refund_amount\" : \"Refund Amount\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2023-04-29 10:27:13'),
(27, 'CANCEL_BOOKED_ROOM', 'Cancel Booked Room', 'Cancel Booked Room', NULL, '<div><div style=\"font-family: Montserrat, sans-serif;\">Room&nbsp;{{room_number}} for&nbsp;{{date}} has been canceled successfully.&nbsp;</div></div><div style=\"font-family: Montserrat, sans-serif;\">Booking Number :&nbsp;{{booking_number}}</div><div style=\"font-family: Montserrat, sans-serif;\"><font size=\"3\"><b style=\"\"><br></b></font></div>', 'Room {{room_number}} for {{date}} has been canceled successfully. \r\nBooking Number : {{booking_number}}', NULL, '{\"booking_number\":\"Booking Number\",\"room_number\":\"Cancelled Room\", \"date\":\"Booking Date\"}', 1, NULL, NULL, 0, NULL, 0, '2021-11-03 12:00:00', '2023-04-30 06:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=fixed, 2=percent',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `starts_from` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `show_banner` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `show_countdown` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=disabled, 1=enabled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'template name',
  `secs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `tempname`, `secs`, `seo_content`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'HOME', '/', 'templates.basic.', '[\"about\",\"featured_room\",\"service\",\"faq\",\"testimonial\",\"blog\",\"subscribe\"]', '{\"image\":null,\"description\":\"Quibusdam amet non\",\"social_title\":\"Consectetur ad dolo\",\"social_description\":\"Maiores consequatur\",\"keywords\":[\"dsafas afsf\",\"fdsafas\"]}', 1, '2020-07-11 06:23:58', '2024-06-11 02:57:42'),
(4, 'NEWS', 'news', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:43', '2020-10-22 01:14:43'),
(5, 'Contact', 'contact', 'templates.basic.', NULL, NULL, 1, '2020-10-22 01:14:53', '2022-06-28 01:09:20'),
(17, 'Book Online', 'rooms-and-suites', 'templates.basic.', NULL, NULL, 1, '2022-06-02 10:10:32', '2022-06-02 10:10:32'),
(18, 'FAQs', 'faq', 'templates.basic.', '[\"faq\"]', NULL, 0, '2022-06-19 08:18:43', '2022-06-19 08:18:52'),
(19, 'HOME', '/', 'templates.elegant.', '[\"booking_advantage\",\"about\",\"featured_rooms\",\"facility\",\"offer\",\"hotel_overview\",\"location\",\"testimonial\",\"faq\",\"blog\",\"subscribe\"]', NULL, 1, '2020-07-11 06:23:58', '2025-06-16 00:40:01'),
(20, 'Room & Suites', 'rooms-and-suites', 'templates.elegant.', '[\"offer\",\"subscribe\"]', NULL, 1, '2022-06-02 10:10:32', '2024-12-03 04:19:31'),
(21, 'Gallery', 'gallery', 'templates.elegant.', NULL, NULL, 1, '2024-12-08 06:40:50', '2024-12-08 06:40:50'),
(22, 'Video', 'video', 'templates.elegant.', NULL, NULL, 1, '2024-12-08 06:41:02', '2024-12-08 06:41:02'),
(23, 'News', 'news', 'templates.elegant.', '[\"subscribe\"]', NULL, 1, '2020-10-22 01:14:43', '2025-06-15 06:05:55'),
(24, 'Contact', 'contact', 'templates.elegant.', '[\"facility\",\"subscribe\"]', NULL, 1, '2020-10-22 01:14:53', '2025-07-14 04:48:43'),
(25, 'ABOUT US', 'about-us', 'templates.elegant.', '[\"about\",\"booking_advantage\",\"location\",\"subscribe\"]', NULL, 0, '2025-06-15 05:52:24', '2025-07-14 04:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `group`, `code`) VALUES
(1, 'Dashboard', 'AdminController', 'admin.dashboard'),
(2, 'Notifications', 'AdminController', 'admin.notifications'),
(3, 'Read Notification', 'AdminController', 'admin.notification.read'),
(4, 'Read All Notifications', 'AdminController', 'admin.notifications.read.all'),
(5, 'Delete All Notifications', 'AdminController', 'admin.notifications.delete.all'),
(6, 'Delete Single Notification', 'AdminController', 'admin.notifications.delete.single'),
(9, 'Download Attachment', 'AdminController', 'admin.download.attachment'),
(10, 'All Staff', 'StaffController', 'admin.staff.index'),
(11, 'Save Staff', 'StaffController', 'admin.staff.save'),
(12, 'Update Staff Status', 'StaffController', 'admin.staff.status'),
(13, 'Login As Staff', 'StaffController', 'admin.staff.login'),
(14, 'Roles', 'RolesController', 'admin.roles.index'),
(15, 'Add Role', 'RolesController', 'admin.roles.add'),
(16, 'Update Roles', 'RolesController', 'admin.roles.edit'),
(17, 'Save Role', 'RolesController', 'admin.roles.save'),
(18, 'All Guests', 'ManageUsersController', 'admin.users.all'),
(19, 'Active Guests', 'ManageUsersController', 'admin.users.active'),
(20, 'Banned Guests', 'ManageUsersController', 'admin.users.banned'),
(21, 'Email Verified Guests', 'ManageUsersController', 'admin.users.email.verified'),
(22, 'Email Unverified Guests', 'ManageUsersController', 'admin.users.email.unverified'),
(23, 'Mobile Unverified Guests', 'ManageUsersController', 'admin.users.mobile.unverified'),
(24, 'Mobile Verified Guests', 'ManageUsersController', 'admin.users.mobile.verified'),
(25, 'Guest\'s Detail', 'ManageUsersController', 'admin.users.detail'),
(26, 'Update Guest Info', 'ManageUsersController', 'admin.users.update'),
(27, 'Guests\' Notification Single', 'ManageUsersController', 'admin.users.notification.single'),
(28, 'Send Guests\' Single Notification', 'ManageUsersController', 'admin.users.notification.single.send'),
(29, 'Login As Guest', 'ManageUsersController', 'admin.users.login'),
(30, 'Update Guest\'s Status', 'ManageUsersController', 'admin.users.status'),
(31, 'Guests All Notification', 'ManageUsersController', 'admin.users.notification.all'),
(32, 'Send Notifications To All Guests', 'ManageUsersController', 'admin.users.notification.all.send'),
(35, 'Guests Notification Logs', 'ManageUsersController', 'admin.users.notification.log'),
(36, 'Amenities', 'AmenitiesController', 'admin.hotel.amenity.all'),
(37, 'Save Amenity', 'AmenitiesController', 'admin.hotel.amenity.save'),
(38, 'Update Amenity Status', 'AmenitiesController', 'admin.hotel.amenity.status'),
(39, 'Beds', 'BedTypeController', 'admin.hotel.bed.all'),
(40, 'Save Bed', 'BedTypeController', 'admin.hotel.bed.save'),
(41, 'Delete Bed', 'BedTypeController', 'admin.hotel.bed.delete'),
(42, 'Facilities', 'FacilityController', 'admin.hotel.facility.all'),
(43, 'Save Facility', 'FacilityController', 'admin.hotel.facility.save'),
(44, 'Update Facility Status', 'FacilityController', 'admin.hotel.facility.status'),
(45, 'Room Types', 'RoomTypeController', 'admin.hotel.room.type.all'),
(46, 'Create Room Type', 'RoomTypeController', 'admin.hotel.room.type.create'),
(47, 'Update Room Type - Page', 'RoomTypeController', 'admin.hotel.room.type.edit'),
(48, 'Save Room Type', 'RoomTypeController', 'admin.hotel.room.type.save'),
(49, 'Update Room Type Status', 'RoomTypeController', 'admin.hotel.room.type.status'),
(50, 'All Rooms', 'RoomController', 'admin.hotel.room.index'),
(51, 'Add Room', 'RoomController', 'admin.hotel.room.add'),
(52, 'Update Room', 'RoomController', 'admin.hotel.room.update'),
(53, 'Update Room Status', 'RoomController', 'admin.hotel.room.status'),
(54, 'Premium Services', 'PremiumServiceController', 'admin.hotel.premium.service.all'),
(55, 'Save Premium Service', 'PremiumServiceController', 'admin.hotel.premium.service.save'),
(56, 'Update Premium Service Status', 'PremiumServiceController', 'admin.hotel.premium.service.status'),
(57, 'Book Room - Page', 'BookRoomController', 'admin.book.room'),
(58, 'Book Room', 'BookRoomController', 'admin.room.book'),
(59, 'Merge Booking', 'ManageBookingController', 'admin.booking.merge'),
(60, 'Booking Payment - Page', 'ManageBookingController', 'admin.booking.payment'),
(61, 'Booking Payment', 'ManageBookingController', 'admin.booking.payment'),
(62, 'Booking Checkout - Page', 'ManageBookingController', 'admin.booking.checkout'),
(63, 'Booking Checkout', 'ManageBookingController', 'admin.booking.checkout'),
(64, 'Booked Rooms', 'BookingController', 'admin.booking.booked.rooms'),
(65, 'Booking Details', 'BookingController', 'admin.booking.details'),
(66, 'Booking Invoice', 'ManageBookingController', 'admin.booking.invoice'),
(67, 'Handover Key', 'ManageBookingController', 'admin.booking.key.handover'),
(68, 'All Bookings', 'BookingController', 'admin.booking.all'),
(69, 'Active Booking', 'BookingController', 'admin.booking.active'),
(70, 'Canceled Booking List', 'BookingController', 'admin.booking.canceled.list'),
(71, 'Checked Out Booking List', 'BookingController', 'admin.booking.checked.out.list'),
(72, 'Todays Booked Booking', 'BookingController', 'admin.booking.todays.booked'),
(73, 'Todays Checkin Booking', 'BookingController', 'admin.booking.todays.checkin'),
(74, 'Todays Checkout Booking', 'BookingController', 'admin.booking.todays.checkout'),
(75, 'Refundable Booking', 'BookingController', 'admin.booking.refundable'),
(76, 'Checkout Delayed Booking', 'BookingController', 'admin.booking.checkout.delayed'),
(77, 'Add Extra Charge', 'ManageBookingController', 'admin.booking.extra.charge.add'),
(78, 'Subtract Extra Charge', 'ManageBookingController', 'admin.booking.extra.charge.subtract'),
(79, 'Booking Service Details', 'ManageBookingController', 'admin.booking.service.details'),
(80, 'Booking Cancel - Page', 'CancelBookingController', 'admin.booking.cancel'),
(81, 'Cancel Full Booking', 'CancelBookingController', 'admin.booking.cancel.full'),
(82, 'Cancel Booked Room', 'CancelBookingController', 'admin.booking.booked.room.cancel'),
(83, 'Day Wise Cancel Booked Room', 'CancelBookingController', 'admin.booking.booked.day.cancel'),
(84, 'Upcoming Booking Checkin', 'BookingController', 'admin.upcoming.booking.checkin'),
(85, 'Upcoming Booking Checkout', 'BookingController', 'admin.upcoming.booking.checkout'),
(86, 'Pending Booking Checkin', 'BookingController', 'admin.pending.booking.checkin'),
(87, 'Delayed Booking Checkout', 'BookingController', 'admin.delayed.booking.checkout'),
(88, 'Used Premium Services', 'BookingPremiumServiceController', 'admin.premium.service.list'),
(89, 'Add Premium Service - Page', 'BookingPremiumServiceController', 'admin.premium.service.add'),
(90, 'Add Premium Service', 'BookingPremiumServiceController', 'admin.premium.service.save'),
(91, 'Delete Premium Service', 'BookingPremiumServiceController', 'admin.premium.service.delete'),
(92, 'Booking Requests', 'ManageBookingRequestController', 'admin.request.booking.all'),
(93, 'Canceled Booking Requests', 'ManageBookingRequestController', 'admin.request.booking.canceled'),
(94, 'Approved Booking Requests', 'ManageBookingRequestController', 'admin.request.booking.approve'),
(95, 'Cancel Booking Request', 'ManageBookingRequestController', 'admin.request.booking.cancel'),
(96, 'Approve Booking Request', 'ManageBookingRequestController', 'admin.request.booking.assign.room'),
(97, 'Subscribers', 'SubscriberController', 'admin.subscriber.index'),
(98, 'Send Email To Subscriber - Page', 'SubscriberController', 'admin.subscriber.send.email'),
(99, 'Remove Subscriber', 'SubscriberController', 'admin.subscriber.remove'),
(100, 'Send Email To Subscribers', 'SubscriberController', 'admin.subscriber.email.send'),
(101, 'Automatic Gateways', 'AutomaticGatewayController', 'admin.gateway.automatic.index'),
(102, 'Update Automatic Gateway - Page', 'AutomaticGatewayController', 'admin.gateway.automatic.edit'),
(103, 'Update Automatic Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.update'),
(104, 'Remove Gateway', 'AutomaticGatewayController', 'admin.gateway.automatic.remove'),
(105, 'Update Status', 'AutomaticGatewayController', 'admin.gateway.automatic.status'),
(106, 'Manual Gateways', 'ManualGatewayController', 'admin.gateway.manual.index'),
(107, 'Create Gateway - Page', 'ManualGatewayController', 'admin.gateway.manual.create'),
(108, 'Create Gateway', 'ManualGatewayController', 'admin.gateway.manual.store'),
(109, 'Update Gateway - Page', 'ManualGatewayController', 'admin.gateway.manual.edit'),
(110, 'Update Gateway', 'ManualGatewayController', 'admin.gateway.manual.update'),
(111, 'Update Status', 'ManualGatewayController', 'admin.gateway.manual.status'),
(112, 'All Payments', 'DepositController', 'admin.deposit.list'),
(113, 'Pending Payments', 'DepositController', 'admin.deposit.pending'),
(114, 'Rejected Payments', 'DepositController', 'admin.deposit.rejected'),
(115, 'Approved Payments', 'DepositController', 'admin.deposit.approved'),
(116, 'Successful Payments', 'DepositController', 'admin.deposit.successful'),
(117, 'Initiated Payments', 'DepositController', 'admin.deposit.initiated'),
(118, 'Payment Detail', 'DepositController', 'admin.deposit.details'),
(119, 'Reject Payment', 'DepositController', 'admin.deposit.reject'),
(120, 'Approve Payment', 'DepositController', 'admin.deposit.approve'),
(128, 'Login History', 'ReportController', 'admin.report.login.history'),
(129, 'Login IpHistory', 'ReportController', 'admin.report.login.ipHistory'),
(130, 'Notification History', 'ReportController', 'admin.report.notification.history'),
(131, 'Email Details', 'ReportController', 'admin.report.email.details'),
(132, 'Booking History', 'ReportController', 'admin.report.booking.history'),
(133, 'Payments Received', 'ReportController', 'admin.report.payments.received'),
(134, 'Payments Returned', 'ReportController', 'admin.report.payments.returned'),
(135, 'Support Tickets', 'SupportTicketController', 'admin.ticket.index'),
(136, 'Pending Tickets', 'SupportTicketController', 'admin.ticket.pending'),
(137, 'Closed Tickets', 'SupportTicketController', 'admin.ticket.closed'),
(138, 'Answered Tickets', 'SupportTicketController', 'admin.ticket.answered'),
(139, 'View Ticket', 'SupportTicketController', 'admin.ticket.view'),
(140, 'Reply Ticket', 'SupportTicketController', 'admin.ticket.reply'),
(141, 'Close Ticket', 'SupportTicketController', 'admin.ticket.close'),
(142, 'Download Attachment', 'SupportTicketController', 'admin.ticket.download'),
(143, 'Delete Ticket', 'SupportTicketController', 'admin.ticket.delete'),
(144, 'Language', 'LanguageController', 'admin.language.manage'),
(145, 'Language Store', 'LanguageController', 'admin.language.manage.store'),
(146, 'Language Delete', 'LanguageController', 'admin.language.manage.delete'),
(147, 'Language Update', 'LanguageController', 'admin.language.manage.update'),
(148, 'Language Key', 'LanguageController', 'admin.language.key'),
(149, 'Language Import', 'LanguageController', 'admin.language.import.lang'),
(150, 'Store Key', 'LanguageController', 'admin.language.store.key'),
(151, 'Delete Key', 'LanguageController', 'admin.language.delete.key'),
(152, 'Update Key', 'LanguageController', 'admin.language.update.key'),
(153, 'System Setting', 'GeneralSettingController', 'admin.setting.system'),
(154, 'General Setting', 'GeneralSettingController', 'admin.setting.general'),
(155, 'Update General Settings', 'GeneralSettingController', 'admin.setting.update'),
(156, 'Socialite Credentials', 'GeneralSettingController', 'admin.setting.socialite.credentials'),
(157, 'Update Socialite Credentials', 'GeneralSettingController', 'admin.setting.socialite.credentials.update'),
(158, 'Update Socialite Credential Status', 'GeneralSettingController', 'admin.setting.socialite.credentials.status.update'),
(159, 'System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration'),
(160, 'Update System Configuration', 'GeneralSettingController', 'admin.setting.system.configuration.submit'),
(161, 'Logo & Favicon', 'GeneralSettingController', 'admin.setting.logo.icon'),
(162, 'Update Logo & Favicon', 'GeneralSettingController', 'admin.setting.update.logo.icon'),
(163, 'Custom Css - Page', 'GeneralSettingController', 'admin.setting.custom.css'),
(164, 'Update Custom Css', 'GeneralSettingController', 'admin.setting.custom.css.submit'),
(165, 'Sitemap - Page', 'GeneralSettingController', 'admin.setting.sitemap'),
(166, 'Update Sitemap', 'GeneralSettingController', 'admin.setting.sitemap.submit'),
(167, 'Robot - Page', 'GeneralSettingController', 'admin.setting.robot'),
(168, 'Update Robot', 'GeneralSettingController', 'admin.setting.robot.submit'),
(169, 'Cookie Setting - Page', 'GeneralSettingController', 'admin.setting.cookie'),
(170, 'Update Cookie', 'GeneralSettingController', 'admin.setting.cookie.submit'),
(171, 'Maintenance Mode - Page', 'GeneralSettingController', 'admin.maintenance.mode'),
(172, 'Update Maintenance Page', 'GeneralSettingController', 'admin.maintenance.mode.submit'),
(176, 'Global Email Setting - Page', 'NotificationController', 'admin.setting.notification.global.email'),
(177, 'Save Global Email Config', 'NotificationController', 'admin.setting.notification.global.email.update'),
(178, 'Global SMS Setting - Page', 'NotificationController', 'admin.setting.notification.global.sms'),
(179, 'Save Global SMS Config', 'NotificationController', 'admin.setting.notification.global.sms.update'),
(180, 'Global Push Setting - Page', 'NotificationController', 'admin.setting.notification.global.push'),
(181, 'Save Global Push Config', 'NotificationController', 'admin.setting.notification.global.push.update'),
(182, 'Notification Template Setting - Page', 'NotificationController', 'admin.setting.notification.templates'),
(183, 'Update Notification Template - Page', 'NotificationController', 'admin.setting.notification.template.edit'),
(184, 'Update Notification Template', 'NotificationController', 'admin.setting.notification.template.update'),
(185, 'Email Notification Setting - Page', 'NotificationController', 'admin.setting.notification.email'),
(186, 'Save Email Notification Config', 'NotificationController', 'admin.setting.notification.email.update'),
(187, 'Test Email Notification', 'NotificationController', 'admin.setting.notification.email.test'),
(188, 'SMS Notification Setting - Page', 'NotificationController', 'admin.setting.notification.sms'),
(189, 'Save SMS Notification Config', 'NotificationController', 'admin.setting.notification.sms.update'),
(190, 'Test SMS Notification', 'NotificationController', 'admin.setting.notification.sms.test'),
(191, 'Push Notification Setting - Page', 'NotificationController', 'admin.setting.notification.push'),
(192, 'Save Push Notification Config', 'NotificationController', 'admin.setting.notification.push.update'),
(193, 'Extensions', 'ExtensionController', 'admin.extensions.index'),
(194, 'Update Extension', 'ExtensionController', 'admin.extensions.update'),
(195, 'Update Notification Status', 'ExtensionController', 'admin.extensions.status'),
(196, 'System Info', 'SystemController', 'admin.system.info'),
(197, 'System Server Info', 'SystemController', 'admin.system.server.info'),
(198, 'System Optimize', 'SystemController', 'admin.system.optimize'),
(199, 'System Optimize Clear', 'SystemController', 'admin.system.optimize.clear'),
(200, 'System Update', 'SystemController', 'admin.system.update'),
(201, 'System Update Process', 'SystemController', 'admin.system.update.process'),
(202, 'System Update Log', 'SystemController', 'admin.system.update.log'),
(203, 'Seo', 'FrontendController', 'admin.seo'),
(204, 'Frontend Manager', 'FrontendController', 'admin.frontend.index'),
(205, 'Templates', 'FrontendController', 'admin.frontend.templates'),
(206, 'Update Template', 'FrontendController', 'admin.frontend.templates.active'),
(207, 'Sections', 'FrontendController', 'admin.frontend.sections'),
(208, 'Update Section Content', 'FrontendController', 'admin.frontend.sections.content'),
(209, 'Section Elements', 'FrontendController', 'admin.frontend.sections.element'),
(210, 'Element SEO - Page', 'FrontendController', 'admin.frontend.sections.element.seo'),
(212, 'Remove Content', 'FrontendController', 'admin.frontend.remove'),
(213, 'Manage Pages', 'PageBuilderController', 'admin.frontend.manage.pages'),
(214, 'Save Page', 'PageBuilderController', 'admin.frontend.manage.pages.save'),
(215, 'Update Page', 'PageBuilderController', 'admin.frontend.manage.pages.update'),
(216, 'Delete Page', 'PageBuilderController', 'admin.frontend.manage.pages.delete'),
(217, 'Manage Section', 'PageBuilderController', 'admin.frontend.manage.section'),
(218, 'Update Section', 'PageBuilderController', 'admin.frontend.manage.section.update'),
(219, 'Page SEO', 'PageBuilderController', 'admin.frontend.manage.pages.seo'),
(224, 'Update Element SEO', 'FrontendController', 'admin.frontend.sections.element.seo.update'),
(225, 'Save Page SEO', 'PageBuilderController', 'admin.frontend.manage.pages.seo.store'),
(228, 'Apply Coupon', 'BookRoomController', 'admin.room.apply.coupon'),
(229, 'Remove Coupon', 'BookRoomController', 'admin.room.remove.coupon'),
(230, 'Delete All Canceled Booking', 'ManageBookingRequestController', 'admin.request.booking.canceled.delete'),
(231, 'All Coupons', 'CouponController', 'admin.coupon.index'),
(232, 'Create Coupon - Page', 'CouponController', 'admin.coupon.create'),
(233, 'Edit Coupon - Page', 'CouponController', 'admin.coupon.edit'),
(234, 'Add/Update Coupon', 'CouponController', 'admin.coupon.store'),
(235, 'Coupon Type Page', 'CouponController', 'admin.coupon.room.type'),
(236, 'Applied Coupon', 'CouponController', 'admin.coupon.applied'),
(237, 'Change Coupon Status', 'CouponController', 'admin.coupon.status.change'),
(238, 'All Offers', 'OfferController', 'admin.offer.index'),
(239, 'Create Offer - Page', 'OfferController', 'admin.offer.create'),
(240, 'Edit Offer - Page', 'OfferController', 'admin.offer.edit'),
(241, 'Add offer', 'OfferController', 'admin.offer.store'),
(242, 'Change Offer Status', 'OfferController', 'admin.offer.status'),
(243, 'Upload Push Notification Json File', 'NotificationController', 'admin.setting.notification.push.upload'),
(244, 'Download Push Notification Json File', 'NotificationController', 'admin.setting.notification.push.download');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `premium_services`
--

CREATE TABLE `premium_services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `status` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `room_type_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_number` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_booking_requests`
--

CREATE TABLE `room_booking_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_request_id` int UNSIGNED DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `room_type_id` int DEFAULT NULL,
  `adult` int DEFAULT '0',
  `children` int NOT NULL DEFAULT '0',
  `quantity` int NOT NULL DEFAULT '0',
  `unit_fare` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `total_fare` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_suite` tinyint(1) NOT NULL DEFAULT '1',
  `main_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_adult` int NOT NULL DEFAULT '0',
  `total_child` int NOT NULL DEFAULT '0',
  `size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fare` decimal(28,8) DEFAULT NULL,
  `offer_fare` decimal(28,8) DEFAULT NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `beds` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancellation_fee` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `cancellation_policy` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `offer_id` int UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_amenities`
--

CREATE TABLE `room_type_amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `room_type_id` int UNSIGNED NOT NULL DEFAULT '0',
  `amenities_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_facilities`
--

CREATE TABLE `room_type_facilities` (
  `id` bigint UNSIGNED NOT NULL,
  `room_type_id` int UNSIGNED DEFAULT '0',
  `facility_id` int UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_type_images`
--

CREATE TABLE `room_type_images` (
  `id` bigint UNSIGNED NOT NULL,
  `room_type_id` int UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suites_type_rooms`
--

CREATE TABLE `suites_type_rooms` (
  `id` bigint UNSIGNED NOT NULL,
  `room_types_id` int UNSIGNED NOT NULL,
  `room_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_attachments`
--

CREATE TABLE `support_attachments` (
  `id` bigint UNSIGNED NOT NULL,
  `support_message_id` int UNSIGNED NOT NULL DEFAULT '0',
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_messages`
--

CREATE TABLE `support_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `support_ticket_id` int UNSIGNED NOT NULL DEFAULT '0',
  `admin_id` int UNSIGNED NOT NULL DEFAULT '0',
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT '0',
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: Open, 1: Answered, 2: Replied, 3: Closed',
  `priority` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Low, 2 = medium, 3 = heigh',
  `last_reply` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_logs`
--

CREATE TABLE `update_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `used_premium_services`
--

CREATE TABLE `used_premium_services` (
  `id` bigint UNSIGNED NOT NULL,
  `booking_id` int UNSIGNED NOT NULL DEFAULT '0',
  `premium_service_id` int UNSIGNED NOT NULL DEFAULT '0',
  `room_id` int UNSIGNED NOT NULL DEFAULT '0',
  `booked_room_id` int UNSIGNED DEFAULT NULL,
  `qty` int UNSIGNED NOT NULL DEFAULT '0',
  `unit_price` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `total_amount` decimal(28,8) NOT NULL DEFAULT '0.00000000',
  `service_date` date DEFAULT NULL,
  `admin_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dial_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: banned, 1: active',
  `ev` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: email unverified, 1: email verified',
  `sv` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0: mobile unverified, 1: mobile verified',
  `profile_complete` tinyint(1) NOT NULL DEFAULT '0',
  `ver_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'stores verification code',
  `ver_code_send_at` datetime DEFAULT NULL COMMENT 'verification send time',
  `tsc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ban_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL DEFAULT '0',
  `user_ip` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `os` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applied_coupons`
--
ALTER TABLE `applied_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_types`
--
ALTER TABLE `bed_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_action_histories`
--
ALTER TABLE `booking_action_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupon_code` (`coupon_code`);

--
-- Indexes for table `coupon_room_type`
--
ALTER TABLE `coupon_room_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `premium_services`
--
ALTER TABLE `premium_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `room_booking_requests`
--
ALTER TABLE `room_booking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_facilities`
--
ALTER TABLE `room_type_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_type_images`
--
ALTER TABLE `room_type_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suites_type_rooms`
--
ALTER TABLE `suites_type_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_attachments`
--
ALTER TABLE `support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_messages`
--
ALTER TABLE `support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_logs`
--
ALTER TABLE `update_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `used_premium_services`
--
ALTER TABLE `used_premium_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_password_resets`
--
ALTER TABLE `admin_password_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applied_coupons`
--
ALTER TABLE `applied_coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bed_types`
--
ALTER TABLE `bed_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booked_rooms`
--
ALTER TABLE `booked_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_action_histories`
--
ALTER TABLE `booking_action_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_room_type`
--
ALTER TABLE `coupon_room_type`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontends`
--
ALTER TABLE `frontends`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gateway_currencies`
--
ALTER TABLE `gateway_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `premium_services`
--
ALTER TABLE `premium_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_booking_requests`
--
ALTER TABLE `room_booking_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_amenities`
--
ALTER TABLE `room_type_amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_facilities`
--
ALTER TABLE `room_type_facilities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type_images`
--
ALTER TABLE `room_type_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suites_type_rooms`
--
ALTER TABLE `suites_type_rooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_attachments`
--
ALTER TABLE `support_attachments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_messages`
--
ALTER TABLE `support_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_logs`
--
ALTER TABLE `update_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `used_premium_services`
--
ALTER TABLE `used_premium_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
