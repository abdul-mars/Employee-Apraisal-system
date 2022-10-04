-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2022 at 09:44 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appraisal`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_list`
--

CREATE TABLE `department_list` (
  `id` int(30) NOT NULL,
  `department` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_list`
--

INSERT INTO `department_list` (`id`, `department`, `description`) VALUES
(1, 'Human Resources (HR)', 'Department in charge of our human resources'),
(2, 'Information Technology (IT)', 'Information Technology is where our it supports are'),
(7, 'R&D', 'Our Research and Development department'),
(8, 'testing 3', 'losdfdskfjlds klsjfdskfdsfk dslfkdsfjdsfdsfdsfdsfdsfdsfffsd'),
(9, 'sdfsdfs', 'sdfdsfdsfdsfds'),
(10, 'department 4', 'stest department 4 dsfdsfs fdsf'),
(11, 'test department', 'testing testing');

-- --------------------------------------------------------

--
-- Table structure for table `designation_list`
--

CREATE TABLE `designation_list` (
  `id` int(30) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designation_list`
--

INSERT INTO `designation_list` (`id`, `designation`, `description`) VALUES
(2, 'TA', 'Assistance that helps lecturers teach students'),
(3, 'Typist', 'Employees that type our documents like handout, letters ect'),
(5, 'Supervisor', 'Supervisor Supervisor Supervisor'),
(6, 'Lecturer', 'Lecturer Lecturer  Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `employee_list`
--

CREATE TABLE `employee_list` (
  `id` int(30) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `department_id` int(30) NOT NULL,
  `designation_id` int(30) NOT NULL,
  `evaluator_id` int(30) NOT NULL,
  `picture` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_list`
--

INSERT INTO `employee_list` (`id`, `employee_id`, `firstname`, `lastname`, `email`, `password`, `token`, `department_id`, `designation_id`, `evaluator_id`, `picture`, `date_created`) VALUES
(1, '', 'update employee ', 'testingsdfd', 'test1@gmail.com', '4297f44b13955235245b2497399d7a93', '', 1, 2, 0, 'images/63223a7560ab7.jpg', '2022-09-09 21:34:50'),
(2, '', 'employee ', 'test 2', 'test2@gmail.com', '', '', 2, 3, 0, NULL, '2022-09-09 21:35:58'),
(4, '', 'test4', 'test', 'test4@gmail.com', '', '', 7, 3, 0, NULL, '2022-09-10 11:01:17'),
(5, '', 'test 5', 'testing', 'asdfdsfds@sdfsd.dfg', '', '', 7, 2, 0, NULL, '2022-09-10 11:01:45'),
(6, '', 'test 6', 'testing', 'test6@gmail.com', '', '', 8, 5, 0, NULL, '2022-09-10 11:04:57'),
(7, '', 'mbo', 'tikuma', 'tikuma@gmail.com', '', '', 2, 2, 0, NULL, '2022-09-13 13:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `evaluator_list`
--

CREATE TABLE `evaluator_list` (
  `id` int(30) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `picture` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluator_list`
--

INSERT INTO `evaluator_list` (`id`, `employee_id`, `firstname`, `lastname`, `email`, `password`, `token`, `picture`, `date_created`) VALUES
(1, '', 'testing one', 'adding evaluator update', 'test1@gmail.com', '4297f44b13955235245b2497399d7a93', '', 'images/63222cc49ed7f.png', '2022-09-10 06:04:29'),
(2, '', 'another ', 'testing', 'test2@gmail.com', '02c75fb22c75b23dc963c7eb91a062cc', '', 'images/631cd339a1059.jpg', '2022-09-10 06:05:06'),
(3, '', 'testing 3', 'evaluator', 'test3@gmail.com', '', 'Wd12JmIv', NULL, '2022-09-10 06:05:39'),
(5, '', 'Abdul-Rashid', 'Mustapha', 'abdulmars1102@gmail.com', '4297f44b13955235245b2497399d7a93', '', 'images/6321f8cf0d2c5.jpg', '2022-09-14 15:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(15) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forget_password`
--

INSERT INTO `forget_password` (`id`, `email`, `code`, `date`) VALUES
(1, 'test1@gmail.com', '580788', '2022-09-12'),
(2, 'abdulmars1102@gmail.com', '173182', '2022-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(30) NOT NULL,
  `employee_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `evaluator_id` int(30) NOT NULL,
  `efficiency` int(11) NOT NULL,
  `timeliness` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `employee_id`, `task_id`, `evaluator_id`, `efficiency`, `timeliness`, `quality`, `accuracy`, `remarks`, `date_created`) VALUES
(1, 1, 3, 2, 5, 3, 4, 3, 'test remark', '2022-09-09 11:55:12'),
(2, 2, 4, 2, 0, 1, 3, 2, 'test remark two', '2022-09-09 12:18:19'),
(3, 2, 4, 3, 3, 4, 1, 3, 'test remark two', '2022-09-09 12:19:15'),
(4, 2, 4, 1, 5, 5, 5, 5, 'testing updating', '2022-09-09 12:19:50'),
(5, 1, 1, 2, 1, 4, 2, 4, 'dgdfgfdgdsf', '2022-09-09 12:20:25'),
(7, 1, 5, 3, 3, 5, 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur inventore ad, illo?', '2022-09-10 16:55:53'),
(8, 1, 5, 1, 3, 5, 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur inventore ad, illo?', '2022-09-10 16:55:58'),
(9, 1, 5, 3, 3, 5, 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur inventore ad, illo?', '2022-09-10 16:56:28'),
(10, 1, 4, 1, 5, 5, 5, 5, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum qui blanditiis dolore voluptate iusto explicabo sapiente ullam corporis doloribus eveniet!', '2022-09-10 16:59:56'),
(16, 2, 2, 2, 2, 3, 0, 4, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum qui blanditiis dolore voluptate iusto explicabo sapiente ullam corporis doloribus eveniet!Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum qui blanditiis dolore voluptate iusto explicabo sapiente ullam corporis doloribus eveniet!', '2022-09-10 17:01:58'),
(17, 2, 2, 1, 3, 4, 4, 3, 'nsectetur adipisicing elit. Cum qLorem ipsum dolor sit amet coui blanditiis dolore voluptate iusto explicabo sapiente ullam corporis doloribus eveniet!', '2022-09-10 17:47:01'),
(18, 1, 4, 1, 1, 0, 2, 1, 'very good well donegdfgdgfdgdfgdfg', '2022-09-13 13:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `employee_id` int(30) NOT NULL,
  `due_date` date NOT NULL,
  `completed` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=on-progress,2=Completed',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `task`, `description`, `employee_id`, `due_date`, `completed`, `status`, `date_created`) VALUES
(1, 'task 1', 'testing adding task ', 1, '2022-09-05', '0000-00-00', 1, '2022-09-10 07:48:35'),
(2, 'task task update', 'testing update task 1 update asdfds fdf', 2, '2022-09-20', '0000-00-00', 1, '2022-09-10 07:49:00'),
(3, 'exam papers', 'Printing of exam papers for end of sem', 4, '2022-10-04', '0000-00-00', 1, '2022-09-10 07:49:38'),
(4, 'testing 5', 'dsfdsfdsfdsfdsfdsf', 1, '2022-10-08', '0000-00-00', 2, '2022-09-10 11:05:30'),
(5, 'dsfdsfds', 'dsfdsfdsfdsfd', 6, '2022-09-28', '0000-00-00', 1, '2022-09-10 11:00:38'),
(8, 'mbo testing', 'lfdifosdjdskfndfhdsifodjfldskfjdsfdsfdsfd', 4, '2022-10-08', '0000-00-00', 0, '2022-09-13 13:29:13'),
(9, 'ghghgffh', 'dgdfgdgdfgdf', 7, '2022-09-30', '0000-00-00', 0, '2022-09-13 13:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `task_progress`
--

CREATE TABLE `task_progress` (
  `id` int(11) NOT NULL,
  `task_id` int(30) NOT NULL,
  `progress` text NOT NULL,
  `is_complete` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=no,1=Yes',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department_list`
--
ALTER TABLE `department_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation_list`
--
ALTER TABLE `designation_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluator_list`
--
ALTER TABLE `evaluator_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_progress`
--
ALTER TABLE `task_progress`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department_list`
--
ALTER TABLE `department_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `designation_list`
--
ALTER TABLE `designation_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `evaluator_list`
--
ALTER TABLE `evaluator_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `task_progress`
--
ALTER TABLE `task_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
