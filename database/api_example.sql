-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2025 at 01:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `canGET` varchar(255) NOT NULL DEFAULT 'false',
  `canPOST` varchar(255) NOT NULL DEFAULT 'false',
  `canDELETE` varchar(255) NOT NULL DEFAULT 'false',
  `canPUT` varchar(255) NOT NULL DEFAULT 'false',
  `canPATCH` varchar(255) NOT NULL DEFAULT 'false',
  `status` varchar(255) NOT NULL DEFAULT 'false',
  `last_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `Class_ID` int(255) NOT NULL,
  `Capacity` int(255) NOT NULL,
  `Room_Type` int(255) NOT NULL,
  `Section` int(255) NOT NULL,
  `Teacher_ID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(255) NOT NULL,
  `Student_LRN` varchar(50) NOT NULL,
  `Advisory` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Quarter1` varchar(255) NOT NULL,
  `Quarter2` varchar(255) NOT NULL,
  `Quarter3` varchar(255) NOT NULL,
  `Quarter4` varchar(255) NOT NULL,
  `school_year` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `id` int(255) NOT NULL,
  `Grade_Level` varchar(255) NOT NULL,
  `Grade 1` varchar(6) NOT NULL,
  `Grade 2` varchar(6) NOT NULL,
  `Grade 3` varchar(6) NOT NULL,
  `Grade 4` varchar(6) NOT NULL,
  `Grade 5` varchar(6) NOT NULL,
  `Grade 6` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guard`
--

CREATE TABLE `guard` (
  `id` int(255) NOT NULL,
  `Guard_ID` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Sex` int(255) NOT NULL,
  `Contact. No` int(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Address` int(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(255) NOT NULL,
  `inventory_no` varchar(255) NOT NULL,
  `Item_Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `Property_no` varchar(255) NOT NULL,
  `Article` varchar(255) NOT NULL,
  `Date_acquired` varchar(255) NOT NULL,
  `Acquisition_cost` varchar(255) NOT NULL,
  `Fund_source` varchar(255) NOT NULL,
  `Accountable_officer` varchar(255) NOT NULL,
  `Unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(255) NOT NULL,
  `users_id` int(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `role` varchar(6) NOT NULL,
  `login_time` datetime(6) NOT NULL,
  `logout_time` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `users_id`, `users_email`, `role`, `login_time`, `logout_time`) VALUES
(26, 7, 'joshtantoy93@gmail.com', '0', '2025-01-07 09:10:00.000000', '0000-00-00 00:00:00.000000'),
(27, 7, 'joshtantoy93@gmail.com', '0', '2025-01-09 07:44:00.000000', '0000-00-00 00:00:00.000000'),
(28, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-09 08:41:00.000000'),
(29, 7, 'joshtantoy93@gmail.com', '0', '2025-01-10 06:36:00.000000', '0000-00-00 00:00:00.000000'),
(30, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-10 07:30:00.000000'),
(31, 9, 'joshmanile@gmail.com', '0', '2025-01-13 06:11:00.000000', '0000-00-00 00:00:00.000000'),
(32, 7, 'joshtantoy93@gmail.com', '0', '2025-01-13 06:51:00.000000', '0000-00-00 00:00:00.000000'),
(33, 7, 'joshtantoy93@gmail.com', '0', '2025-01-13 08:10:00.000000', '0000-00-00 00:00:00.000000'),
(34, 9, 'joshmanile@gmail.com', '0', '2025-01-13 10:03:00.000000', '0000-00-00 00:00:00.000000'),
(35, 9, 'joshmanile@gmail.com', '0', '2025-01-13 10:03:00.000000', '0000-00-00 00:00:00.000000'),
(36, 9, 'joshmanile@gmail.com', '0', '2025-01-13 10:05:00.000000', '0000-00-00 00:00:00.000000'),
(37, 9, 'joshmanile@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-13 10:06:00.000000'),
(38, 9, 'joshmanile@gmail.com', '0', '2025-01-13 10:06:00.000000', '0000-00-00 00:00:00.000000'),
(39, 11, 'Marvs@gmail.com', '0', '2025-01-13 10:49:00.000000', '0000-00-00 00:00:00.000000'),
(40, 7, 'joshtantoy93@gmail.com', '0', '2025-01-14 10:07:00.000000', '0000-00-00 00:00:00.000000'),
(41, 11, 'Marvs@gmail.com', '0', '2025-01-14 10:08:00.000000', '0000-00-00 00:00:00.000000'),
(42, 11, 'Marvs@gmail.com', '0', '2025-01-14 05:23:00.000000', '0000-00-00 00:00:00.000000'),
(43, 7, 'joshtantoy93@gmail.com', '0', '2025-01-14 05:34:00.000000', '0000-00-00 00:00:00.000000'),
(44, 7, 'joshtantoy93@gmail.com', '0', '2025-01-17 10:17:00.000000', '0000-00-00 00:00:00.000000'),
(45, 11, 'Marvs@gmail.com', '0', '2025-01-17 10:20:00.000000', '0000-00-00 00:00:00.000000'),
(46, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 01:40:00.000000'),
(47, 11, 'Marvs@gmail.com', '0', '2025-01-17 08:04:00.000000', '0000-00-00 00:00:00.000000'),
(48, 7, 'joshtantoy93@gmail.com', '0', '2025-01-17 08:27:00.000000', '0000-00-00 00:00:00.000000'),
(49, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 10:02:00.000000'),
(50, 11, 'Marvs@gmail.com', '0', '2025-01-17 10:05:00.000000', '0000-00-00 00:00:00.000000'),
(51, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 10:40:00.000000'),
(52, 11, 'Marvs@gmail.com', '0', '2025-01-17 10:42:00.000000', '0000-00-00 00:00:00.000000'),
(53, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 10:46:00.000000'),
(54, 11, 'Marvs@gmail.com', '0', '2025-01-17 10:46:00.000000', '0000-00-00 00:00:00.000000'),
(55, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 10:47:00.000000'),
(56, 11, 'Marvs@gmail.com', '0', '2025-01-17 10:48:00.000000', '0000-00-00 00:00:00.000000'),
(57, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 10:50:00.000000'),
(58, 7, 'joshtantoy93@gmail.com', '0', '2025-01-17 10:52:00.000000', '0000-00-00 00:00:00.000000'),
(59, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 11:29:00.000000'),
(60, 12, 'Marielang@gmail.com', '0', '2025-01-17 11:30:00.000000', '0000-00-00 00:00:00.000000'),
(61, 12, 'Marielang@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-17 11:30:00.000000'),
(62, 7, 'joshtantoy93@gmail.com', '0', '2025-01-18 06:30:00.000000', '0000-00-00 00:00:00.000000'),
(63, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:31:00.000000'),
(64, 11, 'Marvs@gmail.com', '0', '2025-01-18 06:31:00.000000', '0000-00-00 00:00:00.000000'),
(65, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:41:00.000000'),
(66, 11, 'Marvs@gmail.com', '0', '2025-01-18 06:42:00.000000', '0000-00-00 00:00:00.000000'),
(67, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:48:00.000000'),
(68, 12, 'Marielang@gmail.com', '0', '2025-01-18 06:48:00.000000', '0000-00-00 00:00:00.000000'),
(69, 12, 'Marielang@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:49:00.000000'),
(70, 11, 'Marvs@gmail.com', '0', '2025-01-18 06:49:00.000000', '0000-00-00 00:00:00.000000'),
(71, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:51:00.000000'),
(72, 11, 'Marvs@gmail.com', '0', '2025-01-18 06:51:00.000000', '0000-00-00 00:00:00.000000'),
(73, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:52:00.000000'),
(74, 12, 'Marielang@gmail.com', '0', '2025-01-18 06:52:00.000000', '0000-00-00 00:00:00.000000'),
(75, 12, 'Marielang@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:56:00.000000'),
(76, 12, 'Marielang@gmail.com', '0', '2025-01-18 06:56:00.000000', '0000-00-00 00:00:00.000000'),
(77, 12, 'Marielang@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:57:00.000000'),
(78, 11, 'Marvs@gmail.com', '0', '2025-01-18 06:57:00.000000', '0000-00-00 00:00:00.000000'),
(79, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 06:59:00.000000'),
(80, 12, 'Marielang@gmail.com', '0', '2025-01-18 06:59:00.000000', '0000-00-00 00:00:00.000000'),
(81, 12, 'Marielang@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 07:01:00.000000'),
(82, 11, 'Marvs@gmail.com', '0', '2025-01-18 07:01:00.000000', '0000-00-00 00:00:00.000000'),
(83, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-18 09:23:00.000000'),
(84, 11, 'Marvs@gmail.com', '0', '2025-01-19 01:30:00.000000', '0000-00-00 00:00:00.000000'),
(85, 12, 'Marielang@gmail.com', '0', '2025-01-19 01:44:00.000000', '0000-00-00 00:00:00.000000'),
(86, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-19 02:29:00.000000'),
(87, 7, 'joshtantoy93@gmail.com', '0', '2025-01-19 02:29:00.000000', '0000-00-00 00:00:00.000000'),
(88, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-19 03:16:00.000000'),
(89, 7, 'joshtantoy93@gmail.com', '0', '2025-01-19 03:16:00.000000', '0000-00-00 00:00:00.000000'),
(90, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-19 03:30:00.000000'),
(91, 7, 'joshtantoy93@gmail.com', '0', '2025-01-19 03:31:00.000000', '0000-00-00 00:00:00.000000'),
(92, 7, 'joshtantoy93@gmail.com', '0', '2025-01-25 10:00:00.000000', '0000-00-00 00:00:00.000000'),
(93, 11, 'Marvs@gmail.com', '0', '2025-01-25 10:27:00.000000', '0000-00-00 00:00:00.000000'),
(94, 7, 'joshtantoy93@gmail.com', '0', '2025-01-26 01:06:00.000000', '0000-00-00 00:00:00.000000'),
(95, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-26 01:07:00.000000'),
(96, 7, 'joshtantoy93@gmail.com', '0', '2025-01-26 01:24:00.000000', '0000-00-00 00:00:00.000000'),
(97, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-26 01:27:00.000000'),
(98, 11, 'Marvs@gmail.com', '0', '2025-01-26 01:30:00.000000', '0000-00-00 00:00:00.000000'),
(99, 11, 'Marvs@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-26 01:32:00.000000'),
(100, 7, 'joshtantoy93@gmail.com', '0', '2025-01-26 01:32:00.000000', '0000-00-00 00:00:00.000000'),
(101, 11, 'Marvs@gmail.com', '0', '2025-01-26 01:35:00.000000', '0000-00-00 00:00:00.000000'),
(102, 7, 'joshtantoy93@gmail.com', '0', '2025-01-26 02:50:00.000000', '0000-00-00 00:00:00.000000'),
(103, 7, 'joshtantoy93@gmail.com', '0', '2025-01-29 12:35:00.000000', '0000-00-00 00:00:00.000000'),
(104, 7, 'joshtantoy93@gmail.com', '0', '2025-01-31 01:46:00.000000', '0000-00-00 00:00:00.000000'),
(105, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-01-31 01:47:00.000000'),
(106, 7, 'joshtantoy93@gmail.com', '0', '2025-02-11 09:25:00.000000', '0000-00-00 00:00:00.000000'),
(107, 11, 'Marvs@gmail.com', '0', '2025-02-11 09:56:00.000000', '0000-00-00 00:00:00.000000'),
(108, 7, 'joshtantoy93@gmail.com', '0', '2025-02-11 09:48:00.000000', '0000-00-00 00:00:00.000000'),
(109, 7, 'joshtantoy93@gmail.com', '0', '0000-00-00 00:00:00.000000', '2025-02-11 09:56:00.000000'),
(110, 7, 'joshtantoy93@gmail.com', '0', '2025-02-13 03:38:00.000000', '0000-00-00 00:00:00.000000'),
(111, 7, 'joshtantoy93@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-13 03:54:00.000000'),
(112, 7, 'joshtantoy93@gmail.com', '', '2025-02-13 03:54:00.000000', '0000-00-00 00:00:00.000000'),
(113, 11, 'Marvs@gmail.com', '', '2025-02-13 04:00:00.000000', '0000-00-00 00:00:00.000000'),
(114, 11, 'Marvs@gmail.com', '', '2025-02-13 04:03:00.000000', '0000-00-00 00:00:00.000000'),
(115, 11, 'Marvs@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-13 08:15:00.000000'),
(116, 7, 'joshtantoy93@gmail.com', '', '2025-02-13 08:15:00.000000', '0000-00-00 00:00:00.000000'),
(117, 7, 'joshtantoy93@gmail.com', '', '2025-02-17 07:22:00.000000', '0000-00-00 00:00:00.000000'),
(118, 7, 'joshtantoy93@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-17 07:26:00.000000'),
(119, 7, 'joshtantoy93@gmail.com', '', '2025-02-17 07:29:00.000000', '0000-00-00 00:00:00.000000'),
(120, 11, 'Marvs@gmail.com', '', '2025-02-17 07:33:00.000000', '0000-00-00 00:00:00.000000'),
(121, 7, 'joshtantoy93@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-17 07:36:00.000000'),
(122, 7, 'joshtantoy93@gmail.com', '', '2025-02-17 07:38:00.000000', '0000-00-00 00:00:00.000000'),
(123, 11, 'Marvs@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-17 09:42:00.000000'),
(124, 7, 'joshtantoy93@gmail.com', '', '2025-02-19 08:45:00.000000', '0000-00-00 00:00:00.000000'),
(125, 11, 'Marvs@gmail.com', '', '2025-02-19 08:46:00.000000', '0000-00-00 00:00:00.000000'),
(126, 11, 'Marvs@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-19 09:45:00.000000'),
(127, 11, 'Marvs@gmail.com', '', '2025-02-19 09:45:00.000000', '0000-00-00 00:00:00.000000'),
(128, 11, 'Marvs@gmail.com', '', '2025-02-19 10:32:00.000000', '0000-00-00 00:00:00.000000'),
(129, 11, 'Marvs@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-19 10:45:00.000000'),
(130, 11, 'Marvs@gmail.com', '', '2025-02-19 10:45:00.000000', '0000-00-00 00:00:00.000000'),
(131, 7, 'joshtantoy93@gmail.com', '', '2025-02-19 11:07:00.000000', '0000-00-00 00:00:00.000000'),
(132, 7, 'joshtantoy93@gmail.com', '', '2025-02-19 06:44:00.000000', '0000-00-00 00:00:00.000000'),
(133, 11, 'Marvs@gmail.com', '', '2025-02-19 06:44:00.000000', '0000-00-00 00:00:00.000000'),
(134, 7, 'joshtantoy93@gmail.com', '', '0000-00-00 00:00:00.000000', '2025-02-19 07:15:00.000000'),
(135, 7, 'joshtantoy93@gmail.com', '', '2025-02-20 07:37:00.000000', '0000-00-00 00:00:00.000000'),
(136, 11, 'Marvs@gmail.com', '', '2025-02-20 07:41:00.000000', '0000-00-00 00:00:00.000000'),
(137, 13, 'jervenconde123@gmail.com', '', '2025-02-20 09:45:00.000000', '0000-00-00 00:00:00.000000'),
(138, 13, 'jervenconde123@gmail.com', '', '2025-02-20 09:45:00.000000', '0000-00-00 00:00:00.000000'),
(139, 13, 'jervenconde123@gmail.com', '', '2025-02-20 09:46:00.000000', '0000-00-00 00:00:00.000000'),
(140, 13, 'jervenconde123@gmail.com', '', '2025-02-20 09:48:00.000000', '0000-00-00 00:00:00.000000'),
(141, 13, 'jervenconde123@gmail.com', '', '2025-02-21 05:52:00.000000', '0000-00-00 00:00:00.000000'),
(142, 13, 'jervenconde123@gmail.com', '', '2025-02-21 10:01:00.000000', '0000-00-00 00:00:00.000000'),
(143, 13, 'jervenconde123@gmail.com', '', '2025-02-22 09:36:00.000000', '0000-00-00 00:00:00.000000'),
(144, 13, 'jervenconde123@gmail.com', '', '2025-02-23 08:02:00.000000', '0000-00-00 00:00:00.000000'),
(145, 13, 'jervenconde123@gmail.com', '', '2025-02-23 01:15:00.000000', '0000-00-00 00:00:00.000000'),
(146, 13, 'jervenconde123@gmail.com', '', '2025-02-23 01:26:00.000000', '0000-00-00 00:00:00.000000'),
(147, 13, 'jervenconde123@gmail.com', '', '2025-02-23 03:46:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(255) NOT NULL,
  `Parents` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Sex` varchar(255) NOT NULL,
  `Address` int(255) NOT NULL,
  `Occupation` varchar(255) NOT NULL,
  `Contact. No` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `ID` int(255) NOT NULL,
  `School_ID` int(255) NOT NULL,
  `School` varchar(255) NOT NULL,
  `District` int(255) NOT NULL,
  `Division` varchar(255) NOT NULL,
  `Region` int(255) NOT NULL,
  `Address` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Students_ID` int(255) NOT NULL,
  `Teacher_ID` int(255) NOT NULL,
  `Parents_ID` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Parents` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Contact_No` int(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Student_LRN` varchar(255) NOT NULL,
  `school_year` int(11) NOT NULL,
  `Grade_Level` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Advisory` varchar(255) NOT NULL,
  `last_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_type`
--

CREATE TABLE `student_type` (
  `Student_Type` int(255) NOT NULL,
  `Student_ID` int(255) NOT NULL,
  `Speed` varchar(255) NOT NULL,
  `Muslim` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(255) NOT NULL,
  `Mother_tounge` varchar(255) NOT NULL,
  `Mathematics` varchar(255) NOT NULL,
  `Science` varchar(255) NOT NULL,
  `Filipino` varchar(255) NOT NULL,
  `MAPEH` varchar(255) NOT NULL,
  `Araling_panlipunan` varchar(255) NOT NULL,
  `Esp` varchar(255) NOT NULL,
  `English` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Teacher_ID` int(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Age` int(113) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Contact_No` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Rank` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Subject_Taught` varchar(255) NOT NULL,
  `Joining_Date` date NOT NULL,
  `files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_files`
--

CREATE TABLE `teacher_files` (
  `File_ID` int(255) NOT NULL,
  `Teacher_ID` int(255) NOT NULL,
  `File_Name` varchar(255) NOT NULL,
  `File_Path` varchar(255) NOT NULL,
  `File_Type` varchar(255) NOT NULL,
  `File_Size` int(11) NOT NULL,
  `Uploaded_Date` date NOT NULL,
  `Description` text NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `users_id` int(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Contact_No` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Age` varchar(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `activation_code` varchar(255) NOT NULL,
  `signup_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Class_ID`),
  ADD UNIQUE KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guard`
--
ALTER TABLE `guard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Students_ID`),
  ADD UNIQUE KEY `Parent_ID` (`Parents`),
  ADD KEY `Parents_ID` (`Parents_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`),
  ADD KEY `Parents` (`Parents`),
  ADD KEY `Teacher_ID_2` (`Teacher_ID`);

--
-- Indexes for table `student_type`
--
ALTER TABLE `student_type`
  ADD PRIMARY KEY (`Student_Type`),
  ADD UNIQUE KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Teacher_ID`);

--
-- Indexes for table `teacher_files`
--
ALTER TABLE `teacher_files`
  ADD PRIMARY KEY (`File_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`),
  ADD KEY `Teacher_ID_2` (`Teacher_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `Class_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guard`
--
ALTER TABLE `guard`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Students_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Teacher_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teacher_files`
--
ALTER TABLE `teacher_files`
  MODIFY `File_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_files`
--
ALTER TABLE `teacher_files`
  ADD CONSTRAINT `teacher_files_ibfk_1` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher` (`Teacher_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
