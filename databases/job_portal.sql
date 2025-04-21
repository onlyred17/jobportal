-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 05:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.7

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
  `usertype` varchar(50) NOT NULL DEFAULT 'admin',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `profile_pic`, `created_at`, `updated_at`, `usertype`, `status`) VALUES
(1, 'Admin', 'User', 'admin1@gmail.com', '1234567890', '$2y$10$eBlpro.qGUxoA9m8/PxW9ubUnkFKvdCaP6FI93UESeQ.XwAXzhzHK', '../uploads/1742464226_bg6.jpg', '2025-03-12 13:47:23', '2025-04-21 08:10:50', 'admin', 'active'),
(5, 'Admin', 'Two', 'admin2@gmail.com', '', '$2y$10$40BZuRcOatSCWCTyqy4bxuZrjzwIuSRFY7IthKmebw4HCbZqM1i.K', '../images/default_profile.jpg', '2025-03-21 23:33:19', '2025-03-22 06:33:19', 'admin', 'active');

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
(195, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-21 05:53:29', 'staff'),
(196, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 05:53:39', 'admin'),
(197, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-21 05:56:53', 'admin'),
(198, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:05:18', 'admin'),
(199, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:09:27', 'admin'),
(200, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:10:23', 'super_admin'),
(201, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:11:11', 'super_admin'),
(202, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:15:37', 'super_admin'),
(203, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:17:58', 'super_admin'),
(204, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:18:12', 'super_admin'),
(205, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:19:24', 'super_admin'),
(206, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:20:49', 'super_admin'),
(207, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 06:22:50', 'admin'),
(208, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-21 06:22:59', 'admin'),
(209, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:23:14', 'super_admin'),
(210, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:33:56', 'super_admin'),
(211, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-21 06:36:59', 'staff'),
(212, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:39:17', 'super_admin'),
(213, 1, 'Super Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 06:41:16', 'super_admin'),
(214, 1, 'Super Admin', 'STATUS_UPDATE', 'Super Admin Super Admin (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-21 06:50:22', 'super_admin'),
(215, 1, 'Super Admin', 'STATUS_UPDATE', 'Super Admin Super Admin (ID: 1) set staff two (ID: 5) to Active.', '::1', '2025-03-21 06:50:26', 'super_admin'),
(216, 1, 'Super Admin', 'STATUS_UPDATE', 'Super Admin Super Admin (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-21 06:56:10', 'super_admin'),
(217, 1, 'Super Admin', 'STATUS_UPDATE', 'Super Admin Super Admin (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-21 06:56:12', 'super_admin'),
(218, 1, 'Super Admin', 'Create', 'Staff \'staff five\' added', '::1', '2025-03-21 06:58:57', 'super_admin'),
(219, 1, 'Super Admin', 'Create', 'Staff \'staff six\' added', '::1', '2025-03-21 06:59:51', 'super_admin'),
(220, 1, 'Super Admin', 'Create', 'Staff \'staff seven\' added', '::1', '2025-03-21 07:00:09', 'super_admin'),
(221, 1, 'Supers Admin', 'Update', 'Super Admin profile updated: First Name', '::1', '2025-03-21 07:09:19', 'super_admin'),
(222, 1, 'Supers Admin', 'Update', 'Super Admin profile updated: Profile Picture', '::1', '2025-03-21 07:09:43', 'super_admin'),
(223, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 07:10:46', 'admin'),
(224, 1, 'Admin User', 'Added PWD', 'Admin Admin User added PWD John Doe.', '::1', '2025-03-21 07:30:33', 'admin'),
(225, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'Andres Bonifacio\' updated to \'Approved\' by Admin User', '::1', '2025-03-21 07:35:18', 'admin'),
(226, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'Andres Bonifacio\' updated to \'Released\' by Admin User', '::1', '2025-03-21 07:35:33', 'admin'),
(227, 1, 'Admin User', 'Added PWD to registered list', 'Admin Admin User added PWD John Doe to the registered list.', '::1', '2025-03-21 07:37:00', 'admin'),
(228, 1, 'Admin User', 'Added PWD to registered list', 'Admin Admin User added PWD John Doe to the registered list.', '::1', '2025-03-21 07:40:10', 'admin'),
(229, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-21 07:44:04', 'admin'),
(230, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-21 07:44:43', 'staff'),
(231, 1, 'Sample Staff', 'Job Posting', 'Job posted: Engineer at McDonald\'s by Sample Staff', '::1', '2025-03-21 07:45:30', 'staff'),
(232, 1, 'Sample Staff', 'Job Posting', 'Job posted: a at FedEx by Sample Staff', '::1', '2025-03-21 07:46:30', 'staff'),
(233, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-21 07:51:39', 'staff'),
(234, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 07:51:45', 'admin'),
(235, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-21 07:52:00', 'staff'),
(236, 1, 'Admin User', 'Added PWD to registered list', 'Admin Admin User added PWD John Doe to the registered list.', '::1', '2025-03-21 07:52:33', 'admin'),
(237, 1, 'Sample Staff', 'Job Posting', 'Job posted: a at McDonald\'s by Sample Staff', '::1', '2025-03-21 07:52:48', 'staff'),
(238, 1, 'Sample Staff', 'Create', 'Company \'SM corp\' created', '::1', '2025-03-21 07:55:15', 'staff'),
(239, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-21 07:57:37', 'admin'),
(240, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 07:57:53', 'super_admin'),
(241, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 09:55:33', 'admin'),
(242, 2, 'Admin Two', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 09:56:11', 'admin'),
(243, 2, 'Admin Two', 'Update', 'Admin profile updated: Contact Number, Profile Picture', '::1', '2025-03-21 09:56:33', 'admin'),
(244, 2, 'Admin Two', 'Logout', 'User logged out.', '::1', '2025-03-21 11:09:02', 'admin'),
(245, 2, 'Admin Two', 'Login', 'Admin logged in successfully', '::1', '2025-03-21 11:09:12', 'admin'),
(246, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-22 04:57:11', 'staff'),
(247, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-22 04:58:59', 'staff'),
(248, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-22 05:00:20', 'staff'),
(249, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-22 05:02:09', 'super_admin'),
(250, 1, 'Supers Admin', 'Create', 'Admin \'Admin Three\' added', '::1', '2025-03-22 05:32:31', 'super_admin'),
(251, 1, 'Supers Admin', 'Create', 'Staff \'staff eight\' added', '::1', '2025-03-22 05:32:52', 'super_admin'),
(252, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Admin User (ID: 1) to Inactive.', '::1', '2025-03-22 05:37:40', 'super_admin'),
(253, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Admin User (ID: 1) to Active.', '::1', '2025-03-22 05:37:45', 'super_admin'),
(254, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-22 05:47:11', 'super_admin'),
(255, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set staff two (ID: 5) to Inactive.', '::1', '2025-03-22 05:47:14', 'super_admin'),
(256, 1, 'Sample Staff', 'Job Status Update', 'Job status for \'Engineer\' updated to \'Closed\' by Sample Staff', '::1', '2025-03-22 05:50:49', 'staff'),
(257, 1, 'Supers Admin', 'Update', 'Super Admin profile updated: Profile Picture', '::1', '2025-03-22 05:57:56', 'super_admin'),
(258, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-03-22 05:58:52', 'staff'),
(259, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-22 05:59:11', 'super_admin'),
(260, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-22 06:01:49', 'super_admin'),
(261, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Sample Staff (ID: 1) to Inactive.', '::1', '2025-03-22 06:02:11', 'super_admin'),
(262, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Admin User (ID: 1) to Active.', '::1', '2025-03-22 06:02:46', 'super_admin'),
(263, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Sample Staff (ID: 1) to Active.', '::1', '2025-03-22 06:03:02', 'super_admin'),
(264, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Admin User (ID: 1) to Inactive.', '::1', '2025-03-22 06:25:38', 'super_admin'),
(265, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-22 06:27:28', 'super_admin'),
(266, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set Admin User (ID: 1) to Active.', '::1', '2025-03-22 06:27:36', 'super_admin'),
(267, 1, 'Supers Admin', 'STATUS_UPDATE', 'Super Admin Supers Admin (ID: 1) set staff two (ID: 5) to Active.', '::1', '2025-03-22 06:27:39', 'super_admin'),
(268, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-22 06:28:16', 'super_admin'),
(269, 3, 'Admin Three', 'Login', 'Admin logged in successfully', '::1', '2025-03-22 06:28:23', 'admin'),
(270, 3, 'Admin Three', 'Logout', 'User logged out.', '::1', '2025-03-22 06:28:47', 'admin'),
(271, 11, 'staff eight', 'Login', 'User logged in successfully', '::1', '2025-03-22 06:28:59', 'staff'),
(272, 1, 'Supers Admin', 'Create', 'Admin \'Admin Four\' added', '::1', '2025-03-22 06:30:37', 'super_admin'),
(273, 4, 'Admin Four', 'Login', 'Admin logged in successfully', '::1', '2025-03-22 06:30:54', 'admin'),
(274, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-22 06:32:41', 'super_admin'),
(275, 1, 'Supers Admin', 'Create', 'Staff \'Staff two\' added', '::1', '2025-03-22 06:33:03', 'super_admin'),
(276, 1, 'Supers Admin', 'Create', 'Admin \'Admin Two\' added', '::1', '2025-03-22 06:33:19', 'super_admin'),
(277, 11, 'Supers Admin', 'Logout', 'User logged out.', '::1', '2025-03-22 06:33:20', 'super_admin'),
(278, 12, 'Staff two', 'Login', 'User logged in successfully', '::1', '2025-03-22 06:33:31', 'staff'),
(279, 12, 'Staff two', 'Logout', 'User logged out.', '::1', '2025-03-22 06:33:36', 'staff'),
(280, 5, 'Admin Two', 'Login', 'Admin logged in successfully', '::1', '2025-03-22 06:33:43', 'admin'),
(281, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-22 06:40:16', 'admin'),
(282, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-03-22 06:40:26', 'admin'),
(283, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-03-22 06:44:25', 'admin'),
(284, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-03-22 13:33:33', 'staff'),
(285, 1, 'Sample Staff', 'Archieve', 'Company \'FedEx\' soft deleted', '::1', '2025-03-22 13:38:46', 'staff'),
(286, 1, 'Sample Staff', 'Restore', 'Company \'FedEx\' restored', '::1', '2025-03-22 14:25:35', 'staff'),
(287, 1, 'Sample Staff', 'Archieve', 'Company \'FedEx\' soft deleted', '::1', '2025-03-22 14:26:23', 'staff'),
(288, 1, 'Sample Staff', 'Restore', 'Company \'FedEx\' restored', '::1', '2025-03-22 14:26:26', 'staff'),
(289, 1, 'Sample Staff', 'Archieve', 'Company \'FedEx\' soft deleted', '::1', '2025-03-22 14:28:22', 'staff'),
(290, 1, 'Sample Staff', 'Restore', 'Company \'FedEx\' restored', '::1', '2025-03-22 14:28:50', 'staff'),
(291, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-02 08:17:59', 'admin'),
(292, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-21 08:09:05', 'admin'),
(293, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-04-21 08:09:24', 'admin'),
(294, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-04-21 08:09:39', 'admin'),
(295, 1, 'AdminA User', 'Update', 'Admin profile updated: First Name', '::1', '2025-04-21 08:10:47', 'admin'),
(296, 1, 'Admin User', 'Update', 'Admin profile updated: First Name', '::1', '2025-04-21 08:10:50', 'admin'),
(297, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-04-21 08:12:08', 'admin'),
(298, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-21 08:13:18', 'admin'),
(299, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-04-21 08:20:45', 'admin'),
(300, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-21 08:21:00', 'admin'),
(301, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-04-21 08:22:52', 'staff'),
(302, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-04-21 08:23:25', 'staff'),
(303, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-04-21 09:31:11', 'admin');

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
(18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'FedEx Express, NAIA Complex, Pasay City', 'FedEx is a leading global courier and logistics company that provides fast and reliable shipping solutions. It offers express, freight, and e-commerce shipping services worldwide.', '2025-03-17 11:52:13', '2025-03-22 14:28:50', 0, '2025-03-22 22:28:50'),
(19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig', 'McDonald\'s is a world-renowned fast-food chain offering burgers, fries, and other quick-service meals. It is known for its golden arches logo and consistent food quality.', '2025-03-17 11:52:38', '2025-03-20 17:56:35', 0, NULL),
(23, 'SM corp', '../uploads/1742543715_bg4.jpg', 'Taytay', 'A', '2025-03-21 08:55:15', '2025-03-21 07:55:15', 0, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `message`, `created_at`) VALUES
(1, 'New PWD registration from John Doe (Application ID: APP_5943144B)', '2025-03-21 11:26:38'),
(2, 'New PWD registration from John Doe (Application ID: APP_B96301E1)', '2025-03-21 11:30:43'),
(3, 'New PWD registration from John Doe (Application ID: APP_3D58E069)', '2025-03-21 11:31:28'),
(4, 'New PWD registration from John Doe (Application ID: APP_6A4E0323)', '2025-03-21 11:33:28'),
(5, 'New PWD registration from John Doe (Application ID: APP_E26DEB9D)', '2025-03-21 11:35:34'),
(6, 'New PWD registration from John Doe (Application ID: APP_E7C29543)', '2025-03-21 11:38:27'),
(7, 'New PWD registration from red (Application ID: APP_59133B7D)', '2025-03-21 11:43:47'),
(8, 'New PWD registration from John Doe (Application ID: APP_14D35EDF)', '2025-03-21 11:47:22'),
(9, 'New PWD registration from John Doe', '2025-03-21 11:50:15'),
(10, 'New PWD registration from John Doe', '2025-03-22 06:38:29'),
(11, 'New PWD registration from red', '2025-03-22 06:39:55'),
(12, 'New PWD registration from John Doe', '2025-03-22 06:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `notification_admin`
--

CREATE TABLE `notification_admin` (
  `notification_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `seen` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_admin`
--

INSERT INTO `notification_admin` (`notification_id`, `admin_id`, `seen`, `created_at`) VALUES
(9, 1, 1, '2025-03-21 11:50:15'),
(10, 1, 1, '2025-03-22 06:38:29'),
(10, 5, 0, '2025-03-22 06:38:29'),
(11, 1, 1, '2025-03-22 06:39:55'),
(11, 5, 0, '2025-03-22 06:39:55'),
(12, 1, 1, '2025-03-22 06:44:11'),
(12, 5, 0, '2025-03-22 06:44:11');

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
  `seen` int(11) DEFAULT 0,
  `notification_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwd_registration`
--

INSERT INTO `pwd_registration` (`id`, `full_name`, `birthdate`, `disability_type`, `address`, `contact_number`, `email`, `application_id`, `proof_of_pwd`, `valid_id`, `created_at`, `updated_at`, `status`, `seen`, `notification_id`) VALUES
(105, 'red', '2025-02-27', 'multiple', 'asd', '09071559721', 'jaredsonvicente1771@gmail.com', 'APP_B9472CB0', '../applications/1742625595_bg6.jpg', '../applications/1742625595_bg6.jpg', '2025-03-22 06:39:55', '2025-03-22 06:39:55', 'Pending', 0, NULL),
(106, 'John Doe', '2025-03-01', 'psychosocial', 'aaa', '09071559721', 'jv.aragones1414@gmail.com', 'APP_A993A35E', '../applications/1742625851_bg6.jpg', '../applications/1742625851_bg6.jpg', '2025-03-22 06:44:11', '2025-04-21 08:09:24', 'Approved', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `registered_pwd`
--

CREATE TABLE `registered_pwd` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `disability_type` varchar(255) DEFAULT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registered_pwd`
--

INSERT INTO `registered_pwd` (`id`, `full_name`, `address`, `contact_number`, `email`, `birthdate`, `disability_type`, `registration_date`, `status`) VALUES
(1, 'John Doe', '123 Main Street, City', '09123456789', 'johndoe@example.com', '1980-05-15', 'Visual Impairment', '2025-03-21 07:33:28', 'Active'),
(2, 'Andres Bonifacio', 'Tondo, Manila', '09456789123', 'andres.bonifacio@example.com', '1863-11-30', 'Intellectual Disability', '2025-03-21 07:35:33', 'Active'),
(3, 'John Doe', 'Taytay', '09071559721', 'cas@gmail.com', '2025-03-05', 'ADHD', '2025-03-21 07:37:00', 'Active'),
(4, 'John Doe', 'Taytay', '123', 'staff1@gmail.com', '2025-02-25', 'ADHD', '2025-03-21 07:40:10', 'Active'),
(5, 'John Doe', 'Taytay', '09071559721', 'admin122@gmail.com', '2025-02-25', 'aa', '2025-03-21 07:50:42', 'Active'),
(6, 'John Doe', 'Taytay', '09071559721', 'admin12222@gmail.com', '2025-02-25', 'aaaa', '2025-03-21 07:52:33', 'Active');

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
(1, 'Sample', 'Staff', 'staff1@gmail.com', '09123456789', '$2y$10$i1HjhuJjbcRz0JLZLuuy4OFRSm08JMDfKL0564osyQcwtpYYccYHG', '2025-03-12 16:32:02', '../uploads/1742448535_bg6.jpg', 'active', 'staff'),
(12, 'Staff', 'two', 'staff2@gmail.com', NULL, '$2y$10$OzJjEXo9bWv/GDFUy7PdwuqsoE6FyJ3Z7Mrh9WxBrZoheye1IwDO.', '2025-03-21 23:33:03', '../images/default_profile.jpg', 'active', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

CREATE TABLE `super_admin` (
  `super_admin_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT '../images/default-profile.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` enum('super_admin') DEFAULT 'super_admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_admin_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `profile_pic`, `created_at`, `updated_at`, `usertype`) VALUES
(1, 'Supers', 'Admin', 'superadmin1@gmail.com', '09123456789', '$2y$10$3mhytXoBuCFulXITr0N9vOusosSHVZKZVLmza3MXYoon.3co8diJG', '../uploads/1742623076_bg6.jpg', '2025-03-21 06:03:46', '2025-03-22 05:57:56', 'super_admin');

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `notification_admin`
--
ALTER TABLE `notification_admin`
  ADD PRIMARY KEY (`notification_id`,`admin_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `application_id` (`application_id`);

--
-- Indexes for table `registered_pwd`
--
ALTER TABLE `registered_pwd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `super_admin`
--
ALTER TABLE `super_admin`
  ADD PRIMARY KEY (`super_admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `registered_pwd`
--
ALTER TABLE `registered_pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notification_admin`
--
ALTER TABLE `notification_admin`
  ADD CONSTRAINT `notification_admin_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`notification_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_admin_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
