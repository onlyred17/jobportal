-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 06:43 PM
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
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `location`, `description`, `created_at`) VALUES
(3, 'SM corp', '../uploads/1741529311_registration.png', 'Taytay', 'asd', '2025-03-09 15:08:31'),
(4, 'Jabi', '../uploads/1741529387_steam.jpg', 'asd', 'asd', '2025-03-09 15:09:47'),
(13, 'a', '../uploads/1741603135_415484664_6416179271817304_1103546640539258061_n.jpg', 'a', 'a', '2025-03-10 11:38:55');

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
(13, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'kargador', 'asd', 'Open', '2025-03-09 16:11:44', 1, 'magaling', 0.00, 'Full-time', 'taytay'),
(14, 3, 'SM corp', '../uploads/1741529311_registration.png', 'asd', 'asd', 'Closed', '2025-03-09 16:11:51', 2, 'asd', 0.00, 'Full-time', 'binangonan'),
(16, 4, 'Jabi', '../uploads/1741529387_steam.jpg', 'asdasd', 'asd', 'Open', '2025-03-09 17:53:40', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(17, 1, 'A', 'tech_logo.png', 'asasd', 'asd', 'Open', '2025-03-09 17:57:58', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(18, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'asd', 'asd', 'Open', '2025-03-09 18:02:45', 1, 'asd', 0.00, 'Contract', 'taytay'),
(19, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'asasd', 'asd', 'Open', '2025-03-09 18:04:34', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(20, 1, 'A', 'tech_logo.png', 'as', 'asd', 'Closed', '2025-03-09 18:21:32', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(21, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'RED', 'RED', 'Open', '2025-03-09 18:23:14', 1, 'RED', 0.00, 'Full-time', 'taytay'),
(22, 1, 'A', 'tech_logo.png', 'RED', 'RED@', 'Open', '2025-03-09 18:24:22', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(23, 3, 'SM corp', '../uploads/1741529311_registration.png', 'asd', 'asd', 'Open', '2025-03-09 18:25:36', 1, 'asd', 0.00, 'Part-time', 'taytay'),
(24, 1, 'A', 'tech_logo.png', 'asaaaa', 'asd', 'Closed', '2025-03-09 18:29:02', 1, 'aa', 0.00, 'Full-time', 'taytay'),
(25, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'as', 'as', 'Open', '2025-03-09 18:30:18', 1, 'a', 0.00, 'Part-time', ''),
(26, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'RED2', 'RED@', 'Open', '2025-03-09 18:31:50', 1, 'asd', 0.00, 'Contract', ''),
(27, 3, 'SM corp', '../uploads/1741529311_registration.png', 'A', 'A', 'Open', '2025-03-09 18:34:57', 1, 'A', 0.00, 'Part-time', ''),
(28, 1, 'A', 'tech_logo.png', 'asd', 'asd', 'Open', '2025-03-09 18:35:43', 1, 'a', 0.00, 'Contract', ''),
(29, 3, 'SM corp', '../uploads/1741529311_registration.png', 'as', 'a', 'Open', '2025-03-10 11:37:41', 1, 'a', 0.00, 'Part-time', ''),
(30, 3, 'SM corp', '../uploads/1741529311_registration.png', 'as', 'a', 'Open', '2025-03-10 11:37:42', 1, 'a', 0.00, 'Part-time', ''),
(31, 3, 'SM corp', '../uploads/1741529311_registration.png', 'as', 'a', 'Open', '2025-03-10 11:37:43', 1, 'a', 0.00, 'Part-time', ''),
(32, 3, 'SM corp', '../uploads/1741529311_registration.png', 'as', 'a', 'Open', '2025-03-10 11:37:43', 1, 'a', 0.00, 'Part-time', ''),
(33, 3, 'SM corp', '../uploads/1741529311_registration.png', 'as', 'a', 'Open', '2025-03-10 11:37:43', 1, 'a', 0.00, 'Part-time', ''),
(34, 2, 'Concetrix', '../uploads/1741529217_cat.jpg', 'a', 'a', 'Open', '2025-03-10 11:38:08', 1, 'a', 0.00, 'Full-time', '');

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
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwd_registration`
--

INSERT INTO `pwd_registration` (`id`, `full_name`, `birthdate`, `disability_type`, `address`, `contact_number`, `email`, `application_id`, `proof_of_pwd`, `status`, `created_at`) VALUES
(1, 'red', '2025-03-01', 'asd', 'asd', 'asd', 'cas@gmail.com', '', '../applications/1741615738_415484664_6416179271817304_1103546640539258061_n.jpg', 'Pending', '2025-03-10 14:08:58'),
(3, 'red', '2025-03-08', 'asd', 'asd', '2', 'jv.aragones1414@gmail.com', 'APP_B15A412B', '../applications/1741616259_415484664_6416179271817304_1103546640539258061_n.jpg', 'Pending', '2025-03-10 14:17:39'),
(4, 'redede', '2025-03-06', 'asd', 'asd', '123', 'redv2@gmail.com', 'APP_41EF9F8B', '../applications/1741616404_415484664_6416179271817304_1103546640539258061_n.jpg', 'Pending', '2025-03-10 14:20:04'),
(5, 'red', '2025-03-13', 'asd', 'asd', '123', 'redv22@gmail.com', 'APP_F7460B49', '../applications/1741618301_415484664_6416179271817304_1103546640539258061_n.jpg', 'Pending', '2025-03-10 14:51:41'),
(6, 'red vc', '2025-03-12', 'asd', 'asd', '12', 'jv.aragones12414@gmail.com', 'APP_67CA4687', '../applications/1741619112_415484664_6416179271817304_1103546640539258061_n.jpg', 'Pending', '2025-03-10 15:05:12');

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
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `created_at`, `profile_pic`) VALUES
(1, 'Jared Son', 'Vicentes', 'cas@gmail.com', '09071559721', '$2y$10$w4QoVCa5U.68CFv69EJBq.zr2TgQ8cvHletHp99futJ6N.ol7WxyS', '2025-03-08 07:56:54', '../uploads/1741528292_my_profile.jpg'),
(2, 'Jared Son', 'Vicentes', 'red@gmail.com', '09071559721', '$2y$10$w4QoVCa5U.68CFv69EJBq.zr2TgQ8cvHletHp99futJ...', '2025-03-08 07:56:54', '../uploads/1741528292_my_profile.jpg');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
