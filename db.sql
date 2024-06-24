-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 07:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `htmlaundry-restapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(3, 'pegawai', 'pegawai html');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(3, 3),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 4),
(3, 5),
(3, 6),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin@html.com', 3, '2024-03-08 12:25:07', 0),
(2, '::1', 'admin@html.id', 4, '2024-03-08 12:26:41', 1),
(3, '::1', 'admin@html.id', 4, '2024-03-08 12:31:58', 1),
(4, '::1', 'admin@html.id', 4, '2024-03-08 12:37:48', 1),
(5, '::1', 'admin@html.id', 4, '2024-03-08 12:42:47', 1),
(6, '::1', 'admin@html.id', 4, '2024-03-08 12:43:23', 1),
(7, '::1', 'admin@html.id', 4, '2024-03-08 14:50:31', 1),
(8, '::1', 'admin@html.id', 4, '2024-03-09 07:41:17', 1),
(9, '::1', 'admin@html.id', 4, '2024-03-09 08:00:09', 1),
(10, '::1', 'admin@html.id', 4, '2024-03-11 11:03:35', 1),
(11, '::1', 'admin@html.id', 4, '2024-03-11 11:12:21', 1),
(12, '::1', 'mita', NULL, '2024-03-11 11:17:14', 0),
(13, '::1', 'mita', NULL, '2024-03-11 11:17:39', 0),
(14, '::1', 'admin@html.id', 4, '2024-03-12 03:20:32', 1),
(15, '::1', 'admin@html.id', NULL, '2024-03-12 03:41:41', 0),
(16, '::1', 'admin@html.id', 4, '2024-03-12 03:41:52', 1),
(17, '::1', 'admin@html.id', 4, '2024-03-12 03:42:38', 1),
(18, '::1', 'admin@html.id', 4, '2024-03-12 03:42:59', 1),
(19, '::1', 'Roza@html.id', 6, '2024-03-12 03:47:05', 1),
(20, '::1', 'Roza@html.id', 6, '2024-03-12 03:52:59', 1),
(21, '::1', 'Roza@html.id', 6, '2024-03-12 04:02:08', 1),
(22, '::1', 'Roza@html.id', NULL, '2024-03-12 04:11:45', 0),
(23, '::1', 'Roza@html.id', 6, '2024-03-12 04:11:55', 1),
(24, '::1', 'miftahul.ajmy22@gmail.com', NULL, '2024-03-12 04:12:08', 0),
(25, '::1', 'mita', NULL, '2024-03-12 04:12:20', 0),
(26, '::1', 'mita', NULL, '2024-03-12 04:12:30', 0),
(27, '::1', 'admin@html.id', 4, '2024-03-12 04:15:05', 1),
(28, '::1', 'Roza@html.id', 6, '2024-03-12 04:15:20', 1),
(29, '::1', 'admin@html.id', 4, '2024-03-12 05:13:23', 1),
(30, '::1', 'admin@html.id', 4, '2024-03-12 05:35:15', 1),
(31, '::1', 'admin@html.id', 4, '2024-03-12 12:33:18', 1),
(32, '::1', 'admin@html.id', 4, '2024-03-13 02:05:36', 1),
(33, '::1', 'admin@html.id', 4, '2024-03-13 06:22:56', 1),
(34, '::1', 'admin@html.id', 4, '2024-03-13 07:13:44', 1),
(35, '::1', 'roza@html.id', 6, '2024-03-13 07:13:54', 1),
(36, '::1', 'admin@html.id', 4, '2024-03-13 07:35:05', 1),
(37, '::1', 'admin@html.id', 4, '2024-03-13 07:49:02', 1),
(38, '::1', 'roza@html.id', 6, '2024-03-13 07:50:37', 1),
(39, '::1', 'admin@html.id', 4, '2024-03-13 08:40:38', 1),
(40, '::1', 'admin@html.id', 4, '2024-03-13 08:40:55', 1),
(41, '::1', 'admin@html.id', NULL, '2024-03-14 00:48:37', 0),
(42, '::1', 'admin@html.id', 4, '2024-03-14 00:48:44', 1),
(43, '::1', 'admin@html.id', 4, '2024-03-14 06:34:51', 1),
(44, '::1', 'admin@html.id', 4, '2024-03-15 15:51:23', 1),
(45, '::1', 'admin@html.id', 4, '2024-03-16 03:57:23', 1),
(46, '::1', 'admin@html.id', 4, '2024-03-17 04:30:21', 1),
(47, '::1', 'admin@html.id', 4, '2024-03-17 15:30:08', 1),
(48, '::1', 'admin@html.id', 4, '2024-03-18 15:46:01', 1),
(49, '::1', 'admin@html.id', 4, '2024-03-19 03:53:55', 1),
(50, '::1', 'admin@html.id', 4, '2024-03-19 06:51:23', 1),
(51, '::1', 'roza@html.id', 6, '2024-03-19 15:09:15', 1),
(52, '::1', 'admin@html.id', 4, '2024-03-19 15:37:50', 1),
(53, '::1', 'admin@html.id', 4, '2024-03-21 05:00:00', 1),
(54, '::1', 'luke@gmail.com', 7, '2024-03-21 05:05:51', 1),
(55, '::1', 'admin@html.id', 4, '2024-03-23 03:40:56', 1),
(56, '::1', 'roza@html.id', 6, '2024-03-23 06:15:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-pegawai', 'manage all data pegawai'),
(2, 'delete-transaction', 'delete transaction'),
(3, 'manage-pelanggan', 'manage all data pelangan'),
(4, 'manage-transaction', 'insert update transaction'),
(5, 'manage-pelanggan', 'manage all data pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenislayanan`
--

CREATE TABLE `jenislayanan` (
  `id_layanan` int(5) UNSIGNED NOT NULL,
  `nama_layanan` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `waktu_pengerjaan` varchar(50) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jenislayanan`
--

INSERT INTO `jenislayanan` (`id_layanan`, `nama_layanan`, `harga`, `waktu_pengerjaan`, `gambar`, `created_at`, `updated_at`) VALUES
(5, 'cuci', '3000', '3 hari', '', '2024-02-13 11:03:01', '2024-02-13 11:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-12-08-073807', 'App\\Database\\Migrations\\Pegawai', 'default', 'App', 1702459392, 1),
(2, '2023-12-08-073811', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1702459392, 1),
(3, '2023-12-08-073902', 'App\\Database\\Migrations\\JenisLayanan', 'default', 'App', 1702459921, 2),
(4, '2023-12-13-093246', 'App\\Database\\Migrations\\AntarJemput', 'default', 'App', 1702460027, 3),
(5, '2023-12-13-093357', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1702460081, 4),
(7, '2023-12-14-091828', 'App\\Database\\Migrations\\TransaksiLayanan', 'default', 'App', 1702546286, 5),
(19, '2023-12-14-093157', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1702724061, 6),
(20, '2023-12-14-144529', 'App\\Database\\Migrations\\CreateTransaksiLayanan', 'default', 'App', 1702724061, 6),
(21, '2024-03-05-014259', 'App\\Database\\Migrations\\CreateTransaksiLayanan', 'default', 'App', 1709603069, 7),
(22, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1709780879, 8);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(5) UNSIGNED NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `alamat` varchar(14) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `email`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(16, 'mito', 'miftahul.ajmy22@gmail.com', '085342908109', 'rumbai', '2024-03-12 12:46:33', '2024-03-12 12:46:33'),
(17, 'yuli', 'miftahul.ajmy22@gmail.com', '085342908109', 'rumbai', '2024-03-12 12:48:30', '2024-03-12 12:48:30'),
(19, 'roza', 'asasas@gmail.com', '2 hari', '444', '2024-03-12 13:42:10', '2024-03-12 13:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(5) UNSIGNED NOT NULL,
  `nama` varchar(55) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `no_hp`, `alamat`, `password`, `username`, `gambar`, `created_at`, `updated_at`) VALUES
(11, 'miftahul ajmy', '085342908109', 'rumbai', '$2y$10$P3s', 'mita', '', '2024-03-15 16:05:42', '2024-03-15 16:05:42'),
(12, 'Ahmad Rafiqi', '085342908109', 'rumbai ', '$2y$10$p18', 'Rafi', '', '2024-03-17 04:48:09', '2024-03-17 04:48:09'),
(13, 'Haluke Aberta', '0845454545', 'rumbai ', '$2y$10$RGu', 'luke', '', '2024-03-21 05:01:48', '2024-03-21 05:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `temp_transaksilayanan`
--

CREATE TABLE `temp_transaksilayanan` (
  `id` int(5) NOT NULL,
  `nota` int(5) NOT NULL,
  `layanan` int(5) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `subtotal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(5) UNSIGNED NOT NULL,
  `id_pegawai` int(5) UNSIGNED NOT NULL,
  `id_pelanggan` int(5) UNSIGNED NOT NULL,
  `total_biaya` decimal(14,2) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_bayar` varchar(50) NOT NULL,
  `keluhan` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_layanan`
--

CREATE TABLE `transaksi_layanan` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_transaksi` int(5) UNSIGNED NOT NULL,
  `id_layanan` int(5) UNSIGNED NOT NULL,
  `qty` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `groups` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `groups`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'admin@html.id', 'admin', 'admin', '$2y$10$QcHvRC8BM7xY1/XjCpnh/u8ctkzmTh0OBDHpAeeRAFZ73Fq6n9/PC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-08 12:26:30', '2024-03-08 12:26:30', NULL),
(5, 'miftahul.ajmy22@gmail.com', 'mita', '0', '$2y$10$LTimrr1PG5YNcNUKSb97qOXoITtW36JXRueSGTzbLenBkjenuWYI.', '4f48cf03fba4de42b6411b353ae0211d', NULL, '2024-03-11 12:17:23', NULL, NULL, NULL, 1, 0, '2024-03-08 14:43:26', '2024-03-11 11:17:23', NULL),
(6, 'roza@html.id', 'Roza', 'Pegawai', '$2y$10$jx6c6ha5Ifka.qylN2onPemhHagcQ9st.BJk2/JkKN.Gdh0Jb5Tj2', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-12 03:46:53', '2024-03-12 03:46:53', NULL),
(7, 'luke@gmail.com', 'luke', '', '$2y$10$fh11Y7aTdoh0Pjn86/9FRepbyzsgtyNKUHphiowT042FuXuOTpa0e', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-13 07:20:00', '2024-03-13 07:20:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `jenislayanan`
--
ALTER TABLE `jenislayanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `temp_transaksilayanan`
--
ALTER TABLE `temp_transaksilayanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_pegawai_foreign` (`id_pegawai`),
  ADD KEY `transaksi_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indexes for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_layanan_id_transaksi_foreign` (`id_transaksi`),
  ADD KEY `transaksi_layanan_id_layanan_foreign` (`id_layanan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenislayanan`
--
ALTER TABLE `jenislayanan`
  MODIFY `id_layanan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `temp_transaksilayanan`
--
ALTER TABLE `temp_transaksilayanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`),
  ADD CONSTRAINT `transaksi_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
  ADD CONSTRAINT `transaksi_layanan_id_layanan_foreign` FOREIGN KEY (`id_layanan`) REFERENCES `jenislayanan` (`id_layanan`),
  ADD CONSTRAINT `transaksi_layanan_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
