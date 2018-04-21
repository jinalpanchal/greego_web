-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 07:55 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greego_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `current_trips`
--

CREATE TABLE `current_trips` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_trip_amount` int(10) UNSIGNED NOT NULL,
  `tip_amount` int(10) UNSIGNED NOT NULL,
  `total_trip_amount` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_trip_travel_time` int(10) UNSIGNED NOT NULL,
  `payment_status` tinyint(3) UNSIGNED NOT NULL,
  `trip_driver_rating` int(10) UNSIGNED NOT NULL,
  `trip_user_rating` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driverlocation`
--

CREATE TABLE `driverlocation` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driverlocation`
--

INSERT INTO `driverlocation` (`id`, `driver_id`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 1, 23.0134, 72.5624, '2018-04-17 06:55:29', '2018-04-17 06:55:29'),
(2, 2, 23.2156, 72.6369, '2018-04-17 07:08:10', '2018-04-17 07:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` blob,
  `promocode` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_firstname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_middlename` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `legal_lastname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_security_number` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sedan` tinyint(1) DEFAULT NULL,
  `is_suv` tinyint(1) DEFAULT NULL,
  `is_van` tinyint(1) DEFAULT NULL,
  `is_auto` tinyint(1) DEFAULT NULL,
  `is_manual` tinyint(1) DEFAULT NULL,
  `current_status` tinyint(4) DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_iphone` tinyint(1) NOT NULL DEFAULT '0',
  `is_agreed` tinyint(1) NOT NULL DEFAULT '0',
  `profile_status` smallint(6) NOT NULL DEFAULT '0',
  `is_approve` smallint(6) NOT NULL DEFAULT '0',
  `device_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `lastname`, `email`, `dob`, `contact_number`, `city`, `profile_pic`, `promocode`, `legal_firstname`, `legal_middlename`, `legal_lastname`, `social_security_number`, `is_sedan`, `is_suv`, `is_van`, `is_auto`, `is_manual`, `current_status`, `verified`, `is_iphone`, `is_agreed`, `profile_status`, `is_approve`, `device_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, '+918460003300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 2, NULL, '2018-04-17 06:54:51', '2018-04-17 08:08:59'),
(2, NULL, NULL, NULL, NULL, '+919726796951', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, NULL, '2018-04-17 07:07:22', '2018-04-17 07:07:22'),
(3, NULL, NULL, NULL, NULL, '+919687407565', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 4, 0, NULL, '2018-04-17 07:08:51', '2018-04-17 07:31:21');

-- --------------------------------------------------------

--
-- Table structure for table `driver_bank_info`
--

CREATE TABLE `driver_bank_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `routing_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_document`
--

CREATE TABLE `driver_document` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `verification_document` mediumblob NOT NULL,
  `autoissurance_document` mediumblob NOT NULL,
  `homeissurance_document` mediumblob NOT NULL,
  `uberpaycheck_document` mediumblob NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_document`
--

INSERT INTO `driver_document` (`id`, `driver_id`, `verification_document`, `autoissurance_document`, `homeissurance_document`, `uberpaycheck_document`, `created_at`, `updated_at`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `driver_shipping_address`
--

CREATE TABLE `driver_shipping_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `driver_id` int(10) UNSIGNED NOT NULL,
  `street` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apt` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` int(10) UNSIGNED NOT NULL,
  `state` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2017_10_08_000001_create_oauth_access_token_providers_table', 1),
(8, '2018_04_03_073326_create_vehicle_manufaturers_table', 1),
(9, '2018_04_03_090837_create_vehicles_table', 1),
(10, '2018_04_03_091053_create_user_vehicles_table', 1),
(11, '2018_04_06_081405_create_drivers_table', 1),
(12, '2018_04_06_102934_create_admins_table', 1),
(13, '2018_04_09_051658_create_driverlocation_table', 1),
(14, '2018_04_09_053723_create_user_card_table', 1),
(15, '2018_04_09_063431_create_driver_shipping_address_table', 1),
(16, '2018_04_09_065332_create_driver_bank_info_table', 1),
(17, '2018_04_09_072511_create_driver_document_table', 1),
(18, '2018_04_09_111718_create_request_table', 1),
(19, '2018_04_09_114456_create_current_trips_table', 1),
(20, '2018_04_14_054000_create_usa_states', 1),
(21, '2018_04_14_064001_create_usa_rates', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
('729be65756cbe3570fd3a13242860fb4755fce35717b0ac22ecb3318c3330c1714ba394b3dc7803b', 3, 1, 'MyApp', '[]', 0, '2018-04-17 07:31:01', '2018-04-17 07:31:01', '2019-04-17 13:01:01'),
('94d5aa81a3dbb7da63620237e5106a5ce313679755e5820842e3a239ae0b78caecc0d02d3cb4c1a9', 2, 1, 'MyApp', '[]', 0, '2018-04-17 07:07:24', '2018-04-17 07:07:24', '2019-04-17 12:37:24'),
('d77312747dca935cd972b56d11bdbd1232d178b625eb1a48d350cd07a1b40ae3f5d7fe88cac2a873', 3, 1, 'MyApp', '[]', 0, '2018-04-17 07:09:14', '2018-04-17 07:09:14', '2019-04-17 12:39:14'),
('dc1d7056b20a4499e496afce4fb34f27ae5876879a1af8753394d223296eccc7ba7d8ad4a3d5aa91', 1, 1, 'MyApp', '[]', 0, '2018-04-17 06:55:12', '2018-04-17 06:55:12', '2019-04-17 12:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_token_providers`
--

CREATE TABLE `oauth_access_token_providers` (
  `oauth_access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_token_providers`
--

INSERT INTO `oauth_access_token_providers` (`oauth_access_token_id`, `provider`, `created_at`, `updated_at`) VALUES
('729be65756cbe3570fd3a13242860fb4755fce35717b0ac22ecb3318c3330c1714ba394b3dc7803b', 'users', '2018-04-17 07:31:01', '2018-04-17 07:31:01'),
('94d5aa81a3dbb7da63620237e5106a5ce313679755e5820842e3a239ae0b78caecc0d02d3cb4c1a9', 'users', '2018-04-17 07:07:24', '2018-04-17 07:07:24'),
('d77312747dca935cd972b56d11bdbd1232d178b625eb1a48d350cd07a1b40ae3f5d7fe88cac2a873', 'users', '2018-04-17 07:09:14', '2018-04-17 07:09:14'),
('dc1d7056b20a4499e496afce4fb34f27ae5876879a1af8753394d223296eccc7ba7d8ad4a3d5aa91', 'users', '2018-04-17 06:55:12', '2018-04-17 06:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Greego Personal Access Client', 'TiPRZncIdM0pnwFTBGqgqfO12rBfdPxZxL3sVnie', 'http://localhost', 1, 0, 0, '2018-04-17 06:55:07', '2018-04-17 06:55:07'),
(2, NULL, 'Greego Password Grant Client', 'ufaObSGYmzGpaAa3gaWbQcKNsVGna5S2FFGws3sg', 'http://localhost', 0, 1, 0, '2018-04-17 06:55:07', '2018-04-17 06:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-04-17 06:55:07', '2018-04-17 06:55:07');

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
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_vehicle_id` int(10) UNSIGNED NOT NULL,
  `from_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_lat` float DEFAULT NULL,
  `from_lng` float DEFAULT NULL,
  `to_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_lat` float DEFAULT NULL,
  `to_lng` float DEFAULT NULL,
  `total_estimated_travel_time` smallint(5) UNSIGNED NOT NULL,
  `total_estimated_trip_cost` smallint(5) UNSIGNED NOT NULL,
  `request_status` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usa_rates`
--

CREATE TABLE `usa_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `usa_state_id` int(10) UNSIGNED NOT NULL,
  `base_fee` double(8,2) NOT NULL,
  `time_fee` double(8,2) NOT NULL,
  `mile_fee` double(8,2) NOT NULL,
  `cancel_fee` double(8,2) NOT NULL,
  `overmile_fee` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usa_states`
--

CREATE TABLE `usa_states` (
  `id` int(10) UNSIGNED NOT NULL,
  `state_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usa_states`
--

INSERT INTO `usa_states` (`id`, `state_name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Alabama', 'AL', NULL, NULL),
(2, 'Alaska', 'AK', NULL, NULL),
(3, 'Arizona', 'AZ', NULL, NULL),
(4, 'Arkansas', 'AR', NULL, NULL),
(5, 'California', 'CA', NULL, NULL),
(6, 'Colorado', 'CO', NULL, NULL),
(7, 'Connecticut', 'CT', NULL, NULL),
(8, 'Delaware', 'DE', NULL, NULL),
(9, 'District of Columbia', 'DC', NULL, NULL),
(10, 'Florida', 'FL', NULL, NULL),
(11, 'Georgia', 'GA', NULL, NULL),
(12, 'Hawaii', 'HI', NULL, NULL),
(13, 'Idaho', 'ID', NULL, NULL),
(14, 'Illinois', 'IL', NULL, NULL),
(15, 'Indiana', 'IN', NULL, NULL),
(16, 'Iowa', 'IA', NULL, NULL),
(17, 'Kansas', 'KS', NULL, NULL),
(18, 'Kentucky', 'KY', NULL, NULL),
(19, 'Louisiana', 'LA', NULL, NULL),
(20, 'Maine', 'ME', NULL, NULL),
(21, 'Montana', 'MT', NULL, NULL),
(22, 'Nebraska', 'NE', NULL, NULL),
(23, 'Nevada', 'NV', NULL, NULL),
(24, 'New Hampshire', 'NH', NULL, NULL),
(25, 'New Jersey', 'NJ', NULL, NULL),
(26, 'New Mexico', 'NM', NULL, NULL),
(27, 'New York', 'NY', NULL, NULL),
(28, 'North Carolina', 'NC', NULL, NULL),
(29, 'North Dakota', 'ND', NULL, NULL),
(30, 'Ohio', 'OH', NULL, NULL),
(31, 'Oklahoma', 'OK', NULL, NULL),
(32, 'Oregon', 'OR', NULL, NULL),
(33, 'Maryland', 'MD', NULL, NULL),
(34, 'Massachusetts', 'MA', NULL, NULL),
(35, 'Michigan', 'MI', NULL, NULL),
(36, 'Minnesota', 'MN', NULL, NULL),
(37, 'Mississippi', 'MS', NULL, NULL),
(38, 'Missouri', 'MO', NULL, NULL),
(39, 'Pennsylvania', 'PA', NULL, NULL),
(40, 'Rhode Island', 'RI', NULL, NULL),
(41, 'South Carolina', 'SC', NULL, NULL),
(42, 'South Dakota', 'SD', NULL, NULL),
(43, 'Tennessee', 'TN', NULL, NULL),
(44, 'Texas', 'TX', NULL, NULL),
(45, 'Utah', 'UT', NULL, NULL),
(46, 'Vermont', 'VT', NULL, NULL),
(47, 'Virginia', 'VA', NULL, NULL),
(48, 'Washington', 'WA', NULL, NULL),
(49, 'West Virginia', 'WV', NULL, NULL),
(50, 'Wisconsin', 'WI', NULL, NULL),
(51, 'Wyoming', 'WY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` blob,
  `promocode` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_iphone` tinyint(1) NOT NULL DEFAULT '0',
  `is_agreed` tinyint(1) NOT NULL DEFAULT '0',
  `device_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_card`
--

CREATE TABLE `user_card` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `card_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_month_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cvv_number` smallint(5) UNSIGNED NOT NULL,
  `zipcode` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicles`
--

CREATE TABLE `user_vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `year` smallint(6) DEFAULT NULL,
  `color` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` smallint(6) DEFAULT '0',
  `transmission_type` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vehicle_manufacturer_id` int(10) UNSIGNED NOT NULL,
  `model` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_manufacturers`
--

CREATE TABLE `vehicle_manufacturers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `current_trips`
--
ALTER TABLE `current_trips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `current_trips_request_id_foreign` (`request_id`),
  ADD KEY `current_trips_user_id_foreign` (`user_id`),
  ADD KEY `current_trips_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `driverlocation`
--
ALTER TABLE `driverlocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driverlocation_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_bank_info`
--
ALTER TABLE `driver_bank_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_bank_info_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `driver_document`
--
ALTER TABLE `driver_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_document_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `driver_shipping_address`
--
ALTER TABLE `driver_shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_shipping_address_driver_id_foreign` (`driver_id`);

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
-- Indexes for table `oauth_access_token_providers`
--
ALTER TABLE `oauth_access_token_providers`
  ADD PRIMARY KEY (`oauth_access_token_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usa_rates`
--
ALTER TABLE `usa_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usa_rates_usa_state_id_foreign` (`usa_state_id`);

--
-- Indexes for table `usa_states`
--
ALTER TABLE `usa_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_contact_number_unique` (`contact_number`);

--
-- Indexes for table `user_card`
--
ALTER TABLE `user_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_card_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_vehicles`
--
ALTER TABLE `user_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_vehicles_user_id_foreign` (`user_id`),
  ADD KEY `user_vehicles_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_vehicle_manufacturer_id_foreign` (`vehicle_manufacturer_id`);

--
-- Indexes for table `vehicle_manufacturers`
--
ALTER TABLE `vehicle_manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `current_trips`
--
ALTER TABLE `current_trips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driverlocation`
--
ALTER TABLE `driverlocation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_bank_info`
--
ALTER TABLE `driver_bank_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_document`
--
ALTER TABLE `driver_document`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `driver_shipping_address`
--
ALTER TABLE `driver_shipping_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usa_rates`
--
ALTER TABLE `usa_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usa_states`
--
ALTER TABLE `usa_states`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_card`
--
ALTER TABLE `user_card`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_vehicles`
--
ALTER TABLE `user_vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_manufacturers`
--
ALTER TABLE `vehicle_manufacturers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_trips`
--
ALTER TABLE `current_trips`
  ADD CONSTRAINT `current_trips_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `current_trips_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`),
  ADD CONSTRAINT `current_trips_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `driverlocation`
--
ALTER TABLE `driverlocation`
  ADD CONSTRAINT `driverlocation_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `driver_bank_info`
--
ALTER TABLE `driver_bank_info`
  ADD CONSTRAINT `driver_bank_info_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `driver_document`
--
ALTER TABLE `driver_document`
  ADD CONSTRAINT `driver_document_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `driver_shipping_address`
--
ALTER TABLE `driver_shipping_address`
  ADD CONSTRAINT `driver_shipping_address_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `oauth_access_token_providers`
--
ALTER TABLE `oauth_access_token_providers`
  ADD CONSTRAINT `oauth_access_token_providers_oauth_access_token_id_foreign` FOREIGN KEY (`oauth_access_token_id`) REFERENCES `oauth_access_tokens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usa_rates`
--
ALTER TABLE `usa_rates`
  ADD CONSTRAINT `usa_rates_usa_state_id_foreign` FOREIGN KEY (`usa_state_id`) REFERENCES `usa_states` (`id`);

--
-- Constraints for table `user_card`
--
ALTER TABLE `user_card`
  ADD CONSTRAINT `user_card_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_vehicles`
--
ALTER TABLE `user_vehicles`
  ADD CONSTRAINT `user_vehicles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_vehicles_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_vehicle_manufacturer_id_foreign` FOREIGN KEY (`vehicle_manufacturer_id`) REFERENCES `vehicle_manufacturers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;