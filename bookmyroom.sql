-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2020 at 03:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookmyroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `username`, `password`) VALUES
(1, 'Kheni', '123');

-- --------------------------------------------------------

--
-- Table structure for table `holls`
--

CREATE TABLE `holls` (
  `hollID` int(50) NOT NULL,
  `vendarID` int(50) NOT NULL,
  `hollIMG` varchar(255) NOT NULL,
  `hollstatus` char(6) NOT NULL,
  `hollholdername` varchar(255) NOT NULL,
  `hollholdernumber` int(10) NOT NULL,
  `persons` varchar(255) NOT NULL,
  `bookdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `holls`
--

INSERT INTO `holls` (`hollID`, `vendarID`, `hollIMG`, `hollstatus`, `hollholdername`, `hollholdernumber`, `persons`, `bookdate`) VALUES
(2, 1, 'Screenshot (2).png', 'unbook', '', 0, 'Less then 100', ''),
(3, 1, 'Screenshot (2).png', 'Unbook', '', 0, 'Lass then 300', ''),
(5, 1, 'Screenshot (2).png', 'Unbook', '', 0, 'Lass then 200', '');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomID` int(100) NOT NULL,
  `roomIMG` varchar(255) NOT NULL,
  `roomstatus` varchar(255) NOT NULL,
  `roomholder` varchar(255) NOT NULL,
  `holdernumber` int(10) NOT NULL,
  `capacity` varchar(4) NOT NULL,
  `persons` int(1) NOT NULL,
  `bookdate` varchar(255) NOT NULL,
  `enddate` varchar(255) NOT NULL,
  `vendarID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomID`, `roomIMG`, `roomstatus`, `roomholder`, `holdernumber`, `capacity`, `persons`, `bookdate`, `enddate`, `vendarID`) VALUES
(8, 'Screenshot (4).png', 'unbook', '', 0, '3', 0, '', '', 2),
(11, 'Screenshot (3).png', 'unbook', '', 0, '2', 0, '', '', 2),
(12, 'Screenshot (3).png', 'unbook', '', 0, '3', 0, '', '', 2),
(14, '24UScreenshot (5).png', 'booked', 'Rutvik', 2147483647, '5', 6, '2020-12-24', '2020-12-25', 1),
(20, 'Screenshot (3).png', 'unbook', '', 0, '2', 0, '', '', 1),
(21, 'Screenshot (3).png', 'Unbook', '', 0, '2', 0, '', '', 1),
(27, 'Screenshot (4).png', 'unbook', '', 0, '2', 0, '', '', 1),
(28, 'Screenshot (4).png', 'unbook', '', 0, 'Lass', 0, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobileno` int(10) NOT NULL,
  `gender` char(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `mobileno`, `gender`, `username`, `password`, `status`) VALUES
(1, 'rutvik', 265225, 'M', 'rutvik', '123', 'Lock'),
(2, 'khenirutvik', 458985, 'M', 'kheninilu97@gmail.com', '123', 'lock'),
(3, 'khenirutvik', 47894, 'F', 'kheninilu', '123', 'lock'),
(4, 'khenirutvik', 4894988, 'M', 'meetsborad123@gmail.com', '123', 'lock');

-- --------------------------------------------------------

--
-- Table structure for table `vendar`
--

CREATE TABLE `vendar` (
  `vendarID` int(50) NOT NULL,
  `hotalname` varchar(255) NOT NULL,
  `hotallocation` varchar(255) NOT NULL,
  `hotallogo` varchar(255) NOT NULL,
  `vusername` varchar(255) NOT NULL,
  `vpassword` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `vendarname` varchar(255) DEFAULT NULL,
  `vendarmobileno` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendar`
--

INSERT INTO `vendar` (`vendarID`, `hotalname`, `hotallocation`, `hotallogo`, `vusername`, `vpassword`, `status`, `vendarname`, `vendarmobileno`) VALUES
(1, 'PrimeEe', 'suratT', '24UScreenshot (5).png', 'rutvik', '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq', 1, 'rutvikK', 554565);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `holls`
--
ALTER TABLE `holls`
  ADD PRIMARY KEY (`hollID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `vendar`
--
ALTER TABLE `vendar`
  ADD PRIMARY KEY (`vendarID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holls`
--
ALTER TABLE `holls`
  MODIFY `hollID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vendar`
--
ALTER TABLE `vendar`
  MODIFY `vendarID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
