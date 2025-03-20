-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 01:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT '../images/default_profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `profile_pic`, `created_at`, `updated_at`, `usertype`) VALUES
(1, 'Admin', 'User', 'admin1@gmail.com', '1234567890', '$2y$10$eBlpro.qGUxoA9m8/PxW9ubUnkFKvdCaP6FI93UESeQ.XwAXzhzHK', '../uploads/1742464226_bg6.jpg', '2025-03-12 13:47:23', '2025-03-20 09:50:26', 'admin'),
(2, 'Admin', 'Two', 'admin2@gmail.com', '', '$2y$10$fPJBvzUVJvhFCvVKPFzJfeCWlI0rhTQs3TNvjDCyZ8OAzEPeQawW6', '../uploads/1741528292_my_profile.jpg', '2025-03-12 14:01:32', '2025-03-12 14:38:22', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_log`
--

INSERT INTO `audit_log` (`id`, `user_id`, `full_name`, `action`, `description`, `ip_address`, `created_at`, `usertype`) VALUES
(1, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-14 10:41:17', ''),
(2, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-14 10:42:10', ''),
(3, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-14 10:45:19', ''),
(4, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-14 10:48:49', 'admin'),
(5, 1, 'Sample Staff', 'Delete', 'Company \'AI Pioneers\' deleted', '::1', '2025-03-14 10:49:47', 'staff'),
(6, 1, 'Sample Staff', 'Create', 'Company \'SM cor\' created', '::1', '2025-03-14 10:51:04', 'staff'),
(7, 1, 'Samples Staff', 'Update', 'Staff profile updated', '::1', '2025-03-14 10:52:12', 'staff'),
(8, 1, 'Sample Staff', 'Update', 'Staff profile updated', '::1', '2025-03-14 10:52:20', 'staff'),
(9, 1, '', 'Job Posting', 'Job posted: Software Developer', '::1', '2025-03-14 10:54:11', 'staff'),
(10, 1, 'Sample Staff', 'Update Company', 'Updated company: DevWorks PH', '::1', '2025-03-14 10:56:50', 'staff'),
(11, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-14 10:59:34', 'staff'),
(12, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Open\' by Sample Staff', '::1', '2025-03-14 10:59:36', 'staff'),
(13, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-14 11:06:38', 'staff'),
(14, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-14 11:07:18', 'staff'),
(15, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Open\' by Sample Staff', '::1', '2025-03-14 11:08:58', 'staff'),
(16, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-14 11:09:40', 'staff'),
(17, 1, '', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-14 11:09:53', 'staff'),
(18, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-14 11:12:34', 'staff'),
(19, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Open\' by Sample Staff', '::1', '2025-03-14 11:12:35', 'staff'),
(20, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-03-14 11:15:30', 'admin'),
(21, 1, 'Sample Staff', 'Job Posting', 'Job posted: IT by Sample Staff', '::1', '2025-03-14 11:16:04', 'staff'),
(22, 1, 'Samples Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-14 11:17:33', 'staff'),
(23, 1, 'Samples Staffs', 'Update', 'Staff profile updated: Last Name', '::1', '2025-03-14 11:17:42', 'staff'),
(24, 1, 'Sample Staff', 'Update', 'Staff profile updated: First Name, Last Name', '::1', '2025-03-14 11:34:26', 'staff'),
(25, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-14 11:38:34', 'staff'),
(26, 1, 'Samples Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-14 11:38:40', 'staff'),
(27, 1, 'Sample Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-14 11:40:18', 'staff'),
(28, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 05:24:38', 'staff'),
(29, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-15 05:32:00', 'staff'),
(30, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 05:33:25', 'staff'),
(31, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 05:33:29', 'staff'),
(32, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-15 05:33:47', 'admin'),
(33, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-15 05:34:58', 'admin'),
(34, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-15 05:35:24', 'admin'),
(35, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 05:35:52', 'staff'),
(36, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 05:36:01', 'staff'),
(37, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-15 05:36:31', 'admin'),
(38, 1, 'Admin User', 'Create', 'Staff \'Jhon Lester Delgado\' added', '::1', '2025-03-15 05:45:32', 'admin'),
(39, 1, 'Admin User', 'Create', 'Staff \'staff two\' added', '::1', '2025-03-15 05:46:06', 'admin'),
(40, 1, 'Admin User', 'Create', 'Staff \'staff three\' added', '::1', '2025-03-15 05:46:41', 'admin'),
(41, 1, 'Admin User', 'Create', 'Staff \'staff four\' added', '::1', '2025-03-15 05:47:10', 'admin'),
(42, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 06:09:33', 'staff'),
(43, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 06:09:41', 'staff'),
(44, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 06:10:06', 'staff'),
(45, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 06:10:10', 'staff'),
(46, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-15 06:10:19', 'admin'),
(47, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) changed status of Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-15 06:40:31', 'admin'),
(48, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) changed status of staff two (ID: 5) to Inactive.', '::1', '2025-03-15 06:40:36', 'admin'),
(49, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-15 06:41:39', 'admin'),
(50, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-03-15 06:42:04', 'admin'),
(51, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-03-15 06:42:09', 'admin'),
(52, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-15 06:43:43', 'admin'),
(53, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-15 06:44:01', 'admin'),
(54, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-15 06:44:34', 'admin'),
(55, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-15 06:45:33', 'admin'),
(56, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-15 06:46:10', 'admin'),
(57, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-03-15 06:46:22', 'admin'),
(58, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-03-15 06:46:27', 'admin'),
(59, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'For Printing\' by Admin User', '::1', '2025-03-15 06:46:33', 'admin'),
(60, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'For Release\' by Admin User', '::1', '2025-03-15 06:46:36', 'admin'),
(61, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-03-15 06:46:39', 'admin'),
(62, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-15 06:48:35', 'admin'),
(63, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 06:48:46', 'staff'),
(64, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Developer\' updated to \'Open\' by Sample Staff', '::1', '2025-03-15 06:49:20', 'staff'),
(65, 1, 'Samples Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-15 06:57:16', 'staff'),
(66, 1, 'Sample Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-15 06:57:20', 'staff'),
(67, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 06:57:36', 'staff'),
(68, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-15 06:57:52', 'admin'),
(69, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-15 07:15:29', 'admin'),
(70, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-15 07:15:38', 'staff'),
(71, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-15 07:16:00', 'staff'),
(72, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-15 07:16:05', 'staff'),
(73, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Engineer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-15 07:16:30', 'staff'),
(74, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Engineer\' updated to \'Open\' by Sample Staff', '::1', '2025-03-15 07:16:37', 'staff'),
(75, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-15 07:16:39', 'staff'),
(76, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-16 04:34:04', 'staff'),
(77, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-16 04:53:07', 'admin'),
(78, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-16 04:56:27', 'staff'),
(79, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-16 04:56:38', 'staff'),
(80, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-16 05:00:38', 'staff'),
(81, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-16 05:00:49', 'staff'),
(82, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-16 05:21:53', 'staff'),
(83, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-16 05:22:03', 'staff'),
(84, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-16 05:28:46', 'admin'),
(85, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-16 05:28:53', 'admin'),
(86, 1, 'Admin User', 'Update', 'admin profile updated: Profile Picture', '::1', '2025-03-16 05:35:16', 'admin'),
(87, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Data Entry Specialist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-16 05:43:40', 'staff'),
(88, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-16 05:55:17', 'admin'),
(89, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Engineer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-16 05:56:44', 'staff'),
(90, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Administrative Assistant\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-16 05:56:46', 'staff'),
(91, 1, 'Sample Staff', 'Update Company', 'Updated company: Concetrix', '::1', '2025-03-16 06:28:29', 'staff'),
(92, 1, 'Sample Staff', 'Update Company', 'Updated company: SM cor', '::1', '2025-03-16 06:28:33', 'staff'),
(93, 1, 'Sample Staff', 'Update Company', 'Updated company: SM cor', '::1', '2025-03-16 06:29:17', 'staff'),
(94, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-17 10:44:20', 'staff'),
(95, 1, 'Sample Staff', 'Delete', 'Company \'DevWorks US\' deleted', '::1', '2025-03-17 10:44:36', 'staff'),
(96, 1, 'Sample Staff', 'Delete', 'Company \'Concetrix\' deleted', '::1', '2025-03-17 10:44:37', 'staff'),
(97, 1, 'Sample Staff', 'Delete', 'Company \'SM cor\' deleted', '::1', '2025-03-17 10:44:40', 'staff'),
(98, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Medical Transcriptionist\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:44:56', 'staff'),
(99, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Engineer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:44:58', 'staff'),
(100, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Software Developer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:45:01', 'staff'),
(101, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'IT\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:45:03', 'staff'),
(102, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Graphic Designer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:45:17', 'staff'),
(103, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Customer Support Representative\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 10:45:21', 'staff'),
(104, 1, 'Sample Staff', 'Create', 'Company \'Nike\' created', '::1', '2025-03-17 10:51:22', 'staff'),
(105, 1, 'Sample Staff', 'Create', 'Company \'Apple\' created', '::1', '2025-03-17 10:51:45', 'staff'),
(106, 1, 'Sample Staff', 'Create', 'Company \'FedEx\' created', '::1', '2025-03-17 10:52:13', 'staff'),
(107, 1, 'Sample Staff', 'Create', 'Company \'McDonald\'s\' created', '::1', '2025-03-17 10:52:38', 'staff'),
(108, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'iOS Developer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-17 11:00:58', 'staff'),
(109, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'iOS Developer\' updated to \'Open\' by Sample Staff', '::1', '2025-03-17 11:01:17', 'staff'),
(110, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-18 14:07:32', 'staff'),
(111, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-18 14:09:01', 'staff'),
(112, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-18 14:09:16', 'admin'),
(113, 1, 'Admin User', 'STATUS_UPDATE', 'Admin Admin User (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-18 14:11:33', 'admin'),
(114, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-18 14:13:21', 'admin'),
(115, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'For Printing\' by Admin User', '::1', '2025-03-18 14:13:31', 'admin'),
(116, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-20 04:12:23', 'staff'),
(117, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'iOS Developer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-20 04:25:48', 'staff'),
(118, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'iOS Developer\' updated to \'Open\' by Sample Staff', '::1', '2025-03-20 04:25:50', 'staff'),
(119, 1, 'Sample Staff', 'Job Posting', 'Job posted: Engineer by Sample Staff', '::1', '2025-03-20 04:33:35', 'staff'),
(120, 1, 'Sample Staff', 'Job Posting', 'Job posted: Engineer by Sample Staff', '::1', '2025-03-20 04:38:23', 'staff'),
(121, 1, 'Sample Staff', 'Create', 'Company \'Concetrix\' created', '::1', '2025-03-20 04:46:54', 'staff'),
(122, 1, 'Sample Staff', 'Create', 'Company \'SM corp\' created', '::1', '2025-03-20 04:48:38', 'staff'),
(123, 1, 'Sample Staff', 'Create', 'Company \'SMT\' created', '::1', '2025-03-20 04:57:23', 'staff'),
(124, 1, 'Sample Staff', 'Delete', 'Company \'Concetrix\' deleted', '::1', '2025-03-20 04:59:43', 'staff'),
(125, 1, 'Sample Staff', 'Delete', 'Company \'SM corp\' deleted', '::1', '2025-03-20 04:59:45', 'staff'),
(126, 1, 'Sample Staff', 'Delete', 'Company \'SMT\' deleted', '::1', '2025-03-20 04:59:47', 'staff'),
(127, 1, 'Sample Staffs', 'Update', 'Staff profile updated: Last Name', '::1', '2025-03-20 05:07:24', 'staff'),
(128, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: Last Name', '::1', '2025-03-20 05:07:30', 'staff'),
(129, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:07:31', 'staff'),
(130, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:07:31', 'staff'),
(131, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:07:31', 'staff'),
(132, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:07:33', 'staff'),
(133, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:10:14', 'staff'),
(134, 1, 'Samples Staffsss', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-20 05:10:15', 'staff'),
(135, 1, 'Samples Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:10:19', 'staff'),
(136, 1, 'Samples Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:10:22', 'staff'),
(137, 1, 'Sampless Staffsss', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-20 05:10:32', 'staff'),
(138, 1, 'Sampless Staffsss', 'Update', 'Staff profile updated: ', '::1', '2025-03-20 05:10:34', 'staff'),
(139, 1, 'Sampless Staffsss', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:13:14', 'staff'),
(140, 1, 'Sampless Staffsss', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:13:17', 'staff'),
(141, 1, 'Sampless Staffsss', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:20:30', 'staff'),
(142, 1, 'Sample Staffsss', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-20 05:20:33', 'staff'),
(143, 1, 'Sample Staff', 'Update', 'Staff profile updated: Last Name', '::1', '2025-03-20 05:20:36', 'staff'),
(144, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:21:10', 'staff'),
(145, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:21:32', 'staff'),
(146, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:25:50', 'staff'),
(147, 1, 'Sample Staff', 'Update', 'Staff profile updated: Profile Picture', '::1', '2025-03-20 05:28:55', 'staff'),
(148, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-20 09:43:08', 'staff'),
(149, 1, 'Sample Staff', 'Delete', 'Company \'Nike\' deleted', '::1', '2025-03-20 09:43:57', 'staff'),
(150, 1, 'Sample Staff', 'Delete', 'Company \'Apple\' deleted', '::1', '2025-03-20 09:44:39', 'staff'),
(151, 1, 'Sample Staff', 'Soft Delete', 'Company \'FedEx\' soft deleted', '::1', '2025-03-20 09:45:20', 'staff'),
(152, 1, 'Sample Staff', 'Soft Delete', 'Company \'McDonald\'s\' soft deleted', '::1', '2025-03-20 09:46:14', 'staff'),
(153, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-20 09:48:06', 'staff'),
(154, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-20 09:48:18', 'admin'),
(155, 1, 'Admin User', 'Update', 'Admin profile updated: Profile Picture', '::1', '2025-03-20 09:50:24', 'admin'),
(156, 1, 'Admin User', 'Update', 'Admin profile updated: Profile Picture', '::1', '2025-03-20 09:50:26', 'admin'),
(157, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-20 09:57:05', 'admin'),
(158, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-20 09:57:11', 'admin'),
(159, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-20 10:02:28', 'admin'),
(160, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-20 10:02:33', 'admin'),
(161, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-20 10:05:25', 'admin'),
(162, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-20 10:05:42', 'staff'),
(163, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-20 10:05:59', 'admin'),
(164, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-20 10:27:42', 'staff'),
(165, 1, 'Sample Staff', 'Soft Delete', 'Company \'FedEx\' soft deleted', '::1', '2025-03-20 10:27:51', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `location`, `description`, `created_at`, `updated_at`, `is_deleted`, `deleted_at`) VALUES
(18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'FedEx Express, NAIA Complex, Pasay City', 'FedEx is a leading global courier and logistics company that provides fast and reliable shipping solutions. It offers express, freight, and e-commerce shipping services worldwide.', '2025-03-17 11:52:13', '2025-03-20 10:27:51', 1, '2025-03-20 18:27:51'),
(19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig', 'McDonald\'s is a world-renowned fast-food chain offering burgers, fries, and other quick-service meals. It is known for its golden arches logo and consistent food quality.', '2025-03-17 11:52:38', '2025-03-20 09:46:47', 0, '2025-03-20 17:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Open','Closed') NOT NULL DEFAULT 'Open',
  `posted_date` datetime DEFAULT current_timestamp(),
  `staff_id` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `job_type` enum('Full-time','Part-time','Contract','Freelance') NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `company_name`, `company_logo`, `title`, `description`, `status`, `posted_date`, `staff_id`, `requirements`, `salary`, `job_type`, `location`) VALUES
(1, 101, 'Nike Philippines', '../uploads/1742208682_th.jpg', 'Software Engineer', 'Develop and maintain web applications for e-commerce.', 'Open', '2025-03-17 18:55:34', 5, 'Proficient in PHP, MySQL, and JavaScript', 50000.00, 'Full-time', 'Bonifacio Global City, Taguig'),
(2, 102, 'Apple Philippines', '../uploads/1742208705_th (1).jpg', 'iOS Developer', 'Design and build applications for the iOS platform.', 'Open', '2025-03-17 18:55:34', 6, 'Experience with Swift and iOS frameworks', 70000.00, 'Full-time', 'Makati City'),
(3, 103, 'FedEx Philippines', '../uploads/1742208733_th (2).jpg', 'Logistics Coordinator', 'Manage supply chain operations and shipment tracking.', 'Open', '2025-03-17 18:55:34', 7, 'Background in logistics and inventory management', 45000.00, 'Full-time', 'Pasay City'),
(5, 105, 'McDonald’s Philippines', '../uploads/1742208758_th (3).jpg', 'Restaurant Manager', 'Oversee daily restaurant operations and ensure customer satisfaction.', 'Open', '2025-03-17 18:55:34', 9, 'Experience in food service management', 40000.00, 'Full-time', 'Bonifacio Global City, Taguig'),
(6, 101, 'Nike Philippines', '../uploads/1742208682_th.jpg', 'Marketing Specialist', 'Develop and execute marketing campaigns for Nike products.', 'Open', '2025-03-17 18:55:34', 5, 'Experience in digital marketing and branding', 55000.00, 'Full-time', 'Makati City'),
(7, 102, 'Apple Philippines', '../uploads/1742208705_th (1).jpg\n', 'Technical Support Engineer', 'Assist customers with troubleshooting Apple products.', 'Open', '2025-03-17 18:55:34', 6, 'Strong knowledge of macOS and iOS', 60000.00, 'Full-time', 'Quezon City'),
(8, 103, 'FedEx Philippines', '../uploads/1742208733_th (2).jpg', 'Warehouse Supervisor', 'Oversee warehouse operations and ensure efficient logistics.', 'Open', '2025-03-17 18:55:34', 7, 'Experience in warehouse management', 42000.00, 'Full-time', 'Mandaluyong City'),
(10, 105, 'McDonald’s Philippines', '../uploads/1742208758_th (3).jpg', 'Crew Member', 'Serve food and assist customers at the counter.', 'Open', '2025-03-17 18:55:34', 9, 'No experience required, training provided', 18000.00, 'Part-time', 'Manila City'),
(40, 16, 'Nike', '../uploads/1742208682_th.jpg', 'Engineer', 'asd', 'Open', '2025-03-20 05:33:35', 1, 'asd', 20.00, 'Part-time', ''),
(41, 17, 'Apple', '../uploads/1742208705_th (1).jpg', 'Engineer', 'Asd', 'Open', '2025-03-20 05:38:23', 1, 'aaa', 2.00, 'Part-time', '');

-- --------------------------------------------------------

--
-- Table structure for table `pwd_registration`
--

CREATE TABLE `pwd_registration` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `disability_type` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `proof_of_pwd` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Pending','Approved','For Printing','For Release','Released','Rejected') NOT NULL DEFAULT 'Pending',
  `read_status` tinyint(1) DEFAULT 0,
  `seen` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwd_registration`
--

INSERT INTO `pwd_registration` (`id`, `full_name`, `birthdate`, `disability_type`, `address`, `contact_number`, `email`, `application_id`, `proof_of_pwd`, `valid_id`, `created_at`, `updated_at`, `status`, `read_status`, `seen`) VALUES
(54, 'Carlos Mendoza', '1992-06-15', 'Visual Impairment', '123 Mabini St., Manila', '09123456789', 'carlos.mendoza@example.com', 'APP-20250320-002', 'proof_carlos.jpg', 'id_carlos.jpg', '2025-03-20 11:53:03', '2025-03-20 12:03:28', 'Released', 0, 1),
(55, 'Anna Reyes', '1985-03-22', 'Hearing Impairment', '45 Rizal Ave., Quezon City', '09234567890', 'anna.reyes@example.com', 'APP-20250320-003', 'proof_anna.jpg', 'id_anna.jpg', '2025-03-20 11:53:03', '2025-03-20 11:55:46', 'Approved', 0, 1),
(56, 'Marco Cruz', '1998-09-10', 'Physical Disability', '78 Lopez St., Makati', '09345678901', 'marco.cruz@example.com', 'APP-20250320-004', 'proof_marco.jpg', 'id_marco.jpg', '2025-03-20 11:53:03', '2025-03-20 11:55:48', 'Approved', 0, 1),
(57, 'Sophia Dela Torre', '1990-12-05', 'Speech Impairment', '101 Bonifacio St., Pasig', '09456789012', 'sophia.delatorre@example.com', 'APP-20250320-005', 'proof_sophia.jpg', 'id_sophia.jpg', '2025-03-20 11:53:03', '2025-03-20 11:55:51', 'Approved', 0, 1),
(58, 'Ryan Villanueva', '1987-07-18', 'Intellectual Disability', '55 Aguinaldo St., Taguig', '09567890123', 'ryan.villanueva@example.com', 'APP-20250320-006', 'proof_ryan.jpg', 'id_ryan.jpg', '2025-03-20 11:53:03', '2025-03-20 11:55:53', 'Approved', 0, 1),
(59, 'Juan Dela Cruz', '1990-05-15', 'Visual Impairment', 'Manila, Philippines', '09123456789', 'juan.delacruz@example.com', 'APP-001', 'proof1.jpg', 'id1.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(60, 'Maria Clara', '1985-08-22', 'Hearing Impairment', 'Cebu, Philippines', '09234567891', 'maria.clara@example.com', 'APP-002', 'proof2.jpg', 'id2.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(61, 'Jose Rizal', '1861-06-19', 'Orthopedic Disability', 'Laguna, Philippines', '09345678912', 'jose.rizal@example.com', 'APP-003', 'proof3.jpg', 'id3.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(62, 'Andres Bonifacio', '1863-11-30', 'Intellectual Disability', 'Tondo, Manila', '09456789123', 'andres.bonifacio@example.com', 'APP-004', 'proof4.jpg', 'id4.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(63, 'Emilio Aguinaldo', '1869-03-22', 'Speech Impairment', 'Kawit, Cavite', '09567891234', 'emilio.aguinaldo@example.com', 'APP-005', 'proof5.jpg', 'id5.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(64, 'Gabriela Silang', '1731-03-19', 'Orthopedic Disability', 'Ilocos Sur, Philippines', '09678912345', 'gabriela.silang@example.com', 'APP-006', 'proof6.jpg', 'id6.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(65, 'Apolinario Mabini', '1864-07-23', 'Orthopedic Disability', 'Batangas, Philippines', '09789123456', 'apolinario.mabini@example.com', 'APP-007', 'proof7.jpg', 'id7.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(66, 'Melchora Aquino', '1812-01-06', 'Visual Impairment', 'Quezon City, Philippines', '09891234567', 'melchora.aquino@example.com', 'APP-008', 'proof8.jpg', 'id8.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(67, 'Antonio Luna', '1866-10-29', 'Hearing Impairment', 'Manila, Philippines', '09912345678', 'antonio.luna@example.com', 'APP-009', 'proof9.jpg', 'id9.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1),
(68, 'Gregorio del Pilar', '1875-11-14', 'Speech Impairment', 'Bulacan, Philippines', '09998765432', 'gregorio.pilar@example.com', 'APP-010', 'proof10.jpg', 'id10.jpg', '2025-03-20 12:03:02', '2025-03-20 12:03:05', 'Pending', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT '../images/default_profile.jpg',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `usertype` varchar(50) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `created_at`, `profile_pic`, `status`, `usertype`) VALUES
(1, 'Sample', 'Staff', 'staff1@gmail.com', '09123456789', '$2y$10$i1HjhuJjbcRz0JLZLuuy4OFRSm08JMDfKL0564osyQcwtpYYccYHG', '2025-03-12 16:32:02', '../uploads/1742448535_bg6.jpg', 'inactive', 'staff'),
(5, 'staff', 'two', 'staff2@gmail.com', NULL, '$2y$10$Mlej6D5.NAM86dbJpUeURO4qzveEIGzyrSXK2x7TprSfPgJgcFQNm', '2025-03-14 22:46:06', '../uploads/default_profile.png', 'inactive', 'staff'),
(6, 'staff', 'three', 'staff3@gmail.com', NULL, '$2y$10$AH1bFMsnwCBfnbQlEdNhmu0mh6HpcRiHLTwm341Dp/uhrqDudHFbm', '2025-03-14 22:46:41', '../uploads/default_profile.png', 'active', 'staff'),
(7, 'staff', 'four', 'staff4@gmail.com', NULL, '$2y$10$qNo7OI96361quDFgzS2.t.bL4GOfHZQl8uF4PpHwGuNRiGRGSRLii', '2025-03-14 22:47:10', '../uploads/default_profile.png', 'active', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `application_id` (`application_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
