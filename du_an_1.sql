-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2025 lúc 06:31 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `du_an_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apple', '2024-11-24 00:26:22', '2024-12-01 09:28:25'),
(2, 'samsung', '2024-11-24 00:26:27', '2024-11-24 00:26:27'),
(3, 'Oppo', '2024-12-01 09:33:24', '2024-12-01 09:33:24'),
(5, 'Xiaomi', '2024-12-01 09:35:06', '2024-12-01 09:35:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2024_11_12_005530_create_categories_table', 2),
(6, '2024_11_14_022252_create_products_table', 4),
(11, '2024_11_23_172634_create_password_resets_table', 9),
(12, '2024_11_24_051955_add_reset_token_to_users_table', 10),
(13, '2024_11_24_064528_create_password_resets_table', 11),
(15, '0001_01_01_000000_create_users_table', 12),
(16, '0001_01_01_000001_create_cache_table', 12),
(17, '0001_01_01_000002_create_jobs_table', 12),
(18, '2024_11_14_020651_create_categories_table', 12),
(19, '2024_11_15_140336_create_products_table', 12),
(20, '2024_11_16_002234_add_image_to_products_table', 12),
(21, '2024_11_20_160218_add_role_to_users_table', 12),
(22, '2024_11_23_160514_create_personal_access_tokens_table', 12),
(23, '2024_11_24_070129_add_reset_token_to_users_table', 12),
(24, '2024_11_26_040912_create_carts_table', 13),
(25, '2024_11_26_041544_create_cart_table', 14),
(26, '2024_11_28_034126_create_orders_table', 15),
(27, '2024_11_28_040005_create_orders_table', 16),
(28, '2024_11_28_041808_create_order_items_table', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `status` enum('pending','paid','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `recipient_name`, `recipient_phone`, `address`, `payment_method`, `status`, `total_amount`, `created_at`, `updated_at`) VALUES
(39, 1, 'Trần Tiến Phát', '0942960548', 'sssss', 'vnpay', 'delivered', 19000000.00, '2024-12-08 06:59:07', '2024-12-09 01:47:40'),
(40, 2, 'Trần Tiến Phát', '0942960548', 'ssssss', 'vnpay', 'delivered', 30000000.00, '2024-12-09 18:57:50', '2024-12-09 18:59:27'),
(41, 1, 'Trần Tiến Phát', '0942960548', 'sssssssss', 'cash', 'pending', 19000000.00, '2024-12-09 19:00:24', '2024-12-09 19:00:24'),
(42, 6, 'Trần Tiến Phát', '0942960548', 'bbbbbbbbbbbb', 'vnpay', 'cancelled', 38000000.00, '2024-12-10 19:03:17', '2024-12-10 19:09:53'),
(43, 1, 'Trần Tiến Phát', '0942960548', 'nnnnnnnnnnnnnn', 'vnpay', 'delivered', 25000000.00, '2024-12-10 19:08:43', '2024-12-10 19:10:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(42, 39, 6, 1, 19000000.00, '2024-12-08 06:59:07', '2024-12-08 06:59:07'),
(43, 40, 7, 1, 30000000.00, '2024-12-09 18:57:50', '2024-12-09 18:57:50'),
(44, 41, 6, 1, 19000000.00, '2024-12-09 19:00:24', '2024-12-09 19:00:24'),
(45, 42, 6, 2, 19000000.00, '2024-12-10 19:03:17', '2024-12-10 19:03:17'),
(46, 43, 8, 1, 25000000.00, '2024-12-10 19:08:43', '2024-12-10 19:08:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'YourAppName', '0d8870b2ce497416e61afeb9aa2cf180b9471baea837648179e64b056ca39d12', '[\"*\"]', NULL, NULL, '2024-11-24 00:23:37', '2024-11-24 00:23:37'),
(2, 'App\\Models\\User', 1, 'YourAppName', '1755da24df6c232e8b8d531916d747120dbc11a2ccd2787fa077c87df2b5fcfd', '[\"*\"]', NULL, NULL, '2024-11-24 00:24:13', '2024-11-24 00:24:13'),
(3, 'App\\Models\\User', 1, 'YourAppName', 'daf420e9ed105879f84595a6530d5d6bee153d34ee85c6ee69ccd1c6f07dec1c', '[\"*\"]', NULL, NULL, '2024-11-24 00:24:44', '2024-11-24 00:24:44'),
(4, 'App\\Models\\User', 1, 'YourAppName', 'fa0b72f1476641e0429fe1847b8b6db92cc038a80757abc63bdab541421900d9', '[\"*\"]', NULL, NULL, '2024-11-24 00:26:16', '2024-11-24 00:26:16'),
(5, 'App\\Models\\User', 1, 'YourAppName', 'a38977fb1dcb216d85253da83eb42c981e7ec0def98438eb39fa73e6e720745f', '[\"*\"]', NULL, NULL, '2024-11-24 01:17:04', '2024-11-24 01:17:04'),
(6, 'App\\Models\\User', 1, 'YourAppName', '3541346502d17e590584ec5c1cf8da09cce8d41035c34dfdeccad7e9fc73c9bc', '[\"*\"]', NULL, NULL, '2024-11-24 05:54:59', '2024-11-24 05:54:59'),
(7, 'App\\Models\\User', 2, 'YourAppName', '02d6b467c82e2d76ed3259a34a9fd3de2f16e91d3912b9d92719c932aebe3f1b', '[\"*\"]', NULL, NULL, '2024-11-24 05:59:04', '2024-11-24 05:59:04'),
(8, 'App\\Models\\User', 2, 'YourAppName', 'beb7fde24dee7ad8e2b7ab3616261b3380f6c6b98e60bd92c3000a37ca1e7488', '[\"*\"]', NULL, NULL, '2024-11-24 07:18:56', '2024-11-24 07:18:56'),
(9, 'App\\Models\\User', 1, 'YourAppName', '4df99c62544003ebe824efeafa5e7d09fb3cf11510aabd23d56b042563de1c14', '[\"*\"]', NULL, NULL, '2024-11-24 07:19:11', '2024-11-24 07:19:11'),
(10, 'App\\Models\\User', 2, 'YourAppName', 'bfb29372989b21c256bc070e346c68637c59754a90240ca902bce4534f106014', '[\"*\"]', NULL, NULL, '2024-11-24 08:10:18', '2024-11-24 08:10:18'),
(11, 'App\\Models\\User', 1, 'YourAppName', '56f86e234e6fe7cf0fc7e3b5da8a628757f034f90c990c3393c9d8477f605892', '[\"*\"]', NULL, NULL, '2024-11-25 18:20:06', '2024-11-25 18:20:06'),
(12, 'App\\Models\\User', 1, 'YourAppName', '633663f4dd30a9c5ccc861d7cdd9caf616f0fc87f1d62b1f01ab6cd9d6fd3c75', '[\"*\"]', NULL, NULL, '2024-11-25 18:54:05', '2024-11-25 18:54:05'),
(13, 'App\\Models\\User', 1, 'YourAppName', '6bb85d071e3f3c6afdb1dd93935ead021f1488341ebf0a8f8fdb162c54ed5a33', '[\"*\"]', NULL, NULL, '2024-11-25 18:57:55', '2024-11-25 18:57:55'),
(14, 'App\\Models\\User', 2, 'YourAppName', 'ede2779ee330c483ab9b6dcc955bb499d763c3b54609012b7ee71c04ce627092', '[\"*\"]', NULL, NULL, '2024-11-25 19:06:24', '2024-11-25 19:06:24'),
(15, 'App\\Models\\User', 2, 'YourAppName', '566b8ef0cd81bb206bd9f9b91b9d4d9be67e43baaec7586c74ba8bb9415243df', '[\"*\"]', NULL, NULL, '2024-11-25 19:36:42', '2024-11-25 19:36:42'),
(16, 'App\\Models\\User', 2, 'YourAppName', '14993906db2406e31015c72e002f869d51b9f7656e92678c45c1f9f4272a0003', '[\"*\"]', NULL, NULL, '2024-11-25 20:07:26', '2024-11-25 20:07:26'),
(17, 'App\\Models\\User', 2, 'YourAppName', 'd4a860dccb0d8951c4c2a2651d098f8a0ee0f4006a65769a17738a48ccabe352', '[\"*\"]', NULL, NULL, '2024-11-25 20:07:26', '2024-11-25 20:07:26'),
(18, 'App\\Models\\User', 2, 'YourAppName', 'd2c0f5cf940efffc29aba164c432da68e4dd7c84dcbcb17a37a89aac8fc674d8', '[\"*\"]', NULL, NULL, '2024-11-25 20:08:56', '2024-11-25 20:08:56'),
(19, 'App\\Models\\User', 2, 'YourAppName', '98865dab8cc22ee0d816e0932c224f4a5f3d033006de54feeaa3c74e7699e072', '[\"*\"]', NULL, NULL, '2024-11-25 20:09:07', '2024-11-25 20:09:07'),
(20, 'App\\Models\\User', 2, 'YourAppName', '9ae96c6835ba494e93eb6c7a3787901a36969fdc1d7093829027d62ea529a973', '[\"*\"]', NULL, NULL, '2024-11-25 20:09:39', '2024-11-25 20:09:39'),
(21, 'App\\Models\\User', 2, 'YourAppName', '1663ff0d5b200a217e9226f8b456f4092001deeea4909b1b0ee076075a3b08bf', '[\"*\"]', NULL, NULL, '2024-11-25 20:10:18', '2024-11-25 20:10:18'),
(22, 'App\\Models\\User', 2, 'YourAppName', '14353abb752a04229fe0497a11a0818c170a1551a5adf55667a83afad55e62a2', '[\"*\"]', NULL, NULL, '2024-11-25 20:16:05', '2024-11-25 20:16:05'),
(23, 'App\\Models\\User', 2, 'YourAppName', '8a0ec4b5437c164d86aa0243da33868930367da1e7ea5678cbbe48373a99bcca', '[\"*\"]', NULL, NULL, '2024-11-25 20:16:30', '2024-11-25 20:16:30'),
(24, 'App\\Models\\User', 1, 'YourAppName', '710f04c517514debd439922386364a4c7a07cbd977a6c27aaab45fd45827c791', '[\"*\"]', NULL, NULL, '2024-11-25 20:19:36', '2024-11-25 20:19:36'),
(25, 'App\\Models\\User', 1, 'YourAppName', 'd90734dd736f6bbabd8e972dfbb11b942b414c3a6ae7bdf6678fa94825560802', '[\"*\"]', NULL, NULL, '2024-11-25 20:21:42', '2024-11-25 20:21:42'),
(26, 'App\\Models\\User', 2, 'YourAppName', 'a7de49e23735ffcacf90b0843553fa68488bf5c26fa2e48197caace329fc5b29', '[\"*\"]', NULL, NULL, '2024-11-25 20:59:24', '2024-11-25 20:59:24'),
(27, 'App\\Models\\User', 2, 'YourAppName', '979b384264265da7cd8cc9dfb6341b8bd6af03966a27200142719713aad04fc6', '[\"*\"]', NULL, NULL, '2024-11-26 17:33:48', '2024-11-26 17:33:48'),
(28, 'App\\Models\\User', 2, 'YourAppName', '683819099d1409b154d0dfd9f8d3b5f71021d0850cb994ed4dac95504a9766cf', '[\"*\"]', NULL, NULL, '2024-11-26 17:44:55', '2024-11-26 17:44:55'),
(29, 'App\\Models\\User', 3, 'YourAppName', 'c57983b57f4a7690845d0ccb4ee74ebb595a1b816ff602cf6acf9e76c69b1b02', '[\"*\"]', NULL, NULL, '2024-11-26 18:35:41', '2024-11-26 18:35:41'),
(30, 'App\\Models\\User', 2, 'YourAppName', 'eb55cb8bcbb081f01bbe72d114b9b4a34a0af3985ec051de870bd6af461391b8', '[\"*\"]', NULL, NULL, '2024-11-26 18:39:58', '2024-11-26 18:39:58'),
(31, 'App\\Models\\User', 2, 'YourAppName', '630bba120c8aefa68c29461b581e0cc4091bcceabf004ae3719a8925049c8f95', '[\"*\"]', '2024-11-26 21:55:41', NULL, '2024-11-26 19:40:23', '2024-11-26 21:55:41'),
(32, 'App\\Models\\User', 2, 'YourAppName', 'a010f275712349f9956c452b76572849471888f6fc5aa4c9ce4099c9e4929399', '[\"*\"]', NULL, NULL, '2024-11-26 21:35:07', '2024-11-26 21:35:07'),
(33, 'App\\Models\\User', 2, 'YourAppName', 'fd0e6e9c29793ca55d1df633a840c3b0cdb52a29382f2e7aede834c507cb5354', '[\"*\"]', NULL, NULL, '2024-11-26 21:35:22', '2024-11-26 21:35:22'),
(34, 'App\\Models\\User', 2, 'YourAppName', '4825378eda41746b5a9f981bd66dd8eed669a8c68d6c2c141a00f98e50ab49cf', '[\"*\"]', '2024-11-26 21:57:28', NULL, '2024-11-26 21:56:07', '2024-11-26 21:57:28'),
(35, 'App\\Models\\User', 3, 'YourAppName', '1486991796afa96d03e239f2c24a9eabfa0ff8be7316088638b72763fad9f152', '[\"*\"]', '2024-11-26 21:59:11', NULL, '2024-11-26 21:59:09', '2024-11-26 21:59:11'),
(36, 'App\\Models\\User', 2, 'YourAppName', 'c9427fcef4e9397433a0ebd9e10f931b8d45a8f3b65df8038dcddc914722a749', '[\"*\"]', '2024-11-26 22:54:02', NULL, '2024-11-26 21:59:28', '2024-11-26 22:54:02'),
(37, 'App\\Models\\User', 2, 'YourAppName', '80e0d7ba1808961de64d3fe0711dbacfe31e6daedb2b56524149d13d096cbaf2', '[\"*\"]', NULL, NULL, '2024-11-26 22:40:23', '2024-11-26 22:40:23'),
(38, 'App\\Models\\User', 3, 'YourAppName', '5db19d6e8f077270b53bb66f675a7a1d62fcd4d22da2f1b00595e28b8743f07b', '[\"*\"]', '2024-11-26 22:55:29', NULL, '2024-11-26 22:55:17', '2024-11-26 22:55:29'),
(39, 'App\\Models\\User', 2, 'YourAppName', 'fe60b8cb1bbd5381651a33f4a0f32d9f06550a11b86f4710220ff75adfde80bc', '[\"*\"]', '2024-11-26 23:08:27', NULL, '2024-11-26 22:55:50', '2024-11-26 23:08:27'),
(40, 'App\\Models\\User', 2, 'YourAppName', '2f1d2b5a4b16bd24e8681a1a42a5b48f5e853f2fb5ac00c62264725c33e298d8', '[\"*\"]', NULL, NULL, '2024-11-26 23:01:13', '2024-11-26 23:01:13'),
(41, 'App\\Models\\User', 2, 'YourAppName', 'd36f5436e5c7d5baea2ce42b45b052676f98d6b806aa5945d6377331b49711e1', '[\"*\"]', NULL, NULL, '2024-11-26 23:01:26', '2024-11-26 23:01:26'),
(42, 'App\\Models\\User', 2, 'YourAppName', '2309b01282a234c890193310b77d2b4e7b16143377dac68bcb3298ad18c57290', '[\"*\"]', NULL, NULL, '2024-11-26 23:01:32', '2024-11-26 23:01:32'),
(43, 'App\\Models\\User', 3, 'YourAppName', 'f2c1af23bda1ed6876f79f24c1a4064d85e17de10913e3cd02ecb6593767fd6a', '[\"*\"]', '2024-11-26 23:10:01', NULL, '2024-11-26 23:09:46', '2024-11-26 23:10:01'),
(44, 'App\\Models\\User', 2, 'YourAppName', '5390d0e3e3ca2df3d4f0519268e341e82ede28ab942c31b7d5d5f3e90c7688db', '[\"*\"]', '2024-11-26 23:10:30', NULL, '2024-11-26 23:10:27', '2024-11-26 23:10:30'),
(45, 'App\\Models\\User', 2, 'YourAppName', '0923c92fda4c88f6a8f623f9b44d6898b99c1aa563c62e507bd96d0f73d4a3db', '[\"*\"]', NULL, NULL, '2024-11-27 17:20:44', '2024-11-27 17:20:44'),
(46, 'App\\Models\\User', 2, 'YourAppName', 'dceb20b5de058932ee20c9eefc9cf124bc8a2bdeb8deee8b14c648e73010d3ec', '[\"*\"]', '2024-11-27 17:24:03', NULL, '2024-11-27 17:20:56', '2024-11-27 17:24:03'),
(47, 'App\\Models\\User', 2, 'YourAppName', 'c8551613ef6c47dbbfcedfef81c170c04c1ad95421a0659383eccb122f208051', '[\"*\"]', NULL, NULL, '2024-11-27 17:23:15', '2024-11-27 17:23:15'),
(48, 'App\\Models\\User', 3, 'YourAppName', 'd4f999d8cd7dc47b115486d5ad13be0f24cd2b04bea9934d6c711a3ede27f24f', '[\"*\"]', '2024-11-27 17:39:52', NULL, '2024-11-27 17:24:18', '2024-11-27 17:39:52'),
(49, 'App\\Models\\User', 2, 'YourAppName', '20c65ae0217cbe959ea2cee04a7fa96d40acecdbecc177eb5c0c15722a19f309', '[\"*\"]', NULL, NULL, '2024-11-27 18:10:15', '2024-11-27 18:10:15'),
(50, 'App\\Models\\User', 1, 'YourAppName', 'ccad442014740aa4d48a6c9c44de122f142c327b3808a76c06fb771860f8119f', '[\"*\"]', NULL, NULL, '2024-11-27 19:51:55', '2024-11-27 19:51:55'),
(51, 'App\\Models\\User', 2, 'YourAppName', '60f816b2f4a369056d3aae5bf8909aa5875eda9f3e3982119671aa6aa4f208b9', '[\"*\"]', '2024-11-28 23:14:30', NULL, '2024-11-27 19:52:19', '2024-11-28 23:14:30'),
(52, 'App\\Models\\User', 2, 'YourAppName', 'be3745be29f0f2f541e22f2711a248b46ab0c887189130093ba1ecbfcf280a6c', '[\"*\"]', NULL, NULL, '2024-11-28 18:53:02', '2024-11-28 18:53:02'),
(53, 'App\\Models\\User', 3, 'YourAppName', '5a2dde49bc0435e1b7bb6e5ef34ba11b99886b708e5bd0270de4b54043a7309f', '[\"*\"]', NULL, NULL, '2024-11-28 23:14:58', '2024-11-28 23:14:58'),
(54, 'App\\Models\\User', 3, 'YourAppName', 'e9bf27b0c38386ee69bf400c27e9d13ec2869ea2b3753190a79efafb7c71a04a', '[\"*\"]', '2024-11-28 23:15:32', NULL, '2024-11-28 23:14:59', '2024-11-28 23:15:32'),
(55, 'App\\Models\\User', 1, 'YourAppName', '5b8488273a97c914712e39de673a2843afcb3ea93bc479e774f3251a98ecd6bd', '[\"*\"]', '2024-11-29 00:37:36', NULL, '2024-11-28 23:15:52', '2024-11-29 00:37:36'),
(56, 'App\\Models\\User', 2, 'YourAppName', '3c0fa48e5cdc8136b31d50f0de179b46c2955aa31a6774a0c20ed9f2740b87a7', '[\"*\"]', '2024-11-29 00:48:42', NULL, '2024-11-29 00:37:45', '2024-11-29 00:48:42'),
(57, 'App\\Models\\User', 2, 'YourAppName', '1ecbceb5769c4986e6f4fce6066402afceb7c41e0c5c3f2ae0a43d0a269498d4', '[\"*\"]', '2024-12-01 08:26:05', NULL, '2024-12-01 08:25:43', '2024-12-01 08:26:05'),
(58, 'App\\Models\\User', 1, 'YourAppName', '8b29c0a841818d5204b0ccade2b5f3be0cc51c2e814f4da9f0910ffbeeac8138', '[\"*\"]', '2024-12-01 08:27:32', NULL, '2024-12-01 08:26:45', '2024-12-01 08:27:32'),
(59, 'App\\Models\\User', 2, 'YourAppName', '4aa6b6e0e9a7901d6bd526f03de670c1346338d0ca5d89af3bef7c543672b518', '[\"*\"]', '2024-12-01 09:20:05', NULL, '2024-12-01 08:27:44', '2024-12-01 09:20:05'),
(60, 'App\\Models\\User', 1, 'YourAppName', 'c0fac7667fb70f637ff23947c22432dbca9c2fa725a7325d2c1f08170078f1e8', '[\"*\"]', '2024-12-01 09:20:52', NULL, '2024-12-01 09:20:39', '2024-12-01 09:20:52'),
(61, 'App\\Models\\User', 2, 'YourAppName', '4703b9cbe0cf586d5d50dae980632149cd2721c8c6810c9abcb6292cd78640be', '[\"*\"]', '2024-12-01 09:21:16', NULL, '2024-12-01 09:21:09', '2024-12-01 09:21:16'),
(62, 'App\\Models\\User', 1, 'YourAppName', 'ca4c6efd2cf658cea5bcc0c6e4df594ddf096455818a9b57a6e3fea51a8d497f', '[\"*\"]', '2024-12-01 09:49:04', NULL, '2024-12-01 09:23:36', '2024-12-01 09:49:04'),
(63, 'App\\Models\\User', 2, 'YourAppName', '823abe040bf0077194259407da1343add7e871d640616e1bd43e7964a6139708', '[\"*\"]', '2024-12-01 09:50:35', NULL, '2024-12-01 09:49:41', '2024-12-01 09:50:35'),
(64, 'App\\Models\\User', 1, 'YourAppName', '8bc419e81050f6dbab32f51162c50532e748b6de12ef80ebba32981750c08610', '[\"*\"]', '2024-12-01 09:51:23', NULL, '2024-12-01 09:50:57', '2024-12-01 09:51:23'),
(65, 'App\\Models\\User', 2, 'YourAppName', '0f44806a2ec20e617a1cff8f452fed45ad69b4ce47d3567ec3e5abe6cb7d1ad9', '[\"*\"]', '2024-12-02 19:29:23', NULL, '2024-12-01 09:55:10', '2024-12-02 19:29:23'),
(66, 'App\\Models\\User', 2, 'YourAppName', '08c5745c69d857d64888a91a928d2426e1854c29f03819083cc7a98a8aefcd68', '[\"*\"]', NULL, NULL, '2024-12-02 19:44:37', '2024-12-02 19:44:37'),
(67, 'App\\Models\\User', 2, 'YourAppName', '28bc6cab62b28b768558482834fafe2f3dc63d7616fb7e914bc0dafb978c1ecc', '[\"*\"]', '2024-12-02 19:50:22', NULL, '2024-12-02 19:44:38', '2024-12-02 19:50:22'),
(68, 'App\\Models\\User', 2, 'YourAppName', '71f14488fc134a3a8e6d542a1b344520a4669108fe123d8c45c11a79021221cb', '[\"*\"]', NULL, NULL, '2024-12-02 20:07:01', '2024-12-02 20:07:01'),
(69, 'App\\Models\\User', 2, 'YourAppName', 'c5bfe963acd88a413d74d95e33fd28371f14b38799e0bf6d0f38a77f283f8b42', '[\"*\"]', '2024-12-02 20:35:22', NULL, '2024-12-02 20:22:53', '2024-12-02 20:35:22'),
(70, 'App\\Models\\User', 2, 'YourAppName', 'bc6c54652ac5227343eea8ce80fce1b4b3a3ee1917159a64b3b55ede2f16b5f0', '[\"*\"]', NULL, NULL, '2024-12-02 20:36:10', '2024-12-02 20:36:10'),
(71, 'App\\Models\\User', 1, 'YourAppName', '6b6241a82324ffc6e6ed7a55da5ca33b69baac9ef74f2ee0e6de6e4c51acf10d', '[\"*\"]', '2024-12-02 20:40:49', NULL, '2024-12-02 20:36:45', '2024-12-02 20:40:49'),
(72, 'App\\Models\\User', 2, 'YourAppName', 'e7b85a870eb69a4f64b6387df3db3d1f9d9781721e6bf0d08c1cb33e61b525b1', '[\"*\"]', '2024-12-02 20:41:10', NULL, '2024-12-02 20:41:05', '2024-12-02 20:41:10'),
(73, 'App\\Models\\User', 2, 'YourAppName', 'f633e9bc005346e31831d4b2b7079fd77099d27143e8a1102ee2bee058ced238', '[\"*\"]', '2024-12-02 21:01:12', NULL, '2024-12-02 20:44:12', '2024-12-02 21:01:12'),
(74, 'App\\Models\\User', 5, 'YourAppName', '443c9b2071c3117ca411deff2f33f38fdac5f14dca456573c8e03970c44b4939', '[\"*\"]', NULL, NULL, '2024-12-02 21:02:25', '2024-12-02 21:02:25'),
(75, 'App\\Models\\User', 1, 'YourAppName', '218f523e2626d40dbf276547848b692a4592346d5591ff891221a80fca34aa6a', '[\"*\"]', '2024-12-02 21:03:45', NULL, '2024-12-02 21:03:24', '2024-12-02 21:03:45'),
(76, 'App\\Models\\User', 2, 'YourAppName', '83795e891a4b6ee7abd200b5bb50f01b26a6590a4bee05cb7481e141c8306da4', '[\"*\"]', '2024-12-05 02:24:13', NULL, '2024-12-02 21:03:57', '2024-12-05 02:24:13'),
(77, 'App\\Models\\User', 1, 'YourAppName', '3ce041f6f6accc0d5f6d84b5a3de29c8db835ca0001eec74a8c24024e0b66b8a', '[\"*\"]', '2024-12-09 01:37:58', NULL, '2024-12-05 02:24:50', '2024-12-09 01:37:58'),
(78, 'App\\Models\\User', 1, 'YourAppName', '7abaea05579fb77dd3af3028164b6103af7593d59cb68060bd92e2202842d2ce', '[\"*\"]', '2024-12-09 01:53:50', NULL, '2024-12-09 01:38:30', '2024-12-09 01:53:50'),
(79, 'App\\Models\\User', 1, 'YourAppName', '043b6396a2cf0f45e3071f7e0c6d0ae77471cfdefe82e794e00e8eac8e1eb16e', '[\"*\"]', '2024-12-09 08:06:07', NULL, '2024-12-09 03:01:59', '2024-12-09 08:06:07'),
(80, 'App\\Models\\User', 2, 'YourAppName', 'dcbdd106c133ce1ee9eae5029ca65487dedb229a5d7eb686aa403c250adb3fd8', '[\"*\"]', '2024-12-09 08:06:52', NULL, '2024-12-09 08:06:37', '2024-12-09 08:06:52'),
(81, 'App\\Models\\User', 2, 'YourAppName', 'd27b52ffe83f02fc71a71138b832822d853155a4461355ea7c042feeac2c8f5c', '[\"*\"]', '2024-12-09 18:43:43', NULL, '2024-12-09 18:40:28', '2024-12-09 18:43:43'),
(82, 'App\\Models\\User', 1, 'YourAppName', 'cfbe700dd2d07f745a518927198a56f9d130c19382fa28d448adad92578c26ed', '[\"*\"]', '2024-12-09 18:43:57', NULL, '2024-12-09 18:43:55', '2024-12-09 18:43:57'),
(83, 'App\\Models\\User', 2, 'YourAppName', '84e2a8ec27d95026500b868731aaa4f608ff6c05fcf110b099234c069f851dfe', '[\"*\"]', '2024-12-09 18:57:53', NULL, '2024-12-09 18:46:41', '2024-12-09 18:57:53'),
(84, 'App\\Models\\User', 1, 'YourAppName', '1c3c7cb4f4b0401483bf7cba0a235f23e98b091c4535fd5befb2f4ed79005df0', '[\"*\"]', '2024-12-09 18:59:29', NULL, '2024-12-09 18:59:08', '2024-12-09 18:59:29'),
(85, 'App\\Models\\User', 1, 'YourAppName', 'f964eae989199f566fab4931b96cf22ab13ec399209474da08b7e47abdf0bafa', '[\"*\"]', '2024-12-10 18:54:19', NULL, '2024-12-09 18:59:57', '2024-12-10 18:54:19'),
(86, 'App\\Models\\User', 1, 'YourAppName', '2d53e1d02fc2b1bddbdd1bb343092169046ecd8861091d2371fef8e4fb5f7a68', '[\"*\"]', '2024-12-10 18:56:44', NULL, '2024-12-10 18:56:41', '2024-12-10 18:56:44'),
(87, 'App\\Models\\User', 6, 'YourAppName', '52030d9d0e35b8223c45db1f850ee75a732aacd7cabf0d80e49d9e49bbe18f08', '[\"*\"]', NULL, NULL, '2024-12-10 19:01:51', '2024-12-10 19:01:51'),
(88, 'App\\Models\\User', 6, 'YourAppName', '9a41a503919a2f26467ff268748132ebb8a764f34035b38887159b1753df0cae', '[\"*\"]', NULL, NULL, '2024-12-10 19:01:52', '2024-12-10 19:01:52'),
(89, 'App\\Models\\User', 6, 'YourAppName', '61a0fb0c1f6b295694630a574175f4938219471b2452c8993926604c5bd1132a', '[\"*\"]', '2024-12-10 19:03:18', NULL, '2024-12-10 19:01:53', '2024-12-10 19:03:18'),
(90, 'App\\Models\\User', 1, 'YourAppName', '2866dbe21b2adfa26c1e66e98c0093db80a55b1ef7d280a27e6170bd9138a89e', '[\"*\"]', '2025-03-09 19:45:17', NULL, '2024-12-10 19:07:23', '2025-03-09 19:45:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(6, 1, 'Iphone 15 pro max', 'Điện thoại iPhone 15 Pro Max - Chính hãng VN/A Giá Rẻ', 19000000.00, 10, 'http://127.0.0.1:8000/storage/products/Sydoqm0w3nAndLM2rwcZejF556Kr6bQhgxABD67z.jpg', '2024-11-24 07:46:27', '2024-12-01 09:48:45'),
(7, 1, 'Iphone 16 pro max', 'Điện thoại iPhone 16 Pro Max - Chính hãng VN/A Giá Rẻ', 30000000.00, 2, 'http://127.0.0.1:8000/storage/products/8Snme14iXGrowvkg8QNWzyeOcJsKshEwER5Yhqcz.jpg', '2024-11-24 07:59:23', '2024-12-01 09:48:31'),
(8, 2, 'Samsung Galaxy Z Fold6', 'Samsung Galaxy Z Fold 6 512GB cũ chính hãng giá tốt', 25000000.00, 2, 'http://127.0.0.1:8000/storage/products/2HAEpJfUi2hbgbo7gs1Qw1lKfp0m3JgvBUfJ3Y7a.jpg', '2024-11-24 08:08:46', '2024-12-01 09:48:02'),
(9, 3, 'OPPO Reno12 5G', 'OPPO Reno12 5G (12GB+256GB) giá rẻ', 9990000.00, 10, 'http://127.0.0.1:8000/storage/products/njR1By4xa9OP5XufoEvqJG4GOpJGAmtV2s203OPy.jpg', '2024-12-01 09:40:49', '2024-12-01 09:47:32'),
(11, 3, 'OPPO A3', 'OPPO A3x 64GB Phân phối chính hãng, Giá siêu rẻ', 3500000.00, 5, 'http://127.0.0.1:8000/storage/products/7B4r7jYRyeoAgld4jo292VP6eSUcnIjnez0MDRel.jpg', '2024-12-01 09:43:35', '2024-12-01 09:46:52'),
(12, 5, 'Xiaomi 14T 5G', 'Xiaomi 14T 5G 12GB/256GB chính hãng, giá tốt', 11990000.00, 20, 'http://127.0.0.1:8000/storage/products/moWm9eO35pKw3HneF0MuU99J7saTjXtLGdw9ULOv.jpg', '2024-12-01 09:45:11', '2024-12-01 09:45:11'),
(13, 5, 'Xiaomi Redmi Note 13', 'điện thoại Xiaomi Redmi Note 13 8GB/128GB mới nhất, chính hãng, giá rẻ', 4390000.00, 10, 'http://127.0.0.1:8000/storage/products/ZNn1j8mWHEhkLvXclsqCmkmQNJvq0NXVm9YrcQeU.jpg', '2024-12-01 09:46:26', '2024-12-01 09:46:26'),
(14, 2, 'Điện thoại Samsung Galaxy A55 5G', 'Điện thoại Samsung Galaxy A55 5G  chính hãng', 7250000.00, 15, 'http://127.0.0.1:8000/storage/products/999H1FVRa726Lepdlm3Ba3y06pNyhHXxtJ2f3kpi.jpg', '2024-12-01 09:52:57', '2024-12-01 09:52:57'),
(15, 1, 'Iphone 14 pro max', 'iPhone 14 Pro Max 1TB giá tốt, mua trả chậm 0% lãi suất, chính hãng, ưu đãi hấp dẫn', 20199000.00, 5, 'http://127.0.0.1:8000/storage/products/eVXH0ln7btxq8aZScRmP7zIvjDRmOCKuXGH4NZcX.jpg', '2024-12-01 09:55:00', '2024-12-01 09:55:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0Da1eTyXXlPnBEA0lMC7eELKqqfkslJuTzwsywH3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjNRYklKUmp2S0RWZVl0Z0twSEtKOENVUXdXb0ZPQ0hRNXRxRWVvUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883053),
('0wuXEsS7a6rNB2BPsJXAIQJIbLnJLdKupxMa5wae', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoib0J3Q0dqQXpHQ1ZrMmNSMXcyR2x6OUd6a2o4dnk2WWZoQ2tVdlZMWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882201),
('1Biw4bp1en2RdLcIUDQ9F36lM2fbB6PkYOmh2dWF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWhScWRtMWdnZGt2NWQyNzJxcllHRFpRVkhNTDRZeWJMa3lyd25SeiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733883057),
('1P7oQMSJYXpJNHElH2XlFdj8mA6cflVtlvV32qd4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNGlIN0R3allja1A1M1NndWE3NzVaZnp1Rm1aVnpGS3VFTDlncElUdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883020),
('2aMSdrIgSO7KtesCknHbxn60mnS9FzfjnFNA8SNA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN29xa0lYU3p5QnM2UTc0T2Nmb2ZybzcxTlJMNEMwcll0OVVkZExVeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzIvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882867),
('2csrSD5CqtcdQueG1DEuJXpVOwL2Rsu9hPqAFgbx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1dwWlZRTUk5cGhpUmFsNDBuNFRuNnBmRFlDTGNnNlRQVno1NHB4bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882539),
('2WlOvmNFoChJ3ALjSG2qrzTI6odCfglZ0E03CM37', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid1c4cG9aOEhreDVXbnJLMzFYRFllVjYwN3pVREJhZjBOa3ZMRzdWUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzEvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882523),
('33ISqC95FqPnb9RfdzKNLES4zX3WfvToXgu24nmQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHNKSjNNck80Q3hvWkpCMlZGeXhvSnJmdjU5eDF3djNiRENJR0lFUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy83Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882877),
('4CwS8QH9i7H7Eso2E8wWlzJnm67nNNXDXg3mjZrz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVU1id1VKMGladjdyWTh3bk9EUzdnSzNWa0sxalluT3gyd0pNRmtTYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882871),
('5agaGR9GgTtLFGIegTN0UfWLnw4QaWZ000zskynH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUlHS3RTRWhBYmxHVkhFdkhMdVFjc1BBSjZqN2pZaUpTNW1BckZ0VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883023),
('5HoAk6jCI3t4tZ84o1lHeNJyccTC1BVS1fhTms0C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieTdicHNHck1OVDFuaEFuTEoyMHM0SDdRYzNZbjJrbXljQ3dseHIxRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882900),
('5oDsQhE4vOh7Nn6HS8hOGSQioyGeTDmSZcOSAUkN', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFFaOFRUM3RHZzFZSGQxWkw4VWdRVWk3MzFKRnJSUWNMZW5maEpyTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733883027),
('6cIWZvTw8sIxE7k5p9Y5CcmXBx4YsOY7cKt2LAOf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDNFanh2OG9FTmxNUnhCQnJ2MkdXUEI2UFJnNTZRY252cDFaWEJKUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733883023),
('7IOBmSYRL5ZhPztqrpLLnA2PGffH5mPzlSzZz0cb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicmx0bVJzWXZsOVVlNUtCMWl4UnFCNUJjVVZNVkwzRXBhRXhCYVZMOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741574719),
('7vQKgbDaWB5Ki9i6sVfTKpRZzj4ZjBLoynDojqoG', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiakxVOVg2ZmQybmVCbXo4bVYwNW5FNTU5RE5kU3VlWXo2N25IUzZyMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882552),
('84d48RF14NbJMkhJgyIq0GRgUxvBoMVQ6zYfHUBY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMzJGTzMyck9HcnVYdWtreGdOcDFJTGZCTGswZnh0MmM2TlV1OVlISCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882377),
('8FQlnt8zs7wCXk1GMP36zBlGC8PccY2rlY654TVz', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmFmV1g1bnMzYlpaMVNPakh2OFBubXB3MnV2UDZlRnRPM3pvanE4MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741574719),
('aUCRk0PHlwNYJd1g1sFWxR41IbRxU2XcfphwpJhx', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ1FDVGN2WXBMd1BtaXVzRkpPdExRRjJCUmVrTW1mbENNT1Y0R1I4UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtc3VtbWFyeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733883012),
('aVT7uMVQDC1RW8Yaz6coBieCqsW9Gaowm0xWPxh4', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWWlSMlhoaXhXTUhiZ0VCZTZXSVI0VkZTS1I1YW02OU5qcTdBSURIYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882597),
('Bl16OD9t6KGgt6kE9cWugDReULWWh9U2lva1U2Eo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE14d2h6TG53SE9ocjVHMThnOGxna3VpNHp3ZmhvSVZwNVk3TFV5eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy83L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882539),
('bTAyVhxauu4VqwPxdriyeUpqL1FGcNLnszcYCmYE', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaFgzNVZYV3JiWTJLWVI5QUhDYnVrTzFTa0x2WHZUTERzdUJpTE43QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882892),
('bTGw80J2WRZDIxDfKNyaWltmZ6Rq4mLZh62vjzSI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajRKa3VFcFphTXJPdWNDcTFCbG9aUzFnQTV1MER4SUZqVVZGZ1JMbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882903),
('BXhyWE7q1Pw3BK3xZvyzrLJ4qOWraIfXSoklnglh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzFpM1hvTzlJOW14R1VVVEJSWEQ2Mmh3cG0xYkcybEpYZHVoWTFyYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzUvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882528),
('cAvaAAUacKaRzs1r7JCR9biR09W2saEpT7sTD56V', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiazZ4WDB2Z3RIM1o1QVR3OWRlRXpEdUxkS1hMTUxxeGo1cU84M094cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882532),
('cwmuH1PSXD0TyceVD89amXwPnsliCiycL23Ikqce', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMnlNNkdrN3dtUUJSbGpVbEdHNDcwRlRLRjdYWjZIWXYwRzRxV29NQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882929),
('di64A4FZFw3dwSv6oCX9xmSsRyQOUolaQZfVmZu3', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiUXJVY1BpTnI1MmFkamFvTFF0RWdEOThVVDRvZlNLRnFnaThvVWI3cyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882560),
('dPB87PsnmiAtfDRQrR0Tkb5sugcFZG7ymkMBiypR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUNRSTBpc3poRk54UkFhR2NNeGk4NlFGN2dWVVVXa2V6OWhaVjcyRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzUvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882869),
('dr12ZqxbP4drCSygYXNMlMStX5n82oC1jrCdIF7L', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVUFyYkFuTDc0TUVxOTRaOHdRdkE2b2FhV1BxM3dpWUpwOHl0dnJrSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883073),
('DshbDVdJRDPtTsjbXfqioN2eN2Gz6sw5APJulyQw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiaFFiSUtSMmJyV01vVDd4T1lMdHhRTW1jMmJwWGJwTzJmcEhZR3JQSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882436),
('e9GpEJHIK9T10JIS2Qv6qVjDTyhYwVHEULwoNCsS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0RvUmZ3UDIxaEFxTXhkZ1dCbzZlemxBN3hsNXZtTGZQZUFLMVZ4ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882557),
('EkpKDXOjMyRfs2sGz0vHB0274snqb1aKhLFydWFP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlVOczNQTHprZFk0TVlWWmYwWVl1TFl4NGxRaERJWWdDdjg1bGV2WiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882873),
('f6jeAgW7mx06fLcrpAmjbwklelW6u9kJ5CbLTxws', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREFaWFFTRGVqVGx2NnpDU0hDV2FmWUZsT1ZDcFlsMVlIYmVUY2s2UiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882549),
('fD4YMyNE5i7E6fflSqDJCtGBCI3m8vuu057H08TV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidWwyMEJiR3dWcnN1ZDVNaDUzNVY0cGtMSHpZQlBGRzlRaGl5Wm0wZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882773),
('ffdBtF8qwROWPAE3ufeIUj1izHAzH1cNrA0n6So4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic0JnbWlpdWxrMjE0TktyQU1HbDQ2T0hXZ3dqQVFYak9zR3o1MzRsSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883073),
('Fyot08zIrNik0FnLyxtFgPuVjzXpxgEbQBZ16VDm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidXZId1Zjc285bUdaWTJybjZLRXJ2elJLUU1URXVFbzdsSDhJbGVrYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy84Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882898),
('gJlh9vWcyboPvF1iqm3UlZbkQmTkczheYv6Y9zOQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWEZrblZDOEhORXlsVnc1T0dDSktWSGJFOTNROHFDODJqUWxSM3dNMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883069),
('hLX2q1MXbfrz6JpVIILaZoBTu7myNFAiGg7HR4uW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmV5UDlIN1ZnWmk1VkhFS2FuQ1lTTmZXNUFTaDlMNGZLcGJzUWx1UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882559),
('hlxQqcf2spOWnTup0huj1iF7D77Ztnf9fBLoWIiu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV29LY2ZHRlpYMXVoQ1VMYWNUb1ZoWjRDa1V0V0lxcW45S2dQVmhydCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733883053),
('hql1tPmv3nDISJjUntka0Cr5O2qscbGn4zwf6wjy', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibnZLekRBMHU5TG8wVDRyRlN0TDdlTnY4T1FJa2hkNFNTNjNncFFnOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882567),
('hxAdpgLUJqikSJTCH9pQJDOpeHh6BjGE1olr1KeN', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2cyRkNYQk9IRGNsUDVzcGdNZXRldzlSSk9SdUUzUEJGdkFoMmt4MCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733881982),
('iEWA0ez9TjpDQEk8EdcNWs8mkvizZKM5ls67ajgp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkx1bVF1b0pMVGlLYTFGenB1bDd1cWtkRTRFR2pjZHdodmxHTzlveCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882864),
('Ji991eGsHIy2rLUlLbWnsatg5tvfvgSl4Nka0D13', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiS05aMENQMGdRcXJkR1NvblB1SnFRZ1FnZ0xodTk5OXdPWWRaQWlZeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882923),
('Josd2b4D0e2in9nRnPPB8CNq18YREEY7p1kjhFEv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieHFyVTBYbm1qUlNmUkhFZGNRSDBhYm9wYjdyODZ1emJ1RmxsRmk4MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741574717),
('jqIEEaBq9CA8vIQmImKtDZOjOmS8TrR1oThYnmhs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREZIZXdtS1F4SkFlRmJrUUhoVVM4aVVFN01UQXRhTlpxZncyb3ZmaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882516),
('JSu5ofKM6yG5KAFolZ95eS2F0WZtpYBOUiHP75PL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQWlOb2xrdko0NE15NTlWMkx2UU1jOVpTN1dLQ0dQY3p2N3d3RG1oSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy84L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882898),
('JUOsgrGLuV1RhfzqW3HEwowHYxtxObNy7ZlqWFAd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidmZ4VFZsTWpUN0pheHVkWENrY3FkdUZkbjYyWTNwWjVURGtxTVZHMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy84Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882899),
('LbFJlUqchTFl0O0HbMTzZa0XO1xjPF7nZQdjADKH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiRUYwVER5TWdSeVdwTnUwamMzV3I0dTVKR0pmNzJZaFRpc3VhOVF0SCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733883035),
('lEEzxAHbKpRSHZuyWnENngMikwh56T9fN3tgNieA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWlY3anhrTFZTY3hBRFZBNUlUREtTU3FTZ2ROUXp0c05rOUo3bE5ySSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882806),
('lQBOe3Tx8YPa67iLomnIfNttsdQWDRjDXMal7iEF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiSjJNMkpra3M1dTA4NENQT0RvRnpZZFNLQ0pIbzBSTWJweGhuZ3p3NyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882511),
('lXQ3PaO0wSQyUns4EouLo8s1HdO5lrAasg20abvR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib0xCODN5NXBQbEdrUDFuWnR3NGN1dlFDeUVPNUVXVDFtSEI5SklYSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733881981),
('m8WcijUpFq2NjOrC5zUdQaciO2y3OqhhVNO1yCfQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3ZHblpUQkV1VjlKQWxWTFdlbDVyR2hiRjJxYTcyMzFzREI0MmhsUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882912),
('mk2N7LQxIuQQXmbu0U7lPNSB1V8cm9DqO7sHvKfb', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUEZhVzVGalRUQkRxTVNUQllIODRhMlk0RWF0aE5NSFFXbWhUYnZHYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882582),
('MQ8tWTv1DePM05iuan5f1hq9q9H5SS38kMY8vTWK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWMxYlVKQzVZd0g1UTJCUlJZY0JjZ3BWWnRqdDVyYUVxZTdwTXZhWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882982),
('MscDmPCBWLLLN64FLB8INvjdYIYKKfl59bZsn5tF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic09yUnpoTTFoTjJpWWNabkZ4TU9yZGh3bjN1U09SVEhHZ2oyZFVwQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882873),
('NNHPpGpBa7nG3J6EB35Dm56jDVTtjCFA6aLEpvRO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXF6M05mb09FZk91VE94amtPeVk3a3JZVGw3T09qSzkzU2hlcjc5OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzEvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882858),
('nWtD26QYIzE1LqTecLiXnpG5re7auy29SNHp9RIS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZWlKdkh0cWllTjdzeWxLb1RzeEZGZlV4cElNekI4eGZEeXhEM0FneSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtc3VtbWFyeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882845),
('nypkiypHTAXoqR2X7HTukgHw6PQ0dGOikDUpGDnT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEZ4N0FhVkNkMEhGYm1uclcwZVFPazdJV1hyNlFFOGhRNWh3SzI5RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzMvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882527),
('or1NEXzXwVhpUa2BWR2Iv9g5IXMwU0zK83sV78EW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR3c5WlJyZG9QNUQ2TGxpNkoyanRIOEJWbjRCSW9yV2FtcmJZTGE4MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733883069),
('OVaCUbrETdy2QrgkMJDuLG8UPBndrX4atlkbRQUM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1NFaElsSDVQR3ozc1gySk1vYk9xM1V3cDVtcGJMNWU3RWE5UDFGYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733883073),
('oXecz6GiMqCNk80g5Kz6aBuQbQput7O47XtwKgAA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ25ZNjVacG1NMDVHOURuTkZGOUZGelNET2JTUGhMS0tQVmVETHJnYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882556),
('P8pNAIlMR6Rcx8uqRpKGNIamymsStT01uDFp1czT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUZtY290TUJ4QkJQZlczUDc5VWE0WXM1V3cyQU1Uc0Z0ak5rNGNncCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882558),
('PagP19szcvw0yh8zgkvCRH74LAh10Ll1UtPP7CyO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHY1WnVmZmlwR2Q1SVZUTEhvU3docUs3OEV2QTN0NVFybE9LTFhTbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882515),
('pJxc9o0Osb44HlulL5nJ9APLtSuNK88admOZXss0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1V4UFB0eHA5WUpLbE5ZaGRZbUJTWHJiRnFXa1EwVndtMnhZSWpvbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882059),
('poGQKVqcp3Gs6iK4dN5tq5mGhWl7xQFDV3oQfIvp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFoyRXBKMWtWM3hrenhxNDF3a3ZHUXl6ZVhrRXZoVmpURVpCd0hCRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882852),
('Qd0XbBzqcxYEvUtCMl59zY8gaMrqK6bD18NjUMsO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVpuRjE0ZXJXSmx6M2F6ZW1FNzREMEFpdkI0bGNBR3dHRW5SZDY2dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy83L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882877),
('QdwS51DhCkernEk0o2zByaxH08L0OhYGCpylJ9RY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXN4YnF2bFhub0pPU0hFN1JIWHpKT2pwYjM0SDZERmNsVWMyOFE2aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882559),
('qItdpvT4YFIJosoq3G8e2FHJ460Gw2G0e2xgLqEJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZTd4ckp3YkRxZ0ptNFY0TjMwOXBxaGNMd3AyZWZvYnZnUDJzU0U3bCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882896),
('qOaoLlzcxdaZYhhiZhO6Sg6gxaKvmTdQDjclVzUp', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnNKNHVLODcybGZPV1k5eFdrYzBqMkZSNmJjSVRMYldGRGpFbTYxRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzIvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882525),
('QUq7OU68khCFWXJEsabF2pBilLfNMMcPg4xzfvXx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWJ4YzFYRWFTWTNjcG1iY1dITWdNZWdmSlhPYjhORWhNVmhaclpjTSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882534),
('QVgbD4e02kA3Wns5ogaXEZHefnbwFa4QqpaG6DvW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicHg4MWt1N3dnekIzZWl4d093R29zNUNxaGE3VFRZcFduRnVYSkdTViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882513),
('QZibx7za3TA8oGpEuHuwRTpdFYkMDPgzJFkkn7Vm', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2FrdXVpWU12U2FObEZaWklab1dtRGV1cnpKZzltVHNyVERIakJXcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882862),
('R71eTfR4jYI6osa09yBDvBbHvdgWqwcRDDDVV5P2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieEY0ajNlTXFRVE5XUGhGTlZwWHp1dE5PRUdrNXRJdDdkV05CUXVxVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882762),
('Rdtx6sFkXBVGCUU5ICtMwK219PZutOLQCKvpmqZe', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnd2RjlqUk1hWTN6WXhiRTFub3ZFc1V2cUtWWnU4YkJ6VktiakRWcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82L3JlbGF0ZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882533),
('rJoK6oSFKk7Uq9MMIQ8RQrV9PDwfnh3za31KJJ0N', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiemd1aVFNTjZld0RETG50NEpEUTNZZ1RVUmpGbU5MSVE3cGdJUlF6dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882873),
('rZ2o3dRuCaW8hT6m3Mm43uQv999WHeyC5448Gcsd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicW1aVFQxak91cjIxNG5wMEt0NnU5THFnTGFEYmN0aUQ5U3VzeFBFYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882880),
('s55cCDOPRbQZkcKmf8Md24MUPTc9BGGmqj1D2hnw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoieGNsTWpMdWJnc2hzWW9yMWRqOTE5S05HZTZzczJORmpxUG4zZTdPciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882923),
('s8CnVHB9rl7gofDWZ9RKWvozUWZT7oJrv7ZMsyG9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVhyRVVKWFJ3ejRZa1Y0OEJaQmZ6UkcyWlF6NXRhcGlZSlpxdjZ1MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtc3VtbWFyeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882205),
('SwgufJ7kadmDUwsuFYh9ugMBCV6w3mMZDwGBV76X', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid25iQVhhUDg1YWdsZEhjcHAxRnB1YlJlNDRKUEdOWmwxSHA0WXJYMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882047),
('TcF8A2vy2z0kZXOHeEnVTLQulYm5yHrM4Rtn2NkB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUNFdlhHMlUyWG81TXFUTFFrRXZsUnpUQ1ZIcFhrR2tHelkyazFuUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1741574710),
('TD3TmyZoGChSh7AS80mwqalkzR0RqwC8kcjTxGb7', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoia2JMaVNOVWRoekhwYVNjYkY1bG1tNURTOHdLeXNJbjZ1VFU2VkJ3ZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882843),
('tQ1XiXz0FCcJzPImAVA7alH85dTX0Ww8fvUUJLsj', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMU41TXRCOXBmMGlRZnVSQmFsVmpuNTZFWm9FOFcyd1AxZHJiWHhiVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzMvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882868),
('twL5UD9aQUYoaYDKWEK4VorVWc9n2y7rek55BWCk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzlacUtnTjgwZzk3bUxqT0UzMTZDbWZQSFZGT1lxbTBUVlN0ZGozViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882897),
('tzPYMvgxGlke0WdHRWpwCHl5DXtzS4OAkI84hHcZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNVd1UjR4N0JEaFJIREtXVTNWT3VJTG51V2JlbXN1a3pKSDJ4c0JhVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882475),
('U2ZJ895eGJ0vMdnAabdOGqXgwRn4ertj7nbyPwnb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibzVxNnFCaHF1MmhiMkNBazhZQ2lpcDZQaEJTcEFoWkpXY0x0bU9EZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733883018),
('U7glrhP23yvsnJ6pWPST5u9jaiCAL3aHTFagfs40', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXZXNGdvNzBXRDljQWZQUEduZXVpaWxFWUNEOHNTcm1kekVXS0hHNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlcnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882048),
('uaxsdF5hJin9eWUl97Wsr5R8xEyM7NJe5ijSfaAs', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoick1BUjZlZlJzVzRrS0J1dWNZVnhzT1MxVXhBeDdwUzViMThFVWlXeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882570),
('UG8t0cC0YMg4Q5C353kEkFzvIy1qQ0iDuLXlpI2G', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicmZJWWZ5QWNiaDZyWTNPQTh6OFVaWEp4aERNTWZVSVVSc2FjWnA4ZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882512),
('uXyUme28ANGxiPSRnE2DgfvhDftTMgrTNoLmLQS2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnFsd0M4RmhJcE1RTlZIU1RSaXdhbkh4eWdkS2VuYm1XbWE1WGNycSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882864),
('v0hAXAWNtBPXFWShdNKgRg1huTdtyGmalMK6L6nw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidWprVUpMTVByTWM1bVJXekFsd3UzQndEWWVpNHp3cnZqRnNuNkIzViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882831),
('V2Qjy4xrk6GxvjH3avrPf4t4QgfQWaQqAyiumZMn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSlJzM0Q3Z1lUQndtTGxOVUJsbk1hdE14VGNxWjFuRGxKVXdXdWUwUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882885),
('VmcMXQ5WLyQSS9xShxPXLsOGvU6iq2xpBZnpgcbS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoielNONzRnUWFzSDdDc0hDZlBmZlpqUGZJaFczOERSenA4eVE3MWhpUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzLzEvcHJvZHVjdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733882865),
('Whig9Cx2YfsODT7cPyG9rvYrD5QDqrUGbufjpGdM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTdxcXQ2ZmdoTHN0dUo2NU93TGFrWm1NU0k3VEc1SjUxYWJ0cFdJVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882852),
('WkkNpPt73FIo8uU3ZMEoevCtaDtBusMOV6vLqblL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0VNdDBiREpMeVc1cTFqMXZkSUZjcFFtV0Q2M2FZTHQyaWQwdzZzMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy82Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882534),
('xBo4i99B8W9ja0CieNXPgjMP7ww7GbCJCYSBU5Ol', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMkp4YU5laTJGSENuYUhmRjFRNFBsdUZzMnRTT0R0UXNSYmdhS2dKWiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882337),
('XmxBoFcKFpMwaHpwKSL2OZasm4YkNLoGSWVjP6uF', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZXFlYUVmWTQyZXRRc2lvN21EZnREYWRUR2FUTFdyazVvVDhIZWhUMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882599),
('XofdfZnZYaZ5geSM4af1TdDvjkzNvoU2oPNmaVsb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibUk4NGJmNHFHaGxzUXU5VHBTUFlaT0s2ellXazdSYjdIZjQwbVAxTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882993),
('Xua1bL9CkUiUacQQZUChJzY1djTZwUxJKyFcjon0', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNXpjZ1NNUEFTeWZMeExKN0RNYVlDT3Z2djQ3Y3RtQk5xWEs2ZFN4NCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882544),
('y0DuDmjwJXiAxMGWTSWAxqmxERm90VU2RMUgscUA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiVlFUaTQ4eWN2YkpNNTFWWHVqTURjWmRWeHNUTVM0b2JqdnR4N1pjViI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882324),
('YpgRxfdtTZVpjAFfoOVox38YpSoP0973oVdBXbfF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXgzdnlMQlBtT3g5SWp0eGtGamdsR0x0eVkzVkZEU3M4YUNOS1dTYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733882532),
('z1jMpDGXekMPKOV0fRpP0ZJs6JQvyjyAaTE822YQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGlOWkhESHJGVFZtMTFTS1VTTFBpQjYwZExHNVdrUjV6aDJzR0lpRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1741574712),
('znP4NKcYkJayNRVEUU9mLMGMOFDBl9Neg6g8yV4s', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2hFdVN2MjdlZ0RBOWN2T3FsSXoyTDFJMGtBN0lOc2dRVnBlZ2U5WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQtc3VtbWFyeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733883044),
('zY4YSrTMGQ6X6Xls3jBDgjA87Ek5sGBrooY1gz8R', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVpSTlYyOXlaN2t0NTFUNTB2MXV4eW5uaXBPM1g1ZTAxSDhqZ2IwcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733882872);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_token_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `reset_token`, `reset_token_expires_at`) VALUES
(1, 'Trần Phát', 'phatdeptraiokmen@gmail.com', NULL, '$2y$12$UCkgJotlhMUgkhcXXOq1Hu60XonDK7yfWV44DkBCdI/X2Sue6tlPu', 'admin', NULL, '2024-11-24 00:22:45', '2024-12-10 19:07:11', 'hPBhhMCn4zNVbv7lW7uX5w2GLNlgoT4y94g1vErbFr7UvQOFwIXF5CjgNSnw', '2024-12-10 19:36:36'),
(2, 'Nguyễn Tiến Đạt', 'datntpk03697@gmail.com', NULL, '$2y$12$VZJBv90vKu.ot7MmHI.5wuWM6nPlniMJIpN95IufhOlUEu90hGRSy', 'user', NULL, '2024-11-24 00:23:08', '2024-11-25 19:35:06', 'QjBqcUYYW07tGLomwdd8X5vGDnOrrj7TZc42FcXpzRl96xon4nSX26uPwCsR', '2024-11-25 20:05:06'),
(3, 'cường', 'cuongnmpk03765@gmail.com', NULL, '$2y$12$jhhMp4DDJV9uWu.YqK2mVu7xKUnoHElHRvPhsqKVKr4I66QyTy336', 'user', NULL, '2024-11-25 19:21:06', '2024-11-25 19:28:28', 'BDsusT814WOS5QXnIoswYrWxvzcrDGqIshRP3nqSneb80DhFIA8068x5eRFv', '2024-11-25 19:58:28'),
(4, 'hoài', 'hoai123@gmail.com', NULL, '$2y$12$Oe5st68eC62S6aRyVeh5.egBzNrt5Ng8VSamealvFh/FPDdrZXrlm', 'user', NULL, '2024-11-25 20:27:00', '2024-11-25 20:27:00', NULL, NULL),
(5, 'finalphat', 'phat123@gmail.com', NULL, '$2y$12$TsaDPFL8Ku17qOQ.V1pZr.qm.8c4791LeitrhmlBz9lIC6tDKwJsK', 'user', NULL, '2024-12-02 21:01:53', '2024-12-02 21:01:53', NULL, NULL),
(6, 'phatdeptrai', 'phatttpk03754@gmail.com', NULL, '$2y$12$.Td8ZUTTtZjXtWIm3iJQf.1XOHWH/17okApq5WeZdQANCt1tzoXvK', 'user', NULL, '2024-12-10 18:58:57', '2024-12-10 19:01:12', 'UuQu3s8WXktSHmGI97NVfb9ZgyVGD6T4GVTb8mnMtvkUOtjdOn481a02VgcZ', '2024-12-10 19:30:31'),
(7, 'PHATNE', 'phatdeptraineokmen@gmail.com', NULL, '$2y$12$il4de4eWdUeNskeHoEi4QOc.IVfs2EAbll8soydDcDg9/W6/ZxGji', 'user', NULL, '2024-12-10 19:06:13', '2024-12-10 19:06:13', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
