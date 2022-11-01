-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 05:35 PM
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
-- Database: `vhdl`
--

-- --------------------------------------------------------

--
-- Table structure for table `vhdl_codes_forum`
--

CREATE TABLE `vhdl_codes_forum` (
  `topic` int(10) NOT NULL,
  `question` varchar(150) NOT NULL,
  `code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vhdl_codes_forum`
--

INSERT INTO `vhdl_codes_forum` (`topic`, `question`, `code`) VALUES
(1, 'VHDL program for implementing the following POS expression using data flow modelling: (~a v~ b) ^ (~a v c) ^ (b v c)', '<p>library IEEE;</p>\r\n<p>use IEEE.STD_LOGIC_1164.ALL;</p>\r\n<p>entity product_of_sum6 is</p>\r\n<p>Port</p>\r\n<p>(A : in STD_LOGIC;</p>\r\n<p>B : in STD_LOGIC;</p>\r\n<p>C : in STD_LOGIC;</p>\r\n<p>F : out STD_LOGIC);</p>\r\n<p>end product_of_sum6;</p>\r\n<p>architecture gate_level of product_of_sum6 is</p>\r\n<p>begin</p>\r\n<p>F <= (((NOT A)OR(NOT B))AND((NOT A)OR C)AND(B OR C));</p>\r\n<p>end gate_level;</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vhdl_codes_forum`
--
ALTER TABLE `vhdl_codes_forum`
  ADD PRIMARY KEY (`topic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vhdl_codes_forum`
--
ALTER TABLE `vhdl_codes_forum`
  MODIFY `topic` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
