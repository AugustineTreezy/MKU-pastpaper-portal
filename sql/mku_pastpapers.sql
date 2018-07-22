-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2018 at 08:36 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mku_pastpapers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@mkupastpapersportal.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `email`, `password`) VALUES
(2, 'augustinetreezy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'augustineowuor32@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Table structure for table `intelligent_questions`
--

CREATE TABLE `intelligent_questions` (
  `id` int(11) NOT NULL,
  `unit_name` text NOT NULL,
  `unit_code` text NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `question_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intelligent_questions`
--

INSERT INTO `intelligent_questions` (`id`, `unit_name`, `unit_code`, `question`, `answer`, `question_type`) VALUES
(1, 'Intro to programming', 'DIT747', 'What is array.', 'An array is a data structure, which can store a fixed-size collection of elements of the same data type. An array is used to store a collection of data, but it is often more useful to think of an array as a collection of variables of the same type.', 'define'),
(2, 'Intro to programming', 'DIT747', 'What is a variable.', 'Variable is a symbolic name that holds a value that can change during program execution.', 'define'),
(5, 'DTP', 'DIT748', 'What is master page as used in desktop publishing', 'Master pages allow you to create a consistent layout for the pages in your application. A single master page defines the look and feel and standard behavior that you want for all of the pages (or a group of pages) in your application', 'define'),
(6, 'DTP', 'DIT748', 'What are guidelines as used in desktop publisher software', '', 'define'),
(15, 'Intro to programming', 'MVCT566', 'Define a compiler', 'Compiler converts a high level language to machine language', 'Define'),
(16, 'Intro to programming', 'MVCT566', 'Differentiate between compiler and assembler', 'Compiler converts a high level language to machine language.\r\nAssembler converts assembly language to machine language', 'Difference');

-- --------------------------------------------------------

--
-- Table structure for table `pastpapers`
--

CREATE TABLE `pastpapers` (
  `id` int(11) NOT NULL,
  `department` text NOT NULL,
  `programme` text NOT NULL,
  `unit_name` text NOT NULL,
  `unit_code` text NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pastpapers`
--

INSERT INTO `pastpapers` (`id`, `department`, `programme`, `unit_name`, `unit_code`, `question`, `answer`) VALUES
(2, 'Computer Science', 'Degree', 'DTP', 'DIT748', 'DTP-qn1.pdf', 'DTP-ans1.pdf'),
(4, 'Electrical & Electronic Engineering', 'Phd', 'Analogue Electronics', 'PHBF47', 'Analogue Electronics-qn2.pdf', 'Analogue Electronics-ans2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_reg_no` varchar(50) NOT NULL,
  `payment_type` text NOT NULL,
  `payment_mode` text NOT NULL,
  `date_payed` varchar(50) NOT NULL,
  `time_payed` varchar(50) NOT NULL,
  `valid_untill` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_reg_no`, `payment_type`, `payment_mode`, `date_payed`, `time_payed`, `valid_untill`, `amount`) VALUES
(2, 'scrrtre', '3 months', 'mpesa', '04/28/2018', '11:33am', '07/27/2018', '499.00'),
(3, 'scto21-c004-9872/2018', '1 month', 'mpesa', '04/28/2018', '12:40pm', '05/27/2018', '199.00'),
(4, 'sct021-c004-0945-2017', '3 months', 'mpesa', '05/04/2018', '09:23am', '08/03/2018', '499.00');

-- --------------------------------------------------------

--
-- Table structure for table `payments_report`
--

CREATE TABLE `payments_report` (
  `id` int(11) NOT NULL,
  `user_reg_no` varchar(50) NOT NULL,
  `payment_type` text NOT NULL,
  `payment_mode` text NOT NULL,
  `date_payed` varchar(50) NOT NULL,
  `time_payed` varchar(50) NOT NULL,
  `valid_untill` varchar(50) NOT NULL,
  `amount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments_report`
--

INSERT INTO `payments_report` (`id`, `user_reg_no`, `payment_type`, `payment_mode`, `date_payed`, `time_payed`, `valid_untill`, `amount`) VALUES
(5, 'scrrtre', '3 months', 'mpesa', '04/28/2018', '10:45am', '01/31/1970', '499.00'),
(6, 'scrrtre', '1 month', 'mpesa', '04/28/2018', '11:08am', '04/30/2018', '199.00'),
(7, 'scrrtre', '1 month', 'mpesa', '04/28/2018', '11:16am', '', '199.00'),
(8, 'scrrtre', '1 month', 'mpesa', '04/28/2018', '11:17am', '2018-05-27', '199.00'),
(9, 'scrrtre', '3 months', 'mpesa', '04/28/2018', '11:30am', '10/27/2018', '799.00'),
(10, 'scrrtre', '1 month', 'mpesa', '04/28/2018', '11:32am', '05/27/2018', '199.00'),
(11, 'scrrtre', '3 months', 'mpesa', '04/28/2018', '11:32am', '10/27/2018', '799.00'),
(12, 'scrrtre', '3 months', 'mpesa', '04/28/2018', '11:33am', '07/27/2018', '499.00'),
(13, 'scto21-c004-9872/2018', '1 month', 'mpesa', '04/28/2018', '12:38pm', '05/27/2018', '199.00'),
(14, 'scto21-c004-9872/2018', '1 month', 'mpesa', '04/28/2018', '12:40pm', '05/27/2018', '199.00'),
(15, 'sct021-c004-0945-2017', '3 months', 'mpesa', '05/04/2018', '09:23am', '08/03/2018', '499.00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `reg_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `reg_no`) VALUES
(1, 'John timbe', 'e10adc3949ba59abbe56e057f20f883e', 'scrrtre'),
(2, 'Nebster Malash', 'e10adc3949ba59abbe56e057f20f883e', 'scto21-c004-9872/2018'),
(3, 'Augustine Wafula', 'e10adc3949ba59abbe56e057f20f883e', 'sct021-c004-0945-2017'),
(4, 'Lydia Achieng', 'e10adc3949ba59abbe56e057f20f883e', 'scto21-c004-9345/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intelligent_questions`
--
ALTER TABLE `intelligent_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastpapers`
--
ALTER TABLE `pastpapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments_report`
--
ALTER TABLE `payments_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `intelligent_questions`
--
ALTER TABLE `intelligent_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pastpapers`
--
ALTER TABLE `pastpapers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments_report`
--
ALTER TABLE `payments_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
