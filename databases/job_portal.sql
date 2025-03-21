-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 10:05 AM
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
(240, 1, 'Supers Admin', 'Login', 'Super Admin logged in successfully', '::1', '2025-03-21 07:57:53', 'super_admin');

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
(18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'FedEx Express, NAIA Complex, Pasay City', 'FedEx is a leading global courier and logistics company that provides fast and reliable shipping solutions. It offers express, freight, and e-commerce shipping services worldwide.', '2025-03-17 11:52:13', '2025-03-20 17:56:29', 0, NULL),
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
(41, 17, 'Apple', '../uploads/1742208705_th (1).jpg', 'Engineer', 'Asd', 'Open', '2025-03-20 05:38:23', 1, 'aaa', 2.00, 'Part-time', ''),
(42, 18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'Engineer', 'ASD', 'Open', '2025-03-20 18:52:11', 1, 'ASD', 2.00, 'Part-time', ''),
(43, 18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'Engineer', 'asd', 'Open', '2025-03-20 18:53:17', 1, '22', 2.00, 'Full-time', ''),
(44, 18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'Engineera', 'aaa', 'Open', '2025-03-21 05:52:06', 1, 'aaa', 2.00, 'Full-time', 'FedEx Express, NAIA Complex, Pasay City'),
(45, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'Engineer', 'a', 'Open', '2025-03-21 05:52:41', 1, 'a', 2.00, 'Part-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig'),
(46, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'Engineer', 'a', 'Open', '2025-03-21 05:52:59', 1, 'a', 2.00, 'Part-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig'),
(47, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'Engineer', 'a', 'Open', '2025-03-21 06:14:16', 1, 'aa', 2.00, 'Part-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig'),
(48, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'Engineer', 'a', 'Open', '2025-03-21 06:14:34', 1, 'aa', 2.00, 'Part-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig'),
(49, 18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'a', 'a', 'Open', '2025-03-21 06:15:50', 1, 'aa', 222.00, 'Full-time', 'FedEx Express, NAIA Complex, Pasay City'),
(50, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'Engineer', 'a', 'Open', '2025-03-21 08:45:30', 1, 'a', 2.00, 'Part-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig'),
(51, 18, 'FedEx', '../uploads/1742208733_th (2).jpg', 'a', 'a', 'Open', '2025-03-21 08:46:30', 1, 'a', 2.00, 'Part-time', 'FedEx Express, NAIA Complex, Pasay City'),
(52, 19, 'McDonald\'s', '../uploads/1742208758_th (3).jpg', 'a', 'a', 'Open', '2025-03-21 08:52:48', 1, 'aa', 2.00, 'Full-time', 'McDonald\'s BGC, 32nd Street, Bonifacio Global City, Taguig');

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
(69, 'Juan Dela Cruz', '1990-05-15', 'Visual Impairment', 'Manila, Philippines', '09123456789', 'juan.delacruz@example.com', 'APP-001', 'proof1.jpg', 'id1.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(70, 'Maria Clara', '1985-08-22', 'Hearing Impairment', 'Cebu, Philippines', '09234567891', 'maria.clara@example.com', 'APP-002', 'proof2.jpg', 'id2.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(71, 'Jose Rizal', '1861-06-19', 'Orthopedic Disability', 'Laguna, Philippines', '09345678912', 'jose.rizal@example.com', 'APP-003', 'proof3.jpg', 'id3.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(72, 'Andres Bonifacio', '1863-11-30', 'Intellectual Disability', 'Tondo, Manila', '09456789123', 'andres.bonifacio@example.com', 'APP-004', 'proof4.jpg', 'id4.jpg', '2025-03-20 12:09:14', '2025-03-21 07:35:33', 'Released', 0, 1),
(73, 'Emilio Aguinaldo', '1869-03-22', 'Speech Impairment', 'Kawit, Cavite', '09567891234', 'emilio.aguinaldo@example.com', 'APP-005', 'proof5.jpg', 'id5.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(74, 'Gabriela Silang', '1731-03-19', 'Orthopedic Disability', 'Ilocos Sur, Philippines', '09678912345', 'gabriela.silang@example.com', 'APP-006', 'proof6.jpg', 'id6.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(75, 'Apolinario Mabini', '1864-07-23', 'Orthopedic Disability', 'Batangas, Philippines', '09789123456', 'apolinario.mabini@example.com', 'APP-007', 'proof7.jpg', 'id7.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(76, 'Melchora Aquino', '1812-01-06', 'Visual Impairment', 'Quezon City, Philippines', '09891234567', 'melchora.aquino@example.com', 'APP-008', 'proof8.jpg', 'id8.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(77, 'Antonio Luna', '1866-10-29', 'Hearing Impairment', 'Manila, Philippines', '09912345678', 'antonio.luna@example.com', 'APP-009', 'proof9.jpg', 'id9.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(78, 'Gregorio del Pilar', '1875-11-14', 'Speech Impairment', 'Bulacan, Philippines', '09998765432', 'gregorio.pilar@example.com', 'APP-010', 'proof10.jpg', 'id10.jpg', '2025-03-20 12:09:14', '2025-03-20 12:21:41', 'Pending', 0, 1),
(80, 'John Doe', '2025-02-25', 'ADHD', 'Taytay', '09071559721', 'admin1@gmail.com', '', '', '', '2025-03-21 07:30:33', '2025-03-21 07:31:24', 'Pending', 0, 1);

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
(5, 'staff', 'two', 'staff2@gmail.com', NULL, '$2y$10$Mlej6D5.NAM86dbJpUeURO4qzveEIGzyrSXK2x7TprSfPgJgcFQNm', '2025-03-14 22:46:06', '../uploads/default_profile.png', 'active', 'staff'),
(6, 'staff', 'three', 'staff3@gmail.com', NULL, '$2y$10$AH1bFMsnwCBfnbQlEdNhmu0mh6HpcRiHLTwm341Dp/uhrqDudHFbm', '2025-03-14 22:46:41', '../uploads/default_profile.png', 'active', 'staff'),
(7, 'staff', 'four', 'staff4@gmail.com', NULL, '$2y$10$qNo7OI96361quDFgzS2.t.bL4GOfHZQl8uF4PpHwGuNRiGRGSRLii', '2025-03-14 22:47:10', '../uploads/default_profile.png', 'active', 'staff'),
(8, 'staff', 'five', 'staff5@gmail.com', NULL, '$2y$10$PqIiwVNkNai8d1OXtdk3VeEjWXKVuAtqKFYunRlBGThKhaDSQgSI.', '2025-03-20 23:58:57', '../uploads/default_profile.png', 'active', 'staff'),
(9, 'staff', 'six', 'staff6@gmail.com', NULL, '$2y$10$vs0FTOqg2UKWq0QU4d8Jn.NePvk./N4ljQn.udbUGwZlmjyI0qS5.', '2025-03-20 23:59:51', '../uploads/default_profile.png', 'active', 'staff'),
(10, 'staff', 'seven', 'staff7@gmail.com', NULL, '$2y$10$HdNMwEp9DYdRs1C0L7pqNeO7mHSCxHrPLh3IpcTJJ60/Dq32A8vEG', '2025-03-21 00:00:09', '../uploads/default_profile.png', 'active', 'staff');

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
(1, 'Supers', 'Admin', 'superadmin1@gmail.com', '09123456789', '$2y$10$3mhytXoBuCFulXITr0N9vOusosSHVZKZVLmza3MXYoon.3co8diJG', '../uploads/1742540983_bg4.jpg', '2025-03-21 06:03:46', '2025-03-21 07:09:43', 'super_admin');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

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
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `registered_pwd`
--
ALTER TABLE `registered_pwd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `super_admin`
--
ALTER TABLE `super_admin`
  MODIFY `super_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
