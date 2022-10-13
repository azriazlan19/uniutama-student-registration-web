-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 09:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usradb`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(111) NOT NULL,
  `page_title` varchar(111) NOT NULL,
  `page_caption` varchar(111) DEFAULT NULL,
  `page_icon` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page_name`, `page_title`, `page_caption`, `page_icon`) VALUES
(0, 'dashboard.php', 'Dashboard', 'Uniutama Student Registration Application<br>(Web Platform)', 'fa fa-home'),
(1, 'profile.php', 'Applicant Profile', 'Update your profile to proceed with the student registration process', 'fa fa-address-card'),
(2, 'counselling.php', 'Counselling Session', 'Scheduled meetings and phone counselling arrangement', 'fa fa-comments'),
(3, 'documents.php', 'Documents Submission', 'Upload required documents for admission processes', 'fa fa-paper-plane'),
(4, 'course.php', 'Course Selection', 'Course selection based on your qualification', 'fa fa-archway'),
(5, 'verification.php', 'Documents Verification', 'Verification process with scholarship offering', 'fa fa-check-double'),
(6, 'pronouncement.php', 'Application Pronouncement', 'Course offering and school admission', 'fa fa-hat-wizard');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `email` varchar(51) NOT NULL,
  `password` varchar(51) NOT NULL,
  `register_dt` varchar(50) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `race` varchar(10) DEFAULT NULL,
  `maritalstatus` varchar(10) DEFAULT NULL,
  `dateofbirth` varchar(10) DEFAULT NULL,
  `placeofbirth` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
