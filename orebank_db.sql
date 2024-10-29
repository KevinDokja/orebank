-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2024 at 03:22 PM
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
-- Database: `orebank_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `account_no` int(9) NOT NULL,
  `username` char(25) NOT NULL,
  `password` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`account_no`, `username`, `password`) VALUES
(338509634, 'client1', 'Pass1'),
(338509635, 'Bigii', '2003'),
(338509636, 'FULGENCE', '12345678'),
(338509637, 'Harry', 'lunette'),
(338509638, 'Hermione', 'livre'),
(338509639, 'Mah', 'rosine');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_type`
--

CREATE TABLE `tbl_account_type` (
  `account_no` int(9) NOT NULL,
  `account_type` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_account_type`
--

INSERT INTO `tbl_account_type` (`account_no`, `account_type`) VALUES
(338509634, 'EPARGNE'),
(338509629, 'EPARGNE'),
(338509635, 'COURANT'),
(338509636, 'EPARGNE'),
(338509637, 'COURANT'),
(338509638, 'COURANT'),
(338509639, 'EPARGNE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `account_no` int(9) NOT NULL,
  `home_address` varchar(100) NOT NULL,
  `city` char(25) NOT NULL,
  `state` char(25) NOT NULL,
  `pincode` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`account_no`, `home_address`, `city`, `state`, `pincode`) VALUES
(338509634, '101-B Motombe ', 'Toliara', 'Madagascar', 601),
(338509635, 'Tranomora', 'Toliara', 'Mandagascar', 601),
(338509636, 'Andamasiny', 'Toliara', 'Madagascar', 601),
(338509637, 'Poudlard', 'Londre', 'UK', 5656),
(338509638, 'Poudlard', 'London', 'UK', 589),
(338509639, 'Poudlard', 'London', 'UK', 589);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `full_name` char(25) NOT NULL,
  `mobile` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `full_name`, `mobile`, `email`, `password`) VALUES
(1000502004, 'Admin1', '9959959951', 'adminemail@gmail.com', 'Password1'),
(1000502005, 'ANDRIAMPARANY Tata Kevin', '0343778956', 'kevinadriamparany7@gmail.com', 'soraomiagereba7812');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balance`
--

CREATE TABLE `tbl_balance` (
  `account_no` int(9) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_balance`
--

INSERT INTO `tbl_balance` (`account_no`, `account_type`, `balance`) VALUES
(338509634, 'EPARGNE', 762300),
(338509629, 'EPARGNE', 2145721647),
(338509635, 'COURANT', 164700),
(338509636, 'EPARGNE', 190000),
(338509637, 'COURANT', 500000),
(338509638, 'COURANT', 145000),
(338509639, 'EPARGNE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `account_no` int(9) NOT NULL,
  `full_name` char(100) NOT NULL,
  `gender` char(10) NOT NULL,
  `birth_date` date NOT NULL,
  `mobile` char(15) NOT NULL,
  `email` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`account_no`, `full_name`, `gender`, `birth_date`, `mobile`, `email`) VALUES
(338509634, 'JEDUSOR Tom', 'H', '2000-02-09', '9959959955', 'kevinshocker67@gmail.com'),
(338509629, 'OREBANK', '/', '2024-03-15', '0387109481', 'orebank@mada.mg'),
(338509635, 'FRED Chris Nas Mijah', 'H', '2003-08-06', '0343778956', 'emmalou24gmail@gmail.com'),
(338509636, 'FULGENCE Damivelo', 'H', '2004-04-20', '0325320054', 'fulgencedamivelo6@gmail.coml'),
(338509637, 'POTTER Harry', 'H', '2000-04-06', '0325566255', 'harry@potter.org'),
(338509638, 'GRANGER Hermione', 'H', '2003-03-15', '+26132569658', 'hermione@nerd.org'),
(338509639, 'MARIE Rosine', 'F', '2004-02-02', '0348409040', 'rosine@marie.net');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(10) NOT NULL,
  `account_no` int(9) NOT NULL,
  `feedback` varchar(1000) NOT NULL,
  `hearts` int(6) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `account_no`, `feedback`, `hearts`, `time`) VALUES
(400504618, 338509638, 'Je suis impressionée par la simplicité et des transactions.', 5, '2024-01-06 07:51:44'),
(400504619, 338509634, 'C\'est un peu relou de demander le numéro de compte d\'une personne à chaque fois,j\'aimerai bien que le numéros de ceux à qui j\'ai déjà fais des transactions soit afficher quelque part pour facilité les prochaines transactions', 3, '2024-01-06 07:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_history`
--

CREATE TABLE `tbl_login_history` (
  `token_id` int(10) NOT NULL,
  `account_no` int(9) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login_history`
--

INSERT INTO `tbl_login_history` (`token_id`, `account_no`, `login_time`, `logout_time`) VALUES
(700305985, 338509634, '2024-04-17 07:46:19', '2024-01-05 18:00:26'),
(700305986, 338509634, '2024-01-05 18:00:49', NULL),
(700305987, 338509634, '2024-01-06 00:53:40', '2024-01-06 01:00:29'),
(700305988, 338509634, '2024-01-06 01:01:09', NULL),
(700305989, 338509634, '2024-01-06 01:22:10', '2024-01-06 01:24:49'),
(700305990, 338509634, '2024-04-19 04:28:10', NULL),
(700305991, 338509634, '2024-04-19 04:31:20', '2024-01-05 17:56:09'),
(700305992, 338509634, '2024-01-05 17:59:17', NULL),
(700305993, 338509635, '2024-01-05 18:15:12', NULL),
(700305994, 338509634, '2024-04-19 14:06:43', NULL),
(700305995, 338509635, '2024-04-19 15:12:53', '2024-04-19 16:14:48'),
(700305996, 338509634, '2024-04-19 16:50:16', '2024-04-19 18:46:12'),
(700305997, 338509634, '2024-01-05 17:55:12', '2024-04-20 15:40:41'),
(700305998, 338509634, '2024-04-20 16:13:11', NULL),
(700305999, 338509634, '2024-04-22 07:29:44', NULL),
(700306000, 338509634, '2024-04-22 08:56:46', NULL),
(700306001, 338509634, '2024-04-22 09:39:05', NULL),
(700306002, 338509634, '2024-04-23 14:44:44', NULL),
(700306003, 338509634, '2024-04-27 10:10:38', NULL),
(700306004, 338509634, '2024-04-27 10:16:59', '2024-04-27 10:17:07'),
(700306005, 338509635, '2024-04-27 10:17:25', '2024-04-27 10:19:12'),
(700306006, 338509635, '2024-04-27 10:20:16', NULL),
(700306007, 338509634, '2024-04-27 10:37:55', NULL),
(700306008, 338509635, '2024-04-27 16:24:44', '2024-04-27 16:25:19'),
(700306009, 338509635, '2024-04-27 16:25:19', '2024-04-27 16:28:13'),
(700306010, 338509634, '2024-04-27 16:45:04', '2024-04-27 16:45:42'),
(700306011, 338509635, '2024-04-29 07:24:38', '2024-04-29 07:25:40'),
(700306012, 338509635, '2024-04-29 07:30:12', '2024-04-29 07:33:12'),
(700306013, 338509634, '2024-04-29 07:34:32', '2024-04-29 07:40:26'),
(700306014, 338509636, '2024-04-29 07:57:43', '2024-04-29 08:00:08'),
(700306015, 338509636, '2024-04-29 08:01:06', '2024-04-29 08:02:40'),
(700306016, 338509636, '2024-04-29 08:03:39', NULL),
(700306017, 338509635, '2024-05-04 16:31:03', '2024-05-04 16:32:51'),
(700306018, 338509635, '2024-05-04 16:33:00', '2024-05-04 16:47:55'),
(700306019, 338509634, '2024-05-04 16:48:00', '2024-05-04 16:53:15'),
(700306020, 338509634, '2024-05-04 16:53:20', '2024-05-04 16:53:25'),
(700306021, 338509634, '2024-05-04 16:53:29', '2024-05-04 16:53:35'),
(700306022, 338509635, '2024-05-04 16:53:40', '2024-05-04 17:00:56'),
(700306023, 338509637, '2024-01-06 07:12:24', NULL),
(700306024, 338509638, '2024-01-06 07:28:04', '2024-01-06 07:42:19'),
(700306025, 338509634, '2024-01-06 07:42:30', '2024-01-06 07:42:48'),
(700306026, 338509638, '2024-01-06 07:43:02', NULL),
(700306027, 338509635, '2024-01-05 18:47:05', '2024-10-03 15:24:21'),
(700306028, 338509639, '2024-10-03 15:29:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requests`
--

CREATE TABLE `tbl_requests` (
  `request_id` int(10) NOT NULL,
  `account_no` int(9) NOT NULL,
  `to_account` int(9) NOT NULL,
  `amount` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `hasViewed` tinyint(1) NOT NULL DEFAULT 0,
  `status` char(15) NOT NULL,
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requests`
--

INSERT INTO `tbl_requests` (`request_id`, `account_no`, `to_account`, `amount`, `message`, `hasViewed`, `status`, `request_date`) VALUES
(100009034, 338509634, 338509635, 10000, 'Pourriez-vous envoyer de l\'argent à ce compte, s\'il vous plaît ?', 1, 'sent', '2024-01-05 18:06:53'),
(100009035, 338509635, 338509634, 700, 'J\'ai besoins d\'un peu de money', 1, 'sent', '2024-04-19 15:52:35'),
(100009036, 338509634, 338509635, 46000, 'Pourriez-vous envoyer de l\'argent à ce compte, s\'il vous plaît ?', 1, 'sent', '2024-04-19 15:54:29'),
(100009037, 338509638, 338509637, 50000, 'Mon compte est vide,je viens de l\'ouvrir,envoie moi un peu d\'argent s\'il te plait.', 1, 'sent', '2024-01-06 07:35:14'),
(100009038, 338509635, 338509636, 50000, 'Pourriez-vous envoyer de l\'argent à ce compte, s\'il vous plaît ?', 0, 'ignore', '2024-01-05 19:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `trans_id` int(100) NOT NULL,
  `trans_date` datetime NOT NULL,
  `amount` int(100) NOT NULL,
  `trans_type` char(10) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `to_account` int(9) NOT NULL,
  `account_no` int(9) NOT NULL,
  `account_bal` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`trans_id`, `trans_date`, `amount`, `trans_type`, `purpose`, `to_account`, `account_no`, `account_bal`) VALUES
(10055237, '2024-01-06 01:05:21', 1000000, 'DEBIT', 'Operation effectuée par la banque', 338509634, 338509629, 2146483647),
(10055238, '2024-01-06 01:05:21', 1000000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509634, 1000000),
(10055239, '2024-04-19 15:36:21', 200000, 'DEBIT', 'Paiment des frais scolaires', 338509635, 338509634, 800000),
(10055240, '2024-04-19 15:36:21', 200000, 'CREDIT', 'Paiment des frais scolaires', 338509634, 338509635, 200000),
(10055241, '2024-04-19 15:42:59', 10000, 'DEBIT', 'Demande', 338509634, 338509635, 190000),
(10055242, '2024-04-19 15:42:59', 10000, 'CREDIT', 'Demande', 338509635, 338509634, 810000),
(10055243, '2024-04-19 15:52:54', 700, 'DEBIT', 'Demande', 338509635, 338509634, 809300),
(10055244, '2024-04-19 15:52:54', 700, 'CREDIT', 'Demande', 338509634, 338509635, 190700),
(10055245, '2024-04-19 15:54:45', 46000, 'DEBIT', 'Demande', 338509634, 338509635, 144700),
(10055246, '2024-04-19 15:54:45', 46000, 'CREDIT', 'Demande', 338509635, 338509634, 855300),
(10055247, '2024-04-21 09:39:37', 1000, 'DEBIT', 'Operation effectuée par la banque', 338509634, 338509629, 2146482647),
(10055248, '2024-04-21 09:39:37', 1000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509634, 856300),
(10055249, '2024-04-21 09:41:00', 1000, 'DEBIT', 'Operation effectuée par la banque', 338509634, 338509629, 2146481647),
(10055250, '2024-04-21 09:41:00', 1000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509634, 857300),
(10055251, '2024-04-22 07:51:34', 10000, 'DEBIT', 'Operation efféctuée par la banque', 338509629, 338509635, 134700),
(10055252, '2024-04-22 07:51:34', 10000, 'CREDIT', 'Operation efféctuée par la banque', 338509635, 338509629, 2146491647),
(10055253, '2024-04-27 10:14:50', 10000, 'DEBIT', 'Operation effectuée par la banque', 338509635, 338509629, 2146481647),
(10055254, '2024-04-27 10:14:50', 10000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509635, 144700),
(10055255, '2024-04-29 07:28:24', 20000, 'DEBIT', 'Operation effectuée par la banque', 338509635, 338509629, 2146461647),
(10055256, '2024-04-29 07:28:24', 20000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509635, 164700),
(10055257, '2024-04-29 08:03:29', 200000, 'DEBIT', 'Operation effectuée par la banque', 338509636, 338509629, 2146261647),
(10055258, '2024-04-29 08:03:29', 200000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509636, 200000),
(10055259, '2024-04-29 08:03:59', 10000, 'DEBIT', 'Operation efféctuée par la banque', 338509629, 338509636, 190000),
(10055260, '2024-04-29 08:03:59', 10000, 'CREDIT', 'Operation efféctuée par la banque', 338509636, 338509629, 2146271647),
(10055261, '2024-01-06 07:30:54', 550000, 'DEBIT', 'Operation effectuée par la banque', 338509637, 338509629, 2145721647),
(10055262, '2024-01-06 07:30:54', 550000, 'CREDIT', 'Operation effectuée par la banque', 338509629, 338509637, 550000),
(10055263, '2024-01-06 07:36:09', 50000, 'DEBIT', 'Demande', 338509638, 338509637, 500000),
(10055264, '2024-01-06 07:36:09', 50000, 'CREDIT', 'Demande', 338509637, 338509638, 50000),
(10055265, '2024-01-06 07:46:10', 95000, 'DEBIT', 'Cadeau à un parent / Amis', 338509638, 338509634, 762300),
(10055266, '2024-01-06 07:46:10', 95000, 'CREDIT', 'Cadeau à un parent / Amis', 338509634, 338509638, 145000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`account_no`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`trans_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `account_no` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=338509640;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000502006;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400504620;

--
-- AUTO_INCREMENT for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  MODIFY `token_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=700306029;

--
-- AUTO_INCREMENT for table `tbl_requests`
--
ALTER TABLE `tbl_requests`
  MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100009039;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `trans_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10055267;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
