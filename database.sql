-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2026 at 10:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `relievv`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `email`, `password`) VALUES
(1, 'relievvautomation@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tblblog`
--

CREATE TABLE `tblblog` (
  `id` int(11) NOT NULL,
  `thumbimages` varchar(250) NOT NULL,
  `title` varchar(300) NOT NULL,
  `subtitle` varchar(300) NOT NULL,
  `shortdescription` varchar(400) NOT NULL,
  `innerimages` varchar(250) NOT NULL,
  `fulldescription` varchar(10000) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `encrytiduniq` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblblog`
--

INSERT INTO `tblblog` (`id`, `thumbimages`, `title`, `subtitle`, `shortdescription`, `innerimages`, `fulldescription`, `created_at`, `encrytiduniq`) VALUES
(5, 't_69c0fa771277e9.18090735.jpeg', 'The Future of Finance ', 'The Future of Finance Work: Why Automation is No Longer Optional', 'Tools like Excel and traditional accounting software have helped streamline financial workflows, they still require extensive manual effort for tasks like data formatting, data extraction, reconciliation, and reporting.', 'i_69c0fa7712e549.68673660.jpeg', '<p>Hi Test the Full <strong>Description&nbsp;</strong></p>', '2026-03-24 05:17:24.665415', '29f99811c094e71a7372002e0085e9fd'),
(11, 't_69c10f4cd5b769.90889072.png', 'title three', 'subtitle four', 'test four dummpy description ', 'i_69c10f4cd61ae3.97574427.png', '<p>test full description dummy. <strong>Rest Rahul write blog 🙂 ….</strong></p>', '2026-03-23 10:00:44.000000', '7d8c43b77dd95da8cba060e9a9a4e87b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblblog`
--
ALTER TABLE `tblblog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblblog`
--
ALTER TABLE `tblblog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
