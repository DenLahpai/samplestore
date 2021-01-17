-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2021 at 09:31 PM
-- Server version: 5.7.32
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denlpmm_samplestore`
--

-- --------------------------------------------------------

--
-- Table structure for table `Brands`
--

CREATE TABLE `Brands` (
  `Id` int(12) NOT NULL,
  `BrandsLink` varchar(250) NOT NULL,
  `BrandsName` varchar(250) NOT NULL,
  `LogoImage` varchar(250) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Country` varchar(250) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Brands`
--

INSERT INTO `Brands` (`Id`, `BrandsLink`, `BrandsName`, `LogoImage`, `Image`, `Country`, `Created`, `Updated`) VALUES
(1, 'Brd_5ffad566dc0aa3.23023436', 'Fée', NULL, '5ffad5b3275914.75106823.png', 'France', '2021-01-10 10:22:30', '2021-01-10 10:23:47'),
(2, 'Brd_5ffad5d2d45a08.65781499', 'Oh Deer', NULL, '5ffad5d2d426f1.08614488.png', 'Canada', '2021-01-10 10:24:18', '2021-01-10 10:24:18'),
(3, 'Brd_5ffad5f2b74501.83844613', 'Luna', NULL, '5ffad5f2b72528.38492946.png', 'Spain', '2021-01-10 10:24:50', '2021-01-10 10:24:50'),
(4, 'Brd_5ffad653ad7c98.25202279', 'ရေခဲတောင်', NULL, '5ffad653622ff7.90668362.png', 'Myanmar', '2021-01-10 10:26:27', '2021-01-10 10:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `Id` int(12) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `Qty` int(3) NOT NULL DEFAULT '1',
  `SessionLink` varchar(250) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`Id`, `ProductsLink`, `Qty`, `SessionLink`, `Status`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffbe4157ba065.96432576', 1, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', 1, '2021-01-11 06:11:37', '2021-01-11 06:11:37'),
(2, 'Prd_5ffbd90c920908.13308771', 1, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffc033c5c5216.20465192', 1, '2021-01-11 07:50:32', '2021-01-11 07:50:32'),
(3, 'Prd_5ffbe1957a5e07.02549683', 1, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', 1, '2021-01-11 07:54:27', '2021-01-11 07:54:27'),
(4, 'Prd_5ffadc060fa985.06139160', 1, '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', 1, '2021-01-16 15:16:58', '2021-01-16 15:16:58'),
(5, 'Prd_5ffbd90c920908.13308771', 1, '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', 1, '2021-01-16 15:17:14', '2021-01-16 15:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `Id` int(12) NOT NULL,
  `CustomersLink` varchar(250) NOT NULL,
  `OrdersLink` varchar(250) NOT NULL,
  `Title` varchar(12) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Mobile` varchar(250) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Town` varchar(250) NOT NULL,
  `Note` varchar(250) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`Id`, `CustomersLink`, `OrdersLink`, `Title`, `Name`, `Email`, `Mobile`, `Address`, `Town`, `Note`, `Created`, `Update`) VALUES
(1, 'Ctm_6003047c17f973.53246432', 'Ord_6003047c17f882.30399199', 'Mr', 'Den Lahpai', 'den.lahpai@icloud.com', '09402590317', '116, 15th Street, Lanmadaw', 'Yangon', 'Test order...', '2021-01-16 15:21:55', '2021-01-16 15:21:55');

-- --------------------------------------------------------

--
-- Table structure for table `Images`
--

CREATE TABLE `Images` (
  `Id` int(6) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `Img` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL DEFAULT 'OK',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Images`
--

INSERT INTO `Images` (`Id`, `ProductsLink`, `Img`, `Status`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffadc060fa985.06139160', '5ffadccad9b4f7.74618521.jpg', 'OK', '2021-01-10 10:54:02', '2021-01-10 10:54:02'),
(2, 'Prd_5ffadc060fa985.06139160', '5ffadcddd13080.46622983.jpg', 'OK', '2021-01-10 10:54:21', '2021-01-10 10:54:21'),
(3, 'Prd_5ffbd90c920908.13308771', '5ffbd93fa0c025.53358467.jpg', 'OK', '2021-01-11 04:51:11', '2021-01-11 04:51:11'),
(4, 'Prd_5ffbd90c920908.13308771', '5ffbd958cbbcc8.24067412.jpg', 'OK', '2021-01-11 04:51:36', '2021-01-11 04:51:36'),
(5, 'Prd_5ffbe1957a5e07.02549683', '5ffbe36d8a3223.46136645.jpg', 'OK', '2021-01-11 05:34:37', '2021-01-11 05:34:37'),
(6, 'Prd_5ffbe1957a5e07.02549683', '5ffbe388a2d724.95973954.jpg', 'OK', '2021-01-11 05:35:04', '2021-01-11 05:35:04'),
(7, 'Prd_5ffbe4157ba065.96432576', '5ffec7d21ec057.54863844.jpg', 'OK', '2021-01-13 10:13:38', '2021-01-13 10:13:38'),
(8, 'Prd_5ffbe4157ba065.96432576', '5ffec7e0d1b7e7.57498989.png', 'OK', '2021-01-13 10:13:52', '2021-01-13 10:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `Invoices`
--

CREATE TABLE `Invoices` (
  `Id` int(12) NOT NULL,
  `InvoicesLink` varchar(250) NOT NULL,
  `InvoiceNo` varchar(250) NOT NULL,
  `Total` int(24) NOT NULL DEFAULT '0',
  `Status` varchar(250) NOT NULL DEFAULT 'Invoiced',
  `Method` varchar(250) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PaidOn` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Invoices`
--

INSERT INTO `Invoices` (`Id`, `InvoicesLink`, `InvoiceNo`, `Total`, `Status`, `Method`, `Created`, `Updated`, `PaidOn`) VALUES
(1, 'Inv_6003047c17f988.23537600', '21-010001', 298500, 'Invoiced', NULL, '2021-01-16 15:21:32', '2021-01-16 15:21:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `Id` int(12) NOT NULL,
  `SessionLink` varchar(250) NOT NULL,
  `OrdersLink` varchar(250) NOT NULL,
  `CustomersLink` varchar(250) NOT NULL,
  `InvoicesLink` varchar(250) NOT NULL,
  `Status` varchar(250) NOT NULL DEFAULT 'Confirmed',
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`Id`, `SessionLink`, `OrdersLink`, `CustomersLink`, `InvoicesLink`, `Status`, `Created`, `Updated`) VALUES
(1, '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', 'Ord_6003047c17f882.30399199', 'Ctm_6003047c17f973.53246432', 'Inv_6003047c17f988.23537600', 'Confirmed', '2021-01-16 15:21:32', '2021-01-16 15:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `Orders_List`
--

CREATE TABLE `Orders_List` (
  `Id` int(11) NOT NULL,
  `OrdersLink` varchar(250) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `Qty` int(3) NOT NULL,
  `Subtotal` int(12) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders_List`
--

INSERT INTO `Orders_List` (`Id`, `OrdersLink`, `ProductsLink`, `Qty`, `Subtotal`, `Created`, `Updated`) VALUES
(1, 'Ord_6003047c17f882.30399199', 'Prd_5ffadc060fa985.06139160', 1, 240000, '2021-01-16 15:21:33', '2021-01-16 15:21:33'),
(2, 'Ord_6003047c17f882.30399199', 'Prd_5ffbd90c920908.13308771', 1, 58500, '2021-01-16 15:21:33', '2021-01-16 15:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `Payments`
--

CREATE TABLE `Payments` (
  `Id` int(12) NOT NULL,
  `InvoicesLink` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `Id` int(12) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `ProductsCode` varchar(250) NOT NULL,
  `MainImg` varchar(250) DEFAULT NULL,
  `BrandsId` int(6) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Cat1` varchar(250) NOT NULL,
  `TargetsId` int(3) NOT NULL,
  `Size` varchar(250) NOT NULL,
  `Color` varchar(250) NOT NULL,
  `Price` int(12) NOT NULL,
  `Discount` decimal(12,2) DEFAULT NULL,
  `Description` longtext,
  `Status` varchar(250) NOT NULL DEFAULT 'Available',
  `UsersId` int(6) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`Id`, `ProductsLink`, `ProductsCode`, `MainImg`, `BrandsId`, `Name`, `Cat1`, `TargetsId`, `Size`, `Color`, `Price`, `Discount`, `Description`, `Status`, `UsersId`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffadc060fa985.06139160', 'YKTSBO-2101002', '5ffadcb31d26d8.98868554.jpg', 4, 'SNow Boots', 'Shoes', 2, '28', '#904109', 240000, 0.00, 'နှင်း တောထဲ မှာ လန်းမယ် ရိုမယ်!', 'Available', 1, '2021-01-10 10:50:46', '2021-01-10 10:53:39'),
(2, 'Prd_5ffbd90c920908.13308771', 'ODESHT2101004', '5ffbd9230d0392.22207381.jpg', 2, 'Shirt', 'Shirt', 2, '36', 'white', 65000, 10.00, 'White shirt for all occasions!', 'Available', 1, '2021-01-11 04:50:20', '2021-01-11 04:50:43'),
(3, 'Prd_5ffbe1957a5e07.02549683', 'LNATSH21010093', '5ffbe3448ef997.06760596.jpg', 3, 'T-shirt', 'Shirt', 1, 'Free', 'white', 30000, 0.00, 'T-shirt for casual outdoor.', 'Available', 1, '2021-01-11 05:26:45', '2021-01-11 05:33:56'),
(4, 'Prd_5ffbe4157ba065.96432576', 'LNATSH21010093', '5ffec7be8ea219.19805759.jpg', 3, 'T-shirt', 'Shirt', 1, 'Free', 'black', 30000, 5.00, 'T-shirt for casual outdoor.', 'Available', 1, '2021-01-11 05:37:25', '2021-01-13 10:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `Products_Views`
--

CREATE TABLE `Products_Views` (
  `Id` int(12) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `SessionLink` varchar(250) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Products_Views`
--

INSERT INTO `Products_Views` (`Id`, `ProductsLink`, `SessionLink`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffbe1957a5e07.02549683', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 06:05:27', '2021-01-11 06:05:27'),
(2, 'Prd_5ffbe4157ba065.96432576', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 06:05:40', '2021-01-11 06:05:40'),
(3, 'Prd_5ffbe4157ba065.96432576', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 06:11:45', '2021-01-11 06:11:45'),
(4, 'Prd_5ffbd90c920908.13308771', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffc033c5c5216.20465192', '2021-01-11 07:50:28', '2021-01-11 07:50:28'),
(5, 'Prd_5ffbd90c920908.13308771', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffc033c5c5216.20465192', '2021-01-11 07:50:36', '2021-01-11 07:50:36'),
(6, 'Prd_5ffbe1957a5e07.02549683', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 07:54:25', '2021-01-11 07:54:25'),
(7, 'Prd_5ffbe1957a5e07.02549683', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 07:54:31', '2021-01-11 07:54:31'),
(8, 'Prd_5ffbe1957a5e07.02549683', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 07:55:19', '2021-01-11 07:55:19'),
(9, 'Prd_5ffbe1957a5e07.02549683', '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '2021-01-11 07:55:25', '2021-01-11 07:55:25'),
(10, 'Prd_5ffbe4157ba065.96432576', '13Jan_419adf78026466e4229df9c0126ad2fd_5ffec7fa69f615.10793154', '2021-01-13 10:15:32', '2021-01-13 10:15:32'),
(11, 'Prd_5ffadc060fa985.06139160', '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '2021-01-16 15:16:55', '2021-01-16 15:16:55'),
(12, 'Prd_5ffadc060fa985.06139160', '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '2021-01-16 15:17:01', '2021-01-16 15:17:01'),
(13, 'Prd_5ffbd90c920908.13308771', '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '2021-01-16 15:17:12', '2021-01-16 15:17:12'),
(14, 'Prd_5ffbd90c920908.13308771', '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '2021-01-16 15:17:16', '2021-01-16 15:17:16'),
(15, 'Prd_5ffadc060fa985.06139160', '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '2021-01-16 15:21:26', '2021-01-16 15:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE `Sessions` (
  `Id` int(12) NOT NULL,
  `SessionLink` varchar(250) DEFAULT NULL,
  `Ip` varchar(250) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Sessions`
--

INSERT INTO `Sessions` (`Id`, `SessionLink`, `Ip`, `Created`, `Updated`) VALUES
(1, '10Jan_f4703fe3514f9b035a577057f2bbf661_5ffacc146a0497.36511612', '103.231.94.72', '2021-01-10 09:42:44', '2021-01-10 09:42:44'),
(2, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbcfe15b7217.85428614', '203.81.71.209', '2021-01-11 04:11:13', '2021-01-11 04:11:13'),
(3, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffbeaa7b04c05.89782184', '203.81.71.209', '2021-01-11 06:05:27', '2021-01-11 06:05:27'),
(4, '11Jan_e3734b1ebc527bf93a4fc473b07ac9c4_5ffc033c5c5216.20465192', '203.81.71.209', '2021-01-11 07:50:20', '2021-01-11 07:50:20'),
(5, '13Jan_419adf78026466e4229df9c0126ad2fd_5ffec6d39d2a13.27330978', '103.231.94.60', '2021-01-13 10:09:23', '2021-01-13 10:09:23'),
(6, '13Jan_419adf78026466e4229df9c0126ad2fd_5ffec7fa69f615.10793154', '103.231.94.60', '2021-01-13 10:14:18', '2021-01-13 10:14:18'),
(7, '15Jan_9852c99f068b7e48dcb961b08879634b_60015df2d50bf9.69037805', '203.81.71.174', '2021-01-15 09:18:42', '2021-01-15 09:18:42'),
(8, '15Jan_7512780e1095844f05d46c4f7f71d567_60017683bfd381.91237162', '136.228.172.0', '2021-01-15 11:03:31', '2021-01-15 11:03:31'),
(9, '15Jan_f1dc40dfbf62b32ef2be9097f956589e_600198bb19f1b7.29388783', '173.252.87.112', '2021-01-15 13:29:31', '2021-01-15 13:29:31'),
(10, '16Jan_5b849170e79bab5c6b487238260c7ca6_60030366f2ffc9.11007933', '103.231.94.208', '2021-01-16 15:16:54', '2021-01-16 15:16:54'),
(11, '17Jan_bbc84c17a6816a66ba611b7aacf6d036_60041f413b9a03.07886051', '136.228.173.40', '2021-01-17 11:28:01', '2021-01-17 11:28:01'),
(12, '17Jan_5b849170e79bab5c6b487238260c7ca6_6004453eb7c318.48409908', '103.231.94.208', '2021-01-17 14:10:06', '2021-01-17 14:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `Showcase1`
--

CREATE TABLE `Showcase1` (
  `Id` int(6) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `UsersId` int(6) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Showcase1`
--

INSERT INTO `Showcase1` (`Id`, `ProductsLink`, `Status`, `UsersId`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffbd90c920908.13308771', 1, 1, '2021-01-11 05:05:36', '2021-01-11 05:05:36'),
(2, 'Prd_5ffbe4157ba065.96432576', 1, 1, '2021-01-13 10:14:32', '2021-01-13 10:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `Showcase2`
--

CREATE TABLE `Showcase2` (
  `Id` int(6) NOT NULL,
  `ProductsLink` varchar(250) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1',
  `UsersId` int(6) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Showcase2`
--

INSERT INTO `Showcase2` (`Id`, `ProductsLink`, `Status`, `UsersId`, `Created`, `Updated`) VALUES
(1, 'Prd_5ffbe4157ba065.96432576', 1, 1, '2021-01-13 10:14:37', '2021-01-13 10:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `Targets`
--

CREATE TABLE `Targets` (
  `Id` int(6) NOT NULL,
  `TargetsCode` varchar(6) NOT NULL,
  `Target` varchar(12) NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Targets`
--

INSERT INTO `Targets` (`Id`, `TargetsCode`, `Target`, `Created`, `Updated`) VALUES
(1, 'F', 'Women', '2021-01-02 14:03:51', '2021-01-02 14:03:51'),
(2, 'M', 'Men', '2021-01-02 14:03:51', '2021-01-02 14:03:51'),
(3, 'U', 'Unisex', '2021-01-02 14:04:23', '2021-01-02 14:04:23'),
(4, 'K', 'Kids', '2021-01-02 14:04:23', '2021-01-02 14:04:23'),
(5, 'B', 'Babies', '2021-01-02 14:04:59', '2021-01-02 14:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Id` int(6) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Dob` date NOT NULL,
  `Mobile` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `StoresName` varchar(250) NOT NULL,
  `StoresCode` varchar(250) NOT NULL,
  `StoresLink` varchar(250) NOT NULL,
  `Expiry` date NOT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Id`, `Username`, `Password`, `Name`, `Dob`, `Mobile`, `Email`, `StoresName`, `StoresCode`, `StoresLink`, `Expiry`, `Created`, `Updated`) VALUES
(1, 'denlahpai', '22da7f7990c40cc9849a959619d4777d', 'Den Lahpai', '1978-08-14', '09402590317', 'den.lahpai@icloud.com', 'Link In Myanmar', 'LINKMMRGN', 'www.linkinmyanmar.com', '2021-12-31', '2020-12-17 16:56:02', '2020-12-17 16:56:02'),
(2, 'denny', '22da7f7990c40cc9849a959619d4777d', 'Den Lahpai', '1978-08-14', '09402590317', 'den@linkinmyanmar.com', 'Link In Myanmar', 'LINKMMRGN', 'www.linkinmyanmar.com', '2021-12-31', '2020-12-17 16:56:13', '2020-12-20 16:29:26'),
(3, 'yingsam', 'c9900f89b61bfdb85ab64fbe6ff412f7', 'Lamyaw Ying Sam', '1995-08-14', '09401537750', 'yingsan.101@gmail.com', 'Oi Collection', 'OICLTN', '', '2021-12-31', '2021-01-15 09:18:02', '2021-01-17 11:03:11'),
(4, 'kokan', 'e57f36f3790939a442cb757c499529f1', 'Kan Win Oung', '1977-09-26', '09448026060', 'kanwinoung@gmail.com', 'Link In Myanmar', 'LINKMMRGN', '', '2021-12-31', '2021-01-17 11:17:07', '2021-01-17 11:17:07'),
(5, 'yaminsoe', 'e57f36f3790939a442cb757c499529f1', 'Yamin Soe', '1998-01-01', '09420704685', 'yamin@yamin.com', 'LINK IN MYANMAR', 'LINKMMRGN', '', '2021-12-31', '2021-01-17 11:23:58', '2021-01-17 11:23:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Brands`
--
ALTER TABLE `Brands`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Invoices`
--
ALTER TABLE `Invoices`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Orders_List`
--
ALTER TABLE `Orders_List`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Payments`
--
ALTER TABLE `Payments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Products_Views`
--
ALTER TABLE `Products_Views`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Showcase1`
--
ALTER TABLE `Showcase1`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Showcase2`
--
ALTER TABLE `Showcase2`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Targets`
--
ALTER TABLE `Targets`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Brands`
--
ALTER TABLE `Brands`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Images`
--
ALTER TABLE `Images`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Invoices`
--
ALTER TABLE `Invoices`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Orders_List`
--
ALTER TABLE `Orders_List`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Payments`
--
ALTER TABLE `Payments`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Products_Views`
--
ALTER TABLE `Products_Views`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Sessions`
--
ALTER TABLE `Sessions`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Showcase1`
--
ALTER TABLE `Showcase1`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Showcase2`
--
ALTER TABLE `Showcase2`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Targets`
--
ALTER TABLE `Targets`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
