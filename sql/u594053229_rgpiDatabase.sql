-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2022 at 06:02 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u594053229_rgpiDatabase`
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
(2, 1, 'Baby Care', 0x6c61726765203330732e6a7067, 325),
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
(134, 'RGPI-0000001', 'company1', 2, 'YES', 'Baby Care', '2', 12, '325', 650, '2022-03-08'),
(135, 'RGPI-0000001', 'company1', 2, 'YES', 'Cool Waterlili 3.8oz', '2', 12, '250', 500, '2022-03-08'),
(136, 'RGPI-0000001', 'company1', 2, 'YES', 'Detox Foaming Bodywash Pomegranate -Bottle', '2', 12, '449', 898, '2022-03-08'),
(137, 'RGPI-0000001', 'company1', 2, 'YES', 'Herbal Essence Argan Oil 240ml', '2', 12, '300', 600, '2022-03-08'),
(138, 'RGPI-0000001', 'company1', 2, 'YES', 'Expressions Clear Gel Summer Berry 2.6oz', '2', 12, '17', 34, '2022-03-08'),
(139, 'RGPI-0000001', 'company1', 2, 'YES', 'Herbal Essence Argan Oil 240ml', '2', 12, '300', 600, '2022-03-08'),
(140, 'RGPI-0000001', 'company1', 2, 'YES', 'Tide Liquids Brilliant Whites 1kg Bottle BOGO25%', '2', 12, '294', 588, '2022-03-08'),
(141, 'RGPI-0000001', 'company1', 2, 'YES', 'Shampoo Anti Hairfall For Men', '2', 12, '269', 538, '2022-03-08'),
(142, 'RGPI-0000002', 'company1', 2, 'YES', 'Ariel Base Sunrise Fresh 680g ', '1', 12, '90', 90, '2022-03-08'),
(143, 'RGPI-0000002', 'company1', 2, 'YES', 'Baby Care', '1', 12, '325', 325, '2022-03-08'),
(144, 'RGPI-0000003', 'company3', 2, 'YES', 'Baby Care', '6', 12, '325', 1950, '2022-03-09'),
(145, 'RGPI-0000003', 'company3', 2, 'YES', 'Baby Care', '1', 12, '325', 325, '2022-03-09'),
(146, 'RGPI-0000003', 'company3', 2, 'YES', 'Bodywash Clean 300 Ml', '1', 12, '300', 300, '2022-03-09'),
(147, 'RGPI-0000003', 'company3', 2, 'YES', 'Baby Care', '1', 12, '325', 325, '2022-03-09'),
(148, 'RGPI-0000003', 'company3', 2, 'YES', 'Detox Foaming Bodywash Pomegranate -Bottle', '1', 12, '449', 449, '2022-03-09'),
(149, 'RGPI-0000003', 'company3', 2, 'YES', 'Safefuard Active Fresh 14g', '1', 12, '20', 20, '2022-03-09'),
(150, 'RGPI-0000003', 'company3', 2, 'YES', 'Downy Fabric Refresher AB+ Original Scent.', '1', 12, '234', 234, '2022-03-09'),
(152, 'RGPI-0000004', 'company4', 2, 'NO', 'Baby Care', '5', 12, '325', 1625, '2022-03-09'),
(153, 'RGPI-0000004', 'company4', 2, 'NO', 'Detox Foaming Bodywash Pomegranate -Bottle', '1', 12, '449', 449, '2022-03-09'),
(154, 'RGPI-0000004', 'company4', 2, 'NO', 'Detox Foaming Bodywash Pomegranate -Bottle', '1', 12, '449', 449, '2022-03-09'),
(155, 'RGPI-0000004', 'company4', 2, 'NO', 'Bodywash Clean 300 Ml', '1', 12, '300', 300, '2022-03-09');

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
(38, 'notpaid', '2022-03-08', 'YES', '0000-00-00', 'KAE-two', 'RGPI-0000002', 'company1', 'CompanyOne', '2022-03-06', '2022-03-08', '2022-03-09 02:19:36'),
(39, 'paid', '2022-03-09', 'YES', '2022-03-09', 'KAE-one', 'RGPI-0000003', 'company3', 'Lyndon Supermarket', '2022-03-06', '2022-03-08', '2022-03-09 02:19:36'),
(40, 'paid', '2022-03-09', 'NO', '2022-03-09', 'KAE-two', 'RGPI-0000004', 'company4', 'Company4 supermarket', '2022-03-10', '2022-03-17', '2022-03-09 03:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `rgpiCodes`
--

CREATE TABLE `rgpiCodes` (
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
  `creditLimit` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `creditLimit`, `fullname`, `company`, `address`, `phone`, `username`, `password`, `email`, `create_at`) VALUES
(41, 10000, 'Customer-one', 'CompanyOne', 'Brgy. Halang', '0000-000-0000', 'company1', '$2y$10$AbzPZe9vHvxURYB9n1NPKO2jJ3QB9hpoWe9HcJkrSG2b.PxWPjxK6', 'company1@gmail.com', '2022-03-07 05:19:06'),
(42, 20000, 'company2', 'company2 Market', 'Real, Calamba City', '0912-234-4566', 'company2', '$2y$10$fJ9MVLzHwdabkNXKpDsLuuC1M1lR.MBuN6xP4YbinBINzcxpo/BMK', 'company2@gmail.com', '2022-03-08 09:45:23'),
(44, 100000, 'Lyndon Manaig', 'Lyndon Supermarket', 'full example address', '0987-212-5678', 'company3', '$2y$10$KzAgzbNp4HCiqA8o/ntjAuY/vJ0xGdRma2JINPg3D2j71/fwLVHdW', 'company3@gmail.com', '2022-03-09 02:08:18'),
(45, 100000, 'company4', 'Company4 supermarket', 'Brgy. Real, Calamba City', '0912-232-4567', 'company4', '$2y$10$HPcp/IjY0qzhfCKz5L9dM.lsGjm.F44pgWfH3ZdldEhNYQaquMdwm', 'company4@gmail.com', '2022-03-09 03:34:14');

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
(13, 'user', 'KAE-one', '25d55ad283aa400af464c76d713c07ad', 'Key Account Executive-ONE', 'kae1@gmail.com', 0x6672616e636973204a2e706e67),
(14, 'user', 'KAE-two', '25d55ad283aa400af464c76d713c07ad', 'Key Account Executive-TWO', 'kae2@gmail.com', 0x6672616e63697320442e706e67),
(15, 'user', 'KAE-Three', '25d55ad283aa400af464c76d713c07ad', 'Key Account Executive-THREE', 'kae3@gmail.com', 0x7068656e616c6f6e652e706e67),
(16, 'user', 'KAE-kervin', '25d55ad283aa400af464c76d713c07ad', 'Kervin Dela Cueva', 'kdela_cueva@ccc.edu.ph', 0x616236373631366430303030623237333637343862663830303331636436343638616166316564662e6a706567);

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
-- Indexes for table `rgpiCodes`
--
ALTER TABLE `rgpiCodes`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `brandname`
--
ALTER TABLE `brandname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cartorder`
--
ALTER TABLE `cartorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rgpiCodes`
--
ALTER TABLE `rgpiCodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_newcommer`
--
ALTER TABLE `tbl_newcommer`
  MODIFY `newcommer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
