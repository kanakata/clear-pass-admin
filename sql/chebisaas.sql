-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2026 at 01:07 PM
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
-- Database: `chebisaas`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(50) NOT NULL,
  `admission number` varchar(255) NOT NULL,
  `index number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `school name` varchar(255) NOT NULL,
  `report day` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(200) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `admission number`, `index number`, `username`, `school name`, `report day`, `password`, `usertype`) VALUES
(4, '2', '2', 'terrence kibet ', 'chebisaas', '', '$2y$10$R9XP2Rjjsbq.tLhYTaJR9ucpDZK.RDmYhmkhUHqMaCa0c9EG2hTBe', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `login register`
--

CREATE TABLE `login register` (
  `admission number` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `index number` varchar(200) NOT NULL,
  `date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `nitification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student data`
--

CREATE TABLE `student data` (
  `id` int(50) NOT NULL,
  `admission number` varchar(255) NOT NULL,
  `index number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `finance debt` varchar(255) NOT NULL,
  `finance value` varchar(255) NOT NULL,
  `finance status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `library debt` varchar(255) NOT NULL,
  `library value` varchar(255) NOT NULL,
  `library status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `boarding debt` varchar(255) NOT NULL,
  `boarding value` varchar(255) NOT NULL,
  `boarding status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `laboratory debt` varchar(255) NOT NULL,
  `laboratory value` varchar(255) NOT NULL,
  `laboratory status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `logistics debt` varchar(255) NOT NULL,
  `logistics value` varchar(255) NOT NULL,
  `logistics status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `games debt` varchar(255) NOT NULL,
  `games value` varchar(255) NOT NULL,
  `games status` varchar(255) NOT NULL DEFAULT 'uncleared',
  `library availability` varchar(255) NOT NULL DEFAULT 'abc bookshop',
  `boarding availability` varchar(255) NOT NULL DEFAULT 'abc woodshop',
  `logistics availability` varchar(255) NOT NULL DEFAULT 'abc school depo',
  `games availability` varchar(255) NOT NULL DEFAULT 'abc sports house',
  `laboratory availability` varchar(255) NOT NULL DEFAULT 'abc laboratory dealers',
  `clearance status` varchar(255) NOT NULL DEFAULT 'uncleared'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student data`
--

INSERT INTO `student data` (`id`, `admission number`, `index number`, `username`, `finance debt`, `finance value`, `finance status`, `library debt`, `library value`, `library status`, `boarding debt`, `boarding value`, `boarding status`, `laboratory debt`, `laboratory value`, `laboratory status`, `logistics debt`, `logistics value`, `logistics status`, `games debt`, `games value`, `games status`, `library availability`, `boarding availability`, `logistics availability`, `games availability`, `laboratory availability`, `clearance status`) VALUES
(2, '2', '2', 'terrence kibet', 'none', '0', 'uncleared', 'none', '0', 'uncleared', 'none', '0', 'uncleared', 'none', '0', 'uncleared', 'none', '0', 'uncleared', 'none', '200', 'uncleared', 'abc bookshop', 'abc woodshop', 'abc school depo', 'abc sports house', 'abc laboratory dealers', 'uncleared');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login register`
--
ALTER TABLE `login register`
  ADD KEY `admission` (`admission number`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD UNIQUE KEY `nitification` (`nitification`);

--
-- Indexes for table `student data`
--
ALTER TABLE `student data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student data`
--
ALTER TABLE `student data`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;