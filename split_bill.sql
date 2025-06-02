-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 10:25 AM
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
-- Database: `split_bill`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_destination`
--

CREATE TABLE `t_destination` (
  `id` int(11) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_datetime` datetime NOT NULL,
  `c_trip` varchar(100) DEFAULT NULL,
  `c_payer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_destination`
--

INSERT INTO `t_destination` (`id`, `c_user`, `c_name`, `c_datetime`, `c_trip`, `c_payer`) VALUES
(7, 1, 'Painting', '2025-06-02 14:26:08', '1_6836890ba3cbe6.47041181', 14);

-- --------------------------------------------------------

--
-- Table structure for table `t_member`
--

CREATE TABLE `t_member` (
  `id` int(11) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_trip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_member`
--

INSERT INTO `t_member` (`id`, `c_user`, `c_name`, `c_trip`) VALUES
(1, 1, 'adzka', '1_683688441ff138.51649167'),
(2, 1, 'alfi', '1_683688441ff138.51649167'),
(3, 1, 'fahmi', '1_6836890ba3cbe6.47041181'),
(13, 1, 'adzka', '1_6836890ba3cbe6.47041181'),
(14, 1, 'alfi', '1_6836890ba3cbe6.47041181'),
(15, 1, 'zaha', '1_6836890ba3cbe6.47041181');

-- --------------------------------------------------------

--
-- Table structure for table `t_owner`
--

CREATE TABLE `t_owner` (
  `id` int(11) NOT NULL,
  `c_transaction` varchar(100) NOT NULL,
  `c_owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_owner`
--

INSERT INTO `t_owner` (`id`, `c_transaction`, `c_owner`) VALUES
(26, '7_item_683d52306204a5.45767810', 13),
(27, '7_item_683d52306204a5.45767810', 15),
(28, '7_item_683d56823f23e4.52815659', 3),
(29, '7_item_683d56823f23e4.52815659', 13),
(30, '7_item_683d56823f23e4.52815659', 14),
(31, '7_item_683d56823f23e4.52815659', 15);

-- --------------------------------------------------------

--
-- Table structure for table `t_transaction`
--

CREATE TABLE `t_transaction` (
  `id` varchar(100) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_trip` varchar(100) NOT NULL,
  `c_detail` varchar(250) NOT NULL,
  `c_price` int(50) NOT NULL,
  `c_destination` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_transaction`
--

INSERT INTO `t_transaction` (`id`, `c_user`, `c_trip`, `c_detail`, `c_price`, `c_destination`) VALUES
('7_item_683d52306204a5.45767810', 1, '1_6836890ba3cbe6.47041181', 'Jam', 45000, 7),
('7_item_683d56823f23e4.52815659', 1, '1_6836890ba3cbe6.47041181', 'Kayu', 30000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `t_trip`
--

CREATE TABLE `t_trip` (
  `id` varchar(100) NOT NULL,
  `c_user` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_trip`
--

INSERT INTO `t_trip` (`id`, `c_user`, `c_name`, `c_datetime`) VALUES
('1_683688441ff138.51649167', 1, 'blok m', '2025-05-28 10:52:51'),
('1_6836890ba3cbe6.47041181', 1, 'seasoning', '2025-05-28 10:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `c_name` varchar(250) NOT NULL,
  `c_password` varchar(100) NOT NULL,
  `c_register` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `c_name`, `c_password`, `c_register`) VALUES
(1, 'adzka', 'adzka', '2025-05-27 11:36:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_destination`
--
ALTER TABLE `t_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_member`
--
ALTER TABLE `t_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_owner`
--
ALTER TABLE `t_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_transaction`
--
ALTER TABLE `t_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_trip`
--
ALTER TABLE `t_trip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_destination`
--
ALTER TABLE `t_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_member`
--
ALTER TABLE `t_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_owner`
--
ALTER TABLE `t_owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
