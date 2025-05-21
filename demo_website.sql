-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 21, 2025 lúc 04:36 PM
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
-- Cơ sở dữ liệu: `demo_website`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Sầu riêng', NULL, '2025-05-20 12:16:51', '2025-05-20 12:16:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sầu riêng thái loại 1', 100000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 19:20:43', '2025-05-20 19:20:43'),
(2, 1, 'Sầu riêng thái loại 2', 135000, 'Giá có thể thay đổi theo mùa vụ', '2025-05-20 20:28:06', '2025-05-20 20:28:06'),
(3, 1, 'Sầu riêng thái loại 3', 200000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:29:14', '2025-05-20 20:29:14'),
(4, 1, 'Sầu riêng thái loại 4', 199000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:29:48', '2025-05-20 20:29:48'),
(5, 1, 'MUSANGKING loại 1', 200000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:32:20', '2025-05-20 20:32:20'),
(6, 1, 'MUSANGKING loại 2', 200000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:32:42', '2025-05-20 20:32:42'),
(7, 1, 'MUSANGKING loại 3', 200000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:33:10', '2025-05-20 20:33:10'),
(8, 1, 'MUSANGKING loại 4', 200000, 'Có màu vàng nhạt, phần cơm rất dày, có hạt lép. Điểm đặc biệt chính là vị ngọt thanh, beo béo vừa phải, ăn không bị ngán. Sầu thái không có hậu vị đắng, hương thơm cũng không quá nồng như các loại sầu riêng khác.', '2025-05-20 20:33:32', '2025-05-20 20:33:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `created_at`) VALUES
(1, 1, '1747743643_sau-rieng2.png', '2025-05-20 19:20:43'),
(2, 1, '1747743643_sau-rieng-3.jpg', '2025-05-20 19:20:43'),
(3, 1, '1747743643_sau-rieng-4.jpg', '2025-05-20 19:20:43'),
(4, 1, '1747743643_sau-rieng.png', '2025-05-20 19:20:43'),
(5, 2, '1747747686_sau-rieng-3.jpg', '2025-05-20 20:28:06'),
(6, 2, '1747747686_sau-rieng-4.jpg', '2025-05-20 20:28:06'),
(7, 2, '1747747686_sau-rieng.png', '2025-05-20 20:28:06'),
(8, 2, '1747747686_sau-rieng2.png', '2025-05-20 20:28:06'),
(9, 3, '1747747754_sau-rieng.png', '2025-05-20 20:29:14'),
(10, 3, '1747747754_sau-rieng2.png', '2025-05-20 20:29:14'),
(11, 3, '1747747754_sau-rieng-3.jpg', '2025-05-20 20:29:14'),
(12, 3, '1747747754_sau-rieng-4.jpg', '2025-05-20 20:29:14'),
(13, 4, '1747747788_sau-rieng2.png', '2025-05-20 20:29:48'),
(14, 4, '1747747788_sau-rieng-3.jpg', '2025-05-20 20:29:48'),
(15, 4, '1747747788_sau-rieng-4.jpg', '2025-05-20 20:29:48'),
(16, 4, '1747747788_sau-rieng.png', '2025-05-20 20:29:48'),
(17, 5, '1747747940_3-1045.png', '2025-05-20 20:32:20'),
(18, 6, '1747747962_sau-rieng-4.jpg', '2025-05-20 20:32:42'),
(19, 7, '1747747990_sau-rieng.png', '2025-05-20 20:33:10'),
(20, 8, '1747748012_sau-rieng2.png', '2025-05-20 20:33:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` enum('student','instructor','admin') DEFAULT 'student',
  `status` enum('active','inactive') DEFAULT 'active',
  `otp` varchar(6) DEFAULT NULL,
  `otp_expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `image`, `role`, `status`, `otp`, `otp_expired_at`, `created_at`, `updated_at`) VALUES
(1, 'Nguyen Van Tai', 'ntai6530@gmai.com', '$2y$10$v0jz6P4Mzok7PQqFmdVThOGDYMozkELqj04EXSxzXWDyrXgDf0l0u', NULL, 'avatar/1742609642-aosimiden.jpg', 'admin', 'active', NULL, '2025-03-22 02:14:34', '2025-03-21 06:59:52', '2025-03-22 02:14:34'),
(2, 'admin', 'admin@gmail.com', '$2y$10$YJLg4QqqGOAreQFM4TmaN.BLjnxjXqxSeYMDr7Ey6YXZCkhDeR96m', NULL, 'avatar/1742609642-aosimiden.jpg', 'admin', 'active', NULL, '2025-03-22 02:14:02', '2025-03-22 02:08:52', '2025-03-22 02:14:02'),
(3, 'bui van chau', 'chau@gmail.com', '$2y$10$s0qbmJdTMbSbD.tX1Olmluv8nNF5NTaBjaNPtnaZmXEB9WQpOPR9G', '0987654321', 'avatar/1742614986-aosomigreen.jpg', 'student', 'active', NULL, '2025-03-22 03:43:06', '2025-03-22 03:36:20', '2025-03-22 03:43:06'),
(4, 'nguyen tien dat', 'ntdad2005@gmail.com', '$2y$10$uCGV8N56rxUHIGa949r8wuG6CMOUBylyPo.O4NbSSOR6oD/oOUD76', NULL, NULL, 'student', 'active', NULL, '2025-04-05 04:27:25', '2025-03-24 14:19:38', '2025-04-05 04:27:25'),
(5, 'tien dat', 'datntpk03697@gmail.com', '$2y$10$MbqqG2lFteqBDJrYEQNKUOxbhivZUudJUtIkhGUU0i79ZaT5d.Ko.', '0987654321', 'avatar/1742826178-aosomigreen.jpg', 'student', 'active', NULL, '2025-03-24 14:22:58', '2025-03-24 14:20:54', '2025-03-24 14:22:58'),
(6, 'omachi', 'omachi@gmail.com', '$2y$10$/Z/Mtw.byWHzYLWiK4BvwejCqKUnlPZwarBMmnaKfdH6G8M4f5D06', NULL, NULL, 'student', 'active', NULL, '2025-03-28 14:47:28', '2025-03-28 14:47:28', '2025-03-28 14:47:28'),
(7, 'Đạt Nguyễn', 'bongdemad@gmail.com', '67efeafc55670', NULL, '', 'student', 'active', NULL, '2025-04-08 15:12:26', '2025-04-04 14:21:48', '2025-04-08 15:12:26'),
(8, 'Phát Trần', 'phatdeptraiokmen@gmail.com', '67f4992d1f39c', NULL, '', 'student', 'active', NULL, '2025-04-08 15:12:30', '2025-04-08 03:34:05', '2025-04-08 15:12:30'),
(10, 'Phát Trần', 'phatttpk03754@gmail.com', '67f665e66ff58', NULL, '', '', 'active', NULL, '2025-04-09 12:19:50', '2025-04-09 12:19:50', '2025-04-09 12:19:50');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
