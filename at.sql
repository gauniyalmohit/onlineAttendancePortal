-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2017 at 06:35 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `at`
--

-- --------------------------------------------------------

--
-- Table structure for table `cs_5_c#`
--

CREATE TABLE IF NOT EXISTS `cs_5_c#` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_c#`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_5_cns`
--

CREATE TABLE IF NOT EXISTS `cs_5_cns` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_cns`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_5_cnt`
--

CREATE TABLE IF NOT EXISTS `cs_5_cnt` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_cnt`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_5_dbp`
--

CREATE TABLE IF NOT EXISTS `cs_5_dbp` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_dbp`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_5_mp`
--

CREATE TABLE IF NOT EXISTS `cs_5_mp` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_mp`
--

INSERT INTO `cs_5_mp` (`date`, `day`, `day_status`, `14006050015`, `14006050016`, `14006050017`, `1400605001`, `1400605002`, `1400605003`, `1400605005`) VALUES
('2017-01-10', 'Tue', 'workday', 'p', 'p', 'a', 'a', 'p', 'a', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `cs_5_ns`
--

CREATE TABLE IF NOT EXISTS `cs_5_ns` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_ns`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_5_sqt`
--

CREATE TABLE IF NOT EXISTS `cs_5_sqt` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `14006050015` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050016` varchar(2) NOT NULL DEFAULT 'NA',
  `14006050017` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605001` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605002` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605003` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605005` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_5_sqt`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_cg`
--

CREATE TABLE IF NOT EXISTS `cs_6_cg` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_cg`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_dwm`
--

CREATE TABLE IF NOT EXISTS `cs_6_dwm` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_dwm`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_edm`
--

CREATE TABLE IF NOT EXISTS `cs_6_edm` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_edm`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_es`
--

CREATE TABLE IF NOT EXISTS `cs_6_es` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_es`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_java`
--

CREATE TABLE IF NOT EXISTS `cs_6_java` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_java`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_mc`
--

CREATE TABLE IF NOT EXISTS `cs_6_mc` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_mc`
--


-- --------------------------------------------------------

--
-- Table structure for table `cs_6_ost`
--

CREATE TABLE IF NOT EXISTS `cs_6_ost` (
  `date` date NOT NULL,
  `day` varchar(15) NOT NULL,
  `day_status` varchar(15) NOT NULL,
  `1400605006` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605007` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605008` varchar(2) NOT NULL DEFAULT 'NA',
  `1400605009` varchar(2) NOT NULL DEFAULT 'NA',
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cs_6_ost`
--

INSERT INTO `cs_6_ost` (`date`, `day`, `day_status`, `1400605006`, `1400605007`, `1400605008`, `1400605009`) VALUES
('2017-01-10', 'Tue', 'workday', 'a', 'a', 'p', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE IF NOT EXISTS `holiday` (
  `sno` int(3) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `day` varchar(20) NOT NULL,
  `by` varchar(50) NOT NULL,
  `for` varchar(2000) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=131 ;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`sno`, `date`, `day`, `by`, `for`) VALUES
(130, '2069-12-31', 'Wed', 'Anudeep gusain', 'it_5_rdbms');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `teacher_branch` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `role`, `teacher_branch`) VALUES
('gpdehradun', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'principal', ''),
('abhitesh', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'hod', 'computer_science'),
('anudeep', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'teacher', 'computer_science'),
('deepak', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'teacher', 'information_technology'),
('sunit', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'teacher', 'information_technology'),
('meenu', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'hod', 'information_technology');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `roll_number` bigint(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` int(2) NOT NULL,
  PRIMARY KEY (`roll_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`roll_number`, `name`, `dob`, `branch`, `semester`) VALUES
(1400605009, 'kajal', '2017-01-10', 'computer_science', 6),
(1400605001, 'charu negi', '2017-01-10', 'computer_science', 5),
(1400605002, 'smriti', '2017-01-10', 'computer_science', 5),
(1400605003, 'sunidhi', '2017-01-10', 'computer_science', 5),
(1400605005, 'vishal', '2017-01-10', 'computer_science', 5),
(1400605006, 'govind', '2017-01-10', 'computer_science', 6),
(1400605007, 'reshabh', '2017-01-10', 'computer_science', 6),
(1400605008, 'sachin', '2017-01-07', 'computer_science', 6),
(14006050015, 'mohit gauniyal ', '2017-01-10', 'computer_science', 5),
(14006050016, 'asad', '2017-01-10', 'computer_science', 5),
(14006050017, 'neeraj', '2017-01-10', 'computer_science', 5);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `username` varchar(50) NOT NULL,
  `subject_id` varchar(50) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `semester` int(2) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`username`, `subject_id`, `subject_name`, `teacher_name`, `photo`, `branch`, `semester`) VALUES
('gpdehradun', '', '', 'A.k.saxena', 'img_avatar3.png', '', 0),
('abhitesh', 'cs_3_oop', 'C++', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 3),
('abhitesh', 'cs_4_ds', 'Data structure (CS)', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 4),
('meenu', 'cs_5_sqt', 'SQT(CS)', 'Meenu bijwan', 'img_avatar3.png', 'computer_science', 5),
('sunit', 'it_4_ds', 'Data structure (IT)', 'Sunit', 'img_avatar3.png', 'information_technology', 4),
('deepak', 'it_5_java', 'java', 'Deepak negi', 'img_avatar3.png', 'information_technology', 5),
('abhitesh', 'cs_5_mp', 'Microprocessor', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 5),
('anudeep', 'it_5_rdbms', 'RDBMS (IT)', 'Anudeep gusain', 'img_avatar3.png', 'information_technology', 5),
('sunit', 'cs_5_ns', 'Network security', 'Sunit', 'img_avatar3.png', 'computer_science', 5),
('meenu', 'it_5_sqt', 'SQT (IT)', 'Meenu bijwan', 'img_avatar3.png', 'information_technology', 5),
('anudeep', 'cs_3_pic', 'Programming in C ( CS )', 'Anudeep gusain', 'img_avatar3.png', 'computer_science', 3),
('anudeep', 'it_3_pic', 'Programming in C ( IT )', 'Anudeep gusain', 'img_avatar3.png', 'information_technology', 3),
('sunit', 'cs_3_csp', 'CSP', 'Sunit', 'img_avatar3.png', 'information_technology', 3),
('sunit', 'cs_3_ddc', 'DDC', 'Sunit', 'img_avatar3.png', 'information_technology', 3),
('abhitesh', 'cs_3_os', 'Operating Systems', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 3),
('abhitesh', 'it_3_os', 'Operating Systems', 'Abhitesh mohan', 'img_avatar3.png', 'information_technology', 3),
('sunit', 'cs_4_wt', 'Web Technologies', 'Sunit', 'img_avatar3.png', 'computer_science', 4),
('abhitesh', 'cs_4_coa', 'CSOA', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 4),
('anudeep', 'cs_4_dbms', 'DBMS', 'Anudeep gusain', 'img_avatar3.png', 'computer_science', 4),
('anudeep', 'cs_4_sse', 'SSE', 'Anudeep gusain', 'img_avatar3.png', 'computer_science', 4),
('sunit', 'cs_4_cn', 'Computer Networks', 'Sunit', 'img_avatar3.png', 'computer_science', 4),
('deepak', 'cs_5_dbp', 'DB programming', 'Deepak negi', 'img_avatar3.png', 'computer_science', 5),
('deepak', 'cs_5_c#', 'C#.NET', 'Deepak negi', 'img_avatar3.png', 'computer_science', 5),
('sunit', 'cs_5_cnt', 'CNT', 'Sunit', 'img_avatar3.png', 'computer_science', 5),
('sunit', 'cs_5_cns', 'CNS (CS)', 'Sunit', 'img_avatar3.png', 'computer_science', 5),
('deepak', 'cs_6_java', 'JAVA', 'Deepak negi', 'img_avatar3.png', 'computer_science', 6),
('abhitesh', 'cs_6_cg', 'Computer Graphics', 'Abhitesh mohan', 'img_avatar3.png', 'computer_science', 6),
('sunit', 'cs_6_dwm', 'DWM', 'Sunit', 'img_avatar3.png', 'computer_science', 6),
('anudeep', 'cs_6_ost', 'Open source tech.', 'Anudeep gusain', 'img_avatar3.png', 'computer_science', 6),
('sunit', 'cs_6_mc', 'Mobile computing', 'Sunit', 'img_avatar3.png', 'computer_science', 6),
('anudeep', 'cs_6_edm', 'EDM', 'Anudeep gusain', 'img_avatar3.png', 'computer_science', 6),
('sunit', 'cs_6_es', 'Employable skills', 'Sunit', 'img_avatar3.png', 'computer_science', 6),
('sunit', 'it_5_cns', 'CNS (IT)', 'Sunit', 'img_avatar3.png', 'information_technology', 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
