-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 06, 2022 at 09:34 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HRMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `id` int(4) NOT NULL,
  `Employee_number` int(4) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `job_title` varchar(10) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`id`, `Employee_number`, `first_name`, `last_name`, `job_title`, `password`) VALUES
(100, 100, 'Leen', 'Alluhaidan', 'Developer', '$2y$10$jmcLwWtwABmFKkX48E9fE.xbc18IqvXEtwuzSP70esV.gt.nksjAq'),
(101, 101, 'Rana', 'Alhababi', 'analyst', '$2y$10$ZNbb0idh.wbLO6KXVf1q9.FCrm3wfXMlppiQmW5Vo1DIOvOTaOO9m'),
(102, 102, 'Rahaf', 'bahlas', 'Designer', '$2y$10$bwL14IjtHREbdR0zuwf0tOzJ73RgWV5tvPBnPL1NjyC0U7Ih8aQBC'),
(103, 103, 'tamer', 'ali', 'geo', '$2y$10$iwGZhBn2ETUMDhfwlUqRo.4ugJwKuxhxp.fd5RMyIWfK.9k7t.RSm'),
(104, 104, 'sara', 'rami', 'finding', '$2y$10$3efwfA8u77DxVl1gDvABie0jPl6RkpVmqtLWvhlHBIDWZWuLRO/r2'),
(105, 105, 'nail', 'walid', 'hinting', '$2y$10$gowBSji.wc0CAd2fsgTZ6.Ut8P/Y43n2dFoXfst1LdrEWVR.TOEQ6'),
(106, 106, 'bilal', 'hatem', 'writter', '$2y$10$LPXmlMrflk2G3vik1bgePuaw2qIfOF0NeZlVC03XJ3kXJw9RxGjGC');

-- --------------------------------------------------------

--
-- Table structure for table `Manager`
--

CREATE TABLE `Manager` (
  `id` int(4) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `username` varchar(8) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Manager`
--

INSERT INTO `Manager` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(104, 'hajar', 'Alomar', 'Hajar', '$2y$10$jmcLwWtwABmFKkX48E9fE.xbc18IqvXEtwuzSP70esV.gt.nksjAq');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(4) NOT NULL,
  `emp_id` int(4) NOT NULL,
  `service_id` int(4) NOT NULL,
  `description` text NOT NULL,
  `attachment1` varchar(128) NOT NULL,
  `attachment2` varchar(128) NOT NULL,
  `status` varchar(14) NOT NULL DEFAULT 'in_progress'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `emp_id`, `service_id`, `description`, `attachment1`, `attachment2`, `status`) VALUES
(1, 100, 1, 'I want to prom', 'uploads/promotion.jpeg', 'uploads/promotion.pdf', 'in_progress'),
(2, 101, 2, 'I want to leave', 'uploads/sickLeave.jpeg', 'uploads/leavefile.pdf', 'Approve'),
(3, 102, 3, 'I want an allowance', 'uploads/allowance.png', 'uploads/allowance.pdf', 'Decline'),
(4, 100, 1, 'I want a promotion', 'uploads/Promotion.jpeg', 'uploads/promotion.pdf', 'Approve');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(4) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `type`) VALUES
(1, 'promotion'),
(2, 'leave'),
(3, 'Allowance'),
(4, 'health insurance'),
(5, 'resignation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
