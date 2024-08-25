-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2024 at 01:33 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_sibakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kepegawaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint UNSIGNED NOT NULL,
  `kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waktu_pelaksanaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akunkeuangan`
--

CREATE TABLE `akunkeuangan` (
  `id` bigint UNSIGNED NOT NULL,
  `uraian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int NOT NULL,
  `sifat` enum('D','K') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `kelompok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `jenis_akun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akunkeuangan`
--

INSERT INTO `akunkeuangan` (`id`, `uraian`, `kode`, `level`, `sifat`, `kelompok`, `status`, `jenis_akun`, `created_at`, `updated_at`) VALUES
(1, 'Kewajiban', '2', 1, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(2, 'Saldo Dana', '3', 1, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(3, 'Penerimaan', '4', 1, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(4, 'Penyaluran Dana', '5', 1, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(5, 'Aset Lancar', '1.1', 2, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(6, 'Aset Tidak Lancar', '1.2', 2, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(7, 'Kewajiban Jangka Pendek', '2.1', 2, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(8, 'Saldo Dana Zakat', '3.1', 2, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(9, 'Saldo Dana Infaq/Sedekah', '3.2', 2, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(10, 'Saldo Dana Amil', '3.3', 2, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(11, 'Saldo Dana Hibah', '3.5', 2, 'K', 'NR', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:24:23'),
(12, 'Saldo Dana Non Syariah', '3.6', 2, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(13, 'Penerimaan Dana Zakat', '4.1', 2, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(14, 'Penerimaan Dana Infaq/Sedekah', '4.2', 2, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(15, 'Penerimaan Dana Amil', '4.3', 2, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(16, 'Penerimaan Dana Hibah', '4.5', 2, 'K', 'LRA', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:18:26'),
(17, 'Penerimaan Dana Jasa Giro', '4.6', 2, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(18, 'Penyaluran Dana Zakat', '5.1', 2, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(19, 'Penyaluran Dana Infaq/Sedekah', '5.2', 2, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(20, 'Penggunaan Dana Amil', '5.3', 2, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(21, 'Penggunaan Dana APBN/APBD', '5.5', 2, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(22, 'Penyaluran Dana Jasa Giro', '5.6', 2, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(23, 'Kas Setara Kas', '1.1.01', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(24, 'Persediaan', '1.1.02', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(25, 'Piutang', '1.1.04', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(26, 'Uang Muka', '1.1.06', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(27, 'Aset Tetap', '1.2.01', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(28, 'Akumulasi Penyusutan Aset Tetap', '1.2.02', 3, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(29, 'Utang Penyaluran', '2.1.01', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(30, 'Utang Pihak Ketiga', '2.1.02', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(31, 'Saldo Dana Zakat', '3.1.01', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(32, 'Saldo Dana Infaq/Sedekah', '3.2.01', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(33, 'Saldo Dana Amil', '3.3.01', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(34, 'Saldo Dana Hibah', '3.5.01', 3, 'K', 'NR', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:24:40'),
(35, 'Saldo Dana Non Syariah', '3.6.01', 3, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(36, 'Penerimaan Zakat Entitas', '4.1.01', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(37, 'Penerimaan Zakat Individual', '4.1.02', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(38, 'Penerimaan Dana IST', '4.2.01', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(39, 'Penerimaan Dana ISTT', '4.2.02', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(40, 'Bagian Amil dari Dana Zakat', '4.3.01', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(41, 'Bagian Amil dari Dana Infaq', '4.3.02', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(42, 'Penerimaan Lain', '4.3.99', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(43, 'Penerimaan Dana Hibah', '4.5.01', 3, 'K', 'LRA', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:18:59'),
(44, 'Penerimaan Dana Jasa Giro', '4.6.01', 3, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(45, 'Penyaluran Dana Zakat untuk Amil', '5.1.01', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(46, 'Penyaluran Dana Zakat untuk Fakir', '5.1.02', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(47, 'Penyaluran Dana Zakat Riqob', '5.1.03', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(48, 'Penyaluran Dana Zakat Gharimin', '5.1.04', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(49, 'Penyaluran Dana Zakat Muallaf', '5.1.05', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(50, 'Penyaluran Dana Zakat Fisabilillah', '5.1.06', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(51, 'Penyaluran Dana Zakat Ibnu Sabil', '5.1.07', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(52, 'Penyaluran Dana Zakat Miskin', '5.1.99', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(53, 'Penyaluran Dana Infaq/Sedekah untuk Amil', '5.2.01', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(54, 'Penyaluran Infaq/Sedekah Terikat', '5.2.02', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(55, 'Penyaluran Infaq/Sedekah Tidak Terikat', '5.2.03', 3, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(56, 'Belanja Pegawai', '5.3.01', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(57, 'Belanja Publikasi dan Dokumentasi', '5.3.02', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(58, 'Belanja Perjalanan Dinas', '5.3.03', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(59, 'Belanja Umum dan Administrasi Lain', '5.3.04', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(60, 'Beban Penyusutan', '5.3.05', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(61, 'Penggunaan Lain-Lain', '5.3.06', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(62, 'Belanja Jasa Pihak Ketiga', '5.3.07', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(63, 'Pengadaan Aset Tetap', '5.3.08', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(64, 'Penggunaan APBN/APBD', '5.5.01', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(65, 'Penyaluran Dana Jasa Giro', '5.6.01', 3, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(66, 'Kas Kecil', '1.1.01.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(67, 'Kas Bank', '1.1.01.02', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(68, 'Persediaan Barang', '1.1.02.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(69, 'Piutang', '1.1.04.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(70, 'Uang Muka Pembayaran', '1.1.06.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(71, 'Aset Tetap', '1.2.01.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(72, 'Akumulasi Penyusutan Aset Tetap', '1.2.02.01', 4, 'D', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(73, 'Utang Penyaluran', '2.1.01.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(74, 'Utang Bank', '2.1.02.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(75, 'Utang Pihak Lain', '2.1.02.02', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(76, 'Kewaijban Jangka Pendek Lain', '2.1.02.03', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(77, 'Saldo Dana Zakat', '3.1.01.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(78, 'Saldo Dana Infaq/Sedekah', '3.2.01.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(79, 'Saldo Dana Amil', '3.3.01.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(80, 'Saldo Dana Hibah', '3.5.01.01', 4, 'K', 'NR', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:24:55'),
(81, 'Saldo Dana Non Syariah', '3.6.01.01', 4, 'K', 'NR', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(82, 'Penerimaan Zakat Entitas', '4.1.01.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(83, 'Penerimaan Zakat Individual', '4.1.02.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(84, 'Penerimaan Dana IST', '4.2.01.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(85, 'Penerimaan Dana ISTT', '4.2.02.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(86, 'Bagian Amil dari Dana Zakat Maal', '4.3.01.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(87, 'Bagian Amil dari Dana Infaq', '4.3.02.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(88, 'Penerimaan Lain', '4.3.99.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(89, 'Penerimaan Dana Hibah', '4.5.01.01', 4, 'K', 'LRA', 'A', 'KAS', '2024-03-11 06:40:51', '2024-06-05 09:19:25'),
(90, 'Penerimaan Dana Jasa Giro', '4.6.01.01', 4, 'K', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(91, 'Penyaluran Dana Zakat untuk Amil', '5.1.01.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(92, 'Penyaluran Dana Zakat Fakir-Klaten Cerdas', '5.1.02.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(93, 'Penyaluran Dana Zakat Fakir-Klaten Peduli', '5.1.02.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(94, 'Penyaluran Dana Zakat Fakir-Klaten Makmur', '5.1.02.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(95, 'Penyaluran Dana Zakat Fakir-Klaten Taqwa', '5.1.02.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(96, 'Penyaluran Dana Zakat Fakir-Klaten Sehat', '5.1.02.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(97, 'Zakat Riqob Klaten Cerdas', '5.1.03.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(98, 'Zakat Riqob Klaten Peduli', '5.1.03.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(99, 'Zakat Riqob Klaten Makmur', '5.1.03.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(100, 'Zakat Riqob Klaten Taqwa', '5.1.03.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(101, 'Zakat Riqob Klaten Sehat', '5.1.03.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(102, 'Zakat Gharimin Klaten Cerdas', '5.1.04.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(103, 'Zakat Gharimin Klaten Peduli', '5.1.04.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(104, 'Zakat Gharimin Klaten Makmur', '5.1.04.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(105, 'Zakat Gharimin Klaten Taqwa', '5.1.04.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(106, 'Zakat Gharimin Klaten Sehat', '5.1.04.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(107, 'Zakat Muallaf Klaten Cerdas', '5.1.05.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(108, 'Zakat Muallaf Klaten Peduli', '5.1.05.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(109, 'Zakat Muallaf Klaten Makmur', '5.1.05.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(110, 'Zakat Muallaf Klaten Taqwa', '5.1.05.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(111, 'Zakat Muallaf Klaten Sehat', '5.1.05.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(112, 'Zakat Fisabilillah Klaten Cerdas', '5.1.06.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(113, 'Zakat Fisabilillah Klaten Peduli', '5.1.06.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(114, 'Zakat Fisabilillah Klaten Makmur', '5.1.06.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(115, 'Zakat Fisabilillah Klaten Taqwa', '5.1.06.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(116, 'Zakat Fisabilillah Klaten Sehat', '5.1.06.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(117, 'Zakat Ibnu Sabil Klaten Cerdas', '5.1.07.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(118, 'Zakat Ibnu Sabil Klaten Peduli', '5.1.07.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(119, 'Zakat Ibnu Sabil Klaten Makmur', '5.1.07.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(120, 'Zakat Ibnu Sabil Klaten Taqwa', '5.1.07.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(121, 'Zakat Ibnu Sabil Klaten Sehat', '5.1.07.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(122, 'Zakat Miskin Klaten Cerdas', '5.1.99.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(123, 'Zakat Miskin Klaten Peduli', '5.1.99.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(124, 'Zakat Miskin Klaten Makmur', '5.1.99.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(125, 'Zakat Miskin Klaten Taqwa', '5.1.99.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(126, 'Zakat Miskin Klaten Sehat', '5.1.99.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(127, 'Penyaluran Dana Infaq/Sedekah untuk Amil', '5.2.01.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:51', '2024-03-11 06:40:51'),
(128, 'Infaq Terikat Klaten Cerdas', '5.2.02.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(129, 'Infaq Terikat Klaten Peduli', '5.2.02.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(130, 'Infaq Terikat Klaten Makmur', '5.2.02.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(131, 'Infaq Terikat Klaten Taqwa', '5.2.02.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(132, 'Infaq Terikat Klaten Sehat', '5.2.02.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(133, 'Infaq Tidak Terikat Klaten Cerdas', '5.2.03.01', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(134, 'Infaq Tidak Terikat Klaten Peduli', '5.2.03.02', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(135, 'Infaq Tidak Terikat Klaten Makmur', '5.2.03.03', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(136, 'Infaq Tidak Terikat Klaten Taqwa', '5.2.03.04', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(137, 'Infaq Tidak Terikat Klaten Sehat', '5.2.03.05', 4, 'D', 'LRA', 'A', 'KAS,PROGRAM', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(138, 'Belanja Pegawai', '5.3.01.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(139, 'Belanja Publikasi dan Dokumentasi', '5.3.02.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(140, 'Belanja Perjalanan Dinas', '5.3.03.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(141, 'Belanja Umum dan Administrasi Lain', '5.3.04.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(142, 'Beban Penyusutan Aset Tetap', '5.3.05.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(143, 'Belanja Lain-Lain', '5.3.06.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(144, 'Belanja Jasa Pihak Ketiga', '5.3.07.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(145, 'Pengadaan Aset Tetap', '5.3.08.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(146, 'Penggunaan APBN/APBD', '5.5.01.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(147, 'Penyaluran Dana Jasa Giro dan Non Syariah Lainnya', '5.6.01.01', 4, 'D', 'LRA', 'A', 'KAS,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(148, 'Kas ditangan bendahara', '1.1.01.01.001', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(149, 'kas kecil ditangan pendistribusian', '1.1.01.01.002', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(150, 'kas kecil di bank pendistribusian', '1.1.01.01.003', 5, 'D', 'NR', 'A', 'KAS,VIAPD,VIASDM,SA,VIAPG', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(151, 'kas kecil di tangan sdm umum', '1.1.01.01.004', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(152, 'kas kecil di bank sdm umum', '1.1.01.01.005', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(153, 'kas di tangan bidang pengumpulan', '1.1.01.01.006', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(154, 'Bank Jateng Syariah (6083009791)', '1.1.01.02.001', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(155, 'Bank Jateng (2009068786)', '1.1.01.02.002', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(156, 'Bank Muamalat (5260008076)', '1.1.01.02.003', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(157, 'PD. BPR Bank Klaten (9906000002628)', '1.1.01.02.004', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(158, 'Bank BRI (675001008662538)', '1.1.01.02.005', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(159, 'Bank BSI I (7006242434)', '1.1.01.02.006', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(160, 'Bank BSI II (7339393391)', '1.1.01.02.007', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(161, 'Bank BSI III (7253222632)', '1.1.01.02.008', 5, 'D', 'NR', 'A', 'KAS,VIAPD,VIASDM,SA,VIAPG', '2024-03-11 06:40:52', '2024-04-25 03:03:20'),
(162, 'BPRS Darma Kuwera (1150100562)', '1.1.01.02.009', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(163, 'BPRS Al Mabrur (1220100020)', '1.1.01.02.010', 5, 'D', 'NR', 'A', 'KAS,VIASDM,SA,VIAPD,VIAPG,', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(164, 'Persediaan barang tasaruf', '1.1.02.01.001', 5, 'D', 'NR', 'A', 'KAS,SA,VIAPD,VIAPG,PBPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(165, 'Persediaan BHP Kantor', '1.1.02.01.002', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(166, 'Piutang Distribusi', '1.1.04.01.001', 5, 'D', 'NR', 'A', 'KAS,SA,VIAPD,VIAPG', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(167, 'Piutang Lain Lain', '1.1.04.01.002', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(168, 'Uang Muka Sewa', '1.1.06.01.001', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(169, 'Uang Muka Pembayaran Lainnya', '1.1.06.01.002', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(170, 'Gedung dan Bangunan', '1.2.01.01.001', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(171, 'Kendaraan', '1.2.01.01.002', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(172, 'Aset Lainnya', '1.2.01.01.004', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(173, 'Tanah', '1.2.01.01.005', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(174, 'Akumulasi Penyusutan Gedung dan Bangunan', '1.2.02.01.001', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(175, 'Akumulasi Penyusutan Kendaraan', '1.2.02.01.002', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(176, 'Akumulasi Penyusutan Peralatan dan Mesin', '1.2.02.01.003', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(177, 'Akumulasi Penyusutan Aset Lainnya', '1.2.02.01.004', 5, 'D', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(178, 'Utang Distribusi ZCD', '2.1.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(179, 'Utang Distribusi Baznas Prov', '2.1.01.01.002', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(180, 'Utang Bank A', '2.1.02.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(181, 'Utang Bank B', '2.1.02.01.002', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(182, 'Utang Pihak Lainnya', '2.1.02.02.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(183, 'Kewajiban Lain', '2.1.02.03.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(184, 'Saldo Dana Zakat', '3.1.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(185, 'Saldo Dana Infaq/Sedekah', '3.2.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(186, 'Saldo Dana Amil', '3.3.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(187, 'Saldo Dana Hibah', '3.5.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-06-05 09:25:21'),
(188, 'Saldo Dana Non Syariah', '3.6.01.01.001', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(189, 'Penerimaan Zakat Maal Perusahaan', '4.1.01.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,ZKT', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(190, 'Penerimaan Zakat Maal UPZ', '4.1.02.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,ZKT,zakat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(191, 'Penerimaan Zakat Maal Perorangan', '4.1.02.01.002', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,ZKT', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(192, 'Penerimaan Zakat Fitrah', '4.1.02.01.003', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(193, 'Penerimaan IST Entitas', '4.2.01.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(194, 'Penerimaan IST UPZ', '4.2.01.01.002', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(195, 'Penerimaan IST Perorangan', '4.2.01.01.003', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(196, 'Penerimaan ISTT Entitas', '4.2.02.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(197, 'Penerimaan ISTT UPZ', '4.2.02.01.002', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ,infaq', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(198, 'Penerimaan ISTT Perorangan', '4.2.02.01.003', 5, 'K', 'LRA', 'A', 'KAS,RA,TPG,IFQ', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(199, 'Bagian Amil dari Dana Zakat Maal', '4.3.01.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(200, 'Bagian Amil dari Dana Infaq', '4.3.02.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(201, 'Penerimaan Lain', '4.3.99.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(202, 'Penerimaan Dana APBD Kabupaten', '4.5.01.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-06-05 09:21:11'),
(203, 'Penerimaan Bunga/Jasa Bank Konvensional', '4.6.01.01.001', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(204, 'Penerimaan Bagi hasil', '4.6.01.01.002', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(205, 'Penerimaan Non Syariah Lainnya', '4.6.01.01.003', 5, 'K', 'LRA', 'A', 'KAS,RA', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(206, 'Penyaluran Dana Zakat untuk Amil', '5.1.01.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(207, 'Pelayanan Kemanusiaan-Santunan Fakir dan Mualaf', '5.1.02.02.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(208, 'Pelayanan Kemanusiaan-Bantuan Jadup', '5.1.02.02.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(209, 'Pelayanan Kemanusiaan-Bantuan renovasi RTLH', '5.1.02.02.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(210, 'Pelayanan Kemanusiaan-Bedah Rumah', '5.1.02.02.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(211, 'Pelayanan Kemanusiaan-Khitan Masal', '5.1.02.02.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(212, 'Paket Zakat Fitrah', '5.1.02.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(213, 'Bantuan Sanitasi', '5.1.02.05.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(214, 'Pelayanan Pendidikan-Bantuan Hutang Pendidikan', '5.1.04.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(215, 'Bantuan Hutang Pengobatan', '5.1.04.05.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(216, 'Pemberdayaan Ekonomi-Pemberdayaan mualaf (bantuan ekonomi)', '5.1.05.03.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(217, 'Paket Zakat Fitrah untuk Mualaf', '5.1.05.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(218, 'Pemberdayaan Mualaf', '5.1.05.04.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(219, 'Paket Zakat Fitrah untuk Fisabilillah', '5.1.06.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(220, 'Bantuan Da\'i/Guru/Ustadz', '5.1.06.04.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(221, 'Bantuan Ormas Islam', '5.1.06.04.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(222, 'Bantuan Masjid/Mushola', '5.1.06.04.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(223, 'Bantuan Sarana Ibadah', '5.1.06.04.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(224, 'Pembangunan Sarana Belajar', '5.1.06.04.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(225, 'Bantuan Kegiatan Keagamaan', '5.1.06.04.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(226, 'Pelatihan Da\'i', '5.1.06.04.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(227, 'Pelatihan Mengurus Jenazah', '5.1.06.04.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(228, 'Pelayanan Kemanusiaan-Bantuan Ibnu Sabil', '5.1.07.02.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(229, 'Paket Zakat Fitrah', '5.1.07.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(230, 'Bantuan Da\'i/Guru/Ustadz', '5.1.07.04.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(231, 'Bantuan Ormas Islam', '5.1.07.04.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(232, 'Bantuan Masjid/Mushola', '5.1.07.04.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(233, 'Bantuan Sarana Ibadah', '5.1.07.04.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(234, 'Pembangunan Sarana Belajar', '5.1.07.04.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(235, 'Bantuan Kegiatan Keagamaan', '5.1.07.04.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(236, 'Pelatihan Da\'i', '5.1.07.04.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(237, 'Pelatihan Mengurus Jenazah', '5.1.07.04.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(238, 'Beasiswa Pendidikan-Beasiswa SD/MI', '5.1.99.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(239, 'Beasiswa Pendidikan-Beasiswa SMP/MTS', '5.1.99.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(240, 'Beasiswa Pendidikan-Beasiswa SMA/MA', '5.1.99.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(241, 'Beasiswa Pendidikan-Beasiswa Diploma', '5.1.99.01.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(242, 'Beasiswa Pendidikan-Beasiswa Sarjana', '5.1.99.01.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(243, 'Pelayanan Pendidikan-Bantuan Hutang Pendidikan', '5.1.99.01.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(244, 'Pelayanan Pendidikan-Bantuan Biaya Pendidikan', '5.1.99.01.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(245, 'Zakat Community Development-Sewa demplot tanah untuk pertanian', '5.1.99.03.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(246, 'Zakat Community Development-Banyuanyar', '5.1.99.03.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(247, 'Pelatihan Keterampilan Kerja/Usaha', '5.1.99.03.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(248, 'Zakat Community Development-Jagung Klaten Utara', '5.1.99.03.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(249, 'Pemberdayaan Ekonomi-Bantuan Alat Usaha', '5.1.99.03.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(250, 'Pemberdayaan Ekonomi-Bantuan Modal Usaha', '5.1.99.03.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(251, 'Pemberdayaan Ekonomi-Bantuan Ternak', '5.1.99.03.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(252, 'Pemberdayaan Ekonomi-Pemberdayaan mualaf (bantuan ekonomi)', '5.1.99.03.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(253, 'Paket Zakat Fitrah untuk Miskin', '5.1.99.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(254, 'Bantuan Biaya Pengobatan', '5.1.99.05.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(255, 'Bantuan Alat Kesehatan', '5.1.99.05.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(256, 'Penyaluran Dana Infaq/Sedekah untuk Amil', '5.2.01.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(257, 'Pelayanan Kemanusiaan-Bantuan Jadup', '5.2.02.02.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(258, 'Pelayanan Kemanusiaan-Bantuan Kebencanaan', '5.2.02.02.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(259, 'Beasiswa Pendidikan-Beasiswa SD/MI', '5.2.03.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(260, 'Beasiswa Pendidikan-Beasiswa SMP/MTS', '5.2.03.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(261, 'Beasiswa Pendidikan-Beasiswa SMA/MA', '5.2.03.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(262, 'Beasiswa Pendidikan-Beasiswa Diploma', '5.2.03.01.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(263, 'Beasiswa Pendidikan-Beasiswa Sarjana', '5.2.03.01.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(264, 'Pelayanan Pendidikan-Bantuan Hutang Pendidikan', '5.2.03.01.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(265, 'ISTT Pelayanan Pendidikan-Bantuan Biaya Pendidikan', '5.2.03.01.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(266, 'ISTT Pelayanan Pendidikan-Bantuan Pendidikan Swasta', '5.2.03.01.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(267, 'Pelayanan Pendidikan-Bantuan Biaya Kuliah', '5.2.03.01.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(268, 'Pelayanan Kemanusiaan-Bantuan Jadup', '5.2.03.02.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(269, 'Pelayanan Kemanusiaan-Bantuan renovasi RTLH', '5.2.03.02.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(270, 'Pelayanan Kemanusiaan-Bedah Rumah', '5.2.03.02.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(271, 'Pelayanan Kemanusiaan-Bantuan Ibnu Sabil', '5.2.03.02.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(272, 'Pelayanan Kemanusiaan-Bantuan Kebencanaan', '5.2.03.02.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(273, 'Pemberdayaan Ekonomi-Bantuan Alat Usaha', '5.2.03.03.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(274, 'Pemberdayaan Ekonomi-Bantuan Modal Usaha', '5.2.03.03.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(275, 'Pemberdayaan Ekonomi-Bantuan Ternak', '5.2.03.03.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(276, 'Bantuan Da\'i/Guru/Ustadz', '5.2.03.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(277, 'Bantuan Ormas Islam', '5.2.03.04.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(278, 'Bantuan Masjid/Mushola', '5.2.03.04.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(279, 'Kegiatan Bulan Ramadhan', '5.2.03.04.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(280, 'Bantuan Sarana Belajar', '5.2.03.04.005', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(281, 'Bantuan Kegiatan Keagamaan', '5.2.03.04.006', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(282, 'Pelatihan Da\'i', '5.2.03.04.007', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(283, 'Pelatihan Mengurus Jenazah', '5.2.03.04.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(284, 'Bantuan Hutang Pengobatan', '5.2.03.05.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(285, 'Bantuan Biaya Pengobatan', '5.2.03.05.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(286, 'Bantuan Alat Kesehatan', '5.2.03.05.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(287, 'Bantuan Sanitasi', '5.2.03.05.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(288, 'Belanja Pegawai Bidang Pengumpulan', '5.3.01.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(289, 'Belanja Pegawai Bidang Pendistribusian', '5.3.01.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(290, 'Belanja Pegawai Bidang SDM Umum', '5.3.01.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(291, 'Belanja Pubdok Bidang Pengumpulan', '5.3.02.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(292, 'Belanja Pubdok Bidang Pendistribusian', '5.3.02.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(293, 'Belanja Pubdok Bidang SDM Umum', '5.3.02.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(294, 'Belanja Perjalanan Dinas Bidang Pengumpulan', '5.3.03.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(295, 'Belanja Perjalanan Dinas Bidang Pendistribusian', '5.3.03.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(296, 'Belanja Perjalanan Dinas Bidang SDM Umum', '5.3.03.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(297, 'BUA Bidang Pengumpulan', '5.3.04.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(298, 'BUA Bidang Pendistribusian', '5.3.04.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(299, 'BUA Bidang SDM Umum', '5.3.04.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(300, 'Beban Penyusutan Gedung dan Bangunan', '5.3.05.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(301, 'Beban Penyusutan Kendaraan', '5.3.05.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(302, 'Beban Penyusutan Peralatan Mesin', '5.3.05.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(303, 'Beban Penyusutan Aset Lainnya', '5.3.05.01.004', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(304, 'Belanja Lainnya', '5.3.06.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(305, 'Belanja Jasa Pihak Ketiga', '5.3.07.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(306, 'Pengadaan Gedung dan Bangunan', '5.3.08.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(307, 'Pengadaan Kendaraan', '5.3.08.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(308, 'Pengadaan Peralatan Mesin', '5.3.08.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(309, 'Pengadaan Aset Lainnya', '5.3.08.01.004', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(310, 'Pengadaan Tanah', '5.3.08.01.005', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(311, 'Belanja Pegawai Dana APBD', '5.5.01.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(312, 'Belanja Sosialisasi Publikasi Dokumentasi dan Koordinasi Dana APBD', '5.5.01.01.002', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(313, 'Belanja Administrasi Umum Dana APBD', '5.5.01.01.003', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(314, 'Belanja Lainnya Dana APBD', '5.5.01.01.004', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(315, 'Penyaluran dana jasa giro dan Dana Non Syariah Lainya', '5.6.01.01.001', 5, 'D', 'LRA', 'A', 'KAS,RA,TSDM,TPD', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(317, 'Peralatan dan Mesin', '1.2.01.01.003', 5, 'D', 'NR', 'A', 'KAS,RA,SA', '2024-03-11 06:40:52', '2024-04-16 02:22:13'),
(318, 'Khitan Masal', '5.2.03.02.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(321, 'Miskin-Cerdas via UPZ', '5.1.99.01.008', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(322, 'Fakir-Peduli via UPZ', '5.1.02.02.006', 5, 'D', 'LRA', 'A', 'KAS,PROGRAM,TPD,RA,peduli', '2024-03-11 06:40:52', '2024-04-16 08:08:46'),
(323, 'Fisabilillah-Takwa via UPZ', '5.1.06.04.010', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(324, 'Pemberdayaan Ekonomi Via UPZ', '5.1.99.03.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(325, 'Ibnu Sabil- Peduli Via UPZ', '5.1.07.02.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(326, 'Penerimaan Dana DSKl', '4.2.01.01.004', 5, 'K', 'LRA', 'A', 'IFQ,ZKT,infaq,KAS,PROGRAM,RA,VIAPG', '2024-03-11 06:40:52', '2024-06-07 03:30:43'),
(327, 'IST-Peduli-Penyaluran DSKL ', '5.2.02.02.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(328, 'BPR Bank Klaten (04200002112)', '1.1.01.02.012', 5, 'D', 'NR', 'A', 'KAS,VIAPD,VIASDM,RA,SA,VIAPG', '2024-03-11 06:40:52', '2024-04-16 02:20:27'),
(329, 'Utang Distribusi BAZNAS RI', '2.1.01.01.003', 5, 'K', 'NR', 'A', 'KAS,SA', '2024-03-11 06:40:52', '2024-04-16 02:24:06'),
(330, 'Fisabilillah-Pemberdayan Mualaf', '5.1.06.04.011', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(331, 'ISTT Pemberdayaan Mualaf', '5.2.03.04.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(332, 'Zakat Miskin Peduli Via UPZ', '5.1.99.02.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(333, 'Zakat Miskin Taqwa Via UPZ', '5.1.99.04.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(334, 'Zakat Gharimin Klaten Taqwa via UPZ', '5.1.04.04.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(335, 'Pelatihan Keterampilan Kerja/Usaha', '5.2.03.03.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(336, 'Zakat Community Development-Jagung Klaten Utara', '5.2.03.03.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,makmur', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(337, 'Bantuan Pendidikan Swasta', '5.1.99.01.009', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(338, 'Lomba Cerdas Tangkas Agama Islam', '5.2.03.01.010', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,cerdas', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(339, 'Bantuan Sanitasi', '5.1.99.05.004', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(340, 'Rumah Tahfidz', '5.1.06.04.012', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(341, 'Rumah Tahfidz', '5.2.03.04.010', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(342, 'Pelayanan Kemanusiaan-Bantuan renovasi RTLH', '5.1.99.02.002', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,peduli', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(343, 'Bantuan Pengobatan Via UPZ', '5.1.99.05.001', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,sehat', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(344, 'Pemberdayaan Mualaf Via UPZ', '5.1.05.04.003', 5, 'D', 'LRA', 'A', 'KAS,RA,PROGRAM,TPD,taqwa', '2024-03-11 06:40:52', '2024-03-11 06:40:52'),
(345, 'Infak Terikat Bantuan Pengobatan', '5.2.02.05.001', 5, 'D', 'NR', 'A', 'IFQ,ZKT,infaq,PROGRAM', '2024-06-03 07:51:07', '2024-06-03 07:51:07'),
(346, 'Penerimaan Dana Hibah Lainnya', '4.5.01.01.002', 5, 'K', 'LRA', 'A', 'KAS,RA,SA', '2024-06-05 09:20:35', '2024-06-22 07:25:12'),
(347, 'Kas di Bank Distribusi BNI', '1.1.01.01.007', 5, 'D', 'NR', 'A', 'KAS,PROGRAM,VIAPD,VIASDM,TPD,TSDM,RA,SA', '2024-06-05 14:22:25', '2024-06-05 14:22:25'),
(348, 'Zakat Miskin Klaten Peduli-Jadup', '5.1.99.02.003', 5, 'D', 'LRA', 'A', 'KAS,PROGRAM,VIAPD,RA,peduli', '2024-06-06 02:34:56', '2024-06-06 02:36:52'),
(349, 'Zakat Miskin Klaten Peduli-BPJS Ketenagakerjaan', '5.1.99.02.004', 5, 'D', 'LRA', 'A', 'KAS,PROGRAM,VIAPD,RA,peduli', '2024-06-06 07:47:14', '2024-06-06 07:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kas` bigint DEFAULT NULL,
  `id_ruang` bigint DEFAULT NULL,
  `harga` bigint DEFAULT NULL,
  `kode_asset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baznas`
--

CREATE TABLE `baznas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerimaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keuangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sdm_umum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ka_proposal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ka_penerimaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ka_keuangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ka_sdm_umum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `wilayah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketua_iv` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baznas`
--

INSERT INTO `baznas` (`id`, `nama`, `lokasi`, `website`, `email`, `telp`, `logo`, `proposal`, `penerimaan`, `keuangan`, `sdm_umum`, `ka_proposal`, `ka_penerimaan`, `ka_keuangan`, `ka_sdm_umum`, `created_at`, `updated_at`, `wilayah`, `ketua_iv`) VALUES
(1, 'Baznas Kabupaten Klaten', 'Jl. Ronggo Warsito No.56, RW.11, Gunungan, Bareng Lor, Kec. Klaten Utara, Kabupaten Klaten', 'https://baznas.klaten.go.id', 'baznaskab.klaten@baznas.go.id', '(0272) 339 1307', '1724472474_1656486308rsz_baznas-logo-fix.png', 'Hendri Trisnawan', 'Rifan Widi Utomo, S.T', 'Zulfiana Urfa, S.IP', 'Nita Fatmawati, S. Pd', 'Edy Ahyadi S M, S. Ag., M.Pd', 'K.H. Ahmad Aydi Sunani, S. Ag', 'H. Muslich Wachid Mahdy, S. Ag', 'Drs. K.H Muchlis Hudaf', NULL, '2024-08-24 04:50:45', 'Boyolali', 'H. Rantiman, S.H');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_pengajuan` int DEFAULT NULL,
  `id_kas` int DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informasi`
--

CREATE TABLE `informasi` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `informasi`
--

INSERT INTO `informasi` (`id`, `tanggal`, `judul`, `keterangan`, `file`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-08-26', 'Sistem Informasi Baznas Klaten', '<p>Klaten, Baznas Kabupaten Klaten pada hari ini selasa tanggal 26 Agustus 2024 telah meluncurkan aplikasi terbarunya, SIBAKAT ( Sistem Informasi Baznas Klaten), yang dirancang untuk mempermudah masyarakat dalam berzakat dan meningkatkan transparansi dalam pengelolaan dana zakat. Dengan semakin berkembangnya teknologi digital, Baznas Klaten memperkenalkan SIBAKAT sebagai solusi modern dalam menejemen zakat. Aplikasi ini menyediakan berbagai fitur yang memudahkan masyarakat untuk berzakat secara online, serta memberikan kemudahan bagi Baznas dalam melacak dan mengelola dana zakat dengan lebih efisien.Fitur utama yang ditawarkan oleh SIBAKAT antara lain:</p><ol><li>Pembayaran Zakat Online: Masyarakat dapat melakukan pembayaran zakat secara online melalui berbagai metode pembayaran yang tersedia, seperti transfer bank, kartu kredit, atau pembayaran melalui e-wallet.</li><li>Pengelolaan Data Zakat: Aplikasi ini memungkinkan pengguna untuk menyimpan dan mengelola data zakat secara digital, termasuk riwayat pembayaran, jenis zakat yang telah dikeluarkan, dan informasi lainnya.</li><li>Informasi Program Zakat: SIBAKAT menyediakan informasi terkini tentang program-program zakat yang diselenggarakan oleh Baznas Klaten, termasuk program kemanusiaan, pendidikan, dan kesejahteraan sosial lainnya.</li><li>Transparansi Dana Zakat: Baznas Klaten menekankan pentingnya transparansi dalam pengelolaan dana zakat. Melalui SIBAKAT, masyarakat dapat melacak penggunaan dana zakat secara real-time dan memastikan bahwa dana yang mereka sumbangkan digunakan secara efektif dan tepat sasaran.</li></ol><p>&nbsp;</p>', '1724469450_logo-dark.png', '1', '2024-03-11 14:23:45', '2024-08-23 20:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_akun`
--

CREATE TABLE `jenis_akun` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_akun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_akun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_akun`
--

INSERT INTO `jenis_akun` (`id`, `kode_akun`, `nama_akun`, `created_at`, `updated_at`) VALUES
(1, 'KAS', 'KAS', NULL, NULL),
(2, 'RA', 'Rencana Anggaran', NULL, NULL),
(3, 'PROGRAM', 'Program Baznas', NULL, NULL),
(4, 'SA', 'Saldo Awal', NULL, NULL),
(5, 'TSDM', 'Rekening Tujuan SDM Umum', NULL, NULL),
(6, 'VIASDM', 'Rekening Sumber SDM Umum', NULL, NULL),
(7, 'TPD', 'Rekening Tujuan Pendistribuisan', NULL, NULL),
(8, 'VIAPD', 'Rekening Sumber Pendistribusian', NULL, NULL),
(9, 'TPG', 'Tujuan Pengumpulan', NULL, NULL),
(10, 'VIAPG', 'Sumber Dana Pengumpulan', NULL, NULL),
(11, 'zakat', 'zakat', NULL, NULL),
(12, 'infaq', 'infaq', NULL, NULL),
(13, 'PBPD', 'Tujuan Pembelian Barang', NULL, NULL),
(14, 'ZKT', 'Grup Zakat', NULL, NULL),
(15, 'IFQ', 'Group infaq', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kode_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kas` enum('uang','barang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uang',
  `pengirim` enum('SA','KU','P','SDM','PG') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KU',
  `type` enum('TU','M','SPJ') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TU',
  `debet` int NOT NULL,
  `kredit` int NOT NULL,
  `qty` int DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kasbon` int DEFAULT NULL,
  `tahun` int NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `id_muzaki` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dinas` int DEFAULT NULL,
  `wa` enum('N','B','S') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kasbon`
--

CREATE TABLE `kasbon` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_kasbon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` bigint DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `kategori` enum('A','B','C','D') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'D',
  `status` enum('A','N','B') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'B',
  `validator` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pemohon` enum('SDM','PD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SDM'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'Bayat', '2024-02-26 11:22:09', '2024-02-26 11:22:09'),
(2, 'Cawas', '2024-02-26 11:22:10', '2024-02-26 11:22:10'),
(3, 'Ceper', '2024-02-26 11:22:11', '2024-02-26 11:22:11'),
(4, 'Delanggu', '2024-02-26 11:22:12', '2024-02-26 11:22:12'),
(5, 'Gantiwarno', '2024-02-26 11:22:13', '2024-02-26 11:22:13'),
(6, 'Jatinom', '2024-02-26 11:22:14', '2024-02-26 11:22:14'),
(7, 'Jogonalan', '2024-02-26 11:22:15', '2024-02-26 11:22:15'),
(8, 'Juwiring', '2024-02-26 11:22:16', '2024-02-26 11:22:16'),
(9, 'Kalikotes', '2024-02-26 11:22:17', '2024-02-26 11:22:17'),
(10, 'Karanganom', '2024-02-26 11:22:18', '2024-02-26 11:22:18'),
(11, 'Karangdowo', '2024-02-26 11:22:19', '2024-02-26 11:22:19'),
(12, 'Karangnongko', '2024-02-26 11:22:20', '2024-02-26 11:22:20'),
(13, 'Kebonarum', '2024-02-26 11:22:21', '2024-02-26 11:22:21'),
(14, 'Kemalang', '2024-02-26 11:22:22', '2024-02-26 11:22:22'),
(15, 'Klaten Selatan', '2024-02-26 11:22:23', '2024-02-26 11:22:23'),
(16, ' Klaten Tengah', '2024-02-26 11:22:24', '2024-02-26 11:22:24'),
(17, 'Klaten Utara', '2024-02-26 11:22:25', '2024-02-26 11:22:25'),
(18, 'Manisrenggo', '2024-02-26 11:22:26', '2024-02-26 11:22:26'),
(19, 'Ngawen', '2024-02-26 11:22:27', '2024-02-26 11:22:27'),
(20, 'Pedan', '2024-02-26 11:22:28', '2024-02-26 11:22:28'),
(21, 'Polanharjo', '2024-02-26 11:22:29', '2024-02-26 11:22:29'),
(22, 'Prambanan', '2024-02-26 11:22:30', '2024-02-26 11:22:30'),
(23, 'Trucuk', '2024-02-26 11:22:31', '2024-02-26 11:22:31'),
(24, 'Tulung', '2024-02-26 11:22:32', '2024-02-26 11:22:32'),
(25, 'Wedi', '2024-02-26 11:22:33', '2024-02-26 11:22:33'),
(26, 'Wonosari', '2024-02-26 11:22:34', '2024-02-26 11:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kelurahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kecamatan` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama_kelurahan`, `id_kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'Banyuripan', 1, NULL, NULL),
(2, 'Beluk', 1, NULL, NULL),
(3, 'Bogem', 1, NULL, NULL),
(4, 'Dukuh', 1, NULL, NULL),
(5, 'Gunung Gajah', 1, NULL, NULL),
(6, 'Jambakan', 1, NULL, NULL),
(7, 'Jarum', 1, NULL, NULL),
(8, 'Jotangan', 1, NULL, NULL),
(9, 'Kebon', 1, NULL, NULL),
(10, 'Krakitan', 1, NULL, NULL),
(11, 'Krikilan', 1, NULL, NULL),
(12, 'Nengahan', 1, NULL, NULL),
(13, 'Ngerangan', 1, NULL, NULL),
(14, 'Paseban', 1, NULL, NULL),
(15, 'Talang', 1, NULL, NULL),
(16, 'Tawangrejo', 1, NULL, NULL),
(17, 'Tegalrejo', 1, NULL, NULL),
(18, 'Wiro', 1, NULL, NULL),
(19, 'Balak', 2, NULL, NULL),
(20, 'Baran', 2, NULL, NULL),
(21, 'Barepan', 2, NULL, NULL),
(22, 'Bawak', 2, NULL, NULL),
(23, 'Bendungan', 2, NULL, NULL),
(24, 'Bogor', 2, NULL, NULL),
(25, 'Burikan', 2, NULL, NULL),
(26, 'Cawas', 2, NULL, NULL),
(27, 'Gombang', 2, NULL, NULL),
(28, 'Japanan', 2, NULL, NULL),
(29, 'Karangasem', 2, NULL, NULL),
(30, 'Kedungampel', 2, NULL, NULL),
(31, 'Mlese', 2, NULL, NULL),
(32, 'Nanggulan', 2, NULL, NULL),
(33, 'Pakisan', 2, NULL, NULL),
(34, 'Plosowangi', 2, NULL, NULL),
(35, 'Pogung', 2, NULL, NULL),
(36, 'Tirtomarto', 2, NULL, NULL),
(37, 'Tlingsing', 2, NULL, NULL),
(38, 'Tugu', 2, NULL, NULL),
(39, 'Ceper', 3, NULL, NULL),
(40, 'Cetan', 3, NULL, NULL),
(41, 'Dlimas', 3, NULL, NULL),
(42, 'Jambu Kidul', 3, NULL, NULL),
(43, 'Jambu Kulon', 3, NULL, NULL),
(44, 'Jombor', 3, NULL, NULL),
(45, 'Kajen', 3, NULL, NULL),
(46, 'Klepu', 3, NULL, NULL),
(47, 'Kujon', 3, NULL, NULL),
(48, 'Kuncen', 3, NULL, NULL),
(49, 'Kurung', 3, NULL, NULL),
(50, 'Meger', 3, NULL, NULL),
(51, 'Mlese', 3, NULL, NULL),
(52, 'Ngawonggo', 3, NULL, NULL),
(53, 'Pasungan', 3, NULL, NULL),
(54, 'Pokak', 3, NULL, NULL),
(55, 'Srebegan', 3, NULL, NULL),
(56, 'Tegalrejo', 3, NULL, NULL),
(57, 'Banaran', 4, NULL, NULL),
(58, 'Bowan', 4, NULL, NULL),
(59, 'Butuhan', 4, NULL, NULL),
(60, 'Delanggu', 4, NULL, NULL),
(61, 'Dukuh', 4, NULL, NULL),
(62, 'Gatak', 4, NULL, NULL),
(63, 'Jetis', 4, NULL, NULL),
(64, 'Karang', 4, NULL, NULL),
(65, 'Kepanjen', 4, NULL, NULL),
(66, 'Krecek', 4, NULL, NULL),
(67, 'Mendak', 4, NULL, NULL),
(68, 'Sabrang', 4, NULL, NULL),
(69, 'Segaran', 4, NULL, NULL),
(70, 'Sidomulyo', 4, NULL, NULL),
(71, 'Sribit', 4, NULL, NULL),
(72, 'Tlobong', 4, NULL, NULL),
(73, 'Baturan', 5, NULL, NULL),
(74, 'Ceporan', 5, NULL, NULL),
(75, 'Gentan', 5, NULL, NULL),
(76, 'Gesikan', 5, NULL, NULL),
(77, 'Jabung', 5, NULL, NULL),
(78, 'Jogoprayan', 5, NULL, NULL),
(79, 'Karangturi', 5, NULL, NULL),
(80, 'Katekan', 5, NULL, NULL),
(81, 'Kerten', 5, NULL, NULL),
(82, 'Kragilan', 5, NULL, NULL),
(83, 'Mlese', 5, NULL, NULL),
(84, 'Muruh', 5, NULL, NULL),
(85, 'Mutihan', 5, NULL, NULL),
(86, 'Ngandong', 5, NULL, NULL),
(87, 'Sawit', 5, NULL, NULL),
(88, 'Towangsan', 5, NULL, NULL),
(89, 'Bengking', 6, NULL, NULL),
(90, 'Beteng', 6, NULL, NULL),
(91, 'Bonyokan', 6, NULL, NULL),
(92, 'Cawan', 6, NULL, NULL),
(93, 'Bandungan', 6, NULL, NULL),
(94, 'Gedaren', 6, NULL, NULL),
(95, 'Glagah', 6, NULL, NULL),
(96, 'Jatinom', 6, NULL, NULL),
(97, 'Jemawan', 6, NULL, NULL),
(98, 'Kayumas', 6, NULL, NULL),
(99, 'Krajan', 6, NULL, NULL),
(100, 'Mranggen', 6, NULL, NULL),
(101, 'Pandeyan', 6, NULL, NULL),
(102, 'Puluhan', 6, NULL, NULL),
(103, 'Randulanang', 6, NULL, NULL),
(104, 'Socokangsi', 6, NULL, NULL),
(105, 'Temuireng', 6, NULL, NULL),
(106, 'Tibayan', 6, NULL, NULL),
(107, 'Bakung', 7, NULL, NULL),
(108, 'Dompyongan', 7, NULL, NULL),
(109, 'Gondangan', 7, NULL, NULL),
(110, 'Granting', 7, NULL, NULL),
(111, 'Joton', 7, NULL, NULL),
(112, 'Karangdukuh', 7, NULL, NULL),
(113, 'Kraguman', 7, NULL, NULL),
(114, 'Ngering', 7, NULL, NULL),
(115, 'Pakahan', 7, NULL, NULL),
(116, 'Plawikan', 7, NULL, NULL),
(117, 'Prawatan', 7, NULL, NULL),
(118, 'Rejoso', 7, NULL, NULL),
(119, 'Somopuro', 7, NULL, NULL),
(120, 'Sumyang', 7, NULL, NULL),
(121, 'Tambakan', 7, NULL, NULL),
(122, 'Tangkisan Pos', 7, NULL, NULL),
(123, 'Titang', 7, NULL, NULL),
(124, 'Wonoboyo', 7, NULL, NULL),
(125, 'Bolopleret', 8, NULL, NULL),
(126, 'Bulurejo', 8, NULL, NULL),
(127, 'Carikan', 8, NULL, NULL),
(128, 'Gondangsari', 8, NULL, NULL),
(129, 'Jaten', 8, NULL, NULL),
(130, 'Jetis', 8, NULL, NULL),
(131, 'Juwiran', 8, NULL, NULL),
(132, 'Juwiring', 8, NULL, NULL),
(133, 'Kenaiban', 8, NULL, NULL),
(134, 'Ketitang', 8, NULL, NULL),
(135, 'Kwarasan', 8, NULL, NULL),
(136, 'Mrisen', 8, NULL, NULL),
(137, 'Pundungan', 8, NULL, NULL),
(138, 'Sawahan', 8, NULL, NULL),
(139, 'Serenan', 8, NULL, NULL),
(140, 'Taji', 8, NULL, NULL),
(141, 'Tanjung', 8, NULL, NULL),
(142, 'Tlogorandu', 8, NULL, NULL),
(143, 'Trasan', 8, NULL, NULL),
(144, 'Gemblegan', 9, NULL, NULL),
(145, 'Jimbung', 9, NULL, NULL),
(146, 'Jogosetran', 9, NULL, NULL),
(147, 'Kalikotes', 9, NULL, NULL),
(148, 'Krajan', 9, NULL, NULL),
(149, 'Ngemplak', 9, NULL, NULL),
(150, 'Tambongwetan', 9, NULL, NULL),
(151, 'Tambongkulon', 9, NULL, NULL),
(152, 'Beku', 10, NULL, NULL),
(153, 'Blanceran', 10, NULL, NULL),
(154, 'Brangkal', 10, NULL, NULL),
(155, 'Gempol', 10, NULL, NULL),
(156, 'Gledeg', 10, NULL, NULL),
(157, 'Jambeyan', 10, NULL, NULL),
(158, 'Jeblog', 10, NULL, NULL),
(159, 'Jungkare', 10, NULL, NULL),
(160, 'Jurangjero', 10, NULL, NULL),
(161, 'Kadirejo', 10, NULL, NULL),
(162, 'Karangan', 10, NULL, NULL),
(163, 'Karanganom', 10, NULL, NULL),
(164, 'Kunden', 10, NULL, NULL),
(165, 'Ngabeyan', 10, NULL, NULL),
(166, 'Padas', 10, NULL, NULL),
(167, 'Pondok', 10, NULL, NULL),
(168, 'Soropaten', 10, NULL, NULL),
(169, 'Tarubasan', 10, NULL, NULL),
(170, 'Troso', 10, NULL, NULL),
(171, 'Babadan', 11, NULL, NULL),
(172, 'Bakungan', 11, NULL, NULL),
(173, 'Bulusan', 11, NULL, NULL),
(174, 'Demangan', 11, NULL, NULL),
(175, 'Karangdowo', 11, NULL, NULL),
(176, 'Karangjoho', 11, NULL, NULL),
(177, 'Karangtalun', 11, NULL, NULL),
(178, 'Karangwungu', 11, NULL, NULL),
(179, 'Kupang', 11, NULL, NULL),
(180, 'Munggung', 11, NULL, NULL),
(181, 'Ngolodono', 11, NULL, NULL),
(182, 'Pugeran', 11, NULL, NULL),
(183, 'Ringinputih', 11, NULL, NULL),
(184, 'Sentono', 11, NULL, NULL),
(185, 'Soka', 11, NULL, NULL),
(186, 'Tambak', 11, NULL, NULL),
(187, 'Tegalampel', 11, NULL, NULL),
(188, 'Tulas', 11, NULL, NULL),
(189, 'Tumpukan', 11, NULL, NULL),
(190, 'Banyuaeng', 12, NULL, NULL),
(191, 'Blimbing', 12, NULL, NULL),
(192, 'Demakijo', 12, NULL, NULL),
(193, 'Gemampir', 12, NULL, NULL),
(194, 'Gumul', 12, NULL, NULL),
(195, 'Jagalan', 12, NULL, NULL),
(196, 'Jetis', 12, NULL, NULL),
(197, 'Jiwan', 12, NULL, NULL),
(198, 'Kadilajo', 12, NULL, NULL),
(199, 'Kanoman', 12, NULL, NULL),
(200, 'Karangnongko', 12, NULL, NULL),
(201, 'Logede', 12, NULL, NULL),
(202, 'Ngemplak', 12, NULL, NULL),
(203, 'Somokaton', 12, NULL, NULL),
(204, 'Basin', 13, NULL, NULL),
(205, 'Gondang', 13, NULL, NULL),
(206, 'Karangduren', 13, NULL, NULL),
(207, 'Malangjiwan', 13, NULL, NULL),
(208, 'Menden', 13, NULL, NULL),
(209, 'Ngrundul', 13, NULL, NULL),
(210, 'Pluneng', 13, NULL, NULL),
(211, 'Balerante', 14, NULL, NULL),
(212, 'Bawukan', 14, NULL, NULL),
(213, 'Bumiharjo', 14, NULL, NULL),
(214, 'Dompol', 14, NULL, NULL),
(215, 'Kemalang', 14, NULL, NULL),
(216, 'Kendalsari', 14, NULL, NULL),
(217, 'Keputran', 14, NULL, NULL),
(218, 'Panggang', 14, NULL, NULL),
(219, 'Sidorejo', 14, NULL, NULL),
(220, 'Talun', 14, NULL, NULL),
(221, 'Tangkil', 14, NULL, NULL),
(222, 'Tegalmulyo', 14, NULL, NULL),
(223, 'Tlogowatu', 14, NULL, NULL),
(224, 'Danguran', 15, NULL, NULL),
(225, 'Gayamprit', 15, NULL, NULL),
(226, 'Glodogan', 15, NULL, NULL),
(227, 'Jetis', 15, NULL, NULL),
(228, 'Kajoran', 15, NULL, NULL),
(229, 'Karanglo', 15, NULL, NULL),
(230, 'Merbung', 15, NULL, NULL),
(231, 'Ngalas', 15, NULL, NULL),
(232, 'Nglinggi', 15, NULL, NULL),
(233, 'Sumberejo', 15, NULL, NULL),
(234, 'Tegalyoso', 15, NULL, NULL),
(235, 'Trunuh', 15, NULL, NULL),
(236, 'Bareng', 16, NULL, NULL),
(237, 'Buntalan', 16, NULL, NULL),
(238, 'Gumulan', 16, NULL, NULL),
(239, 'Jomboran', 16, NULL, NULL),
(240, 'Kabupaten', 16, NULL, NULL),
(241, 'Klaten', 16, NULL, NULL),
(242, 'Mojayan', 16, NULL, NULL),
(243, 'Semangkak', 16, NULL, NULL),
(244, 'Tonggalan', 16, NULL, NULL),
(245, 'Bareng Lor', 17, NULL, NULL),
(246, 'Gergunung', 17, NULL, NULL),
(247, 'Belang Wetan', 17, NULL, NULL),
(248, 'Jebugan', 17, NULL, NULL),
(249, 'Jonggrangan', 17, NULL, NULL),
(250, 'Karanganom', 17, NULL, NULL),
(251, 'Ketandan', 17, NULL, NULL),
(252, 'Sekarsuli', 17, NULL, NULL),
(253, 'Barukan', 18, NULL, NULL),
(254, 'Bendan', 18, NULL, NULL),
(255, 'Borangan', 18, NULL, NULL),
(256, 'Kebonalas', 18, NULL, NULL),
(257, 'Kecemen', 18, NULL, NULL),
(258, 'Kepurun', 18, NULL, NULL),
(259, 'Kranggan', 18, NULL, NULL),
(260, 'Leses', 18, NULL, NULL),
(261, 'Nangsri', 18, NULL, NULL),
(262, 'Ngemplakseneng', 18, NULL, NULL),
(263, 'Sapen', 18, NULL, NULL),
(264, 'Solodiran', 18, NULL, NULL),
(265, 'Sukorini', 18, NULL, NULL),
(266, 'Tanjungsari', 18, NULL, NULL),
(267, 'Taskombang', 18, NULL, NULL),
(268, 'Tijayan', 18, NULL, NULL),
(269, 'Candi Rejo', 19, NULL, NULL),
(270, 'Drono', 19, NULL, NULL),
(271, 'Duwet', 19, NULL, NULL),
(272, 'Gatak', 19, NULL, NULL),
(273, 'Kahuman', 19, NULL, NULL),
(274, 'Kwaren', 19, NULL, NULL),
(275, 'Manjung', 19, NULL, NULL),
(276, 'Manjungan', 19, NULL, NULL),
(277, 'Mayungan', 19, NULL, NULL),
(278, 'Ngawen', 19, NULL, NULL),
(279, 'Pepe', 19, NULL, NULL),
(280, 'Senden', 19, NULL, NULL),
(281, 'Tempursari', 19, NULL, NULL),
(282, 'Beji', 20, NULL, NULL),
(283, 'Bendo', 20, NULL, NULL),
(284, 'Jatimulyo', 20, NULL, NULL),
(285, 'Jetis Wetan', 20, NULL, NULL),
(286, 'Kalangan', 20, NULL, NULL),
(287, 'Kaligawe', 20, NULL, NULL),
(288, 'Keden', 20, NULL, NULL),
(289, 'Kedungan', 20, NULL, NULL),
(290, 'Lemahireng', 20, NULL, NULL),
(291, 'Ngaren', 20, NULL, NULL),
(292, 'Sobayan', 20, NULL, NULL),
(293, 'Tambakboyo', 20, NULL, NULL),
(294, 'Temuwangi', 20, NULL, NULL),
(295, 'Troketon', 20, NULL, NULL),
(296, 'Borongan', 21, NULL, NULL),
(297, 'Glagah Wangi', 21, NULL, NULL),
(298, 'Janti', 21, NULL, NULL),
(299, 'Jimus', 21, NULL, NULL),
(300, 'Kapungan', 21, NULL, NULL),
(301, 'Karanglo', 21, NULL, NULL),
(302, 'Kauman', 21, NULL, NULL),
(303, 'Kebonharjo', 21, NULL, NULL),
(304, 'Keprabon', 21, NULL, NULL),
(305, 'Kranggan', 21, NULL, NULL),
(306, 'Nganjat', 21, NULL, NULL),
(307, 'Ngaran', 21, NULL, NULL),
(308, 'Polan', 21, NULL, NULL),
(309, 'Ponggok', 21, NULL, NULL),
(310, 'Sidoharjo', 21, NULL, NULL),
(311, 'Sidowayah', 21, NULL, NULL),
(312, 'Turus', 21, NULL, NULL),
(313, 'Wangen', 21, NULL, NULL),
(314, 'Polanharjo', 21, NULL, NULL),
(315, 'Brajan', 22, NULL, NULL),
(316, 'Bugisan', 22, NULL, NULL),
(317, 'Cucukan', 22, NULL, NULL),
(318, 'Geneng', 22, NULL, NULL),
(319, 'Joho', 22, NULL, NULL),
(320, 'Kebon Dalem Kidul', 22, NULL, NULL),
(321, 'Kebon Dalem Lor', 22, NULL, NULL),
(322, 'Kemudo', 22, NULL, NULL),
(323, 'Kokosan', 22, NULL, NULL),
(324, 'Kotesan', 22, NULL, NULL),
(325, 'Pereng', 22, NULL, NULL),
(326, 'Randusari', 22, NULL, NULL),
(327, 'Sanggrahan', 22, NULL, NULL),
(328, 'Sengon', 22, NULL, NULL),
(329, 'Taji', 22, NULL, NULL),
(330, 'Tlogo', 22, NULL, NULL),
(331, 'Karangpakel', 23, NULL, NULL),
(332, 'Wanglu', 23, NULL, NULL),
(333, 'Trucuk', 23, NULL, NULL),
(334, 'Kalikebo', 23, NULL, NULL),
(335, 'Gaden', 23, NULL, NULL),
(336, 'Planggu', 23, NULL, NULL),
(337, 'Pundungsari', 23, NULL, NULL),
(338, 'Sajen', 23, NULL, NULL),
(339, 'Puluhan', 23, NULL, NULL),
(340, 'Kradenan', 23, NULL, NULL),
(341, 'Sabrang Lor', 23, NULL, NULL),
(342, 'Jatipuro', 23, NULL, NULL),
(343, 'Wonosari', 23, NULL, NULL),
(344, 'Mireng', 23, NULL, NULL),
(345, 'Bero', 23, NULL, NULL),
(346, 'Mandong', 23, NULL, NULL),
(347, 'Sumber', 23, NULL, NULL),
(348, 'Palar', 23, NULL, NULL),
(349, 'Beji', 24, NULL, NULL),
(350, 'Bono', 24, NULL, NULL),
(351, 'Cokro', 24, NULL, NULL),
(352, 'Dalangan', 24, NULL, NULL),
(353, 'Daleman', 24, NULL, NULL),
(354, 'Gedongjetis', 24, NULL, NULL),
(355, 'Kemiri', 24, NULL, NULL),
(356, 'Kiringan', 24, NULL, NULL),
(357, 'Majegan', 24, NULL, NULL),
(358, 'Malangan', 24, NULL, NULL),
(359, 'Mundu', 24, NULL, NULL),
(360, 'Pomah', 24, NULL, NULL),
(361, 'Pucang Miliran', 24, NULL, NULL),
(362, 'Sedayu', 24, NULL, NULL),
(363, 'Sorogaten', 24, NULL, NULL),
(364, 'Sudimoro', 24, NULL, NULL),
(365, 'Tulung', 24, NULL, NULL),
(366, 'Wunut', 24, NULL, NULL),
(367, 'Birit', 25, NULL, NULL),
(368, 'Brangkal', 25, NULL, NULL),
(369, 'Canan', 25, NULL, NULL),
(370, 'Dengkeng', 25, NULL, NULL),
(371, 'Gadungan', 25, NULL, NULL),
(372, 'Jiwo Wetan', 25, NULL, NULL),
(373, 'Kadibolo', 25, NULL, NULL),
(374, 'Kadilanggon', 25, NULL, NULL),
(375, 'Kaligayam', 25, NULL, NULL),
(376, 'Kalitengah', 25, NULL, NULL),
(377, 'Melikan', 25, NULL, NULL),
(378, 'Pacing', 25, NULL, NULL),
(379, 'Pandes', 25, NULL, NULL),
(380, 'Pasung', 25, NULL, NULL),
(381, 'Pesu', 25, NULL, NULL),
(382, 'Sembung', 25, NULL, NULL),
(383, 'Sukorejo', 25, NULL, NULL),
(384, 'Tanjungan', 25, NULL, NULL),
(385, 'Trotok', 25, NULL, NULL),
(386, 'Bener', 26, NULL, NULL),
(387, 'Bentangan', 26, NULL, NULL),
(388, 'Bolali', 26, NULL, NULL),
(389, 'Boto', 26, NULL, NULL),
(390, 'Bulan', 26, NULL, NULL),
(391, 'Duwet', 26, NULL, NULL),
(392, 'Gunting', 26, NULL, NULL),
(393, 'Jelobo', 26, NULL, NULL),
(394, 'Kingkang', 26, NULL, NULL),
(395, 'Lumbung Kerep', 26, NULL, NULL),
(396, 'Ngreden', 26, NULL, NULL),
(397, 'Pandanan', 26, NULL, NULL),
(398, 'Sekaran', 26, NULL, NULL),
(399, 'Sidowarno', 26, NULL, NULL),
(400, 'Sukorejo', 26, NULL, NULL),
(401, 'Tegalgondo', 26, NULL, NULL),
(402, 'Teloyo', 26, NULL, NULL),
(403, 'Wadung Getas', 26, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint UNSIGNED NOT NULL,
  `tahun` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `laporan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_04_111631_create_customer_table', 1),
(6, '2023_12_02_055448_create_tahun_table', 2),
(7, '2023_12_02_055658_create_akunkeuangan_table', 2),
(8, '2023_12_02_055809_create_rencana_table', 2),
(9, '2023_12_02_055836_create_surat_keluar_table', 2),
(10, '2023_12_02_055856_create_surat_masuk_table', 2),
(11, '2023_12_02_055930_create_jenis_akun_table', 2),
(12, '2023_12_02_055953_create_kas_table', 2),
(13, '2023_12_02_060021_create_kasbon_table', 2),
(14, '2023_12_02_060039_create_muzaki_table', 2),
(15, '2023_12_02_060101_create_ruang_table', 2),
(16, '2023_12_02_060120_create_asset_table', 2),
(17, '2023_12_02_060157_create_pendidikan_table', 2),
(18, '2023_12_02_060216_create_pelatihan_table', 2),
(19, '2023_12_02_060234_create_sertifikat_table', 2),
(20, '2023_12_02_060351_create_absensi_table', 2),
(21, '2024_01_22_110054_drop_users', 3),
(22, '2024_01_22_110121_drop_users', 4),
(26, '2024_01_29_132627_create_proposal_table', 5),
(27, '2024_01_31_141816_create_baznas_table', 6),
(31, '2024_02_02_043838_create_kecamatan_table', 7),
(32, '2024_02_02_043944_create_kelurahan_table', 7),
(33, '2024_02_21_143457_create_laporan_table', 8),
(35, '2024_02_21_151227_create_informasi_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `muzaki`
--

CREATE TABLE `muzaki` (
  `id` int NOT NULL,
  `npwz` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_muzaki` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('P','L') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `npwp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_register` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dinas` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muzaki`
--

INSERT INTO `muzaki` (`id`, `npwz`, `nama_muzaki`, `alamat`, `telp`, `hp`, `email`, `type`, `keterangan`, `created_at`, `updated_at`, `npwp`, `nik`, `tgl_register`, `jenis_kelamin`, `dinas`) VALUES
(1, '1', 'Dinas Perseoarangan', 'Jl. Ronggo Warsito No.56, RW.11, Gunungan, Bareng Lor, Kec. Klaten Utara, Kabupaten Klaten', '(0272) 339 1307', '0895605805888', NULL, 'L', NULL, '2024-08-24 05:18:00', '2024-08-24 05:18:00', NULL, '33090522020595001', '2024-12-01', NULL, NULL),
(2, '1', 'Mei prabowo', 'Jl. Ronggo Warsito No.56, RW.11, Gunungan, Bareng Lor, Kec. Klaten Utara, Kabupaten Klaten', '(0272) 339 1307', '0895605805888', 'mei.prabowo@uinsalatiga.ac.id', 'P', NULL, '2024-08-24 05:18:24', '2024-08-24 05:18:24', NULL, '330955', '2024-12-31', 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_pelatihan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pelatihan` date DEFAULT NULL,
  `id_kepegawaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` bigint UNSIGNED NOT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kepegawaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `tahun` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nomor_pengajuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `pengaju` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `nomor_proposal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_permohonan` enum('barang','uang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemohon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat_lengkap` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kecamatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rw` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_pengajuan` bigint DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('B','O','A','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas_survey` int DEFAULT NULL,
  `tanggal_survey` date DEFAULT NULL,
  `tanggal_penetapan` date DEFAULT NULL,
  `keterangan_penolakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `program_disetujui` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_status` enum('B','S','BW','SW') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_pemohon` enum('P','L') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  `tanggal_input_survey` date DEFAULT NULL,
  `keterangan_survey` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wa_akhir` enum('N','B','S') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rencana`
--

CREATE TABLE `rencana` (
  `id` bigint UNSIGNED NOT NULL,
  `id_akun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_ruang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ruang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pegawai` int DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_sertifikat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_sertifikat` date DEFAULT NULL,
  `nomor_sertifikat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kepegawaian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` int DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `file_lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tembusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isi_surat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kepada` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun` int DEFAULT NULL,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tahun`
--

CREATE TABLE `tahun` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','N') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tahun`
--

INSERT INTO `tahun` (`id`, `nama_tahun`, `status`, `created_at`, `updated_at`) VALUES
(1, '2024', 'A', '2024-02-26 11:22:09', '2024-02-26 11:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` enum('N','A') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `status` enum('A','PR','PG','KU','SD','B') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'B',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `aktif`, `status`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `hp`, `foto`) VALUES
(1, 'Mei Prabowo', 'A', 'A', 'mei.prabowo@uinsalatiga.ac.id', NULL, '$2y$10$la/5/FsrZ3FZuGb7vVBjLeHISIT/pJa3U0kIexQj8oJGj6Qr0mWnS', NULL, '2023-11-30 00:16:16', '2024-03-10 04:30:15', '08586704421', '1710070174_Untitled.png'),
(5, 'Drs. K.H Muchlis Hudaf', 'A', 'A', '0@gmail.com', NULL, '$2y$10$icXJGRnwoyC1lMzyT/aPhu82ylitA4xK8j3KxBZRqobbOjwEAdvpS', NULL, '2024-02-29 21:06:16', '2024-02-29 21:06:16', '0', 'default.jpg'),
(6, 'H. Rantiman, S.H', 'A', 'A', '1@gmail.com', NULL, '$2y$10$ohQ.0n3FGb8rCxp1pft.LeM6KBGSsc6bEZSo9yrPqiqBbWKGmC6lO', NULL, '2024-02-29 21:06:50', '2024-02-29 21:06:50', '0', 'default.jpg'),
(7, 'K.H. Ahmad Aydi Sunani, S. Ag', 'A', 'A', '2@gmail.com', NULL, '$2y$10$eB1amajT5zj0OQzspE1gdeBEjdzBPbWafAVtgO0CE7Z6lPD4hJkqm', NULL, '2024-02-29 21:07:14', '2024-02-29 21:07:14', '0', 'default.jpg'),
(8, 'H. Muslich Wachid Mahdy, S. Ag', 'A', 'A', '3@gmail.com', NULL, '$2y$10$J7Fc7WnnoGiTwkZqNsRcbOm8dJwWK0kUUEp0lYOicXb8us8DdmG5.', NULL, '2024-02-29 21:07:40', '2024-02-29 21:07:40', '0', 'default.jpg'),
(9, 'Edy Ahyadi S M, S. Ag., M.Pd', 'A', 'A', '4@gmail.com', NULL, '$2y$10$JACqs6M9mD09pa7g9VB41ODzaKdyJUqVdlGUQxsfCi6PV8uP7HHXq', NULL, '2024-02-29 21:08:10', '2024-02-29 21:08:10', '0', 'default.jpg'),
(10, 'Rifan Widi Utomo, S.T', 'A', 'PG', '5@gmail.com', NULL, '$2y$10$HLQ/Fd6uYByYUV/3ZtKNHe.jgG66FdLzbquO/PgzY570zFfNTuZIi', NULL, '2024-02-29 21:08:31', '2024-02-29 21:08:31', '0', 'default.jpg'),
(11, 'Hendri Trisnawan', 'A', 'PR', '6@gmail.com', NULL, '$2y$10$AbhPvcf..zFXuMhUlhBpheELrJbq7SHL1PyprXpzOd6UJky/eisva', NULL, '2024-02-29 21:09:35', '2024-02-29 21:09:35', '0', 'default.jpg'),
(12, 'Galuh Dayinta Sundari, S.E', 'A', 'PR', '7@gmail.com', NULL, '$2y$10$drF7/xaXKKQEWlF0UHXWIOZtwM1gaI2eXR4IDUfopzC7Ft4m1bjhm', NULL, '2024-02-29 21:10:14', '2024-02-29 21:10:14', '0', 'default.jpg'),
(13, 'Zulfiana Urfa, S.IP', 'A', 'KU', '8@gmail.com', NULL, '$2y$10$CyDLmcNsxfYSN4wS3RO./.BopQPCkVFYA0MOlsBbnPiJg8N2OYe96', NULL, '2024-02-29 21:10:31', '2024-02-29 21:10:31', '0', 'default.jpg'),
(14, 'Nita Fatmawati, S. Pd', 'A', 'SD', '9@gmail.com', NULL, '$2y$10$ZdcLzUj8G4/y8m7PiriiIu64.MC7OL8xaAXTt1i6qDlLgtcRM/WkK', NULL, '2024-02-29 21:11:07', '2024-02-29 21:11:07', '0', 'default.jpg'),
(15, 'Safira Putri Mentari, S.T', 'A', 'A', 'safiraputrimentari@gmail.com', NULL, '$2y$10$dP6fLTzjqjPP5R96A1foSOJFvfFLF9fQbOdxB4lpZR2fHcTrz5fSS', NULL, '2024-02-29 21:11:43', '2024-02-29 21:11:43', '082299114595', 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akunkeuangan`
--
ALTER TABLE `akunkeuangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baznas`
--
ALTER TABLE `baznas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`);

--
-- Indexes for table `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_akun`
--
ALTER TABLE `jenis_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kasbon`
--
ALTER TABLE `kasbon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muzaki`
--
ALTER TABLE `muzaki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rencana`
--
ALTER TABLE `rencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tahun`
--
ALTER TABLE `tahun`
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
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akunkeuangan`
--
ALTER TABLE `akunkeuangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `baznas`
--
ALTER TABLE `baznas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_akun`
--
ALTER TABLE `jenis_akun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kasbon`
--
ALTER TABLE `kasbon`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `muzaki`
--
ALTER TABLE `muzaki`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rencana`
--
ALTER TABLE `rencana`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tahun`
--
ALTER TABLE `tahun`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
