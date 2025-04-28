-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 10:04 AM
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
  `usertype` varchar(50) NOT NULL DEFAULT 'admin',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `verification_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `profile_pic`, `created_at`, `updated_at`, `usertype`, `status`, `verification_code`) VALUES
(1, 'Admin', 'User', 'admin1@gmail.com', '1234567890', '$2y$10$B7HWKk3mmqiS/FJz.Frs5enOfbEXIXOBjOBXK97Kwkz22sDHg3kI2', '../uploads/1745470882_bg6.jpg', '2025-03-12 13:47:23', '2025-04-24 07:48:34', 'admin', 'active', NULL),
(5, 'Admin', 'Two', 'admin2@gmail.com', '', '$2y$10$40BZuRcOatSCWCTyqy4bxuZrjzwIuSRFY7IthKmebw4HCbZqM1i.K', '../images/default_profile.jpg', '2025-03-21 23:33:19', '2025-03-22 06:33:19', 'admin', 'active', '');

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
(338, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-04-24 08:08:12', 'staff'),
(339, 1, 'Sample Staff', 'Create', 'Company \'PWD Job Portal Solutions Inc.\' created', '::1', '2025-04-24 08:09:24', 'staff'),
(340, 1, 'Sample Staff', 'Archieve', 'Company \'PWD Job Portal Solutions Inc.\' soft deleted', '::1', '2025-04-24 08:09:37', 'staff'),
(341, 1, 'Sample Staff', 'Restore', 'Company \'PWD Job Portal Solutions Inc.\' restored', '::1', '2025-04-24 08:09:40', 'staff'),
(342, 1, 'Sample Staff', 'Archieve', 'Company \'PWD Job Portal Solutions Inc.\' soft deleted', '::1', '2025-04-24 08:09:53', 'staff'),
(343, 1, 'Sample Staff', 'Restore', 'Company \'PWD Job Portal Solutions Inc.\' restored', '::1', '2025-04-24 08:09:56', 'staff'),
(344, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-04-24 08:10:21', 'staff'),
(345, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-24 08:10:35', 'admin'),
(346, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-04-24 08:10:44', 'admin'),
(347, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-04-25 05:21:57', 'staff'),
(348, 1, 'Sample Staff', 'Job Posting', 'Job posted: Engineer at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:22:13', 'staff'),
(349, 1, 'Sample Staff', 'Job Posting', 'Job posted: Engineer at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:24:45', 'staff'),
(350, 1, 'Sample Staff', 'Job Posting', 'Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:26:40', 'staff'),
(351, 1, 'Sample Staff', 'Job Posting', 'Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:28:16', 'staff'),
(352, 1, 'Sample Staff', 'Job Posting', 'Job posted: as at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:29:03', 'staff'),
(353, 1, 'Sample Staff', 'Job Posting', 'Job posted: a at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:52:36', 'staff'),
(354, 1, 'Sample Staff', 'Job Posting', 'Job posted: asd at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:58:19', 'staff'),
(355, 1, 'Sample Staff', 'Job Posting', 'Job posted: asaa at PWD Job Portal Solutions Inc. by Sample Staff', '::1', '2025-04-25 05:59:37', 'staff'),
(356, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-04-25 06:01:50', 'staff'),
(357, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-04-25 06:09:23', 'staff'),
(358, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-04-25 06:49:09', 'staff'),
(359, 1, 'Sample Staff', 'Login', 'User logged in successfully', '::1', '2025-04-25 06:49:20', 'staff'),
(360, 1, 'Sample Staff', 'Archieve', 'Company \'PWD Job Portal Solutions Inc.\' soft deleted', '::1', '2025-04-25 06:53:07', 'staff'),
(361, 1, 'Sample Staff', 'Restore', 'Company \'PWD Job Portal Solutions Inc.\' restored', '::1', '2025-04-25 06:53:09', 'staff'),
(362, 1, 'Sample Staff', 'Logout', 'User logged out.', '::1', '2025-04-25 07:03:03', 'staff'),
(363, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-25 07:03:11', 'admin'),
(364, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'For Release\' by Admin User', '::1', '2025-04-25 07:11:02', 'admin'),
(365, 1, 'Admin User', 'Logout', 'User logged out.', '::1', '2025-04-25 07:31:36', 'admin'),
(366, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-04-25 07:32:05', 'super_admin'),
(367, 1, 'Admin User', 'Login', 'Admin logged in successfully', '::1', '2025-04-25 07:33:37', 'admin'),
(368, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:37:38', 'admin'),
(369, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:37:44', 'admin'),
(370, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:40:03', 'admin'),
(371, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:40:37', 'admin'),
(372, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Approved\' by Admin User', '::1', '2025-04-25 07:45:47', 'admin'),
(373, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:46:33', 'admin'),
(374, 1, 'Admin User', 'PWD Status Update', 'Status for PWD \'John Doe\' updated to \'Rejected\' by Admin User', '::1', '2025-04-25 07:47:28', 'admin');

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
(12, 'New PWD registration from John Doe', '2025-03-22 06:44:11'),
(13, 'New PWD registration from John Doe', '2025-04-23 11:35:13'),
(14, 'New PWD registration from John Doe', '2025-04-23 11:45:28'),
(15, 'New PWD registration from John Doe', '2025-04-23 11:48:46'),
(16, 'New PWD registration from John Doe', '2025-04-23 11:54:10'),
(17, 'New PWD registration from John Doe', '2025-04-23 12:05:28'),
(18, 'New PWD registration from John Doe', '2025-04-23 13:25:56'),
(19, 'New PWD registration from John Doe', '2025-04-23 13:38:39'),
(20, 'New PWD registration from red', '2025-04-23 13:39:24'),
(21, 'New PWD registration from John Doe', '2025-04-23 13:39:42'),
(22, 'New PWD registration from John Doe', '2025-04-25 05:12:53'),
(23, 'New PWD registration from John Doe', '2025-04-25 07:09:32'),
(24, 'New PWD registration from John Doe', '2025-04-25 08:00:17');

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
(12, 5, 0, '2025-03-22 06:44:11'),
(13, 1, 1, '2025-04-23 11:35:13'),
(13, 5, 0, '2025-04-23 11:35:13'),
(14, 1, 1, '2025-04-23 11:45:28'),
(14, 5, 0, '2025-04-23 11:45:28'),
(15, 1, 1, '2025-04-23 11:48:46'),
(15, 5, 0, '2025-04-23 11:48:46'),
(16, 1, 1, '2025-04-23 11:54:10'),
(16, 5, 0, '2025-04-23 11:54:11'),
(17, 1, 1, '2025-04-23 12:05:28'),
(17, 5, 0, '2025-04-23 12:05:28'),
(18, 1, 1, '2025-04-23 13:25:56'),
(18, 5, 0, '2025-04-23 13:25:56'),
(19, 1, 1, '2025-04-23 13:38:39'),
(19, 5, 0, '2025-04-23 13:38:39'),
(20, 1, 1, '2025-04-23 13:39:24'),
(20, 5, 0, '2025-04-23 13:39:24'),
(21, 1, 1, '2025-04-23 13:39:42'),
(21, 5, 0, '2025-04-23 13:39:42'),
(22, 1, 1, '2025-04-25 05:12:53'),
(22, 5, 0, '2025-04-25 05:12:53'),
(23, 1, 1, '2025-04-25 07:09:32'),
(23, 5, 0, '2025-04-25 07:09:32'),
(24, 1, 0, '2025-04-25 08:00:17'),
(24, 5, 0, '2025-04-25 08:00:17');

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
  `notification_id` int(11) DEFAULT NULL,
  `valid_id_back` varchar(255) NOT NULL,
  `valid_id_type` varchar(255) NOT NULL,
  `reason` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `usertype` varchar(50) NOT NULL DEFAULT 'staff',
  `verification_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `created_at`, `profile_pic`, `status`, `usertype`, `verification_code`) VALUES
(1, 'Sample', 'Staff', 'staff1@gmail.com', '09123456789', '$2y$10$IiihPl49MrDrLS8ZwwtckuE9M8lmf7J1mFMprLji1FZ/VJRlwBSd2', '2025-03-12 16:32:02', '../uploads/1742448535_bg6.jpg', 'active', 'staff', NULL),
(12, 'Staff', 'two', 'staff2@gmail.com', NULL, '$2y$10$OzJjEXo9bWv/GDFUy7PdwuqsoE6FyJ3Z7Mrh9WxBrZoheye1IwDO.', '2025-03-21 23:33:03', '../images/default_profile.jpg', 'active', 'staff', NULL);

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
  `usertype` enum('super_admin') DEFAULT 'super_admin',
  `verification_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `super_admin`
--

INSERT INTO `super_admin` (`super_admin_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `profile_pic`, `created_at`, `updated_at`, `usertype`, `verification_code`) VALUES
(1, 'Supers', 'Admin', 'superadmin1@gmail.com', '09123456789', '$2y$10$RjJGXdJqoSoesbKd3.E6mOnsv4AMpdO8OwwXLzl7qjXTOs.jecQEi', '../uploads/1742623076_bg6.jpg', '2025-03-21 06:03:46', '2025-04-24 08:05:41', 'super_admin', NULL);

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
  ADD UNIQUE KEY `application_id` (`application_id`),
  ADD KEY `email` (`email`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

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
