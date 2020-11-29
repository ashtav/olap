-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 29, 2020 at 11:30 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_olap`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_center`
--

CREATE TABLE `data_center` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_center`
--

INSERT INTO `data_center` (`id`, `nama_file`, `tahun`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 'Data Pak Bagus', '2020', 'lengkap dengan kota dan gps', '2020-11-17 06:09:21', '2020-11-17 06:09:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_mart`
--

CREATE TABLE `data_mart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berdasarkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_mart`
--

INSERT INTO `data_mart` (`id`, `judul`, `berdasarkan`, `data`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'hasil perhitungan berdasarkan jenis kelamin', 'Jenis Kelamin', '{\"laki_laki\":29,\"perempuan\":28}', 1, '2020-11-18 07:24:19', '2020-11-18 07:24:19'),
(2, 'hasil hitung data tahun 2020', 'Kota', '[{\"kota\":\"Denpasar\",\"jumlah\":17},{\"kota\":\"Badung\",\"jumlah\":8},{\"kota\":\"Singaraja\",\"jumlah\":7},{\"kota\":\"Tabanan\",\"jumlah\":6},{\"kota\":\"Gianyar\",\"jumlah\":4},{\"kota\":\"Bengkayang\",\"jumlah\":2},{\"kota\":\"Parigi Moutong\",\"jumlah\":2},{\"kota\":\"Manggarai\",\"jumlah\":1},{\"kota\":\"Palu\",\"jumlah\":1},{\"kota\":\"Belu, NTT\",\"jumlah\":1},{\"kota\":\"Tambolaka\",\"jumlah\":1},{\"kota\":\"Bima\",\"jumlah\":1},{\"kota\":\"Magelang\",\"jumlah\":1},{\"kota\":\"Jembrana\",\"jumlah\":1},{\"kota\":\"Poso\",\"jumlah\":1},{\"kota\":\"Ngada\",\"jumlah\":1},{\"kota\":\"Karangasem\",\"jumlah\":1},{\"kota\":\"Mamuju\",\"jumlah\":1}]', 1, '2020-11-18 07:29:32', '2020-11-18 07:29:32'),
(3, 'data sekolah tahun 2020', 'Asal Sekolah', '[{\"sekolah\":\"SMK WIRA HARAPAN\",\"jumlah\":5},{\"sekolah\":\"SMAN 2 BANJAR\",\"jumlah\":4},{\"sekolah\":\"SMA N 3 BENGKAYANG\",\"jumlah\":2},{\"sekolah\":\"SMA N 1 TORUE\",\"jumlah\":2},{\"sekolah\":\"SMK PGRI 3 DENPASAR\",\"jumlah\":2},{\"sekolah\":\"SMA N 2 BANJAR\",\"jumlah\":2},{\"sekolah\":\"SMK N 3 SUKAWATI\",\"jumlah\":2},{\"sekolah\":\"SMA DWIJENDRA DENPASAR\",\"jumlah\":2},{\"sekolah\":\"SMAK THOMAS AQUINO\",\"jumlah\":1},{\"sekolah\":\"SMA KATHOLIK ST.DONBOSKO\",\"jumlah\":1},{\"sekolah\":\"SMA N 1 PALU\",\"jumlah\":1},{\"sekolah\":\"SMA N 3  ATAMBUA\",\"jumlah\":1},{\"sekolah\":\"SMA N 8 DPS\",\"jumlah\":1},{\"sekolah\":\"SMA SWASTA MANDHA ELU\",\"jumlah\":1},{\"sekolah\":\"SMAN 2 MENGWI\",\"jumlah\":1},{\"sekolah\":\"SMA N 1 KOTA BIMA\",\"jumlah\":1},{\"sekolah\":\"SMA N 2 ELAR\",\"jumlah\":1},{\"sekolah\":\"SMK NUSA DUA\",\"jumlah\":1},{\"sekolah\":\"SMA PARAMARTA 1\",\"jumlah\":1},{\"sekolah\":\"SMA 5 MAGELANG\",\"jumlah\":1},{\"sekolah\":\"SMA ISLAM RAUDHATUL JANNAH\",\"jumlah\":1},{\"sekolah\":\"SMK PAR PUTRA BANGSA - UBUD\",\"jumlah\":1},{\"sekolah\":\"SMA SARASWATI SERIRIT\",\"jumlah\":1},{\"sekolah\":\"SMA 1 MELAYA\",\"jumlah\":1},{\"sekolah\":\"SMA N BALI MANDARA\",\"jumlah\":1},{\"sekolah\":\"SMK MARGARANA TABANAN\",\"jumlah\":1},{\"sekolah\":\"SMK N 5 DPS\",\"jumlah\":1},{\"sekolah\":\"SMA PGRI 4 DENPASAR\",\"jumlah\":1},{\"sekolah\":\"SMK PAR KERTAYASA UBUD\",\"jumlah\":1},{\"sekolah\":\"SMA N 1 PAMONA BARAT\",\"jumlah\":1},{\"sekolah\":\"SMA N 1 MARGA\",\"jumlah\":1},{\"sekolah\":\"SMK N JEREBUU\",\"jumlah\":1},{\"sekolah\":\"SMK PGRI 1 BADUNG\",\"jumlah\":1},{\"sekolah\":\"SMK N 5 DENPASAR\",\"jumlah\":1},{\"sekolah\":\"SMK BALI DEWATA\",\"jumlah\":1},{\"sekolah\":\"SMK N 1 KUBU\",\"jumlah\":1},{\"sekolah\":\"SMA N 1 BULU TABA\",\"jumlah\":1},{\"sekolah\":\"SMK PAR TRIATMA JAYA TBN\",\"jumlah\":1},{\"sekolah\":\"SMK PGRI I BADUNG\",\"jumlah\":1},{\"sekolah\":\"SMK WIRA HARAPAN \",\"jumlah\":1},{\"sekolah\":\"SMK TRIATMAJAYA TABANAN\",\"jumlah\":1},{\"sekolah\":\"SMK PGRI 5 DENPASAR\",\"jumlah\":1},{\"sekolah\":\"SMK N 4 DENPASAR\",\"jumlah\":1},{\"sekolah\":\"SMA SURYA WISATA\",\"jumlah\":1}]', 1, '2020-11-18 07:31:25', '2020-11-18 07:31:25'),
(4, 'data by perkejaan ortu', 'Pekerjaan Orang Tua', '[{\"pekerjaan\":\"WIRASWASTA\",\"jumlah\":19},{\"pekerjaan\":\"PETANI\",\"jumlah\":14},{\"pekerjaan\":\"PEGAWAI SWASTA\",\"jumlah\":12},{\"pekerjaan\":\"PNS\",\"jumlah\":7},{\"pekerjaan\":\"DOKTER\",\"jumlah\":3},{\"pekerjaan\":\"BURUH\",\"jumlah\":2}]', 1, '2020-11-18 07:33:58', '2020-11-18 07:33:58'),
(5, 'berdasarkan jarak', 'Jarak', '[{\"kabupaten\":\"Denpasar, 0-10 km\",\"jumlah\":18},{\"kabupaten\":\"Bengkayang, +450 km\",\"jumlah\":12},{\"kabupaten\":\"Denpasar, 10-50 km\",\"jumlah\":10},{\"kabupaten\":\"Singaraja, 50-100 km\",\"jumlah\":9}]', 1, '2020-11-18 07:36:42', '2020-11-18 07:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `detail_data_center`
--

CREATE TABLE `detail_data_center` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gps` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_data_center`
--

INSERT INTO `detail_data_center` (`id`, `data_id`, `nama`, `alamat`, `kota`, `gps`, `tanggal_lahir`, `jenis_kelamin`, `asal_sekolah`, `pekerjaan_orang_tua`, `created_at`, `updated_at`) VALUES
(990, '20', 'JHONATAN PERMADI', 'Jl. Guna Baru, Bengkayang, KalBar', 'Bengkayang', '0.867658, 109.499964', '1995-11-15', 'L', 'SMA N 3 BENGKAYANG', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(991, '20', 'NI LUH GRACE PATRICIA LEMPID', 'Jl. Tunjung Sari, Denpasar', 'Denpasar', '-8.637604, 115.182457', '1996-11-02', 'P', 'SMK WIRA HARAPAN', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(992, '20', 'NI PUTU TRISNA OCTAPIANI', 'Dalung Permai', 'Badung', '-8.630974, 115.172813', '1996-04-29', 'P', 'SMK WIRA HARAPAN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(993, '20', 'THEOFANI EIRINE MARLISSA', 'Jl. Tukad Pancoran III, Panjer, DenBar', 'Denpasar', '-8.687859, 115.228107', '1997-01-02', 'P', 'SMAK THOMAS AQUINO', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(994, '20', 'I GUSTI NGURAH SATYA NUGRAHA', 'Jl. Pandu, Banjar Dukuh, Dalung', 'Badung', '-8.619191, 115.166540', '1996-10-03', 'L', 'SMK WIRA HARAPAN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(995, '20', 'YOHANES BAPTISTA DDEO', 'Jl. Hayam Wuruk No.5, Manggarai, NTT', 'Manggarai', '-8.608774, 120.468149', '1996-07-22', 'L', 'SMA KATHOLIK ST.DONBOSKO', 'DOKTER', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(996, '20', 'JENIPER', 'Bani Amas, Bengkayang, Kalimantan Barat', 'Bengkayang', '0.850677, 109.499352', '1997-01-27', 'P', 'SMA N 3 BENGKAYANG', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(997, '20', 'NI MADE ELLA DWI PURWATI', 'Tolai Barat, Torue, Parigi Moutong, SulTeng', 'Parigi Moutong', '-0.991097, 120.327478', '1997-04-16', 'P', 'SMA N 1 TORUE', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(998, '20', 'JENNY MARCELINA B.', 'Jl. Dr. Samratulangi No. 46, Palu', 'Palu', '-0.885396, 119.871214', '1995-08-16', 'P', 'SMA N 1 PALU', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(999, '20', 'OKTOVIANUS LARAN', 'Jl. Marsda Adi Sucipto, NTT', 'Belu, NTT', '-9.041622, 124.927726', '1996-06-28', 'L', 'SMA N 3  ATAMBUA', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1000, '20', 'NI KADEK SABRINA PRATIWI', 'Denpasar', 'Denpasar', '-8.664853, 115.194123', '1997-02-09', 'P', 'SMA N 8 DPS', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1001, '20', 'EDEHRUDIS FELISITAS MALO', 'Jl. Sapurata, Wee Tobula, Kota Tambolaka', 'Tambolaka', '-9.431591, 119.234321', '1997-02-25', 'L', 'SMA SWASTA MANDHA ELU', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1002, '20', 'NI PUTU FEBRIYANTI', 'Banjar Alangkajeng, Mengwi, Badung', 'Badung', '-8.545946, 115.170030', '1997-02-09', 'P', 'SMAN 2 MENGWI', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1003, '20', 'ROSDIANA', 'JL Soekarno Hatta, Bima, NTB', 'Bima', '-8.459547, 118.738536', '1996-12-12', 'P', 'SMA N 1 KOTA BIMA', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1004, '20', 'RICHARDO DICKY  EMANUEL', 'Denpasar', 'Denpasar', '-8.786325, 115.202234', '1997-04-23', 'L', 'SMA N 2 ELAR', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1005, '20', 'I MADE AGUS JUNIARTA', 'Jl. Taman Ayodya, Nusa Dua', 'Badung', '-8.786223, 115.205592', '1997-09-15', 'L', 'SMK NUSA DUA', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1006, '20', 'GUSTI KOMANG BUDI KUSUMA', 'Dalung Permai', 'Badung', '-8.631217, 115.169464', '1997-01-01', 'L', 'SMA PARAMARTA 1', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1007, '20', 'REGINA SHENDI HUTAHAEAN', 'Jl. Dewaruci, Magersari, Kec. Magelang', 'Magelang', '-7.492271, 110.221225', '1996-12-29', 'P', 'SMA 5 MAGELANG', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1008, '20', 'NI PUTU JULIANTARI', 'Jalan Ratna, Denpasar', 'Denpasar', '-8.639377, 115.228432', '1996-10-28', 'P', 'SMK PGRI 3 DENPASAR', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1009, '20', 'M SUBHAN', 'Jl. Nusa Indah, Denpasar', 'Denpasar', '-8.649575, 115.233934', '1998-03-26', 'L', 'SMA ISLAM RAUDHATUL JANNAH', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1010, '20', 'NI KADEK ARISMAWATI', 'Jl. Penestanan Kelod No.108, Sayan, Gianyar', 'Gianyar', '-8.509040, 115.247812', '1996-11-03', 'P', 'SMK PAR PUTRA BANGSA - UBUD', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1011, '20', 'IDA AYU PUTU RISNA JAYANTI', 'Singaraja', 'Singaraja', '-8.118477, 115.086329', '1997-05-14', 'P', 'SMA N 2 BANJAR', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1012, '20', 'NI PUTU ERNA VITASARI', 'Jl. Panji Anom, Panji Anom, Kec. Sukasada', 'Singaraja', '-8.154580, 115.083890', '1997-03-14', 'P', 'SMA N 2 BANJAR', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1013, '20', 'KD.RISCY INDRA YUDA PRAYOGI', 'Seririt', 'Singaraja', '-8.236888, 114.929420', '1997-11-09', 'L', 'SMA SARASWATI SERIRIT', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1014, '20', 'I GEDE RISMA SURANATA', 'Banjar Tengah, Kec. Negara, Kabupaten Jembrana', 'Jembrana', '-8.359117, 114.615242', '1996-04-28', 'L', 'SMA 1 MELAYA', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1015, '20', 'GEDE SETIA WIDIANTARA', 'Jl. Cendrawasih 5 Banyuasri Buleleng', 'Singaraja', '-8.109703, 115.085856', '1997-02-15', 'L', 'SMAN 2 BANJAR', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1016, '20', 'NI PUTU AYU MASDARINI', 'Jl. Tukad Batanghari, Denpasar', 'Denpasar', '-8.683748, 115.227330', '1996-09-12', 'P', 'SMA N BALI MANDARA', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1017, '20', 'I MADE PERMADA DUWI PUTRA', 'Desa Tua, Marga, Tabanan', 'Tabanan', '-8.397040, 115.181802', '1996-08-17', 'L', 'SMK MARGARANA TABANAN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1018, '20', 'I MADE YOGI MAHENDRA', 'Sidakarya, Denpasar', 'Denpasar', '-8.705028, 115.234565', '1997-04-26', 'L', 'SMK WIRA HARAPAN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1019, '20', 'AGNES NILUH VIKA', 'Jl. Yudistira 7 Astina Buleleng', 'Singaraja', '-8.120319, 115.093715', '1996-05-05', 'P', 'SMAN 2 BANJAR', 'DOKTER', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1020, '20', 'KADEK DESI AYU LESTARI', 'Jl. Ngurah Rai 68, Singaraja', 'Singaraja', '-8.114083, 115.091425', '1996-05-09', 'P', 'SMAN 2 BANJAR', 'DOKTER', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1021, '20', 'GEDE WIDANA', 'Jl. Jendral A Yani Singaraja', 'Singaraja', '-8.110416, 115.088340', '1996-05-28', 'L', 'SMAN 2 BANJAR', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1022, '20', 'NI KETUT AYU LESTARI', 'Denpasar', 'Denpasar', '-8.673828, 115.232005', '1996-08-13', 'P', 'SMK N 5 DPS', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1023, '20', 'A.A. ANJAS CAHYA DINATA', 'Jl. Tukad Pakerisan, Denpasar', 'Denpasar', '-8.682090, 115.225913', '1996-06-28', 'L', 'SMK WIRA HARAPAN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1024, '20', 'I KADEK ADI SUPADMA', 'Jl. Kebo Iwa, Denpasar', 'Denpasar', '-8.630003, 115.182500', '1997-07-05', 'L', 'SMA PGRI 4 DENPASAR', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1025, '20', 'NI LUH SUMARNI ASIH', 'Jl. Hanoman No.46, Ubud', 'Gianyar', '-8.514265, 115.263968', '1996-08-29', 'P', 'SMK PAR KERTAYASA UBUD', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1026, '20', 'KOMANG AYU MEI TRIYANI', 'Jl. Tukad Badung, Denpasar', 'Denpasar', '-8.684386, 115.237831', '1997-02-02', 'P', 'SMK PGRI 3 DENPASAR', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1027, '20', 'KOMANG EKA NINGSIH', 'Kelurahan Pamona, Poso', 'Poso', '-1.753379, 120.627002', '1997-02-15', 'P', 'SMA N 1 PAMONA BARAT', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1028, '20', 'SANDY PRIMA NANDA', 'Jl. Ciung Wanara, Sukawati, Kec. Sukawati', 'Gianyar', '-8.595850, 115.286313', '1997-02-20', 'L', 'SMK N 3 SUKAWATI', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1029, '20', 'I KADEK MEGGI ANDREAWAN', 'Batuan, Sukawati, Gianyar', 'Gianyar', '-8.585105, 115.269384', '1995-09-09', 'L', 'SMK N 3 SUKAWATI', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1030, '20', 'NI MADE INDAH PRATIWI', 'Jl. Mawar Gerokgak Gede, Tabanan', 'Tabanan', '-8.545253, 115.124813', '1997-09-24', 'P', 'SMA N 1 MARGA', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1031, '20', 'PETRUS CORNELTUS RIWU WEDE', 'Tude, Tiworiwu 1, Tiworiwu, Jerebuu, Kabupaten Ngada, NTT', 'Ngada', '-8.877927, 120.997028', '1996-10-07', 'L', 'SMK N JEREBUU', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1032, '20', 'I PT AGUS ANGGA YUDA PRATAMA', 'Abiansemal, Badung', 'Badung', '-8.522822, 115.205019', '1997-05-19', 'L', 'SMK PGRI 1 BADUNG', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1033, '20', 'I GEDE PT ADNYANA', 'Jl. Nusa Indah, Denpasar', 'Denpasar', '-8.654364, 115.235043', '1997-04-13', 'L', 'SMK N 5 DENPASAR', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1034, '20', 'NI MKOMANG DEVI RIZKY DEWANTI', 'Jl. Nangka Selatan, Gang Perkutut, Denpasar', 'Denpasar', '-8.646142, 115.219020', '1996-08-20', 'P', 'SMA DWIJENDRA DENPASAR', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1035, '20', 'NI PUTU SETIAWATI', 'Jl. Dewi Madri, Denpasar', 'Denpasar', '-8.665097, 115.235683', '1997-01-18', 'P', 'SMA DWIJENDRA DENPASAR', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1036, '20', 'PUTU MASTHIN PRADITYA ANANDA', 'Br. Abiantuwung Kelod, Kediri, Tabanan', 'Tabanan', '-8.559157, 115.151360', '1996-12-13', 'L', 'SMK BALI DEWATA', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1037, '20', 'NI LUH DIAN LESTARI', 'Jl. Gn. Sari, Tolai, Torue, Parigi Moutong, Sulawesi Tengah', 'Parigi Moutong', '-0.991299, 120.329495', '1996-11-20', 'P', 'SMA N 1 TORUE', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1038, '20', 'I GEDE BUDIANA YASA ', 'Ban, Kubu, Karangasem', 'Karangasem', '-8.233521, 115.497115', '1997-03-29', 'L', 'SMK N 1 KUBU', 'BURUH', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1039, '20', 'I NYOMAN SAKA SUJANA', 'Jl. Pendidikan Lilimori, Bulutaba, Mamuju Utara, Lilimori, Mamuju, Sulawesi Barat', 'Mamuju', '', '1997-01-07', 'L', 'SMA N 1 BULU TABA', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1040, '20', 'GST NGRH MD KRISNA ARI P', 'Jl. Werkudara No. 5, Tabanan', 'Tabanan', '', '1997-05-07', 'L', 'SMK PAR TRIATMA JAYA TBN', 'WIRASWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1041, '20', 'I KADEK PURNADI', 'Perum Dalung Permai, Blok YY, Badung', 'Badung', '', '1997-04-09', 'L', 'SMK PGRI I BADUNG', 'BURUH', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1042, '20', 'NI NYM AYU WIYANI', 'Perum Dalung Permai, Blok ZZ, Kuta Utara', 'Badung', '', '1998-02-18', 'P', 'SMK WIRA HARAPAN ', 'PEGAWAI SWASTA', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1043, '20', 'I KADEK ARI SANTIKA', 'Bantas Bale Agung, Desa Bantas, Selemadeg Timur', 'Tabanan', '', '1996-06-18', 'L', 'SMK TRIATMAJAYA TABANAN', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1044, '20', 'KOMANG YUNITA SARI', 'Jl. Tukad Pancoran, Gang 2A, No. 7 Denpasar', 'Denpasar', '', '1996-06-10', 'P', 'SMK PGRI 5 DENPASAR', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1045, '20', 'PUTU DIVA NANDA PRATAMA', 'Jalan Drupadi, Denpasar', 'Denpasar', '', '1997-02-03', 'P', 'SMK N 4 DENPASAR', 'PETANI', '2020-11-17 06:09:21', '2020-11-17 06:09:21'),
(1046, '20', 'I NYOMAN MUDANA PUTRA', 'Banjar Anyar, Kediri, Tabanan', 'Tabanan', '', '1995-01-05', 'L', 'SMA SURYA WISATA', 'PNS', '2020-11-17 06:09:21', '2020-11-17 06:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_10_30_133118_create_data_center_table', 2),
(5, '2020_10_31_122238_create_detail_data_center', 2),
(6, '2020_11_02_115755_create_user_details_table', 3),
(7, '2020_11_18_150731_create_data_mart_table', 4);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','rektor','marketing') COLLATE utf8mb4_unicode_ci DEFAULT 'marketing',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'user@gmail.com', '2020-11-02 15:59:02', '$2y$10$nzakgyvGd4W89HSFpbIU.u0pTIHmMnprXNuYNReykLgEZUI5BCoKe', 'admin', NULL, '2020-11-02 04:19:47', '2020-11-08 07:41:28', NULL),
(4, 'wendy@gmail.com', '2020-11-02 15:59:06', '$2y$10$jDDaQBCzC4JjFKf/b9W/3.nree.9gTaSJjf.MrOWskBTIyP.sNcxm', 'rektor', NULL, '2020-11-02 04:19:47', '2020-11-02 08:02:17', NULL),
(5, 'agus@gmail.com', NULL, '$2y$10$LFUB8MT5cq9zOW3lwNg2OeUkEQ/cujB8tZdyv/5UnhpAOGyYHKFra', 'marketing', NULL, '2020-11-15 06:43:20', '2020-11-15 06:43:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'laki-laki',
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `telepon`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Bagus Banget', 'Denpasar', '1994-12-10', 'laki-laki', 'Jl. Lorem Ipsum Dolor, No. 22, Denpasar', '08199900000', '1606061312.jpeg', '2020-11-02 12:09:20', '2020-11-22 08:08:32', NULL),
(2, 4, 'Wendy Hardianis', 'Amlapura', '1991-12-10', 'laki-laki', 'Jl. Lipsum Sit Amet 3, Denpasar', '0812220001', NULL, '2020-11-02 04:19:47', '2020-11-02 08:04:36', NULL),
(3, 5, 'Agus Irmawan', NULL, NULL, 'laki-laki', 'Jl. Lipsum Dolor Sit Amet, 30', '081000233', NULL, '2020-11-15 06:43:20', '2020-11-15 06:43:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_center`
--
ALTER TABLE `data_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_mart`
--
ALTER TABLE `data_mart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_data_center`
--
ALTER TABLE `detail_data_center`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_center`
--
ALTER TABLE `data_center`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `data_mart`
--
ALTER TABLE `data_mart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_data_center`
--
ALTER TABLE `detail_data_center`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1047;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
