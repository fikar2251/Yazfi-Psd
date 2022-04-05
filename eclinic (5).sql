-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 10:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time DEFAULT NULL,
  `keluar` time DEFAULT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `tipe` enum('telat','tidak telat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `langitude` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidik_jari` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `tanggal`, `masuk`, `keluar`, `pegawai_id`, `tipe`, `langitude`, `longitude`, `foto`, `sidik_jari`, `created_at`, `updated_at`) VALUES
(1, '2021-12-03', '14:11:00', NULL, 1, 'telat', NULL, NULL, NULL, NULL, '2021-12-03 06:53:46', '2021-12-03 07:11:33'),
(2, '2021-12-03', '13:54:54', NULL, 3, 'telat', NULL, NULL, NULL, NULL, '2021-12-03 06:54:56', '2021-12-03 06:54:56'),
(3, '2021-12-03', '15:10:31', NULL, 2, 'telat', NULL, NULL, NULL, NULL, '2021-12-03 08:10:31', '2021-12-03 08:10:31'),
(4, '2021-12-06', '09:10:13', NULL, 1, 'tidak telat', NULL, NULL, NULL, NULL, '2021-12-06 02:10:13', '2021-12-06 02:10:13'),
(5, '2021-12-06', '09:12:39', NULL, 2, 'tidak telat', NULL, NULL, NULL, NULL, '2021-12-06 02:12:40', '2021-12-06 02:12:40'),
(6, '2021-12-06', '09:13:46', NULL, 3, 'tidak telat', NULL, NULL, NULL, NULL, '2021-12-06 02:13:47', '2021-12-06 02:13:47'),
(7, '2021-12-06', '09:13:55', NULL, 4, 'tidak telat', NULL, NULL, NULL, NULL, '2021-12-06 02:13:56', '2021-12-06 02:13:56'),
(8, '2021-12-06', '09:15:10', NULL, 5, 'telat', NULL, NULL, NULL, NULL, '2021-12-06 02:15:12', '2021-12-06 02:15:12'),
(11, '2022-01-12', '12:36:02', NULL, 1, 'telat', NULL, NULL, NULL, NULL, '2022-01-12 05:36:03', '2022-01-12 05:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `agamas`
--

CREATE TABLE `agamas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agamas`
--

INSERT INTO `agamas` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 1, '2021-11-16 04:01:25', '2021-11-16 04:01:25'),
(2, 'Katolik', 1, '2021-11-16 04:01:34', '2021-11-16 04:01:34'),
(3, 'Protestan', 1, '2021-11-16 04:01:45', '2021-11-16 04:01:45'),
(4, 'Hindu', 1, '2021-11-16 04:01:55', '2021-11-16 04:01:55'),
(5, 'Buddha', 1, '2021-11-16 04:02:09', '2021-11-16 04:02:09'),
(6, 'Konghucu', 1, '2021-11-16 04:02:21', '2021-11-16 04:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('barang','service') COLLATE utf8mb4_unicode_ci NOT NULL,
  `durasi` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `type` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `description`, `jenis`, `durasi`, `is_active`, `type`, `created_at`, `updated_at`) VALUES
(1, '556565', 'Semen', '', 'barang', 20, 1, 1, '2021-07-16 20:16:03', '2021-07-16 20:16:56'),
(2, '123455', 'BPJS', '', 'service', 20, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_booking` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing_id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `dokter_pengganti_id` int(11) DEFAULT NULL,
  `resepsionis_id` bigint(20) UNSIGNED NOT NULL,
  `ob_id` bigint(20) UNSIGNED NOT NULL,
  `perawat_id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_id` int(225) UNSIGNED NOT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `tanggal_status` date NOT NULL,
  `status_kedatangan_id` int(11) UNSIGNED NOT NULL,
  `jam_status` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `tanggal_pengganti` date DEFAULT NULL,
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_image` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `no_booking`, `marketing_id`, `dokter_id`, `dokter_pengganti_id`, `resepsionis_id`, `ob_id`, `perawat_id`, `cabang_id`, `customer_id`, `jadwal_id`, `status_pembayaran`, `tanggal_status`, `status_kedatangan_id`, `jam_status`, `jam_selesai`, `tanggal_pengganti`, `is_active`, `is_image`, `created_at`, `deleted_at`, `updated_at`) VALUES
(3, 'Tebet/20211011/93262', 4, 3, 9, 2, 6, 5, 1, 1, 136, 1, '2021-10-11', 4, '10:48:28', '11:28:28', '2021-10-11', '1', 1, '2021-10-11 03:49:00', NULL, '2021-10-11 04:04:49'),
(4, 'Tebet/20211011/80360', 4, 3, 9, 2, 6, 5, 1, 2, 641, 1, '2021-10-11', 4, '15:00:00', '16:00:00', '2021-10-11', '1', 1, '2021-10-11 07:31:22', NULL, '2021-10-11 08:19:36'),
(5, 'Tebet/20211011/70675', 4, 9, 3, 2, 6, 5, 1, 3, 642, 1, '2021-10-11', 4, '15:55:18', '16:35:18', '2021-10-11', '1', 1, '2021-10-11 08:56:14', NULL, '2021-10-12 09:19:31'),
(6, 'Tebet/20211209/89934', 4, 9, NULL, 0, 0, 0, 1, 1, 106, 0, '2021-12-13', 1, '09:00:00', '09:00:00', NULL, '1', 0, '2021-12-09 07:32:26', NULL, '2021-12-09 07:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `cabangs`
--

CREATE TABLE `cabangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_cabang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppn` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `status_pajak` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cabangs`
--

INSERT INTO `cabangs` (`id`, `kode_cabang`, `nama`, `alamat`, `telpon`, `email`, `wa`, `ppn`, `is_active`, `status_pajak`, `created_at`, `updated_at`) VALUES
(1, 'C001', 'Tebet', 'Jl Tebet', '08977356372533', 'tebet@gmail.com', '08977356372533', 10, 1, 1, '2021-07-16 19:58:17', '2021-08-19 07:14:41'),
(2, 'C002', 'Kemang', 'Jl Kemang', '0892367236723', 'kemang@gmail.com', '0892367236723', 5, 1, 1, '2021-08-04 21:01:24', '2021-08-19 07:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `cat_chart_of_account`
--

CREATE TABLE `cat_chart_of_account` (
  `id_cat` int(11) NOT NULL,
  `kode_parent` varchar(10) NOT NULL,
  `nama_cat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_chart_of_account`
--

INSERT INTO `cat_chart_of_account` (`id_cat`, `kode_parent`, `nama_cat`) VALUES
(1, '1', 'Fixed Asset'),
(2, '1', 'Accumulated Depreciation'),
(3, '1', 'Other Asset'),
(4, '2', 'Account Payable'),
(5, '2', 'Other Current Liability'),
(6, '2', 'Long term liability'),
(7, '3', 'Equity'),
(8, '4', 'Revenue'),
(9, '4', 'Cash & bank'),
(10, '4', 'Account Receivable'),
(11, '4', 'Inventory'),
(12, '4', 'Other current asset'),
(13, '4', 'Cost of goods Sold'),
(14, '5', 'Expense'),
(15, '5', 'Other expense'),
(16, '5', 'Other Income');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `id_chart_of_account` int(11) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_cat` int(11) NOT NULL,
  `status_tanggal` date NOT NULL,
  `child_numb` int(11) NOT NULL,
  `currency` int(2) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  `utama` int(1) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `atas_nama` varchar(25) NOT NULL,
  `cabang` varchar(60) NOT NULL,
  `notes` text NOT NULL,
  `balance` text NOT NULL,
  `tanggalbalance` date NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_of_account`
--

INSERT INTO `chart_of_account` (`id_chart_of_account`, `kode`, `deskripsi`, `id_cat`, `status_tanggal`, `child_numb`, `currency`, `opening_balance`, `utama`, `no_rekening`, `nama_bank`, `atas_nama`, `cabang`, `notes`, `balance`, `tanggalbalance`, `status`) VALUES
(8, '12010', 'MANDIRI', 9, '0000-00-00', 0, 0, 0, 0, '1150002030171', 'Mandiri', 'INTI SEMESTA SE', 'kcp mangga dua', '', '-8260119354.3', '0000-00-00', 1),
(10, '11010', 'Cash', 9, '0000-00-00', 16, 0, 0, 0, '00000', 'Cash', '', '', '', '-1595087.62', '0000-00-00', 1),
(11, '12012', 'Credit Card Mandiri', 9, '0000-00-00', 8, 0, 0, 0, '0', 'Credit Card BCA', '', '', '', '-30000000', '0000-00-00', 1),
(14, '12011', 'Debit Card Mandiri', 9, '0000-00-00', 8, 0, 0, 0, '0', 'Debit Card BCA', '', '', '', '-34641200', '0000-00-00', 1),
(15, '11020', 'Kas besar', 9, '0000-00-00', 16, 0, 0, 0, '0', 'Kas Besar', '', '', '', '1583556909.3', '0000-00-00', 1),
(16, '11000', 'Kas rupiah', 9, '0000-00-00', 16, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(17, '12000', 'Bank', 9, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(18, '13000', 'Piutang dagang', 10, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '6965879562', '0000-00-00', 1),
(19, '13200', 'Piutang karyawan', 12, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(20, '16000', 'Biaya dibayar dimuka', 12, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(21, '17000', 'Aktiva tetap', 1, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(22, '17100', 'Akumulasi penyusutan', 2, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(23, '20000', 'Hutang dagang', 4, '0000-00-00', 0, 0, 1000000, 1, '', '', '', '', '', '-2447294422.0892', '0000-00-00', 1),
(24, '40000', 'Pendapatan', 8, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(25, '61000', 'Beban Penyusutan', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(26, '62000', 'Biaya Umum & Administrasi	', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(27, '63000', 'Biaya kirim ', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(28, '65000', 'Komisi Penjualan', 14, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '1880609349.62', '0000-00-00', 1),
(29, '71000', 'Pendapatan lain lain', 16, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(30, '72000', 'Biaya lain lain	', 15, '0000-00-00', 0, 0, 0, 1, '', '', '', '', '', '0', '0000-00-00', 1),
(33, '15000', 'Uang Muka Pembelian', 10, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(34, '21000', 'Uang Muka Penjualan', 4, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(37, '13001', 'Piutang dagang', 10, '0000-00-00', 18, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(39, '13003', 'Piutang Joko', 10, '0000-00-00', 18, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(42, '12030', 'Bank BCA', 9, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 0),
(60, '14000', 'Persediaan Barang', 11, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-2383796807.0908', '0000-00-00', 1),
(62, '16001', 'Sewa Dibayar Di Muka', 12, '0000-00-00', 20, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(63, '13300', 'Piutang Lain Lain', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '36000000', '0000-00-00', 1),
(64, '17001', 'Tanah', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(65, '17002', 'Bangunan', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(66, '17003', 'Peralatan Kantor', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '15989000', '0000-00-00', 1),
(67, '17004', 'Peralatan Toko', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(68, '17005', 'Kendaraan', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(69, '17006', 'Mesin & Peralatan Kerja', 1, '0000-00-00', 21, 0, 0, 0, '', '', '', '', '', '20000000', '0000-00-00', 1),
(70, '17101', 'Akumulasi Penyusutan Tanah', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(71, '17102', 'Akumulasi Penyusutan Bangunan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(72, '17103', 'Akumulasi Penyusutan Peralatan Kantor', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(73, '17104', 'Akumulasi Penyusutan Peralatan Toko', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(74, '17105', 'Akumulasi Penyusutan Kendaraan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(75, '17106', 'Akumulasi Penyusutan Mesin & Peralatan Kerja', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(76, '20001', 'Hutang dagang', 4, '0000-00-00', 23, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(77, '20002', 'Hutang Ci Ani', 4, '0000-00-00', 23, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(102, '23000', 'Hutang Lain Lain', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-50000000', '0000-00-00', 1),
(103, '30000', 'Modal', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(104, '31000', 'Deviden', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(105, '32000', 'Laba Ditahan', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '5670349790', '0000-00-00', 1),
(106, '40001', 'Penjualan Barang', 8, '0000-00-00', 24, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(107, '40002', 'Penjualan Jasa', 8, '0000-00-00', 24, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(109, '42000', 'Potongan Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '2', '0000-00-00', 1),
(110, '41000', 'Retur Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(111, '51000', 'Harga Pokok Penjualan', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '3975452', '0000-00-00', 1),
(112, '52000', 'Biaya Angkut Pembelian', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '313803097', '0000-00-00', 1),
(113, '53000', 'Potongan Pembelian', 13, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(114, '61001', 'Beban Penyusutan Tanah', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(115, '61002', 'Beban Penyusutan Bangunan', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(116, '61003', 'Beban Penyusutan Peralatan Kantor', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(117, '61005', 'Beban Penyusutan Kendaraan', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(118, '61006', 'Beban Penyusutan Mesin & Peralatan Kerja', 14, '0000-00-00', 25, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(119, '62001', 'Biaya Listrik', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(120, '62002', 'Biaya PAM', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(121, '62003', 'Biaya Telpon', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(122, '62004', 'Biaya Pulsa', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(123, '62005', 'Biaya Gaji Karyawan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1467600000', '0000-00-00', 1),
(124, '62006', 'Biaya Pemasaran', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(125, '62007', 'Biaya Alat Tulis Kantor', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '9964598', '0000-00-00', 1),
(126, '62008', 'Biaya Fotocopy', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1100000', '0000-00-00', 1),
(127, '62009', 'Biaya Internet', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '1320000', '0000-00-00', 1),
(128, '62010', 'Biaya Bahan Bakar', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '3472357', '0000-00-00', 1),
(129, '62011', 'Biaya Parkir', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(130, '62012', 'Biaya Makan Bersama', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '867605', '0000-00-00', 1),
(131, '62013', 'Biaya Iuran Kebersihan & Keamanan Bulanan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2395000', '0000-00-00', 1),
(132, '62014', 'Biaya Pemeliharaan Bangunan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '34055350', '0000-00-00', 1),
(133, '62015', 'Biaya Pemeliharaan Peralatan Kantor', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '4876000', '0000-00-00', 1),
(134, '62016', 'Biaya Pemeliharaan Peralatan Toko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '488000', '0000-00-00', 1),
(135, '62017', 'Biaya Pemeliharaan Kendaraan', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '45493184', '0000-00-00', 1),
(136, '62018', 'Biaya Pemeliharaan Mesin & Peralatan Kerja', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2250000', '0000-00-00', 1),
(137, '62019', 'Biaya Lain - Lain Toko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2036843288', '0000-00-00', 1),
(138, '62020', 'Biaya MGK', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(139, '62021', 'Biaya Asuransi', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '2960000', '0000-00-00', 1),
(140, '62022', 'Biaya Sewa Ruko', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(141, '62023', 'Biaya Tilang', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '600000', '0000-00-00', 1),
(142, '62024', 'Biaya THR', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '122300000', '0000-00-00', 1),
(143, '62025', 'Biaya Perlengkapan Toko', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(144, '63001', 'Biaya Kirim TIKI', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '675000', '0000-00-00', 1),
(145, '63002', 'Biaya Kirim Amalindo', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '220102814', '0000-00-00', 1),
(146, '63003', 'Biaya Kirim DHL', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '106542487', '0000-00-00', 1),
(147, '63004', 'Biaya Kirim TNT', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '204916271', '0000-00-00', 1),
(148, '63006', 'Biaya Kirim Lain Lain', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '115822940', '0000-00-00', 1),
(149, '63005', 'Biaya Kirim NNR', 14, '0000-00-00', 27, 0, 0, 0, '', '', '', '', '', '41104780', '0000-00-00', 1),
(150, '64000', 'Biaya Supplies', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(151, '65001', 'Komisi Penjualan Tina', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(152, '65002', 'Komisi Penjualan Joko', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(153, '65003', 'Komisi Penjualan Edwin', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(154, '65004', 'Komisi Penjualan Lain - Lain', 14, '0000-00-00', 28, 0, 0, 0, '', '', '', '', '', '545885866', '0000-00-00', 1),
(155, '71001', 'Pendapatan Bunga Bank', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(156, '71002', 'Penjualan Aktiva Tetap', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(157, '71003', 'Pendapatan Lain Lain', 16, '0000-00-00', 29, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(158, '72001', 'Biaya Administrasi Bank', 15, '0000-00-00', 30, 0, 0, 0, '', '', '', '', '', '141200', '0000-00-00', 1),
(159, '72002', 'Pajak Bunga Bank', 15, '0000-00-00', 30, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(160, '73000', 'Laba Rugi Terealisasi', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(161, '74000', 'Laba / Rugi Belum terealisasi', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(162, '75000', 'Selisih Kurs', 15, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(163, '80000', 'Unbilled Goods', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(164, '80002', 'Lebih Bayar Penjualan', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '60011600', '0000-00-00', 1),
(165, '80003', 'Kurang Bayar Pembelian', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(166, '81003', 'Unbilled goods', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '0000-00-00', 1),
(179, '40000.01', 'Penjualan', 8, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-27871323466', '0000-00-00', 1),
(180, '89889889', 'penyusutan', 2, '0000-00-00', 22, 0, 0, 0, '', '', '', '', '-', '0', '2020-04-22', 1),
(181, '24000', 'Ppn Keluaran', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-934108815', '0000-00-00', 1),
(182, '16100', 'Ppn Masukan', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '279549408.9', '2020-07-14', 1),
(183, '24000', 'PPn keluaran', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '2020-07-14', 0),
(184, '62026', 'Biaya Entertain', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '284124141', '2020-07-14', 1),
(185, '11021', 'KAS KECIL', 9, '0000-00-00', 15, 0, 0, 0, '', '', '', '', '', '0', '2020-07-15', 0),
(186, '20003', 'Hutang Pak dhany', 4, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '-927286531', '2020-07-28', 1),
(187, '66000', 'Biaya asuransi', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '0', '2020-09-16', 1),
(188, '66001', 'Biaya Asuransi gedung', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '4745300', '2020-09-16', 1),
(189, '66002', 'Biaya asuransi bpjs ketenagakerjaan', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '84059400', '2020-09-16', 1),
(190, '66003', 'Biaya asuransi bpjs kesehatan', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '46134900', '2020-09-16', 1),
(191, '66004', 'Biaya asuransi mobil', 14, '0000-00-00', 187, 0, 0, 0, '', '', '', '', '', '22861770', '2020-09-16', 1),
(192, '11021', 'Kas kecil', 9, '0000-00-00', 16, 0, 0, 0, '', '', '', '', '', '407668755', '2020-09-16', 1),
(193, '16200', 'PPH pasal 21/25', 12, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '126615791', '0000-00-00', 1),
(194, '82000', 'PPh pasal 29', 5, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '8270800', '2020-09-16', 1),
(195, '62020', 'Biaya pbb', 14, '0000-00-00', 26, 0, 0, 0, '', '', '', '', '', '927500', '2020-09-16', 1),
(196, '62027', 'Biaya Percetakan', 14, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '4025000', '2020-09-16', 1),
(197, '33000', 'Opening Balance Equity', 7, '0000-00-00', 0, 0, 0, 0, '', '', '', '', '', '57713470', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` bigint(20) UNSIGNED NOT NULL,
  `rekam_medik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_st` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_nd` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rek` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ktp` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `suku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pict` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `cabang_id`, `rekam_medik`, `nama`, `no_telp`, `telp_st`, `telp_nd`, `no_rek`, `nik_ktp`, `email`, `tempat_lahir`, `tgl_lahir`, `jk`, `suku`, `alamat`, `pekerjaan`, `pict`, `is_active`, `created_at`, `deleted_at`, `updated_at`) VALUES
(1, 4, 1, '', 'Gustopa Muhamad Irsad', '1241243252', NULL, NULL, '1137567567', '32064657565', 'gbhagodua@gmail.com', 'Jakarta', '2000-01-11', 'Laki-Laki', 'Sunda', 'Jakarta', 'Pelajar', 'images/patients/P4A8v8Sy2wgWdyB.jpg', 1, '2021-10-11 03:47:55', NULL, '2021-10-11 03:47:55'),
(2, 4, 1, '', 'Marliya Rahayu', '1241243252', NULL, NULL, '8746464564', '74638736473', 'marliya@gmail.com', 'Jakarta', '1998-09-30', 'Perempuan', 'Sunda', 'Jakarta', 'Pelajar', 'images/patients/5j7RKfmRLvPdRTd.jpg', 1, '2021-10-11 07:28:46', NULL, '2021-10-11 07:28:46'),
(3, 4, 1, '', 'Rahma', '8374626232', NULL, NULL, '112243434', '12324344', 'rahma@gmail.com', 'Jakarta', '2011-10-01', 'Perempuan', 'Sunda', 'Jakarta', 'Pelajar', 'images/patients/kx3v3XSpW2AX95q.jpg', 1, '2021-10-11 08:53:34', NULL, '2021-10-11 08:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `detail_tukar_faktur`
--

CREATE TABLE `detail_tukar_faktur` (
  `id_detail_tukar_faktur` int(250) NOT NULL,
  `no_faktur` varchar(250) NOT NULL,
  `pilihan` enum('Ya','Tidak','','') DEFAULT NULL,
  `id_dokumen` int(250) NOT NULL,
  `is_active` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_tukar_faktur`
--

CREATE TABLE `dokumen_tukar_faktur` (
  `id_dokumen` int(11) NOT NULL,
  `nama_dokumen` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_tukar_faktur`
--

INSERT INTO `dokumen_tukar_faktur` (`id_dokumen`, `nama_dokumen`, `is_active`) VALUES
(1, 'Kwitansi/ Invoice Bermaterai', 1),
(2, 'Faktur Pajak', 1),
(3, 'Copy PO/SPK', 1),
(4, 'Surat Jalan Asli (Supplier)', 1),
(5, 'Laporan Progress (Kontraktor)', 1),
(6, 'Sertifikat Pembayaran (Kontraktor)', 1),
(7, 'Bast (Kontraktor)', 1);

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
-- Table structure for table `fisiks`
--

CREATE TABLE `fisiks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `gol_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tekanan_darah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pny_jantung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `diabetes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `haemopilia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `hepatitis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `gastring` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `pny_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `alergi_obat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `alergi_makanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Ada',
  `ket_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_tekanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_obat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_makanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fisiks`
--

INSERT INTO `fisiks` (`id`, `customer_id`, `gol_darah`, `tekanan_darah`, `pny_jantung`, `diabetes`, `haemopilia`, `hepatitis`, `gastring`, `pny_lainnya`, `alergi_obat`, `alergi_makanan`, `ket_lainnya`, `ket_tekanan`, `ket_obat`, `ket_makanan`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '110/70', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', '-', NULL, '-', '-', '2021-10-11 03:47:55', '2021-10-11 03:50:22'),
(2, 2, 'B', '120/70', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', 'Tidak Ada', '-', NULL, '-', '-', '2021-10-11 07:28:46', '2021-10-11 07:32:22'),
(3, 3, 'A', '120/70', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Asma', 'Normal', 'Obat Pilek', 'Udang', '2021-10-11 08:53:34', '2021-10-11 08:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `gigipasien`
--

CREATE TABLE `gigipasien` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `p11c` varchar(32) NOT NULL DEFAULT 'sou',
  `p11t` varchar(32) NOT NULL DEFAULT 'sou',
  `p11b` varchar(32) NOT NULL DEFAULT 'sou',
  `p11l` varchar(32) NOT NULL DEFAULT 'sou',
  `p11r` varchar(32) NOT NULL DEFAULT 'sou',
  `p12c` varchar(32) NOT NULL DEFAULT 'sou',
  `p12t` varchar(32) NOT NULL DEFAULT 'sou',
  `p12b` varchar(32) NOT NULL DEFAULT 'sou',
  `p12l` varchar(32) NOT NULL DEFAULT 'sou',
  `p12r` varchar(32) NOT NULL DEFAULT 'sou',
  `p13c` varchar(32) NOT NULL DEFAULT 'sou',
  `p13t` varchar(32) NOT NULL DEFAULT 'sou',
  `p13b` varchar(32) NOT NULL DEFAULT 'sou',
  `p13l` varchar(32) NOT NULL DEFAULT 'sou',
  `p13r` varchar(32) NOT NULL DEFAULT 'sou',
  `p14c` varchar(32) NOT NULL DEFAULT 'sou',
  `p14t` varchar(32) NOT NULL DEFAULT 'sou',
  `p14b` varchar(32) NOT NULL DEFAULT 'sou',
  `p14l` varchar(32) NOT NULL DEFAULT 'sou',
  `p14r` varchar(32) NOT NULL DEFAULT 'sou',
  `p15c` varchar(32) NOT NULL DEFAULT 'sou',
  `p15t` varchar(32) NOT NULL DEFAULT 'sou',
  `p15b` varchar(32) NOT NULL DEFAULT 'sou',
  `p15l` varchar(32) NOT NULL DEFAULT 'sou',
  `p15r` varchar(32) NOT NULL DEFAULT 'sou',
  `p16c` varchar(32) NOT NULL DEFAULT 'sou',
  `p16t` varchar(32) NOT NULL DEFAULT 'sou',
  `p16b` varchar(32) NOT NULL DEFAULT 'sou',
  `p16l` varchar(32) NOT NULL DEFAULT 'sou',
  `p16r` varchar(32) NOT NULL DEFAULT 'sou',
  `p17c` varchar(32) NOT NULL DEFAULT 'sou',
  `p17t` varchar(32) NOT NULL DEFAULT 'sou',
  `p17b` varchar(32) NOT NULL DEFAULT 'sou',
  `p17l` varchar(32) NOT NULL DEFAULT 'sou',
  `p17r` varchar(32) NOT NULL DEFAULT 'sou',
  `p18c` varchar(32) NOT NULL DEFAULT 'sou',
  `p18t` varchar(32) NOT NULL DEFAULT 'sou',
  `p18b` varchar(32) NOT NULL DEFAULT 'sou',
  `p18l` varchar(32) NOT NULL DEFAULT 'sou',
  `p18r` varchar(32) NOT NULL DEFAULT 'sou',
  `p21c` varchar(32) NOT NULL DEFAULT 'sou',
  `p21t` varchar(32) NOT NULL DEFAULT 'sou',
  `p21b` varchar(32) NOT NULL DEFAULT 'sou',
  `p21l` varchar(32) NOT NULL DEFAULT 'sou',
  `p21r` varchar(32) NOT NULL DEFAULT 'sou',
  `p22c` varchar(32) NOT NULL DEFAULT 'sou',
  `p22t` varchar(32) NOT NULL DEFAULT 'sou',
  `p22b` varchar(32) NOT NULL DEFAULT 'sou',
  `p22l` varchar(32) NOT NULL DEFAULT 'sou',
  `p22r` varchar(32) NOT NULL DEFAULT 'sou',
  `p23c` varchar(32) NOT NULL DEFAULT 'sou',
  `p23t` varchar(32) NOT NULL DEFAULT 'sou',
  `p23b` varchar(32) NOT NULL DEFAULT 'sou',
  `p23l` varchar(32) NOT NULL DEFAULT 'sou',
  `p23r` varchar(32) NOT NULL DEFAULT 'sou',
  `p24c` varchar(32) NOT NULL DEFAULT 'sou',
  `p24t` varchar(32) NOT NULL DEFAULT 'sou',
  `p24b` varchar(32) NOT NULL DEFAULT 'sou',
  `p24l` varchar(32) NOT NULL DEFAULT 'sou',
  `p24r` varchar(32) NOT NULL DEFAULT 'sou',
  `p25c` varchar(32) NOT NULL DEFAULT 'sou',
  `p25t` varchar(32) NOT NULL DEFAULT 'sou',
  `p25b` varchar(32) NOT NULL DEFAULT 'sou',
  `p25l` varchar(32) NOT NULL DEFAULT 'sou',
  `p25r` varchar(32) NOT NULL DEFAULT 'sou',
  `p26c` varchar(32) NOT NULL DEFAULT 'sou',
  `p26t` varchar(32) NOT NULL DEFAULT 'sou',
  `p26b` varchar(32) NOT NULL DEFAULT 'sou',
  `p26l` varchar(32) NOT NULL DEFAULT 'sou',
  `p26r` varchar(32) NOT NULL DEFAULT 'sou',
  `p27c` varchar(32) NOT NULL DEFAULT 'sou',
  `p27t` varchar(32) NOT NULL DEFAULT 'sou',
  `p27b` varchar(32) NOT NULL DEFAULT 'sou',
  `p27l` varchar(32) NOT NULL DEFAULT 'sou',
  `p27r` varchar(32) NOT NULL DEFAULT 'sou',
  `p28c` varchar(32) NOT NULL DEFAULT 'sou',
  `p28t` varchar(32) NOT NULL DEFAULT 'sou',
  `p28b` varchar(32) NOT NULL DEFAULT 'sou',
  `p28l` varchar(32) NOT NULL DEFAULT 'sou',
  `p28r` varchar(32) NOT NULL DEFAULT 'sou',
  `p51c` varchar(32) NOT NULL DEFAULT 'sou',
  `p51t` varchar(32) NOT NULL DEFAULT 'sou',
  `p51b` varchar(32) NOT NULL DEFAULT 'sou',
  `p51l` varchar(32) NOT NULL DEFAULT 'sou',
  `p51r` varchar(32) NOT NULL DEFAULT 'sou',
  `p52c` varchar(32) NOT NULL DEFAULT 'sou',
  `p52t` varchar(32) NOT NULL DEFAULT 'sou',
  `p52b` varchar(32) NOT NULL DEFAULT 'sou',
  `p52l` varchar(32) NOT NULL DEFAULT 'sou',
  `p52r` varchar(32) NOT NULL DEFAULT 'sou',
  `p53c` varchar(32) NOT NULL DEFAULT 'sou',
  `p53t` varchar(32) NOT NULL DEFAULT 'sou',
  `p53b` varchar(32) NOT NULL DEFAULT 'sou',
  `p53l` varchar(32) NOT NULL DEFAULT 'sou',
  `p53r` varchar(32) NOT NULL DEFAULT 'sou',
  `p54c` varchar(32) NOT NULL DEFAULT 'sou',
  `p54t` varchar(32) NOT NULL DEFAULT 'sou',
  `p54b` varchar(32) NOT NULL DEFAULT 'sou',
  `p54l` varchar(32) NOT NULL DEFAULT 'sou',
  `p54r` varchar(32) NOT NULL DEFAULT 'sou',
  `p55c` varchar(32) NOT NULL DEFAULT 'sou',
  `p55t` varchar(32) NOT NULL DEFAULT 'sou',
  `p55b` varchar(32) NOT NULL DEFAULT 'sou',
  `p55l` varchar(32) NOT NULL DEFAULT 'sou',
  `p55r` varchar(32) NOT NULL DEFAULT 'sou',
  `p61c` varchar(32) NOT NULL DEFAULT 'sou',
  `p61t` varchar(32) NOT NULL DEFAULT 'sou',
  `p61b` varchar(32) NOT NULL DEFAULT 'sou',
  `p61l` varchar(32) NOT NULL DEFAULT 'sou',
  `p61r` varchar(32) NOT NULL DEFAULT 'sou',
  `p62c` varchar(32) NOT NULL DEFAULT 'sou',
  `p62t` varchar(32) NOT NULL DEFAULT 'sou',
  `p62b` varchar(32) NOT NULL DEFAULT 'sou',
  `p62l` varchar(32) NOT NULL DEFAULT 'sou',
  `p62r` varchar(32) NOT NULL DEFAULT 'sou',
  `p63c` varchar(32) NOT NULL DEFAULT 'sou',
  `p63t` varchar(32) NOT NULL DEFAULT 'sou',
  `p63b` varchar(32) NOT NULL DEFAULT 'sou',
  `p63l` varchar(32) NOT NULL DEFAULT 'sou',
  `p63r` varchar(32) NOT NULL DEFAULT 'sou',
  `p64c` varchar(32) NOT NULL DEFAULT 'sou',
  `p64t` varchar(32) NOT NULL DEFAULT 'sou',
  `p64b` varchar(32) NOT NULL DEFAULT 'sou',
  `p64l` varchar(32) NOT NULL DEFAULT 'sou',
  `p64r` varchar(32) NOT NULL DEFAULT 'sou',
  `p65c` varchar(32) NOT NULL DEFAULT 'sou',
  `p65t` varchar(32) NOT NULL DEFAULT 'sou',
  `p65b` varchar(32) NOT NULL DEFAULT 'sou',
  `p65l` varchar(32) NOT NULL DEFAULT 'sou',
  `p65r` varchar(32) NOT NULL DEFAULT 'sou',
  `p81c` varchar(32) NOT NULL DEFAULT 'sou',
  `p81t` varchar(32) NOT NULL DEFAULT 'sou',
  `p81b` varchar(32) NOT NULL DEFAULT 'sou',
  `p81l` varchar(32) NOT NULL DEFAULT 'sou',
  `p81r` varchar(32) NOT NULL DEFAULT 'sou',
  `p82c` varchar(32) NOT NULL DEFAULT 'sou',
  `p82t` varchar(32) NOT NULL DEFAULT 'sou',
  `p82b` varchar(32) NOT NULL DEFAULT 'sou',
  `p82l` varchar(32) NOT NULL DEFAULT 'sou',
  `p82r` varchar(32) NOT NULL DEFAULT 'sou',
  `p83c` varchar(32) NOT NULL DEFAULT 'sou',
  `p83t` varchar(32) NOT NULL DEFAULT 'sou',
  `p83b` varchar(32) NOT NULL DEFAULT 'sou',
  `p83l` varchar(32) NOT NULL DEFAULT 'sou',
  `p83r` varchar(32) NOT NULL DEFAULT 'sou',
  `p84c` varchar(32) NOT NULL DEFAULT 'sou',
  `p84t` varchar(32) NOT NULL DEFAULT 'sou',
  `p84b` varchar(32) NOT NULL DEFAULT 'sou',
  `p84l` varchar(32) NOT NULL DEFAULT 'sou',
  `p84r` varchar(32) NOT NULL DEFAULT 'sou',
  `p85c` varchar(32) NOT NULL DEFAULT 'sou',
  `p85t` varchar(32) NOT NULL DEFAULT 'sou',
  `p85b` varchar(32) NOT NULL DEFAULT 'sou',
  `p85l` varchar(32) NOT NULL DEFAULT 'sou',
  `p85r` varchar(32) NOT NULL DEFAULT 'sou',
  `p71c` varchar(32) NOT NULL DEFAULT 'sou',
  `p71t` varchar(32) NOT NULL DEFAULT 'sou',
  `p71b` varchar(32) NOT NULL DEFAULT 'sou',
  `p71l` varchar(32) NOT NULL DEFAULT 'sou',
  `p71r` varchar(32) NOT NULL DEFAULT 'sou',
  `p72c` varchar(32) NOT NULL DEFAULT 'sou',
  `p72t` varchar(32) NOT NULL DEFAULT 'sou',
  `p72b` varchar(32) NOT NULL DEFAULT 'sou',
  `p72l` varchar(32) NOT NULL DEFAULT 'sou',
  `p72r` varchar(32) NOT NULL DEFAULT 'sou',
  `p73c` varchar(32) NOT NULL DEFAULT 'sou',
  `p73t` varchar(32) NOT NULL DEFAULT 'sou',
  `p73b` varchar(32) NOT NULL DEFAULT 'sou',
  `p73l` varchar(32) NOT NULL DEFAULT 'sou',
  `p73r` varchar(32) NOT NULL DEFAULT 'sou',
  `p74c` varchar(32) NOT NULL DEFAULT 'sou',
  `p74t` varchar(32) NOT NULL DEFAULT 'sou',
  `p74b` varchar(32) NOT NULL DEFAULT 'sou',
  `p74l` varchar(32) NOT NULL DEFAULT 'sou',
  `p74r` varchar(32) NOT NULL DEFAULT 'sou',
  `p75c` varchar(32) NOT NULL DEFAULT 'sou',
  `p75t` varchar(32) NOT NULL DEFAULT 'sou',
  `p75b` varchar(32) NOT NULL DEFAULT 'sou',
  `p75l` varchar(32) NOT NULL DEFAULT 'sou',
  `p75r` varchar(32) NOT NULL DEFAULT 'sou',
  `p41c` varchar(32) NOT NULL DEFAULT 'sou',
  `p41t` varchar(32) NOT NULL DEFAULT 'sou',
  `p41b` varchar(32) NOT NULL DEFAULT 'sou',
  `p41l` varchar(32) NOT NULL DEFAULT 'sou',
  `p41r` varchar(32) NOT NULL DEFAULT 'sou',
  `p42c` varchar(32) NOT NULL DEFAULT 'sou',
  `p42t` varchar(32) NOT NULL DEFAULT 'sou',
  `p42b` varchar(32) NOT NULL DEFAULT 'sou',
  `p42l` varchar(32) NOT NULL DEFAULT 'sou',
  `p42r` varchar(32) NOT NULL DEFAULT 'sou',
  `p43c` varchar(32) NOT NULL DEFAULT 'sou',
  `p43t` varchar(32) NOT NULL DEFAULT 'sou',
  `p43b` varchar(32) NOT NULL DEFAULT 'sou',
  `p43l` varchar(32) NOT NULL DEFAULT 'sou',
  `p43r` varchar(32) NOT NULL DEFAULT 'sou',
  `p44c` varchar(32) NOT NULL DEFAULT 'sou',
  `p44t` varchar(32) NOT NULL DEFAULT 'sou',
  `p44b` varchar(32) NOT NULL DEFAULT 'sou',
  `p44l` varchar(32) NOT NULL DEFAULT 'sou',
  `p44r` varchar(32) NOT NULL DEFAULT 'sou',
  `p45c` varchar(32) NOT NULL DEFAULT 'sou',
  `p45t` varchar(32) NOT NULL DEFAULT 'sou',
  `p45b` varchar(32) NOT NULL DEFAULT 'sou',
  `p45l` varchar(32) NOT NULL DEFAULT 'sou',
  `p45r` varchar(32) NOT NULL DEFAULT 'sou',
  `p46c` varchar(32) NOT NULL DEFAULT 'sou',
  `p46t` varchar(32) NOT NULL DEFAULT 'sou',
  `p46b` varchar(32) NOT NULL DEFAULT 'sou',
  `p46l` varchar(32) NOT NULL DEFAULT 'sou',
  `p46r` varchar(32) NOT NULL DEFAULT 'sou',
  `p47c` varchar(32) NOT NULL DEFAULT 'sou',
  `p47t` varchar(32) NOT NULL DEFAULT 'sou',
  `p47b` varchar(32) NOT NULL DEFAULT 'sou',
  `p47l` varchar(32) NOT NULL DEFAULT 'sou',
  `p47r` varchar(32) NOT NULL DEFAULT 'sou',
  `p48c` varchar(32) NOT NULL DEFAULT 'sou',
  `p48t` varchar(32) NOT NULL DEFAULT 'sou',
  `p48b` varchar(32) NOT NULL DEFAULT 'sou',
  `p48l` varchar(32) NOT NULL DEFAULT 'sou',
  `p48r` varchar(32) NOT NULL DEFAULT 'sou',
  `p31c` varchar(32) NOT NULL DEFAULT 'sou',
  `p31t` varchar(32) NOT NULL DEFAULT 'sou',
  `p31b` varchar(32) NOT NULL DEFAULT 'sou',
  `p31l` varchar(32) NOT NULL DEFAULT 'sou',
  `p31r` varchar(32) NOT NULL DEFAULT 'sou',
  `p32c` varchar(32) NOT NULL DEFAULT 'sou',
  `p32t` varchar(32) NOT NULL DEFAULT 'sou',
  `p32b` varchar(32) NOT NULL DEFAULT 'sou',
  `p32l` varchar(32) NOT NULL DEFAULT 'sou',
  `p32r` varchar(32) NOT NULL DEFAULT 'sou',
  `p33c` varchar(32) NOT NULL DEFAULT 'sou',
  `p33t` varchar(32) NOT NULL DEFAULT 'sou',
  `p33b` varchar(32) NOT NULL DEFAULT 'sou',
  `p33l` varchar(32) NOT NULL DEFAULT 'sou',
  `p33r` varchar(32) NOT NULL DEFAULT 'sou',
  `p34c` varchar(32) NOT NULL DEFAULT 'sou',
  `p34t` varchar(32) NOT NULL DEFAULT 'sou',
  `p34b` varchar(32) NOT NULL DEFAULT 'sou',
  `p34l` varchar(32) NOT NULL DEFAULT 'sou',
  `p34r` varchar(32) NOT NULL DEFAULT 'sou',
  `p35c` varchar(32) NOT NULL DEFAULT 'sou',
  `p35t` varchar(32) NOT NULL DEFAULT 'sou',
  `p35b` varchar(32) NOT NULL DEFAULT 'sou',
  `p35l` varchar(32) NOT NULL DEFAULT 'sou',
  `p35r` varchar(32) NOT NULL DEFAULT 'sou',
  `p36c` varchar(32) NOT NULL DEFAULT 'sou',
  `p36t` varchar(32) NOT NULL DEFAULT 'sou',
  `p36b` varchar(32) NOT NULL DEFAULT 'sou',
  `p36l` varchar(32) NOT NULL DEFAULT 'sou',
  `p36r` varchar(32) NOT NULL DEFAULT 'sou',
  `p37c` varchar(32) NOT NULL DEFAULT 'sou',
  `p37t` varchar(32) NOT NULL DEFAULT 'sou',
  `p37b` varchar(32) NOT NULL DEFAULT 'sou',
  `p37l` varchar(32) NOT NULL DEFAULT 'sou',
  `p37r` varchar(32) NOT NULL DEFAULT 'sou',
  `p38c` varchar(32) NOT NULL DEFAULT 'sou',
  `p38t` varchar(32) NOT NULL DEFAULT 'sou',
  `p38b` varchar(32) NOT NULL DEFAULT 'sou',
  `p38l` varchar(32) NOT NULL DEFAULT 'sou',
  `p38r` varchar(32) NOT NULL DEFAULT 'sou',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gigipasien`
--

INSERT INTO `gigipasien` (`id`, `customer_id`, `p11c`, `p11t`, `p11b`, `p11l`, `p11r`, `p12c`, `p12t`, `p12b`, `p12l`, `p12r`, `p13c`, `p13t`, `p13b`, `p13l`, `p13r`, `p14c`, `p14t`, `p14b`, `p14l`, `p14r`, `p15c`, `p15t`, `p15b`, `p15l`, `p15r`, `p16c`, `p16t`, `p16b`, `p16l`, `p16r`, `p17c`, `p17t`, `p17b`, `p17l`, `p17r`, `p18c`, `p18t`, `p18b`, `p18l`, `p18r`, `p21c`, `p21t`, `p21b`, `p21l`, `p21r`, `p22c`, `p22t`, `p22b`, `p22l`, `p22r`, `p23c`, `p23t`, `p23b`, `p23l`, `p23r`, `p24c`, `p24t`, `p24b`, `p24l`, `p24r`, `p25c`, `p25t`, `p25b`, `p25l`, `p25r`, `p26c`, `p26t`, `p26b`, `p26l`, `p26r`, `p27c`, `p27t`, `p27b`, `p27l`, `p27r`, `p28c`, `p28t`, `p28b`, `p28l`, `p28r`, `p51c`, `p51t`, `p51b`, `p51l`, `p51r`, `p52c`, `p52t`, `p52b`, `p52l`, `p52r`, `p53c`, `p53t`, `p53b`, `p53l`, `p53r`, `p54c`, `p54t`, `p54b`, `p54l`, `p54r`, `p55c`, `p55t`, `p55b`, `p55l`, `p55r`, `p61c`, `p61t`, `p61b`, `p61l`, `p61r`, `p62c`, `p62t`, `p62b`, `p62l`, `p62r`, `p63c`, `p63t`, `p63b`, `p63l`, `p63r`, `p64c`, `p64t`, `p64b`, `p64l`, `p64r`, `p65c`, `p65t`, `p65b`, `p65l`, `p65r`, `p81c`, `p81t`, `p81b`, `p81l`, `p81r`, `p82c`, `p82t`, `p82b`, `p82l`, `p82r`, `p83c`, `p83t`, `p83b`, `p83l`, `p83r`, `p84c`, `p84t`, `p84b`, `p84l`, `p84r`, `p85c`, `p85t`, `p85b`, `p85l`, `p85r`, `p71c`, `p71t`, `p71b`, `p71l`, `p71r`, `p72c`, `p72t`, `p72b`, `p72l`, `p72r`, `p73c`, `p73t`, `p73b`, `p73l`, `p73r`, `p74c`, `p74t`, `p74b`, `p74l`, `p74r`, `p75c`, `p75t`, `p75b`, `p75l`, `p75r`, `p41c`, `p41t`, `p41b`, `p41l`, `p41r`, `p42c`, `p42t`, `p42b`, `p42l`, `p42r`, `p43c`, `p43t`, `p43b`, `p43l`, `p43r`, `p44c`, `p44t`, `p44b`, `p44l`, `p44r`, `p45c`, `p45t`, `p45b`, `p45l`, `p45r`, `p46c`, `p46t`, `p46b`, `p46l`, `p46r`, `p47c`, `p47t`, `p47b`, `p47l`, `p47r`, `p48c`, `p48t`, `p48b`, `p48l`, `p48r`, `p31c`, `p31t`, `p31b`, `p31l`, `p31r`, `p32c`, `p32t`, `p32b`, `p32l`, `p32r`, `p33c`, `p33t`, `p33b`, `p33l`, `p33r`, `p34c`, `p34t`, `p34b`, `p34l`, `p34r`, `p35c`, `p35t`, `p35b`, `p35l`, `p35r`, `p36c`, `p36t`, `p36b`, `p36l`, `p36r`, `p37c`, `p37t`, `p37b`, `p37l`, `p37r`, `p38c`, `p38t`, `p38b`, `p38l`, `p38r`, `created_at`, `updated_at`) VALUES
(1, 1, 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'amf', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', '2021-10-11 03:50:07', '2021-10-11 10:50:07'),
(2, 2, 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'A', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', '2021-10-11 07:32:41', '2021-10-11 14:32:41'),
(3, 3, 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'cnm', 'cnm', 'cnm', 'cnm', 'cnm', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', 'sou', '2021-10-11 08:58:59', '2021-10-11 15:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `harga_produk_cabangs`
--

CREATE TABLE `harga_produk_cabangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `harga` bigint(20) NOT NULL,
  `lokasi_barang` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `harga_produk_cabangs`
--

INSERT INTO `harga_produk_cabangs` (`id`, `project_id`, `barang_id`, `harga`, `lokasi_barang`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 200000, 'Lantai 1', 20, '2022-02-11 02:19:38', NULL),
(2, 2, 1, 200000, 'lantai2', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holding`
--

CREATE TABLE `holding` (
  `id_holding` int(1) NOT NULL,
  `nama_holding` varchar(20) NOT NULL,
  `status_holding` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holding`
--

INSERT INTO `holding` (`id_holding`, `nama_holding`, `status_holding`) VALUES
(1, 'YAZFI GRUP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `holiday_date` date NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `booking_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'pasien/images/11102021105148-38598.jpg', '2021-10-11 03:51:48', '2021-10-11 03:51:48'),
(2, 3, 'pasien/images/11102021105148-download.jpg', '2021-10-11 03:51:48', '2021-10-11 03:51:48'),
(3, 4, 'pasien/images/11102021143335-38598.jpg', '2021-10-11 07:33:35', '2021-10-11 07:33:35'),
(4, 4, 'pasien/images/11102021143335-download.jpg', '2021-10-11 07:33:35', '2021-10-11 07:33:35'),
(5, 4, 'pasien/images/11102021143335-kisspng-user-profile-computer-icons-user-interface-mystique-5aceb0245aa097.2885333015234949483712.jpg', '2021-10-11 07:33:35', '2021-10-11 07:33:35'),
(6, 5, 'pasien/images/11102021160132-38598.jpg', '2021-10-11 09:01:32', '2021-10-11 09:01:32'),
(7, 5, 'pasien/images/11102021160132-download.jpg', '2021-10-11 09:01:32', '2021-10-11 09:01:32'),
(8, 5, 'pasien/images/11102021160132-kisspng-user-profile-computer-icons-user-interface-mystique-5aceb0245aa097.2885333015234949483712.jpg', '2021-10-11 09:01:32', '2021-10-11 09:01:32'),
(9, 5, 'pasien/images/11102021160132-Macbook-Air-2018.jpeg', '2021-10-11 09:01:32', '2021-10-11 09:01:32'),
(10, 5, 'pasien/images/12102021105732-kisspng-user-profile-computer-icons-user-interface-mystique-5aceb0245aa097.2885333015234949483712.jpg', '2021-10-12 03:57:32', '2021-10-12 03:57:32'),
(11, 5, 'pasien/images/12102021105732-Macbook-Air-2018.jpeg', '2021-10-12 03:57:32', '2021-10-12 03:57:32'),
(12, 5, 'pasien/images/12102021105732-pngtree-user-vector-avatar-png-image_1541962.jpg', '2021-10-12 03:57:32', '2021-10-12 03:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `in_outs`
--

CREATE TABLE `in_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `in` int(11) NOT NULL DEFAULT 0,
  `out` int(11) NOT NULL DEFAULT 0,
  `last_stok` int(250) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `in_outs`
--

INSERT INTO `in_outs` (`id`, `invoice`, `barang_id`, `supplier_id`, `project_id`, `user_id`, `in`, `out`, `last_stok`, `created_at`, `updated_at`) VALUES
(6, '121212', 2, 1, 1, 13, 1, 0, 0, '2022-02-15 04:40:05', NULL),
(8, 'INV12333', 1, 1, 1, 13, 1, 0, 0, '2022-02-15 09:43:25', NULL),
(9, 'INV12333', 2, 1, 1, 13, 10, 0, 0, '2022-02-15 09:43:25', NULL),
(10, 'PO/08/00008', 1, 2, 1, 13, 1, 0, 0, '2022-02-17 04:49:45', NULL),
(11, 'PO/09/00009', 1, 1, 2, 13, 1, 0, 0, '2022-02-18 03:50:37', NULL),
(12, 'PO/10/00010', 1, 1, 1, 13, 1, 0, 0, '2022-02-24 03:02:19', NULL),
(15, 'PO/11/00011', 1, 1, 1, 13, 2, 0, 0, '2022-02-24 03:26:49', NULL),
(16, 'PO/14/00014', 1, 1, 1, 13, 1, 0, 0, '2022-02-24 06:35:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatans`
--

CREATE TABLE `jabatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatans`
--

INSERT INTO `jabatans` (`id`, `nama`, `status`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 1, 1, '2022-02-18 03:01:42', NULL),
(2, 'Staff', 1, 1, '2022-02-18 03:01:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` bigint(20) UNSIGNED NOT NULL,
  `ruangan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `user_id`, `cabang_id`, `shift_id`, `ruangan_id`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 2, '2021-12-01', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(2, 3, 1, 1, 2, '2021-12-02', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(3, 3, 1, 1, 2, '2021-12-03', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(4, 3, 1, 1, 2, '2021-12-04', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(5, 3, 1, 1, 2, '2021-12-05', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(6, 3, 1, 1, 2, '2021-12-06', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(7, 3, 1, 1, 2, '2021-12-07', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(8, 3, 1, 1, 2, '2021-12-08', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(9, 3, 1, 1, 2, '2021-12-09', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(10, 3, 1, 1, 2, '2021-12-10', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(11, 3, 1, 1, 2, '2021-12-11', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(12, 3, 1, 1, 2, '2021-12-12', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(13, 3, 1, 1, 2, '2021-12-13', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(14, 3, 1, 1, 2, '2021-12-14', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(15, 3, 1, 1, 2, '2021-12-15', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(16, 3, 1, 1, 2, '2021-12-16', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(17, 3, 1, 1, 2, '2021-12-17', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(18, 3, 1, 1, 2, '2021-12-18', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(19, 3, 1, 1, 2, '2021-12-19', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(20, 3, 1, 1, 2, '2021-12-20', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(21, 3, 1, 1, 2, '2021-12-21', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(22, 3, 1, 1, 2, '2021-12-22', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(23, 3, 1, 1, 2, '2021-12-23', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(24, 3, 1, 1, 2, '2021-12-24', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(25, 3, 1, 1, 2, '2021-12-25', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(26, 3, 1, 1, 2, '2021-12-26', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(27, 3, 1, 1, 2, '2021-12-27', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(28, 3, 1, 1, 2, '2021-12-28', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(29, 3, 1, 1, 2, '2021-12-29', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(30, 3, 1, 1, 2, '2021-12-30', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(31, 3, 1, 1, 2, '2021-12-31', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(32, 5, 1, 1, 2, '2021-12-01', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(33, 5, 1, 1, 2, '2021-12-02', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(34, 5, 1, 1, 2, '2021-12-03', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(35, 5, 1, 1, 2, '2021-12-04', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(36, 5, 1, 1, 2, '2021-12-05', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(37, 5, 1, 1, 2, '2021-12-06', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(38, 5, 1, 1, 2, '2021-12-07', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(39, 5, 1, 1, 2, '2021-12-08', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(40, 5, 1, 1, 2, '2021-12-09', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(41, 5, 1, 1, 2, '2021-12-10', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(42, 5, 1, 1, 2, '2021-12-11', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(43, 5, 1, 1, 2, '2021-12-12', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(44, 5, 1, 1, 2, '2021-12-13', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(45, 5, 1, 1, 2, '2021-12-14', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(46, 5, 1, 1, 2, '2021-12-15', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(47, 5, 1, 1, 2, '2021-12-16', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(48, 5, 1, 1, 2, '2021-12-17', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(49, 5, 1, 1, 2, '2021-12-18', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(50, 5, 1, 1, 2, '2021-12-19', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(51, 5, 1, 1, 2, '2021-12-20', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(52, 5, 1, 1, 2, '2021-12-21', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(53, 5, 1, 1, 2, '2021-12-22', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(54, 5, 1, 1, 2, '2021-12-23', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(55, 5, 1, 1, 2, '2021-12-24', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(56, 5, 1, 1, 2, '2021-12-25', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(57, 5, 1, 1, 2, '2021-12-26', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(58, 5, 1, 1, 2, '2021-12-27', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(59, 5, 1, 1, 2, '2021-12-28', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(60, 5, 1, 1, 2, '2021-12-29', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(61, 5, 1, 1, 2, '2021-12-30', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(62, 5, 1, 1, 2, '2021-12-31', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(63, 6, 1, 1, 2, '2021-12-01', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(64, 6, 1, 1, 2, '2021-12-02', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(65, 6, 1, 1, 2, '2021-12-03', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(66, 6, 1, 1, 2, '2021-12-04', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(67, 6, 1, 1, 2, '2021-12-05', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(68, 6, 1, 1, 2, '2021-12-06', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(69, 6, 1, 1, 2, '2021-12-07', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(70, 6, 1, 1, 2, '2021-12-08', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(71, 6, 1, 1, 2, '2021-12-09', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(72, 6, 1, 1, 2, '2021-12-10', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(73, 6, 1, 1, 2, '2021-12-11', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(74, 6, 1, 1, 2, '2021-12-12', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(75, 6, 1, 1, 2, '2021-12-13', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(76, 6, 1, 1, 2, '2021-12-14', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(77, 6, 1, 1, 2, '2021-12-15', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(78, 6, 1, 1, 2, '2021-12-16', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(79, 6, 1, 1, 2, '2021-12-17', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(80, 6, 1, 1, 2, '2021-12-18', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(81, 6, 1, 1, 2, '2021-12-19', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(82, 6, 1, 1, 2, '2021-12-20', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(83, 6, 1, 1, 2, '2021-12-21', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(84, 6, 1, 1, 2, '2021-12-22', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(85, 6, 1, 1, 2, '2021-12-23', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(86, 6, 1, 1, 2, '2021-12-24', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(87, 6, 1, 1, 2, '2021-12-25', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(88, 6, 1, 1, 2, '2021-12-26', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(89, 6, 1, 1, 2, '2021-12-27', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(90, 6, 1, 1, 2, '2021-12-28', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(91, 6, 1, 1, 2, '2021-12-29', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(92, 6, 1, 1, 2, '2021-12-30', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(93, 6, 1, 1, 2, '2021-12-31', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(94, 9, 1, 1, 2, '2021-12-01', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(95, 9, 1, 1, 2, '2021-12-02', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(96, 9, 1, 1, 2, '2021-12-03', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(97, 9, 1, 1, 2, '2021-12-04', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(98, 9, 1, 1, 2, '2021-12-05', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(99, 9, 1, 1, 2, '2021-12-06', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(100, 9, 1, 1, 2, '2021-12-07', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(101, 9, 1, 1, 2, '2021-12-08', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(102, 9, 1, 1, 2, '2021-12-09', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(103, 9, 1, 1, 2, '2021-12-10', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(104, 9, 1, 1, 2, '2021-12-11', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(105, 9, 1, 1, 2, '2021-12-12', '2021-12-09 07:29:35', '2021-12-09 07:29:35'),
(106, 9, 1, 1, 2, '2021-12-13', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(107, 9, 1, 1, 2, '2021-12-14', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(108, 9, 1, 1, 2, '2021-12-15', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(109, 9, 1, 1, 2, '2021-12-16', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(110, 9, 1, 1, 2, '2021-12-17', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(111, 9, 1, 1, 2, '2021-12-18', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(112, 9, 1, 1, 2, '2021-12-19', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(113, 9, 1, 1, 2, '2021-12-20', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(114, 9, 1, 1, 2, '2021-12-21', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(115, 9, 1, 1, 2, '2021-12-22', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(116, 9, 1, 1, 2, '2021-12-23', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(117, 9, 1, 1, 2, '2021-12-24', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(118, 9, 1, 1, 2, '2021-12-25', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(119, 9, 1, 1, 2, '2021-12-26', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(120, 9, 1, 1, 2, '2021-12-27', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(121, 9, 1, 1, 2, '2021-12-28', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(122, 9, 1, 1, 2, '2021-12-29', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(123, 9, 1, 1, 2, '2021-12-30', '2021-12-09 07:29:36', '2021-12-09 07:29:36'),
(124, 9, 1, 1, 2, '2021-12-31', '2021-12-09 07:29:36', '2021-12-09 07:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `ket_odontograms`
--

CREATE TABLE `ket_odontograms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `occlusi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_palatinus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_mandibularis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `palatum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diastema` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anomali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_occlusi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_tp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_tm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_palatum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_diastema` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ket_anomali` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ket_odontograms`
--

INSERT INTO `ket_odontograms` (`id`, `customer_id`, `occlusi`, `t_palatinus`, `t_mandibularis`, `palatum`, `diastema`, `anomali`, `lain`, `d`, `m`, `f`, `ket_occlusi`, `ket_tp`, `ket_tm`, `ket_palatum`, `ket_diastema`, `ket_anomali`, `created_at`, `updated_at`) VALUES
(1, 2, 'Normal Bite', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-07 10:34:02'),
(2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-11 03:47:55', '2021-10-11 03:47:55'),
(4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-11 07:28:46', '2021-10-11 07:28:46'),
(5, 3, 'Normal Bite', 'Tidak Ada', 'Tidak Ada', 'Rendah', 'Tidak Ada', 'Tidak Ada', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-10-11 08:53:34', '2021-10-11 08:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `komisis`
--

CREATE TABLE `komisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `persentase` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_transaksi` bigint(20) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `komisis`
--

INSERT INTO `komisis` (`id`, `role_id`, `persentase`, `min_transaksi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 0, 1, '2021-07-21 05:53:55', '2021-08-13 15:49:13'),
(2, 2, '20', 0, 1, '2021-08-05 23:02:18', '2021-08-05 23:02:18'),
(3, 3, '1', 900000, 1, '2021-08-05 23:02:36', '2021-08-13 15:49:46'),
(4, 4, '1', 900000, 1, '2021-08-14 01:54:32', '2021-08-14 01:54:32'),
(5, 5, '0.25', 900000, 1, '2021-08-14 01:56:30', '2021-08-14 01:56:30'),
(6, 6, '1', 900000, 1, '2021-08-14 01:56:43', '2021-08-14 01:56:43');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_10_030934_create_permission_tables', 1),
(5, '2021_07_13_080413_create_barangs_table', 1),
(6, '2021_07_14_043218_create_harga_produk_cabangs_table', 1),
(7, '2021_07_15_030150_create_customers_table', 1),
(8, '2021_07_16_002514_create_payments_table', 1),
(9, '2021_07_16_021433_create_status_pasiens_table', 1),
(10, '2021_07_16_031117_create_vouchers_table', 1),
(11, '2021_07_17_022654_create_cabangs_table', 1),
(12, '2021_07_21_123541_create_komisis_table', 2),
(13, '2021_07_22_003352_create_ruangans_table', 3),
(14, '2021_07_26_023617_create_odontograms_table', 4),
(15, '2021_07_26_025104_add_field_to_odontograms_table', 5),
(16, '2021_07_26_033809_create_simbol_odontograms_table', 6),
(17, '2021_07_27_041134_create_rekam_medis_table', 7),
(19, '2021_07_29_012337_create_ket_odontograms_table', 8),
(21, '2021_08_02_031724_create_fisiks_table', 9),
(22, '2021_08_05_030713_create_bookings_table', 10),
(23, '2021_08_05_031124_create_tindakans_table', 10),
(24, '2021_08_05_031423_create_rincian_pembayarans_table', 10),
(25, '2021_10_05_095142_create_images_table', 11),
(26, '2021_10_11_140324_create_holidays_table', 12),
(27, '2021_10_11_140435_create_jadwals_table', 12),
(28, '2021_10_11_140609_create_rincian_komisi_table', 12),
(29, '2021_10_11_140720_create_setting_table', 12),
(30, '2021_10_11_140832_create_shifts_table', 12),
(31, '2021_12_06_163515_add_qty_to_harga_produk_cabangs_table', 12),
(32, '2021_12_06_164947_create_suppliers_table', 13),
(36, '2021_12_07_152729_create_purchases_table', 14),
(37, '2021_12_07_153425_create_in_outs_table', 14),
(38, '2021_12_10_104139_create_transfer_stoks_table', 15),
(42, '2021_12_10_104454_add_cabang_id_to_in_outs_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\User', 11),
(2, 'App\\User', 23),
(8, 'App\\User', 10),
(9, 'App\\User', 12),
(9, 'App\\User', 13),
(10, 'App\\User', 14);

-- --------------------------------------------------------

--
-- Table structure for table `mst_penerimaans`
--

CREATE TABLE `mst_penerimaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_penerimaans`
--

INSERT INTO `mst_penerimaans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'gaji pokok', '2021-12-07 07:44:13', '2021-12-07 07:44:13'),
(2, 'tujangan', '2021-12-07 07:44:13', '2021-12-07 07:44:13'),
(3, 'lembur', '2021-12-07 07:44:13', '2021-12-07 07:44:13'),
(4, 'transport', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(5, 'uang makan', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(6, 'bonus', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(7, 'infaq', '2021-12-08 03:03:05', '2021-12-08 03:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `mst_potongans`
--

CREATE TABLE `mst_potongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_potongans`
--

INSERT INTO `mst_potongans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'tunjangan jabatan', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(2, 'BPJS', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(3, 'JHT', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(4, 'JKK', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(5, 'JPN', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(6, 'PPN', '2021-12-07 07:44:14', '2021-12-07 07:44:14'),
(7, 'infaq dan sadaqoh', '2021-12-08 03:09:13', '2021-12-08 03:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `odontogram_pasien`
--

CREATE TABLE `odontogram_pasien` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `p11c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p11t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p11b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p11l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p11r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p12c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p12t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p12b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p12l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p12r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p13c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p13t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p13b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p13l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p13r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p14c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p14t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p14b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p14l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p14r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p15c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p15t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p15b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p15l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p15r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p16c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p16t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p16b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p16l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p16r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p17c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p17t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p17b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p17l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p17r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p18c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p18t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p18b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p18l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p18r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p21c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p21t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p21b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p21l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p21r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p22c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p22t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p22b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p22l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p22r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p23c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p23t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p23b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p23l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p23r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p24c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p24t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p24b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p24l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p24r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p25c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p25t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p25b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p25l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p25r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p26c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p26t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p26b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p26l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p26r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p27c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p27t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p27b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p27l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p27r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p28c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p28t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p28b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p28l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p28r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p51c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p51t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p51b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p51l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p51r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p52c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p52t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p52b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p52l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p52r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p53c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p53t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p53b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p53l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p53r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p54c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p54t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p54b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p54l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p54r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p55c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p55t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p55b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p55l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p55r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p61c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p61t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p61b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p61l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p61r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p62c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p62t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p62b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p62l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p62r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p63c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p63t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p63b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p63l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p63r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p64c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p64t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p64b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p64l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p64r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p65c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p65t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p65b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p65l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p65r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p81c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p81t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p81b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p81l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p81r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p82c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p82t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p82b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p82l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p82r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p83c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p83t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p83b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p83l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p83r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p84c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p84t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p84b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p84l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p84r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p85c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p85t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p85b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p85l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p85r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p71c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p71t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p71b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p71l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p71r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p72c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p72t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p72b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p72l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p72r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p73c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p73t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p73b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p73l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p73r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p74c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p74t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p74b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p74l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p74r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p75c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p75t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p75b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p75l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p75r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p41c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p41t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p41b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p41l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p41r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p42c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p42t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p42b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p42l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p42r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p43c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p43t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p43b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p43l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p43r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p44c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p44t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p44b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p44l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p44r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p45c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p45t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p45b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p45l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p45r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p46c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p46t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p46b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p46l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p46r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p47c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p47t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p47b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p47l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p47r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p48c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p48t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p48b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p48l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p48r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p31c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p31t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p31b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p31l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p31r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p32c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p32t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p32b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p32l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p32r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p33c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p33t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p33b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p33l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p33r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p34c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p34t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p34b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p34l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p34r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p35c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p35t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p35b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p35l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p35r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p36c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p36t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p36b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p36l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p36r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p37c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p37t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p37b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p37l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p37r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p38c` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p38t` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p38b` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p38l` varchar(32) NOT NULL DEFAULT 'Ivory',
  `p38r` varchar(32) NOT NULL DEFAULT 'Ivory',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `odontogram_pasien`
--

INSERT INTO `odontogram_pasien` (`id`, `customer_id`, `p11c`, `p11t`, `p11b`, `p11l`, `p11r`, `p12c`, `p12t`, `p12b`, `p12l`, `p12r`, `p13c`, `p13t`, `p13b`, `p13l`, `p13r`, `p14c`, `p14t`, `p14b`, `p14l`, `p14r`, `p15c`, `p15t`, `p15b`, `p15l`, `p15r`, `p16c`, `p16t`, `p16b`, `p16l`, `p16r`, `p17c`, `p17t`, `p17b`, `p17l`, `p17r`, `p18c`, `p18t`, `p18b`, `p18l`, `p18r`, `p21c`, `p21t`, `p21b`, `p21l`, `p21r`, `p22c`, `p22t`, `p22b`, `p22l`, `p22r`, `p23c`, `p23t`, `p23b`, `p23l`, `p23r`, `p24c`, `p24t`, `p24b`, `p24l`, `p24r`, `p25c`, `p25t`, `p25b`, `p25l`, `p25r`, `p26c`, `p26t`, `p26b`, `p26l`, `p26r`, `p27c`, `p27t`, `p27b`, `p27l`, `p27r`, `p28c`, `p28t`, `p28b`, `p28l`, `p28r`, `p51c`, `p51t`, `p51b`, `p51l`, `p51r`, `p52c`, `p52t`, `p52b`, `p52l`, `p52r`, `p53c`, `p53t`, `p53b`, `p53l`, `p53r`, `p54c`, `p54t`, `p54b`, `p54l`, `p54r`, `p55c`, `p55t`, `p55b`, `p55l`, `p55r`, `p61c`, `p61t`, `p61b`, `p61l`, `p61r`, `p62c`, `p62t`, `p62b`, `p62l`, `p62r`, `p63c`, `p63t`, `p63b`, `p63l`, `p63r`, `p64c`, `p64t`, `p64b`, `p64l`, `p64r`, `p65c`, `p65t`, `p65b`, `p65l`, `p65r`, `p81c`, `p81t`, `p81b`, `p81l`, `p81r`, `p82c`, `p82t`, `p82b`, `p82l`, `p82r`, `p83c`, `p83t`, `p83b`, `p83l`, `p83r`, `p84c`, `p84t`, `p84b`, `p84l`, `p84r`, `p85c`, `p85t`, `p85b`, `p85l`, `p85r`, `p71c`, `p71t`, `p71b`, `p71l`, `p71r`, `p72c`, `p72t`, `p72b`, `p72l`, `p72r`, `p73c`, `p73t`, `p73b`, `p73l`, `p73r`, `p74c`, `p74t`, `p74b`, `p74l`, `p74r`, `p75c`, `p75t`, `p75b`, `p75l`, `p75r`, `p41c`, `p41t`, `p41b`, `p41l`, `p41r`, `p42c`, `p42t`, `p42b`, `p42l`, `p42r`, `p43c`, `p43t`, `p43b`, `p43l`, `p43r`, `p44c`, `p44t`, `p44b`, `p44l`, `p44r`, `p45c`, `p45t`, `p45b`, `p45l`, `p45r`, `p46c`, `p46t`, `p46b`, `p46l`, `p46r`, `p47c`, `p47t`, `p47b`, `p47l`, `p47r`, `p48c`, `p48t`, `p48b`, `p48l`, `p48r`, `p31c`, `p31t`, `p31b`, `p31l`, `p31r`, `p32c`, `p32t`, `p32b`, `p32l`, `p32r`, `p33c`, `p33t`, `p33b`, `p33l`, `p33r`, `p34c`, `p34t`, `p34b`, `p34l`, `p34r`, `p35c`, `p35t`, `p35b`, `p35l`, `p35r`, `p36c`, `p36t`, `p36b`, `p36l`, `p36r`, `p37c`, `p37t`, `p37b`, `p37l`, `p37r`, `p38c`, `p38t`, `p38b`, `p38l`, `p38r`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'DarkGrey', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', '2021-10-11 03:47:55', '2021-10-11 03:50:07'),
(2, 2, 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'LimeGreen', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', '2021-10-11 07:28:46', '2021-10-11 07:32:41'),
(3, 3, 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'ForestGreen', 'ForestGreen', 'ForestGreen', 'ForestGreen', 'ForestGreen', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', 'Ivory', '2021-10-11 08:53:34', '2021-10-11 08:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `parent_chart_of_account`
--

CREATE TABLE `parent_chart_of_account` (
  `id_parent` int(11) NOT NULL,
  `en_parent` varchar(100) NOT NULL,
  `in_parent` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent_chart_of_account`
--

INSERT INTO `parent_chart_of_account` (`id_parent`, `en_parent`, `in_parent`, `is_active`) VALUES
(1, 'Assets', 'Aktiva', 1),
(2, 'Liability', 'Kewajiban / Utang\r\n ', 1),
(3, 'Equity', 'Modal', 1),
(4, 'Revenue', 'Pendapatan', 1),
(5, 'Expense', 'Biaya', 1);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` int(11) NOT NULL,
  `nama_metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potongan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekening` int(20) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `cabang_id`, `nama_metode`, `potongan`, `rekening`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Debit Visa', '5', 2222232, 1, '2021-08-05 17:48:04', '2021-08-05 17:50:20'),
(2, 1, 'Bank BCA', '3', 2222235, 1, '2021-08-05 17:48:25', '2021-08-05 17:50:26'),
(3, 1, 'Cash', '0', 0, 1, '2021-08-05 17:48:35', '2021-10-04 09:16:53'),
(5, 2, 'Debit Visa', '5', 10108923, 1, '2021-10-04 09:20:10', '2021-10-04 09:20:10'),
(6, 2, 'Bank BCA', '3', 10108778, 1, '2021-10-04 09:20:31', '2021-10-04 09:20:31'),
(7, 2, 'Cash', '0', 0, 1, '2021-10-04 09:20:43', '2021-10-04 09:20:43'),
(8, 1, 'Debit Tebet', '5', 10108923, 1, '2021-10-08 10:29:24', '2021-10-08 10:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

CREATE TABLE `pegawais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmt` date NOT NULL,
  `tanggal_kenaikan_berkala_terakhir` date NOT NULL,
  `tanggal_kenaikan_pangkat_terakhir` date NOT NULL,
  `status_pegawai` int(11) NOT NULL,
  `status_user` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status_perkawinan_id` bigint(20) UNSIGNED NOT NULL,
  `agama_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `pendidikan_id` bigint(20) UNSIGNED NOT NULL,
  `perusahaan_id` int(250) NOT NULL,
  `role_id` int(250) NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `nip`, `nama`, `nik`, `tanggal_lahir`, `tempat_lahir`, `alamat`, `jenis_kelamin`, `no_hp`, `foto`, `facebook`, `instagram`, `tmt`, `tanggal_kenaikan_berkala_terakhir`, `tanggal_kenaikan_pangkat_terakhir`, `status_pegawai`, `status_user`, `user_id`, `status_perkawinan_id`, `agama_id`, `jabatan_id`, `pendidikan_id`, `perusahaan_id`, `role_id`, `unit_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '11806634', 'Ichsan Arrizqi', '6634', '2000-11-02', 'Bogor', 'Bojonggede', 'Laki Laki', '081296031743', 'pegawai/foto/20211116112147_orang.jpg', 'https://facebook.com/', 'https://instagram.com/', '2017-11-26', '2021-11-16', '2021-11-16', 1, 1, 4, 4, 6, 5, 3, 0, 0, 3, '2021-11-16 04:21:47', '2021-12-01 07:32:17', NULL),
(2, '839201', 'budi', '12321', '2021-11-17', 'Jakarta', 'dsa', 'Laki Laki', '123', 'pegawai/foto/06102021162408-AIG.png', 'https://facebook.com/', 'https://instagram.com/', '2017-11-26', '2021-11-16', '2021-11-16', 1, 1, 5, 4, 6, 5, 10, 0, 0, 3, '2021-11-16 04:41:45', '2022-01-28 07:57:21', NULL),
(3, '123123', 'James', '132312', '1999-11-16', 'Depok', 'Depok', 'Laki Laki', '1232131', 'pegawai/foto/20211116131206_1924756943_20211111_michele-caliani-iLAAT1E-H_8-unsplash.jpg', 'https://facebook.com/', 'https://instagram.com/', '2017-11-26', '2021-11-16', '2021-11-16', 1, 1, 6, 1, 3, 2, 6, 0, 0, 1, '2021-11-16 06:12:06', '2021-11-16 06:12:06', NULL),
(4, '123908', 'Alyssa', '1298309', '1999-06-17', 'Tanggerang', 'Tanggerang', 'Prempuan', '213098709123', 'pegawai/foto/20211116131343_menangis.jpg', 'https://facebook.com/', 'https://instagram.com/', '2019-11-26', '2021-11-16', '2021-11-16', 1, 1, 7, 1, 2, 4, 7, 0, 0, 1, '2021-11-16 06:13:43', '2021-11-16 06:13:43', NULL),
(5, '123989', 'iqbal', '1290830', '2007-03-22', 'Jakarta', 'Jakarta', 'Laki Laki', '1239213', 'pegawai/foto/20211122093458_06102021162408-381-3812277_ville-de-saint-etienne-png-download-gambar-icon.png', 'https://facebook.com/', 'https://instagram.com/', '2019-11-29', '2021-11-22', '2021-11-22', 1, 1, 8, 1, 1, 1, 3, 0, 0, 3, '2021-11-22 02:34:59', '2021-11-22 02:34:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendidikans`
--

CREATE TABLE `pendidikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendidikans`
--

INSERT INTO `pendidikans` (`id`, `nama`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SD / MI', 1, '2021-11-16 04:04:57', '2021-11-16 04:04:57'),
(2, 'SMP / MTS', 1, '2021-11-16 04:05:03', '2021-11-16 04:05:03'),
(3, 'SMA / MA / SMK', 1, '2021-11-16 04:05:10', '2021-11-16 04:05:10'),
(4, 'D1', 1, '2021-11-16 04:05:17', '2021-11-16 04:05:17'),
(5, 'D2', 1, '2021-11-16 04:05:24', '2021-11-16 04:05:24'),
(6, 'D4', 1, '2021-11-16 04:05:31', '2021-11-16 04:05:31'),
(7, 'S1', 1, '2021-11-16 04:05:37', '2021-11-16 04:05:37'),
(8, 'S2', 1, '2021-11-16 04:05:44', '2021-11-16 04:05:44'),
(9, 'S3', 1, '2021-11-16 04:05:51', '2021-11-16 04:05:51'),
(10, 'D3', 1, '2021-11-16 04:05:58', '2021-11-16 04:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_barangs`
--

CREATE TABLE `penerimaan_barangs` (
  `id` int(10) NOT NULL,
  `id_purchase` int(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `no_penerimaan_barang` int(250) NOT NULL,
  `qty_received` int(250) NOT NULL,
  `tanggal_penerimaan` datetime NOT NULL DEFAULT current_timestamp(),
  `harga_satuan` varchar(250) NOT NULL,
  `ppn` varchar(250) DEFAULT NULL,
  `total` varchar(250) NOT NULL,
  `grand_total` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuans`
--

CREATE TABLE `pengajuans` (
  `id` int(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `id_roles` int(250) NOT NULL,
  `nomor_pengajuan` varchar(250) NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `file` varchar(250) DEFAULT NULL,
  `status_approval` varchar(250) NOT NULL,
  `approval_by` varchar(250) NOT NULL,
  `approval_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajuans`
--

INSERT INTO `pengajuans` (`id`, `id_user`, `id_perusahaan`, `id_roles`, `nomor_pengajuan`, `tanggal_pengajuan`, `file`, `status_approval`, `approval_by`, `approval_time`) VALUES
(1, 13, 1, 9, 'KEU/01/00001', '2022-02-22 09:03:00', 'KEU/01/00001.Revisi Axis 29 Oktober 2021.docx', 'pending', 'pending', '2022-02-22 09:03:00'),
(2, 13, 1, 9, 'KEU/02/00002', '2022-02-22 09:04:00', 'KEU/02/00002.02092021.docx', 'pending', 'pending', '2022-02-22 09:04:00'),
(3, 13, 1, 9, 'KEU/03/00003', '2022-02-22 09:05:00', 'KEU/03/00003.02092021.docx', 'pending', 'pending', '2022-02-22 09:05:00'),
(4, 13, 1, 9, 'KEU/04/00004', '2022-02-22 10:56:00', 'KEU/04/00004/02092021.docx', 'pending', 'pending', '2022-02-22 10:56:00'),
(5, 20, 1, 9, 'PD/05/00005', '2022-02-23 10:13:00', 'PD/05/00005/02092021.docx', 'pending', 'pending', '2022-02-23 10:13:00'),
(8, 13, 1, 9, 'PD/06/00006', '2022-02-23 14:11:00', 'PD/06/00006/02092021.docx', 'pending', 'pending', '2022-02-23 14:11:00'),
(9, 13, 1, 9, 'PD/09/00009', '2022-02-24 10:04:00', 'PD/09/00009/SK_09122021.docx', 'pending', 'pending', '2022-02-24 10:04:00'),
(10, 13, 1, 9, 'PD/10/00010', '2022-02-24 10:20:00', 'PD/10/00010/SK_09122021.docx', 'pending', 'pending', '2022-02-24 10:20:00'),
(11, 13, 1, 9, 'PD/11/00011', '2022-02-24 10:30:00', 'PD/11/00011/SB22022022.docx', 'pending', 'pending', '2022-02-24 10:30:00'),
(12, 13, 1, 9, 'PD/12/00012', '2022-02-24 14:05:00', 'PD/12/00012/SB08022022-Part 2 (1).docx', 'pending', 'pending', '2022-02-24 14:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `penggajians`
--

CREATE TABLE `penggajians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pegawai_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penggajians`
--

INSERT INTO `penggajians` (`id`, `pegawai_id`, `tanggal`, `gaji_pokok`, `jabatan`, `golongan`, `admin`, `created_at`, `updated_at`) VALUES
(4, 1, '2021-12-06', 5000000, 'Kepala Dinas', 'IV', 'admin', '2021-12-07 07:54:31', '2021-12-08 10:00:28'),
(5, 5, '2021-12-02', 4500000, 'Kepala Seksi Pelaksanaan Penataan Ruang', 'IV', 'admin', '2021-12-08 02:35:05', '2021-12-08 08:36:03'),
(6, 3, '2021-12-08', 1000000, 'Kepala Seksi Pengawasan dan Pengendalian Pemanfaatan Ruang', 'IV', 'admin', '2021-12-08 06:34:06', '2021-12-08 06:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'permission-access', 'Permission Access', 'web', '2021-07-16 20:00:20', '2021-07-16 20:00:20'),
(7, 'permission-create', 'Permission Create', 'web', '2021-07-16 20:00:24', '2021-07-16 20:00:24'),
(8, 'permission-edit', 'Permission Edit', 'web', '2021-07-16 20:00:28', '2021-07-16 20:00:28'),
(9, 'permission-delete', 'Permission Delete', 'web', '2021-07-16 20:00:35', '2021-07-16 20:00:35'),
(11, 'roles-edit', 'Roles Edit', 'web', '2021-07-16 20:00:45', '2021-07-16 20:00:45'),
(12, 'roles-create', 'Roles Create', 'web', '2021-07-16 20:00:48', '2021-07-16 20:00:48'),
(13, 'roles-delete', 'Roles Delete', 'web', '2021-07-16 20:00:52', '2021-07-16 20:00:52'),
(14, 'user-access', 'User Access', 'web', '2021-07-16 20:02:15', '2021-07-16 20:02:15'),
(15, 'user-create', 'User Create', 'web', '2021-07-16 20:02:20', '2021-07-16 20:02:20'),
(16, 'user-edit', 'User Edit', 'web', '2021-07-16 20:02:23', '2021-07-16 20:02:23'),
(17, 'user-delete', 'User Delete', 'web', '2021-07-16 20:02:27', '2021-07-16 20:02:27'),
(18, 'roles-access', 'Roles Access', 'web', '2021-07-16 20:02:45', '2021-07-16 20:02:45'),
(19, 'cabang-access', 'Cabang Access', 'web', '2021-07-16 20:04:13', '2021-07-16 20:04:13'),
(20, 'cabang-create', 'Cabang Create', 'web', '2021-07-16 20:04:17', '2021-07-16 20:04:17'),
(21, 'cabang-edit', 'Cabang Edit', 'web', '2021-07-16 20:04:21', '2021-07-16 20:04:21'),
(22, 'cabang-delete', 'Cabang Delete', 'web', '2021-07-16 20:04:25', '2021-07-16 20:04:25'),
(23, 'product-access', 'Product Access', 'web', '2021-07-16 20:04:32', '2021-07-16 20:04:32'),
(24, 'product-create', 'Product Create', 'web', '2021-07-16 20:04:37', '2021-07-16 20:04:37'),
(25, 'product-edit', 'Product Edit', 'web', '2021-07-16 20:04:41', '2021-07-16 20:04:41'),
(26, 'product-delete', 'Product Delete', 'web', '2021-07-16 20:04:45', '2021-07-16 20:04:45'),
(27, 'service-access', 'Service Access', 'web', '2021-07-16 20:04:48', '2021-07-16 20:04:48'),
(28, 'service-create', 'Service Create', 'web', '2021-07-16 20:04:50', '2021-07-16 20:04:50'),
(29, 'service-delete', 'Service Delete', 'web', '2021-07-16 20:04:54', '2021-07-16 20:04:54'),
(30, 'service-edit', 'Service Edit', 'web', '2021-07-16 20:04:57', '2021-07-16 20:04:57'),
(31, 'patient-access', 'Patient Access', 'web', '2021-07-16 20:19:07', '2021-07-16 20:19:07'),
(32, 'patient-create', 'Patient Create', 'web', '2021-07-16 20:19:10', '2021-07-16 20:19:10'),
(33, 'patient-edit', 'Patient Edit', 'web', '2021-07-16 20:19:14', '2021-07-16 20:19:14'),
(34, 'patient-delete', 'Patient Delete', 'web', '2021-07-16 20:19:17', '2021-07-16 20:19:17'),
(35, 'payment-access', 'Payment Access', 'web', '2021-07-28 07:27:35', '2021-07-28 07:27:35'),
(36, 'payment-create', 'Payment Create', 'web', '2021-07-28 07:27:43', '2021-07-28 07:27:43'),
(37, 'payment-edit', 'Payment Edit', 'web', '2021-07-28 07:27:49', '2021-07-28 07:27:49'),
(38, 'payment-delete', 'Payment Delete', 'web', '2021-07-28 07:27:55', '2021-07-28 07:27:55'),
(39, 'status-access', 'Status Access', 'web', '2021-07-28 07:38:58', '2021-07-28 07:38:58'),
(40, 'status-create', 'Status Create', 'web', '2021-07-28 07:39:05', '2021-07-28 07:39:05'),
(41, 'status-edit', 'Status Edit', 'web', '2021-07-28 07:39:09', '2021-07-28 07:39:09'),
(42, 'status-delete', 'Status Delete', 'web', '2021-07-28 07:39:14', '2021-07-28 07:39:14'),
(43, 'voucher-access', 'Voucher Access', 'web', '2021-07-28 07:46:11', '2021-07-28 07:46:11'),
(44, 'voucher-create', 'Voucher Create', 'web', '2021-07-28 07:46:16', '2021-07-28 07:46:16'),
(45, 'voucher-edit', 'Voucher Edit', 'web', '2021-07-28 07:46:20', '2021-07-28 07:46:20'),
(46, 'voucher-delete', 'Voucher Delete', 'web', '2021-07-28 07:46:29', '2021-07-28 07:46:29'),
(47, 'komisi-access', 'Komisi Access', 'web', '2021-07-28 07:58:59', '2021-07-28 07:58:59'),
(48, 'komisi-create', 'Komisi Create', 'web', '2021-07-28 07:59:05', '2021-07-28 07:59:05'),
(49, 'komisi-edit', 'Komisi Edit', 'web', '2021-07-28 07:59:10', '2021-07-28 07:59:10'),
(50, 'komisi-delete', 'Komisi Delete', 'web', '2021-07-28 07:59:16', '2021-07-28 07:59:16'),
(51, 'simbol-access', 'Simbol Access', 'web', '2021-07-28 08:27:23', '2021-07-28 08:27:23'),
(52, 'simbol-create', 'Simbol Create', 'web', '2021-07-28 08:27:31', '2021-07-28 08:27:31'),
(53, 'simbol-edit', 'Simbol Edit', 'web', '2021-07-28 08:27:39', '2021-07-28 08:27:39'),
(54, 'simbol-delete', 'Simbol Delete', 'web', '2021-07-28 08:27:46', '2021-07-28 08:27:46'),
(55, 'report-access', 'Report Access', 'web', '2021-08-12 17:01:14', '2021-08-12 17:01:14'),
(56, 'dokter-access', 'Dokter Access', 'web', '2021-08-22 03:01:57', '2021-08-22 03:01:57'),
(57, 'dokter-create', 'Dokter Create', 'web', '2021-08-22 03:02:03', '2021-08-22 03:02:03'),
(58, 'dokter-edit', 'Dokter Edit', 'web', '2021-08-22 03:02:07', '2021-08-22 03:02:07'),
(59, 'dokter-delete', 'Dokter Delete', 'web', '2021-08-22 03:02:14', '2021-08-22 03:02:14'),
(60, 'appointment-access', 'Appointment Access', 'web', '2021-08-25 07:06:14', '2021-08-25 07:06:14'),
(61, 'appointment-create', 'Appointment Create', 'web', '2021-08-25 07:06:23', '2021-08-25 07:06:23'),
(62, 'appointment-edit', 'Appointment Edit', 'web', '2021-08-25 07:06:29', '2021-08-25 07:06:29'),
(63, 'appointment-delete', 'Appointment Delete', 'web', '2021-08-25 07:06:39', '2021-08-25 07:06:39'),
(64, 'supplier-access', 'Supplier Access', 'web', '2021-12-07 03:16:07', '2021-12-07 03:16:07'),
(65, 'supplier-create', 'Supplier Create', 'web', '2021-12-07 03:16:14', '2021-12-07 03:16:14'),
(66, 'supplier-edit', 'Supplier Edit', 'web', '2021-12-07 03:16:23', '2021-12-07 03:16:23'),
(67, 'supplier-delete', 'Supplier Delete', 'web', '2021-12-07 03:16:30', '2021-12-07 03:16:30'),
(68, 'purchase-access', 'Purchase Access', 'web', '2021-12-07 08:37:38', '2021-12-07 08:37:38'),
(69, 'purchase-create', 'Purchase Create', 'web', '2021-12-07 08:37:50', '2021-12-07 08:37:50'),
(70, 'purchase-edit', 'Purchase Edit', 'web', '2021-12-07 08:37:57', '2021-12-07 08:37:57'),
(71, 'purchase-delete', 'Purchase Delete', 'web', '2021-12-07 08:38:06', '2021-12-07 08:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaans`
--

CREATE TABLE `perusahaans` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telepon` varchar(30) NOT NULL,
  `id_holding` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaans`
--

INSERT INTO `perusahaans` (`id`, `nama_perusahaan`, `alamat`, `no_telepon`, `id_holding`) VALUES
(1, 'PT YAZFI SETIA PERSADA', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` varchar(11) NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `project_code` varchar(250) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `alamat_project` varchar(255) NOT NULL,
  `no_telepon_project` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `id_perusahaan`, `project_code`, `nama_project`, `alamat_project`, `no_telepon_project`) VALUES
('1', 1, 'Project-01/YSP/2021', 'Ashoka Park', 'Gunung Sindar', '021912XXX'),
('2', 2, 'project-01/YSP/2021', 'Ashoka View', 'Bogor', '021xx');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `lokasi` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(250) NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `total` double NOT NULL,
  `PPN` int(250) DEFAULT NULL,
  `grand_total` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pembayaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `barang_id`, `supplier_id`, `user_id`, `lokasi`, `project_id`, `invoice`, `unit`, `qty`, `harga_beli`, `total`, `PPN`, `grand_total`, `status_barang`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 13, 'Gunung Sindar', 1, '121212', 'Sak', 1, 10000, 10000, 1000, '', 'pending', 'pending', '2022-02-15 04:38:00', NULL),
(6, 1, 2, 13, '', 1, 'INV12333', '', 1, 10000, 10000, 101000, '', 'pending', 'pending', '2022-02-15 09:40:00', NULL),
(7, 2, 2, 13, '', 1, 'INV12333', '', 10, 100000, 1000000, 101000, '', 'pending', 'pending', '2022-02-15 09:40:00', NULL),
(8, 1, 2, 13, '', 1, 'PO/08/00008', 'pcs', 1, 100000, 100000, 10000, '', 'pending', 'pending', '2022-02-17 04:49:00', NULL),
(9, 1, 1, 13, '', 2, 'PO/09/00009', 'pcs', 1, 100000, 100000, 10000, '110000', 'pending', 'pending', '2022-02-18 03:49:00', NULL),
(10, 1, 1, 13, '', 1, 'PO/10/00010', 'sak', 1, 1000000, 1000000, 10, '1100000', 'pending', 'pending', '2022-02-24 03:01:00', NULL),
(13, 1, 1, 13, '', 1, 'PO/11/00011', 'Sak', 2, 100000, 200000, 10, '220000', 'pending', 'pending', '2022-02-24 03:24:00', NULL),
(14, 1, 1, 13, 'Gunung Sindar', 1, 'PO/14/00014', 'pcs', 1, 100000, 100000, 10000, '110000', 'pending', 'pending', '2022-02-24 06:35:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reinbursts`
--

CREATE TABLE `reinbursts` (
  `id` int(10) NOT NULL,
  `nomor_reinburst` varchar(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `id_jabatans` int(250) NOT NULL,
  `id_project` int(250) NOT NULL,
  `id_roles` int(250) NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `status_hrd` varchar(250) NOT NULL,
  `status_pembayaran` varchar(250) NOT NULL,
  `tanggal_reinburst` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reinbursts`
--

INSERT INTO `reinbursts` (`id`, `nomor_reinburst`, `id_user`, `id_jabatans`, `id_project`, `id_roles`, `id_perusahaan`, `file`, `status_hrd`, `status_pembayaran`, `tanggal_reinburst`) VALUES
(1, 'RN/01/00001', 14, 2, 1, 10, 1, 'RN/01/00001/SB08022022-Part 2.docx', 'pending', 'pending', '2022-02-22 14:09:00'),
(2, 'RN/02/00002', 14, 0, 1, 0, 1, 'RN/02/00002/SK_09122021.docx', 'pending', 'pending', '2022-02-24 10:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `no_gigi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `simbol_id` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tindakan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id`, `customer_id`, `user_id`, `tanggal`, `no_gigi`, `simbol_id`, `keterangan`, `tindakan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2021-10-11', '24C', 1, 'Amalgam', 'Cabut', '2021-10-11 03:50:07', '2021-10-11 03:50:07'),
(2, 2, 3, '2021-10-11', '75C', 10, 'Anomali', 'Anomali', '2021-10-11 07:32:41', '2021-10-11 07:32:41'),
(3, 3, 9, '2021-10-11', '71ALL', 17, 'Komposite', 'Cabut', '2021-10-11 08:58:59', '2021-10-11 08:58:59');

-- --------------------------------------------------------

--
-- Table structure for table `rincian_komisi`
--

CREATE TABLE `rincian_komisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nominal_komisi` bigint(20) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rincian_pembayarans`
--

CREATE TABLE `rincian_pembayarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `kasir_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `nominal` bigint(11) NOT NULL,
  `dibayar` int(20) NOT NULL,
  `kembali` int(11) NOT NULL,
  `voucher_id` int(11) DEFAULT NULL,
  `disc_vouc` int(11) DEFAULT NULL,
  `biaya_kartu` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rincian_pembayarans`
--

INSERT INTO `rincian_pembayarans` (`id`, `booking_id`, `kasir_id`, `payment_id`, `tanggal_pembayaran`, `nominal`, `dibayar`, `kembali`, `voucher_id`, `disc_vouc`, `biaya_kartu`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 3, '2021-10-11 03:54:00', 5300000, 5300000, 0, 1, 200000, 0, 1, '2021-10-11 03:55:08', '2021-10-11 03:55:08'),
(2, 4, 2, 3, '2021-10-11 07:34:00', 4750000, 4750000, 0, 1, 200000, 0, 1, '2021-10-11 07:35:21', '2021-10-11 07:35:21'),
(3, 5, 2, 2, '2021-10-11 09:01:00', 3500000, 3500000, 0, 1, 200000, 105000, 1, '2021-10-11 09:02:17', '2021-10-11 09:02:17'),
(4, 5, 2, 3, '2021-10-11 09:09:00', 1800000, 1800000, 0, 0, 0, 0, 1, '2021-10-11 09:09:46', '2021-10-11 09:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `rincian_pengajuans`
--

CREATE TABLE `rincian_pengajuans` (
  `id` int(250) NOT NULL,
  `nomor_pengajuan` varchar(250) NOT NULL,
  `no_kwitansi` varchar(250) NOT NULL,
  `barang_id` varchar(250) DEFAULT NULL,
  `total` varchar(250) NOT NULL,
  `harga_beli` varchar(250) NOT NULL,
  `PPN` int(250) DEFAULT NULL,
  `qty` int(250) DEFAULT NULL,
  `grandtotal` varchar(250) NOT NULL,
  `unit` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rincian_pengajuans`
--

INSERT INTO `rincian_pengajuans` (`id`, `nomor_pengajuan`, `no_kwitansi`, `barang_id`, `total`, `harga_beli`, `PPN`, `qty`, `grandtotal`, `unit`, `keterangan`) VALUES
(1, 'KEU/03/00003', '', 'listrik', '0', '1000000', 200000, 1, '2200000', 'pcs', 'sdsd'),
(2, 'KEU/03/00003', '', 'BPJS', '0', '1000000', 200000, 1, '2200000', 'pcs', 'sadsa'),
(3, 'KEU/04/00004', '', 'sabun', '0', '100000', 10, 1, '100000', 'pcs', 'sdsd'),
(4, 'PD/05/00005', '', 'sabun', '100000', '100000', 12, 1, '112000', 'pcs', 'ad'),
(8, 'PD/06/00006', '', 'sabun', '1000000', '1000000', 10, 1, '1100000', 'pcs', 'adsa'),
(9, 'PD/09/00009', '', 'listrik', '100000', '100000', 0, 1, '200000', 'Buah', 'Gawat'),
(10, 'PD/09/00009', '', 'BPJS', '100000', '100000', 0, 1, '200000', 'Buah', 'Sakit'),
(11, 'PD/10/00010', '', 'sabun', '10000', '10000', 10, 1, '11000', 'pcs', 'asdsad'),
(12, 'PD/11/00011', '', 'Bayar Listrik', '100000', '100000', 11, 1, '222000', 'buah', 'Bayar'),
(13, 'PD/11/00011', '', 'Bayar BPJS', '100000', '100000', 11, 1, '222000', 'buah', 'Bayar'),
(14, 'PD/12/00012', '23232323', 'sabun', '1000000', '1000000', NULL, 1, '1000000', 'pcs', 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `rincian_reinbursts`
--

CREATE TABLE `rincian_reinbursts` (
  `id` int(10) NOT NULL,
  `no_kwitansi` varchar(250) DEFAULT NULL,
  `nomor_reinburst` varchar(250) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `harga_beli` int(250) NOT NULL,
  `total` int(250) NOT NULL,
  `grandtotal` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rincian_reinbursts`
--

INSERT INTO `rincian_reinbursts` (`id`, `no_kwitansi`, `nomor_reinburst`, `catatan`, `harga_beli`, `total`, `grandtotal`) VALUES
(1, '121212', 'RN/01/00001', 'sasas', 10000, 10000, 110000),
(2, '121212', 'RN/01/00001', 'qwqw', 100000, 100000, 110000),
(3, '1021213', 'RN/02/00002', 'Reinburst Bensin', 100000, 100000, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `rincian_tagihan_spr`
--

CREATE TABLE `rincian_tagihan_spr` (
  `id_rincian` int(250) NOT NULL,
  `no_transaksi` varchar(250) NOT NULL,
  `tipe` varchar(250) NOT NULL,
  `jumlah_tagihan` varchar(250) NOT NULL,
  `jatuh_tempo` varchar(250) NOT NULL,
  `status_pembayaran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'Super Admin', 'web', '2021-07-16 19:56:23', '2021-07-16 19:56:23'),
(2, 'dokter', 'Dokter', 'web', '2021-07-21 18:26:17', '2021-07-21 18:26:17'),
(3, 'resepsionis', 'Resepsionis', 'web', '2021-08-01 18:38:02', '2021-08-01 18:38:02'),
(4, 'marketing', 'Marketing', 'web', '2021-08-14 01:52:46', '2021-08-14 01:52:46'),
(5, 'office-boy', 'Office Boy', 'web', '2021-08-14 01:54:47', '2021-08-14 01:54:47'),
(6, 'perawat', 'Perawat', 'web', '2021-08-14 01:55:06', '2021-08-14 01:55:06'),
(7, 'supervisor', 'Supervisor', 'web', '2021-08-25 07:07:13', '2021-08-25 07:07:13'),
(8, 'hrd', 'hrd', 'web', '2021-10-07 03:59:53', '2021-10-07 03:59:53'),
(9, 'logistik', 'Logistik', 'web', NULL, NULL),
(10, 'purchasing', 'Purchasing', 'web', '2022-02-15 05:02:08', '2022-02-15 05:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(11, 1),
(11, 8),
(12, 1),
(12, 8),
(13, 1),
(13, 8),
(14, 1),
(14, 8),
(15, 1),
(15, 8),
(16, 1),
(16, 8),
(17, 1),
(17, 8),
(18, 1),
(18, 8),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(31, 2),
(31, 3),
(31, 4),
(31, 5),
(31, 6),
(32, 4),
(33, 1),
(33, 4),
(34, 4),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(56, 3),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(60, 3),
(60, 7),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruangans`
--

CREATE TABLE `ruangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cabang_id` bigint(20) UNSIGNED NOT NULL,
  `nama_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangans`
--

INSERT INTO `ruangans` (`id`, `cabang_id`, `nama_ruangan`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 1, 'Ruang 1', 1, '2021-07-21 18:03:49', '2021-07-21 18:03:49'),
(3, 1, 'Ruang 2', 1, '2021-07-21 18:03:54', '2021-07-21 18:03:54'),
(4, 2, 'Ruang 1', 1, '2021-09-02 07:55:41', '2021-09-02 07:55:41');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `web_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `web_name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Yazfi', 'images/logo/y1cLeLVtRdyznKc.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo_admin`, `logo_pegawai`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Q office', 'setting/logo_admin_logo_admin.png', 'setting/logo_pegawai_logo_qoffice (COLOR).png', 'selamat datang di qoffice', '2021-11-16 02:04:33', '2021-12-03 09:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `kode`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 'SF1', '09:00:00', '15:00:00', NULL, NULL),
(2, 'SF2', '15:00:00', '21:00:00', NULL, NULL),
(3, 'L', '00:00:00', '00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simbol_odontograms`
--

CREATE TABLE `simbol_odontograms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_simbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `simbol_odontograms`
--

INSERT INTO `simbol_odontograms` (`id`, `nama_simbol`, `singkatan`, `warna`, `created_at`, `updated_at`) VALUES
(1, 'Amalgam', 'amf', 'DarkGrey', NULL, NULL),
(2, 'Komposite', 'cof', 'MediumBlue', NULL, NULL),
(3, 'pit dan fissure sealant', 'fis', 'AntiqueWhite', NULL, NULL),
(4, 'Nekrosis Pulpa', 'NP', 'DarkSlateGray', NULL, NULL),
(5, 'Perawatan Saluran Akar', 'rct', 'Aquamarine', NULL, NULL),
(6, 'gigi tidak ada, tidak diketahui ada atau tidak ada.', 'non', 'Indigo', NULL, NULL),
(7, 'Un-Erupted', 'UE', 'AliceBlue', NULL, NULL),
(8, 'Partial Eruption', 'PE', 'Orchid', NULL, NULL),
(9, 'Normal/ baik', 'sou', 'Ivory', NULL, NULL),
(10, 'Anomali ', 'A', 'LimeGreen', NULL, NULL),
(11, 'Karies Media', 'KM', 'Brown', NULL, NULL),
(12, 'Fractur', 'cfr', 'Teal', NULL, NULL),
(13, 'Karies Profunda', 'KP', 'Chocolate', NULL, NULL),
(14, 'Karies Superfisial', 'KS', 'BurlyWood', NULL, NULL),
(15, 'Metal Crown', 'fmc', 'Green', NULL, NULL),
(17, 'Crown Non Metal', 'cnm', 'ForestGreen', NULL, NULL),
(18, 'Normal', 'TAK', 'LightCyan', NULL, NULL),
(19, 'Mobility', 'M', 'Lime', NULL, NULL),
(20, 'Radix', 'rx', 'Yellow', NULL, NULL),
(21, 'Missing teeth', 'mis', 'Coral', NULL, NULL),
(22, 'Implant + Porcelain crown', 'ipx-poc', 'LightGreen', NULL, NULL),
(23, 'Bridge', 'Brg', 'OliveDrab', NULL, NULL),
(24, 'GTSL', 'gtsl', 'Fuchsia', NULL, NULL),
(25, 'plak dan kalkulus', 'calculus', 'Chartreuse', NULL, NULL),
(26, 'GTL', 'GTL', 'HotPink', NULL, NULL),
(27, 'Migrasi/ Version/Rotasi dibuat panahsesuai arah', 'mv', 'GoldenRod', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skema_pembayaran`
--

CREATE TABLE `skema_pembayaran` (
  `id_skema` int(250) NOT NULL,
  `nama_skema` varchar(250) NOT NULL,
  `jumlah_skema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spr`
--

CREATE TABLE `spr` (
  `id_transaksi` int(250) NOT NULL,
  `id_sales` int(250) NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `id_project` int(250) NOT NULL,
  `id_unit` varchar(250) NOT NULL,
  `no_transaksi` varchar(250) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jam_transaksi` date NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_ktp` int(250) NOT NULL,
  `npwp` varchar(250) NOT NULL,
  `no_tlp` int(30) NOT NULL,
  `no_hp` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `status_booking` varchar(11) DEFAULT NULL,
  `status_dp` varchar(11) DEFAULT NULL,
  `harga_jual` varchar(250) NOT NULL,
  `diskon` int(250) NOT NULL,
  `status_approval` varchar(11) DEFAULT NULL,
  `harga_net` int(250) NOT NULL,
  `total_luas_tanah` int(250) DEFAULT NULL,
  `skema` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spr`
--

INSERT INTO `spr` (`id_transaksi`, `id_sales`, `id_perusahaan`, `id_project`, `id_unit`, `no_transaksi`, `tanggal_transaksi`, `jam_transaksi`, `nama`, `alamat`, `no_ktp`, `npwp`, `no_tlp`, `no_hp`, `email`, `pekerjaan`, `status_booking`, `status_dp`, `harga_jual`, `diskon`, `status_approval`, `harga_net`, `total_luas_tanah`, `skema`) VALUES
(1, 4, 1, 0, '0', 'SP/01/00001', '0000-00-00', '0000-00-00', 'Rudi', 'Jl Ahmad yani No 12', 2147483647, '0090037689123', 2147483647, 2147483647, 'rudi12@gmail.com', 'Programmer', '0', '0', '515000', 5000000, '0', 510000000, NULL, 'cash_bertahap'),
(2, 4, 1, 1, 'Kocinea', 'SP/02/00002', '0000-00-00', '0000-00-00', 'Rudi', 'Jl Ahmad Yani No 12', 2147483647, '0999786511123', 2147483647, 2147483647, 'rudi12@gmail.com', 'Programmer', 'unpaid', 'unpaid', '337850', 5000000, 'pending', 332000000, NULL, 'cash_bertahap');

-- --------------------------------------------------------

--
-- Table structure for table `status_pasiens`
--

CREATE TABLE `status_pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pasiens`
--

INSERT INTO `status_pasiens` (`id`, `status`, `warna`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Belum Datang', 'red', 1, '2021-07-28 07:42:49', '2021-08-24 00:09:07'),
(2, 'Datang & Waiting', 'orange', 1, '2021-07-28 07:42:53', '2021-08-24 00:09:17'),
(3, 'Masuk Ruangan', 'blue', 1, '2021-07-28 07:42:58', '2021-08-24 00:09:25'),
(4, 'Selesai', 'green', 1, '2021-08-20 04:17:59', '2021-08-24 00:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `status_pernikahans`
--

CREATE TABLE `status_pernikahans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktifya` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_pernikahans`
--

INSERT INTO `status_pernikahans` (`id`, `nama`, `aktifya`, `created_at`, `updated_at`) VALUES
(1, 'Belum Kawin', 1, '2021-11-16 04:04:12', '2021-11-16 04:04:12'),
(2, 'Cerai Hidup', 1, '2021-11-16 04:04:26', '2021-11-16 04:04:26'),
(3, 'Cerai Mati', 1, '2021-11-16 04:04:32', '2021-11-16 04:04:32'),
(4, 'Kawin', 1, '2021-11-16 04:04:40', '2021-11-16 04:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `nama`, `telpon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'PT Semen Tiga Roda', '0126736221', 'Jakata Pusat', '2021-12-13 08:54:47', '2021-12-13 08:54:47'),
(2, 'PT Maju Mundur', '0126736225', 'Jakarta Barat', '2021-12-13 08:55:39', '2021-12-13 08:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_simbol`
--

CREATE TABLE `tabel_simbol` (
  `id` int(11) NOT NULL,
  `namasimbol` varchar(128) NOT NULL,
  `singkatan` varchar(16) NOT NULL,
  `warna` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tabel_simbol`
--

INSERT INTO `tabel_simbol` (`id`, `namasimbol`, `singkatan`, `warna`) VALUES
(1, 'Amalgam', 'amf', 'DarkGrey'),
(2, 'Komposite', 'cof', 'MediumBlue'),
(3, 'pit dan fissure sealant', 'fis', 'AntiqueWhite'),
(4, 'Nekrosis Pulpa', 'NP', 'DarkSlateGray'),
(5, 'Perawatan Saluran Akar', 'rct', 'Aquamarine'),
(6, 'gigi tidak ada, tidak diketahui ada atau tidak ada.', 'non', 'Indigo'),
(7, 'Un-Erupted', 'UE', 'AliceBlue'),
(8, 'Partial Eruption', 'PE', 'Orchid'),
(9, 'Normal/ baik', 'sou', 'Ivory'),
(10, 'Anomali ', 'A', 'LimeGreen'),
(11, 'Karies Media', 'KM', 'Brown'),
(12, 'Fractur', 'cfr', 'Teal'),
(13, 'Karies Profunda', 'KP', 'Chocolate'),
(14, 'Karies Superfisial', 'KS', 'BurlyWood'),
(15, 'Metal Crown', 'fmc', 'Green'),
(17, 'Crown Non Metal', 'cnm', 'ForestGreen'),
(18, 'Normal', 'TAK', 'LightCyan'),
(19, 'Mobility', 'M', 'Lime'),
(20, 'Radix', 'rx', 'Yellow'),
(21, 'Missing teeth', 'mis', 'Coral'),
(22, 'Implant + Porcelain crown', 'ipx-poc', 'LightGreen'),
(23, 'Bridge', 'Brg', 'OliveDrab'),
(24, 'GTSL', 'gtsl', 'Fuchsia'),
(25, 'plak dan kalkulus', 'calculus', 'Chartreuse'),
(26, 'GTL', 'GTL', 'HotPink'),
(27, 'Migrasi/ Version/Rotasi dibuat panahsesuai arah', 'mv', 'GoldenRod');

-- --------------------------------------------------------

--
-- Table structure for table `tindakans`
--

CREATE TABLE `tindakans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `tindakan_id` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `dokter_id` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tindakans`
--

INSERT INTO `tindakans` (`id`, `booking_id`, `tindakan_id`, `durasi`, `dokter_id`, `nominal`, `qty`, `status`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 20, 3, 1500000, 1, 1, '10:50:35', '2021-10-11 03:49:00', '2021-10-11 03:50:35'),
(2, 3, 3, 20, 9, 1500000, 1, 1, '10:53:55', '2021-10-11 03:49:00', '2021-10-11 03:53:55'),
(3, 3, 1, 0, 9, 2000000, 1, 1, '10:53:56', '2021-10-11 03:49:00', '2021-10-11 03:53:56'),
(4, 4, 3, 40, 3, 3000000, 2, 1, '14:33:03', '2021-10-11 07:31:22', '2021-10-11 07:33:03'),
(5, 4, 4, 20, 9, 1500000, 1, 1, '14:34:38', '2021-10-11 07:31:22', '2021-10-11 07:34:38'),
(6, 5, 3, 20, 9, 1500000, 1, 1, '16:00:02', '2021-10-11 08:56:14', '2021-10-11 09:00:02'),
(7, 5, 4, 20, 9, 1500000, 1, 1, '16:00:03', '2021-10-11 08:56:14', '2021-10-11 09:00:03'),
(8, 5, 1, 0, 3, 2000000, 1, 1, '16:08:14', '2021-10-11 08:56:14', '2021-10-11 09:08:14'),
(9, 6, 2, 0, 9, 100000, 1, 0, NULL, '2021-12-09 07:32:26', '2021-12-09 07:32:26'),
(10, 6, 5, 0, 9, 22000, 1, 0, NULL, '2021-12-09 07:32:26', '2021-12-09 07:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_stoks`
--

CREATE TABLE `transfer_stoks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `asal_id` bigint(20) UNSIGNED NOT NULL,
  `tujuan_id` bigint(20) UNSIGNED NOT NULL,
  `barang_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transfer_stoks`
--

INSERT INTO `transfer_stoks` (`id`, `asal_id`, `tujuan_id`, `barang_id`, `user_id`, `invoice`, `qty`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 1, 1, 'TRX20211210001', 5, '2021-12-13 08:56:00', NULL),
(4, 1, 2, 2, 1, 'TRX20211210001', 5, '2021-12-13 08:56:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tukar_fakturs`
--

CREATE TABLE `tukar_fakturs` (
  `id` int(250) NOT NULL,
  `no_faktur` varchar(250) NOT NULL,
  `supplier_id` int(250) NOT NULL,
  `no_po_vendor` varchar(250) NOT NULL,
  `nilai_invoice` varchar(250) NOT NULL,
  `id_user` int(250) NOT NULL,
  `tanggal_tukar_faktur` datetime NOT NULL,
  `is_active` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tukar_fakturs`
--

INSERT INTO `tukar_fakturs` (`id`, `no_faktur`, `supplier_id`, `no_po_vendor`, `nilai_invoice`, `id_user`, `tanggal_tukar_faktur`, `is_active`) VALUES
(1, 'KEU', 1, 'PO', '100000', 14, '2022-02-21 07:49:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `nama`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'Keuangan', 1, '2021-11-16 04:07:39', '2021-11-16 04:07:39'),
(2, 'Administrator', 1, '2021-11-16 04:08:29', '2021-11-16 04:08:29'),
(3, 'Gedung', 1, '2021-11-16 04:08:41', '2021-11-16 04:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `unit_rumah`
--

CREATE TABLE `unit_rumah` (
  `id_unit_rumah` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `blok` varchar(20) NOT NULL,
  `no` varchar(20) NOT NULL,
  `lb` varchar(20) NOT NULL,
  `lt` varchar(20) NOT NULL,
  `nstd` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `status_penjualan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_rumah`
--

INSERT INTO `unit_rumah` (`id_unit_rumah`, `type`, `blok`, `no`, `lb`, `lt`, `nstd`, `total`, `harga_jual`, `status_penjualan`) VALUES
(1, 'Ruko', 'R', '1', '96', '48', ' -   ', '48', '630.000.000', 'Sold'),
(2, 'Ruko', 'R', '2', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(3, 'Ruko', 'R', '3', '96', '48', ' -   ', '48', '630.000.000', 'Sold'),
(4, 'Ruko', 'R', '4', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(5, 'Ruko', 'R', '5', '96', '48', ' -   ', '48', '614.000.000', 'Sold'),
(6, 'Ruko', 'R', '6', '96', '48', ' -   ', '48', '614.000.000', 'Sold'),
(7, 'Ruko', 'R', '7', '96', '48', ' -   ', '48', '515.000.000', 'Sold'),
(8, 'Ruko', 'R', '8', '96', '48', ' -   ', '48', '630.000.000', 'Sold'),
(9, 'Ruko', 'R', '9', '96', '48', ' -   ', '48', '610.000.000', 'Sold'),
(10, 'Ruko', 'R', '10', '96', '48', ' -   ', '48', '610.000.000', 'Sold'),
(11, 'Ruko', 'R', '11', '96', '48', ' -   ', '48', '623.700.000', 'Sold'),
(12, 'Ruko', 'R', '12', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(13, 'Ruko', 'R', '13', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(14, 'Ruko', 'R', '14', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(15, 'Ruko', 'R', '15', '96', '48', ' -   ', '48', '634.400.000', 'Available'),
(16, 'Javanika', 'A-1', '1', '45', '80', '29', '109', '434.000.000', 'Available'),
(17, 'Javanika', 'A-1', '2', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(18, 'Javanika', 'A-1', '3', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(19, 'Javanika', 'A-1', '4', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(20, 'Javanika', 'A-1', '5', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(21, 'Javanika', 'A-1', '6', '45', '80', '29', '109', '434.000.000', 'Available'),
(22, 'Javanika', 'A-1', '7', '45', '80', '29', '109', '430.000.000', 'Available'),
(23, 'Javanika', 'A-1', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(24, 'Javanika', 'A-1', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(25, 'Javanika', 'A-1', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(26, 'Javanika', 'A-1', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(27, 'Javanika', 'A-1', '12', '45', '80', '29', '109', '430.000.000', 'Available'),
(28, 'Javanika', 'A-2', '1', '45', '80', '29', '109', '373.625.000', 'Sold'),
(29, 'Javanika', 'A-2', '2', '45', '80', ' -   ', '80', '365.000.000', 'Sold'),
(30, 'Javanika', 'A-2', '3', '45', '80', ' -   ', '80', '402.950.000', 'Sold'),
(31, 'Javanika', 'A-2', '4', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(32, 'Javanika', 'A-2', '5', '45', '80', ' -   ', '80', '365.000.000', 'Sold'),
(33, 'Javanika', 'A-2', '6', '45', '80', ' -   ', '80', '385.000.000', 'Sold'),
(34, 'Javanika', 'A-2', '7', '45', '80', ' -   ', '80', '375.400.000', 'Sold'),
(35, 'Javanika', 'A-2', '8', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(36, 'Javanika', 'A-2', '9', '45', '80', '29', '109', '420.800.000', 'Sold'),
(37, 'Javanika', 'A-2', '10', '45', '80', '29', '109', '416.050.000', 'Sold'),
(38, 'Javanika', 'A-2', '11', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(39, 'Javanika', 'A-2', '12', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(40, 'Javanika', 'A-2', '13', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(41, 'Javanika', 'A-2', '14', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(42, 'Javanika', 'A-2', '15', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(43, 'Javanika', 'A-2', '16', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(44, 'Javanika', 'A-2', '17', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(45, 'Javanika', 'A-2', '18', '45', '80', '29', '109', '405.500.000', 'Sold'),
(46, 'Javanika', 'A-3', '1', '45', '80', '71', '151', '468.500.000', 'Sold'),
(47, 'Javanika', 'A-3', '2', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(48, 'Javanika', 'A-3', '3', '45', '80', ' -   ', '80', '364.000.000', 'Sold'),
(49, 'Javanika', 'A-3', '4', '45', '80', ' -   ', '80', '396.000.000', 'Sold'),
(50, 'Javanika', 'A-3', '5', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(51, 'Javanika', 'A-3', '6', '45', '80', '29', '109', '474.100.000', 'Sold'),
(52, 'Javanika', 'A-3', '7', '45', '80', '29', '109', '432.750.000', 'Sold'),
(53, 'Javanika', 'A-3', '8', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(54, 'Javanika', 'A-3', '9', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(55, 'Javanika', 'A-3', '10', '45', '80', '52', '132', '499.850.000', 'Sold'),
(56, 'Javanika', 'A-4', '1', '45', '80', '29', '109', '405.500.000', 'Sold'),
(57, 'Javanika', 'A-4', '2', '45', '80', ' -   ', '80', '374.000.000', 'Sold'),
(58, 'Javanika', 'A-4', '3', '45', '80', '29', '109', '444.200.000', 'Sold'),
(59, 'Javanika', 'A-4', '4', '45', '80', '29', '109', '405.500.000', 'Sold'),
(60, 'Javanika', 'A-4', '5', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(61, 'Javanika', 'A-4', '6', '45', '80', '29', '109', '459.100.000', 'Sold'),
(62, 'Javanika', 'A-5', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(63, 'Javanika', 'A-5', '2', '45', '80', ' -   ', '80', '393.450.000', 'Sold'),
(64, 'Javanika', 'A-5', '3', '45', '80', '29', '109', '456.150.000', 'Sold'),
(65, 'Javanika', 'A-5', '4', '45', '80', '29', '109', '468.100.000', 'Sold'),
(66, 'Javanika', 'A-5', '5', '45', '80', ' -   ', '80', '391.550.000', 'Sold'),
(67, 'Javanika', 'A-5', '6', '45', '80', '29', '109', '430.000.000', 'Available'),
(68, 'Javanika', 'A-6', '1', '45', '80', '62', '142', '430.000.000', 'Available'),
(69, 'Javanika', 'A-6', '2', '45', '80', '24', '104', '457.600.000', 'Sold'),
(70, 'Javanika', 'A-6', '3', '45', '80', '62', '142', '495.500.000', 'Sold'),
(71, 'Javanika', 'A-6', '4', '45', '80', '51', '131', '443.500.000', 'Sold'),
(72, 'Javanika', 'A-6', '5', '45', '80', '16', '96', '402.400.000', 'Sold'),
(73, 'Javanika', 'A-6', '6', '45', '80', '51', '131', '434.000.000', 'Available'),
(74, 'Javanika', 'B-1', '1', '45', '80', '29', '109', '456.000.000', 'Sold'),
(75, 'Javanika', 'B-1', '2', '45', '80', ' -   ', '80', '413.400.000', 'Sold'),
(76, 'Javanika', 'B-1', '3', '45', '80', ' -   ', '80', '413.400.000', 'Sold'),
(77, 'Javanika', 'B-1', '4', '45', '80', ' -   ', '80', '396.000.000', 'Sold'),
(78, 'Javanika', 'B-1', '5', '45', '80', ' -   ', '80', '402.000.000', 'Reserved'),
(79, 'Javanika', 'B-1', '6', '45', '80', '29', '109', '407.750.000', 'Sold'),
(80, 'Javanika', 'B-1', '7', '45', '80', '29', '109', '454.000.000', 'Sold'),
(81, 'Javanika', 'B-1', '8', '45', '80', ' -   ', '80', '409.600.000', 'Reserved'),
(82, 'Javanika', 'B-1', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(83, 'Javanika', 'B-1', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(84, 'Javanika', 'B-1', '11', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(85, 'Javanika', 'B-1', '12', '45', '80', '29', '109', '462.000.000', 'Sold'),
(86, 'Javanika', 'B-2', '1', '45', '80', '29', '109', '437.750.000', 'Sold'),
(87, 'Javanika', 'B-2', '2', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(88, 'Javanika', 'B-2', '3', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(89, 'Javanika', 'B-2', '4', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(90, 'Javanika', 'B-2', '5', '45', '80', ' -   ', '80', '432.000.000', 'Available'),
(91, 'Javanika', 'B-2', '6', '45', '80', ' -   ', '80', '402.950.000', 'Sold'),
(92, 'Javanika', 'B-2', '7', '45', '80', ' -   ', '80', '396.300.000', 'Sold'),
(93, 'Javanika', 'B-2', '8', '45', '80', ' -   ', '80', '385.000.000', 'Sold'),
(94, 'Javanika', 'B-2', '9', '45', '80', '29', '109', '446.100.000', 'Sold'),
(95, 'Javanika', 'B-2', '10', '45', '80', '29', '109', '432.750.000', 'Sold'),
(96, 'Javanika', 'B-2', '11', '45', '80', ' -   ', '80', '391.550.000', 'Sold'),
(97, 'Javanika', 'B-2', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(98, 'Javanika', 'B-2', '13', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(99, 'Javanika', 'B-2', '14', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(100, 'Javanika', 'B-2', '15', '45', '80', ' -   ', '80', '370.650.000', 'Sold'),
(101, 'Javanika', 'B-2', '16', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(102, 'Javanika', 'B-2', '17', '45', '80', ' -   ', '80', '374.000.000', 'Sold'),
(103, 'Javanika', 'B-2', '18', '45', '80', '29', '109', '456.150.000', 'Sold'),
(104, 'Kocinea', 'B-3', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(105, 'Kocinea', 'B-3', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(106, 'Kocinea', 'B-3', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(107, 'Kocinea', 'B-3', '4', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(108, 'Kocinea', 'B-3', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(109, 'Kocinea', 'B-3', '6', '32', '64', '23', '87', '262.650.000', 'Sold'),
(110, 'Kocinea', 'B-3', '7', '32', '64', '23', '87', '267.400.000', 'Sold'),
(111, 'Kocinea', 'B-3', '8', '32', '64', ' -   ', '64', '231.000.000', 'Sold'),
(112, 'Kocinea', 'B-3', '9', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(113, 'Kocinea', 'B-3', '10', '32', '64', ' -   ', '64', '248.100.000', 'Sold'),
(114, 'Kocinea', 'B-3', '11', '32', '64', ' -   ', '64', '263.300.000', 'Sold'),
(115, 'Kocinea', 'B-3', '12', '32', '64', '23', '87', '285.500.000', 'Sold'),
(116, 'Kocinea', 'B-4', '1', '32', '64', '23', '87', '266.500.000', 'Sold'),
(117, 'Kocinea', 'B-4', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(118, 'Kocinea', 'B-4', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(119, 'Kocinea', 'B-4', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(120, 'Kocinea', 'B-4', '5', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(121, 'Kocinea', 'B-4', '6', '32', '64', '23', '87', '259.500.000', 'Sold'),
(122, 'Kocinea', 'B-4', '7', '32', '64', '23', '87', '262.650.000', 'Sold'),
(123, 'Kocinea', 'B-4', '8', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(124, 'Kocinea', 'B-4', '9', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(125, 'Kocinea', 'B-4', '10', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(126, 'Kocinea', 'B-4', '11', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(127, 'Kocinea', 'B-4', '12', '32', '64', '23', '87', '261.500.000', 'Sold'),
(128, 'Kocinea', 'B-5', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(129, 'Kocinea', 'B-5', '2', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(130, 'Kocinea', 'B-5', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(131, 'Kocinea', 'B-5', '4', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(132, 'Kocinea', 'B-5', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(133, 'Kocinea', 'B-5', '6', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(134, 'Kocinea', 'B-5', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(135, 'Kocinea', 'B-5', '8', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(136, 'Kocinea', 'B-5', '9', '32', '64', '23', '87', '262.650.000', 'Sold'),
(137, 'Kocinea', 'B-5', '10', '32', '64', '23', '87', '262.500.000', 'Sold'),
(138, 'Kocinea', 'B-5', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(139, 'Kocinea', 'B-5', '12', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(140, 'Kocinea', 'B-5', '13', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(141, 'Kocinea', 'B-5', '14', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(142, 'Kocinea', 'B-5', '15', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(143, 'Kocinea', 'B-5', '16', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(144, 'Kocinea', 'B-5', '17', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(145, 'Kocinea', 'B-5', '18', '32', '64', '23', '87', '262.650.000', 'Sold'),
(146, 'Kocinea', 'B-6', '1', '32', '64', '23', '87', '263.500.000', 'Sold'),
(147, 'Kocinea', 'B-6', '2', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(148, 'Kocinea', 'B-6', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(149, 'Kocinea', 'B-6', '4', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(150, 'Kocinea', 'B-6', '5', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(151, 'Kocinea', 'B-6', '6', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(152, 'Kocinea', 'B-6', '7', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(153, 'Kocinea', 'B-6', '8', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(154, 'Kocinea', 'B-6', '9', '32', '64', '23', '87', '296.500.000', 'Sold'),
(155, 'Kocinea', 'B-6', '10', '32', '64', '23', '87', '305.500.000', 'Sold'),
(156, 'Kocinea', 'B-6', '11', '32', '64', ' -   ', '64', '245.000.000', 'Sold'),
(157, 'Kocinea', 'B-6', '12', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(158, 'Kocinea', 'B-6', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(159, 'Kocinea', 'B-6', '14', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(160, 'Kocinea', 'B-6', '15', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(161, 'Kocinea', 'B-6', '16', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(162, 'Kocinea', 'B-6', '17', '32', '64', ' -   ', '64', '255.000.000', 'Sold'),
(163, 'Kocinea', 'B-6', '18', '32', '64', '23', '87', '262.650.000', 'Sold'),
(164, 'Javanika', 'B-7', '1', '45', '80', '29', '109', '433.100.000', 'Sold'),
(165, 'Javanika', 'B-7', '2', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(166, 'Javanika', 'B-7', '3', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(167, 'Javanika', 'B-7', '4', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(168, 'Javanika', 'B-7', '5', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(169, 'Javanika', 'B-7', '6', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(170, 'Javanika', 'B-7', '7', '45', '80', ' -   ', '80', '402.000.000', 'Sold'),
(171, 'Javanika', 'B-7', '8', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(172, 'Javanika', 'B-7', '9', '45', '80', '29', '109', '454.000.000', 'Sold'),
(173, 'Javanika', 'B-7', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(174, 'Javanika', 'B-7', '11', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(175, 'Javanika', 'B-7', '12', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(176, 'Javanika', 'B-7', '13', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(177, 'Javanika', 'B-7', '14', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(178, 'Javanika', 'B-7', '15', '45', '80', ' -   ', '80', '409.600.000', 'Sold'),
(179, 'Javanika', 'B-7', '16', '45', '80', ' -   ', '80', '390.000.000', 'Sold'),
(180, 'Javanika', 'B-7', '17', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(181, 'Javanika', 'B-7', '18', '45', '80', '29', '109', '432.750.000', 'Sold'),
(182, 'Javanika', 'B-8', '1', '45', '80', '29', '109', '416.050.000', 'Sold'),
(183, 'Javanika', 'B-8', '2', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(184, 'Javanika', 'B-8', '3', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(185, 'Javanika', 'B-8', '4', '45', '80', ' -   ', '80', '360.000.000', 'Sold'),
(186, 'Javanika', 'B-8', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(187, 'Javanika', 'B-8', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(188, 'Javanika', 'B-8', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(189, 'Javanika', 'B-8', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(190, 'Javanika', 'B-8', '9', '45', '80', '29', '109', '430.000.000', 'Available'),
(191, 'Javanika', 'B-8', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(192, 'Javanika', 'B-8', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(193, 'Javanika', 'B-8', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(194, 'Javanika', 'B-8', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(195, 'Javanika', 'B-8', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(196, 'Javanika', 'B-8', '15', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(197, 'Javanika', 'B-8', '16', '45', '80', ' -   ', '80', '399.150.000', 'Sold'),
(198, 'Javanika', 'B-8', '17', '45', '80', ' -   ', '80', '384.000.000', 'Sold'),
(199, 'Javanika', 'B-8', '18', '45', '80', '29', '109', '444.200.000', 'Sold'),
(200, 'Javanika', 'B-9', '1', '45', '80', '29', '109', '468.100.000', 'Sold'),
(201, 'Javanika', 'B-9', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(202, 'Javanika', 'B-9', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(203, 'Javanika', 'B-9', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(204, 'Javanika', 'B-9', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(205, 'Javanika', 'B-9', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(206, 'Javanika', 'B-9', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(207, 'Javanika', 'B-9', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(208, 'Javanika', 'B-9', '9', '45', '80', '29', '109', '430.000.000', 'Available'),
(209, 'Javanika', 'B-9', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(210, 'Javanika', 'B-9', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(211, 'Javanika', 'B-9', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(212, 'Javanika', 'B-9', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(213, 'Javanika', 'B-9', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(214, 'Javanika', 'B-9', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(215, 'Javanika', 'B-9', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(216, 'Javanika', 'B-9', '17', '45', '80', ' -   ', '80', '398.000.000', 'Sold'),
(217, 'Javanika', 'B-9', '18', '45', '80', '29', '109', '468.100.000', 'Sold'),
(218, 'Javanika', 'B-10', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(219, 'Javanika', 'B-10', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(220, 'Javanika', 'B-10', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(221, 'Javanika', 'B-10', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(222, 'Javanika', 'B-10', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(223, 'Javanika', 'B-10', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(224, 'Javanika', 'B-10', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(225, 'Javanika', 'B-10', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(226, 'Javanika', 'B-10', '9', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(227, 'Javanika', 'B-10', '10', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(228, 'Javanika', 'B-10', '11', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(229, 'Javanika', 'B-10', '12', '45', '80', '29', '109', '422.750.000', 'Sold'),
(230, 'Javanika', 'B-10', '13', '45', '80', '29', '109', '422.750.000', 'Sold'),
(231, 'Javanika', 'B-10', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(232, 'Javanika', 'B-10', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(233, 'Javanika', 'B-10', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(234, 'Javanika', 'B-10', '17', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(235, 'Javanika', 'B-10', '18', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(236, 'Javanika', 'B-10', '19', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(237, 'Javanika', 'B-10', '20', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(238, 'Javanika', 'B-10', '21', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(239, 'Javanika', 'B-10', '22', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(240, 'Javanika', 'B-10', '23', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(241, 'Javanika', 'B-10', '24', '45', '80', '29', '109', '430.000.000', 'Available'),
(242, 'Javanika', 'B-11', '1', '45', '80', '29', '109', '430.000.000', 'Available'),
(243, 'Javanika', 'B-11', '2', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(244, 'Javanika', 'B-11', '3', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(245, 'Javanika', 'B-11', '4', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(246, 'Javanika', 'B-11', '5', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(247, 'Javanika', 'B-11', '6', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(248, 'Javanika', 'B-11', '7', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(249, 'Javanika', 'B-11', '8', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(250, 'Javanika', 'B-11', '9', '45', '80', ' -   ', '80', '430.000.000', 'Available'),
(251, 'Javanika', 'B-11', '10', '45', '80', '29', '109', '430.000.000', 'Available'),
(252, 'Javanika', 'B-11', '11', '45', '80', '29', '109', '428.000.000', 'Available'),
(253, 'Javanika', 'B-11', '12', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(254, 'Javanika', 'B-11', '13', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(255, 'Javanika', 'B-11', '14', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(256, 'Javanika', 'B-11', '15', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(257, 'Javanika', 'B-11', '16', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(258, 'Javanika', 'B-11', '17', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(259, 'Javanika', 'B-11', '18', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(260, 'Javanika', 'B-11', '19', '45', '80', ' -   ', '80', '428.000.000', 'Available'),
(261, 'Javanika', 'B-11', '20', '45', '80', '29', '109', '430.000.000', 'Available'),
(262, 'Acumina', 'B-12', '1', '32', '64', '23', '87', '314.100.000', 'Sold'),
(263, 'Acumina', 'B-12', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(264, 'Acumina', 'B-12', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(265, 'Acumina', 'B-12', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(266, 'Acumina', 'B-12', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(267, 'Acumina', 'B-12', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(268, 'Acumina', 'B-12', '7', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(269, 'Acumina', 'B-12', '8', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(270, 'Acumina', 'B-12', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(271, 'Acumina', 'B-12', '10', '32', '64', '23', '87', '310.100.000', 'Sold'),
(272, 'Acumina', 'B-12', '11', '32', '64', '23', '87', '314.750.000', 'Sold'),
(273, 'Acumina', 'B-12', '12', '32', '64', '16', '80', '273.750.000', 'Sold'),
(274, 'Acumina', 'B-12', '13', '32', '64', '16', '80', '273.750.000', 'Sold'),
(275, 'Acumina', 'B-12', '14', '32', '64', '16', '80', '273.750.000', 'Sold'),
(276, 'Acumina', 'B-12', '15', '32', '64', '16', '80', '273.750.000', 'Sold'),
(277, 'Acumina', 'B-12', '16', '32', '64', '16', '80', '273.750.000', 'Sold'),
(278, 'Acumina', 'B-12', '17', '32', '64', '16', '80', '273.750.000', 'Sold'),
(279, 'Acumina', 'B-12', '18', '32', '64', '16', '80', '273.750.000', 'Sold'),
(280, 'Acumina', 'B-12', '19', '32', '64', '16', '80', '275.000.000', 'Sold'),
(281, 'Acumina', 'B-12', '20', '32', '64', '23', '87', '309.100.000', 'Sold'),
(282, 'Acumina', 'B-13', '1', '32', '64', '19', '83', '314.300.000', 'Sold'),
(283, 'Acumina', 'B-13', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(284, 'Acumina', 'B-13', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(285, 'Acumina', 'B-13', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(286, 'Acumina', 'B-13', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(287, 'Acumina', 'B-13', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(288, 'Acumina', 'B-13', '7', '32', '64', '39', '103', '341.300.000', 'Sold'),
(289, 'Acumina', 'B-13', '8', '32', '64', '28', '92', '322.600.000', 'Sold'),
(290, 'Acumina', 'B-13', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(291, 'Acumina', 'B-13', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(292, 'Acumina', 'B-13', '11', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(293, 'Acumina', 'B-13', '12', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(294, 'Acumina', 'B-13', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(295, 'Acumina', 'B-13', '14', '32', '64', '19', '83', '303.300.000', 'Sold'),
(296, 'Acumina', 'B-14', '1', '32', '64', '19', '83', '307.950.000', 'Sold'),
(297, 'Acumina', 'B-14', '2', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(298, 'Acumina', 'B-14', '3', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(299, 'Acumina', 'B-14', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(300, 'Acumina', 'B-14', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(301, 'Acumina', 'B-14', '6', '32', '64', ' -   ', '64', '271.700.000', 'Sold'),
(302, 'Acumina', 'B-14', '7', '32', '64', '68', '132', '397.600.000', 'Sold'),
(303, 'Acumina', 'B-14', '8', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(304, 'Acumina', 'B-14', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(305, 'Acumina', 'B-14', '10', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(306, 'Acumina', 'B-14', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(307, 'Acumina', 'B-14', '12', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(308, 'Acumina', 'B-14', '13', '32', '64', '19', '83', '285.500.000', 'Sold'),
(309, 'Acumina', 'B-15', '1', '32', '64', '19', '83', '303.300.000', 'Sold'),
(310, 'Acumina', 'B-15', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(311, 'Acumina', 'B-15', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(312, 'Acumina', 'B-15', '4', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(313, 'Acumina', 'B-15', '5', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(314, 'Acumina', 'B-15', '6', '32', '64', '40', '104', '316.650.000', 'Sold'),
(315, 'Acumina', 'B-15', '7', '32', '64', '29', '93', '318.300.000', 'Sold'),
(316, 'Acumina', 'B-15', '8', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(317, 'Acumina', 'B-15', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(318, 'Acumina', 'B-15', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(319, 'Acumina', 'B-15', '11', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(320, 'Acumina', 'B-15', '12', '32', '64', '19', '83', '301.500.000', 'Sold'),
(321, 'Acumina', 'B-16', '1', '32', '64', '19', '83', '314.300.000', 'Sold'),
(322, 'Acumina', 'B-16', '2', '32', '64', ' -   ', '64', '271.000.000', 'Sold'),
(323, 'Acumina', 'B-16', '3', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(324, 'Acumina', 'B-16', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(325, 'Acumina', 'B-16', '5', '32', '64', ' -   ', '64', '271.000.000', 'Sold'),
(326, 'Acumina', 'B-16', '6', '32', '64', '70', '134', '401.000.000', 'Sold'),
(327, 'Acumina', 'B-16', '7', '32', '64', ' -   ', '64', '266.000.000', 'Sold'),
(328, 'Acumina', 'B-16', '8', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(329, 'Acumina', 'B-16', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(330, 'Acumina', 'B-16', '10', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(331, 'Acumina', 'B-16', '11', '32', '64', '19', '83', '290.250.000', 'Sold'),
(332, 'Kocinea', 'B-17', '1', '32', '64', '62', '126', '351.000.000', 'Sold'),
(333, 'Kocinea', 'B-17', '2', '32', '64', '31', '95', '337.850.000', 'Sold'),
(334, 'Kocinea', 'B-17', '3', '32', '64', '35', '99', '321.500.000', 'Sold'),
(335, 'Kocinea', 'B-17', '4', '32', '64', '39', '103', '297.000.000', 'Available'),
(336, 'Kocinea', 'B-17', '5', '32', '64', '36', '100', '346.350.000', 'Sold'),
(337, 'Kocinea', 'B-17', '6', '32', '64', '32', '96', '297.000.000', 'Available'),
(338, 'Kocinea', 'B-17', '7', '32', '64', '38', '102', '297.000.000', 'Available'),
(339, 'Kocinea', 'B-17', '8', '32', '64', '43', '107', '297.000.000', 'Available'),
(340, 'Kocinea', 'B-17', '9', '32', '64', '39', '103', '297.000.000', 'Available'),
(341, 'Kocinea', 'B-17', '10', '32', '64', '97', '161', '417.500.000', 'Sold'),
(342, 'Kocinea', 'B-18', '1', '32', '64', '45', '109', '295.650.000', 'Sold'),
(343, 'Kocinea', 'B-18', '2', '32', '64', '35', '99', '325.500.000', 'Sold'),
(344, 'Kocinea', 'B-18', '3', '32', '64', '49', '113', '297.000.000', 'Available'),
(345, 'Kocinea', 'B-18', '4', '32', '64', '63', '127', '297.000.000', 'Available'),
(346, 'Kocinea', 'B-18', '5', '32', '64', '7', '71', '242.500.000', 'Sold'),
(347, 'Kocinea', 'B-18', '6', '32', '64', '4', '68', '238.000.000', 'Sold'),
(348, 'Kocinea', 'B-18', '7', '32', '64', '5', '69', '290.500.000', 'Sold'),
(349, 'Kocinea', 'B-18', '8', '32', '64', '9', '73', '239.750.000', 'Sold'),
(350, 'Kocinea', 'B-18', '9', '32', '64', '46', '110', '297.150.000', 'Sold'),
(351, 'Kocinea', 'B-18', '10', '32', '64', '35', '99', '297.000.000', 'Available'),
(352, 'Kocinea', 'B-18', '11', '32', '64', '9', '73', '239.750.000', 'Sold'),
(353, 'Kocinea', 'B-18', '12', '32', '64', '15', '79', '284.500.000', 'Sold'),
(354, 'Kocinea', 'B-19', '1', '32', '64', '14', '78', '268.000.000', 'Sold'),
(355, 'Kocinea', 'B-19', '2', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(356, 'Kocinea', 'B-19', '3', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(357, 'Kocinea', 'B-19', '4', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(358, 'Kocinea', 'B-19', '5', '32', '64', '31', '95', '308.500.000', 'Sold'),
(359, 'Kocinea', 'B-19', '6', '32', '64', '31', '95', '338.700.000', 'Sold'),
(360, 'Kocinea', 'B-19', '7', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(361, 'Kocinea', 'B-19', '8', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(362, 'Kocinea', 'B-19', '9', '32', '64', ' -   ', '64', '284.000.000', 'Sold'),
(363, 'Kocinea', 'B-19', '10', '32', '64', '14', '78', '305.800.000', 'Sold'),
(364, 'Kocinea', 'B-20', '11', '32', '64', '34', '98', '250.650.000', 'Sold'),
(365, 'Kocinea', 'B-20', '12', '32', '64', '15', '79', '289.900.000', 'Sold'),
(366, 'Kocinea', 'B-20', '13', '32', '64', '15', '79', '443.000.000', 'Sold'),
(367, 'Kocinea', 'B-20', '14', '32', '64', '15', '79', '422.000.000', 'Sold'),
(368, 'Kocinea', 'B-20', '15', '32', '64', '15', '79', '336.800.000', 'Sold'),
(369, 'Kocinea', 'B-20', '16', '32', '64', '15', '79', '309.500.000', 'Sold'),
(370, 'Kocinea', 'B-20', '17', '32', '64', '15', '79', '310.650.000', 'Sold'),
(371, 'Kocinea', 'B-20', '18', '32', '64', '98', '162', '310.650.000', 'Sold'),
(372, 'Kocinea', 'B-20', '19', '32', '64', '117', '181', '310.650.000', 'Sold'),
(373, 'Kocinea', 'B-20', '20', '32', '64', '15', '79', '309.500.000', 'Sold'),
(374, 'Kocinea', 'B-20', '21', '32', '64', '19', '83', '310.650.000', 'Sold'),
(375, 'Acumina', 'C-1', '1', '32', '64', '15', '79', '282.950.000', 'Sold'),
(376, 'Acumina', 'C-1', '2', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(377, 'Acumina', 'C-1', '3', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(378, 'Acumina', 'C-1', '4', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(379, 'Acumina', 'C-1', '5', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(380, 'Acumina', 'C-1', '6', '32', '64', ' -   ', '64', '258.550.000', 'Sold'),
(381, 'Acumina', 'C-1', '7', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(382, 'Acumina', 'C-1', '8', '32', '64', ' -   ', '64', '259.000.000', 'Sold'),
(383, 'Acumina', 'C-1', '9', '32', '64', '23', '87', '295.500.000', 'Sold'),
(384, 'Acumina', 'C-1', '10', '32', '64', '23', '87', '526.000.000', 'Sold'),
(385, 'Acumina', 'C-1', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(386, 'Acumina', 'C-1', '12', '32', '64', ' -   ', '64', '228.000.000', 'Sold'),
(387, 'Acumina', 'C-1', '13', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(388, 'Acumina', 'C-1', '14', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(389, 'Acumina', 'C-1', '15', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(390, 'Acumina', 'C-1', '16', '32', '64', ' -   ', '64', '252.000.000', 'Sold'),
(391, 'Acumina', 'C-1', '17', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(392, 'Acumina', 'C-1', '18', '32', '64', '15', '79', '276.500.000', 'Sold'),
(393, 'Acumina', 'C-2', '1', '32', '64', '15', '79', '279.500.000', 'Sold'),
(394, 'Acumina', 'C-2', '2', '32', '64', ' -   ', '64', '252.000.000', 'Sold'),
(395, 'Acumina', 'C-2', '3', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(396, 'Acumina', 'C-2', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(397, 'Acumina', 'C-2', '5', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(398, 'Acumina', 'C-2', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(399, 'Acumina', 'C-2', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(400, 'Acumina', 'C-2', '8', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(401, 'Acumina', 'C-2', '9', '32', '64', '23', '87', '321.100.000', 'Sold'),
(402, 'Acumina', 'C-2', '10', '32', '64', '23', '87', '321.100.000', 'Sold'),
(403, 'Acumina', 'C-2', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(404, 'Acumina', 'C-2', '12', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(405, 'Acumina', 'C-2', '13', '32', '64', ' -   ', '64', '194.687.500', 'Sold'),
(406, 'Acumina', 'C-2', '14', '32', '64', ' -   ', '64', '194.687.500', 'Sold'),
(407, 'Acumina', 'C-2', '15', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(408, 'Acumina', 'C-2', '16', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(409, 'Acumina', 'C-2', '17', '32', '64', ' -   ', '64', '254.750.000', 'Sold'),
(410, 'Acumina', 'C-2', '18', '32', '64', '15', '79', '279.500.000', 'Sold'),
(411, 'Acumina', 'C-3', '1', '32', '64', '15', '79', '279.250.000', 'Sold'),
(412, 'Acumina', 'C-3', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(413, 'Acumina', 'C-3', '3', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(414, 'Acumina', 'C-3', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(415, 'Acumina', 'C-3', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(416, 'Acumina', 'C-3', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(417, 'Acumina', 'C-3', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(418, 'Acumina', 'C-3', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(419, 'Acumina', 'C-3', '9', '32', '64', '23', '87', '291.150.000', 'Sold'),
(420, 'Acumina', 'C-3', '10', '32', '64', '67', '131', '364.900.000', 'Sold'),
(421, 'Acumina', 'C-3', '11', '32', '64', '22', '86', '308.400.000', 'Sold'),
(422, 'Acumina', 'C-3', '12', '32', '64', '27', '91', '314.900.000', 'Sold'),
(423, 'Acumina', 'C-3', '13', '32', '64', '23', '87', '291.150.000', 'Sold'),
(424, 'Acumina', 'C-3', '14', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(425, 'Acumina', 'C-3', '15', '32', '64', ' -   ', '64', '264.250.000', 'Sold'),
(426, 'Acumina', 'C-3', '16', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(427, 'Acumina', 'C-3', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(428, 'Acumina', 'C-3', '18', '32', '64', ' -   ', '64', '240.000.000', 'Sold'),
(429, 'Acumina', 'C-3', '19', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(430, 'Acumina', 'C-3', '20', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(431, 'Acumina', 'C-3', '21', '32', '64', '15', '79', '279.500.000', 'Sold'),
(432, 'Acumina', 'C-4', '1', '32', '64', '15', '79', '288.250.000', 'Sold'),
(433, 'Acumina', 'C-4', '2', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(434, 'Acumina', 'C-4', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(435, 'Acumina', 'C-4', '4', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(436, 'Acumina', 'C-4', '5', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(437, 'Acumina', 'C-4', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(438, 'Acumina', 'C-4', '7', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(439, 'Acumina', 'C-4', '8', '32', '64', '7', '71', '270.250.000', 'Sold'),
(440, 'Acumina', 'C-4', '9', '32', '64', '7', '71', '293.900.000', 'Sold'),
(441, 'Acumina', 'C-4', '10', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(442, 'Acumina', 'C-4', '11', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(443, 'Acumina', 'C-4', '12', '32', '64', ' -   ', '64', '235.000.000', 'Sold'),
(444, 'Acumina', 'C-4', '13', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(445, 'Acumina', 'C-4', '14', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(446, 'Acumina', 'C-4', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(447, 'Acumina', 'C-4', '16', '32', '64', '15', '79', '280.500.000', 'Sold'),
(448, 'Acumina', 'C-5', '1', '32', '64', '15', '79', '288.250.000', 'Sold'),
(449, 'Acumina', 'C-5', '2', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(450, 'Acumina', 'C-5', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(451, 'Acumina', 'C-5', '4', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(452, 'Acumina', 'C-5', '5', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(453, 'Acumina', 'C-5', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(454, 'Acumina', 'C-5', '7', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(455, 'Acumina', 'C-5', '8', '32', '64', '7', '71', '297.900.000', 'Sold'),
(456, 'Acumina', 'C-5', '9', '32', '64', '9', '73', '270.150.000', 'Sold'),
(457, 'Acumina', 'C-5', '10', '32', '64', '3', '67', '254.100.000', 'Sold'),
(458, 'Acumina', 'C-5', '11', '32', '64', '7', '71', '273.900.000', 'Sold'),
(459, 'Acumina', 'C-5', '12', '32', '64', '10', '74', '289.000.000', 'Sold'),
(460, 'Acumina', 'C-5', '13', '32', '64', '7', '71', '262.900.000', 'Sold'),
(461, 'Acumina', 'C-5', '14', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(462, 'Acumina', 'C-5', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(463, 'Acumina', 'C-5', '16', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(464, 'Acumina', 'C-5', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(465, 'Acumina', 'C-5', '18', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(466, 'Acumina', 'C-5', '19', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(467, 'Acumina', 'C-5', '20', '32', '64', '15', '79', '284.250.000', 'Sold'),
(468, 'Acumina', 'C-6', '1', '32', '64', '15', '79', '300.500.000', 'Sold'),
(469, 'Acumina', 'C-6', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(470, 'Acumina', 'C-6', '3', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(471, 'Acumina', 'C-6', '4', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(472, 'Acumina', 'C-6', '5', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(473, 'Acumina', 'C-6', '6', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(474, 'Acumina', 'C-6', '7', '32', '64', ' -   ', '64', '254.000.000', 'Sold'),
(475, 'Acumina', 'C-6', '8', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(476, 'Acumina', 'C-6', '9', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(477, 'Acumina', 'C-6', '10', '32', '64', '15', '79', '294.500.000', 'Sold'),
(478, 'Acumina', 'C-6', '11', '32', '64', '15', '79', '298.500.000', 'Sold'),
(479, 'Acumina', 'C-6', '12', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(480, 'Acumina', 'C-6', '13', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(481, 'Acumina', 'C-6', '14', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(482, 'Acumina', 'C-6', '15', '32', '64', ' -   ', '64', '256.000.000', 'Sold'),
(483, 'Acumina', 'C-6', '16', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(484, 'Acumina', 'C-6', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(485, 'Acumina', 'C-6', '18', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(486, 'Acumina', 'C-6', '19', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(487, 'Acumina', 'C-6', '20', '32', '64', '15', '79', '284.250.000', 'Sold'),
(488, 'Acumina', 'C-7', '1', '32', '64', '15', '79', '275.500.000', 'Sold'),
(489, 'Acumina', 'C-7', '2', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(490, 'Acumina', 'C-7', '3', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(491, 'Acumina', 'C-7', '4', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(492, 'Acumina', 'C-7', '5', '32', '64', ' -   ', '64', '272.000.000', 'Sold'),
(493, 'Acumina', 'C-7', '6', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(494, 'Acumina', 'C-7', '7', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(495, 'Acumina', 'C-7', '8', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(496, 'Acumina', 'C-7', '9', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(497, 'Acumina', 'C-7', '10', '32', '64', '15', '79', '298.500.000', 'Sold'),
(498, 'Acumina', 'C-7', '11', '32', '64', '15', '79', '301.150.000', 'Sold'),
(499, 'Acumina', 'C-7', '12', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(500, 'Acumina', 'C-7', '13', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(501, 'Acumina', 'C-7', '14', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(502, 'Acumina', 'C-7', '15', '32', '64', ' -   ', '64', '253.800.000', 'Sold'),
(503, 'Acumina', 'C-7', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(504, 'Acumina', 'C-7', '17', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(505, 'Acumina', 'C-7', '18', '32', '64', ' -   ', '64', '273.750.000', 'Sold'),
(506, 'Acumina', 'C-7', '19', '32', '64', ' -   ', '64', '275.000.000', 'Sold'),
(507, 'Acumina', 'C-7', '20', '32', '64', '15', '79', '275.500.000', 'Sold'),
(508, 'Acumina', 'C-8', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(509, 'Acumina', 'C-8', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(510, 'Acumina', 'C-8', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(511, 'Acumina', 'C-8', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(512, 'Acumina', 'C-8', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(513, 'Acumina', 'C-8', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(514, 'Acumina', 'C-8', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(515, 'Acumina', 'C-8', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(516, 'Acumina', 'C-8', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(517, 'Acumina', 'C-8', '10', '32', '64', '15', '79', '299.000.000', 'Close'),
(518, 'Acumina', 'C-8', '11', '32', '64', '103', '167', '299.000.000', 'Close'),
(519, 'Acumina', 'C-8', '12', '32', '64', '49', '113', '297.000.000', 'Close'),
(520, 'Acumina', 'C-8', '13', '32', '64', '64', '128', '299.000.000', 'Close'),
(521, 'Acumina', 'C-8', '14', '32', '64', '15', '79', '299.000.000', 'Close'),
(522, 'Acumina', 'C-8', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(523, 'Acumina', 'C-8', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(524, 'Acumina', 'C-8', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(525, 'Acumina', 'C-8', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(526, 'Acumina', 'C-8', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(527, 'Acumina', 'C-8', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(528, 'Acumina', 'C-8', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(529, 'Acumina', 'C-8', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(530, 'Acumina', 'C-8', '23', '32', '64', '15', '79', '299.000.000', 'Close'),
(531, 'Acumina', 'C-9', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(532, 'Acumina', 'C-9', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(533, 'Acumina', 'C-9', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(534, 'Acumina', 'C-9', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(535, 'Acumina', 'C-9', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(536, 'Acumina', 'C-9', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(537, 'Acumina', 'C-9', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(538, 'Acumina', 'C-9', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(539, 'Acumina', 'C-9', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(540, 'Acumina', 'C-9', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(541, 'Acumina', 'C-9', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(542, 'Acumina', 'C-9', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(543, 'Acumina', 'C-9', '13', '32', '64', '41', '105', '299.000.000', 'Close'),
(544, 'Acumina', 'C-9', '14', '32', '64', '43', '107', '299.000.000', 'Close'),
(545, 'Acumina', 'C-9', '15', '32', '64', '34', '98', '297.000.000', 'Close'),
(546, 'Acumina', 'C-9', '16', '32', '64', '33', '97', '297.000.000', 'Close'),
(547, 'Acumina', 'C-9', '17', '32', '64', '32', '96', '297.000.000', 'Close'),
(548, 'Acumina', 'C-9', '18', '32', '64', '49', '113', '299.000.000', 'Close'),
(549, 'Acumina', 'C-9', '19', '32', '64', '41', '105', '299.000.000', 'Close'),
(550, 'Acumina', 'C-9', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(551, 'Acumina', 'C-9', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(552, 'Acumina', 'C-9', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(553, 'Acumina', 'C-9', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(554, 'Acumina', 'C-9', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(555, 'Acumina', 'C-9', '25', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(556, 'Acumina', 'C-9', '26', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(557, 'Acumina', 'C-9', '27', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(558, 'Acumina', 'C-9', '28', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(559, 'Acumina', 'C-9', '29', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(560, 'Acumina', 'C-9', '30', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(561, 'Acumina', 'C-9', '31', '32', '64', '15', '79', '299.000.000', 'Close'),
(562, 'Acumina', 'C-10', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(563, 'Acumina', 'C-10', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(564, 'Acumina', 'C-10', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(565, 'Acumina', 'C-10', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(566, 'Acumina', 'C-10', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(567, 'Acumina', 'C-10', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(568, 'Acumina', 'C-10', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(569, 'Acumina', 'C-10', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(570, 'Acumina', 'C-10', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(571, 'Acumina', 'C-10', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(572, 'Acumina', 'C-10', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(573, 'Acumina', 'C-10', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(574, 'Acumina', 'C-10', '13', '32', '64', '41', '105', '299.000.000', 'Close'),
(575, 'Acumina', 'C-10', '14', '32', '64', '32', '96', '299.000.000', 'Close'),
(576, 'Acumina', 'C-10', '15', '32', '64', '16', '80', '297.000.000', 'Close'),
(577, 'Acumina', 'C-10', '16', '32', '64', '16', '80', '297.000.000', 'Close'),
(578, 'Acumina', 'C-10', '17', '32', '64', '16', '80', '297.000.000', 'Close'),
(579, 'Acumina', 'C-10', '18', '32', '64', '36', '100', '299.000.000', 'Close'),
(580, 'Acumina', 'C-10', '19', '32', '64', '41', '105', '299.000.000', 'Close'),
(581, 'Acumina', 'C-10', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(582, 'Acumina', 'C-10', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(583, 'Acumina', 'C-10', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(584, 'Acumina', 'C-10', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(585, 'Acumina', 'C-10', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(586, 'Acumina', 'C-10', '25', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(587, 'Acumina', 'C-10', '26', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(588, 'Acumina', 'C-10', '27', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(589, 'Acumina', 'C-10', '28', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(590, 'Acumina', 'C-10', '29', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(591, 'Acumina', 'C-10', '30', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(592, 'Acumina', 'C-10', '31', '32', '64', '9', '73', '299.000.000', 'Close'),
(593, 'Acumina', 'C-11', '1', '32', '64', '15', '79', '299.000.000', 'Close'),
(594, 'Acumina', 'C-11', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(595, 'Acumina', 'C-11', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(596, 'Acumina', 'C-11', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(597, 'Acumina', 'C-11', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(598, 'Acumina', 'C-11', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(599, 'Acumina', 'C-11', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(600, 'Acumina', 'C-11', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(601, 'Acumina', 'C-11', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(602, 'Acumina', 'C-11', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(603, 'Acumina', 'C-11', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(604, 'Acumina', 'C-11', '12', '32', '64', '15', '79', '299.000.000', 'Close'),
(605, 'Acumina', 'C-11', '13', '32', '64', '27', '91', '299.000.000', 'Close'),
(606, 'Acumina', 'C-11', '14', '32', '64', '52', '116', '299.000.000', 'Close'),
(607, 'Acumina', 'C-11', '15', '32', '64', '15', '79', '299.000.000', 'Close'),
(608, 'Acumina', 'C-11', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(609, 'Acumina', 'C-11', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(610, 'Acumina', 'C-11', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(611, 'Acumina', 'C-11', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(612, 'Acumina', 'C-11', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(613, 'Acumina', 'C-11', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(614, 'Acumina', 'C-11', '22', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(615, 'Acumina', 'C-11', '23', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(616, 'Acumina', 'C-11', '24', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(617, 'Acumina', 'C-11', '25', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(618, 'Acumina', 'C-11', '26', '32', '64', '15', '79', '296.000.000', 'Sold'),
(619, 'Acumina', 'C-12', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(620, 'Acumina', 'C-12', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(621, 'Acumina', 'C-12', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(622, 'Acumina', 'C-12', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(623, 'Acumina', 'C-12', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(624, 'Acumina', 'C-12', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(625, 'Acumina', 'C-12', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(626, 'Acumina', 'C-12', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(627, 'Acumina', 'C-12', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(628, 'Acumina', 'C-12', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(629, 'Acumina', 'C-12', '11', '32', '64', '15', '79', '299.000.000', 'Close'),
(630, 'Acumina', 'C-12', '12', '32', '64', '15', '79', '299.000.000', 'Close');
INSERT INTO `unit_rumah` (`id_unit_rumah`, `type`, `blok`, `no`, `lb`, `lt`, `nstd`, `total`, `harga_jual`, `status_penjualan`) VALUES
(631, 'Acumina', 'C-12', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(632, 'Acumina', 'C-12', '14', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(633, 'Acumina', 'C-12', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(634, 'Acumina', 'C-12', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(635, 'Acumina', 'C-12', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(636, 'Acumina', 'C-12', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(637, 'Acumina', 'C-12', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(638, 'Acumina', 'C-12', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(639, 'Acumina', 'C-12', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(640, 'Acumina', 'C-12', '22', '32', '64', '23', '87', '299.000.000', 'Close'),
(641, 'Acumina', 'C-13', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(642, 'Acumina', 'C-13', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(643, 'Acumina', 'C-13', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(644, 'Acumina', 'C-13', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(645, 'Acumina', 'C-13', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(646, 'Acumina', 'C-13', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(647, 'Acumina', 'C-13', '7', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(648, 'Acumina', 'C-13', '8', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(649, 'Acumina', 'C-13', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(650, 'Acumina', 'C-13', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(651, 'Acumina', 'C-13', '11', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(652, 'Acumina', 'C-13', '12', '32', '64', ' -   ', '64', '299.000.000', 'Close'),
(653, 'Acumina', 'C-13', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(654, 'Acumina', 'C-13', '14', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(655, 'Acumina', 'C-13', '15', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(656, 'Acumina', 'C-13', '16', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(657, 'Acumina', 'C-13', '17', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(658, 'Acumina', 'C-13', '18', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(659, 'Acumina', 'C-13', '19', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(660, 'Acumina', 'C-13', '20', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(661, 'Acumina', 'C-13', '21', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(662, 'Acumina', 'C-13', '22', '32', '64', '23', '87', '299.000.000', 'Close'),
(663, 'Acumina', 'C-14', '1', '32', '64', '23', '87', '299.000.000', 'Close'),
(664, 'Acumina', 'C-14', '2', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(665, 'Acumina', 'C-14', '3', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(666, 'Acumina', 'C-14', '4', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(667, 'Acumina', 'C-14', '5', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(668, 'Acumina', 'C-14', '6', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(669, 'Acumina', 'C-14', '7', '32', '64', '33', '97', '299.000.000', 'Close'),
(670, 'Acumina', 'C-14', '8', '32', '64', '7', '71', '299.000.000', 'Close'),
(671, 'Acumina', 'C-14', '9', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(672, 'Acumina', 'C-14', '10', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(673, 'Acumina', 'C-14', '11', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(674, 'Acumina', 'C-14', '12', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(675, 'Acumina', 'C-14', '13', '32', '64', ' -   ', '64', '297.000.000', 'Close'),
(676, 'Acumina', 'C-14', '14', '32', '64', '23', '87', '299.000.000', 'Close'),
(677, 'Acumina', 'C-15', '8', '32', '64', '121', '185', '299.000.000', 'Close'),
(678, 'Acumina', 'C-15', '9', '32', '64', '51', '115', '297.000.000', 'Close'),
(679, 'Acumina', 'C-15', '10', '32', '64', '89', '153', '299.000.000', 'Close'),
(680, 'Acumina', 'C-15', '11', '32', '64', '19', '83', '299.000.000', 'Close'),
(681, 'Acumina', 'C-15', '12', '32', '64', '16', '80', '297.000.000', 'Close'),
(682, 'Acumina', 'C-15', '13', '32', '64', '16', '80', '297.000.000', 'Close'),
(683, 'Acumina', 'C-15', '14', '32', '64', '16', '80', '297.000.000', 'Close'),
(684, 'Acumina', 'C-15', '15', '32', '64', '43', '107', '299.000.000', 'Close'),
(685, 'Acumina', 'C-15', '16', '32', '64', '113', '177', '299.000.000', 'Close'),
(686, 'Acumina', 'C-15', '17', '32', '64', '23', '87', '297.000.000', 'Close'),
(687, 'Acumina', 'C-15', '18', '32', '64', '35', '99', '299.000.000', 'Close'),
(688, 'Kocinea', 'D-1', '1', '32', '64', '23', '87', '296.500.000', 'Sold'),
(689, 'Kocinea', 'D-1', '2', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(690, 'Kocinea', 'D-1', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(691, 'Kocinea', 'D-1', '4', '32', '64', ' -   ', '64', '250.000.000', 'Sold'),
(692, 'Kocinea', 'D-1', '5', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(693, 'Kocinea', 'D-1', '6', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(694, 'Kocinea', 'D-1', '7', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(695, 'Kocinea', 'D-1', '8', '32', '64', ' -   ', '64', '247.000.000', 'Sold'),
(696, 'Kocinea', 'D-1', '9', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(697, 'Kocinea', 'D-1', '10', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(698, 'Kocinea', 'D-1', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(699, 'Kocinea', 'D-1', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(700, 'Kocinea', 'D-1', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(701, 'Kocinea', 'D-1', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(702, 'Kocinea', 'D-1', '15', '32', '64', '15', '79', '299.000.000', 'Available'),
(703, 'Kocinea', 'D-1', '16', '32', '64', '15', '79', '299.000.000', 'Available'),
(704, 'Kocinea', 'D-1', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(705, 'Kocinea', 'D-1', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(706, 'Kocinea', 'D-1', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(707, 'Kocinea', 'D-1', '20', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(708, 'Kocinea', 'D-1', '21', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(709, 'Kocinea', 'D-1', '22', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(710, 'Kocinea', 'D-1', '23', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(711, 'Kocinea', 'D-1', '24', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(712, 'Kocinea', 'D-1', '25', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(713, 'Kocinea', 'D-1', '26', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(714, 'Kocinea', 'D-1', '27', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(715, 'Kocinea', 'D-1', '28', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(716, 'Kocinea', 'D-1', '29', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(717, 'Kocinea', 'D-1', '30', '32', '64', '23', '87', '296.500.000', 'Sold'),
(718, 'Kocinea', 'D-2', '1', '32', '64', '23', '87', '295.900.000', 'Sold'),
(719, 'Kocinea', 'D-2', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(720, 'Kocinea', 'D-2', '3', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(721, 'Kocinea', 'D-2', '4', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(722, 'Kocinea', 'D-2', '5', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(723, 'Kocinea', 'D-2', '6', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(724, 'Kocinea', 'D-2', '7', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(725, 'Kocinea', 'D-2', '8', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(726, 'Kocinea', 'D-2', '9', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(727, 'Kocinea', 'D-2', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(728, 'Kocinea', 'D-2', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(729, 'Kocinea', 'D-2', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(730, 'Kocinea', 'D-2', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(731, 'Kocinea', 'D-2', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(732, 'Kocinea', 'D-2', '15', '32', '64', '15', '79', '299.000.000', 'Available'),
(733, 'Kocinea', 'D-2', '16', '32', '64', '15', '79', '299.000.000', 'Available'),
(734, 'Kocinea', 'D-2', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(735, 'Kocinea', 'D-2', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(736, 'Kocinea', 'D-2', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(737, 'Kocinea', 'D-2', '20', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(738, 'Kocinea', 'D-2', '21', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(739, 'Kocinea', 'D-2', '22', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(740, 'Kocinea', 'D-2', '23', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(741, 'Kocinea', 'D-2', '24', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(742, 'Kocinea', 'D-2', '25', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(743, 'Kocinea', 'D-2', '26', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(744, 'Kocinea', 'D-2', '27', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(745, 'Kocinea', 'D-2', '28', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(746, 'Kocinea', 'D-2', '29', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(747, 'Kocinea', 'D-2', '30', '32', '64', '23', '87', '295.900.000', 'Sold'),
(748, 'Kocinea', 'D-3', '1', '32', '64', '23', '87', '309.500.000', 'Sold'),
(749, 'Kocinea', 'D-3', '2', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(750, 'Kocinea', 'D-3', '3', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(751, 'Kocinea', 'D-3', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(752, 'Kocinea', 'D-3', '5', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(753, 'Kocinea', 'D-3', '6', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(754, 'Kocinea', 'D-3', '7', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(755, 'Kocinea', 'D-3', '8', '32', '64', ' -   ', '64', '269.000.000', 'Sold'),
(756, 'Kocinea', 'D-3', '9', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(757, 'Kocinea', 'D-3', '10', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(758, 'Kocinea', 'D-3', '11', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(759, 'Kocinea', 'D-3', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(760, 'Kocinea', 'D-3', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(761, 'Kocinea', 'D-3', '14', '32', '64', '75', '139', '299.000.000', 'Available'),
(762, 'Kocinea', 'D-3', '15', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(763, 'Kocinea', 'D-3', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(764, 'Kocinea', 'D-3', '17', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(765, 'Kocinea', 'D-3', '18', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(766, 'Kocinea', 'D-3', '19', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(767, 'Kocinea', 'D-3', '20', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(768, 'Kocinea', 'D-3', '21', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(769, 'Kocinea', 'D-3', '22', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(770, 'Kocinea', 'D-3', '23', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(771, 'Kocinea', 'D-3', '24', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(772, 'Kocinea', 'D-3', '25', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(773, 'Kocinea', 'D-3', '26', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(774, 'Kocinea', 'D-3', '27', '32', '64', '23', '87', '262.650.000', 'Sold'),
(775, 'Kocinea', 'D-4', '1', '32', '64', '23', '87', '262.650.000', 'Sold'),
(776, 'Kocinea', 'D-4', '2', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(777, 'Kocinea', 'D-4', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(778, 'Kocinea', 'D-4', '4', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(779, 'Kocinea', 'D-4', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(780, 'Kocinea', 'D-4', '6', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(781, 'Kocinea', 'D-4', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(782, 'Kocinea', 'D-4', '8', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(783, 'Kocinea', 'D-4', '9', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(784, 'Kocinea', 'D-4', '10', '32', '64', '19', '83', '256.650.000', 'Sold'),
(785, 'Kocinea', 'D-4', '11', '32', '64', '23', '87', '262.650.000', 'Sold'),
(786, 'Kocinea', 'D-4', '12', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(787, 'Kocinea', 'D-4', '13', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(788, 'Kocinea', 'D-4', '14', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(789, 'Kocinea', 'D-4', '15', '32', '64', ' -   ', '64', '242.000.000', 'Sold'),
(790, 'Kocinea', 'D-4', '16', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(791, 'Kocinea', 'D-4', '17', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(792, 'Kocinea', 'D-4', '18', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(793, 'Kocinea', 'D-4', '19', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(794, 'Kocinea', 'D-4', '20', '32', '64', '23', '87', '262.650.000', 'Sold'),
(795, 'Kocinea', 'D-5', '1', '32', '64', '23', '87', '266.500.000', 'Sold'),
(796, 'Kocinea', 'D-5', '2', '32', '64', ' -   ', '64', '245.000.000', 'Sold'),
(797, 'Kocinea', 'D-5', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(798, 'Kocinea', 'D-5', '4', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(799, 'Kocinea', 'D-5', '5', '32', '64', '23', '87', '299.000.000', 'Available'),
(800, 'Kocinea', 'D-5', '6', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(801, 'Kocinea', 'D-5', '7', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(802, 'Kocinea', 'D-5', '8', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(803, 'Kocinea', 'D-5', '9', '32', '64', '60', '124', '347.000.000', 'Sold'),
(804, 'Kocinea', 'D-5', '10', '32', '64', '65', '129', '343.700.000', 'Sold'),
(805, 'Kocinea', 'D-6', '1', '32', '64', '23', '87', '235.500.000', 'Sold'),
(806, 'Kocinea', 'D-6', '2', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(807, 'Kocinea', 'D-6', '3', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(808, 'Kocinea', 'D-6', '4', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(809, 'Kocinea', 'D-6', '5', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(810, 'Kocinea', 'D-6', '6', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(811, 'Kocinea', 'D-6', '7', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(812, 'Kocinea', 'D-6', '8', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(813, 'Kocinea', 'D-6', '9', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(814, 'Kocinea', 'D-6', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(815, 'Kocinea', 'D-6', '11', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(816, 'Kocinea', 'D-6', '12', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(817, 'Kocinea', 'D-6', '13', '32', '64', '45', '109', '313.700.000', 'Sold'),
(818, 'Kocinea', 'D-6', '14', '32', '64', '19', '83', '299.000.000', 'Available'),
(819, 'Kocinea', 'D-6', '15', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(820, 'Kocinea', 'D-6', '16', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(821, 'Kocinea', 'D-6', '17', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(822, 'Kocinea', 'D-6', '18', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(823, 'Kocinea', 'D-6', '19', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(824, 'Kocinea', 'D-6', '20', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(825, 'Kocinea', 'D-6', '21', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(826, 'Kocinea', 'D-6', '22', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(827, 'Kocinea', 'D-6', '23', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(828, 'Kocinea', 'D-6', '24', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(829, 'Kocinea', 'D-6', '25', '32', '64', ' -   ', '64', '285.150.000', 'Sold'),
(830, 'Kocinea', 'D-6', '26', '32', '64', ' -   ', '64', '280.000.000', 'Sold'),
(831, 'Kocinea', 'D-6', '27', '32', '64', '23', '87', '266.500.000', 'Sold'),
(832, 'Kocinea', 'D-7', '1', '32', '64', '57', '121', '331.700.000', 'Sold'),
(833, 'Kocinea', 'D-7', '2', '32', '64', '8', '72', '297.000.000', 'Available'),
(834, 'Kocinea', 'D-7', '3', '32', '64', '4', '68', '297.000.000', 'Available'),
(835, 'Kocinea', 'D-7', '4', '32', '64', '13', '77', '297.000.000', 'Available'),
(836, 'Kocinea', 'D-7', '5', '32', '64', '32', '96', '297.000.000', 'Available'),
(837, 'Kocinea', 'D-7', '6', '32', '64', '50', '114', '297.000.000', 'Available'),
(838, 'Kocinea', 'D-7', '7', '32', '64', '67', '131', '299.000.000', 'Available'),
(839, 'Kocinea', 'D-7', '8', '32', '64', '11', '75', '299.000.000', 'Available'),
(840, 'Kocinea', 'D-7', '9', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(841, 'Kocinea', 'D-7', '10', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(842, 'Kocinea', 'D-7', '11', '32', '64', '37', '101', '299.000.000', 'Available'),
(843, 'Kocinea', 'D-7', '12', '32', '64', '37', '101', '299.000.000', 'Available'),
(844, 'Kocinea', 'D-7', '13', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(845, 'Kocinea', 'D-7', '14', '32', '64', ' -   ', '64', '297.000.000', 'Available'),
(846, 'Kocinea', 'D-7', '15', '32', '64', '11', '75', '299.000.000', 'Available'),
(847, 'Kocinea', 'D-7', '16', '32', '64', '158', '222', '299.000.000', 'Available'),
(848, 'Kocinea', 'D-7', '17', '32', '64', '46', '110', '297.000.000', 'Available'),
(849, 'Kocinea', 'D-7', '18', '32', '64', '51', '115', '297.000.000', 'Available'),
(850, 'Kocinea', 'D-7', '19', '32', '64', '57', '121', '297.000.000', 'Available'),
(851, 'Kocinea', 'D-7', '20', '32', '64', '64', '128', '297.000.000', 'Available'),
(852, 'Kocinea', 'D-7', '21', '32', '64', '77', '141', '299.000.000', 'Available'),
(853, 'Kocinea', 'D-8', '1', '32', '64', '23', '87', '291.500.000', 'Sold'),
(854, 'Kocinea', 'D-8', '2', '32', '64', ' -   ', '64', '209.000.000', 'Sold'),
(855, 'Kocinea', 'D-8', '3', '32', '64', ' -   ', '64', '225.000.000', 'Sold'),
(856, 'Kocinea', 'D-8', '4', '32', '64', ' -   ', '64', '257.000.000', 'Sold'),
(857, 'Kocinea', 'D-8', '5', '32', '64', ' -   ', '64', '267.500.000', 'Sold'),
(858, 'Kocinea', 'D-8', '6', '32', '64', ' -   ', '64', '210.000.000', 'Sold'),
(859, 'Kocinea', 'D-8', '7', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(860, 'Kocinea', 'D-8', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(861, 'Kocinea', 'D-8', '9', '32', '64', '23', '87', '262.650.000', 'Sold'),
(862, 'Kocinea', 'D-8', '10', '32', '64', '23', '87', '', 'Sold'),
(863, 'Kocinea', 'D-8', '11', '32', '64', ' -   ', '64', '271.850.000', 'Sold'),
(864, 'Kocinea', 'D-8', '12', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(865, 'Kocinea', 'D-8', '13', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(866, 'Kocinea', 'D-8', '14', '32', '64', ' -   ', '64', '243.350.000', 'Sold'),
(867, 'Kocinea', 'D-8', '15', '32', '64', ' -   ', '64', '225.000.000', 'Sold'),
(868, 'Kocinea', 'D-8', '16', '32', '64', ' -   ', '64', '273.000.000', 'Sold'),
(869, 'Kocinea', 'D-8', '17', '32', '64', ' -   ', '64', '244.000.000', 'Sold'),
(870, 'Kocinea', 'D-8', '18', '32', '64', '23', '87', '293.500.000', 'Sold'),
(871, 'Kocinea', 'D-9', '1', '32', '64', '23', '87', '266.250.000', 'Sold'),
(872, 'Kocinea', 'D-9', '2', '32', '64', ' -   ', '64', '251.000.000', 'Sold'),
(873, 'Kocinea', 'D-9', '3', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(874, 'Kocinea', 'D-9', '4', '32', '64', ' -   ', '64', '270.000.000', 'Sold'),
(875, 'Kocinea', 'D-9', '5', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(876, 'Kocinea', 'D-9', '6', '32', '64', '23', '87', '281.500.000', 'Sold'),
(877, 'Kocinea', 'D-9', '7', '32', '64', '23', '87', '295.900.000', 'Sold'),
(878, 'Kocinea', 'D-9', '8', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(879, 'Kocinea', 'D-9', '9', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(880, 'Kocinea', 'D-9', '10', '32', '64', ' -   ', '64', '259.500.000', 'Sold'),
(881, 'Kocinea', 'D-9', '11', '32', '64', ' -   ', '64', '226.250.000', 'Sold'),
(882, 'Kocinea', 'D-9', '12', '32', '64', '23', '87', '262.650.000', 'Sold'),
(883, 'Kocinea', 'D-10', '1', '32', '64', '23', '87', '278.500.000', 'Sold'),
(884, 'Kocinea', 'D-10', '2', '32', '64', ' -   ', '64', '231.000.000', 'Sold'),
(885, 'Kocinea', 'D-10', '3', '32', '64', ' -   ', '64', '248.100.000', 'Sold'),
(886, 'Kocinea', 'D-10', '4', '32', '64', ' -   ', '64', '235.000.000', 'Sold'),
(887, 'Kocinea', 'D-10', '5', '32', '64', ' -   ', '64', '249.000.000', 'Sold'),
(888, 'Kocinea', 'D-10', '6', '32', '64', '23', '87', '271.500.000', 'Sold'),
(889, 'Kocinea', 'D-10', '7', '32', '64', '23', '87', '266.500.000', 'Sold'),
(890, 'Kocinea', 'D-10', '8', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(891, 'Kocinea', 'D-10', '9', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(892, 'Kocinea', 'D-10', '10', '32', '64', ' -   ', '64', '230.000.000', 'Sold'),
(893, 'Kocinea', 'D-10', '11', '32', '64', ' -   ', '64', '260.000.000', 'Sold'),
(894, 'Kocinea', 'D-10', '12', '32', '64', '23', '87', '277.000.000', 'Sold');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_perusahaan` int(250) NOT NULL,
  `id_jabatans` int(30) NOT NULL,
  `id_roles` int(250) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `cabang_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mac_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` enum('pending','verified') COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_perusahaan`, `id_jabatans`, `id_roles`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone_number`, `is_active`, `cabang_id`, `mac_address`, `is_verified`, `updated_by`, `address`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Admin', 'admin@localhost.com', NULL, '$2a$12$fyytii4AV3J8yzB5V4hWHOodVA0lGdkXr4z9wYUun7PwfzjgLIRra', NULL, '82114823280', 1, 1, 'DC-53-60-02-84-01', 'verified', NULL, 'Palmerah, Jakarta Barat', 'images/users/hgitp4V9MG5C6rQ.png', NULL, '2021-07-16 19:36:06', '2022-02-23 07:51:35'),
(10, 1, 2, 8, 'hrd', 'hrd@test.com', NULL, '$2a$12$eMNtb1n9EX4bWgOz9k6JoOwM7AArixYDWYmJFu7m2cFwF0.OzIvD.', NULL, '980879', 1, 1, 'DC-53-60-02-84-01', 'verified', NULL, 'uhnjim', 'images/users/1DTA67QiTSv9EFv.jpg', NULL, '2021-10-07 04:00:59', '2021-10-07 04:01:21'),
(13, 1, 2, 0, 'zainuna', 'zainun@test.com', NULL, '$2y$10$IGToEofGjPjv4jsZBesG5.XNy.r5165Es8th2Mwv6ml.EkjeMX79W', NULL, '0909800980', 1, 1, 'DC-53-60-02-84-01', 'verified', NULL, 'sadsadsa', 'images/users/PlK5sRosBKNpYpp.png', NULL, '2022-02-09 04:27:10', '2022-02-09 04:27:27'),
(14, 1, 2, 10, 'salma', 'salma@gmail.com', NULL, '$2y$10$QVPsc21zrxh3Qee/1zaNoeu8h7LSZZAQPNXaA44G91RpafCN7fEly', NULL, '09090909', 1, 1, 'DC-53-60-02-84-01', 'verified', NULL, 'qwqwq', 'images/users/nykVErTyUXXARxj.png', NULL, '2022-02-15 05:04:31', '2022-02-15 05:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_voucher` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `min_transaksi` bigint(20) DEFAULT NULL,
  `nominal` bigint(20) NOT NULL,
  `type` enum('Per','Min') COLLATE utf8mb4_unicode_ci NOT NULL,
  `persentase` int(11) NOT NULL,
  `kuota` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `kode_voucher`, `tgl_mulai`, `tgl_akhir`, `min_transaksi`, `nominal`, `type`, `persentase`, `kuota`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'COBAINGRATIS', '2021-10-01', '2021-10-31', 1000000, 200000, 'Min', 0, 4, 1, '2021-10-11 01:46:12', '2021-10-11 09:02:17'),
(2, 'hHsiY7MMSi', '2021-10-11', '2021-10-31', 1000000, 100000, 'Min', 0, 1, 1, '2021-10-11 04:42:52', '2021-10-11 04:42:52'),
(3, 'NiTuwsr41m', '2021-10-11', '2021-10-31', 1000000, 100000, 'Min', 0, 1, 1, '2021-10-11 04:42:52', '2021-10-11 04:42:52'),
(4, 'AszuD9pEYf', '2021-10-11', '2021-10-31', 1000000, 100000, 'Min', 0, 1, 1, '2021-10-11 04:42:52', '2021-10-11 04:42:52'),
(5, 'RY6ATHMLRY', '2021-10-11', '2021-10-20', 0, 0, 'Per', 20, 1, 1, '2021-10-11 04:45:11', '2021-10-11 04:45:11'),
(6, '247RZ6KBOC', '2021-10-11', '2021-10-20', 0, 0, 'Per', 20, 0, 0, '2021-10-11 04:45:11', '2021-10-11 04:45:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_pegawai_id_foreign` (`pegawai_id`);

--
-- Indexes for table `agamas`
--
ALTER TABLE `agamas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cabangs`
--
ALTER TABLE `cabangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_chart_of_account`
--
ALTER TABLE `cat_chart_of_account`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`id_chart_of_account`),
  ADD KEY `child_numb` (`child_numb`),
  ADD KEY `status` (`status`),
  ADD KEY `kategori_gl` (`id_cat`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik_ktp` (`nik_ktp`);

--
-- Indexes for table `detail_tukar_faktur`
--
ALTER TABLE `detail_tukar_faktur`
  ADD PRIMARY KEY (`id_detail_tukar_faktur`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fisiks`
--
ALTER TABLE `fisiks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gigipasien`
--
ALTER TABLE `gigipasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpasien` (`customer_id`);

--
-- Indexes for table `harga_produk_cabangs`
--
ALTER TABLE `harga_produk_cabangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_outs`
--
ALTER TABLE `in_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ket_odontograms`
--
ALTER TABLE `ket_odontograms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komisis`
--
ALTER TABLE `komisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `odontogram_pasien`
--
ALTER TABLE `odontogram_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pegawais_user_id_foreign` (`user_id`),
  ADD KEY `pegawais_status_perkawinan_id_foreign` (`status_perkawinan_id`),
  ADD KEY `pegawais_agama_id_foreign` (`agama_id`),
  ADD KEY `pegawais_jabatan_id_foreign` (`jabatan_id`),
  ADD KEY `pegawais_pendidikan_id_foreign` (`pendidikan_id`),
  ADD KEY `pegawais_unit_id_foreign` (`unit_id`),
  ADD KEY `pegawais_perusahaan_id_foreign` (`perusahaan_id`),
  ADD KEY `pegawais_role_id_foreign` (`role_id`);

--
-- Indexes for table `pendidikans`
--
ALTER TABLE `pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerimaan_barangs`
--
ALTER TABLE `penerimaan_barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaan_barang_id_purchase` (`id_purchase`),
  ADD KEY `penerimaan_user_id_foriegn` (`id_user`);

--
-- Indexes for table `pengajuans`
--
ALTER TABLE `pengajuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `perusahaans`
--
ALTER TABLE `perusahaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reinbursts`
--
ALTER TABLE `reinbursts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_komisi`
--
ALTER TABLE `rincian_komisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_pembayarans`
--
ALTER TABLE `rincian_pembayarans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_pengajuans`
--
ALTER TABLE `rincian_pengajuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_reinbursts`
--
ALTER TABLE `rincian_reinbursts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rincian_tagihan_spr`
--
ALTER TABLE `rincian_tagihan_spr`
  ADD PRIMARY KEY (`id_rincian`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `ruangans`
--
ALTER TABLE `ruangans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simbol_odontograms`
--
ALTER TABLE `simbol_odontograms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skema_pembayaran`
--
ALTER TABLE `skema_pembayaran`
  ADD PRIMARY KEY (`id_skema`);

--
-- Indexes for table `spr`
--
ALTER TABLE `spr`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `status_pasiens`
--
ALTER TABLE `status_pasiens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_pernikahans`
--
ALTER TABLE `status_pernikahans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabel_simbol`
--
ALTER TABLE `tabel_simbol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `warna` (`warna`);

--
-- Indexes for table `tindakans`
--
ALTER TABLE `tindakans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_stoks`
--
ALTER TABLE `transfer_stoks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tukar_fakturs`
--
ALTER TABLE `tukar_fakturs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agamas`
--
ALTER TABLE `agamas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cabangs`
--
ALTER TABLE `cabangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_tukar_faktur`
--
ALTER TABLE `detail_tukar_faktur`
  MODIFY `id_detail_tukar_faktur` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fisiks`
--
ALTER TABLE `fisiks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gigipasien`
--
ALTER TABLE `gigipasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `harga_produk_cabangs`
--
ALTER TABLE `harga_produk_cabangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `in_outs`
--
ALTER TABLE `in_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `ket_odontograms`
--
ALTER TABLE `ket_odontograms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komisis`
--
ALTER TABLE `komisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `odontogram_pasien`
--
ALTER TABLE `odontogram_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pendidikans`
--
ALTER TABLE `pendidikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengajuans`
--
ALTER TABLE `pengajuans`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `perusahaans`
--
ALTER TABLE `perusahaans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reinbursts`
--
ALTER TABLE `reinbursts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rincian_komisi`
--
ALTER TABLE `rincian_komisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rincian_pembayarans`
--
ALTER TABLE `rincian_pembayarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rincian_pengajuans`
--
ALTER TABLE `rincian_pengajuans`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rincian_reinbursts`
--
ALTER TABLE `rincian_reinbursts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rincian_tagihan_spr`
--
ALTER TABLE `rincian_tagihan_spr`
  MODIFY `id_rincian` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ruangans`
--
ALTER TABLE `ruangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simbol_odontograms`
--
ALTER TABLE `simbol_odontograms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `skema_pembayaran`
--
ALTER TABLE `skema_pembayaran`
  MODIFY `id_skema` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spr`
--
ALTER TABLE `spr`
  MODIFY `id_transaksi` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_pasiens`
--
ALTER TABLE `status_pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_pernikahans`
--
ALTER TABLE `status_pernikahans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabel_simbol`
--
ALTER TABLE `tabel_simbol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tindakans`
--
ALTER TABLE `tindakans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transfer_stoks`
--
ALTER TABLE `transfer_stoks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tukar_fakturs`
--
ALTER TABLE `tukar_fakturs`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
