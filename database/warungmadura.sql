-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Nov 2025 pada 07.33
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungmadura`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator dengan hak akses penuh'),
(2, 'user', 'User biasa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'test', NULL, '2025-08-13 23:21:03', 0),
(2, '::1', 'admin', NULL, '2025-08-30 01:51:39', 0),
(3, '::1', 'admin', NULL, '2025-08-30 01:51:45', 0),
(4, '::1', 'admin', NULL, '2025-08-30 01:53:01', 0),
(5, '::1', 'admin', NULL, '2025-08-30 01:55:08', 0),
(6, '::1', 'adminss', NULL, '2025-08-30 01:55:23', 0),
(7, '::1', 'admin', NULL, '2025-08-30 01:55:32', 0),
(8, '::1', 'admin', NULL, '2025-08-30 01:57:22', 0),
(9, '::1', 'admin', NULL, '2025-08-30 01:58:27', 0),
(10, '::1', 'admin', NULL, '2025-08-30 01:59:05', 0),
(11, '::1', 'admin', NULL, '2025-08-30 01:59:38', 0),
(12, '::1', 'admin', NULL, '2025-08-30 01:59:44', 0),
(13, '::1', 'admin', NULL, '2025-08-30 02:00:11', 0),
(14, '::1', 'admin', NULL, '2025-08-30 12:01:54', 0),
(15, '::1', 'bayu', NULL, '2025-08-30 12:22:11', 0),
(16, '::1', 'admingg', 4, '2025-08-30 12:45:22', 0),
(17, '::1', 'adm@gmain.com', 4, '2025-08-30 12:45:59', 1),
(18, '::1', 'admin', NULL, '2025-08-30 13:36:54', 0),
(19, '::1', 'adm@gmain.com', 4, '2025-08-30 13:38:19', 1),
(20, '::1', 'admingg', NULL, '2025-08-30 13:44:33', 0),
(21, '::1', 'adm@gmain.com', 4, '2025-08-30 13:44:42', 1),
(22, '::1', 'adm@gmain.com', 4, '2025-08-30 13:50:27', 1),
(23, '::1', 'admindd', NULL, '2025-08-30 13:50:37', 0),
(24, '::1', 'admin@d', NULL, '2025-08-30 13:54:31', 0),
(25, '::1', 'admin3', NULL, '2025-08-30 13:55:33', 0),
(26, '::1', 'dad', NULL, '2025-08-30 13:57:00', 0),
(27, '::1', 'ada', NULL, '2025-08-30 13:59:07', 0),
(28, '::1', 'adm@gmain.com', 4, '2025-08-30 14:00:33', 1),
(29, '::1', 'adm@gmain.com', 4, '2025-08-30 15:49:05', 1),
(30, '::1', 'bayu123', NULL, '2025-08-30 17:26:27', 0),
(31, '::1', 'adm@gmain.com', 4, '2025-08-30 17:27:04', 1),
(32, '::1', 'adm@gmain.com', 4, '2025-08-30 17:29:38', 1),
(33, '::1', 'bayu123', NULL, '2025-08-30 17:29:56', 0),
(34, '::1', 'adm@gmain.com', 4, '2025-08-30 17:30:12', 1),
(35, '::1', 'bayu', NULL, '2025-08-30 17:30:44', 0),
(36, '::1', 'adm@gmain.com', 4, '2025-08-30 17:31:30', 1),
(37, '::1', 'bayu', NULL, '2025-08-30 17:47:24', 0),
(38, '::1', 'admingg', NULL, '2025-08-30 17:47:50', 0),
(39, '::1', 'adm@gmain.com', 4, '2025-08-30 17:48:00', 1),
(40, '::1', 'bayu', NULL, '2025-08-30 17:49:14', 0),
(41, '::1', 'adm@gmain.com', 4, '2025-08-30 17:49:23', 1),
(42, '::1', 'bayu12', NULL, '2025-08-30 17:50:03', 0),
(43, '::1', 'bayu12', NULL, '2025-08-30 17:50:11', 0),
(44, '::1', 'adm@gmain.com', 4, '2025-08-30 17:56:49', 1),
(45, '::1', 'adm@gmain.com', 4, '2025-08-31 15:44:12', 1),
(46, '::1', 'adm@gmain.com', 4, '2025-08-31 16:48:39', 1),
(47, '::1', 'admin22', NULL, '2025-08-31 16:58:18', 0),
(48, '::1', 'admingg', NULL, '2025-08-31 16:59:24', 0),
(49, '::1', 'adad', NULL, '2025-11-04 20:52:37', 0),
(50, '::1', 'admin', NULL, '2025-11-04 20:52:43', 0),
(51, '::1', 'admin', NULL, '2025-11-04 20:52:58', 0),
(52, '::1', 'admin', NULL, '2025-11-04 20:53:05', 0),
(53, '::1', 'admin', NULL, '2025-11-04 20:59:55', 0),
(54, '::1', 'admin', NULL, '2025-11-04 21:05:54', 0),
(55, '::1', 'adasd', NULL, '2025-11-04 21:11:03', 0),
(56, '::1', 'asdad', NULL, '2025-11-04 21:11:07', 0),
(57, '::1', 'dada', NULL, '2025-11-04 21:12:55', 0),
(58, '::1', 'admin', NULL, '2025-11-04 22:53:48', 0),
(59, '::1', 'admin', NULL, '2025-11-04 22:54:04', 0),
(60, '::1', 'admin', NULL, '2025-11-04 22:56:24', 0),
(61, '::1', 'admin@mail.com', 1, '2025-11-04 22:56:43', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `listproduct`
--

CREATE TABLE `listproduct` (
  `ProductID` int(11) NOT NULL,
  `ProductCode` varchar(100) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductType` int(11) NOT NULL COMMENT '1 = Kemasan 2 = satuan',
  `ProductImg` varchar(255) DEFAULT NULL,
  `QrProduct` varchar(255) DEFAULT NULL,
  `TotalStock` varchar(255) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `listproduct`
--

INSERT INTO `listproduct` (`ProductID`, `ProductCode`, `ProductName`, `ProductType`, `ProductImg`, `QrProduct`, `TotalStock`, `created_at`) VALUES
(5, 'PRD001', 'Beras', 1, '1754586194_44f6f53f33e55de4f0df.jpg', 'PRD001_1754836979.png', '41', '2025-08-07 17:03:14'),
(6, 'PRD002', 'Minyak Goreng 2', 2, '1754586248_3f5dab65b52e7aab1720.jpg', 'PRD002_1754837015.png', '58', '2025-08-07 17:03:34'),
(8, 'PRD003', 'Gula', 1, '1756631595_705e4ce8d9d76ec712af.jpg', 'PRD003_1756634690.png', '1', '2025-08-31 16:13:15'),
(9, 'PRD004', 'Mie', 1, '1756631621_ce91bfd2405a4896a735.jpg', 'PRD004_1756645944.png', '1', '2025-08-31 16:13:41'),
(10, 'PRD005', 'Telur', 2, '1756631640_3c9e900942aac3861411.jpg', 'PRD005_1756645948.png', '1', '2025-08-31 16:14:00'),
(11, 'PRD006', 'Tepung', 1, '1756631661_b9784c0ec3fe91f9342e.jpg', NULL, '2', '2025-08-31 16:14:21'),
(12, 'PRD007', 'Kecap', 2, '1756631819_640efb6250038387ca08.jpg', NULL, '1', '2025-08-31 16:14:48'),
(13, 'PRD008', 'Garam', 2, '1756631707_5f7c44068c5b8c0e05d3.jpg', NULL, '2', '2025-08-31 16:15:07'),
(14, 'PRD009', 'Air Galon', 2, '1756631724_d8293b19a96e1095eb74.jpg', NULL, '3', '2025-08-31 16:15:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1755098153, 1),
(2, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1756493326, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stockmanajement`
--

CREATE TABLE `stockmanajement` (
  `StockManajementID` int(11) NOT NULL,
  `ProductCode` varchar(100) NOT NULL,
  `Qty` varchar(255) NOT NULL,
  `DateInput` datetime NOT NULL,
  `TypeStock` int(10) NOT NULL COMMENT '1 = Keluar, 2 = Masuk',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stockmanajement`
--

INSERT INTO `stockmanajement` (`StockManajementID`, `ProductCode`, `Qty`, `DateInput`, `TypeStock`, `created_at`) VALUES
(1, 'PRD001', '5', '2025-08-30 14:58:33', 2, '2025-08-30 14:58:33'),
(2, 'PRD001', '10', '2025-08-30 14:59:06', 1, '2025-08-30 14:59:06'),
(3, 'PRD002', '15', '2025-08-30 15:23:45', 2, '2025-08-30 15:23:45'),
(4, 'PRD002', '7', '2025-08-30 15:24:07', 1, '2025-08-30 15:24:07'),
(5, 'PRD002', '3', '2025-08-30 15:24:39', 1, '2025-08-30 15:24:39'),
(6, 'PRD001', '4', '2025-08-30 15:24:55', 1, '2025-08-30 15:24:55'),
(7, 'PRD002', '2', '2025-08-31 20:25:11', 1, '2025-08-31 20:25:11'),
(8, 'PRD002', '5', '2025-08-31 20:25:29', 2, '2025-08-31 20:25:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userlogin`
--

CREATE TABLE `userlogin` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@mail.com', 'admin', '$2y$10$s0rG.d.layk4IYWwfT.N3e6NJU7NNdALw.HzQM1o5eX6Lr0ITopve', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 01:49:10', '2025-08-30 01:49:10', NULL),
(2, 'adm@gmail.com', 'admadmin', '$2y$10$L48NiJLXErbUEgEHdgne6O9SV0wWFulP7SCW0.026fWCMhI8oB2zW', NULL, NULL, NULL, 'cc60d448e8219f687addc0923898648f', NULL, NULL, 0, 0, '2025-08-30 12:32:30', '2025-08-30 12:32:30', NULL),
(3, 'admin@gmail.com', 'admadmin22', '$2y$10$y2zZAcjCOpVQ7i.C3TNzPuifPyUZ237vRzXsfpHvKfKFPzkndKTc.', NULL, NULL, NULL, '3abb0c04108cecc92ffee18b9f93694c', NULL, NULL, 0, 0, '2025-08-30 12:34:26', '2025-08-30 12:34:26', NULL),
(4, 'adm@gmain.com', 'admingg', '$2y$10$s0rG.d.layk4IYWwfT.N3e6NJU7NNdALw.HzQM1o5eX6Lr0ITopve', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 12:40:21', '2025-08-30 12:40:21', NULL),
(5, NULL, 'user12', 'user!', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 16:27:53', '2025-08-30 17:48:33', '2025-08-30 17:48:33'),
(6, NULL, 'user2', '$2y$10$O.M.yMlqfxHNTU2j/VqWWezo66a/pWSmdwWhois1RUm0iLVc/yrpC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 16:29:44', '2025-08-30 17:48:30', '2025-08-30 17:48:30'),
(7, NULL, 'bayu', '$2y$10$0/gtLhC6r7ctn3Of4JPyp.DVmtNBacAksArBqFfC5SScgE.Wp97WK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 17:00:38', '2025-08-30 17:48:25', '2025-08-30 17:48:25'),
(8, NULL, 'bayu12', '$2y$10$s0rG.d.layk4IYWwfT.N3e6NJU7NNdALw.HzQM1o5eX6Lr0ITopve', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-08-30 17:49:49', '2025-08-30 17:49:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `listproduct`
--
ALTER TABLE `listproduct`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stockmanajement`
--
ALTER TABLE `stockmanajement`
  ADD PRIMARY KEY (`StockManajementID`);

--
-- Indeks untuk tabel `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`UserID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `listproduct`
--
ALTER TABLE `listproduct`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stockmanajement`
--
ALTER TABLE `stockmanajement`
  MODIFY `StockManajementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
