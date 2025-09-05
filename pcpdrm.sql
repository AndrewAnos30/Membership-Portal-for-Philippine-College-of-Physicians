-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2025 at 04:33 AM
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
-- Database: `pcpdrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','member','applicant','editor','accounting') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `role`) VALUES
(10, 'pcp@member', '$2y$10$Wj.V4cur4ElI1Lr/OBCcDeEZMsKL5VoEhgykmCDkA7MF40AOhn/dK', 'member'),
(12, 'member', '$2y$10$8Ybpci5UGVJAyHujLWApiOVBV5RACPIiVDaOl76/D7C3Bhr7JWTuq', 'member'),
(13, 'test', '$2y$10$mGsgpqnKz8ZixRiaJwkjGuJ1RpVkf1cWrrv7Vkxy8GQ3aWi3IEpHq', 'member'),
(15, 'gyugdyuguye', '$2y$10$2yuOVTWfzo05fg9TpHha1ueX87Kfzjpwy.6El/TRfb1dLNe707trC', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `con_membership_no` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `con_membership_no`, `phone`, `mobile`, `email`) VALUES
(1, 'pcp@member', '12312312312', '123123', 'test@test.test'),
(2, 'member', '45678', '345678', 'test@test.testsss'),
(3, 'test', '345678', '45678', 'test@test.testsss'),
(4, 'gyugdyuguye', '765762167', '+637651236751', 'test@test.testsss');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `cre_membership_no` varchar(50) DEFAULT NULL,
  `prc` varchar(50) DEFAULT NULL,
  `prc_expiry` date DEFAULT NULL,
  `pma` varchar(50) DEFAULT NULL,
  `pma_expiry` date DEFAULT NULL,
  `phic` varchar(50) DEFAULT NULL,
  `phic_expiry` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `cre_membership_no`, `prc`, `prc_expiry`, `pma`, `pma_expiry`, `phic`, `phic_expiry`) VALUES
(1, 'pcp@member', 'prc', '2025-12-31', 'pma', '2024-12-31', 'phic', '2023-12-31'),
(2, 'member', 'fadsf', '2024-12-30', 'fadsf', '2025-12-31', 'fadf', '2025-12-31'),
(3, 'test', 'dsaf', '2025-12-31', '213123', '2025-12-30', '123123', '2025-12-31'),
(4, 'gyugdyuguye', '', '0000-00-00', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `home_address`
--

CREATE TABLE `home_address` (
  `id` int(11) NOT NULL,
  `a_membership_no` varchar(100) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_address`
--

INSERT INTO `home_address` (`id`, `a_membership_no`, `region`, `province`, `city`, `barangay`, `zip`, `address1`, `address2`) VALUES
(3, 'member', 'REGION V', 'CATANDUANES', 'GIGMOTO', 'SAN PEDRO', '21312', 'fasdf', 'ndlaskmnflkadsf'),
(4, 'test', 'NCR', 'NATIONAL CAPITAL REGION - MANILA', 'SAN NICOLAS', 'BARANGAY 284', '123123', 'address 1', 'address 2'),
(5, 'gyugdyuguye', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `induction`
--

CREATE TABLE `induction` (
  `id` int(11) NOT NULL,
  `i_membership_no` varchar(50) DEFAULT NULL,
  `induc_category` varchar(100) DEFAULT NULL,
  `induc_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `induction`
--

INSERT INTO `induction` (`id`, `i_membership_no`, `induc_category`, `induc_date`, `remarks`) VALUES
(1, 'member', 'Honorary Fellow', '2025-12-31', 'remarks'),
(2, 'test', '1', '2025-12-31', '1'),
(5, 'gyugdyuguye', 'Life Fellow', '2001-01-20', 'smx');

-- --------------------------------------------------------

--
-- Table structure for table `membership_info`
--

CREATE TABLE `membership_info` (
  `id` int(11) NOT NULL,
  `m_membership_no` varchar(50) NOT NULL,
  `member_chapter` varchar(100) NOT NULL,
  `member_category` varchar(100) NOT NULL,
  `specialty` varchar(150) DEFAULT NULL,
  `sub_specialty` varchar(150) DEFAULT NULL,
  `other_specialty` varchar(150) DEFAULT NULL,
  `classification` varchar(100) DEFAULT NULL,
  `member_status` enum('active','inactive','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_info`
--

INSERT INTO `membership_info` (`id`, `m_membership_no`, `member_chapter`, `member_category`, `specialty`, `sub_specialty`, `other_specialty`, `classification`, `member_status`) VALUES
(1, 'pcp@member', 'mchapter', 'mcategory', 'specialty', 'sub', 'other', 'class', 'inactive'),
(2, 'member', 'fasdf', 'cat', 'bhjb', 'bjkhb', 'jhv', 'vkjvk', 'active'),
(3, 'test', 'esa', 'jnkj', 'njn', 'jknkj', 'njknjk', 'jnkn', 'active'),
(4, 'gyugdyuguye', 'Northern Mindanao', 'Diplomate', '', '', '', '', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `pi_membership_no` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `extname` varchar(50) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `civilstatus` enum('single','married','widowed','separated','divorced') NOT NULL,
  `partners_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_info`
--

INSERT INTO `personal_info` (`id`, `pi_membership_no`, `lastname`, `firstname`, `middlename`, `extname`, `gender`, `birthdate`, `nationality`, `civilstatus`, `partners_name`) VALUES
(11, 'pcp@member', 'last', '', 'middle', 'ext', 'other', '2025-12-31', 'fil', 'married', 'partner'),
(12, 'member', 'fhjajsf', '', 'kjbkj', 'bkbkjbkj', 'male', '2025-12-31', 'dasf', 'married', 'fsdfsdf'),
(13, 'test', 'last', '', 'middle', 'ext', 'male', '2024-11-30', 'filipino', 'single', ''),
(14, 'gyugdyuguye', 'fvghsava', '', '', '', 'male', '2131-03-12', 'fasdfas', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contacts` (`con_membership_no`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_credentials` (`cre_membership_no`);

--
-- Indexes for table `home_address`
--
ALTER TABLE `home_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_home_address_account` (`a_membership_no`);

--
-- Indexes for table `induction`
--
ALTER TABLE `induction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_induction` (`i_membership_no`);

--
-- Indexes for table `membership_info`
--
ALTER TABLE `membership_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_membership_info` (`m_membership_no`);

--
-- Indexes for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_membership` (`pi_membership_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_address`
--
ALTER TABLE `home_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `induction`
--
ALTER TABLE `induction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `membership_info`
--
ALTER TABLE `membership_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts` FOREIGN KEY (`con_membership_no`) REFERENCES `account` (`username`);

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `fk_credentials` FOREIGN KEY (`cre_membership_no`) REFERENCES `account` (`username`);

--
-- Constraints for table `home_address`
--
ALTER TABLE `home_address`
  ADD CONSTRAINT `fk_home_address_account` FOREIGN KEY (`a_membership_no`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `induction`
--
ALTER TABLE `induction`
  ADD CONSTRAINT `fk_induction` FOREIGN KEY (`i_membership_no`) REFERENCES `account` (`username`);

--
-- Constraints for table `membership_info`
--
ALTER TABLE `membership_info`
  ADD CONSTRAINT `fk_membership_info` FOREIGN KEY (`m_membership_no`) REFERENCES `account` (`username`);

--
-- Constraints for table `personal_info`
--
ALTER TABLE `personal_info`
  ADD CONSTRAINT `fk_membership` FOREIGN KEY (`pi_membership_no`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
