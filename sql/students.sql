-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 04:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_student`
--

CREATE TABLE `add_student` (
  `rollno` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phoneno` bigint(20) NOT NULL,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `lang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_student`
--

INSERT INTO `add_student` (`rollno`, `name`, `gender`, `dob`, `address`, `phoneno`, `cid`, `sid`, `lang`) VALUES
(170101, 'Shashi', 'Male', '1999-12-11', 'Siddapura', 1234567890, 34, 31, 'SANSKRIT'),
(170151, 'Adarsha', 'Male', '1999-08-17', 'Trasi', 9141220022, 34, 32, 'KANNADA'),
(170401, 'Ramya', 'Female', '1999-10-17', 'Kandloor', 9141220022, 33, 30, 'HINDI'),
(180501, 'Joyston', 'Male', '2000-12-23', 'Hemmadi', 9889765246, 31, 28, 'KANNADA'),
(180601, 'Nishanth', 'Male', '2000-08-25', 'Udupi', 9141220022, 32, 29, 'SANSKRIT'),
(190201, 'Bhairav', 'Male', '2001-08-21', 'Udupi', 9141220033, 28, 26, 'KANNADA'),
(190301, 'Anjali', 'Female', '2001-10-12', 'Kundapura', 1234567890, 29, 27, 'HINDI');

-- --------------------------------------------------------

--
-- Table structure for table `manage_attend`
--

CREATE TABLE `manage_attend` (
  `rollno` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `scode` varchar(50) NOT NULL,
  `class_held` int(11) NOT NULL,
  `class_attend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_attend`
--

INSERT INTO `manage_attend` (`rollno`, `month`, `scode`, `class_held`, `class_attend`) VALUES
(190201, 'MARCH', 'BA101', 50, 48),
(190301, 'MARCH', 'BBM102', 60, 49),
(170401, 'MARCH', 'BCA105', 60, 52),
(180601, 'MARCH', 'BSC104', 50, 41),
(170101, 'MARCH', 'BCOM101', 50, 43),
(190201, 'APRIL', 'BBA103', 100, 23),
(190201, 'MARCH', 'BCOM101', 100, 34),
(190201, 'APRIL', 'BA101', 100, 100),
(190301, 'APRIL', 'BBM102', 100, 100),
(180501, 'APRIL', 'BBA103', 100, 10);

-- --------------------------------------------------------

--
-- Table structure for table `manage_course`
--

CREATE TABLE `manage_course` (
  `cid` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `sem` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_course`
--

INSERT INTO `manage_course` (`cid`, `year`, `sem`, `course`) VALUES
(28, 'FIRST', 'I', 'BA'),
(29, 'FIRST', 'II', 'BBM'),
(31, 'SECOND', 'III', 'BBA'),
(32, 'SECOND', 'IV', 'BSC/MPCS'),
(33, 'THIRD', 'V', 'BCA'),
(34, 'THIRD', 'VI', 'BCOM');

-- --------------------------------------------------------

--
-- Table structure for table `manage_exam`
--

CREATE TABLE `manage_exam` (
  `examid` int(11) NOT NULL,
  `ename` varchar(50) NOT NULL,
  `edate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_exam`
--

INSERT INTO `manage_exam` (`examid`, `ename`, `edate`) VALUES
(20, 'FIRST_INTERNAL', '2020-03-19'),
(21, 'SECOND_INTERNAL', '2020-04-02'),
(22, 'SEMESTER', '2020-04-23'),
(23, 'SECOND_INTERNAL', '2020-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `manage_marks`
--

CREATE TABLE `manage_marks` (
  `rollno` int(11) NOT NULL,
  `examid` int(11) NOT NULL,
  `scode` varchar(50) NOT NULL,
  `max_marks` int(11) NOT NULL,
  `marks_obtain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_marks`
--

INSERT INTO `manage_marks` (`rollno`, `examid`, `scode`, `max_marks`, `marks_obtain`) VALUES
(190201, 20, 'BA101', 25, 20),
(190301, 20, 'BBM102', 25, 18),
(180601, 20, 'BSC104', 25, 15),
(170401, 20, 'BCA105', 25, 25),
(170101, 20, 'BCOM101', 25, 22),
(190201, 20, 'BSC104', 100, 30),
(190201, 21, 'BCA105', 100, 78),
(190201, 21, 'BCOM101', 20, 15),
(190201, 23, 'BCOM101', 100, 32),
(190201, 23, 'BBA103', 166, 66),
(190301, 21, 'BBM102', 100, 100),
(180501, 22, 'BBA103', 100, 78);

-- --------------------------------------------------------

--
-- Table structure for table `manage_section`
--

CREATE TABLE `manage_section` (
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_section`
--

INSERT INTO `manage_section` (`sid`, `cid`, `section`) VALUES
(26, 28, 'A'),
(27, 29, 'A'),
(28, 31, 'A'),
(29, 32, 'A'),
(30, 33, 'A'),
(31, 34, 'A'),
(32, 34, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `manage_sub`
--

CREATE TABLE `manage_sub` (
  `scode` varchar(50) NOT NULL,
  `cid` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_sub`
--

INSERT INTO `manage_sub` (`scode`, `cid`, `sname`) VALUES
('BA101', 28, 'ENGLISH'),
('BBA103', 31, 'KANNADA'),
('BBM102', 29, 'HINDI'),
('BCA105', 33, 'SOFTWARE ENGINEERING'),
('BCOM101', 34, 'ENGLISH'),
('BSC104', 32, 'SANSKRIT');

-- --------------------------------------------------------

--
-- Table structure for table `manage_user`
--

CREATE TABLE `manage_user` (
  `lid` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `scode` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_user`
--

INSERT INTO `manage_user` (`lid`, `lname`, `pass`, `type`, `cid`, `sid`, `scode`) VALUES
('L101', 'Suresh', '123', 'Academic Advisor', 28, 26, NULL),
('L102', 'Ramesh', '123', 'Academic Advisor', 31, 28, NULL),
('L103', 'Ganesh', '123', 'Academic Advisor', 33, 30, NULL),
('L104', 'Nishanth', '123', 'Subject Lecturer', NULL, NULL, 'BA101,BBA103,'),
('L105', 'Shashidhar', '123', 'Subject Lecturer', NULL, NULL, 'BBM102,'),
('L106', 'Vinay', '123', 'Subject Lecturer', NULL, NULL, 'BBA103,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_student`
--
ALTER TABLE `add_student`
  ADD PRIMARY KEY (`rollno`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `manage_attend`
--
ALTER TABLE `manage_attend`
  ADD KEY `rollno` (`rollno`),
  ADD KEY `scode` (`scode`);

--
-- Indexes for table `manage_course`
--
ALTER TABLE `manage_course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `manage_exam`
--
ALTER TABLE `manage_exam`
  ADD PRIMARY KEY (`examid`);

--
-- Indexes for table `manage_marks`
--
ALTER TABLE `manage_marks`
  ADD KEY `rollno` (`rollno`),
  ADD KEY `examid` (`examid`),
  ADD KEY `scode` (`scode`);

--
-- Indexes for table `manage_section`
--
ALTER TABLE `manage_section`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `manage_sub`
--
ALTER TABLE `manage_sub`
  ADD PRIMARY KEY (`scode`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `manage_user`
--
ALTER TABLE `manage_user`
  ADD PRIMARY KEY (`lid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `sid` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manage_course`
--
ALTER TABLE `manage_course`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `manage_exam`
--
ALTER TABLE `manage_exam`
  MODIFY `examid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `manage_section`
--
ALTER TABLE `manage_section`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_student`
--
ALTER TABLE `add_student`
  ADD CONSTRAINT `add_student_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `manage_course` (`cid`),
  ADD CONSTRAINT `add_student_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `manage_course` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `add_student_ibfk_3` FOREIGN KEY (`sid`) REFERENCES `manage_section` (`sid`) ON DELETE CASCADE;

--
-- Constraints for table `manage_attend`
--
ALTER TABLE `manage_attend`
  ADD CONSTRAINT `manage_attend_ibfk_1` FOREIGN KEY (`rollno`) REFERENCES `add_student` (`rollno`) ON DELETE CASCADE,
  ADD CONSTRAINT `manage_attend_ibfk_2` FOREIGN KEY (`scode`) REFERENCES `manage_sub` (`scode`) ON DELETE CASCADE;

--
-- Constraints for table `manage_marks`
--
ALTER TABLE `manage_marks`
  ADD CONSTRAINT `manage_marks_ibfk_1` FOREIGN KEY (`rollno`) REFERENCES `add_student` (`rollno`) ON DELETE CASCADE,
  ADD CONSTRAINT `manage_marks_ibfk_2` FOREIGN KEY (`examid`) REFERENCES `manage_exam` (`examid`) ON DELETE CASCADE,
  ADD CONSTRAINT `manage_marks_ibfk_3` FOREIGN KEY (`scode`) REFERENCES `manage_sub` (`scode`) ON DELETE CASCADE;

--
-- Constraints for table `manage_section`
--
ALTER TABLE `manage_section`
  ADD CONSTRAINT `manage_section_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `manage_course` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `manage_sub`
--
ALTER TABLE `manage_sub`
  ADD CONSTRAINT `manage_sub_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `manage_course` (`cid`) ON DELETE CASCADE;

--
-- Constraints for table `manage_user`
--
ALTER TABLE `manage_user`
  ADD CONSTRAINT `manage_user_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `manage_course` (`cid`) ON DELETE CASCADE,
  ADD CONSTRAINT `manage_user_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `manage_section` (`sid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
