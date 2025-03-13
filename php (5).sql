-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 13, 2025 lúc 04:59 AM
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
-- Cơ sở dữ liệu: `php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_session` varchar(255) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'Áo thun', NULL, NULL),
(11, 'áo sơ mi', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Đen', NULL, NULL),
(3, 'Trắng', NULL, NULL),
(4, 'Xanh', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `codeCoupon` varchar(50) NOT NULL,
  `nameCoupon` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `quantityCoupon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `codeCoupon`, `nameCoupon`, `discount`, `startDate`, `endDate`, `quantityCoupon`) VALUES
(1, 'GIAMSAU', 'giam sau', 50, '2025-02-26 09:28:00', '2025-03-01 09:28:00', 48),
(2, 'GIAM20', 'Giam 20', 20, '2025-02-18 08:33:00', '2025-02-28 08:33:00', 44);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favourite_items`
--

CREATE TABLE `favourite_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `createDate` datetime DEFAULT current_timestamp(),
  `price` decimal(10,0) NOT NULL,
  `coupon` text DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `note` text DEFAULT NULL,
  `status` enum('pending','processing','paid','shipping','completed','cancelled') NOT NULL DEFAULT 'pending',
  `total` decimal(10,0) NOT NULL,
  `paymentMethod` enum('cod','vnpay','momo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `code`, `createDate`, `price`, `coupon`, `userId`, `name`, `phone`, `address`, `note`, `status`, `total`, `paymentMethod`) VALUES
(21, 'ORD_67b402da33b72', '2025-02-18 10:47:38', 0, 'GIAM20', 5, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'completed', 189200, 'cod'),
(22, 'ORD_67b403d0be10e', '2025-02-18 10:51:44', 0, 'GIAM20', 5, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'processing', 189200, 'cod'),
(23, 'ORD_67b4040c02f91', '2025-02-18 10:52:44', 0, 'GIAM20', 5, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'processing', 189200, 'cod'),
(24, 'ORD_67b7463b9b4f0', '2025-02-20 22:11:55', 0, NULL, 3, 'Trần Đạt', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'abc', 'paid', 1025000, 'cod'),
(25, 'ORD_67b94b0ea4a26', '2025-02-22 10:57:02', 0, 'GIAMSAU', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'aaaa', 'processing', 229000, 'cod'),
(55, 'ORD_67be2546b72ad', '2025-02-26 03:17:10', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'aaa', 'cancelled', 685000, 'vnpay'),
(58, 'ORD_67be27e7d6006', '2025-02-26 03:28:23', 0, 'GIAMSAU', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'sao v bay', 'completed', 280000, 'vnpay'),
(60, 'ORD_67be28c1b1bf0', '2025-02-26 03:32:01', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'cod', 'completed', 530000, 'cod'),
(61, 'ORD_67be2aae779c6', '2025-02-26 03:40:14', 0, 'GIAMSAU', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'hahahah', 'cancelled', 340000, 'vnpay'),
(62, 'ORD_67be35b42bebd', '2025-02-26 04:27:16', 0, 'GIAMSAU', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'ssss', 'cancelled', 461500, 'vnpay'),
(78, 'ORD_67bfb4b125e0c', '2025-02-27 07:41:21', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'pending', 340000, 'vnpay'),
(79, 'ORD_67bfba02267cd', '2025-02-27 08:04:02', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'pending', 340000, 'cod'),
(80, 'ORD_67bfbf16cd61f', '2025-02-27 08:25:42', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'pending', 230000, 'cod'),
(81, 'ORD_67bfc2862fb2c', '2025-02-27 08:40:22', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '', 'pending', 185000, 'cod'),
(84, 'ORD_67bfcde4c80c2', '2025-02-27 09:28:52', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'vnpay', 'pending', 185000, 'cod'),
(85, 'ORD_67bfcea1bacca', '2025-02-27 09:32:01', 0, 'GIAM20', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'CCC', 'pending', 154000, 'vnpay'),
(86, 'ORD_67bfcf7975314', '2025-02-27 09:35:37', 0, 'GIAM20', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'CCC', 'pending', 154000, 'vnpay'),
(87, 'ORD_67bfd6ef7cfe8', '2025-02-27 10:07:27', 0, 'GIAM20', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'hjh', 'pending', 154000, 'vnpay'),
(92, 'ORD_67bfdaa851414', '2025-02-27 10:23:20', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'demo', 'cancelled', 185000, 'vnpay'),
(93, 'ORD_67bfdb90031f4', '2025-02-27 10:27:12', 0, NULL, 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'demo', 'shipping', 185000, 'vnpay'),
(95, 'ORD_67bfdd031e487', '2025-02-27 10:33:23', 0, 'GIAMSAU', 8, 'đạt', '0456789452', '234, thôn 2, xã Tâm Thắng, H. Cư Jut, T. Đăk Nông', 'aaaa', 'completed', 185000, 'vnpay'),
(97, 'ORD_67c00bed2ec57', '2025-02-27 13:53:33', 0, 'GIAMSAU', 8, 'Trần Phát', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'hello', 'cancelled', 107500, 'vnpay'),
(99, 'ORD_67c2913689bf9', '2025-03-01 11:46:46', 0, NULL, 11, 'tuấn', '0942960548', '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', 'aaa', 'pending', 627000, 'cod');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `idProductVariants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `quantity`, `price`, `idOrder`, `idProductVariants`) VALUES
(20, 1, 199000, 21, 15),
(21, 1, 199000, 22, 15),
(22, 1, 199000, 23, 15),
(23, 5, 199000, 24, 15),
(24, 2, 199000, 25, 15),
(52, 2, 250000, 55, 15),
(53, 1, 155000, 55, 17),
(55, 2, 250000, 58, 15),
(56, 2, 250000, 60, 29),
(57, 4, 155000, 61, 18),
(58, 3, 155000, 62, 18),
(59, 2, 199000, 62, 29),
(74, 2, 155000, 78, 33),
(75, 2, 155000, 79, 33),
(76, 1, 200000, 80, 26),
(77, 1, 155000, 81, 34),
(80, 1, 155000, 84, 34),
(81, 1, 155000, 85, 33),
(82, 1, 155000, 86, 33),
(83, 1, 155000, 87, 33),
(86, 1, 155000, 92, 34),
(87, 1, 155000, 93, 34),
(89, 1, 155000, 95, 34),
(90, 1, 155000, 95, 33),
(91, 1, 155000, 97, 34),
(92, 3, 199000, 99, 15);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` decimal(10,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `price`) VALUES
(33, 11, 'Áo Sơ Mi Ngắn Tay Teelab Local Brand Unisex Studio Oxford Shirt SS052', 'Thông tin sản phẩm:\r\n- Chất liệu: Vải  Oxford\r\n- Form: Oversize\r\n- Màu sắc: Xanh/Hồng/Xám\r\n- Thiết kế: Kẻ Sọc\r\n', NULL, NULL, 199000),
(34, 6, 'Áo thun FIDE LABUBU phông unisex form rộng local brand nam nữ cổ tròn oversize', 'Áo thun FIDE LABUBU phông unisex form rộng local brand nam nữ cổ tròn oversize - AT79\r\n\r\nChất liệu:cotton 2 chiều\r\n\r\n️Bo cổ : 3 phân không bị giãn hay nhão sau khi giặt\r\n\r\n️Hình in : cam kết không bông trốc , không gây hại dạ ,\r\n\r\ndính màu , an toàn sức khoẻ cho người sử dụng ,\r\n\r\n️Thiết kế nhiều phong cách đa dạng khác nhau : streetwear , dễ thương, cá tính , mạnh mẽ, ngầu , năng đông, hiện thời , thiết mới luôn theo xu hướng trend\r\n\r\n️ Màu sắc có màu : ĐEN KEM TRẮNG HỒNG\r\n\r\n️ Áo có 5 SIZE : S M L XL XXL', NULL, NULL, 250000),
(39, 6, 'Áo Thun Teelab Local Brand Unisex Mệt Tshirt TS232', 'Thông tin sản phẩm:\r\n- Chất liệu: Cotton\r\n- Form: Oversize\r\n- Màu sắc: Đen\r\n- Thiết kế: In lụa', NULL, NULL, 155000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`, `updated_at`) VALUES
(11, 33, 'uploads/678f190d41b29_1-43f68bee-ffe3-4d5f-bcbe-725ff90cd875.webp', '2025-01-21 03:48:29', '2025-01-21 03:48:29'),
(12, 33, 'uploads/678f190d4205f_img-9387-1.webp', '2025-01-21 03:48:29', '2025-01-21 03:48:29'),
(14, 33, 'uploads/678f192181e6d_img-9387-1.webp', '2025-01-21 03:48:49', '2025-01-21 03:48:49'),
(17, 34, 'uploads/67a42b185aaff_z5594338172868_260691dc855189afeb0872fad05b1552_9eaa6959ef204713a4d500a0bac396c4_1024x1024.webp', '2025-02-06 03:23:04', '2025-02-06 03:23:04'),
(18, 34, 'uploads/67a42b185adb7_z5594338252963_7aecaf29c3ee3474e7d1dc05a46779d7_3537a6f565654585a7b45113703933ee_1024x1024.webp', '2025-02-06 03:23:04', '2025-02-06 03:23:04'),
(19, 34, 'uploads/67a42b185af1f_z5594338311706_53123b2d888f84bf37ea7ce2c1371724_c360165a807e4baa8a89f5df76784e4c_1024x1024.webp', '2025-02-06 03:23:04', '2025-02-06 03:23:04'),
(26, 39, 'uploads/67bd2dce08315_1-4db3b09d-bd47-4f42-9b5c-2b33059a262d.webp', '2025-02-25 02:41:18', '2025-02-25 02:41:18'),
(27, 39, 'uploads/67bd2dce087a3_2-a1f3923b-edc0-4612-aa4c-b9b045d48fb6.webp', '2025-02-25 02:41:18', '2025-02-25 02:41:18'),
(28, 39, 'uploads/67bd2dce08abb_coao-a43d83e1-cbd6-4912-8769-35eb48419c15.webp', '2025-02-25 02:41:18', '2025-02-25 02:41:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,0) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_variants`
--

INSERT INTO `product_variants` (`id`, `sku`, `product_id`, `color_id`, `size_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(14, 'AA-001', 33, 2, 1, 49, 199000, NULL, NULL),
(15, 'AA-002', 33, 2, 2, 13, 199000, NULL, NULL),
(16, 'AA-003', 33, 2, 3, 49, 199000, NULL, NULL),
(17, 'AB-001', 33, 3, 1, 45, 210000, NULL, NULL),
(18, 'AB-002', 33, 3, 2, 36, 210000, NULL, NULL),
(19, 'AB-003', 33, 3, 3, 50, 199000, NULL, NULL),
(21, 'AC-001', 34, 2, 1, 100, 200000, NULL, NULL),
(22, 'AC-002', 34, 2, 2, 100, 200000, NULL, NULL),
(23, 'AC-003', 34, 2, 3, 99, 200000, NULL, NULL),
(24, 'AD-001', 34, 3, 1, 100, 200000, NULL, NULL),
(25, 'AD-002', 34, 3, 2, 99, 200000, NULL, NULL),
(26, 'AD-003', 34, 3, 3, 99, 200000, NULL, NULL),
(27, 'AE-001', 34, 4, 1, 76, 185000, NULL, NULL),
(28, 'AE-002', 34, 4, 2, 89, 185000, NULL, NULL),
(29, 'AE-003', 34, 4, 3, 98, 185000, NULL, NULL),
(32, 'AF-001', 39, 2, 1, 100, 155000, NULL, NULL),
(33, 'AF-002', 39, 2, 2, 81, 155000, NULL, NULL),
(34, 'AF-003', 39, 2, 3, 95, 155000, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S', NULL, NULL),
(2, 'M', NULL, NULL),
(3, 'L', NULL, NULL),
(4, 'X', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `otp` varchar(6) DEFAULT NULL,
  `otp_expired_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`, `role`, `otp`, `otp_expired_at`) VALUES
(3, 'Trần Tiến Đạt', 'datntpk03697@gmail.com', '123456789', 'uploads/67b76f083dfe9.z6230416928815_f786bd8c339c98e33f81af03dbf347b8.jpg', '2025-01-13 00:24:24', '2025-02-20 18:06:00', 'user', NULL, NULL),
(4, 'Mạnh Cường', 'cuongnmpk03765@gmail.com', '123456789', NULL, '2025-01-13 00:44:29', '2025-01-13 00:44:29', 'user', NULL, NULL),
(5, 'Trần Tiến Phát', 'phatttpk03754@gmail.com', '123123123', 'uploads/67b88a9b15c92.z6237739466616_f286bdf6e5bddae9aee9a153fda30fa6.jpg', '2025-01-13 11:27:02', '2025-02-21 14:15:55', 'admin', NULL, NULL),
(6, 'hat Vua', 'vuahatdinhduongngon@gmail.com', '$2y$10$dGmZvPrXdjMAPOPCdWzE5uOcp3uyvdLPDHnTKScssmDWKIhlzKeZ2', 'uploads/678f1f9bc4daf.z6231042980407_f42e5786492a8037c2f4529e2f2115eb.jpg', '2025-01-14 03:56:11', '2025-01-21 04:16:27', '', NULL, NULL),
(7, 'Nguyễn Tiến Đạt', 'dat1234@gmail.com', '123456789', 'uploads/678874165a765.z6230416928815_f786bd8c339c98e33f81af03dbf347b8.jpg', '2025-01-16 02:51:02', '2025-01-16 02:51:02', 'user', NULL, NULL),
(8, 'Trần Tiến Phát', 'phatdeptraiokmen@gmail.com', '123123123', 'uploads/678f1fa5b372c.z6230418728152_a62e5b33a1530f348ddf765bceea7b8d.jpg', '2025-01-16 02:52:22', '2025-02-21 09:02:12', 'user', NULL, NULL),
(9, 'finalphat', 'phat123@gmail.com', '123456789', 'uploads/678f1b815e716.z6231044173801_6bbd249038a59877aa20b83a1efcc769.jpg', '2025-01-21 03:58:57', '2025-01-21 03:58:57', 'user', NULL, NULL),
(10, 'finalphat', 'phat12345@gmail.com', '123456', NULL, '2025-03-01 04:35:46', '2025-03-01 04:35:46', 'user', NULL, NULL),
(11, 'tuấn', 'tuan123@gmail.com', '123456789', NULL, '2025-03-01 04:42:55', '2025-03-01 04:42:55', 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `userId`, `address`, `phone`, `name`, `is_default`, `created_at`) VALUES
(1, 8, '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '0942960548', 'Trần Phát', 0, '2025-02-27 01:25:42'),
(2, 8, '234, thôn 2, xã Tâm Thắng, H. Cư Jut, T. Đăk Nông', '0456789452', 'đạt', 0, '2025-02-27 03:33:23'),
(3, 11, '151/50 Lê Hồng Phong, P. Thống Nhất, tp. Buôn Ma Thuột', '0942960548', 'tuấn', 0, '2025-03-01 04:46:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_unique` (`cart_session`,`sku`,`color_id`,`size_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codeCoupon` (`codeCoupon`);

--
-- Chỉ mục cho bảng `favourite_items`
--
ALTER TABLE `favourite_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idOrder` (`idOrder`),
  ADD KEY `idProductVariants` (`idProductVariants`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_images_product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_variant` (`product_id`,`color_id`,`size_id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `favourite_items`
--
ALTER TABLE `favourite_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `favourite_items`
--
ALTER TABLE `favourite_items`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`idOrder`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`idProductVariants`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
