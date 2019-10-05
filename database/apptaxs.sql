-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 10.2.3-MariaDB-log - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Membuang data untuk tabel apptaxs.companies: ~16 rows (lebih kurang)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT IGNORE INTO `companies` (`id`, `name`, `address`, `npwp`, `created_at`, `updated_at`, `pic`, `nopic`, `company_categories_id`) VALUES
	(7, 'WARKOP UMY', 'JLN. BAHAGIA, PUNGE BLANG CUT', '3.00036276.08.09', '2019-08-04 09:54:19', '2019-08-04 09:54:19', NULL, NULL, 2),
	(8, 'TEST', 'ABU LAM U', '3.00036276.77.11', '2019-08-04 09:58:40', '2019-08-04 09:58:40', NULL, NULL, 1),
	(9, 'AYAM PRESTO CABE HIJO', 'JL. KARTIKA ASRAMA PHB', '3.00027221.01.02', '2019-08-05 02:31:38', '2019-08-05 02:31:38', NULL, NULL, 2),
	(10, 'AWAI NA KUPI', 'JL. MR. MOHD. HASAN', '3.00036316.06.07', '2019-08-05 02:32:27', '2019-08-05 02:32:27', NULL, NULL, 2),
	(11, 'WARUNG BARDI', 'JL. RESIDEN DANU BROTO', '3.000.33990.07.012', '2019-08-05 02:33:10', '2019-08-05 02:33:10', NULL, NULL, 2),
	(12, 'NASI UDUK ISTANA RAME', 'JL. P. NYAK MAKAM', '3.00034395.09.03', '2019-08-05 02:35:40', '2019-08-05 02:35:40', NULL, NULL, 2),
	(13, 'TANDA MATA', 'JL. RA. KARTINI', '3.00000329.01.01', '2019-08-05 02:38:03', '2019-08-05 02:38:03', NULL, NULL, 2),
	(14, 'KK. SYARIFUDDIN', 'JL. AYAH GANI', '3.00031468.01.02', '2019-08-05 02:38:45', '2019-08-05 02:38:45', NULL, NULL, 2),
	(15, 'AYAM PENYET PAK ULIS', 'JL. T. NYAK ARIEF', '3.00026127.04.01', '2019-08-05 02:39:22', '2019-08-05 02:39:22', NULL, NULL, 2),
	(16, 'LOSMEN ACEH BARAT', 'JL. CHAIRIL ANWAR', '3.00000678.01.01', '2019-08-05 02:56:33', '2019-08-05 02:56:33', NULL, NULL, 1),
	(17, 'GRAND NANGGROE', 'JL. TGK. IMUM LUENG BATA', '3.00018884.06.002', '2019-08-05 02:57:22', '2019-08-05 02:57:22', NULL, NULL, 1),
	(18, 'WISMA NABILA', 'JL. STA. MAHMUDSYAH', '3.00030.24.02.001', '2019-08-05 02:58:29', '2019-08-05 02:58:29', NULL, NULL, 1),
	(19, 'GRAND LAMBHUK HOTEL', 'JL. T. ISKANDAR, NO. 58', '3.00033472.09.03', '2019-08-05 02:59:54', '2019-08-05 02:59:54', NULL, NULL, 1),
	(20, 'PENGINAPAN MULIA', 'JL. T. NYAK ARIEF KOPELMA', '3.00036229.04.08', '2019-08-05 03:00:41', '2019-08-05 03:00:41', NULL, NULL, 1),
	(21, 'HOTEL THAYYIBA', 'JL. T. TANJUNG III IE MASEN', '2.00036226.04.07', '2019-08-05 03:01:52', '2019-08-05 03:01:52', NULL, NULL, 1),
	(22, 'HOTEL SEI', 'JL. TANOH ABEE NO. 71  Mulia - Kuta Alam', '3.00027863.01.04', '2019-08-05 03:06:29', '2019-08-05 03:06:29', NULL, NULL, 1);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.company_categories: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `company_categories` DISABLE KEYS */;
INSERT IGNORE INTO `company_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Hotel', '2019-07-21 22:06:21', '2019-07-21 22:06:24'),
	(2, 'Restoran', NULL, NULL),
	(3, 'Parkir', NULL, NULL),
	(4, 'Hiburan', NULL, NULL),
	(5, 'Reklame', NULL, NULL);
/*!40000 ALTER TABLE `company_categories` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.histories: ~11 rows (lebih kurang)
/*!40000 ALTER TABLE `histories` DISABLE KEYS */;
INSERT IGNORE INTO `histories` (`id`, `letter_date`, `created_at`, `updated_at`, `periode`, `penalty`, `status_id`, `is_last`, `letter_id`, `duration`, `is_readed`, `pinalty_persen`) VALUES
	(23, '2019-08-01 00:00:00', '2019-08-04 10:00:26', '2019-08-04 10:00:26', '2019-08-05 00:00:00', 20000, 2, 1, 27, 4, 0, 2),
	(24, '2019-07-24 00:00:00', '2019-08-05 02:46:59', '2019-08-05 02:46:59', '2019-08-05 00:00:00', 16000, 2, 1, 28, 12, 0, 4),
	(25, '2019-07-24 00:00:00', '2019-08-05 02:48:24', '2019-08-05 02:48:24', '2019-08-05 00:00:00', 5000, 2, 1, 29, 12, 0, 2),
	(26, '2019-07-24 00:00:00', '2019-08-05 02:49:20', '2019-08-05 02:49:20', '2019-08-05 00:00:00', 20000, 2, 1, 30, 12, 0, 4),
	(27, '2019-07-24 00:00:00', '2019-08-05 02:50:29', '2019-08-05 02:50:29', '2019-08-05 00:00:00', 10000, 2, 1, 31, 12, 0, 2),
	(28, '2019-07-24 00:00:00', '2019-08-05 02:51:37', '2019-08-05 02:51:37', '2019-08-05 00:00:00', 8000, 2, 1, 32, 12, 0, 4),
	(29, '2019-07-24 00:00:00', '2019-08-05 02:52:14', '2019-08-05 02:52:14', '2019-08-05 00:00:00', 20000, 2, 1, 33, 12, 0, 2),
	(30, '2019-07-24 00:00:00', '2019-08-05 02:52:52', '2019-08-05 02:52:52', '2019-08-05 00:00:00', 40000, 2, 1, 34, 12, 0, 4),
	(31, '2019-07-24 00:00:00', '2019-08-05 02:53:28', '2019-08-05 02:53:28', '2019-08-05 00:00:00', 6000, 2, 1, 35, 12, 0, 2),
	(32, '2019-07-29 00:00:00', '2019-08-05 03:09:05', '2019-08-05 03:09:05', '2019-08-07 00:00:00', 81236.4, 2, 1, 36, 9, 0, 4),
	(33, '2019-07-29 00:00:00', '2019-08-05 03:10:49', '2019-08-05 03:10:49', '2019-08-07 00:00:00', 18208, 2, 1, 37, 9, 0, 2);
/*!40000 ALTER TABLE `histories` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.letters: ~11 rows (lebih kurang)
/*!40000 ALTER TABLE `letters` DISABLE KEYS */;
INSERT IGNORE INTO `letters` (`id`, `company_id`, `created_at`, `updated_at`, `desc`, `month`, `year`, `pokok`, `is_paid_off`) VALUES
	(27, 8, '2019-08-04 10:00:26', '2019-08-04 10:00:26', 'TEST AJA', 5, '2019', 1000000, 'N'),
	(28, 9, '2019-08-05 02:46:59', '2019-08-05 02:46:59', NULL, 4, '2019', 400000, 'N'),
	(29, 10, '2019-08-05 02:48:24', '2019-08-05 02:48:24', NULL, 5, '2019', 250000, 'N'),
	(30, 11, '2019-08-05 02:49:20', '2019-08-05 02:49:20', NULL, 4, '2019', 500000, 'N'),
	(31, 11, '2019-08-05 02:50:29', '2019-08-05 02:50:29', NULL, 5, '2019', 500000, 'N'),
	(32, 12, '2019-08-05 02:51:37', '2019-08-05 02:51:37', NULL, 4, '2019', 200000, 'N'),
	(33, 13, '2019-08-05 02:52:14', '2019-08-05 02:52:14', NULL, 5, '2019', 1000000, 'N'),
	(34, 14, '2019-08-05 02:52:52', '2019-08-05 02:52:52', NULL, 4, '2019', 1000000, 'N'),
	(35, 15, '2019-08-05 02:53:28', '2019-08-05 02:53:28', NULL, 5, '2019', 300000, 'N'),
	(36, 22, '2019-08-05 03:09:05', '2019-08-05 03:09:05', NULL, 4, '2019', 2030910, 'N'),
	(37, 22, '2019-08-05 03:10:49', '2019-08-05 03:10:49', NULL, 5, '2019', 910400, 'N');
/*!40000 ALTER TABLE `letters` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.migrations: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.password_resets: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.settings: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.statuses: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT IGNORE INTO `statuses` (`id`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'Lunas', '2019-08-04 09:43:00', '2019-08-04 09:43:00'),
	(2, 'STPD', '2019-08-04 09:43:13', '2019-08-04 09:43:13'),
	(3, 'Surat Teguran I', '2019-08-04 09:43:33', '2019-08-04 09:43:33'),
	(4, 'Surat Teguran II', '2019-08-04 09:43:51', '2019-08-04 09:43:51');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;

-- Membuang data untuk tabel apptaxs.users: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'salman farisi', 'salmandriva@gmail.com', NULL, '$2y$12$YF9PQFigf4CBfIRCZm7rweWzIs2lkFsJRWEvopwI4u4bJ.rpj6CVS', NULL, '2019-07-05 11:31:11', '2019-07-05 11:31:11');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
