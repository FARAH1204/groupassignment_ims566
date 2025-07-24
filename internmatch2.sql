-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2025 at 08:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internmatch2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `internship_date` date DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `internship_id` int(11) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `internship_date`, `status`, `internship_id`, `resume`) VALUES
(1, 2, '2025-07-23', '', 0, NULL),
(2, 3, '2025-07-23', '', 0, 'resume_3_1753276375.pdf'),
(4, 2, '2025-07-23', '', 0, NULL),
(6, 10, '2025-07-24', '', 25, 'resume_10_1753327380.pdf'),
(7, 2, '2025-07-24', '', 1, 'resume_2_1753329757.pdf'),
(8, 2, '2025-07-24', '', 27, 'resume_2_1753332425.pdf'),
(9, 2, '2025-07-24', '', 2, 'resume_2_1753333646.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `internships`
--

CREATE TABLE `internships` (
  `id` int(20) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `date_posted` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `internships`
--

INSERT INTO `internships` (`id`, `company_name`, `position`, `location`, `date_posted`) VALUES
(1, 'PwC Malaysia', 'Intern - Accountancy', 'Kuala Lumpur', '2025-07-23'),
(2, 'AIA Malaysia', 'Intern - Actuarial Science', 'Kuala Lumpur', '2025-07-23'),
(3, 'Habib Jewels', 'Intern - Fine Metal Design', 'Kuala Lumpur', '2025-07-23'),
(4, 'Frost & Sullivan', 'Intern - Graphic Design', 'Petaling Jaya', '2025-07-23'),
(5, 'Jakel Textile', 'Intern - Textile Design', 'Shah Alam', '2025-07-23'),
(6, 'Maybank', 'Intern - Banking', 'Kuala Lumpur', '2025-07-23'),
(7, 'SME Corp', 'Intern - Business Studies', 'Putrajaya', '2025-07-23'),
(8, 'Fusionex', 'Intern - Computer Science', 'Petaling Jaya', '2025-07-23'),
(9, 'Balai Seni Negara', 'Intern - Fine Art', 'Kuala Lumpur', '2025-07-23'),
(10, 'National Library of Malaysia', 'Intern - Information Management', 'Kuala Lumpur', '2025-07-23'),
(11, 'Education Malaysia Global Services', 'Intern - Mathematical Sciences', 'Cyberjaya', '2025-07-23'),
(12, 'Suruhanjaya Perkhidmatan Awam', 'Intern - Office Technology', 'Putrajaya', '2025-07-23'),
(13, 'Ministry of Youth & Sports', 'Intern - Public Administration', 'Putrajaya', '2025-07-23'),
(14, 'Department of Statistics Malaysia', 'Intern - Statistics', 'Putrajaya', '2025-07-23'),
(15, 'UiTM Admin Office', 'Intern - Office Systems', 'Machang', '2025-07-23'),
(16, 'Deloitte Malaysia', 'Intern - Accountancy', 'Kuala Lumpur', '2025-07-23'),
(17, 'Khazanah Nasional', 'Intern - Business Economics', 'Kuala Lumpur', '2025-07-23'),
(18, 'CIMB Bank', 'Intern - Finance', 'Kuala Lumpur', '2025-07-23'),
(19, 'Nestlé Malaysia', 'Intern - Marketing', 'Shah Alam', '2025-07-23'),
(20, 'CyberSecurity Malaysia', 'Intern - IS Management', 'Cyberjaya', '2025-07-23'),
(21, 'Silverlake Group', 'Intern - Information Technology', 'Petaling Jaya', '2025-07-23'),
(22, 'DOSM', 'Intern - Statistics', 'Putrajaya', '2025-07-23'),
(23, 'Universiti Malaya - Data Lab', 'Intern - Mathematics', 'Kuala Lumpur', '2025-07-23'),
(24, 'Sakura Textile Sdn Bhd', 'Intern - Textile Design', 'Kuantan', '2025-07-23'),
(28, 'MayBank Sdn Bhd', 'Marketing', 'Kuantan, Pahang', '2025-07-24'),
(29, 'Bank Islam Sdn Bhd', 'IT', 'Selangor', '2025-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `date_sent`) VALUES
(1, 2, 'Your application has been approved 🎉.', '2025-07-23 23:58:20'),
(2, 3, 'Your application has been rejected ❌.', '2025-07-23 23:58:33'),
(3, 2, 'Your application has been rejected ❌.', '2025-07-23 23:58:35'),
(4, 2, 'Your Application is approved 🎉.', '2025-07-24 03:04:50'),
(5, 10, 'Your application is approved 🎉.', '2025-07-24 11:27:32'),
(6, 2, 'Your application is approved 🎉.', '2025-07-24 12:05:09'),
(7, 2, 'Your application is rejected ❌.', '2025-07-24 12:50:22'),
(8, 2, 'Your application is approved 🎉.', '2025-07-24 13:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `student_id` varchar(30) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `student_id`, `course`, `password`, `role`) VALUES
(1, 'Admin UiTM', 'admin@uitm.edu.my', NULL, NULL, '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'FARAH HASINA', 'farah@uitm.edu.my', '2021456789', 'Diploma in Information Management', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(3, 'Alya Nabila', 'alya@uitm.edu.my', '2021456790', 'Diploma in Computer Science', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(4, 'Qila Syahira', 'qila@uitm.edu.my', '2021456791', 'Diploma in Business Studies', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(5, 'Muna Aina', 'muna@uitm.edu.my', '2021456792', 'Diploma in Fine Art', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(6, 'Daniel Hakim', 'daniel@uitm.edu.my', '2021456793', 'Diploma in Statistics', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(7, 'Izzah Balqis', 'izzah@uitm.edu.my', '2021456794', 'Diploma in Marketing', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(8, 'Rafiq Azhar', 'rafiq@uitm.edu.my', '2021456795', 'Diploma in Office Management', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(9, 'Siti Aina', 'sitia@uitm.edu.my', '2021456796', 'Diploma in Information Management', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(10, 'Ammar Haziq', 'ammar@uitm.edu.my', '2021456797', 'Diploma in Actuarial Science', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(11, 'Zulaikha Nasuha', 'zulaikha@uitm.edu.my', '2021456798', 'Diploma in Mathematical Sciences', 'e10adc3949ba59abbe56e057f20f883e', 'student'),
(17, 'ALYA NABILAH', 'alya@uitm.edu.my', '2023545466', NULL, '$2y$10$XcH4BReqS8P3EocD8s6xlebdwCcT1kA8GW.gefG/RITXO4GvPB07m', 'student'),
(18, 'ALYA NABILAH', 'alya@uitm.edu.my', '2023545466', NULL, '$2y$10$DdWr61FClZFAim9X6jsHeOoRatoIYQOAlhpXVtjtJArIwOH5wxd02', 'student'),
(19, 'ALYA NABILA', 'alya@uitm.edu.my', '2023545466', NULL, '$2y$10$5.QV3B.gEhGkpEmNIWWdUOTAtSJUdtekPqPA8pmx5Be.UrZMe8KlK', 'student'),
(20, 'ALYA NABILA', 'alya@uitm.edu.my', '2023545466', NULL, '$2y$10$N8cZXaeDcryemoSOfELbouiDQuA/Czk0.Tv.z4B6uDVSmbpdyBmQK', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `internships`
--
ALTER TABLE `internships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `internships`
--
ALTER TABLE `internships`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`id`) REFERENCES `internships` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
