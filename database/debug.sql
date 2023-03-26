-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2018 at 01:02 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `debug`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `last_login`) VALUES
(4, 'admin', 'admin', '2018-12-07 07:15:22'),
(5, 'jayson', 'jayson', '2018-12-07 07:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `quiz_id`, `question_id`, `answer`, `correct`) VALUES
(13, 1, 4, 'simuno ', '1'),
(14, 1, 4, 'tuwirang layon', '0'),
(15, 1, 4, 'di tuwiran layon', '0'),
(16, 1, 4, 'panaguri', '0'),
(17, 1, 5, 'Sintaksis', '1'),
(18, 1, 5, 'Skimming', '0'),
(19, 1, 5, 'Sesura', '0'),
(20, 1, 5, 'Sukat', '0'),
(21, 1, 6, 'pang abay', '1'),
(22, 1, 6, 'panaguri', '0'),
(23, 1, 6, 'pautos', '0'),
(24, 1, 6, 'patanong', '0'),
(25, 1, 7, 'Patanong', '1'),
(26, 1, 7, 'Pautos', '0'),
(27, 1, 7, 'Padamdam', '0'),
(28, 1, 7, 'Panaguri', '0'),
(29, 1, 8, 'I''m not', '1'),
(30, 1, 8, 'I don''t', '0'),
(31, 1, 8, 'I isn''t', '0'),
(32, 1, 8, 'I can''t', '0');

-- --------------------------------------------------------

--
-- Table structure for table `enrolment_login`
--

CREATE TABLE IF NOT EXISTS `enrolment_login` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `enrolment_login`
--

INSERT INTO `enrolment_login` (`id`, `username`, `password`, `type`) VALUES
(4, 'a', '0cc175b9c0f1b6a831c399e269772661', 'Enrolment');

-- --------------------------------------------------------

--
-- Table structure for table `exam_user`
--

CREATE TABLE IF NOT EXISTS `exam_user` (
  `ID` int(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `exam_user`
--

INSERT INTO `exam_user` (`ID`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'reonel', 'domingo', 'placido'),
(8, 'darel', 'tayamin', 'aguinaldo'),
(11, 'ethel', 'alvarez', 'domingo'),
(12, 'albert', 'anciado ', 'tolentino'),
(13, 'kyle', 'anciado ', 'tolentino'),
(15, 'ryoji', 'anciado ', 'tolentino'),
(16, 'ron', 'tolentino', 'roque'),
(17, 'arlene', 'domingo', 'placido');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `code` varchar(9999) NOT NULL,
  `code_type` varchar(30) NOT NULL,
  `type` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_id`, `question`, `code`, `code_type`, `type`) VALUES
(4, 1, 4, 'Tumatanggap ng kilos sa isang pangungusap ', '', '', 'mc'),
(5, 1, 5, 'Pahapyaw na pagbasa?', '', '', 'mc'),
(6, 1, 6, 'ano ang tawag sa pangungusap na nag uutos?', '', '', 'mc'),
(7, 1, 7, 'Ano ang tawag sa pangugusap na nagtatanong?', '', '', 'mc'),
(8, 1, 8, 'Anna: Are you Spanish? Marco: No, _________', '', '', 'mc');

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

CREATE TABLE IF NOT EXISTS `quizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `display_questions` int(11) NOT NULL,
  `time_allotted` int(11) NOT NULL,
  `set_default` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quizes`
--

INSERT INTO `quizes` (`id`, `quiz_id`, `quiz_name`, `total_questions`, `display_questions`, `time_allotted`, `set_default`) VALUES
(1, 1, 'ISU Entrance Exam', 5, 100, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_takers`
--

CREATE TABLE IF NOT EXISTS `quiz_takers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `percentage` varchar(24) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `quiz_takers`
--

INSERT INTO `quiz_takers` (`id`, `username`, `quiz_id`, `marks`, `percentage`, `date_time`, `duration`) VALUES
(7, 'Reonel Placido', 1, 5, '38.461538461538', '2018-11-19 09:08:19', 23),
(8, 'Marvin Pascual', 1, 2, '15.384615384615', '2018-11-19 09:13:01', 25),
(9, 'Jhonald Fernandez', 1, 5, '38.461538461538', '2018-11-19 09:17:30', 20),
(10, 'Ashley Jones Bulan', 1, 3, '23.076923076923', '2018-11-19 09:40:47', 66),
(11, 'Darel Aguinaldo', 1, 6, '46.153846153846', '2018-11-19 09:55:12', 26),
(12, 'Joan Reyes', 1, 4, '30.769230769231', '2018-11-23 21:09:44', 65),
(15, 'John Joseph Ortal', 1, 1, '7.6923076923077', '2018-11-26 08:52:22', 29);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
