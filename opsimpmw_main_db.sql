-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2026 at 11:01 PM
-- Server version: 8.0.46
-- PHP Version: 8.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opsimpmw_main_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement_attachments`
--

CREATE TABLE `announcement_attachments` (
  `id` int UNSIGNED NOT NULL,
  `announcement_id` int UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_size` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_attachments`
--

INSERT INTO `announcement_attachments` (`id`, `announcement_id`, `file_path`, `file_name`, `file_type`, `file_size`, `created_at`, `updated_at`) VALUES
(14, 38, 'uploads/announcements/38/1777525193_f4a49b1ab989eb6d251c.jpeg', 'Sosialisasi PMW 2026.jpeg', 'image/jpeg', 116089, '2026-04-30 11:59:53', '2026-04-30 11:59:53'),
(16, 43, 'uploads/announcements/43/1779617511_cc65f41e4e5b026518ca.pdf', 'Surat pernyataan-1.pdf', 'application/pdf', 84314, '2026-05-24 17:11:51', '2026-05-24 17:11:51'),
(17, 44, 'uploads/announcements/44/1779711689_ae2079e2ff53774dcdaa.jpeg', 'Perpanjangan PMW 2026.jpeg', 'image/jpeg', 173601, '2026-05-25 19:21:29', '2026-05-25 19:21:29'),
(18, 45, 'uploads/announcements/45/1780709025_c8e60fb9dfdb30133705.pdf', 'SURAT PENGUMUMAN PMW PITCH DESK TAHUN 2026.pdf', 'application/pdf', 186812, '2026-06-06 08:23:45', '2026-06-06 08:23:45'),
(20, 47, 'uploads/announcements/47/1781326042_495abc2de21324fb26d9.pdf', 'BARU FORM-BAZAR DAN SYARAT KENTENTUAN BAZAR 2026.pdf', 'application/pdf', 426466, '2026-06-13 11:47:22', '2026-06-13 11:47:22'),
(21, 48, 'uploads/announcements/48/1781755761_b033d29ff399a86d1bc8.pdf', 'BERITA ACARA HASIL PITCHING DESK PMW 2026 LOLOS & TIDAK LOLOSS.pdf', 'application/pdf', 2705855, '2026-06-18 11:09:21', '2026-06-18 11:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'admin', '2026-04-14 04:39:02'),
(41, 42, 'mahasiswa', '2026-05-03 22:51:30'),
(42, 43, 'mahasiswa', '2026-05-04 10:56:06'),
(43, 44, 'mahasiswa', '2026-05-04 21:36:13'),
(44, 47, 'mahasiswa', '2026-05-05 15:32:39'),
(45, 48, 'mahasiswa', '2026-05-05 19:12:04'),
(46, 49, 'mahasiswa', '2026-05-05 20:09:23'),
(47, 50, 'mahasiswa', '2026-05-06 16:29:24'),
(48, 51, 'mahasiswa', '2026-05-07 09:51:19'),
(49, 52, 'mahasiswa', '2026-05-07 17:55:10'),
(50, 53, 'mahasiswa', '2026-05-07 18:52:50'),
(51, 54, 'mahasiswa', '2026-05-08 08:46:20'),
(52, 55, 'mahasiswa', '2026-05-08 18:44:43'),
(53, 56, 'mahasiswa', '2026-05-10 08:46:55'),
(54, 57, 'mahasiswa', '2026-05-10 15:08:24'),
(55, 58, 'mahasiswa', '2026-05-10 23:05:13'),
(61, 64, 'mahasiswa', '2026-05-11 16:03:37'),
(62, 65, 'mahasiswa', '2026-05-11 16:04:19'),
(63, 66, 'mahasiswa', '2026-05-11 21:47:17'),
(64, 67, 'mahasiswa', '2026-05-13 08:56:11'),
(65, 68, 'mahasiswa', '2026-05-13 14:04:17'),
(66, 69, 'mahasiswa', '2026-05-13 21:06:58'),
(67, 70, 'mahasiswa', '2026-05-14 14:09:55'),
(68, 71, 'mahasiswa', '2026-05-14 20:07:39'),
(69, 72, 'mahasiswa', '2026-05-16 09:35:44'),
(70, 73, 'mahasiswa', '2026-05-16 10:08:37'),
(71, 74, 'mahasiswa', '2026-05-17 12:39:29'),
(72, 75, 'mahasiswa', '2026-05-18 15:50:14'),
(73, 76, 'mahasiswa', '2026-05-19 09:39:39'),
(74, 77, 'mahasiswa', '2026-05-19 10:46:34'),
(75, 78, 'mahasiswa', '2026-05-19 11:24:58'),
(76, 79, 'mahasiswa', '2026-05-19 11:25:20'),
(77, 80, 'mahasiswa', '2026-05-19 11:26:44'),
(79, 82, 'mahasiswa', '2026-05-20 01:21:59'),
(80, 83, 'mahasiswa', '2026-05-20 12:59:15'),
(81, 84, 'mahasiswa', '2026-05-20 14:04:10'),
(82, 85, 'mahasiswa', '2026-05-20 15:22:10'),
(83, 86, 'mahasiswa', '2026-05-20 18:56:37'),
(84, 87, 'mahasiswa', '2026-05-21 12:55:59'),
(85, 88, 'mahasiswa', '2026-05-21 15:43:00'),
(86, 89, 'mahasiswa', '2026-05-21 16:09:44'),
(87, 90, 'mahasiswa', '2026-05-21 18:19:25'),
(88, 91, 'mahasiswa', '2026-05-22 07:52:38'),
(89, 92, 'mahasiswa', '2026-05-22 08:02:18'),
(90, 93, 'mahasiswa', '2026-05-23 10:42:51'),
(91, 94, 'mahasiswa', '2026-05-23 10:57:24'),
(92, 95, 'mahasiswa', '2026-05-23 11:51:45'),
(93, 96, 'mahasiswa', '2026-05-23 12:32:08'),
(94, 97, 'mahasiswa', '2026-05-23 21:58:09'),
(95, 98, 'mahasiswa', '2026-05-23 22:55:59'),
(96, 99, 'mahasiswa', '2026-05-23 23:43:29'),
(97, 100, 'mahasiswa', '2026-05-24 11:57:30'),
(98, 101, 'mahasiswa', '2026-05-24 12:49:36'),
(99, 102, 'mahasiswa', '2026-05-24 13:21:31'),
(100, 103, 'mahasiswa', '2026-05-24 17:40:58'),
(101, 104, 'mahasiswa', '2026-05-24 19:03:57'),
(102, 105, 'mahasiswa', '2026-05-24 19:28:18'),
(103, 106, 'mahasiswa', '2026-05-24 21:24:13'),
(104, 107, 'mahasiswa', '2026-05-24 21:25:33'),
(106, 109, 'mahasiswa', '2026-05-25 11:04:52'),
(107, 110, 'mahasiswa', '2026-05-25 13:28:13'),
(108, 111, 'mahasiswa', '2026-05-25 21:19:46'),
(109, 112, 'mahasiswa', '2026-05-26 09:39:07'),
(110, 113, 'mahasiswa', '2026-05-26 16:49:16'),
(112, 115, 'reviewer', '2026-06-01 14:45:14'),
(120, 123, 'penilai', '2026-06-04 15:46:57'),
(121, 124, 'penilai', '2026-06-04 15:47:57'),
(122, 125, 'penilai', '2026-06-04 15:48:45'),
(123, 126, 'penilai', '2026-06-04 15:49:51'),
(124, 127, 'penilai', '2026-06-04 15:50:39'),
(125, 128, 'penilai', '2026-06-04 15:54:22'),
(126, 129, 'mahasiswa', '2026-06-05 12:09:36'),
(127, 130, 'penilai', '2026-06-08 17:48:56'),
(128, 131, 'dosen', '2026-07-19 19:10:45'),
(129, 132, 'dosen', '2026-07-19 19:14:41'),
(130, 133, 'dosen', '2026-07-19 19:18:24'),
(131, 134, 'dosen', '2026-07-19 19:20:43'),
(132, 135, 'dosen', '2026-07-19 19:21:58'),
(133, 136, 'dosen', '2026-07-19 19:23:05'),
(134, 137, 'dosen', '2026-07-19 19:24:26'),
(135, 138, 'dosen', '2026-07-19 19:25:59'),
(136, 139, 'dosen', '2026-07-19 19:26:59'),
(137, 140, 'dosen', '2026-07-19 19:28:26'),
(138, 141, 'mentor', '2026-07-23 10:19:03'),
(139, 142, 'mentor', '2026-07-23 10:21:28'),
(140, 143, 'mentor', '2026-07-23 10:22:30'),
(141, 144, 'mentor', '2026-07-23 10:23:19'),
(142, 145, 'mentor', '2026-07-23 10:24:07'),
(143, 146, 'mentor', '2026-07-23 10:24:50'),
(144, 147, 'mentor', '2026-07-23 10:26:49'),
(145, 148, 'mentor', '2026-07-23 10:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'simpmw@polsri.ac.id', '$2y$12$Mn8F04rWpJYuXVlwE974pOwbGCBEXZoz/HgjXKoWQHlvX61nEApc6', NULL, NULL, 0, '2026-08-03 21:43:31', '2026-04-14 04:39:01', '2026-08-03 21:43:31'),
(45, 42, 'email_password', NULL, 'mroihanbaariq@gmail.com', '$2y$12$YkIZgFQAlhPqKQjAmVNGI.hePJOg7ETHfi.yvvSOMw9QOfHQ8Qjqu', NULL, NULL, 0, '2026-07-31 13:09:12', '2026-05-03 22:51:30', '2026-07-31 13:09:12'),
(46, 43, 'email_password', NULL, 'mersialyaprima67@gmail.com', '$2y$12$KYxlXX84lYnhX9WUNLx78uHJjIDOblDWS1Ub9Q4XDSnR7.PvDvvS2', NULL, NULL, 0, '2026-05-06 23:00:42', '2026-05-04 10:56:05', '2026-05-06 23:00:42'),
(47, 44, 'email_password', NULL, 'putrinatasyaaa1188@gmail.com', '$2y$12$FLdLKrwV5g7iojnjJaDoKOFahMwWLd5b1huF01QvKWr1POrj3Ksza', NULL, NULL, 0, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(48, 47, 'email_password', NULL, 'ghefiramutiara8@gmail.com', '$2y$12$.T/xKyGyPZL3FLQhtlCk6uusdV/VHyVL4RMRo5qSnt3Seo/sFZtl6', NULL, NULL, 0, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(49, 48, 'email_password', NULL, 'msatriaws@gmail.com', '$2y$12$JskyVbWIaDRWZ8TQr37Ek..sDylKm0eudQbn8UCZRGhUuaTl12DAC', NULL, NULL, 0, '2026-06-16 18:59:17', '2026-05-05 19:12:04', '2026-06-16 18:59:17'),
(50, 49, 'email_password', NULL, 'iwayanbhayusastrawiguna@gmail.com', '$2y$12$gK78vR2cnktNYGTKWnGuDevX8WK6lErFUm.Vv8Ks2Nl5z1jIvjjOS', NULL, NULL, 0, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(51, 50, 'email_password', NULL, 'rakameidiansyah67@gmail.com', '$2y$12$qE/ysSrIr1GaYnfAwiGYL.iKqBmPuAdUBJvtg4yvTOkQ6F4nzJOKq', NULL, NULL, 0, '2026-07-02 18:09:21', '2026-05-06 16:29:24', '2026-07-02 18:09:21'),
(52, 51, 'email_password', NULL, 'melinasftr1204@gmail.com', '$2y$12$rHYtkDLlaJ/ibgAkBpWwz.AA.ZrReAzUml1rLeWACOA4/G9cRM.Ru', NULL, NULL, 0, '2026-06-08 14:48:25', '2026-05-07 09:51:19', '2026-06-08 14:48:25'),
(53, 52, 'email_password', NULL, 'prianhandy@gmail.com', '$2y$12$fbGREFqAHsz8b2bfIw5HL..4pek4vEMcmYDBvl7d5Ujl9heA.9xGO', NULL, NULL, 0, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(54, 53, 'email_password', NULL, 'oliviadinatadinda@gmail.com', '$2y$12$wo0pnt1cBc83Ba8zfEKKJejVz7EsX9mGGW4Hh3fM6oQoKM.abLqn.', NULL, NULL, 0, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(55, 54, 'email_password', NULL, 'faturrahman102006@gmail.com', '$2y$12$h3PmM7OpInfXTRyGSKsHF.KOCr/O3sa2GxW.ff5jyHRt0YmhoAtkS', NULL, NULL, 0, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(56, 55, 'email_password', NULL, '062340833143@student.polsri.ac.id', '$2y$12$GslYYlaEz2EQAY5kaTpUreaMbRGjcrCdjqANR/zprJZG85p3Cpiae', NULL, NULL, 0, '2026-08-03 21:54:28', '2026-05-08 18:44:43', '2026-08-03 21:54:28'),
(57, 56, 'email_password', NULL, 'gh4554ni.queen@gmail.com', '$2y$12$9VMh236i6fORo1rxrtz9j.a9DQokfetQTfVqaRTqY3a2nm5/4iHUq', NULL, NULL, 0, '2026-07-31 09:43:00', '2026-05-10 08:46:54', '2026-07-31 09:43:00'),
(58, 57, 'email_password', NULL, 'chaniaputrii06@gmail.com', '$2y$12$Pi0JsrJl42mXubblirbnW.IrsK9B2Xg63e1HAOoc9lRLppFsGfyE.', NULL, NULL, 0, '2026-07-30 10:43:41', '2026-05-10 15:08:24', '2026-07-30 10:43:41'),
(59, 58, 'email_password', NULL, 'elfandary2405@gmail.com', '$2y$12$Rkr9QnNCSI17MvDZBWwb.OpNn7ZocRIOF9M8YiOWS561eybEIZJtq', NULL, NULL, 0, '2026-05-12 14:58:37', '2026-05-10 23:05:13', '2026-05-12 14:58:37'),
(65, 64, 'email_password', NULL, 'sonyardian499@gmail.com', '$2y$12$YIiSqSmcCbMD8/5nJS3NsOxV9FT0LxEHq2B253X724t3V4O25XgF2', NULL, NULL, 0, NULL, '2026-05-11 16:03:36', '2026-05-11 16:03:37'),
(66, 65, 'email_password', NULL, 'mariofebriand23@gmail.com', '$2y$12$JhZL6JiBxg8yQkVlx30CDOdYQUbEfyxAJ1vuYgHJEnp7VaZaQOkTG', NULL, NULL, 0, '2026-05-11 21:30:26', '2026-05-11 16:04:19', '2026-05-11 21:30:26'),
(67, 66, 'email_password', NULL, 'baybaraqbah@gmail.com', '$2y$12$8SGFYyVb5xTmW1rK0eIMBub5IdLBlcKWClGnZyRjhu5I9sE4AN3h.', NULL, NULL, 0, '2026-05-12 17:35:19', '2026-05-11 21:47:16', '2026-05-12 17:35:19'),
(68, 67, 'email_password', NULL, 'rejakjugo@gmail.com', '$2y$12$biTv9rh8islJap6BuYHbh.FRWxjDFfQWTDxAAkkQtzw2gZL6Zr6Ia', NULL, NULL, 0, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(69, 68, 'email_password', NULL, 'nicucimol@gmail.com', '$2y$12$nf/ikgPWevY4WBMjlJtZNusS5An9pUKzrTWbJMWW9cfIP9DdvQ5HG', NULL, NULL, 0, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(70, 69, 'email_password', NULL, 'marselmks932@gmail.com', '$2y$12$8H/6ONxk0JV9HZ8SF/vBeuGbszhbYR80gCVMgt0h.ojT3bU/qIDN2', NULL, NULL, 0, '2026-05-25 08:59:38', '2026-05-13 21:06:57', '2026-05-25 08:59:38'),
(71, 70, 'email_password', NULL, 'intanbelindaaa2@gmal.com', '$2y$12$eJ14gzeOsZxbWazuWE1y/.NZgO5axnSpTppbpJQ3jJBY8IPyzJ2xa', NULL, NULL, 0, '2026-07-16 13:56:16', '2026-05-14 14:09:55', '2026-07-16 13:56:16'),
(72, 71, 'email_password', NULL, 'k4rn0tr1y4d1@gmail.com', '$2y$12$2q7ZnRFHY4sMNcv.K3/LWekxA1s4Nf574jFI3.f31CaVBa./TVIUO', NULL, NULL, 0, '2026-07-01 09:09:34', '2026-05-14 20:07:38', '2026-07-01 09:09:34'),
(73, 72, 'email_password', NULL, 'damayantisarfina@gmail.com', '$2y$12$qqbMwwSsUSeWB5V6lh8x3OsfHaQn4N5Elv0ALAxB8KXt1t4agfrsG', NULL, NULL, 0, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(74, 73, 'email_password', NULL, 'krisnawati0706na@gmail.com', '$2y$12$gCc.FijoIaOvMFNeyA8uQ.nmhVo4sK.zQQRkBhdNIF1xry1WSZ73a', NULL, NULL, 0, '2026-08-01 09:52:34', '2026-05-16 10:08:37', '2026-08-01 09:52:34'),
(75, 74, 'email_password', NULL, 'khaillaanastya@gmail.com', '$2y$12$t4J8nlf3GDVoGfT2qruy8ewwniBBYXPE8nnbXGOXl8RaWbOP7Eshe', NULL, NULL, 0, '2026-06-07 18:52:07', '2026-05-17 12:39:29', '2026-06-07 18:52:07'),
(76, 75, 'email_password', NULL, 'risaoktapiaa@gmail.com', '$2y$12$7Y028tfKX6uppLUAFdA/EeZ..2vU6WE1anjOqLDqJ3FlgCm8yMtAS', NULL, NULL, 0, '2026-06-06 12:53:09', '2026-05-18 15:50:14', '2026-06-06 12:53:09'),
(77, 76, 'email_password', NULL, 'davinaramadhani06@gmail.com', '$2y$12$mfEGMCgJyld3KQcusRkvJOZNkulO2kHhRDt00YR0VxXdwzd5W3fj6', NULL, NULL, 0, '2026-06-06 18:59:06', '2026-05-19 09:39:39', '2026-06-06 18:59:06'),
(78, 77, 'email_password', NULL, '062440833325@student.polsri.ac.id', '$2y$12$KUCVsAvRG3PvVGt/cKFUi.ImGyC7OEOYahdeLiXIImhgMwuTHg0iG', NULL, NULL, 0, '2026-06-18 15:41:03', '2026-05-19 10:46:34', '2026-06-18 15:41:03'),
(79, 78, 'email_password', NULL, '062440833330@student.polsri.ac.id', '$2y$12$rgyM9nlYx1Tf19.sPYm9..lDKRuqIhwyHYaB/VtiSQcEPkDwbfXyC', NULL, NULL, 0, '2026-06-07 21:22:29', '2026-05-19 11:24:58', '2026-06-07 21:22:29'),
(80, 79, 'email_password', NULL, 'akbarcool998@gmail.com', '$2y$12$QXGo8U/5zO/0q1hChiRKeO/JJNqpBmqW3nsNXR9gm4MYW0QoJFqwK', NULL, NULL, 0, '2026-07-04 16:54:23', '2026-05-19 11:25:20', '2026-07-04 16:54:23'),
(81, 80, 'email_password', NULL, '062440833323@student.polsri.ac.id', '$2y$12$wAWymL/UmwAlZOrHwUyN2ed9iHQR9z0q4Tv8/xB9e99SdgSm/eWD6', NULL, NULL, 0, '2026-06-06 16:33:02', '2026-05-19 11:26:43', '2026-06-06 16:33:02'),
(83, 82, 'email_password', NULL, 'muhammadjayadiluthfiizzuddin@gmail.com', '$2y$12$OrwBW57lRacl5nMQ26fNSOPGs1dyJDpAqttIgfH4J.LK/i/oT5N1e', NULL, NULL, 0, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(84, 83, 'email_password', NULL, 'kholilahfitri4@gmail.com', '$2y$12$tRLXm8PI8Hl/2yyZ9UikOeDGu7NpDWb1ak3I1.ykkjcDmypVF1JGm', NULL, NULL, 0, '2026-06-10 12:32:10', '2026-05-20 12:59:15', '2026-06-10 12:32:10'),
(85, 84, 'email_password', NULL, '062440833326@student.polsri.ac.id', '$2y$12$RzidAqmrN5CmP44LDipy5ukgSdutsM7gn6UNoKMOF0RgmLAmOvOuq', NULL, NULL, 0, '2026-06-01 14:30:55', '2026-05-20 14:04:10', '2026-06-01 14:30:55'),
(86, 85, 'email_password', NULL, 'najwaalyasenovgizahra@gmail.com', '$2y$12$SXTVzRh9LWPCuooZW8KaTeukPrRktWrC8hIxiBDreuTyL1Of1/6Eq', NULL, NULL, 0, '2026-08-02 21:21:38', '2026-05-20 15:22:09', '2026-08-02 21:21:38'),
(87, 86, 'email_password', NULL, 'nailahdwimulya04@gmail.com', '$2y$12$tiJls.o418/fmh6LhpeIHu4ga.PvqF5O3Dpcby7oyiBatiea0z/V6', NULL, NULL, 0, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(88, 87, 'email_password', NULL, 'oliviaclaudiaa17@gmail.con', '$2y$12$1L6LTOYWyMf4dKuZDKC2N.mbXQh/lsIsgt11hOU/KqujmebtmlIDi', NULL, NULL, 0, '2026-07-30 12:05:15', '2026-05-21 12:55:59', '2026-07-30 12:05:15'),
(89, 88, 'email_password', NULL, 'indahade600@gmail.com', '$2y$12$jdOgxhL2BO0jSUwS7TWVR.rflCuceN0IGzhx7amybtwhy4tsaK7Ga', NULL, NULL, 0, '2026-05-23 14:05:06', '2026-05-21 15:43:00', '2026-05-23 14:05:06'),
(90, 89, 'email_password', NULL, 'nadilastevanialensi@gmail.con', '$2y$12$joat3Sx05SZpSSxdhu/WouNd04SSGjdF/poj47bgDVmykJUSyRjye', NULL, NULL, 0, '2026-07-30 13:06:38', '2026-05-21 16:09:44', '2026-07-30 13:06:38'),
(91, 90, 'email_password', NULL, '062440833334@student.polsri.ac.id', '$2y$12$pB0PI5E9K26IAFURoO.Hf.M5c299F5YL.B0SUjPJMev9OuqNSnofW', NULL, NULL, 0, '2026-06-18 13:10:53', '2026-05-21 18:19:24', '2026-06-18 13:10:53'),
(92, 91, 'email_password', NULL, 'mozaslavina@gmail.com', '$2y$12$H0cmssR5c5lXsfMalfosm.Dk6Z3Jgx/Um1/p3PiRGcu78fw3r6BOy', NULL, NULL, 0, '2026-06-07 10:02:59', '2026-05-22 07:52:38', '2026-06-07 10:02:59'),
(93, 92, 'email_password', NULL, 'ciciagustinaputri525@gmail.com', '$2y$12$uc/qzzgwDh.JKjtfvxowLunEcJTZV/Pp5V3nVM.PaSrB4E3IlM.H.', NULL, NULL, 0, '2026-06-07 10:33:03', '2026-05-22 08:02:18', '2026-06-07 10:33:03'),
(94, 93, 'email_password', NULL, '062440833332@student.polsri.ac.id', '$2y$12$jTcT9l8haFUKJfzc94bxx.mM7O6XQysMk7g6tuVRj5Gi3Vkk3Fupe', NULL, NULL, 0, '2026-06-07 21:25:32', '2026-05-23 10:42:51', '2026-06-07 21:25:32'),
(95, 94, 'email_password', NULL, '062440833336@student.polsri.ac.id', '$2y$12$xCmnfdlgAyB1hcjXWZzee.OhHp2lWUh3n7GXhLbPkxFoK9GgrJY8S', NULL, NULL, 0, '2026-06-08 11:32:14', '2026-05-23 10:57:24', '2026-06-08 11:32:14'),
(96, 95, 'email_password', NULL, 'rizka03rd@gmail.com', '$2y$12$1q56e0.2JzpMB1KtPADcDeiXXvvBxk31vAUOHKkz9H00PuPNiqYEy', NULL, NULL, 0, '2026-06-25 19:48:18', '2026-05-23 11:51:45', '2026-06-25 19:48:18'),
(97, 96, 'email_password', NULL, 'dinnizen@gmail.com', '$2y$12$J9NmoCEN4mEhLkM77j487.4sfOdkFlVhubdsg3rlc0MUA4o4lkO1K', NULL, NULL, 0, '2026-07-30 07:47:45', '2026-05-23 12:32:08', '2026-07-30 07:47:45'),
(98, 97, 'email_password', NULL, 'htriwarsito@gmail.com', '$2y$12$QEW0teCjcldxpQul.oE6n.wiOMKINSMlL92M2B8QvSZ0NV76ZVhaW', NULL, NULL, 0, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(99, 98, 'email_password', NULL, 'marsya.00101@gmail.com', '$2y$12$0siT9gncDXs9jMXZYhiOaudNqiX3ms0wm6RLSQDqA8z5PNL5h19ui', NULL, NULL, 0, '2026-06-07 10:36:53', '2026-05-23 22:55:59', '2026-06-07 10:36:53'),
(100, 99, 'email_password', NULL, 'houseoflytheros@gmail.com', '$2y$12$NB6Z9qM4F2YQgXy1lNKYkOpg937EvMf8VtT5FVLCTIh6UMREn6kHO', NULL, NULL, 0, '2026-06-08 10:50:04', '2026-05-23 23:43:28', '2026-06-08 10:50:04'),
(101, 100, 'email_password', NULL, 'mridhoapriliadi0@gmail.com', '$2y$12$GSd0RI2q.EfUEHfHfmXqauNVJ67ABwZadZgS1VSJn3x/5.xAXROA.', NULL, NULL, 0, '2026-06-07 07:07:07', '2026-05-24 11:57:30', '2026-06-07 07:07:07'),
(102, 101, 'email_password', NULL, 'tesalonikacfe46@gmail.com', '$2y$12$q3HOrreLK8uSe9NlOqVyyOnEmg1fp4mXMOe8yVmZJ8PbsWHqTqrOq', NULL, NULL, 0, '2026-06-07 08:22:51', '2026-05-24 12:49:36', '2026-06-07 08:22:51'),
(103, 102, 'email_password', NULL, 'rarahnewe@gmail.com', '$2y$12$V.nyvVOgf4MKRHO25SQ8IuL4NzaoNphfxY.NUjUOF/qWjDl0Hm2bC', NULL, NULL, 0, '2026-06-10 09:17:06', '2026-05-24 13:21:30', '2026-06-10 09:17:06'),
(104, 103, 'email_password', NULL, 'hassanjankhan19@gmail.com', '$2y$12$3pkQvB42dvD90kY8tj0NfeXjvAPE9ldT/68twREiwjAQzfwmVgAYm', NULL, NULL, 0, '2026-06-07 11:23:32', '2026-05-24 17:40:58', '2026-06-07 11:23:32'),
(105, 104, 'email_password', NULL, 'meliachya@gmail.com', '$2y$12$pdXP26wnAL1zsLenegYKCOQpXYwalubR9R74VPdJixk8a8lwdfMWm', NULL, NULL, 0, '2026-06-07 00:33:56', '2026-05-24 19:03:57', '2026-06-07 00:33:56'),
(106, 105, 'email_password', NULL, 'naninajae@gmail.com', '$2y$12$TlKPA.//wtsquh9LhrxhU.Qe9iamctx25Z31T7fEiZEUY9bHj9bbW', NULL, NULL, 0, '2026-06-07 10:09:23', '2026-05-24 19:28:18', '2026-06-07 10:09:23'),
(107, 106, 'email_password', NULL, 'mfathir069@gmail.com', '$2y$12$uy7qy8zXanE330F7He0MHex.hPeHRcMFRSuVu3iHaphoArnJVKmca', NULL, NULL, 0, '2026-07-29 23:52:49', '2026-05-24 21:24:12', '2026-07-29 23:52:49'),
(108, 107, 'email_password', NULL, 'tianiusds@gmail.com', '$2y$12$PeR2kcXaMHxng8vB6vo0Jekmli4696wMNjmmazJQWWerkZTovrd9W', NULL, NULL, 0, '2026-06-07 13:48:54', '2026-05-24 21:25:32', '2026-06-07 13:48:54'),
(110, 109, 'email_password', NULL, 'muhammadriizkyy4@gmail.com', '$2y$12$fDpT6j/9bg3lQDr2ZAwc6.lQD7BlaAqFUV.Xp4lv82xzDpX.ciSkS', NULL, NULL, 0, '2026-07-30 16:16:34', '2026-05-25 11:04:51', '2026-07-30 16:16:34'),
(111, 110, 'email_password', NULL, '062440833329@student.polsri.ac.id', '$2y$12$XZ5UINGMYOkPhBhZ3vmBVODJ8M7YASjaCxywcPIyXIvo7tRKWGSby', NULL, NULL, 0, '2026-06-09 17:56:08', '2026-05-25 13:28:13', '2026-06-09 17:56:08'),
(112, 111, 'email_password', NULL, 'valengeraldi17@gmail.com', '$2y$12$onukxJClphZWT0rB9XuLTO0G.L3S7GAowGDnvs8P08ZShfVVstDxa', NULL, NULL, 0, '2026-07-30 14:23:41', '2026-05-25 21:19:46', '2026-07-30 14:23:41'),
(113, 112, 'email_password', NULL, 'akbarfrnd63@gmail.com', '$2y$12$0bsmjt7gfayNVCD0mdw25u7OBNbtk4efbHO6i7y6ZXP8yq9O5UA0.', NULL, NULL, 0, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(114, 113, 'email_password', NULL, 'febriansyah010200@gmail.com', '$2y$12$lDWwGd469T8HTteiDnfG5uld02e8JTVYBocyGh2cDZiMI7OMxAkX.', NULL, NULL, 0, '2026-07-30 19:18:52', '2026-05-26 16:49:16', '2026-07-30 19:18:52'),
(116, 115, 'email_password', NULL, 'reviewerpolsri@gmail.com', '$2y$12$1Jc/C6xwMLoJp8sH.ASiZ.1Fajbzv/vgryeTV.z63FGNcZRxHtgyu', NULL, NULL, 0, '2026-06-03 11:04:28', '2026-06-01 14:45:14', '2026-06-03 11:04:28'),
(124, 123, 'email_password', NULL, 'penilai111@gmail.com', '$2y$12$T8mPEJfzCdcG4zNO/447teyKb93Phn7lI/b88tb3zuJybjigsr1ga', NULL, NULL, 0, '2026-06-06 09:17:44', '2026-06-04 15:46:57', '2026-06-06 09:17:44'),
(125, 124, 'email_password', NULL, 'Penilai222@gmail.com', '$2y$12$chSFez7Zdne4XSTjGaQhLe8zHgtpSnNI/atUtPmYhfUIyIH4CD32i', NULL, NULL, 0, '2026-06-06 09:52:44', '2026-06-04 15:47:57', '2026-06-06 09:52:44'),
(126, 125, 'email_password', NULL, 'Penilai333@gmail.com', '$2y$12$4OG6GZD02Hof3CwnxLZa2.kqUe70dY73/kUgSqdnJrjOBB5pOapDy', NULL, NULL, 0, '2026-06-07 15:08:17', '2026-06-04 15:48:44', '2026-06-07 15:08:17'),
(127, 126, 'email_password', NULL, 'Penilai444@gmail.com', '$2y$12$vcJVhwnuvgIfiD/iG2AaOuUOBYPdrhVzop8V0L4TKE3pucvrRxY32', NULL, NULL, 0, '2026-06-06 10:30:00', '2026-06-04 15:49:51', '2026-06-06 10:30:00'),
(128, 127, 'email_password', NULL, 'Penilai555@gmail.com', '$2y$12$ABt0wySh0mS3sTXCcWypCeiQGBP7Let3N5zeRiqGkVulF3P1Pu1HG', NULL, NULL, 0, '2026-06-07 15:20:09', '2026-06-04 15:50:38', '2026-06-07 15:20:09'),
(129, 128, 'email_password', NULL, 'Penilai666@gmail.com', '$2y$12$dlXA6Ebz.OAiTRgmhzqoeecgTDhQfs4XLV4.jQKGNxoT4vSbEmZyG', NULL, NULL, 0, '2026-06-18 14:11:31', '2026-06-04 15:54:22', '2026-06-18 14:11:31'),
(130, 129, 'email_password', NULL, 'fungsional08@gmail.com', '$2y$12$ZbMs7.oXVLQu0YDWbmdMcOdpC6SrnYPAENEdquXvBSdMhOjoK/eFe', NULL, NULL, 0, '2026-06-07 14:17:26', '2026-06-05 12:09:35', '2026-06-07 14:17:26'),
(131, 130, 'email_password', NULL, 'Penilai@gmail.com', '$2y$12$RuRyk/aMddd.SwXJqeW1k.L9oMWX2/XCRQYDTrfJNcnWCe7jv0ZoS', NULL, NULL, 0, '2026-06-09 14:59:35', '2026-06-08 17:48:56', '2026-06-09 14:59:35'),
(132, 131, 'email_password', NULL, 'paisaldosen@gmail.com', '$2y$12$eqNMmfPH1GA7uDVec7NH9uD4Us8U0wwCBLd8U5DxD1WF14oLe0ed.', NULL, NULL, 0, '2026-08-03 22:42:30', '2026-07-19 19:10:45', '2026-08-03 22:42:30'),
(133, 132, 'email_password', NULL, 'zurohainadosen@gmail.com', '$2y$12$Xc8ryHV811W6vameoo3seeai3frxdREZ.RJ5JEkbvgIY8Q1ieIp2a', NULL, NULL, 0, '2026-07-30 13:53:26', '2026-07-19 19:14:41', '2026-07-30 13:53:26'),
(134, 133, 'email_password', NULL, 'indahpratiwidosen@gmail.com', '$2y$12$4WB0zXpdT2NS00ePE.Br7OBKPbx4MZ0AS79XS.7KB7.1yzInPlL6C', NULL, NULL, 0, '2026-07-30 14:51:27', '2026-07-19 19:18:24', '2026-07-30 14:51:27'),
(135, 134, 'email_password', NULL, 'wahyutriajidosen@gmail.com', '$2y$12$ibZBcus23nNk60FYpOFHPuXS32XNPDVT7UdMAdpScyiQilWv8d9wO', NULL, NULL, 0, '2026-07-30 21:33:01', '2026-07-19 19:20:43', '2026-07-30 21:33:01'),
(136, 135, 'email_password', NULL, 'heniyuvitadosen@gmail.com', '$2y$12$CpPfozb1kgINfYBpVI4v8.dSCdyiJf4Q8xkY8bd0p/U1tBA8shyRm', NULL, NULL, 0, '2026-07-30 15:58:36', '2026-07-19 19:21:58', '2026-07-30 15:58:36'),
(137, 136, 'email_password', NULL, 'dwirianadosen@gmail.com', '$2y$12$XX8t7VGKH5xQOQSdsWpvHez5KalxIfnltly/zpgn/7sDlRxN/wAGG', NULL, NULL, 0, '2026-07-30 15:38:18', '2026-07-19 19:23:04', '2026-07-30 15:38:18'),
(138, 137, 'email_password', NULL, 'lenisabrinadosen@gmail.com', '$2y$12$eMjV89AYa5nQHjcR0CZzA.QEiGeBYAf.Qj8EHjz/TTrr12snJBZdS', NULL, NULL, 0, '2026-07-30 13:17:42', '2026-07-19 19:24:26', '2026-07-30 13:17:42'),
(139, 138, 'email_password', NULL, 'mutiaraputridosen@gmail.com', '$2y$12$VflCNxn4qEPmhS5No25xsux3WkbOgR7I3DD5gvxIogxkQySBbICBm', NULL, NULL, 0, '2026-07-31 04:59:43', '2026-07-19 19:25:59', '2026-07-31 04:59:43'),
(140, 139, 'email_password', NULL, 'dikasetiagrahadosen@gmail.com', '$2y$12$jh82pnxhbAWzlthoH/pgRuRYm0Ixf46hlIU86UEHQVlua/KRIY3lO', NULL, NULL, 0, '2026-07-30 16:38:05', '2026-07-19 19:26:58', '2026-07-30 16:38:05'),
(141, 140, 'email_password', NULL, 'imaspermatasaridosen@gmail.com', '$2y$12$E7ezjr4uCQMOl4YUlI1ltuyUhNoKTX40a70jdkPwIOE8XW1YxJHHG', NULL, NULL, 0, NULL, '2026-07-19 19:28:26', '2026-07-19 19:28:26'),
(142, 141, 'email_password', NULL, 'masaziz@gmail.com', '$2y$12$5EJADhf.nb6uLJNfBJyN/.qvZlYCWS6X1orG1CmnV3XTKx.qD8AdO', NULL, NULL, 0, '2026-07-23 10:27:09', '2026-07-23 10:19:03', '2026-07-23 10:27:09'),
(143, 142, 'email_password', NULL, 'asepsomanhudimentor@gmail.com', '$2y$12$o.i8c4sOE3qpkS8Y4BzhOOZHyAik.WHp.yAkh8RgU/kgZPlMepHyy', NULL, NULL, 0, NULL, '2026-07-23 10:21:27', '2026-07-23 10:21:28'),
(144, 143, 'email_password', NULL, 'rizkirantaumentor@gmail.com', '$2y$12$ELSx5a17TyB7Z4k7ZRzjruT55FGzSax3RhBa53i/GyT4JwUjBnS56', NULL, NULL, 0, '2026-07-23 10:33:19', '2026-07-23 10:22:30', '2026-07-23 10:33:19'),
(145, 144, 'email_password', NULL, 'ekomentor@gmail.com', '$2y$12$iV7QAoyVmYC23S/TDaX.Oe4j7DHPB5yvgkv1FQSWLJFL5PkoLxpMK', NULL, NULL, 0, NULL, '2026-07-23 10:23:19', '2026-07-23 10:23:19'),
(146, 145, 'email_password', NULL, 'lolamentor@gmail.com', '$2y$12$bBS09bQZF6ycyngDlwi/b.m7KKL1YIanmaQNozztopXU4ykTgdLui', NULL, NULL, 0, NULL, '2026-07-23 10:24:07', '2026-07-23 10:24:07'),
(147, 146, 'email_password', NULL, 'ikbalmentor@gmail.com', '$2y$12$YC6JAwctzLsRhZzMu3VnLOdhOipyy01d3BdKRjEYezQ6X6CzVHmfe', NULL, NULL, 0, NULL, '2026-07-23 10:24:49', '2026-07-23 10:24:50'),
(148, 147, 'email_password', NULL, 'anggimentor@gmail.com', '$2y$12$/r5EiaJ6RfQb.UKaYEJ1YuLcV5v0a/lCttDGWjUpXvIczmZ.UROgC', NULL, NULL, 0, NULL, '2026-07-23 10:26:49', '2026-07-23 10:26:49'),
(149, 148, 'email_password', NULL, 'testingmentor@gmail.com', '$2y$12$TG2aphvONlqeJ5l2.Ip1rOOkKiIrpaNmtuM6nQ.U8yhLYrXmIFUAu', NULL, NULL, 0, NULL, '2026-07-23 10:29:08', '2026-07-23 10:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(385, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 02:42:06', 1),
(386, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', NULL, '2026-04-30 09:17:31', 0),
(387, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 09:27:39', 1),
(388, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 09:30:39', 1),
(389, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 09:56:59', 1),
(390, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 09:58:06', 1),
(391, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'masaziz@gmail.com', NULL, '2026-04-30 10:01:45', 0),
(392, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'masaziz@gmail.com', 32, '2026-04-30 10:01:52', 1),
(393, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'dosenk862@gmail.com', 31, '2026-04-30 10:04:44', 1),
(394, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 10:45:18', 1),
(395, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 10:50:48', 1),
(396, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 11:02:03', 1),
(397, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'masaziz@gmail.com', 32, '2026-04-30 11:06:25', 1),
(398, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 11:06:48', 1),
(399, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 11:07:53', 1),
(400, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 11:08:08', 1),
(401, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'dosenk862@gmail.com', 31, '2026-04-30 11:42:42', 1),
(402, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 11:43:02', 1),
(403, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'lopureta@gmail.com', 33, '2026-04-30 11:44:53', 1),
(404, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 11:55:29', 1),
(405, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kkdayyy003@gmail.com', 30, '2026-04-30 11:55:39', 1),
(406, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 12:55:38', 1),
(407, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 14:09:03', 1),
(408, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 14:19:21', 1),
(409, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 14:34:55', 1),
(410, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 15:48:12', 1),
(411, '118.99.94.198', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 15:48:42', 1),
(412, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-04-30 16:06:37', 1),
(413, '158.140.173.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-01 20:54:05', 1),
(414, '158.140.173.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'budicahyono@gmail.com', 35, '2026-05-01 20:54:22', 1),
(415, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-01 21:19:17', 1),
(416, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-01 21:22:23', 1),
(417, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 07:38:47', 1),
(418, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 08:07:27', 1),
(419, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 09:56:22', 1),
(420, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'budisantoso@gmail.com', NULL, '2026-05-02 10:06:19', 0),
(421, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'budisantoso@gmail.com', NULL, '2026-05-02 10:06:23', 0),
(422, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:06:34', 1),
(423, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:08:05', 1),
(424, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:08:25', 1),
(425, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kurniawan@gmail.com', 37, '2026-05-02 10:08:33', 1),
(426, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kurniawan@gmail.com', 37, '2026-05-02 10:09:18', 1),
(427, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kurniawan@gmail.com', 37, '2026-05-02 10:25:16', 1),
(428, '182.1.237.45', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-02 10:26:32', 0),
(429, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'kurniawan@gmail.com', 37, '2026-05-02 10:28:59', 1),
(430, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:40:58', 1),
(431, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:56:22', 1),
(432, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:56:51', 1),
(433, '158.140.165.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-02 10:57:20', 1),
(434, '158.140.165.75', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', 41, '2026-05-02 20:20:27', 1),
(435, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', 40, '2026-05-03 05:38:08', 1),
(436, '118.99.94.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-03 18:33:21', 1),
(437, '10.84.123.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-04 07:36:32', 1),
(438, '118.99.94.121', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-04 11:26:32', 1),
(439, '182.1.238.151', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', 43, '2026-05-04 12:04:18', 1),
(440, '10.84.155.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-05-04 15:31:16', 1),
(441, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:16:54', 0),
(442, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:17:00', 0),
(443, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:17:13', 0),
(444, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-05 08:17:39', 0),
(445, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-05 08:17:52', 0),
(446, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:18:05', 0),
(447, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:18:24', 0),
(448, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:18:32', 0),
(449, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-05 08:18:38', 0),
(450, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-05 08:18:51', 0),
(451, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:19:41', 0),
(452, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:19:57', 0),
(453, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-05 08:20:39', 0),
(454, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:21:29', 0),
(455, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:23:27', 0),
(456, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:24:34', 0),
(457, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:24:55', 0),
(458, '114.79.1.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 08:25:47', 0),
(459, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:11:24', 0),
(460, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:11:32', 0),
(461, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:11:47', 0),
(462, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:12:58', 0),
(463, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:13:09', 0),
(464, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:13:18', 0),
(465, '172.225.72.77', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:13:41', 0),
(466, '146.75.132.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:14:28', 0),
(467, '146.75.132.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:15:09', 0),
(468, '146.75.132.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:15:15', 0),
(469, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:16:31', 0),
(470, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:16:48', 0),
(471, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:16:55', 0),
(472, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:16:59', 0),
(473, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:17:11', 0),
(474, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:18:34', 0),
(475, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:18:45', 0),
(476, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:18:56', 0),
(477, '146.75.132.27', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:19:02', 0),
(478, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:19:35', 0),
(479, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:19:48', 0),
(480, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara8@gmail.com', NULL, '2026-05-05 15:20:00', 0),
(481, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:20:13', 0),
(482, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:20:29', 0),
(483, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:20:38', 0),
(484, '158.140.173.85', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:20:56', 0),
(485, '158.140.173.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:26:00', 0),
(486, '158.140.173.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'Ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:28:56', 0),
(487, '158.140.173.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara1096@gmail.com', NULL, '2026-05-05 15:29:45', 0),
(488, '158.140.173.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.2 Mobile/15E148 Safari/604.1', 'email_password', 'ghefiramutiara8@gmail.com', NULL, '2026-05-05 15:30:11', 0),
(489, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-05 19:11:41', 1),
(490, '114.79.0.113', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 20:19:34', 0),
(491, '114.79.0.113', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 20:19:39', 0),
(492, '114.79.0.113', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-05 20:19:48', 0),
(493, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:31:31', 0),
(494, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:31:45', 0),
(495, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:33:40', 0),
(496, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-06 08:34:02', 0),
(497, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'geaaudreyee@gmail.com', NULL, '2026-05-06 08:34:58', 0),
(498, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:35:04', 0),
(499, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:35:44', 0),
(500, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-06 08:36:38', 0),
(501, '158.140.165.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-06 19:07:47', 1),
(502, '158.140.173.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:49:30', 0),
(503, '158.140.173.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:49:46', 0),
(504, '158.140.173.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:50:37', 0),
(505, '158.140.173.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:50:50', 0),
(506, '158.140.173.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:51:01', 0),
(507, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialya67@gmail.com', NULL, '2026-05-06 22:54:25', 0),
(508, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialya67@gmail.com', NULL, '2026-05-06 22:54:39', 0),
(509, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialya67@gmail.com', NULL, '2026-05-06 22:54:58', 0),
(510, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:55:16', 0),
(511, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:55:42', 0),
(512, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:56:06', 0),
(513, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:56:14', 0),
(514, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:58:15', 0),
(515, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 22:58:46', 0),
(516, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 23:00:09', 0),
(517, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 23:00:25', 0),
(518, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'mersialyaprima67@gmail.com', 43, '2026-05-06 23:00:42', 1),
(519, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-08 18:40:29', 1),
(520, '114.79.0.124', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-08 18:52:18', 0),
(521, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-09 05:33:21', 0),
(522, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-09 05:33:31', 0),
(523, '114.79.0.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'dianramadhan0411@gmail.com', NULL, '2026-05-09 10:50:49', 0),
(524, '114.79.0.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', NULL, '2026-05-09 10:51:01', 0),
(525, '114.79.0.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', NULL, '2026-05-09 10:51:27', 0),
(526, '103.111.100.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', NULL, '2026-05-09 12:22:25', 0),
(527, '103.111.100.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', NULL, '2026-05-09 12:22:57', 0),
(528, '103.111.100.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-09 12:24:21', 1),
(529, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-09 18:29:52', 1),
(530, '158.140.165.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-09 20:14:48', 1),
(531, '157.15.47.53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-05-09 22:37:20', 1),
(532, '103.111.100.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-10 12:20:43', 1),
(533, '36.76.211.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'ChaniaPutriWiranda@gmail.com', NULL, '2026-05-10 15:45:30', 0),
(534, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-10 19:14:41', 1),
(535, '114.79.3.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'Chaniaputrii06@gmail.com', 57, '2026-05-10 19:45:22', 1),
(536, '36.76.211.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-10 20:04:45', 1),
(537, '103.111.100.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-10 21:28:29', 1),
(538, '36.76.211.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-10 22:42:27', 1),
(539, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/419.4.905781065 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', NULL, '2026-05-10 23:07:00', 0),
(540, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-11 08:29:54', 1),
(541, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-11 08:42:29', 1),
(542, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-11 08:55:16', 1),
(543, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-11 08:57:44', 1),
(544, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-11 09:04:34', 1),
(545, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/419.4.905781065 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', 58, '2026-05-11 09:31:48', 1),
(546, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', NULL, '2026-05-11 19:33:03', 0),
(547, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', NULL, '2026-05-11 19:33:13', 0),
(548, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', 58, '2026-05-11 19:35:07', 1),
(549, '182.1.238.129', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-11 19:55:48', 0),
(550, '182.1.238.129', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-11 19:55:57', 0),
(551, '103.136.59.222', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', 58, '2026-05-11 19:55:58', 1),
(552, '182.1.238.129', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-11 19:56:06', 1),
(553, '182.1.229.149', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'mariofebriand03@gmail.com', NULL, '2026-05-11 21:29:59', 0),
(554, '182.1.229.149', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'mariofebriand03@gmail.com', NULL, '2026-05-11 21:30:11', 0),
(555, '182.1.229.149', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'mariofebriand23@gmail.com', 65, '2026-05-11 21:30:26', 1),
(556, '114.10.98.152', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-11 21:51:58', 1),
(557, '182.1.229.149', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-11 21:55:26', 1),
(558, '114.10.98.152', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-12 00:15:15', 1),
(559, '182.1.229.137', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-12 00:22:06', 1),
(560, '182.1.229.149', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-12 09:47:38', 1),
(561, '182.1.229.137', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-12 14:31:49', 1),
(562, '140.213.185.34', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/419.4.905781065 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', 58, '2026-05-12 14:58:36', 1),
(563, '140.213.184.37', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/419.4.905781065 Mobile/15E148 Safari/604.1', 'email_password', 'elfandary2405@gmail.com', 58, '2026-05-12 14:58:37', 1),
(564, '114.10.98.242', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'baybaraqbah@gmail.com', 66, '2026-05-12 17:35:19', 1),
(565, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-12 18:03:09', 1),
(566, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-12 18:15:17', 1),
(567, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-12 18:19:15', 1),
(568, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-12 18:25:20', 1),
(569, '158.140.173.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-12 19:19:01', 1),
(570, '36.76.211.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-12 20:53:08', 1),
(571, '158.140.173.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-14 14:23:23', 1),
(572, '182.253.133.163', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmail.com', NULL, '2026-05-14 14:57:34', 0),
(573, '182.253.133.163', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmail.com', NULL, '2026-05-14 14:57:51', 0),
(574, '140.213.185.145', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-14 15:00:53', 1),
(575, '158.140.173.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-16 08:25:13', 1),
(576, '158.140.173.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-16 13:32:16', 1),
(577, '158.140.165.24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-16 20:53:03', 1),
(578, '158.140.173.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-17 08:13:42', 1),
(579, '158.140.173.87', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-17 17:34:12', 1),
(580, '103.144.180.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'k4rn0tr1y4d1@gmail.com', 71, '2026-05-18 12:41:15', 1),
(581, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-19 09:16:12', 1),
(582, '10.84.142.225', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-19 10:56:20', 1),
(583, '114.10.98.116', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'marselmks932@gmail.com', 69, '2026-05-19 11:00:38', 1),
(584, '10.84.152.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-19 11:16:45', 1),
(585, '10.84.142.225', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-19 11:38:19', 1),
(586, '182.9.49.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'admin@gmail.com', NULL, '2026-05-19 20:58:57', 0),
(587, '114.10.98.38', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'marselmks932@gmail.com', 69, '2026-05-20 08:49:25', 1),
(588, '10.84.128.32', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-20 09:09:36', 1),
(589, '10.84.95.246', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-20 11:20:11', 1),
(590, '119.235.212.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-20 17:19:51', 1),
(591, '158.140.173.87', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-20 17:27:43', 1),
(592, '119.235.212.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-20 17:31:12', 0),
(593, '119.235.212.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-20 17:31:30', 0),
(594, '125.167.57.83', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-20 18:23:01', 1),
(595, '114.10.99.114', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-20 20:22:24', 1),
(596, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-20 20:34:12', 1),
(597, '36.76.241.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-20 20:39:25', 1),
(598, '114.10.99.218', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-05-20 20:51:49', 1),
(599, '36.70.50.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-05-20 22:01:18', 1),
(600, '114.10.98.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-20 23:26:38', 1),
(601, '158.140.165.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 07:18:54', 1),
(602, '10.84.95.246', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-21 08:27:37', 1),
(603, '36.70.50.207', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-05-21 11:50:22', 1),
(604, '101.128.104.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-05-21 11:58:16', 0),
(605, '101.128.104.220', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', 80, '2026-05-21 11:58:24', 1),
(606, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-21 12:14:31', 1),
(607, '36.76.241.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-21 12:19:45', 1),
(608, '103.144.180.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'k4rn0tr1y4d1@gmail.com', 71, '2026-05-21 12:21:40', 1),
(609, '10.84.184.148', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 12:34:35', 1),
(610, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:09:12', 0),
(611, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:09:32', 0);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(612, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:12:53', 0),
(613, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:13:05', 0),
(614, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:13:13', 0),
(615, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:13:32', 0),
(616, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:20:26', 0),
(617, '36.76.241.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-21 13:23:11', 1),
(618, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:25:45', 0),
(619, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:26:00', 0),
(620, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:26:27', 0),
(621, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-05-21 13:26:44', 0),
(622, '36.77.160.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-21 13:27:11', 1),
(623, '36.77.160.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-21 13:32:50', 1),
(624, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-21 13:33:19', 1),
(625, '36.77.160.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-21 13:40:09', 1),
(626, '114.10.98.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'budicahyono@gmail.com', NULL, '2026-05-21 14:50:00', 0),
(627, '114.10.98.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-21 14:50:04', 1),
(628, '36.77.160.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-21 16:07:23', 1),
(629, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:43:29', 0),
(630, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:43:41', 0),
(631, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:44:05', 0),
(632, '114.125.235.90', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', NULL, '2026-05-21 16:44:10', 0),
(633, '114.125.235.90', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-05-21 16:44:17', 1),
(634, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:44:55', 0),
(635, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:45:05', 0),
(636, '10.84.127.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-21 16:45:29', 1),
(637, '10.84.127.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-21 16:45:38', 1),
(638, '10.84.161.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-21 16:46:07', 0),
(639, '10.84.127.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-21 16:46:19', 1),
(640, '158.140.165.32', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 18:27:28', 1),
(641, '158.140.165.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', NULL, '2026-05-21 19:15:36', 0),
(642, '158.140.165.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 19:15:53', 1),
(643, '158.140.165.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 22:25:02', 1),
(644, '158.140.165.32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-21 22:31:06', 1),
(645, '36.76.196.200', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-21 22:43:23', 1),
(646, '158.140.173.87', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-21 23:33:36', 1),
(647, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-21 23:51:46', 1),
(648, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-22 06:55:19', 1),
(649, '158.140.165.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-22 10:33:39', 1),
(650, '114.125.238.219', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-22 10:51:16', 1),
(651, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-22 19:32:39', 1),
(652, '182.1.237.191', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-22 19:43:24', 1),
(653, '36.76.198.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-05-23 00:01:58', 0),
(654, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-23 00:09:32', 1),
(655, '157.15.47.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-05-23 00:29:54', 1),
(656, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 05:19:06', 1),
(657, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 07:57:23', 1),
(658, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 08:50:22', 1),
(659, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 10:10:30', 1),
(660, '114.10.99.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-05-23 10:50:37', 1),
(661, '10.88.5.17', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-23 11:20:42', 1),
(662, '180.243.210.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'safitrimelina1204@gmail.com', NULL, '2026-05-23 11:44:05', 0),
(663, '180.243.210.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasafitri1204@gmail.com', NULL, '2026-05-23 11:50:34', 0),
(664, '36.76.198.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-23 12:10:32', 1),
(665, '114.10.99.146', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-23 13:53:50', 1),
(666, '101.128.109.200', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'indahade600@gmail.com', 88, '2026-05-23 14:05:06', 1),
(667, '10.88.5.12', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-23 14:20:56', 1),
(668, '140.213.184.59', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-23 14:43:53', 1),
(669, '158.140.165.3', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-23 14:49:33', 1),
(670, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 14:50:30', 1),
(671, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 15:29:13', 1),
(672, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-05-23 15:33:50', 0),
(673, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-05-23 15:34:31', 0),
(674, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-05-23 15:53:00', 0),
(675, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-05-23 15:53:25', 0),
(676, '36.77.165.239', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-23 16:01:06', 1),
(677, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-23 16:03:33', 1),
(678, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 17:49:33', 1),
(679, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-23 18:33:36', 1),
(680, '36.69.53.162', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-23 18:35:54', 1),
(681, '114.10.99.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-23 18:36:00', 1),
(682, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-23 19:28:14', 0),
(683, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-23 19:30:25', 0),
(684, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-23 19:30:34', 0),
(685, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-23 19:30:39', 0),
(686, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'fakhriirawann@gmail.com', NULL, '2026-05-23 19:30:53', 0),
(687, '158.140.173.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-05-23 19:32:25', 1),
(688, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-23 21:12:43', 1),
(689, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-23 21:39:36', 1),
(690, '158.140.165.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-23 23:03:43', 1),
(691, '158.140.173.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', NULL, '2026-05-23 23:49:55', 0),
(692, '158.140.173.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-23 23:50:14', 1),
(693, '36.76.198.159', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-24 00:39:24', 1),
(694, '36.69.52.10', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-24 06:47:28', 1),
(695, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-24 06:57:07', 1),
(696, '158.140.173.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillanastya@gmail.com', NULL, '2026-05-24 07:12:00', 0),
(697, '158.140.173.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillanastya@gmail.com', NULL, '2026-05-24 07:12:40', 0),
(698, '36.70.57.171', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-24 08:11:31', 1),
(699, '158.140.165.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 09:15:16', 1),
(700, '114.79.1.46', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 09:17:38', 1),
(701, '158.140.165.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-05-24 10:34:31', 1),
(702, '101.128.109.128', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', NULL, '2026-05-24 10:48:52', 0),
(703, '101.128.109.128', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-24 10:49:10', 1),
(704, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:150.0) Gecko/20100101 Firefox/150.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-24 11:18:55', 1),
(705, '10.88.5.12', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-24 11:30:48', 1),
(706, '158.140.173.116', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 11:52:30', 1),
(707, '158.140.173.86', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'davinaramadhani06@gmail.com', 76, '2026-05-24 11:52:30', 1),
(708, '101.128.109.128', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-24 12:03:24', 1),
(709, '101.128.109.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-05-24 12:08:05', 1),
(710, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-24 12:21:37', 1),
(711, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 12:23:13', 1),
(712, '103.119.54.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-05-24 12:23:59', 1),
(713, '180.251.242.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-24 12:54:08', 1),
(714, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 13:18:42', 1),
(715, '158.140.165.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 13:23:20', 1),
(716, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 13:36:11', 1),
(717, '36.70.54.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'k4rn0tr1y4d1@gmail.com', 71, '2026-05-24 13:44:06', 1),
(718, '36.77.143.155', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-24 14:01:37', 1),
(719, '114.79.1.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-24 14:04:49', 1),
(720, '158.140.165.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-24 15:04:18', 1),
(721, '180.251.246.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-24 15:26:57', 1),
(722, '114.79.6.174', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-05-24 15:34:54', 1),
(723, '182.1.229.238', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-24 15:39:13', 1),
(724, '114.10.99.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@polsri.ac.id', NULL, '2026-05-24 15:58:28', 0),
(725, '114.10.99.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@polsri.ac.id', NULL, '2026-05-24 15:58:37', 0),
(726, '114.10.99.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@polsri.ac.id', NULL, '2026-05-24 15:58:42', 0),
(727, '114.10.99.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-05-24 15:59:23', 0),
(728, '114.10.99.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-05-24 15:59:32', 1),
(729, '125.167.56.127', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-24 16:20:47', 1),
(730, '103.119.54.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mridhoapriliadi0@gmail.com', NULL, '2026-05-24 16:32:47', 0),
(731, '103.119.54.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-05-24 16:33:00', 1),
(732, '114.10.98.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-24 16:54:00', 1),
(733, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 17:11:05', 1),
(734, '101.128.108.131', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-05-24 17:33:55', 1),
(735, '114.10.98.96', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'marselmks932@gmail.com', 69, '2026-05-24 17:41:30', 1),
(736, '101.128.109.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-05-24 18:00:33', 1),
(737, '158.140.165.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 18:05:46', 1),
(738, '114.79.5.89', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Mobile/15E148 Safari/604.1', 'email_password', 'mozaslavina@gmail.com', 91, '2026-05-24 18:07:57', 1),
(739, '158.140.165.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 18:19:41', 1),
(740, '114.10.99.165', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-24 18:37:39', 1),
(741, '158.140.165.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-05-24 18:46:04', 1),
(742, '180.251.242.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-24 18:48:17', 1),
(743, '114.125.238.24', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-24 19:02:51', 1),
(744, '180.242.10.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-24 19:06:26', 1),
(745, '114.79.5.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-24 19:14:35', 1),
(746, '203.78.116.55', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_4_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/23E261 Instagram 430.0.0.32.70 (iPhone17,1; iOS 26_4_2; en_US; en; scale=3.00; 1206x2622; IABMV/1; 972915403) Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-05-24 19:33:33', 1),
(747, '101.128.104.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-24 19:37:18', 1),
(748, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-24 20:07:20', 1),
(749, '158.140.165.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'tianiusds@gmail.com', NULL, '2026-05-24 20:11:28', 0),
(750, '158.140.165.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'tianiusds@gmail.com', NULL, '2026-05-24 20:11:47', 0),
(751, '158.140.165.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'tianiusds@gmail.com', NULL, '2026-05-24 20:12:07', 0),
(752, '158.140.165.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'krisnawati706na@gmail.com', NULL, '2026-05-24 20:13:05', 0),
(753, '158.140.165.4', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'krisnawati706na@gmail.com', NULL, '2026-05-24 20:13:41', 0),
(754, '101.128.109.156', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Mobile/15E148 Safari/604.1', 'email_password', 'mozaslavina@gmail.com', 91, '2026-05-24 20:22:25', 1),
(755, '101.128.109.156', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0', 'email_password', 'mozaslavina@gmail.com', 91, '2026-05-24 20:23:43', 1),
(756, '110.137.116.49', 'Mozilla/5.0 (iPad; CPU OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22H352 Instagram 430.0.0.32.70 (iPad13,18; iPadOS 18_7_8; id_ID; id; scale=2.00; 2360x1640; IABMV/1; 972915403) Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-05-24 20:37:56', 1),
(757, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-24 20:41:10', 1),
(758, '36.76.223.54', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-24 20:45:11', 1),
(759, '157.15.47.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-05-24 20:47:49', 1),
(760, '157.10.97.155', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:32:53', 0),
(761, '157.10.97.155', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:33:08', 0),
(762, '157.10.97.155', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:33:32', 0),
(763, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-24 21:37:02', 1),
(764, '36.70.61.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-24 21:37:22', 1),
(765, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:43:29', 0),
(766, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:43:42', 0),
(767, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:43:44', 0),
(768, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:45:12', 0),
(769, '125.167.56.127', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-24 21:45:22', 1),
(770, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'estertorie0729@gmail.com', NULL, '2026-05-24 21:46:14', 0),
(771, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'krisnawati0706na@gmail.com', NULL, '2026-05-24 21:51:42', 0),
(772, '157.10.97.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-24 21:53:13', 1),
(773, '36.70.61.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-24 22:08:26', 1),
(774, '36.70.61.12', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1', 'email_password', '062440833338@student.polsri.ac.id', NULL, '2026-05-24 22:10:19', 0),
(775, '36.70.61.12', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-24 22:10:46', 1),
(776, '103.111.100.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-24 22:17:31', 1),
(777, '158.140.165.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-05-24 22:53:55', 0),
(778, '158.140.165.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', 93, '2026-05-24 22:54:12', 1),
(779, '114.10.98.165', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-24 23:29:23', 1),
(780, '180.254.164.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 00:09:33', 1),
(781, '103.111.100.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-25 01:44:57', 1),
(782, '36.76.223.54', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-25 03:33:15', 1),
(783, '182.9.34.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'admin@gmail.com', NULL, '2026-05-25 03:39:39', 0),
(784, '182.9.34.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'combetohct@yahoo.com', 81, '2026-05-25 03:39:44', 1),
(785, '158.140.173.76', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-05-25 05:14:06', 1),
(786, '180.254.164.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 05:37:21', 1),
(787, '180.254.164.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 05:38:54', 1),
(788, '158.140.165.2', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 05:43:23', 1),
(789, '180.254.164.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 05:45:08', 1),
(790, '180.254.164.161', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Safari/605.1.15', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-05-25 05:51:13', 1),
(791, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-25 06:07:29', 1),
(792, '159.223.82.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-25 06:42:01', 1),
(793, '10.84.218.138', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmail.com', NULL, '2026-05-25 06:52:05', 0),
(794, '10.84.218.138', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmail.com', NULL, '2026-05-25 06:52:19', 0),
(795, '10.84.218.138', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-25 06:53:13', 1),
(796, '10.84.145.114', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'naninajae@gmail.com', 105, '2026-05-25 07:06:43', 1),
(797, '114.10.99.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-25 07:07:12', 1),
(798, '10.84.241.183', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'davinaramadhani06@gmail.com', 76, '2026-05-25 08:07:25', 1),
(799, '114.10.98.146', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'meliachya@gmail.com', 104, '2026-05-25 08:39:13', 1),
(800, '10.84.246.79', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-25 08:50:53', 1),
(801, '10.88.130.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-25 08:50:57', 1),
(802, '10.84.245.145', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'tianiusds@gmail.com', 107, '2026-05-25 08:54:40', 1),
(803, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-25 08:55:18', 1),
(804, '114.10.98.19', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36', 'email_password', 'marselmks932@gmail.com', 69, '2026-05-25 08:59:38', 1),
(805, '10.84.244.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 09:15:27', 1),
(806, '182.253.133.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-25 09:22:51', 1),
(807, '36.70.48.233', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_1_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.1.1 Mobile/15E148 Safari/604.1', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-25 09:25:14', 1),
(808, '10.84.244.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 09:26:34', 1),
(809, '114.10.98.230', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-25 09:35:33', 0),
(810, '114.10.98.230', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-25 09:35:40', 1),
(811, '10.84.107.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-25 09:36:24', 1),
(812, '10.84.244.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 09:47:36', 1),
(813, '10.84.239.22', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-25 09:51:18', 1),
(814, '36.76.223.54', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-25 09:53:28', 1),
(815, '110.137.129.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-05-25 09:56:41', 1),
(816, '10.84.244.43', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 10:33:33', 1),
(817, '10.84.254.240', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-25 11:39:38', 1),
(818, '10.84.238.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-05-25 11:49:11', 1),
(819, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', NULL, '2026-05-25 12:04:21', 0),
(820, '158.140.173.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-25 12:04:36', 1),
(821, '10.84.236.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-25 12:14:54', 1),
(822, '10.84.235.17', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-05-25 12:32:44', 1),
(823, '36.70.48.233', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-25 12:33:17', 1),
(824, '10.84.98.242', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-25 12:57:22', 1),
(825, '10.84.245.145', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'tianiusds@gmail.com', 107, '2026-05-25 13:15:03', 1),
(826, '10.88.130.153', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-05-25 13:15:06', 1),
(827, '172.225.78.198', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-25 13:21:40', 1),
(828, '10.84.252.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-05-25 13:33:09', 1),
(829, '101.128.108.38', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833329@student.polsri.ac.id', 110, '2026-05-25 13:33:19', 1),
(830, '114.10.98.198', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-25 13:53:10', 1),
(831, '36.76.184.208', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22F76 Instagram 430.0.0.32.70 (iPhone14,5; iOS 18_5; id_ID; id; scale=3.00; 1170x2532; IABMV/1; 972915403) Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-25 14:05:39', 1),
(832, '10.84.9.28', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-05-25 14:12:33', 1),
(833, '10.84.8.55', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-25 14:15:09', 1),
(834, '36.76.184.208', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22F76 Instagram 430.0.0.32.70 (iPhone14,5; iOS 18_5; id_ID; id; scale=3.00; 1170x2532; IABMV/1; 972915403) Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', NULL, '2026-05-25 14:22:52', 0),
(835, '36.76.184.208', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/22F76 Instagram 430.0.0.32.70 (iPhone14,5; iOS 18_5; id_ID; id; scale=3.00; 1170x2532; IABMV/1; 972915403) Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-25 14:23:03', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(836, '10.84.2.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-25 14:25:17', 0),
(837, '10.84.2.57', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-25 14:25:26', 1),
(838, '114.125.239.192', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-25 14:26:25', 1),
(839, '114.79.1.162', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-25 14:42:49', 1),
(840, '110.137.129.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-05-25 14:59:52', 1),
(841, '10.84.127.155', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-05-25 15:02:49', 1),
(842, '114.10.98.146', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'meliachya@gmail.com', 104, '2026-05-25 15:17:31', 1),
(843, '182.253.133.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-25 15:39:35', 1),
(844, '103.111.100.11', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-05-25 15:45:27', 1),
(845, '158.140.173.100', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 16:05:47', 1),
(846, '114.79.2.111', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-25 16:52:50', 1),
(847, '10.84.233.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-25 17:02:42', 1),
(848, '114.10.99.146', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@gmail.com', NULL, '2026-05-25 17:14:23', 0),
(849, '114.10.99.146', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@polsri.ac.id', NULL, '2026-05-25 17:14:44', 0),
(850, '114.10.99.146', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-05-25 17:15:01', 0),
(851, '114.10.99.146', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', 80, '2026-05-25 17:15:16', 1),
(852, '158.140.173.83', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 18:27:26', 1),
(853, '101.128.109.128', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-25 18:32:48', 1),
(854, '114.10.98.110', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', 80, '2026-05-25 18:34:17', 1),
(855, '119.235.212.225', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-25 18:41:06', 1),
(856, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 18:43:36', 1),
(857, '158.140.173.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-25 19:22:31', 1),
(858, '114.79.0.254', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-05-25 19:42:12', 1),
(859, '103.111.100.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-25 19:56:45', 1),
(860, '114.79.1.182', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-25 20:01:20', 1),
(861, '10.84.233.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-05-25 20:04:43', 1),
(862, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-25 20:30:17', 1),
(863, '182.1.231.94', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-25 21:03:43', 1),
(864, '36.77.143.155', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-25 21:28:40', 1),
(865, '101.128.104.234', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', 80, '2026-05-25 21:36:10', 1),
(866, '180.243.209.157', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-05-25 21:38:09', 1),
(867, '158.140.173.123', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@polsri.student.ac.id', NULL, '2026-05-25 21:44:37', 0),
(868, '158.140.173.123', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@polsri.student.ac.id', NULL, '2026-05-25 21:48:24', 0),
(869, '114.10.98.230', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-25 22:12:38', 1),
(870, '114.10.98.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-25 22:37:12', 1),
(871, '180.254.167.157', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-25 22:46:01', 1),
(872, '103.111.100.11', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-05-25 22:50:59', 1),
(873, '125.167.57.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasafitri1204@gmail.com', NULL, '2026-05-25 23:16:56', 0),
(874, '125.167.57.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-05-25 23:17:32', 1),
(875, '182.1.233.217', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-25 23:30:01', 1),
(876, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-26 05:01:53', 1),
(877, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-26 07:11:45', 1),
(878, '114.10.98.152', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-05-26 07:18:08', 0),
(879, '114.10.98.152', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-26 07:18:16', 1),
(880, '114.10.99.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-05-26 10:15:40', 1),
(881, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-26 13:00:20', 1),
(882, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', 108, '2026-05-26 13:18:34', 1),
(883, '182.1.233.37', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-26 13:27:52', 1),
(884, '182.253.133.139', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-26 15:50:40', 1),
(885, '114.10.99.43', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-05-26 16:04:29', 1),
(886, '158.140.173.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', NULL, '2026-05-26 16:27:38', 0),
(887, '158.140.173.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', NULL, '2026-05-26 16:27:50', 0),
(888, '158.140.173.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', NULL, '2026-05-26 16:28:11', 0),
(889, '114.10.98.152', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-26 16:52:23', 1),
(890, '125.167.48.136', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-26 16:57:47', 1),
(891, '114.79.0.242', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-05-26 17:00:18', 1),
(892, '114.10.98.152', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-26 17:09:54', 1),
(893, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-26 17:33:27', 1),
(894, '158.140.173.78', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-26 20:56:32', 1),
(895, '125.167.50.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-26 22:20:22', 1),
(896, '158.140.173.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-05-26 23:05:44', 1),
(897, '180.254.174.188', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-27 01:14:56', 1),
(898, '10.88.5.40', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-27 08:15:35', 1),
(899, '101.128.104.131', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-27 13:17:52', 1),
(900, '36.70.52.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-27 17:22:59', 1),
(901, '182.1.239.147', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-05-27 17:27:15', 1),
(902, '180.254.175.104', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'email_password', 'marsya.00101@gmail.com', 98, '2026-05-27 17:54:36', 1),
(903, '114.10.98.181', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-27 19:27:31', 1),
(904, '103.189.207.171', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelinda467@gmal.com', NULL, '2026-05-27 20:16:21', 0),
(905, '103.189.207.171', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-27 20:16:51', 1),
(906, '103.111.100.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-27 22:34:25', 1),
(907, '125.167.51.126', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-05-28 15:35:04', 1),
(908, '36.77.162.94', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-05-28 17:38:13', 1),
(909, '114.79.7.205', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-05-28 19:42:08', 1),
(910, '103.111.100.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-05-28 20:35:54', 1),
(911, '125.167.50.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-28 23:01:56', 1),
(912, '103.111.100.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-05-29 12:28:32', 1),
(913, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-05-29 13:21:14', 0),
(914, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-05-29 13:21:29', 0),
(915, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-05-29 13:21:42', 0),
(916, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-29 13:21:51', 1),
(917, '9.154.222.33', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-05-29 13:29:31', 1),
(918, '182.1.231.76', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-29 15:10:35', 1),
(919, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-29 20:24:08', 1),
(920, '125.167.48.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', NULL, '2026-05-29 21:01:50', 0),
(921, '125.167.48.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-29 21:01:59', 1),
(922, '180.254.174.188', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-30 10:11:42', 1),
(923, '103.111.100.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-30 15:32:26', 1),
(924, '103.111.100.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-30 17:19:07', 1),
(925, '180.242.9.185', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'mfathir069@gmail.com', 106, '2026-05-30 17:45:01', 1),
(926, '180.242.9.185', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-05-30 21:44:31', 1),
(927, '103.111.100.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-05-30 22:04:37', 1),
(928, '10.88.5.12', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-05-31 08:19:16', 1),
(929, '182.1.228.86', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148 Version/11.1.1 Safari/605.1.15', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-31 08:32:45', 1),
(930, '158.140.173.20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-05-31 08:42:52', 1),
(931, '114.10.99.52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-31 09:25:03', 1),
(932, '103.189.207.228', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-05-31 11:58:46', 1),
(933, '114.10.98.251', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-05-31 13:46:27', 1),
(934, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-31 14:14:19', 1),
(935, '114.10.41.155', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-05-31 19:23:22', 1),
(936, '103.111.100.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-31 20:07:55', 1),
(937, '114.10.41.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'mfathir069@gmail.com', 106, '2026-05-31 20:19:51', 1),
(938, '103.111.100.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-05-31 21:46:27', 1),
(939, '182.1.228.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-05-31 21:59:00', 1),
(940, '112.215.50.90', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-05-31 22:10:56', 1),
(941, '103.111.100.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-05-31 22:32:47', 1),
(942, '114.10.99.52', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-05-31 23:56:31', 1),
(943, '114.10.41.155', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'mfathir069@gmail.com', 106, '2026-06-01 02:13:58', 1),
(944, '103.111.100.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-01 05:16:24', 1),
(945, '114.10.99.119', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-01 06:16:01', 1),
(946, '158.140.173.20', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 06:55:22', 1),
(947, '10.88.5.79', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-06-01 07:28:41', 1),
(948, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 11:59:00', 1),
(949, '103.111.100.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-01 13:38:40', 1),
(950, '114.10.99.47', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-06-01 14:30:41', 1),
(951, '114.10.98.216', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833326@student.polsri.ac.id', 84, '2026-06-01 14:30:55', 1),
(952, '36.77.165.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 14:34:43', 1),
(953, '114.10.99.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'reviewer@polsri.ac.id', NULL, '2026-06-01 14:43:03', 0),
(954, '114.10.99.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'reviewer@polsri.ac.id', NULL, '2026-06-01 14:43:12', 0),
(955, '114.10.99.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 14:43:16', 1),
(956, '114.10.99.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'reviewerpolsri@gmail.com', 115, '2026-06-01 14:45:29', 1),
(957, '114.79.6.83', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-06-01 14:51:48', 1),
(958, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'reviewerpolsri@gmail.com', 115, '2026-06-01 14:53:03', 1),
(959, '182.253.133.167', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-01 15:01:06', 1),
(960, '114.10.98.196', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-06-01 15:11:57', 1),
(961, '114.10.99.119', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-01 15:26:13', 1),
(962, '114.10.99.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 15:31:04', 1),
(963, '114.10.98.183', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@polsri.student.ac.id', NULL, '2026-06-01 15:39:28', 0),
(964, '114.10.98.183', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@polsri.student.ac.id', NULL, '2026-06-01 15:39:57', 0),
(965, '114.10.98.183', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@student.polsri.ac.id', 110, '2026-06-01 15:40:57', 1),
(966, '103.111.100.2', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-01 16:09:43', 1),
(967, '180.254.170.154', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-01 16:11:03', 1),
(968, '114.10.99.119', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-01 20:36:02', 0),
(969, '114.10.99.119', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-01 20:36:10', 1),
(970, '158.140.173.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 20:55:45', 1),
(971, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-01 21:16:51', 1),
(972, '103.189.207.228', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-06-01 21:19:32', 0),
(973, '103.189.207.228', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-06-01 21:20:14', 0),
(974, '103.189.207.228', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-01 21:20:36', 1),
(975, '10.84.46.96', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-06-02 08:44:57', 1),
(976, '10.84.60.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-06-02 08:48:39', 1),
(977, '114.10.99.26', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-02 10:23:02', 0),
(978, '114.10.99.26', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-02 10:23:36', 1),
(979, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 10:41:32', 1),
(980, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-06-02 10:41:39', 1),
(981, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 10:59:06', 1),
(982, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-02 11:22:53', 1),
(983, '10.84.73.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-02 11:30:57', 1),
(984, '103.111.100.7', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-06-02 13:15:30', 1),
(985, '101.128.109.20', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-06-02 13:43:09', 1),
(986, '10.88.5.12', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-06-02 13:45:19', 1),
(987, '158.140.173.6', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-02 13:48:48', 1),
(988, '180.254.170.154', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-02 14:02:20', 1),
(989, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 14:15:24', 1),
(990, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', 108, '2026-06-02 14:15:39', 1),
(991, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 14:16:06', 1),
(992, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 14:16:07', 1),
(993, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-02 14:16:35', 1),
(994, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 14:17:50', 1),
(995, '114.10.99.26', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-02 15:09:53', 1),
(996, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-02 16:45:16', 1),
(997, '10.84.92.231', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-02 17:26:18', 1),
(998, '158.140.173.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-03 07:58:44', 1),
(999, '114.10.99.50', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-03 08:51:00', 1),
(1000, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-03 09:45:34', 1),
(1001, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-03 10:56:20', 1),
(1002, '36.77.162.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-03 11:01:42', 1),
(1003, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'reviewerpolsri@gmail.com', 115, '2026-06-03 11:04:28', 1),
(1004, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', NULL, '2026-06-03 11:06:30', 0),
(1005, '114.10.98.245', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-03 11:14:22', 1),
(1006, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-03 11:15:33', 1),
(1007, '114.10.98.245', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-03 11:30:58', 1),
(1008, '114.125.239.103', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-06-03 15:05:26', 1),
(1009, '114.10.99.109', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-06-03 15:06:16', 1),
(1010, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai_pmw_polsri@gmail.com', 116, '2026-06-03 18:04:26', 1),
(1011, '158.140.173.59', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-06-03 21:23:12', 1),
(1012, '180.254.160.207', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-03 22:10:00', 1),
(1013, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-03 23:32:53', 1),
(1014, '114.10.99.83', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-04 06:17:41', 1),
(1015, '10.84.47.18', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-06-04 07:15:02', 1),
(1016, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 11:20:49', 1),
(1017, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'combetohct@yahoo.com', 81, '2026-06-04 11:30:02', 1),
(1018, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 11:32:39', 1),
(1019, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 11:47:21', 1),
(1020, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 11:48:08', 1),
(1021, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri1@gmail.com', 117, '2026-06-04 11:55:20', 1),
(1022, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 11:57:35', 1),
(1023, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri1@gmail.com', 117, '2026-06-04 11:58:30', 1),
(1024, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri2@gmail.com', 118, '2026-06-04 12:09:28', 1),
(1025, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri3@gmail.com', NULL, '2026-06-04 12:10:13', 0),
(1026, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri3@gmail.com', NULL, '2026-06-04 12:10:17', 0),
(1027, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'juri4@gmail.com', NULL, '2026-06-04 12:10:24', 0),
(1028, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:10:33', 1),
(1029, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'jurithree@gmail.com', 119, '2026-06-04 12:11:14', 1),
(1030, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'jurifour@gmail.com', 120, '2026-06-04 12:11:39', 1),
(1031, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:12:03', 1),
(1032, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 12:36:18', 1),
(1033, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:44:03', 1),
(1034, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 12:45:46', 1),
(1035, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 12:45:49', 1),
(1036, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:46:45', 1),
(1037, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:48:30', 1),
(1038, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'jurifive@gmail.com', 121, '2026-06-04 12:48:46', 1),
(1039, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:49:37', 1),
(1040, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:52:04', 1),
(1041, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:54:45', 1),
(1042, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 12:54:51', 1),
(1043, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'jurifive@gmail.com', 121, '2026-06-04 12:55:36', 1),
(1044, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', 108, '2026-06-04 12:56:06', 1),
(1045, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:56:46', 1),
(1046, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', 108, '2026-06-04 12:57:13', 1),
(1047, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:57:30', 1),
(1048, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 12:57:54', 1),
(1049, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'darknessking@gmail.com', 122, '2026-06-04 12:58:03', 1),
(1050, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'juri1@gmail.com', 117, '2026-06-04 13:01:11', 1),
(1051, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 13:05:05', 1),
(1052, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', 108, '2026-06-04 13:08:20', 1),
(1053, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 13:08:56', 1),
(1054, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 13:10:02', 1),
(1055, '10.84.124.130', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-04 13:50:33', 1),
(1056, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-04 15:25:43', 1),
(1057, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-04 15:44:41', 1),
(1058, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai333@gmail.com', 125, '2026-06-04 15:54:45', 1),
(1059, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai111@gmail.com', 123, '2026-06-04 15:55:08', 1),
(1060, '157.15.47.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-04 18:58:55', 1),
(1061, '114.79.3.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-04 19:34:54', 1),
(1062, '180.254.160.207', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-04 21:14:51', 1),
(1063, '118.99.94.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-05 09:48:16', 1),
(1064, '180.254.175.149', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'davinaramadhani06@gmail.com', 76, '2026-06-05 11:32:28', 1),
(1065, '114.10.99.112', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-06-05 11:36:55', 1),
(1066, '10.84.128.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-05 13:53:34', 1),
(1067, '10.84.56.184', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-05 13:56:50', 1),
(1068, '182.1.238.150', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'fungsional08@gmail.com', 129, '2026-06-05 15:07:49', 1),
(1069, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-05 17:35:22', 1),
(1070, '112.215.19.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'meliachya@gmail.com', 104, '2026-06-05 19:21:15', 1),
(1071, '101.128.109.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-06-05 19:36:44', 1),
(1072, '36.76.175.78', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'fungsional08@gmail.com', 129, '2026-06-05 19:45:14', 1),
(1073, '114.10.43.239', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai444@gmail.com', 126, '2026-06-05 19:59:30', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1074, '182.1.236.173', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/423.5.920392540 Mobile/15E148 Safari/604.1', 'email_password', 'Fungsional08@gmail.com', 129, '2026-06-05 20:21:18', 1),
(1075, '9.154.222.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-05 20:41:02', 1),
(1076, '101.128.104.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-05 20:56:12', 1),
(1077, '182.1.234.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'Penilai666@gmail.com', 128, '2026-06-05 21:54:10', 1),
(1078, '182.1.234.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-05 22:11:23', 1),
(1079, '103.111.98.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-05 22:20:24', 1),
(1080, '182.1.234.118', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-05 22:58:33', 1),
(1081, '10.88.5.12', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-06-05 23:58:52', 1),
(1082, '182.1.235.220', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/423.5.920392540 Mobile/15E148 Safari/604.1', 'email_password', 'Fungsional08@gmail.com', 129, '2026-06-06 07:18:57', 1),
(1083, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 08:22:23', 1),
(1084, '101.128.108.48', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.5 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-06 08:36:50', 1),
(1085, '128.1.227.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai111@gmail.com', 123, '2026-06-06 08:37:07', 1),
(1086, '101.128.108.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36 Avast/122.0.0.0', 'email_password', 'penilai666@gmail.com', 128, '2026-06-06 08:41:07', 1),
(1087, '9.154.222.2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'Penilai222@gmail.com', 124, '2026-06-06 08:43:06', 1),
(1088, '128.1.227.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'penilai111@gmail.com', 123, '2026-06-06 09:17:44', 1),
(1089, '158.140.173.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai222@gmail.com', 124, '2026-06-06 09:52:44', 1),
(1090, '182.253.133.172', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai444@gmail.com', 126, '2026-06-06 10:30:00', 1),
(1091, '114.79.1.201', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai555@gmail.com', 127, '2026-06-06 10:46:05', 1),
(1092, '182.1.239.56', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'Penilai333@gmail.com', NULL, '2026-06-06 10:54:15', 0),
(1093, '182.1.239.56', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'Penilai333@gmail.com', NULL, '2026-06-06 10:54:21', 0),
(1094, '182.1.239.56', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'Penilai333@gmail.com', 125, '2026-06-06 10:55:00', 1),
(1095, '158.140.173.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 11:48:01', 1),
(1096, '114.79.0.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-06 12:09:58', 1),
(1097, '114.10.99.39', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'risaoktapiaa@gmail.com', 75, '2026-06-06 12:53:09', 1),
(1098, '36.77.170.21', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-06-06 13:34:37', 0),
(1099, '36.77.170.21', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-06-06 13:34:54', 1),
(1100, '101.128.109.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-06-06 13:35:17', 1),
(1101, '140.213.233.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-06 13:43:58', 1),
(1102, '182.1.228.143', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', NULL, '2026-06-06 14:03:44', 0),
(1103, '114.79.0.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-06 14:05:04', 1),
(1104, '182.1.228.143', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-06 14:05:25', 1),
(1105, '158.140.173.13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 14:33:26', 1),
(1106, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 15:10:19', 1),
(1107, '182.1.229.142', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai555@gmail.com', 127, '2026-06-06 15:15:11', 1),
(1108, '114.79.0.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-06 15:25:52', 1),
(1109, '9.154.222.15', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-06-06 15:48:13', 1),
(1110, '158.140.173.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833334@student.polsri.ac.id', NULL, '2026-06-06 15:54:17', 0),
(1111, '158.140.173.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833329@student.polsri.ac.id', 110, '2026-06-06 15:54:20', 1),
(1112, '158.140.173.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-06-06 15:55:04', 1),
(1113, '158.140.173.8', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-06-06 15:56:39', 1),
(1114, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:04:47', 0),
(1115, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:04:59', 0),
(1116, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:05:12', 0),
(1117, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:05:19', 0),
(1118, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:06:30', 0),
(1119, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:06:37', 0),
(1120, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:07:05', 0),
(1121, '9.154.222.15', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:07:17', 0),
(1122, '114.10.98.56', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-06-06 16:07:23', 1),
(1123, '36.70.60.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'email_password', 'akbarcool998@gmail.com', 79, '2026-06-06 16:08:30', 1),
(1124, '36.70.60.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'email_password', 'akbarcool998@gmail.com', 79, '2026-06-06 16:08:30', 1),
(1125, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:08:50', 0),
(1126, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:08:59', 0),
(1127, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:09:06', 0),
(1128, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:09:20', 0),
(1129, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:09:37', 0),
(1130, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:09:45', 0),
(1131, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:09:54', 0),
(1132, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:10:10', 0),
(1133, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:10:24', 0),
(1134, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:14:19', 0),
(1135, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:15:01', 0),
(1136, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:15:22', 0),
(1137, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:15:35', 0),
(1138, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:15:48', 0),
(1139, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:16:01', 0),
(1140, '125.167.57.7', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', '062440833327@student.polsri.ac.id', NULL, '2026-06-06 16:16:05', 0),
(1141, '125.167.57.7', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', '062440833327@student.polsri.ac.id', NULL, '2026-06-06 16:16:11', 0),
(1142, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:16:17', 0),
(1143, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:16:30', 0),
(1144, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', NULL, '2026-06-06 16:16:51', 0),
(1145, '9.154.222.15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', '062440833332@student.polsri.ac.id', 93, '2026-06-06 16:17:03', 1),
(1146, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/23F77 Instagram 432.0.0.27.62 (iPhone15,4; iOS 26_5; id_ID; id; scale=3.00; 1179x2556; IABMV/1; 983743279) Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-06 16:20:58', 1),
(1147, '36.70.60.188', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-06-06 16:24:13', 1),
(1148, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-06-06 16:32:08', 0),
(1149, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/148.0.7778.166 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-06 16:32:19', 1),
(1150, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-06-06 16:32:22', 0),
(1151, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-06-06 16:32:29', 0),
(1152, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-06-06 16:32:46', 0),
(1153, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', NULL, '2026-06-06 16:32:54', 0),
(1154, '114.10.99.241', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833323@student.polsri.ac.id', 80, '2026-06-06 16:33:02', 1),
(1155, '180.243.52.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 16:39:53', 1),
(1156, '101.128.108.218', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-06 17:48:26', 1),
(1157, '9.154.222.16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-06-06 18:10:24', 1),
(1158, '114.10.99.85', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-06 18:15:01', 0),
(1159, '114.10.99.85', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-06 18:15:08', 1),
(1160, '114.125.239.72', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-06-06 18:19:04', 1),
(1161, '114.10.98.239', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'davinaramadhani06@gmail.com', 76, '2026-06-06 18:59:06', 1),
(1162, '103.165.236.106', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-06 19:00:40', 1),
(1163, '114.79.5.170', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'Chaniaputrii06@gmail.com', 57, '2026-06-06 19:01:10', 1),
(1164, '36.76.200.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/403.0.853868894 Mobile/15E148 Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-06 19:03:43', 1),
(1165, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-06 21:01:48', 1),
(1166, '125.167.59.211', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', NULL, '2026-06-06 21:36:46', 0),
(1167, '125.167.59.211', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-06 21:37:15', 1),
(1168, '101.128.108.218', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-06 21:37:31', 1),
(1169, '103.111.98.104', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-06 21:44:47', 1),
(1170, '180.254.168.169', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-06-06 22:06:34', 1),
(1171, '101.128.104.147', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-06 22:08:56', 1),
(1172, '36.77.80.208', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-06 22:12:47', 1),
(1173, '158.140.173.43', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-06 22:14:14', 1),
(1174, '103.111.98.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-06 22:34:45', 1),
(1175, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-06 22:40:21', 1),
(1176, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-06-06 23:19:54', 0),
(1177, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-06-06 23:20:07', 0),
(1178, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-06 23:20:29', 1),
(1179, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-06 23:24:33', 1),
(1180, '112.215.19.97', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-06 23:30:53', 1),
(1181, '182.1.238.196', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-07 00:00:40', 1),
(1182, '101.128.108.14', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-06-07 00:07:29', 1),
(1183, '114.125.251.73', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'meliachya@gmail.com', 104, '2026-06-07 00:33:56', 1),
(1184, '9.154.222.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-07 03:30:27', 1),
(1185, '125.167.58.93', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-07 04:32:18', 1),
(1186, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 04:57:08', 1),
(1187, '103.111.98.105', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-07 05:01:24', 1),
(1188, '125.167.59.211', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-07 05:56:20', 1),
(1189, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', NULL, '2026-06-07 06:04:09', 0),
(1190, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-07 06:04:19', 1),
(1191, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-07 06:16:37', 1),
(1192, '9.154.222.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-06-07 07:05:49', 1),
(1193, '101.128.108.130', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.2 Mobile/15E148 Safari/604.1', 'email_password', 'mridhoapriliadi0@gmail.com', 100, '2026-06-07 07:07:06', 1),
(1194, '125.167.58.93', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-07 07:57:19', 1),
(1195, '9.154.222.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-07 07:57:47', 1),
(1196, '182.1.228.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_6_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.6 Mobile/15E148 Safari/604.1', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-06-07 08:11:26', 1),
(1197, '9.154.222.17', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/30.0 Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'tesalonikacfe46@gmail.com', 101, '2026-06-07 08:22:51', 1),
(1198, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-07 08:43:12', 1),
(1199, '9.154.222.16', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-06-07 08:47:16', 1),
(1200, '182.1.235.8', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-07 09:25:26', 1),
(1201, '110.137.126.181', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'newerarah@gmail.com', NULL, '2026-06-07 09:41:45', 0),
(1202, '110.137.126.181', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'newerarah@gmail.com', NULL, '2026-06-07 09:42:13', 0),
(1203, '110.137.126.181', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-06-07 09:42:45', 1),
(1204, '101.128.109.198', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Mobile Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-06-07 09:48:16', 1),
(1205, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-07 10:00:41', 0),
(1206, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-07 10:00:48', 1),
(1207, '101.128.109.90', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_3_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.3.1 Mobile/15E148 Safari/604.1', 'email_password', 'mozaslavina@gmail.com', 91, '2026-06-07 10:02:59', 1),
(1208, '119.235.212.175', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'naninajae@gmail.com', 105, '2026-06-07 10:09:23', 1),
(1209, '9.154.222.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'ciciagustinaputri525@gmail.com', 92, '2026-06-07 10:33:03', 1),
(1210, '101.128.108.14', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', NULL, '2026-06-07 10:36:01', 0),
(1211, '101.128.108.14', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Mobile Safari/537.36', 'email_password', 'marsya.00101@gmail.com', 98, '2026-06-07 10:36:53', 1),
(1212, '9.154.222.24', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-07 10:43:03', 1),
(1213, '9.154.222.23', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-07 10:45:15', 1),
(1214, '180.254.169.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'hassanjankhan19@gmail.com', 103, '2026-06-07 11:23:32', 1),
(1215, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-07 12:33:52', 0),
(1216, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-07 12:34:06', 1),
(1217, '114.10.99.206', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-07 13:27:52', 1),
(1218, '158.140.173.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-07 13:40:11', 1),
(1219, '9.154.222.16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'tianiusds@gmail.com', 107, '2026-06-07 13:48:54', 1),
(1220, '158.140.173.13', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-07 13:51:29', 1),
(1221, '182.1.229.133', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-07 14:05:05', 1),
(1222, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:15:40', 1),
(1223, '182.1.231.125', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/423.5.920392540 Mobile/15E148 Safari/604.1', 'email_password', 'Fungsional08@gmail.com', 129, '2026-06-07 14:17:26', 1),
(1224, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:18:53', 1),
(1225, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:26:20', 1),
(1226, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:27:18', 1),
(1227, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:27:50', 1),
(1228, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 14:33:02', 1),
(1229, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-07 14:47:34', 1),
(1230, '114.125.238.143', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-07 14:53:46', 1),
(1231, '114.125.238.143', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-07 14:53:46', 1),
(1232, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 15:03:08', 1),
(1233, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai333@gmail.com', 125, '2026-06-07 15:08:17', 1),
(1234, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'Penilai666@gmail.com', 128, '2026-06-07 15:09:12', 1),
(1235, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 15:11:49', 1),
(1236, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai666@gmail.com', 128, '2026-06-07 15:16:43', 1),
(1237, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai555@gmail.com', 127, '2026-06-07 15:20:09', 1),
(1238, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 15:28:03', 1),
(1239, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-07 16:42:39', 1),
(1240, '125.167.58.93', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-07 16:51:35', 1),
(1241, '114.10.99.22', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/403.0.853868894 Mobile/15E148 Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-07 18:03:19', 1),
(1242, '9.154.222.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', NULL, '2026-06-07 18:51:45', 0),
(1243, '9.154.222.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'khaillaanastya@gmail.com', 74, '2026-06-07 18:52:07', 1),
(1244, '182.1.238.196', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-07 19:00:25', 1),
(1245, '125.167.59.211', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-07 19:05:41', 1),
(1246, '114.10.98.179', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-07 19:17:51', 1),
(1247, '114.10.99.84', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-07 20:12:24', 1),
(1248, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-07 21:14:51', 1),
(1249, '36.70.60.188', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', '062440833330@student.polsri.ac.id', 78, '2026-06-07 21:22:29', 1),
(1250, '158.140.173.46', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'email_password', '062440833332@student.polsri.ac.id', 93, '2026-06-07 21:25:32', 1),
(1251, '125.167.51.126', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'k4rn0tr1y4d1@gmail.com', 71, '2026-06-07 21:29:10', 1),
(1252, '180.249.245.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-06-07 21:30:36', 1),
(1253, '158.140.173.45', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-07 21:59:23', 1),
(1254, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-07 22:04:00', 1),
(1255, '125.167.58.93', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-07 23:16:01', 1),
(1256, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-08 06:29:42', 0),
(1257, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-08 06:29:54', 0),
(1258, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-08 06:30:26', 0),
(1259, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-08 06:30:41', 0),
(1260, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-08 06:30:47', 1),
(1261, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.con', NULL, '2026-06-08 07:31:17', 0),
(1262, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-08 07:31:25', 1),
(1263, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 09:44:07', 1),
(1264, '114.10.99.63', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-08 09:57:00', 1),
(1265, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-08 09:58:44', 0),
(1266, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-08 09:58:51', 1),
(1267, '114.125.239.245', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-08 09:59:59', 1),
(1268, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.con', NULL, '2026-06-08 10:29:17', 0),
(1269, '180.254.167.210', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-08 10:29:33', 1),
(1270, '114.125.238.191', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/23F77 Instagram 432.0.0.27.62 (iPhone17,1; iOS 26_5; en_US; en; scale=3.00; 1206x2622; IABMV/1; 983743279) Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-06-08 10:46:42', 1),
(1271, '158.140.173.59', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'houseoflytheros@gmail.com', 99, '2026-06-08 10:50:00', 1),
(1272, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 11:12:28', 1),
(1273, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 11:14:50', 1),
(1274, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-08 11:19:15', 0),
(1275, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-08 11:19:24', 0),
(1276, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-08 11:19:44', 0),
(1277, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 11:19:50', 1),
(1278, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-08 11:21:28', 1),
(1279, '110.137.129.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-08 11:22:54', 1),
(1280, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'test@gmail.com', NULL, '2026-06-08 11:25:42', 0),
(1281, '114.79.0.71', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7.6 Mobile/15E148 Safari/604.1', 'email_password', '062440833336@student.polsri.ac.id', 94, '2026-06-08 11:32:14', 1),
(1282, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 14:32:40', 1),
(1283, '36.77.162.95', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'melinasftr1204@gmail.com', 51, '2026-06-08 14:48:25', 1),
(1284, '110.137.129.202', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-08 16:07:24', 1),
(1285, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 17:47:35', 1),
(1286, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-08 17:49:24', 1),
(1287, '36.69.62.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-08 18:02:06', 1),
(1288, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 18:21:10', 1),
(1289, '114.10.98.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-08 20:12:23', 1),
(1290, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 20:30:55', 1),
(1291, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 20:35:25', 1),
(1292, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-08 21:07:18', 1),
(1293, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 21:15:04', 1),
(1294, '9.154.222.9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-08 21:20:36', 1),
(1295, '118.99.94.197', 'Mozilla/5.0 (X11; Linux x86_64; rv:151.0) Gecko/20100101 Firefox/151.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-08 22:40:39', 1),
(1296, '158.140.173.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-09 06:21:36', 1),
(1297, '158.140.173.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-09 06:27:07', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1298, '158.140.173.30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-09 06:27:47', 1),
(1299, '114.10.98.235', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-09 07:29:39', 1),
(1300, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-09 08:07:44', 1),
(1301, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-09 09:14:27', 1),
(1302, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-09 10:10:44', 1),
(1303, '180.254.175.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-09 10:16:40', 1),
(1304, '125.167.56.20', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-09 12:43:53', 1),
(1305, '103.111.98.105', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-09 13:05:35', 1),
(1306, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-09 13:37:11', 1),
(1307, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-09 14:52:20', 1),
(1308, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'Penilai@gmail.com', 130, '2026-06-09 14:59:35', 1),
(1309, '182.1.237.142', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-09 15:08:52', 1),
(1310, '10.84.139.163', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', NULL, '2026-06-09 15:51:06', 0),
(1311, '10.84.139.163', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-09 15:51:36', 1),
(1312, '125.167.56.20', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-09 15:55:13', 1),
(1313, '114.10.98.235', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-09 15:58:46', 1),
(1314, '114.10.99.65', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', NULL, '2026-06-09 16:12:10', 0),
(1315, '114.10.99.65', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-09 16:12:30', 1),
(1316, '158.140.173.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@polsri.student.ac.id', NULL, '2026-06-09 17:55:30', 0),
(1317, '158.140.173.28', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', '062440833329@student.polsri.ac.id', 110, '2026-06-09 17:56:08', 1),
(1318, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-09 20:19:19', 1),
(1319, '140.213.232.216', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'Chaniaputrii06@gmail.com', 57, '2026-06-09 20:26:15', 1),
(1320, '36.76.200.106', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/403.0.853868894 Mobile/15E148 Safari/604.1', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-09 20:29:20', 1),
(1321, '36.76.199.88', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-09 20:36:23', 1),
(1322, '180.254.175.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-09 20:57:31', 1),
(1323, '103.111.98.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-09 22:02:47', 1),
(1324, '114.10.98.235', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-09 22:34:52', 0),
(1325, '114.10.98.235', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-09 22:35:01', 1),
(1326, '101.128.108.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-09 23:28:57', 1),
(1327, '180.254.175.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-10 00:42:13', 1),
(1328, '114.10.99.37', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', NULL, '2026-06-10 05:55:53', 0),
(1329, '114.10.99.37', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-10 05:56:25', 1),
(1330, '180.254.175.253', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-10 08:04:27', 1),
(1331, '114.10.99.37', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-10 08:52:02', 1),
(1332, '10.84.195.52', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/23F77 Instagram 432.0.0.27.62 (iPhone17,1; iOS 26_5; id_ID; id; scale=3.00; 1206x2622; IABMV/1; 983743279) Safari/604.1', 'email_password', 'rarahnewe@gmail.com', 102, '2026-06-10 09:17:06', 1),
(1333, '103.111.98.105', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-10 09:17:42', 1),
(1334, '36.76.199.88', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-06-10 09:22:07', 0),
(1335, '36.76.199.88', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-10 09:23:16', 1),
(1336, '36.76.199.88', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-06-10 09:24:48', 0),
(1337, '36.76.199.88', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-10 09:25:28', 1),
(1338, '114.10.98.53', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-10 10:48:02', 1),
(1339, '10.84.137.29', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-10 11:10:32', 1),
(1340, '10.84.47.96', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-10 12:18:11', 1),
(1341, '182.1.237.156', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36', 'email_password', 'kholilahfitri4@gmail.com', 83, '2026-06-10 12:32:10', 1),
(1342, '10.84.210.161', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-10 13:26:46', 1),
(1343, '10.84.100.22', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-10 14:08:52', 1),
(1344, '114.10.99.39', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-10 14:10:40', 1),
(1345, '10.84.211.223', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-10 14:57:58', 1),
(1346, '119.235.212.176', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-10 17:32:13', 1),
(1347, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-10 19:10:49', 1),
(1348, '140.213.76.70', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-10 19:14:37', 1),
(1349, '114.10.99.39', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-10 19:48:29', 1),
(1350, '114.125.238.35', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-10 20:14:20', 1),
(1351, '36.77.162.237', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-10 20:22:15', 1),
(1352, '103.111.98.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-10 21:30:11', 1),
(1353, '114.10.99.39', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-10 22:47:47', 1),
(1354, '182.253.133.175', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-11 09:25:44', 1),
(1355, '10.84.80.202', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-11 14:06:53', 1),
(1356, '182.1.230.94', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-11 14:56:05', 1),
(1357, '125.167.56.162', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-11 15:12:50', 1),
(1358, '114.10.98.244', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-11 19:31:05', 1),
(1359, '114.10.98.244', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-11 23:32:41', 1),
(1360, '114.10.99.73', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-12 06:12:26', 1),
(1361, '10.84.227.240', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-12 07:59:58', 1),
(1362, '182.1.232.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', NULL, '2026-06-12 12:10:49', 0),
(1363, '182.1.232.227', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.45 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-12 12:10:56', 1),
(1364, '10.84.213.165', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-12 13:35:25', 1),
(1365, '10.84.243.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-12 13:49:53', 1),
(1366, '10.84.89.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-12 14:16:01', 1),
(1367, '158.140.173.10', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-12 15:27:55', 1),
(1368, '114.10.99.73', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-12 15:50:10', 1),
(1369, '10.84.250.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-12 16:21:51', 1),
(1370, '10.84.250.78', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-12 16:24:38', 1),
(1371, '158.140.173.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-12 19:22:34', 1),
(1372, '114.10.98.224', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-13 06:12:47', 1),
(1373, '180.242.1.233', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-13 09:42:29', 1),
(1374, '158.140.173.62', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-13 11:39:48', 1),
(1375, '114.10.43.71', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Mobile Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-06-13 17:21:49', 1),
(1376, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-13 17:41:28', 1),
(1377, '103.111.98.105', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-13 21:39:48', 1),
(1378, '103.111.98.105', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-14 10:05:30', 1),
(1379, '114.10.98.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-14 14:41:27', 1),
(1380, '158.140.173.10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-14 18:23:43', 1),
(1381, '180.242.42.107', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-14 19:37:20', 1),
(1382, '157.15.47.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-15 00:32:37', 1),
(1383, '101.128.109.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-15 15:14:43', 1),
(1384, '10.84.34.218', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-15 16:15:57', 1),
(1385, '36.77.142.201', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-06-15 19:00:41', 1),
(1386, '36.76.238.250', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-16 08:09:51', 1),
(1387, '114.10.98.128', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'msatriaws@gmail.com', 48, '2026-06-16 18:59:17', 1),
(1388, '9.154.222.21', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-16 19:11:21', 1),
(1389, '36.69.49.3', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-17 05:54:47', 1),
(1390, '10.84.227.240', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-17 09:31:03', 1),
(1391, '36.69.49.3', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-17 13:25:44', 1),
(1392, '10.84.60.71', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-17 13:30:15', 1),
(1393, '158.140.173.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-18 09:57:03', 1),
(1394, '10.84.243.44', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-18 11:05:57', 1),
(1395, '36.68.9.73', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', '062440833334@student.polsri.ac.id', 90, '2026-06-18 13:10:53', 1),
(1396, '112.215.50.248', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', NULL, '2026-06-18 13:52:30', 0),
(1397, '112.215.50.248', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-18 13:53:02', 1),
(1398, '101.128.109.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.1 Mobile/15E148 Safari/604.1', 'email_password', 'penilai666@gmail.com', 128, '2026-06-18 14:11:31', 1),
(1399, '182.1.233.129', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-18 14:34:09', 1),
(1400, '36.68.8.204', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-18 15:01:27', 1),
(1401, '10.84.180.72', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-06-18 15:41:03', 1),
(1402, '10.84.84.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-06-18 15:42:13', 1),
(1403, '158.140.173.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-18 16:08:38', 1),
(1404, '114.10.99.214', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-18 16:49:03', 1),
(1405, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammdriizkyy4@gmail.com', NULL, '2026-06-18 17:37:51', 0),
(1406, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammdriizkyy4@gmail.com', NULL, '2026-06-18 17:38:02', 0),
(1407, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammdriizkyy4@gmail.com', NULL, '2026-06-18 17:38:16', 0),
(1408, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammdriizkyy4@gmail.com', NULL, '2026-06-18 17:38:23', 0),
(1409, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammdriizkyy4@gmail.com', NULL, '2026-06-18 17:38:31', 0),
(1410, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy@gmail.com', NULL, '2026-06-18 17:39:03', 0),
(1411, '10.84.27.168', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-18 17:39:20', 1),
(1412, '172.225.78.203', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-18 17:40:39', 1),
(1413, '101.128.104.53', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-18 18:10:22', 1),
(1414, '114.10.99.214', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-18 20:36:19', 1),
(1415, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-19 08:16:00', 1),
(1416, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-19 08:18:46', 1),
(1417, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-06-19 08:20:14', 1),
(1418, '158.140.165.11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-20 06:11:05', 1),
(1419, '182.1.232.2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-20 09:46:33', 1),
(1420, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-20 10:48:11', 1),
(1421, '36.77.166.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-20 14:06:31', 1),
(1422, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-06-20 17:48:57', 0),
(1423, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', NULL, '2026-06-20 17:49:11', 0),
(1424, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-20 17:58:43', 1),
(1425, '110.137.125.38', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-21 19:03:03', 1),
(1426, '104.28.121.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-22 09:17:39', 1),
(1427, '104.28.121.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-22 09:17:40', 1),
(1428, '104.28.121.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-22 09:17:40', 1),
(1429, '118.99.94.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-22 09:41:20', 1),
(1430, '110.137.125.38', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-22 11:38:32', 1),
(1431, '158.140.165.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-22 20:11:47', 1),
(1432, '180.242.1.151', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-23 13:54:05', 1),
(1433, '119.235.212.26', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-23 19:37:34', 1),
(1434, '118.99.94.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-24 00:23:55', 1),
(1435, '103.111.98.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-24 00:49:04', 1),
(1436, '182.9.49.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'admin@gmail.com', NULL, '2026-06-24 01:47:03', 0),
(1437, '182.9.49.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'edwin.frymaruwah@polsri.ac.id', NULL, '2026-06-24 01:47:10', 0),
(1438, '182.9.49.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'spi@polsri.ac.id', NULL, '2026-06-24 01:47:15', 0),
(1439, '182.9.49.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'email_password', 'combetohct@yahoo.com', NULL, '2026-06-24 01:47:21', 0),
(1440, '114.10.99.43', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-24 09:46:12', 1),
(1441, '125.167.51.62', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', NULL, '2026-06-24 09:49:37', 0),
(1442, '125.167.51.62', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-06-24 09:49:57', 1),
(1443, '10.84.89.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-06-24 09:53:28', 1),
(1444, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-24 11:30:17', 1),
(1445, '180.242.9.62', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-24 14:21:47', 1),
(1446, '180.242.9.62', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-24 18:55:42', 1),
(1447, '180.242.9.62', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-24 19:00:43', 1),
(1448, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-24 19:17:27', 1),
(1449, '157.15.47.56', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-24 23:08:09', 1),
(1450, '158.140.165.22', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-06-24 23:18:54', 1),
(1451, '114.10.135.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-25 04:16:10', 0),
(1452, '114.10.135.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-25 04:16:11', 0),
(1453, '114.10.135.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', NULL, '2026-06-25 04:16:11', 0),
(1454, '101.128.108.189', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rizka03rd@gmail.com', 95, '2026-06-25 19:48:18', 1),
(1455, '140.213.185.248', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-25 21:52:33', 1),
(1456, '10.84.153.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', NULL, '2026-06-26 13:10:36', 0),
(1457, '10.84.153.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', NULL, '2026-06-26 13:10:58', 0),
(1458, '10.84.153.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', NULL, '2026-06-26 13:11:26', 0),
(1459, '10.84.153.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-06-26 13:11:36', 1),
(1460, '10.84.173.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-06-26 14:48:48', 1),
(1461, '158.140.173.127', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-27 15:33:52', 1),
(1462, '158.140.173.114', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-28 18:15:43', 1),
(1463, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-28 19:02:38', 1),
(1464, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-28 20:34:16', 1),
(1465, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-06-28 20:44:51', 1),
(1466, '101.128.104.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-28 21:11:16', 1),
(1467, '158.140.173.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-06-28 23:16:35', 1),
(1468, '103.67.47.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-29 00:53:44', 1),
(1469, '103.67.47.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-29 10:42:01', 1),
(1470, '10.84.188.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-06-29 14:58:32', 1),
(1471, '103.67.47.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-06-29 22:24:19', 1),
(1472, '157.15.47.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-06-30 02:51:01', 1),
(1473, '140.213.230.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-06-30 11:17:51', 1),
(1474, '36.70.55.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'k4rn0tr1y4d1@gmail.com', 71, '2026-07-01 09:09:34', 1),
(1475, '114.10.99.71', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-01 12:37:56', 1),
(1476, '36.69.61.195', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-01 14:17:46', 1),
(1477, '158.140.165.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-01 18:27:14', 1),
(1478, '158.140.165.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-02 07:05:29', 1),
(1479, '110.137.165.205', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'rakameidiansyah67@gmail.com', 50, '2026-07-02 18:09:21', 1),
(1480, '158.140.173.115', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-02 22:06:48', 1),
(1481, '182.1.233.226', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-03 18:00:44', 1),
(1482, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-04 08:29:21', 1),
(1483, '36.70.54.192', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'email_password', 'akbarcool998@gmail.com', 79, '2026-07-04 16:54:23', 1),
(1484, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-05 02:39:28', 1),
(1485, '180.242.14.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'CHANIAPUTRII06@GMAIL.COM', 57, '2026-07-06 16:32:32', 1),
(1486, '101.128.104.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-07-06 18:17:18', 0),
(1487, '101.128.104.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-06 18:17:50', 1),
(1488, '125.167.57.251', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/149.0.7827.137 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-06 18:52:04', 1),
(1489, '158.140.173.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-07 13:41:27', 1),
(1490, '158.140.173.66', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-07 21:41:09', 1),
(1491, '10.84.206.191', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-08 10:38:17', 1),
(1492, '10.84.182.15', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-10 14:49:02', 1),
(1493, '103.171.30.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-10 16:43:37', 1),
(1494, '103.67.47.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-10 20:26:17', 1),
(1495, '103.67.47.57', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-10 20:34:35', 1),
(1496, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-07-10 20:40:52', 0),
(1497, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-07-10 20:41:27', 0),
(1498, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-07-10 20:41:59', 0),
(1499, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-07-10 20:42:30', 0),
(1500, '103.67.47.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-10 20:43:31', 1),
(1501, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.com', NULL, '2026-07-10 20:43:44', 0),
(1502, '158.140.173.74', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-10 20:44:37', 1),
(1503, '158.140.165.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-10 22:06:30', 1),
(1504, '103.67.47.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', NULL, '2026-07-10 22:49:52', 0),
(1505, '103.67.47.57', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', NULL, '2026-07-10 22:50:06', 0),
(1506, '182.1.238.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-11 08:02:04', 1),
(1507, '158.140.165.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'Chaniaputrii06@gmail.com', 57, '2026-07-11 17:28:43', 1),
(1508, '158.140.165.10', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-11 19:06:31', 1),
(1509, '101.128.104.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-12 10:07:14', 1),
(1510, '114.125.239.201', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'Chaniaputrii06@gmail.com', 57, '2026-07-12 18:44:58', 1),
(1511, '112.215.50.44', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-12 18:55:01', 1),
(1512, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-13 08:47:02', 1),
(1513, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-13 22:10:05', 1),
(1514, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-14 09:22:27', 1),
(1515, '149.88.103.49', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-14 16:08:57', 1),
(1516, '182.1.228.41', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-14 18:25:17', 1),
(1517, '114.10.99.177', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'budi@gmail.com', NULL, '2026-07-14 23:05:07', 0),
(1518, '119.235.212.198', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-15 19:15:16', 1),
(1519, '114.10.99.230', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-16 12:49:52', 1),
(1520, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-16 13:09:32', 1),
(1521, '10.84.23.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-16 13:43:39', 1),
(1522, '158.140.173.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-16 13:50:30', 1),
(1523, '103.189.207.166', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'email_password', 'intanbelindaaa2@gmal.com', 70, '2026-07-16 13:56:16', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1524, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-17 07:05:44', 1),
(1525, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-17 07:07:01', 1),
(1526, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-17 07:07:27', 1),
(1527, '10.84.23.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-17 10:19:18', 1),
(1528, '157.15.47.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-17 10:32:12', 1),
(1529, '157.15.47.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-17 18:49:45', 1),
(1530, '158.140.173.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-17 21:52:38', 1),
(1531, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:47', 0),
(1532, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:48', 0),
(1533, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:49', 0),
(1534, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:50', 0),
(1535, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:51', 0),
(1536, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:52', 0),
(1537, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:54', 0),
(1538, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:55', 0),
(1539, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:56', 0),
(1540, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:57', 0),
(1541, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:58', 0),
(1542, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:55:59', 0),
(1543, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:00', 0),
(1544, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:01', 0),
(1545, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:02', 0),
(1546, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:03', 0),
(1547, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:04', 0),
(1548, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:05', 0),
(1549, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:06', 0),
(1550, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:07', 0),
(1551, '194.116.236.215', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/44.0.2403.89 Chrome/44.0.2403.89 Safari/537.36', 'email_password', 'tsdgoezs@immenseignite.info', NULL, '2026-07-19 08:56:09', 0),
(1552, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-19 19:06:07', 1),
(1553, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-19 19:34:49', 1),
(1554, '158.140.173.70', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-19 22:38:30', 1),
(1555, '118.99.94.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-20 09:44:06', 1),
(1556, '158.140.173.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-21 08:51:36', 1),
(1557, '158.140.165.30', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-21 11:07:14', 1),
(1558, '158.140.165.30', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-21 11:17:10', 1),
(1559, '10.84.85.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-21 12:31:58', 1),
(1560, '10.84.87.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-21 14:13:34', 1),
(1561, '10.84.49.60', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-21 14:20:42', 0),
(1562, '10.84.49.60', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-21 14:20:59', 0),
(1563, '10.84.49.60', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-07-21 14:21:09', 1),
(1564, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-21 14:26:55', 1),
(1565, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-21 16:55:02', 1),
(1566, '119.235.212.198', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-21 18:01:38', 1),
(1567, '10.84.75.5', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-21 18:08:33', 1),
(1568, '140.213.184.15', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Safari/537.36', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-21 18:15:06', 1),
(1569, '101.128.104.148', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-21 20:05:49', 1),
(1570, '182.1.228.59', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-21 20:53:16', 1),
(1571, '114.10.41.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-21 21:13:34', 1),
(1572, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-21 22:26:15', 1),
(1573, '114.79.0.50', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-07-22 00:01:29', 1),
(1574, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-22 09:25:16', 1),
(1575, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 10:15:19', 1),
(1576, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'masaziz@gmail.com', 141, '2026-07-23 10:27:09', 1),
(1577, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 10:28:17', 1),
(1578, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'rizkirantaumentor@gmail.com', 143, '2026-07-23 10:33:19', 1),
(1579, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 10:35:50', 1),
(1580, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 10:49:35', 1),
(1581, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 10:50:34', 1),
(1582, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 10:51:46', 1),
(1583, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 11:07:39', 1),
(1584, '157.15.47.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-23 11:09:47', 1),
(1585, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 11:11:23', 1),
(1586, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 11:11:31', 1),
(1587, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 11:12:17', 1),
(1588, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 11:16:38', 1),
(1589, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 11:16:50', 1),
(1590, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-23 11:19:13', 1),
(1591, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 11:26:43', 1),
(1592, '114.10.98.55', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-23 17:05:20', 1),
(1593, '157.15.47.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-24 01:30:36', 1),
(1594, '10.84.85.82', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-24 08:25:43', 1),
(1595, '10.84.107.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-24 08:38:38', 1),
(1596, '10.84.107.173', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-24 09:57:51', 1),
(1597, '10.84.107.196', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-24 13:51:47', 1),
(1598, '157.15.47.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-24 23:12:45', 1),
(1599, '114.79.4.255', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-24 23:45:51', 1),
(1600, '182.1.229.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.113 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-25 14:57:05', 1),
(1601, '158.140.173.115', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-25 15:09:55', 1),
(1602, '182.1.234.125', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-25 18:20:57', 1),
(1603, '158.140.165.12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-25 18:52:24', 1),
(1604, '36.76.204.249', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-25 19:57:14', 1),
(1605, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-25 20:32:56', 1),
(1606, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-25 22:02:19', 1),
(1607, '82.197.69.49', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5.2 Safari/605.1.15', 'email_password', '3GtA7O46YEpgvqpWy4HWkpDuXP8@7M2CX.com', NULL, '2026-07-26 07:52:05', 0),
(1608, '158.140.173.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-26 10:05:41', 1),
(1609, '118.99.94.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-26 13:35:57', 1),
(1610, '180.242.3.67', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-26 16:31:58', 1),
(1611, '101.128.108.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-26 23:11:15', 1),
(1612, '158.140.165.31', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-27 08:45:02', 1),
(1613, '140.213.184.111', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-27 10:26:34', 1),
(1614, '157.15.47.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-27 23:28:07', 1),
(1615, '114.10.98.237', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-28 18:26:25', 1),
(1616, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-28 19:14:39', 1),
(1617, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-28 19:14:57', 1),
(1618, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-28 22:47:42', 1),
(1619, '114.10.41.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-28 22:58:32', 1),
(1620, '103.111.98.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-28 23:59:20', 1),
(1621, '158.140.173.77', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-29 05:40:05', 1),
(1622, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-29 07:22:15', 1),
(1623, '10.84.132.46', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-29 08:08:16', 1),
(1624, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-29 09:22:08', 1),
(1625, '10.84.118.102', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-29 09:22:31', 1),
(1626, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-29 09:22:49', 1),
(1627, '103.218.166.186', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-29 09:24:29', 1),
(1628, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-29 09:35:12', 1),
(1629, '158.140.173.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-29 09:56:08', 1),
(1630, '103.111.98.98', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-29 10:35:29', 1),
(1631, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-29 10:59:11', 1),
(1632, '158.140.173.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-29 11:13:59', 1),
(1633, '114.79.7.237', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-29 14:04:40', 1),
(1634, '36.76.221.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-29 14:44:39', 1),
(1635, '158.140.173.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-29 16:22:19', 1),
(1636, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-29 16:32:12', 1),
(1637, '103.111.98.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-29 16:34:24', 1),
(1638, '114.10.42.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-29 19:41:05', 1),
(1639, '125.167.58.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', NULL, '2026-07-29 19:55:13', 0),
(1640, '125.167.58.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', NULL, '2026-07-29 19:55:37', 0),
(1641, '125.167.58.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', NULL, '2026-07-29 19:56:24', 0),
(1642, '125.167.58.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-29 19:57:53', 1),
(1643, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', NULL, '2026-07-29 20:35:24', 0),
(1644, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-29 20:35:30', 1),
(1645, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-29 20:40:23', 1),
(1646, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-29 20:40:57', 1),
(1647, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-29 21:15:12', 1),
(1648, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-29 21:16:32', 1),
(1649, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-29 21:20:44', 1),
(1650, '101.128.104.61', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-29 21:23:09', 1),
(1651, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-07-29 21:26:55', 0),
(1652, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-07-29 21:27:08', 0),
(1653, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-07-29 21:27:45', 0),
(1654, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.com', NULL, '2026-07-29 21:28:01', 0),
(1655, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-29 21:32:20', 1),
(1656, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'indahpratiwidosen@gmail.com', 133, '2026-07-29 21:55:08', 1),
(1657, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-29 22:19:59', 1),
(1658, '182.1.236.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-29 23:22:57', 1),
(1659, '114.10.42.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', NULL, '2026-07-29 23:52:38', 0),
(1660, '114.10.42.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', NULL, '2026-07-29 23:52:40', 0),
(1661, '114.10.42.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'mfathir069@gmail.com', 106, '2026-07-29 23:52:49', 1),
(1662, '182.1.236.178', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-30 00:55:09', 1),
(1663, '182.1.236.190', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-30 06:50:28', 1),
(1664, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-30 07:30:33', 0),
(1665, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-30 07:30:44', 0),
(1666, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-30 07:31:09', 0),
(1667, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-30 07:31:33', 0),
(1668, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', NULL, '2026-07-30 07:31:37', 0),
(1669, '114.79.7.35', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dinnizen@gmail.com', 96, '2026-07-30 07:47:45', 1),
(1670, '158.140.173.109', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 08:11:59', 1),
(1671, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'mutiaraputridosen@gmail.com', NULL, '2026-07-30 08:21:04', 0),
(1672, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'mutiaraputridosen@gmail.com', 138, '2026-07-30 08:21:25', 1),
(1673, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 08:22:22', 1),
(1674, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-30 08:32:21', 1),
(1675, '103.67.47.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-30 09:06:49', 1),
(1676, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 09:36:53', 0),
(1677, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 09:37:14', 0),
(1678, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 09:38:08', 0),
(1679, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-30 09:38:28', 1),
(1680, '158.140.165.14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-07-30 09:44:57', 1),
(1681, '36.68.9.236', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-30 10:16:14', 1),
(1682, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'dwirianadosen@gmail.com', 136, '2026-07-30 10:18:42', 1),
(1683, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 10:25:57', 0),
(1684, '125.167.56.57', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 10:26:09', 0),
(1685, '114.79.3.167', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 10:27:55', 0),
(1686, '114.79.4.235', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Safari/537.36 HeyTapBrowser/45.14.4.2 Chrome/115.0.5970.168', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 10:39:40', 1),
(1687, '180.245.109.217', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 10:42:29', 1),
(1688, '140.213.230.75', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'chaniaputrii06@gmail.com', 57, '2026-07-30 10:43:41', 1),
(1689, '10.84.72.187', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 10:55:17', 1),
(1690, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-30 11:17:01', 1),
(1691, '114.10.98.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-30 11:18:27', 1),
(1692, '10.84.73.138', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 11:19:58', 1),
(1693, '149.50.211.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-07-30 11:23:35', 1),
(1694, '140.213.76.14', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 11:29:30', 1),
(1695, '158.140.173.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 11:39:33', 1),
(1696, '158.140.173.109', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 11:55:06', 1),
(1697, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-30 12:01:52', 1),
(1698, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 12:02:32', 1),
(1699, '158.140.173.109', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 12:02:59', 1),
(1700, '182.1.236.166', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'oliviaclaudiaa17@gmail.con', 87, '2026-07-30 12:05:15', 1),
(1701, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 12:07:02', 1),
(1702, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-30 12:07:04', 1),
(1703, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 12:10:21', 1),
(1704, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-30 12:31:21', 1),
(1705, '36.68.9.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.113 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-30 12:53:01', 1),
(1706, '36.68.9.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.113 Mobile/15E148 Safari/604.1', 'email_password', 'indahpratiwidosen@gmail.com', 133, '2026-07-30 12:58:44', 1),
(1707, '36.68.9.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.113 Mobile/15E148 Safari/604.1', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-30 12:59:16', 1),
(1708, '182.1.239.179', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', NULL, '2026-07-30 13:01:40', 0),
(1709, '36.68.9.236', 'Mozilla/5.0 (iPhone; CPU iPhone OS 26_5_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/150.0.7871.113 Mobile/15E148 Safari/604.1', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-30 13:04:03', 1),
(1710, '128.1.227.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'lenisabrinadosen@gmail.com', 137, '2026-07-30 13:05:29', 1),
(1711, '103.67.47.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', NULL, '2026-07-30 13:06:16', 0),
(1712, '103.67.47.63', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'nadilastevanialensi@gmail.con', 89, '2026-07-30 13:06:38', 1),
(1713, '128.1.227.231', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'lenisabrinadosen@gmail.com', 137, '2026-07-30 13:17:42', 1),
(1714, '114.10.98.244', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 13:28:31', 1),
(1715, '182.1.239.179', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 13:29:31', 1),
(1716, '203.78.116.132', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'indahpratiwidosen@gmail.com', 133, '2026-07-30 13:30:13', 1),
(1717, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 13:31:27', 1),
(1718, '36.76.221.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/403.0.853868894 Mobile/15E148 Safari/604.1', 'email_password', 'indahpratiwidosen@gmail.com', NULL, '2026-07-30 13:33:49', 0),
(1719, '36.76.221.4', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) GSA/403.0.853868894 Mobile/15E148 Safari/604.1', 'email_password', 'indahpratiwidosen@gmail.com', 133, '2026-07-30 13:34:28', 1),
(1720, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-30 13:44:51', 1),
(1721, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 13:52:34', 1),
(1722, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'zurohainadosen@gmail.com', 132, '2026-07-30 13:53:26', 1),
(1723, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-30 13:54:32', 1),
(1724, '114.10.98.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-30 14:21:56', 1),
(1725, '182.1.239.179', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'email_password', 'valengeraldi17@gmail.com', 111, '2026-07-30 14:23:41', 1),
(1726, '10.84.87.80', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'indahpratiwidosen@gmail.com', 133, '2026-07-30 14:51:27', 1),
(1727, '114.79.2.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'dwirianadosen@gmail.com', 136, '2026-07-30 15:38:18', 1),
(1728, '182.1.238.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Mobile/15E148 Safari/604.1', 'email_password', 'mutiaraputridosen@gmail.com', NULL, '2026-07-30 15:42:15', 0),
(1729, '182.1.239.8', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Mobile/15E148 Safari/604.1', 'email_password', 'mutiaraputridosen@gmail.com', NULL, '2026-07-30 15:42:44', 0),
(1730, '103.138.218.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'wahyutriaji@polsri.ac.id', NULL, '2026-07-30 15:42:57', 0),
(1731, '182.1.238.18', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Mobile/15E148 Safari/604.1', 'email_password', 'mutiaraputridosen@gmail.com', 138, '2026-07-30 15:43:05', 1),
(1732, '103.138.218.178', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-30 15:43:43', 1),
(1733, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-07-30 15:45:04', 1),
(1734, '10.84.72.187', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 15:46:04', 1),
(1735, '103.138.218.178', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-30 15:53:02', 1),
(1736, '10.84.72.187', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'heniyuvitadosen@gmail.com', 135, '2026-07-30 15:58:36', 1),
(1737, '10.84.72.187', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 16:00:17', 1),
(1738, '158.140.173.109', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-07-30 16:05:06', 1),
(1739, '36.68.9.236', 'Mozilla/5.0 (Linux; Android 12; V2040) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.79 Mobile Safari/537.36', 'email_password', 'muhammadriizkyy4@gmail.com', 109, '2026-07-30 16:16:34', 1),
(1740, '10.84.110.65', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'dikasetiagrahadosen@gmail.com', 139, '2026-07-30 16:38:05', 1),
(1741, '114.10.99.23', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'email_password', 'febriansyah010200@gmail.com', 113, '2026-07-30 19:18:52', 1),
(1742, '114.122.13.149', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.5 Mobile/15E148 Safari/604.1', 'email_password', 'wahyutriajidosen@gmail.com', 134, '2026-07-30 21:33:01', 1),
(1743, '158.140.173.81', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/27.0 Mobile/15E148 Safari/604.1', 'email_password', 'mutiaraputridosen@gmail.com', 138, '2026-07-31 04:59:43', 1),
(1744, '103.111.98.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'email_password', 'gh4554ni.queen@gmail.com', 56, '2026-07-31 09:43:00', 1),
(1745, '10.84.119.40', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-31 11:34:40', 1),
(1746, '158.140.173.122', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-31 11:43:44', 1),
(1747, '114.10.99.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'mroihanbaariq@gmail.com', 42, '2026-07-31 13:09:12', 1),
(1748, '118.99.94.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-07-31 13:50:05', 1),
(1749, '158.140.173.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'krisnawati0706na@gmail.com', 73, '2026-08-01 09:52:34', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1750, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-08-01 09:56:14', 1),
(1751, '158.140.173.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 Edg/151.0.0.0', 'email_password', 'najwaalyasenovgizahra@gmail.com', 85, '2026-08-02 21:21:38', 1),
(1752, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-08-03 13:28:40', 1),
(1753, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-08-03 15:11:52', 1),
(1754, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-08-03 20:27:48', 1),
(1755, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-08-03 21:13:15', 1),
(1756, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', 'paisaldosen@gmail.com', 131, '2026-08-03 21:27:09', 1),
(1757, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-08-03 21:42:48', 1),
(1758, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', 'simpmw@polsri.ac.id', 1, '2026-08-03 21:43:31', 1),
(1759, '158.140.173.81', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'email_password', '062340833143@student.polsri.ac.id', 55, '2026-08-03 21:54:28', 1),
(1760, '118.99.94.199', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'paisaldosen@gmail.com', 131, '2026-08-03 21:55:53', 1),
(1761, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'paisaldosen@gmail.com', NULL, '2026-08-03 22:41:41', 0),
(1762, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'paisaldosen@gmail.com', NULL, '2026-08-03 22:42:07', 0),
(1763, '118.99.94.199', 'Mozilla/5.0 (X11; Linux x86_64; rv:153.0) Gecko/20100101 Firefox/153.0', 'email_password', 'paisaldosen@gmail.com', 131, '2026-08-03 22:42:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_content`
--

CREATE TABLE `cms_content` (
  `id` int UNSIGNED NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_general_ci,
  `type` enum('text','image','json','rich_text') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'text',
  `group` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'general',
  `label` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_content`
--

INSERT INTO `cms_content` (`id`, `key`, `content`, `type`, `group`, `label`, `created_at`, `updated_at`) VALUES
(1, 'home_hero_badge', 'Program Tahun 2026', 'text', 'home_hero', 'Hero Badge Text', NULL, '2026-07-31 13:52:07'),
(4, 'home_hero_description', 'Politeknik Negeri Sriwijaya memfasilitasi mahasiswa untuk mengembangkan ide bisnis menjadi usaha nyata melalui program pembinaan kewirausahaan.', 'text', 'home_hero', 'Hero Description', NULL, '2026-07-31 13:52:07'),
(5, 'home_hero_image', 'uploads/cms/1777540014_45a9d703a585e6db5ad0.png', 'image', 'home_hero', 'Hero Image', NULL, '2026-07-31 13:52:07'),
(6, 'home_hero_stats', '[{\"number\":\"15+\",\"label\":\"Tahun Berdiri\"},{\"number\":\"300+\",\"label\":\"Tim Terbina\"},{\"number\":\"300+\",\"label\":\"Usaha Aktif\"}]', 'json', 'home_hero', 'Hero Statistics', NULL, '2026-07-31 13:52:07'),
(7, 'home_features_badge', 'Mengapa PMW?', 'text', 'home_features', 'Features Badge', NULL, '2026-07-31 13:52:07'),
(8, 'home_features_title', 'Program Pembinaan Komprehensif', 'text', 'home_features', 'Features Title', NULL, '2026-07-31 13:52:07'),
(9, 'home_features_description', 'Program Mahasiswa Wirausaha dirancang untuk memberikan dukungan holistik dari ide hingga usaha yang berkelanjutan.', 'text', 'home_features', 'Features Description', NULL, '2026-07-31 13:52:07'),
(10, 'home_features_list', '[{\"icon\":\"fa-route\",\"color\":\"sky\",\"title\":\"Proses Jelas\",\"desc\":\"Tahapan program yang terstruktur dari pendaftaran hingga awarding dengan milestone yang jelas.\"},{\"icon\":\"fa-users\",\"color\":\"yellow\",\"title\":\"Tim Pendamping\",\"desc\":\"Didampingi oleh dosen dan mentor industri berpengalaman dalam setiap tahap pengembangan.\"},{\"icon\":\"fa-coins\",\"color\":\"sky\",\"title\":\"Pendanaan Implementasi\",\"desc\":\"Akses pendanaan tahap 1 dan tahap 2 untuk mengakselerasi pertumbuhan usaha Anda.\"},{\"icon\":\"fa-chart-line\",\"color\":\"emerald\",\"title\":\"Pengembangan Skill\",\"desc\":\"Pelatihan kewirausahaan, manajemen bisnis, dan pengembangan produk berkualitas.\"}]', 'json', 'home_features', 'Features List', NULL, '2026-07-31 13:52:07'),
(11, 'home_workflow_badge', 'Alur Program', 'text', 'home_workflow', 'Workflow Badge', NULL, '2026-07-31 13:52:07'),
(12, 'home_workflow_title', '11 Tahapan Menuju Wirausaha Mandiri', 'text', 'home_workflow', 'Workflow Title', NULL, '2026-07-31 13:52:07'),
(13, 'home_workflow_description', 'Program ini dirancang dengan pendekatan berbasis proses yang sistematis. Setiap tahap memiliki kriteria evaluasi yang jelas dan dukungan yang sesuai.', 'text', 'home_workflow', 'Workflow Description', NULL, '2026-07-31 13:52:07'),
(14, 'home_workflow_image', 'uploads/cms/1777538917_749022d80dcdeff7b5af.png', 'image', 'home_workflow', 'Workflow Image', NULL, '2026-07-31 13:52:07'),
(15, 'home_workflow_list', '[{\"num\":\"1\",\"color\":\"sky\",\"title\":\"Pendaftaran & Pitching\",\"desc\":\"Submit ide bisnis Anda\"},{\"num\":\"2\",\"color\":\"yellow\",\"title\":\"Seleksi Proposal\",\"desc\":\"Buat Proposal Bisnismu\"},{\"num\":\"3\",\"color\":\"emerald\",\"title\":\"Implementasi & Mentoring\",\"desc\":\"Bimbingan intensif 4 bulan\"}]', 'json', 'home_workflow', 'Workflow Preview List', NULL, '2026-07-31 13:52:07'),
(16, 'home_gallery_badge', 'Dokumentasi', 'text', 'home_gallery', 'Gallery Badge', NULL, '2026-07-31 13:52:07'),
(23, 'home_cta_badge', 'Siap Memulai?', 'text', 'home_cta', 'CTA Badge', NULL, '2026-07-31 13:52:07'),
(24, 'home_cta_title', 'Bersiaplah untuk PMW Berikutnya', 'text', 'home_cta', 'CTA Title', NULL, '2026-07-31 13:52:07'),
(25, 'home_cta_description', 'Pelajari tahapan program dan persiapkan diri Anda untuk pendaftaran periode berikutnya. Tim kami siap membimbing Anda.', 'text', 'home_cta', 'CTA Description', NULL, '2026-07-31 13:52:07'),
(26, 'tahapan_hero_badge', 'Alur Program', 'text', 'tahapan_hero', 'Hero Badge', NULL, '2026-07-31 13:52:07'),
(29, 'tahapan_hero_description', 'Program Mahasiswa Wirausaha terdiri dari 11 tahapan yang harus dilalui peserta mulai dari pendaftaran hingga Awarding & Expo Kewirausahaan.', 'text', 'tahapan_hero', 'Hero Description', NULL, '2026-07-31 13:52:07'),
(30, 'tahapan_flow_badge', 'Alur Pendaftaran', 'text', 'tahapan_flow', 'Flow Badge', NULL, '2026-07-31 13:52:07'),
(33, 'tahapan_flow_description', 'Ikuti langkah-langkah berikut untuk mendaftar Program Mahasiswa Wirausaha Polsri.', 'text', 'tahapan_flow', 'Flow Description', NULL, '2026-07-31 13:52:07'),
(34, 'tahapan_flow_steps', '[{\"num\":\"1\",\"title\":\"Registrasi Akun\",\"desc\":\"Buat akun di sistem PMW Polsri dengan email kampus.\"},{\"num\":\"2\",\"title\":\"Pilih Kategori\",\"desc\":\"Tentukan kategori PMW: Usaha Pemula atau Berkembang.\"},{\"num\":\"3\",\"title\":\"Lengkapi Data Tim\",\"desc\":\"Masukkan profil seluruh anggota tim beserta skill.\"},{\"num\":\"4\",\"title\":\"Upload Proposal\",\"desc\":\"Unggah proposal usaha dalam format PDF sesuai template.\"},{\"num\":\"5\",\"seleksi\":\"Seleksi & Wawancara\",\"desc\":\"Ikuti seluruh tahapan seleksi dengan persiapan matang.\"},{\"num\":\"6\",\"title\":\"Implementasi\",\"desc\":\"Peserta terpilih akan mengikuti program hingga evaluasi akhir.\"}]', 'json', 'tahapan_flow', 'Registration Steps', NULL, '2026-07-31 13:52:07'),
(35, 'tahapan_cta_title', 'Siap Mengikuti Tahapan PMW?', 'text', 'tahapan_cta', 'CTA Title', NULL, '2026-07-31 13:52:07'),
(36, 'tahapan_cta_description', 'Daftarkan tim Anda sekarang dan mulai perjalanan kewirausahaan.', 'text', 'tahapan_cta', 'CTA Description', NULL, '2026-07-31 13:52:07'),
(62, 'tentang_hero_badge', 'Tentang Program', 'text', 'tentang_hero', 'Hero Badge', NULL, '2026-07-31 13:52:07'),
(63, 'tentang_hero_title', 'Program Mahasiswa Wirausaha', 'text', 'tentang_hero', 'Hero Title', NULL, '2026-07-31 13:52:07'),
(64, 'tentang_hero_description', 'Program pembinaan kewirausahaan bagi mahasiswa Politeknik Negeri Sriwijaya untuk mengembangkan usaha berbasis inovasi dan kreativitas.', 'text', 'tentang_hero', 'Hero Description', NULL, '2026-07-31 13:52:07'),
(65, 'tentang_vision_title', 'Mencetak Wirausaha Muda', 'text', 'tentang_vision', 'Vision Title', NULL, '2026-07-31 13:52:07'),
(66, 'tentang_vision_content', 'Menjadikan Politeknik Negeri Sriwijaya sebagai pusat unggulan pengembangan kewirausahaan yang menghasilkan entrepreneur muda berdaya saing tinggi, inovatif, dan berkontribusi pada pertumbuhan ekonomi lokal maupun nasional.', 'text', 'tentang_vision', 'Vision Text', NULL, '2026-07-31 13:52:07'),
(67, 'tentang_mission_list', '[{\"misi\":\"Memfasilitasi mahasiswa dalam mengembangkan ide bisnis menjadi usaha nyata\"},{\"misi\":\"Memberikan pendanaan dan akses permodalan untuk pengembangan usaha\"},{\"misi\":\"Menyediakan mentoring dan pendampingan dari praktisi berpengalaman\"},{\"misi\":\"Membangun ekosistem kewirausahaan yang kolaboratif dan berkelanjutan\"}]', 'json', 'tentang_vision', 'Mission List', NULL, '2026-07-31 13:52:07'),
(68, 'tentang_vision_image', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80', 'image', 'tentang_vision', 'Vision Image', NULL, '2026-07-31 13:52:07'),
(69, 'tentang_objectives_title', 'Apa yang Kami Capai', 'text', 'tentang_objectives', 'Objectives Title', NULL, '2026-07-31 13:52:07'),
(70, 'tentang_objectives_list', '[{\"icon\":\"fa-lightbulb\",\"color\":\"sky\",\"title\":\"Inovasi & Kreativitas\",\"desc\":\"Mendorong mahasiswa mengembangkan produk/jasa inovatif.\"},{\"icon\":\"fa-hand-holding-usd\",\"color\":\"yellow\",\"title\":\"Kemandirian Ekonomi\",\"desc\":\"Membantu mahasiswa membangun sumber penghasilan mandiri.\"},{\"icon\":\"fa-network-wired\",\"color\":\"emerald\",\"title\":\"Networking Bisnis\",\"desc\":\"Membangun jaringan dengan pelaku usaha dan investor.\"},{\"icon\":\"fa-graduation-cap\",\"color\":\"sky\",\"title\":\"Skill Development\",\"desc\":\"Pelatihan manajemen bisnis dan financial literacy.\"},{\"icon\":\"fa-users\",\"color\":\"yellow\",\"title\":\"Job Creation\",\"desc\":\"Menciptakan lapangan kerja melalui usaha berkelanjutan.\"},{\"icon\":\"fa-globe-asia\",\"color\":\"emerald\",\"title\":\"Dampak Sosial\",\"desc\":\"Mengembangkan usaha yang berdampak positif bagi masyarakat.\"}]', 'json', 'tentang_objectives', 'Objectives List', NULL, '2026-07-31 13:52:07'),
(71, 'tentang_cta_title', 'Siap Bergabung dengan PMW?', 'text', 'tentang_cta', 'CTA Title', NULL, '2026-07-31 13:52:07'),
(72, 'tentang_cta_description', 'Pelajari tahapan program selengkapnya dan persiapkan proposal terbaik Anda.', 'text', 'tentang_cta', 'CTA Description', NULL, '2026-07-31 13:52:07'),
(161, 'pengumuman_hero_badge', 'Informasi', 'text', 'pengumuman_hero', 'Hero Badge', NULL, '2026-07-31 13:52:07'),
(162, 'pengumuman_hero_title', 'Pengumuman Terbaru', 'text', 'pengumuman_hero', 'Hero Title', NULL, '2026-07-31 13:52:07'),
(163, 'pengumuman_hero_description', 'Informasi terbaru seputar Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya. Pantau terus pengumuman penting dan jadwal kegiatan.', 'text', 'pengumuman_hero', 'Hero Description', NULL, '2026-07-31 13:52:07'),
(218, 'home_stats_list', '[{\"icon\":\"fa-users\",\"val\":\"1000+\",\"label\":\"Peserta Terdaftar\",\"color\":\"sky\"},{\"icon\":\"fa-store\",\"val\":\"300+\",\"label\":\"Usaha Aktif\",\"color\":\"yellow\"},{\"icon\":\"fa-chalkboard-teacher\",\"val\":\"50+\",\"label\":\"Mentor Berpengalaman\",\"color\":\"emerald\"},{\"icon\":\"fa-hand-holding-dollar\",\"val\":\">2.5M\",\"label\":\"Total Dana Terdistribusi\",\"color\":\"amber\"}]', 'json', 'home_stats', 'Statistics Data', NULL, '2026-07-31 13:52:07'),
(282, 'home_hero_title', 'Program Mahasiswa Wirausaha', 'text', 'home_hero', 'Hero Title', NULL, '2026-07-31 13:52:07'),
(283, 'home_gallery_title', 'Galeri Kegiatan', 'text', 'home_gallery', 'Gallery Title', NULL, '2026-07-31 13:52:07'),
(284, 'tahapan_hero_title', 'Tahapan Program PMW', 'text', 'tahapan_hero', 'Hero Title', NULL, '2026-07-31 13:52:07'),
(285, 'tahapan_flow_title', 'Bagaimana Cara Mendaftar', 'text', 'tahapan_flow', 'Flow Title', NULL, '2026-07-31 13:52:07'),
(286, 'home_announcement_badge', 'Informasi Terkini', 'text', 'home_announcement', 'Announcement Badge', NULL, '2026-07-31 13:52:07'),
(287, 'home_announcement_title', 'Pengumuman Terbaru', 'text', 'home_announcement', 'Announcement Title', NULL, '2026-07-31 13:52:07'),
(288, 'home_announcement_description', 'Pantau terus informasi penting seputar Program Mahasiswa Wirausaha.', 'text', 'home_announcement', 'Announcement Description', NULL, '2026-07-31 13:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1776141412, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1776141412, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1776141412, 1),
(4, '2026-04-14-043939', 'App\\Database\\Migrations\\CreatePmwTables', 'default', 'App', 1776141600, 2),
(5, '2026-04-14-075607', 'App\\Database\\Migrations\\UpdatePmwAuthTables', 'default', 'App', 1776154346, 3),
(6, '2026-04-14-133816', 'App\\Database\\Migrations\\AddNamaToProfiles', 'default', 'App', 1776173904, 4),
(7, '2026-04-14-230000', 'App\\Database\\Migrations\\CreateLecturersTable', 'default', 'App', 1776184059, 5),
(8, '2026-04-14-230001', 'App\\Database\\Migrations\\CreateMentorsTable', 'default', 'App', 1776184059, 5),
(9, '2026-04-14-230002', 'App\\Database\\Migrations\\CreateReviewersTable', 'default', 'App', 1776184059, 5),
(10, '2026-04-15-000000', 'App\\Database\\Migrations\\CreatePmwPeriodsTable', 'default', 'App', 1776192872, 6),
(11, '2026-04-15-000001', 'App\\Database\\Migrations\\CreatePmwSchedulesTable', 'default', 'App', 1776192872, 6),
(12, '2026-04-15-044400', 'App\\Database\\Migrations\\CreatePmwProposalsTable', 'default', 'App', 1776228779, 7),
(13, '2026-04-15-044718', 'App\\Database\\Migrations\\CreatePmwProposalMembersTable', 'default', 'App', 1776228780, 7),
(14, '2026-04-15-044733', 'App\\Database\\Migrations\\AlterPmwDocumentsAddProposalColumns', 'default', 'App', 1776228780, 7),
(15, '2026-04-15-065107', 'App\\Database\\Migrations\\AlterProposalLecturerNullable', 'default', 'App', 1776235890, 8),
(16, '2026-04-15-110928', 'App\\Database\\Migrations\\AlterColumnStatusUsahaToKategoriWirausaha', 'default', 'App', 1776253330, 9),
(17, '2026-04-15-122714', 'App\\Database\\Migrations\\AddBerkembangFieldsToProposals', 'default', 'App', 1776256056, 10),
(18, '2026-04-15-164406', 'App\\Database\\Migrations\\AddCatatanToProposals', 'default', 'App', 1776271457, 11),
(19, '2026-04-15-173501', 'App\\Database\\Migrations\\AddVideoUrlToProposals', 'default', 'App', 1776274877, 12),
(20, '2026-04-15-175153', 'App\\Database\\Migrations\\AddPitchingValidationToProposals', 'default', 'App', 1776275523, 13),
(21, '2026-04-16-040100', 'App\\Database\\Migrations\\AddWawancaraToProposals', 'default', 'App', 1776312024, 14),
(22, '2026_04_16_043000', 'App\\Database\\Migrations\\UpdatePmwDocumentTypes', 'default', 'App', 1776314012, 15),
(23, '2026-04-16-170000', 'App\\Database\\Migrations\\CreatePmwAnnouncementsTable', 'default', 'App', 1776359769, 16),
(24, '2026-04-16-170010', 'App\\Database\\Migrations\\CreatePmwAnnouncementItemsTable', 'default', 'App', 1776359770, 16),
(25, '2026-04-17-001100', 'App\\Database\\Migrations\\AlterBankAccountsToUseProposalId', 'default', 'App', 1776362105, 17),
(26, '2026-04-17-002000', 'App\\Database\\Migrations\\AddTrainingInfoToAnnouncements', 'default', 'App', 1776364768, 18),
(27, '2026-04-17-002100', 'App\\Database\\Migrations\\CreatePmwTrainingReportsTable', 'default', 'App', 1776364768, 18),
(28, '2026-04-17-002200', 'App\\Database\\Migrations\\CreatePmwTrainingPhotosTable', 'default', 'App', 1776364768, 18),
(29, '2026-04-17-023000', 'App\\Database\\Migrations\\ShiftPhasesSplitTraining', 'default', 'App', 1776367521, 19),
(30, '2026-04-17-003000', 'App\\Database\\Migrations\\CreateImplementationTables', 'default', 'App', 1776399370, 20),
(31, '2026-04-17-003100', 'App\\Database\\Migrations\\AddImplementasiStatusToProposals', 'default', 'App', 1776399370, 20),
(32, '2026-04-17-100001', 'App\\Database\\Migrations\\AddUpdatedAtToTrainingPhotos', 'default', 'App', 1776413386, 21),
(33, '2026-04-17-083848', 'App\\Database\\Migrations\\AddMentorIdToProposals', 'default', 'App', 1776415139, 22),
(34, '2026-04-17-090657', 'App\\Database\\Migrations\\CreatePmwImplementationKonsumsiTable', 'default', 'App', 1776416841, 23),
(35, '2026-04-17-093507', 'App\\Database\\Migrations\\CreateGuidanceTables', 'default', 'App', 1776418520, 24),
(36, '2026-04-17-110000', 'App\\Database\\Migrations\\NormalizeProposalTables', 'default', 'App', 1776419303, 25),
(37, '2026-04-17-120000', 'App\\Database\\Migrations\\StandardizeSelectionFields', 'default', 'App', 1776419789, 26),
(38, '2026-04-17-194500', 'App\\Database\\Migrations\\CreateNotificationsTable', 'default', 'App', 1776430618, 27),
(39, '2026-04-17-141556', 'App\\Database\\Migrations\\AddSubmittedAtToPitching', 'default', 'App', 1776435370, 28),
(40, '2026-04-17-155435', 'App\\Database\\Migrations\\AddQtyToImplementationItems', 'default', 'App', 1776441293, 29),
(41, '2026-04-17-234500', 'App\\Database\\Migrations\\AddDualValidationToImplementasi', 'default', 'App', 1776444188, 30),
(42, '2026-04-18-002000', 'App\\Database\\Migrations\\AddSubmittedAtToWawancara', 'default', 'App', 1776446367, 31),
(43, '2026-04-18-044435', 'App\\Database\\Migrations\\AddNotaDetailsToLogbooks', 'default', 'App', 1776487542, 32),
(44, '2026-04-18-050127', 'App\\Database\\Migrations\\AddDraftStatusToLogbooks', 'default', 'App', 1776488497, 33),
(45, '2026-04-18-050256', 'App\\Database\\Migrations\\AddCategoryToImplementationItems', 'default', 'App', 1776488589, 34),
(46, '2026-04-18-054136', 'App\\Database\\Migrations\\AddNotaItemsToLogbooks', 'default', 'App', 1776490912, 35),
(47, '2026-04-18-055151', 'App\\Database\\Migrations\\AddNotaFilesToLogbooks', 'default', 'App', 1776491526, 36),
(48, '2026-04-18-123901', 'App\\Database\\Migrations\\CreateActivityTables', 'default', 'App', 1776491526, 36),
(49, '2026-04-18-061309', 'App\\Database\\Migrations\\AddSubmittedAtToLogbooks', 'default', 'App', 1776492832, 37),
(50, '2026-04-18-160700', 'App\\Database\\Migrations\\EnforceUniqueProposalAssignments', 'default', 'App', 1776503272, 38),
(51, '2026-04-18-102156', 'App\\Database\\Migrations\\AddReviewerFieldsToActivityLogbooks', 'default', 'App', 1776507727, 39),
(52, '2026-04-18-130742', 'App\\Database\\Migrations\\AddBatchIdToActivitySchedules', 'default', 'App', 1776517678, 40),
(53, '2026-04-18-144105', 'App\\Database\\Migrations\\AddActivityLogbookPhotosTable', 'default', 'App', 1776523284, 41),
(54, '2026-04-18-163809', 'App\\Database\\Migrations\\AddAdminMonitoringFieldsToActivityLogbooks', 'default', 'App', 1776530298, 42),
(55, '2026-04-18-163924', 'App\\Database\\Migrations\\AddRoleToActivityLogbookPhotos', 'default', 'App', 1776530374, 43),
(56, '2026-04-19-092500', 'App\\Database\\Migrations\\CreatePmwMilestoneReportsTable', 'default', 'App', 1776565420, 44),
(58, '2026-04-19-034109', 'App\\Database\\Migrations\\CreatePmwSelectionFinalization', 'default', 'App', 1776571324, 45),
(59, '2026-04-19-062736', 'App\\Database\\Migrations\\CreatePmwExpoAwardingTables', 'default', 'App', 1776580074, 46),
(60, '2026-04-19-103340', 'App\\Database\\Migrations\\AddCertificateToExpoSubmissions', 'default', 'App', 1776594833, 47),
(61, '2026-04-19-171823', 'App\\Database\\Migrations\\AddFotoToProposalMembersMigration', 'default', 'App', 1776619114, 48),
(62, '2026-04-20-000001', 'App\\Database\\Migrations\\CreateCmsContentTable', 'default', 'App', 1776658261, 49),
(63, '2026-04-20-042554', 'App\\Database\\Migrations\\FixCmsGroupsMigration', 'default', 'App', 1776659163, 50),
(64, '2026-04-20-050733', 'App\\Database\\Migrations\\CreateAnnouncementsTable', 'default', 'App', 1776661682, 51),
(65, '2026-04-20-124201', 'App\\Database\\Migrations\\AddAnnouncementAttachments', 'default', 'App', 1776688935, 52),
(66, '2026-04-20-151051', 'App\\Database\\Migrations\\ChangeAnnouncementContentToJson', 'default', 'App', 1776697879, 53),
(67, '2026-04-20-170921', 'App\\Database\\Migrations\\AddSubscribersTable', 'default', 'App', 1776705249, 54),
(68, '2026-04-20-171359', 'App\\Database\\Migrations\\AddPushSubscriptionsTable', 'default', 'App', 1776705249, 54),
(69, '2026-04-20-172700', 'App\\Database\\Migrations\\RenamePushSubscriptionColumns', 'default', 'App', 1776706028, 55),
(70, '2026-04-20-174400', 'App\\Database\\Migrations\\CreatePortalGalleriesTable', 'default', 'App', 1776707026, 56),
(71, '2026-04-29-000000', 'App\\Database\\Migrations\\CreatePmwSelectionProposalTable', 'default', 'App', 1777395611, 57),
(72, '2026-04-29-000100', 'App\\Database\\Migrations\\DropDosenColumnsFromSelectionPitching', 'default', 'App', 1777396844, 58),
(73, '2026-04-29-000200', 'App\\Database\\Migrations\\DropLegacyTeamTables', 'default', 'App', 1777397633, 59),
(74, '2026-04-29-000300', 'App\\Database\\Migrations\\CreatePmwProposalRabItems', 'default', 'App', 1777439078, 60),
(75, '2026-04-29-010000', 'App\\Database\\Migrations\\AddLamaUsahaToProposals', 'default', 'App', 1777452401, 61),
(76, '2026-04-29-020000', 'App\\Database\\Migrations\\AddInstagramUrlToProposals', 'default', 'App', 1777472839, 62),
(77, '2026-04-29-170100', 'App\\Database\\Migrations\\AddLinkPembelianToImplementationPayments', 'default', 'App', 1777482068, 63),
(78, '2026-04-30-111100', 'App\\Database\\Migrations\\AddDeadlineDaysToGuidanceSchedules', 'default', 'App', 1777486136, 64);

-- --------------------------------------------------------

--
-- Table structure for table `pmw_activity_logbooks`
--

CREATE TABLE `pmw_activity_logbooks` (
  `id` int UNSIGNED NOT NULL,
  `schedule_id` int UNSIGNED NOT NULL,
  `activity_description` text COLLATE utf8mb4_general_ci NOT NULL,
  `photo_activity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_supervisor_visit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reviewer_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reviewer_summary` text COLLATE utf8mb4_general_ci,
  `reviewer_id` int UNSIGNED DEFAULT NULL,
  `reviewer_at` datetime DEFAULT NULL,
  `admin_photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_summary` text COLLATE utf8mb4_general_ci,
  `admin_at` datetime DEFAULT NULL,
  `status` enum('draft','pending','approved_by_dosen','approved_by_mentor','approved','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `dosen_status` enum('pending','approved','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `dosen_note` text COLLATE utf8mb4_general_ci,
  `dosen_verified_at` datetime DEFAULT NULL,
  `mentor_status` enum('pending','approved','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `mentor_note` text COLLATE utf8mb4_general_ci,
  `mentor_verified_at` datetime DEFAULT NULL,
  `admin_note` text COLLATE utf8mb4_general_ci,
  `admin_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_activity_logbook_photos`
--

CREATE TABLE `pmw_activity_logbook_photos` (
  `id` int UNSIGNED NOT NULL,
  `logbook_id` int UNSIGNED NOT NULL,
  `uploader_role` enum('student','admin','reviewer') COLLATE utf8mb4_general_ci DEFAULT 'student',
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_activity_schedules`
--

CREATE TABLE `pmw_activity_schedules` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `batch_id` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `activity_category` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `activity_date` date NOT NULL,
  `activity_time` time DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('planned','ongoing','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'planned',
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_announcements`
--

CREATE TABLE `pmw_announcements` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `phase_number` int NOT NULL DEFAULT '5',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `training_date` datetime DEFAULT NULL,
  `training_location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `training_details` text COLLATE utf8mb4_general_ci,
  `sk_file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sk_original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_announcements`
--

INSERT INTO `pmw_announcements` (`id`, `period_id`, `phase_number`, `title`, `content`, `training_date`, `training_location`, `training_details`, `sk_file_path`, `sk_original_name`, `is_published`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'Pengumuman Kelolosan Dana Tahap I & Pembekalan', 'Selamat kepada yang telah lolos dari pengajuan proposal, pitching desk dan telah mengirimkan perjanjian, data tim yang lolos dapat dilihat dan diunduh pada lampiran di bawah', '2026-04-20 14:00:00', 'KPA Lt.2 ', 'Goess BRRRR', 'uploads/pmw/sk/1776366951_006d98945a4c57c1cfa0.pdf', 'SK Kelolosan Dana PMW Tahap I 2026.pdf', 1, '2026-04-17 02:22:06', '2026-04-16 17:54:30', '2026-04-17 15:05:41'),
(2, 1, 4, 'Pengumuman Kelolosan Pendanaan Tahap I PMW Tahun 2026', 'Selamat kepada seluruh tim yang berhasil lolos Seleksi Pendanaan Tahap I Program Mahasiswa Wirausaha (PMW) Tahun 2026!\r\n\r\nBerdasarkan hasil evaluasi dan penilaian oleh tim juri, sebanyak 13 tim usaha dinyatakan lolos dan berhak melanjutkan ke tahap pembekalan serta pencairan dana Tahap I.\r\n\r\nLampiran Surat Keputusan (SK) Direktur dapat diunduh pada tautan/file yang telah disediakan di halaman ini.\r\n\r\nBagi tim yang belum berkesempatan lolos pada tahap ini, kami sangat mengapresiasi kerja keras dan inovasi yang telah ditunjukkan. Tetap semangat dalam berkarya dan mengembangkan wirausaha!', '2026-07-24 12:00:00', 'Graha Politeknik Negeri Sriwijaya', 'Wajib membawa :\r\n1. Laptop\r\n2. proposal Hardcopy dan soft copy\r\n3. List Perjanjian Implementasi\r\n\r\nuntuk mengikuti kegiatan Bimtek Administrasi & Keuangan bersama Tim Verifikasi (SPI). Terimakasih', NULL, NULL, 1, '2026-04-29 15:12:49', '2026-04-29 11:39:24', '2026-08-03 21:44:39');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_announcement_items`
--

CREATE TABLE `pmw_announcement_items` (
  `id` int UNSIGNED NOT NULL,
  `announcement_id` int UNSIGNED NOT NULL,
  `item_type` enum('file','link') COLLATE utf8mb4_general_ci NOT NULL,
  `item_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_announcement_items`
--

INSERT INTO `pmw_announcement_items` (`id`, `announcement_id`, `item_type`, `item_title`, `file_path`, `original_name`, `url`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'link', 'Contoh Video Pengenalan Usaha', NULL, NULL, 'https://youtu.be/wek9dIw2uVM?si=8ld6HRt6mCHnNe2C', 1, '2026-04-16 18:08:22', '2026-04-16 18:08:22'),
(2, 1, 'file', 'Materi Kewirausahaan', 'uploads/pmw/announcements/announcement_1/1776362918_65b90bc1245edbbd3925.pdf', 'DOKUMEN PROPOSAL UTAMA-1.pdf', NULL, 2, '2026-04-16 18:08:38', '2026-04-16 18:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_assessments`
--

CREATE TABLE `pmw_assessments` (
  `id` int UNSIGNED NOT NULL,
  `document_id` int UNSIGNED NOT NULL,
  `reviewer_id` int UNSIGNED NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `feedback` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_awards`
--

CREATE TABLE `pmw_awards` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  `rank` int NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_award_categories`
--

CREATE TABLE `pmw_award_categories` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `max_rank` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_award_categories`
--

INSERT INTO `pmw_award_categories` (`id`, `period_id`, `name`, `max_rank`, `created_at`, `updated_at`) VALUES
(1, 1, 'Peringkat PMW', 3, '2026-04-19 07:28:54', '2026-04-19 07:28:54'),
(2, 1, 'Stan Terbaik', 1, '2026-04-19 07:29:04', '2026-04-19 07:29:04'),
(3, 1, 'Inovasi Termantap', 2, '2026-04-19 07:29:17', '2026-04-19 07:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_bank_accounts`
--

CREATE TABLE `pmw_bank_accounts` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `account_holder_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `account_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `branch_office` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bank_book_scan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_bank_accounts`
--

INSERT INTO `pmw_bank_accounts` (`id`, `proposal_id`, `period_id`, `bank_name`, `account_holder_name`, `account_number`, `branch_office`, `bank_book_scan`, `description`, `created_at`, `updated_at`) VALUES
(6, 31, 1, '', '', '', '', NULL, '', '2026-08-03 21:55:20', '2026-08-03 21:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_documents`
--

CREATE TABLE `pmw_documents` (
  `id` int UNSIGNED NOT NULL,
  `team_id` int UNSIGNED DEFAULT NULL,
  `proposal_id` int UNSIGNED DEFAULT NULL,
  `uploader_id` int UNSIGNED NOT NULL,
  `type` enum('proposal','laporan_awal','laporan_akhir','nota','dokumentasi_alat','pitching','perjanjian') COLLATE utf8mb4_general_ci DEFAULT 'proposal',
  `doc_key` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('submitted','pending_review','verified','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `version` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_documents`
--

INSERT INTO `pmw_documents` (`id`, `team_id`, `proposal_id`, `uploader_id`, `type`, `doc_key`, `file_path`, `original_name`, `status`, `version`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 10, 'proposal', 'ktm', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-ktm-20260415_171018.pdf', '2.pdf', 'submitted', 4, '2026-04-15 13:46:43', '2026-04-15 17:10:18'),
(2, NULL, 1, 10, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-proposal_utama-20260415_141809.pdf', 'DOKUMEN PROPOSAL UTAMA.pdf', 'submitted', 2, '2026-04-15 13:59:17', '2026-04-15 14:18:09'),
(3, NULL, 1, 10, 'proposal', 'biodata', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-biodata-20260415_141809.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 2, '2026-04-15 13:59:17', '2026-04-15 14:18:09'),
(4, NULL, 1, 10, 'proposal', 'surat_pernyataan_ketua', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-surat_pernyataan_ketua-20260415_141809.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 2, '2026-04-15 13:59:17', '2026-04-15 14:18:09'),
(5, NULL, 1, 10, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-surat_kesediaan_dosen-20260415_141809.pdf', 'SURAT KESEDIAAN DOSEN PEMBIMBING.pdf', 'submitted', 2, '2026-04-15 13:59:17', '2026-04-15 14:18:09'),
(6, NULL, 1, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/1/pitching/1776276357_3ba955f59c8795fb196f.pdf', '2-1.pdf', 'submitted', 1, '2026-04-15 17:42:58', '2026-04-15 18:05:57'),
(7, NULL, 1, 10, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_1/kopi-kudo-liar-bukti_perjanjian-20260416_044342.pdf', '2-1-6.pdf', 'submitted', 2, '2026-04-16 04:43:31', '2026-04-16 04:43:42'),
(8, NULL, 4, 20, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_4/pempek-buffe-proposal_utama-20260417_123939.pdf', 'SK Kelolosan Dana PMW Tahap I 2026-1.pdf', 'submitted', 1, '2026-04-17 12:39:39', '2026-04-17 12:39:39'),
(9, NULL, 4, 20, 'proposal', 'biodata', 'uploads/pmw/proposals/proposal_4/pempek-buffe-biodata-20260417_123939.pdf', '1776393311_05becb03cd1278e5867f.pdf', 'submitted', 1, '2026-04-17 12:39:39', '2026-04-17 12:39:39'),
(10, NULL, 4, 20, 'proposal', 'surat_pernyataan_ketua', 'uploads/pmw/proposals/proposal_4/pempek-buffe-surat_pernyataan_ketua-20260417_123939.pdf', '1776393139_5cd8893977572fea2178-1.pdf', 'submitted', 1, '2026-04-17 12:39:39', '2026-04-17 12:39:39'),
(11, NULL, 4, 20, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_4/pempek-buffe-surat_kesediaan_dosen-20260417_123939.pdf', '69e19b96c90308.53895540.pdf', 'submitted', 1, '2026-04-17 12:39:39', '2026-04-17 12:39:39'),
(12, NULL, 4, 20, 'proposal', 'ktm', 'uploads/pmw/proposals/proposal_4/pempek-buffe-ktm-20260417_132949.pdf', '1776393139_5cd8893977572fea2178-1.pdf', 'submitted', 3, '2026-04-17 12:39:39', '2026-04-17 13:29:49'),
(13, NULL, 4, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/4/pitching/1776438100_7878ecf8f5799253f425.pptx', 'My-Pitching.pptx', 'submitted', 1, '2026-04-17 13:32:39', '2026-04-17 15:01:40'),
(14, NULL, 4, 20, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_4/pempek-buffe-bukti_perjanjian-20260417_150640.pdf', '69e19b96c90308.53895540.pdf', 'submitted', 1, '2026-04-17 15:06:40', '2026-04-17 15:06:40'),
(15, NULL, 5, 24, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_5/serba-bisa-proposal_utama-20260419_175353.pdf', 'DOKUMEN PROPOSAL UTAMA.pdf', 'submitted', 1, '2026-04-19 17:53:53', '2026-04-19 17:53:53'),
(16, NULL, 5, 24, 'proposal', 'biodata', 'uploads/pmw/proposals/proposal_5/serba-bisa-biodata-20260419_175353.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 1, '2026-04-19 17:53:53', '2026-04-19 17:53:53'),
(17, NULL, 5, 24, 'proposal', 'surat_pernyataan_ketua', 'uploads/pmw/proposals/proposal_5/serba-bisa-surat_pernyataan_ketua-20260419_175353.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-04-19 17:53:53', '2026-04-19 17:53:53'),
(18, NULL, 5, 24, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_5/serba-bisa-surat_kesediaan_dosen-20260419_175353.pdf', 'SURAT KESEDIAAN DOSEN PEMBIMBING.pdf', 'submitted', 1, '2026-04-19 17:53:53', '2026-04-19 17:53:53'),
(19, NULL, 5, 24, 'proposal', 'ktm', 'uploads/pmw/proposals/proposal_5/serba-bisa-ktm-20260419_175353.pdf', 'SCAN KTM.pdf', 'submitted', 1, '2026-04-19 17:53:53', '2026-04-19 17:53:53'),
(20, NULL, 6, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/6/pitching/1777391880_660132023f8752eb23f2.pdf', 'LAPORAN FULL RICO PERUMDA.pdf', 'submitted', 1, '2026-04-28 15:58:00', '2026-04-28 15:58:00'),
(21, NULL, 6, 0, 'pitching', 'biodata', 'uploads/proposals/6/pitching/1777394388_2759ea74caeaa2730b91.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 1, '2026-04-28 16:39:48', '2026-04-28 16:39:48'),
(22, NULL, 6, 0, 'pitching', 'ktm', 'uploads/proposals/6/pitching/1777394394_7a2a138acf473612b4a6.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-04-28 16:39:54', '2026-04-28 16:39:54'),
(23, NULL, 6, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/6/pitching/1777394401_92a838c179f12518e483.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-04-28 16:40:01', '2026-04-28 16:40:01'),
(24, NULL, 6, 0, 'pitching', 'surat_kesediaan_dosen', 'uploads/proposals/6/pitching/1777394407_0f91bce9da64e80cdab2.pdf', 'SURAT KESEDIAAN DOSEN PEMBIMBING.pdf', 'submitted', 1, '2026-04-28 16:40:07', '2026-04-28 16:40:07'),
(25, NULL, 6, 26, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_6/yorozuya-proposal_utama-20260429_121357.pdf', 'DOKUMEN PROPOSAL UTAMA.pdf', 'submitted', 1, '2026-04-29 12:13:57', '2026-04-29 12:13:57'),
(26, NULL, 6, 26, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_6/yorozuya-bukti_perjanjian-20260429_145032.pdf', 'perjanjian_implementasi_ecaknyotuh.pdf', 'submitted', 2, '2026-04-29 14:50:16', '2026-04-29 14:50:32'),
(27, NULL, 8, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/8/pitching/1777469058_14c95579a18632f61fe4.pptx', 'My-Pitching.pptx', 'submitted', 1, '2026-04-29 20:24:18', '2026-04-29 20:24:18'),
(28, NULL, 8, 0, 'pitching', 'biodata', 'uploads/proposals/8/pitching/1777469064_f030458034d34933c4c7.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 1, '2026-04-29 20:24:24', '2026-04-29 20:24:24'),
(29, NULL, 8, 0, 'pitching', 'ktm', 'uploads/proposals/8/pitching/1777469069_df7fb2325479a46b8525.pdf', 'SCAN KTM.pdf', 'submitted', 1, '2026-04-29 20:24:29', '2026-04-29 20:24:29'),
(30, NULL, 8, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/8/pitching/1777469073_0ba625daf9eccfddec7b.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-04-29 20:24:33', '2026-04-29 20:24:33'),
(31, NULL, 9, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/9/pitching/1777469937_778dd81614cc9af06c12.pptx', 'My-Pitching.pptx', 'submitted', 1, '2026-04-29 20:38:57', '2026-04-29 20:38:57'),
(32, NULL, 9, 0, 'pitching', 'biodata', 'uploads/proposals/9/pitching/1777470031_f295053d5d1c17ddcc8e.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 1, '2026-04-29 20:40:31', '2026-04-29 20:40:31'),
(33, NULL, 9, 0, 'pitching', 'ktm', 'uploads/proposals/9/pitching/1777470037_ea2089ab394c39c32e28.pdf', 'SCAN KTM.pdf', 'submitted', 1, '2026-04-29 20:40:37', '2026-04-29 20:40:37'),
(34, NULL, 9, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/9/pitching/1777470043_5ced4dc861325ec8f644.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-04-29 20:40:43', '2026-04-29 20:40:43'),
(35, NULL, 9, 0, 'pitching', 'cashflow', 'uploads/proposals/9/pitching/1777470733_9410854451cbb8852128.pdf', 'cashflow.pdf', 'submitted', 1, '2026-04-29 20:52:13', '2026-04-29 20:52:13'),
(36, NULL, 8, 28, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_8/jasa-joki-web-terkemuka-proposal_utama-20260429_211446.pdf', 'DOKUMEN PROPOSAL UTAMA.pdf', 'submitted', 1, '2026-04-29 21:14:46', '2026-04-29 21:14:46'),
(37, NULL, 8, 28, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_8/jasa-joki-web-terkemuka-surat_kesediaan_dosen-20260429_211446.pdf', 'SURAT KESEDIAAN DOSEN PEMBIMBING.pdf', 'submitted', 1, '2026-04-29 21:14:46', '2026-04-29 21:14:46'),
(38, NULL, 9, 29, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_9/panda-koko-proposal_utama-20260429_212039.pdf', 'DOKUMEN PROPOSAL UTAMA.pdf', 'submitted', 1, '2026-04-29 21:20:39', '2026-04-29 21:20:39'),
(39, NULL, 9, 29, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_9/panda-koko-surat_kesediaan_dosen-20260429_212039.pdf', 'SURAT KESEDIAAN DOSEN PEMBIMBING.pdf', 'submitted', 1, '2026-04-29 21:20:39', '2026-04-29 21:20:39'),
(40, NULL, 8, 28, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_8/jasa-joki-web-terkemuka-bukti_perjanjian-20260429_225655.pdf', 'perjanjian_implementasi_ecaknyotuh.pdf', 'submitted', 1, '2026-04-29 22:56:55', '2026-04-29 22:56:55'),
(41, NULL, 9, 29, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_9/panda-koko-bukti_perjanjian-20260429_225730.pdf', 'perjanjian_implementasi_ecaknyotuh-2.pdf', 'submitted', 1, '2026-04-29 22:57:30', '2026-04-29 22:57:30'),
(49, NULL, 11, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/11/pitching/1777518572_8efca89095c88cfb5fb0.pdf', 'Kertas Putih Polos (3).pdf', 'submitted', 1, '2026-04-30 10:09:32', '2026-04-30 10:09:32'),
(50, NULL, 11, 0, 'pitching', 'biodata', 'uploads/proposals/11/pitching/1777518585_df4dbfc89215be486c75.pdf', 'Kertas Putih Polos (2).pdf', 'submitted', 1, '2026-04-30 10:09:45', '2026-04-30 10:09:45'),
(51, NULL, 11, 0, 'pitching', 'ktm', 'uploads/proposals/11/pitching/1777518589_88076ef08a8db82c8312.pdf', 'Kertas Putih Polos (2).pdf', 'submitted', 1, '2026-04-30 10:09:49', '2026-04-30 10:09:49'),
(52, NULL, 11, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/11/pitching/1777518592_c28175db99ee071caabf.pdf', 'Kertas Putih Polos (2).pdf', 'submitted', 1, '2026-04-30 10:09:52', '2026-04-30 10:09:52'),
(53, NULL, 11, 33, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_11/fdsgfdg-proposal_utama-20260430_101400.pdf', 'Kertas Putih Polos (3).pdf', 'submitted', 1, '2026-04-30 10:14:00', '2026-04-30 10:14:00'),
(54, NULL, 11, 33, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_11/fdsgfdg-surat_kesediaan_dosen-20260430_101400.pdf', 'Kertas Putih Polos (3).pdf', 'submitted', 1, '2026-04-30 10:14:00', '2026-04-30 10:14:00'),
(55, NULL, 11, 33, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_11/fdsgfdg-bukti_perjanjian-20260430_105437.pdf', 'Pertemuan 11.pdf', 'submitted', 1, '2026-04-30 10:54:37', '2026-04-30 10:54:37'),
(57, NULL, 13, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/13/pitching/1777643876_210b499a0b643122635b.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 20:57:56', '2026-05-01 20:57:56'),
(58, NULL, 13, 0, 'pitching', 'biodata', 'uploads/proposals/13/pitching/1777643880_c0affc8f507864bb72ac.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 20:58:00', '2026-05-01 20:58:00'),
(59, NULL, 13, 0, 'pitching', 'ktm', 'uploads/proposals/13/pitching/1777643883_daa123d9cf24d4ca4729.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 20:58:03', '2026-05-01 20:58:03'),
(60, NULL, 13, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/13/pitching/1777643887_2a0f97ca758fc1add948.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 20:58:07', '2026-05-01 20:58:07'),
(61, NULL, 14, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/14/pitching/1777645855_e7fa673f6a40ce012ab2.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:30:55', '2026-05-01 21:30:55'),
(62, NULL, 14, 0, 'pitching', 'biodata', 'uploads/proposals/14/pitching/1777645860_fe7d2a11ce69c8a1e395.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:31:00', '2026-05-01 21:31:00'),
(63, NULL, 14, 0, 'pitching', 'ktm', 'uploads/proposals/14/pitching/1777645865_b91be2d77f4568ec1542.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:31:05', '2026-05-01 21:31:05'),
(64, NULL, 14, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/14/pitching/1777645869_677e0619c391d0b2300b.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:31:09', '2026-05-01 21:31:09'),
(65, NULL, 14, 36, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_14/toko-kelontong-budi-proposal_utama-20260501_213519.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:35:19', '2026-05-01 21:35:19'),
(66, NULL, 14, 36, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_14/toko-kelontong-budi-surat_kesediaan_dosen-20260501_213519.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-05-01 21:35:19', '2026-05-01 21:35:19'),
(67, NULL, 15, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/15/pitching/1777692759_c4b40289fa065bfd810f.pdf', 'RUNDOWN PMW 2026..pdf', 'submitted', 1, '2026-05-02 10:32:39', '2026-05-02 10:32:39'),
(68, NULL, 15, 0, 'pitching', 'biodata', 'uploads/proposals/15/pitching/1777692771_13e5dc12d334e3aa5517.pdf', 'RUNDOWN PMW 2026..pdf', 'submitted', 1, '2026-05-02 10:32:51', '2026-05-02 10:32:51'),
(69, NULL, 15, 0, 'pitching', 'ktm', 'uploads/proposals/15/pitching/1777692783_ab44a3e2ac5d660628a0.pdf', 'RUNDOWN PMW 2026..pdf', 'submitted', 1, '2026-05-02 10:33:03', '2026-05-02 10:33:03'),
(70, NULL, 15, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/15/pitching/1777692788_15dd132882c567b0fef7.pdf', 'RUNDOWN PMW 2026..pdf', 'submitted', 1, '2026-05-02 10:33:08', '2026-05-02 10:33:08'),
(71, NULL, 24, 0, 'pitching', 'ktm', 'uploads/proposals/24/pitching/1779724486_e3bfa98ff26b876f40cd.pdf', 'KTM GABUNGAN TRINKETSKU.pdf', 'submitted', 1, '2026-05-05 20:01:56', '2026-05-25 22:54:46'),
(72, NULL, 27, 0, 'pitching', 'ktm', 'uploads/proposals/27/pitching/1778313355_e8824f17d4c765b456dd.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-05-09 14:55:55', '2026-05-09 14:55:55'),
(73, NULL, 33, 0, 'pitching', 'ktm', 'uploads/proposals/33/pitching/1778418658_34d931c8e51fe9107834.pdf', 'KTM TIM PMW AGENCY.pdf', 'submitted', 1, '2026-05-10 20:10:58', '2026-05-10 20:10:58'),
(74, NULL, 27, 0, 'pitching', 'biodata', 'uploads/proposals/27/pitching/1778427495_f6bad6bee545ec0dda15.pdf', 'Biodata Tim.pdf', 'submitted', 1, '2026-05-10 22:38:15', '2026-05-10 22:38:15'),
(75, NULL, 40, 0, 'pitching', 'cashflow', 'uploads/proposals/40/pitching/1778491737_bd2c9e3c27be0f2dacbc.pdf', 'cashflow.pdf', 'submitted', 1, '2026-05-11 16:28:57', '2026-05-11 16:28:57'),
(76, NULL, 57, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/57/pitching/1779199252_34413bf24a1bde403c6f.php', '300.pdf', 'submitted', 1, '2026-05-19 21:00:52', '2026-05-19 21:00:52'),
(77, NULL, 57, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/57/pitching/1779207191_d4601a7bf74e0855e27d.php', '300.pdf', 'submitted', 1, '2026-05-19 23:13:11', '2026-05-19 23:13:11'),
(78, NULL, 59, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/59/pitching/1779268244_17008842410e5bd337ef.pdf', 'TitikKampus PMW POLSRI_compressed.pdf', 'submitted', 1, '2026-05-20 15:40:44', '2026-05-20 16:10:44'),
(79, NULL, 59, 0, 'pitching', 'ktm', 'uploads/proposals/59/pitching/1779273546_e9657c8af83a054adc3b.pdf', 'KTM Gabungan_compressed.pdf', 'submitted', 1, '2026-05-20 17:39:06', '2026-05-20 17:39:06'),
(80, NULL, 49, 0, 'pitching', 'biodata', 'uploads/proposals/49/pitching/1779637699_90e35488829185c388d4.pdf', 'Biodata TIM PMW.pdf', 'submitted', 1, '2026-05-20 18:19:47', '2026-05-24 22:48:19'),
(81, NULL, 49, 0, 'pitching', 'ktm', 'uploads/proposals/49/pitching/1779636370_83cee2c23c52ade43406.pdf', 'KTM Gabungan 3.pdf', 'submitted', 1, '2026-05-20 18:35:29', '2026-05-24 22:26:10'),
(82, NULL, 53, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/53/pitching/1779284129_2c0e9344e37516caef43.pdf', 'Surat Pernyataan Ketua Tim Juniorers_Store.pdf', 'submitted', 1, '2026-05-20 20:35:29', '2026-05-20 20:35:29'),
(83, NULL, 53, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/53/pitching/1779407733_1ce20f4c8fb505de7224.pdf', 'Juniorers_Store_v2.pptx.pdf', 'submitted', 1, '2026-05-20 20:37:59', '2026-05-22 06:55:33'),
(84, NULL, 54, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/54/pitching/1779292861_cf57584dcb79034296db.pdf', 'BowlKita PPT.pdf', 'submitted', 1, '2026-05-20 23:01:01', '2026-05-20 23:01:01'),
(85, NULL, 54, 0, 'pitching', 'ktm', 'uploads/proposals/54/pitching/1779293218_fc579bad8af642170b04.pdf', 'KTM kelompok 7.pdf', 'submitted', 1, '2026-05-20 23:06:58', '2026-05-20 23:06:58'),
(86, NULL, 54, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/54/pitching/1779293222_f367cd8666878c011529.pdf', 'surat pernyataan ketua tim kel 7 pmw.pdf', 'submitted', 1, '2026-05-20 23:07:02', '2026-05-20 23:07:02'),
(87, NULL, 54, 0, 'pitching', 'biodata', 'uploads/proposals/54/pitching/1779339100_a163314465e10eab09c1.pdf', 'Biodata Tim kewirausahaan kel7  [1[.pdf', 'submitted', 1, '2026-05-21 11:51:40', '2026-05-21 11:51:40'),
(88, NULL, 53, 0, 'pitching', 'biodata', 'uploads/proposals/53/pitching/1779344625_ce2726c9121b75b17721.pdf', 'Biodata Tim Juniorers_Store.pdf', 'submitted', 1, '2026-05-21 13:23:45', '2026-05-21 13:23:45'),
(89, NULL, 61, 0, 'pitching', 'ktm', 'uploads/proposals/61/pitching/1779377490_95d4dadd5a7ffc30cb1d.pdf', 'FILE KTM GABUNGAN .pdf', 'submitted', 1, '2026-05-21 22:31:30', '2026-05-21 22:31:30'),
(90, NULL, 53, 0, 'pitching', 'ktm', 'uploads/proposals/53/pitching/1779382344_c4996c9163e8b63d6fbb.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-05-21 23:52:24', '2026-05-21 23:52:24'),
(91, NULL, 61, 0, 'pitching', 'biodata', 'uploads/proposals/61/pitching/1779382654_a008e2fe50b50797e59e.pdf', 'BIODATA TIM.pdf', 'submitted', 1, '2026-05-21 23:57:34', '2026-05-21 23:57:34'),
(92, NULL, 49, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/49/pitching/1779627973_029b7a82c688dcf14881.pdf', 'pernyataan ketua pengusul_.pdf', 'submitted', 1, '2026-05-22 00:10:37', '2026-05-24 20:06:13'),
(93, NULL, 61, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/61/pitching/1779421952_d2bfaf116db9176eead5.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-05-22 10:52:32', '2026-05-22 10:52:32'),
(94, NULL, 61, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/61/pitching/1779440910_6ddb0dbb0ecc4a53a4f6.pdf', 'Topi.co PPT_compressed.pdf', 'submitted', 1, '2026-05-22 15:59:11', '2026-05-22 16:08:30'),
(95, NULL, 61, 0, 'pitching', 'cashflow', 'uploads/proposals/61/pitching/1779440553_acdc37df0b296ce9f01e.pdf', 'CASHFLOW TOPICO.pdf', 'submitted', 1, '2026-05-22 16:02:33', '2026-05-22 16:02:33'),
(96, NULL, 66, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/66/pitching/1779509278_c5ed05065aeb945fc64b.pdf', 'proposal mazefoods-1 (1)_compressed.pdf', 'submitted', 1, '2026-05-23 11:07:58', '2026-05-23 11:07:58'),
(97, NULL, 70, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/70/pitching/1779634959_6ab2f93d9482ce2e0ee0.pdf', 'ppt kewirausahaan_compressed (1).pdf', 'submitted', 1, '2026-05-23 11:13:25', '2026-05-24 22:02:39'),
(98, NULL, 59, 0, 'pitching', 'biodata', 'uploads/proposals/59/pitching/1779597068_120fcad7581a837eb75b.pdf', 'Daftar Riwayat Hidup Ketua dan Anggota PMW.pdf', 'submitted', 1, '2026-05-23 14:21:25', '2026-05-24 11:31:08'),
(99, NULL, 59, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/59/pitching/1779520893_695276d55c1e4315d47c.pdf', 'surat pernyataan pengusul ketua.pdf', 'submitted', 1, '2026-05-23 14:21:33', '2026-05-23 14:21:33'),
(100, NULL, 46, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/46/pitching/1779526846_c816aa954f7372575069.pdf', 'Surat Pernyataan Ketua Pengusul PMW 2026.pdf', 'submitted', 1, '2026-05-23 15:44:12', '2026-05-23 16:00:46'),
(101, NULL, 46, 0, 'pitching', 'ktm', 'uploads/proposals/46/pitching/1779528009_4814cb7def62fb7b75e7.pdf', 'KTM gabungan .pdf', 'submitted', 1, '2026-05-23 16:20:09', '2026-05-23 16:20:09'),
(102, NULL, 46, 0, 'pitching', 'biodata', 'uploads/proposals/46/pitching/1779528030_3617f4cba593ac2ca7f7.pdf', 'BIodata Tim Pengusul PMW 2026 Final.pdf', 'submitted', 1, '2026-05-23 16:20:30', '2026-05-23 16:20:30'),
(103, NULL, 46, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/46/pitching/1779528954_45850ff65833df38126d.pdf', 'PPT Pitching Desk Crumble Co_compressed.pdf', 'submitted', 1, '2026-05-23 16:35:54', '2026-05-23 16:35:54'),
(104, NULL, 50, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/50/pitching/1779600140_a4e7ea25b612916eb866.pdf', 'Surat Pernyataan Ketua .pdf', 'submitted', 1, '2026-05-23 16:52:03', '2026-05-24 12:22:20'),
(105, NULL, 60, 0, 'pitching', 'ktm', 'uploads/proposals/60/pitching/1779536312_485735320d8e9dd08077.pdf', 'KTM gabungan MILKY QUEST.pdf', 'submitted', 1, '2026-05-23 18:38:32', '2026-05-23 18:38:32'),
(106, NULL, 60, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/60/pitching/1779536428_a8f08b9bd4e846dcf5e7.pdf', 'Surat Pernyataan Ketua Milky Quest.pdf', 'submitted', 1, '2026-05-23 18:40:28', '2026-05-23 18:40:28'),
(107, NULL, 60, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/60/pitching/1779536587_55a637f7e32bf004235a.pdf', 'Milky Quest PPT.pdf', 'submitted', 1, '2026-05-23 18:43:07', '2026-05-23 18:43:07'),
(108, NULL, 60, 0, 'pitching', 'biodata', 'uploads/proposals/60/pitching/1779537659_7e80355874ab47683a9a.pdf', 'Biodata Tim Milky Quest.pdf', 'submitted', 1, '2026-05-23 19:00:59', '2026-05-23 19:00:59'),
(109, NULL, 50, 0, 'pitching', 'ktm', 'uploads/proposals/50/pitching/1779545627_baf0a574031d5280a951.pdf', 'KTM Gabungan.pdf', 'submitted', 1, '2026-05-23 21:13:47', '2026-05-23 21:13:47'),
(110, NULL, 75, 0, 'pitching', 'ktm', 'uploads/proposals/75/pitching/1779558552_2006e22820c20d42efaa.pdf', 'KTM LYTHEROS.pdf', 'submitted', 1, '2026-05-24 00:49:12', '2026-05-24 00:49:12'),
(111, NULL, 75, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/75/pitching/1779558611_27ba27b41773b3aa24c3.pdf', 'Surat_Pernyataan_Ketua_PMW.pdf', 'submitted', 1, '2026-05-24 00:50:11', '2026-05-24 00:50:11'),
(112, NULL, 75, 0, 'pitching', 'biodata', 'uploads/proposals/75/pitching/1779560822_7cbd1d8df2ac7a88e7a4.pdf', 'BIODATA TIM PMW.pdf', 'submitted', 1, '2026-05-24 01:27:02', '2026-05-24 01:27:02'),
(113, NULL, 50, 0, 'pitching', 'biodata', 'uploads/proposals/50/pitching/1779582045_04d72e025de3ecb1c5e6.pdf', 'IDENTITAS GABUNGAN TIM.pdf', 'submitted', 1, '2026-05-24 07:20:45', '2026-05-24 07:20:45'),
(114, NULL, 68, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/68/pitching/1779660864_5c8f5687099b414dad3b.pdf', 'Surat pernyataan ketua 2026 (1).pdf', 'submitted', 1, '2026-05-24 11:00:13', '2026-05-25 05:14:24'),
(115, NULL, 68, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/68/pitching/1779599097_d09d6b8c82bf765302de.pdf', 'Pancong Waffle Genz__.pdf', 'submitted', 1, '2026-05-24 11:14:41', '2026-05-24 12:04:57'),
(116, NULL, 68, 0, 'pitching', 'biodata', 'uploads/proposals/68/pitching/1779596113_8273b3325eecb27eb821.pdf', 'riwayat tim.pdf', 'submitted', 1, '2026-05-24 11:15:13', '2026-05-24 11:15:13'),
(117, NULL, 68, 0, 'pitching', 'ktm', 'uploads/proposals/68/pitching/1779597404_1c673f6e97f9ffef6373.pdf', 'KTM.pdf', 'submitted', 1, '2026-05-24 11:36:44', '2026-05-24 11:36:44'),
(118, NULL, 74, 0, 'pitching', 'biodata', 'uploads/proposals/74/pitching/1779599046_4f237ae4a58c54a0fbf8.pdf', 'Daftar Riwayat Hidup BIODATA PMW.pdf', 'submitted', 1, '2026-05-24 12:04:06', '2026-05-24 12:04:06'),
(119, NULL, 49, 0, 'pitching', 'cashflow', 'uploads/proposals/49/pitching/1779600082_6fdabf64cf45b1ab76da.pdf', 'Chashflow bukti transaksi.pdf', 'submitted', 1, '2026-05-24 12:05:12', '2026-05-24 12:21:22'),
(120, NULL, 76, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/76/pitching/1779601362_8d423789b081a20fc9fb.pdf', 'Proposal_P2MW_KalaWangi fix.pdf', 'submitted', 1, '2026-05-24 12:30:13', '2026-05-24 12:42:42'),
(121, NULL, 50, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/50/pitching/1779601047_572d8559ffb5d8698731.pdf', 'Pitching desk Lumiara_20260524_111118_0000-compressed.pdf', 'submitted', 1, '2026-05-24 12:37:27', '2026-05-24 12:37:27'),
(122, NULL, 71, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/71/pitching/1779601123_d2ed37811a1cb396e545.pdf', 'Charmate.pdf', 'submitted', 1, '2026-05-24 12:38:43', '2026-05-24 12:38:43'),
(123, NULL, 76, 0, 'pitching', 'ktm', 'uploads/proposals/76/pitching/1779602281_fe0c0a7ba6ae863a881a.pdf', 'KTM Gabungan.pdf', 'submitted', 1, '2026-05-24 12:58:01', '2026-05-24 12:58:01'),
(124, NULL, 75, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/75/pitching/1779602484_f6ef6d2540c642bd1423.pptx', 'LYTHEROS.pptx', 'submitted', 1, '2026-05-24 13:01:24', '2026-05-24 13:01:24'),
(125, NULL, 71, 0, 'pitching', 'biodata', 'uploads/proposals/71/pitching/1779603780_bfca91d893c33a8f31ef.pdf', 'Biodata Anggota Charmate.pdf', 'submitted', 1, '2026-05-24 13:23:00', '2026-05-24 13:23:00'),
(126, NULL, 49, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/49/pitching/1779637787_478463a9480d24cae881.pdf', 'PPT Pitching Desk kewirausahaan berkembang.pdf', 'submitted', 1, '2026-05-24 13:25:38', '2026-05-24 22:49:47'),
(127, NULL, 71, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/71/pitching/1779604271_1090569b91245a6c0b9d.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-05-24 13:31:11', '2026-05-24 13:31:11'),
(128, NULL, 47, 0, 'pitching', 'ktm', 'uploads/proposals/47/pitching/1779605950_3748e32593d0718d53bd.pdf', 'CamScanner 24-05-2026 13.52.pdf', 'submitted', 1, '2026-05-24 13:59:10', '2026-05-24 13:59:10'),
(129, NULL, 47, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/47/pitching/1779605968_20378de7073719e74d1f.pdf', 'CamScanner 24-05-2026 13.55.pdf', 'submitted', 1, '2026-05-24 13:59:28', '2026-05-24 13:59:28'),
(130, NULL, 47, 0, 'pitching', 'biodata', 'uploads/proposals/47/pitching/1779605986_bbbae154b352d49cde2d.pdf', 'CamScanner 24-05-2026 13.56.pdf', 'submitted', 1, '2026-05-24 13:59:46', '2026-05-24 13:59:46'),
(131, NULL, 47, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/47/pitching/1779606638_00bdc7548ad9de80669a.pdf', 'akajiwa ppt (1)-compressed.pdf', 'submitted', 1, '2026-05-24 14:10:38', '2026-05-24 14:10:38'),
(132, NULL, 71, 0, 'pitching', 'ktm', 'uploads/proposals/71/pitching/1779609021_9f2d9c3a9d9840ad2cf5.pdf', 'KTM Anggota.pdf', 'submitted', 1, '2026-05-24 14:43:41', '2026-05-24 14:50:21'),
(133, NULL, 26, 0, 'pitching', 'ktm', 'uploads/proposals/26/pitching/1779612764_cc2cd33536566541238d.pdf', '1000228625.pdf', 'submitted', 1, '2026-05-24 15:52:44', '2026-05-24 15:52:44'),
(134, NULL, 31, 0, 'pitching', 'biodata', 'uploads/proposals/31/pitching/1779613900_032ec59bbe567b0a1a1d.pdf', 'Biodata ketua dan anggota.pdf', 'submitted', 1, '2026-05-24 16:11:40', '2026-05-24 16:11:40'),
(135, NULL, 76, 0, 'pitching', 'biodata', 'uploads/proposals/76/pitching/1779615194_a0535e18ea373341b5a4.pdf', 'Bio Data Anggota.pdf', 'submitted', 1, '2026-05-24 16:33:14', '2026-05-24 16:33:14'),
(136, NULL, 76, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/76/pitching/1779615611_f66b33409b3392688fe5.pdf', 'SURAT PERNYATAAN KETUA PELAKSANA.pdf', 'submitted', 1, '2026-05-24 16:40:11', '2026-05-24 16:40:11'),
(137, NULL, 67, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/67/pitching/1779620954_f53e533eb7aeeb69b797.pdf', 'PPT SlaySide MUA.pdf', 'submitted', 1, '2026-05-24 18:09:14', '2026-05-24 18:09:14'),
(138, NULL, 31, 0, 'pitching', 'ktm', 'uploads/proposals/31/pitching/1779623737_6c8a05ed889094d29ef6.pdf', 'ktm_kelompok_pmw.pdf', 'submitted', 1, '2026-05-24 18:55:37', '2026-05-24 18:55:37'),
(139, NULL, 31, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/31/pitching/1779623805_a80955b3599a334a9ffa.pdf', 'ppt_weborastudio.pdf', 'submitted', 1, '2026-05-24 18:56:45', '2026-05-24 18:56:45'),
(140, NULL, 33, 0, 'pitching', 'biodata', 'uploads/proposals/33/pitching/1779625648_5afa068604801535a1ef.pdf', 'BIODATA TIM PMW ARDHANA AGENCY.pdf', 'submitted', 1, '2026-05-24 19:27:28', '2026-05-24 19:27:28'),
(141, NULL, 67, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/67/pitching/1779629122_ce0c527d299626afcbe7.pdf', 'Surat Pernyataan slayside.pdf', 'submitted', 1, '2026-05-24 20:25:22', '2026-05-24 20:25:22'),
(142, NULL, 78, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/78/pitching/1779630000_aae187f2bb336508d027.pdf', 'SURAT PERNYATAAN KETUA PENGUSUL.pdf', 'submitted', 1, '2026-05-24 20:40:00', '2026-05-24 20:40:00'),
(143, NULL, 78, 0, 'pitching', 'ktm', 'uploads/proposals/78/pitching/1779630434_4bef0724f8e15d3bee17.pdf', 'KTM GABUNGAN ANGGOTA.pdf', 'submitted', 1, '2026-05-24 20:47:14', '2026-05-24 20:47:14'),
(144, NULL, 67, 0, 'pitching', 'biodata', 'uploads/proposals/67/pitching/1779630741_180349fc2c6aa458fcc9.pdf', 'BIODATA TIM.pdf', 'submitted', 1, '2026-05-24 20:52:21', '2026-05-24 20:52:21'),
(145, NULL, 67, 0, 'pitching', 'ktm', 'uploads/proposals/67/pitching/1779630748_9510a831950214a0adb0.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-05-24 20:52:28', '2026-05-24 20:52:28'),
(146, NULL, 33, 0, 'pitching', 'cashflow', 'uploads/proposals/33/pitching/1779631556_a5893830fe09c6537d05.pdf', 'FINAL CASHFLOW ARDHANA AGENCY.pdf', 'submitted', 1, '2026-05-24 21:05:56', '2026-05-24 21:05:56'),
(147, NULL, 20, 0, 'pitching', 'ktm', 'uploads/proposals/20/pitching/1779631697_40b0e7a46e4ac1f23ffd.pdf', 'KTM (1).pdf', 'submitted', 1, '2026-05-24 21:08:17', '2026-05-24 21:08:17'),
(148, NULL, 81, 0, 'pitching', 'biodata', 'uploads/proposals/81/pitching/1779632067_643b1868dabc414319f5.pdf', 'DAFTAR RIWAYAT HIDUP BIODATA PMW.pdf', 'submitted', 1, '2026-05-24 21:13:57', '2026-05-24 21:14:27'),
(149, NULL, 81, 0, 'pitching', 'ktm', 'uploads/proposals/81/pitching/1779632071_e23250af1f5f6b3b92a2.pdf', 'CamScanner 24-05-2026 20.17.pdf', 'submitted', 1, '2026-05-24 21:14:31', '2026-05-24 21:14:31'),
(150, NULL, 81, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/81/pitching/1779632075_204e21fa0e51845cf7f7.pdf', 'SURAT PERNYATAAN KESEDIAAN MENJALANKAN USAHA PROGRAM MAHASISWA WIRAUSAHA 2026.pdf', 'submitted', 1, '2026-05-24 21:14:35', '2026-05-24 21:14:35'),
(151, NULL, 33, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/33/pitching/1779632152_a0919436449344fa5e57.pdf', 'PITCH DESK PMW ARDHANA_compressed.pdf', 'submitted', 1, '2026-05-24 21:15:52', '2026-05-24 21:15:52'),
(152, NULL, 81, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/81/pitching/1779632663_78afdc0d5cbadf4c7b06.pdf', 'CLEAN REANGERS_compressed.pdf', 'submitted', 1, '2026-05-24 21:24:23', '2026-05-24 21:24:23'),
(153, NULL, 70, 0, 'pitching', 'biodata', 'uploads/proposals/70/pitching/1779633521_f02f24208a5e47c13b29.pdf', 'daftar riwayat.pdf', 'submitted', 1, '2026-05-24 21:38:41', '2026-05-24 21:38:41'),
(154, NULL, 70, 0, 'pitching', 'ktm', 'uploads/proposals/70/pitching/1779634030_884deff26687e576639e.pdf', 'KTM gabungan.pdf', 'submitted', 1, '2026-05-24 21:47:10', '2026-05-24 21:47:10'),
(155, NULL, 70, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/70/pitching/1779634119_5bf01491ef8427ce675b.pdf', 'surat pernyataan ketua tim.pdf', 'submitted', 1, '2026-05-24 21:48:39', '2026-05-24 21:48:39'),
(156, NULL, 83, 0, 'pitching', 'ktm', 'uploads/proposals/83/pitching/1779634354_9e8051c7552e2a62c0cf.pdf', 'KTM GABUNGAN SIOMAY 4U.pdf', 'submitted', 1, '2026-05-24 21:52:34', '2026-05-24 21:52:34'),
(157, NULL, 65, 0, 'pitching', 'ktm', 'uploads/proposals/65/pitching/1779637285_0e6c070d3c754a130665.pdf', 'KTM Gabungan.pdf', 'submitted', 1, '2026-05-24 22:41:25', '2026-05-24 22:41:25'),
(158, NULL, 78, 0, 'pitching', 'biodata', 'uploads/proposals/78/pitching/1779637818_60439e96f51389730cc4.pdf', 'Biodata Tim.pdf', 'submitted', 1, '2026-05-24 22:45:46', '2026-05-24 22:50:18'),
(159, NULL, 78, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/78/pitching/1779637789_3dfab13171609daf2f65.pdf', 'BiDi Memo 3.pdf', 'submitted', 1, '2026-05-24 22:49:49', '2026-05-24 22:49:49'),
(160, NULL, 69, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/69/pitching/1779638939_cdad22fae5f1d3f56e27.pdf', 'SURAT PERNYATAAN KETUA TIM.pdf', 'submitted', 1, '2026-05-24 23:08:59', '2026-05-24 23:08:59'),
(161, NULL, 69, 0, 'pitching', 'biodata', 'uploads/proposals/69/pitching/1779639680_b9beadd61597baf6db40.pdf', 'BIODATA TIM.pdf', 'submitted', 1, '2026-05-24 23:21:20', '2026-05-24 23:21:20'),
(162, NULL, 69, 0, 'pitching', 'ktm', 'uploads/proposals/69/pitching/1779640099_b4781e5a9f22cd381084.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-05-24 23:28:19', '2026-05-24 23:28:19'),
(163, NULL, 69, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/69/pitching/1779641934_8aa1f5cf1a4a3b0d80cf.pptx', 'bloomie_studio.pptx', 'submitted', 1, '2026-05-24 23:58:54', '2026-05-24 23:58:54'),
(164, NULL, 77, 0, 'pitching', 'ktm', 'uploads/proposals/77/pitching/1779642886_c2906c5f16421a53abdc.pdf', 'KTM FELTORIA.pdf', 'submitted', 1, '2026-05-25 00:11:29', '2026-05-25 00:14:46'),
(165, NULL, 77, 0, 'pitching', 'biodata', 'uploads/proposals/77/pitching/1779642705_82fb58d4cb148314b292.pdf', 'BIODATA TIM FELTORIA.pdf', 'submitted', 1, '2026-05-25 00:11:45', '2026-05-25 00:11:45'),
(166, NULL, 77, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/77/pitching/1779642839_e9898224765a9e4a182a.pdf', 'Surat Pernyataan Ketua.pdf', 'submitted', 1, '2026-05-25 00:13:59', '2026-05-25 00:13:59'),
(167, NULL, 77, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/77/pitching/1779644055_0061af625c1d8826dd99.pdf', 'Biru Putih Profesional Sidang Skripsi Presentasi-dikompresi.pdf', 'submitted', 1, '2026-05-25 00:34:15', '2026-05-25 00:34:15'),
(168, NULL, 80, 0, 'pitching', 'biodata', 'uploads/proposals/80/pitching/1779646469_7b1a29b9be00d9d910b9.pdf', 'BIODATA TIM.pdf', 'submitted', 1, '2026-05-25 01:14:29', '2026-05-25 01:14:29'),
(169, NULL, 80, 0, 'pitching', 'ktm', 'uploads/proposals/80/pitching/1779646476_325d6807187a35ec1a82.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-05-25 01:14:36', '2026-05-25 01:14:36'),
(170, NULL, 20, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/20/pitching/1779648156_299a5ad1297adefdfb69.pdf', 'PPT KICKSPARKLE.pdf', 'submitted', 1, '2026-05-25 01:42:36', '2026-05-25 01:42:36'),
(171, NULL, 80, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/80/pitching/1779648472_b81393a82521c22afabc.pdf', 'Membangun Pengalaman Fashion Modest Melalui Hijab Stylish dan Berkesan_compressed (1).pdf', 'submitted', 1, '2026-05-25 01:47:52', '2026-05-25 01:47:52'),
(172, NULL, 26, 0, 'pitching', 'biodata', 'uploads/proposals/26/pitching/1779666265_7b2ce83530da8816c508.pdf', 'BIODATA TIM.pdf', 'submitted', 1, '2026-05-25 06:44:25', '2026-05-25 06:44:25'),
(173, NULL, 63, 0, 'pitching', 'ktm', 'uploads/proposals/63/pitching/1779668508_32bf92e601ddf862953d.pdf', 'ktm aromelle.pdf', 'submitted', 1, '2026-05-25 07:21:48', '2026-05-25 07:21:48'),
(174, NULL, 63, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/63/pitching/1779669044_3ed7944c9d6c7f93922a.bin', 'AROMELLE (1)_compressed.pptx', 'submitted', 1, '2026-05-25 07:30:44', '2026-05-25 07:30:44'),
(175, NULL, 52, 0, 'pitching', 'ktm', 'uploads/proposals/52/pitching/1779671361_073f72f48c234c942040.pdf', 'DOC-20260525-WA0022..pdf', 'submitted', 1, '2026-05-25 08:09:21', '2026-05-25 08:09:21'),
(176, NULL, 52, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/52/pitching/1779672297_0a0df8cae10e4e3d2d65.pdf', 'Surat pernyataan Ketua Charmu-1.pdf', 'submitted', 1, '2026-05-25 08:24:57', '2026-05-25 08:24:57'),
(177, NULL, 52, 0, 'pitching', 'biodata', 'uploads/proposals/52/pitching/1779673863_352afdca1a5e5dd89641.pdf', 'biodata pmw.pdf', 'submitted', 1, '2026-05-25 08:50:29', '2026-05-25 08:51:03'),
(178, NULL, 52, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/52/pitching/1779674626_92a0fd770876cb61411c.pdf', 'DOC-20260525-WA0019..pdf', 'submitted', 1, '2026-05-25 09:03:46', '2026-05-25 09:03:46'),
(179, NULL, 33, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/33/pitching/1779675833_12cc88cd164b19943e14.pdf', 'SURAT PERNYATAAN KETUA TIM PMW AGENCY.pdf', 'submitted', 1, '2026-05-25 09:23:53', '2026-05-25 09:23:53'),
(180, NULL, 51, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/51/pitching/1779679307_734aac2fcb732e4fdbb4.bin', 'Risa Oktavia PMW_20260525_101902_0000.pptx', 'submitted', 1, '2026-05-25 09:51:50', '2026-05-25 10:21:47'),
(181, NULL, 31, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/31/pitching/1779677834_ff9bb2c991784fc81c5e.pdf', 'surat pernyataan ketua pmw webora_studio.pdf', 'submitted', 1, '2026-05-25 09:57:14', '2026-05-25 09:57:14'),
(182, NULL, 80, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/80/pitching/1779677909_18ff9f8cd07ca225e178.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-05-25 09:58:29', '2026-05-25 09:58:29'),
(183, NULL, 83, 0, 'pitching', 'biodata', 'uploads/proposals/83/pitching/1779679235_7eb166f0027273d927d2.pdf', 'Biodata Tim PMW.pdf', 'submitted', 1, '2026-05-25 10:20:35', '2026-05-25 10:20:35'),
(184, NULL, 83, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/83/pitching/1779679239_9dd5a675f6858ec32233.pdf', 'Pernyataan Ketua Siomay4u.pdf', 'submitted', 1, '2026-05-25 10:20:39', '2026-05-25 10:20:39'),
(185, NULL, 63, 0, 'pitching', 'biodata', 'uploads/proposals/63/pitching/1779680411_8bf26793113679739015.pdf', 'biodata aromelle.pdf', 'submitted', 1, '2026-05-25 10:40:11', '2026-05-25 10:40:11'),
(186, NULL, 63, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/63/pitching/1779690126_1c37f7a487221c505ded.pdf', 'surat pernyataan.pdf', 'submitted', 1, '2026-05-25 10:40:32', '2026-05-25 13:22:06'),
(187, NULL, 65, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/65/pitching/1779681374_e9c33c2de8b540d7d7ec.pdf', 'Usaha Pemula_Sik Sak Sock_Nadila, M. Aidil, Fauziah, Riani_PMWPOLSRI2026.pdf', 'submitted', 1, '2026-05-25 10:56:14', '2026-05-25 10:56:14'),
(188, NULL, 31, 0, 'pitching', 'cashflow', 'uploads/proposals/31/pitching/1779682341_54343af5c145c7ad8aa5.pdf', 'cashflow pmw.pdf', 'submitted', 1, '2026-05-25 11:12:21', '2026-05-25 11:12:21'),
(189, NULL, 65, 0, 'pitching', 'biodata', 'uploads/proposals/65/pitching/1779686038_cab16c6369ca4ebf2258.pdf', 'Biodata TIm_PMWPOLSRI2026.pdf', 'submitted', 1, '2026-05-25 12:13:58', '2026-05-25 12:13:58'),
(190, NULL, 65, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/65/pitching/1779686043_790e0819513c7e1c961e.pdf', 'Surat Pernyataan Ketua_PMWPOLSRI2026.pdf', 'submitted', 1, '2026-05-25 12:14:03', '2026-05-25 12:14:03'),
(191, NULL, 26, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/26/pitching/1779686106_ea3aa5240bdc5da6f244.pdf', 'CamScanner 25-05-2026 12.13.pdf', 'submitted', 1, '2026-05-25 12:15:06', '2026-05-25 12:15:06'),
(192, NULL, 66, 0, 'pitching', 'biodata', 'uploads/proposals/66/pitching/1779687292_f9cc02fe9fcf2ac648c9.pdf', 'Biodata Tim kewirausahaan kel6 4MIM.pdf', 'submitted', 1, '2026-05-25 12:34:52', '2026-05-25 12:34:52'),
(193, NULL, 66, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/66/pitching/1779687405_0b0a38cf00765ca122f3.pdf', 'surat pernyataan ketua tim .pdf', 'submitted', 1, '2026-05-25 12:36:45', '2026-05-25 12:36:45'),
(194, NULL, 74, 0, 'pitching', 'ktm', 'uploads/proposals/74/pitching/1779688701_911bf2f2c7f07155f726.pdf', 'DOC-20260525-WA0015..pdf', 'submitted', 1, '2026-05-25 12:58:21', '2026-05-25 12:58:21'),
(195, NULL, 74, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/74/pitching/1779688743_d93a60e8a7c67433d1aa.pdf', 'DOC-20260525-WA0009..pdf', 'submitted', 1, '2026-05-25 12:59:03', '2026-05-25 12:59:03'),
(196, NULL, 83, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/83/pitching/1779689875_a439d8f0256787f97b8d.pdf', 'PPT Pitching Desk kewirausahaan.pdf', 'submitted', 1, '2026-05-25 13:17:55', '2026-05-25 13:17:55'),
(197, NULL, 86, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/86/pitching/1779691565_e7d3ff6ce054873e21d1.pdf', 'proposal FAJAR RAYA_compressed.pdf', 'submitted', 1, '2026-05-25 13:46:05', '2026-05-25 13:46:05'),
(198, NULL, 86, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/86/pitching/1779692762_64dbcc4e798b39068b31.pdf', 'surat pengesahan ketua fajar.pdf', 'submitted', 1, '2026-05-25 14:06:02', '2026-05-25 14:06:02'),
(199, NULL, 51, 0, 'pitching', 'biodata', 'uploads/proposals/51/pitching/1779693091_f966b0815efa80cf57d2.pdf', 'DOC-20260525-WA0009..pdf', 'submitted', 1, '2026-05-25 14:09:56', '2026-05-25 14:11:31'),
(200, NULL, 51, 0, 'pitching', 'ktm', 'uploads/proposals/51/pitching/1779693071_7b2f2a9714d6a3925e74.pdf', 'Cetak Bukti Pemutahiran Data (1).pdf', 'submitted', 1, '2026-05-25 14:11:11', '2026-05-25 14:11:11'),
(201, NULL, 86, 0, 'pitching', 'ktm', 'uploads/proposals/86/pitching/1779694277_3799858815f1c2cdd285.pdf', 'ktm 1.pdf', 'submitted', 1, '2026-05-25 14:31:17', '2026-05-25 14:31:17'),
(202, NULL, 20, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/20/pitching/1779695798_154f66dd9c14d7721919.pdf', 'SURAT PERNYATAAN KETUAA.pdf', 'submitted', 1, '2026-05-25 14:39:53', '2026-05-25 14:56:38'),
(203, NULL, 32, 0, 'pitching', 'biodata', 'uploads/proposals/32/pitching/1779695035_0abd90192d4556149890.pdf', 'BIODATA MEMORIES_PALEMBANG.pdf', 'submitted', 1, '2026-05-25 14:43:55', '2026-05-25 14:43:55'),
(204, NULL, 32, 0, 'pitching', 'ktm', 'uploads/proposals/32/pitching/1779695087_053e527863dfefc4a8a2.pdf', 'KTM MEMORIES_PALEMBANG.pdf', 'submitted', 1, '2026-05-25 14:44:47', '2026-05-25 14:44:47'),
(205, NULL, 32, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/32/pitching/1779695117_3f646c05dd177528769d.pdf', 'PPT Pitching Desk_Pemula_MEMORIES.pdf', 'submitted', 1, '2026-05-25 14:45:17', '2026-05-25 14:45:17'),
(206, NULL, 20, 0, 'pitching', 'biodata', 'uploads/proposals/20/pitching/1779695628_ab33304afba15d2186af.pdf', 'Biodata_M_Roihan_Baariq.pdf', 'submitted', 1, '2026-05-25 14:53:48', '2026-05-25 14:53:48'),
(207, NULL, 86, 0, 'pitching', 'biodata', 'uploads/proposals/86/pitching/1779698266_acd6cdf47fdc8a1b5e09.pdf', 'Biodata Tim kewirausahaan kel 2 4MIM.pdf', 'submitted', 1, '2026-05-25 15:37:46', '2026-05-25 15:37:46'),
(208, NULL, 32, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/32/pitching/1779700171_07f495617ead771a0997.pdf', 'SURAT PERNYATAAN KETUA PENGUSUL.pdf', 'submitted', 1, '2026-05-25 16:09:31', '2026-05-25 16:09:31'),
(209, NULL, 51, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/51/pitching/1779702397_6e8dfd20b959424ebb86.pdf', 'DOC-20260525-WA0015..pdf', 'submitted', 1, '2026-05-25 16:46:37', '2026-05-25 16:46:37'),
(210, NULL, 56, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/56/pitching/1779705940_e41d2c361529470d4543.pdf', 'Proposal Bisnis ARCTECH CCTV.pdf', 'submitted', 1, '2026-05-25 17:45:40', '2026-05-25 17:45:40'),
(211, NULL, 56, 0, 'pitching', 'cashflow', 'uploads/proposals/56/pitching/1779706612_d5f637fb15fcb76fe24a.pdf', 'Cashflow Arctech CCTV.pdf', 'submitted', 1, '2026-05-25 17:56:52', '2026-05-25 17:56:52'),
(212, NULL, 56, 0, 'pitching', 'ktm', 'uploads/proposals/56/pitching/1779707435_67632e2f52fb4ede51c4.pdf', 'KTM Arctech cctv.pdf', 'submitted', 1, '2026-05-25 18:10:35', '2026-05-25 18:10:35'),
(213, NULL, 56, 0, 'pitching', 'biodata', 'uploads/proposals/56/pitching/1779708328_67994ad4f7a3355cb462.pdf', 'Biodata Tim kewirausahaan keL1.pdf', 'submitted', 1, '2026-05-25 18:25:28', '2026-05-25 18:25:28'),
(214, NULL, 74, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/74/pitching/1779709322_8f8d431231a0a6ce94a7.pdf', 'CREAVORY Project Presentation_compressed.pdf', 'submitted', 1, '2026-05-25 18:42:02', '2026-05-25 18:42:02'),
(215, NULL, 51, 0, 'pitching', 'cashflow', 'uploads/proposals/51/pitching/1779714035_84767de09d28b1e217f3.pdf', 'Laporan Arus Kas Bakaran Risa.pdf', 'submitted', 1, '2026-05-25 20:00:35', '2026-05-25 20:00:35'),
(216, NULL, 87, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/87/pitching/1779719290_a834dcdf57276ed2053c.bin', 'Pitch Deck MY SIOMAY 2026.pptx', 'submitted', 1, '2026-05-25 21:28:10', '2026-05-25 21:28:10'),
(217, NULL, 56, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/56/pitching/1779719844_53d5bc18aaffc856e9cc.pdf', 'Surat Pernyataan Ketua.pdf', 'submitted', 1, '2026-05-25 21:36:33', '2026-05-25 21:37:24'),
(218, NULL, 66, 0, 'pitching', 'ktm', 'uploads/proposals/66/pitching/1779719929_10d8f76d40b890dbfab0.pdf', 'KTM GABUNGAN MAHASISWA .pdf', 'submitted', 1, '2026-05-25 21:38:49', '2026-05-25 21:38:49'),
(219, NULL, 26, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/26/pitching/1779721718_eacd0af438e2169234c0.pdf', 'PPT SORANA ORGANIZER_compressed.pdf', 'submitted', 1, '2026-05-25 22:08:38', '2026-05-25 22:08:38'),
(220, NULL, 24, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/24/pitching/1779724008_011d4d8c0dc35e67cde3.pdf', 'Surat Pernyataan Ketua TrinketsKu.pdf', 'submitted', 1, '2026-05-25 22:46:48', '2026-05-25 22:46:48'),
(221, NULL, 72, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/72/pitching/1779724441_112de483d5fc3c77470c.pdf', 'PPT Pitching Desk Pemula_Dinni_Noye UbePop.pdf', 'submitted', 1, '2026-05-25 22:54:01', '2026-05-25 22:54:01'),
(222, NULL, 72, 0, 'pitching', 'biodata', 'uploads/proposals/72/pitching/1779724457_97f80b59654e16164c17.pdf', 'Biodata Pengusul PMW_Dinni.pdf', 'submitted', 1, '2026-05-25 22:54:17', '2026-05-25 22:54:17'),
(223, NULL, 72, 0, 'pitching', 'ktm', 'uploads/proposals/72/pitching/1779724477_cf58f8ee0c7a7ba28f6c.pdf', 'KTM (dinni).pdf', 'submitted', 1, '2026-05-25 22:54:37', '2026-05-25 22:54:37'),
(224, NULL, 72, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/72/pitching/1779724485_88d8c50b9f3c720b24c1.pdf', 'Surat Pernyataan Pengusul PMW_Dinni.pdf', 'submitted', 1, '2026-05-25 22:54:45', '2026-05-25 22:54:45'),
(225, NULL, 27, 0, 'pitching', 'cashflow', 'uploads/proposals/27/pitching/1779726121_6deeaca713b0916a2d44.pdf', 'CashFLow.pdf', 'submitted', 1, '2026-05-25 23:22:01', '2026-05-25 23:22:01'),
(226, NULL, 27, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/27/pitching/1779726192_0e615ff689bfd42df04f.pdf', 'Surat Pernyataan Ketua Tim PMW.pdf', 'submitted', 1, '2026-05-25 23:23:12', '2026-05-25 23:23:12'),
(227, NULL, 85, 0, 'pitching', 'ktm', 'uploads/proposals/85/pitching/1780195117_904066b4057164060a25.pdf', 'ktm.pdf', 'submitted', 1, '2026-05-25 23:31:28', '2026-05-31 09:38:37'),
(228, NULL, 85, 0, 'pitching', 'cashflow', 'uploads/proposals/85/pitching/1779726785_99eada1c7bfd7d1fd1bf.pdf', 'Dokumen 44.pdf', 'submitted', 1, '2026-05-25 23:33:05', '2026-05-25 23:33:05'),
(229, NULL, 27, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/27/pitching/1779727101_725c252bd94040e665cd.pdf', 'Presentasi PowerPoint Bouquething_Project.pdf', 'submitted', 1, '2026-05-25 23:38:21', '2026-05-25 23:38:21'),
(230, NULL, 85, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/85/pitching/1779809378_5cde483645b65cf27cce.bin', '843533a8-d8b9-47fc-9fc6-ca584cf01aa7.pptx', 'submitted', 1, '2026-05-26 22:29:38', '2026-05-26 22:29:38'),
(231, NULL, 24, 0, 'pitching', 'biodata', 'uploads/proposals/24/pitching/1779885111_d73a6f10542ec2dd55e2.pdf', 'Biodata_PMW-3.pdf', 'submitted', 1, '2026-05-27 19:31:51', '2026-05-27 19:31:51'),
(232, NULL, 85, 0, 'pitching', 'biodata', 'uploads/proposals/85/pitching/1780065673_6f7a805d53454bdcfa5c.pdf', 'DAFTAR RIWAYAT HIDUP.pdf', 'submitted', 1, '2026-05-28 23:40:03', '2026-05-29 21:41:13'),
(233, NULL, 87, 0, 'pitching', 'cashflow', 'uploads/proposals/87/pitching/1780036863_66fb121132b83b1a6f73.pdf', 'LAPORAN LR MY SIOMAY.pdf', 'submitted', 1, '2026-05-29 13:41:03', '2026-05-29 13:41:03'),
(234, NULL, 87, 0, 'pitching', 'ktm', 'uploads/proposals/87/pitching/1780037308_7076a91f7c588524a4d0.pdf', 'KTM TIM MY SIOMAY.pdf', 'submitted', 1, '2026-05-29 13:48:28', '2026-05-29 13:48:28'),
(235, NULL, 85, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/85/pitching/1780065548_2372188ac4d440a19328.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-05-29 21:39:08', '2026-05-29 21:39:08'),
(236, NULL, 87, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/87/pitching/1780136525_7972a6e4e4de0ef44cbe.pdf', 'DOC-20260530-WA0006..pdf', 'submitted', 1, '2026-05-30 17:22:05', '2026-05-30 17:22:05'),
(237, NULL, 87, 0, 'pitching', 'biodata', 'uploads/proposals/87/pitching/1780215529_dc6f4e4f929862fd62fc.pdf', 'BIODATA TIM My Siomay.pdf', 'submitted', 1, '2026-05-31 15:18:49', '2026-05-31 15:18:49'),
(238, NULL, 82, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/82/pitching/1780232304_c260d890267c527dc90d.pdf', 'F&D Design Creative bisnis model canvas ( BMC ).pdf', 'submitted', 1, '2026-05-31 19:58:24', '2026-05-31 19:58:24'),
(239, NULL, 82, 0, 'pitching', 'biodata', 'uploads/proposals/82/pitching/1780233417_cc69af8e3eb4cddd8cc7.pdf', 'gabungan_foto_ktp.pdf', 'submitted', 1, '2026-05-31 20:16:57', '2026-05-31 20:16:57'),
(240, NULL, 82, 0, 'pitching', 'ktm', 'uploads/proposals/82/pitching/1780234105_144543f5f5bf0f0bb334.pdf', 'gabungan_foto.pdf', 'submitted', 1, '2026-05-31 20:28:25', '2026-05-31 20:28:25'),
(241, NULL, 82, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/82/pitching/1780241124_2ffc3b8c4d0a9c743894.pdf', '60936.pdf', 'submitted', 1, '2026-05-31 21:54:00', '2026-05-31 22:25:24'),
(242, NULL, 89, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/89/pitching/1780242260_fb02607adf537bdefa58.pdf', 'CamScanner 05-30-2026 21.08.pdf', 'submitted', 1, '2026-05-31 22:44:20', '2026-05-31 22:44:20'),
(243, NULL, 89, 0, 'pitching', 'biodata', 'uploads/proposals/89/pitching/1780242330_69bff21143f14044330f.pdf', 'CamScanner 05-30-2026 21.09.pdf', 'submitted', 1, '2026-05-31 22:45:30', '2026-05-31 22:45:30'),
(244, NULL, 89, 0, 'pitching', 'ktm', 'uploads/proposals/89/pitching/1780242891_36da68b406b0becbb163.pdf', 'KTM.pdf', 'submitted', 1, '2026-05-31 22:54:51', '2026-05-31 22:54:51'),
(245, NULL, 89, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/89/pitching/1780243114_298e2f9f0e3f19ed5d4b.pdf', 'PEKSANG Keripik Pisang Dengan Cita Rasa Pedas dan Manis_compressed.pdf', 'submitted', 1, '2026-05-31 22:58:34', '2026-05-31 22:58:34'),
(246, NULL, 24, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/24/pitching/1780246790_29ec6cc7dd7e1563463f.pdf', 'TrinketsKu_FINAL (1).pdf', 'submitted', 1, '2026-05-31 23:59:50', '2026-05-31 23:59:50');
INSERT INTO `pmw_documents` (`id`, `team_id`, `proposal_id`, `uploader_id`, `type`, `doc_key`, `file_path`, `original_name`, `status`, `version`, `created_at`, `updated_at`) VALUES
(247, NULL, 90, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/90/pitching/1780548540_961bfe1a807fe563fb1a.pptx', 'My-Pitching(1).pptx', 'submitted', 1, '2026-06-04 11:49:00', '2026-06-04 11:49:00'),
(248, NULL, 90, 0, 'pitching', 'biodata', 'uploads/proposals/90/pitching/1780548548_bdd360746ce39d155ae4.pdf', 'LAMPIRAN BIODATA.pdf', 'submitted', 1, '2026-06-04 11:49:08', '2026-06-04 11:49:08'),
(249, NULL, 90, 0, 'pitching', 'ktm', 'uploads/proposals/90/pitching/1780548552_8f669954ae0b4049af9e.pdf', 'SCAN KTM.pdf', 'submitted', 1, '2026-06-04 11:49:12', '2026-06-04 11:49:12'),
(250, NULL, 90, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/90/pitching/1780548556_c5f01bdfa3027340dd12.pdf', 'SURAT PERNYATAAN KETUA.pdf', 'submitted', 1, '2026-06-04 11:49:16', '2026-06-04 11:49:16'),
(251, NULL, 84, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/84/pitching/1780552681_ad05c0ac7bf9d1a9489c.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-06-04 12:58:01', '2026-06-04 12:58:01'),
(252, NULL, 84, 0, 'pitching', 'biodata', 'uploads/proposals/84/pitching/1780552685_8b9f2aa907051be43f98.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-06-04 12:58:05', '2026-06-04 12:58:05'),
(253, NULL, 84, 0, 'pitching', 'ktm', 'uploads/proposals/84/pitching/1780552687_bb59cad8e795b5fa651e.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-06-04 12:58:07', '2026-06-04 12:58:07'),
(254, NULL, 84, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/84/pitching/1780552690_ab3d11e06a059d7f4979.pdf', 'Kertas Putih Polos.pdf', 'submitted', 1, '2026-06-04 12:58:10', '2026-06-04 12:58:10'),
(255, NULL, 91, 0, 'pitching', 'pitching_ppt', 'uploads/proposals/91/pitching/1780665924_094d072e23dc3871a51c.pdf', 'VARATION HOLIDAY.pdf', 'submitted', 1, '2026-06-05 20:25:24', '2026-06-05 20:25:24'),
(256, NULL, 91, 0, 'pitching', 'biodata', 'uploads/proposals/91/pitching/1780666326_04910a0ccb03d9954448.pdf', 'Biodata tim.pdf', 'submitted', 1, '2026-06-05 20:32:06', '2026-06-05 20:32:06'),
(257, NULL, 91, 0, 'pitching', 'surat_pernyataan_ketua', 'uploads/proposals/91/pitching/1780667790_9d66f3ccaa456d597278.pdf', 'Surat pernyataan ketua.pdf', 'submitted', 1, '2026-06-05 20:56:30', '2026-06-05 20:56:30'),
(258, NULL, 91, 0, 'pitching', 'ktm', 'uploads/proposals/91/pitching/1780668613_eb993b1abd76c1df2cac.pdf', 'KTM GABUNGAN.pdf', 'submitted', 1, '2026-06-05 21:10:13', '2026-06-05 21:10:13'),
(259, NULL, 63, 87, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_63/aromelle-surat_kesediaan_dosen-20260706_182956.pdf', 'surat pernyataan dosen pembimbing.pdf', 'submitted', 1, '2026-07-06 18:29:56', '2026-07-06 18:29:56'),
(260, NULL, 63, 87, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_63/aromelle-proposal_utama-20260729_233418.pdf', 'proposal.pdf', 'submitted', 3, '2026-07-06 19:02:22', '2026-07-29 23:34:18'),
(261, NULL, 65, 89, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_65/sik-sak-sock-surat_kesediaan_dosen-20260730_093943.pdf', 'Surat pernyataan kesediaan dosen pendamping.pdf', 'submitted', 2, '2026-07-10 23:59:39', '2026-07-30 09:39:43'),
(262, NULL, 65, 89, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_65/sik-sak-sock-proposal_utama-20260730_155957.pdf', 'PROPOSAL UTAMA.pdf', 'submitted', 3, '2026-07-11 00:02:37', '2026-07-30 15:59:57'),
(263, NULL, 33, 57, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_33/ardhana-agency-proposal_utama-20260730_115528.pdf', 'PROPOSAL ARDHANA LENGKAP TTD + LOKASI USAHA + SURAT PERNYATAAN PENERIMA DANA_compressed-dikompresi_compressed.pdf', 'submitted', 2, '2026-07-11 17:30:05', '2026-07-30 11:55:28'),
(264, NULL, 33, 57, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_33/ardhana-agency-surat_kesediaan_dosen-20260711_173005.pdf', 'CamScanner 07-07-26 11.40.pdf', 'submitted', 1, '2026-07-11 17:30:05', '2026-07-11 17:30:05'),
(265, NULL, 32, 56, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_32/memories-proposal_utama-20260725_220316.pdf', 'PROPOSAL PMW 2026.pdf', 'submitted', 3, '2026-07-13 09:10:56', '2026-07-25 22:03:16'),
(266, NULL, 32, 56, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_32/memories-surat_kesediaan_dosen-20260721_230701.pdf', 'SURAT PERNYATAAN DOSEN PENDAMPING ASLI_compressed.pdf', 'submitted', 2, '2026-07-13 09:10:56', '2026-07-21 23:07:01'),
(267, NULL, 82, 106, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_82/fd-design-creative-proposal_utama-20260728_225921.pdf', 'F&D DESIGN CREATIVE PROPOSAL.pdf', 'submitted', 2, '2026-07-21 14:40:32', '2026-07-28 22:59:21'),
(268, NULL, 82, 106, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_82/fd-design-creative-surat_kesediaan_dosen-20260721_144032.pdf', 'SURAT KETERSEDIAAN DOSEN PEDAMPING F&D DESIGN CREATIVE.pdf', 'submitted', 1, '2026-07-21 14:40:32', '2026-07-21 14:40:32'),
(269, NULL, 82, 106, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_82/fd-design-creative-bukti_perjanjian-20260728_235312.pdf', 'F&D DESIGN CREATIVE PERNYATAAN IMPLEMENTASI (1).pdf', 'submitted', 2, '2026-07-21 14:52:38', '2026-07-28 23:53:12'),
(270, NULL, 32, 56, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_32/memories-bukti_perjanjian-20260725_221626.pdf', 'Form List Perjanjian Implementasi PMW 2026 _compress.pdf', 'submitted', 2, '2026-07-21 23:15:11', '2026-07-25 22:16:26'),
(271, NULL, 72, 96, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_72/noye-ubepop-ubepudding-pudding-ubi-ungu-ubeicecream-es-krim-ubi-ungu-bukti_perjanjian-20260730_094649.pdf', 'List Implementasi Noye UbePop_compressed.pdf', 'submitted', 5, '2026-07-22 00:22:22', '2026-07-30 09:46:49'),
(272, NULL, 72, 96, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_72/noye-ubepop-ubepudding-pudding-ubi-ungu-ubeicecream-es-krim-ubi-ungu-proposal_utama-20260730_092954.pdf', 'Proposal_Noye UbePop_.pdf', 'submitted', 3, '2026-07-22 00:27:35', '2026-07-30 09:29:54'),
(273, NULL, 72, 96, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_72/noye-ubepop-ubepudding-pudding-ubi-ungu-ubeicecream-es-krim-ubi-ungu-surat_kesediaan_dosen-20260722_002735.pdf', 'Surat Pernyataan Kesediaan Dosen Pendamping Noye UbePop .pdf', 'submitted', 1, '2026-07-22 00:27:35', '2026-07-22 00:27:35'),
(274, NULL, 20, 42, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_20/kicksparkle-proposal_utama-20260731_131240.pdf', 'Usaha Pemula_Kicksparkle_M Roihan Baariq_PMWPOLSRI2026  (3).pdf', 'submitted', 2, '2026-07-23 12:22:28', '2026-07-31 13:12:40'),
(275, NULL, 20, 42, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_20/kicksparkle-surat_kesediaan_dosen-20260723_122228.pdf', 'SURAT PERNYTAAN DOSEN .pdf', 'submitted', 1, '2026-07-23 12:22:28', '2026-07-23 12:22:28'),
(276, NULL, 31, 55, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_31/webora-studio-proposal_utama-20260726_163737.pdf', 'Proposal Webora Studio + Pengesahan.pdf', 'submitted', 1, '2026-07-26 16:37:37', '2026-07-26 16:37:37'),
(277, NULL, 31, 55, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_31/webora-studio-surat_kesediaan_dosen-20260726_163737.pdf', 'Pernyataan Dosen Pendamping.pdf', 'submitted', 1, '2026-07-26 16:37:37', '2026-07-26 16:37:37'),
(278, NULL, 31, 55, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_31/webora-studio-bukti_perjanjian-20260726_231231.pdf', 'List Perjanjian Implementasi Webora Studio.pdf', 'submitted', 1, '2026-07-26 23:12:31', '2026-07-26 23:12:31'),
(279, NULL, 89, 113, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_89/peksang-proposal_utama-20260729_002823.pdf', 'PROPOSAL PEKSANG.pdf', 'submitted', 1, '2026-07-29 00:28:23', '2026-07-29 00:28:23'),
(280, NULL, 89, 113, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_89/peksang-surat_kesediaan_dosen-20260729_003001.pdf', 'Surat Pernyataan Ketersediaan Dosen Pendamping.pdf', 'submitted', 1, '2026-07-29 00:30:01', '2026-07-29 00:30:01'),
(281, NULL, 82, 106, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_82/fd-design-creative-surat_pernyataan_penerima_dana-20260729_003559.pdf', 'SURAT PERNYATAAN PENERIMA DANA PMW F&D DESIGN CREATIVE.pdf', 'submitted', 1, '2026-07-29 00:35:59', '2026-07-29 00:35:59'),
(282, NULL, 89, 113, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_89/peksang-surat_pernyataan_penerima_dana-20260729_092721.pdf', 'Surat pernyataan penerima dana.pdf', 'submitted', 1, '2026-07-29 09:27:21', '2026-07-29 09:27:21'),
(283, NULL, 89, 113, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_89/peksang-bukti_perjanjian-20260729_092811.pdf', 'LIST IMPLEMENTASI FIX PEKSANG (1).pdf', 'submitted', 1, '2026-07-29 09:28:11', '2026-07-29 09:28:11'),
(284, NULL, 87, 111, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_87/my-siomay-surat_kesediaan_dosen-20260729_105956.pdf', 'ttd SURAT KESEDIAAN DOSEN PMW 2026.pdf', 'submitted', 1, '2026-07-29 10:59:56', '2026-07-29 10:59:56'),
(285, NULL, 87, 111, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_87/my-siomay-proposal_utama-20260729_110518.pdf', 'Comp ACC PROPOSAL PMW POLSRI 2026 MY SIOMAY.pdf', 'submitted', 1, '2026-07-29 11:05:18', '2026-07-29 11:05:18'),
(286, NULL, 87, 111, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_87/my-siomay-bukti_perjanjian-20260729_111858.pdf', 'Comp ACC List Implementasi My Siomay 2026.pdf', 'submitted', 1, '2026-07-29 11:18:58', '2026-07-29 11:18:58'),
(287, NULL, 87, 111, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_87/my-siomay-surat_pernyataan_penerima_dana-20260729_111913.pdf', 'TTD SURAT PERNYATAAN PENERIMA DANA _MY SIOMAY .pdf', 'submitted', 1, '2026-07-29 11:19:13', '2026-07-29 11:19:13'),
(288, NULL, 61, 85, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_61/topico-proposal_utama-20260729_211047.pdf', 'UsahaBerkembang_Topi.co_NajwaAlyaSenovgiZahra_PMWPOLSRI2026.pdf', 'submitted', 3, '2026-07-29 20:50:49', '2026-07-29 21:10:47'),
(289, NULL, 61, 85, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_61/topico-surat_kesediaan_dosen-20260729_205051.pdf', 'SURAT PERNYATAAN DOSEN PENDAMPING.pdf', 'submitted', 2, '2026-07-29 20:50:49', '2026-07-29 20:50:51'),
(290, NULL, 32, 56, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_32/memories-surat_pernyataan_penerima_dana-20260729_212113.pdf', 'SURAT PERNYATAAN PESERTA PENERIMA DANA PMW 2026.pdf', 'submitted', 1, '2026-07-29 21:21:13', '2026-07-29 21:21:13'),
(291, NULL, 85, 109, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_85/mayzera-2024-strore-surat_pernyataan_penerima_dana-20260729_213810.pdf', 'Dokumen 34.pdf', 'submitted', 1, '2026-07-29 21:38:10', '2026-07-29 21:38:10'),
(292, NULL, 85, 109, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_85/mayzera-2024-strore-bukti_perjanjian-20260729_214541.pdf', 'RAB.pdf', 'submitted', 1, '2026-07-29 21:45:41', '2026-07-29 21:45:41'),
(293, NULL, 85, 109, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_85/mayzera-2024-strore-proposal_utama-20260729_215739.pdf', 'Dokumen 35 (1).pdf', 'submitted', 2, '2026-07-29 21:50:04', '2026-07-29 21:57:39'),
(294, NULL, 85, 109, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_85/mayzera-2024-strore-surat_kesediaan_dosen-20260729_215004.pdf', 'Dokumen 34 (1).pdf', 'submitted', 1, '2026-07-29 21:50:04', '2026-07-29 21:50:04'),
(295, NULL, 63, 87, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_63/aromelle-bukti_perjanjian-20260729_233500.pdf', 'form list implementasi.pdf', 'submitted', 3, '2026-07-29 22:01:40', '2026-07-29 23:35:00'),
(296, NULL, 63, 87, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_63/aromelle-surat_pernyataan_penerima_dana-20260729_233523.pdf', 'surat pernyataan penerimaan dana.pdf', 'submitted', 2, '2026-07-29 22:02:57', '2026-07-29 23:35:23'),
(297, NULL, 61, 85, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_61/topico-bukti_perjanjian-20260730_082820.pdf', 'Bukti_Perjanjian_Implementasi.pdf', 'submitted', 1, '2026-07-30 08:28:20', '2026-07-30 08:28:20'),
(298, NULL, 61, 85, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_61/topico-surat_pernyataan_penerima_dana-20260730_083117.pdf', 'Surat_Pernyataan_Penerima_Dana.pdf', 'submitted', 1, '2026-07-30 08:31:17', '2026-07-30 08:31:17'),
(299, NULL, 72, 96, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_72/noye-ubepop-ubepudding-pudding-ubi-ungu-ubeicecream-es-krim-ubi-ungu-surat_pernyataan_penerima_dana-20260730_094709.pdf', 'Surat Pernyataan Peserta Penerima Dana_Noye UbePop .pdf', 'submitted', 2, '2026-07-30 08:35:57', '2026-07-30 09:47:09'),
(300, NULL, 49, 73, 'proposal', 'proposal_utama', 'uploads/pmw/proposals/proposal_49/byjuwita-proposal_utama-20260730_123840.pdf', 'PROPOSAL PMW BY.JUWITA REV 1 (1).pdf', 'submitted', 2, '2026-07-30 11:19:53', '2026-07-30 12:38:40'),
(301, NULL, 31, 55, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_31/webora-studio-surat_pernyataan_penerima_dana-20260730_112349.pdf', 'CamScanner 27-07-2026 12.13.pdf', 'submitted', 1, '2026-07-30 11:23:49', '2026-07-30 11:23:49'),
(302, NULL, 49, 73, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_49/byjuwita-bukti_perjanjian-20260730_124026.pdf', 'IMPLEMENTASI BY.JUWITA.pdf', 'submitted', 2, '2026-07-30 11:26:21', '2026-07-30 12:40:26'),
(303, NULL, 49, 73, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_49/byjuwita-surat_pernyataan_penerima_dana-20260730_112837.pdf', 'Surat Pernyataan penerima dana.pdf', 'submitted', 1, '2026-07-30 11:28:37', '2026-07-30 11:28:37'),
(304, NULL, 49, 73, 'proposal', 'surat_kesediaan_dosen', 'uploads/pmw/proposals/proposal_49/byjuwita-surat_kesediaan_dosen-20260730_113144.pdf', 'SURAT KESEDIAAN DOSEN PENDAMPING.pdf', 'submitted', 1, '2026-07-30 11:31:44', '2026-07-30 11:31:44'),
(305, NULL, 33, 57, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_33/ardhana-agency-surat_pernyataan_penerima_dana-20260730_120725.pdf', 'SURAT PENERIMAAN DANA.pdf', 'submitted', 1, '2026-07-30 12:07:25', '2026-07-30 12:07:25'),
(306, NULL, 33, 57, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_33/ardhana-agency-bukti_perjanjian-20260730_120922.pdf', 'LIST IMPLEMENTASI_compressed (1).pdf', 'submitted', 1, '2026-07-30 12:09:22', '2026-07-30 12:09:22'),
(307, NULL, 65, 89, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_65/sik-sak-sock-surat_pernyataan_penerima_dana-20260730_131200.pdf', 'Surat pernyataan penerima dana.pdf', 'submitted', 1, '2026-07-30 13:12:00', '2026-07-30 13:12:00'),
(308, NULL, 20, 42, 'perjanjian', 'surat_pernyataan_penerima_dana', 'uploads/pmw/proposals/proposal_20/kicksparkle-surat_pernyataan_penerima_dana-20260730_142808.pdf', 'SURAT PERNYATAAN IMPLEMENTASI .pdf', 'submitted', 1, '2026-07-30 14:28:08', '2026-07-30 14:28:08'),
(309, NULL, 20, 42, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_20/kicksparkle-bukti_perjanjian-20260730_143132.pdf', 'PERNYATAAN IMPLEMENTASI PMW 2026 Kicksparkle (3)_compressed.pdf', 'submitted', 1, '2026-07-30 14:31:32', '2026-07-30 14:31:32'),
(310, NULL, 65, 89, 'perjanjian', 'bukti_perjanjian', 'uploads/pmw/proposals/proposal_65/sik-sak-sock-bukti_perjanjian-20260730_160622.pdf', 'LIST PERJANJIAN IMPLEMENTASI_UP WEB.pdf', 'submitted', 1, '2026-07-30 16:06:22', '2026-07-30 16:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_expo_attachments`
--

CREATE TABLE `pmw_expo_attachments` (
  `id` int UNSIGNED NOT NULL,
  `submission_id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_type` enum('image','document') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'image',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_expo_schedules`
--

CREATE TABLE `pmw_expo_schedules` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `submission_deadline` datetime DEFAULT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_expo_schedules`
--

INSERT INTO `pmw_expo_schedules` (`id`, `period_id`, `event_name`, `event_date`, `location`, `description`, `submission_deadline`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Expo Kewirausahaan 2026', '2026-04-19', 'Graha POLSRI', 'Kegiatan Tahunan untuk Enterpreneurship polsri', '2026-04-25 14:35:00', 0, '2026-04-19 07:35:36', '2026-04-19 07:35:36');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_expo_submissions`
--

CREATE TABLE `pmw_expo_submissions` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `summary` text COLLATE utf8mb4_general_ci,
  `certificate_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_guidance_logbooks`
--

CREATE TABLE `pmw_guidance_logbooks` (
  `id` int UNSIGNED NOT NULL,
  `schedule_id` int UNSIGNED NOT NULL,
  `material_explanation` text COLLATE utf8mb4_general_ci,
  `video_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_activity` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'File path for activity photo',
  `assignment_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'File path for assignment/tasks',
  `nota_file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'File path for consumption note',
  `nota_files` text COLLATE utf8mb4_general_ci COMMENT 'Stored as JSON array of file paths',
  `nota_items` text COLLATE utf8mb4_general_ci,
  `nominal_konsumsi` int NOT NULL DEFAULT '0',
  `status` enum('draft','pending','approved','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `submitted_at` datetime DEFAULT NULL,
  `verification_note` text COLLATE utf8mb4_general_ci,
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_guidance_schedules`
--

CREATE TABLE `pmw_guidance_schedules` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL COMMENT 'Creator: Dosen or Mentor',
  `type` enum('bimbingan','mentoring') COLLATE utf8mb4_general_ci NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` time NOT NULL,
  `deadline_date` date DEFAULT NULL COMMENT 'Tanggal batas pengisian logbook',
  `deadline_time` time DEFAULT NULL COMMENT 'Jam batas pengisian logbook',
  `topic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('planned','ongoing','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'planned',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_implementation_items`
--

CREATE TABLE `pmw_implementation_items` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `item_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `item_description` text COLLATE utf8mb4_general_ci,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int DEFAULT '1',
  `price` decimal(15,2) DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_implementation_item_photos`
--

CREATE TABLE `pmw_implementation_item_photos` (
  `id` int UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `photo_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_implementation_konsumsi`
--

CREATE TABLE `pmw_implementation_konsumsi` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `konsumsi_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_implementation_payments`
--

CREATE TABLE `pmw_implementation_payments` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `payment_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `link_pembelian` text COLLATE utf8mb4_general_ci,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_lecturers`
--

CREATE TABLE `pmw_lecturers` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nip` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prodi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_lecturers`
--

INSERT INTO `pmw_lecturers` (`id`, `user_id`, `nip`, `nama`, `jurusan`, `prodi`, `expertise`, `phone`, `bio`, `created_at`, `updated_at`) VALUES
(7, 131, '197109042005011001', 'Dr. Paisal, S.E., M.Si.', 'Teknik Kimia', 'S2 Terapan/Magister Terapan: Teknik Energi Terbarukan', 'Marketing', '082280942197', 'Dosen Pendamping', '2026-07-19 19:10:45', '2026-07-19 19:10:45'),
(8, 132, '1', 'Zurohaina, S.T., M.T.', 'Teknik Sipil', 'D-III Teknik Sipil', 'Marketing', '081', 'Dosen pembimbing', '2026-07-19 19:14:41', '2026-07-19 19:14:41'),
(9, 133, '199102232023212048 ', 'Indah Pratiwi, S.ST., M.T.', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 'Marketing', '081278087291', 'Dosen Pendamping', '2026-07-19 19:18:24', '2026-07-19 19:18:24'),
(10, 134, '2', 'Wahyu Triaji Rahadianto, S.Tr.T., M.T.', 'Teknik Kimia', 'D-IV Teknik Energi', 'Marketing', '082267607285', 'Dosen Pendamping', '2026-07-19 19:20:43', '2026-07-19 19:20:43'),
(11, 135, '3', 'Heni Yuvita, M.Si.', 'Akuntansi', 'D-IV Akuntansi Sektor Publik PSDKU OKU Baturaja', 'Marketing', '083', 'Dosen Pendamping', '2026-07-19 19:21:58', '2026-07-19 19:21:58'),
(12, 136, '4', 'Dwi Riana, S.E., M.A.B.', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 'Marketing', '084', 'Dosen Pendamping', '2026-07-19 19:23:05', '2026-07-19 19:23:05'),
(13, 137, '5', 'Leni Sabrina, S.P., M.Si.', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 'Marketing', '085', 'Dosen Pendamping', '2026-07-19 19:24:26', '2026-07-19 19:24:26'),
(14, 138, '6', 'Mutiara Putri, S.ST., M.Tr.T.', 'Teknik Sipil', 'D-III Teknik Sipil', 'Marketing', '086', 'Dosen Pendamping', '2026-07-19 19:25:59', '2026-07-19 19:25:59'),
(15, 139, '7', 'Dika Setiagraha, S.E., M.M.', 'Teknik Sipil', 'D-III Teknik Sipil', 'Marketing', '087', 'Dosen Pendamping', '2026-07-19 19:26:59', '2026-07-19 19:26:59'),
(16, 140, '8', 'Imas Permatasari, S.E., M.Si.', 'Teknik Sipil', 'D-III Teknik Sipil', 'Marketing', '088', 'Dosen Pendamping', '2026-07-19 19:28:26', '2026-07-19 19:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_mentoring_logs`
--

CREATE TABLE `pmw_mentoring_logs` (
  `id` int UNSIGNED NOT NULL,
  `team_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `supervisor_id` int UNSIGNED NOT NULL,
  `activity_date` date NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `verify_status` enum('pending','verified','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_mentors`
--

CREATE TABLE `pmw_mentors` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_mentors`
--

INSERT INTO `pmw_mentors` (`id`, `user_id`, `nama`, `company`, `position`, `expertise`, `phone`, `email`, `bio`, `created_at`, `updated_at`) VALUES
(6, 141, 'Mas Aziz', 'Bakso Granat', 'CEO', 'Marketing', '081', 'masaziz@gmail.com', 'Mentor', '2026-07-23 10:19:03', '2026-07-23 10:19:03'),
(7, 142, 'Asep Somanhudi', 'Perusahaan', 'CEO', 'Marketing', '082', '', 'Mentor', '2026-07-23 10:21:28', '2026-07-23 10:21:28'),
(8, 143, 'Rizki Rantau', 'Perusahaan', 'CEO', 'Marketing', '083', '', 'Mentor', '2026-07-23 10:22:30', '2026-07-23 10:22:30'),
(9, 144, 'Eko', 'Perusahaan', 'CEO', 'Marketing', '084', '', 'Mentor', '2026-07-23 10:23:19', '2026-07-23 10:23:19'),
(10, 145, 'Lola', 'Perusahaan', 'CEO', 'Marketing', '085', '', 'Mentor', '2026-07-23 10:24:07', '2026-07-23 10:24:07'),
(11, 146, 'Ikbal', 'Perusahaan', 'CEO', 'Marketing', '086', '', 'Mentor', '2026-07-23 10:24:50', '2026-07-23 10:24:50'),
(12, 147, 'Anggi', 'Perusahaan', 'CEO', 'Marketing', '087', '', 'Mentor', '2026-07-23 10:26:49', '2026-07-23 10:26:49'),
(13, 148, 'Testing', 'Testing', '', '', '088', '', '', '2026-07-23 10:29:09', '2026-07-23 10:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_notifications`
--

CREATE TABLE `pmw_notifications` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `data_id` int UNSIGNED DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `read_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_notifications`
--

INSERT INTO `pmw_notifications` (`id`, `user_id`, `type`, `title`, `message`, `link`, `data_id`, `is_read`, `read_at`, `created_at`, `updated_at`) VALUES
(107, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Muhammad Abror Rifada\' telah mengirimkan berkas pitching desk untuk usaha \'ricebowl \"BOWLKITA\"\'', 'admin/pitching-desk', 54, 1, '2026-05-21 14:50:09', '2026-05-21 11:51:49', '2026-05-21 14:50:09'),
(108, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Fazel Mawla\' telah mengirimkan berkas pitching desk untuk usaha \'Juniorers_Store\'', 'admin/pitching-desk', 53, 0, NULL, '2026-05-22 06:55:46', '2026-05-22 06:55:46'),
(109, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'NAJWA ALYA SENOVGI ZAHRA\' telah mengirimkan berkas pitching desk untuk usaha \'Topi.co\'', 'admin/pitching-desk', 61, 0, NULL, '2026-05-22 16:11:14', '2026-05-22 16:11:14'),
(110, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Intan Belinda\' telah mengirimkan berkas pitching desk untuk usaha \'Crumble Co\'', 'admin/pitching-desk', 46, 0, NULL, '2026-05-23 16:37:30', '2026-05-23 16:37:30'),
(111, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Johan Hadil Mahasin\' telah mengirimkan berkas pitching desk untuk usaha \'Milky Quest\'', 'admin/pitching-desk', 60, 0, NULL, '2026-05-23 19:03:21', '2026-05-23 19:03:21'),
(112, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Fitri Kholilah \' telah mengirimkan berkas pitching desk untuk usaha \'TitikKampus \'', 'admin/pitching-desk', 59, 0, NULL, '2026-05-24 11:33:24', '2026-05-24 11:33:24'),
(113, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Khailla Anastya Ramadini\' telah mengirimkan berkas pitching desk untuk usaha \'Lumiara\'', 'admin/pitching-desk', 50, 0, NULL, '2026-05-24 12:56:59', '2026-05-24 12:56:59'),
(114, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Raghil Risqi Akbar\' telah mengirimkan berkas pitching desk untuk usaha \'Lytheros\'', 'admin/pitching-desk', 75, 0, NULL, '2026-05-24 13:01:35', '2026-05-24 13:01:35'),
(115, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Karno Triyadi\' telah mengirimkan berkas pitching desk untuk usaha \'akarjiwa.jamu\'', 'admin/pitching-desk', 47, 0, NULL, '2026-05-24 14:13:03', '2026-05-24 14:13:03'),
(116, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Rizka Putri Badiah\' telah mengirimkan berkas pitching desk untuk usaha \'Charmate / Bagcharm\'', 'admin/pitching-desk', 71, 0, NULL, '2026-05-24 14:51:05', '2026-05-24 14:51:05'),
(117, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M Ridho Apriliadi\' telah mengirimkan berkas pitching desk untuk usaha \'Kalawangi\'', 'admin/pitching-desk', 76, 0, NULL, '2026-05-24 17:42:54', '2026-05-24 17:42:54'),
(118, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Moza slavina salsabillah\' telah mengirimkan berkas pitching desk untuk usaha \'Slay Side MUA\'', 'admin/pitching-desk', 67, 0, NULL, '2026-05-24 21:03:19', '2026-05-24 21:03:19'),
(119, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Nani umiarti nasyuha \' telah mengirimkan berkas pitching desk untuk usaha \'Clean Rangers\'', 'admin/pitching-desk', 81, 0, NULL, '2026-05-24 21:27:42', '2026-05-24 21:27:42'),
(120, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Naurah Rafifah\' telah mengirimkan berkas pitching desk untuk usaha \'BiDi Memo (Ipad Booth) \'', 'admin/pitching-desk', 78, 0, NULL, '2026-05-24 22:50:46', '2026-05-24 22:50:46'),
(121, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Muhammad Nabil Akmal\' telah mengirimkan berkas pitching desk untuk usaha \'Bloomie Studio\'', 'admin/pitching-desk', 69, 0, NULL, '2026-05-25 00:02:03', '2026-05-25 00:02:03'),
(122, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Tesalonika Claudya Felicia Estiko\' telah mengirimkan berkas pitching desk untuk usaha \'Felt Photobooth Frame\'', 'admin/pitching-desk', 77, 0, NULL, '2026-05-25 05:49:20', '2026-05-25 05:49:20'),
(123, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Cici Agustina Putri\' telah mengirimkan berkas pitching desk untuk usaha \'Pancong Waffle\'', 'admin/pitching-desk', 68, 0, NULL, '2026-05-25 06:45:23', '2026-05-25 06:45:23'),
(124, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Davina Ramadhani Akbar\' telah mengirimkan berkas pitching desk untuk usaha \'Charmu\'', 'admin/pitching-desk', 52, 0, NULL, '2026-05-25 09:04:02', '2026-05-25 09:04:02'),
(125, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Chania Putri Wiranda\' telah mengirimkan berkas pitching desk untuk usaha \'Ardhana Agency\'', 'admin/pitching-desk', 33, 0, NULL, '2026-05-25 09:25:08', '2026-05-25 09:25:08'),
(126, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Krisna Wati\' telah mengirimkan berkas pitching desk untuk usaha \'by.juwita\'', 'admin/pitching-desk', 49, 0, NULL, '2026-05-25 09:54:57', '2026-05-25 09:54:57'),
(127, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'FAKHRI IRAWAN 062340833143\' telah mengirimkan berkas pitching desk untuk usaha \'Webora Studio\'', 'admin/pitching-desk', 31, 0, NULL, '2026-05-25 11:17:23', '2026-05-25 11:17:23'),
(128, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Septia Rahmadhani\' telah mengirimkan berkas pitching desk untuk usaha \'Siomay 4U\'', 'admin/pitching-desk', 83, 0, NULL, '2026-05-25 13:20:06', '2026-05-25 13:20:06'),
(129, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Olivia Claudia Amanda Susanti D\' telah mengirimkan berkas pitching desk untuk usaha \'Aromelle\'', 'admin/pitching-desk', 63, 0, NULL, '2026-05-25 13:47:16', '2026-05-25 13:47:16'),
(130, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Nadila Devani Alensi\' telah mengirimkan berkas pitching desk untuk usaha \'Sik Sak Sock\'', 'admin/pitching-desk', 65, 0, NULL, '2026-05-25 15:03:55', '2026-05-25 15:03:55'),
(131, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M Roihan Baariq\' telah mengirimkan berkas pitching desk untuk usaha \'kicksparkle\'', 'admin/pitching-desk', 20, 0, NULL, '2026-05-25 15:09:30', '2026-05-25 15:09:30'),
(132, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Cahya Amelia Hayati\' telah mengirimkan berkas pitching desk untuk usaha \'SAHABAT HIJAB\'', 'admin/pitching-desk', 80, 0, NULL, '2026-05-25 15:17:56', '2026-05-25 15:17:56'),
(133, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Maulana Fajar Pratama\' telah mengirimkan berkas pitching desk untuk usaha \'Fajar Raya/ Onigiri Rendang \'', 'admin/pitching-desk', 86, 0, NULL, '2026-05-25 15:38:19', '2026-05-25 15:38:19'),
(134, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Gea Audrey Lexandria Aprilian Zein\' telah mengirimkan berkas pitching desk untuk usaha \'MEMORIES\'', 'admin/pitching-desk', 32, 0, NULL, '2026-05-25 16:10:20', '2026-05-25 16:10:20'),
(135, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Siti Fa\'iqriyyah Febizainsky\' telah mengirimkan berkas pitching desk untuk usaha \'Mini Melty\'', 'admin/pitching-desk', 70, 0, NULL, '2026-05-25 17:05:08', '2026-05-25 17:05:08'),
(136, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Marsya Hilwatullisah\' telah mengirimkan berkas pitching desk untuk usaha \'Creavory\'', 'admin/pitching-desk', 74, 1, '2026-05-25 19:06:40', '2026-05-25 18:43:27', '2026-05-25 19:06:40'),
(137, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Arcellino Putra Rifai\' telah mengirimkan berkas pitching desk untuk usaha \'ARCTECH CCTV\'', 'admin/pitching-desk', 56, 0, NULL, '2026-05-25 21:37:57', '2026-05-25 21:37:57'),
(138, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Nizelia Khairunisa \' telah mengirimkan berkas pitching desk untuk usaha \'Mazefoods/ Gyoza Ayam dan Es Jelly Kelapa\'', 'admin/pitching-desk', 66, 0, NULL, '2026-05-25 21:41:19', '2026-05-25 21:41:19'),
(139, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Raka Meidiansyah \' telah mengirimkan berkas pitching desk untuk usaha \'SORANA\'', 'admin/pitching-desk', 26, 0, NULL, '2026-05-25 22:10:13', '2026-05-25 22:10:13'),
(140, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Dinni\' telah mengirimkan berkas pitching desk untuk usaha \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\'', 'admin/pitching-desk', 72, 1, '2026-06-03 09:52:22', '2026-05-25 22:56:11', '2026-06-03 09:52:22'),
(141, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Melina Safitri\' telah mengirimkan berkas pitching desk untuk usaha \'bouquething_project\'', 'admin/pitching-desk', 27, 1, '2026-05-26 13:10:51', '2026-05-25 23:47:10', '2026-05-26 13:10:51'),
(142, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Muhammad Rizky\' telah mengirimkan berkas pitching desk untuk usaha \'Mayzera 2024 Strore\'', 'admin/pitching-desk', 85, 0, NULL, '2026-05-31 09:38:50', '2026-05-31 09:38:50'),
(143, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Valen Geraldi\' telah mengirimkan berkas pitching desk untuk usaha \'MY SIOMAY\'', 'admin/pitching-desk', 87, 1, '2026-06-01 12:01:27', '2026-05-31 20:46:34', '2026-06-01 12:01:27'),
(144, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M. Fathir Sumizi Rahman\' telah mengirimkan berkas pitching desk untuk usaha \'F&D Design Creative\'', 'admin/pitching-desk', 82, 0, NULL, '2026-05-31 22:38:37', '2026-05-31 22:38:37'),
(145, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M Febriansyah\' telah mengirimkan berkas pitching desk untuk usaha \'PEKSANG\'', 'admin/pitching-desk', 89, 0, NULL, '2026-05-31 23:02:24', '2026-05-31 23:02:24'),
(146, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M.Satria Wijaksono_Akuntansi\' telah mengirimkan berkas pitching desk untuk usaha \'TrinketsKu\'', 'admin/pitching-desk', 24, 0, NULL, '2026-05-31 23:59:54', '2026-05-31 23:59:54'),
(147, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Raja Kegelapan \' telah mengirimkan berkas pitching desk untuk usaha \'Cek Kodam\'', 'admin/pitching-desk', 90, 0, NULL, '2026-06-04 11:52:02', '2026-06-04 11:52:02'),
(148, 122, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Cek Kodam\' : lolos. Catatan: MANTAP', 'mahasiswa/pitching-desk?notif_type=pitching', 90, 0, NULL, '2026-06-04 12:57:44', '2026-06-04 12:57:44'),
(149, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'test\' telah mengirimkan berkas pitching desk untuk usaha \'testing\'', 'admin/pitching-desk', 84, 0, NULL, '2026-06-04 12:59:05', '2026-06-04 12:59:05'),
(150, 108, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'testing\' : lolos. Catatan: Anda Lolos', 'mahasiswa/pitching-desk?notif_type=pitching', 84, 0, NULL, '2026-06-04 13:07:55', '2026-06-04 13:07:55'),
(151, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Muhammad Rifqi Al Aufa\' telah mengirimkan berkas pitching desk untuk usaha \'VARATION HOLIDAY\'', 'admin/pitching-desk', 91, 0, NULL, '2026-06-05 21:27:47', '2026-06-05 21:27:47'),
(152, 55, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Webora Studio\' : lolos. Catatan: Di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 31, 1, '2026-06-19 08:16:31', '2026-06-18 09:58:33', '2026-06-19 08:16:31'),
(153, 111, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'MY SIOMAY\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 87, 1, '2026-06-18 15:02:09', '2026-06-18 09:59:01', '2026-06-18 15:02:09'),
(154, 57, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Ardhana Agency\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 33, 1, '2026-06-20 14:10:22', '2026-06-18 09:59:25', '2026-06-20 14:10:22'),
(155, 85, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Topi.co\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 61, 1, '2026-07-01 18:27:27', '2026-06-18 09:59:41', '2026-07-01 18:27:27'),
(156, 110, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Fajar Raya/ Onigiri Rendang \' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 86, 0, NULL, '2026-06-18 09:59:58', '2026-06-18 09:59:58'),
(157, 113, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'PEKSANG\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 89, 1, '2026-06-24 00:51:22', '2026-06-18 10:00:16', '2026-06-24 00:51:22'),
(158, 56, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'MEMORIES\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 32, 1, '2026-06-18 15:53:32', '2026-06-18 10:00:31', '2026-06-18 15:53:32'),
(159, 73, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'by.juwita\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 49, 1, '2026-06-18 16:09:09', '2026-06-18 10:00:46', '2026-06-18 16:09:09'),
(160, 96, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 72, 1, '2026-07-21 14:23:40', '2026-06-18 10:01:04', '2026-07-21 14:23:40'),
(161, 87, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Aromelle\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 63, 1, '2026-06-18 17:41:31', '2026-06-18 10:01:20', '2026-06-18 17:41:31'),
(162, 101, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Felt Photobooth Frame\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 77, 0, NULL, '2026-06-18 10:01:41', '2026-06-18 10:01:41'),
(163, 89, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Sik Sak Sock\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 65, 1, '2026-06-28 18:16:35', '2026-06-18 10:02:12', '2026-06-28 18:16:35'),
(164, 106, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'F&D Design Creative\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 82, 1, '2026-07-21 14:14:13', '2026-06-18 10:02:34', '2026-07-21 14:14:13'),
(165, 70, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Crumble Co\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 46, 1, '2026-06-18 16:49:29', '2026-06-18 10:02:57', '2026-06-18 16:49:29'),
(166, 42, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'kicksparkle\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 20, 1, '2026-06-24 23:08:33', '2026-06-18 10:03:19', '2026-06-18 10:03:19'),
(167, 109, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Mayzera 2024 Strore\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 85, 1, '2026-06-18 14:35:38', '2026-06-18 10:03:39', '2026-06-18 14:35:38'),
(168, 90, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Mazefoods/ Gyoza Ayam dan Es Jelly Kelapa\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 66, 0, NULL, '2026-06-18 10:04:48', '2026-06-18 10:04:48'),
(169, 50, 'pitching_approved', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'SORANA\' : lolos. Catatan: Dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 26, 0, NULL, '2026-06-18 10:05:30', '2026-06-18 10:05:30'),
(170, 77, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Juniorers_Store\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 53, 0, NULL, '2026-06-18 10:06:46', '2026-06-18 10:06:46'),
(171, 95, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Charmate / Bagcharm\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 71, 0, NULL, '2026-06-18 10:07:03', '2026-06-18 10:07:03'),
(172, 78, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'ricebowl \"BOWLKITA\"\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 54, 0, NULL, '2026-06-18 10:07:20', '2026-06-18 10:07:20'),
(173, 91, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Slay Side MUA\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 67, 0, NULL, '2026-06-18 10:07:42', '2026-06-18 10:07:42'),
(174, 84, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Milky Quest\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 60, 0, NULL, '2026-06-18 10:08:01', '2026-06-18 10:08:01'),
(175, 93, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Bloomie Studio\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 69, 0, NULL, '2026-06-18 10:08:19', '2026-06-18 10:08:19'),
(176, 48, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'TrinketsKu\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 24, 0, NULL, '2026-06-18 10:08:35', '2026-06-18 10:08:35'),
(177, 51, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'bouquething_project\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 27, 0, NULL, '2026-06-18 10:08:54', '2026-06-18 10:08:54'),
(178, 99, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Lytheros\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 75, 0, NULL, '2026-06-18 10:09:13', '2026-06-18 10:09:13'),
(179, 74, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Lumiara\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 50, 0, NULL, '2026-06-18 10:09:30', '2026-06-18 10:09:30'),
(180, 100, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Kalawangi\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 76, 0, NULL, '2026-06-18 10:09:48', '2026-06-18 10:09:48'),
(181, 107, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Siomay 4U\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 83, 0, NULL, '2026-06-18 10:10:04', '2026-06-18 10:10:04'),
(182, 105, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Clean Rangers\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 81, 0, NULL, '2026-06-18 10:10:24', '2026-06-18 10:10:24'),
(183, 76, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Charmu\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 52, 0, NULL, '2026-06-18 10:10:42', '2026-06-18 10:10:42'),
(184, 71, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'akarjiwa.jamu\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 47, 0, NULL, '2026-06-18 10:10:58', '2026-06-18 10:10:58'),
(185, 102, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'BiDi Memo (Ipad Booth) \' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 78, 0, NULL, '2026-06-18 10:11:27', '2026-06-18 10:11:27'),
(186, 83, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'TitikKampus \' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 59, 0, NULL, '2026-06-18 10:11:45', '2026-06-18 10:11:45'),
(187, 104, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'SAHABAT HIJAB\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 80, 0, NULL, '2026-06-18 10:12:02', '2026-06-18 10:12:02'),
(188, 92, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Pancong Waffle\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 68, 0, NULL, '2026-06-18 10:12:18', '2026-06-18 10:12:18'),
(189, 98, 'pitching_rejected', 'Hasil Pitching Desk', 'Hasil Pitching Desk untuk \'Creavory\' : ditolak. Catatan: Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 'mahasiswa/pitching-desk?notif_type=pitching', 74, 0, NULL, '2026-06-18 10:12:34', '2026-06-18 10:12:34'),
(190, 55, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Lanjut Ke Tahap Selanjutnya', 'mahasiswa/perjanjian', 31, 1, '2026-07-23 10:50:19', '2026-07-23 10:32:14', '2026-07-23 10:50:19'),
(191, 55, 'perjanjian_revision', 'Hasil Validasi Perjanjian: REVISI', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status REVISI.', 'mahasiswa/perjanjian', 31, 1, '2026-07-23 11:12:02', '2026-07-23 11:11:14', '2026-07-23 11:12:02'),
(192, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'kicksparkle\' oleh M Roihan Baariq menunggu persetujuan', 'admin/validasi', 20, 0, NULL, '2026-07-23 12:22:28', '2026-07-23 12:22:28'),
(193, 134, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'kicksparkle\' oleh M Roihan Baariq telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 20, 0, NULL, '2026-07-23 12:22:28', '2026-07-23 12:22:28'),
(194, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Webora Studio\' oleh FAKHRI IRAWAN 062340833143 menunggu persetujuan', 'admin/validasi', 31, 1, '2026-07-28 19:14:45', '2026-07-26 23:11:36', '2026-07-28 19:14:45'),
(195, 131, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Webora Studio\' oleh FAKHRI IRAWAN 062340833143 telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 31, 0, NULL, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(196, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'PEKSANG\' oleh M Febriansyah menunggu persetujuan', 'admin/validasi', 89, 0, NULL, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(197, 135, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'PEKSANG\' oleh M Febriansyah telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 89, 0, NULL, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(198, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'MEMORIES\' oleh Gea Audrey Lexandria Aprilian Zein menunggu persetujuan', 'admin/validasi', 32, 0, NULL, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(199, 136, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'MEMORIES\' oleh Gea Audrey Lexandria Aprilian Zein telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 32, 0, NULL, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(200, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'MY SIOMAY\' oleh Valen Geraldi menunggu persetujuan', 'admin/validasi', 87, 0, NULL, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(201, 132, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'MY SIOMAY\' oleh Valen Geraldi telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 87, 0, NULL, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(202, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Topi.co\' oleh NAJWA ALYA SENOVGI ZAHRA menunggu persetujuan', 'admin/validasi', 61, 0, NULL, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(203, 134, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Topi.co\' oleh NAJWA ALYA SENOVGI ZAHRA telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 61, 0, NULL, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(204, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Mayzera 2024 Strore\' oleh Muhammad Rizky menunggu persetujuan', 'admin/validasi', 85, 0, NULL, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(205, 131, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Mayzera 2024 Strore\' oleh Muhammad Rizky telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 85, 0, NULL, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(206, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'F&D Design Creative\' oleh M. Fathir Sumizi Rahman menunggu persetujuan', 'admin/validasi', 82, 0, NULL, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(207, 133, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'F&D Design Creative\' oleh M. Fathir Sumizi Rahman telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 82, 0, NULL, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(208, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Aromelle\' oleh Olivia Claudia Amanda Susanti D menunggu persetujuan', 'admin/validasi', 63, 0, NULL, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(209, 138, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Aromelle\' oleh Olivia Claudia Amanda Susanti D telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 63, 1, '2026-07-31 04:59:59', '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(210, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\' oleh Dinni menunggu persetujuan', 'admin/validasi', 72, 0, NULL, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(211, 132, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\' oleh Dinni telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 72, 0, NULL, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(212, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Ardhana Agency\' oleh Chania Putri Wiranda menunggu persetujuan', 'admin/validasi', 33, 0, NULL, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(213, 133, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Ardhana Agency\' oleh Chania Putri Wiranda telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 33, 0, NULL, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(214, 55, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Webora Studio\' disetujui. Catatan: Administrasi telah bagus. Lanjutkan', 'mahasiswa/proposal', 31, 0, NULL, '2026-07-30 12:07:43', '2026-07-30 12:07:43'),
(215, 111, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'MY SIOMAY\' disetujui. Catatan: Sudah baik, Lanjutkan', 'mahasiswa/proposal', 87, 0, NULL, '2026-07-30 12:13:24', '2026-07-30 12:13:24'),
(216, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'by.juwita\' oleh Krisna Wati menunggu persetujuan', 'admin/validasi', 49, 0, NULL, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(217, 137, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'by.juwita\' oleh Krisna Wati telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 49, 0, NULL, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(218, 73, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'by.juwita\' disetujui. Catatan: Usaha By.Juwita layak dilanjutkan', 'mahasiswa/proposal', 49, 1, '2026-07-30 13:51:56', '2026-07-30 13:19:53', '2026-07-30 13:51:56'),
(219, 111, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'MY SIOMAY\' disetujui. Catatan: Sudah baik, Lanjutkan', 'mahasiswa/proposal', 87, 0, NULL, '2026-07-30 13:30:34', '2026-07-30 13:30:34'),
(220, 96, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\' disetujui', 'mahasiswa/proposal', 72, 0, NULL, '2026-07-30 13:30:59', '2026-07-30 13:30:59'),
(221, 57, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Ardhana Agency\' disetujui', 'mahasiswa/proposal', 33, 0, NULL, '2026-07-30 13:31:03', '2026-07-30 13:31:03'),
(222, 106, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'F&D Design Creative\' disetujui. Catatan: Proposal sudah di perbaiki sesuai dengan aturan', 'mahasiswa/proposal', 82, 0, NULL, '2026-07-30 14:52:35', '2026-07-30 14:52:35'),
(223, 106, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'F&D Design Creative\' disetujui. Catatan: Proposal sudah di perbaiki sesuai dengan aturan', 'mahasiswa/proposal', 82, 0, NULL, '2026-07-30 14:52:38', '2026-07-30 14:52:38'),
(224, 106, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'F&D Design Creative\' disetujui. Catatan: Proposal sudah di perbaiki sesuai dengan aturan', 'mahasiswa/proposal', 82, 0, NULL, '2026-07-30 14:52:47', '2026-07-30 14:52:47'),
(225, 56, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'MEMORIES\' disetujui', 'mahasiswa/proposal', 32, 1, '2026-07-31 09:43:09', '2026-07-30 15:38:52', '2026-07-31 09:43:09'),
(226, 87, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Aromelle\' disetujui', 'mahasiswa/proposal', 63, 0, NULL, '2026-07-30 15:44:00', '2026-07-30 15:44:00'),
(227, 109, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Mayzera 2024 Strore\' disetujui', 'mahasiswa/proposal', 85, 1, '2026-07-30 16:16:40', '2026-07-30 15:45:24', '2026-07-30 16:16:40'),
(228, 85, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Topi.co\' disetujui', 'mahasiswa/proposal', 61, 1, '2026-07-30 15:54:51', '2026-07-30 15:54:41', '2026-07-30 15:54:51'),
(229, 42, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'kicksparkle\' disetujui', 'mahasiswa/proposal', 20, 1, '2026-07-31 13:09:19', '2026-07-30 15:55:01', '2026-07-31 13:09:19'),
(230, 113, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'PEKSANG\' disetujui', 'mahasiswa/proposal', 89, 1, '2026-07-30 16:00:33', '2026-07-30 15:59:33', '2026-07-30 16:00:33'),
(231, 113, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'PEKSANG\' disetujui', 'mahasiswa/proposal', 89, 1, '2026-07-30 16:00:33', '2026-07-30 16:00:02', '2026-07-30 16:00:33'),
(232, NULL, 'proposal_submitted', 'Proposal Baru Masuk', 'Terdapat proposal \'Sik Sak Sock\' oleh Nadila Devani Alensi menunggu persetujuan', 'admin/validasi', 65, 1, '2026-07-31 11:40:01', '2026-07-30 16:07:45', '2026-07-31 11:40:01'),
(233, 139, 'proposal_dosen_review', 'Proposal Perlu Divalidasi', 'Tim \'Sik Sak Sock\' oleh Nadila Devani Alensi telah mengajukan proposal dan menunggu persetujuan Anda.', 'dosen/proposal', 65, 0, NULL, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(234, 89, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Sik Sak Sock\' disetujui', 'mahasiswa/proposal', 65, 1, '2026-07-30 16:39:02', '2026-07-30 16:38:30', '2026-07-30 16:39:02'),
(235, 89, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Sik Sak Sock\' disetujui', 'mahasiswa/proposal', 65, 0, NULL, '2026-07-30 16:39:57', '2026-07-30 16:39:57'),
(236, 89, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Sik Sak Sock\' disetujui. Catatan: Proposal diterima', 'mahasiswa/proposal', 65, 0, NULL, '2026-07-31 11:46:42', '2026-07-31 11:46:42'),
(237, 73, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'by.juwita\' disetujui. Catatan: proposal diterima', 'mahasiswa/proposal', 49, 1, '2026-08-01 09:52:51', '2026-07-31 11:48:15', '2026-08-01 09:52:51'),
(238, 57, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Ardhana Agency\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 33, 0, NULL, '2026-07-31 11:49:48', '2026-07-31 11:49:48'),
(239, 96, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 72, 0, NULL, '2026-07-31 11:53:10', '2026-07-31 11:53:10'),
(240, 87, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Aromelle\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 63, 0, NULL, '2026-07-31 11:55:18', '2026-07-31 11:55:18'),
(241, 106, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'F&D Design Creative\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 82, 0, NULL, '2026-07-31 11:56:42', '2026-07-31 11:56:42'),
(242, 109, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Mayzera 2024 Strore\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 85, 0, NULL, '2026-07-31 11:58:09', '2026-07-31 11:58:09'),
(243, 85, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Topi.co\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 61, 1, '2026-08-02 21:21:48', '2026-07-31 11:59:10', '2026-08-02 21:21:48'),
(244, 111, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'MY SIOMAY\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 87, 0, NULL, '2026-07-31 12:01:05', '2026-07-31 12:01:05'),
(245, 56, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'MEMORIES\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 32, 0, NULL, '2026-07-31 12:03:48', '2026-07-31 12:03:48'),
(246, 113, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'PEKSANG\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 89, 0, NULL, '2026-07-31 12:09:50', '2026-07-31 12:09:50'),
(247, 55, 'proposal_approved', 'Hasil Validasi Proposal', 'Proposal \'Webora Studio\' disetujui. Catatan: Proposal Diterima', 'mahasiswa/proposal', 31, 0, NULL, '2026-07-31 12:43:26', '2026-07-31 12:43:26'),
(248, 42, 'proposal_revision', 'Hasil Validasi Proposal', 'Proposal \'kicksparkle\' perlu revisi. Catatan: proposal yang di inputkan wajib yang telah di tanda tangani', 'mahasiswa/proposal', 20, 1, '2026-07-31 13:09:19', '2026-07-31 12:44:54', '2026-07-31 13:09:19'),
(249, 42, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 20, 0, NULL, '2026-08-03 21:13:57', '2026-08-03 21:13:57'),
(250, 55, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 31, 0, NULL, '2026-08-03 21:14:19', '2026-08-03 21:14:19'),
(251, 113, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 89, 0, NULL, '2026-08-03 21:15:34', '2026-08-03 21:15:34'),
(252, 113, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 89, 0, NULL, '2026-08-03 21:15:34', '2026-08-03 21:15:34'),
(253, 56, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 32, 0, NULL, '2026-08-03 21:15:56', '2026-08-03 21:15:56'),
(254, 111, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 87, 0, NULL, '2026-08-03 21:16:11', '2026-08-03 21:16:11'),
(255, 85, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 61, 0, NULL, '2026-08-03 21:16:24', '2026-08-03 21:16:24'),
(256, 109, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 85, 0, NULL, '2026-08-03 21:16:37', '2026-08-03 21:16:37'),
(257, 106, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 82, 0, NULL, '2026-08-03 21:16:48', '2026-08-03 21:16:48'),
(258, 87, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 63, 0, NULL, '2026-08-03 21:17:00', '2026-08-03 21:17:00'),
(259, 96, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 72, 0, NULL, '2026-08-03 21:17:14', '2026-08-03 21:17:14'),
(260, 57, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 33, 0, NULL, '2026-08-03 21:17:26', '2026-08-03 21:17:26'),
(261, 73, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 49, 0, NULL, '2026-08-03 21:17:42', '2026-08-03 21:17:42'),
(262, 89, 'perjanjian_approved', 'Hasil Validasi Perjanjian: LOLOS', 'Validasi berkas perjanjian implementasi Anda telah selesai dengan status LOLOS.', 'mahasiswa/perjanjian', 65, 0, NULL, '2026-08-03 21:17:53', '2026-08-03 21:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_penilai`
--

CREATE TABLE `pmw_penilai` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nidn` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `institution` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_penilai`
--

INSERT INTO `pmw_penilai` (`id`, `user_id`, `nama`, `nidn`, `nip`, `institution`, `expertise`, `phone`, `bio`, `created_at`, `updated_at`) VALUES
(7, 123, 'Penilai1', '11111111111111', '1111111111111111111', 'Politeknik Negeri Sriwijaya', 'Penilaian', '0811111111111', 'Penilaian', '2026-06-04 15:46:57', '2026-06-04 15:46:57'),
(8, 124, 'Penilai2', '2222222222222', '222222222222222', 'Politeknik Negeri Sriwijaya', 'Penilaian', '0822222222222', 'Penilaian', '2026-06-04 15:47:57', '2026-06-04 15:47:57'),
(9, 125, 'Penilai3', '33333333333333', '33333333333333', 'Politeknik Negeri Sriwijaya', 'Penilaian', '0833333333333', 'Penilaian', '2026-06-04 15:48:45', '2026-06-04 15:48:45'),
(10, 126, 'Penilai4', '444444444444', '4444444444444', 'Politeknik Negeri Sriwijaya', 'Penilaian', '0844444444444', 'Penilaian', '2026-06-04 15:49:51', '2026-06-04 15:49:51'),
(11, 127, 'Penilai5', '5555555555555555', '5555555555555', 'Politeknik Negeri Sriwijaya', 'Penilaian', '08555555555', 'Penilaian', '2026-06-04 15:50:39', '2026-06-04 15:50:39'),
(12, 128, 'Penilai6', '666666666666666', '6666666666666', 'Politeknik Negeri Sriwijaya', 'Penilaian', '086666666666666', 'Penilaian', '2026-06-04 15:54:22', '2026-06-04 15:54:22'),
(13, 130, 'Penilai', '000000000000000', '000000000000000', 'Politeknik Negeri Sriwijaya', 'Penilaian', '0000000000000', 'Penilaian', '2026-06-08 17:48:56', '2026-06-08 17:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_periods`
--

CREATE TABLE `pmw_periods` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `year` int UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_periods`
--

INSERT INTO `pmw_periods` (`id`, `name`, `year`, `is_active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PMW Tahun 2026', 2026, 1, 'PMW Tahun 2026 dengan Tema Bisnis di Era Digital', '2026-04-14 19:08:13', '2026-04-19 15:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_perjanjian`
--

CREATE TABLE `pmw_perjanjian` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `student_submitted_at` datetime DEFAULT NULL,
  `admin_status` enum('pending','approved','revision','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin_catatan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_perjanjian`
--

INSERT INTO `pmw_perjanjian` (`id`, `proposal_id`, `student_submitted_at`, `admin_status`, `admin_catatan`, `created_at`, `updated_at`) VALUES
(20, 20, '2026-07-30 14:31:32', 'approved', NULL, '2026-05-03 22:51:30', '2026-08-03 21:13:57'),
(21, 21, NULL, 'pending', NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(22, 22, NULL, 'pending', NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 23, NULL, 'pending', NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(24, 24, NULL, 'pending', NULL, '2026-05-05 19:12:04', '2026-05-05 19:12:04'),
(25, 25, NULL, 'pending', NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(26, 26, NULL, 'pending', NULL, '2026-05-06 16:29:24', '2026-05-06 16:29:24'),
(27, 27, NULL, 'pending', NULL, '2026-05-07 09:51:19', '2026-05-07 09:51:19'),
(28, 28, NULL, 'pending', NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(29, 29, NULL, 'pending', NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 30, NULL, 'pending', NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 31, '2026-07-30 11:23:49', 'approved', NULL, '2026-05-08 18:44:43', '2026-08-03 21:14:19'),
(32, 32, '2026-07-29 21:21:13', 'approved', NULL, '2026-05-10 08:46:55', '2026-08-03 21:15:56'),
(33, 33, '2026-07-30 12:09:22', 'approved', NULL, '2026-05-10 15:08:24', '2026-08-03 21:17:26'),
(34, 34, NULL, 'pending', NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(35, 35, NULL, 'pending', NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 36, NULL, 'pending', NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 37, NULL, 'pending', NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 38, NULL, 'pending', NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 39, NULL, 'pending', NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 40, NULL, 'pending', NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(41, 41, NULL, 'pending', NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(42, 42, NULL, 'pending', NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(43, 43, NULL, 'pending', NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 44, NULL, 'pending', NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 45, NULL, 'pending', NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(46, 46, NULL, 'pending', NULL, '2026-05-14 14:09:55', '2026-05-14 14:09:55'),
(47, 47, NULL, 'pending', NULL, '2026-05-14 20:07:38', '2026-05-14 20:07:38'),
(48, 48, NULL, 'pending', NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 49, '2026-07-30 12:40:26', 'approved', NULL, '2026-05-16 10:08:37', '2026-08-03 21:17:42'),
(50, 50, NULL, 'pending', NULL, '2026-05-17 12:39:29', '2026-05-17 12:39:29'),
(51, 51, NULL, 'pending', NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(52, 52, NULL, 'pending', NULL, '2026-05-19 09:39:39', '2026-05-19 09:39:39'),
(53, 53, NULL, 'pending', NULL, '2026-05-19 10:46:34', '2026-05-19 10:46:34'),
(54, 54, NULL, 'pending', NULL, '2026-05-19 11:24:58', '2026-05-19 11:24:58'),
(55, 55, NULL, 'pending', NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 56, NULL, 'pending', NULL, '2026-05-19 11:26:44', '2026-05-19 11:26:44'),
(57, 57, NULL, 'pending', NULL, '2026-05-19 20:59:29', '2026-05-19 20:59:29'),
(58, 58, NULL, 'pending', NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 59, NULL, 'pending', NULL, '2026-05-20 12:59:15', '2026-05-20 12:59:15'),
(60, 60, NULL, 'pending', NULL, '2026-05-20 14:04:10', '2026-05-20 14:04:10'),
(61, 61, '2026-07-30 08:31:17', 'approved', NULL, '2026-05-20 15:22:10', '2026-08-03 21:16:24'),
(62, 62, NULL, 'pending', NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, '2026-07-29 23:35:23', 'approved', NULL, '2026-05-21 12:55:59', '2026-08-03 21:17:00'),
(64, 64, NULL, 'pending', NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, '2026-07-30 16:06:22', 'approved', NULL, '2026-05-21 16:09:44', '2026-08-03 21:17:53'),
(66, 66, NULL, 'pending', NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(67, 67, NULL, 'pending', NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(68, 68, NULL, 'pending', NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(69, 69, NULL, 'pending', NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(70, 70, NULL, 'pending', NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(71, 71, NULL, 'pending', NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(72, 72, '2026-07-30 09:47:09', 'approved', NULL, '2026-05-23 12:32:08', '2026-08-03 21:17:14'),
(73, 73, NULL, 'pending', NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, NULL, 'pending', NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(75, 75, NULL, 'pending', NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(76, 76, NULL, 'pending', NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(77, 77, NULL, 'pending', NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(78, 78, NULL, 'pending', NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(79, 79, NULL, 'pending', NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, NULL, 'pending', NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(81, 81, NULL, 'pending', NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(82, 82, '2026-07-29 00:35:59', 'approved', NULL, '2026-05-24 21:24:13', '2026-08-03 21:16:48'),
(83, 83, NULL, 'pending', NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(85, 85, '2026-07-29 21:45:41', 'approved', NULL, '2026-05-25 11:04:52', '2026-08-03 21:16:37'),
(86, 86, NULL, 'pending', NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, '2026-07-29 11:19:13', 'approved', NULL, '2026-05-25 21:19:46', '2026-08-03 21:16:11'),
(88, 88, NULL, 'pending', NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, '2026-07-29 09:28:11', 'approved', NULL, '2026-05-26 16:49:16', '2026-08-03 21:15:34'),
(91, 91, NULL, 'pending', NULL, '2026-06-05 12:09:36', '2026-06-05 12:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_pitching_assessments`
--

CREATE TABLE `pmw_pitching_assessments` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `penilai_user_id` int UNSIGNED NOT NULL,
  `is_admin_assessment` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('approved','rejected') NOT NULL,
  `catatan` text,
  `edited_by_admin` tinyint(1) NOT NULL DEFAULT '0',
  `persentase_nilai` decimal(5,2) DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pmw_pitching_assessments`
--

INSERT INTO `pmw_pitching_assessments` (`id`, `proposal_id`, `penilai_user_id`, `is_admin_assessment`, `status`, `catatan`, `edited_by_admin`, `persentase_nilai`, `submitted_at`, `created_at`, `updated_at`) VALUES
(7, 53, 128, 0, 'rejected', 'untuk presentasinya kurang dirinckan mengenai penggunan biaya awal yang digunakan sesuai dengan biaya yang dimiliki, untuk perikiraan target margin bulanan terlalu minim untuk mendapatkan pengembalian modal awal', 0, 45.81, '2026-06-06 10:10:54', '2026-06-06 10:10:54', '2026-06-06 10:10:54'),
(8, 24, 124, 0, 'rejected', 'anggota tdk hadir 1 untk produk kurang kreatif. paparan kurang siap. ke uangan kurang rinci', 0, 71.15, '2026-06-06 10:12:41', '2026-06-06 10:12:41', '2026-06-06 10:12:41'),
(9, 89, 124, 0, 'approved', 'kreatif ', 0, 88.05, '2026-06-06 10:20:52', '2026-06-06 10:20:52', '2026-06-06 10:20:52'),
(10, 75, 128, 0, 'approved', 'kurangnya perhitungan mengenai pembiayaan yang di butuhkan dari bahan pokok dan bahan baku yang dimiliki serta perhitungam modal yang digunakan untuk membeli harus sesuai berapa banyak stock yang diperlukan untuk awal. ', 0, 90.00, '2026-06-06 10:51:12', '2026-06-06 10:51:12', '2026-06-06 10:51:12'),
(11, 75, 126, 0, 'rejected', 'kurang dipenjelesana proyeksi keuangan, merupakan poin paling penting dari sebuah bisnis/ \r\nkalau ide dan konsep sudah bagus dan ok. ', 0, 76.35, '2026-06-06 10:55:36', '2026-06-06 10:55:36', '2026-06-06 10:55:36'),
(12, 87, 124, 0, 'approved', 'pengembangan untk produk oke dan perizinan pirt halal dan pengembangan produk frozen', 0, 90.98, '2026-06-06 11:04:09', '2026-06-06 11:04:09', '2026-06-06 11:04:09'),
(13, 46, 128, 0, 'approved', 'penjelasan baik hanya perlu diperhitungkan kebali mengenai target bulanan dan kenaikan tiap bulan secara rinci.', 1, 82.00, '2026-06-06 11:15:12', '2026-06-06 11:15:12', '2026-06-09 06:24:42'),
(14, 46, 126, 0, 'approved', 'idenya simpel, gampang dieksekusi dan realistis. perhitungan jelas. hanya nanti PRnya eksekusi yang konsisten. ', 1, 82.00, '2026-06-06 11:26:21', '2026-06-06 11:26:21', '2026-06-09 06:24:32'),
(15, 82, 124, 0, 'approved', 'bisa dikembang ', 0, 83.77, '2026-06-06 11:27:29', '2026-06-06 11:27:29', '2026-06-06 11:27:29'),
(16, 53, 126, 0, 'rejected', 'idenya bagus dan ok.\r\nhanya saja margin terlalu tipis sangan susah untuk mengejar target. ', 0, 60.44, '2026-06-06 11:27:33', '2026-06-06 11:27:33', '2026-06-06 11:27:33'),
(17, 87, 125, 0, 'approved', 'Untuk produk sangat menarik', 1, 89.93, '2026-06-06 11:35:00', '2026-06-06 11:35:00', '2026-06-08 20:58:21'),
(18, 89, 125, 0, 'approved', 'Produk umum, cuma sangat beras peluang untuk di branding', 0, 88.08, '2026-06-06 11:37:12', '2026-06-06 11:37:12', '2026-06-06 11:37:12'),
(19, 82, 125, 0, 'approved', 'Kreatif, tinggal peningkatan penjualan ', 0, 80.77, '2026-06-06 11:39:17', '2026-06-06 11:39:17', '2026-06-06 11:39:17'),
(20, 72, 124, 0, 'approved', 'produknya kreatif mempunyai peluang pasar yg menjanjikan', 1, 91.17, '2026-06-06 11:40:44', '2026-06-06 11:40:44', '2026-06-08 20:53:45'),
(21, 59, 128, 0, 'rejected', 'sudah baikn hanya kedepannya biaya nodal hingga laba bersih yang di dapat dalam jangka waktu sebulan. Lalu tidak ada proyeksi keuangan 1 th kedepan', 1, 70.00, '2026-06-06 11:41:49', '2026-06-06 11:41:49', '2026-06-09 06:26:53'),
(22, 72, 125, 0, 'approved', 'Produk dan presentasi sudah oke', 1, 80.51, '2026-06-06 11:48:16', '2026-06-06 11:48:16', '2026-06-08 20:53:29'),
(23, 59, 126, 0, 'rejected', 'dari ide sangat menjawab permasalahan dilokasi.\r\ntapi tidak ada proyeksi keuangan 1 th kedepan\r\nPR harus memikirkan sumber pedapatan lainya supaya bisa meningkatkan keuntungan ', 1, 70.00, '2026-06-06 11:53:18', '2026-06-06 11:53:18', '2026-06-09 06:26:20'),
(24, 32, 125, 0, 'approved', 'Sanggat besar peluangnya tinggal pembesaran pasar', 0, 91.54, '2026-06-06 12:06:58', '2026-06-06 12:06:58', '2026-06-06 12:06:58'),
(25, 50, 128, 0, 'rejected', 'bisa bagus hanya perlu evaluasi lebih banyak lagi mengenai target markett dan inovasi pada pelanggan', 0, 78.16, '2026-06-06 12:22:05', '2026-06-06 12:22:05', '2026-06-06 12:22:05'),
(26, 26, 124, 0, 'approved', 'judul diganti ditambah produk tipy lain dan keuangan', 1, 80.01, '2026-06-06 12:59:54', '2026-06-06 12:32:28', '2026-06-09 06:30:18'),
(27, 50, 126, 0, 'approved', 'ide kreatif, tabtangan terbesar di volume penjualan, karena melihat produk yang sangat spesifik dengan konsumen yang spesifik juga. ', 0, 80.41, '2026-06-06 12:56:12', '2026-06-06 12:56:12', '2026-06-06 12:56:12'),
(28, 26, 125, 0, 'approved', 'Peluang bisnis masih besar ', 1, 80.01, '2026-06-06 13:16:04', '2026-06-06 13:16:04', '2026-06-09 06:25:15'),
(29, 52, 125, 0, 'rejected', 'Pemaparan dan produk tidak selaras', 0, 79.62, '2026-06-06 13:21:56', '2026-06-06 13:21:56', '2026-06-06 13:21:56'),
(30, 52, 124, 0, 'rejected', 'judul tdk sesuai  keuangan diperbaiki', 0, 75.87, '2026-06-06 13:22:50', '2026-06-06 13:22:50', '2026-06-06 13:22:50'),
(31, 61, 128, 0, 'approved', 'perkembangannya sudah bagus hanya perlu di evaluasi tujuan penggunaan dana yang tepat agar ekspansi dpat terjadi secara optimal.', 0, 97.20, '2026-06-06 13:30:40', '2026-06-06 13:30:40', '2026-06-06 13:30:40'),
(32, 61, 126, 0, 'approved', 'ide nya mendasar, secara bisnis gampang d aplikasikan tapi rentan dengan kebocoran, karena waktu paparan tidak jelas di bagian HPP dan laporan keuangan. ', 0, 80.03, '2026-06-06 13:31:22', '2026-06-06 13:31:22', '2026-06-06 13:31:22'),
(33, 74, 125, 0, 'rejected', 'Tidak menguasai produk, masih coba2 dan blm berhasil, tidak mengenal HPP. Inovasinya keren', 0, 78.08, '2026-06-06 13:47:48', '2026-06-06 13:47:48', '2026-06-06 13:47:48'),
(34, 74, 124, 0, 'rejected', 'produknya tdk spesifik  keuangan perbaikan', 0, 71.03, '2026-06-06 13:50:24', '2026-06-06 13:50:24', '2026-06-06 13:50:24'),
(35, 47, 128, 0, 'rejected', 'perlu melakukam perhitungan keuangan modal dan biaya oenjualan kembaoli agar tahu secara langsung tafget perbulan dan perhitungan modal pendpatan yang dituju', 0, 62.85, '2026-06-06 13:51:41', '2026-06-06 13:51:41', '2026-06-06 13:51:41'),
(36, 47, 126, 0, 'approved', 'secara ide bagus, tapi secara prduk akan susah intuk d pasarkan jika tidak serius di marketing. \r\nperhitungan HPP belum jelas secara perencanaan keuangan masih sangat kurang. ', 0, 80.03, '2026-06-06 13:54:50', '2026-06-06 13:54:50', '2026-06-06 13:54:50'),
(37, 71, 126, 0, 'rejected', 'peserta tidak menguasi dan belum siap, terlihat dri total biaya pengajuan yang hanya 300ribu. proyeksi pendapatan belum ada, anggaran dan target belum jelas. ', 0, 78.15, '2026-06-06 14:15:47', '2026-06-06 14:15:47', '2026-06-06 14:15:47'),
(38, 71, 128, 0, 'rejected', 'kurang mencantumkan pembiayaan dn dana modaln hingga target penjualan yang akan dilakukan serta tidak mencantumkan modal yang dibutuhkan beraoa untuk pengajuan usahanya hanya usaha nya sudah cukup bagus', 0, 31.16, '2026-06-06 14:16:32', '2026-06-06 14:16:32', '2026-06-06 14:16:32'),
(39, 20, 125, 0, 'approved', 'Baik, sangat berpotensi besar usaha ini jika bisa di Kolaka dg baik', 1, 80.41, '2026-06-06 14:16:34', '2026-06-06 14:16:33', '2026-06-09 06:29:01'),
(40, 20, 124, 0, 'approved', 'perbaiki keuangan', 1, 80.41, '2026-06-06 14:18:23', '2026-06-06 14:18:23', '2026-06-09 06:28:47'),
(41, 65, 125, 0, 'approved', 'Tingkatkan penjualan ', 0, 85.38, '2026-06-06 14:35:32', '2026-06-06 14:35:32', '2026-06-06 14:35:32'),
(42, 76, 126, 0, 'approved', 'pr nya marketing harus lebih gencar lagi. karena darinsisi produk dan tampilan sdh ok. idenya ok, ', 1, 80.01, '2026-06-06 14:46:41', '2026-06-06 14:46:41', '2026-06-09 06:22:58'),
(43, 76, 128, 0, 'approved', 'produk sudah bagushanya anggaran biayanyaa dan target mrket audiens nya perlu dinperbaiki untuk permintaan modalnya boleh di rincikan kembali ', 1, 80.01, '2026-06-06 14:46:51', '2026-06-06 14:46:51', '2026-06-09 06:29:31'),
(44, 65, 124, 0, 'approved', 'tambahkan jenis2 kaos kaki dan perbaiki keuangan', 0, 82.30, '2026-06-06 14:54:24', '2026-06-06 14:54:24', '2026-06-06 14:54:24'),
(45, 32, 124, 0, 'approved', 'perbaiki keuangan', 0, 85.68, '2026-06-06 14:55:25', '2026-06-06 14:55:25', '2026-06-06 14:55:25'),
(46, 67, 126, 0, 'approved', 'memliki potensi untuk berkembang ', 0, 82.58, '2026-06-06 15:05:32', '2026-06-06 15:05:32', '2026-06-06 15:05:32'),
(47, 67, 128, 0, 'rejected', 'belajar dan workshop lebih dahulu agar llebih mempersiapkan diri dalam membuka usaha dikemdian hari', 0, 42.74, '2026-06-06 15:08:58', '2026-06-06 15:08:58', '2026-06-06 15:08:58'),
(48, 85, 127, 0, 'rejected', 'bisnisnya bagus tapi kurang dalam penyampaian materi', 0, 75.08, '2026-06-06 15:16:43', '2026-06-06 15:16:43', '2026-06-06 15:16:43'),
(49, 27, 127, 0, 'rejected', 'bisnis prospeknya kurang menjanjikan, dan tim masih kurang memahami market yang mau dimasuki', 0, 70.26, '2026-06-06 15:17:48', '2026-06-06 15:17:48', '2026-06-06 15:17:48'),
(50, 86, 127, 0, 'approved', 'produk menarik, dan harga affordable. \r\nditambah ada support dari bisnis orang tua yang linier kemungkinan bisnis survive cukup tinggi', 0, 85.10, '2026-06-06 15:19:18', '2026-06-06 15:19:18', '2026-06-06 15:19:18'),
(51, 33, 126, 0, 'approved', 'secara keseluruhan sudah bagus, menguasai materi, ide bagus, dan sudah berjalan ', 1, 90.18, '2026-06-06 15:21:38', '2026-06-06 15:21:38', '2026-06-08 21:00:07'),
(52, 66, 127, 0, 'rejected', 'produk bagus dan menarik.\r\n\r\nhanya saja pimpinan tim terlihat jualan hanya ketika mood. terlihat dari bisnisnya yang satu lini dengan gyoza yaitu dimsum yang sangat bergantung pada mood swing owner', 0, 79.83, '2026-06-06 15:24:43', '2026-06-06 15:24:43', '2026-06-06 15:24:43'),
(53, 63, 127, 0, 'approved', 'produk sangat unik dan menarik, teruskan', 1, 90.00, '2026-06-06 15:26:56', '2026-06-06 15:26:55', '2026-06-08 20:49:32'),
(54, 33, 128, 0, 'approved', 'sudah bagus ', 1, 90.10, '2026-06-06 15:27:04', '2026-06-06 15:27:04', '2026-06-09 06:30:56'),
(55, 83, 127, 0, 'rejected', 'produk biasa aja, ga ada yang menarik. ', 0, 72.89, '2026-06-06 15:30:17', '2026-06-06 15:30:17', '2026-06-06 15:30:17'),
(56, 31, 127, 0, 'approved', 'Menunjukkan urgensi masalah konsumen yang sangat jelas berbasis data, memiliki model bisnis (BMC) yang matang, serta didukung performa presentasi dan penguasaan materi yang luar biasa saat menjawab pertanyaan dan yang paling penting laporan keuangan yang sangat baik dan sangat prospektif serta saya melihat susunan tim anda sangat komplit dan sangat bisa diandalkan satu sama lain', 1, 99.36, '2026-06-06 15:32:43', '2026-06-06 15:32:43', '2026-06-08 20:39:02'),
(57, 80, 127, 0, 'rejected', 'model bisnis biasa,\r\nproduk juga biasa.\r\n\r\nsusah survive kalau masuk ke red ocean', 0, 70.67, '2026-06-06 15:34:34', '2026-06-06 15:34:34', '2026-06-06 15:34:34'),
(58, 49, 127, 0, 'approved', 'bisnis udah jalan, menarik untuk perkembangannya. \r\ntinggal dipoles untuk jadi lebih besar. ', 0, 81.97, '2026-06-06 15:36:57', '2026-06-06 15:36:57', '2026-06-06 15:36:57'),
(59, 77, 127, 0, 'approved', 'proyek yang menarik dan timnya semangat serta excited dengan yang dikerjakan.', 0, 82.00, '2026-06-06 15:41:38', '2026-06-06 15:41:38', '2026-06-06 15:41:38'),
(60, 68, 127, 0, 'rejected', 'produknya menarik, cuma baru sebatas prototype. \r\nmasih meragukan. ', 0, 77.25, '2026-06-06 15:43:22', '2026-06-06 15:43:22', '2026-06-06 15:43:22'),
(61, 69, 127, 0, 'rejected', 'bisnis kurang menjanjikan,\r\npresentasi terlalu AI dan usaha masih belum berjalan', 0, 74.70, '2026-06-06 15:44:53', '2026-06-06 15:44:53', '2026-06-06 15:44:53'),
(62, 78, 127, 0, 'rejected', 'bagus, dan keren.\r\nidenya unik dan applicable. ', 0, 79.09, '2026-06-06 15:49:10', '2026-06-06 15:49:10', '2026-06-06 15:49:10'),
(63, 81, 127, 0, 'approved', 'bisnis ini niche nya besar dan market yang butuh banyak\r\ntinggal gimana tim eksekusi di lapangan', 0, 80.78, '2026-06-06 15:49:49', '2026-06-06 15:49:49', '2026-06-06 15:49:49'),
(64, 81, 123, 0, 'rejected', 'Proposal sudah cukup lengkap dan relevan, namun masih lemah pada analisis pasar berbasis data, proyeksi keuangan, serta strategi pemasaran yang spesifik dan terukur. Terdapat juga pengulangan isi pada beberapa slide. Perlu penguatan diferensiasi agar lebih kompetitif', 1, 65.44, '2026-06-06 17:28:29', '2026-06-06 17:28:29', '2026-06-08 21:42:37'),
(65, 27, 123, 0, 'rejected', 'Proposal menunjukkan ide pengembangan yang menarik dan lebih bernilai, namun masih lemah pada aspek legalitas yang belum terpenuhi serta belum ada data pasar dan proyeksi keuangan yang jelas. Perlu penguatan diferensiasi, kesiapan operasional, dan kelengkapan administrasi agar lebih layak dikembangkan', 0, 71.31, '2026-06-06 17:34:25', '2026-06-06 17:34:25', '2026-06-06 17:34:25'),
(66, 69, 123, 0, 'rejected', 'Proposal memiliki potensi pasar yang jelas dan sudah didukung gambaran biaya, namun masih perlu penguatan pada analisis pesaing, strategi pemasaran yang lebih terukur, serta proyeksi keuntungan. Perlu juga memperjelas diferensiasi produk agar lebih kompetitif', 0, 68.32, '2026-06-06 17:39:17', '2026-06-06 17:39:17', '2026-06-06 17:39:17'),
(67, 68, 123, 0, 'rejected', 'Proposal memiliki ide inovasi yang relevan dan sesuai tren pasar anak muda, namun masih perlu penguatan pada analisis pesaing, proyeksi keuangan, serta strategi pemasaran yang lebih terukur. Perlu juga konsistensi kualitas produk dan diferensiasi agar mampu bersaing secara berkelanjutan .', 0, 63.36, '2026-06-06 17:43:08', '2026-06-06 17:43:08', '2026-06-06 17:43:08'),
(68, 77, 123, 0, 'approved', 'Proposal sudah cukup lengkap dari sisi ide, pasar, hingga keuangan, namun masih perlu penguatan pada analisis pesaing dan validasi pasar. Proyeksi pendapatan perlu didukung asumsi yang lebih realistis, serta strategi pemasaran dibuat lebih terukur agar implementasi usaha lebih meyakinkan', 0, 83.75, '2026-06-06 17:50:39', '2026-06-06 17:50:39', '2026-06-06 17:50:39'),
(69, 86, 123, 0, 'approved', 'Proposal memiliki konsep inovasi yang kuat dan analisis keuangan yang cukup detail, namun masih terdapat pengulangan isi pada beberapa bagian serta asumsi proyeksi keuntungan yang perlu divalidasi agar lebih realistis. Perlu juga penajaman analisis pesaing dan strategi pemasaran yang lebih spesifik agar implementasi lebih meyakinkan', 0, 87.25, '2026-06-06 17:56:00', '2026-06-06 17:56:00', '2026-06-06 17:56:00'),
(70, 49, 123, 0, 'approved', 'Proposal menunjukkan usaha yang sudah berjalan dan memiliki inovasi produk serta pemasaran digital yang baik, namun masih terkendala pada aspek operasional seperti penyimpanan bahan dan efisiensi produksi. Selain itu, legalitas usaha belum terpenuhi. Perlu prioritas pada pengadaan alat, peningkatan kapasitas produksi, dan pengurusan izin usaha agar lebih berkembang dan profesional', 0, 93.75, '2026-06-06 17:59:39', '2026-06-06 17:59:39', '2026-06-06 17:59:39'),
(71, 78, 123, 0, 'approved', 'Proposal menunjukkan konsep yang jelas dan relevan dengan kebutuhan pasar, namun masih lemah pada aspek keuangan yang sangat sederhana dan belum menunjukkan kelayakan bisnis secara menyeluruh. Selain itu, terdapat pengulangan konten pada beberapa bagian. Perlu penguatan analisis pasar, proyeksi keuangan, dan strategi pengembangan agar lebih meyakinkan', 0, 83.75, '2026-06-06 18:04:32', '2026-06-06 18:04:32', '2026-06-06 18:04:32'),
(72, 31, 123, 0, 'approved', 'Proposal yang sangat baik dengan arah bisnis yang jelas dan portofolio awal yang kuat. Sangat disarankan untuk penguatan pada positioning dan model bisnis agar semakin scalable. Tim anda juga sangat kompeten satu sama lain, sangat bagus sekali.', 1, 98.36, '2026-06-06 18:11:05', '2026-06-06 18:11:05', '2026-06-08 20:41:03'),
(73, 63, 123, 0, 'approved', 'Proposal memiliki ide inovatif yang kuat dengan diferensiasi produk aromaterapi yang jelas dan relevan dengan kebutuhan pasar. Namun, masih perlu penguatan pada aspek proyeksi keuangan, strategi pemasaran yang lebih terukur, serta validasi pasar yang lebih luas agar potensi bisnis lebih meyakinkan', 1, 80.76, '2026-06-06 18:13:38', '2026-06-06 18:13:38', '2026-06-08 20:48:48'),
(74, 83, 123, 0, 'rejected', 'Proposal memiliki inovasi produk yang jelas pada peningkatan daya simpan melalui kemasan vakum dan penambahan nilai gizi, namun masih perlu penguatan pada aspek pemasaran, proyeksi keuangan, serta strategi distribusi. Selain itu, legalitas seperti sertifikasi halal perlu segera direalisasikan untuk meningkatkan kepercayaan pasar', 0, 75.00, '2026-06-06 18:16:18', '2026-06-06 18:16:18', '2026-06-06 18:16:18'),
(75, 66, 123, 0, 'approved', 'Proposal menunjukkan konsep bisnis yang cukup matang dengan model bisnis, segmentasi pasar, serta proyeksi keuangan yang relatif lengkap dan terukur. Namun, masih perlu penguatan pada validasi pasar berbasis data riil, analisis pesaing yang lebih spesifik, serta konsistensi asumsi keuangan. Perlu juga penajaman diferensiasi agar keunggulan produk lebih kuat dan berkelanjutan', 1, 81.55, '2026-06-06 18:20:02', '2026-06-06 18:20:02', '2026-06-18 10:04:37'),
(76, 85, 123, 0, 'approved', 'Proposal memiliki konsep usaha yang jelas dengan positioning pada fashion tradisional Melayu modern serta didukung peluang pasar yang relevan. Namun, masih perlu penguatan pada analisis pesaing, proyeksi keuangan, serta diferensiasi produk yang lebih spesifik. Strategi pemasaran juga perlu dibuat lebih terukur agar pengembangan usaha lebih terarah dan kompetitif', 0, 85.50, '2026-06-06 18:25:07', '2026-06-06 18:25:07', '2026-06-06 18:25:07'),
(77, 80, 123, 0, 'rejected', 'Proposal memiliki konsep diferensiasi pada packaging gift dan pendekatan personal kepada konsumen. Namun, masih perlu penguatan pada aspek proyeksi keuangan, analisis pesaing yang lebih tajam, serta strategi pemasaran yang terukur. Perlu juga validasi pasar yang lebih luas agar model bisnis lebih meyakinkan dan scalable', 0, 75.00, '2026-06-06 18:29:50', '2026-06-06 18:29:50', '2026-06-06 18:29:50'),
(78, 60, 128, 0, 'rejected', 'Untuk milky quest untuk permintaan dana nya masuk akal, hanya saja di bagian keuntungan perbulan 700.000 bersih dan penggunaan dana tiap bulan sampai gaji tidak dirin ikan mengenai biaya operasional perbulan nya, dan modal percup sampai keuntungan percup tidak dituliskan rinci, untuk ide usaha nya terlalu basic dan tidak menarik dibanding susu kemasan dingin yang ada di market market sejauh ini ', 0, 68.29, '2026-06-07 15:17:44', '2026-06-07 15:17:44', '2026-06-07 15:17:44'),
(79, 54, 128, 0, 'rejected', 'ide usaha nya sudah terllau banyak dipasaran untuk harga juga standar dan tidak ada peebedaan signifikan dengan brand brand lain, untuk pemasaran promosi dan penjualan secara online apakah sudah pasti mendapatkan pelanggan , untuk target pencapaian 20 box perhari bisa memungkin kan tapi terhantung konsistensi untuk oenjualan apakah setiap hari akan melakukan produksi pembuatan makanan?, untuk biaya perhitungan modal tidak rinci, perhitungan tidak sesuai tanpa penggunaan gas dan alat bahan lainnya', 0, 54.29, '2026-06-07 15:18:24', '2026-06-07 15:18:24', '2026-06-07 15:18:24'),
(80, 60, 127, 0, 'rejected', 'Ide bisnis yang diajukan sudah cukup menarik, namun rencana bisnis dan strategi eksekusinya masih memerlukan pendalaman yang lebih matang. Tetap semangat dan silakan kembangkan lagi proposal ini untuk kesempatan berikutnya', 0, 57.58, '2026-06-07 15:21:40', '2026-06-07 15:21:40', '2026-06-07 15:21:40'),
(81, 54, 127, 0, 'rejected', 'Hasil presentasi dan pemaparan materi belum memenuhi standar batas kelulusan minimal pitching saat ini. Direkomendasikan untuk melakukan evaluasi menyeluruh pada pemetaan target pasar dan proyeksi keuangan usaha', 0, 59.81, '2026-06-07 15:22:18', '2026-06-07 15:22:18', '2026-06-07 15:22:18'),
(82, 78, 130, 0, 'rejected', 'Belum memenuhi batas minimal kelulusan nilai pitching. Silakan evaluasi kembali model bisnis Anda dan lakukan revisi sesuai dengan umpan balik panduan PMW', 1, 50.75, '2026-06-08 18:04:01', '2026-06-08 18:04:01', '2026-06-08 20:31:46'),
(83, 75, 130, 0, 'rejected', 'Peserta  tidak menjelaskan proyeksi keuangan sesuai aturan pedoman buku pmw 2026', 0, 60.34, '2026-06-08 21:45:57', '2026-06-08 21:07:46', '2026-06-08 21:45:57'),
(84, 76, 130, 0, 'rejected', 'file yang dikumpulkan tidak sesuai format penulisan Buku Panduan PMW 2026, serta tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 1, 60.46, '2026-06-09 10:05:02', '2026-06-08 21:21:26', '2026-06-09 10:05:02'),
(85, 81, 130, 0, 'rejected', 'peserta tidak menampilkan & menjelaskan Proyeksi keuangan, sesuai aturan pedoman buku pmw 2026', 0, 60.97, '2026-06-08 21:46:28', '2026-06-08 21:22:05', '2026-06-08 21:46:28'),
(86, 59, 130, 0, 'rejected', 'Tidak ada proyeksi keuangan 1 th kedepan', 0, 70.00, '2026-06-09 06:27:33', '2026-06-09 06:27:33', '2026-06-09 06:27:33'),
(87, 31, 130, 0, 'approved', 'Mencantumkan Bukti kegiatan (aktivitas usaha : video, media sosial), Laporan laba/rugi, bukti transaksi penjualan, Cash flow minimal 6 bulan sebelumnya sesuai aturan buku panduan PMW 2026', 0, 98.86, '2026-06-09 09:16:58', '2026-06-09 09:16:58', '2026-06-09 09:16:58'),
(88, 87, 130, 0, 'approved', 'Peserta merupakan PMW periode tahun 2025 yang sudah banyak menuunjukan hasil usaha signifikan, namun belum mencantumkan cash flow bukti transaksi 6 bulan', 0, 90.46, '2026-06-09 09:19:22', '2026-06-09 09:19:22', '2026-06-09 09:19:22'),
(89, 33, 130, 0, 'approved', 'Usaha baik, dan sudah melengkapi cash flow minimal 6 bulan', 0, 90.14, '2026-06-09 09:20:19', '2026-06-09 09:20:19', '2026-06-09 09:20:19'),
(90, 61, 130, 0, 'approved', 'Produk Usaha PMW pada periode tahun 2025 yang sudah menunjukan hasil penjualan yang signifikan dan lengkap legalitas, namun perhitungan cash belum dirincikan secara detail hanya menampilkan grafik saja', 0, 90.73, '2026-06-09 09:22:38', '2026-06-09 09:22:38', '2026-06-09 09:22:38'),
(91, 49, 130, 0, 'approved', 'Bukti kegiatan usaha berupa media sosial IG terlampir menunjukan usaha telah berjalan, namun aktivitas video kegiatan berwirausaha tidak ada, Laporan laba/rugi, bukti transaksi penjualan, Cash flow minimal 6 bulan sebelumnya sesuai aturan buku panduan PMW 2026 tidak di cantumkan', 0, 80.01, '2026-06-09 09:28:29', '2026-06-09 09:28:29', '2026-06-09 09:28:29'),
(92, 85, 130, 0, 'approved', 'Usaha sudah berjalan sangat signifikan dibuktikan dengan media penjualan melalui akun shopee, namun pada PPT peserta tidak mencantumkan Laporan laba/rugi, bukti transaksi penjualan, Cash flow minimal 6 bulan sebelumnya sesuai aturan buku panduan PMW 2026', 0, 80.16, '2026-06-09 09:32:58', '2026-06-09 09:32:58', '2026-06-09 09:32:58'),
(93, 32, 130, 0, 'approved', 'Usaha yang akan di jalankan tergambarkan dengan baik namun Tidak mencantumkan Potensi pengembangan usaha,Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 81.16, '2026-06-09 09:36:15', '2026-06-09 09:36:15', '2026-06-09 09:36:15'),
(94, 72, 130, 0, 'approved', 'Usaha yang akan dijalan tergambarkan dengan baik namun tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 80.81, '2026-06-09 09:38:28', '2026-06-09 09:38:28', '2026-06-09 09:38:28'),
(95, 63, 130, 0, 'approved', 'Usaha yang akan dijalankan sudah tergambarkan, namun tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 80.66, '2026-06-09 09:40:52', '2026-06-09 09:40:52', '2026-06-09 09:40:52'),
(96, 65, 130, 0, 'approved', 'Usaha yang akan dijalan sudah dengan baik tergambarkan, namun produk belum menunjukan inovasi / nilai keterbaruan dari yang ada pada umumnya serta tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 80.01, '2026-06-09 09:45:07', '2026-06-09 09:45:07', '2026-06-09 09:45:07'),
(97, 89, 130, 0, 'approved', 'Usaha sudah tergambarkan dengan sangat baik dan mencantumkan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 88.07, '2026-06-09 09:49:41', '2026-06-09 09:49:41', '2026-06-09 09:49:41'),
(98, 86, 130, 0, 'rejected', 'Mengundurkan diri', 1, 60.67, '2026-06-09 09:50:46', '2026-06-09 09:50:46', '2026-07-23 11:23:11'),
(99, 77, 130, 0, 'rejected', 'Belum lolos Verifikasi Administrasi', 1, 70.00, '2026-06-09 09:53:57', '2026-06-09 09:52:42', '2026-07-30 15:43:34'),
(100, 82, 130, 0, 'approved', 'usaha yang akan dijalankan sudah tergambarkan dengan baik namun tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 80.95, '2026-06-09 09:55:49', '2026-06-09 09:55:49', '2026-06-09 09:55:49'),
(101, 46, 130, 0, 'rejected', 'Mengundurkan diri', 1, 70.00, '2026-06-09 09:58:06', '2026-06-09 09:58:06', '2026-07-23 11:21:48'),
(102, 20, 130, 0, 'approved', 'usaha yang akan dijalankan tergambar sudah baik, namun tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 80.01, '2026-06-09 09:59:41', '2026-06-09 09:59:41', '2026-06-09 09:59:41'),
(103, 26, 130, 0, 'rejected', 'usaha yang akan dijalankan tergambar sudah baik, namun tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026. Format proposal belum sesuai dengan \r\nBuku Panduan PMW 2026', 1, 70.00, '2026-06-09 10:00:59', '2026-06-09 10:00:59', '2026-07-23 11:20:21'),
(104, 66, 130, 0, 'rejected', 'usaha yang akan dijalankan tergambar cukup baik, dan mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026. Format proposal belum sesuai dengan \r\nBuku Panduan PMW 2026', 1, 70.00, '2026-06-09 15:00:47', '2026-06-09 10:07:46', '2026-07-23 11:20:58'),
(105, 53, 130, 0, 'rejected', 'file tidak sesuai buku panduan PMW 2026,  tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 53.13, '2026-06-09 10:09:37', '2026-06-09 10:09:37', '2026-06-09 10:09:37'),
(106, 71, 130, 0, 'rejected', 'File tidak sesuai format Buku panduan PMW 2026, Tidak ada rincian biaya serta tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 54.66, '2026-06-09 10:13:25', '2026-06-09 10:13:25', '2026-06-09 10:13:25'),
(107, 54, 130, 0, 'rejected', 'usaha yang akan dijalankan tidak tergambarkan dengan jelas dan tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 57.05, '2026-06-09 10:14:40', '2026-06-09 10:14:40', '2026-06-09 10:14:40'),
(108, 67, 130, 0, 'rejected', 'File yang dikirimakan tidak sesuai format Buku panduan PMW 2026, usaha tidak tergambarkan dengan jelas, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 49.39, '2026-06-09 10:21:20', '2026-06-09 10:21:20', '2026-06-09 10:21:20'),
(109, 60, 130, 0, 'rejected', 'usaha yang akan dijalankan belum digambarkan dengan jelas serta Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan)  secara detail sesuai aturan buku panduan PMW 2026', 0, 60.75, '2026-06-09 10:22:43', '2026-06-09 10:22:43', '2026-06-09 10:22:43'),
(110, 68, 130, 0, 'rejected', 'usaha yang akan dijalankan belum tergambarkan dengan jelas, tidak ada inovasi keterbaruan produk, serta Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 67.72, '2026-06-09 10:24:33', '2026-06-09 10:24:33', '2026-06-09 10:24:33'),
(111, 27, 130, 0, 'rejected', 'Usaha digolongkan kategori baru, dan belum tergambarkan dengan jelas, tidak ada inovasi keterbaruan produk serta Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 64.56, '2026-06-09 10:25:48', '2026-06-09 10:25:48', '2026-06-09 10:25:48'),
(112, 24, 130, 0, 'rejected', 'usaha belum tergambarkan dengan jelas, tidak ada inovasi keterbaruan produk serta Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 64.13, '2026-06-09 10:27:21', '2026-06-09 10:27:21', '2026-06-09 10:27:21'),
(113, 47, 130, 0, 'rejected', 'usaha tidak ada nilai keterbaruan maupun inovasi lebih dibandingkan produk sejenis serta Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 71.44, '2026-06-09 10:29:46', '2026-06-09 10:29:46', '2026-06-09 10:29:46'),
(114, 69, 130, 0, 'rejected', 'file tidak sesuai format buku panduan PMW 2026, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 59.74, '2026-06-09 10:31:31', '2026-06-09 10:31:31', '2026-06-09 10:31:31'),
(115, 80, 130, 0, 'rejected', 'usaha belum menunjukan adanya inovasi keterbaruan dari produk sejenisnya, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 62.90, '2026-06-09 10:33:15', '2026-06-09 10:33:15', '2026-06-09 10:33:15'),
(116, 83, 130, 0, 'rejected', 'usaha belum memiliki inovasi keterbaruan dibanding produk sejenis, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 67.36, '2026-06-09 10:35:17', '2026-06-09 10:35:17', '2026-06-09 10:35:17'),
(117, 74, 130, 0, 'rejected', 'File tidak sesuai format Buku panduan PMW 2026, produk tidak ada inovasi/nilai keterbaruan, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan. (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 59.24, '2026-06-09 10:37:55', '2026-06-09 10:37:55', '2026-06-09 10:37:55'),
(118, 52, 130, 0, 'rejected', 'Usaha yang akan dijalankan belum tergambarkan dengan jelas, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) sesuai aturan buku panduan PMW 2026', 0, 59.74, '2026-06-09 10:39:14', '2026-06-09 10:39:14', '2026-06-09 10:39:14'),
(119, 50, 130, 0, 'rejected', 'usaha yang akan dijalankan tidak memiliki inovasi/nilai keterbaruan dibandingkan produk sejenis, Tidak mencantumkan Potensi pengembangan usaha Gambaran peluang pertumbuhan dan keberlanjutan usaha ke depan (Cashflow 1 tahun ke depan) secara detail sesuai aturan buku panduan PMW 2026', 0, 67.29, '2026-06-09 10:41:24', '2026-06-09 10:41:24', '2026-06-09 10:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_products`
--

CREATE TABLE `pmw_products` (
  `id` int UNSIGNED NOT NULL,
  `team_id` int UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_profiles`
--

CREATE TABLE `pmw_profiles` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `prodi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `semester` int NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8mb4_general_ci NOT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `socio_economic` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `pmw_profiles`
--

INSERT INTO `pmw_profiles` (`id`, `user_id`, `nama`, `nim`, `jurusan`, `prodi`, `semester`, `phone`, `gender`, `bio`, `socio_economic`, `foto`, `created_at`, `updated_at`) VALUES
(22, 42, 'M Roihan Baariq', '062430320690', 'Teknik Elektro', 'D-III Teknik Elektronika', 4, '089524931067', 'L', NULL, NULL, NULL, '2026-05-03 22:51:30', '2026-05-03 22:51:30'),
(23, 43, 'Mersi Alya Prima', '062340512654', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 6, '085832811348', 'P', NULL, NULL, NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(24, 44, 'Putri Natasya Adelia ', '062540412651', 'Teknik Kimia', 'D-IV Teknik Energi', 2, '081361399016', 'P', NULL, NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(25, 47, 'Ghefira Mutiara', '06214011232', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 8, '087892217061', 'P', NULL, NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(26, 48, 'M.Satria Wijaksono_Akuntansi', '062530501092', 'Akuntansi', 'D-III Akuntansi', 2, '089524387127', 'L', NULL, NULL, NULL, '2026-05-05 19:12:04', '2026-05-05 19:12:04'),
(27, 49, 'I Wayan Bhayu  Sastra Wiguna', '062530240407', 'Teknik Mesin', 'D-III Pemeliharaan Alat Berat', 2, '083878791477', 'L', NULL, NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(28, 50, 'Raka Meidiansyah ', '062540663121', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 2, '0895392809904', 'L', NULL, NULL, NULL, '2026-05-06 16:29:24', '2026-05-06 16:29:24'),
(29, 51, 'Melina Safitri', '062440342267', 'Teknik Elektro', 'D-IV Teknik Elektro', 4, '085838864571', 'P', NULL, NULL, NULL, '2026-05-07 09:51:19', '2026-05-07 09:51:19'),
(30, 52, 'HANDY PRIAN', '062240342179', 'Teknik Elektro', 'D-IV Teknik Elektro', 8, '082181347229', 'L', NULL, NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(31, 53, 'Dinda Olivia Dinata ', '062541023585', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Produksi Tanaman Perkebunan', 2, '088808169251', 'P', NULL, NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(32, 54, 'MUHAMMAD FATHURRAHMAN', '062430310471', 'Teknik Elektro', 'D-III Teknik Listrik', 4, '082373227261', 'L', NULL, NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(33, 55, 'FAKHRI IRAWAN 062340833143', '062340833143', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 6, '082174464169', 'L', NULL, NULL, NULL, '2026-05-08 18:44:43', '2026-05-08 18:44:43'),
(34, 56, 'Gea Audrey Lexandria Aprilian Zein', '062430601252', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '082181146216', 'L', NULL, NULL, NULL, '2026-05-10 08:46:55', '2026-05-10 08:46:55'),
(35, 57, 'Chania Putri Wiranda', '062340612755', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '083140719612', 'P', NULL, NULL, NULL, '2026-05-10 15:08:24', '2026-05-10 15:08:24'),
(36, 58, 'Elfandary Shafira Maharani ', '062340612757', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '082372076028', 'P', NULL, NULL, NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(42, 64, 'Sony Ardian', '062340342244', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '085117709550', 'L', NULL, NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(43, 65, 'Mario Febrian Dwi Putra', '062340342232', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '081264697455', 'L', NULL, NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(44, 66, 'Muhammad Ubaidillah', '062340342237', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '089669732620', 'L', NULL, NULL, NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(45, 1, 'Admin PMW', 'TEMP-1', '', '', 0, '0895634548603', 'L', NULL, NULL, NULL, '2026-05-12 18:03:35', '2026-05-12 18:03:35'),
(46, 67, 'Reza Juliansyah ', '062530240419', 'Teknik Mesin', 'D-III Pemeliharaan Alat Berat', 2, '085173240739', 'L', NULL, NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(47, 68, 'Maulidya Anisa Rahmawati', '062430601286', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '089527190983', 'P', NULL, NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(48, 69, 'Marcelino', '062430601232', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '081281935052', 'L', NULL, NULL, NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(49, 70, 'Intan Belinda', '062440422557', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 4, '085841842358', 'P', NULL, NULL, NULL, '2026-05-14 14:09:55', '2026-05-14 15:03:03'),
(50, 71, 'Karno Triyadi', '062340212085', 'Teknik Mesin', 'D-IV Teknik Mesin Produksi dan Perawatan', 6, '088747376811', 'L', NULL, NULL, NULL, '2026-05-14 20:07:38', '2026-05-14 20:07:38'),
(51, 72, 'Sarfina damayanti', '062440833335', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081564919236', 'P', NULL, NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(52, 73, 'Krisna Wati', '062541033629', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '081997487900', 'P', NULL, NULL, NULL, '2026-05-16 10:08:37', '2026-05-16 10:08:37'),
(53, 74, 'Khailla Anastya Ramadini', '062440663077', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085384577529', 'P', NULL, NULL, NULL, '2026-05-17 12:39:29', '2026-05-17 12:39:29'),
(54, 75, 'Risa Oktavia', '062530601226', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 2, '0895402538267', 'P', NULL, NULL, NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(55, 76, 'Davina Ramadhani Akbar', '062440663051', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '0895350396992', 'P', NULL, NULL, NULL, '2026-05-19 09:39:39', '2026-05-19 09:39:39'),
(56, 77, 'Fazel Mawla', '062440833325', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895415220202', 'L', NULL, NULL, NULL, '2026-05-19 10:46:34', '2026-05-19 10:46:34'),
(57, 78, 'Muhammad Abror Rifada', '062440833330', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085783565731', 'L', NULL, NULL, NULL, '2026-05-19 11:24:58', '2026-05-19 11:24:58'),
(58, 79, 'Sutan Akbar Dwi Nugraha', '062440833337', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085758292876', 'L', NULL, NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(59, 80, 'Arcellino Putra Rifai', '062440833323', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085788764544', 'L', NULL, NULL, NULL, '2026-05-19 11:26:44', '2026-05-19 11:26:44'),
(61, 82, 'Muhammad Jayadi Luthfi Izzuddin', '062530901829', 'Bahasa dan Pariwisata', 'D-III Bahasa Inggris', 2, '082185997442', 'L', NULL, NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(62, 83, 'Fitri Kholilah ', '062440513371', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 4, '085212118218', 'P', NULL, NULL, NULL, '2026-05-20 12:59:15', '2026-05-20 12:59:15'),
(63, 84, 'Johan Hadil Mahasin', '062440833326', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895636623550', 'L', NULL, NULL, NULL, '2026-05-20 14:04:10', '2026-05-20 14:04:10'),
(64, 85, 'NAJWA ALYA SENOVGI ZAHRA', '062540512909', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '081366543968', 'P', NULL, NULL, NULL, '2026-05-20 15:22:10', '2026-05-20 15:22:10'),
(65, 86, 'Nailah Dwi Mulya', '062540663114', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 2, '088272139698', 'P', NULL, NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(66, 87, 'Olivia Claudia Amanda Susanti D', '062440412452', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '088274359796', 'P', NULL, NULL, NULL, '2026-05-21 12:55:59', '2026-05-21 12:55:59'),
(67, 88, 'Ade Indah Yani', '062540633057', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 2, '085168821433', 'P', NULL, NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(68, 89, 'Nadila Devani Alensi', '062430601260', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '081274139091', 'P', NULL, NULL, NULL, '2026-05-21 16:09:44', '2026-05-21 16:09:44'),
(69, 90, 'Nizelia Khairunisa ', '062440833334', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081997447392', 'P', NULL, NULL, NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(70, 91, 'Moza slavina salsabillah', '062440612884', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081271215943', 'P', NULL, NULL, NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(71, 92, 'Cici Agustina Putri', '062440612873', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085951503483', 'P', NULL, NULL, NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(72, 93, 'Muhammad Nabil Akmal', '062440833332', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081287200937', 'L', NULL, NULL, NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(73, 94, 'Siti Fa\'iqriyyah Febizainsky', '062440833336', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '082180607057', 'P', NULL, NULL, NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(74, 95, 'Rizka Putri Badiah', '062440663066', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '081367000154', 'P', NULL, NULL, NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(75, 96, 'Dinni', '062340412363', 'Teknik Kimia', 'D-IV Teknik Energi', 6, '088286330104', 'P', NULL, NULL, NULL, '2026-05-23 12:32:08', '2026-05-23 12:32:08'),
(76, 97, 'HANIF TRI WARSITO', '062540833371', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 2, '087899542334', 'L', NULL, NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(77, 98, 'Marsya Hilwatullisah', '062440612883', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085782589313', 'P', NULL, NULL, NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(78, 99, 'Raghil Risqi Akbar', '062540422726', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '+6289686146455', 'L', NULL, NULL, NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(79, 100, 'M Ridho Apriliadi', '062440663056', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08971244457', 'L', NULL, NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(80, 101, 'Tesalonika Claudya Felicia Estiko', '062440663068', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '081273221104', 'P', NULL, NULL, NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(81, 102, 'Naurah Rafifah', '062440663059', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '082279590631', 'P', NULL, NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(82, 103, 'Hassan Zeb', '062540723686', 'Teknik Komputer', 'D-IV Teknologi Informatika Multimedia Digital', 2, '087844062162', 'L', NULL, NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(83, 104, 'Cahya Amelia Hayati', '062430601274', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '083891326203', 'P', NULL, NULL, NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(84, 105, 'Nani umiarti nasyuha ', '062440612886', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '083130014233', 'P', NULL, NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(85, 106, 'M. Fathir Sumizi Rahman', '062440412533', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '088706556446', 'L', NULL, NULL, NULL, '2026-05-24 21:24:13', '2026-05-24 21:24:13'),
(86, 107, 'Septia Rahmadhani', '062541033637', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '083173754177', 'P', NULL, NULL, NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(88, 109, 'Muhammad Rizky', '062240512647', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 8, '082175981859', 'L', NULL, NULL, NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(89, 110, 'Maulana Fajar Pratama', '062440833329', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '089687820402', 'L', NULL, NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(90, 111, 'Valen Geraldi', '062440632952', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '082289240408', 'L', NULL, NULL, 'uploads/profiles/profile_6a145ea51e4c80.01858243.jpg', '2026-05-25 21:19:46', '2026-05-25 21:37:25'),
(91, 112, 'Akbar Rizky Fernando', '062340111952', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 6, '088747371378', 'L', NULL, NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(92, 113, 'M Febriansyah', '062440663078', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08972426774', 'L', NULL, NULL, NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16'),
(94, 129, 'Muhammad Rifqi Al Aufa', '062440612885', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081271947575', 'L', NULL, NULL, NULL, '2026-06-05 12:09:36', '2026-06-05 12:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_proposals`
--

CREATE TABLE `pmw_proposals` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `leader_user_id` int UNSIGNED NOT NULL,
  `kategori_usaha` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_usaha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_wirausaha` enum('pemula','berkembang') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pemula',
  `detail_keterangan` text COLLATE utf8mb4_general_ci,
  `lama_usaha_tahun` int UNSIGNED DEFAULT NULL,
  `lama_usaha_bulan` int UNSIGNED DEFAULT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_rab` decimal(15,2) DEFAULT NULL,
  `status` enum('draft','submitted','revision','approved','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'draft',
  `catatan` text COLLATE utf8mb4_general_ci,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_proposals`
--

INSERT INTO `pmw_proposals` (`id`, `period_id`, `leader_user_id`, `kategori_usaha`, `nama_usaha`, `kategori_wirausaha`, `detail_keterangan`, `lama_usaha_tahun`, `lama_usaha_bulan`, `instagram_url`, `video_url`, `total_rab`, `status`, `catatan`, `submitted_at`, `created_at`, `updated_at`) VALUES
(20, 1, 42, 'Jasa Sosial', 'kicksparkle', 'pemula', 'KickSparkle merupakan usaha jasa cuci dan perawatan sepatu yang telah berjalan kurang lebih selama 6 bulan. Usaha ini hadir untuk membantu pelanggan menjaga kebersihan, kenyamanan, dan penampilan sepatu agar tetap terlihat bersih seperti baru. KickSparkle menyediakan berbagai layanan, seperti cuci sepatu reguler, deep cleaning, whitening, repaint sederhana, perawatan suede dan canvas, serta layanan pengeringan dan pewangi sepatu. Dalam proses pengerjaan, KickSparkle menggunakan peralatan dan bahan khusus yang aman untuk berbagai jenis sepatu sehingga kualitas sepatu tetap terjaga.\n\nTarget pasar utama usaha ini adalah mahasiswa, karena banyak mahasiswa yang aktif menggunakan sepatu untuk kegiatan kuliah maupun organisasi sehingga membutuhkan layanan perawatan sepatu yang praktis dan terjangkau. Selain itu, KickSparkle juga menyasar komunitas basket yang membutuhkan perawatan rutin untuk menjaga kebersihan dan kenyamanan sepatu olahraga. Target pasar lainnya adalah pengajar dan pekerja, yang membutuhkan penampilan rapi dan profesional dalam aktivitas sehari-hari. Tidak hanya itu, usaha ini juga terbuka untuk masyarakat umum yang ingin merawat sepatu kesayangan agar lebih awet, bersih, dan nyaman digunakan.\n\nDengan pelayanan yang ramah, hasil pengerjaan yang maksimal, serta harga yang terjangkau, KickSparkle berkomitmen menjadi solusi terpercaya dalam jasa perawatan sepatu di lingkungan sekitar.', NULL, 6, 'kicksparkle', NULL, 4680001.00, 'draft', 'proposal yang di inputkan wajib yang telah di tanda tangani', NULL, '2026-05-03 22:51:30', '2026-07-31 13:58:50'),
(21, 1, 43, 'Kreatif', 'HAMCI PLG', 'berkembang', 'Usaha saya bergerak di sektor peternakan dan penjualan hewan peliharaan mungil, terutama hamster, beserta pakan serta beragam perlengkapannya. Selain membiakkan hamster, bisnis ini juga menyediakan kebutuhan pendukung secara menyeluruh untuk mempermudah perawatan konsumen. Saya membudidayakan 2 jenis hamster yaitu syrian dan winter white yang dimana yang sangatlah banyak diminati di pasaran.\nDi samping hamster, usaha ini menawarkan aneka pakan yang saya racik sendiri dengan formula khusus untuk memastikan nutrisi optimal, gizi seimbang, dan daya tarik rasa bagi hamster, seperti campuran biji-bijian, pelet khusus, serta camilan sehat dan sayur kering. Tersedia juga perlengkapan lengkap seperti kandang, wadah makanan-minuman, roda lari, alas kandang (serbuk kayu), dan aksesoris pendukung kenyamanan hamster lainnya. Keunggulan utamanya adalah konsep one-stop shopping, di mana semua kebutuhan tersedia di satu tempat, sehingga pelanggan tak perlu bolak-balik. Selain itu, saya juga berikan edukasi dasar bagi pemula tentang perawatan hamster yang tepat.\nTarget pasar mencakup anak-anak serta remaja pecinta hewan kecil, mahasiswa dan pekerja muda yang mencari peliharaan mudah dirawat, serta keluarga muda yang ingin memperkenalkan hewan peliharaan pada anak. Untuk pengembangan bisnis, penjualan dilakukan via media sosial seperti instagram, whatshaap dan shopee serta tokopedia.\nYang dimana untuk pengiriman hamster hanya di lakukan di dalam kota palembang dengan pengiriman instan sedangkan seperti pakan dan perlengkapan bisa menjangkau pelanggan diluar daerah.', 3, NULL, 'hamciplg', NULL, NULL, 'draft', NULL, NULL, '2026-05-04 10:56:06', '2026-05-06 23:20:47'),
(22, 1, 44, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 1, 47, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:33:00'),
(24, 1, 48, 'Kreatif', 'TrinketsKu', 'pemula', 'TrinketsKu adalah usaha industri kreatif yang memproduksi gantungan kunci dengan teknik kombinasi desain digital dan material pilihan.', NULL, NULL, 'trinketsku_', NULL, NULL, 'draft', NULL, NULL, '2026-05-05 19:12:04', '2026-05-31 23:59:52'),
(25, 1, 49, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:10:03'),
(26, 1, 50, 'Jasa Sosial', 'SORANA', 'pemula', '', NULL, NULL, NULL, 'https://youtu.be/jCdnqxkhj50?si=-Ltsx5BTyVXRWZPg', NULL, 'draft', NULL, NULL, '2026-05-06 16:29:24', '2026-05-25 21:28:52'),
(27, 1, 51, 'Kreatif', 'bouquething_project', 'berkembang', 'Usaha yang kami jalankan bergerak di bidang kesenian kreatif berupa pembuatan bouqet artificial flowers (bouqet bunga palsu), yang aesthetic, modern dan dapat digunakan untuk hari hari special seperti wisuda, ulang tahun anniversary dan acara special lainnya. Produk yang ditawarkan dapat sesuai dengan kebutuhan pelanggan mulai dari desain warna serta ukuran\n\nKeunggulan dari usaha ini adalah penggunaan bunga palsu berkualitas yang lebih tahan lama dibanding bunga asli, tidak mudah layu, serta memiliki harga yang lebih terjangkau. Selain itu, desain bouquet dibuat mengikuti tren anak muda dan media sosial sehingga cocok dijadikan hadiah maupun properti foto.\n\nTarget pasar usaha ini yaitu kalangan Mahasiswa, pelajar hingga masyarakat umum yang embutuhkan bouqet sebagai hadiah di acara acara besarnya, saat ini emasaran hanya dilakukan di WhatsApp dan sistem Pre-Order dengan foto katalog dan price list harga.\n\nSeiring berkembangnya usaha dan meningkatnya minat konsumen, saya berencana mengembangkan usaha dengan menambah produk berupa bouquet bunga asli (fresh flower bouquet). Penambahan produk ini bertujuan untuk memperluas target pasar serta memberikan lebih banyak pilihan kepada pelanggan. Bouquet bunga asli memiliki daya tarik tersendiri karena memberikan kesan lebih elegan, natural, dan premium sehingga cocok digunakan untuk acara formal maupun hadiah spesial.\n\nMelalui Program Mahasiswa Wirausaha (PMW), usaha ini diharapkan dapat berkembang dari segi variasi produk, kualitas bahan, inovasi desain, serta perluasan pemasaran bukan lagi hanya melalui whatsapp tetapi instagram tiktok dan marketplace. Bantuan dan dukungan dari program ini akan digunakan untuk pengembangan produk bunga asli, pembelian perlengkapan florist, meningkatkan kualitas kemasan, serta memperkuat branding usaha agar mampu bersaing dan memiliki nilai jual yang lebih tinggi.', 1, NULL, '@bouquething_project', 'https://drive.google.com/drive/folders/1AEQVIz7YS0CWecOAl8llf6821-ZrSBSb?usp=drive_link', NULL, 'draft', NULL, NULL, '2026-05-07 09:51:19', '2026-05-25 23:46:39'),
(28, 1, 52, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:56:01'),
(29, 1, 53, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 1, 54, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 1, 55, 'Digital', 'Webora Studio', 'berkembang', 'Webora Studio merupakan usaha jasa digital yang bergerak di bidang pembuatan dan pengembangan website profesional. Usaha ini menyediakan layanan website company profile, landing page bisnis, website portofolio, pengembangan web app, mobile app, serta maintenance website sesuai kebutuhan klien. Webora Studio hadir untuk membantu UMKM, startup, mahasiswa, organisasi, dan pelaku usaha dalam membangun identitas digital yang modern, responsif, dan profesional.\n\nTarget pasar Webora Studio meliputi UMKM, pelaku bisnis, startup, organisasi, instansi, dan individu yang membutuhkan solusi digital untuk meningkatkan eksistensi serta jangkauan usahanya. Keunggulan Webora Studio terletak pada desain yang menyesuaikan kebutuhan klien, layanan yang fleksibel, proses pengembangan yang modern, serta fokus pada kualitas dan pengalaman pengguna.', 1, NULL, '@weboraa.studio', 'https://drive.google.com/file/d/1jKa8_1K0GDlI94UGKIFjx6Qj_SUD0qIZ/view?usp=sharing', 12320000.00, 'approved', 'Proposal Diterima', '2026-07-26 23:11:36', '2026-05-08 18:44:43', '2026-07-31 12:43:26'),
(32, 1, 56, 'Jasa Sosial', 'MEMORIES', 'pemula', '“Memories” merupakan usaha kreatif yang bergerak di bidang buket dan dekorasi acara dengan menawarkan produk seperti buket bunga, buket snack, dan buket balon yang aesthetic, berkualitas, dan terjangkau. Target pasar usaha ini adalah remaja, mahasiswa, hingga masyarakat umum di Kota Palembang dan sekitarnya yang membutuhkan dekorasi untuk momen wisuda, ulang tahun, anniversary, lamaran, dan pernikahan. Ke depannya, “Memories” juga akan mengembangkan layanan seperti papan bunga, photobooth, kotak hantaran, mahar frame, dan backdrop dekorasi untuk memenuhi kebutuhan pelanggan secara lebih lengkap.', NULL, 3, 'memories_palembang', NULL, 6868965.00, 'approved', 'Proposal Diterima', '2026-07-29 10:58:16', '2026-05-10 08:46:55', '2026-07-31 12:03:48'),
(33, 1, 57, 'Jasa Sosial', 'Ardhana Agency', 'berkembang', '', 1, NULL, 'ardhana_agency', 'https://drive.google.com/file/d/1A3Jfj2PMPE4vgUGcAsTqUTzUWpvszJXM/view?usp=drivesdk', 10904025.00, 'approved', 'Proposal Diterima', '2026-07-30 11:56:54', '2026-05-10 15:08:24', '2026-07-31 11:49:48'),
(34, 1, 58, 'Jasa Sosial', 'Venesia Tour Travel', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-10 23:05:13', '2026-05-11 20:00:34'),
(35, 1, 59, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 1, 60, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 1, 61, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 1, 62, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 1, 63, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 1, 64, 'Boga', 'Nasi Cokot Gabut', 'berkembang', 'Nasi cokot adalah makanan yaitu dengan basic nasi dan lauk di tengahnya, nasi ini terinspirasi dari bentuk burger, jadi bentuknya sama seperti burger, sehingga makannya bisa lebih simple seperti makan burger akan tetapi bisa lebih mengenyangkan dikarenakan ini adalah nasi. Nasi cokot dijual dengan harga Rp.5000 sehingga lebih terjangkau bagi kalangan mahasiswa, khususnya mahasiswa POLSRI dan UNSRI, sejauh ini baru ada 2 menu yang tersedia yaitu ayam pedas dan ayam manis, tetapi kami punya inovasi penambahan menu seperti ikan cakalang, cumi asin, yang mana itu permintaan dari pelanggan kami. Selama ini Nasi Cokot Gabut berjualan di depan gerbang UNSRI di jam sore di weekdays, sedangkan saat weekend berada di kawasan Kambang Iwak serta kami juga berjualan melalui online dengan sistem pre order dan minimal order 20pcs.', 1, NULL, 'nasicokot.gabut', NULL, NULL, 'draft', NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:29:01'),
(41, 1, 65, 'Kreatif', '', 'berkembang', '', 1, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 21:49:39'),
(42, 1, 66, 'Kreatif', 'ByBeelaugh', 'berkembang', '', 1, 11, 'By.Beelaugh', NULL, NULL, 'draft', NULL, NULL, '2026-05-11 21:47:17', '2026-05-12 00:25:33'),
(43, 1, 67, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 1, 68, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 1, 69, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-13 21:06:58', '2026-05-24 17:50:36'),
(46, 1, 70, 'Boga', 'Crumble Co', 'pemula', 'Crumble Co. adalah usaha kuliner skala mikro berbasis stand kampus yang menjual kukis premium dengan konsep mood booster, hadir untuk memenuhi kebutuhan mahasiswa yang tidak hanya ingin camilan enak, tetapi juga ingin merasa lebih bersemangat dan produktif setelah hari kuliah yang panjang. Produk kami terdiri dari kukis empat varian rasa (coklat, red velvet, matcha, vanila), tiga pilihan saus siraman (coklat, matcha, tiramisu), topping add-on (parutan keju, meses, regal), dan minuman dark chocolate eksklusif yang hanya tersedia di Crumble Co. Keunikan utama kami terletak pada sistem dual packaging, kukis di atas, minuman di bawah, dalam satu kemasan terintegrasi yang estetis, praktis, dan secara natural mendorong konsumen untuk memfoto dan membagikannya di media sosial.\n\nTarget pasar utama kami adalah mahasiswa aktif usia 18–24 tahun yang sadar akan estetika, gemar nongkrong, dan mencari camilan yang terasa worth it tanpa harus keluar banyak uang jajan mereka. Di lingkungan kampus, belum ada satu pun kompetitor yang memposisikan dirinya sebagai snack untuk produktivitas dan moodbooster, kami rasa ini adalah blue ocean yang Crumble Co siap isi. Strategi pemasaran kami mengandalkan media sosial (Instagram & TikTok), word of mouth organik yang diperkuat oleh desain packaging, student ambassador lintas fakultas, serta kehadiran di event-event kampus. Operasional berjalan dengan model sell-out harian untuk menjaga kesegaran produk sekaligus menciptakan urgensi pembelian.\n\nCrumble Co. diluncurkan pada skala mikro dengan target pencapaian break-even point dalam 2–3 bulan pertama, dengan margin kotor yang ditargetkan pada kisaran 40–60%. Roadmap pengembangannya dirancang dalam tiga tahap: fondasi dan pembuktian konsep di kampus pertama, dilanjutkan dengan ekspansi stand dan integrasi platform pesan-antar, hingga akhirnya membuka peluang kemitraan dan franchise ke kampus-kampus lain. Crumble Co bukan sekadar bisnis kukis, ia adalah brand yang menjual pengalaman, semangat, dan hari yang lebih baik, satu gigitan dalam satu waktu.', NULL, NULL, 'crumble_co_ofc', NULL, NULL, 'draft', NULL, NULL, '2026-05-14 14:09:55', '2026-05-23 16:20:33'),
(47, 1, 71, 'Boga', 'akarjiwa.jamu', 'pemula', 'AKARJIWA.JAMU merupakan usaha minuman herbal modern yang mengangkat kembali kekayaan jamu tradisional Indonesia dengan sentuhan gaya hidup masa kini. Nama “Akarjiwa” memiliki filosofi sebagai sumber kesehatan alami yang berasal dari akar tradisi dan memberikan kebaikan bagi tubuh serta jiwa.Makna ini dirangkai dari paduan nama Tim ( A,KAR,JI,WA) yang berarti Awalan KARno aJI WAhyu,konsepan ini juga merawat akar dan menghidupkan jiwa agar jamu jadi selalu minuman yang selalu ada sebagai minuman tradisional turun temurun.kami merawat akarnya ,agar bisa terus menghidupkan jiwa generasi muda.Karena sehat yang sebenarnya berasal dari akar yang kuat.\n\nUsaha ini hadir untuk menjawab permasalahan rendahnya minat generasi muda terhadap jamu akibat citra produk yang dianggap kuno dan kurang menarik. Melalui konsep modern, minimalis, dan instagramable, AKARJIWA.JAMU menghadirkan minuman herbal siap konsumsi dengan rasa yang lebih ramah di lidah, kemasan eco-friendly, serta desain yang sesuai dengan tren healthy lifestyle saat ini.\n\nProduk kami menggunakan bahan alami pilihan seperti kunyit, jahe, temulawak, dan beras kencur yang dikemas secara praktis sehingga mudah dikonsumsi oleh semua kalangan, mulai dari mahasiswa hingga masyarakat umum. Selain berfokus pada kesehatan, usaha ini juga membawa nilai pelestarian budaya lokal Indonesia melalui inovasi produk herbal modern.\n\nDengan memanfaatkan pemasaran door to door, digital dan media sosial, AKARJIWA.JAMU diharapkan mampu menjadi brand jamu modern yang tidak hanya sehat dan alami, tetapi juga relevan dengan kebutuhan generasi masa kini.', NULL, 1, 'akarjiwa.jamu', 'https://drive.google.com/file/d/15MnkWBUn0AXDbcCBhoLfoJ0ZGLZJ95jQ/view?usp=drive_link', NULL, 'draft', NULL, NULL, '2026-05-14 20:07:38', '2026-05-24 14:12:35'),
(48, 1, 72, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 1, 73, 'Kreatif', 'by.juwita', 'berkembang', 'by.juwita merupakan usaha buket yang berdiri sejak tahun 2019 Jl. Kopral Ramin II Palembang. Usaha ini menyediakan berbagai jenis buket seperti bouquet bunga artificial, money buket, snack buket, dan gift buket untuk berbagai momen spesial seperti wisuda, ulang tahun, dan anniversary. Dengan mengutamakan desain yang estetik dan custom dari custumer, by.juwita ingin terus berkembang melalui pemasaran media sosial serta pelayanan yang mengikuti kebutuhan pelanggan.', 1, 11, 'by.juwita ', 'https://youtube.com/shorts/pxkUAR8RlPU?si=ftVuPeiabtgnUfd4', 8790000.00, 'approved', 'proposal diterima', '2026-07-30 13:13:00', '2026-05-16 10:08:37', '2026-07-31 11:48:15'),
(50, 1, 74, 'Kreatif', 'Lumiara', 'pemula', 'LUMIARA merupakan bisnis kreatif ramah lingkungan dengan tagline “Less Plastic, More Aesthetic” yang menghadirkan cup holder dan tumbler holder berbahan rajutan tangan (crochet) bertema bunga, usaha ini bertujuan mengurangi penggunaan plastik sekali pakai dengan menghadirkan pelindung minuman yang juga berfungsi sebagai aksesori fesyen modern.\nTarget pasar LUMIARA meliputi pecinta produk ramah lingkungan, komunitas handmade/DIY, dan kafe yang membutuhkan merchandise eco-friendly. Pemasaran dilakukan melalui Instagram, TikTok, dan Shopee,  LUMIARA berencana menghadirkan koleksi pre-order eksklusif serta workshop merajut untuk membangun komunitas dan meningkatkan loyalitas pelanggan.', NULL, NULL, NULL, 'https://drive.google.com/file/d/1TcAdVxrkC361apeKaR9_j1Whxu24FSKv/view?usp=drivesdk', NULL, 'draft', NULL, NULL, '2026-05-17 12:39:29', '2026-05-24 12:37:51'),
(51, 1, 75, 'Boga', 'Bakaran Risa - Serba 2RB', 'berkembang', 'Usaha “Bakaran Risa” merupakan usaha kuliner skala mikro yang bergerak di bidang makanan dan minuman dengan konsep utama menyediakan aneka makanan bakaran dengan harga terjangkau, yaitu mulai dari Rp2.000. Usaha ini didirikan sebagai bentuk pengembangan usaha mandiri yang bertujuan untuk memenuhi kebutuhan masyarakat terhadap makanan ringan yang praktis, lezat, dan ekonomis.\nUsaha ini menawarkan berbagai jenis produk, seperti bakso bakar, sosis bakar, tahu bakar, otak-otak bakar, minuman, serta menu pelengkap lainnya yang disajikan dengan cita rasa khas dan proses pembakaran langsung sehingga menghasilkan aroma dan rasa yang menarik bagi konsumen. Konsep “serba 2 ribu” menjadi daya tarik utama karena memberikan kesempatan kepada semua kalangan masyarakat untuk menikmati makanan dengan harga yang murah dan ramah di kantong.\nTarget pasar usaha ini meliputi pelajar, mahasiswa, pekerja, karyawan toko, serta masyarakat umum yang membutuhkan makanan cepat saji dengan harga terjangkau. Lokasi usaha yang berada di kawasan pinggir jalan ramai juga menjadi faktor pendukung dalam menarik konsumen, karena mudah dijangkau dan terlihat oleh orang yang melintas.\nDalam menjalankan usahanya, “Bakaran Risa - Serba 2 Ribu” menerapkan strategi berupa:\nharga yang ekonomis,\nvariasi menu yang beragam,\npelayanan yang cepat dan ramah,\nserta menjaga kualitas rasa dan kebersihan produk.\nSelain berorientasi pada keuntungan, usaha ini juga menjadi sarana pengembangan jiwa kewirausahaan, kreativitas, dan inovasi dalam menciptakan peluang usaha di bidang kuliner. Melalui konsep sederhana namun menarik, usaha ini diharapkan mampu berkembang lebih besar, dikenal masyarakat luas, serta memiliki daya saing di tengah berkembangnya bisnis kuliner modern.\nNama “Bakaran Risa” sendiri memiliki makna sebagai identitas usaha kuliner milik Risa yang menyediakan aneka makanan bakaran dengan harga terjangkau untuk semua kalangan masyarakat. Nama ini mencerminkan semangat usaha, kerja keras, serta tujuan untuk menghadirkan makanan yang enak, murah, dan mudah dinikmati oleh siapa saja.', 2, 5, NULL, 'https://youtube.com/shorts/H7BT12JwOME?si=3kaEi3t3x7Vg8b8v', NULL, 'draft', NULL, NULL, '2026-05-18 15:50:14', '2026-06-02 08:47:45'),
(52, 1, 76, 'Kreatif', 'Charmu', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 09:39:39', '2026-05-25 09:03:56'),
(53, 1, 77, 'Digital', 'Juniorers_Store', 'pemula', 'Juniorers_Store adalah usaha di bidang jasa digital gaming yang berlokasi di Palembang dan beroperasi secara online. Usaha ini didirikan pada bulan September tahun 2021 dan sempat dinonaktifkan pada tahun 2022 akhir, dan rencananya akan diaktifkan kembali jika usaha ini disetujui sampai tahap lolos seleksi. Jam operasional setiap hari Senin hingga Minggu pukul 09.00 hingga 22.00 WIB. Juniorers_Store menawarkan dua layanan utama yaitu top up game (Mobile Legends, Free Fire, Valorant, PUBG, dan voucher game) serta jasa jual beli akun game yang meliputi mediator escrow, verifikasi akun, dan titip jual. Target konsumen adalah remaja dan mahasiswa usia 15 hingga 25 tahun di Palembang.', NULL, 15, 'juniorers_store', NULL, NULL, 'draft', NULL, NULL, '2026-05-19 10:46:34', '2026-05-22 06:55:36'),
(54, 1, 78, 'Boga', 'ricebowl \"BOWLKITA\"', 'pemula', 'Usaha yang saya jalankan bernama BowlKita, yaitu usaha kuliner yang menyediakan makanan siap saji berupa rice bowl dengan berbagai pilihan menu yang praktis, enak, dan harga terjangkau. Produk yang ditawarkan terdiri dari rice bowl ayam crispy, ayam saus pedas/manis, beef bowl, serta menu tambahan seperti topping dan minuman. BowlKita mengutamakan kualitas bahan baku, rasa yang konsisten, serta penyajian yang higienis dan menarik. Target pasar BowlKita adalah pelajar, mahasiswa, karyawan, dan masyarakat umum yang membutuhkan makanan cepat saji dengan harga terjangkau.', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 11:24:58', '2026-05-21 00:03:35'),
(55, 1, 79, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 11:25:20', '2026-07-04 16:55:08'),
(56, 1, 80, 'Digital', 'ARCTECH CCTV', 'berkembang', 'ARCTECH CCTV adalah usaha yang bergerak di bidang solusi keamanan dan pengawasan modern, menyediakan layanan pemasangan, perawatan, dan konsultasi sistem CCTV untuk rumah, toko, kantor, gudang, hingga area industri. Dengan mengutamakan kualitas, ketepatan pemasangan, dan teknologi terkini, ARCTECH CCTV hadir untuk membantu pelanggan menciptakan lingkungan yang lebih aman, nyaman, dan terpantau setiap saat.\n\nLayanan yang ditawarkan meliputi instalasi CCTV analog dan IP camera, setting monitoring online via smartphone, perbaikan dan maintenance CCTV, penataan jaringan, serta upgrade sistem keamanan sesuai kebutuhan pelanggan. Didukung oleh tenaga teknisi yang profesional dan berpengalaman, ARCTECH CCTV berkomitmen memberikan pelayanan cepat, hasil rapi, dan solusi terbaik dengan harga kompetitif.', 1, NULL, NULL, 'https://youtube.com/shorts/f8fRjPlgZBQ?feature=shared', NULL, 'draft', NULL, NULL, '2026-05-19 11:26:44', '2026-05-25 18:27:29'),
(57, 1, 81, 'Digital', 'Administrator', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 21:00:59'),
(58, 1, 82, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 1, 83, 'Teknologi Non Digital', 'TitikKampus ', 'pemula', 'TitikKampus merupakan usaha layanan printing dan kebutuhan akademik mahasiswa yang berlokasi di Rusunawa Politeknik Negeri Sriwijaya Kampus Banyuasin. Usaha ini menyediakan layanan print hitam putih, print warna, scan, fotokopi, laminating, jilid, cetak foto, penjualan ATK, serta layanan desain tugas dan presentasi. TitikKampus hadir sebagai solusi atas keterbatasan layanan printing yang dekat, cepat, dan praktis bagi mahasiswa di lingkungan kampus Banyuasin. Selain layanan offline, usaha ini juga menyediakan pemesanan online dan layanan antar untuk mempermudah mahasiswa dalam memenuhi kebutuhan akademik.', NULL, 2, NULL, 'https://drive.google.com/drive/folders/1C0qihNgvca33qaaywxuhnQ809uVBbPoe', NULL, 'draft', NULL, NULL, '2026-05-20 12:59:15', '2026-05-24 11:31:18'),
(60, 1, 84, 'Boga', 'Milky Quest', 'pemula', '', NULL, 4, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 14:04:10', '2026-05-23 19:02:41'),
(61, 1, 85, 'Boga', 'Topi.co', 'berkembang', 'Topi.co adalah usaha yang berbasis kopi nusantara dengan mengusung kopi Pagar Alam dan kopi gula aren dari kota Lubuk Linggau', 1, 4, 'topii_coo', 'https://youtu.be/gYryONckc7Y?si=P8NcE2NV5Y54xWXT', 10200000.00, 'approved', 'Proposal Diterima', '2026-07-29 21:13:21', '2026-05-20 15:22:10', '2026-07-31 11:59:10'),
(62, 1, 86, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 1, 87, 'Kreatif', 'Aromelle', 'pemula', '1.	IDE USAHA\nAromelle merupakan usaha kreatif yang bergerak di bidang kerajinan handmade aromaterapi dengan menggabungkan unsur estetika, personalisasi, dan fungsi relaksasi dalam setiap produknya. Berbeda dengan produk kerajinan pada umumnya, seluruh produk aromelle dirancang menggunakan essence beads atau media penyerap minyak esensial yang mampu menyimpan dan menyebarkan aroma terapi secara perlahan. Dengan demikian, produk tidak hanya berfungsi sebagai aksesori, tetapi juga memberikan efek menenangkan, menyegarkan, serta meningkatkan kenyamanan pengguna dalam aktivitas sehari-hari.				Ide usaha ini muncul dari meningkatnya kebutuhan masyarakat terhadap produk self-care dan wellness yang praktis, estetik, dan mudah digunakan. Di sisi lain, sebagian besar produk aromaterapi yang tersedia di pasaran masih memiliki keterbatasan, seperti penggunaan yang kurang praktis, desain yang monoton, serta hanya dapat digunakan di dalam ruangan. Melalui aromelle, kami menghadirkan inovasi berupa produk kerajinan aromaterapi portable yang dapat digunakan kapan saja dan di mana saja tanpa memerlukan alat tambahan seperti listrik atau api. Produk utama yang ditawarkan aromelle meliputi gelang aromaterapi handmade dan gantungan kunci aromaterapi berbahan kawat bulu (pipe cleaner) yang dipadukan dengan essence beads berpori sebagai media penyimpan aroma. Setiap produk dapat dikustomisasi sesuai preferensi konsumen, baik dari segi warna, bentuk, karakter, maupun jenis aroma yang digunakan. Aroma yang tersedia antara lain lavender untuk membantu relaksasi, peppermint untuk meningkatkan fokus, serta lemon dan sweet orange untuk memberikan efek segar dan meningkatkan suasana hati. Keunggulan utama aromelle terletak pada perpaduan antara fungsi aromaterapi dan nilai estetika handmade dalam satu produk. Produk tidak hanya digunakan sebagai aksesori fashion dan gantungan kunci, tetapi juga sebagai media relaksasi portable yang dapat membantu mengurangi stres ringan, memberikan rasa nyaman, serta menjadi sarana ekspresi diri bagi pengguna. Selain itu, produk bersifat reusable karena aroma dapat digunakan kembali hanya dengan meneteskan ulang minyak esensial pada essence beads.	Dengan konsep yang inovatif, kreatif, dan mengikuti tren wellness serta self-care yang terus berkembang, aromelle memiliki peluang pasar yang luas, khususnya di kalangan remaja, mahasiswa, pekerja muda, serta masyarakat yang menyukai produk handmade estetik dengan nilai fungsi tambahan.\n\n2.	IDENTIFIKASI MASALAH ATAU KEBUTUHAN PASAR\nDi era modern saat ini, tingkat aktivitas dan tekanan hidup masyarakat semakin meningkat, sehingga memunculkan berbagai permasalahan seperti stres, kelelahan mental, sulit fokus, dan gangguan relaksasi ringan. Kondisi ini dialami oleh berbagai kalangan, mulai dari pelajar, mahasiswa, pekerja kantoran, hingga ibu rumah tangga. Seiring meningkatnya kesadaran masyarakat terhadap pentingnya kesehatan mental dan self-care, kebutuhan akan produk relaksasi yang praktis dan mudah digunakan juga semakin tinggi.			Produk aromaterapi yang umum tersedia di pasaran masih memiliki beberapa keterbatasan. Produk seperti diffuser listrik, lilin aroma, atau burner membutuhkan listrik maupun api sehingga kurang praktis digunakan saat bepergian. Sebagian produk aromaterapi memiliki desain yang monoton dan kurang menarik bagi kalangan muda karena lebih identik sebagai produk kesehatan dibandingkan aksesori gaya hidup. Sedangkan kerajinan handmade seperti gelang atau gantungan kunci memang memiliki nilai estetika yang tinggi, tetapi sebagian besar hanya berfungsi sebagai hiasan tanpa memiliki nilai guna tambahan. Hal ini membuat konsumen mulai mencari produk yang tidak hanya menarik secara visual, tetapi juga memiliki fungsi yang bermanfaat dalam kehidupan sehari-hari.				Aromelle hadir sebagai solusi dengan menghadirkan produk kerajinan handmade aromaterapi yang menggabungkan fungsi relaksasi dan estetika dalam satu produk. Seluruh produk aromelle, baik gelang maupun gantungan kunci kawat bulu, dilengkapi dengan essence beads yang dapat menyerap dan menyebarkan aroma minyak esensial secara perlahan. Dengan demikian, produk tidak hanya menjadi aksesori fashion dan kerajinan unik, tetapi juga dapat membantu memberikan efek menenangkan, meningkatkan fokus, dan menyegarkan suasana hati pengguna.	Selain menjawab kebutuhan relaksasi praktis, aromelle juga memanfaatkan peluang pasar dari tren wellness, self-care, dan produk aesthetic handmade yang saat ini berkembang pesat di media sosial seperti tiktok dan instagram. Konsumen, khususnya generasi z dan milenial, cenderung tertarik pada produk yang unik, dapat dikustomisasi, serta memiliki nilai emosional dan pengalaman penggunaan yang berbeda. Dengan menggabungkan konsep aromaterapi portable dan kerajinan handmade custom, aromelle memiliki peluang pasar yang luas serta mampu menghadirkan inovasi produk yang masih jarang ditemukan di pasaran.\n\n3.	SOLUSI USAHA YANG DITAWARKAN\nAromelle hadir sebagai solusi inovatif atas kebutuhan masyarakat terhadap produk relaksasi yang praktis, estetik, dan dapat digunakan dalam aktivitas sehari-hari. Aromelle menawarkan produk yang tidak hanya berfungsi sebagai aksesori atau hiasan, tetapi juga memiliki manfaat tambahan sebagai media aromaterapi portable. Produk utama aromelle adalah gelang aromaterapi dan gantungan kunci handmade berbahan kawat bulu yang dilengkapi dengan essence beads atau manik berpori. Essence beads tersebut mampu menyerap minyak esensial dan melepaskan aromanya secara perlahan sehingga pengguna dapat menikmati manfaat aromaterapi kapan saja dan di mana saja tanpa memerlukan listrik, api, ataupun alat tambahan lainnya. Solusi yang ditawarkan aromelle terletak pada kombinasi antara fungsi relaksasi dan nilai estetika produk. Konsumen tidak hanya memperoleh produk handmade yang menarik secara visual, tetapi juga mendapatkan manfaat aromaterapi yang dapat membantu mengurangi stres ringan, meningkatkan fokus, memberikan rasa nyaman, serta memperbaiki suasana hati. Hal ini menjadikan produk lebih fungsional dibandingkan produk kerajinan biasa yang hanya memiliki nilai dekoratif. Aromelle juga memberikan solusi dalam bentuk produk yang dapat dikustomisasi sesuai keinginan konsumen. Pelanggan dapat memilih desain, warna, karakter, bentuk hiasan, hingga jenis aroma yang diinginkan. Aromelle menjadi barang yang  memiliki nilai emosional yang lebih tinggi dan cocok digunakan sebagai aksesori pribadi maupun hadiah untuk orang lain.	\n									\n4.	KEUNIKAN DAN NILAI TAMBAH USAHA\nAromelle memiliki keunikan utama berupa kombinasi antara produk kerajinan handmade, aksesori estetik, dan fungsi aromaterapi dalam satu produk. Berbeda dengan usaha kerajinan pada umumnya yang hanya berfokus pada nilai estetika, aromelle menghadirkan produk yang tidak hanya menarik secara visual, tetapi juga memiliki manfaat relaksasi dan self-care bagi penggunanya.								Keunggulan utama aromelle terletak pada penggunaan essence beads atau manik berpori yang mampu menyerap dan menyebarkan aroma minyak esensial secara perlahan. Inovasi ini diterapkan tidak hanya pada gelang aromaterapi, tetapi juga pada gantungan kunci handmade berbahan kawat bulu. Seluruh produk aromelle memiliki ciri khas berupa aroma terapi yang dapat memberikan efek menenangkan, menyegarkan, serta meningkatkan kenyamanan pengguna dalam aktivitas sehari-hari.	Untuk meningkatkan ketahanan aroma, aromelle menggunakan kombinasi essential oil dan fiksatif yang diaplikasikan pada media silika gel atau essence beads. Fiksatif berfungsi sebagai pengikat aroma agar minyak esensial tidak mudah menguap, sehingga aroma dapat bertahan lebih lama dibandingkan aromaterapi biasa. Dengan penggunaan formulasi tersebut, aroma pada produk dapat bertahan kurang lebih hingga satu minggu, tergantung intensitas penggunaan, suhu lingkungan, dan jenis aroma yang digunakan. Hal ini menjadi nilai tambah karena pengguna tidak perlu terlalu sering melakukan pengisian ulang aroma.	Selain itu, aromelle menawarkan produk yang dapat dikustomisasi sesuai keinginan konsumen, baik dari segi warna, bentuk, karakter, hiasan, maupun pilihan aroma. Konsumen dapat memilih aroma tertentu seperti lavender untuk relaksasi, peppermint untuk meningkatkan fokus, atau citrus untuk membantu meningkatkan suasana hati (mood booster). Fitur personalisasi ini memberikan nilai emosional dan kesan eksklusif yang menjadi daya tarik tersendiri dibandingkan produk massal di pasaran. Dari sisi inovasi, aromelle menggabungkan tren wellness dan self-care dengan produk handmade modern yang mengikuti perkembangan gaya hidup generasi muda. Konsep ini masih tergolong jarang ditemukan di pasar lokal sehingga memberikan peluang diferensiasi yang kuat dibandingkan usaha aksesori atau kerajinan biasa.						Dalam aspek kualitas, produk dibuat secara handmade menggunakan bahan yang ringan, aman, nyaman digunakan, serta dapat digunakan kembali (reusable) hanya dengan meneteskan ulang minyak esensial pada essence beads. Desain produk juga dibuat dengan tampilan estetik dan modern agar sesuai dengan selera pasar saat ini.	Dari segi harga, produk aromelle ditawarkan dengan harga yang terjangkau sehingga dapat menjangkau berbagai kalangan, khususnya pelajar, mahasiswa, dan generasi muda. Meskipun memiliki fungsi tambahan sebagai aromaterapi, biaya produksi produk relatif efisien sehingga usaha tetap memiliki potensi margin keuntungan yang baik.	Kemudahan akses juga menjadi nilai tambah aromelle karena produk dipasarkan secara online melalui media sosial dan marketplace seperti Instagram, TikTok Shop, dan Shopee. Bentuk produk yang ringan dan praktis memudahkan proses pengemasan serta pengiriman ke berbagai daerah di Indonesia.\n\n5.	TARGET PASAR\nTarget pasar utama (primary market) aromelle difokuskan pada mahasiswa Politeknik Negeri Sriwijaya (POLSRI) serta komunitas mahasiswa di wilayah Palembang. Segmen ini dipilih karena memiliki mobilitas dan aktivitas akademik yang tinggi, sehingga membutuhkan produk relaksasi yang praktis, mudah digunakan, dan tetap memiliki nilai estetika. Selain itu, kalangan mahasiswa juga cenderung mengikuti tren self-care, wellness, dan produk handmade estetik yang saat ini berkembang pesat di media sosial.						Dalam upaya memperluas jangkauan pasar, aromelle juga menargetkan masyarakat umum secara nasional melalui pemanfaatan platform digital seperti tiktok, instagram, dan marketplace. Strategi pemasaran digital dilakukan dengan memanfaatkan tren konten aesthetic lifestyle, art & craft, self-care, serta video pendek seperti reels dan fyp yang memiliki potensi tinggi dalam menarik perhatian konsumen dari berbagai daerah.	Selain pengguna individu, aromelle juga membidik pasar sekunder (secondary market), yaitu konsumen yang membutuhkan produk custom untuk hadiah ulang tahun, hadiah wisuda, souvenir acara, hampers, maupun pemesanan dalam jumlah besar untuk kegiatan organisasi, perkuliahan, dan acara personal lainnya. Dengan target pasar yang luas dan sesuai dengan tren gaya hidup modern, aromelle memiliki peluang untuk berkembang sebagai produk handmade aromaterapi yang diminati berbagai kalangan masyarakat. \n', NULL, NULL, NULL, 'https://drive.google.com/drive/folders/1vcxAtmTwssOOKv_BosDBbOnPmjQ2fzbX', 6240000.00, 'approved', 'Proposal Diterima', '2026-07-30 06:53:09', '2026-05-21 12:55:59', '2026-07-31 11:55:18'),
(64, 1, 88, 'Boga', 'Ayammy Saus', 'pemula', '', NULL, 4, 'ayammy_saus', NULL, NULL, 'draft', NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:48:35'),
(65, 1, 89, 'Kreatif', 'Sik Sak Sock', 'pemula', 'Sik Sak Sock merupakan usaha yang bergerak di bidang fashion dengan konsep lucu dan fun, khususnya produk kaos kaki yang mengutamakan kenyamanan dan gaya. Sik Sak Sock hadir sebagai pilihan kaos kaki yang dapat digunakan disemua rentang usia untuk berbagai aktivitas sehari-hari, baik untuk sekolah, kuliah, bekerja, olahraga, maupun kegiatan santai.', NULL, 1, '@siksak.sock', 'https://drive.google.com/drive/folders/1xzffmpANzuS1HXsV1DrW1oO1HvFvk7DF?usp=sharing', 6098768.00, 'approved', 'Proposal diterima', '2026-07-30 16:07:45', '2026-05-21 16:09:44', '2026-07-31 11:46:42'),
(66, 1, 90, 'Boga', 'Mazefoods/ Gyoza Ayam dan Es Jelly Kelapa', 'pemula', '', NULL, NULL, 'mazefoods', NULL, NULL, 'draft', NULL, NULL, '2026-05-21 18:19:25', '2026-05-25 12:38:39'),
(67, 1, 91, 'Kreatif', 'Slay Side MUA', 'pemula', 'Slay Side merupakan usaha jasa Make Up Artist (MUA) yang bergerak di bidang kecantikan dan fashion. Kami menyediakan layanan makeup, hair do, dan hijab do untuk berbagai acara seperti wisuda, pesta, photoshoot, penari hingga acara formal lainnya. Slay Side mengutamakan hasil yang rapi, modern, elegan, dan sesuai dengan keinginan pelanggan agar tampil lebih percaya diri. Target pasar kami adalah remaja hingga dewasa, khususnya wanita yang membutuhkan jasa kecantikan dengan harga terjangkau dan kualitas terbaik.', NULL, NULL, 'slayside_mua', NULL, NULL, 'draft', NULL, NULL, '2026-05-22 07:52:38', '2026-05-24 21:01:17'),
(68, 1, 92, 'Boga', 'Pancong Waffle', 'pemula', 'Jenis usaha yang kami pilih ialah makanan ringan tradisional yang menggabungkan kue pancong tradisional dengan berbagai varian topping yang lebih modern.Kue Pancong merupakan makanan khas betawi.oleh karena itu,untuk produk yang kami jual ialah pancong waffle.Selain memberikan rasa yang lebih modern,juga memberikan inovasi dengan bentuk waffle.varian topping yang kami pilih seperti matcha,cokelat,choco Crunchy,dan menambahkan ice cream.target pasar dari produk kami ialah mahasiswa dan masyarakat umum.tempat yang kami pilih ialah di area kampus dan area ramai masyarakat serta memiliki lokasi yang strategis.', NULL, NULL, 'pancongwafflegenz_', NULL, NULL, 'draft', NULL, NULL, '2026-05-22 08:02:18', '2026-05-25 05:14:39'),
(69, 1, 93, 'Kreatif', 'Bloomie Studio', 'pemula', 'Usaha kerajinan tangan dengan produk bunga dari pipe cleaner.', NULL, 1, '-', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 10:42:51', '2026-05-25 00:01:59'),
(70, 1, 94, 'Boga', 'Mini Melty', 'pemula', 'Mini Melty adalah usaha dessert box mini yang menjual camilan manis berukuran praktis, rasa premium, tampilan imut, dan harga ramah mahasiswa. Produk dibuat fresh by order serta dipasarkan melalui media sosial, pre-order, dan penjualan langsung di lingkungan kampus.', NULL, NULL, '-', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 10:57:24', '2026-05-25 17:04:38'),
(71, 1, 95, 'Kreatif', 'Charmate / Bagcharm', 'pemula', 'Charmate adalah usaha kreatif yang bergerak di bidang aksesoris custom, khususnya bag charm dengan desain unik dan estetik. Charmate hadir untuk membantu anak muda mengekspresikan diri melalui gantungan tas yang lucu, trendy, dan memiliki makna personal. Produk Charmate terinspirasi dari berbagai elemen menarik seperti logo himpunan, program studi, hingga desain kekinian yang cocok digunakan sehari-hari.\nDengan mengutamakan kualitas, detail desain, dan kreativitas, Charmate tidak hanya menjadi aksesoris biasa, tetapi juga simbol identitas dan gaya penggunanya. Charmate cocok digunakan sebagai pelengkap fashion, hadiah, maupun merchandise komunitas dan organisasi.', NULL, 1, 'charm.mate', 'https://drive.google.com/drive/folders/14WHKXfBCeOHzdqr-PXrpCwek6dHrHw6D', NULL, 'draft', NULL, NULL, '2026-05-23 11:51:45', '2026-05-24 14:51:02'),
(72, 1, 96, 'Boga', 'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)', 'pemula', 'Noye UbePop adalah usaha dessert berbahan dasar ubi ungu yang menjual UbePudding dan UbeIceCream dengan rasa manis, creamy, dan warna ungu yang cantik. Awalnya usaha ini jualan pudding, lalu berkembang bikin ice cream supaya pilihan produknya makin banyak dan menarik. Noye UbePop hadir buat anak muda yang suka jajanan manis, unik, kekinian, harga terjangkau, namun tetap bergizi dan cocok buat nemenin santai, nongkrong, ataupun jadi cemilan favorit sehari-hari.', NULL, 6, '@noye.ubepop', NULL, 6190000.00, 'approved', 'Proposal Diterima', '2026-07-30 10:30:13', '2026-05-23 12:32:08', '2026-07-31 11:53:10'),
(73, 1, 97, 'Kreatif', 'Triflorist', 'pemula', 'TriFlorist adalah usaha florist yang menghadirkan keindahan melalui berbagai pilihan rangkaian bunga buatan (artificial flowers) berkualitas premium yang tampak natural dan elegan , seperti hand bouquet untuk momen wisuda dan ulang tahun, bunga meja (table flower arrangement) untuk dekorasi ruangan yang estetis, hingga hantaran dan kado eksklusif lainnya. Berfokus pada penjualan secara online melalui Instagram, usaha ini membidik target pasar yang dinamis, yaitu laki-laki maupun perempuan remaja maupun lanjut usia termasuk mahasiswa, pekerja kantoran, serta pasangan muda yang aktif di media sosial dan sangat menghargai keindahan visual tanpa repot merawat bunga asli. Nilai jual utama dari Tri Florist terletak pada penggunaan bahan bunga tiruan premium yang tahan lama ', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 23:29:40'),
(74, 1, 98, 'Boga', 'Creavory', 'pemula', 'CREAVORY merupakan usaha di bidang Food and Beverage (FnB) yang menghadirkan inovasi savory crepes atau crepes gurih dengan konsep modern dan kekinian. Produk ini dibuat menggunakan kulit crepes crispy yang dipadukan dengan chicken pop crispy homemade serta berbagai pilihan saus premium seperti mentai, spicy korean, cheese volcano, dan original mayo. CREAVORY hadir sebagai solusi makanan praktis dengan cita rasa unik yang dapat dinikmati oleh berbagai kalangan, khususnya mahasiswa dan anak muda. Selain mengutamakan rasa, usaha ini juga menawarkan tampilan produk yang estetik dan menarik sehingga cocok dipasarkan melalui media sosial. Dengan harga yang terjangkau dan konsep street food modern, CREAVORY memiliki potensi pasar yang luas serta peluang pengembangan usaha yang berkelanjutan.', NULL, NULL, 'Creavory.Plg', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 22:55:59', '2026-05-25 18:43:20'),
(75, 1, 99, 'Kreatif', 'Lytheros', 'pemula', 'Lytheros adalah brand fashion yang menghadirkan gaya elegan dengan sentuhan modern dan premium. Terinspirasi dari kekuatan dan karakter, setiap desain Lytheros dibuat untuk mereka yang berani tampil berbeda memadukan keanggunan, ketegasan, dan kualitas tinggi dalam setiap potongan kain. Kami berfokus pada kaos, kemeja, dan outerwear dengan bahan pilihan seperti cotton combed premium dan campuran kain eksklusif yang nyaman dipakai namun tetap berkelas. Setiap detail sablon dan jahitan dirancang untuk mencerminkan identitas kuat dan percaya diri. Lytheros bukan sekadar pakaian, ini adalah simbol gaya hidup bagi mereka yang menghargai keindahan dalam kekuatan dan kesederhanaan dalam kemewahan.', NULL, NULL, 'lytheros.official', 'https://drive.google.com/file/d/14hElHsHQ2gRsZS2ij4IFpBnu_9_LFLTM/view?usp=drive_link', NULL, 'draft', NULL, NULL, '2026-05-23 23:43:29', '2026-05-24 13:01:13'),
(76, 1, 100, 'Teknologi Non Digital', 'Kalawangi', 'pemula', 'Kalawangi adalah bisnis yang didirikan oleh mahasiswa dari D4 Bisnis Digital, Kalawangi memproduksi lilin aroma terapi yang terbuat dari limbah minyak jelantah rumah tangga atau resoran', NULL, 3, 'kalawangi.ofc', 'https://youtu.be/lpRek5_GQmw?si=iJmqgT6fbQBbY_RG', NULL, 'draft', NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 17:42:48'),
(77, 1, 101, 'Kreatif', 'Felt Photobooth Frame', 'pemula', 'Usaha yang kami jalankan bergerak di bidang kerajinan handmade berupa frame photobooth dari kain flanel yang dapat dijadikan pajangan maupun hiasan gantung. Frame memiliki kertas pelindung agar foto tidak mudah rusak. Produk dibuat dengan desain estetik dan customizable, mulai dari warna hingga dekorasi sesuai keinginan pelanggan. Target pasar usaha ini adalah remaja dan dewasa muda yang menyukai barang unik, aesthetic, serta gemar mengoleksi dan mengabadikan momen melalui foto.', NULL, 1, 'feltoria.id', 'https://youtube.com/shorts/PQr0CJt6eiI?si=X5O3GFIiTBNr1Yu6', NULL, 'draft', NULL, NULL, '2026-05-24 12:49:36', '2026-05-25 05:49:17'),
(78, 1, 102, 'Kreatif', 'BiDi Memo (Ipad Booth) ', 'pemula', 'BidiMemo merupakan usaha layanan photobooth digital berbasis iPad yang\ndirancang untuk memenuhi kebutuhan dokumentasi foto di lingkungan kampus.\nLayanan ini memungkinkan pengguna mengambil foto secara mandiri dengan\ntampilan frame yang menarik serta hasil foto yang dapat langsung diunduh secara\ndigital.\nBidiMemo menggunakan sistem photobooth yang terintegrasi dengan\naplikasi LumaBooth, sehingga proses pengambilan foto menjadi lebih praktis,\ncepat, dan modern. Selain itu, desain frame foto dapat disesuaikan dengan tema\nkegiatan maupun identitas kampus. Usaha ini ditujukan untuk mendukung berbagai\nkegiatan di lingkungan kampus seperti seminar, kegiatan organisasi mahasiswa,\nacara institusi, hingga momen kebersamaan civitas akademika. Dengan konsep\nyang portabel dan mudah dipindahkan, BidiMemo juga dapat menghadirkan pop-\nup photobooth di berbagai lokasi kegiatan kampus.\nMelalui layanan ini, BidiMemo tidak hanya menyediakan sarana\ndokumentasi foto, tetapi juga menghadirkan pengalaman berfoto yang menarik\nserta menjadi peluang usaha kreatif berbasis teknologi digital di lingkungan\nperguruan tinggi', NULL, 1, '@bidimemo', 'https://drive.google.com/drive/folders/1Oz4WDrerHeXJONjXiw7XHv89E0COE8_q', NULL, 'draft', NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 22:50:09'),
(79, 1, 103, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 1, 104, 'Kreatif', 'SAHABAT HIJAB', 'pemula', 'Sahabat hijab adalah brand fashion yang menghadirkan hijab trendy, nyaman, berkualitas, dan terjangkau bagi perempuan muda indonesia. Kami menyediakan hijab yang viral seperti paris jadul hingga hijab motif request dengan sistem pre-order(PO), mengikuti trend dan kebutuhan pasar. Dengan konsep \"bestie para hijabers\", Sahabat Hijab berkomitmen memenuhi keinginan konsumen dengan harga yang tetap affordable. Target pasar kami adalah remaja putri, mahasiswi,  wanita dewasa  termasuk konsumen yang mencari hijab sebagai pilihan hadiah bermakna untuk sahabat, keluarga, pasangan, maupun orang tersayang pada momen spesial. Strategi pemasaran dilakukan melalui promosi langsung dan media sosial dengan program loyalitas seperti free gift dan repeat order. Keunggulan Sahabat Hijab terletak pada variasi warna dan model yang mengikuti trend, branding produk dan logo, kemasan eksklusif, serta fleksibilitas produk sesuai preferensi konsumen. Hingga saat ini, produk Sahabat Hijab telah menjangkau pelanggan di berbagai daerah dan terus berkembang sebagai usaha mahasiswa yang mengedepankan inovasi, kualitas, dan kepuasan pelanggan.', NULL, 2, 'sh.sahabathijab', NULL, NULL, 'draft', NULL, NULL, '2026-05-24 19:03:57', '2026-05-25 10:03:58'),
(81, 1, 105, 'Jasa Sosial', 'Clean Rangers', 'pemula', 'clean rangers merupakan usaha yang bergerak di bidang jasa yaitu membersihkan kost yang bertujuan untuk membantu mahasiswa terutama mahasiswa polsri yntuk membersihkan kost agar lebih rapih tanpa perlu repot lgi dengan menggunakan jasa kami', NULL, NULL, 'cleanrangerz', NULL, NULL, 'draft', NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 21:26:56');
INSERT INTO `pmw_proposals` (`id`, `period_id`, `leader_user_id`, `kategori_usaha`, `nama_usaha`, `kategori_wirausaha`, `detail_keterangan`, `lama_usaha_tahun`, `lama_usaha_bulan`, `instagram_url`, `video_url`, `total_rab`, `status`, `catatan`, `submitted_at`, `created_at`, `updated_at`) VALUES
(82, 1, 106, 'Digital', 'F&D Design Creative', 'pemula', 'F&D Design Creative merupakan usaha yang bergerak di bidang jasa desain grafis dan termasuk dalam industri kreatif digital. Usaha ini berfokus pada pembuatan berbagai kebutuhan visual seperti desain logo, poster, pamflet, banner, konten media sosial, desain presentasi, katalog sederhana, kartu nama, sertifikat, serta kebutuhan desain lainnya. Setiap desain dibuat sesuai dengan permintaan pelanggan dengan mengutamakan kreativitas, kerapian, tampilan yang menarik, dan kesesuaian konsep yang diinginkan.\n\nUsaha ini didirikan oleh M. Fathir Sumizi Rahman dan Muhammad Dafa Arghandi dengan nama F&D Design Creative. Nama tersebut diambil dari inisial pendiri usaha dan mencerminkan kerja sama, kreativitas, serta komitmen dalam memberikan layanan desain yang berkualitas. Slogan yang digunakan adalah “Desain Keren, Auto Dilirik”, yang menggambarkan tujuan usaha untuk menghasilkan desain yang menarik perhatian dan mampu meningkatkan daya tarik visual suatu brand. \n\nTarget utama dari F&D Design Creative adalah mahasiswa, pelaku UMKM, dan masyarakat umum, khususnya yang berada di wilayah Palembang. Mahasiswa membutuhkan desain untuk keperluan tugas, presentasi, poster kegiatan, dan organisasi, sedangkan pelaku UMKM membutuhkan desain untuk promosi usaha seperti logo, banner, katalog, dan konten digital agar produk atau jasa mereka terlihat lebih profesional. \n\nSistem pelayanan usaha ini dilakukan secara fleksibel dan berbasis online melalui media sosial seperti WhatsApp dan Instagram. Pelanggan dapat melakukan pemesanan, konsultasi konsep, mengirim referensi, meminta revisi, hingga menerima hasil akhir desain secara digital tanpa harus datang langsung ke lokasi. Hal ini membuat proses pelayanan menjadi lebih praktis, cepat, dan mudah dijangkau oleh pelanggan. \n\nKeunggulan dari F&D Design Creative terletak pada harga yang terjangkau, pelayanan yang ramah dan responsif, proses pengerjaan yang cepat, serta hasil desain yang dapat disesuaikan dengan kebutuhan pelanggan. Dengan memanfaatkan perangkat digital seperti laptop, handphone, koneksi internet, dan aplikasi desain grafis, usaha ini memiliki peluang yang cukup besar untuk berkembang karena kebutuhan visual di era digital terus meningkat. \n\nDengan adanya usaha F&D Design Creative, diharapkan dapat membantu mahasiswa, UMKM, dan masyarakat dalam memenuhi kebutuhan desain secara cepat, praktis, ekonomis, dan profesional. Selain itu, usaha ini juga memiliki prospek untuk terus berkembang melalui peningkatan kualitas desain, perluasan promosi online, serta penguatan branding agar lebih dikenal oleh masyarakat luas, khususnya di wilayah Palembang.', NULL, 2, 'fd.designcreative', 'https://drive.google.com/drive/folders/1dLat-9ECuyQE8DLqBCzYsqw5Rldg2AoC', 8240000.00, 'approved', 'Proposal Diterima', '2026-07-29 23:53:22', '2026-05-24 21:24:13', '2026-07-31 11:56:42'),
(83, 1, 107, 'Boga', 'Siomay 4U', 'pemula', 'Awal mula usaha Siomay 4U didirikan karena adanya praktikum mata kuliah kewirausahaan, kami mencari resep melalui tiktok dan youtube kemudian kami kembangkan resep sendiri dengan menyesuaikan selera konsumen. Konsumen kami sebagian besar adalah warga Politeknik Negeri Sriwijaya Kampus Banyuasin dan beberapa warga Pangkalan Balai. Di antara produk yang ada di bazzar, produk kami merupakan produk yang paling diminati konsumen karena harganya yang terjangkau, memiliki rasa enak yang sudah disesuaikan dengan selera konsumen. ', NULL, 3, 'siomay4u', 'https://youtube.com/shorts/QkjlkCUJhSw?si=lt-GJuCel2KvrmfC', NULL, 'draft', NULL, NULL, '2026-05-24 21:25:33', '2026-05-25 13:18:44'),
(85, 1, 109, 'Digital', 'Mayzera 2024 Strore', 'berkembang', 'Mayzera 2024 Store merupakan usaha yang bergerak di bidang fashion tradisional Melayu modern yang menyediakan berbagai produk seperti baju melayu pria, baju kurung, songket, tanjak, dan perlengkapan pakaian adat lainnya. Usaha ini didirikan dengan tujuan untuk melestarikan budaya Melayu melalui produk fashion yang elegan, nyaman digunakan, serta mengikuti perkembangan tren masyarakat modern.\n\nProduk yang ditawarkan menyasar berbagai kalangan, mulai dari pelajar, mahasiswa, masyarakat umum, hingga kebutuhan acara adat, pernikahan, dan kegiatan formal lainnya. Selain mengutamakan kualitas bahan dan desain, Mayzera 2024 Store juga menawarkan harga yang terjangkau sehingga dapat menjangkau pasar yang lebih luas.\n\nSaat ini pemasaran dilakukan secara online melalui platform marketplace Shopee, tiktok, tokopedia dan lazada dengan nama toko “Mayzera 2024 Store”, sehingga memudahkan pelanggan dalam melakukan pemesanan dari berbagai daerah. Ke depannya, usaha ini akan terus dikembangkan melalui inovasi produk, peningkatan promosi digital, serta perluasan target pasar agar dapat menjadi brand fashion Melayu modern yang dikenal luas oleh masyarakat.', 1, 10, 'mayzera2024srore', 'https://drive.google.com/file/d/1IvbnK7ASKSrY16JAN4J1YvXj7QkhmsSU/view?usp=drive_link', 8800000.00, 'approved', 'Proposal Diterima', '2026-07-29 22:19:13', '2026-05-25 11:04:52', '2026-07-31 11:58:09'),
(86, 1, 110, 'Boga', 'Fajar Raya/ Onigiri Rendang ', 'pemula', '', NULL, 3, 'rm_fajar_raya', NULL, NULL, 'draft', NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:38:49'),
(87, 1, 111, 'Boga', 'MY SIOMAY', 'berkembang', 'My Siomay adalah unit usaha kuliner inovatif yang memproduksi siomay premium dengan memanfaatkan potensi pangan lokal. Berbeda dengan siomay pada umumnya, produk kami menggunakan formulasi 100% Tepung Sagu Murni dan Ikan Kakap Super dengan isian Telur Puyuh. Dengan positioning sebagai \"Solusi Kenyang Tanpa Nasi\", kami menawarkan produk yang sehat (gluten-free), tinggi protein, dan memiliki indeks kenyang yang setara dengan porsi makan besar.', 1, NULL, 'my__siomay', 'https://drive.google.com/drive/folders/1OCvfL-as0GOZLTiS67kQV3GjJYbKKRXh', 10880000.00, 'approved', 'Proposal Diterima', '2026-07-29 16:32:36', '2026-05-25 21:19:46', '2026-07-31 12:01:05'),
(88, 1, 112, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:47'),
(89, 1, 113, 'Boga', 'PEKSANG', 'pemula', 'PEKSANG merupakan usaha makanan ringan yang bergerak di bidang pengolahan produk berbahan dasar pisang menjadi keripik pisang dengan inovasi varian rasa pedas dan manis. Usaha ini hadir sebagai bentuk pengembangan komoditas pisang yang melimpah di Indonesia menjadi produk bernilai tambah yang lebih menarik dan sesuai dengan preferensi konsumen masa kini. Varian rasa pedas menjadi keunggulan utama produk untuk menjawab tingginya minat masyarakat Indonesia terhadap makanan bercita rasa pedas, sementara varian manis disediakan untuk menjangkau pasar yang lebih luas. Target pasar utama PEKSANG adalah pelajar, mahasiswa, dan masyarakat usia produktif yang menyukai camilan praktis, terjangkau, dan memiliki cita rasa khas. Dengan bahan baku yang mudah diperoleh, proses produksi yang sederhana, serta peluang pemasaran melalui media sosial dan lingkungan kampus, PEKSANG memiliki potensi untuk berkembang menjadi produk camilan lokal yang inovatif, berdaya saing, dan berkelanjutan.', NULL, NULL, 'peksang__', 'https://youtube.com/shorts/rWnyX9z2Yk0?feature=share', 7188500.00, 'approved', 'Proposal Diterima', '2026-07-29 09:50:55', '2026-05-26 16:49:16', '2026-07-31 12:09:50'),
(91, 1, 129, 'Jasa Sosial', 'VARATION HOLIDAY', 'pemula', 'detail keterangan usaha\nUsaha Tour & travel, melayani perjalanan wisata dengan target pasar umum baik siswa/i mahasiswa/i ataupun umum. ', NULL, 2, 'varation.holiday', NULL, NULL, 'draft', NULL, NULL, '2026-06-05 12:09:36', '2026-06-05 21:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_proposal_assignments`
--

CREATE TABLE `pmw_proposal_assignments` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `lecturer_id` int UNSIGNED DEFAULT NULL,
  `mentor_id` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_proposal_assignments`
--

INSERT INTO `pmw_proposal_assignments` (`id`, `proposal_id`, `lecturer_id`, `mentor_id`, `created_at`, `updated_at`) VALUES
(20, 20, 10, 11, '2026-05-03 22:51:30', '2026-08-03 21:13:57'),
(21, 21, NULL, NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(22, 22, NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 23, NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(24, 24, NULL, NULL, '2026-05-05 19:12:04', '2026-05-05 19:12:04'),
(25, 25, NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(26, 26, NULL, NULL, '2026-05-06 16:29:24', '2026-05-06 16:29:24'),
(27, 27, NULL, NULL, '2026-05-07 09:51:19', '2026-05-07 09:51:19'),
(28, 28, NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(29, 29, NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 30, NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 31, 7, 8, '2026-05-08 18:44:43', '2026-08-03 21:14:19'),
(32, 32, 12, 10, '2026-05-10 08:46:55', '2026-08-03 21:15:56'),
(33, 33, 9, 10, '2026-05-10 15:08:24', '2026-08-03 21:17:26'),
(34, 34, NULL, NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(35, 35, NULL, NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 36, NULL, NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 37, NULL, NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 38, NULL, NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 39, NULL, NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 40, NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(41, 41, NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(42, 42, NULL, NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(43, 43, NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 44, NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 45, NULL, NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(46, 46, NULL, NULL, '2026-05-14 14:09:55', '2026-05-14 14:09:55'),
(47, 47, NULL, NULL, '2026-05-14 20:07:38', '2026-05-14 20:07:38'),
(48, 48, NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 49, 13, 12, '2026-05-16 10:08:37', '2026-08-03 21:17:42'),
(50, 50, NULL, NULL, '2026-05-17 12:39:29', '2026-05-17 12:39:29'),
(51, 51, NULL, NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(52, 52, NULL, NULL, '2026-05-19 09:39:39', '2026-05-19 09:39:39'),
(53, 53, NULL, NULL, '2026-05-19 10:46:34', '2026-05-19 10:46:34'),
(54, 54, NULL, NULL, '2026-05-19 11:24:58', '2026-05-19 11:24:58'),
(55, 55, NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 56, NULL, NULL, '2026-05-19 11:26:44', '2026-05-19 11:26:44'),
(57, 57, NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 20:59:29'),
(58, 58, NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 59, NULL, NULL, '2026-05-20 12:59:15', '2026-05-20 12:59:15'),
(60, 60, NULL, NULL, '2026-05-20 14:04:10', '2026-05-20 14:04:10'),
(61, 61, 10, 6, '2026-05-20 15:22:10', '2026-08-03 21:16:24'),
(62, 62, NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, 14, 11, '2026-05-21 12:55:59', '2026-08-03 21:17:00'),
(64, 64, NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, 15, 9, '2026-05-21 16:09:44', '2026-08-03 21:17:53'),
(66, 66, NULL, NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(67, 67, NULL, NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(68, 68, NULL, NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(69, 69, NULL, NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(70, 70, NULL, NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(71, 71, NULL, NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(72, 72, 8, 7, '2026-05-23 12:32:08', '2026-08-03 21:17:14'),
(73, 73, NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, NULL, NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(75, 75, NULL, NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(76, 76, NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(77, 77, NULL, NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(78, 78, NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(79, 79, NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, NULL, NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(81, 81, NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(82, 82, 9, 8, '2026-05-24 21:24:13', '2026-08-03 21:16:48'),
(83, 83, NULL, NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(85, 85, 7, 9, '2026-05-25 11:04:52', '2026-08-03 21:16:37'),
(86, 86, NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, 8, 7, '2026-05-25 21:19:46', '2026-08-03 21:16:11'),
(88, 88, NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, 11, 6, '2026-05-26 16:49:16', '2026-08-03 21:15:34'),
(91, 91, NULL, NULL, '2026-06-05 12:09:36', '2026-06-05 12:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_proposal_members`
--

CREATE TABLE `pmw_proposal_members` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `role` enum('ketua','anggota') COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jurusan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prodi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_proposal_members`
--

INSERT INTO `pmw_proposal_members` (`id`, `proposal_id`, `role`, `nama`, `nim`, `jurusan`, `prodi`, `semester`, `phone`, `email`, `foto`, `created_at`, `updated_at`) VALUES
(252, 22, 'ketua', 'Putri Natasya Adelia ', '062540412651', 'Teknik Kimia', 'D-IV Teknik Energi', 2, '081361399016', 'putrinatasyaaa1188@gmail.com', NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(255, 23, 'ketua', 'Ghefira Mutiara', '06214011232', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 8, '087892217061', 'ghefiramutiara8@gmail.com', NULL, '2026-05-05 15:33:00', '2026-05-05 15:33:00'),
(259, 25, 'ketua', 'I Wayan Bhayu  Sastra Wiguna', '062530240407', 'Teknik Mesin', 'D-III Pemeliharaan Alat Berat', 2, '083878791477', 'iwayanbhayusastrawiguna@gmail.com', NULL, '2026-05-05 20:10:03', '2026-05-05 20:10:03'),
(261, 21, 'ketua', 'Mersi Alya Prima', '062340512654', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 6, '085832811348', 'mersialyaprima67@gmail.com', NULL, '2026-05-06 23:20:47', '2026-05-06 23:20:47'),
(264, 28, 'ketua', 'HANDY PRIAN', '062240342179', 'Teknik Elektro', 'D-IV Teknik Elektro', 8, '082181347229', 'prianhandy@gmail.com', NULL, '2026-05-07 17:56:01', '2026-05-07 17:56:01'),
(265, 29, 'ketua', 'Dinda Olivia Dinata ', '062541023585', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Produksi Tanaman Perkebunan', 2, '088808169251', 'oliviadinatadinda@gmail.com', NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(266, 30, 'ketua', 'MUHAMMAD FATHURRAHMAN', '062430310471', 'Teknik Elektro', 'D-III Teknik Listrik', 4, '082373227261', 'faturrahman102006@gmail.com', NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(331, 39, 'ketua', 'Kmaasdasd', '062248785722', 'Bahasa dan Pariwisata', 'D-III Bahasa Inggris', 6, '0877657723123', 'smaasdasd@gmail.com', NULL, '2026-05-11 09:00:14', '2026-05-11 09:04:23'),
(339, 40, 'ketua', 'Sony Ardian', '062340342244', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '085117709550', 'sonyardian499@gmail.com', NULL, '2026-05-11 16:29:01', '2026-05-11 16:29:01'),
(340, 40, 'anggota', 'Muhammad Nabil', '062340342235', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '089669004712', 'muhammadnabil0184@gmail.com', NULL, '2026-05-11 16:29:01', '2026-05-11 16:29:01'),
(345, 34, 'ketua', 'Elfandary Shafira Maharani ', '062340612757', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '082372076028', 'elfandary2405@gmail.com', NULL, '2026-05-11 20:00:34', '2026-05-11 20:00:34'),
(346, 34, 'anggota', 'Suci Zahra', '062340612772', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '0878-0144-9771', 'ucizahra600@gmail.com', NULL, '2026-05-11 20:00:34', '2026-05-11 20:00:34'),
(347, 34, 'anggota', 'Nur Fadilah', '062340612740', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '081278909309', 'nurfadilah6130@gmail.com', NULL, '2026-05-11 20:00:34', '2026-05-11 20:00:34'),
(348, 34, 'anggota', 'Julia Aulia', '062340612735', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '0882-8614-5823', 'juliaauliaaa26@gmail.com', NULL, '2026-05-11 20:00:34', '2026-05-11 20:00:34'),
(350, 41, 'ketua', 'Mario Febrian Dwi Putra', '062340342232', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '081264697455', 'mariofebriand23@gmail.com', NULL, '2026-05-11 21:49:39', '2026-05-11 21:49:39'),
(351, 41, 'anggota', 'Muhammad Ubaidillah', '062340342237', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '089669732620', 'baybaraqbah@gmail.com', NULL, '2026-05-11 21:49:39', '2026-05-11 21:49:39'),
(352, 42, 'ketua', 'Muhammad Ubaidillah', '062340342237', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '089669732620', 'baybaraqbah@gmail.com', NULL, '2026-05-12 00:25:33', '2026-05-12 00:25:33'),
(353, 42, 'anggota', 'Mario Febrian Dwi Putra', '062340342232', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '081264697455', 'mariofebriand23@gmail.com', NULL, '2026-05-12 00:25:33', '2026-05-12 00:25:33'),
(354, 42, 'anggota', 'Muhammad Nabil', '062340342235', 'Teknik Elektro', 'D-IV Teknik Elektro', 6, '089669004712', 'muhammadnabil0184@gmail.com', NULL, '2026-05-12 00:25:33', '2026-05-12 00:25:33'),
(355, 43, 'ketua', 'Reza Juliansyah ', '062530240419', 'Teknik Mesin', 'D-III Pemeliharaan Alat Berat', 2, '085173240739', 'rejakjugo@gmail.com', NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(356, 44, 'ketua', 'Maulidya Anisa Rahmawati', '062430601286', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '089527190983', 'nicucimol@gmail.com', NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(384, 48, 'ketua', 'Sarfina damayanti', '062440833335', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081564919236', 'damayantisarfina@gmail.com', NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(492, 58, 'ketua', 'Muhammad Jayadi Luthfi Izzuddin', '062530901829', 'Bahasa dan Pariwisata', 'D-III Bahasa Inggris', 2, '082185997442', 'muhammadjayadiluthfiizzuddin@gmail.com', NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(531, 62, 'ketua', 'Nailah Dwi Mulya', '062540663114', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 2, '088272139698', 'nailahdwimulya04@gmail.com', NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(556, 54, 'ketua', 'Muhammad Abror Rifada', '062440833330', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085783565731', '062440833330@student.polsri.ac.id', NULL, '2026-05-21 00:03:35', '2026-05-21 00:03:35'),
(557, 54, 'anggota', 'Chika Putri Haryani', '06244083324', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '+62 853-6979-7079', '06244083324@student.polsri.ac.id', NULL, '2026-05-21 00:03:35', '2026-05-21 00:03:35'),
(558, 54, 'anggota', 'Sarfina Damayanti', '06244083335', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '+62 815-6491-9236', '06244083335@student.polsri.ac.id', NULL, '2026-05-21 00:03:35', '2026-05-21 00:03:35'),
(568, 64, 'ketua', 'Ade Indah Yani', '062540633057', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 2, '085168821433', 'indahade600@gmail.com', NULL, '2026-05-21 15:48:35', '2026-05-21 15:48:35'),
(625, 53, 'ketua', 'Fazel Mawla', '062440833325', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895415220202', '062440833325@student.polsri.ac.id', NULL, '2026-05-22 06:55:36', '2026-05-22 06:55:36'),
(626, 53, 'anggota', 'Adith Kurniawan', '062440833320', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '082280139359', '062440833320@student.polsri.ac.id', NULL, '2026-05-22 06:55:36', '2026-05-22 06:55:36'),
(627, 53, 'anggota', 'M Jefri Al Bukhori', '062440833328', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895383022555', '062440833328@student.polsri.ac.id', NULL, '2026-05-22 06:55:36', '2026-05-22 06:55:36'),
(628, 53, 'anggota', 'Rifqi Rahmatullah', '062430400889', 'Teknik Kimia', 'D-III Teknik Kimia', 4, '085381398062', '062430400889@student.polsri.ac.id', NULL, '2026-05-22 06:55:36', '2026-05-22 06:55:36'),
(672, 61, 'ketua', 'NAJWA ALYA SENOVGI ZAHRA', '062540512909', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '081366543968', 'najwaalyasenovgizahra@gmail.com', NULL, '2026-05-22 16:11:08', '2026-05-22 16:11:08'),
(673, 61, 'anggota', 'Raisha Naazneen Sabrina', '062530501098', 'Akuntansi', 'D-III Akuntansi', 2, '0895803050006', 'raishasabrina17@gmail.com', NULL, '2026-05-22 16:11:08', '2026-05-22 16:11:08'),
(674, 61, 'anggota', 'Kennysha Kayla Putri', '062530501090', 'Akuntansi', 'D-III Akuntansi', 2, '082281357812', 'kennyshakaylap@gmail.com', NULL, '2026-05-22 16:11:08', '2026-05-22 16:11:08'),
(675, 61, 'anggota', 'Syidiq Wahid Pranata', '062530501082', 'Akuntansi', 'D-III Akuntansi', 2, '083873673165', 'syidiqwahidpranata21@gmail.com', NULL, '2026-05-22 16:11:08', '2026-05-22 16:11:08'),
(676, 61, 'anggota', 'Satria Mutias Kintama', '062530701412', 'Akuntansi', 'D-III Akuntansi', 2, '0895706624070', 'satriamutiaskintama@gmail.com', NULL, '2026-05-22 16:11:08', '2026-05-22 16:11:08'),
(730, 46, 'ketua', 'Intan Belinda', '062440422557', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 4, '085841842358', 'intanbelindaaa2@gmal.com', NULL, '2026-05-23 16:20:33', '2026-05-23 16:20:33'),
(731, 46, 'anggota', 'M. KHADAFI PRATAMA', '062440632940', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '081218866714', 'khadafi.pratamaa@gmail.com', NULL, '2026-05-23 16:20:33', '2026-05-23 16:20:33'),
(732, 46, 'anggota', 'Tri Aliya Novela', '062430501155', 'Akuntansi', 'D-III Akuntansi', 4, '0895392810593', 'trialyanovela@gmail.com', NULL, '2026-05-23 16:20:33', '2026-05-23 16:20:33'),
(733, 46, 'anggota', 'Indah Risnawati', '062440111908', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 4, '085924653501', 'indahrisnawati72@gmail.com', NULL, '2026-05-23 16:20:33', '2026-05-23 16:20:33'),
(743, 60, 'ketua', 'Johan Hadil Mahasin', '062440833326', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895636623550', '062440833326@student.polsri.ac.id', NULL, '2026-05-23 19:02:41', '2026-05-23 19:02:41'),
(744, 60, 'anggota', 'M Jehan', '062440833327', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '088276278127', '062440833327@student.polsri.ac.id', NULL, '2026-05-23 19:02:41', '2026-05-23 19:02:41'),
(745, 60, 'anggota', 'Ardo Kasuma', '062540512816', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '089636548613', '', NULL, '2026-05-23 19:02:41', '2026-05-23 19:02:41'),
(760, 73, 'ketua', 'HANIF TRI WARSITO', '062540833371', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 2, '087899542334', 'htriwarsito@gmail.com', NULL, '2026-05-23 23:29:40', '2026-05-23 23:29:40'),
(784, 59, 'ketua', 'Fitri Kholilah ', '062440513371', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 4, '085212118218', 'kholilahfitri4@gmail.com', NULL, '2026-05-24 11:31:18', '2026-05-24 11:31:18'),
(785, 59, 'anggota', 'Uswatun Mahfiroh ', '062340131999', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Produksi Tanaman Perkebunan', 6, '081272348621', 'uswatunmahfiroh596@gmail.com', NULL, '2026-05-24 11:31:18', '2026-05-24 11:31:18'),
(786, 59, 'anggota', 'Agustina Elisabeth Br Sihotang', '062340131986', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Produksi Tanaman Perkebunan', 6, '+62 821-8082-9285', 'agustinasihotang@gmail.com', NULL, '2026-05-24 11:31:18', '2026-05-24 11:31:18'),
(837, 50, 'ketua', 'Khailla Anastya Ramadini', '062440663077', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085384577529', 'khaillaanastya@gmail.com', NULL, '2026-05-24 12:37:51', '2026-05-24 12:37:51'),
(838, 50, 'anggota', 'Zulpa Triana Putri', '062440663077', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '081379145574', 'zulpatrianaputri.1@gmail.com', NULL, '2026-05-24 12:37:51', '2026-05-24 12:37:51'),
(839, 50, 'anggota', 'Eischa Vallencia', '062430320630', 'Teknik Elektro', 'D-III Teknik Elektronika', 4, '0823747943000', 'eischavallencia06@gmail.com', NULL, '2026-05-24 12:37:51', '2026-05-24 12:37:51'),
(853, 75, 'ketua', 'Raghil Risqi Akbar', '062540422726', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '+6289686146455', 'houseoflytheros@gmail.com', NULL, '2026-05-24 13:01:13', '2026-05-24 13:01:13'),
(854, 75, 'anggota', 'M. Auliya Rahman', '0625400422718', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '0895621649689', 'houseoflytheros@gmail.com', NULL, '2026-05-24 13:01:13', '2026-05-24 13:01:13'),
(855, 75, 'anggota', 'M. Nabil Khusnul Muafi', '062540422719', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '081379657048', 'houseoflytheros@gmail.com', NULL, '2026-05-24 13:01:13', '2026-05-24 13:01:13'),
(856, 75, 'anggota', 'Mutiara Ramadhani', '062540422722', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '081368686860', 'houseoflytheros@gmail.com', NULL, '2026-05-24 13:01:13', '2026-05-24 13:01:13'),
(857, 75, 'anggota', 'Putri Rania Ramadhani', '062540422725', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 2, '082374097384', 'houseoflytheros@gmail.com', NULL, '2026-05-24 13:01:13', '2026-05-24 13:01:13'),
(895, 47, 'ketua', 'Karno Triyadi', '062340212085', 'Teknik Mesin', 'D-IV Teknik Mesin Produksi dan Perawatan', 6, '088747376811', 'k4rn0tr1y4d1@gmail.com', NULL, '2026-05-24 14:12:35', '2026-05-24 14:12:35'),
(896, 47, 'anggota', 'Muhammad Aji Putra Prijaya', '062340833149', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 6, '085783367684', 'm.ajiputraa12@gmail.com', NULL, '2026-05-24 14:12:35', '2026-05-24 14:12:35'),
(897, 47, 'anggota', 'Wahyu Pradana ', '062540212166', 'Teknik Mesin', 'D-IV Teknik Mesin Produksi dan Perawatan', 2, '083840716523', 'carlesb019@gmail.com', NULL, '2026-05-24 14:12:35', '2026-05-24 14:12:35'),
(908, 71, 'ketua', 'Rizka Putri Badiah', '062440663066', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '081367000154', 'rizka03rd@gmail.com', NULL, '2026-05-24 14:51:02', '2026-05-24 14:51:02'),
(909, 71, 'anggota', 'Nyayu Davina Zahra Alifia', '062440663061', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085813313522', 'nyayuayu53@gmail.com', NULL, '2026-05-24 14:51:02', '2026-05-24 14:51:02'),
(910, 71, 'anggota', 'Alexandra Naflah Ramadhani Manoren', '062440663049', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '0895620507028', 'alexandranaflah1010@gmail.com', NULL, '2026-05-24 14:51:02', '2026-05-24 14:51:02'),
(911, 71, 'anggota', 'Dliyaul Amami Al Muthohari', '062440663052', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '083177491577', 'dliyaulamami1@gmail.com', NULL, '2026-05-24 14:51:02', '2026-05-24 14:51:02'),
(912, 71, 'anggota', 'Ryesti Intan Zulaikha', '062430501089', 'Akuntansi', 'D-III Akuntansi', 4, '089507113653', 'restiintanzulaikha@gmail.com', NULL, '2026-05-24 14:51:02', '2026-05-24 14:51:02'),
(935, 76, 'ketua', 'M Ridho Apriliadi', '062440663056', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08971244457', 'mridhoapriliadi0@gmail.com', NULL, '2026-05-24 17:37:25', '2026-05-24 17:37:25'),
(936, 76, 'anggota', 'Putri Aulia Zahra', '062440663062', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '0895-6369-16213', 'putriauliazhr03@gmail.com', NULL, '2026-05-24 17:37:25', '2026-05-24 17:37:25'),
(937, 76, 'anggota', 'Rei Haikal Widayanto', '062440663064', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '083177868876', 'bebekhaikal25@gmail.com', NULL, '2026-05-24 17:37:25', '2026-05-24 17:37:25'),
(938, 76, 'anggota', 'Wafi Naufal Azzaky', '062440663069', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '082374834560', 'wafibta4433@gmail.com', NULL, '2026-05-24 17:37:25', '2026-05-24 17:37:25'),
(939, 79, 'ketua', 'Hassan Zeb', '062540723686', 'Teknik Komputer', 'D-IV Teknologi Informatika Multimedia Digital', 2, '087844062162', 'hassanjankhan19@gmail.com', NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(940, 45, 'ketua', 'Marcelino', '062430601232', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '081281935052', 'marselmks932@gmail.com', NULL, '2026-05-24 17:50:36', '2026-05-24 17:50:36'),
(941, 45, 'anggota', 'Hassan Zeb', '062540723686', 'Teknik Komputer', 'D-IV Teknologi Informatika Multimedia Digital', 2, '087844062162', 'hassanjankhan19@gmail.com', NULL, '2026-05-24 17:50:36', '2026-05-24 17:50:36'),
(1005, 67, 'ketua', 'Moza slavina salsabillah', '062440612884', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081271215943', 'mozaslavina@gmail.com', NULL, '2026-05-24 21:01:17', '2026-05-24 21:01:17'),
(1006, 67, 'anggota', 'Aldi Dwi Irfani', '062440612871', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085147214602', 'aldidwiirfani@gmail.com', NULL, '2026-05-24 21:01:17', '2026-05-24 21:01:17'),
(1007, 67, 'anggota', 'Putri Felisha', '0624412888', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '088276285655', 'putrifelisha2608@gmail.com', NULL, '2026-05-24 21:01:17', '2026-05-24 21:01:17'),
(1019, 33, 'ketua', 'Chania Putri Wiranda', '062340612755', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 6, '083140719612', 'chaniaputrii06@gmail.com', NULL, '2026-05-24 21:16:00', '2026-05-24 21:16:00'),
(1020, 33, 'anggota', 'Intan Nurul\'Atha', '062440663076', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '083178218646', 'intannurulatha@gmail.com', NULL, '2026-05-24 21:16:00', '2026-05-24 21:16:00'),
(1021, 33, 'anggota', 'ariqah shabirah', '062340512560', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 6, '089654237177', 'sahbiraharika@gmail.com', NULL, '2026-05-24 21:16:00', '2026-05-24 21:16:00'),
(1039, 81, 'ketua', 'Nani umiarti nasyuha ', '062440612886', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '083130014233', 'naninajae@gmail.com', NULL, '2026-05-24 21:26:56', '2026-05-24 21:26:56'),
(1040, 81, 'anggota', 'Hana sajida', '062440612876', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '083190628920', 'hsajida515@gmail.com', NULL, '2026-05-24 21:26:56', '2026-05-24 21:26:56'),
(1041, 81, 'anggota', 'Nyayu zulfa nailaturrahmi', '062440612887', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '082281888360', 'nyayuzulfanaila@gmail.com', NULL, '2026-05-24 21:26:56', '2026-05-24 21:26:56'),
(1042, 81, 'anggota', 'Ferisa aqilah sari', '062440612875', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '082278319347', 'ferisaaqilahsari@gmail.com', NULL, '2026-05-24 21:26:56', '2026-05-24 21:26:56'),
(1086, 78, 'ketua', 'Naurah Rafifah', '062440663059', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '082279590631', 'rarahnewe@gmail.com', NULL, '2026-05-24 22:49:43', '2026-05-24 22:49:43'),
(1087, 78, 'anggota', 'M Ihsan Khadafi', '062440663055', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085383720832', 'ihsankhadafi08@gmail.com', NULL, '2026-05-24 22:49:43', '2026-05-24 22:49:43'),
(1088, 78, 'anggota', 'Iqbal Yoga Pranata', '062440663054', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '082181677863', 'Iqbalyogapranata12@gmail.com', NULL, '2026-05-24 22:49:43', '2026-05-24 22:49:43'),
(1089, 78, 'anggota', 'Diva Ayu Anggraini', '062440632933', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '089687987020', 'diva749@gmail.com', NULL, '2026-05-24 22:49:43', '2026-05-24 22:49:43'),
(1090, 78, 'anggota', 'Robi’ah Alawiyah', '062440663067', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '089602463576', 'robiahalawiyah444@gmail.com', NULL, '2026-05-24 22:49:43', '2026-05-24 22:49:43'),
(1119, 69, 'ketua', 'Muhammad Nabil Akmal', '062440833332', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081287200937', '062440833332@student.polsri.ac.id', NULL, '2026-05-25 00:01:59', '2026-05-25 00:01:59'),
(1120, 69, 'anggota', 'Muhammad Azrin', '062440833332', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '082186881929', '062440833331@student.polsri.ac.id', NULL, '2026-05-25 00:01:59', '2026-05-25 00:01:59'),
(1121, 69, 'anggota', 'Aiman Aqil Wicaksono', '062430701512', 'Teknik Komputer', 'D-III Teknik Komputer', 4, '085609471099', 'Aimanwicaksono746@gmail.com', NULL, '2026-05-25 00:01:59', '2026-05-25 00:01:59'),
(1153, 57, 'ketua', 'Administrator', '1122334455', '', '', 0, '082272825100', 'combetohct@yahoo.com', NULL, '2026-05-25 03:45:53', '2026-05-25 03:45:53'),
(1154, 57, 'anggota', 'admin', '11223465656784', '', '', 0, '084544563', 'admin@gmail.com', NULL, '2026-05-25 03:45:53', '2026-05-25 03:45:53'),
(1158, 68, 'ketua', 'Cici Agustina Putri', '062440612873', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085951503483', 'ciciagustinaputri525@gmail.com', NULL, '2026-05-25 05:14:39', '2026-05-25 05:14:39'),
(1159, 68, 'anggota', 'Malia Seha Palda Kosra', '062440612882', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '0896-2474-9561', 'maliasehapaldakosra@gmail.com', NULL, '2026-05-25 05:14:39', '2026-05-25 05:14:39'),
(1160, 68, 'anggota', 'Amelya Sri Wahyuni', '062440612872', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '088286080381', 'Amelyasriwahyuni2005@gmail.com', NULL, '2026-05-25 05:14:39', '2026-05-25 05:14:39'),
(1161, 77, 'ketua', 'Tesalonika Claudya Felicia Estiko', '062440663068', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '081273221104', 'tesalonikacfe46@gmail.com', NULL, '2026-05-25 05:49:17', '2026-05-25 05:49:17'),
(1162, 77, 'anggota', 'Fauziatul Jannah', '062440663053', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085271674436', 'jannahfauziatul3@gmail.com', NULL, '2026-05-25 05:49:17', '2026-05-25 05:49:17'),
(1163, 77, 'anggota', 'Putri Revina Mauliza', '062440663063', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08893732722', 'putrirevinamauliza@gmail.com', NULL, '2026-05-25 05:49:17', '2026-05-25 05:49:17'),
(1164, 77, 'anggota', 'Riska Talisa', '062440663065', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '085709530676', 'riskatalisa59@gmail.com', NULL, '2026-05-25 05:49:17', '2026-05-25 05:49:17'),
(1165, 77, 'anggota', 'Nadiya Pariska', '062430601234', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '083176822901', 'fariskanadia622@gmail.com', NULL, '2026-05-25 05:49:17', '2026-05-25 05:49:17'),
(1198, 52, 'ketua', 'Davina Ramadhani Akbar', '062440663051', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '0895350396992', 'davinaramadhani06@gmail.com', NULL, '2026-05-25 09:03:56', '2026-05-25 09:03:56'),
(1199, 52, 'anggota', 'Annisa Balqis', '062440663050', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '089510722188', 'annisasaja54@gmail.com', NULL, '2026-05-25 09:03:56', '2026-05-25 09:03:56'),
(1200, 52, 'anggota', 'Nayla Syahira Putri Mantoza', '062440663060', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08974411899', 'naylasyahiraa07@gmail.com', NULL, '2026-05-25 09:03:56', '2026-05-25 09:03:56'),
(1201, 52, 'anggota', 'Nabila Nur Aisyah', '062440663058', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '088278546733', 'nabilanuraisyahna@gmail.com', NULL, '2026-05-25 09:03:56', '2026-05-25 09:03:56'),
(1202, 52, 'anggota', 'Zifa Amelia Cahyanti', '062430801600', 'Manajemen Informatika', 'D-III Manajemen Informatika', 4, '08985731385', 'zifaamelia216@gmail.com', NULL, '2026-05-25 09:03:56', '2026-05-25 09:03:56'),
(1248, 49, 'ketua', 'Krisna Wati', '062541033629', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '081997487900', 'krisnawati0706na@gmail.com', NULL, '2026-05-25 09:54:43', '2026-05-25 09:54:43'),
(1249, 49, 'anggota', 'Desiani Siregar', '062541033621', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '082176055685', 'desianisiregar@gmail.com', NULL, '2026-05-25 09:54:43', '2026-05-25 09:54:43'),
(1250, 49, 'anggota', 'Ester Nazareta Torie', ' 0625410033624', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, ' 0895324004750 ', 'estertorie0729@gmail.com', NULL, '2026-05-25 09:54:43', '2026-05-25 09:54:43'),
(1251, 49, 'anggota', 'Nyimas Fifi Almeizi Adhyanova', ' 062541053673', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Akuakultur', 2, '083893334737', 'pnyimas514@gmail.com', NULL, '2026-05-25 09:54:43', '2026-05-25 09:54:43'),
(1264, 80, 'ketua', 'Cahya Amelia Hayati', '062430601274', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '083891326203', 'meliachya@gmail.com', NULL, '2026-05-25 10:03:58', '2026-05-25 10:03:58'),
(1265, 80, 'anggota', 'Diva Intan Nofitri', '062430601278', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '081374061767', 'divainta1767@gmail.com', NULL, '2026-05-25 10:03:58', '2026-05-25 10:03:58'),
(1266, 80, 'anggota', 'Silfiah', '062340632860', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 6, '0895604955854', 'silfiah25240517@gmail.com', NULL, '2026-05-25 10:03:58', '2026-05-25 10:03:58'),
(1304, 31, 'ketua', 'FAKHRI IRAWAN 062340833143', '062340833143', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 6, '082174464169', '062340833143@student.polsri.ac.id', NULL, '2026-05-25 11:16:58', '2026-05-25 11:16:58'),
(1305, 31, 'anggota', 'Muhammad Lutfi Kurniawan', '062230833079', 'Manajemen Informatika', 'D-III Manajemen Informatika', 6, '08983064613', 'kurniawanlutfi925@gmail.com', NULL, '2026-05-25 11:16:58', '2026-05-25 11:16:58'),
(1306, 31, 'anggota', 'Anandari Pramadhanty', '   062340833138', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 6, '0895639455813', 'anandaripramadhanty063@gmail.com', NULL, '2026-05-25 11:16:58', '2026-05-25 11:16:58'),
(1310, 26, 'ketua', 'Raka Meidiansyah ', '062540663121', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 2, '0895392809904', 'rakameidiansyah67@gmail.com', NULL, '2026-05-25 12:15:10', '2026-05-25 12:15:10'),
(1311, 26, 'anggota', 'M. Naufal Hilmiy', '062540663110', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 2, '0895621576962', 'naufalhilmiyco@gmail.com', NULL, '2026-05-25 12:15:10', '2026-05-25 12:15:10'),
(1312, 26, 'anggota', 'Dewi La Luna', '062530601236', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 2, '085709460925', 'dewilaluna07@gmail.com', NULL, '2026-05-25 12:15:10', '2026-05-25 12:15:10'),
(1313, 26, 'anggota', 'Zhafira Alvianita', '', 'Teknik Elektro', 'D-IV Teknik Elektro', 2, '0883178895866', 'zhafiraalvianita@gmail.com', NULL, '2026-05-25 12:15:10', '2026-05-25 12:15:10'),
(1314, 26, 'anggota', 'Seisya Aprilia Putri', '062530400889', 'Teknik Kimia', 'D-III Teknik Kimia', 2, '089527322255', 'seisyaapriliaptr@gmail.com', NULL, '2026-05-25 12:15:10', '2026-05-25 12:15:10'),
(1323, 66, 'ketua', 'Nizelia Khairunisa ', '062440833334', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '081997447392', '062440833334@student.polsri.ac.id', NULL, '2026-05-25 12:38:39', '2026-05-25 12:38:39'),
(1324, 66, 'anggota', 'Muhammad Rizki', '062440833333', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '0895637046006', '062440833333@student.polsri.ac.id', NULL, '2026-05-25 12:38:39', '2026-05-25 12:38:39'),
(1325, 66, 'anggota', 'Aliyah Salsabilah Putri', '062440833322', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085783630478', '062440833322@student.polsri.ac.id', NULL, '2026-05-25 12:38:39', '2026-05-25 12:38:39'),
(1326, 66, 'anggota', 'Fadhila khairunisa ', '062430801723', 'Manajemen Informatika', '', 4, '0811-7120-069', '062430801723@student.polsri.ac.id', NULL, '2026-05-25 12:38:39', '2026-05-25 12:38:39'),
(1331, 83, 'ketua', 'Septia Rahmadhani', '062541033637', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '083173754177', 'tianiusds@gmail.com', NULL, '2026-05-25 13:18:44', '2026-05-25 13:18:44'),
(1332, 83, 'anggota', 'Syera Wati Saragih ', '062541033639', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '085837714571', 'serawatisaragih@gmail.com', NULL, '2026-05-25 13:18:44', '2026-05-25 13:18:44'),
(1333, 83, 'anggota', 'Nabila Novrillia', '062541023595', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Teknologi Produksi Tanaman Perkebunan', 2, '083178543715', 'nabilanovrillia28@gmail.com', NULL, '2026-05-25 13:18:44', '2026-05-25 13:18:44'),
(1334, 83, 'anggota', 'Sifa Mahira', '062541033638', 'Rekayasa Teknologi dan Bisnis Pertanian', 'D-IV Agribisnis Pangan Kampus Banyuasin', 2, '087801984622', 'mahirasyifa130306@gmail.com', NULL, '2026-05-25 13:18:44', '2026-05-25 13:18:44'),
(1335, 63, 'ketua', 'Olivia Claudia Amanda Susanti D', '062440412452', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '088274359796', 'oliviaclaudiaa17@gmail.con', NULL, '2026-05-25 13:22:08', '2026-05-25 13:22:08'),
(1336, 63, 'anggota', 'Nurul Hasanah', '062440412451', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '0887437221596', 'nurulbae8787@gmail.com', NULL, '2026-05-25 13:22:08', '2026-05-25 13:22:08'),
(1337, 63, 'anggota', 'Lentera sukma', '062540513769', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 6, '085366622837', 'lenterasukma32@gmail.com', NULL, '2026-05-25 13:22:08', '2026-05-25 13:22:08'),
(1341, 86, 'ketua', 'Maulana Fajar Pratama', '062440833329', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '089687820402', '062440833329@student.polsri.ac.id', NULL, '2026-05-25 13:38:49', '2026-05-25 13:38:49'),
(1342, 86, 'anggota', 'Sutan Akbar Dwi Nugraha', '062440833337', 'Manajemen Informatika', '', 4, '085758292876', '062440833337@student.polsri.ac.id', NULL, '2026-05-25 13:38:49', '2026-05-25 13:38:49'),
(1353, 32, 'ketua', 'Gea Audrey Lexandria Aprilian Zein', '062430601252', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '082181146216', 'gh4554ni.queen@gmail.com', NULL, '2026-05-25 14:50:42', '2026-05-25 14:50:42'),
(1354, 32, 'anggota', 'DIAN RAMADHAN', '062240632909', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 8, '088276029525', 'dianramadhan0411@gmail.com', NULL, '2026-05-25 14:50:42', '2026-05-25 14:50:42'),
(1355, 32, 'anggota', 'FADILA', '062240632830', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 8, '083800572448', 'fadilaputrifatimah@gmail.com', NULL, '2026-05-25 14:50:42', '2026-05-25 14:50:42'),
(1357, 65, 'ketua', 'Nadila Devani Alensi', '062430601260', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '081274139091', 'nadilastevanialensi@gmail.con', NULL, '2026-05-25 15:03:45', '2026-05-25 15:03:45'),
(1358, 65, 'anggota', 'M. Aidil Rafansyah', '062430601285', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '085609295060', 'aidilrafansyah769@gmail.com', NULL, '2026-05-25 15:03:45', '2026-05-25 15:03:45'),
(1359, 65, 'anggota', 'Fauzia Puspa Dewi', '062430601280', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 4, '085268183370', 'zipuspadwi@gmail.com', NULL, '2026-05-25 15:03:45', '2026-05-25 15:03:45'),
(1360, 65, 'anggota', 'Riani Nurqaidah', '062540633032', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 2, '083172658312', 'rianinurqaidah19@gmail.com', NULL, '2026-05-25 15:03:45', '2026-05-25 15:03:45'),
(1366, 20, 'ketua', 'M Roihan Baariq', '062430320690', 'Teknik Elektro', 'D-III Teknik Elektronika', 4, '089524931067', 'mroihanbaariq@gmail.com', NULL, '2026-05-25 15:09:18', '2026-05-25 15:09:18'),
(1374, 70, 'ketua', 'Siti Fa\'iqriyyah Febizainsky', '062440833336', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '082180607057', '062440833336@student.polsri.ac.id', NULL, '2026-05-25 17:04:38', '2026-05-25 17:04:38'),
(1375, 70, 'anggota', 'Zilina Helsinki', '062440833338', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '082180607057', '062440833338@student.polsri.ac.id', NULL, '2026-05-25 17:04:38', '2026-05-25 17:04:38'),
(1376, 70, 'anggota', 'Eko Bagus Cahya Rudin', '062330100200', 'Teknik Sipil', 'D-III Teknik Sipil', 6, '0831 6045 8796', '062330100200@student.polsri.ac.id', NULL, '2026-05-25 17:04:38', '2026-05-25 17:04:38'),
(1377, 70, 'anggota', 'Mutiara Olivia Gurning', '062240412433', 'Teknik Kimia', 'D-IV Teknik Energi', 8, '082175363816', '062240412433@student.polsri.ac.id', NULL, '2026-05-25 17:04:38', '2026-05-25 17:04:38'),
(1378, 56, 'ketua', 'Arcellino Putra Rifai', '062440833323', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085788764544', '062440833323@student.polsri.ac.id', NULL, '2026-05-25 18:27:29', '2026-05-25 18:27:29'),
(1379, 56, 'anggota', 'Alin Putri Cahaya', '062440833321', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '089612856684', '062440833321@student.polsri.ac.id', NULL, '2026-05-25 18:27:29', '2026-05-25 18:27:29'),
(1380, 56, 'anggota', 'Natasyah Dwi Hapsari', '062530601335', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 2, '082282482026', 'natasyadwihapsariy@gmail.com', NULL, '2026-05-25 18:27:29', '2026-05-25 18:27:29'),
(1381, 74, 'ketua', 'Marsya Hilwatullisah', '062440612883', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085782589313', 'marsya.00101@gmail.com', NULL, '2026-05-25 18:43:20', '2026-05-25 18:43:20'),
(1382, 74, 'anggota', 'Tasya Jaskia Meccah', '062440612890', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085835292509', 'tasyajaskiamecca20@gmail.com', NULL, '2026-05-25 18:43:20', '2026-05-25 18:43:20'),
(1383, 74, 'anggota', 'M. Adrian Maulana', '062440612880', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '0895620546822', 'pissboykocak@gmail.com', NULL, '2026-05-25 18:43:20', '2026-05-25 18:43:20'),
(1384, 74, 'anggota', 'Everdina Elda Mayor', '062440612874', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081248582120', 'elldaamayor@gmail.com', NULL, '2026-05-25 18:43:20', '2026-05-25 18:43:20'),
(1387, 72, 'ketua', 'Dinni', '062340412363', 'Teknik Kimia', 'D-IV Teknik Energi', 6, '088286330104', 'dinnizen@gmail.com', NULL, '2026-05-25 19:49:15', '2026-05-25 19:49:15'),
(1414, 27, 'ketua', 'Melina Safitri', '062440342267', 'Teknik Elektro', 'D-IV Teknik Elektro', 4, '085838864571', 'melinasftr1204@gmail.com', NULL, '2026-05-25 23:46:39', '2026-05-25 23:46:39'),
(1415, 27, 'anggota', 'Asma Wati', '062530501014', 'Akuntansi', 'D-III Akuntansi', 2, '083171244048', 'asmawati160108@gmail.com', NULL, '2026-05-25 23:46:39', '2026-05-25 23:46:39'),
(1416, 27, 'anggota', 'Selly Purnama Sari', '062530501031', 'Akuntansi', 'D-III Akuntansi', 2, '082176707229', 'sellypurnamasari02@gmail.com', NULL, '2026-05-25 23:46:39', '2026-05-25 23:46:39'),
(1417, 27, 'anggota', 'Mayang Permata Dinniyah', '062540513771', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 6, '081272022507', 'dinniyahmayang@gmail.com', NULL, '2026-05-25 23:46:39', '2026-05-25 23:46:39'),
(1424, 88, 'ketua', 'Akbar Rizky Fernando', '062340111952', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 6, '088747371378', 'akbarfrnd63@gmail.com', NULL, '2026-05-26 09:39:47', '2026-05-26 09:39:47'),
(1454, 85, 'ketua', 'Muhammad Rizky', '062240512647', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 8, '082175981859', 'muhammadriizkyy4@gmail.com', NULL, '2026-05-31 08:35:29', '2026-05-31 08:35:29'),
(1474, 82, 'ketua', 'M. Fathir Sumizi Rahman', '062440412533', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '088706556446', 'mfathir069@gmail.com', NULL, '2026-05-31 20:28:33', '2026-05-31 20:28:33'),
(1475, 82, 'anggota', 'Muhammad Dafa Arghandi', '062440412535', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '085136174181', 'dafab4496@gmail.com', NULL, '2026-05-31 20:28:33', '2026-05-31 20:28:33'),
(1476, 82, 'anggota', 'Muhammad Pathi Al-Amien', '062440412536', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '085366534388', 'muhammadpathialamien@gmail.com', NULL, '2026-05-31 20:28:33', '2026-05-31 20:28:33'),
(1477, 82, 'anggota', 'Muhammad Rizky Arroyan ', '062440412538', 'Teknik Kimia', 'D-IV Teknik Energi', 4, '089626770784', 'royanrizky37@gmail.com', NULL, '2026-05-31 20:28:33', '2026-05-31 20:28:33'),
(1478, 82, 'anggota', 'Athira Putri Zahra', '062440422649', 'Teknik Kimia', 'D-IV Teknologi Kimia Industri', 4, '085369334956', 'putriztira@gmail.com', NULL, '2026-05-31 20:28:33', '2026-05-31 20:28:33'),
(1485, 87, 'ketua', 'Valen Geraldi', '062440632952', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '082289240408', 'valengeraldi17@gmail.com', NULL, '2026-05-31 20:45:03', '2026-05-31 20:45:03'),
(1486, 87, 'anggota', 'Ghifari Azka Jayadi', '062440632936', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '088287290364', 'ghifariazkajayadi@gmail.com', NULL, '2026-05-31 20:45:03', '2026-05-31 20:45:03'),
(1487, 87, 'anggota', 'Muhammad Sultan Komarrudin', '062440632943', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '083802941916', 'komarudinsultan07@gmail.com', NULL, '2026-05-31 20:45:03', '2026-05-31 20:45:03'),
(1491, 89, 'ketua', 'M Febriansyah', '062440663078', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08972426774', 'febriansyah010200@gmail.com', NULL, '2026-05-31 23:01:10', '2026-05-31 23:01:10'),
(1492, 24, 'ketua', 'M.Satria Wijaksono_Akuntansi', '062530501092', 'Akuntansi', 'D-III Akuntansi', 2, '089524387127', 'msatriaws@gmail.com', NULL, '2026-05-31 23:59:52', '2026-05-31 23:59:52'),
(1493, 24, 'anggota', 'Keisha Naila Putri', '062530500999', 'Akuntansi', 'D-III Akuntansi', 2, '082179291051', 'keishanailaputri2008@gmail.com', NULL, '2026-05-31 23:59:52', '2026-05-31 23:59:52'),
(1494, 24, 'anggota', 'Muhammad Kaisar Az Zaky', '062540633047', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 2, '082178606687', 'kaisarazzaky645@gmail.com', NULL, '2026-05-31 23:59:52', '2026-05-31 23:59:52'),
(1495, 24, 'anggota', 'Puput Ranjani', '062540512911', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '088743793671', 'tiffanyagnesia266@gmail.com', NULL, '2026-05-31 23:59:52', '2026-05-31 23:59:52'),
(1496, 24, 'anggota', 'Qonita Muharani', '062540512938', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '088275756006', 'qonniecantii@gmail.com', NULL, '2026-05-31 23:59:52', '2026-05-31 23:59:52'),
(1497, 51, 'ketua', 'Risa Oktavia', '062530601226', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 2, '0895402538267', 'risaoktapiaa@gmail.com', NULL, '2026-06-02 08:47:45', '2026-06-02 08:47:45'),
(1507, 91, 'ketua', 'Muhammad Rifqi Al Aufa', '062440612885', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081271947575', 'fungsional08@gmail.com', NULL, '2026-06-05 21:23:41', '2026-06-05 21:23:41'),
(1508, 91, 'anggota', 'Lenovo Sriwijaya', '062440612879', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '+62 851-5630-9046', 'Lenovosriwijaya29', NULL, '2026-06-05 21:23:41', '2026-06-05 21:23:41'),
(1509, 91, 'anggota', 'Johan viky satria simangunsong', '062440612878', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '+62 821-8333-4228', 'Johansimangunsong24@gmail.com', NULL, '2026-06-05 21:23:41', '2026-06-05 21:23:41'),
(1510, 91, 'anggota', 'Jihan rajwa mevia', '062440612877', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '081271641506', 'Jihanrajwa0910@gmail.com', NULL, '2026-06-05 21:23:41', '2026-06-05 21:23:41'),
(1511, 91, 'anggota', 'Tasya aulia buana', '062440612889', 'Administrasi Bisnis', 'D-IV Usaha Perjalanan Wisata', 4, '085142366445', 'tasyarismiati@gmail.com', NULL, '2026-06-05 21:23:41', '2026-06-05 21:23:41'),
(1512, 55, 'ketua', 'Sutan Akbar Dwi Nugraha', '062440833337', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085758292876', 'akbarcool998@gmail.com', NULL, '2026-07-04 16:55:08', '2026-07-04 16:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_proposal_rab_items`
--

CREATE TABLE `pmw_proposal_rab_items` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `nama_item` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT '1.00',
  `satuan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'unit',
  `harga_satuan` decimal(15,2) NOT NULL DEFAULT '0.00',
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_proposal_rab_items`
--

INSERT INTO `pmw_proposal_rab_items` (`id`, `proposal_id`, `nama_item`, `qty`, `satuan`, `harga_satuan`, `urutan`, `created_at`, `updated_at`) VALUES
(870, 31, 'Subscription AI Gemini', 1.00, 'unit', 5745000.00, 0, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(871, 31, 'Online Course AI Engineer', 1.00, 'unit', 4050000.00, 1, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(872, 31, 'Sertifikasi Artificial Intelligence', 1.00, 'unit', 1650000.00, 2, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(873, 31, 'X Banner', 1.00, 'unit', 255000.00, 3, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(874, 31, 'Brosur', 1.00, 'Rim', 320000.00, 4, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(875, 31, 'Bootcamp Kewirausahaan oleh TDA', 1.00, 'unit', 300000.00, 5, '2026-07-26 23:11:36', '2026-07-26 23:11:36'),
(1058, 89, 'BOOTH PORTABLE GEROBAK LIPAT MEJA LIPAT rangka hollow dan kayu', 1.00, 'Unit', 540000.00, 0, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1059, 89, 'CETAK STIKER VINYL METERAN | WATERPROOF HIRES (STICKER BOOTH)', 3.00, 'Lembar', 110000.00, 1, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1060, 89, 'Mesin Potong Singkong Kripik Parutan Kripik Singkong Listrik Perajang Umbi Singkong Kentang Dinamo', 1.00, 'unit', 650000.00, 2, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1061, 89, 'TROLI LIPAT BESI', 1.00, 'unit', 150000.00, 3, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1062, 89, '\"SPINER\" PENIRIS MINYAK/PENYARING MINYAK BONUS BOX PACKING', 1.00, 'unit', 200000.00, 4, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1063, 89, 'Mesin Press Plastik Body Besi/Sealer Plastik 40cm Arashi ARS-401', 1.00, 'unit', 230000.00, 5, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1064, 89, 'Kompor Komersial Progas 21A+Selang Gas+Regulator SNI Kompor mawar Kompor Komersial Progas Cor', 1.00, 'unit', 380000.00, 6, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1065, 89, 'Kuali Penggorengan Wok Stainless Steel 60 CM', 1.00, 'unit', 350000.00, 7, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1066, 89, 'Serok Serokan Saringan Peniris Minyak Gorengan Kecil Jumbo Gagang Kayu 30 CM', 1.00, 'unit', 65000.00, 8, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1067, 89, 'rint Roll Up Banner + Standing Murah | Cetak Roll Up Banner Custom | Ukuran 60 x 160', 1.00, 'unit', 220000.00, 9, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1068, 89, 'TAS OBROK MOTOR', 1.00, 'unit', 170000.00, 10, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1069, 89, 'BASKOM STAINLESS STEEL 55 CM', 1.00, 'unit', 79250.00, 11, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1070, 89, 'PAYUNG TENDA 240CM', 1.00, 'unit', 230000.00, 12, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1071, 89, 'Minyak Goreng 18 Lliter', 1.00, 'unit', 818000.00, 13, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1072, 89, 'Coklat batang 1 KG', 2.00, 'unit', 60000.00, 14, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1073, 89, 'Coklat Batang 1 KG (Greentea)', 1.00, 'unit', 57000.00, 15, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1074, 89, 'Coklat Batang 1 KG (Tiramisu)', 1.00, 'unit', 57000.00, 16, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1075, 89, 'Coklat Batang 1 KG (Strawberry)', 1.00, 'unit', 57000.00, 17, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1076, 89, 'Cabe Kering Kasar', 1.00, 'kg', 65000.00, 18, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1077, 89, 'Cabe Bubuk', 1.00, 'kg', 60625.00, 19, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1078, 89, 'STANDING POUCH CUSTOM UKURAN 12*15', 500.00, 'pcs', 1125.00, 20, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1079, 89, 'Pendaftaran merek dagang', 1.00, 'unit', 500000.00, 21, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1080, 89, 'BOOTCAMP TDA', 1.00, 'unit', 300000.00, 22, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1081, 89, 'NIB DAN PIRT', 1.00, 'unit', 278275.00, 23, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1082, 89, 'CETAK DOKUMEN A4', 300.00, 'Lembar', 1000.00, 24, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1083, 89, 'BROSUR A5 2 SISI', 200.00, 'Lembar', 1010.00, 25, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1084, 89, 'MATERAI', 2.00, 'unit', 11500.00, 26, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1085, 89, 'JILID PROPOSAL/LAPORAN KEMAJUAN/AKHIR', 5.00, 'unit', 5000.00, 27, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1086, 89, 'TENT BROSUR DAN TATAKAN ACRYLIC', 1.00, 'unit', 44850.00, 28, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1087, 89, 'MAP KERTAS', 4.00, 'unit', 3000.00, 29, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1088, 89, 'NOTA CUSTOM 2 PLY', 4.00, 'unit', 6000.00, 30, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1089, 89, 'PULPEN 1PACK ISI 12', 1.00, 'pack', 25000.00, 31, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1090, 89, 'EXPANDING FILE/MAP PLASTIK', 1.00, 'pcs', 63000.00, 32, '2026-07-29 09:50:55', '2026-07-29 09:50:55'),
(1091, 32, 'Tripod  Frame Stand', 8.00, 'unit', 85000.00, 0, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1092, 32, 'Alat Lem  Tembak', 2.00, 'unit', 24500.00, 1, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1093, 32, 'Pistol  Stapler  Konstruksi', 1.00, 'unit', 82000.00, 2, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1094, 32, 'Gunting', 3.00, 'unit', 45000.00, 3, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1095, 32, 'Cutter', 3.00, 'unit', 43150.00, 4, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1096, 32, 'Tiang Bunga', 2.00, 'unit', 155000.00, 5, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1097, 32, 'NIB', 1.00, 'unit', 300000.00, 6, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1098, 32, 'Akrilik  Kubah  40×60 cm', 5.00, 'unit', 64500.00, 7, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1099, 32, 'Triplek 3  mm', 3.00, 'unit', 95000.00, 8, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1100, 32, 'Elastis  Buket Foam', 10.00, 'unit', 15000.00, 9, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1101, 32, 'Refill Lem  Tembak', 2.00, 'unit', 65050.00, 10, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1102, 32, 'Lem Fox  PVAc', 2.00, 'unit', 20000.00, 11, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1103, 32, 'Kertas  Buket', 5.00, 'unit', 23600.00, 12, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1104, 32, 'Lidi', 2.00, 'unit', 19000.00, 13, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1105, 32, 'Kain  Organza', 8.00, 'unit', 10000.00, 14, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1106, 32, 'Kain Tile', 10.00, 'unit', 5500.00, 15, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1107, 32, 'Pilox', 8.00, 'unit', 22500.00, 16, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1108, 32, 'Resin', 2.00, 'unit', 38000.00, 17, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1109, 32, 'Kabel Ties', 2.00, 'unit', 8000.00, 18, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1110, 32, 'Artificial  Mawar', 15.00, 'unit', 24000.00, 19, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1111, 32, 'Anggrek  Latex', 9.00, 'unit', 24000.00, 20, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1112, 32, 'Bunga Lily', 8.00, 'unit', 21500.00, 21, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1113, 32, 'Daisy  Artificial', 8.00, 'unit', 6000.00, 22, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1114, 32, 'Baby Breath', 8.00, 'unit', 9500.00, 23, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1115, 32, 'Snow  PomPom', 10.00, 'unit', 5500.00, 24, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1116, 32, 'Kertas  Stiker  Glossy F4', 3.00, 'unit', 31500.00, 25, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1117, 32, 'Sticker  Motif  Marble', 3.00, 'unit', 44050.00, 26, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1118, 32, 'Pita Satin', 12.00, 'unit', 16000.00, 27, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1119, 32, 'Glitter', 5.00, 'unit', 8000.00, 28, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1120, 32, 'Busa Ati  (EVA  Foam)', 1.00, 'unit', 23000.00, 29, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1121, 32, 'Kawat No.  18', 4.00, 'unit', 11500.00, 30, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1122, 32, 'Liviro Meja Lipat Koper', 1.00, 'unit', 431500.00, 31, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1123, 32, 'Keranjang Roblox Putih', 4.00, 'unit', 15250.00, 32, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1124, 32, 'X Banner', 1.00, 'unit', 87000.00, 33, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1125, 32, 'Standing Buket', 4.00, 'unit', 10500.00, 34, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1126, 32, 'tenda lipat', 1.00, 'unit', 122700.00, 35, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1127, 32, 'Keranjang Bunga Bulat', 3.00, 'unit', 12000.00, 36, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1128, 32, 'Taplak meja', 1.00, 'unit', 39000.00, 37, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1129, 32, 'Mawar per tangkai', 15.00, 'unit', 6751.00, 38, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1130, 32, 'Plastik packing', 2.00, 'unit', 30000.00, 39, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1131, 32, 'Plastik mika bunga tangkai', 15.00, 'unit', 7000.00, 40, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1132, 32, 'Sertifikasi microsoft excel', 3.00, 'unit', 143450.00, 41, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1133, 32, 'Boothcamp', 1.00, 'unit', 300000.00, 42, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1134, 32, 'Tinta Art Paper Epson', 2.00, 'unit', 74000.00, 43, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1135, 32, 'Brosur', 145.00, 'unit', 522.00, 44, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1136, 32, 'Cetak Nota Custom', 4.00, 'unit', 7500.00, 45, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1137, 32, 'Cetak Print Sticker', 6.00, 'unit', 14250.00, 46, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1138, 32, 'Lakban kecil Solasi', 1.00, 'unit', 21000.00, 47, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1139, 32, 'Tape Cutter', 1.00, 'unit', 36000.00, 48, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1140, 32, 'Kertas Photo Art Paper', 1.00, 'unit', 19500.00, 49, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1141, 32, 'Deli Klip Penjepit Kertas', 1.00, 'unit', 6760.00, 50, '2026-07-29 10:58:16', '2026-07-29 10:58:16'),
(1159, 87, 'Biaya Endorsment @bontet.makan', 1.00, 'paket', 500000.00, 0, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1160, 87, 'Biaya Endorsment @promopalembang', 1.00, 'paket', 588000.00, 1, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1161, 87, 'Booth Lipat Portable Stiker Req (100 x 40) + sayap', 1.00, 'unit', 874000.00, 2, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1162, 87, 'Tenda Portable (2,5 x 2,5 m)', 1.00, 'unit', 1000000.00, 3, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1163, 87, 'Kompor Rinnai Ri-602 BGX 2 Tungku dan selang gas', 1.00, 'unit', 795000.00, 4, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1164, 87, 'Panci Steamer Supra 32 cm 3 susun', 1.00, 'unit', 688500.00, 5, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1165, 87, 'Blender Philips Plastik 2 liter - 5000 Series HR2223/30', 1.00, 'unit', 1000000.00, 6, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1166, 87, 'Cooler Box HIICE X-PLORE 10L', 1.00, 'unit', 440500.00, 7, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1167, 87, 'Meja Lipat Portable 120 x 60 cm', 1.00, 'unit', 768500.00, 8, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1168, 87, 'Selang + Regulator DESTEC', 1.00, 'unit', 340500.00, 9, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1169, 87, 'Tas Box Ice 32 L (40 x 27 x 30 cm)', 1.00, 'unit', 77000.00, 10, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1170, 87, 'Pendaftaran Merk Dagang', 1.00, 'unit', 500000.00, 11, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1171, 87, 'Pelatihan Digital Marketing', 3.00, 'orang', 250000.00, 12, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1172, 87, 'Boothcamp Kewirausahaan', 2.00, 'orang', 191000.00, 13, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1173, 87, 'Custom Lunch Box Size M Bahan Ivory 250 gr', 2000.00, 'pcs', 1088.00, 14, '2026-07-29 16:32:36', '2026-07-29 16:32:36'),
(1369, 61, 'Endors @makanreceh.plg', 1.00, 'unit', 700000.00, 0, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1370, 61, 'Endors @plgfoodmania', 1.00, 'unit', 320000.00, 1, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1371, 61, 'Booth', 1.00, 'unit', 855000.00, 2, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1372, 61, 'Cooler Box', 2.00, 'unit', 472810.00, 3, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1373, 61, 'Pump & Bottle', 10.00, 'unit', 35880.00, 4, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1374, 61, 'Rak Penyimpanan Botol', 2.00, 'unit', 249093.00, 5, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1375, 61, 'Tenda Jualan', 1.00, 'unit', 120584.00, 6, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1376, 61, 'Tempat Cup Gelas', 2.00, 'unit', 86600.00, 7, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1377, 61, 'Gelas Ukur', 5.00, 'unit', 5109.00, 8, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1378, 61, 'Taplak Meja', 2.00, 'unit', 112353.00, 9, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1379, 61, 'Kotak Sampah', 1.00, 'unit', 91000.00, 10, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1380, 61, 'Sekop Es Batu', 2.00, 'unit', 45350.00, 11, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1381, 61, 'Papan Tulis Kapur', 2.00, 'unit', 280950.00, 12, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1382, 61, 'Kapur', 2.00, 'unit', 38900.00, 13, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1383, 61, 'Timbangan Dapur 5kg', 1.00, 'unit', 94510.00, 14, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1384, 61, 'Branding Merk - X Banner 160cm x 60cm', 1.00, 'unit', 140000.00, 15, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1385, 61, 'Branding Merk - Brosur', 100.00, 'unit', 1800.00, 16, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1386, 61, 'Meja Portable', 1.00, 'unit', 230300.00, 17, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1387, 61, 'Kursi Lipat', 4.00, 'unit', 204381.00, 18, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1388, 61, 'Vesper Milk', 1.00, 'unit', 124625.00, 19, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1389, 61, 'HKI Merk Dagang', 1.00, 'unit', 1000000.00, 20, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1390, 61, 'Bootcamp Kewirausahaan TDA', 1.00, 'unit', 300000.00, 21, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1391, 61, 'Bootcamp Design (Marketing Social Media)', 1.00, 'unit', 230000.00, 22, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1392, 61, 'Cup 12oz Oval + Tutup - Sablon', 1500.00, 'unit', 1360.00, 23, '2026-07-29 21:13:21', '2026-07-29 21:13:21'),
(1393, 85, 'Goodie Bag', 1.00, '200 pcs + ongkir', 462800.00, 0, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1394, 85, 'Sticker Vinyl', 1.00, '3 pack (100x100) +ongkir', 369400.00, 1, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1395, 85, 'Plastik Packing Polymailer', 1.00, '10 pack (30x40) 4 pack (40x60) + Ongkir', 693942.00, 2, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1396, 85, 'Hang tag', 1.00, '2300 pcs + Ongkir', 246571.00, 3, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1397, 85, 'Rak Besi 5 Susun', 1.00, '4 rak + Ongkir', 2559000.00, 4, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1398, 85, 'Kaca Cermin Standing Mirror 122x30 cm', 1.00, '1 pcs + Ongkir', 249456.00, 5, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1399, 85, 'Standing Gantungan Baju Serbaguna', 1.00, '1 PAket + Ongkir', 191414.00, 6, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1400, 85, 'Patung Manekin Perempuan', 1.00, '1 pcs + Ongkir', 281900.00, 7, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1401, 85, 'Patung Manekin Laki-laki', 1.00, '1 pcs + Ongkir', 268679.00, 8, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1402, 85, 'Hanger Kayu / Gantungan Baju', 1.00, '1 paket + Ongkir', 356999.00, 9, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1403, 85, 'Banner + Standing', 1.00, '1 pcs + Ongkir', 72999.00, 10, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1404, 85, 'Meja Lipat', 1.00, '1 pcs (60x40x70) + Ongkir', 272700.00, 11, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1405, 85, 'Kursi Bulat Stainless', 1.00, '1 pcs + Ongkir', 146640.00, 12, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1406, 85, 'Iklan Shopee Ads', 1.00, 'Paket', 333000.00, 13, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1407, 85, 'Iklan Shopee Ads', 1.00, 'Paket', 333000.00, 14, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1408, 85, 'Iklan Shopee Ads', 1.00, 'Paket', 214000.00, 15, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1409, 85, 'Pembuatan NIB', 1.00, 'Paket', 500000.00, 16, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1410, 85, 'Merk Dagang', 1.00, 'Paket', 500000.00, 17, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1411, 85, 'Bootcamp Kewirausahaan oleh TDA', 1.00, 'Pelatihan', 300000.00, 18, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1412, 85, 'Menerapkan Teknik Ecoprint untuk Produk Fashion', 1.00, 'Pelatihan', 160000.00, 19, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1413, 85, 'E-Commerce 101: Kunci Sukses Berjualan Online', 1.00, 'PElatihan', 100000.00, 20, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1414, 85, 'Materai Rp10.000', 6.00, 'PCS', 10000.00, 21, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1415, 85, 'Kertas A4', 1.00, 'Rim + Ongkir', 61000.00, 22, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1416, 85, 'Cetak Brosur', 1.00, '3 pack  (150 lbr) + Ongkir', 66500.00, 23, '2026-07-29 22:19:13', '2026-07-29 22:19:13'),
(1460, 82, 'ChatGPT Premium (6 Bulan)', 3.00, 'unit', 46000.00, 0, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1461, 82, 'Adobe Premium (4 Bulan)', 1.00, 'unit', 299000.00, 1, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1462, 82, 'Canva Premium (6 Bulan)', 6.00, 'unit', 95000.00, 2, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1463, 82, 'Capcut Premium (6 Bulan)', 6.00, 'unit', 49500.00, 3, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1464, 82, 'Gemini AI Premium (6 Bulan)', 1.00, 'unit', 99000.00, 4, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1465, 82, 'Magnific Premium (3 Bulan)', 3.00, 'unit', 63000.00, 5, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1466, 82, 'Mika Jilid Film Folio', 1.00, 'unit', 70000.00, 6, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1467, 82, 'Akrilik Stand', 1.00, 'unit', 34000.00, 7, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1468, 82, 'EventDesk Booth PVC', 1.00, 'unit', 633000.00, 8, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1469, 82, 'Standing Banner', 1.00, 'unit', 257500.00, 9, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1470, 82, 'Mouse Wireless', 1.00, 'unit', 85000.00, 10, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1471, 82, 'Alat Pemotong Kertas', 1.00, 'unit', 29500.00, 11, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1472, 82, 'Hardisk', 1.00, 'unit', 300000.00, 12, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1473, 82, 'Gunting Stainless', 1.00, 'unit', 14500.00, 13, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1474, 82, 'Cutter Deli', 1.00, 'unit', 66500.00, 14, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1475, 82, 'Rotary Stepler Joyko', 1.00, 'unit', 35000.00, 15, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1476, 82, 'Kabel Panjang', 1.00, 'unit', 59000.00, 16, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1477, 82, 'Graphic Design & Canva Bootcamp', 5.00, 'unit', 230000.00, 17, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1478, 82, 'Kelas Photoshop \"Next Level Social Media Design\"', 5.00, 'unit', 149000.00, 18, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1479, 82, 'Jasa Sewa Printer (5x Penyewaan)', 5.00, 'unit', 149000.00, 19, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1480, 82, 'Pembuatan NIB', 1.00, 'unit', 331300.00, 20, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1481, 82, 'Sertfikasi Usaha Jasa (BNSP)', 1.00, 'unit', 900000.00, 21, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1482, 82, 'Cetak Proposal Usaha + Revisi', 66.00, 'unit', 1300.00, 22, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1483, 82, 'Cetak Dana Implementasi + Revisi', 60.00, 'unit', 1300.00, 23, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1484, 82, 'Cetak Surat Pernyataan', 3.00, 'unit', 1300.00, 24, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1485, 82, 'Cetak Laporan Kemajuan + Lampiran', 100.00, 'unit', 1300.00, 25, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1486, 82, 'Cetak Laporan Akhir + Lampiran', 100.00, 'unit', 1300.00, 26, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1487, 82, 'Cetak Revisi RAB + Implementasi', 70.00, 'unit', 1300.00, 27, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1488, 82, 'Biola Map Kertas Kambing', 1.00, 'unit', 80500.00, 28, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1489, 82, 'Pena Tinta Tizo', 2.00, 'unit', 41500.00, 29, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1490, 82, 'Pensil Joyko', 1.00, 'unit', 27000.00, 30, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1491, 82, 'Notebook', 1.00, 'unit', 49000.00, 31, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1492, 82, 'Lakban Hitam Kain', 1.00, 'unit', 39000.00, 32, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1493, 82, 'Kertas Karton Buffalo (A4)', 1.00, 'unit', 47500.00, 33, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1494, 82, 'Sticker Label Kromo', 1.00, 'unit', 76000.00, 34, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1495, 82, 'Isolasi Bening', 1.00, 'unit', 28000.00, 35, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1496, 82, 'Double Tape', 1.00, 'unit', 14500.00, 36, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1497, 82, 'Isi Stepler Joyko', 1.00, 'unit', 27000.00, 37, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1498, 82, 'Pembuatan Brosur', 1.00, 'unit', 89000.00, 38, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1499, 82, 'Kertas HVS 75 GSM', 1.00, 'unit', 65500.00, 39, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1500, 82, 'Art Paper 150 GSM (A4)', 1.00, 'unit', 48000.00, 40, '2026-07-29 23:53:22', '2026-07-29 23:53:22'),
(1627, 63, 'Tali Pita Kotak ½ inch 18-22 m', 6.00, 'unit', 4500.00, 0, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1628, 63, 'Kawat Bulu premium 8MM', 20.00, 'unit', 20350.00, 1, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1629, 63, 'Ring gantungan kunci Model Lobster Bahan logam', 50.00, 'unit', 1020.00, 2, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1630, 63, 'mata boneka tempel  700 pcs', 1.00, 'unit', 38000.00, 3, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1631, 63, 'Isi lem tembak isi 30 pcs', 2.00, 'unit', 16500.00, 4, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1632, 63, 'Manik Mix garden Fairy Flower 100 gr', 7.00, 'unit', 26141.00, 5, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1633, 63, 'Tali Giok cina 1 roll (40M)', 5.00, 'roll', 18200.00, 6, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1634, 63, 'Cantolan ram/ kaitan ram s besi putih', 4.00, 'unit', 12000.00, 7, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1635, 63, 'Manik bunga gantungan jelly 100 gr', 2.00, 'unit', 24500.00, 8, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1636, 63, 'Box Custom  9 x 14 cm', 60.00, 'unit', 1967.00, 9, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1637, 63, 'Alas foto produk lipat background marble 30x40 cm', 1.00, 'unit', 43000.00, 10, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1638, 63, 'kokot udang kait lobster 50 pcs (12 mm)', 1.00, 'unit', 6000.00, 11, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1639, 63, 'Ring o 100 gr', 1.00, 'unit', 16000.00, 12, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1640, 63, 'essential oil lavender 10 ml', 2.00, 'unit', 31000.00, 13, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1641, 63, 'essential oil peppermint 10 ml', 2.00, 'unit', 19500.00, 14, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1642, 63, 'essential oil eacalyptus 10 ml', 2.00, 'unit', 27500.00, 15, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1643, 63, 'essential oil kayu manis 10 ml', 1.00, 'unit', 35000.00, 16, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1644, 63, 'fixative kental penguat parfum 100 ml', 2.00, 'unit', 17500.00, 17, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1645, 63, 'tang kombinasi multifungsi 3 in 1', 3.00, 'unit', 21000.00, 18, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1646, 63, 'spet injektor sunik 20 ml', 6.00, 'unit', 8334.00, 19, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1647, 63, 'glue gun lam tembak 20 wat', 3.00, 'unit', 18334.00, 20, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1648, 63, 'gunting serbaguna multifungsi', 3.00, 'unit', 6666.00, 21, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1649, 63, 'toples tabung tutup alumunium rosegold 200ml', 10.00, 'unit', 5500.00, 22, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1650, 63, 'booth portable 2 rak + 1 rak depan sudah  termasuk gambar dan banner', 1.00, 'unit', 555000.00, 23, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1651, 63, 'rak display putar matahari 2 susun', 3.00, 'unit', 74000.00, 24, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1652, 63, 'display karakter', 4.00, 'unit', 14500.00, 25, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1653, 63, 'rak mundo p.40 x t.70', 1.00, 'unit', 140000.00, 26, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1654, 63, 'box container 15 L', 2.00, 'unit', 62000.00, 27, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1655, 63, 'zipperbeg pouch 10x15 sablon custome', 91.00, 'unit', 1802.00, 28, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1656, 63, 'tali elastis 0,5 mm 100 m', 2.00, 'unit', 12500.00, 29, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1657, 63, 'lampu standing LED', 2.00, 'unit', 40000.00, 30, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1658, 63, 'Pembuatan NIB', 1.00, 'unit', 350000.00, 31, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1659, 63, 'workshop pmw polsri (TAD)', 1.00, 'unit', 350000.00, 32, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1660, 63, 'Sales & Business development bootcamp', 1.00, 'unit', 236000.00, 33, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1661, 63, 'stempel custome warna (cap)', 1.00, 'unit', 25000.00, 34, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1662, 63, 'tempat bak sempel joyko', 1.00, 'unit', 13000.00, 35, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1663, 63, 'materai 10.000', 10.00, 'unit', 11100.00, 36, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1664, 63, 'map kertas biola 10 pcs', 1.00, 'unit', 20000.00, 37, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1665, 63, 'pena jel joyko', 2.00, 'unit', 19500.00, 38, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1666, 63, 'nota mini hvs putih 2 rangkap 1 pak', 2.00, 'unit', 17500.00, 39, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1667, 63, 'tinta sampel', 3.00, 'unit', 16000.00, 40, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1668, 63, 'kertas a4 1 rim', 2.00, 'unit', 45500.00, 41, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1669, 63, 'staples HD 10 CL + ISI', 3.00, 'unit', 15334.00, 42, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1670, 63, 'lakban bening 24 mm (6pcs)', 2.00, 'unit', 22000.00, 43, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1671, 63, 'set dekorasi', 1.00, 'unit', 35000.00, 44, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1672, 63, 'kursi lipat portabel', 3.00, 'unit', 113334.00, 45, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1673, 63, 'payung tenda 2.7m', 1.00, 'unit', 693000.00, 46, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1674, 63, 'meja camping lipat outdoor', 1.00, 'unit', 123000.00, 47, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1675, 63, 'nampan kayu', 2.00, 'unit', 11500.00, 48, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1676, 63, 'baterai aki 6v 4,5AH+charger', 1.00, 'unit', 80000.00, 49, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1677, 63, 'taplak meja makan waterproof ukuran 140 cm x 180 cm', 1.00, 'unit', 24000.00, 50, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1678, 63, 'display pajangangelang 2 susun', 1.00, 'unit', 51000.00, 51, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1679, 63, 'lampu LED DC 30 WATT', 1.00, 'unit', 19000.00, 52, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1680, 63, 'kabel listrik ganda serabut tembaga per meter 2 x 12', 1.00, 'unit', 3000.00, 53, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1681, 63, 'cermin bulat karkter 10 pcs', 3.00, 'unit', 13334.00, 54, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1682, 63, 'manik clay ploymer 200 pcs', 3.00, 'unit', 7333.00, 55, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1683, 63, 'buku hardcover 100 lmbr', 2.00, 'unit', 21500.00, 56, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1684, 63, 'doble tape bolak balik besar 24 mm (1 slop 24 pcs)', 1.00, 'unit', 38000.00, 57, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1685, 63, 'paper clip 28 mm warna silver', 2.00, 'unit', 12500.00, 58, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1686, 63, 'sticky note', 2.00, 'unit', 42000.00, 59, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1687, 63, 'kantong plastik 100 lmbr (25cmx35cm)', 3.00, 'unit', 21334.00, 60, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1688, 63, 'cermin standing Led', 1.00, 'unit', 67000.00, 61, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1689, 63, 'kotak laci perhiasan', 5.00, 'unit', 22200.00, 62, '2026-07-30 06:53:09', '2026-07-30 06:53:09'),
(1794, 72, 'Booth Portable Bahan Aluminium Model Lipat', 1.00, 'unit', 756000.00, 0, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1795, 72, 'Miyako HM620 Hand Mixer 190 Watt', 1.00, 'Buah', 248000.00, 1, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1796, 72, 'Miyako BL101PL Blender Plastik 2 in 1', 1.00, 'unit', 266000.00, 2, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1797, 72, 'Cooler Box 30 L', 1.00, 'Buah', 556000.00, 3, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1798, 72, 'Payung Tenda 180 cm + Segitiga', 1.00, 'Set', 157000.00, 4, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1799, 72, 'Lampu Emergency Surya Magic 12 Watt', 1.00, 'Buah', 47000.00, 5, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1800, 72, 'Rosh Kukusan Stainless Steel', 1.00, 'Buah', 137000.00, 6, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1801, 72, 'Vienna Panci Stainless Steel', 1.00, 'Buah', 162000.00, 7, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1802, 72, 'Omicko C37 Mesin Cup Sealer', 1.00, 'Buah', 766000.00, 8, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1803, 72, 'Sertifikasi Halal', 1.00, 'Paket', 228500.00, 9, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1804, 72, 'NIB', 1.00, 'Paket', 400000.00, 10, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1805, 72, 'Boothcamp Kewirausahaan bersama TDA', 1.00, 'Paket', 300000.00, 11, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1806, 72, 'Ubi Ungu', 3.00, 'Kg', 17000.00, 12, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1807, 72, 'Agar Agar Swallow Globe 1 Box', 6.00, 'Kotak', 61000.00, 13, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1808, 72, 'Waffle Cone isi 13 1 pack', 10.00, 'Pack', 10400.00, 14, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1809, 72, 'Gula Pasir Gulaku 1 Kg', 10.00, 'Bungkus', 18000.00, 15, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1810, 72, 'Susu Ultra Milk Full Cream 1L', 5.00, 'Kotak', 27000.00, 16, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1811, 72, 'Frisian Flag Bendera Kental Manis 490 gr', 5.00, 'Kaleng', 19400.00, 17, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1812, 72, 'Lid Sealer isi 1200 pcs', 1.00, 'Roll', 167000.00, 18, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1813, 72, 'Susu Dancow Putih Renceng', 2.00, 'Renceng', 46000.00, 19, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1814, 72, 'Cup Plastik Ukuran 240 ml', 10.00, 'unit', 7700.00, 20, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1815, 72, 'Oreo Cookie Crumb', 1.00, 'Kg', 90000.00, 21, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1816, 72, 'Keju WinCheez 250 gr', 4.00, 'Bungkus', 15000.00, 22, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1817, 72, 'My Fla Nutrijell 60 gr', 16.00, 'Bungkus', 5750.00, 23, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1818, 72, 'Sendok Jelly Victory isi 1 Pack 100 pcs', 5.00, 'Pack', 7300.00, 24, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1819, 72, 'Kertas Art Paper 120 gsm isi 250 lembar', 2.00, 'Pack', 159500.00, 25, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(1820, 72, 'Tinta Epson Diamond Ink', 2.00, 'Pack', 150000.00, 26, '2026-07-30 10:30:13', '2026-07-30 10:30:13'),
(2066, 33, 'Jasa Website Company Profile', 1.00, 'unit', 478000.00, 0, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2067, 33, 'X-Banner', 1.00, 'unit', 150000.00, 1, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2068, 33, 'Kartu Company Profile', 100.00, 'lembar', 350.00, 2, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2069, 33, 'Brosur', 215.00, 'lembar', 555.00, 3, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2070, 33, 'Buku Pitching Deck 28 Halaman', 5.00, 'unit', 62000.00, 4, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2071, 33, 'Service Custom Pembuatan Aplikasi', 1.00, 'unit', 950000.00, 5, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2072, 33, 'Jasa Pengembangan Aplikasi', 1.00, 'unit', 615000.00, 6, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2073, 33, 'Layanan Pemeliharaan Aplikasi', 1.00, 'unit', 615000.00, 7, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2074, 33, 'Booth Disertai Branding Merk', 1.00, 'unit', 580000.00, 8, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2075, 33, 'Softbox Lighting', 1.00, 'unit', 879000.00, 9, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2076, 33, 'Backdrop Foto Studio (Background + Penyangga)', 1.00, 'unit', 240900.00, 10, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2077, 33, 'Tripod', 1.00, 'unit', 195000.00, 11, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2078, 33, 'Microphone', 1.00, 'unit', 388900.00, 12, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2079, 33, 'Reflektor Cahaya Fotografi Studio', 1.00, 'unit', 74900.00, 13, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2080, 33, 'Paket Lampu Studio Flash', 1.00, 'unit', 745000.00, 14, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2081, 33, 'Payung Light Stand', 2.00, 'unit', 106000.00, 15, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2082, 33, 'Box Studio Foto Protable Lipat Motif', 1.00, 'unit', 242500.00, 16, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2083, 33, 'Lighting Vlogging Set', 2.00, 'unit', 225000.00, 17, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2084, 33, 'Telemprompter', 1.00, 'unit', 295000.00, 18, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2085, 33, 'LED Four-Color Flash Light', 1.00, 'unit', 517000.00, 19, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2086, 33, 'Set Podium Kayu', 1.00, 'unit', 85000.00, 20, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2087, 33, 'Properti Produk', 1.00, 'set', 125000.00, 21, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2088, 33, 'SSD Vurrion Fusion', 1.00, 'unit', 340000.00, 22, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2089, 33, 'Tatakan Gelas Kayu Tipe H dan E', 2.00, 'unit', 14250.00, 23, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2090, 33, 'Dekorasi Ruangan Paket Properti Konten', 2.00, 'unit', 26500.00, 24, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2091, 33, 'Sertifikasi Khusus Sales & Business Development', 1.00, 'unit', 230000.00, 25, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2092, 33, 'Sertifikasi Khusus Digital Marketing', 2.00, 'unit', 650000.00, 26, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2093, 33, 'NIB', 1.00, 'unit', 350000.00, 27, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2094, 33, 'Pelatihan Kewirausahaan oleh TDA', 1.00, 'unit', 300000.00, 28, '2026-07-30 11:56:54', '2026-07-30 11:56:54'),
(2287, 49, 'Iklan Instagram (Meta Ads Instagram) by Postingan', 14.00, 'Hari', 37500.00, 0, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2288, 49, 'Iklan Rells Instagram (Meta Ads Instagram) by Rells', 10.00, 'Hari', 35400.00, 1, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2289, 49, 'Rak Serbaguna', 1.00, 'unit', 750000.00, 2, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2290, 49, 'Booth Custom', 1.00, 'unit', 807000.00, 3, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2291, 49, 'Standing Flowers Decorasion', 5.00, 'unit', 44000.00, 4, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2292, 49, 'Alat Lem Tembak', 3.00, 'unit', 62900.00, 5, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2293, 49, 'Hanging Display Buket', 11.00, 'unit', 16500.00, 6, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2294, 49, 'Gunting', 5.00, 'unit', 25000.00, 7, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2295, 49, 'Tape Dispenser', 2.00, 'unit', 25500.00, 8, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2296, 49, 'Tang Potong Bunga', 2.00, 'unit', 57900.00, 9, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2297, 49, 'Cutter', 1.00, 'Paket', 165000.00, 10, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2298, 49, 'Pembolong Kertas', 2.00, 'unit', 45600.00, 11, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2299, 49, 'Heat Gun', 2.00, 'unit', 58000.00, 12, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2300, 49, 'Keranjang Vas Rotan', 5.00, 'unit', 29500.00, 13, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2301, 49, 'Penggaris Besi', 3.00, 'unit', 12250.00, 14, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2302, 49, 'Stapler Hekter', 2.00, 'unit', 10950.00, 15, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2303, 49, 'Rak Buket', 1.00, 'unit', 180400.00, 16, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2304, 49, 'Papan Akrilik', 1.00, 'unit', 425000.00, 17, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2305, 49, 'Folding Paper Cylinder', 2.00, 'unit', 189000.00, 18, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2306, 49, 'Kursi Lipat', 1.00, 'unit', 64050.00, 19, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2307, 49, 'Tripod Stand Banner', 1.00, 'unit', 145200.00, 20, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2308, 49, 'Rak Kertas Buket', 1.00, 'unit', 150000.00, 21, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2309, 49, 'Rak Pita', 1.00, 'unit', 35000.00, 22, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2310, 49, 'Pendaftaran Merek Dagang', 1.00, 'Paket', 500000.00, 23, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2311, 49, 'Biaya Jasa Pendampingan Pembuatan  NIB (Nomor Induk Berusaha) di Lembaga Pemeriksa Halal Polsri', 1.00, 'Paket', 500000.00, 24, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2312, 49, 'Bootcamp Kewirausahaan Oleh TDA', 1.00, 'Paket', 300000.00, 25, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2313, 49, 'Kelas Online Buket Bunga', 1.00, 'Paket', 345000.00, 26, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2314, 49, 'Materai  Rp 10.000', 4.00, 'Pcs', 13750.00, 27, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2315, 49, 'Kertas HVS A4', 1.00, 'unit', 58000.00, 28, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2316, 49, 'Paper Bag Custom', 250.00, 'Pcs', 4200.00, 29, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2317, 49, 'Pita Satin Custom', 22.00, 'Roll', 32000.00, 30, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2318, 49, 'Biaya Penanganan Pita Satin penanganan Pita satin', 1.00, 'unit', 4000.00, 31, '2026-07-30 13:13:00', '2026-07-30 13:13:00'),
(2624, 65, 'Meja booth portable', 1.00, 'unit', 645000.00, 0, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2625, 65, 'Ram kaki (rak display 90x150)', 1.00, 'unit', 220999.00, 1, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2626, 65, 'Cantolan ram', 30.00, 'unit', 1334.00, 2, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2627, 65, 'Manekin kaki', 4.00, 'unit', 105250.00, 3, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2628, 65, 'Perforator 1 lubang', 1.00, 'unit', 15700.00, 4, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2629, 65, 'Gunting joyko SC-838', 2.00, 'unit', 16900.00, 5, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2630, 65, 'Box penyimpanan kontainer', 2.00, 'unit', 81011.00, 6, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2631, 65, 'Papan akrilik qris', 1.00, 'unit', 25000.00, 7, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2632, 65, 'Laci penyimpanan uang 4 tingkat', 1.00, 'unit', 29009.00, 8, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2633, 65, 'Tas penyimpanan', 4.00, 'unit', 30150.00, 9, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2634, 65, 'Rumput sintetis', 2.00, 'unit', 113730.00, 10, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2635, 65, 'X banner (standing banner)', 1.00, 'unit', 62750.00, 11, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2636, 65, 'Speaker', 1.00, 'unit', 145900.00, 12, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2637, 65, 'Brosur promosi brand', 193.00, 'unit', 1806.00, 13, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2638, 65, 'Bando maskot', 4.00, 'unit', 30250.00, 14, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2639, 65, 'Standing brosur brand', 1.00, 'unit', 35000.00, 15, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2640, 65, 'Meja display', 1.00, 'unit', 80650.00, 16, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2641, 65, 'Keranjang display', 3.00, 'unit', 28333.00, 17, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2642, 65, 'Tenda jualan', 1.00, 'unit', 161000.00, 18, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2643, 65, 'Tag gun', 1.00, 'unit', 37300.00, 19, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2644, 65, 'Kertas serut 50 gram', 4.00, 'unit', 4250.00, 20, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2645, 65, 'Kertas bungkus', 1.00, 'unit', 10450.00, 21, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2646, 65, 'Pelatihan (Bootcamp TDA)', 1.00, 'kali', 300000.00, 22, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2647, 65, 'Kelas Pro Course Skill Academy', 1.00, 'kali', 160000.00, 23, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2648, 65, 'Pengurusan NIB', 1.00, 'kali', 350000.00, 24, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2649, 65, 'E-learning MySkill', 1.00, 'kali', 110774.00, 25, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2650, 65, 'Kaos kaki bayi motif animal', 5.00, 'pcs', 9187.00, 26, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2651, 65, 'Kaos kaki bayi bulu lembut', 5.00, 'pcs', 21812.00, 27, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2652, 65, 'Kaos kaki bayi panjang karakter', 5.00, 'pcs', 11128.00, 28, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2653, 65, 'Kaos kaki timbul premium', 5.00, 'pcs', 28198.00, 29, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2654, 65, 'Kaos kaki twist lolita women', 6.00, 'pcs', 6667.00, 30, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2655, 65, 'Kaos kaki panjang tulip flower 3D', 5.00, 'pcs', 8000.00, 31, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2656, 65, 'Kaos kaki panjang wanita colorful flower', 5.00, 'pcs', 7199.00, 32, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2657, 65, 'Kaos kaki tribal pendek pria', 5.00, 'pcs', 6950.00, 33, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2658, 65, 'Kaos kaki kantor pria', 5.00, 'pcs', 8700.00, 34, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2659, 65, 'Kaos kaki pendek wanita japanese retro style', 5.00, 'pcs', 6200.00, 35, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2660, 65, 'Kaos kaki 3D dengan magnet', 6.00, 'pcs', 26055.00, 36, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2661, 65, 'Kaos kaki silk anti UV', 2.00, 'pcs', 26844.00, 37, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2662, 65, 'Kaos kaki full print', 5.00, 'pcs', 27199.00, 38, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2663, 65, 'Kaos kaki oldschool', 2.00, 'pcs', 8303.00, 39, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2664, 65, 'Kaos kaki sport basic', 3.00, 'pcs', 6198.00, 40, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2665, 65, 'Pita satin', 3.00, 'roll', 3680.00, 41, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2666, 65, 'Cetak paperbelt', 15.00, 'lembar', 1800.00, 42, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2667, 65, 'Plastik OPP', 3.00, 'pack', 20134.00, 43, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2668, 65, 'Cetak special packaging', 21.00, 'lembar', 1800.00, 44, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2669, 65, 'Double tape', 5.00, 'buah', 2800.00, 45, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2670, 65, 'Paper bag custom', 25.00, 'pcs', 2130.00, 46, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2671, 65, 'Hardbox custom', 4.00, 'pcs', 25250.00, 47, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2672, 65, 'Gelas kaca gift premium', 2.00, 'pcs', 31400.00, 48, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2673, 65, 'Gelas kaca gift premium cewe', 2.00, 'pcs', 33500.00, 49, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2674, 65, 'Gelas kaca gift premium anak', 2.00, 'pcs', 38700.00, 50, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2675, 65, 'Needle tag gun', 1.00, 'pcs', 31000.00, 51, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2676, 65, 'Tag pin', 1.00, 'pcs', 23000.00, 52, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2677, 65, 'Cetak dokumen', 424.00, 'lembar', 500.00, 53, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2678, 65, 'Cetak dokumen warna', 100.00, 'lembar', 2000.00, 54, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2679, 65, 'Materai', 10.00, 'buah', 11700.00, 55, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2680, 65, 'Penjilidan dokumen', 10.00, 'kali', 5000.00, 56, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2681, 65, 'Map', 10.00, 'buah', 3000.00, 57, '2026-07-30 16:07:45', '2026-07-30 16:07:45'),
(2751, 20, 'Hard Brush - Permanence Your Clothes', 1.00, 'unit', 64000.00, 0, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2752, 20, 'Sikat Sepatu Suede Rubber Brush', 1.00, 'unit', 35500.00, 1, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2753, 20, 'Lap Microfiber Bowin', 2.00, 'unit', 15000.00, 2, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2754, 20, 'Sikat Sepatu Premium Nylon', 2.00, 'unit', 21500.00, 3, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2755, 20, 'Sikat Semir Sepatu Kulit Sponge', 2.00, 'unit', 20750.00, 4, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2756, 20, 'Alat Pencongkel Outsole dan Midsole', 1.00, 'unit', 29500.00, 5, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2757, 20, 'Booth Promosi', 1.00, 'unit', 624000.00, 6, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2758, 20, 'Tripod Banner', 1.00, 'unit', 260000.00, 7, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2759, 20, 'Shoes Clear Electric Philips', 1.00, 'unit', 381000.00, 8, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2760, 20, 'Woya Printer Bluetooth', 1.00, 'unit', 235000.00, 9, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2761, 20, 'AW Mesin Pembersih Uap', 1.00, 'unit', 513000.00, 10, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2762, 20, 'Shoe Cleaner Holly Shine', 3.00, 'unit', 47667.00, 11, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2763, 20, 'Falap Shoe Parfum', 2.00, 'unit', 172500.00, 12, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2764, 20, 'Shoes Water Repellent Spray', 2.00, 'unit', 35000.00, 13, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2765, 20, 'Plastic Klip Handle', 2.00, 'unit', 175500.00, 14, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2766, 20, 'Wonder Balsam', 1.00, 'unit', 74000.00, 15, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2767, 20, 'Silica Gel Natural', 5.00, 'unit', 37400.00, 16, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2768, 20, 'Portable Leather Shoe Cleaner', 1.00, 'unit', 83000.00, 17, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2769, 20, 'Boothcamp/ Pelatihan Pmw', 1.00, 'unit', 300000.00, 18, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2770, 20, 'Pembuatan NIB', 1.00, 'unit', 402000.00, 19, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2771, 20, 'Cetak Proposal Usaha', 1.00, 'unit', 35000.00, 20, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2772, 20, 'Cetak Dana Implementasi', 1.00, 'unit', 34000.00, 21, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2773, 20, 'Cetak Laporan Kemajuan + Lampiran', 1.00, 'unit', 60000.00, 22, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2774, 20, 'CETAK LAPORAN AKHIR + LAMPIRAN', 1.00, 'unit', 60000.00, 23, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2775, 20, 'Cetak Surat Pernyataan', 1.00, 'unit', 5000.00, 24, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2776, 20, 'Kertas Hvs F4', 1.00, 'unit', 55000.00, 25, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2777, 20, 'Kertas Printer Woya', 5.00, 'unit', 29600.00, 26, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2778, 20, 'Tinta Printer Woya', 2.00, 'unit', 15500.00, 27, '2026-07-31 13:58:50', '2026-07-31 13:58:50'),
(2779, 20, 'Materai', 3.00, 'unit', 13500.00, 28, '2026-07-31 13:58:50', '2026-07-31 13:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_reports`
--

CREATE TABLE `pmw_reports` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `schedule_id` int UNSIGNED NOT NULL,
  `type` enum('kemajuan','akhir','magang') COLLATE utf8mb4_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `status` enum('submitted','approved','rejected','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'submitted',
  `dosen_note` text COLLATE utf8mb4_general_ci,
  `dosen_verified_at` datetime DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_report_schedules`
--

CREATE TABLE `pmw_report_schedules` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `type` enum('kemajuan','akhir','magang') COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_report_schedules`
--

INSERT INTO `pmw_report_schedules` (`id`, `period_id`, `type`, `start_date`, `end_date`, `is_active`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'kemajuan', '2026-04-13', '2026-04-24', 1, NULL, '2026-04-19 02:39:05', '2026-04-19 02:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_reviewers`
--

CREATE TABLE `pmw_reviewers` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nidn` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `institution` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expertise` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_reviewers`
--

INSERT INTO `pmw_reviewers` (`id`, `user_id`, `nama`, `nidn`, `nip`, `institution`, `expertise`, `phone`, `bio`, `created_at`, `updated_at`) VALUES
(3, 115, 'Reviewer1', '123456789', '987654321', 'Politeknik Negeri Sriwijaya', 'Review', '08123456789', 'Reviewer PMW', '2026-06-01 14:45:14', '2026-06-01 14:45:14');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_schedules`
--

CREATE TABLE `pmw_schedules` (
  `id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `phase_number` int UNSIGNED NOT NULL,
  `phase_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_schedules`
--

INSERT INTO `pmw_schedules` (`id`, `period_id`, `phase_number`, `phase_name`, `start_date`, `end_date`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Administrasi & Deck Evaluation', '2026-05-04', '2026-05-31', 'Tahap pengajuan awal: pengisian identitas usaha, data tim, unggah dokumen administrasi, File presentasi, dan video perkenalan usaha (wajib untuk kategori Berkembang).', 1, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(2, 1, 2, 'Pengumpulan Proposal', '2026-07-01', '2026-07-30', 'Tahap Proposal. Tim yang lolos Tahap 1 (Administrasi & Deck Evaluation) wajib mengunggah dokumen proposal utama dan RAB untuk divalidasi oleh dosen pendamping.', 1, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(4, 1, 3, 'Perjanjian Implementasi', '2026-07-01', '2026-07-30', 'Tahap verifikasi komitmen bagi tim yang lolos seleksi pitching. Meliputi wawancara pendalaman kesiapan eksekusi bisnis dan penandatanganan lembar perjanjian implementasi.', 1, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(5, 1, 4, 'Pengumuman Kelolosan Dana PMW Tahap I', '2026-07-20', '2026-08-07', 'Perilisan daftar tim yang berhak menerima pendanaan tahap awal. Dilanjutkan dengan pelatihan intensif (Workshop) untuk mematangkan strategi eksekusi bisnis, pemasaran, dan manajemen pengelolaan keuangan.', 1, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(6, 1, 6, 'Start Up Bisnis dan Pendampingan (Mentoring) & Magang', '2026-08-01', '2026-10-31', 'Fase eksekusi bisnis menggunakan dana modal yang diberikan. Tim wajib menjalankan operasional usaha sembari berkoordinasi secara rutin dengan dosen pembimbing dan mentor praktisi untuk memecahkan kendala di lapangan.', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(7, 1, 7, 'Monitoring dan Evaluasi Tahap I (Bazar & Bootcamp kewirausahaan)', '2026-10-19', '2026-10-24', 'Monitoring dan Evaluasi (Monev) tahap pertama melalui simulasi pasar terbuka. Tim akan dinilai berdasarkan respons pasar, strategi pemasaran langsung (direct selling), kemasan produk, dan pencatatan transaksi awal.', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(8, 1, 8, 'Monitoring dan Evaluasi Tahap II  (Lokasi Usaha Mahasiswa)', '2026-10-19', '2025-10-24', 'Kunjungan lapangan (observasi) oleh tim penilai ke lokasi operasional atau tempat produksi bisnis. Bertujuan untuk memvalidasi realisasi kemajuan usaha dan kesesuaian penggunaan anggaran.', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(9, 1, 9, 'Pengumuman Tahap II', '2026-10-26', '2026-10-30', '\"Penetapan kelanjutan pendanaan berdasarkan akumulasi metrik penilaian dari Monev 1 dan Monev 2. Tim dengan kinerja dan arus kas bisnis yang tervalidasi sehat berhak menerima pencairan dana tahap akhir.', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(10, 1, 10, 'Laporan Akhir & Penutupan', '2026-11-02', '2026-11-16', 'Kewajiban administratif final program. Setiap tim harus menyusun dan menyerahkan laporan komprehensif terkait rekapitulasi keuangan riil, evaluasi pencapaian target, dan rencana keberlanjutan bisnis (sustainability).', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(11, 1, 11, 'Awarding & Expo', '2026-11-23', '2026-11-25', 'Puncak acara PMW berupa pameran bisnis skala besar untuk uji pasar final, diakhiri dengan malam penganugerahan (Awarding) guna memberikan apresiasi kepada wirausaha mahasiswa terbaik berdasarkan indikator kinerja terukur.', 0, '2026-04-14 19:08:13', '2026-08-03 21:57:48'),
(23, 1, 5, 'Pembekalan Kewirausahaan, Administrasi, dan Keuangan', '2026-07-20', '2026-08-24', 'Fase pembekalan wajib bagi tim yang telah lolos pendanaan. Peserta akan mendapatkan materi komprehensif mengenai strategi operasional bisnis, standar administrasi pembukuan, dan manajemen arus kas keuangan. Setelah mengikuti kegiatan, peserta diwajibkan mengunggah bukti kehadiran berupa dokumentasi foto dan ringkasan materi sebagai syarat administratif ke tahap implementasi.', 1, '2026-04-16 19:25:21', '2026-08-03 21:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_selection_finalization`
--

CREATE TABLE `pmw_selection_finalization` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `admin_status` enum('pending','approved','rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `admin_catatan` text COLLATE utf8mb4_general_ci,
  `admin_verified_at` datetime DEFAULT NULL,
  `admin_id` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_selection_implementasi`
--

CREATE TABLE `pmw_selection_implementasi` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `student_submitted_at` datetime DEFAULT NULL,
  `dosen_status` enum('pending','approved','revision','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `dosen_catatan` text COLLATE utf8mb4_general_ci,
  `dosen_verified_at` datetime DEFAULT NULL,
  `admin_status` enum('pending','approved','revision','rejected') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `admin_catatan` text COLLATE utf8mb4_general_ci,
  `admin_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_selection_implementasi`
--

INSERT INTO `pmw_selection_implementasi` (`id`, `proposal_id`, `student_submitted_at`, `dosen_status`, `dosen_catatan`, `dosen_verified_at`, `admin_status`, `admin_catatan`, `admin_verified_at`, `created_at`, `updated_at`) VALUES
(20, 20, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-03 22:51:30', '2026-05-03 22:51:30'),
(21, 21, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(22, 22, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 23, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(24, 24, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-05 19:12:04', '2026-05-05 19:12:04'),
(25, 25, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(26, 26, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-06 16:29:24', '2026-05-06 16:29:24'),
(27, 27, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-07 09:51:19', '2026-05-07 09:51:19'),
(28, 28, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(29, 29, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 30, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 31, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-08 18:44:43', '2026-05-08 18:44:43'),
(32, 32, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-10 08:46:55', '2026-05-10 08:46:55'),
(33, 33, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-10 15:08:24', '2026-05-10 15:08:24'),
(34, 34, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(35, 35, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 36, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 37, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 38, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 39, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 40, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(41, 41, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(42, 42, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(43, 43, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 44, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 45, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(46, 46, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-14 14:09:55', '2026-05-14 14:09:55'),
(47, 47, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-14 20:07:38', '2026-05-14 20:07:38'),
(48, 48, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 49, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-16 10:08:37', '2026-05-16 10:08:37'),
(50, 50, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-17 12:39:29', '2026-05-17 12:39:29'),
(51, 51, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(52, 52, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 09:39:39', '2026-05-19 09:39:39'),
(53, 53, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 10:46:34', '2026-05-19 10:46:34'),
(54, 54, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 11:24:58', '2026-05-19 11:24:58'),
(55, 55, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 56, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 11:26:44', '2026-05-19 11:26:44'),
(57, 57, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 20:59:29'),
(58, 58, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 59, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-20 12:59:15', '2026-05-20 12:59:15'),
(60, 60, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-20 14:04:10', '2026-05-20 14:04:10'),
(61, 61, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-20 15:22:10', '2026-05-20 15:22:10'),
(62, 62, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-21 12:55:59', '2026-05-21 12:55:59'),
(64, 64, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-21 16:09:44', '2026-05-21 16:09:44'),
(66, 66, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(67, 67, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(68, 68, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(69, 69, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(70, 70, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(71, 71, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(72, 72, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 12:32:08', '2026-05-23 12:32:08'),
(73, 73, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(75, 75, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(76, 76, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(77, 77, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(78, 78, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(79, 79, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(81, 81, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(82, 82, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 21:24:13', '2026-05-24 21:24:13'),
(83, 83, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(85, 85, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(86, 86, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 21:19:46', '2026-05-25 21:19:46'),
(88, 88, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16'),
(91, 91, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-06-05 12:09:36', '2026-06-05 12:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_selection_pitching`
--

CREATE TABLE `pmw_selection_pitching` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `student_submitted_at` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_general_ci,
  `persentase_nilai` decimal(5,2) DEFAULT NULL,
  `penilaian_final_at` datetime DEFAULT NULL,
  `penilaian_final_by` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_selection_pitching`
--

INSERT INTO `pmw_selection_pitching` (`id`, `proposal_id`, `student_submitted_at`, `status`, `catatan`, `persentase_nilai`, `penilaian_final_at`, `penilaian_final_by`, `created_at`, `updated_at`) VALUES
(20, 20, '2026-05-25 15:09:30', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 80.28, '2026-06-18 10:03:19', 1, '2026-05-03 22:51:30', '2026-06-18 10:03:19'),
(21, 21, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(22, 22, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 23, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(24, 24, '2026-05-31 23:59:54', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 67.64, '2026-06-18 10:08:35', 1, '2026-05-05 19:12:04', '2026-06-18 10:08:35'),
(25, 25, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(26, 26, '2026-05-25 22:10:13', 'rejected', 'Dapat di lanjutkan ke tahap berikutnya', 76.67, '2026-06-18 10:05:30', 1, '2026-05-06 16:29:24', '2026-07-23 11:20:21'),
(27, 27, '2026-05-25 23:47:10', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 68.71, '2026-06-18 10:08:54', 1, '2026-05-07 09:51:19', '2026-06-18 10:08:54'),
(28, 28, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(29, 29, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 30, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 31, '2026-05-25 11:17:23', 'approved', 'Di lanjutkan ke tahap berikutnya', 98.86, '2026-06-18 09:58:33', 1, '2026-05-08 18:44:43', '2026-06-18 09:58:33'),
(32, 32, '2026-05-25 16:10:20', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 86.13, '2026-06-18 10:00:31', 1, '2026-05-10 08:46:55', '2026-06-18 10:00:31'),
(33, 33, '2026-05-25 09:25:08', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 90.14, '2026-06-18 09:59:25', 1, '2026-05-10 15:08:24', '2026-06-18 09:59:25'),
(34, 34, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(35, 35, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 36, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 37, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 38, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 39, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 40, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(41, 41, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(42, 42, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(43, 43, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 44, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 45, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(46, 46, '2026-05-23 16:37:30', 'rejected', 'Dapat di lanjutkan ke tahap berikutnya', 78.00, '2026-06-18 10:02:57', 1, '2026-05-14 14:09:55', '2026-07-23 11:21:48'),
(47, 47, '2026-05-24 14:13:03', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 71.44, '2026-06-18 10:10:58', 1, '2026-05-14 20:07:38', '2026-06-18 10:10:58'),
(48, 48, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 49, '2026-05-25 09:54:57', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 85.24, '2026-06-18 10:00:46', 1, '2026-05-16 10:08:37', '2026-06-18 10:00:46'),
(50, 50, '2026-05-24 12:56:59', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 75.29, '2026-06-18 10:09:30', 1, '2026-05-17 12:39:29', '2026-06-18 10:09:30'),
(51, 51, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(52, 52, '2026-05-25 09:04:02', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 71.74, '2026-06-18 10:10:42', 1, '2026-05-19 09:39:39', '2026-06-18 10:10:42'),
(53, 53, '2026-05-22 06:55:46', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 53.13, '2026-06-18 10:06:46', 1, '2026-05-19 10:46:34', '2026-06-18 10:06:46'),
(54, 54, '2026-05-21 11:51:49', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 57.05, '2026-06-18 10:07:20', 1, '2026-05-19 11:24:58', '2026-06-18 10:07:20'),
(55, 55, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 56, '2026-05-25 21:37:57', 'pending', NULL, NULL, NULL, NULL, '2026-05-19 11:26:44', '2026-05-25 21:37:57'),
(57, 57, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 20:59:29'),
(58, 58, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 59, '2026-05-24 11:33:24', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 70.00, '2026-06-18 10:11:45', 1, '2026-05-20 12:59:15', '2026-06-18 10:11:45'),
(60, 60, '2026-05-23 19:03:21', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 62.21, '2026-06-18 10:08:01', 1, '2026-05-20 14:04:10', '2026-06-18 10:08:01'),
(61, 61, '2026-05-22 16:11:14', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 89.32, '2026-06-18 09:59:41', 1, '2026-05-20 15:22:10', '2026-06-18 09:59:41'),
(62, 62, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, '2026-05-25 13:47:16', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 83.81, '2026-06-18 10:01:20', 1, '2026-05-21 12:55:59', '2026-06-18 10:01:20'),
(64, 64, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, '2026-05-25 15:03:55', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 82.56, '2026-06-18 10:02:12', 1, '2026-05-21 16:09:44', '2026-06-18 10:02:12'),
(66, 66, '2026-05-25 21:41:19', 'rejected', 'Dapat di lanjutkan ke tahap berikutnya', 77.13, '2026-06-18 10:04:48', 1, '2026-05-21 18:19:25', '2026-07-23 11:20:58'),
(67, 67, '2026-05-24 21:03:18', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 58.24, '2026-06-18 10:07:42', 1, '2026-05-22 07:52:38', '2026-06-18 10:07:42'),
(68, 68, '2026-05-25 06:45:23', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 69.44, '2026-06-18 10:12:18', 1, '2026-05-22 08:02:18', '2026-06-18 10:12:18'),
(69, 69, '2026-05-25 00:02:02', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 67.59, '2026-06-18 10:08:19', 1, '2026-05-23 10:42:51', '2026-06-18 10:08:19'),
(70, 70, '2026-05-25 17:05:08', 'pending', NULL, NULL, NULL, NULL, '2026-05-23 10:57:24', '2026-05-25 17:05:08'),
(71, 71, '2026-05-24 14:51:05', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 54.66, '2026-06-18 10:07:03', 1, '2026-05-23 11:51:45', '2026-06-18 10:07:03'),
(72, 72, '2026-05-25 22:56:11', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 84.16, '2026-06-18 10:01:04', 1, '2026-05-23 12:32:08', '2026-06-18 10:01:04'),
(73, 73, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, '2026-05-25 18:43:27', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 69.45, '2026-06-18 10:12:34', 1, '2026-05-23 22:55:59', '2026-06-18 10:12:34'),
(75, 75, '2026-05-24 13:01:35', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 75.56, '2026-06-18 10:09:13', 1, '2026-05-23 23:43:29', '2026-06-18 10:09:13'),
(76, 76, '2026-05-24 17:42:54', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 73.49, '2026-06-18 10:09:48', 1, '2026-05-24 11:57:30', '2026-06-18 10:09:48'),
(77, 77, '2026-05-25 05:49:20', 'rejected', 'Dapat di lanjutkan ke tahap berikutnya', 78.58, '2026-06-18 10:01:41', 1, '2026-05-24 12:49:36', '2026-07-30 15:43:34'),
(78, 78, '2026-05-24 22:50:46', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 71.20, '2026-06-18 10:11:27', 1, '2026-05-24 13:21:31', '2026-06-18 10:11:27'),
(79, 79, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, '2026-05-25 15:17:56', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 69.52, '2026-06-18 10:12:02', 1, '2026-05-24 19:03:57', '2026-06-18 10:12:02'),
(81, 81, '2026-05-24 21:27:42', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 69.06, '2026-06-18 10:10:23', 1, '2026-05-24 19:28:18', '2026-06-18 10:10:24'),
(82, 82, '2026-05-31 22:38:37', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 81.83, '2026-06-18 10:02:34', 1, '2026-05-24 21:24:13', '2026-06-18 10:02:34'),
(83, 83, '2026-05-25 13:20:06', 'rejected', 'Nilai belum memenuhi standar kelolosan pitch desk pmw 2026, tidak dapat di lanjutkan ke tahap berikutnya', 71.75, '2026-06-18 10:10:04', 1, '2026-05-24 21:25:33', '2026-06-18 10:10:04'),
(85, 85, '2026-05-31 09:38:50', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 80.25, '2026-06-18 10:03:39', 1, '2026-05-25 11:04:52', '2026-06-18 10:03:39'),
(86, 86, '2026-05-25 15:38:19', 'rejected', 'Dapat di lanjutkan ke tahap berikutnya', 77.67, '2026-06-18 09:59:58', 1, '2026-05-25 13:28:13', '2026-07-23 11:23:11'),
(87, 87, '2026-05-31 20:46:34', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 90.46, '2026-06-18 09:59:01', 1, '2026-05-25 21:19:46', '2026-06-18 09:59:01'),
(88, 88, NULL, 'pending', NULL, NULL, NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, '2026-05-31 23:02:24', 'approved', 'Dapat di lanjutkan ke tahap berikutnya', 88.07, '2026-06-18 10:00:16', 1, '2026-05-26 16:49:16', '2026-06-18 10:00:16'),
(91, 91, '2026-06-05 21:27:47', 'pending', NULL, NULL, NULL, NULL, '2026-06-05 12:09:36', '2026-06-05 21:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_selection_proposal`
--

CREATE TABLE `pmw_selection_proposal` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `student_submitted_at` datetime DEFAULT NULL,
  `dosen_status` enum('pending','approved','rejected','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `admin_status` enum('pending','approved','rejected','revision') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `dosen_catatan` text COLLATE utf8mb4_general_ci,
  `admin_catatan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_selection_proposal`
--

INSERT INTO `pmw_selection_proposal` (`id`, `proposal_id`, `student_submitted_at`, `dosen_status`, `admin_status`, `dosen_catatan`, `admin_catatan`, `created_at`, `updated_at`) VALUES
(7, 20, '2026-07-23 12:22:28', 'approved', 'revision', NULL, 'proposal yang di inputkan wajib yang telah di tanda tangani', '2026-07-23 12:22:28', '2026-07-31 12:44:54'),
(8, 31, '2026-07-26 23:11:36', 'approved', 'approved', 'Administrasi telah bagus. Lanjutkan', 'Proposal Diterima', '2026-07-26 23:11:36', '2026-07-31 12:43:26'),
(9, 89, '2026-07-29 09:50:55', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-29 09:50:55', '2026-07-31 12:09:50'),
(10, 32, '2026-07-29 10:58:16', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-29 10:58:16', '2026-07-31 12:03:48'),
(11, 87, '2026-07-29 16:32:36', 'approved', 'approved', 'Sudah baik, Lanjutkan', 'Proposal Diterima', '2026-07-29 16:32:36', '2026-07-31 12:01:05'),
(12, 61, '2026-07-29 21:13:21', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-29 21:13:21', '2026-07-31 11:59:10'),
(13, 85, '2026-07-29 22:19:13', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-29 22:19:13', '2026-07-31 11:58:09'),
(14, 82, '2026-07-29 23:53:22', 'approved', 'approved', 'Proposal sudah di perbaiki sesuai dengan aturan', 'Proposal Diterima', '2026-07-29 23:53:22', '2026-07-31 11:56:42'),
(15, 63, '2026-07-30 06:53:09', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-30 06:53:09', '2026-07-31 11:55:18'),
(16, 72, '2026-07-30 10:30:13', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-30 10:30:13', '2026-07-31 11:53:10'),
(17, 33, '2026-07-30 11:56:54', 'approved', 'approved', NULL, 'Proposal Diterima', '2026-07-30 11:56:54', '2026-07-31 11:49:48'),
(18, 49, '2026-07-30 13:13:00', 'approved', 'approved', 'Usaha By.Juwita layak dilanjutkan', 'proposal diterima', '2026-07-30 13:13:00', '2026-07-31 11:48:15'),
(19, 65, '2026-07-30 16:07:45', 'approved', 'approved', NULL, 'Proposal diterima', '2026-07-30 16:07:45', '2026-07-31 11:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `pmw_training_photos`
--

CREATE TABLE `pmw_training_photos` (
  `id` int UNSIGNED NOT NULL,
  `report_id` int UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pmw_training_reports`
--

CREATE TABLE `pmw_training_reports` (
  `id` int UNSIGNED NOT NULL,
  `proposal_id` int UNSIGNED NOT NULL,
  `period_id` int UNSIGNED NOT NULL,
  `summary` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_training_reports`
--

INSERT INTO `pmw_training_reports` (`id`, `proposal_id`, `period_id`, `summary`, `created_at`, `updated_at`) VALUES
(6, 31, 1, '', '2026-07-23 10:49:45', '2026-07-23 10:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `portal_announcements`
--

CREATE TABLE `portal_announcements` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'normal',
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `date` date DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `portal_announcements`
--

INSERT INTO `portal_announcements` (`id`, `title`, `slug`, `category`, `type`, `content`, `date`, `is_published`, `created_at`, `updated_at`) VALUES
(37, 'BUKU PANDUAN PMW 2026 SUDAH RILIS! CEK SEKARANG!!!', 'buku-panduan-pmw-2026-sudah-rilis-cek-sekarang', 'Penting', 'normal', '{\"ops\":[{\"insert\":\"Ingin proposalmu lolos pendanaan? Pelajari aturan mainnya di Panduan PMW terbaru yang bisa kamu akses melalui tautan berikut:\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"\\n\"},{\"attributes\":{\"link\":\"https://drive.google.com/file/d/16bp4WkypQ6xZ6VsdhbDDdGfFZTaTWozw/view?usp=sharing \"},\"insert\":\"https://drive.google.com/file/d/16bp4WkypQ6xZ6VsdhbDDdGfFZTaTWozw/view?usp=sharing \"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"}]}', '2026-05-04', 1, '2026-04-30 11:23:39', '2026-04-30 11:23:39'),
(38, 'Sosialisasi Program Mahasiswa Wirausaha 2026', 'sosialisasi-program-mahasiswa-wirausaha-2026', 'Jadwal', 'normal', '{\"ops\":[{\"insert\":\"Berikut detail jadwal sosialisasi PMW POLSRI 2026\\n\\nHari/Tanggal : Sabtu, 2 Mei 2026\\nPukul : 08.30 WIB s.d. 12.00 WIB\\nLink Zoom : \"},{\"attributes\":{\"link\":\"https://bit.ly/sosialisasipolsripmw2026\"},\"insert\":\"https://bit.ly/sosialisasipolsripmw2026\"},{\"insert\":\"\\nZoom Meeting ID : 988 1046 1505\\nPasscode : 030693\\n\"}]}', '2026-04-02', 1, '2026-04-30 11:59:53', '2026-04-30 11:59:53'),
(39, '📢 SIAP-SIAP PITCHING! FORMAT PPT SUDAH TERSEDIA', '-siapsiap-pitching-format-ppt-sudah-tersedia', 'Penting', 'normal', '{\"ops\":[{\"insert\":\"Persiapkan presentasimu dengan baik! Gunakan \"},{\"attributes\":{\"italic\":true},\"insert\":\"template\"},{\"insert\":\" resmi \"},{\"attributes\":{\"italic\":true},\"insert\":\"pitching deck\"},{\"insert\":\" yang dapat diunduh melalui tautan di bawah ini. Pastikan seluruh struktur materi mengikuti panduan yang tersedia.\\n\\n\"},{\"attributes\":{\"link\":\"https://drive.google.com/drive/folders/1okLsxINnJY6N0xRjqy9QtbiKTyYAU8Y4\"},\"insert\":\"https://drive.google.com/drive/folders/1okLsxINnJY6N0xRjqy9QtbiKTyYAU8Y4\"},{\"insert\":\"\\n\"}]}', '2026-05-04', 1, '2026-04-30 15:38:48', '2026-04-30 15:38:48'),
(40, 'PENDAFTARAN PROGRAM MAHASISWA WIRAUSAHA (PMW) 2026 RESMI DIBUKA!!!', 'pendaftaran-program-mahasiswa-wirausaha-pmw-2026-resmi-dibuka', 'Info', 'normal', '{\"ops\":[{\"insert\":\"PENDAFTARAN PROGRAM MAHASISWA WIRAUSAHA (PMW) 2026 RESMI DIBUKA!!!\\n\\nSEGERA CEK PANDUANNYA SEKARANG!!!\\n\"}]}', '2026-05-04', 1, '2026-05-04 07:37:37', '2026-05-04 07:37:37'),
(41, 'JANGAN TERLEWAT, PMW 2026 TELAH DIBUKA! BUTUH BANTUAN? HUBUNGI KAMI!', 'jangan-terlewat-pmw-2026-telah-dibuka-butuh-bantuan-hubungi-kami', 'Info', 'normal', '{\"ops\":[{\"insert\":\"MENEMUKAN KENDALA SAAT PENDAFTARAN PMW 2026?\"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"insert\":\"HUBUNGI KAMI DI NOMOR BERIKUT:\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"+62 895-6345-48603\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"\\nSEGERA DAFTARKAN DIRI KAMU DI PMW 2026!!!\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"}]}', '2026-05-12', 1, '2026-05-12 18:24:36', '2026-05-12 18:24:36'),
(43, 'Pemberitahuan Perbaikan Berkas Surat Pernyataan Ketua Pengusul', 'pemberitahuan-perbaikan-berkas-surat-pernyataan-ketua-pengusul', 'Penting', 'normal', '{\"ops\":[{\"insert\":\"Berdasarkan hasil verifikasi berkas, terdapat beberapa ketidaksesuaian pada dokumen \"},{\"attributes\":{\"bold\":true},\"insert\":\"Surat Pernyataan Ketua\"},{\"insert\":\".\\nMohon segera periksa kembali berkas Anda. Jika memerlukan perbaikan, silakan unduh format yang benar dan unggah ulang melalui tautan berikut:\\n\\n\"},{\"attributes\":{\"background\":\"#f0f4f9\",\"color\":\"#1f1f1f\",\"link\":\"https://drive.google.com/file/d/1GIoeAqtTr2JPrnP1uLyJ1s6aZpeGVOjb/view?usp=sharing\"},\"insert\":\"https://drive.google.com/file/d/1GIoeAqtTr2JPrnP1uLyJ1s6aZpeGVOjb/view?usp=sharing\"},{\"insert\":\"\\n\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"Catatan Penting:\"},{\"insert\":\"\\nPastikan data diri dan judul proposal sudah benar.\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"Surat wajib ditandatangani di atas meterai yang berlaku.\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"Simpan dan unggah kembali dalam format \"},{\"attributes\":{\"bold\":true},\"insert\":\"PDF\"},{\"insert\":\".\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"Harap segera melakukan perbaikan sebelum batas waktu seleksi administrasi ditutup agar tidak memengaruhi kelulusan tahap validasi.\\n\"}]}', '2026-05-24', 1, '2026-05-24 17:11:51', '2026-05-24 17:11:51'),
(44, 'Perpanjangan Waktu Pendaftaran PMW 2026 Hingga 31 Mei 2026', 'perpanjangan-waktu-pendaftaran-pmw-2026-hingga-31-mei-2026', 'Info', 'normal', '{\"ops\":[{\"insert\":\"Halo Calon Wirausaha Muda Polsri!\\nKabar gembira bagi kalian yang belum sempat mendaftar atau menyelesaikan berkas. Pendaftaran Berwirausaha Mahasiswa (PMW) 2026 resmi \"},{\"attributes\":{\"bold\":true},\"insert\":\"diperpanjang hingga tanggal 31 Mei 2026\"},{\"insert\":\".\\nManfaatkan kesempatan tambahan ini untuk mematangkan proposal bisnis kelompokmu. Segera lengkapi persyaratan dan submit sebelum batas waktu berakhir!\\n\"}]}', '2026-05-25', 1, '2026-05-25 19:21:28', '2026-05-25 19:21:28'),
(45, 'Pengumuman Jadwal Pelaksanaan Pitching Deck PMW Polsri 2026', 'pengumuman-jadwal-pelaksanaan-pitching-deck-pmw-polsri-2026', 'Info', 'normal', '{\"ops\":[{\"insert\":\"Halo Entrepreneur Muda Polsri!\\n\\nTahap yang dinanti-nanti telah tiba. Jadwal resmi untuk presentasi Pitching Deck PMW Polsri 2026 sudah dapat diakses. \\n\\nSilakan cek tanggal, waktu, serta urutan tampil tim kamu melalui file lampiran PDF di bagian bawah pengumuman ini. \\n\\n💡 Catatan Penting:\\n- Pastikan seluruh anggota tim hadir tepat waktu sesuai jadwal masing-masing.\\n- Siapkan file presentasi terbaik Anda untuk memukau para reviewer!\\n\\nJangan sampai kelewatan ya! Persiapkan tim kamu dari sekarang.\\n\"}]}', '2026-06-05', 1, '2026-06-06 08:23:45', '2026-06-06 08:23:45'),
(47, 'Form Usulan Tenant Bazar', 'form-usulan-tenant-bazar', 'Info', 'normal', '{\"ops\":[{\"insert\":\"Diberitahukan kepada seluruh mahasiswa aktif, Ormawa Politeknik Negeri Sriwijaya (Umum) yang tertarik  mengajukan kegiatan bazar atau sudah memiliki usaha ingin membuka bazar,\\nSilahkan download form ajuan ini, \\nDan ikuti aturan SOP yang tercantum didalamnya, Lalu kirim berkas hardcopy  lengkap tanda tangan persetujuan ke UPA Pengembangan Karir & Kewirausahaan.\\nTerimakasih\\n\"}]}', '2026-06-12', 1, '2026-06-13 11:47:22', '2026-06-13 11:47:22'),
(48, 'Pengumuman Hasil Seleksi Pitching Desk Program Mahasiswa Wirausaha (PMW) Politeknik Negeri Sriwijaya Tahun 2026', 'pengumuman-hasil-seleksi-pitching-desk-program-mahasiswa-wirausaha-pmw-politeknik-negeri-sriwijaya-tahun-2026', 'Penting', 'urgent', '{\"ops\":[{\"insert\":\"Poin Penting bagi Peserta yang Dinyatakan Lolos:\"},{\"attributes\":{\"header\":2},\"insert\":\"\\n\"},{\"insert\":\"Tahap Selanjutnya: Wajib mengikuti kegiatan seleksi wawancara dan penandatanganan perjanjian implementasi.\\n\\nPendampingan: Saat pelaksanaan tahap selanjutnya, peserta wajib didampingi oleh dosen pendamping masing-masing.\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"Perbaikan Dokumen: Peserta diharuskan menyampaikan dokumen perbaikan sesuai dengan masukan dan rekomendasi yang telah diberikan oleh tim reviewer (catatan penilai dapat dilihat pada lampiran dokumen).\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"Informasi lebih lanjut mengenai detail pembagian jadwal wawancara serta ketentuan pelaksanaan teknis dapat diakses secara berkala melalui tautan resmi SIMPMW Polsri.\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"\\nSelamat kepada seluruh tim usaha yang berhasil lolos, dan tetap semangat bagi tim yang belum mendapatkan pendanaan pada periode ini!\\n\"}]}', '2026-06-18', 1, '2026-06-18 11:09:20', '2026-06-18 11:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `portal_galleries`
--

CREATE TABLE `portal_galleries` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portal_galleries`
--

INSERT INTO `portal_galleries` (`id`, `title`, `category`, `description`, `image_url`, `is_published`, `sort_order`, `created_at`, `updated_at`) VALUES
(13, 'PENGANUGERAHAN JUARA PMW AWARD', 'Awarding', 'Momen penganugerahan juara PMW Award untuk para inovator muda berbakat. Kebanggaan luar biasa melihat ide-ide bisnis brilian mahasiswa Politeknik Negeri Sriwijaya diapresiasi secara resmi.', 'uploads/gallery/1777516710_3b669b968cc6956ba9d3.jpeg', 1, 0, '2026-04-30 09:38:30', '2026-04-30 09:38:30'),
(14, 'APRESIASI DAN SELEBRASI INOVATOR MUDA PMW AWARD', 'Awarding', 'Foto bersama seluruh pemenang dan penyelenggara dalam malam penganugerahan PMW Award di Politeknik Negeri Sriwijaya', 'uploads/gallery/1777516830_e7ccb929d1b13c949121.jpeg', 1, 0, '2026-04-30 09:40:30', '2026-04-30 09:40:30'),
(15, 'COFFEE SOFT', 'Produk Binaan', 'minuman Ready To Drink karya mahasiswa POLSRI, Coffee Soft menawarkan perpaduan unik kopi premium dan varian non-kopi yang diracik dengan sepenuh hati.', 'uploads/gallery/1777516875_c42b26bb9e3f9f8c7076.jpeg', 1, 0, '2026-04-30 09:41:15', '2026-04-30 09:41:15'),
(16, 'CREME DE LA COOKIE', 'Produk Binaan', 'Creme De La Cookie yang hadir dengan berbagai varian rasa favorit seperti chocolate, green tea, dan red velvet', 'uploads/gallery/1777516942_53af5573f6e795c4f34e.jpeg', 1, 0, '2026-04-30 09:42:22', '2026-04-30 09:42:22'),
(17, 'DIMSUM RECEH PLG', 'Produk Binaan', 'Nikmati kelezatan Dimsum Receh PLG yang menyajikan cita rasa autentik dengan harga yang sangat terjangkau bagi semua kalangan.', 'uploads/gallery/1777516979_86f39aa8b1e09d3e0a1a.jpeg', 1, 0, '2026-04-30 09:42:59', '2026-04-30 09:42:59'),
(18, 'E-BAGS', 'Produk Binaan', 'koleksi eksklusif E-Bags, tas tangan eco-friendly yang terbuat dari anyaman eceng gondok alami.', 'uploads/gallery/1777517009_e31b9bf1e7887ecb60ef.jpeg', 1, 0, '2026-04-30 09:43:29', '2026-04-30 09:43:29'),
(19, 'MIE AYAM WILDAN', 'Produk Binaan', 'Mie Ayam Wildan yang hadir dengan tekstur mie kenyal, potongan ayam empuk, dan kuah kaldu yang kaya rasa.', 'uploads/gallery/1777517045_058c932dc18858dae019.jpeg', 1, 0, '2026-04-30 09:44:05', '2026-04-30 09:44:05'),
(20, 'SAMBALLAN', 'Produk Binaan', 'setiap meja makan dengan Samballan, sambal kemasan praktis yang tersedia dalam berbagai varian seperti ayam suir, cumi asin, dan teri.', 'uploads/gallery/1777517083_a783db2cdb0758d17414.jpeg', 1, 0, '2026-04-30 09:44:43', '2026-04-30 09:44:43'),
(21, 'Valen Center', 'Produk Binaan', 'pusat layanan terintegrasi untuk kebutuhan servis, jual, serta beli berbagai perangkat elektronik seperti laptop, komputer, smartphone, hingga PlayStation', 'uploads/gallery/1777517115_6e811e82b50b12d99333.jpeg', 1, 0, '2026-04-30 09:45:15', '2026-04-30 09:45:15'),
(22, 'WASH UP FINEST', 'Produk Binaan', 'solusi profesional untuk jasa cuci dan perbaikan sepatu yang telah dipercaya sejak tahun 2022.', 'uploads/gallery/1777517167_a9f4affd6c41fefa08ff.jpeg', 1, 0, '2026-04-30 09:46:07', '2026-04-30 09:46:07'),
(23, 'KERIPIK PISANG YAPPIES', 'Produk Binaan', 'menghadirkan perpaduan sempurna antara tekstur renyah dan aneka pilihan rasa lumer seperti Coklat, Tiramisu, hingga Green Tea.', 'uploads/gallery/1777517204_ab5fe082d01d9a8b9b85.jpeg', 1, 0, '2026-04-30 09:46:44', '2026-04-30 09:46:44'),
(24, 'SANDWICHIN', 'Produk Binaan', 'roti tawar premium yang diisi dengan berbagai pilihan daging olahan lezat dan sayuran segar berkualitas', 'uploads/gallery/1777517232_6caf4368abcbcd0bfd8f.jpeg', 1, 0, '2026-04-30 09:47:12', '2026-04-30 12:40:35'),
(26, 'PEMPEK HAFIZA', 'Produk Binaan', 'menyajikan berbagai varian pempek berkualitas dengan tekstur lembut dan rasa ikan yang terasa. Lengkap dengan kuah cuko yang hitam, kental, dan pedas mantap', 'uploads/gallery/1777528647_7c1a47271609a94245b5.jpg', 1, 0, '2026-04-30 12:57:27', '2026-04-30 13:05:18'),
(27, 'Batik Cindo', 'Produk Binaan', 'Batik Cindo menghadirkan ragam kain khas mulai dari jumputan, batik tulis, hingga batik cap yang menawan. Koleksi kami juga mencakup kerajinan unik seperti tas anyaman rotan yang dipadukan dengan sentuhan motif batik autentik.', 'uploads/gallery/1777528929_4578d26de50c8a066ccb.png', 1, 0, '2026-04-30 13:02:09', '2026-04-30 13:02:09'),
(28, 'BAKSO BAKAR BONTET', 'Produk Binaan', 'bakso bakar premium yang disajikan dengan siraman saus dan mayonais yang melimpah.', 'uploads/gallery/1777531853_4f87e662be8412361462.png', 1, 0, '2026-04-30 13:50:53', '2026-04-30 13:50:53'),
(30, 'RECEH SHOP 18', 'Produk Binaan', '', 'uploads/gallery/1777532881_ed8e029d48b729c3ae93.png', 1, 0, '2026-04-30 14:08:01', '2026-04-30 14:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `push_subscriptions`
--

CREATE TABLE `push_subscriptions` (
  `id` int UNSIGNED NOT NULL,
  `endpoint` text COLLATE utf8mb4_general_ci NOT NULL,
  `p256dh` text COLLATE utf8mb4_general_ci,
  `auth` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `push_subscriptions`
--

INSERT INTO `push_subscriptions` (`id`, `endpoint`, `p256dh`, `auth`, `created_at`, `updated_at`) VALUES
(1, 'https://fcm.googleapis.com/fcm/send/dHEN-JXPKJw:APA91bExzA1toSVw_i1qI8Fe4Lq-Lkgb1CuaFHhlPUpT16bGAaQLCJE26s_Rl-BLgkuDfKiy-T1rHPD0ikhmRi7yb3FKzzNRRUQspw2vizhVI74yxrs3gsVmJYlEz1mofgVrNt_k4fE0', 'BGbMgAAfHyscd6S41UCqb-qhk_7i7ABvNhlZc8IFIClBaobVJ29t9Xh9Y6SVURka7dOKvRj8boJ5mELza3HTj30', 'hiNkfmeQruJu-OkoHdktfA', '2026-04-20 17:20:49', '2026-04-20 17:20:49'),
(2, 'https://fcm.googleapis.com/fcm/send/dw_828dMdh4:APA91bG-3OisOxBlLu9UOTqZs1yyt2LisqhDEZlULr9ii6o0Nep8jecSRp8Dv5Ef4YPaeN4LkQQUa7jLUo9kAry3jq1sJlSwNmhTR2ddvTJGj0fBCWhEKH789SUQIU1xhKTyi-N4OsWE', 'BOuvLSCOoy2pihjbz_qf4piqOYyhvMq9W5PjO_alidVPTsW-FL5fowuw9ut9Zi-alXiSfV8JYF6BRmo9Bc3RIXw', 'CtdWkFIO2unMj8JXn1l3mg', '2026-04-30 14:34:41', '2026-04-30 14:34:41'),
(4, 'https://fcm.googleapis.com/fcm/send/dErTiF6D_kg:APA91bEPyBkd7nFaBhHKjM38StXx_SIGPUzqfaI1m9cr_Yya8J-LVe4uzhGVNa48tp5rXY0t6OV5p_90vPoiPsbrx1UG7xbXv0PfJ9UVk50FYX1AXu46OynxNYFFasFuq2Oy_CeL_GJs', 'BLQfYFEE9tzbhbXp96X4pTX57hLHJ5lnmK_DloZERN4s8hsZZr-aaE6mPjBNmWLzxi1u75ULMSgzy3svSeeWAzo', 'Sjy2OqpEqSnaaoqEwOYkBQ', '2026-05-02 10:22:36', '2026-05-02 10:22:36'),
(5, 'https://wns2-pn1p.notify.windows.com/w/?token=BQYAAACegq5EZaKYjpIqftorXFKMCf1AnCasJROQNhkkYfknyRhg6mcYsR4QEC2KhFiPboku%2b%2fx9%2fjrAMXLdTs83oLMaqDHWNF512fOOWuwk37YJCGiZYY4674klB1TwEt0OtcQ248Jz4u0zqZmMti89bY%2bUqnJhk48sfy3gGXTWoGwhCBRwqteJ8MOJ3AlMBGhKFWVlEvtQmaFZxnTnCYkQj4fsTd7s6xnR2AWhYwbQLOio7v1GT%2fGtYvUQ4b%2fZ%2fAcXb26YhE%2fAgLHFqjtb1fTBt%2f%2fHwURNvvzMQWL6oYHLNp5ja7ApXWoJIwDpVOohIHrrBZLNTi1EBSDnsh%2bJ1n13krz5', 'BOHPRqPLHgPSHPUYsoE9XBplepwL5d2W7Hb4TUT15EdNiHi-NNlwp9wRofziy151i3DbBzQt8TsgYV67HMpNCFs', 'T0vW6z4y854TPnos5_pa4A', '2026-05-02 10:22:40', '2026-05-02 10:22:40'),
(7, 'https://fcm.googleapis.com/fcm/send/cOzX6FJ6JV4:APA91bHO5HZ250TqjSALir8B9l3ZYlbw5bUGWA8zSsKEcn89lQRTkJZWJ34KcxHWIZmogh8nz0zJY0t0pm9mrYHhE_gQrddQLhisq76W3PMa0WcZuPKhEhnu2W_C8t_HAPznbFE8qwzG', 'BOFHkkZLk9uGcdFXOMdT6x4Cu0qG-DEmmZJ9Qgd7KxaGdx5vpXGTqLRdM3aPQ9p57RZMFczBgcRuzvA98UphtBw', 'acsA6EG99ImopRudWEM9Bg', '2026-05-11 15:58:11', '2026-05-11 15:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `type` varchar(31) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 1, '2026-08-03 21:57:48', '2026-04-14 04:39:01', '2026-04-14 04:39:01', NULL),
(6, 'dosen19jutalapanganpekerjaan', NULL, NULL, 1, '2026-04-21 13:58:54', '2026-04-14 18:36:14', '2026-04-30 02:44:53', '2026-04-30 02:44:53'),
(9, 'suzy\'dmentor', NULL, NULL, 1, '2026-04-30 01:41:13', '2026-04-15 05:47:34', '2026-04-30 02:44:50', '2026-04-30 02:44:50'),
(10, 'apriyansah1678', NULL, NULL, 1, '2026-04-29 23:20:06', '2026-04-15 06:32:14', '2026-04-30 02:44:48', '2026-04-30 02:44:48'),
(11, 'mahasiswa1024', NULL, NULL, 1, '2026-04-15 07:00:10', '2026-04-15 06:40:55', '2026-04-15 07:01:32', '2026-04-15 07:01:32'),
(12, 'master7876', NULL, NULL, 1, '2026-04-15 07:03:01', '2026-04-15 07:02:56', '2026-04-17 14:32:02', '2026-04-17 14:32:02'),
(13, 'gaming1248', NULL, NULL, 1, '2026-04-15 10:43:51', '2026-04-15 10:43:37', '2026-04-17 14:33:52', '2026-04-17 14:33:52'),
(14, 'student6789', NULL, NULL, 1, '2026-04-15 10:50:12', '2026-04-15 10:47:21', '2026-04-17 14:33:48', '2026-04-17 14:33:48'),
(15, 'student8777', NULL, NULL, 1, '2026-04-15 10:55:47', '2026-04-15 10:55:47', '2026-04-17 14:32:59', '2026-04-17 14:32:59'),
(17, 'registration6555', NULL, NULL, 0, '2026-04-15 11:02:33', '2026-04-15 11:02:32', '2026-04-17 14:27:59', '2026-04-17 14:27:59'),
(18, 'bento1292', NULL, NULL, 0, '2026-04-15 11:04:30', '2026-04-15 11:04:26', '2026-04-17 14:27:44', '2026-04-17 14:27:44'),
(19, 'doesntneedu', NULL, NULL, 1, '2026-04-30 01:12:08', '2026-04-15 12:57:25', '2026-04-30 02:44:45', '2026-04-30 02:44:45'),
(20, 'saputra2303', NULL, NULL, 1, '2026-04-21 14:21:35', '2026-04-17 10:06:31', '2026-04-30 02:44:42', '2026-04-30 02:44:42'),
(21, 'smithd\'mentor', NULL, NULL, 1, '2026-04-19 15:09:23', '2026-04-17 15:14:05', '2026-04-30 02:44:39', '2026-04-30 02:44:39'),
(22, 'justareviewer', NULL, NULL, 1, '2026-04-21 13:26:07', '2026-04-18 16:35:26', '2026-04-30 02:44:36', '2026-04-30 02:44:36'),
(23, 'sukijat208', NULL, NULL, 1, '2026-04-19 15:57:12', '2026-04-19 15:56:56', '2026-04-30 02:44:33', '2026-04-30 02:44:33'),
(24, 'sumbul1298', NULL, NULL, 0, '2026-04-19 17:55:51', '2026-04-19 16:20:57', '2026-04-30 02:44:30', '2026-04-30 02:44:30'),
(25, 'zalali892', NULL, NULL, 1, NULL, '2026-04-19 17:55:34', '2026-04-30 02:44:05', '2026-04-30 02:44:05'),
(26, 'user5918', NULL, NULL, 0, '2026-04-29 15:50:58', '2026-04-28 15:55:48', '2026-04-30 02:44:02', '2026-04-30 02:44:02'),
(27, 'krabs2819', NULL, NULL, 0, '2026-04-29 16:22:08', '2026-04-29 16:00:13', '2026-04-30 02:43:59', '2026-04-30 02:43:59'),
(28, 'wikalodon1601', NULL, NULL, 0, '2026-04-30 01:31:09', '2026-04-29 20:19:55', '2026-04-30 02:43:56', '2026-04-30 02:43:56'),
(29, 'cimolodon1602', NULL, NULL, 0, '2026-04-30 00:53:27', '2026-04-29 20:29:14', '2026-04-30 02:43:54', '2026-04-30 02:43:54'),
(30, 'lutfi4124', NULL, NULL, 1, '2026-04-30 11:56:59', '2026-04-30 09:18:04', '2026-04-30 11:57:13', '2026-04-30 11:57:13'),
(31, 'dosen101', NULL, NULL, 1, '2026-04-30 11:58:42', '2026-04-30 10:00:10', '2026-05-03 18:34:10', '2026-05-03 18:34:10'),
(32, 'simpmw@polsri.ac.id', NULL, NULL, 1, '2026-04-30 11:58:27', '2026-04-30 10:01:20', '2026-07-23 10:16:18', '2026-07-23 10:16:18'),
(33, 'reta7987', NULL, NULL, 0, '2026-04-30 11:44:53', '2026-04-30 10:09:07', '2026-04-30 11:58:18', '2026-04-30 11:58:18'),
(34, 'lutfi7198', NULL, NULL, 0, '2026-04-30 11:57:34', '2026-04-30 11:57:33', '2026-05-03 18:34:18', '2026-05-03 18:34:18'),
(35, 'cahyono8478', NULL, NULL, 0, '2026-05-01 21:06:43', '2026-05-01 20:52:01', '2026-05-03 18:34:05', '2026-05-03 18:34:05'),
(36, 'santoso4765', NULL, NULL, 0, '2026-05-01 21:35:30', '2026-05-01 21:27:52', '2026-05-03 18:34:02', '2026-05-03 18:34:02'),
(37, 'kurniawan5678', NULL, NULL, 0, '2026-05-02 10:34:31', '2026-05-02 10:07:48', '2026-05-03 18:33:59', '2026-05-03 18:33:59'),
(38, 'adinda2696', NULL, NULL, 0, '2026-05-02 10:25:38', '2026-05-02 10:25:37', '2026-05-03 18:33:54', '2026-05-03 18:33:54'),
(39, 'dwi3657', NULL, NULL, 0, '2026-05-02 10:28:55', '2026-05-02 10:28:55', '2026-05-03 18:33:52', '2026-05-03 18:33:52'),
(40, 'ramadhan2909', NULL, NULL, 0, '2026-05-03 05:49:12', '2026-05-02 10:52:22', '2026-05-03 18:33:48', '2026-05-03 18:33:48'),
(41, 'mutiara2132', NULL, NULL, 0, '2026-05-02 20:20:52', '2026-05-02 17:48:48', '2026-05-03 18:33:45', '2026-05-03 18:33:45'),
(42, 'roihan0690', NULL, NULL, 1, '2026-07-31 13:58:50', '2026-05-03 22:51:29', '2026-05-11 08:33:24', NULL),
(43, 'alya2654', NULL, NULL, 1, '2026-05-06 23:20:47', '2026-05-04 10:56:05', '2026-05-11 08:33:28', NULL),
(44, 'natasya2651', NULL, NULL, 1, '2026-05-04 21:36:14', '2026-05-04 21:36:13', '2026-05-11 08:33:31', NULL),
(47, 'mutiara1232', NULL, NULL, 1, '2026-05-05 15:33:00', '2026-05-05 15:32:39', '2026-05-11 08:33:34', NULL),
(48, 'wijaksonoakuntansi1092', NULL, NULL, 1, '2026-06-16 18:59:23', '2026-05-05 19:12:04', '2026-05-11 08:33:38', NULL),
(49, 'wayan0407', NULL, NULL, 1, '2026-05-05 20:10:03', '2026-05-05 20:09:23', '2026-05-11 08:33:42', NULL),
(50, 'meidiansyah3121', NULL, NULL, 1, '2026-07-02 18:10:09', '2026-05-06 16:29:24', '2026-05-11 08:33:46', NULL),
(51, 'safitri2267', NULL, NULL, 1, '2026-06-08 14:48:35', '2026-05-07 09:51:19', '2026-05-11 08:33:56', NULL),
(52, 'prian2179', NULL, NULL, 1, '2026-05-07 17:56:01', '2026-05-07 17:55:10', '2026-05-11 08:34:11', NULL),
(53, 'olivia3585', NULL, NULL, 1, '2026-05-07 18:52:51', '2026-05-07 18:52:50', '2026-05-11 08:34:06', NULL),
(54, 'fathurrahman0471', NULL, NULL, 1, '2026-05-08 08:46:20', '2026-05-08 08:46:19', '2026-05-11 08:34:01', NULL),
(55, 'irawan3143', NULL, NULL, 1, '2026-08-03 21:59:09', '2026-05-08 18:44:43', '2026-05-11 08:33:18', NULL),
(56, 'audrey1252', NULL, NULL, 1, '2026-07-31 09:43:09', '2026-05-10 08:46:54', '2026-05-11 08:33:13', NULL),
(57, 'putri2755', NULL, NULL, 1, '2026-07-30 12:10:16', '2026-05-10 15:08:24', '2026-05-11 08:33:09', NULL),
(58, 'shafira2757', NULL, NULL, 1, '2026-05-12 14:58:53', '2026-05-10 23:05:13', '2026-05-11 08:33:04', NULL),
(59, 'user9922', NULL, NULL, 1, '2026-05-11 08:42:13', '2026-05-11 08:42:12', '2026-05-11 08:42:46', '2026-05-11 08:42:46'),
(60, 'mantaps8766', NULL, NULL, 1, '2026-05-11 08:54:11', '2026-05-11 08:47:29', '2026-05-11 08:57:54', '2026-05-11 08:57:54'),
(61, 'lagi8555', NULL, NULL, 1, '2026-05-11 08:55:11', '2026-05-11 08:55:01', '2026-05-11 08:56:45', '2026-05-11 08:56:45'),
(62, 'test8989', NULL, NULL, 1, '2026-05-11 08:57:40', '2026-05-11 08:57:39', '2026-05-11 08:57:51', '2026-05-11 08:57:51'),
(63, 'kmaasdasd5722', NULL, NULL, 1, '2026-05-11 09:04:26', '2026-05-11 09:00:14', '2026-05-11 09:04:39', '2026-05-11 09:04:39'),
(64, 'ardian2244', NULL, NULL, 1, '2026-05-11 16:29:01', '2026-05-11 16:03:36', '2026-05-11 16:03:36', NULL),
(65, 'febrian2232', NULL, NULL, 1, '2026-05-11 21:49:39', '2026-05-11 16:04:19', '2026-05-11 16:04:19', NULL),
(66, 'ubaidillah2237', NULL, NULL, 1, '2026-05-12 17:35:20', '2026-05-11 21:47:16', '2026-05-11 21:47:16', NULL),
(67, 'juliansyah0419', NULL, NULL, 1, '2026-05-13 08:59:02', '2026-05-13 08:56:11', '2026-05-13 08:56:11', NULL),
(68, 'anisa1286', NULL, NULL, 1, '2026-05-13 14:04:17', '2026-05-13 14:04:17', '2026-05-13 14:04:17', NULL),
(69, 'marcelino1232', NULL, NULL, 1, '2026-05-25 08:59:52', '2026-05-13 21:06:57', '2026-05-13 21:06:57', NULL),
(70, 'belinda2557', NULL, NULL, 1, '2026-07-16 13:56:23', '2026-05-14 14:09:54', '2026-05-14 14:09:54', NULL),
(71, 'triyadi2085', NULL, NULL, 1, '2026-07-01 09:10:03', '2026-05-14 20:07:38', '2026-05-14 20:07:38', NULL),
(72, 'damayanti3335', NULL, NULL, 1, '2026-05-16 09:47:59', '2026-05-16 09:35:43', '2026-05-16 09:35:43', NULL),
(73, 'wati3629', NULL, NULL, 1, '2026-08-01 09:54:16', '2026-05-16 10:08:37', '2026-05-16 10:08:37', NULL),
(74, 'anastya3077', NULL, NULL, 1, '2026-06-07 18:53:48', '2026-05-17 12:39:28', '2026-05-17 12:39:28', NULL),
(75, 'oktavia1226', NULL, NULL, 1, '2026-06-06 12:53:09', '2026-05-18 15:50:14', '2026-05-18 15:50:14', NULL),
(76, 'ramadhani3051', NULL, NULL, 1, '2026-06-06 18:59:10', '2026-05-19 09:39:39', '2026-05-19 09:39:39', NULL),
(77, 'mawla3325', NULL, NULL, 1, '2026-06-18 15:41:15', '2026-05-19 10:46:34', '2026-05-19 10:46:34', NULL),
(78, 'abror3330', NULL, NULL, 1, '2026-06-07 21:22:44', '2026-05-19 11:24:58', '2026-05-19 11:24:58', NULL),
(79, 'akbar3337', NULL, NULL, 1, '2026-07-04 16:55:07', '2026-05-19 11:25:20', '2026-05-19 11:25:20', NULL),
(80, 'putra3323', NULL, NULL, 1, '2026-06-06 16:33:35', '2026-05-19 11:26:43', '2026-05-19 11:26:43', NULL),
(81, 'administrator4455', NULL, NULL, 1, '2026-06-04 11:32:33', '2026-05-19 20:59:29', '2026-06-04 11:32:55', '2026-06-04 11:32:55'),
(82, 'jayadi1829', NULL, NULL, 1, '2026-05-20 01:35:44', '2026-05-20 01:21:58', '2026-05-20 01:21:58', NULL),
(83, 'kholilah3371', NULL, NULL, 1, '2026-06-10 12:32:35', '2026-05-20 12:59:15', '2026-05-20 12:59:15', NULL),
(84, 'hadil3326', NULL, NULL, 1, '2026-06-01 15:37:40', '2026-05-20 14:04:10', '2026-05-20 14:04:10', NULL),
(85, 'alya2909', NULL, NULL, 1, '2026-08-02 21:22:21', '2026-05-20 15:22:09', '2026-05-20 15:22:09', NULL),
(86, 'dwi3114', NULL, NULL, 1, '2026-05-20 18:58:56', '2026-05-20 18:56:37', '2026-05-20 18:56:37', NULL),
(87, 'claudia2452', NULL, NULL, 1, '2026-07-30 12:06:01', '2026-05-21 12:55:58', '2026-05-21 12:55:58', NULL),
(88, 'indah3057', NULL, NULL, 1, '2026-05-23 14:05:25', '2026-05-21 15:43:00', '2026-05-21 15:43:00', NULL),
(89, 'devani1260', NULL, NULL, 1, '2026-07-30 16:39:02', '2026-05-21 16:09:43', '2026-05-21 16:09:43', NULL),
(90, 'khairunisa3334', NULL, NULL, 1, '2026-06-18 13:11:09', '2026-05-21 18:19:24', '2026-05-21 18:19:24', NULL),
(91, 'slavina2884', NULL, NULL, 1, '2026-06-07 10:59:40', '2026-05-22 07:52:38', '2026-05-22 07:52:38', NULL),
(92, 'agustina2873', NULL, NULL, 1, '2026-06-07 10:33:26', '2026-05-22 08:02:17', '2026-05-22 08:02:17', NULL),
(93, 'nabil3332', NULL, NULL, 1, '2026-06-07 21:25:37', '2026-05-23 10:42:51', '2026-05-23 10:42:51', NULL),
(94, 'faiqriyyah3336', NULL, NULL, 1, '2026-06-08 11:32:50', '2026-05-23 10:57:23', '2026-05-23 10:57:23', NULL),
(95, 'putri3066', NULL, NULL, 1, '2026-06-25 19:48:27', '2026-05-23 11:51:45', '2026-05-23 11:51:45', NULL),
(96, 'dinni2363', NULL, NULL, 1, '2026-07-30 10:37:49', '2026-05-23 12:32:08', '2026-05-23 12:32:08', NULL),
(97, 'tri3371', NULL, NULL, 1, '2026-05-23 23:29:40', '2026-05-23 21:58:09', '2026-05-23 21:58:09', NULL),
(98, 'hilwatullisah2883', NULL, NULL, 1, '2026-06-07 10:38:06', '2026-05-23 22:55:59', '2026-05-23 22:55:59', NULL),
(99, 'risqi2726', NULL, NULL, 1, '2026-06-08 10:50:07', '2026-05-23 23:43:28', '2026-05-23 23:43:28', NULL),
(100, 'ridho3056', NULL, NULL, 1, '2026-06-07 07:28:56', '2026-05-24 11:57:30', '2026-05-24 11:57:30', NULL),
(101, 'claudya3068', NULL, NULL, 1, '2026-06-07 08:25:00', '2026-05-24 12:49:35', '2026-05-24 12:49:35', NULL),
(102, 'rafifah3059', NULL, NULL, 1, '2026-06-10 09:17:18', '2026-05-24 13:21:30', '2026-05-24 13:21:30', NULL),
(103, 'zeb3686', NULL, NULL, 1, '2026-06-07 11:23:59', '2026-05-24 17:40:57', '2026-05-24 17:40:57', NULL),
(104, 'amelia1274', NULL, NULL, 1, '2026-06-07 00:42:13', '2026-05-24 19:03:56', '2026-05-24 19:03:56', NULL),
(105, 'umiarti2886', NULL, NULL, 1, '2026-06-07 10:30:35', '2026-05-24 19:28:17', '2026-05-24 19:28:17', NULL),
(106, 'fathir2533', NULL, NULL, 1, '2026-07-29 23:54:00', '2026-05-24 21:24:12', '2026-05-24 21:24:12', NULL),
(107, 'rahmadhani3637', NULL, NULL, 1, '2026-06-07 13:48:59', '2026-05-24 21:25:32', '2026-05-24 21:25:32', NULL),
(108, 'test1111', NULL, NULL, 1, '2026-06-04 13:08:42', '2026-05-25 09:49:52', '2026-06-04 13:17:16', '2026-06-04 13:17:16'),
(109, 'rizky2647', NULL, NULL, 1, '2026-07-30 16:16:56', '2026-05-25 11:04:51', '2026-05-25 11:04:51', NULL),
(110, 'fajar3329', NULL, NULL, 1, '2026-06-09 17:59:51', '2026-05-25 13:28:13', '2026-05-25 13:28:13', NULL),
(111, 'geraldi2952', NULL, NULL, 1, '2026-07-30 14:24:02', '2026-05-25 21:19:46', '2026-05-25 21:19:46', NULL),
(112, 'rizky1952', NULL, NULL, 1, '2026-05-26 09:41:16', '2026-05-26 09:39:07', '2026-05-26 09:39:07', NULL),
(113, 'febriansyah3078', NULL, NULL, 1, '2026-07-30 19:19:03', '2026-05-26 16:49:16', '2026-05-26 16:49:16', NULL),
(114, 'reviewer@polsri.ac.id', NULL, NULL, 1, NULL, '2026-06-01 14:42:27', '2026-07-21 08:52:22', '2026-07-21 08:52:22'),
(115, 'Reviewer Polsri', NULL, NULL, 1, '2026-06-03 11:12:35', '2026-06-01 14:45:14', '2026-06-01 14:45:14', NULL),
(116, 'nila381', NULL, NULL, 1, '2026-06-03 18:04:41', '2026-06-02 11:22:38', '2026-06-04 11:21:26', '2026-06-04 11:21:26'),
(117, 'jurione', NULL, NULL, 1, '2026-06-04 13:02:31', '2026-06-04 11:36:18', '2026-06-04 13:17:31', '2026-06-04 13:17:31'),
(118, 'juritwo', NULL, NULL, 1, '2026-06-04 12:10:07', '2026-06-04 11:37:30', '2026-06-04 13:17:50', '2026-06-04 13:17:50'),
(119, 'jurithree', NULL, NULL, 1, '2026-06-04 12:11:30', '2026-06-04 11:41:18', '2026-06-04 13:17:44', '2026-06-04 13:17:44'),
(120, 'jurifour', NULL, NULL, 1, '2026-06-04 12:11:56', '2026-06-04 11:42:53', '2026-06-04 13:17:40', '2026-06-04 13:17:40'),
(121, 'jurifive', NULL, NULL, 1, '2026-06-04 12:55:55', '2026-06-04 11:43:42', '2026-06-04 13:17:36', '2026-06-04 13:17:36'),
(122, 'kegelapan1922', NULL, NULL, 1, '2026-06-04 12:58:06', '2026-06-04 11:45:19', '2026-06-04 13:17:00', '2026-06-04 13:17:00'),
(123, 'penilai111', NULL, NULL, 1, '2026-06-06 18:29:52', '2026-06-04 15:46:57', '2026-06-04 15:46:57', NULL),
(124, 'penilai222', NULL, NULL, 1, '2026-06-06 15:00:34', '2026-06-04 15:47:57', '2026-06-04 15:47:57', NULL),
(125, 'Penilai333', NULL, NULL, 1, '2026-06-07 15:08:28', '2026-06-04 15:48:44', '2026-06-04 15:48:44', NULL),
(126, 'Penilai444', NULL, NULL, 1, '2026-06-06 15:21:39', '2026-06-04 15:49:51', '2026-06-04 15:49:51', NULL),
(127, 'Penilai555', NULL, NULL, 1, '2026-06-07 15:22:23', '2026-06-04 15:50:38', '2026-06-04 15:50:38', NULL),
(128, 'Penilai666', NULL, NULL, 1, '2026-06-18 14:20:51', '2026-06-04 15:54:21', '2026-06-04 15:54:21', NULL),
(129, 'rifqi2885', NULL, NULL, 1, '2026-06-07 14:51:06', '2026-06-05 12:09:35', '2026-06-05 12:09:35', NULL),
(130, 'Penilai', NULL, NULL, 1, '2026-06-09 15:03:07', '2026-06-08 17:48:55', '2026-06-08 17:48:55', NULL),
(131, 'Dr. Paisal, S.E., M.Si.', NULL, NULL, 1, '2026-08-03 22:42:34', '2026-07-19 19:10:45', '2026-07-19 19:10:45', NULL),
(132, 'Zurohaina, S.T., M.T.', NULL, NULL, 1, '2026-07-30 14:23:20', '2026-07-19 19:14:40', '2026-07-19 19:14:40', NULL),
(133, 'Indah Pratiwi, S.ST., M.T.', NULL, NULL, 1, '2026-07-30 14:57:40', '2026-07-19 19:18:24', '2026-07-19 19:18:24', NULL),
(134, 'Wahyu Triaji Rahadianto', NULL, NULL, 1, '2026-07-30 21:33:01', '2026-07-19 19:20:43', '2026-07-19 19:20:43', NULL),
(135, 'Heni Yuvita, M.Si.', NULL, NULL, 1, '2026-07-30 16:00:07', '2026-07-19 19:21:57', '2026-07-19 19:21:57', NULL),
(136, 'Dwi Riana, S.E., M.A.B.', NULL, NULL, 1, '2026-07-30 15:40:19', '2026-07-19 19:23:04', '2026-07-19 19:23:04', NULL),
(137, 'Leni Sabrina, S.P., M.Si.', NULL, NULL, 1, '2026-07-30 13:31:40', '2026-07-19 19:24:25', '2026-07-19 19:24:25', NULL),
(138, 'Mutiara Putri, S.ST., M.Tr.T.', NULL, NULL, 1, '2026-07-31 05:00:26', '2026-07-19 19:25:58', '2026-07-19 19:25:58', NULL),
(139, 'Dika Setiagraha, S.E., M.M.', NULL, NULL, 1, '2026-07-30 16:40:27', '2026-07-19 19:26:58', '2026-07-19 19:26:58', NULL),
(140, 'Imas Permatasari, S.E., M.Si.', NULL, NULL, 1, NULL, '2026-07-19 19:28:26', '2026-07-19 19:28:26', NULL),
(141, 'Mas Aziz', NULL, NULL, 1, '2026-07-23 10:27:12', '2026-07-23 10:19:02', '2026-07-23 10:19:02', NULL),
(142, 'Asep Somanhudi', NULL, NULL, 1, NULL, '2026-07-23 10:21:27', '2026-07-23 10:21:27', NULL),
(143, 'Rizki Rantau', NULL, NULL, 1, '2026-07-23 10:33:26', '2026-07-23 10:22:29', '2026-07-23 10:22:29', NULL),
(144, 'eko', NULL, NULL, 1, NULL, '2026-07-23 10:23:19', '2026-07-23 10:23:19', NULL),
(145, 'Lola', NULL, NULL, 1, NULL, '2026-07-23 10:24:06', '2026-07-23 10:24:06', NULL),
(146, 'Ikbal', NULL, NULL, 1, NULL, '2026-07-23 10:24:49', '2026-07-23 10:24:49', NULL),
(147, 'anggi', NULL, NULL, 1, NULL, '2026-07-23 10:26:49', '2026-07-23 10:26:49', NULL),
(148, 'testing', NULL, NULL, 1, NULL, '2026-07-23 10:29:08', '2026-07-23 10:29:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement_attachments`
--
ALTER TABLE `announcement_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_attachments_announcement_id_foreign` (`announcement_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cms_content`
--
ALTER TABLE `cms_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`),
  ADD KEY `group` (`group`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pmw_activity_logbooks`
--
ALTER TABLE `pmw_activity_logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_activity_logbooks_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `pmw_activity_logbook_photos`
--
ALTER TABLE `pmw_activity_logbook_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_activity_logbook_photos_logbook_id_foreign` (`logbook_id`);

--
-- Indexes for table `pmw_activity_schedules`
--
ALTER TABLE `pmw_activity_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_activity_schedules_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_activity_schedules_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_announcements`
--
ALTER TABLE `pmw_announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `period_id_phase_number` (`period_id`,`phase_number`);

--
-- Indexes for table `pmw_announcement_items`
--
ALTER TABLE `pmw_announcement_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcement_id_sort_order` (`announcement_id`,`sort_order`);

--
-- Indexes for table `pmw_assessments`
--
ALTER TABLE `pmw_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_assessments_document_id_foreign` (`document_id`),
  ADD KEY `pmw_assessments_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `pmw_awards`
--
ALTER TABLE `pmw_awards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_awards_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_awards_category_id_foreign` (`category_id`);

--
-- Indexes for table `pmw_award_categories`
--
ALTER TABLE `pmw_award_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_award_categories_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_bank_accounts`
--
ALTER TABLE `pmw_bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposal_id` (`proposal_id`),
  ADD KEY `pmw_bank_accounts_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_documents`
--
ALTER TABLE `pmw_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_documents_team_id_foreign` (`team_id`);

--
-- Indexes for table `pmw_expo_attachments`
--
ALTER TABLE `pmw_expo_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_expo_attachments_submission_id_foreign` (`submission_id`);

--
-- Indexes for table `pmw_expo_schedules`
--
ALTER TABLE `pmw_expo_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_expo_schedules_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_expo_submissions`
--
ALTER TABLE `pmw_expo_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_expo_submissions_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_guidance_logbooks`
--
ALTER TABLE `pmw_guidance_logbooks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `pmw_guidance_schedules`
--
ALTER TABLE `pmw_guidance_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pmw_implementation_items`
--
ALTER TABLE `pmw_implementation_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_implementation_items_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_implementation_items_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_implementation_item_photos`
--
ALTER TABLE `pmw_implementation_item_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_implementation_item_photos_item_id_foreign` (`item_id`);

--
-- Indexes for table `pmw_implementation_konsumsi`
--
ALTER TABLE `pmw_implementation_konsumsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_implementation_konsumsi_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_implementation_konsumsi_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_implementation_payments`
--
ALTER TABLE `pmw_implementation_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_implementation_payments_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_implementation_payments_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_lecturers`
--
ALTER TABLE `pmw_lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pmw_mentoring_logs`
--
ALTER TABLE `pmw_mentoring_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_mentoring_logs_team_id_foreign` (`team_id`);

--
-- Indexes for table `pmw_mentors`
--
ALTER TABLE `pmw_mentors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pmw_notifications`
--
ALTER TABLE `pmw_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `type` (`type`),
  ADD KEY `is_read` (`is_read`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `pmw_penilai`
--
ALTER TABLE `pmw_penilai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pmw_periods`
--
ALTER TABLE `pmw_periods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year` (`year`),
  ADD KEY `is_active` (`is_active`);

--
-- Indexes for table `pmw_perjanjian`
--
ALTER TABLE `pmw_perjanjian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_selection_wawancara_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_pitching_assessments`
--
ALTER TABLE `pmw_pitching_assessments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposal_id_penilai_user_id` (`proposal_id`,`penilai_user_id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `fk_pitching_assessments_user` (`penilai_user_id`);

--
-- Indexes for table `pmw_products`
--
ALTER TABLE `pmw_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_products_team_id_foreign` (`team_id`);

--
-- Indexes for table `pmw_profiles`
--
ALTER TABLE `pmw_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `pmw_profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `pmw_proposals`
--
ALTER TABLE `pmw_proposals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `period_id_leader_user_id` (`period_id`,`leader_user_id`),
  ADD KEY `period_id` (`period_id`),
  ADD KEY `leader_user_id` (`leader_user_id`);

--
-- Indexes for table `pmw_proposal_assignments`
--
ALTER TABLE `pmw_proposal_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_proposal_assignments_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_proposal_members`
--
ALTER TABLE `pmw_proposal_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_id` (`proposal_id`),
  ADD KEY `proposal_id_role` (`proposal_id`,`role`);

--
-- Indexes for table `pmw_proposal_rab_items`
--
ALTER TABLE `pmw_proposal_rab_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_id` (`proposal_id`);

--
-- Indexes for table `pmw_reports`
--
ALTER TABLE `pmw_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_reports_proposal_id_foreign` (`proposal_id`),
  ADD KEY `pmw_reports_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `pmw_report_schedules`
--
ALTER TABLE `pmw_report_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_report_schedules_period_id_foreign` (`period_id`);

--
-- Indexes for table `pmw_reviewers`
--
ALTER TABLE `pmw_reviewers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `pmw_schedules`
--
ALTER TABLE `pmw_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `period_id_phase_number` (`period_id`,`phase_number`);

--
-- Indexes for table `pmw_selection_finalization`
--
ALTER TABLE `pmw_selection_finalization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_selection_finalization_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_selection_implementasi`
--
ALTER TABLE `pmw_selection_implementasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_selection_implementasi_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_selection_pitching`
--
ALTER TABLE `pmw_selection_pitching`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_selection_pitching_proposal_id_foreign` (`proposal_id`),
  ADD KEY `penilaian_final_at` (`penilaian_final_at`),
  ADD KEY `fk_selection_pitching_final_by` (`penilaian_final_by`);

--
-- Indexes for table `pmw_selection_proposal`
--
ALTER TABLE `pmw_selection_proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_selection_proposal_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `pmw_training_photos`
--
ALTER TABLE `pmw_training_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pmw_training_photos_report_id_foreign` (`report_id`);

--
-- Indexes for table `pmw_training_reports`
--
ALTER TABLE `pmw_training_reports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposal_id_period_id` (`proposal_id`,`period_id`),
  ADD KEY `pmw_training_reports_period_id_foreign` (`period_id`);

--
-- Indexes for table `portal_announcements`
--
ALTER TABLE `portal_announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `portal_galleries`
--
ALTER TABLE `portal_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement_attachments`
--
ALTER TABLE `announcement_attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1764;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_content`
--
ALTER TABLE `cms_content`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `pmw_activity_logbooks`
--
ALTER TABLE `pmw_activity_logbooks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pmw_activity_logbook_photos`
--
ALTER TABLE `pmw_activity_logbook_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pmw_activity_schedules`
--
ALTER TABLE `pmw_activity_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pmw_announcements`
--
ALTER TABLE `pmw_announcements`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmw_announcement_items`
--
ALTER TABLE `pmw_announcement_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmw_assessments`
--
ALTER TABLE `pmw_assessments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_awards`
--
ALTER TABLE `pmw_awards`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_award_categories`
--
ALTER TABLE `pmw_award_categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pmw_bank_accounts`
--
ALTER TABLE `pmw_bank_accounts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_documents`
--
ALTER TABLE `pmw_documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `pmw_expo_attachments`
--
ALTER TABLE `pmw_expo_attachments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_expo_schedules`
--
ALTER TABLE `pmw_expo_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pmw_expo_submissions`
--
ALTER TABLE `pmw_expo_submissions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_guidance_logbooks`
--
ALTER TABLE `pmw_guidance_logbooks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_guidance_schedules`
--
ALTER TABLE `pmw_guidance_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_implementation_items`
--
ALTER TABLE `pmw_implementation_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pmw_implementation_item_photos`
--
ALTER TABLE `pmw_implementation_item_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pmw_implementation_konsumsi`
--
ALTER TABLE `pmw_implementation_konsumsi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_implementation_payments`
--
ALTER TABLE `pmw_implementation_payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_lecturers`
--
ALTER TABLE `pmw_lecturers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pmw_mentoring_logs`
--
ALTER TABLE `pmw_mentoring_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_mentors`
--
ALTER TABLE `pmw_mentors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pmw_notifications`
--
ALTER TABLE `pmw_notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `pmw_penilai`
--
ALTER TABLE `pmw_penilai`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pmw_periods`
--
ALTER TABLE `pmw_periods`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmw_perjanjian`
--
ALTER TABLE `pmw_perjanjian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pmw_pitching_assessments`
--
ALTER TABLE `pmw_pitching_assessments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `pmw_products`
--
ALTER TABLE `pmw_products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_profiles`
--
ALTER TABLE `pmw_profiles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_proposals`
--
ALTER TABLE `pmw_proposals`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pmw_proposal_assignments`
--
ALTER TABLE `pmw_proposal_assignments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pmw_proposal_members`
--
ALTER TABLE `pmw_proposal_members`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1513;

--
-- AUTO_INCREMENT for table `pmw_proposal_rab_items`
--
ALTER TABLE `pmw_proposal_rab_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2780;

--
-- AUTO_INCREMENT for table `pmw_reports`
--
ALTER TABLE `pmw_reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pmw_report_schedules`
--
ALTER TABLE `pmw_report_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pmw_reviewers`
--
ALTER TABLE `pmw_reviewers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pmw_schedules`
--
ALTER TABLE `pmw_schedules`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pmw_selection_finalization`
--
ALTER TABLE `pmw_selection_finalization`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmw_selection_implementasi`
--
ALTER TABLE `pmw_selection_implementasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pmw_selection_pitching`
--
ALTER TABLE `pmw_selection_pitching`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `pmw_selection_proposal`
--
ALTER TABLE `pmw_selection_proposal`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pmw_training_photos`
--
ALTER TABLE `pmw_training_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_training_reports`
--
ALTER TABLE `pmw_training_reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `portal_announcements`
--
ALTER TABLE `portal_announcements`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `portal_galleries`
--
ALTER TABLE `portal_galleries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_attachments`
--
ALTER TABLE `announcement_attachments`
  ADD CONSTRAINT `announcement_attachments_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `portal_announcements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmw_activity_logbooks`
--
ALTER TABLE `pmw_activity_logbooks`
  ADD CONSTRAINT `pmw_activity_logbooks_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `pmw_activity_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_activity_logbook_photos`
--
ALTER TABLE `pmw_activity_logbook_photos`
  ADD CONSTRAINT `pmw_activity_logbook_photos_logbook_id_foreign` FOREIGN KEY (`logbook_id`) REFERENCES `pmw_activity_logbooks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_activity_schedules`
--
ALTER TABLE `pmw_activity_schedules`
  ADD CONSTRAINT `pmw_activity_schedules_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_activity_schedules_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_announcements`
--
ALTER TABLE `pmw_announcements`
  ADD CONSTRAINT `pmw_announcements_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_announcement_items`
--
ALTER TABLE `pmw_announcement_items`
  ADD CONSTRAINT `pmw_announcement_items_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `pmw_announcements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_assessments`
--
ALTER TABLE `pmw_assessments`
  ADD CONSTRAINT `pmw_assessments_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `pmw_documents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_assessments_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_awards`
--
ALTER TABLE `pmw_awards`
  ADD CONSTRAINT `pmw_awards_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `pmw_award_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_awards_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_award_categories`
--
ALTER TABLE `pmw_award_categories`
  ADD CONSTRAINT `pmw_award_categories_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_bank_accounts`
--
ALTER TABLE `pmw_bank_accounts`
  ADD CONSTRAINT `pmw_bank_accounts_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_bank_accounts_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_expo_attachments`
--
ALTER TABLE `pmw_expo_attachments`
  ADD CONSTRAINT `pmw_expo_attachments_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `pmw_expo_submissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_expo_schedules`
--
ALTER TABLE `pmw_expo_schedules`
  ADD CONSTRAINT `pmw_expo_schedules_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_expo_submissions`
--
ALTER TABLE `pmw_expo_submissions`
  ADD CONSTRAINT `pmw_expo_submissions_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_guidance_logbooks`
--
ALTER TABLE `pmw_guidance_logbooks`
  ADD CONSTRAINT `pmw_guidance_logbooks_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `pmw_guidance_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_guidance_schedules`
--
ALTER TABLE `pmw_guidance_schedules`
  ADD CONSTRAINT `pmw_guidance_schedules_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_guidance_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmw_implementation_items`
--
ALTER TABLE `pmw_implementation_items`
  ADD CONSTRAINT `pmw_implementation_items_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_implementation_items_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_implementation_item_photos`
--
ALTER TABLE `pmw_implementation_item_photos`
  ADD CONSTRAINT `pmw_implementation_item_photos_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `pmw_implementation_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_implementation_konsumsi`
--
ALTER TABLE `pmw_implementation_konsumsi`
  ADD CONSTRAINT `pmw_implementation_konsumsi_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_implementation_konsumsi_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_implementation_payments`
--
ALTER TABLE `pmw_implementation_payments`
  ADD CONSTRAINT `pmw_implementation_payments_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_implementation_payments_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_lecturers`
--
ALTER TABLE `pmw_lecturers`
  ADD CONSTRAINT `pmw_lecturers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_mentors`
--
ALTER TABLE `pmw_mentors`
  ADD CONSTRAINT `pmw_mentors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_notifications`
--
ALTER TABLE `pmw_notifications`
  ADD CONSTRAINT `pmw_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pmw_penilai`
--
ALTER TABLE `pmw_penilai`
  ADD CONSTRAINT `fk_penilai_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_perjanjian`
--
ALTER TABLE `pmw_perjanjian`
  ADD CONSTRAINT `pmw_selection_wawancara_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_pitching_assessments`
--
ALTER TABLE `pmw_pitching_assessments`
  ADD CONSTRAINT `fk_pitching_assessments_proposal` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pitching_assessments_user` FOREIGN KEY (`penilai_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pmw_profiles`
--
ALTER TABLE `pmw_profiles`
  ADD CONSTRAINT `pmw_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_proposals`
--
ALTER TABLE `pmw_proposals`
  ADD CONSTRAINT `pmw_proposals_leader_user_id_foreign` FOREIGN KEY (`leader_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_proposals_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_proposal_assignments`
--
ALTER TABLE `pmw_proposal_assignments`
  ADD CONSTRAINT `pmw_proposal_assignments_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_proposal_members`
--
ALTER TABLE `pmw_proposal_members`
  ADD CONSTRAINT `pmw_proposal_members_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_proposal_rab_items`
--
ALTER TABLE `pmw_proposal_rab_items`
  ADD CONSTRAINT `pmw_proposal_rab_items_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_reports`
--
ALTER TABLE `pmw_reports`
  ADD CONSTRAINT `pmw_reports_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_reports_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `pmw_report_schedules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_report_schedules`
--
ALTER TABLE `pmw_report_schedules`
  ADD CONSTRAINT `pmw_report_schedules_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_reviewers`
--
ALTER TABLE `pmw_reviewers`
  ADD CONSTRAINT `pmw_reviewers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_schedules`
--
ALTER TABLE `pmw_schedules`
  ADD CONSTRAINT `pmw_schedules_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_selection_finalization`
--
ALTER TABLE `pmw_selection_finalization`
  ADD CONSTRAINT `pmw_selection_finalization_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_selection_implementasi`
--
ALTER TABLE `pmw_selection_implementasi`
  ADD CONSTRAINT `pmw_selection_implementasi_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_selection_pitching`
--
ALTER TABLE `pmw_selection_pitching`
  ADD CONSTRAINT `fk_selection_pitching_final_by` FOREIGN KEY (`penilaian_final_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pmw_selection_pitching_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_selection_proposal`
--
ALTER TABLE `pmw_selection_proposal`
  ADD CONSTRAINT `pmw_selection_proposal_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_training_photos`
--
ALTER TABLE `pmw_training_photos`
  ADD CONSTRAINT `pmw_training_photos_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `pmw_training_reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pmw_training_reports`
--
ALTER TABLE `pmw_training_reports`
  ADD CONSTRAINT `pmw_training_reports_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `pmw_periods` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pmw_training_reports_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `pmw_proposals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
