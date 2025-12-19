-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2025 at 02:13 PM
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
-- Database: `enrollment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` enum('enrolled','completed') DEFAULT 'enrolled',
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `subject_id`, `status`, `grade`) VALUES
(1, 13, 0, 'enrolled', NULL),
(2, 13, 1, 'completed', '1.00'),
(3, 13, 2, 'completed', '1.00'),
(4, 13, 7, 'completed', '1.25'),
(5, 13, 8, 'enrolled', NULL),
(6, 11, 8, 'completed', '1.50'),
(7, 11, 2, 'enrolled', NULL),
(8, 11, 12, 'enrolled', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `enrollment_id` int(11) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`enrollment_id`, `grade`) VALUES
(0, '1.00'),
(2, '1.00'),
(3, '1.00'),
(4, '1.25'),
(6, '1.50');

-- --------------------------------------------------------

--
-- Table structure for table `prerequisites`
--

CREATE TABLE `prerequisites` (
  `subject_id` int(11) NOT NULL,
  `prerequisite_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prerequisites`
--

INSERT INTO `prerequisites` (`subject_id`, `prerequisite_id`) VALUES
(5, 6),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `name`) VALUES
(2, '222', 'Math 2'),
(3, '333', 'Science 1'),
(4, '444', 'Science 2'),
(5, '555', 'English 1'),
(6, '666', 'English 2'),
(7, '777', 'WebDev 1'),
(8, '999', 'WebSys 1'),
(9, '000', 'Spanish'),
(10, '900', 'AppDev'),
(11, '911', 'AppDev'),
(12, '123', 'Web System 2');

-- --------------------------------------------------------

--
-- Table structure for table `subject_faculty`
--

CREATE TABLE `subject_faculty` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_faculty`
--

INSERT INTO `subject_faculty` (`id`, `faculty_id`, `subject_id`) VALUES
(1, 6, 0),
(2, 6, 1),
(3, 6, 2),
(4, 6, 7),
(5, 14, 12),
(6, 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('student','faculty','admin') NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `profile_pic`, `signature`) VALUES
(1, 'faculty', 'Fernandez, Chris Jacob', 'jacob@sample.com', '$2y$10$ZdskNOnzOyKqYB2il3ZxZul9VU3zVCSCoouOe06szxJa8JjiZXItu', 'OIP.jpg', '1406845795.webp'),
(9, 'admin', 'System Admin', 'admin@sample.com', '$2y$10$Pinjx6sTKtcS3Ujs7oAvWuwAGrYLlH6wYrUiJEr1Tbj18ok51iH/K', '1765717595_Mona-Lisa-oil-wood-panel-Leonardo-da.webp', '1765717595_1406845795.webp'),
(11, 'student', 'Francis, Jake', 'jake@sample.com', '$2y$10$F4AV6usytZ5jvObTldCDNuTDQ0mYuxzNsWT2wJbMVKvfp2SIWp5ES', 'OIP.jpg', '1406845795.webp'),
(13, 'student', 'Tabs, Tin', 'tin@sample.com', '$2y$10$T1fmNVSH9.Ukj1set6g2p.AjO1el.j7eW2KgFmakkbwxzKct0i9Jy', '0c77a74c-c02a-4c09-a074-2ebc75e90d80-removebg-preview.png', 'flag-of-the-philippines-free-png.webp'),
(14, 'faculty', 'Fernandez, Daryl', 'daryl@sample.com', '$2y$10$NtbpqFRbpaKT82f8rDKRiu21BuOuyn8DRSSaETimZHRgv8Dr.bQEO', 'OIP.jpg', '1406845795.webp'),
(15, 'student', 'Fernandez, Ryan', 'ryan@sample.com', '$2y$10$zXPHstcwFG3oDbeOeczkkOrExJX/Z8jP/gjZtuiMTbUleRFnX9u.e', 'OIP.jpg', 'eab4a933-9e02-4fad-b5b9-1bfe09a7d61c.__CR0_0_1940_600_PT0_SX970_V1___-removebg-preview.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_faculty`
--
ALTER TABLE `subject_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subject_faculty`
--
ALTER TABLE `subject_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
