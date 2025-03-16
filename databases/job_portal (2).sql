-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 12:42 PM
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
(1, 'Admin', 'User', 'admin1@gmail.com', '1234567890', '$2y$10$EG8XipZeHWhtQEKU8hwGAOyfkPVvBByP3wX269RLRKVmf6oowK6iK', '../images/default_profile.jpg', '2025-03-12 13:47:23', '2025-03-12 15:12:53', 'admin'),
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
(27, 1, 'Sample Staff', 'Update', 'Staff profile updated: First Name', '::1', '2025-03-14 11:40:18', 'staff');

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `location`, `description`, `created_at`, `updated_at`) VALUES
(5, 'DevWorks US', '../uploads/bg2.jpg', 'Davao City, Philippines', 'A software firm specializing in enterprise applications and system integrations.', '2025-03-13 00:51:32', '2025-03-14 10:56:50'),
(14, 'Concetrix', '../uploads/html-logo.png', 'Taytay', 'Call Center', '2025-03-14 06:53:28', '2025-03-14 06:42:59'),
(15, 'SM cor', '../uploads/1741949464_html-logo.png', 'Taytay', 'asd', '2025-03-14 11:51:04', '2025-03-14 10:51:04');

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
(1, 101, 'Inclusive Tech Solutions', 'inclusive_tech_logo.png', 'Software Developer', 'Develop and maintain web applications using PHP and MySQL. Ensure accessibility compliance.', 'Closed', '2025-03-20 06:00:00', 1, 'Bachelor’s degree in IT or related field; Experience with PHP, MySQL, and JavaScript; Strong problem-solving skills', 50.00, 'Full-time', 'Makati, Philippines'),
(2, 102, 'Empower Inc.', 'empower_inc_logo.png', 'Customer Support Representative', 'Provide excellent customer service via chat, email, and phone. Handle inquiries from customers with diverse needs.', 'Open', '2025-03-20 00:00:00', 1, 'High school diploma or equivalent; Strong communication skills; Experience in customer service is a plus', 25.00, 'Full-time', 'Quezon City, Philippines'),
(3, 103, 'DiversityWorks', 'diversity_works_logo.png', 'Graphic Designer', 'Create visually appealing designs for marketing materials, social media, and website content.', 'Open', '2025-03-20 00:00:00', 1, 'Proficiency in Adobe Photoshop, Illustrator, and Canva; Portfolio of previous work required', 40.00, 'Part-time', 'Remote'),
(4, 104, 'Accessible Solutions', 'accessible_solutions_logo.png', 'Data Entry Specialist', 'Accurately input and manage data into company databases, ensuring accessibility standards.', 'Open', '2025-03-12 00:00:00', 1, 'Strong typing skills; Attention to detail; Knowledge of MS Excel and Google Sheets', 22.00, 'Full-time', 'Cebu, Philippines'),
(5, 105, 'FutureVision', 'futurevision_logo.png', 'Digital Marketing Specialist', 'Plan and execute digital marketing strategies, including SEO, PPC, and social media management.', 'Open', '2025-03-12 00:00:00', 1, 'Experience in digital marketing; Knowledge of SEO and Google Ads; Strong analytical skills', 45.00, 'Contract', 'Taguig, Philippines'),
(6, 106, 'BrightPath Solutions', 'brightpath_logo.png', 'Administrative Assistant', 'Provide administrative support, schedule meetings, and manage documents efficiently.', 'Open', '2025-03-12 00:00:00', 1, 'High school diploma or equivalent; Proficiency in MS Office; Strong organizational skills', 28.00, 'Full-time', 'Pasig, Philippines'),
(7, 107, 'Visionary Web', 'visionary_web_logo.png', 'Front-End Developer', 'Develop and maintain user-friendly websites with accessibility in mind.', 'Open', '2025-03-12 00:00:00', 1, 'Experience with HTML, CSS, JavaScript, and React; Understanding of accessibility best practices', 55.00, 'Full-time', 'Remote'),
(8, 108, 'CareFirst', 'carefirst_logo.png', 'Medical Transcriptionist', 'Transcribe medical reports and patient records accurately.', 'Open', '2025-03-12 00:00:00', 2, 'Medical transcription certification preferred; Excellent listening and typing skills', 35.00, 'Part-time', 'Davao, Philippines'),
(9, 109, 'EnableTech', 'enabletech_logo.png', 'IT Support Specialist', 'Provide technical assistance, troubleshoot system issues, and assist employees with IT-related concerns.', 'Open', '2025-03-12 00:00:00', 2, 'Degree in IT or related field; Experience with hardware/software troubleshooting', 40.00, 'Full-time', 'Mandaluyong, Philippines'),
(10, 110, 'SmartReach', 'smartreach_logo.png', 'Social Media Manager', 'Develop and manage social media campaigns, create engaging content, and analyze engagement metrics.', 'Open', '2025-03-12 00:00:00', 122, 'Experience in social media marketing; Strong writing and analytical skills', 38.00, 'Contract', 'Remote'),
(35, 3, 'SM corp', '../uploads/1741529311_registration.png', 'Software Engineer', 'We are looking for a skilled Software Engineer to design, develop, test, and maintain high-quality software solutions. The ideal candidate will collaborate with cross-functional teams to create efficient and scalable applications.', 'Open', '2025-03-12 17:46:54', 1, '✔️ Bachelor\'s degree in Computer Science, IT, or related field.\r\n✔️ Proficiency in programming languages (e.g., PHP, JavaScript, Python).\r\n✔️ Experience with databases (e.g., MySQL, PostgreSQL).\r\n✔️ Knowledge of software development methodologies (Agile, Scrum).\r\n✔️ Strong problem-solving and analytical skills.', 0.00, 'Full-time', ''),
(36, 4, 'AI Pioneers', '../uploads/cat.jpg', 'Software Engineer', 'Create App', 'Open', '2025-03-14 06:19:03', 1, 'Skills', 20.00, 'Full-time', ''),
(37, 5, 'DevWorks PH', '../uploads/bg2.jpg', 'Software Developer', 'Sample desc', 'Open', '2025-03-14 11:54:11', 1, 'Sample Req', 0.00, 'Part-time', ''),
(38, 14, 'Concetrix', '../uploads/html-logo.png', 'Software Engineer', 'sample', 'Open', '2025-03-14 11:55:19', 1, 'sample', 0.00, 'Part-time', ''),
(39, 5, 'DevWorks US', '../uploads/bg2.jpg', 'IT', 'IT', 'Open', '2025-03-14 12:16:04', 1, 'IT', 0.00, 'Full-time', '');

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
  `status` enum('Pending','Approved','For Printing','For Release','Released','Rejected') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwd_registration`
--

INSERT INTO `pwd_registration` (`id`, `full_name`, `birthdate`, `disability_type`, `address`, `contact_number`, `email`, `application_id`, `proof_of_pwd`, `valid_id`, `created_at`, `updated_at`, `status`) VALUES
(12, 'John Doe', '2025-03-06', 'ADHD', 'ASD', '09071559721', 'admin1@gmail.com', 'APP_6E7D2E68', '../applications/1741930028_CertificateOfRegistrationForm.pdf', '../applications/1741930028_CertificateOfRegistrationForm.pdf', '2025-03-14 05:27:08', '2025-03-14 11:15:30', 'Approved'),
(13, 'John Doe', '2025-02-27', 'asd', 'asd', '09071559721', 'jv.aragones1414@gmail.com', 'APP_39362D0E', '../applications/1741930053_cat.jpg', '../applications/1741930053_cat.jpg', '2025-03-14 05:27:33', '2025-03-14 06:14:27', 'Released');

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
(1, 'Sample', 'Staff', 'staff1@gmail.com', '09123456789', '$2y$10$CRi9UxRk3s47QVKG5xMXHurx.fNWQDmn/dI1JMBhl5Y2jwlNWvUBe', '2025-03-12 16:32:02', '../images/default_profile.jpg', 'active', 'staff');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
