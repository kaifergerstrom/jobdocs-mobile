-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2021 at 11:47 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobdocs`
--

-- --------------------------------------------------------

--
-- Table structure for table `workorders`
--

CREATE TABLE `workorders` (
  `WorkOrderId` int(11) NOT NULL,
  `DateOpened` date NOT NULL,
  `TimeOpened` varchar(8) NOT NULL,
  `WOType` varchar(15) NOT NULL,
  `OriginalCaller` varchar(29) DEFAULT NULL,
  `DateEarliestStart` date NOT NULL,
  `DateWorkCompleted` date NOT NULL,
  `WorkRequested` varchar(109) DEFAULT NULL,
  `SiteID` int(11) NOT NULL,
  `SiteName` varchar(22) NOT NULL,
  `StreetAddress` varchar(23) NOT NULL,
  `City` varchar(9) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Zip` int(11) NOT NULL,
  `WorkCode` varchar(36) NOT NULL,
  `WOStatus` varchar(13) NOT NULL,
  `Fog_Permit_No` varchar(30) DEFAULT NULL,
  `SiteNumber` varchar(30) DEFAULT NULL,
  `Invoices` int(11) NOT NULL,
  `Documents` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workorders`
--

INSERT INTO `workorders` (`WorkOrderId`, `DateOpened`, `TimeOpened`, `WOType`, `OriginalCaller`, `DateEarliestStart`, `DateWorkCompleted`, `WorkRequested`, `SiteID`, `SiteName`, `StreetAddress`, `City`, `State`, `Zip`, `WorkCode`, `WOStatus`, `Fog_Permit_No`, `SiteNumber`, `Invoices`, `Documents`) VALUES
(318809, '2019-07-24', '12:14:10', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-07-24', 'Kitchen backing up in Unit #221', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(318875, '2019-07-25', '09:27:25', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-07-26', 'Apt washing machine stack is backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 3),
(319055, '2019-07-29', '09:13:58', 'Service', 'Harold 240-499-9015', '1900-01-01', '2019-07-28', 'Kitchen overflowing in Unit #503', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(319225, '2019-07-31', '07:58:41', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-07-31', 'Kitchen sink in Unit #218 is backing up \r\nSnake & jet line also', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(319462, '2019-07-31', '09:40:45', 'PreventiveMaint', NULL, '2019-08-17', '2019-08-13', 'Basement & Loading Dock Interceptors Ejectors', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 9),
(319905, '2019-08-03', '14:00:41', 'Service', 'Harold Mazo 240-499-9015', '1900-01-01', '2019-08-03', 'Sink backed up at Unit #519                \r\nHarold\r\n240-499-9015\r\n240-499-9075', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(320297, '2019-08-10', '14:19:09', 'Service', 'Ignacio 301-326-0333', '1900-01-01', '2019-08-10', 'Sink in unit #235 is backing up and needs it cleared right away.\r\nEngineer Ignacio 301-326-0333', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(320433, '2019-08-13', '12:21:40', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-08-13', 'Bathroom sink in #510 is backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(320697, '2019-08-19', '07:11:10', 'Service', 'Ignacia Hernandez301-326-0333', '1900-01-01', '2019-08-19', 'Kitchen sink in Unit #223 is backed up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(320790, '2019-08-19', '15:48:36', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-08-19', 'Sink drain in Unit #416 is backing up/thinks the floor below also has problems Call Matt, 240-330-8334', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(321091, '2019-08-23', '10:07:03', 'Service', 'Lis 240-499-0469', '1900-01-01', '2019-09-04', '3\" pipe feeding to Ejector has come apart and water is shooting out', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '14 PLUMBING COMMERCIAL SERVICE', 'Billed', NULL, NULL, 1, 3),
(321566, '2019-08-27', '15:25:03', 'PreventiveMaint', NULL, '2019-09-18', '2019-09-11', 'All Large & Small Interceptors & Ejectors', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 24),
(321813, '2019-08-28', '13:52:17', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-08-28', 'Kitchen sink in Unit #306 is clogged', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(321937, '2019-08-30', '11:51:42', 'PreventiveMaint', NULL, '2019-10-18', '2019-10-16', 'FC Loading Dock Eject. Bsmt Intercept & Eject', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 12),
(321938, '2019-08-30', '11:51:42', 'PreventiveMaint', NULL, '2019-11-19', '2019-11-19', 'Basement & Loading Dock Interceptors Ejectors', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 2),
(321939, '2019-08-30', '11:51:42', 'PreventiveMaint', NULL, '2019-12-18', '2019-12-18', 'All Large & Small Interceptors & Ejectors', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 12),
(322895, '2019-09-09', '08:42:00', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-09-09', 'Laundry line is backing up/camera line and bring jet', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(322908, '2019-09-09', '10:13:09', 'Service', 'lisa', '1900-01-01', '2019-09-09', 'laundry line backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(323381, '2019-09-17', '08:22:20', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-09-17', 'Kitchen sink in Unit #114 keeps backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(323493, '2019-09-18', '12:48:27', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-09-18', 'Unit #765 has sewage coming up through the tub, also in Unit #752', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(323579, '2019-09-19', '12:36:22', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-09-19', 'MSAL Building Room #15, when they flush the toilet the waste comes up in the shower drain. Call Lisa with ETA', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(323871, '2019-09-25', '08:25:41', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-09-25', 'Clogged drain in janitors closet on ground floor', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(324009, '2019-09-26', '14:23:38', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-09-26', 'New 3 story building room 15 line backed up again', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(324903, '2019-10-03', '16:30:02', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-10-03', 'Unit #513 sink is clogged, needs service today\r\nMatt: 240-330-8334', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(325007, '2019-10-07', '08:19:06', 'Service', 'Matthew 240-330-8334', '1900-01-01', '2019-10-04', 'Kitchen sink backing up in Unit #534', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(325172, '2019-10-09', '08:49:00', 'Service', 'William Kelley 240-499-9015', '1900-01-01', '2019-10-08', 'Backed up kitchen in Apts', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(325242, '2019-10-09', '16:57:52', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-10-09', 'Clogged toilet main from Room #15', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(325573, '2019-10-16', '09:38:22', 'Service', 'Harold Mazo240-370-1099', '1900-01-01', '2019-10-13', 'Unit #112 is backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(325591, '2019-10-16', '11:17:41', 'Service', 'Lisa 240-4990469', '1900-01-01', '2019-10-16', 'Toilet in Unit #779 is backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(326205, '2019-10-25', '10:35:29', 'Service', 'Matt 240-330-8334', '1900-01-01', '2019-10-25', 'Water heater with booster we install in 337 is not keeping up temperature.', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '14 HVAC COMMERCIAL SERVICE', 'Billed', NULL, NULL, 1, 4),
(327704, '2019-11-09', '11:33:43', 'Service', 'William 240-499-9015', '1900-01-01', '2019-11-09', 'Apt #202 kitchen sink is overflowing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(327753, '2019-11-11', '11:06:37', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-11-11', 'Kitchen sink backed up in Unit #209', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(327922, '2019-11-13', '11:06:15', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-11-13', 'Toilet was backing up in Unit #756 but is now coming through the shower', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(327968, '2019-11-13', '15:43:54', 'Service', 'Lisa', '1900-01-01', '2019-11-13', 'unit 725 toilet backing up into shower leaking below', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Cancelled', NULL, NULL, 0, 0),
(328071, '2019-11-15', '09:09:09', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-11-18', 'Apt 337 water temp runs hot briefly then goes down to 75 degress', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '14 PLUMBING COMMERCIAL SERVICE', 'Billed', NULL, NULL, 1, 2),
(328227, '2019-11-18', '12:25:36', 'Service', 'Lisa 240-499-0469', '1900-01-01', '2019-11-18', 'back up in unit 226', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Cancelled', NULL, NULL, 0, 0),
(328505, '2019-11-21', '15:52:51', 'Service', 'Matt 240-330-8334', '1900-01-01', '1900-01-01', 'unit 614 kitchen sink backed up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Cancelled', NULL, NULL, 0, 0),
(330691, '2019-12-18', '17:07:21', 'PreventiveMaint', NULL, '2020-01-01', '2019-12-30', 'Basement & Loading Dock Interceptors Ejectors', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Cancelled', NULL, NULL, 0, 0),
(330945, '2019-12-19', '14:59:17', 'Service', 'Carlos Mayberry 240-370-4829', '1900-01-01', '2019-12-19', 'Backed up kitchen sink that needs to be snaked \r\nApt#405', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(331452, '2019-12-31', '08:48:51', 'PreventiveMaint', NULL, '2020-01-01', '2020-02-06', NULL, 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '14 Test backflow', 'Billed', NULL, NULL, 1, 39),
(331543, '2020-01-02', '11:14:16', 'Service', 'Harold Mavo 240-370-1099', '1900-01-01', '2020-01-01', 'The caller states kitchen sink is backed up\r\nUnit #507 \r\nAlt # 240-299-9022', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(332374, '2020-01-14', '17:25:19', 'PreventiveMaint', NULL, '2020-01-01', '2020-01-21', 'Scope of Work: A Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 16),
(332594, '2020-01-18', '10:03:33', 'Service', NULL, '1900-01-01', '2020-01-18', 'Onsite Harold, 340-370-1099             \r\nKitchen sink backing up in apt #404', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(333797, '2020-01-31', '10:12:28', 'Service', 'William 240-499-9015', '1900-01-01', '2020-01-30', 'Backed up sink in Apt. #429', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(333831, '2020-01-31', '14:14:39', 'PreventiveMaint', NULL, '2020-02-01', '2020-02-20', 'Scope of Work: B Multiple Pits & Power Washing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 26),
(335087, '2020-02-18', '16:59:45', 'PreventiveMaint', NULL, '2020-03-01', '2020-03-27', 'Scope of Work: B Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 11),
(335554, '2020-02-25', '13:06:42', 'Service', 'Lisa Brenner', '1900-01-01', '2020-03-10', 'Rebuild (3) backflows', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '14 Plumbing Comm Construction', 'Billed', NULL, NULL, 1, 4),
(335914, '2020-03-02', '12:36:42', 'Service', 'Matt 240-330-8334', '1900-01-01', '2020-03-02', 'Backed up kitchen sink\r\nAPT# 302', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 2),
(337609, '2020-03-20', '15:52:36', 'PreventiveMaint', NULL, '2020-04-01', '2020-04-28', 'Scope of Work: A Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 34),
(338409, '2020-04-04', '14:17:40', 'Service', 'Harold Mazo 240-370-1099', '1900-01-01', '2020-04-04', 'Units #202 & #226 kitchen sink backing up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 1),
(339219, '2020-04-22', '16:28:11', 'PreventiveMaint', NULL, '2020-05-01', '2020-05-26', 'Scope of Work: B Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 18),
(339550, '2020-04-30', '12:42:46', 'Service', 'Matthew 240-330-8334', '1900-01-01', '2020-04-30', 'Unit 520: kitchen sink back up', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Billed', NULL, NULL, 1, 4),
(340880, '2020-05-26', '16:41:37', 'PreventiveMaint', NULL, '2020-06-01', '2020-06-29', 'Scope of Work: B Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Billed', NULL, NULL, 1, 43),
(341696, '2020-06-05', '17:20:28', 'Service', '703408-7403', '1900-01-01', '2020-06-06', 'Clogged sink in the guest room', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Cleaning Service Work Order', 'Billed', NULL, NULL, 1, 2),
(341760, '2020-06-08', '10:28:26', 'Service', 'Lisa Brenner 240-499-0469', '1900-01-01', '2020-06-06', 'Clogged sink in the guest room', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Drain Clean Work Orders', 'Invoice Ready', NULL, NULL, 0, 0),
(343105, '2020-06-24', '16:55:47', 'PreventiveMaint', NULL, '2020-07-01', '1900-01-01', 'Scope of Work: A Multiple Pits & Powerwashing', 80916, 'Ingleside at King Farm', '701 King Farm Boulevard', 'Rockville', 'MD', 20850, '04 Ejector System Waste', 'Scheduled', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorders`
--
ALTER TABLE `workorders`
  ADD PRIMARY KEY (`WorkOrderId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
