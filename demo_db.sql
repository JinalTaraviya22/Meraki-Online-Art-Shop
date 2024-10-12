-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 04:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `C_Id` int(3) NOT NULL,
  `C_Name` varchar(60) NOT NULL,
  `C_Img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`C_Id`, `C_Name`, `C_Img`) VALUES
(1, 'Drawing Materials', '66f6e4d99a621DrawingMaterials.png'),
(2, 'Sculpting and Modeling', '66f77c93e0b08Sculpting and Modeling.png');

-- --------------------------------------------------------

--
-- Table structure for table `password_token_tbl`
--

CREATE TABLE `password_token_tbl` (
  `Id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Otp` int(11) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `P_Id` int(10) NOT NULL,
  `P_Name` varchar(200) NOT NULL,
  `P_Price` int(60) NOT NULL,
  `P_Stock` int(5) NOT NULL,
  `P_Company_Name` varchar(60) NOT NULL,
  `P_SC_Id` int(3) NOT NULL,
  `P_Desc` text NOT NULL,
  `P_Img1` varchar(60) NOT NULL,
  `P_Img2` varchar(60) NOT NULL,
  `P_Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`P_Id`, `P_Name`, `P_Price`, `P_Stock`, `P_Company_Name`, `P_SC_Id`, `P_Desc`, `P_Img1`, `P_Img2`, `P_Status`) VALUES
(1, 'Nitram Powdered Charcoal 175gms SKU: AZ1635', 2530, 1000, 'Nitram', 1, 'Nitram Powdered Charcoal gives artists a versatile way to apply charcoal and produce varied and textured sketch effects\r\nMilled to an extra fine, uniform 100µ particle size\r\nSmooth, velvety consistency\r\nCan be applied with a brush or a paper stump\r\nHelps to produce varied and textured sketch effects\r\nExcellent lightfastness\r\nNitram Extra Fine Powdered Charcoal comes in this sturdy, reusable aluminium tin, with a lid that can be sealed tightly to avoid messy leaks.\r\nThe functional recessed reservoir insert allows you to control the amount of Nitram Charcoal Powder available. It can be easily removed to access and refill the tin.\r\nNitram Powdered Charcoal is milled to an extra-fine, uniform 100µ particle size. It is smooth, velvety and consistent. It has no coarse or grainy lumps that can mar the surface of your paper.\r\nYou can use a brush or a paper stump to create shapes and tones quickly and easily.\r\nThe uses are limited only by your imagination!', '670a79c48ee98charcoalpow.png', '670a8d75a1142powder.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `slider_tbl`
--

CREATE TABLE `slider_tbl` (
  `Id` int(3) NOT NULL,
  `Img_1` varchar(100) NOT NULL,
  `Img_2` varchar(100) NOT NULL,
  `Img_3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider_tbl`
--

INSERT INTO `slider_tbl` (`Id`, `Img_1`, `Img_2`, `Img_3`) VALUES
(1, 'slide1.png', 'slide2.png', 'slide3.png');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory_tbl`
--

CREATE TABLE `subcategory_tbl` (
  `SC_Id` int(3) NOT NULL,
  `SC_Name` varchar(60) NOT NULL,
  `C_Id` int(3) NOT NULL,
  `SC_Img` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory_tbl`
--

INSERT INTO `subcategory_tbl` (`SC_Id`, `SC_Name`, `C_Id`, `SC_Img`) VALUES
(1, 'Charcoal', 1, '66f77fc5982ccCharcoal.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `U_Id` int(11) NOT NULL,
  `U_Fnm` varchar(255) NOT NULL,
  `U_Lnm` varchar(255) NOT NULL,
  `U_Email` varchar(255) NOT NULL,
  `U_Phn` int(15) NOT NULL,
  `U_Add` text NOT NULL,
  `U_City` char(10) NOT NULL,
  `U_State` char(10) NOT NULL,
  `U_Zip` int(6) NOT NULL,
  `U_Pwd` varchar(255) NOT NULL,
  `U_Profile` varchar(255) DEFAULT NULL,
  `U_Role` char(10) DEFAULT 'Normal',
  `U_Status` char(10) DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`U_Id`, `U_Fnm`, `U_Lnm`, `U_Email`, `U_Phn`, `U_Add`, `U_City`, `U_State`, `U_Zip`, `U_Pwd`, `U_Profile`, `U_Role`, `U_Status`) VALUES
(1, 'Jinal', 'Taraviya', 'jtaraviya932@rku.ac.in', 1234567890, 'rku', 'Rajkot', 'Gujarat', 789998, 'jin', '6706063c52bdcjp pop.png', 'Admin', 'Active'),
(53, 'ayushi', 'mehta', 'amehta123@gmail.com', 1234567890, 'qwer', 'rajkot', 'Gujarat', 360005, 'ayushi', '66ff808362ceb✨Headcanons✨.jpg', 'Normal', 'Inactive'),
(54, 'Angel', 'Raiyani', 'angelraiyanii@gmail.com', 1234567890, 'qwerftg', 'Rajkot', 'Gujarat', 360005, 'angel', '66ff80f8a234dUntitled design (1).png', 'Normal', 'Inactive'),
(59, 'Kalindi', 'Fichadiya', 'jinal.taraviya997@gmail.com', 2147483647, 'rku', 'Rajkot', 'Gujarat', 360005, 'kallu', '670606a6a6640Untitled design.png', 'Normal', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`C_Id`);

--
-- Indexes for table `password_token_tbl`
--
ALTER TABLE `password_token_tbl`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`P_Id`);

--
-- Indexes for table `slider_tbl`
--
ALTER TABLE `slider_tbl`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subcategory_tbl`
--
ALTER TABLE `subcategory_tbl`
  ADD PRIMARY KEY (`SC_Id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`U_Id`),
  ADD UNIQUE KEY `U_Email` (`U_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `C_Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_token_tbl`
--
ALTER TABLE `password_token_tbl`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `P_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider_tbl`
--
ALTER TABLE `slider_tbl`
  MODIFY `Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory_tbl`
--
ALTER TABLE `subcategory_tbl`
  MODIFY `SC_Id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `U_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
