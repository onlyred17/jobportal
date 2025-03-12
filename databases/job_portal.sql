-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 05:53 PM
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
(1, 'Tech Solutions Inc.', 'tech_solutions_logo.png', 'Makati City, Philippines', 'A leading software development company specializing in web and mobile applications.', '2025-03-13 00:51:32', '2025-03-12 16:51:32'),
(2, 'Innovate IT Hub', 'innovate_logo.png', 'Cebu City, Philippines', 'Providing cutting-edge IT solutions for businesses.', '2025-03-13 00:51:32', '2025-03-12 16:51:32'),
(3, 'CloudSync Corp.', 'cloudsync_logo.png', 'Taguig City, Philippines', 'Experts in cloud computing and cybersecurity.', '2025-03-13 00:51:32', '2025-03-12 16:51:32'),
(4, 'AI Pioneers', 'aipioneers_logo.png', 'Quezon City, Philippines', 'Advancing AI technology for automation and business intelligence.', '2025-03-13 00:51:32', '2025-03-12 16:51:32'),
(5, 'DevWorks PH', 'devworks_logo.png', 'Davao City, Philippines', 'A software firm specializing in enterprise applications and system integrations.', '2025-03-13 00:51:32', '2025-03-12 16:51:32');

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
(4, 104, 'Accessible Solutions', 'accessible_solutions_logo.png', 'Data Entry Specialist', 'Accurately input and manage data into company databases, ensuring accessibility standards.', 'Closed', '2025-03-12 00:00:00', 1, 'Strong typing skills; Attention to detail; Knowledge of MS Excel and Google Sheets', 22.00, 'Full-time', 'Cebu, Philippines'),
(5, 105, 'FutureVision', 'futurevision_logo.png', 'Digital Marketing Specialist', 'Plan and execute digital marketing strategies, including SEO, PPC, and social media management.', 'Open', '2025-03-12 00:00:00', 1, 'Experience in digital marketing; Knowledge of SEO and Google Ads; Strong analytical skills', 45.00, 'Contract', 'Taguig, Philippines'),
(6, 106, 'BrightPath Solutions', 'brightpath_logo.png', 'Administrative Assistant', 'Provide administrative support, schedule meetings, and manage documents efficiently.', 'Open', '2025-03-12 00:00:00', 1, 'High school diploma or equivalent; Proficiency in MS Office; Strong organizational skills', 28.00, 'Full-time', 'Pasig, Philippines'),
(7, 107, 'Visionary Web', 'visionary_web_logo.png', 'Front-End Developer', 'Develop and maintain user-friendly websites with accessibility in mind.', 'Open', '2025-03-12 00:00:00', 1, 'Experience with HTML, CSS, JavaScript, and React; Understanding of accessibility best practices', 55.00, 'Full-time', 'Remote'),
(8, 108, 'CareFirst', 'carefirst_logo.png', 'Medical Transcriptionist', 'Transcribe medical reports and patient records accurately.', 'Open', '2025-03-12 00:00:00', 2, 'Medical transcription certification preferred; Excellent listening and typing skills', 35.00, 'Part-time', 'Davao, Philippines'),
(9, 109, 'EnableTech', 'enabletech_logo.png', 'IT Support Specialist', 'Provide technical assistance, troubleshoot system issues, and assist employees with IT-related concerns.', 'Open', '2025-03-12 00:00:00', 2, 'Degree in IT or related field; Experience with hardware/software troubleshooting', 40.00, 'Full-time', 'Mandaluyong, Philippines'),
(10, 110, 'SmartReach', 'smartreach_logo.png', 'Social Media Manager', 'Develop and manage social media campaigns, create engaging content, and analyze engagement metrics.', 'Open', '2025-03-12 00:00:00', 122, 'Experience in social media marketing; Strong writing and analytical skills', 38.00, 'Contract', 'Remote'),
(35, 3, 'SM corp', '../uploads/1741529311_registration.png', 'Software Engineer', 'We are looking for a skilled Software Engineer to design, develop, test, and maintain high-quality software solutions. The ideal candidate will collaborate with cross-functional teams to create efficient and scalable applications.', 'Open', '2025-03-12 17:46:54', 1, '✔️ Bachelor\'s degree in Computer Science, IT, or related field.\r\n✔️ Proficiency in programming languages (e.g., PHP, JavaScript, Python).\r\n✔️ Experience with databases (e.g., MySQL, PostgreSQL).\r\n✔️ Knowledge of software development methodologies (Agile, Scrum).\r\n✔️ Strong problem-solving and analytical skills.', 0.00, 'Full-time', '');

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
  `profile_pic` varchar(255) DEFAULT '../images/default_profile.jpg',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `usertype` varchar(50) NOT NULL DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `email`, `contact_number`, `password`, `created_at`, `profile_pic`, `status`, `usertype`) VALUES
(1, 'Staff', 'One', 'staff1@gmail.com', '09123456789', '$2y$10$CRi9UxRk3s47QVKG5xMXHurx.fNWQDmn/dI1JMBhl5Y2jwlNWvUBe', '2025-03-12 16:32:02', '../images/default_profile.jpg', 'active', 'staff');

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
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pwd_registration`
--
ALTER TABLE `pwd_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
