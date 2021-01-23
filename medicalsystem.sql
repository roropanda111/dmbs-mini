-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 10:14 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicalsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` varchar(400) DEFAULT NULL,
  `sid` varchar(400) DEFAULT NULL,
  `cid` varchar(400) DEFAULT NULL,
  `pid` varchar(400) DEFAULT NULL,
  `pname` varchar(400) DEFAULT NULL,
  `quantity` varchar(400) DEFAULT NULL,
  `cost` varchar(400) DEFAULT NULL,
  `total` varchar(400) DEFAULT NULL,
  `zip` varchar(400) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `sid`, `cid`, `pid`, `pname`, `quantity`, `cost`, `total`, `zip`, `date`) VALUES
('3', 's001', 'c001', '3021', 'cipla', '30', '10', '300', '560050', '05/29/2018'),
('4', 's005', 'c002', '307', 'cipla3', '6005', '10', '60050', '560050', '05/30/2018'),
('5', NULL, 'c003', NULL, 'Meloxicam ', '3', '0', '0', '560041', NULL),
('6', NULL, 'c003', NULL, 'katakoda', '2', '0', '0', '560042', NULL),
('7', NULL, 'c003', NULL, 'paracitamal', '1', '0', '0', '560043', NULL),
('8', NULL, 'c003', NULL, 'Olbas ', '2', '0', '0', '560044', NULL),
('9', NULL, 'c003', NULL, 'Bonelay ', '10', '0', '0', '560045', NULL),
('10', 's001', 'c003', '306', 'favour', '5', '10', '50', '560046', '05/30/2018'),
('11', 's005', 'c003', '301', 'Meloxicam ', '10', '10', '100', '560041', '05/30/2018'),
('12', NULL, 'c003', NULL, 'katakoda', '2', '0', '0', '560042', NULL),
('13', NULL, 'c003', NULL, 'paracitamal', '3', '0', '0', '560043', NULL),
('14', 's001', 'c003', '304', 'Olbas ', '5', '5', '25', '560044', '05/30/2018'),
('15', 's005', 'c003', '305', 'Bonelay ', '5', '10', '50', '560045', '05/30/2018'),
('16', NULL, 'c003', NULL, 'favour', '100', '0', '0', '560046', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` varchar(100) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `pincode` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `address`, `pincode`) VALUES
('s001', 'Maruthi MedPlus', 'Navaranga-Banglore', '560041'),
('s002', 'Apollo MedPlus', 'Vijayanagar-Banglore', '560042'),
('s003', 'Lakshmi MedPlus', 'Diary Circle-Banglore', '560043'),
('s004', 'Maruthi MedPlus', 'Navaranga-Banglore', '560044'),
('s005', 'Lakshmi MedPlus', 'Vijayanagar-Banglore', '560045'),
('s006', 'Lakshmi MedPlus', 'banglore', '560046'),
('s009', 'santosh malagi', 'banglore', '560040');

-- --------------------------------------------------------

--
-- Table structure for table `shop_status`
--

CREATE TABLE `shop_status` (
  `sid` varchar(10) NOT NULL,
  `order_no` varchar(10) NOT NULL,
  `cid` varchar(11) NOT NULL,
  `pname` varchar(10) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_status`
--

INSERT INTO `shop_status` (`sid`, `order_no`, `cid`, `pname`, `quantity`, `date`) VALUES
('s001', '1 ', 'c001', '', '10', '05/25/2018'),
('s001', '2 ', 'c001', '', '5', '05/25/2018'),
('s001', '3 ', 'c001', '', '30', '05/29/2018'),
('s005', '11 ', 'c003', '', '10', '05/30/2018'),
('s005', '15 ', 'c003', '', '5', '05/30/2018'),
('s005', '4 ', 'c002', '', '6005', '05/30/2018'),
('s001', '14 ', 'c003', '', '5', '05/30/2018'),
('s001', '10 ', 'c003', '', '5', '05/30/2018');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `pid` varchar(10) NOT NULL,
  `sid` varchar(100) DEFAULT NULL,
  `pname` varchar(4000) DEFAULT NULL,
  `ptype` varchar(4000) DEFAULT NULL,
  `mdate` varchar(4000) DEFAULT NULL,
  `edate` varchar(4000) DEFAULT NULL,
  `quantity` varchar(4000) DEFAULT NULL,
  `cost` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`pid`, `sid`, `pname`, `ptype`, `mdate`, `edate`, `quantity`, `cost`) VALUES
('301', 's005', 'Meloxicam ', 'tablet', '05/14/2018', '05/31/2018', '40', '10'),
('302', 's005', 'katakoda', 'injection', '05/15/2018', '05/31/2018', '20', '5'),
('303', 's005', 'paracitamal', 'syrup', '05/15/2018', '05/31/2018', '20', '10'),
('304', 's005', 'Olbas ', 'injection', '05/07/2018', '05/30/2018', '25', '5'),
('305', 's005', 'Bonelay ', 'syrup', '05/10/2018', '05/31/2018', '5', '10'),
('306', 's005', 'favour', 'tablet', '05/17/2018', '05/31/2018', '5', '10'),
('307', 's005', 'cipla3', 'tablet', '05/23/2018', '05/31/2018', '1', '10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(4000) DEFAULT NULL,
  `contact` varchar(400) NOT NULL,
  `mail` varchar(400) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `userid` varchar(400) NOT NULL,
  `password` varchar(400) DEFAULT NULL,
  `role` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `contact`, `mail`, `address`, `userid`, `password`, `role`) VALUES
('c1', '2123131313', 'jsbch@hbhjbds.com', 'banglore', 'c001', 'c001', 'customer'),
('c02', '4659781325', 'gw@k.com', 'navaranga', 'c002', 'c002', 'customer'),
('santosh', '8884550820', 'santosh25794@gmail.com', 'banglore', 'c003', 'c003', 'customer'),
('s1', '5465466466', 'bhhbahv@hd.com', 'banglore', 's001', 's001', 'shopowner'),
('ssss', '5263145278', 'vsh@h.com', 'pesu', 's003', 's003', 'shopowner'),
('s03', '8123855878', 'shsh@gmail.com', 'vijayanagar', 's004', 's004', 'shopowner'),
('santosh', '8884550820', 'santosh25794@gmail.com', 'banglore', 's005', 's005', 'shopowner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD KEY `sid_fk3` (`sid`),
  ADD KEY `cid_fk3` (`cid`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_status`
--
ALTER TABLE `shop_status`
  ADD KEY `sid_fk2` (`sid`),
  ADD KEY `cid_fk2` (`cid`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `sid_fk` (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `cid_fk3` FOREIGN KEY (`cid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sid_fk3` FOREIGN KEY (`sid`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_status`
--
ALTER TABLE `shop_status`
  ADD CONSTRAINT `cid_fk2` FOREIGN KEY (`cid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sid_fk2` FOREIGN KEY (`sid`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `sid_fk` FOREIGN KEY (`sid`) REFERENCES `shop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
