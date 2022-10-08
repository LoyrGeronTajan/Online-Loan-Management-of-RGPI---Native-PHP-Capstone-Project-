-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 07:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rgpi`
--

-- --------------------------------------------------------

--
-- Table structure for table `addnewproduct`
--

CREATE TABLE `addnewproduct` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productImage` longblob NOT NULL,
  `productPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addnewproduct`
--

INSERT INTO `addnewproduct` (`id`, `category`, `productName`, `productImage`, `productPrice`) VALUES
(1, 9, 'Safefuard Active Fresh 14g', 0x616374697665206672657368203134672e6a7067, 20),
(3, 9, 'Cool Waterlili 3.8oz', 0x636f6f6c2077617465726c696c7920332e38206f7a2e6a706567, 250),
(4, 2, 'Tide Liquids Brilliant Whites 1kg Bottle BOGO25%', 0x74696465206c697175696420627720314b672e6a7067, 294),
(5, 6, 'Herbal Essence Argan Oil 240ml', 0x617267616e206f696c203234306d6c2e6a7067, 300),
(7, 6, 'Bodywash Clean 300 Ml', 0x6372656d6520626f64797761736820636c65616e73696e6720616e6420627269676874656e696e67203330306d6c2e6a7067, 300),
(8, 4, 'Vitamin C 90g', 0x7769746820766974616d696e20432033706964203930672e6a7067, 120),
(9, 9, 'Expressions Clear Gel Summer Berry 2.6oz', 0x73756d6d657220626572727920322e36206f7a2e6a7067, 17),
(10, 9, 'Detox Foaming Bodywash Pomegranate -Bottle', 0x706f6d656772616e617465203530306d6c2e6a7067, 449),
(11, 6, 'Shampoo Anti Hairfall For Men', 0x616e7469206861697266616c6c20666f72206d656e203331356d6c2e6a7067, 269),
(12, 2, 'Ariel Base Sunrise Fresh 680g ', 0x73756e7269736520667265736820363830672e6a7067, 90),
(13, 2, 'Downy Fabric Refresher AB+ Original Scent.', 0x446f776e7920466162726963205265667265736865722041422b204f726967696e616c205363656e742e6a7067, 234);

-- --------------------------------------------------------

--
-- Table structure for table `brandname`
--

CREATE TABLE `brandname` (
  `id` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brandname`
--

INSERT INTO `brandname` (`id`, `brandname`, `create_date`) VALUES
(1, 'BABY CARE', '2022-02-16 12:16:03'),
(2, 'FABRIC CARE', '2022-02-16 12:16:03'),
(3, 'FAMILY CARE', '2022-02-16 12:16:03'),
(4, 'FEMININE CARE', '2022-02-16 12:16:03'),
(5, 'GROOMING', '2022-02-16 12:16:03'),
(6, 'HARI CARE', '2022-02-16 12:16:03'),
(7, 'HOME CARE', '2022-02-16 12:16:03'),
(8, 'ORAL CARE', '2022-02-16 12:16:03'),
(9, 'PERSONAL HEALTH CARE', '2022-02-16 12:16:03'),
(10, 'SKIN AND PERSONAL CARE', '2022-02-16 12:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `cartorder`
--

CREATE TABLE `cartorder` (
  `id` int(11) NOT NULL,
  `invoiceNo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` tinyint(11) DEFAULT 1,
  `archive` varchar(255) DEFAULT 'NO',
  `order_productname` varchar(255) NOT NULL,
  `order_productqty` varchar(255) NOT NULL,
  `vat` int(11) DEFAULT 12,
  `order_productprice` varchar(255) NOT NULL,
  `productTotal` float NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cartorder`
--

INSERT INTO `cartorder` (`id`, `invoiceNo`, `username`, `status`, `archive`, `order_productname`, `order_productqty`, `vat`, `order_productprice`, `productTotal`, `create_date`) VALUES
(168, 'RGPI-0000002', 'customer1', 2, 'NO', 'Ariel Base Sunrise Fresh 680g ', '1', 12, '90', 90, '2022-10-09'),
(170, 'RGPI-0000002', 'customer1', 2, 'NO', 'Bodywash Clean 300 Ml', '1', 12, '300', 300, '2022-10-09'),
(171, 'RGPI-0000002', 'customer1', 2, 'NO', 'Expressions Clear Gel Summer Berry 2.6oz', '1', 12, '17', 17, '2022-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceId` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'notpaid',
  `dateAssigned` date DEFAULT NULL,
  `archive` varchar(255) DEFAULT 'NO',
  `datePaid` date NOT NULL,
  `kaeName` varchar(255) NOT NULL,
  `invoiceNo` varchar(255) NOT NULL,
  `invoiceUsername` varchar(255) NOT NULL,
  `invoiceCompany` varchar(255) NOT NULL,
  `dateDelivered` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceId`, `status`, `dateAssigned`, `archive`, `datePaid`, `kaeName`, `invoiceNo`, `invoiceUsername`, `invoiceCompany`, `dateDelivered`, `dueDate`, `create_at`) VALUES
(37, 'paid', '2022-03-08', 'YES', '2022-03-08', 'KAE-one', 'RGPI-0000001', 'company1', 'CompanyOne', '2022-03-06', '2022-03-07', '2022-03-09 02:19:36'),
(47, 'paid', '2022-10-08', 'NO', '2022-10-08', 'kae-sample', 'RGPI-0000002', 'customer1', 'sample company', '2022-10-02', '2022-10-03', '2022-10-08 17:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `rgpicodes`
--

CREATE TABLE `rgpicodes` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL,
  `expire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '!approve',
  `requestCreditlimit` varchar(255) NOT NULL,
  `creditLimit` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permit` blob NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `status`, `requestCreditlimit`, `creditLimit`, `fullname`, `company`, `address`, `phone`, `username`, `password`, `email`, `permit`, `create_at`) VALUES
(51, 'approve', '', 10000, 'sample fullname', 'sample company', 'sample address', '0000-000-0000', 'customer1', '$2y$10$r0DrtSGIChWClAYU.zz3..3LS7aLg.Wj5dHegqLTgD/sB0USJbOJ6', 'sampleemail@gmail.com', 0x3330393636353035345f3737343132393036373331353030345f343637393435323832343739313839343833365f6e2e6a7067, '2022-10-08 17:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newcommer`
--

CREATE TABLE `tbl_newcommer` (
  `newcommer_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `newcommer_email` varchar(255) NOT NULL,
  `newcommer_company` varchar(255) NOT NULL,
  `newcommer_businessPermit` longblob NOT NULL,
  `newcommer_address` varchar(255) NOT NULL,
  `newcommer_contact` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newcommer`
--

INSERT INTO `tbl_newcommer` (`newcommer_id`, `status`, `newcommer_email`, `newcommer_company`, `newcommer_businessPermit`, `newcommer_address`, `newcommer_contact`, `create_at`) VALUES
(16, 'pending', 'sampleemail@gmail.com', 'sample company', 0x3330393636353035345f3737343132393036373331353030345f343637393435323832343739313839343833365f6e2e6a7067, 'sample address', '0000-000-0000', '2022-10-08 17:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userImage` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `role`, `username`, `password`, `name`, `email`, `userImage`) VALUES
(12, 'admin', 'Adminloyr', '25f9e794323b453885f5181f1b624d0b', 'Loyr', 'lndnmng@gmail.com', 0x312e706e67),
(20, 'user', 'kae-sample', '25d55ad283aa400af464c76d713c07ad', 'Sample KAE', 'kae@gmail.com', 0x6b6165342e706e67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addnewproduct`
--
ALTER TABLE `addnewproduct`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brandname`
--
ALTER TABLE `brandname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartorder`
--
ALTER TABLE `cartorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceId`);

--
-- Indexes for table `rgpicodes`
--
ALTER TABLE `rgpicodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code` (`code`),
  ADD KEY `expire` (`expire`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newcommer`
--
ALTER TABLE `tbl_newcommer`
  ADD PRIMARY KEY (`newcommer_id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addnewproduct`
--
ALTER TABLE `addnewproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `brandname`
--
ALTER TABLE `brandname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cartorder`
--
ALTER TABLE `cartorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `rgpicodes`
--
ALTER TABLE `rgpicodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_newcommer`
--
ALTER TABLE `tbl_newcommer`
  MODIFY `newcommer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
