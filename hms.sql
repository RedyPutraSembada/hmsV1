-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2024 pada 16.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `accupations`
--

CREATE TABLE `accupations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `accupations`
--

INSERT INTO `accupations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Programmer', '2024-06-14 23:13:31', '2024-06-14 23:13:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `additional_items`
--

CREATE TABLE `additional_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'transaction'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `additional_items`
--

INSERT INTO `additional_items` (`id`, `name`, `price`, `qty`, `created_at`, `updated_at`, `alias`, `description`, `type`) VALUES
(1, 'Kasur Tidur', 20000, 20, '2024-06-15 04:38:08', '2024-06-15 04:38:08', 'KS', 'Kasur nyaman', 'Transaction'),
(2, 'Kursi', 10000, 30, '2024-06-15 04:38:34', '2024-06-15 04:38:34', 'KR', 'Kursi Nyaman', 'Transaction');

-- --------------------------------------------------------

--
-- Struktur dari tabel `breakfasts`
--

CREATE TABLE `breakfasts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `breakfasts`
--

INSERT INTO `breakfasts` (`id`, `name`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 'Not include breakfast', 0, '2024-06-14 23:13:32', '2024-06-14 23:13:32'),
(2, 'Tipe 1', 20000, '2024-06-15 04:38:55', '2024-06-15 04:38:55'),
(3, 'Tipe 2', 25000, '2024-06-15 04:39:05', '2024-06-15 04:39:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_room_amanities`
--

CREATE TABLE `detil_room_amanities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_room` bigint(20) UNSIGNED NOT NULL,
  `id_additional_item` bigint(20) UNSIGNED NOT NULL,
  `qty_item` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_transaction_room_items`
--

CREATE TABLE `detil_transaction_room_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaction_room` bigint(20) UNSIGNED NOT NULL,
  `id_additional_item` bigint(20) UNSIGNED NOT NULL,
  `qty_item` int(11) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `floors`
--

CREATE TABLE `floors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `floors`
--

INSERT INTO `floors` (`id`, `name`, `alias`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Lantai 1', 'LT1', 'Lantai 2', '2024-06-14 23:13:31', '2024-06-14 23:13:31'),
(2, 'Lantai 2', 'LT2', 'Lantai 2', '2024-06-14 23:13:31', '2024-06-14 23:13:31'),
(3, 'Lantai 3', 'LT3', 'Lantai 3', '2024-06-14 23:13:31', '2024-06-14 23:13:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `identity_card_type` varchar(255) NOT NULL,
  `identity_card_number` varchar(255) NOT NULL,
  `exp_identity_card` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `city_birth` varchar(255) NOT NULL,
  `state_birth` varchar(255) NOT NULL,
  `country_birth` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `guest_type` varchar(255) NOT NULL,
  `id_occupation` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `guests`
--

INSERT INTO `guests` (`id`, `full_name`, `email`, `phone`, `identity_card_type`, `identity_card_number`, `exp_identity_card`, `nationality`, `state`, `address`, `city`, `postal`, `country`, `birth_date`, `city_birth`, `state_birth`, `country_birth`, `gender`, `guest_type`, `id_occupation`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Putra', 'redyputra120503@gmail.com', '085775574421', 'KTP', '923823823928', NULL, 'Indonesia', 'Balıkesir', 'Karesibalikesir', 'Karesi', '10100', 'Türkiye', '2003-05-12', 'Karesi', 'Balıkesir', 'Türkiye', 'Man', 'Repeat', 1, NULL, '2024-06-17 06:45:57', '2024-06-30 06:40:21'),
(2, 'Putra', 'redy@gmail.com', '0857755765767', '0', '0', NULL, '-', '-', 'Karesibalikesir', '-', '-', '-', '1900-01-01', '-', '-', '-', 'Man', 'VIP', 1, '-', '2024-06-17 22:13:26', '2024-06-17 22:13:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `iventories`
--

CREATE TABLE `iventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_24_130522_create_status_rooms_table', 1),
(6, '2023_12_24_161109_create_room_types_table', 1),
(7, '2023_12_24_164650_create_price_rate_types_table', 1),
(8, '2023_12_24_182107_create_travel_agents_table', 1),
(9, '2023_12_24_185441_create_source_travel_agents_table', 1),
(10, '2023_12_24_191822_create_additional_items_table', 1),
(11, '2023_12_25_061431_create_rooms_table', 1),
(12, '2023_12_25_071430_add_field_capacity_to_rooms', 1),
(13, '2023_12_25_080446_create_accupations_table', 1),
(14, '2023_12_25_081552_create_guests_table', 1),
(15, '2023_12_25_104302_create_transaction_rooms_table', 1),
(16, '2023_12_25_111153_create_detil_transaction_room_items_table', 1),
(17, '2023_12_25_112309_create_transaction_sewa_rooms_table', 1),
(18, '2023_12_30_103837_add_field_extra_to_price_rate_types', 1),
(19, '2023_12_30_104031_add_field_base_to_room_types', 1),
(20, '2023_12_30_105733_create_floors_table', 1),
(21, '2023_12_30_124902_add_fieldidfloor_to_rooms', 1),
(22, '2023_12_30_125452_remove_floor_to_rooms', 1),
(23, '2023_12_30_130739_remove_capacity_to_rooms', 1),
(24, '2023_12_30_175349_add_field_to_additional_items', 1),
(25, '2023_12_30_181649_create_table_detil_room_amanities', 1),
(26, '2024_01_06_143839_add_field_total_day_to_detil_transaction_room_items', 1),
(27, '2024_01_27_185334_create_total_payments_table', 1),
(28, '2024_01_27_202110_modify_status_nullable_transaction_rooms', 1),
(29, '2024_02_03_135606_add_field_to_total_payments', 1),
(30, '2024_03_11_065016_create_breakfasts_table', 1),
(31, '2024_03_11_073322_add_foreign_key_to_room_types_table', 1),
(32, '2024_03_12_072434_create_roles_table', 1),
(33, '2024_03_12_073350_add_field_to_users', 1),
(34, '2024_03_12_090016_add_field_to_roles', 1),
(35, '2024_03_12_125200_create_stay_views_table', 1),
(36, '2024_03_17_044012_create_products_table', 1),
(37, '2024_03_17_065735_create_product_buyings_table', 1),
(38, '2024_03_17_065814_add_field_image_to_products', 1),
(39, '2024_03_21_135913_create_product_categories_table', 1),
(40, '2024_03_21_140038_add_field_to_products', 1),
(41, '2024_03_24_094145_create_transaction_pos_table', 1),
(42, '2024_03_30_065048_modify_to_total_payments', 1),
(43, '2024_05_24_151416_create_status_rate_types_table', 1),
(44, '2024_05_24_155543_add_field_to_price_rate_types', 1),
(45, '2024_05_28_114204_modify_guests_table', 1),
(46, '2024_05_30_182801_create_iventories_table', 1),
(47, '2024_06_28_134910_add_transaction_pos_to_product_buyings', 1),
(48, '2024_06_28_140423_add_field_to_transaction_rooms', 1),
(49, '2024_06_16_041124_drop_field_to_transaction_rooms', 2),
(50, '2024_06_16_171132_add_field_to_total_payments', 3),
(52, '2024_06_30_102605_add_field_registry_to_transaction_rooms', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_rate_types`
--

CREATE TABLE `price_rate_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_room_type` bigint(20) UNSIGNED NOT NULL,
  `type_day` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extra_adult` bigint(20) NOT NULL,
  `extra_child` bigint(20) NOT NULL,
  `id_status_rate_type` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `price_rate_types`
--

INSERT INTO `price_rate_types` (`id`, `id_room_type`, `type_day`, `price`, `created_at`, `updated_at`, `extra_adult`, `extra_child`, `id_status_rate_type`) VALUES
(1, 1, 'Daily', 200, '2024-06-15 04:40:57', '2024-06-15 04:40:57', 10000, 5000, 1),
(2, 2, 'Weekend', 300000, '2024-06-15 04:41:23', '2024-06-15 04:41:23', 20000, 15000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` text DEFAULT NULL,
  `id_product_category` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `type`, `name`, `price`, `qty`, `created_at`, `updated_at`, `image`, `id_product_category`) VALUES
(2, 'non-product', 'Nasi Goreng', 10000, 0, '2024-07-01 08:34:13', '2024-07-01 08:34:13', 'images/product/NxlM3pxifxeO4VOOq22BYTSfhm2gqOexU3dpJ7wQ.jpg', 1),
(3, 'product', 'Jus Mangga', 5000, 23, '2024-07-01 08:34:41', '2024-07-01 08:34:41', 'images/product/ARHopZHa7VTYRj33Kj8nxiZKHlni9FPIfBKcYZ7Y.jpg', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_buyings`
--

CREATE TABLE `product_buyings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` bigint(20) NOT NULL,
  `total_price` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_transaction_pos` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_buyings`
--

INSERT INTO `product_buyings` (`id`, `id_product`, `qty`, `total_price`, `created_at`, `updated_at`, `id_transaction_pos`) VALUES
(1, 2, 2, 20000, '2024-07-04 07:01:56', '2024-07-04 07:01:56', 1),
(2, 3, 3, 15000, '2024-07-04 07:01:56', '2024-07-04 07:01:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2024-07-01 08:31:32', '2024-07-01 08:31:32'),
(2, 'Minuman', '2024-07-01 08:31:39', '2024-07-01 08:31:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `premission` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_id`, `name`, `created_at`, `updated_at`, `premission`) VALUES
(1, NULL, 'Super Admin', '2024-06-14 23:13:31', '2024-06-14 23:13:31', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\"]'),
(2, NULL, 'Guest', '2024-06-14 23:13:31', '2024-06-14 23:13:31', NULL),
(3, NULL, 'OB', '2024-06-14 23:13:31', '2024-06-14 23:13:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_room_type` bigint(20) UNSIGNED NOT NULL,
  `id_status_room` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `kode_room` varchar(255) NOT NULL,
  `status_sewa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_floor` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `id_room_type`, `id_status_room`, `name`, `kode_room`, `status_sewa`, `created_at`, `updated_at`, `id_floor`) VALUES
(1, 1, 4, 'A1', 'A001', 1, '2024-06-15 04:42:48', '2024-06-29 09:04:56', 1),
(2, 2, 2, 'B1', 'B001', 1, '2024-06-15 04:43:30', '2024-06-15 04:43:30', 2),
(3, 1, 4, 'Room A 2', 'A002', 1, '2024-06-29 02:48:39', '2024-06-29 09:04:56', 1),
(4, 1, 4, 'A3', 'A003', 1, '2024-06-29 02:54:22', '2024-06-29 09:04:56', 1),
(5, 1, 2, 'A4', 'A004', 1, '2024-06-29 02:54:47', '2024-06-29 02:54:47', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `base_adult` bigint(20) NOT NULL,
  `base_child` bigint(20) NOT NULL,
  `breakfast_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `created_at`, `updated_at`, `base_adult`, `base_child`, `breakfast_id`) VALUES
(1, 'Reguler', '2024-06-14 23:13:31', '2024-06-15 04:39:31', 2, 2, 2),
(2, 'VIP', '2024-06-14 23:13:31', '2024-06-15 04:39:36', 1, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `source_travel_agents`
--

CREATE TABLE `source_travel_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_travel_agent` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `comission` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_rate_types`
--

CREATE TABLE `status_rate_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_rate_types`
--

INSERT INTO `status_rate_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'DU', '2024-06-15 04:40:12', '2024-06-15 04:40:12'),
(2, 'VD', '2024-06-15 04:40:22', '2024-06-15 04:40:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_rooms`
--

CREATE TABLE `status_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `main_status` int(11) DEFAULT NULL,
  `operation` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `status_rooms`
--

INSERT INTO `status_rooms` (`id`, `name`, `image`, `main_status`, `operation`, `created_at`, `updated_at`) VALUES
(1, 'Terisi', NULL, 1, 1, '2024-06-14 23:13:31', '2024-06-14 23:13:31'),
(2, 'Ready', NULL, 2, 1, '2024-06-14 23:13:31', '2024-06-14 23:13:31'),
(3, 'Sedang di bersihkan', NULL, 3, 1, '2024-06-14 23:13:31', '2024-06-14 23:13:31'),
(4, 'Booking', NULL, 4, 1, '2024-06-14 23:13:31', '2024-06-29 03:33:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stay_views`
--

CREATE TABLE `stay_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `total_payments`
--

CREATE TABLE `total_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaction` bigint(20) UNSIGNED NOT NULL,
  `payment_paid` decimal(15,2) DEFAULT NULL,
  `total_payment_transaction` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notes_from_fo` longtext DEFAULT NULL,
  `compensation` decimal(15,2) DEFAULT 0.00,
  `deposit` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `total_payments`
--

INSERT INTO `total_payments` (`id`, `id_transaction`, `payment_paid`, `total_payment_transaction`, `created_at`, `updated_at`, `notes_from_fo`, `compensation`, `deposit`) VALUES
(2, 2, 60600.00, 60600.00, '2024-06-29 09:04:56', '2024-06-30 06:40:21', NULL, 0.00, 500000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_pos`
--

CREATE TABLE `transaction_pos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaction` bigint(20) UNSIGNED NOT NULL,
  `id_guest` bigint(20) UNSIGNED NOT NULL,
  `type_transaction` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `sub_total` decimal(15,2) DEFAULT NULL,
  `total_transaction` decimal(15,2) DEFAULT NULL,
  `paid_transaction` decimal(15,2) DEFAULT NULL,
  `status_transaction` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_pos`
--

INSERT INTO `transaction_pos` (`id`, `id_transaction`, `id_guest`, `type_transaction`, `card_number`, `date`, `discount`, `sub_total`, `total_transaction`, `paid_transaction`, `status_transaction`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'cash', '-', '2024-07-04', 500000.00, 35000.00, 0.00, 0.00, 1, '2024-07-04 07:01:56', '2024-07-04 07:01:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_rooms`
--

CREATE TABLE `transaction_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_guest` bigint(20) UNSIGNED NOT NULL,
  `type_transaction` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `exp_card` date DEFAULT NULL,
  `folio_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `arrival` date DEFAULT NULL,
  `departure` date DEFAULT NULL,
  `id_room` varchar(255) DEFAULT NULL,
  `id_price_rate_type` bigint(20) UNSIGNED NOT NULL,
  `id_source_travel_agent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status_transaction` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_breakfast` tinyint(1) DEFAULT NULL,
  `price_breakfast` bigint(20) DEFAULT NULL,
  `market_code` varchar(255) DEFAULT NULL,
  `no_of_room` int(11) DEFAULT NULL,
  `no_of_person` int(11) DEFAULT NULL,
  `arrival_flight_no` varchar(255) DEFAULT NULL,
  `departure_flight_no` varchar(255) DEFAULT NULL,
  `eta` varchar(255) DEFAULT NULL,
  `etd` varchar(255) DEFAULT NULL,
  `booked_by` varchar(255) DEFAULT NULL,
  `tlp_by` varchar(255) DEFAULT NULL,
  `fax_by` varchar(255) DEFAULT NULL,
  `taken_by` varchar(255) DEFAULT NULL,
  `taken_time` varchar(255) DEFAULT NULL,
  `confirmation_by` varchar(255) DEFAULT NULL,
  `confirmation_time` varchar(255) DEFAULT NULL,
  `input_by` varchar(255) DEFAULT NULL,
  `input_time` varchar(255) DEFAULT NULL,
  `checked_by` varchar(255) DEFAULT NULL,
  `checked_time` varchar(255) DEFAULT NULL,
  `passport_no` varchar(255) DEFAULT NULL,
  `purpose_of_visit` varchar(255) DEFAULT NULL,
  `last_place_of_lodging` varchar(255) DEFAULT NULL,
  `next_destination` varchar(255) DEFAULT NULL,
  `clerk` varchar(255) DEFAULT NULL,
  `date_of_issued` date DEFAULT NULL,
  `date_of_landing` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_rooms`
--

INSERT INTO `transaction_rooms` (`id`, `id_guest`, `type_transaction`, `card_number`, `exp_card`, `folio_number`, `notes`, `arrival`, `departure`, `id_room`, `id_price_rate_type`, `id_source_travel_agent`, `status_transaction`, `created_at`, `updated_at`, `status_breakfast`, `price_breakfast`, `market_code`, `no_of_room`, `no_of_person`, `arrival_flight_no`, `departure_flight_no`, `eta`, `etd`, `booked_by`, `tlp_by`, `fax_by`, `taken_by`, `taken_time`, `confirmation_by`, `confirmation_time`, `input_by`, `input_time`, `checked_by`, `checked_time`, `passport_no`, `purpose_of_visit`, `last_place_of_lodging`, `next_destination`, `clerk`, `date_of_issued`, `date_of_landing`) VALUES
(2, 1, 'Cash', NULL, NULL, 'T000001', 'bismillah', '2024-06-29', '2024-06-30', '[1,3,4]', 1, 0, 1, '2024-06-29 09:04:56', '2024-07-04 07:01:56', NULL, 465000, 'Airlines', 3, 6, 'berangkat 0001', 'pulang 0002', 'hashja7667a', 'jnasjkaks6556', 'Emans', '423423423', '42523423423', 'Man', '2024-06-29T23:02', NULL, '2024-06-30T23:02', 'Man', '2024-07-01T23:02', 'To', '2024-07-02T23:03', 'sasadas3', 'fdsdadsad', 'dsadsadas', 'Jepang', 'Emans', '2024-06-30', '2024-06-29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_sewa_rooms`
--

CREATE TABLE `transaction_sewa_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaction_room` bigint(20) UNSIGNED NOT NULL,
  `arrival` date NOT NULL,
  `departure` date NOT NULL,
  `total_orang_dewasa` int(11) NOT NULL,
  `total_anak` int(11) DEFAULT NULL,
  `total_bayi` int(11) DEFAULT NULL,
  `status_sewa` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_sewa_rooms`
--

INSERT INTO `transaction_sewa_rooms` (`id`, `id_transaction_room`, `arrival`, `departure`, `total_orang_dewasa`, `total_anak`, `total_bayi`, `status_sewa`, `created_at`, `updated_at`) VALUES
(2, 2, '2024-06-29', '2024-06-30', 4, 2, 3, 1, '2024-06-29 09:04:56', '2024-06-29 09:04:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `travel_agents`
--

CREATE TABLE `travel_agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `travel_agents`
--

INSERT INTO `travel_agents` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Aplikasi', '2024-06-14 23:13:31', '2024-06-14 23:13:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `identity_card_type` varchar(255) DEFAULT NULL,
  `identity_card_number` varchar(255) DEFAULT NULL,
  `exp_identity_card` date DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `city_birth` varchar(255) DEFAULT NULL,
  `state_birth` varchar(255) DEFAULT NULL,
  `country_birth` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `phone`, `identity_card_type`, `identity_card_number`, `exp_identity_card`, `nationality`, `state`, `address`, `city`, `postal`, `country`, `birth_date`, `city_birth`, `state_birth`, `country_birth`, `gender`, `user_type`, `image`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'HandlerOne', NULL, 'HandlerOne@gmail.com', '$2y$12$MHhZIKu.LG0Dz44BR0x5qe2TX5ILzJrAEULi8au0DCG3CJQYFebu6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, NULL, '2024-06-14 23:13:31', '2024-06-14 23:13:31', 1),
(2, 'HandlerOne', NULL, 'aldinkaisar45222@gmail.com', '$2y$12$gj9xixcwqPkhyB9tNPtPRehd.JqTvAtqUGv2zyB2oJOBNVaT0qeXK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'OB', NULL, NULL, '2024-06-14 23:13:32', '2024-06-14 23:13:32', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `accupations`
--
ALTER TABLE `accupations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `additional_items`
--
ALTER TABLE `additional_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `breakfasts`
--
ALTER TABLE `breakfasts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detil_room_amanities`
--
ALTER TABLE `detil_room_amanities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detil_room_amanities_id_room_foreign` (`id_room`),
  ADD KEY `detil_room_amanities_id_additional_item_foreign` (`id_additional_item`);

--
-- Indeks untuk tabel `detil_transaction_room_items`
--
ALTER TABLE `detil_transaction_room_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detil_transaction_room_items_id_transaction_room_foreign` (`id_transaction_room`),
  ADD KEY `detil_transaction_room_items_id_additional_item_foreign` (`id_additional_item`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guests_id_occupation_foreign` (`id_occupation`);

--
-- Indeks untuk tabel `iventories`
--
ALTER TABLE `iventories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `price_rate_types`
--
ALTER TABLE `price_rate_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_rate_types_id_room_type_foreign` (`id_room_type`),
  ADD KEY `price_rate_types_id_status_rate_type_foreign` (`id_status_rate_type`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_product_category_foreign` (`id_product_category`);

--
-- Indeks untuk tabel `product_buyings`
--
ALTER TABLE `product_buyings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_buyings_id_product_foreign` (`id_product`),
  ADD KEY `product_buyings_id_transaction_pos_foreign` (`id_transaction_pos`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_id_room_type_foreign` (`id_room_type`),
  ADD KEY `rooms_id_status_room_foreign` (`id_status_room`),
  ADD KEY `rooms_id_floor_foreign` (`id_floor`);

--
-- Indeks untuk tabel `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_types_breakfast_id_foreign` (`breakfast_id`);

--
-- Indeks untuk tabel `source_travel_agents`
--
ALTER TABLE `source_travel_agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `source_travel_agents_id_travel_agent_foreign` (`id_travel_agent`);

--
-- Indeks untuk tabel `status_rate_types`
--
ALTER TABLE `status_rate_types`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `status_rooms`
--
ALTER TABLE `status_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stay_views`
--
ALTER TABLE `stay_views`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `total_payments`
--
ALTER TABLE `total_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `total_payments_id_transaction_foreign` (`id_transaction`);

--
-- Indeks untuk tabel `transaction_pos`
--
ALTER TABLE `transaction_pos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_pos_id_transaction_foreign` (`id_transaction`),
  ADD KEY `transaction_pos_id_guest_foreign` (`id_guest`);

--
-- Indeks untuk tabel `transaction_rooms`
--
ALTER TABLE `transaction_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_rooms_id_guest_foreign` (`id_guest`),
  ADD KEY `transaction_rooms_id_room_foreign` (`id_room`),
  ADD KEY `transaction_rooms_id_price_rate_type_foreign` (`id_price_rate_type`),
  ADD KEY `transaction_rooms_id_source_travel_agent_foreign` (`id_source_travel_agent`);

--
-- Indeks untuk tabel `transaction_sewa_rooms`
--
ALTER TABLE `transaction_sewa_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_sewa_rooms_id_transaction_room_foreign` (`id_transaction_room`);

--
-- Indeks untuk tabel `travel_agents`
--
ALTER TABLE `travel_agents`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `accupations`
--
ALTER TABLE `accupations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `additional_items`
--
ALTER TABLE `additional_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `breakfasts`
--
ALTER TABLE `breakfasts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detil_room_amanities`
--
ALTER TABLE `detil_room_amanities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detil_transaction_room_items`
--
ALTER TABLE `detil_transaction_room_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `floors`
--
ALTER TABLE `floors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `iventories`
--
ALTER TABLE `iventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `price_rate_types`
--
ALTER TABLE `price_rate_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_buyings`
--
ALTER TABLE `product_buyings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `source_travel_agents`
--
ALTER TABLE `source_travel_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status_rate_types`
--
ALTER TABLE `status_rate_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `status_rooms`
--
ALTER TABLE `status_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stay_views`
--
ALTER TABLE `stay_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `total_payments`
--
ALTER TABLE `total_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaction_pos`
--
ALTER TABLE `transaction_pos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaction_rooms`
--
ALTER TABLE `transaction_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaction_sewa_rooms`
--
ALTER TABLE `transaction_sewa_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `travel_agents`
--
ALTER TABLE `travel_agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detil_room_amanities`
--
ALTER TABLE `detil_room_amanities`
  ADD CONSTRAINT `detil_room_amanities_id_additional_item_foreign` FOREIGN KEY (`id_additional_item`) REFERENCES `additional_items` (`id`),
  ADD CONSTRAINT `detil_room_amanities_id_room_foreign` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `detil_transaction_room_items`
--
ALTER TABLE `detil_transaction_room_items`
  ADD CONSTRAINT `detil_transaction_room_items_id_additional_item_foreign` FOREIGN KEY (`id_additional_item`) REFERENCES `additional_items` (`id`),
  ADD CONSTRAINT `detil_transaction_room_items_id_transaction_room_foreign` FOREIGN KEY (`id_transaction_room`) REFERENCES `transaction_rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_id_occupation_foreign` FOREIGN KEY (`id_occupation`) REFERENCES `accupations` (`id`);

--
-- Ketidakleluasaan untuk tabel `price_rate_types`
--
ALTER TABLE `price_rate_types`
  ADD CONSTRAINT `price_rate_types_id_room_type_foreign` FOREIGN KEY (`id_room_type`) REFERENCES `room_types` (`id`),
  ADD CONSTRAINT `price_rate_types_id_status_rate_type_foreign` FOREIGN KEY (`id_status_rate_type`) REFERENCES `status_rate_types` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_product_category_foreign` FOREIGN KEY (`id_product_category`) REFERENCES `product_categories` (`id`);

--
-- Ketidakleluasaan untuk tabel `product_buyings`
--
ALTER TABLE `product_buyings`
  ADD CONSTRAINT `product_buyings_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_buyings_id_transaction_pos_foreign` FOREIGN KEY (`id_transaction_pos`) REFERENCES `transaction_pos` (`id`);

--
-- Ketidakleluasaan untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ketidakleluasaan untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_id_floor_foreign` FOREIGN KEY (`id_floor`) REFERENCES `floors` (`id`),
  ADD CONSTRAINT `rooms_id_room_type_foreign` FOREIGN KEY (`id_room_type`) REFERENCES `room_types` (`id`),
  ADD CONSTRAINT `rooms_id_status_room_foreign` FOREIGN KEY (`id_status_room`) REFERENCES `status_rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `room_types`
--
ALTER TABLE `room_types`
  ADD CONSTRAINT `room_types_breakfast_id_foreign` FOREIGN KEY (`breakfast_id`) REFERENCES `breakfasts` (`id`);

--
-- Ketidakleluasaan untuk tabel `source_travel_agents`
--
ALTER TABLE `source_travel_agents`
  ADD CONSTRAINT `source_travel_agents_id_travel_agent_foreign` FOREIGN KEY (`id_travel_agent`) REFERENCES `travel_agents` (`id`);

--
-- Ketidakleluasaan untuk tabel `total_payments`
--
ALTER TABLE `total_payments`
  ADD CONSTRAINT `total_payments_id_transaction_foreign` FOREIGN KEY (`id_transaction`) REFERENCES `transaction_rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_pos`
--
ALTER TABLE `transaction_pos`
  ADD CONSTRAINT `transaction_pos_id_guest_foreign` FOREIGN KEY (`id_guest`) REFERENCES `guests` (`id`),
  ADD CONSTRAINT `transaction_pos_id_transaction_foreign` FOREIGN KEY (`id_transaction`) REFERENCES `transaction_rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_rooms`
--
ALTER TABLE `transaction_rooms`
  ADD CONSTRAINT `transaction_rooms_id_guest_foreign` FOREIGN KEY (`id_guest`) REFERENCES `guests` (`id`),
  ADD CONSTRAINT `transaction_rooms_id_price_rate_type_foreign` FOREIGN KEY (`id_price_rate_type`) REFERENCES `price_rate_types` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_sewa_rooms`
--
ALTER TABLE `transaction_sewa_rooms`
  ADD CONSTRAINT `transaction_sewa_rooms_id_transaction_room_foreign` FOREIGN KEY (`id_transaction_room`) REFERENCES `transaction_rooms` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
