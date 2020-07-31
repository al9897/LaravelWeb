-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2019 at 11:21 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoes_web_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Adidas', NULL, NULL),
(2, 'Nike', NULL, NULL),
(3, 'Puma', NULL, NULL),
(4, 'Timberland', NULL, NULL),
(5, 'Fila', '2019-05-13 02:41:24', '2019-05-13 02:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birth_year` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_05_07_074636_create_products_table', 1),
(2, '2019_05_09_102513_create_promotions_table', 1),
(3, '2019_05_10_072938_create_sales_table', 1),
(4, '2019_05_10_073631_create_brands_table', 1),
(5, '2019_05_10_074005_create_clients_table', 1),
(6, '2019_05_10_074926_create_orders_table', 1),
(7, '2019_05_10_074958_create_order_detail_table', 1),
(8, '2019_05_10_082827_create_target_clients_table', 1),
(9, '2019_05_10_093055_rename_column_target_client_in_products_table', 1),
(10, '2019_05_11_190320_create_users_table', 1),
(11, '2019_05_11_190505_create_password_resets_table', 1),
(12, '2019_05_11_202856_add_is_admin_column_to_users', 1),
(13, '2019_05_12_082759_create_sessions_table', 1),
(14, '2019_05_12_202232_rename_client_i_d_column_in_orders', 1),
(15, '2019_05_12_203638_delete_order_time_column_in_orders', 1),
(16, '2019_05_12_222341_add_is_done_column_to_orders', 1),
(17, '2019_05_13_000439_add_deleted_at_column_to_orders', 1),
(18, '2019_06_01_191338_add_pixelate_img_to_products', 2),
(19, '2019_06_02_031916_add_colum_deleted_at_to_users', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `special_discount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isDone` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `special_discount`, `created_at`, `updated_at`, `isDone`, `deleted_at`) VALUES
(1, 3, 1.00, '2019-05-12 14:56:03', '2019-05-12 14:56:03', 0, NULL),
(2, 3, 1.00, '2019-05-12 15:05:48', '2019-05-12 15:05:48', 0, NULL),
(4, 3, 1.00, '2019-05-12 15:06:49', '2019-05-12 15:06:49', 0, NULL),
(5, 3, 1.00, '2019-05-12 15:07:53', '2019-05-12 15:07:53', 0, NULL),
(6, 2, 1.00, '2019-05-12 15:20:54', '2019-05-12 15:20:54', 0, NULL),
(8, 2, 1.00, '2019-05-12 15:26:03', '2019-05-12 18:02:33', 1, NULL),
(9, 2, 1.00, '2019-05-12 15:26:13', '2019-05-12 18:03:21', 1, NULL),
(10, 2, 1.00, '2019-05-12 15:29:27', '2019-05-12 15:29:27', 0, NULL),
(11, 2, 1.00, '2019-05-12 15:32:47', '2019-05-12 15:32:47', 0, NULL),
(12, 3, 1.00, '2019-05-12 17:39:25', '2019-05-12 17:39:25', 0, NULL),
(13, 2, 1.00, '2019-05-12 18:36:06', '2019-05-12 18:36:06', 0, NULL),
(14, 2, 1.00, '2019-05-13 04:44:14', '2019-05-13 04:44:14', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, '2019-05-12 14:56:03', '2019-05-12 14:56:03'),
(2, 1, 11, 1, '2019-05-12 14:56:03', '2019-05-12 14:56:03'),
(3, 2, 3, 1, '2019-05-12 15:05:48', '2019-05-12 15:05:48'),
(4, 2, 4, 1, '2019-05-12 15:05:48', '2019-05-12 15:05:48'),
(5, 4, 2, 1, '2019-05-12 15:06:49', '2019-05-12 15:06:49'),
(6, 5, 7, 1, '2019-05-12 15:07:53', '2019-05-12 15:07:53'),
(7, 6, 1, 1, '2019-05-12 15:20:54', '2019-05-12 15:20:54'),
(8, 6, 11, 1, '2019-05-12 15:20:54', '2019-05-12 15:20:54'),
(9, 7, 1, 1, '2019-05-12 15:23:39', '2019-05-12 15:23:39'),
(10, 9, 1, 1, '2019-05-12 15:26:13', '2019-05-12 15:26:13'),
(11, 10, 7, 3, '2019-05-12 15:29:27', '2019-05-12 15:29:27'),
(12, 10, 11, 1, '2019-05-12 15:29:27', '2019-05-12 15:29:27'),
(13, 11, 1, 1, '2019-05-12 15:32:47', '2019-05-12 15:32:47'),
(14, 12, 6, 1, '2019-05-12 17:39:25', '2019-05-12 17:39:25'),
(15, 13, 2, 3, '2019-05-12 18:36:06', '2019-05-12 18:36:06'),
(16, 14, 7, 4, '2019-05-13 04:44:14', '2019-05-13 04:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `target_client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `viewed_number` int(11) NOT NULL,
  `bought_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pixelate_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `brand_id`, `target_client_id`, `image_path`, `price`, `stock`, `sale_id`, `viewed_number`, `bought_number`, `created_at`, `updated_at`, `pixelate_img`) VALUES
(1, 'Shoes 1', 'It is really comfortable', 1, '1', 'upload/products/1559548135.webp', 90.00, 100, 2, 10, 16, NULL, '2019-06-03 05:48:55', 'upload/products/pixelate/1559548135.webp'),
(2, 'Shoes 2', 'It is really comfortable', 1, '1', 'image/sample_product.jpg', 90.00, 100, 1, 10, 28, NULL, '2019-05-12 18:36:06', 'image/sample_product_pixelate.png'),
(3, 'Shoes 3', 'It is really comfortable', 1, '1', 'image/sample_product.jpg', 90.00, 100, 3, 20, 35, NULL, NULL, 'image/sample_product_pixelate.png'),
(4, 'Shoes 4', 'It is really comfortable', 1, '1', 'image/sample_product.jpg', 90.00, 100, 1, 20, 35, NULL, NULL, 'image/sample_product_pixelate.png'),
(5, 'Shoes 5', 'It is really comfortable', 2, '2', 'image/sample_product.jpg', 90.00, 100, 1, 30, 45, NULL, NULL, 'image/sample_product_pixelate.png'),
(6, 'Shoes 6', 'It is really comfortable', 3, '2', 'image/sample_product.jpg', 90.00, 100, 1, 8, 38, NULL, '2019-05-12 17:39:25', 'image/sample_product_pixelate.png'),
(7, 'Shoes 7', 'It is really comfortable', 3, '2', 'image/sample_product.jpg', 90.00, 96, 4, 20, 39, NULL, '2019-05-13 04:44:14', 'image/sample_product_pixelate.png'),
(8, 'Shoes 8', 'It is really comfortable', 4, '2', 'image/sample_product.jpg', 90.00, 100, 1, 20, 35, NULL, NULL, 'image/sample_product_pixelate.png'),
(9, 'Shoes 9', 'It is really comfortable', 2, '3', 'image/sample_product.jpg', 90.00, 100, 1, 20, 45, NULL, NULL, 'image/sample_product_pixelate.png'),
(10, 'Shoes 10', 'It is really comfortable', 2, '3', 'image/sample_product.jpg', 90.00, 100, 1, 43, 35, NULL, NULL, 'image/sample_product_pixelate.png'),
(11, 'Shoes 11', 'It is really comfortable', 4, '3', 'image/sample_product.jpg', 90.00, 100, 5, 14, 35, NULL, NULL, 'image/sample_product_pixelate.png'),
(19, 'Test', 'Test', 1, '3', 'upload/products/1559546102.jpg', 140.00, 50, 1, 0, 0, '2019-06-03 05:15:02', '2019-06-03 05:15:02', 'upload/products/pixelate/1559546102.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(10) UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'image/promotions/nike.jpg', NULL, NULL),
(2, 'image/promotions/adidas.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sale_percent` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `description`, `sale_percent`, `created_at`, `updated_at`) VALUES
(1, 'No discount', 1.00, NULL, NULL),
(2, 'Discount 20%', 0.80, NULL, NULL),
(3, 'Discount 30%', 0.70, NULL, NULL),
(4, 'Discount 40%', 0.60, NULL, NULL),
(5, 'Discount 50%', 0.50, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `target_clients`
--

CREATE TABLE `target_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `for_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `target_clients`
--

INSERT INTO `target_clients` (`id`, `for_client`, `created_at`, `updated_at`) VALUES
(1, 'Male', NULL, NULL),
(2, 'Female', NULL, NULL),
(3, 'Unisex', NULL, NULL),
(4, 'Kids', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isAdmin` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `remember_token`, `created_at`, `updated_at`, `isAdmin`, `deleted_at`) VALUES
(1, 'Nguyen Tran', 'nguyentn031192@gmail.com', '$2y$10$3J9qIARG0F3Cpor33Wzo0eiDnng7QJDpddd2PXwHQwY8OZXarYgUe', '/upload/avatars/1559287259.jpg', 'TNqqWXpYfq9G0QjjHAOknvVRAMgzjg07rXGU8amwQsB0zVERrQT1Ka5CidMT', '2019-05-11 13:06:06', '2019-05-31 05:20:59', 1, NULL),
(2, 'An Le', 'anle@gmail.com', '$2y$10$XBYk8hoGQ5SHeMHtIguSkOMSlxDTvNIFI4VQOnuYOocl4S4ZvNbMC', 'image/profiles/default.png', '3rgTYj6P1a0Gttc9lvVHDpTBOPHvAfLTV7KC9OMLKtqlOiMWUA5sS4iXjMS5', '2019-05-11 14:35:02', '2019-05-30 09:33:50', 1, NULL),
(3, 'Emin Thaqi', 'emin@gmail.com', '$2y$10$ZXL74sgEPRfzUL5z4Cy7KOA6c52KS6ViIQUBvu67Uc6mRmyahPp2q', '/upload/avatars/1559553498.jpg', NULL, '2019-06-03 07:14:59', '2019-06-03 07:18:18', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_name_email_telephone_unique` (`name`,`email`,`telephone`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_details_order_id_product_id_unique` (`order_id`,`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `target_clients`
--
ALTER TABLE `target_clients`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `target_clients`
--
ALTER TABLE `target_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
