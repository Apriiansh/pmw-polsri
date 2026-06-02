-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2026 at 10:48 AM
-- Server version: 8.0.46
-- PHP Version: 8.4.21

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
(17, 44, 'uploads/announcements/44/1779711689_ae2079e2ff53774dcdaa.jpeg', 'Perpanjangan PMW 2026.jpeg', 'image/jpeg', 173601, '2026-05-25 19:21:29', '2026-05-25 19:21:29');

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
(31, 32, 'mentor', '2026-04-30 10:01:20'),
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
(78, 81, 'mahasiswa', '2026-05-19 20:59:29'),
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
(105, 108, 'mahasiswa', '2026-05-25 09:49:52'),
(106, 109, 'mahasiswa', '2026-05-25 11:04:52'),
(107, 110, 'mahasiswa', '2026-05-25 13:28:13'),
(108, 111, 'mahasiswa', '2026-05-25 21:19:46'),
(109, 112, 'mahasiswa', '2026-05-26 09:39:07'),
(110, 113, 'mahasiswa', '2026-05-26 16:49:16'),
(111, 114, 'mentor', '2026-06-01 14:42:27'),
(112, 115, 'reviewer', '2026-06-01 14:45:14');

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
(1, 1, 'email_password', NULL, 'simpmw@polsri.ac.id', '$2y$12$Mn8F04rWpJYuXVlwE974pOwbGCBEXZoz/HgjXKoWQHlvX61nEApc6', NULL, NULL, 0, '2026-06-02 10:41:32', '2026-04-14 04:39:01', '2026-06-02 10:41:32'),
(45, 42, 'email_password', NULL, 'mroihanbaariq@gmail.com', '$2y$12$YkIZgFQAlhPqKQjAmVNGI.hePJOg7ETHfi.yvvSOMw9QOfHQ8Qjqu', NULL, NULL, 0, '2026-05-25 14:12:33', '2026-05-03 22:51:30', '2026-05-25 14:12:33'),
(46, 43, 'email_password', NULL, 'mersialyaprima67@gmail.com', '$2y$12$KYxlXX84lYnhX9WUNLx78uHJjIDOblDWS1Ub9Q4XDSnR7.PvDvvS2', NULL, NULL, 0, '2026-05-06 23:00:42', '2026-05-04 10:56:05', '2026-05-06 23:00:42'),
(47, 44, 'email_password', NULL, 'putrinatasyaaa1188@gmail.com', '$2y$12$FLdLKrwV5g7iojnjJaDoKOFahMwWLd5b1huF01QvKWr1POrj3Ksza', NULL, NULL, 0, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(48, 47, 'email_password', NULL, 'ghefiramutiara8@gmail.com', '$2y$12$.T/xKyGyPZL3FLQhtlCk6uusdV/VHyVL4RMRo5qSnt3Seo/sFZtl6', NULL, NULL, 0, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(49, 48, 'email_password', NULL, 'msatriaws@gmail.com', '$2y$12$JskyVbWIaDRWZ8TQr37Ek..sDylKm0eudQbn8UCZRGhUuaTl12DAC', NULL, NULL, 0, '2026-06-02 10:23:36', '2026-05-05 19:12:04', '2026-06-02 10:23:36'),
(50, 49, 'email_password', NULL, 'iwayanbhayusastrawiguna@gmail.com', '$2y$12$gK78vR2cnktNYGTKWnGuDevX8WK6lErFUm.Vv8Ks2Nl5z1jIvjjOS', NULL, NULL, 0, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(51, 50, 'email_password', NULL, 'rakameidiansyah67@gmail.com', '$2y$12$qE/ysSrIr1GaYnfAwiGYL.iKqBmPuAdUBJvtg4yvTOkQ6F4nzJOKq', NULL, NULL, 0, '2026-05-26 16:04:29', '2026-05-06 16:29:24', '2026-05-26 16:04:29'),
(52, 51, 'email_password', NULL, 'melinasftr1204@gmail.com', '$2y$12$rHYtkDLlaJ/ibgAkBpWwz.AA.ZrReAzUml1rLeWACOA4/G9cRM.Ru', NULL, NULL, 0, '2026-05-25 23:17:32', '2026-05-07 09:51:19', '2026-05-25 23:17:32'),
(53, 52, 'email_password', NULL, 'prianhandy@gmail.com', '$2y$12$fbGREFqAHsz8b2bfIw5HL..4pek4vEMcmYDBvl7d5Ujl9heA.9xGO', NULL, NULL, 0, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(54, 53, 'email_password', NULL, 'oliviadinatadinda@gmail.com', '$2y$12$wo0pnt1cBc83Ba8zfEKKJejVz7EsX9mGGW4Hh3fM6oQoKM.abLqn.', NULL, NULL, 0, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(55, 54, 'email_password', NULL, 'faturrahman102006@gmail.com', '$2y$12$h3PmM7OpInfXTRyGSKsHF.KOCr/O3sa2GxW.ff5jyHRt0YmhoAtkS', NULL, NULL, 0, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(56, 55, 'email_password', NULL, '062340833143@student.polsri.ac.id', '$2y$12$GslYYlaEz2EQAY5kaTpUreaMbRGjcrCdjqANR/zprJZG85p3Cpiae', NULL, NULL, 0, '2026-06-01 15:01:06', '2026-05-08 18:44:43', '2026-06-01 15:01:06'),
(57, 56, 'email_password', NULL, 'gh4554ni.queen@gmail.com', '$2y$12$9VMh236i6fORo1rxrtz9j.a9DQokfetQTfVqaRTqY3a2nm5/4iHUq', NULL, NULL, 0, '2026-05-28 19:42:08', '2026-05-10 08:46:54', '2026-05-28 19:42:08'),
(58, 57, 'email_password', NULL, 'chaniaputrii06@gmail.com', '$2y$12$Pi0JsrJl42mXubblirbnW.IrsK9B2Xg63e1HAOoc9lRLppFsGfyE.', NULL, NULL, 0, '2026-05-28 17:38:13', '2026-05-10 15:08:24', '2026-05-28 17:38:13'),
(59, 58, 'email_password', NULL, 'elfandary2405@gmail.com', '$2y$12$Rkr9QnNCSI17MvDZBWwb.OpNn7ZocRIOF9M8YiOWS561eybEIZJtq', NULL, NULL, 0, '2026-05-12 14:58:37', '2026-05-10 23:05:13', '2026-05-12 14:58:37'),
(65, 64, 'email_password', NULL, 'sonyardian499@gmail.com', '$2y$12$YIiSqSmcCbMD8/5nJS3NsOxV9FT0LxEHq2B253X724t3V4O25XgF2', NULL, NULL, 0, NULL, '2026-05-11 16:03:36', '2026-05-11 16:03:37'),
(66, 65, 'email_password', NULL, 'mariofebriand23@gmail.com', '$2y$12$JhZL6JiBxg8yQkVlx30CDOdYQUbEfyxAJ1vuYgHJEnp7VaZaQOkTG', NULL, NULL, 0, '2026-05-11 21:30:26', '2026-05-11 16:04:19', '2026-05-11 21:30:26'),
(67, 66, 'email_password', NULL, 'baybaraqbah@gmail.com', '$2y$12$8SGFYyVb5xTmW1rK0eIMBub5IdLBlcKWClGnZyRjhu5I9sE4AN3h.', NULL, NULL, 0, '2026-05-12 17:35:19', '2026-05-11 21:47:16', '2026-05-12 17:35:19'),
(68, 67, 'email_password', NULL, 'rejakjugo@gmail.com', '$2y$12$biTv9rh8islJap6BuYHbh.FRWxjDFfQWTDxAAkkQtzw2gZL6Zr6Ia', NULL, NULL, 0, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(69, 68, 'email_password', NULL, 'nicucimol@gmail.com', '$2y$12$nf/ikgPWevY4WBMjlJtZNusS5An9pUKzrTWbJMWW9cfIP9DdvQ5HG', NULL, NULL, 0, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(70, 69, 'email_password', NULL, 'marselmks932@gmail.com', '$2y$12$8H/6ONxk0JV9HZ8SF/vBeuGbszhbYR80gCVMgt0h.ojT3bU/qIDN2', NULL, NULL, 0, '2026-05-25 08:59:38', '2026-05-13 21:06:57', '2026-05-25 08:59:38'),
(71, 70, 'email_password', NULL, 'intanbelindaaa2@gmal.com', '$2y$12$eJ14gzeOsZxbWazuWE1y/.NZgO5axnSpTppbpJQ3jJBY8IPyzJ2xa', NULL, NULL, 0, '2026-05-31 22:10:56', '2026-05-14 14:09:55', '2026-05-31 22:10:56'),
(72, 71, 'email_password', NULL, 'k4rn0tr1y4d1@gmail.com', '$2y$12$2q7ZnRFHY4sMNcv.K3/LWekxA1s4Nf574jFI3.f31CaVBa./TVIUO', NULL, NULL, 0, '2026-05-24 13:44:06', '2026-05-14 20:07:38', '2026-05-24 13:44:06'),
(73, 72, 'email_password', NULL, 'damayantisarfina@gmail.com', '$2y$12$qqbMwwSsUSeWB5V6lh8x3OsfHaQn4N5Elv0ALAxB8KXt1t4agfrsG', NULL, NULL, 0, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(74, 73, 'email_password', NULL, 'krisnawati0706na@gmail.com', '$2y$12$gCc.FijoIaOvMFNeyA8uQ.nmhVo4sK.zQQRkBhdNIF1xry1WSZ73a', NULL, NULL, 0, '2026-05-25 13:15:06', '2026-05-16 10:08:37', '2026-05-25 13:15:06'),
(75, 74, 'email_password', NULL, 'khaillaanastya@gmail.com', '$2y$12$t4J8nlf3GDVoGfT2qruy8ewwniBBYXPE8nnbXGOXl8RaWbOP7Eshe', NULL, NULL, 0, '2026-06-01 21:20:36', '2026-05-17 12:39:29', '2026-06-01 21:20:36'),
(76, 75, 'email_password', NULL, 'risaoktapiaa@gmail.com', '$2y$12$7Y028tfKX6uppLUAFdA/EeZ..2vU6WE1anjOqLDqJ3FlgCm8yMtAS', NULL, NULL, 0, '2026-06-02 08:44:57', '2026-05-18 15:50:14', '2026-06-02 08:44:57'),
(77, 76, 'email_password', NULL, 'davinaramadhani06@gmail.com', '$2y$12$mfEGMCgJyld3KQcusRkvJOZNkulO2kHhRDt00YR0VxXdwzd5W3fj6', NULL, NULL, 0, '2026-05-25 08:07:25', '2026-05-19 09:39:39', '2026-05-25 08:07:25'),
(78, 77, 'email_password', NULL, '062440833325@student.polsri.ac.id', '$2y$12$KUCVsAvRG3PvVGt/cKFUi.ImGyC7OEOYahdeLiXIImhgMwuTHg0iG', NULL, NULL, 0, '2026-06-02 10:41:39', '2026-05-19 10:46:34', '2026-06-02 10:41:39'),
(79, 78, 'email_password', NULL, '062440833330@student.polsri.ac.id', '$2y$12$rgyM9nlYx1Tf19.sPYm9..lDKRuqIhwyHYaB/VtiSQcEPkDwbfXyC', NULL, NULL, 0, '2026-05-21 16:44:17', '2026-05-19 11:24:58', '2026-05-21 16:44:17'),
(80, 79, 'email_password', NULL, 'akbarcool998@gmail.com', '$2y$12$QXGo8U/5zO/0q1hChiRKeO/JJNqpBmqW3nsNXR9gm4MYW0QoJFqwK', NULL, NULL, 0, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(81, 80, 'email_password', NULL, '062440833323@student.polsri.ac.id', '$2y$12$wAWymL/UmwAlZOrHwUyN2ed9iHQR9z0q4Tv8/xB9e99SdgSm/eWD6', NULL, NULL, 0, '2026-05-25 21:36:10', '2026-05-19 11:26:43', '2026-05-25 21:36:10'),
(82, 81, 'email_password', NULL, 'combetohct@yahoo.com', '$2y$12$G7tUmavhNicW5yG9hTqeCehSnbB/Ywot2ztmjQD.K7TwILYbvJCju', NULL, NULL, 0, '2026-05-25 03:39:44', '2026-05-19 20:59:29', '2026-05-25 03:39:44'),
(83, 82, 'email_password', NULL, 'muhammadjayadiluthfiizzuddin@gmail.com', '$2y$12$OrwBW57lRacl5nMQ26fNSOPGs1dyJDpAqttIgfH4J.LK/i/oT5N1e', NULL, NULL, 0, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(84, 83, 'email_password', NULL, 'kholilahfitri4@gmail.com', '$2y$12$tRLXm8PI8Hl/2yyZ9UikOeDGu7NpDWb1ak3I1.ykkjcDmypVF1JGm', NULL, NULL, 0, '2026-06-01 07:28:41', '2026-05-20 12:59:15', '2026-06-01 07:28:41'),
(85, 84, 'email_password', NULL, '062440833326@student.polsri.ac.id', '$2y$12$RzidAqmrN5CmP44LDipy5ukgSdutsM7gn6UNoKMOF0RgmLAmOvOuq', NULL, NULL, 0, '2026-06-01 14:30:55', '2026-05-20 14:04:10', '2026-06-01 14:30:55'),
(86, 85, 'email_password', NULL, 'najwaalyasenovgizahra@gmail.com', '$2y$12$SXTVzRh9LWPCuooZW8KaTeukPrRktWrC8hIxiBDreuTyL1Of1/6Eq', NULL, NULL, 0, '2026-06-01 14:51:48', '2026-05-20 15:22:09', '2026-06-01 14:51:48'),
(87, 86, 'email_password', NULL, 'nailahdwimulya04@gmail.com', '$2y$12$tiJls.o418/fmh6LhpeIHu4ga.PvqF5O3Dpcby7oyiBatiea0z/V6', NULL, NULL, 0, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(88, 87, 'email_password', NULL, 'oliviaclaudiaa17@gmail.con', '$2y$12$1L6LTOYWyMf4dKuZDKC2N.mbXQh/lsIsgt11hOU/KqujmebtmlIDi', NULL, NULL, 0, '2026-05-25 13:33:09', '2026-05-21 12:55:59', '2026-05-25 13:33:09'),
(89, 88, 'email_password', NULL, 'indahade600@gmail.com', '$2y$12$jdOgxhL2BO0jSUwS7TWVR.rflCuceN0IGzhx7amybtwhy4tsaK7Ga', NULL, NULL, 0, '2026-05-23 14:05:06', '2026-05-21 15:43:00', '2026-05-23 14:05:06'),
(90, 89, 'email_password', NULL, 'nadilastevanialensi@gmail.con', '$2y$12$kmcemOeqElz/GksWXxHQsO6VMtbq6llwngMKuP8wbxXi8scTA60CS', NULL, NULL, 0, '2026-05-25 15:02:49', '2026-05-21 16:09:44', '2026-05-25 15:02:49'),
(91, 90, 'email_password', NULL, '062440833334@student.polsri.ac.id', '$2y$12$pB0PI5E9K26IAFURoO.Hf.M5c299F5YL.B0SUjPJMev9OuqNSnofW', NULL, NULL, 0, '2026-05-25 21:38:09', '2026-05-21 18:19:24', '2026-05-25 21:38:09'),
(92, 91, 'email_password', NULL, 'mozaslavina@gmail.com', '$2y$12$H0cmssR5c5lXsfMalfosm.Dk6Z3Jgx/Um1/p3PiRGcu78fw3r6BOy', NULL, NULL, 0, '2026-05-24 20:23:43', '2026-05-22 07:52:38', '2026-05-24 20:23:43'),
(93, 92, 'email_password', NULL, 'ciciagustinaputri525@gmail.com', '$2y$12$uc/qzzgwDh.JKjtfvxowLunEcJTZV/Pp5V3nVM.PaSrB4E3IlM.H.', NULL, NULL, 0, '2026-05-29 13:29:31', '2026-05-22 08:02:18', '2026-05-29 13:29:31'),
(94, 93, 'email_password', NULL, '062440833332@student.polsri.ac.id', '$2y$12$jTcT9l8haFUKJfzc94bxx.mM7O6XQysMk7g6tuVRj5Gi3Vkk3Fupe', NULL, NULL, 0, '2026-05-24 22:54:12', '2026-05-23 10:42:51', '2026-05-24 22:54:12'),
(95, 94, 'email_password', NULL, '062440833336@student.polsri.ac.id', '$2y$12$xCmnfdlgAyB1hcjXWZzee.OhHp2lWUh3n7GXhLbPkxFoK9GgrJY8S', NULL, NULL, 0, '2026-05-25 20:04:43', '2026-05-23 10:57:24', '2026-05-25 20:04:43'),
(96, 95, 'email_password', NULL, 'rizka03rd@gmail.com', '$2y$12$1q56e0.2JzpMB1KtPADcDeiXXvvBxk31vAUOHKkz9H00PuPNiqYEy', NULL, NULL, 0, '2026-06-02 08:48:39', '2026-05-23 11:51:45', '2026-06-02 08:48:39'),
(97, 96, 'email_password', NULL, 'dinnizen@gmail.com', '$2y$12$J9NmoCEN4mEhLkM77j487.4sfOdkFlVhubdsg3rlc0MUA4o4lkO1K', NULL, NULL, 0, '2026-05-26 17:00:18', '2026-05-23 12:32:08', '2026-05-26 17:00:18'),
(98, 97, 'email_password', NULL, 'htriwarsito@gmail.com', '$2y$12$QEW0teCjcldxpQul.oE6n.wiOMKINSMlL92M2B8QvSZ0NV76ZVhaW', NULL, NULL, 0, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(99, 98, 'email_password', NULL, 'marsya.00101@gmail.com', '$2y$12$0siT9gncDXs9jMXZYhiOaudNqiX3ms0wm6RLSQDqA8z5PNL5h19ui', NULL, NULL, 0, '2026-05-27 17:54:37', '2026-05-23 22:55:59', '2026-05-27 17:54:37'),
(100, 99, 'email_password', NULL, 'houseoflytheros@gmail.com', '$2y$12$NB6Z9qM4F2YQgXy1lNKYkOpg937EvMf8VtT5FVLCTIh6UMREn6kHO', NULL, NULL, 0, '2026-06-01 15:11:57', '2026-05-23 23:43:28', '2026-06-01 15:11:57'),
(101, 100, 'email_password', NULL, 'mridhoapriliadi0@gmail.com', '$2y$12$GSd0RI2q.EfUEHfHfmXqauNVJ67ABwZadZgS1VSJn3x/5.xAXROA.', NULL, NULL, 0, '2026-05-24 17:33:55', '2026-05-24 11:57:30', '2026-05-24 17:33:55'),
(102, 101, 'email_password', NULL, 'tesalonikacfe46@gmail.com', '$2y$12$q3HOrreLK8uSe9NlOqVyyOnEmg1fp4mXMOe8yVmZJ8PbsWHqTqrOq', NULL, NULL, 0, '2026-05-25 05:51:13', '2026-05-24 12:49:36', '2026-05-25 05:51:13'),
(103, 102, 'email_password', NULL, 'rarahnewe@gmail.com', '$2y$12$V.nyvVOgf4MKRHO25SQ8IuL4NzaoNphfxY.NUjUOF/qWjDl0Hm2bC', NULL, NULL, 0, '2026-05-24 20:37:56', '2026-05-24 13:21:30', '2026-05-24 20:37:56'),
(104, 103, 'email_password', NULL, 'hassanjankhan19@gmail.com', '$2y$12$3pkQvB42dvD90kY8tj0NfeXjvAPE9ldT/68twREiwjAQzfwmVgAYm', NULL, NULL, 0, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(105, 104, 'email_password', NULL, 'meliachya@gmail.com', '$2y$12$pdXP26wnAL1zsLenegYKCOQpXYwalubR9R74VPdJixk8a8lwdfMWm', NULL, NULL, 0, '2026-05-25 15:17:31', '2026-05-24 19:03:57', '2026-05-25 15:17:31'),
(106, 105, 'email_password', NULL, 'naninajae@gmail.com', '$2y$12$TlKPA.//wtsquh9LhrxhU.Qe9iamctx25Z31T7fEiZEUY9bHj9bbW', NULL, NULL, 0, '2026-05-25 07:06:43', '2026-05-24 19:28:18', '2026-05-25 07:06:43'),
(107, 106, 'email_password', NULL, 'mfathir069@gmail.com', '$2y$12$uy7qy8zXanE330F7He0MHex.hPeHRcMFRSuVu3iHaphoArnJVKmca', NULL, NULL, 0, '2026-06-01 02:13:58', '2026-05-24 21:24:12', '2026-06-01 02:13:58'),
(108, 107, 'email_password', NULL, 'tianiusds@gmail.com', '$2y$12$PeR2kcXaMHxng8vB6vo0Jekmli4696wMNjmmazJQWWerkZTovrd9W', NULL, NULL, 0, '2026-05-25 13:15:03', '2026-05-24 21:25:32', '2026-05-25 13:15:03'),
(109, 108, 'email_password', NULL, 'test@gmail.com', '$2y$12$gF8FJzCaWYX5tVcY.y1WpehK35PxyLwnSPDeMPyo.UapPl4hP34Km', NULL, NULL, 0, '2026-05-26 13:18:34', '2026-05-25 09:49:52', '2026-05-26 13:18:34'),
(110, 109, 'email_password', NULL, 'muhammadriizkyy4@gmail.com', '$2y$12$fDpT6j/9bg3lQDr2ZAwc6.lQD7BlaAqFUV.Xp4lv82xzDpX.ciSkS', NULL, NULL, 0, '2026-06-01 16:11:03', '2026-05-25 11:04:51', '2026-06-01 16:11:03'),
(111, 110, 'email_password', NULL, '062440833329@student.polsri.ac.id', '$2y$12$XZ5UINGMYOkPhBhZ3vmBVODJ8M7YASjaCxywcPIyXIvo7tRKWGSby', NULL, NULL, 0, '2026-06-01 15:40:57', '2026-05-25 13:28:13', '2026-06-01 15:40:57'),
(112, 111, 'email_password', NULL, 'valengeraldi17@gmail.com', '$2y$12$onukxJClphZWT0rB9XuLTO0G.L3S7GAowGDnvs8P08ZShfVVstDxa', NULL, NULL, 0, '2026-06-01 16:09:43', '2026-05-25 21:19:46', '2026-06-01 16:09:43'),
(113, 112, 'email_password', NULL, 'akbarfrnd63@gmail.com', '$2y$12$0bsmjt7gfayNVCD0mdw25u7OBNbtk4efbHO6i7y6ZXP8yq9O5UA0.', NULL, NULL, 0, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(114, 113, 'email_password', NULL, 'febriansyah010200@gmail.com', '$2y$12$lDWwGd469T8HTteiDnfG5uld02e8JTVYBocyGh2cDZiMI7OMxAkX.', NULL, NULL, 0, '2026-06-01 13:38:40', '2026-05-26 16:49:16', '2026-06-01 13:38:40'),
(115, 114, 'email_password', NULL, 'reviewer@gmail.com', '$2y$12$scXY3YxuX9PIawtR4/wUQexbL.uFrVbPigPiKRpGyuOI5yJZ9fZtO', NULL, NULL, 0, NULL, '2026-06-01 14:42:27', '2026-06-01 14:42:27'),
(116, 115, 'email_password', NULL, 'reviewerpolsri@gmail.com', '$2y$12$1Jc/C6xwMLoJp8sH.ASiZ.1Fajbzv/vgryeTV.z63FGNcZRxHtgyu', NULL, NULL, 0, '2026-06-01 14:53:03', '2026-06-01 14:45:14', '2026-06-01 14:53:03');

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
(980, '36.76.241.199', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'email_password', '062440833325@student.polsri.ac.id', 77, '2026-06-02 10:41:39', 1);

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
(1, 'home_hero_badge', 'Program Tahun 2026', 'text', 'home_hero', 'Hero Badge Text', NULL, '2026-05-02 09:56:38'),
(4, 'home_hero_description', 'Politeknik Negeri Sriwijaya memfasilitasi mahasiswa untuk mengembangkan ide bisnis menjadi usaha nyata melalui program pembinaan kewirausahaan.', 'text', 'home_hero', 'Hero Description', NULL, '2026-05-02 09:56:38'),
(5, 'home_hero_image', 'uploads/cms/1777540014_45a9d703a585e6db5ad0.png', 'image', 'home_hero', 'Hero Image', NULL, '2026-05-02 09:56:38'),
(6, 'home_hero_stats', '[{\"number\":\"15+\",\"label\":\"Tahun Berdiri\"},{\"number\":\"300+\",\"label\":\"Tim Terbina\"},{\"number\":\"300+\",\"label\":\"Usaha Aktif\"}]', 'json', 'home_hero', 'Hero Statistics', NULL, '2026-05-02 09:56:38'),
(7, 'home_features_badge', 'Mengapa PMW?', 'text', 'home_features', 'Features Badge', NULL, '2026-05-02 09:56:38'),
(8, 'home_features_title', 'Program Pembinaan Komprehensif', 'text', 'home_features', 'Features Title', NULL, '2026-05-02 09:56:38'),
(9, 'home_features_description', 'Program Mahasiswa Wirausaha dirancang untuk memberikan dukungan holistik dari ide hingga usaha yang berkelanjutan.', 'text', 'home_features', 'Features Description', NULL, '2026-05-02 09:56:38'),
(10, 'home_features_list', '[{\"icon\":\"fa-route\",\"color\":\"sky\",\"title\":\"Proses Jelas\",\"desc\":\"Tahapan program yang terstruktur dari pendaftaran hingga awarding dengan milestone yang jelas.\"},{\"icon\":\"fa-users\",\"color\":\"yellow\",\"title\":\"Tim Pendamping\",\"desc\":\"Didampingi oleh dosen dan mentor industri berpengalaman dalam setiap tahap pengembangan.\"},{\"icon\":\"fa-coins\",\"color\":\"sky\",\"title\":\"Pendanaan Implementasi\",\"desc\":\"Akses pendanaan tahap 1 dan tahap 2 untuk mengakselerasi pertumbuhan usaha Anda.\"},{\"icon\":\"fa-chart-line\",\"color\":\"emerald\",\"title\":\"Pengembangan Skill\",\"desc\":\"Pelatihan kewirausahaan, manajemen bisnis, dan pengembangan produk berkualitas.\"}]', 'json', 'home_features', 'Features List', NULL, '2026-05-02 09:56:38'),
(11, 'home_workflow_badge', 'Alur Program', 'text', 'home_workflow', 'Workflow Badge', NULL, '2026-05-02 09:56:38'),
(12, 'home_workflow_title', '11 Tahapan Menuju Wirausaha Mandiri', 'text', 'home_workflow', 'Workflow Title', NULL, '2026-05-02 09:56:38'),
(13, 'home_workflow_description', 'Program ini dirancang dengan pendekatan berbasis proses yang sistematis. Setiap tahap memiliki kriteria evaluasi yang jelas dan dukungan yang sesuai.', 'text', 'home_workflow', 'Workflow Description', NULL, '2026-05-02 09:56:38'),
(14, 'home_workflow_image', 'uploads/cms/1777538917_749022d80dcdeff7b5af.png', 'image', 'home_workflow', 'Workflow Image', NULL, '2026-05-02 09:56:38'),
(15, 'home_workflow_list', '[{\"num\":\"1\",\"color\":\"sky\",\"title\":\"Pendaftaran & Pitching\",\"desc\":\"Submit ide bisnis Anda\"},{\"num\":\"2\",\"color\":\"yellow\",\"title\":\"Seleksi Proposal\",\"desc\":\"Buat Proposal Bisnismu\"},{\"num\":\"3\",\"color\":\"emerald\",\"title\":\"Implementasi & Mentoring\",\"desc\":\"Bimbingan intensif 4 bulan\"}]', 'json', 'home_workflow', 'Workflow Preview List', NULL, '2026-05-02 09:56:38'),
(16, 'home_gallery_badge', 'Dokumentasi', 'text', 'home_gallery', 'Gallery Badge', NULL, '2026-05-02 09:56:38'),
(23, 'home_cta_badge', 'Siap Memulai?', 'text', 'home_cta', 'CTA Badge', NULL, '2026-05-02 09:56:38'),
(24, 'home_cta_title', 'Bersiaplah untuk PMW Berikutnya', 'text', 'home_cta', 'CTA Title', NULL, '2026-05-02 09:56:38'),
(25, 'home_cta_description', 'Pelajari tahapan program dan persiapkan diri Anda untuk pendaftaran periode berikutnya. Tim kami siap membimbing Anda.', 'text', 'home_cta', 'CTA Description', NULL, '2026-05-02 09:56:38'),
(26, 'tahapan_hero_badge', 'Alur Program', 'text', 'tahapan_hero', 'Hero Badge', NULL, '2026-05-02 09:56:38'),
(29, 'tahapan_hero_description', 'Program Mahasiswa Wirausaha terdiri dari 11 tahapan yang harus dilalui peserta mulai dari pendaftaran hingga Awarding & Expo Kewirausahaan.', 'text', 'tahapan_hero', 'Hero Description', NULL, '2026-05-02 09:56:38'),
(30, 'tahapan_flow_badge', 'Alur Pendaftaran', 'text', 'tahapan_flow', 'Flow Badge', NULL, '2026-05-02 09:56:38'),
(33, 'tahapan_flow_description', 'Ikuti langkah-langkah berikut untuk mendaftar Program Mahasiswa Wirausaha Polsri.', 'text', 'tahapan_flow', 'Flow Description', NULL, '2026-05-02 09:56:38'),
(34, 'tahapan_flow_steps', '[{\"num\":\"1\",\"title\":\"Registrasi Akun\",\"desc\":\"Buat akun di sistem PMW Polsri dengan email kampus.\"},{\"num\":\"2\",\"title\":\"Pilih Kategori\",\"desc\":\"Tentukan kategori PMW: Usaha Pemula atau Berkembang.\"},{\"num\":\"3\",\"title\":\"Lengkapi Data Tim\",\"desc\":\"Masukkan profil seluruh anggota tim beserta skill.\"},{\"num\":\"4\",\"title\":\"Upload Proposal\",\"desc\":\"Unggah proposal usaha dalam format PDF sesuai template.\"},{\"num\":\"5\",\"seleksi\":\"Seleksi & Wawancara\",\"desc\":\"Ikuti seluruh tahapan seleksi dengan persiapan matang.\"},{\"num\":\"6\",\"title\":\"Implementasi\",\"desc\":\"Peserta terpilih akan mengikuti program hingga evaluasi akhir.\"}]', 'json', 'tahapan_flow', 'Registration Steps', NULL, '2026-05-02 09:56:38'),
(35, 'tahapan_cta_title', 'Siap Mengikuti Tahapan PMW?', 'text', 'tahapan_cta', 'CTA Title', NULL, '2026-05-02 09:56:38'),
(36, 'tahapan_cta_description', 'Daftarkan tim Anda sekarang dan mulai perjalanan kewirausahaan.', 'text', 'tahapan_cta', 'CTA Description', NULL, '2026-05-02 09:56:38'),
(62, 'tentang_hero_badge', 'Tentang Program', 'text', 'tentang_hero', 'Hero Badge', NULL, '2026-05-02 09:56:38'),
(63, 'tentang_hero_title', 'Program Mahasiswa Wirausaha', 'text', 'tentang_hero', 'Hero Title', NULL, '2026-05-02 09:56:38'),
(64, 'tentang_hero_description', 'Program pembinaan kewirausahaan bagi mahasiswa Politeknik Negeri Sriwijaya untuk mengembangkan usaha berbasis inovasi dan kreativitas.', 'text', 'tentang_hero', 'Hero Description', NULL, '2026-05-02 09:56:38'),
(65, 'tentang_vision_title', 'Mencetak Wirausaha Muda', 'text', 'tentang_vision', 'Vision Title', NULL, '2026-05-02 09:56:38'),
(66, 'tentang_vision_content', 'Menjadikan Politeknik Negeri Sriwijaya sebagai pusat unggulan pengembangan kewirausahaan yang menghasilkan entrepreneur muda berdaya saing tinggi, inovatif, dan berkontribusi pada pertumbuhan ekonomi lokal maupun nasional.', 'text', 'tentang_vision', 'Vision Text', NULL, '2026-05-02 09:56:38'),
(67, 'tentang_mission_list', '[{\"misi\":\"Memfasilitasi mahasiswa dalam mengembangkan ide bisnis menjadi usaha nyata\"},{\"misi\":\"Memberikan pendanaan dan akses permodalan untuk pengembangan usaha\"},{\"misi\":\"Menyediakan mentoring dan pendampingan dari praktisi berpengalaman\"},{\"misi\":\"Membangun ekosistem kewirausahaan yang kolaboratif dan berkelanjutan\"}]', 'json', 'tentang_vision', 'Mission List', NULL, '2026-05-02 09:56:38'),
(68, 'tentang_vision_image', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=800&q=80', 'image', 'tentang_vision', 'Vision Image', NULL, '2026-05-02 09:56:38'),
(69, 'tentang_objectives_title', 'Apa yang Kami Capai', 'text', 'tentang_objectives', 'Objectives Title', NULL, '2026-05-02 09:56:38'),
(70, 'tentang_objectives_list', '[{\"icon\":\"fa-lightbulb\",\"color\":\"sky\",\"title\":\"Inovasi & Kreativitas\",\"desc\":\"Mendorong mahasiswa mengembangkan produk/jasa inovatif.\"},{\"icon\":\"fa-hand-holding-usd\",\"color\":\"yellow\",\"title\":\"Kemandirian Ekonomi\",\"desc\":\"Membantu mahasiswa membangun sumber penghasilan mandiri.\"},{\"icon\":\"fa-network-wired\",\"color\":\"emerald\",\"title\":\"Networking Bisnis\",\"desc\":\"Membangun jaringan dengan pelaku usaha dan investor.\"},{\"icon\":\"fa-graduation-cap\",\"color\":\"sky\",\"title\":\"Skill Development\",\"desc\":\"Pelatihan manajemen bisnis dan financial literacy.\"},{\"icon\":\"fa-users\",\"color\":\"yellow\",\"title\":\"Job Creation\",\"desc\":\"Menciptakan lapangan kerja melalui usaha berkelanjutan.\"},{\"icon\":\"fa-globe-asia\",\"color\":\"emerald\",\"title\":\"Dampak Sosial\",\"desc\":\"Mengembangkan usaha yang berdampak positif bagi masyarakat.\"}]', 'json', 'tentang_objectives', 'Objectives List', NULL, '2026-05-02 09:56:38'),
(71, 'tentang_cta_title', 'Siap Bergabung dengan PMW?', 'text', 'tentang_cta', 'CTA Title', NULL, '2026-05-02 09:56:38'),
(72, 'tentang_cta_description', 'Pelajari tahapan program selengkapnya dan persiapkan proposal terbaik Anda.', 'text', 'tentang_cta', 'CTA Description', NULL, '2026-05-02 09:56:38'),
(161, 'pengumuman_hero_badge', 'Informasi', 'text', 'pengumuman_hero', 'Hero Badge', NULL, '2026-05-02 09:56:38'),
(162, 'pengumuman_hero_title', 'Pengumuman Terbaru', 'text', 'pengumuman_hero', 'Hero Title', NULL, '2026-05-02 09:56:38'),
(163, 'pengumuman_hero_description', 'Informasi terbaru seputar Program Mahasiswa Wirausaha Politeknik Negeri Sriwijaya. Pantau terus pengumuman penting dan jadwal kegiatan.', 'text', 'pengumuman_hero', 'Hero Description', NULL, '2026-05-02 09:56:38'),
(218, 'home_stats_list', '[{\"icon\":\"fa-users\",\"val\":\"1000+\",\"label\":\"Peserta Terdaftar\",\"color\":\"sky\"},{\"icon\":\"fa-store\",\"val\":\"300+\",\"label\":\"Usaha Aktif\",\"color\":\"yellow\"},{\"icon\":\"fa-chalkboard-teacher\",\"val\":\"50+\",\"label\":\"Mentor Berpengalaman\",\"color\":\"emerald\"},{\"icon\":\"fa-hand-holding-dollar\",\"val\":\">2.5M\",\"label\":\"Total Dana Terdistribusi\",\"color\":\"amber\"}]', 'json', 'home_stats', 'Statistics Data', NULL, '2026-05-02 09:56:38'),
(282, 'home_hero_title', 'Program Mahasiswa Wirausaha', 'text', 'home_hero', 'Hero Title', NULL, '2026-05-02 09:56:38'),
(283, 'home_gallery_title', 'Galeri Kegiatan', 'text', 'home_gallery', 'Gallery Title', NULL, '2026-05-02 09:56:38'),
(284, 'tahapan_hero_title', 'Tahapan Program PMW', 'text', 'tahapan_hero', 'Hero Title', NULL, '2026-05-02 09:56:38'),
(285, 'tahapan_flow_title', 'Bagaimana Cara Mendaftar', 'text', 'tahapan_flow', 'Flow Title', NULL, '2026-05-02 09:56:38'),
(286, 'home_announcement_badge', 'Informasi Terkini', 'text', 'home_announcement', 'Announcement Badge', NULL, '2026-05-02 09:56:38'),
(287, 'home_announcement_title', 'Pengumuman Terbaru', 'text', 'home_announcement', 'Announcement Title', NULL, '2026-05-02 09:56:38'),
(288, 'home_announcement_description', 'Pantau terus informasi penting seputar Program Mahasiswa Wirausaha.', 'text', 'home_announcement', 'Announcement Description', NULL, '2026-05-02 09:56:38');

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
(2, 1, 4, 'Pengumuman Kelolosan Dana Tahap I', 'Mantap semuanya', '2026-04-30 12:00:00', 'Aula POLTEK', 'Baju Hitam Putih dan Bawa Bekal Menuju Akhirat', 'uploads/pmw/sk/1777450116_a676f3de6920e0cabd44.pdf', 'SK Mantap.pdf', 1, '2026-04-29 15:12:49', '2026-04-29 11:39:24', '2026-04-29 15:12:49');

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
  `topic` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deadline_days` int UNSIGNED DEFAULT '5' COMMENT 'Batas waktu pengisian logbook oleh mahasiswa (dalam hari)',
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
(4, 32, 'aziz', 'Bakso Granat', 'CEO', 'Masak', '0980989874', 'Aziz@gmail.com', '', '2026-04-30 10:01:20', '2026-04-30 10:01:20'),
(5, 114, 'Reviewer1', 'Politeknik Negeri Sriwijaya', 'Reviewer', 'Review', '08123456789', 'reviewer@gmail.com', 'Menjadi Reviewer', '2026-06-01 14:42:27', '2026-06-01 14:42:27');

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
(140, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Dinni\' telah mengirimkan berkas pitching desk untuk usaha \'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)\'', 'admin/pitching-desk', 72, 0, NULL, '2026-05-25 22:56:11', '2026-05-25 22:56:11'),
(141, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Melina Safitri\' telah mengirimkan berkas pitching desk untuk usaha \'bouquething_project\'', 'admin/pitching-desk', 27, 1, '2026-05-26 13:10:51', '2026-05-25 23:47:10', '2026-05-26 13:10:51'),
(142, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Muhammad Rizky\' telah mengirimkan berkas pitching desk untuk usaha \'Mayzera 2024 Strore\'', 'admin/pitching-desk', 85, 0, NULL, '2026-05-31 09:38:50', '2026-05-31 09:38:50'),
(143, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'Valen Geraldi\' telah mengirimkan berkas pitching desk untuk usaha \'MY SIOMAY\'', 'admin/pitching-desk', 87, 1, '2026-06-01 12:01:27', '2026-05-31 20:46:34', '2026-06-01 12:01:27'),
(144, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M. Fathir Sumizi Rahman\' telah mengirimkan berkas pitching desk untuk usaha \'F&D Design Creative\'', 'admin/pitching-desk', 82, 0, NULL, '2026-05-31 22:38:37', '2026-05-31 22:38:37'),
(145, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M Febriansyah\' telah mengirimkan berkas pitching desk untuk usaha \'PEKSANG\'', 'admin/pitching-desk', 89, 0, NULL, '2026-05-31 23:02:24', '2026-05-31 23:02:24'),
(146, NULL, 'pitching_submitted', 'Berkas Pitching Desk Masuk', 'Tim \'M.Satria Wijaksono_Akuntansi\' telah mengirimkan berkas pitching desk untuk usaha \'TrinketsKu\'', 'admin/pitching-desk', 24, 0, NULL, '2026-05-31 23:59:54', '2026-05-31 23:59:54');

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
(20, 20, NULL, 'pending', NULL, '2026-05-03 22:51:30', '2026-05-03 22:51:30'),
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
(31, 31, NULL, 'pending', NULL, '2026-05-08 18:44:43', '2026-05-08 18:44:43'),
(32, 32, NULL, 'pending', NULL, '2026-05-10 08:46:55', '2026-05-10 08:46:55'),
(33, 33, NULL, 'pending', NULL, '2026-05-10 15:08:24', '2026-05-10 15:08:24'),
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
(49, 49, NULL, 'pending', NULL, '2026-05-16 10:08:37', '2026-05-16 10:08:37'),
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
(61, 61, NULL, 'pending', NULL, '2026-05-20 15:22:10', '2026-05-20 15:22:10'),
(62, 62, NULL, 'pending', NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, NULL, 'pending', NULL, '2026-05-21 12:55:59', '2026-05-21 12:55:59'),
(64, 64, NULL, 'pending', NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, NULL, 'pending', NULL, '2026-05-21 16:09:44', '2026-05-21 16:09:44'),
(66, 66, NULL, 'pending', NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(67, 67, NULL, 'pending', NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(68, 68, NULL, 'pending', NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(69, 69, NULL, 'pending', NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(70, 70, NULL, 'pending', NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(71, 71, NULL, 'pending', NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(72, 72, NULL, 'pending', NULL, '2026-05-23 12:32:08', '2026-05-23 12:32:08'),
(73, 73, NULL, 'pending', NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, NULL, 'pending', NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(75, 75, NULL, 'pending', NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(76, 76, NULL, 'pending', NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(77, 77, NULL, 'pending', NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(78, 78, NULL, 'pending', NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(79, 79, NULL, 'pending', NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, NULL, 'pending', NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(81, 81, NULL, 'pending', NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(82, 82, NULL, 'pending', NULL, '2026-05-24 21:24:13', '2026-05-24 21:24:13'),
(83, 83, NULL, 'pending', NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(84, 84, NULL, 'pending', NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(85, 85, NULL, 'pending', NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(86, 86, NULL, 'pending', NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, NULL, 'pending', NULL, '2026-05-25 21:19:46', '2026-05-25 21:19:46'),
(88, 88, NULL, 'pending', NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, NULL, 'pending', NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16');

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
(60, 81, 'Administrator', '1122334455', 'Teknik Mesin', 'D-III Teknik Mesin', 2, '082272825100', 'L', NULL, NULL, 'uploads/profiles/profile_6a0c6cdc8ad2f2.88985237.jpg', '2026-05-19 20:59:29', '2026-05-19 20:59:56'),
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
(87, 108, 'test', '1111111111111', 'Teknik Komputer', 'D-IV Teknologi Informatika Multimedia Digital', 5, '111111111111', 'L', NULL, NULL, NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(88, 109, 'Muhammad Rizky', '062240512647', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 8, '082175981859', 'L', NULL, NULL, NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(89, 110, 'Maulana Fajar Pratama', '062440833329', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '089687820402', 'L', NULL, NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(90, 111, 'Valen Geraldi', '062440632952', 'Administrasi Bisnis', 'D-IV Manajemen Bisnis', 4, '082289240408', 'L', NULL, NULL, 'uploads/profiles/profile_6a145ea51e4c80.01858243.jpg', '2026-05-25 21:19:46', '2026-05-25 21:37:25'),
(91, 112, 'Akbar Rizky Fernando', '062340111952', 'Teknik Sipil', 'D-IV Perancangan Jalan dan Jembatan', 6, '088747371378', 'L', NULL, NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(92, 113, 'M Febriansyah', '062440663078', 'Administrasi Bisnis', 'D-IV Bisnis Digital', 4, '08972426774', 'L', NULL, NULL, NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16');

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
(20, 1, 42, 'Jasa Sosial', 'kicksparkle', 'pemula', 'KickSparkle merupakan usaha jasa cuci dan perawatan sepatu yang telah berjalan kurang lebih selama 6 bulan. Usaha ini hadir untuk membantu pelanggan menjaga kebersihan, kenyamanan, dan penampilan sepatu agar tetap terlihat bersih seperti baru. KickSparkle menyediakan berbagai layanan, seperti cuci sepatu reguler, deep cleaning, whitening, repaint sederhana, perawatan suede dan canvas, serta layanan pengeringan dan pewangi sepatu. Dalam proses pengerjaan, KickSparkle menggunakan peralatan dan bahan khusus yang aman untuk berbagai jenis sepatu sehingga kualitas sepatu tetap terjaga.\n\nTarget pasar utama usaha ini adalah mahasiswa, karena banyak mahasiswa yang aktif menggunakan sepatu untuk kegiatan kuliah maupun organisasi sehingga membutuhkan layanan perawatan sepatu yang praktis dan terjangkau. Selain itu, KickSparkle juga menyasar komunitas basket yang membutuhkan perawatan rutin untuk menjaga kebersihan dan kenyamanan sepatu olahraga. Target pasar lainnya adalah pengajar dan pekerja, yang membutuhkan penampilan rapi dan profesional dalam aktivitas sehari-hari. Tidak hanya itu, usaha ini juga terbuka untuk masyarakat umum yang ingin merawat sepatu kesayangan agar lebih awet, bersih, dan nyaman digunakan.\n\nDengan pelayanan yang ramah, hasil pengerjaan yang maksimal, serta harga yang terjangkau, KickSparkle berkomitmen menjadi solusi terpercaya dalam jasa perawatan sepatu di lingkungan sekitar.', NULL, 6, 'kicksparkle', NULL, NULL, 'draft', NULL, NULL, '2026-05-03 22:51:30', '2026-05-25 15:09:18'),
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
(31, 1, 55, 'Digital', 'Webora Studio', 'berkembang', 'Webora Studio merupakan usaha jasa digital yang bergerak di bidang pembuatan dan pengembangan website profesional. Usaha ini menyediakan layanan website company profile, landing page bisnis, website portofolio, pengembangan web app, mobile app, serta maintenance website sesuai kebutuhan klien. Webora Studio hadir untuk membantu UMKM, startup, mahasiswa, organisasi, dan pelaku usaha dalam membangun identitas digital yang modern, responsif, dan profesional.\n\nTarget pasar Webora Studio meliputi UMKM, pelaku bisnis, startup, organisasi, instansi, dan individu yang membutuhkan solusi digital untuk meningkatkan eksistensi serta jangkauan usahanya. Keunggulan Webora Studio terletak pada desain yang menyesuaikan kebutuhan klien, layanan yang fleksibel, proses pengembangan yang modern, serta fokus pada kualitas dan pengalaman pengguna.', 1, NULL, '@weboraa.studio', 'https://drive.google.com/file/d/1jKa8_1K0GDlI94UGKIFjx6Qj_SUD0qIZ/view?usp=sharing', NULL, 'draft', NULL, NULL, '2026-05-08 18:44:43', '2026-05-25 11:16:58'),
(32, 1, 56, 'Jasa Sosial', 'MEMORIES', 'pemula', '“Memories” merupakan usaha kreatif yang bergerak di bidang buket dan dekorasi acara dengan menawarkan produk seperti buket bunga, buket snack, dan buket balon yang aesthetic, berkualitas, dan terjangkau. Target pasar usaha ini adalah remaja, mahasiswa, hingga masyarakat umum di Kota Palembang dan sekitarnya yang membutuhkan dekorasi untuk momen wisuda, ulang tahun, anniversary, lamaran, dan pernikahan. Ke depannya, “Memories” juga akan mengembangkan layanan seperti papan bunga, photobooth, kotak hantaran, mahar frame, dan backdrop dekorasi untuk memenuhi kebutuhan pelanggan secara lebih lengkap.', NULL, 3, 'memories_palembang', NULL, NULL, 'draft', NULL, NULL, '2026-05-10 08:46:55', '2026-05-25 14:50:42'),
(33, 1, 57, 'Jasa Sosial', 'Ardhana Agency', 'berkembang', '', 1, NULL, 'ardhana_agency', 'https://drive.google.com/file/d/1A3Jfj2PMPE4vgUGcAsTqUTzUWpvszJXM/view?usp=drivesdk', NULL, 'draft', NULL, NULL, '2026-05-10 15:08:24', '2026-05-24 21:16:00'),
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
(49, 1, 73, 'Kreatif', 'by.juwita', 'berkembang', 'by.juwita merupakan usaha buket yang berdiri sejak tahun 2019 Jl. Kopral Ramin II Palembang. Usaha ini menyediakan berbagai jenis buket seperti bouquet bunga artificial, money buket, snack buket, dan gift buket untuk berbagai momen spesial seperti wisuda, ulang tahun, dan anniversary. Dengan mengutamakan desain yang estetik dan custom dari custumer, by.juwita ingin terus berkembang melalui pemasaran media sosial serta pelayanan yang mengikuti kebutuhan pelanggan.', 1, 11, 'by.juwita ', 'https://youtube.com/shorts/pxkUAR8RlPU?si=ftVuPeiabtgnUfd4', NULL, 'draft', NULL, NULL, '2026-05-16 10:08:37', '2026-05-25 09:54:43'),
(50, 1, 74, 'Kreatif', 'Lumiara', 'pemula', 'LUMIARA merupakan bisnis kreatif ramah lingkungan dengan tagline “Less Plastic, More Aesthetic” yang menghadirkan cup holder dan tumbler holder berbahan rajutan tangan (crochet) bertema bunga, usaha ini bertujuan mengurangi penggunaan plastik sekali pakai dengan menghadirkan pelindung minuman yang juga berfungsi sebagai aksesori fesyen modern.\nTarget pasar LUMIARA meliputi pecinta produk ramah lingkungan, komunitas handmade/DIY, dan kafe yang membutuhkan merchandise eco-friendly. Pemasaran dilakukan melalui Instagram, TikTok, dan Shopee,  LUMIARA berencana menghadirkan koleksi pre-order eksklusif serta workshop merajut untuk membangun komunitas dan meningkatkan loyalitas pelanggan.', NULL, NULL, NULL, 'https://drive.google.com/file/d/1TcAdVxrkC361apeKaR9_j1Whxu24FSKv/view?usp=drivesdk', NULL, 'draft', NULL, NULL, '2026-05-17 12:39:29', '2026-05-24 12:37:51'),
(51, 1, 75, 'Boga', 'Bakaran Risa - Serba 2RB', 'berkembang', 'Usaha “Bakaran Risa” merupakan usaha kuliner skala mikro yang bergerak di bidang makanan dan minuman dengan konsep utama menyediakan aneka makanan bakaran dengan harga terjangkau, yaitu mulai dari Rp2.000. Usaha ini didirikan sebagai bentuk pengembangan usaha mandiri yang bertujuan untuk memenuhi kebutuhan masyarakat terhadap makanan ringan yang praktis, lezat, dan ekonomis.\nUsaha ini menawarkan berbagai jenis produk, seperti bakso bakar, sosis bakar, tahu bakar, otak-otak bakar, minuman, serta menu pelengkap lainnya yang disajikan dengan cita rasa khas dan proses pembakaran langsung sehingga menghasilkan aroma dan rasa yang menarik bagi konsumen. Konsep “serba 2 ribu” menjadi daya tarik utama karena memberikan kesempatan kepada semua kalangan masyarakat untuk menikmati makanan dengan harga yang murah dan ramah di kantong.\nTarget pasar usaha ini meliputi pelajar, mahasiswa, pekerja, karyawan toko, serta masyarakat umum yang membutuhkan makanan cepat saji dengan harga terjangkau. Lokasi usaha yang berada di kawasan pinggir jalan ramai juga menjadi faktor pendukung dalam menarik konsumen, karena mudah dijangkau dan terlihat oleh orang yang melintas.\nDalam menjalankan usahanya, “Bakaran Risa - Serba 2 Ribu” menerapkan strategi berupa:\nharga yang ekonomis,\nvariasi menu yang beragam,\npelayanan yang cepat dan ramah,\nserta menjaga kualitas rasa dan kebersihan produk.\nSelain berorientasi pada keuntungan, usaha ini juga menjadi sarana pengembangan jiwa kewirausahaan, kreativitas, dan inovasi dalam menciptakan peluang usaha di bidang kuliner. Melalui konsep sederhana namun menarik, usaha ini diharapkan mampu berkembang lebih besar, dikenal masyarakat luas, serta memiliki daya saing di tengah berkembangnya bisnis kuliner modern.\nNama “Bakaran Risa” sendiri memiliki makna sebagai identitas usaha kuliner milik Risa yang menyediakan aneka makanan bakaran dengan harga terjangkau untuk semua kalangan masyarakat. Nama ini mencerminkan semangat usaha, kerja keras, serta tujuan untuk menghadirkan makanan yang enak, murah, dan mudah dinikmati oleh siapa saja.', 2, 5, NULL, 'https://youtube.com/shorts/H7BT12JwOME?si=3kaEi3t3x7Vg8b8v', NULL, 'draft', NULL, NULL, '2026-05-18 15:50:14', '2026-06-02 08:47:45'),
(52, 1, 76, 'Kreatif', 'Charmu', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 09:39:39', '2026-05-25 09:03:56'),
(53, 1, 77, 'Digital', 'Juniorers_Store', 'pemula', 'Juniorers_Store adalah usaha di bidang jasa digital gaming yang berlokasi di Palembang dan beroperasi secara online. Usaha ini didirikan pada bulan September tahun 2021 dan sempat dinonaktifkan pada tahun 2022 akhir, dan rencananya akan diaktifkan kembali jika usaha ini disetujui sampai tahap lolos seleksi. Jam operasional setiap hari Senin hingga Minggu pukul 09.00 hingga 22.00 WIB. Juniorers_Store menawarkan dua layanan utama yaitu top up game (Mobile Legends, Free Fire, Valorant, PUBG, dan voucher game) serta jasa jual beli akun game yang meliputi mediator escrow, verifikasi akun, dan titip jual. Target konsumen adalah remaja dan mahasiswa usia 15 hingga 25 tahun di Palembang.', NULL, 15, 'juniorers_store', NULL, NULL, 'draft', NULL, NULL, '2026-05-19 10:46:34', '2026-05-22 06:55:36'),
(54, 1, 78, 'Boga', 'ricebowl \"BOWLKITA\"', 'pemula', 'Usaha yang saya jalankan bernama BowlKita, yaitu usaha kuliner yang menyediakan makanan siap saji berupa rice bowl dengan berbagai pilihan menu yang praktis, enak, dan harga terjangkau. Produk yang ditawarkan terdiri dari rice bowl ayam crispy, ayam saus pedas/manis, beef bowl, serta menu tambahan seperti topping dan minuman. BowlKita mengutamakan kualitas bahan baku, rasa yang konsisten, serta penyajian yang higienis dan menarik. Target pasar BowlKita adalah pelajar, mahasiswa, karyawan, dan masyarakat umum yang membutuhkan makanan cepat saji dengan harga terjangkau.', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 11:24:58', '2026-05-21 00:03:35'),
(55, 1, 79, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 1, 80, 'Digital', 'ARCTECH CCTV', 'berkembang', 'ARCTECH CCTV adalah usaha yang bergerak di bidang solusi keamanan dan pengawasan modern, menyediakan layanan pemasangan, perawatan, dan konsultasi sistem CCTV untuk rumah, toko, kantor, gudang, hingga area industri. Dengan mengutamakan kualitas, ketepatan pemasangan, dan teknologi terkini, ARCTECH CCTV hadir untuk membantu pelanggan menciptakan lingkungan yang lebih aman, nyaman, dan terpantau setiap saat.\n\nLayanan yang ditawarkan meliputi instalasi CCTV analog dan IP camera, setting monitoring online via smartphone, perbaikan dan maintenance CCTV, penataan jaringan, serta upgrade sistem keamanan sesuai kebutuhan pelanggan. Didukung oleh tenaga teknisi yang profesional dan berpengalaman, ARCTECH CCTV berkomitmen memberikan pelayanan cepat, hasil rapi, dan solusi terbaik dengan harga kompetitif.', 1, NULL, NULL, 'https://youtube.com/shorts/f8fRjPlgZBQ?feature=shared', NULL, 'draft', NULL, NULL, '2026-05-19 11:26:44', '2026-05-25 18:27:29'),
(57, 1, 81, 'Digital', 'Administrator', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 21:00:59'),
(58, 1, 82, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 1, 83, 'Teknologi Non Digital', 'TitikKampus ', 'pemula', 'TitikKampus merupakan usaha layanan printing dan kebutuhan akademik mahasiswa yang berlokasi di Rusunawa Politeknik Negeri Sriwijaya Kampus Banyuasin. Usaha ini menyediakan layanan print hitam putih, print warna, scan, fotokopi, laminating, jilid, cetak foto, penjualan ATK, serta layanan desain tugas dan presentasi. TitikKampus hadir sebagai solusi atas keterbatasan layanan printing yang dekat, cepat, dan praktis bagi mahasiswa di lingkungan kampus Banyuasin. Selain layanan offline, usaha ini juga menyediakan pemesanan online dan layanan antar untuk mempermudah mahasiswa dalam memenuhi kebutuhan akademik.', NULL, 2, NULL, 'https://drive.google.com/drive/folders/1C0qihNgvca33qaaywxuhnQ809uVBbPoe', NULL, 'draft', NULL, NULL, '2026-05-20 12:59:15', '2026-05-24 11:31:18'),
(60, 1, 84, 'Boga', 'Milky Quest', 'pemula', '', NULL, 4, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 14:04:10', '2026-05-23 19:02:41'),
(61, 1, 85, 'Boga', 'Topi.co', 'berkembang', 'Topi.co adalah usaha yang berbasis kopi nusantara dengan mengusung kopi Pagar Alam dan kopi gula aren dari kota Lubuk Linggau', 1, 4, 'topii_coo', 'https://youtu.be/gYryONckc7Y?si=P8NcE2NV5Y54xWXT', NULL, 'draft', NULL, NULL, '2026-05-20 15:22:10', '2026-05-22 16:11:08'),
(62, 1, 86, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 1, 87, 'Kreatif', 'Aromelle', 'pemula', '1.	IDE USAHA\nAromelle merupakan usaha kreatif yang bergerak di bidang kerajinan handmade aromaterapi dengan menggabungkan unsur estetika, personalisasi, dan fungsi relaksasi dalam setiap produknya. Berbeda dengan produk kerajinan pada umumnya, seluruh produk aromelle dirancang menggunakan essence beads atau media penyerap minyak esensial yang mampu menyimpan dan menyebarkan aroma terapi secara perlahan. Dengan demikian, produk tidak hanya berfungsi sebagai aksesori, tetapi juga memberikan efek menenangkan, menyegarkan, serta meningkatkan kenyamanan pengguna dalam aktivitas sehari-hari.				Ide usaha ini muncul dari meningkatnya kebutuhan masyarakat terhadap produk self-care dan wellness yang praktis, estetik, dan mudah digunakan. Di sisi lain, sebagian besar produk aromaterapi yang tersedia di pasaran masih memiliki keterbatasan, seperti penggunaan yang kurang praktis, desain yang monoton, serta hanya dapat digunakan di dalam ruangan. Melalui aromelle, kami menghadirkan inovasi berupa produk kerajinan aromaterapi portable yang dapat digunakan kapan saja dan di mana saja tanpa memerlukan alat tambahan seperti listrik atau api. Produk utama yang ditawarkan aromelle meliputi gelang aromaterapi handmade dan gantungan kunci aromaterapi berbahan kawat bulu (pipe cleaner) yang dipadukan dengan essence beads berpori sebagai media penyimpan aroma. Setiap produk dapat dikustomisasi sesuai preferensi konsumen, baik dari segi warna, bentuk, karakter, maupun jenis aroma yang digunakan. Aroma yang tersedia antara lain lavender untuk membantu relaksasi, peppermint untuk meningkatkan fokus, serta lemon dan sweet orange untuk memberikan efek segar dan meningkatkan suasana hati. Keunggulan utama aromelle terletak pada perpaduan antara fungsi aromaterapi dan nilai estetika handmade dalam satu produk. Produk tidak hanya digunakan sebagai aksesori fashion dan gantungan kunci, tetapi juga sebagai media relaksasi portable yang dapat membantu mengurangi stres ringan, memberikan rasa nyaman, serta menjadi sarana ekspresi diri bagi pengguna. Selain itu, produk bersifat reusable karena aroma dapat digunakan kembali hanya dengan meneteskan ulang minyak esensial pada essence beads.	Dengan konsep yang inovatif, kreatif, dan mengikuti tren wellness serta self-care yang terus berkembang, aromelle memiliki peluang pasar yang luas, khususnya di kalangan remaja, mahasiswa, pekerja muda, serta masyarakat yang menyukai produk handmade estetik dengan nilai fungsi tambahan.\n\n2.	IDENTIFIKASI MASALAH ATAU KEBUTUHAN PASAR\nDi era modern saat ini, tingkat aktivitas dan tekanan hidup masyarakat semakin meningkat, sehingga memunculkan berbagai permasalahan seperti stres, kelelahan mental, sulit fokus, dan gangguan relaksasi ringan. Kondisi ini dialami oleh berbagai kalangan, mulai dari pelajar, mahasiswa, pekerja kantoran, hingga ibu rumah tangga. Seiring meningkatnya kesadaran masyarakat terhadap pentingnya kesehatan mental dan self-care, kebutuhan akan produk relaksasi yang praktis dan mudah digunakan juga semakin tinggi.			Produk aromaterapi yang umum tersedia di pasaran masih memiliki beberapa keterbatasan. Produk seperti diffuser listrik, lilin aroma, atau burner membutuhkan listrik maupun api sehingga kurang praktis digunakan saat bepergian. Sebagian produk aromaterapi memiliki desain yang monoton dan kurang menarik bagi kalangan muda karena lebih identik sebagai produk kesehatan dibandingkan aksesori gaya hidup. Sedangkan kerajinan handmade seperti gelang atau gantungan kunci memang memiliki nilai estetika yang tinggi, tetapi sebagian besar hanya berfungsi sebagai hiasan tanpa memiliki nilai guna tambahan. Hal ini membuat konsumen mulai mencari produk yang tidak hanya menarik secara visual, tetapi juga memiliki fungsi yang bermanfaat dalam kehidupan sehari-hari.				Aromelle hadir sebagai solusi dengan menghadirkan produk kerajinan handmade aromaterapi yang menggabungkan fungsi relaksasi dan estetika dalam satu produk. Seluruh produk aromelle, baik gelang maupun gantungan kunci kawat bulu, dilengkapi dengan essence beads yang dapat menyerap dan menyebarkan aroma minyak esensial secara perlahan. Dengan demikian, produk tidak hanya menjadi aksesori fashion dan kerajinan unik, tetapi juga dapat membantu memberikan efek menenangkan, meningkatkan fokus, dan menyegarkan suasana hati pengguna.	Selain menjawab kebutuhan relaksasi praktis, aromelle juga memanfaatkan peluang pasar dari tren wellness, self-care, dan produk aesthetic handmade yang saat ini berkembang pesat di media sosial seperti tiktok dan instagram. Konsumen, khususnya generasi z dan milenial, cenderung tertarik pada produk yang unik, dapat dikustomisasi, serta memiliki nilai emosional dan pengalaman penggunaan yang berbeda. Dengan menggabungkan konsep aromaterapi portable dan kerajinan handmade custom, aromelle memiliki peluang pasar yang luas serta mampu menghadirkan inovasi produk yang masih jarang ditemukan di pasaran.\n\n3.	SOLUSI USAHA YANG DITAWARKAN\nAromelle hadir sebagai solusi inovatif atas kebutuhan masyarakat terhadap produk relaksasi yang praktis, estetik, dan dapat digunakan dalam aktivitas sehari-hari. Aromelle menawarkan produk yang tidak hanya berfungsi sebagai aksesori atau hiasan, tetapi juga memiliki manfaat tambahan sebagai media aromaterapi portable. Produk utama aromelle adalah gelang aromaterapi dan gantungan kunci handmade berbahan kawat bulu yang dilengkapi dengan essence beads atau manik berpori. Essence beads tersebut mampu menyerap minyak esensial dan melepaskan aromanya secara perlahan sehingga pengguna dapat menikmati manfaat aromaterapi kapan saja dan di mana saja tanpa memerlukan listrik, api, ataupun alat tambahan lainnya. Solusi yang ditawarkan aromelle terletak pada kombinasi antara fungsi relaksasi dan nilai estetika produk. Konsumen tidak hanya memperoleh produk handmade yang menarik secara visual, tetapi juga mendapatkan manfaat aromaterapi yang dapat membantu mengurangi stres ringan, meningkatkan fokus, memberikan rasa nyaman, serta memperbaiki suasana hati. Hal ini menjadikan produk lebih fungsional dibandingkan produk kerajinan biasa yang hanya memiliki nilai dekoratif. Aromelle juga memberikan solusi dalam bentuk produk yang dapat dikustomisasi sesuai keinginan konsumen. Pelanggan dapat memilih desain, warna, karakter, bentuk hiasan, hingga jenis aroma yang diinginkan. Aromelle menjadi barang yang  memiliki nilai emosional yang lebih tinggi dan cocok digunakan sebagai aksesori pribadi maupun hadiah untuk orang lain.	\n									\n4.	KEUNIKAN DAN NILAI TAMBAH USAHA\nAromelle memiliki keunikan utama berupa kombinasi antara produk kerajinan handmade, aksesori estetik, dan fungsi aromaterapi dalam satu produk. Berbeda dengan usaha kerajinan pada umumnya yang hanya berfokus pada nilai estetika, aromelle menghadirkan produk yang tidak hanya menarik secara visual, tetapi juga memiliki manfaat relaksasi dan self-care bagi penggunanya.								Keunggulan utama aromelle terletak pada penggunaan essence beads atau manik berpori yang mampu menyerap dan menyebarkan aroma minyak esensial secara perlahan. Inovasi ini diterapkan tidak hanya pada gelang aromaterapi, tetapi juga pada gantungan kunci handmade berbahan kawat bulu. Seluruh produk aromelle memiliki ciri khas berupa aroma terapi yang dapat memberikan efek menenangkan, menyegarkan, serta meningkatkan kenyamanan pengguna dalam aktivitas sehari-hari.	Untuk meningkatkan ketahanan aroma, aromelle menggunakan kombinasi essential oil dan fiksatif yang diaplikasikan pada media silika gel atau essence beads. Fiksatif berfungsi sebagai pengikat aroma agar minyak esensial tidak mudah menguap, sehingga aroma dapat bertahan lebih lama dibandingkan aromaterapi biasa. Dengan penggunaan formulasi tersebut, aroma pada produk dapat bertahan kurang lebih hingga satu minggu, tergantung intensitas penggunaan, suhu lingkungan, dan jenis aroma yang digunakan. Hal ini menjadi nilai tambah karena pengguna tidak perlu terlalu sering melakukan pengisian ulang aroma.	Selain itu, aromelle menawarkan produk yang dapat dikustomisasi sesuai keinginan konsumen, baik dari segi warna, bentuk, karakter, hiasan, maupun pilihan aroma. Konsumen dapat memilih aroma tertentu seperti lavender untuk relaksasi, peppermint untuk meningkatkan fokus, atau citrus untuk membantu meningkatkan suasana hati (mood booster). Fitur personalisasi ini memberikan nilai emosional dan kesan eksklusif yang menjadi daya tarik tersendiri dibandingkan produk massal di pasaran. Dari sisi inovasi, aromelle menggabungkan tren wellness dan self-care dengan produk handmade modern yang mengikuti perkembangan gaya hidup generasi muda. Konsep ini masih tergolong jarang ditemukan di pasar lokal sehingga memberikan peluang diferensiasi yang kuat dibandingkan usaha aksesori atau kerajinan biasa.						Dalam aspek kualitas, produk dibuat secara handmade menggunakan bahan yang ringan, aman, nyaman digunakan, serta dapat digunakan kembali (reusable) hanya dengan meneteskan ulang minyak esensial pada essence beads. Desain produk juga dibuat dengan tampilan estetik dan modern agar sesuai dengan selera pasar saat ini.	Dari segi harga, produk aromelle ditawarkan dengan harga yang terjangkau sehingga dapat menjangkau berbagai kalangan, khususnya pelajar, mahasiswa, dan generasi muda. Meskipun memiliki fungsi tambahan sebagai aromaterapi, biaya produksi produk relatif efisien sehingga usaha tetap memiliki potensi margin keuntungan yang baik.	Kemudahan akses juga menjadi nilai tambah aromelle karena produk dipasarkan secara online melalui media sosial dan marketplace seperti Instagram, TikTok Shop, dan Shopee. Bentuk produk yang ringan dan praktis memudahkan proses pengemasan serta pengiriman ke berbagai daerah di Indonesia.\n\n5.	TARGET PASAR\nTarget pasar utama (primary market) aromelle difokuskan pada mahasiswa Politeknik Negeri Sriwijaya (POLSRI) serta komunitas mahasiswa di wilayah Palembang. Segmen ini dipilih karena memiliki mobilitas dan aktivitas akademik yang tinggi, sehingga membutuhkan produk relaksasi yang praktis, mudah digunakan, dan tetap memiliki nilai estetika. Selain itu, kalangan mahasiswa juga cenderung mengikuti tren self-care, wellness, dan produk handmade estetik yang saat ini berkembang pesat di media sosial.						Dalam upaya memperluas jangkauan pasar, aromelle juga menargetkan masyarakat umum secara nasional melalui pemanfaatan platform digital seperti tiktok, instagram, dan marketplace. Strategi pemasaran digital dilakukan dengan memanfaatkan tren konten aesthetic lifestyle, art & craft, self-care, serta video pendek seperti reels dan fyp yang memiliki potensi tinggi dalam menarik perhatian konsumen dari berbagai daerah.	Selain pengguna individu, aromelle juga membidik pasar sekunder (secondary market), yaitu konsumen yang membutuhkan produk custom untuk hadiah ulang tahun, hadiah wisuda, souvenir acara, hampers, maupun pemesanan dalam jumlah besar untuk kegiatan organisasi, perkuliahan, dan acara personal lainnya. Dengan target pasar yang luas dan sesuai dengan tren gaya hidup modern, aromelle memiliki peluang untuk berkembang sebagai produk handmade aromaterapi yang diminati berbagai kalangan masyarakat. \n', NULL, NULL, NULL, 'https://drive.google.com/drive/folders/1vcxAtmTwssOOKv_BosDBbOnPmjQ2fzbX', NULL, 'draft', NULL, NULL, '2026-05-21 12:55:59', '2026-05-25 13:22:08'),
(64, 1, 88, 'Boga', 'Ayammy Saus', 'pemula', '', NULL, 4, 'ayammy_saus', NULL, NULL, 'draft', NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:48:35'),
(65, 1, 89, 'Kreatif', 'Sik Sak Sock', 'pemula', 'Sik Sak Sock merupakan usaha yang bergerak di bidang fashion dengan konsep lucu dan fun, khususnya produk kaos kaki yang mengutamakan kenyamanan dan gaya. Sik Sak Sock hadir sebagai pilihan kaos kaki yang dapat digunakan disemua rentang usia untuk berbagai aktivitas sehari-hari, baik untuk sekolah, kuliah, bekerja, olahraga, maupun kegiatan santai.', NULL, 1, '@siksak.sock', 'https://drive.google.com/drive/folders/1xzffmpANzuS1HXsV1DrW1oO1HvFvk7DF?usp=sharing', NULL, 'draft', NULL, NULL, '2026-05-21 16:09:44', '2026-05-25 15:03:45'),
(66, 1, 90, 'Boga', 'Mazefoods/ Gyoza Ayam dan Es Jelly Kelapa', 'pemula', '', NULL, NULL, 'mazefoods', NULL, NULL, 'draft', NULL, NULL, '2026-05-21 18:19:25', '2026-05-25 12:38:39'),
(67, 1, 91, 'Kreatif', 'Slay Side MUA', 'pemula', 'Slay Side merupakan usaha jasa Make Up Artist (MUA) yang bergerak di bidang kecantikan dan fashion. Kami menyediakan layanan makeup, hair do, dan hijab do untuk berbagai acara seperti wisuda, pesta, photoshoot, penari hingga acara formal lainnya. Slay Side mengutamakan hasil yang rapi, modern, elegan, dan sesuai dengan keinginan pelanggan agar tampil lebih percaya diri. Target pasar kami adalah remaja hingga dewasa, khususnya wanita yang membutuhkan jasa kecantikan dengan harga terjangkau dan kualitas terbaik.', NULL, NULL, 'slayside_mua', NULL, NULL, 'draft', NULL, NULL, '2026-05-22 07:52:38', '2026-05-24 21:01:17'),
(68, 1, 92, 'Boga', 'Pancong Waffle', 'pemula', 'Jenis usaha yang kami pilih ialah makanan ringan tradisional yang menggabungkan kue pancong tradisional dengan berbagai varian topping yang lebih modern.Kue Pancong merupakan makanan khas betawi.oleh karena itu,untuk produk yang kami jual ialah pancong waffle.Selain memberikan rasa yang lebih modern,juga memberikan inovasi dengan bentuk waffle.varian topping yang kami pilih seperti matcha,cokelat,choco Crunchy,dan menambahkan ice cream.target pasar dari produk kami ialah mahasiswa dan masyarakat umum.tempat yang kami pilih ialah di area kampus dan area ramai masyarakat serta memiliki lokasi yang strategis.', NULL, NULL, 'pancongwafflegenz_', NULL, NULL, 'draft', NULL, NULL, '2026-05-22 08:02:18', '2026-05-25 05:14:39'),
(69, 1, 93, 'Kreatif', 'Bloomie Studio', 'pemula', 'Usaha kerajinan tangan dengan produk bunga dari pipe cleaner.', NULL, 1, '-', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 10:42:51', '2026-05-25 00:01:59'),
(70, 1, 94, 'Boga', 'Mini Melty', 'pemula', 'Mini Melty adalah usaha dessert box mini yang menjual camilan manis berukuran praktis, rasa premium, tampilan imut, dan harga ramah mahasiswa. Produk dibuat fresh by order serta dipasarkan melalui media sosial, pre-order, dan penjualan langsung di lingkungan kampus.', NULL, NULL, '-', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 10:57:24', '2026-05-25 17:04:38'),
(71, 1, 95, 'Kreatif', 'Charmate / Bagcharm', 'pemula', 'Charmate adalah usaha kreatif yang bergerak di bidang aksesoris custom, khususnya bag charm dengan desain unik dan estetik. Charmate hadir untuk membantu anak muda mengekspresikan diri melalui gantungan tas yang lucu, trendy, dan memiliki makna personal. Produk Charmate terinspirasi dari berbagai elemen menarik seperti logo himpunan, program studi, hingga desain kekinian yang cocok digunakan sehari-hari.\nDengan mengutamakan kualitas, detail desain, dan kreativitas, Charmate tidak hanya menjadi aksesoris biasa, tetapi juga simbol identitas dan gaya penggunanya. Charmate cocok digunakan sebagai pelengkap fashion, hadiah, maupun merchandise komunitas dan organisasi.', NULL, 1, 'charm.mate', 'https://drive.google.com/drive/folders/14WHKXfBCeOHzdqr-PXrpCwek6dHrHw6D', NULL, 'draft', NULL, NULL, '2026-05-23 11:51:45', '2026-05-24 14:51:02'),
(72, 1, 96, 'Boga', 'Noye UbePop / UbePudding (Pudding Ubi Ungu) & UbeIceCream (Es Krim Ubi Ungu)', 'pemula', 'Noye UbePop adalah usaha dessert berbahan dasar ubi ungu yang menjual UbePudding dan UbeIceCream dengan rasa manis, creamy, dan warna ungu yang cantik. Awalnya usaha ini jualan pudding, lalu berkembang bikin ice cream supaya pilihan produknya makin banyak dan menarik. Noye UbePop hadir buat anak muda yang suka jajanan manis, unik, kekinian, harga terjangkau, namun tetap bergizi dan cocok buat nemenin santai, nongkrong, ataupun jadi cemilan favorit sehari-hari.', NULL, 6, '@noye.ubepop', NULL, NULL, 'draft', NULL, NULL, '2026-05-23 12:32:08', '2026-05-25 19:49:15'),
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
(82, 1, 106, 'Digital', 'F&D Design Creative', 'pemula', 'F&D Design Creative merupakan usaha yang bergerak di bidang jasa desain grafis dan termasuk dalam industri kreatif digital. Usaha ini berfokus pada pembuatan berbagai kebutuhan visual seperti desain logo, poster, pamflet, banner, konten media sosial, desain presentasi, katalog sederhana, kartu nama, sertifikat, serta kebutuhan desain lainnya. Setiap desain dibuat sesuai dengan permintaan pelanggan dengan mengutamakan kreativitas, kerapian, tampilan yang menarik, dan kesesuaian konsep yang diinginkan.\n\nUsaha ini didirikan oleh M. Fathir Sumizi Rahman dan Muhammad Dafa Arghandi dengan nama F&D Design Creative. Nama tersebut diambil dari inisial pendiri usaha dan mencerminkan kerja sama, kreativitas, serta komitmen dalam memberikan layanan desain yang berkualitas. Slogan yang digunakan adalah “Desain Keren, Auto Dilirik”, yang menggambarkan tujuan usaha untuk menghasilkan desain yang menarik perhatian dan mampu meningkatkan daya tarik visual suatu brand. \n\nTarget utama dari F&D Design Creative adalah mahasiswa, pelaku UMKM, dan masyarakat umum, khususnya yang berada di wilayah Palembang. Mahasiswa membutuhkan desain untuk keperluan tugas, presentasi, poster kegiatan, dan organisasi, sedangkan pelaku UMKM membutuhkan desain untuk promosi usaha seperti logo, banner, katalog, dan konten digital agar produk atau jasa mereka terlihat lebih profesional. \n\nSistem pelayanan usaha ini dilakukan secara fleksibel dan berbasis online melalui media sosial seperti WhatsApp dan Instagram. Pelanggan dapat melakukan pemesanan, konsultasi konsep, mengirim referensi, meminta revisi, hingga menerima hasil akhir desain secara digital tanpa harus datang langsung ke lokasi. Hal ini membuat proses pelayanan menjadi lebih praktis, cepat, dan mudah dijangkau oleh pelanggan. \n\nKeunggulan dari F&D Design Creative terletak pada harga yang terjangkau, pelayanan yang ramah dan responsif, proses pengerjaan yang cepat, serta hasil desain yang dapat disesuaikan dengan kebutuhan pelanggan. Dengan memanfaatkan perangkat digital seperti laptop, handphone, koneksi internet, dan aplikasi desain grafis, usaha ini memiliki peluang yang cukup besar untuk berkembang karena kebutuhan visual di era digital terus meningkat. \n\nDengan adanya usaha F&D Design Creative, diharapkan dapat membantu mahasiswa, UMKM, dan masyarakat dalam memenuhi kebutuhan desain secara cepat, praktis, ekonomis, dan profesional. Selain itu, usaha ini juga memiliki prospek untuk terus berkembang melalui peningkatan kualitas desain, perluasan promosi online, serta penguatan branding agar lebih dikenal oleh masyarakat luas, khususnya di wilayah Palembang.', NULL, 2, 'fd.designcreative', 'https://drive.google.com/drive/folders/1dLat-9ECuyQE8DLqBCzYsqw5Rldg2AoC', NULL, 'draft', NULL, NULL, '2026-05-24 21:24:13', '2026-05-31 22:37:24'),
(83, 1, 107, 'Boga', 'Siomay 4U', 'pemula', 'Awal mula usaha Siomay 4U didirikan karena adanya praktikum mata kuliah kewirausahaan, kami mencari resep melalui tiktok dan youtube kemudian kami kembangkan resep sendiri dengan menyesuaikan selera konsumen. Konsumen kami sebagian besar adalah warga Politeknik Negeri Sriwijaya Kampus Banyuasin dan beberapa warga Pangkalan Balai. Di antara produk yang ada di bazzar, produk kami merupakan produk yang paling diminati konsumen karena harganya yang terjangkau, memiliki rasa enak yang sudah disesuaikan dengan selera konsumen. ', NULL, 3, 'siomay4u', 'https://youtube.com/shorts/QkjlkCUJhSw?si=lt-GJuCel2KvrmfC', NULL, 'draft', NULL, NULL, '2026-05-24 21:25:33', '2026-05-25 13:18:44'),
(84, 1, 108, '', '', 'pemula', NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(85, 1, 109, 'Digital', 'Mayzera 2024 Strore', 'berkembang', 'Mayzera 2024 Store merupakan usaha yang bergerak di bidang fashion tradisional Melayu modern yang menyediakan berbagai produk seperti baju melayu pria, baju kurung, songket, tanjak, dan perlengkapan pakaian adat lainnya. Usaha ini didirikan dengan tujuan untuk melestarikan budaya Melayu melalui produk fashion yang elegan, nyaman digunakan, serta mengikuti perkembangan tren masyarakat modern.\n\nProduk yang ditawarkan menyasar berbagai kalangan, mulai dari pelajar, mahasiswa, masyarakat umum, hingga kebutuhan acara adat, pernikahan, dan kegiatan formal lainnya. Selain mengutamakan kualitas bahan dan desain, Mayzera 2024 Store juga menawarkan harga yang terjangkau sehingga dapat menjangkau pasar yang lebih luas.\n\nSaat ini pemasaran dilakukan secara online melalui platform marketplace Shopee, tiktok, tokopedia dan lazada dengan nama toko “Mayzera 2024 Store”, sehingga memudahkan pelanggan dalam melakukan pemesanan dari berbagai daerah. Ke depannya, usaha ini akan terus dikembangkan melalui inovasi produk, peningkatan promosi digital, serta perluasan target pasar agar dapat menjadi brand fashion Melayu modern yang dikenal luas oleh masyarakat.', 1, 10, 'mayzera2024srore', 'https://drive.google.com/file/d/1IvbnK7ASKSrY16JAN4J1YvXj7QkhmsSU/view?usp=drive_link', NULL, 'draft', NULL, NULL, '2026-05-25 11:04:52', '2026-05-31 08:35:29'),
(86, 1, 110, 'Boga', 'Fajar Raya/ Onigiri Rendang ', 'pemula', '', NULL, 3, 'rm_fajar_raya', NULL, NULL, 'draft', NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:38:49'),
(87, 1, 111, 'Boga', 'MY SIOMAY', 'berkembang', 'My Siomay adalah unit usaha kuliner inovatif yang memproduksi siomay premium dengan memanfaatkan potensi pangan lokal. Berbeda dengan siomay pada umumnya, produk kami menggunakan formulasi 100% Tepung Sagu Murni dan Ikan Kakap Super dengan isian Telur Puyuh. Dengan positioning sebagai \"Solusi Kenyang Tanpa Nasi\", kami menawarkan produk yang sehat (gluten-free), tinggi protein, dan memiliki indeks kenyang yang setara dengan porsi makan besar.', 1, NULL, 'my__siomay', 'https://drive.google.com/drive/folders/1OCvfL-as0GOZLTiS67kQV3GjJYbKKRXh', NULL, 'draft', NULL, NULL, '2026-05-25 21:19:46', '2026-05-31 20:45:03'),
(88, 1, 112, '', '', 'pemula', '', NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:47'),
(89, 1, 113, 'Boga', 'PEKSANG', 'pemula', 'PEKSANG merupakan usaha makanan ringan yang bergerak di bidang pengolahan produk berbahan dasar pisang menjadi keripik pisang dengan inovasi varian rasa pedas dan manis. Usaha ini hadir sebagai bentuk pengembangan komoditas pisang yang melimpah di Indonesia menjadi produk bernilai tambah yang lebih menarik dan sesuai dengan preferensi konsumen masa kini. Varian rasa pedas menjadi keunggulan utama produk untuk menjawab tingginya minat masyarakat Indonesia terhadap makanan bercita rasa pedas, sementara varian manis disediakan untuk menjangkau pasar yang lebih luas. Target pasar utama PEKSANG adalah pelajar, mahasiswa, dan masyarakat usia produktif yang menyukai camilan praktis, terjangkau, dan memiliki cita rasa khas. Dengan bahan baku yang mudah diperoleh, proses produksi yang sederhana, serta peluang pemasaran melalui media sosial dan lingkungan kampus, PEKSANG memiliki potensi untuk berkembang menjadi produk camilan lokal yang inovatif, berdaya saing, dan berkelanjutan.', NULL, NULL, 'peksang__', 'https://youtube.com/shorts/rWnyX9z2Yk0?feature=share', NULL, 'draft', NULL, NULL, '2026-05-26 16:49:16', '2026-05-31 23:01:10');

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
(20, 20, NULL, NULL, '2026-05-03 22:51:30', '2026-05-03 22:51:30'),
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
(31, 31, NULL, NULL, '2026-05-08 18:44:43', '2026-05-08 18:44:43'),
(32, 32, NULL, NULL, '2026-05-10 08:46:55', '2026-05-10 08:46:55'),
(33, 33, NULL, NULL, '2026-05-10 15:08:24', '2026-05-10 15:08:24'),
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
(49, 49, NULL, NULL, '2026-05-16 10:08:37', '2026-05-16 10:08:37'),
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
(61, 61, NULL, NULL, '2026-05-20 15:22:10', '2026-05-20 15:22:10'),
(62, 62, NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, NULL, NULL, '2026-05-21 12:55:59', '2026-05-21 12:55:59'),
(64, 64, NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, NULL, NULL, '2026-05-21 16:09:44', '2026-05-21 16:09:44'),
(66, 66, NULL, NULL, '2026-05-21 18:19:25', '2026-05-21 18:19:25'),
(67, 67, NULL, NULL, '2026-05-22 07:52:38', '2026-05-22 07:52:38'),
(68, 68, NULL, NULL, '2026-05-22 08:02:18', '2026-05-22 08:02:18'),
(69, 69, NULL, NULL, '2026-05-23 10:42:51', '2026-05-23 10:42:51'),
(70, 70, NULL, NULL, '2026-05-23 10:57:24', '2026-05-23 10:57:24'),
(71, 71, NULL, NULL, '2026-05-23 11:51:45', '2026-05-23 11:51:45'),
(72, 72, NULL, NULL, '2026-05-23 12:32:08', '2026-05-23 12:32:08'),
(73, 73, NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, NULL, NULL, '2026-05-23 22:55:59', '2026-05-23 22:55:59'),
(75, 75, NULL, NULL, '2026-05-23 23:43:29', '2026-05-23 23:43:29'),
(76, 76, NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 11:57:30'),
(77, 77, NULL, NULL, '2026-05-24 12:49:36', '2026-05-24 12:49:36'),
(78, 78, NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 13:21:31'),
(79, 79, NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, NULL, NULL, '2026-05-24 19:03:57', '2026-05-24 19:03:57'),
(81, 81, NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 19:28:18'),
(82, 82, NULL, NULL, '2026-05-24 21:24:13', '2026-05-24 21:24:13'),
(83, 83, NULL, NULL, '2026-05-24 21:25:33', '2026-05-24 21:25:33'),
(84, 84, NULL, NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(85, 85, NULL, NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(86, 86, NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, NULL, NULL, '2026-05-25 21:19:46', '2026-05-25 21:19:46'),
(88, 88, NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, NULL, NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16');

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
(327, 35, 'ketua', 'Test User', '062277889922', 'Teknik Sipil', 'D-III Teknik Sipil', 6, '087789768777', 'testastest@gmail.com', NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(328, 36, 'ketua', 'Mantaps', '067787678766', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 6, '087787676766', 'mantaps@gmail.com', NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(329, 37, 'ketua', 'Lagi Lagi Test', '062276748555', 'Teknik Elektro', 'D-III Teknik Telekomunikasi', 2, '087767647622', 'testlagi@gmail.com', NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(330, 38, 'ketua', 'lagi test', '062289898989', 'Akuntansi', 'D-IV Akuntansi Sektor Publik', 2, '082287874488', 'lagitest@gmail.com', NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
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
(488, 55, 'ketua', 'Sutan Akbar Dwi Nugraha', '062440833337', 'Manajemen Informatika', 'D-IV Manajemen Informatika', 4, '085758292876', 'akbarcool998@gmail.com', NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
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
(1235, 84, 'ketua', 'test', '1111111111111', 'Teknik Komputer', 'D-IV Teknologi Informatika Multimedia Digital', 5, '111111111111', 'test@gmail.com', NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
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
(1497, 51, 'ketua', 'Risa Oktavia', '062530601226', 'Administrasi Bisnis', 'D-III Administrasi Bisnis', 2, '0895402538267', 'risaoktapiaa@gmail.com', NULL, '2026-06-02 08:47:45', '2026-06-02 08:47:45');

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
(1, 1, 1, 'Administrasi & Deck Evaluation', '2026-05-04', '2026-05-31', 'Tahap pengajuan awal: pengisian identitas usaha, data tim, unggah dokumen administrasi, File presentasi, dan video perkenalan usaha (wajib untuk kategori Berkembang).', 1, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(2, 1, 2, 'Pengumpulan Proposal', '2026-07-01', '2026-07-10', 'Tahap Proposal. Tim yang lolos Tahap 1 (Administrasi & Deck Evaluation) wajib mengunggah dokumen proposal utama dan RAB untuk divalidasi oleh dosen pendamping.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(4, 1, 3, 'Perjanjian Implementasi', '2026-07-01', '2026-07-10', 'Tahap verifikasi komitmen bagi tim yang lolos seleksi pitching. Meliputi wawancara pendalaman kesiapan eksekusi bisnis dan penandatanganan lembar perjanjian implementasi.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(5, 1, 4, 'Pengumuman Kelolosan Dana PMW Tahap I', '2026-07-01', '2026-07-10', 'Perilisan daftar tim yang berhak menerima pendanaan tahap awal. Dilanjutkan dengan pelatihan intensif (Workshop) untuk mematangkan strategi eksekusi bisnis, pemasaran, dan manajemen pengelolaan keuangan.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(6, 1, 6, 'Start Up Bisnis dan Pendampingan (Mentoring) & Magang', '2026-08-01', '2026-10-31', 'Fase eksekusi bisnis menggunakan dana modal yang diberikan. Tim wajib menjalankan operasional usaha sembari berkoordinasi secara rutin dengan dosen pembimbing dan mentor praktisi untuk memecahkan kendala di lapangan.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(7, 1, 7, 'Monitoring dan Evaluasi Tahap I (Bazar & Bootcamp kewirausahaan)', '2026-10-19', '2026-10-24', 'Monitoring dan Evaluasi (Monev) tahap pertama melalui simulasi pasar terbuka. Tim akan dinilai berdasarkan respons pasar, strategi pemasaran langsung (direct selling), kemasan produk, dan pencatatan transaksi awal.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(8, 1, 8, 'Monitoring dan Evaluasi Tahap II  (Lokasi Usaha Mahasiswa)', '2026-10-19', '2025-10-24', 'Kunjungan lapangan (observasi) oleh tim penilai ke lokasi operasional atau tempat produksi bisnis. Bertujuan untuk memvalidasi realisasi kemajuan usaha dan kesesuaian penggunaan anggaran.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(9, 1, 9, 'Pengumuman Tahap II', '2026-10-26', '2026-10-30', '\"Penetapan kelanjutan pendanaan berdasarkan akumulasi metrik penilaian dari Monev 1 dan Monev 2. Tim dengan kinerja dan arus kas bisnis yang tervalidasi sehat berhak menerima pencairan dana tahap akhir.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(10, 1, 10, 'Laporan Akhir & Penutupan', '2026-11-02', '2026-11-16', 'Kewajiban administratif final program. Setiap tim harus menyusun dan menyerahkan laporan komprehensif terkait rekapitulasi keuangan riil, evaluasi pencapaian target, dan rencana keberlanjutan bisnis (sustainability).', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(11, 1, 11, 'Awarding & Expo', '2026-11-23', '2026-11-25', 'Puncak acara PMW berupa pameran bisnis skala besar untuk uji pasar final, diakhiri dengan malam penganugerahan (Awarding) guna memberikan apresiasi kepada wirausaha mahasiswa terbaik berdasarkan indikator kinerja terukur.', 0, '2026-04-14 19:08:13', '2026-05-26 20:56:59'),
(23, 1, 5, 'Pembekalan Kewirausahaan, Administrasi, dan Keuangan', '2026-08-08', '2026-08-08', 'Fase pembekalan wajib bagi tim yang telah lolos pendanaan. Peserta akan mendapatkan materi komprehensif mengenai strategi operasional bisnis, standar administrasi pembukuan, dan manajemen arus kas keuangan. Setelah mengikuti kegiatan, peserta diwajibkan mengunggah bukti kehadiran berupa dokumentasi foto dan ringkasan materi sebagai syarat administratif ke tahap implementasi.', 0, '2026-04-16 19:25:21', '2026-05-26 20:56:59');

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
(84, 84, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(85, 85, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 11:04:52', '2026-05-25 11:04:52'),
(86, 86, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 13:28:13'),
(87, 87, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-25 21:19:46', '2026-05-25 21:19:46'),
(88, 88, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, NULL, 'pending', NULL, NULL, 'pending', NULL, NULL, '2026-05-26 16:49:16', '2026-05-26 16:49:16');

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pmw_selection_pitching`
--

INSERT INTO `pmw_selection_pitching` (`id`, `proposal_id`, `student_submitted_at`, `status`, `catatan`, `persentase_nilai`, `created_at`, `updated_at`) VALUES
(20, 20, '2026-05-25 15:09:30', 'pending', NULL, NULL, '2026-05-03 22:51:30', '2026-05-25 15:09:30'),
(21, 21, NULL, 'pending', NULL, NULL, '2026-05-04 10:56:06', '2026-05-04 10:56:06'),
(22, 22, NULL, 'pending', NULL, NULL, '2026-05-04 21:36:13', '2026-05-04 21:36:13'),
(23, 23, NULL, 'pending', NULL, NULL, '2026-05-05 15:32:39', '2026-05-05 15:32:39'),
(24, 24, '2026-05-31 23:59:54', 'pending', NULL, NULL, '2026-05-05 19:12:04', '2026-05-31 23:59:54'),
(25, 25, NULL, 'pending', NULL, NULL, '2026-05-05 20:09:23', '2026-05-05 20:09:23'),
(26, 26, '2026-05-25 22:10:13', 'pending', NULL, NULL, '2026-05-06 16:29:24', '2026-05-25 22:10:13'),
(27, 27, '2026-05-25 23:47:10', 'pending', NULL, NULL, '2026-05-07 09:51:19', '2026-05-25 23:47:10'),
(28, 28, NULL, 'pending', NULL, NULL, '2026-05-07 17:55:10', '2026-05-07 17:55:10'),
(29, 29, NULL, 'pending', NULL, NULL, '2026-05-07 18:52:50', '2026-05-07 18:52:50'),
(30, 30, NULL, 'pending', NULL, NULL, '2026-05-08 08:46:20', '2026-05-08 08:46:20'),
(31, 31, '2026-05-25 11:17:23', 'pending', NULL, NULL, '2026-05-08 18:44:43', '2026-05-25 11:17:23'),
(32, 32, '2026-05-25 16:10:20', 'pending', NULL, NULL, '2026-05-10 08:46:55', '2026-05-25 16:10:20'),
(33, 33, '2026-05-25 09:25:08', 'pending', NULL, NULL, '2026-05-10 15:08:24', '2026-05-25 09:25:08'),
(34, 34, NULL, 'pending', NULL, NULL, '2026-05-10 23:05:13', '2026-05-10 23:05:13'),
(35, 35, NULL, 'pending', NULL, NULL, '2026-05-11 08:42:13', '2026-05-11 08:42:13'),
(36, 36, NULL, 'pending', NULL, NULL, '2026-05-11 08:47:29', '2026-05-11 08:47:29'),
(37, 37, NULL, 'pending', NULL, NULL, '2026-05-11 08:55:02', '2026-05-11 08:55:02'),
(38, 38, NULL, 'pending', NULL, NULL, '2026-05-11 08:57:40', '2026-05-11 08:57:40'),
(39, 39, NULL, 'pending', NULL, NULL, '2026-05-11 09:00:14', '2026-05-11 09:00:14'),
(40, 40, NULL, 'pending', NULL, NULL, '2026-05-11 16:03:37', '2026-05-11 16:03:37'),
(41, 41, NULL, 'pending', NULL, NULL, '2026-05-11 16:04:19', '2026-05-11 16:04:19'),
(42, 42, NULL, 'pending', NULL, NULL, '2026-05-11 21:47:17', '2026-05-11 21:47:17'),
(43, 43, NULL, 'pending', NULL, NULL, '2026-05-13 08:56:11', '2026-05-13 08:56:11'),
(44, 44, NULL, 'pending', NULL, NULL, '2026-05-13 14:04:17', '2026-05-13 14:04:17'),
(45, 45, NULL, 'pending', NULL, NULL, '2026-05-13 21:06:58', '2026-05-13 21:06:58'),
(46, 46, '2026-05-23 16:37:30', 'pending', NULL, NULL, '2026-05-14 14:09:55', '2026-05-23 16:37:30'),
(47, 47, '2026-05-24 14:13:03', 'pending', NULL, NULL, '2026-05-14 20:07:38', '2026-05-24 14:13:03'),
(48, 48, NULL, 'pending', NULL, NULL, '2026-05-16 09:35:44', '2026-05-16 09:35:44'),
(49, 49, '2026-05-25 09:54:57', 'pending', NULL, NULL, '2026-05-16 10:08:37', '2026-05-25 09:54:57'),
(50, 50, '2026-05-24 12:56:59', 'pending', NULL, NULL, '2026-05-17 12:39:29', '2026-05-24 12:56:59'),
(51, 51, NULL, 'pending', NULL, NULL, '2026-05-18 15:50:14', '2026-05-18 15:50:14'),
(52, 52, '2026-05-25 09:04:02', 'pending', NULL, NULL, '2026-05-19 09:39:39', '2026-05-25 09:04:02'),
(53, 53, '2026-05-22 06:55:46', 'pending', NULL, NULL, '2026-05-19 10:46:34', '2026-05-22 06:55:46'),
(54, 54, '2026-05-21 11:51:49', 'pending', NULL, NULL, '2026-05-19 11:24:58', '2026-05-21 11:51:49'),
(55, 55, NULL, 'pending', NULL, NULL, '2026-05-19 11:25:20', '2026-05-19 11:25:20'),
(56, 56, '2026-05-25 21:37:57', 'pending', NULL, NULL, '2026-05-19 11:26:44', '2026-05-25 21:37:57'),
(57, 57, NULL, 'pending', NULL, NULL, '2026-05-19 20:59:29', '2026-05-19 20:59:29'),
(58, 58, NULL, 'pending', NULL, NULL, '2026-05-20 01:21:59', '2026-05-20 01:21:59'),
(59, 59, '2026-05-24 11:33:24', 'pending', NULL, NULL, '2026-05-20 12:59:15', '2026-05-24 11:33:24'),
(60, 60, '2026-05-23 19:03:21', 'pending', NULL, NULL, '2026-05-20 14:04:10', '2026-05-23 19:03:21'),
(61, 61, '2026-05-22 16:11:14', 'pending', NULL, NULL, '2026-05-20 15:22:10', '2026-05-22 16:11:14'),
(62, 62, NULL, 'pending', NULL, NULL, '2026-05-20 18:56:37', '2026-05-20 18:56:37'),
(63, 63, '2026-05-25 13:47:16', 'pending', NULL, NULL, '2026-05-21 12:55:59', '2026-05-25 13:47:16'),
(64, 64, NULL, 'pending', NULL, NULL, '2026-05-21 15:43:00', '2026-05-21 15:43:00'),
(65, 65, '2026-05-25 15:03:55', 'pending', NULL, NULL, '2026-05-21 16:09:44', '2026-05-25 15:03:55'),
(66, 66, '2026-05-25 21:41:19', 'pending', NULL, NULL, '2026-05-21 18:19:25', '2026-05-25 21:41:19'),
(67, 67, '2026-05-24 21:03:18', 'pending', NULL, NULL, '2026-05-22 07:52:38', '2026-05-24 21:03:18'),
(68, 68, '2026-05-25 06:45:23', 'pending', NULL, NULL, '2026-05-22 08:02:18', '2026-05-25 06:45:23'),
(69, 69, '2026-05-25 00:02:02', 'pending', NULL, NULL, '2026-05-23 10:42:51', '2026-05-25 00:02:02'),
(70, 70, '2026-05-25 17:05:08', 'pending', NULL, NULL, '2026-05-23 10:57:24', '2026-05-25 17:05:08'),
(71, 71, '2026-05-24 14:51:05', 'pending', NULL, NULL, '2026-05-23 11:51:45', '2026-05-24 14:51:05'),
(72, 72, '2026-05-25 22:56:11', 'pending', NULL, NULL, '2026-05-23 12:32:08', '2026-05-25 22:56:11'),
(73, 73, NULL, 'pending', NULL, NULL, '2026-05-23 21:58:09', '2026-05-23 21:58:09'),
(74, 74, '2026-05-25 18:43:27', 'pending', NULL, NULL, '2026-05-23 22:55:59', '2026-05-25 18:43:27'),
(75, 75, '2026-05-24 13:01:35', 'pending', NULL, NULL, '2026-05-23 23:43:29', '2026-05-24 13:01:35'),
(76, 76, '2026-05-24 17:42:54', 'pending', NULL, NULL, '2026-05-24 11:57:30', '2026-05-24 17:42:54'),
(77, 77, '2026-05-25 05:49:20', 'pending', NULL, NULL, '2026-05-24 12:49:36', '2026-05-25 05:49:20'),
(78, 78, '2026-05-24 22:50:46', 'pending', NULL, NULL, '2026-05-24 13:21:31', '2026-05-24 22:50:46'),
(79, 79, NULL, 'pending', NULL, NULL, '2026-05-24 17:40:58', '2026-05-24 17:40:58'),
(80, 80, '2026-05-25 15:17:56', 'pending', NULL, NULL, '2026-05-24 19:03:57', '2026-05-25 15:17:56'),
(81, 81, '2026-05-24 21:27:42', 'pending', NULL, NULL, '2026-05-24 19:28:18', '2026-05-24 21:27:42'),
(82, 82, '2026-05-31 22:38:37', 'pending', NULL, NULL, '2026-05-24 21:24:13', '2026-05-31 22:38:37'),
(83, 83, '2026-05-25 13:20:06', 'pending', NULL, NULL, '2026-05-24 21:25:33', '2026-05-25 13:20:06'),
(84, 84, NULL, 'pending', NULL, NULL, '2026-05-25 09:49:52', '2026-05-25 09:49:52'),
(85, 85, '2026-05-31 09:38:50', 'pending', NULL, NULL, '2026-05-25 11:04:52', '2026-05-31 09:38:50'),
(86, 86, '2026-05-25 15:38:19', 'pending', NULL, NULL, '2026-05-25 13:28:13', '2026-05-25 15:38:19'),
(87, 87, '2026-05-31 20:46:34', 'pending', NULL, NULL, '2026-05-25 21:19:46', '2026-05-31 20:46:34'),
(88, 88, NULL, 'pending', NULL, NULL, '2026-05-26 09:39:07', '2026-05-26 09:39:07'),
(89, 89, '2026-05-31 23:02:24', 'pending', NULL, NULL, '2026-05-26 16:49:16', '2026-05-31 23:02:24');

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
(44, 'Perpanjangan Waktu Pendaftaran PMW 2026 Hingga 31 Mei 2026', 'perpanjangan-waktu-pendaftaran-pmw-2026-hingga-31-mei-2026', 'Info', 'normal', '{\"ops\":[{\"insert\":\"Halo Calon Wirausaha Muda Polsri!\\nKabar gembira bagi kalian yang belum sempat mendaftar atau menyelesaikan berkas. Pendaftaran Berwirausaha Mahasiswa (PMW) 2026 resmi \"},{\"attributes\":{\"bold\":true},\"insert\":\"diperpanjang hingga tanggal 31 Mei 2026\"},{\"insert\":\".\\nManfaatkan kesempatan tambahan ini untuk mematangkan proposal bisnis kelompokmu. Segera lengkapi persyaratan dan submit sebelum batas waktu berakhir!\\n\"}]}', '2026-05-25', 1, '2026-05-25 19:21:28', '2026-05-25 19:21:28');

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
(1, 'admin', NULL, NULL, 1, '2026-06-02 10:41:51', '2026-04-14 04:39:01', '2026-04-14 04:39:01', NULL),
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
(32, 'simpmw@polsri.ac.id', NULL, NULL, 1, '2026-04-30 11:58:27', '2026-04-30 10:01:20', '2026-04-30 10:01:20', NULL),
(33, 'reta7987', NULL, NULL, 0, '2026-04-30 11:44:53', '2026-04-30 10:09:07', '2026-04-30 11:58:18', '2026-04-30 11:58:18'),
(34, 'lutfi7198', NULL, NULL, 0, '2026-04-30 11:57:34', '2026-04-30 11:57:33', '2026-05-03 18:34:18', '2026-05-03 18:34:18'),
(35, 'cahyono8478', NULL, NULL, 0, '2026-05-01 21:06:43', '2026-05-01 20:52:01', '2026-05-03 18:34:05', '2026-05-03 18:34:05'),
(36, 'santoso4765', NULL, NULL, 0, '2026-05-01 21:35:30', '2026-05-01 21:27:52', '2026-05-03 18:34:02', '2026-05-03 18:34:02'),
(37, 'kurniawan5678', NULL, NULL, 0, '2026-05-02 10:34:31', '2026-05-02 10:07:48', '2026-05-03 18:33:59', '2026-05-03 18:33:59'),
(38, 'adinda2696', NULL, NULL, 0, '2026-05-02 10:25:38', '2026-05-02 10:25:37', '2026-05-03 18:33:54', '2026-05-03 18:33:54'),
(39, 'dwi3657', NULL, NULL, 0, '2026-05-02 10:28:55', '2026-05-02 10:28:55', '2026-05-03 18:33:52', '2026-05-03 18:33:52'),
(40, 'ramadhan2909', NULL, NULL, 0, '2026-05-03 05:49:12', '2026-05-02 10:52:22', '2026-05-03 18:33:48', '2026-05-03 18:33:48'),
(41, 'mutiara2132', NULL, NULL, 0, '2026-05-02 20:20:52', '2026-05-02 17:48:48', '2026-05-03 18:33:45', '2026-05-03 18:33:45'),
(42, 'roihan0690', NULL, NULL, 1, '2026-05-25 15:09:30', '2026-05-03 22:51:29', '2026-05-11 08:33:24', NULL),
(43, 'alya2654', NULL, NULL, 1, '2026-05-06 23:20:47', '2026-05-04 10:56:05', '2026-05-11 08:33:28', NULL),
(44, 'natasya2651', NULL, NULL, 1, '2026-05-04 21:36:14', '2026-05-04 21:36:13', '2026-05-11 08:33:31', NULL),
(47, 'mutiara1232', NULL, NULL, 1, '2026-05-05 15:33:00', '2026-05-05 15:32:39', '2026-05-11 08:33:34', NULL),
(48, 'wijaksonoakuntansi1092', NULL, NULL, 1, '2026-06-02 10:23:44', '2026-05-05 19:12:04', '2026-05-11 08:33:38', NULL),
(49, 'wayan0407', NULL, NULL, 1, '2026-05-05 20:10:03', '2026-05-05 20:09:23', '2026-05-11 08:33:42', NULL),
(50, 'meidiansyah3121', NULL, NULL, 1, '2026-05-26 16:04:32', '2026-05-06 16:29:24', '2026-05-11 08:33:46', NULL),
(51, 'safitri2267', NULL, NULL, 1, '2026-05-25 23:49:38', '2026-05-07 09:51:19', '2026-05-11 08:33:56', NULL),
(52, 'prian2179', NULL, NULL, 1, '2026-05-07 17:56:01', '2026-05-07 17:55:10', '2026-05-11 08:34:11', NULL),
(53, 'olivia3585', NULL, NULL, 1, '2026-05-07 18:52:51', '2026-05-07 18:52:50', '2026-05-11 08:34:06', NULL),
(54, 'fathurrahman0471', NULL, NULL, 1, '2026-05-08 08:46:20', '2026-05-08 08:46:19', '2026-05-11 08:34:01', NULL),
(55, 'irawan3143', NULL, NULL, 1, '2026-06-01 15:01:18', '2026-05-08 18:44:43', '2026-05-11 08:33:18', NULL),
(56, 'audrey1252', NULL, NULL, 1, '2026-05-28 19:42:16', '2026-05-10 08:46:54', '2026-05-11 08:33:13', NULL),
(57, 'putri2755', NULL, NULL, 1, '2026-05-28 17:38:52', '2026-05-10 15:08:24', '2026-05-11 08:33:09', NULL),
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
(70, 'belinda2557', NULL, NULL, 1, '2026-05-31 22:11:29', '2026-05-14 14:09:54', '2026-05-14 14:09:54', NULL),
(71, 'triyadi2085', NULL, NULL, 1, '2026-05-24 14:13:06', '2026-05-14 20:07:38', '2026-05-14 20:07:38', NULL),
(72, 'damayanti3335', NULL, NULL, 1, '2026-05-16 09:47:59', '2026-05-16 09:35:43', '2026-05-16 09:35:43', NULL),
(73, 'wati3629', NULL, NULL, 1, '2026-05-25 13:15:21', '2026-05-16 10:08:37', '2026-05-16 10:08:37', NULL),
(74, 'anastya3077', NULL, NULL, 1, '2026-06-01 21:21:38', '2026-05-17 12:39:28', '2026-05-17 12:39:28', NULL),
(75, 'oktavia1226', NULL, NULL, 1, '2026-06-02 09:13:25', '2026-05-18 15:50:14', '2026-05-18 15:50:14', NULL),
(76, 'ramadhani3051', NULL, NULL, 1, '2026-05-25 10:25:01', '2026-05-19 09:39:39', '2026-05-19 09:39:39', NULL),
(77, 'mawla3325', NULL, NULL, 1, '2026-06-02 10:41:46', '2026-05-19 10:46:34', '2026-05-19 10:46:34', NULL),
(78, 'abror3330', NULL, NULL, 1, '2026-05-21 16:44:22', '2026-05-19 11:24:58', '2026-05-19 11:24:58', NULL),
(79, 'akbar3337', NULL, NULL, 1, '2026-05-19 11:25:34', '2026-05-19 11:25:20', '2026-05-19 11:25:20', NULL),
(80, 'putra3323', NULL, NULL, 1, '2026-05-25 21:38:00', '2026-05-19 11:26:43', '2026-05-19 11:26:43', NULL),
(81, 'administrator4455', NULL, NULL, 1, '2026-05-25 03:47:46', '2026-05-19 20:59:29', '2026-05-19 20:59:29', NULL),
(82, 'jayadi1829', NULL, NULL, 1, '2026-05-20 01:35:44', '2026-05-20 01:21:58', '2026-05-20 01:21:58', NULL),
(83, 'kholilah3371', NULL, NULL, 1, '2026-06-01 07:28:51', '2026-05-20 12:59:15', '2026-05-20 12:59:15', NULL),
(84, 'hadil3326', NULL, NULL, 1, '2026-06-01 15:37:40', '2026-05-20 14:04:10', '2026-05-20 14:04:10', NULL),
(85, 'alya2909', NULL, NULL, 1, '2026-06-01 14:51:55', '2026-05-20 15:22:09', '2026-05-20 15:22:09', NULL),
(86, 'dwi3114', NULL, NULL, 1, '2026-05-20 18:58:56', '2026-05-20 18:56:37', '2026-05-20 18:56:37', NULL),
(87, 'claudia2452', NULL, NULL, 1, '2026-05-25 13:47:19', '2026-05-21 12:55:58', '2026-05-21 12:55:58', NULL),
(88, 'indah3057', NULL, NULL, 1, '2026-05-23 14:05:25', '2026-05-21 15:43:00', '2026-05-21 15:43:00', NULL),
(89, 'devani1260', NULL, NULL, 1, '2026-05-25 15:05:46', '2026-05-21 16:09:43', '2026-05-21 16:09:43', NULL),
(90, 'khairunisa3334', NULL, NULL, 1, '2026-05-25 21:45:09', '2026-05-21 18:19:24', '2026-05-21 18:19:24', NULL),
(91, 'slavina2884', NULL, NULL, 1, '2026-05-24 21:06:34', '2026-05-22 07:52:38', '2026-05-22 07:52:38', NULL),
(92, 'agustina2873', NULL, NULL, 1, '2026-05-29 13:30:16', '2026-05-22 08:02:17', '2026-05-22 08:02:17', NULL),
(93, 'nabil3332', NULL, NULL, 1, '2026-05-25 00:02:06', '2026-05-23 10:42:51', '2026-05-23 10:42:51', NULL),
(94, 'faiqriyyah3336', NULL, NULL, 1, '2026-05-25 20:05:17', '2026-05-23 10:57:23', '2026-05-23 10:57:23', NULL),
(95, 'putri3066', NULL, NULL, 1, '2026-06-02 08:48:55', '2026-05-23 11:51:45', '2026-05-23 11:51:45', NULL),
(96, 'dinni2363', NULL, NULL, 1, '2026-05-26 17:12:23', '2026-05-23 12:32:08', '2026-05-23 12:32:08', NULL),
(97, 'tri3371', NULL, NULL, 1, '2026-05-23 23:29:40', '2026-05-23 21:58:09', '2026-05-23 21:58:09', NULL),
(98, 'hilwatullisah2883', NULL, NULL, 1, '2026-05-27 17:54:36', '2026-05-23 22:55:59', '2026-05-23 22:55:59', NULL),
(99, 'risqi2726', NULL, NULL, 1, '2026-06-01 15:47:47', '2026-05-23 23:43:28', '2026-05-23 23:43:28', NULL),
(100, 'ridho3056', NULL, NULL, 1, '2026-05-24 19:17:06', '2026-05-24 11:57:30', '2026-05-24 11:57:30', NULL),
(101, 'claudya3068', NULL, NULL, 1, '2026-05-25 05:51:18', '2026-05-24 12:49:35', '2026-05-24 12:49:35', NULL),
(102, 'rafifah3059', NULL, NULL, 1, '2026-05-24 22:50:54', '2026-05-24 13:21:30', '2026-05-24 13:21:30', NULL),
(103, 'zeb3686', NULL, NULL, 1, '2026-05-24 17:40:58', '2026-05-24 17:40:57', '2026-05-24 17:40:57', NULL),
(104, 'amelia1274', NULL, NULL, 1, '2026-05-25 15:17:56', '2026-05-24 19:03:56', '2026-05-24 19:03:56', NULL),
(105, 'umiarti2886', NULL, NULL, 1, '2026-05-25 07:06:43', '2026-05-24 19:28:17', '2026-05-24 19:28:17', NULL),
(106, 'fathir2533', NULL, NULL, 1, '2026-06-01 02:14:13', '2026-05-24 21:24:12', '2026-05-24 21:24:12', NULL),
(107, 'rahmadhani3637', NULL, NULL, 1, '2026-05-25 13:20:36', '2026-05-24 21:25:32', '2026-05-24 21:25:32', NULL),
(108, 'test1111', NULL, NULL, 1, '2026-05-26 13:19:13', '2026-05-25 09:49:52', '2026-05-25 09:49:52', NULL),
(109, 'rizky2647', NULL, NULL, 1, '2026-06-01 16:25:38', '2026-05-25 11:04:51', '2026-05-25 11:04:51', NULL),
(110, 'fajar3329', NULL, NULL, 1, '2026-06-01 15:41:03', '2026-05-25 13:28:13', '2026-05-25 13:28:13', NULL),
(111, 'geraldi2952', NULL, NULL, 1, '2026-06-01 16:09:46', '2026-05-25 21:19:46', '2026-05-25 21:19:46', NULL),
(112, 'rizky1952', NULL, NULL, 1, '2026-05-26 09:41:16', '2026-05-26 09:39:07', '2026-05-26 09:39:07', NULL),
(113, 'febriansyah3078', NULL, NULL, 1, '2026-06-01 13:42:04', '2026-05-26 16:49:16', '2026-05-26 16:49:16', NULL),
(114, 'reviewer@polsri.ac.id', NULL, NULL, 1, NULL, '2026-06-01 14:42:27', '2026-06-01 14:42:27', NULL),
(115, 'Reviewer Polsri', NULL, NULL, 1, '2026-06-01 15:30:48', '2026-06-01 14:45:14', '2026-06-01 14:45:14', NULL);

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
  ADD KEY `pmw_selection_pitching_proposal_id_foreign` (`proposal_id`);

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=981;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_documents`
--
ALTER TABLE `pmw_documents`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_mentoring_logs`
--
ALTER TABLE `pmw_mentoring_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_mentors`
--
ALTER TABLE `pmw_mentors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pmw_notifications`
--
ALTER TABLE `pmw_notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `pmw_penilai`
--
ALTER TABLE `pmw_penilai`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pmw_periods`
--
ALTER TABLE `pmw_periods`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pmw_perjanjian`
--
ALTER TABLE `pmw_perjanjian`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pmw_proposal_assignments`
--
ALTER TABLE `pmw_proposal_assignments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pmw_proposal_members`
--
ALTER TABLE `pmw_proposal_members`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1498;

--
-- AUTO_INCREMENT for table `pmw_proposal_rab_items`
--
ALTER TABLE `pmw_proposal_rab_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pmw_selection_pitching`
--
ALTER TABLE `pmw_selection_pitching`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pmw_selection_proposal`
--
ALTER TABLE `pmw_selection_proposal`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_training_photos`
--
ALTER TABLE `pmw_training_photos`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pmw_training_reports`
--
ALTER TABLE `pmw_training_reports`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
