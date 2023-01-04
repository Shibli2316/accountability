-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2023 at 03:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountability`
--

-- --------------------------------------------------------

--
-- Table structure for table `monthly`
--

CREATE TABLE `monthly` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `reso` text NOT NULL,
  `completeBy` date NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthly`
--

INSERT INTO `monthly` (`id`, `username`, `reso`, `completeBy`, `time`) VALUES
(1, '', 'qwertyqw', '2023-01-17', '2023-01-02 13:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `pdg`
--

CREATE TABLE `pdg` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `goal` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pdg`
--

INSERT INTO `pdg` (`id`, `username`, `title`, `goal`, `created`) VALUES
(3, '', '', '', '2023-01-02 19:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `reso`
--

CREATE TABLE `reso` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `reso` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'shibli', '123'),
(2, 'talha', 'iamnotgay'),
(3, 'sarim', 'qwerty123.'),
(4, 'hamza', 'badass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monthly`
--
ALTER TABLE `monthly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdg`
--
ALTER TABLE `pdg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reso`
--
ALTER TABLE `reso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monthly`
--
ALTER TABLE `monthly`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pdg`
--
ALTER TABLE `pdg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reso`
--
ALTER TABLE `reso`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reso`
--
ALTER TABLE `reso`
  ADD CONSTRAINT `FKey` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
