-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2020 at 09:24 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apk`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(100) NOT NULL,
  `comment_on_id` int(100) NOT NULL,
  `comment_on_type` text NOT NULL,
  `comment` text NOT NULL,
  `comment_by` text NOT NULL,
  `rating` int(100) NOT NULL,
  `is_registered` int(100) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0865cd640357cc1a89b07e00a5782985f6bf753c696ef8ceecdfc643f9f5137fd8bf041ef4f3ee35', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 13:14:23', '2020-07-22 13:14:23', '2021-07-22 18:44:23'),
('0df94bbbfd47de02f601d995beae3f133e055ad75ec73b0d4ca1ea9aef3b90ee05933de52d5053b7', 21, 1, 'Cookrey', '[]', 0, '2020-07-22 11:18:11', '2020-07-22 11:18:11', '2021-07-22 16:48:11'),
('1ff5d943af7d53ca771d7676979a4058734291194abd946e27f91c72ba810447dec2f745822abd10', 12, 1, 'Cookrey', '[]', 0, '2020-07-22 08:08:31', '2020-07-22 08:08:31', '2021-07-22 13:38:31'),
('3f9fcc9e3053dd83be6a5f19df001019cdc9fdf02d64cc60b50aa7abb36789be5365c45beac5c36d', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 13:20:33', '2020-07-22 13:20:33', '2021-07-22 18:50:33'),
('44ac73894ae24af8086c11384e704e8b250685a81a1738363fd3fd246951a21ab28e7c25b17e0248', 18, 1, 'Cookrey', '[]', 0, '2020-07-22 08:52:41', '2020-07-22 08:52:41', '2021-07-22 14:22:41'),
('45434fd74638a4af3150344109127a123cc279a459af44112f5e38b050e40c4af98382f790570b61', 19, 1, 'Cookrey', '[]', 0, '2020-07-22 08:53:20', '2020-07-22 08:53:20', '2021-07-22 14:23:20'),
('46b15959e2e9483e56e435f3e1dadf6788fb65f8b58a62add7fbcfab2bec731cf69c9bfe04d5d741', 13, 1, 'Cookrey', '[]', 0, '2020-07-22 08:09:32', '2020-07-22 08:09:32', '2021-07-22 13:39:32'),
('6c2fabd79c7b6f8bed78a8bb8ea18f0582c8ef01842d072cba0d2246ead1e8e38d96a5e28b365d51', 17, 1, 'Cookrey', '[]', 0, '2020-07-22 08:45:40', '2020-07-22 08:45:40', '2021-07-22 14:15:40'),
('84d90427524c9a939eeac25de2b013e0eeb8f0b7a2c432b9791f0e02e82e3a91d004ecb100bc3933', 5, 1, 'Cookrey', '[]', 0, '2020-07-22 08:01:12', '2020-07-22 08:01:12', '2021-07-22 13:31:12'),
('96073878c37467f1482a9dba1bb82deab16ecdc586123192f0eb55a3404a8fdbc913afa973c23dcf', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 08:55:03', '2020-07-22 08:55:03', '2021-07-22 14:25:03'),
('c2954d116e8a57eebce9707e8d9ae825c4da2176d34f485b4c9f02fc3fe3804d9f48fb273665f1ac', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 13:15:28', '2020-07-22 13:15:28', '2021-07-22 18:45:28'),
('c816118f5c096f5607e11c6ac1e1ae2992fbed9568bf4ad25d2624bd2fae40fd32adfb30bfe748dc', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 13:19:18', '2020-07-22 13:19:18', '2021-07-22 18:49:18'),
('d49fa300860ae6afd00c55d516e17d820dbb2b29c07b4e10e0fbcbe8d3b27a24f8f4030a7c46477f', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 13:16:49', '2020-07-22 13:16:49', '2021-07-22 18:46:49'),
('e65509fd11ed22f1442808c15c75ce7272d65bb57b43df0e099ab1c26f4ef1fa8f6bf66b90320103', 1, 1, 'Cookrey', '[]', 0, '2020-07-22 02:11:07', '2020-07-22 02:11:07', '2021-07-22 07:41:07'),
('ee9de3c4125f251aa12767efc3c4a8c7dff9730d400519f831c6e5c274d36e164475157b87778cba', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 09:33:50', '2020-07-22 09:33:50', '2021-07-22 15:03:50'),
('f5380718369aa73c4a429d6a11bb107979946b8399e1944bc6f21877839d4811c2731391a7aa7eab', 20, 1, 'Cookrey', '[]', 0, '2020-07-22 09:34:37', '2020-07-22 09:34:37', '2021-07-22 15:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'CDzX703EgKJbIWLY64CcIuBq92m2sxVPvJ0S19gq', NULL, 'http://localhost', 1, 0, 0, '2020-07-21 22:47:30', '2020-07-21 22:47:30'),
(2, NULL, 'Laravel Password Grant Client', 'QgWXh1W2ITy8pHL07csQfsOwpqxWvTDDnYFtSNpp', 'users', 'http://localhost', 0, 1, 0, '2020-07-21 22:47:30', '2020-07-21 22:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-07-21 22:47:30', '2020-07-21 22:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` text NOT NULL,
  `gallery` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `category` int(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `price` int(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `food_type` varchar(100) NOT NULL,
  `rating` int(100) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `image`, `description`, `price`, `type`, `food_type`, `rating`, `created_at`, `updated_at`) VALUES
(10, 'Commodo qui itaque v', '131113-cups.png', 'Perferendis doloribu', 28, 'thali', '', 5, '2020-07-15 13:11:13.095935', '2020-07-15 13:11:13.095935'),
(11, 'Chicken Tikka', '131140-cups.png', 'Perferendis doloribu', 28, 'snack', '', 5, '2020-07-15 13:11:40.868192', '2020-07-15 13:11:40.868192'),
(12, 'Paneer Tikka', '131203-blog-7.png', 'Perferendis doloribu', 28, 'snack', '', 5, '2020-07-15 13:12:03.319515', '2020-07-15 13:12:03.319515'),
(13, 'Chicken Leg Piece', '131258-hinged-container.png', 'Perferendis doloribu', 285, 'snack', '', 5, '2020-07-15 13:12:58.686189', '2020-07-15 13:12:58.686189');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(100) NOT NULL,
  `provider_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desciption` text NOT NULL,
  `image` text NOT NULL,
  `gallery` text NOT NULL,
  `rating` int(100) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tiffin_box`
--

CREATE TABLE `tiffin_box` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `dish` text NOT NULL,
  `rice` int(255) NOT NULL,
  `flatbread` int(255) NOT NULL,
  `extra` text NOT NULL,
  `tiffin_type` varchar(255) NOT NULL,
  `service_id` int(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topping`
--

CREATE TABLE `topping` (
  `id` int(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `service_id` int(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(18, NULL, '3370540666', 'ginibino@mailinator.com', NULL, '$2y$10$UcPypcfMjEujx8neFSy0AeM1/yVs8h.NwkP2jukCnkxdkBF819meK', NULL, '2020-07-22 08:52:41', '2020-07-22 08:52:41'),
(19, NULL, '7253325817', 'qofasohyqy@mailinator.net', NULL, '$2y$10$n9ywltEy2RZSsh9/i9vYiO6FRwbBlqlMQ68msPUqhrYuCvXrWVdra', NULL, '2020-07-22 08:53:20', '2020-07-22 08:53:20'),
(20, NULL, '1122334455', 'ginibino@mailim', NULL, '$2y$10$aEGcTd/2zhruWqsU.fgefu99/XAMEXEAhl8lHsECW9eVsfFRDjBUS', NULL, '2020-07-22 08:55:03', '2020-07-22 08:55:03'),
(21, NULL, '5765765676', 'qofasohyqy@mailinato', NULL, '$2y$10$kzUgimPxjikwn87RW890Se2deweNOmKa1XIPYk36JYWAxJ/VNyDNe', NULL, '2020-07-22 11:18:11', '2020-07-22 11:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `users_old`
--

CREATE TABLE `users_old` (
  `id` int(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` text,
  `photo` varchar(100) DEFAULT NULL,
  `address` text,
  `password` text,
  `token` text,
  `active` int(100) DEFAULT NULL,
  `is_member` int(100) DEFAULT NULL,
  `membership_type` varchar(255) DEFAULT NULL,
  `business_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_old`
--

INSERT INTO `users_old` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `photo`, `address`, `password`, `token`, `active`, `is_member`, `membership_type`, `business_type`, `created_at`, `updated_at`) VALUES
(3, NULL, NULL, NULL, 'sumit@test', '7088984624', NULL, NULL, '$2y$10$T2KXjpBWhPs.g.xmKvHbBezwZF5QGfEb/fAtDcyGv6soPcs.q67D.', NULL, NULL, NULL, NULL, NULL, '2020-07-21 08:12:39.000000', '2020-07-21 08:12:39.000000'),
(4, NULL, NULL, NULL, 'qofasohyqy@mailinator.net', '7578678678', NULL, NULL, '$2y$10$c9ZmRjlk9UGCmgUSyH5ipu0o.2SlQZV3Ttu91ED8qmcO5bkAUDjIO', NULL, NULL, NULL, NULL, NULL, '2020-07-21 09:48:08.000000', '2020-07-21 09:48:08.000000'),
(5, NULL, NULL, NULL, 'qofasohyqy@mailinator.netr', '7578678678', NULL, NULL, '$2y$10$3df5oMDPYBBF9QrFFvFrGurwioMlG4N3iFQTvM9P5tF8/isU61gsy', NULL, NULL, NULL, NULL, NULL, '2020-07-21 09:55:30.000000', '2020-07-21 09:55:30.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tiffin_box`
--
ALTER TABLE `tiffin_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_old`
--
ALTER TABLE `users_old`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tiffin_box`
--
ALTER TABLE `tiffin_box`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topping`
--
ALTER TABLE `topping`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users_old`
--
ALTER TABLE `users_old`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
