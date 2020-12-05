-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 04:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jsea`
--

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
-- Table structure for table `md_email`
--

CREATE TABLE `md_email` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `np` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `md_email`
--

INSERT INTO `md_email` (`id`, `np`, `nama`, `email`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, '7776', 'Anas Rachmadi', 'anasrp04@gmail.com', 'pengadaan', NULL, NULL),
(2, '7777', 'arif yulianto', 'ti2018peruri@gmail.com', 'k3', '2020-11-06 17:00:00', NULL),
(23, '7780', 'Wahyu', 'anasrp08@gmail.com', 'k3', '2020-11-23 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_kriteria`
--

CREATE TABLE `md_kriteria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `md_kriteria`
--

INSERT INTO `md_kriteria` (`id`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Pelaksanaan Pekerjaan', NULL, NULL, NULL),
(2, 'Alat Pelindung Diri', NULL, NULL, NULL),
(3, 'Peralatan Pekerjaan', NULL, NULL, NULL),
(4, 'Bahan/Material', NULL, NULL, NULL),
(5, 'Urutan Pelaksanaan Pekerjaan', NULL, NULL, NULL),
(6, 'Bahaya - Resiko / Aspek - Dampak', NULL, NULL, NULL),
(7, 'Tindakan Pengendalian', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_no_jsea`
--

CREATE TABLE `md_no_jsea` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_jsea` int(11) NOT NULL,
  `seksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bulang` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `md_no_jsea`
--

INSERT INTO `md_no_jsea` (`id`, `no_jsea`, `seksi`, `bulang`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 10, NULL, 2, 2020, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_status`
--

CREATE TABLE `md_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `md_status`
--

INSERT INTO `md_status` (`id`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Permohonan Review', NULL, NULL, NULL),
(2, 'Save', NULL, NULL, NULL),
(3, 'JSEA Diterima', NULL, NULL, NULL),
(4, 'Evaluasi Selesai', NULL, NULL, NULL),
(5, 'Dikirim ke Pengadaan', NULL, NULL, NULL),
(6, 'Diterima Pengadaan', NULL, NULL, NULL);

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
(26, '2014_10_12_000000_create_users_table', 1),
(27, '2014_10_12_100000_create_password_resets_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2020_01_30_054846_laratrust_setup_tables', 1),
(31, '2020_10_05_040009_create_md_no_jsea', 2),
(45, '2020_10_20_043142_create_md_kriteria', 2),
(46, '2020_10_20_043153_create_md_status', 2),
(62, '2020_11_02_002901_create_md_email', 2),
(71, '2020_10_05_035409_create_tr_daftar_jsea', 3),
(72, '2020_10_05_040021_create_tr_evaluasi_jsea', 3),
(73, '2020_10_05_040319_create_tr_status_jsea', 3),
(74, '2020_11_24_063615_create_tbl_history', 3);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', NULL, '2020-10-15 20:21:49', '2020-10-15 20:21:49'),
(2, 'pengadaan', 'Pengadaan', NULL, '2020-10-15 20:21:50', '2020-10-15 20:21:50'),
(3, 'unit k3', 'Unit K3', NULL, '2020-10-15 20:21:50', '2020-10-15 20:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\User'),
(2, 2, 'App\\User'),
(3, 3, 'App\\User');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_history`
--

CREATE TABLE `tbl_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_daftar` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `np` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_daftar_jsea`
--

CREATE TABLE `tr_daftar_jsea` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_pr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_tender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_sppj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_jsea` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_sppj` date DEFAULT NULL,
  `path_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_upload` date DEFAULT NULL,
  `desc_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_vendor` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_tender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_vendor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_review` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pekerjaan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_tender` date DEFAULT NULL,
  `tgl_updtender` date DEFAULT NULL,
  `tgl_review` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_daftar_jsea`
--

INSERT INTO `tr_daftar_jsea` (`id`, `id_tender`, `no_pr`, `no_tender`, `no_sppj`, `no_jsea`, `tgl_sppj`, `path_file`, `file_name`, `tgl_upload`, `desc_file`, `id_vendor`, `vendor`, `status_tender`, `status_vendor`, `status_review`, `nama_pekerjaan`, `updated_by`, `tgl_tender`, `tgl_updtender`, `tgl_review`, `created_at`, `updated_at`) VALUES
(1, 'cd58ba59-fd41-4b6e-9342-e7b140aa6391', '0013000720', 'PLJ/2020/00251', '0013000720', '005/JSEA/XI/2020', '2020-10-28', 'file/File Jsea/2020/Perbedaan UU Ketenagakerjaan dengan RUU Omnibus Law Cipta Kerja (1).pdf', 'PLJ 2020 00251.zip', '2020-10-28', 'Terlampir', '41412725-c0b7-44e4-b0f7-da345bae2527', 'PURI GIRI SENTOSA', 'FINISHED', 'AWARDED', '6', 'JASA KEPABEANAN DAN PENGANGKUTAN UNTUK PESANAN 11.000 BUAH PLYWOOD BOX EXPAX-P', 'pengadaan@jseaperuri', '2020-10-28', '2020-10-28', NULL, '2020-11-28 17:00:00', '2020-11-28 17:00:00'),
(2, 'c034439f-ee2f-4738-9c44-59261e206483', '0013000722', 'PLJ/2020/00255', '0013000722', '006/JSEA/XII/2020', '2020-11-06', 'file/File Jsea/2020/tes.pdf', 'PLJ 2020 00255.zip', '2020-11-06', 'Terlampir', '70717f1f-6ede-4822-b891-b07407b4df0e', 'JANATRA MULKI ABADI', 'FINISHED', 'AWARDED', '6', 'JASA PENAMBAHAN DAN INTEGRASI 1 (SATU) UNIT COMPRESSOR HIGH PRESSURE RUANG CENTRAL COMPRESSOR', 'pengadaan@jseaperuri', '2020-11-06', '2020-11-06', NULL, '2020-12-01 17:00:00', '2020-12-01 17:00:00'),
(3, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', '0013000696', 'PLJ/2020/00249', '0013000696', '007/JSEA/XII/2020', '2020-10-23', 'file/File Jsea/2020/tes.pdf', 'PLJ 2020 00249.zip', '2020-10-23', 'terlampir', 'b664e7b7-50f5-464d-a581-50bd0de0f2bc', 'MULTI ERAGUNA USAHA', 'FINISHED', 'AWARDED', '6', 'JASA RENOVASI RUANG KANTOR CERA LINI A', 'pengadaan@jseaperuri', '2020-10-23', '2020-10-23', NULL, '2020-12-01 17:00:00', '2020-12-01 17:00:00'),
(4, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', '0013000698', 'PLJ/2020/00247', '0013000698', '008/JSEA/XII/2020', '2020-10-20', 'file/File Jsea/2020/JSEA - PLJ 2020 00247.pdf', 'PLJ 2020 00247.zip', '2020-10-20', 'Terlampir', 'eefd2f52-43f2-42db-88ca-976b9ea350e1', 'HARYA JAYA', 'FINISHED', 'AWARDED', '4', 'JASA RENOVASI RUANG ARSIP DI GEDUNG DEPARTEMEN PENGADAAN PERUM PERURI', 'pengadaan@jseaperuri', '2020-10-20', '2020-10-20', NULL, '2020-12-01 17:00:00', '2020-12-01 17:00:00'),
(5, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', '0013000697', 'PLJ/2020/00246', '0013000697', '009/JSEA/XII/2020', '2020-10-19', 'file/File Jsea/2020/e. JSEA - PEKERJAAN RENOVASI RUANG RAPAT VIDEO CONFERENCE DEP BANG TI.pdf', 'PLJ 2020 00246.zip', '2020-10-19', 'Terlampir', 'b664e7b7-50f5-464d-a581-50bd0de0f2bc', 'MULTI ERAGUNA USAHA', 'FINISHED', 'AWARDED', '2', 'JASA PEKERJAAN PEMBUATAN RUANG VIDEO CONFERENCE DEPARTEMEN BANG TI PERURI KARAWANG', 'pengadaan@jseaperuri', '2020-10-19', '2020-10-19', NULL, '2020-12-01 17:00:00', '2020-12-01 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tr_evaluasi_jsea`
--

CREATE TABLE `tr_evaluasi_jsea` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_daftar` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `np` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_evaluasi_jsea`
--

INSERT INTO `tr_evaluasi_jsea` (`id`, `id_tender`, `id_daftar`, `catatan`, `kriteria`, `status`, `created_by`, `np`, `created_at`, `updated_at`) VALUES
(1, 'cd58ba59-fd41-4b6e-9342-e7b140aa6391', 1, '-', '-', '3', 'anas', '7776', '2020-11-28 17:00:00', NULL),
(2, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba&nbsp;</li></ol>', '1', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(3, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba</li></ol>', '2', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(4, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba2</li></ol>', '3', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(5, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba4</li></ol>', '4', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(6, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba1</li></ol>', '5', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(7, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba</li></ol>', '6', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(8, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba3</li></ol>', '7', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(9, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba&nbsp;</li></ol>', '1', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(10, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba</li></ol>', '2', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(11, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba2</li></ol>', '3', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(12, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba4</li></ol>', '4', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(13, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba1</li></ol>', '5', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(14, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba</li></ol>', '6', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(15, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '<ol><li>coba3</li></ol>', '7', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(16, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba1</li></ol>', '1', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(17, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba3</li></ol>', '2', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(18, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>cob5</li></ol>', '3', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(19, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<p><br></p>', '4', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(20, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba2</li></ol>', '5', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(21, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba</li></ol>', '6', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(22, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<div><br></div>', '7', '2', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(23, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba1</li></ol>', '1', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(24, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba3</li></ol>', '2', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(25, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>cob5</li></ol>', '3', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(26, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba7</li></ol>', '4', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(27, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba2</li></ol>', '5', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(28, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>coba</li></ol>', '6', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(29, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '<ol><li>cob6</li></ol>', '7', '4', 'anas rachmadi', '7776', '2020-12-01 17:00:00', NULL),
(30, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>Belum&nbsp;</li></ol>', '1', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(31, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>bekjksfhsdfh</li></ol>', '2', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(32, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>jhgfdighfiodg</li><li>dfhifywd</li><li>dfhwiery</li><li><br></li></ol>', '3', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(33, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>fhgwuryu</li><li>jupen</li></ol>', '4', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(34, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>belum</li></ol>', '5', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(35, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<p>wifibsjkbfsf</p>', '6', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(36, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '<ol><li>dfhyeerhe</li><li>13563</li><li>efhweuoere</li></ol>', '7', '4', 'Jupentinus S', '7639', '2020-12-01 17:00:00', NULL),
(37, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '<p>dhgfudifg</p>', '1', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(38, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '<p>gfg</p>', '2', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(39, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '<ol><li>dgrggdfh</li></ol>', '3', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(40, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '-', '4', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(41, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '-', '5', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(42, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '-', '6', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL),
(43, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '-', '7', '2', 'jupen', '7639', '2020-12-01 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tr_status_jsea`
--

CREATE TABLE `tr_status_jsea` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_tender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_daftar` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tr_status_jsea`
--

INSERT INTO `tr_status_jsea` (`id`, `id_tender`, `id_daftar`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'cd58ba59-fd41-4b6e-9342-e7b140aa6391', 1, '6', 'pengadaan@jseaperuri', NULL, '2020-11-28 17:00:00'),
(2, 'c034439f-ee2f-4738-9c44-59261e206483', 2, '6', 'pengadaan@jseaperuri', NULL, '2020-12-01 17:00:00'),
(3, '43d0b0a7-341b-4240-a8d8-bb8e01007bc8', 3, '6', 'pengadaan@jseaperuri', NULL, '2020-12-01 17:00:00'),
(4, 'f091e658-46a3-4d40-9203-6561b4d5d2c1', 4, '4', 'pengadaan@jseaperuri', NULL, '2020-12-01 17:00:00'),
(5, '7a2b8c7d-e74d-47ba-aa65-513e56fe1c8d', 5, '2', 'pengadaan@jseaperuri', NULL, '2020-12-01 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `is_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@jseaperuri', 'admin_avatar.jpg', NULL, '$2y$10$DVrj7u4d9Fovxk0snvN4Ne6huQa186/sDkneZDH/DBTk1MxrG7/ue', 1, NULL, '2020-10-15 20:21:50', '2020-10-15 20:21:50'),
(2, 'Pengadaan', 'pengadaan@jseaperuri', 'operator_avatar.png', NULL, '$2y$10$M5kdsudyA0eU7FNLo8h.R.QpKJjTjmAEmG2cTKitAygxAkjZQ4dbu', 1, NULL, '2020-10-15 20:21:50', '2020-10-15 20:21:50'),
(3, 'Unit K3', 'unitk3@jseaperuri', 'operator_avatar.png', NULL, '$2y$10$UTdIphvrOhtkJdZf6zE8b.Kl7xNQ3Qz0p.z/XmtyaGn5s/u29ONym', 1, NULL, '2020-10-15 20:21:50', '2020-10-15 20:21:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_email`
--
ALTER TABLE `md_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_kriteria`
--
ALTER TABLE `md_kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_no_jsea`
--
ALTER TABLE `md_no_jsea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `md_status`
--
ALTER TABLE `md_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_history_id_daftar_foreign` (`id_daftar`);

--
-- Indexes for table `tr_daftar_jsea`
--
ALTER TABLE `tr_daftar_jsea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_evaluasi_jsea`
--
ALTER TABLE `tr_evaluasi_jsea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tr_evaluasi_jsea_id_daftar_foreign` (`id_daftar`);

--
-- Indexes for table `tr_status_jsea`
--
ALTER TABLE `tr_status_jsea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tr_status_jsea_id_daftar_foreign` (`id_daftar`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `md_email`
--
ALTER TABLE `md_email`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `md_kriteria`
--
ALTER TABLE `md_kriteria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `md_no_jsea`
--
ALTER TABLE `md_no_jsea`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `md_status`
--
ALTER TABLE `md_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_history`
--
ALTER TABLE `tbl_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_daftar_jsea`
--
ALTER TABLE `tr_daftar_jsea`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tr_evaluasi_jsea`
--
ALTER TABLE `tr_evaluasi_jsea`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tr_status_jsea`
--
ALTER TABLE `tr_status_jsea`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_history`
--
ALTER TABLE `tbl_history`
  ADD CONSTRAINT `tbl_history_id_daftar_foreign` FOREIGN KEY (`id_daftar`) REFERENCES `tr_daftar_jsea` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tr_evaluasi_jsea`
--
ALTER TABLE `tr_evaluasi_jsea`
  ADD CONSTRAINT `tr_evaluasi_jsea_id_daftar_foreign` FOREIGN KEY (`id_daftar`) REFERENCES `tr_daftar_jsea` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tr_status_jsea`
--
ALTER TABLE `tr_status_jsea`
  ADD CONSTRAINT `tr_status_jsea_id_daftar_foreign` FOREIGN KEY (`id_daftar`) REFERENCES `tr_daftar_jsea` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
