 
--  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
--	wizGrade V 1.2 (Formerly SDOSMS) is Designed & Developed by Igweze Ebele Mark | https://www.iem.wizgrade.com
--	https://www.wizgrade.com
--	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 	
--	Copyright 2014 - 2020 c wizGrade | IGWEZE EBELE MARK 
	
--	Licensed under the Apache License, Version 2.0 (the 'License');
--	you may not use this file except in compliance with the License.
--	You may obtain a copy of the License at

--		http://www.apache.org/licenses/LICENSE-2.0

--	Unless required by applicable law or agreed to in writing, software
--	distributed under the License is distributed on an 'AS IS' BASIS,
--	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
--	See the License for the specific language governing permissions and
--	limitations under the License	
--	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
--	wizGrade School App is Dedicated To Almighty God, My Amazing Parents ENGR Mr & Mrs Igweze Okwudili Godwin, 
--	To My Fabulous and Supporting Wife Mrs Igweze Nkiruka Jennifer
--	and To My Inestimable Sons Osinachi Michael, Ifechukwu Othniel and Naetochukwu Ryan.  
	
--	WEBSITE 					PHONES												EMAILS
--	https://www.wizgrade.com	+234 - 80 - 30 716 751, +234 - 80 - 22 000 490 		info@wizgrade.com	
	
	
--	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~Page/Code Explanation~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
--	wizGrade School App Database
--	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	
-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: July 05, 2020 at 11:44 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8	
	
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wizgrade`
--
 
-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_assignment`
--

CREATE TABLE `nur_wizgrade_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_assign_questions`
--

CREATE TABLE `nur_wizgrade_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class`
--

CREATE TABLE `nur_wizgrade_class` (
  `cl_id` int(3) NOT NULL PRIMARY KEY,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nur_wizgrade_class`
--

INSERT INTO `nur_wizgrade_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'Nursery 1', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1'),
(2, 'Nursery 2', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1'),
(3, 'Nursery 3', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_comment`
--

CREATE TABLE `nur_wizgrade_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_grade`
--

CREATE TABLE `nur_wizgrade_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_grand_score`
--

CREATE TABLE `nur_wizgrade_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_remark`
--

CREATE TABLE `nur_wizgrade_class_one_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_score`
--

CREATE TABLE `nur_wizgrade_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_one_sub_score`
--

CREATE TABLE `nur_wizgrade_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_comment`
--

CREATE TABLE `nur_wizgrade_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_grade`
--

CREATE TABLE `nur_wizgrade_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_grand_score`
--

CREATE TABLE `nur_wizgrade_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_remark`
--

CREATE TABLE `nur_wizgrade_class_three_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_score`
--

CREATE TABLE `nur_wizgrade_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_three_sub_score`
--

CREATE TABLE `nur_wizgrade_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_comment`
--

CREATE TABLE `nur_wizgrade_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_grade`
--

CREATE TABLE `nur_wizgrade_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_grand_score`
--

CREATE TABLE `nur_wizgrade_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_remark`
--

CREATE TABLE `nur_wizgrade_class_two_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_score`
--

CREATE TABLE `nur_wizgrade_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_class_two_sub_score`
--

CREATE TABLE `nur_wizgrade_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_config_rs`
--

CREATE TABLE `nur_wizgrade_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_daily_comments`
--

CREATE TABLE `nur_wizgrade_daily_comments` (
  `rID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text,
  `attendance` enum('0','1','2','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_exams`
--

CREATE TABLE `nur_wizgrade_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_exams_config`
--

CREATE TABLE `nur_wizgrade_exams_config` (
  `ex_id` tinyint(3) NOT NULL PRIMARY KEY,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nur_wizgrade_exams_config`
--

INSERT INTO `nur_wizgrade_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 0, NULL, NULL, NULL, 80, '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_exam_ans`
--

CREATE TABLE `nur_wizgrade_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_exam_questions`
--

CREATE TABLE `nur_wizgrade_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_form_teachers`
--

CREATE TABLE `nur_wizgrade_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_hostel`
--

CREATE TABLE `nur_wizgrade_hostel` (
  `h_id` smallint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_jss_class_repeat`
--

CREATE TABLE `nur_wizgrade_jss_class_repeat` (
  `id_jrp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_regno`
--

CREATE TABLE `nur_wizgrade_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_sss_class_repeat`
--

CREATE TABLE `nur_wizgrade_sss_class_repeat` (
  `id_srp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_student_record`
--

CREATE TABLE `nur_wizgrade_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(20) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(50) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `secuinfo` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nur_wizgrade_timetb`
--

CREATE TABLE `nur_wizgrade_timetb` (
  `tID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_assignment`
--

CREATE TABLE `pri_wizgrade_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_assign_questions`
--

CREATE TABLE `pri_wizgrade_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class`
--

CREATE TABLE `pri_wizgrade_class` (
  `cl_id` int(3) NOT NULL PRIMARY KEY,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pri_wizgrade_class`
--

INSERT INTO `pri_wizgrade_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'Primary 1', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1'),
(2, 'Primary 2', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1'),
(3, 'Primary 3', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, NULL, '1'),
(4, 'Primary 4', 'a:7:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";i:5;s:1:"F";i:6;s:1:"G";}', 'a:7:{i:0;s:1:"4";i:1;s:1:"4";i:2;s:1:"4";i:3;s:1:"4";i:4;s:1:"4";i:5;s:1:"4";i:6;s:1:"4";}', NULL, '2'),
(5, 'Primary 5', 'a:4:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";}', 'a:4:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}', NULL, '2'),
(6, 'Primary 6', 'a:4:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";}', 'a:4:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_comment`
--

CREATE TABLE `pri_wizgrade_class_five_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_grade`
--

CREATE TABLE `pri_wizgrade_class_five_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_grand_score`
--

CREATE TABLE `pri_wizgrade_class_five_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fif` smallint(10) DEFAULT NULL,
  `jemji_gr_fif` float DEFAULT NULL,
  `jemji_po_fif` tinyint(5) DEFAULT NULL,
  `jiemj_to_fif` smallint(10) DEFAULT NULL,
  `jiemj_gr_fif` float DEFAULT NULL,
  `jiemj_po_fif` tinyint(5) DEFAULT NULL,
  `jmeji_to_fif` smallint(10) DEFAULT NULL,
  `jmeji_gr_fif` float DEFAULT NULL,
  `jmeji_po_fif` tinyint(5) DEFAULT NULL,
  `jgrand_to_fif` smallint(10) DEFAULT NULL,
  `jgrand_gr_fif` float DEFAULT NULL,
  `jgrand_po_fif` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_remark`
--

CREATE TABLE `pri_wizgrade_class_five_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_score`
--

CREATE TABLE `pri_wizgrade_class_five_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_five_sub_score`
--

CREATE TABLE `pri_wizgrade_class_five_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_comment`
--

CREATE TABLE `pri_wizgrade_class_four_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_grade`
--

CREATE TABLE `pri_wizgrade_class_four_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_grand_score`
--

CREATE TABLE `pri_wizgrade_class_four_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fo` smallint(10) DEFAULT NULL,
  `jemji_gr_fo` float DEFAULT NULL,
  `jemji_po_fo` tinyint(5) DEFAULT NULL,
  `jiemj_to_fo` smallint(10) DEFAULT NULL,
  `jiemj_gr_fo` float DEFAULT NULL,
  `jiemj_po_fo` tinyint(5) DEFAULT NULL,
  `jmeji_to_fo` smallint(10) DEFAULT NULL,
  `jmeji_gr_fo` float DEFAULT NULL,
  `jmeji_po_fo` tinyint(5) DEFAULT NULL,
  `jgrand_to_fo` smallint(10) DEFAULT NULL,
  `jgrand_gr_fo` float DEFAULT NULL,
  `jgrand_po_fo` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_remark`
--

CREATE TABLE `pri_wizgrade_class_four_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_score`
--

CREATE TABLE `pri_wizgrade_class_four_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_four_sub_score`
--

CREATE TABLE `pri_wizgrade_class_four_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_comment`
--

CREATE TABLE `pri_wizgrade_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_grade`
--

CREATE TABLE `pri_wizgrade_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_grand_score`
--

CREATE TABLE `pri_wizgrade_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_remark`
--

CREATE TABLE `pri_wizgrade_class_one_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_score`
--

CREATE TABLE `pri_wizgrade_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_one_sub_score`
--

CREATE TABLE `pri_wizgrade_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_comment`
--

CREATE TABLE `pri_wizgrade_class_six_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_grade`
--

CREATE TABLE `pri_wizgrade_class_six_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_grand_score`
--

CREATE TABLE `pri_wizgrade_class_six_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_six` smallint(10) DEFAULT NULL,
  `jemji_gr_six` float DEFAULT NULL,
  `jemji_po_six` tinyint(5) DEFAULT NULL,
  `jiemj_to_six` smallint(10) DEFAULT NULL,
  `jiemj_gr_six` float DEFAULT NULL,
  `jiemj_po_six` tinyint(5) DEFAULT NULL,
  `jmeji_to_six` smallint(10) DEFAULT NULL,
  `jmeji_gr_six` float DEFAULT NULL,
  `jmeji_po_six` tinyint(5) DEFAULT NULL,
  `jgrand_to_six` smallint(10) DEFAULT NULL,
  `jgrand_gr_six` float DEFAULT NULL,
  `jgrand_po_six` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_remark`
--

CREATE TABLE `pri_wizgrade_class_six_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_score`
--

CREATE TABLE `pri_wizgrade_class_six_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_six_sub_score`
--

CREATE TABLE `pri_wizgrade_class_six_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_comment`
--

CREATE TABLE `pri_wizgrade_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_grade`
--

CREATE TABLE `pri_wizgrade_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_grand_score`
--

CREATE TABLE `pri_wizgrade_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_remark`
--

CREATE TABLE `pri_wizgrade_class_three_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_score`
--

CREATE TABLE `pri_wizgrade_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_three_sub_score`
--

CREATE TABLE `pri_wizgrade_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_comment`
--

CREATE TABLE `pri_wizgrade_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_grade`
--

CREATE TABLE `pri_wizgrade_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_grand_score`
--

CREATE TABLE `pri_wizgrade_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_remark`
--

CREATE TABLE `pri_wizgrade_class_two_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_score`
--

CREATE TABLE `pri_wizgrade_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_class_two_sub_score`
--

CREATE TABLE `pri_wizgrade_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_config_rs`
--

CREATE TABLE `pri_wizgrade_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_daily_comments`
--

CREATE TABLE `pri_wizgrade_daily_comments` (
  `rID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text,
  `attendance` enum('0','1','2','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_exams`
--

CREATE TABLE `pri_wizgrade_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_exams_config`
--

CREATE TABLE `pri_wizgrade_exams_config` (
  `ex_id` tinyint(3) NOT NULL PRIMARY KEY,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pri_wizgrade_exams_config`
--

INSERT INTO `pri_wizgrade_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 10, NULL, NULL, NULL, 70, '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_exam_ans`
--

CREATE TABLE `pri_wizgrade_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_exam_questions`
--

CREATE TABLE `pri_wizgrade_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_form_teachers`
--

CREATE TABLE `pri_wizgrade_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_hostel`
--

CREATE TABLE `pri_wizgrade_hostel` (
  `h_id` smallint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_jss_class_repeat`
--

CREATE TABLE `pri_wizgrade_jss_class_repeat` (
  `id_jrp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_regno`
--

CREATE TABLE `pri_wizgrade_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `class_4` varchar(10) DEFAULT NULL,
  `class_5` varchar(10) DEFAULT NULL,
  `class_6` varchar(10) DEFAULT NULL,
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_sss_class_repeat`
--

CREATE TABLE `pri_wizgrade_sss_class_repeat` (
  `id_srp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_student_record`
--

CREATE TABLE `pri_wizgrade_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(20) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(50) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `secuinfo` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pri_wizgrade_timetb`
--

CREATE TABLE `pri_wizgrade_timetb` (
  `tID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_assignment`
--

CREATE TABLE `sec_wizgrade_assignment` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `dDate` date DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_assign_questions`
--

CREATE TABLE `sec_wizgrade_assign_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class`
--

CREATE TABLE `sec_wizgrade_class` (
  `cl_id` int(3) NOT NULL PRIMARY KEY,
  `level` varchar(30) NOT NULL,
  `class` varchar(256) DEFAULT NULL,
  `class_type` varchar(256) DEFAULT NULL,
  `minCourse` varchar(5) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sec_wizgrade_class`
--

INSERT INTO `sec_wizgrade_class` (`cl_id`, `level`, `class`, `class_type`, `minCourse`, `status`) VALUES
(1, 'JSS 1', 'a:6:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";i:5;s:1:"F";}', NULL, '9', '1'),
(2, 'JSS 2', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, '8', '1'),
(3, 'JSS 3', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', NULL, 'All', '1'),
(4, 'SSS 1', 'a:7:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";i:5;s:1:"F";i:6;s:1:"G";}', 'a:7:{i:0;s:1:"4";i:1;s:1:"4";i:2;s:1:"4";i:3;s:1:"4";i:4;s:1:"4";i:5;s:1:"4";i:6;s:1:"4";}', '7', '2'),
(5, 'SSS 2', 'a:4:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";}', 'a:4:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}', '8', '2'),
(6, 'SSS 3', 'a:5:{i:0;s:1:"A";i:1;s:1:"B";i:2;s:1:"C";i:3;s:1:"D";i:4;s:1:"E";}', 'a:4:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"2";i:3;s:1:"3";}', '9', '2');

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_comment`
--

CREATE TABLE `sec_wizgrade_class_five_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_grade`
--

CREATE TABLE `sec_wizgrade_class_five_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_grand_score`
--

CREATE TABLE `sec_wizgrade_class_five_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fif` smallint(10) DEFAULT NULL,
  `jemji_gr_fif` float DEFAULT NULL,
  `jemji_po_fif` tinyint(5) DEFAULT NULL,
  `jiemj_to_fif` smallint(10) DEFAULT NULL,
  `jiemj_gr_fif` float DEFAULT NULL,
  `jiemj_po_fif` tinyint(5) DEFAULT NULL,
  `jmeji_to_fif` smallint(10) DEFAULT NULL,
  `jmeji_gr_fif` float DEFAULT NULL,
  `jmeji_po_fif` tinyint(5) DEFAULT NULL,
  `jgrand_to_fif` smallint(10) DEFAULT NULL,
  `jgrand_gr_fif` float DEFAULT NULL,
  `jgrand_po_fif` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_remark`
--

CREATE TABLE `sec_wizgrade_class_five_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_score`
--

CREATE TABLE `sec_wizgrade_class_five_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_five_sub_score`
--

CREATE TABLE `sec_wizgrade_class_five_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_comment`
--

CREATE TABLE `sec_wizgrade_class_four_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_grade`
--

CREATE TABLE `sec_wizgrade_class_four_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_grand_score`
--

CREATE TABLE `sec_wizgrade_class_four_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fo` smallint(10) DEFAULT NULL,
  `jemji_gr_fo` float DEFAULT NULL,
  `jemji_po_fo` tinyint(5) DEFAULT NULL,
  `jiemj_to_fo` smallint(10) DEFAULT NULL,
  `jiemj_gr_fo` float DEFAULT NULL,
  `jiemj_po_fo` tinyint(5) DEFAULT NULL,
  `jmeji_to_fo` smallint(10) DEFAULT NULL,
  `jmeji_gr_fo` float DEFAULT NULL,
  `jmeji_po_fo` tinyint(5) DEFAULT NULL,
  `jgrand_to_fo` smallint(10) DEFAULT NULL,
  `jgrand_gr_fo` float DEFAULT NULL,
  `jgrand_po_fo` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_remark`
--

CREATE TABLE `sec_wizgrade_class_four_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_score`
--

CREATE TABLE `sec_wizgrade_class_four_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_four_sub_score`
--

CREATE TABLE `sec_wizgrade_class_four_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_comment`
--

CREATE TABLE `sec_wizgrade_class_one_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_grade`
--

CREATE TABLE `sec_wizgrade_class_one_grade` (
  `id_pfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_grand_score`
--

CREATE TABLE `sec_wizgrade_class_one_grand_score` (
  `id_gfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_fi` smallint(10) DEFAULT NULL,
  `jemji_gr_fi` float DEFAULT NULL,
  `jemji_po_fi` tinyint(5) DEFAULT NULL,
  `jiemj_to_fi` smallint(10) DEFAULT NULL,
  `jiemj_gr_fi` float DEFAULT NULL,
  `jiemj_po_fi` tinyint(5) DEFAULT NULL,
  `jmeji_to_fi` smallint(10) DEFAULT NULL,
  `jmeji_gr_fi` float DEFAULT NULL,
  `jmeji_po_fi` tinyint(5) DEFAULT NULL,
  `jgrand_to_fi` smallint(10) DEFAULT NULL,
  `jgrand_gr_fi` float DEFAULT NULL,
  `jgrand_po_fi` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_remark`
--

CREATE TABLE `sec_wizgrade_class_one_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_score`
--

CREATE TABLE `sec_wizgrade_class_one_score` (
  `id_fi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_one_sub_score`
--

CREATE TABLE `sec_wizgrade_class_one_sub_score` (
  `id_sfi` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_comment`
--

CREATE TABLE `sec_wizgrade_class_six_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_grade`
--

CREATE TABLE `sec_wizgrade_class_six_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_grand_score`
--

CREATE TABLE `sec_wizgrade_class_six_grand_score` (
  `id_gfo` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_six` smallint(10) DEFAULT NULL,
  `jemji_gr_six` float DEFAULT NULL,
  `jemji_po_six` tinyint(5) DEFAULT NULL,
  `jiemj_to_six` smallint(10) DEFAULT NULL,
  `jiemj_gr_six` float DEFAULT NULL,
  `jiemj_po_six` tinyint(5) DEFAULT NULL,
  `jmeji_to_six` smallint(10) DEFAULT NULL,
  `jmeji_gr_six` float DEFAULT NULL,
  `jmeji_po_six` tinyint(5) DEFAULT NULL,
  `jgrand_to_six` smallint(10) DEFAULT NULL,
  `jgrand_gr_six` float DEFAULT NULL,
  `jgrand_po_six` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_remark`
--

CREATE TABLE `sec_wizgrade_class_six_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_score`
--

CREATE TABLE `sec_wizgrade_class_six_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_six_sub_score`
--

CREATE TABLE `sec_wizgrade_class_six_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_comment`
--

CREATE TABLE `sec_wizgrade_class_three_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_grade`
--

CREATE TABLE `sec_wizgrade_class_three_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_grand_score`
--

CREATE TABLE `sec_wizgrade_class_three_grand_score` (
  `id_gth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_th` smallint(10) DEFAULT NULL,
  `jemji_gr_th` float DEFAULT NULL,
  `jemji_po_th` tinyint(5) DEFAULT NULL,
  `jiemj_to_th` smallint(10) DEFAULT NULL,
  `jiemj_gr_th` float DEFAULT NULL,
  `jiemj_po_th` tinyint(5) DEFAULT NULL,
  `jmeji_to_th` smallint(10) DEFAULT NULL,
  `jmeji_gr_th` float DEFAULT NULL,
  `jmeji_po_th` tinyint(5) DEFAULT NULL,
  `jgrand_to_th` smallint(10) DEFAULT NULL,
  `jgrand_gr_th` float DEFAULT NULL,
  `jgrand_po_th` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_remark`
--

CREATE TABLE `sec_wizgrade_class_three_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_score`
--

CREATE TABLE `sec_wizgrade_class_three_score` (
  `id_th` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_three_sub_score`
--

CREATE TABLE `sec_wizgrade_class_three_sub_score` (
  `id_sth` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_comment`
--

CREATE TABLE `sec_wizgrade_class_two_comment` (
  `comID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_grade`
--

CREATE TABLE `sec_wizgrade_class_two_grade` (
  `id_pse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_grand_score`
--

CREATE TABLE `sec_wizgrade_class_two_grand_score` (
  `id_gse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `jemji_to_se` smallint(10) DEFAULT NULL,
  `jemji_gr_se` float DEFAULT NULL,
  `jemji_po_se` tinyint(5) DEFAULT NULL,
  `jiemj_to_se` smallint(10) DEFAULT NULL,
  `jiemj_gr_se` float DEFAULT NULL,
  `jiemj_po_se` tinyint(5) DEFAULT NULL,
  `jmeji_to_se` smallint(10) DEFAULT NULL,
  `jmeji_gr_se` float DEFAULT NULL,
  `jmeji_po_se` tinyint(5) DEFAULT NULL,
  `jgrand_to_se` smallint(10) DEFAULT NULL,
  `jgrand_gr_se` float DEFAULT NULL,
  `jgrand_po_se` tinyint(5) DEFAULT NULL,
  `certify` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_remark`
--

CREATE TABLE `sec_wizgrade_class_two_remark` (
  `id_remark` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `att_fi` varchar(30) DEFAULT NULL,
  `conduct_fi` varchar(60) DEFAULT NULL,
  `sports_fi` varchar(30) DEFAULT NULL,
  `organ_fi` text,
  `comment_fi` tinyint(3) DEFAULT NULL,
  `tcom_fi` varchar(100) DEFAULT NULL,
  `princ_fi` varchar(100) DEFAULT NULL,
  `att_se` varchar(30) DEFAULT NULL,
  `conduct_se` varchar(60) DEFAULT NULL,
  `sports_se` varchar(30) DEFAULT NULL,
  `organ_se` text,
  `comment_se` tinyint(3) DEFAULT NULL,
  `tcom_se` varchar(100) DEFAULT NULL,
  `princ_se` varchar(100) DEFAULT NULL,
  `att_th` varchar(30) DEFAULT NULL,
  `conduct_th` varchar(60) DEFAULT NULL,
  `sports_th` varchar(30) DEFAULT NULL,
  `organ_th` text,
  `comment_th` tinyint(3) DEFAULT NULL,
  `tcom_th` varchar(100) DEFAULT NULL,
  `princ_th` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_score`
--

CREATE TABLE `sec_wizgrade_class_two_score` (
  `id_se` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `certify` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_class_two_sub_score`
--

CREATE TABLE `sec_wizgrade_class_two_sub_score` (
  `id_sse` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `CF` enum('0','1') NOT NULL DEFAULT '1',
  `CS` enum('0','1') NOT NULL DEFAULT '1',
  `CT` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_config_rs`
--

CREATE TABLE `sec_wizgrade_config_rs` (
  `s_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` int(4) DEFAULT NULL,
  `class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `t_info` text,
  `staff_id` int(4) NOT NULL,
  `status` enum('1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_daily_comments`
--

CREATE TABLE `sec_wizgrade_daily_comments` (
  `rID` int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text,
  `attendance` enum('0','1','2','3','4') DEFAULT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_exams`
--

CREATE TABLE `sec_wizgrade_exams` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `session` tinyint(3) DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `eTerm` tinyint(1) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `eTitle` varchar(150) DEFAULT NULL,
  `eSubject` varchar(150) DEFAULT NULL,
  `eTime` varchar(10) DEFAULT NULL,
  `eDetail` text,
  `eGrade` enum('1','2') NOT NULL DEFAULT '1',
  `eStaff` int(10) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_exams_config`
--

CREATE TABLE `sec_wizgrade_exams_config` (
  `ex_id` tinyint(3) NOT NULL PRIMARY KEY,
  `fi_ass` tinyint(3) DEFAULT NULL,
  `se_ass` tinyint(3) DEFAULT NULL,
  `th_ass` tinyint(3) DEFAULT NULL,
  `fo_ass` tinyint(3) DEFAULT NULL,
  `fif_ass` tinyint(3) DEFAULT NULL,
  `six_ass` tinyint(3) DEFAULT NULL,
  `exam` tinyint(3) DEFAULT NULL,
  `rsType` enum('1','2') NOT NULL DEFAULT '1',
  `status` enum('1','2','3','4') DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sec_wizgrade_exams_config`
--

INSERT INTO `sec_wizgrade_exams_config` (`ex_id`, `fi_ass`, `se_ass`, `th_ass`, `fo_ass`, `fif_ass`, `six_ass`, `exam`, `rsType`, `status`) VALUES
(1, 10, 10, 10, NULL, NULL, NULL, 70, '2', '3');

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_exam_ans`
--

CREATE TABLE `sec_wizgrade_exam_ans` (
  `aID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `answers` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_exam_questions`
--

CREATE TABLE `sec_wizgrade_exam_questions` (
  `qID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `eID` int(40) DEFAULT NULL,
  `question` text NOT NULL,
  `qPicture` varchar(30) DEFAULT NULL,
  `qOptions` text,
  `qAnswer` varchar(100) DEFAULT NULL,
  `qMark` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_form_teachers`
--

CREATE TABLE `sec_wizgrade_form_teachers` (
  `form_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_hostel`
--

CREATE TABLE `sec_wizgrade_hostel` (
  `h_id` smallint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `hostel` varchar(200) DEFAULT NULL,
  `h_limit` int(10) DEFAULT NULL,
  `h_desc` text,
  `h_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_jss_class_repeat`
--

CREATE TABLE `sec_wizgrade_jss_class_repeat` (
  `id_jrp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_regno`
--

CREATE TABLE `sec_wizgrade_regno` (
  `ireg_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nk_regno` varchar(16) NOT NULL DEFAULT '0',
  `class_1` varchar(10) DEFAULT NULL,
  `class_2` varchar(10) DEFAULT NULL,
  `class_3` varchar(10) DEFAULT NULL,
  `class_4` varchar(10) DEFAULT NULL,
  `class_5` varchar(10) DEFAULT NULL,
  `class_6` varchar(10) DEFAULT NULL,
  `jss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `sss_class` enum('A','B','C','D','E','F','G','H','I','J') DEFAULT NULL,
  `current_class` enum('1','2','3','4','5','6','7') DEFAULT NULL,
  `s_dept` enum('1','2','3') DEFAULT NULL,
  `en_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `en_term` enum('1','2','3') DEFAULT NULL,
  `session_id` tinyint(4) DEFAULT NULL,
  `date_regs` date NOT NULL,
  `active` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_sss_class_repeat`
--

CREATE TABLE `sec_wizgrade_sss_class_repeat` (
  `id_srp` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `level` enum('1','2','3') NOT NULL DEFAULT '1',
  `scores` text NOT NULL,
  `sub_scores` text NOT NULL,
  `grand_scores` text NOT NULL,
  `passed` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_student_record`
--

CREATE TABLE `sec_wizgrade_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `ireg_id` int(10) NOT NULL,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_firstname` varchar(50) DEFAULT NULL,
  `i_midname` varchar(50) DEFAULT NULL,
  `i_lastname` varchar(50) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(50) DEFAULT NULL,
  `i_state` varchar(50) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(50) DEFAULT NULL,
  `i_add_fi` varchar(100) DEFAULT NULL,
  `i_add_se` varchar(100) DEFAULT NULL,
  `i_stu_phone` varchar(30) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spon_occup` varchar(100) DEFAULT NULL,
  `i_spo_add` varchar(100) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(50) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `hostel` tinyint(5) DEFAULT NULL,
  `route` tinyint(5) DEFAULT NULL,
  `secuinfo` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_wizgrade_timetb`
--

CREATE TABLE `sec_wizgrade_timetb` (
  `tID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_assign_subject_teachers`
--

CREATE TABLE `wizgrade_assign_subject_teachers` (
  `assign_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `t_id` int(10) DEFAULT NULL,
  `sub_id` int(10) NOT NULL,
  `session` int(10) DEFAULT NULL,
  `level` tinyint(3) DEFAULT NULL,
  `class` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_broadcast`
--

CREATE TABLE `wizgrade_broadcast` (
  `bID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bTitle` varchar(100) DEFAULT NULL,
  `broadcastMsg` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_bursary`
--

CREATE TABLE `wizgrade_bursary` (
  `b_id` tinyint(3) NOT NULL PRIMARY KEY,
  `currency` varchar(10) DEFAULT NULL,
  `bank` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_bursary`
--

INSERT INTO `wizgrade_bursary` (`b_id`, `currency`, `bank`) VALUES
(1, 'AUD', 'Igweze Ebele Mark\r\n101010101010\r\nwizGrade Bank');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_club`
--

CREATE TABLE `wizgrade_club` (
  `club_id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `club` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_config_nur`
--

CREATE TABLE `wizgrade_config_nur` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_config_pri`
--

CREATE TABLE `wizgrade_config_pri` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_config_sec`
--

CREATE TABLE `wizgrade_config_sec` (
  `cf_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cf_raw` varchar(15) DEFAULT NULL,
  `cf_code` varchar(10) DEFAULT NULL,
  `cf_tittle` varchar(80) DEFAULT NULL,
  `cf_tot` varchar(15) DEFAULT NULL,
  `cf_pos` varchar(15) DEFAULT NULL,
  `cf_com` varchar(15) DEFAULT NULL,
  `cf_level` tinyint(1) DEFAULT NULL,
  `cf_term` enum('1','2','3') DEFAULT NULL,
  `cf_program` tinyint(1) DEFAULT NULL,
  `cf_status` enum('0','1') NOT NULL DEFAULT '1',
  `sub_mpass` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cpost`
--

CREATE TABLE `wizgrade_cpost` (
  `club_id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `club_post` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_comments`
--

CREATE TABLE `wizgrade_cw_comments` (
  `comment_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_title` text NOT NULL,
  `comment_pic` varchar(80) NOT NULL,
  `comment_date` int(11) NOT NULL,
  `comment_user` varchar(11) NOT NULL,
  `comment_ip` varchar(40) DEFAULT NULL,
  `delcom` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_forum`
--

CREATE TABLE `wizgrade_cw_forum` (
  `member_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `member_reg` varchar(20) NOT NULL,
  `member_mail` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(40) DEFAULT NULL,
  `wall_pic` varchar(40) DEFAULT NULL,
  `member_name` varchar(50) NOT NULL,
  `member_sex` enum('0','1','2') NOT NULL,
  `member_dept` tinyint(3) NOT NULL,
  `member_faculty` tinyint(3) NOT NULL,
  `member_program` tinyint(3) DEFAULT NULL,
  `member_rank` enum('1','2','3') NOT NULL DEFAULT '1',
  `load_page` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_ireport`
--

CREATE TABLE `wizgrade_cw_ireport` (
  `report_id_idgsi` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `comment_id_idgsi` int(11) NOT NULL DEFAULT '0',
  `article_id_idgsi` int(11) NOT NULL DEFAULT '0',
  `report_idgsi` text NOT NULL,
  `reporting_user_idgsi` int(11) NOT NULL DEFAULT '0',
  `reported_user_idgsi` int(11) NOT NULL DEFAULT '0',
  `date_idgsi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_likes_track`
--

CREATE TABLE `wizgrade_cw_likes_track` (
  `likes_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_mailbox`
--

CREATE TABLE `wizgrade_cw_mailbox` (
  `msg_id` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `njnk_title` varchar(256) NOT NULL,
  `njnk_msg` text NOT NULL,
  `njnk_time` int(11) NOT NULL,
  `njnk_status` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `njnk_sender_id` int(10) NOT NULL,
  `njnk_reps_id` int(10) NOT NULL,
  `njnk_sender_ip` varchar(40) NOT NULL,
  `njnk_type` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `njnk_trash` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_notification`
--

CREATE TABLE `wizgrade_cw_notification` (
  `not_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `senders_id` varchar(255) NOT NULL,
  `not_time` int(11) NOT NULL,
  `not_type` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_posts`
--

CREATE TABLE `wizgrade_cw_posts` (
  `post_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `author_id` varchar(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `post_msg` text,
  `post_img_fi` varchar(80) DEFAULT NULL,
  `post_img_se` varchar(80) DEFAULT NULL,
  `post_img_th` varchar(80) DEFAULT NULL,
  `post_img_fo` varchar(80) DEFAULT NULL,
  `post_url` text,
  `post_date` int(11) DEFAULT NULL,
  `post_ip` varchar(40) DEFAULT NULL,
  `post_type` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `d_id` tinyint(4) DEFAULT NULL,
  `f_id` tinyint(4) DEFAULT NULL,
  `delpost` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_cw_temp_upload_pic`
--

CREATE TABLE `wizgrade_cw_temp_upload_pic` (
  `upload_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `upload_pathp` varchar(30) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `upload_type` enum('1','2') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_disability`
--

CREATE TABLE `wizgrade_disability` (
  `id_dis` int(3) NOT NULL  PRIMARY KEY,
  `disability` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_disability`
--

INSERT INTO `wizgrade_disability` (`id_dis`, `disability`, `status`) VALUES
(1, ' Autism spectrum disorders', '1'),
(2, 'Hearing Loss and Deafness', '1'),
(3, 'Chronic Illness', '1'),
(4, 'Learning Disability', '1'),
(5, 'Memory Loss', '1'),
(6, 'Mental health and emotional disabilities', '1'),
(7, 'Physical Disability', '1'),
(8, 'Language Disorders', '1'),
(9, 'Intellectual Disability', '1'),
(10, 'Balance disorder', '1'),
(11, 'Developmental disability', '1'),
(12, 'Somatosensory impairment', '1'),
(13, 'Olfactory and gustatory impairment', '1'),
(14, 'Omar', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_events_notification`
--

CREATE TABLE `wizgrade_events_notification` (
  `eID` int(18) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `startdate` datetime NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `comments` text NOT NULL,
  `type` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_ewallet_nkiruka`
--

CREATE TABLE `wizgrade_ewallet_nkiruka` (
  `iiii_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `iiii_pin_iiii` varchar(24) DEFAULT NULL,
  `iiii_serial_iiii` varchar(40) DEFAULT NULL,
  `iiii_reg` varchar(30) DEFAULT NULL,
  `iiii_reg_id` int(10) DEFAULT NULL,
  `iiii_level` tinyint(3) DEFAULT NULL,
  `iiii_term` tinyint(3) DEFAULT NULL,
  `iiii_time` int(11) DEFAULT NULL,
  `iiii_stype` enum('1','2','3','4') DEFAULT NULL,
  `iiii_status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_expenses`
--

CREATE TABLE `wizgrade_expenses` (
  `eID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `expenseCat` tinyint(3) DEFAULT NULL,
  `eAmount` decimal(19,4) DEFAULT NULL,
  `expTitle` varchar(100) DEFAULT NULL,
  `method` enum('1','2','3','4') DEFAULT NULL,
  `expDetails` text,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_expense_category`
--

CREATE TABLE `wizgrade_expense_category` (
  `e_id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `expense` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_fees`
--

CREATE TABLE `wizgrade_fees` (
  `fID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `feeCat` tinyint(3) NOT NULL,
  `feeAmount` decimal(19,4) DEFAULT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `reg_id` int(10) NOT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `class` varchar(2) DEFAULT NULL,
  `term` enum('1','2','3') DEFAULT NULL,
  `method` enum('1','2','3','4') DEFAULT NULL,
  `f_details` text,
  `amount` decimal(19,4) DEFAULT NULL,
  `balance` decimal(19,4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `f_status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_fee_category`
--

CREATE TABLE `wizgrade_fee_category` (
  `f_id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fee` varchar(100) DEFAULT NULL,
  `amount` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_grades`
--

CREATE TABLE `wizgrade_grades` (
  `gID` smallint(10) NOT NULL PRIMARY KEY,
  `fromGrade` varchar(5) DEFAULT NULL,
  `toGrade` varchar(5) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_grades`
--

INSERT INTO `wizgrade_grades` (`gID`, `fromGrade`, `toGrade`, `grade`) VALUES
(1, '0', '34', 'F'),
(2, '35', '39', 'E8'),
(3, '40', '49', 'D7'),
(4, '50', '54', 'C6'),
(5, '55', '59', 'C5'),
(6, '60', '64', 'C4'),
(7, '65', '69', 'B3'),
(8, '70', '74', 'B2'),
(9, '75', '100', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_library`
--

CREATE TABLE `wizgrade_library` (
  `book_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_name` varchar(100) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_desc` varchar(255) DEFAULT NULL,
  `book_path` varchar(40) DEFAULT NULL,
  `book_price` varchar(15) DEFAULT NULL,
  `book_type` enum('1','2') DEFAULT NULL,
  `book_hits` int(10) NOT NULL DEFAULT '0',
  `book_copies` mediumint(5) DEFAULT NULL,
  `book_location` varchar(255) DEFAULT NULL,
  `stype` enum('1','2','3') NOT NULL,
  `sclass` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '7',
  `book_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_library_apply`
--

CREATE TABLE `wizgrade_library_apply` (
  `b_id` int(30) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_id` int(10) NOT NULL,
  `lib_user` int(30) DEFAULT NULL,
  `lib_reg` varchar(30) DEFAULT NULL,
  `apply_date` datetime DEFAULT NULL,
  `d_reasons` varchar(150) DEFAULT NULL,
  `approve_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `sclass` int(4) DEFAULT NULL,
  `b_status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_library_configs`
--

CREATE TABLE `wizgrade_library_configs` (
  `c_id` tinyint(1) NOT NULL PRIMARY KEY,
  `book_no_apply` tinyint(3) DEFAULT NULL,
  `book_no_borrow` tinyint(3) DEFAULT NULL,
  `book_dateline` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_library_configs`
--

INSERT INTO `wizgrade_library_configs` (`c_id`, `book_no_apply`, `book_no_borrow`, `book_dateline`) VALUES
(1, 10, 5, '30 DAY');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_order_summ`
--

CREATE TABLE `wizgrade_order_summ` (
  `s_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `order_id` int(20) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `qty` tinyint(2) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_payment_gateway`
--

CREATE TABLE `wizgrade_payment_gateway` (
  `gID` tinyint(3) NOT NULL PRIMARY KEY,
  `gateway` varchar(50) DEFAULT NULL,
  `gatewayVerb` varchar(30) DEFAULT NULL,
  `gateKey` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_payment_gateway`
--

INSERT INTO `wizgrade_payment_gateway` (`gID`, `gateway`, `gatewayVerb`, `gateKey`) VALUES
(1, 'Paypal', 'Paypal Business Email', 'sdosms@gmail.com'),
(2, '2Checkout', '2Checkout Account Key', '901342101'),
(3, 'Paystack', 'Paystack Pay Public Key', 'pk_test_a4787362baf189d4bee36ce7047a25e32c938766'),
(4, 'VoguePay', 'VoguePay Merchant ID', '2477-0049083');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_products`
--

CREATE TABLE `wizgrade_products` (
  `pID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cat_id` tinyint(3) DEFAULT NULL,
  `p_title` varchar(255) DEFAULT NULL,
  `p_description` text,
  `p_price` varchar(10) DEFAULT NULL,
  `x_price` varchar(10) DEFAULT NULL,
  `p_date` date DEFAULT NULL,
  `p_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_product_category`
--

CREATE TABLE `wizgrade_product_category` (
  `p_id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_product_order`
--

CREATE TABLE `wizgrade_product_order` (
  `order_id` int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `reg_id` int(10) DEFAULT NULL,
  `regNo` varchar(14) DEFAULT NULL,
  `stype` enum('1','2','3') DEFAULT NULL,
  `orderIP` text,
  `orderDate` timestamp NULL DEFAULT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_product_pic`
--

CREATE TABLE `wizgrade_product_pic` (
  `pic_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_registration`
--

CREATE TABLE `wizgrade_registration` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `i_stupic` varchar(60) DEFAULT NULL,
  `i_school` enum('1','2','3') DEFAULT NULL,
  `i_level` enum('1','2','3','4','5','6') DEFAULT NULL,
  `i_firstname` varchar(50) DEFAULT NULL,
  `i_midname` varchar(50) DEFAULT NULL,
  `i_lastname` varchar(50) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(50) DEFAULT NULL,
  `i_state` varchar(50) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(50) DEFAULT NULL,
  `i_add_fi` varchar(100) DEFAULT NULL,
  `i_add_se` varchar(100) DEFAULT NULL,
  `i_stu_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spon_occup` varchar(50) NOT NULL,
  `i_spo_add` varchar(100) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `disability` varchar(60) DEFAULT NULL,
  `reg_date` int(11) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_remarks`
--

CREATE TABLE `wizgrade_remarks` (
  `id_rem` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `remarks` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_route`
--

CREATE TABLE `wizgrade_route` (
  `r_id` smallint(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `route` varchar(200) DEFAULT NULL,
  `r_amout` int(10) DEFAULT NULL,
  `r_desc` text,
  `r_master` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_schoolinfo`
--

CREATE TABLE `wizgrade_schoolinfo` (
  `school_id` tinyint(3) NOT NULL PRIMARY KEY,
  `school_name` varchar(256) DEFAULT NULL,
  `school_address` varchar(256) DEFAULT NULL,
  `reg_prefix` varchar(10) DEFAULT NULL,
  `school_cutoff` tinyint(3) NOT NULL,
  `school_head` varchar(100) DEFAULT NULL,
  `bursary` smallint(5) DEFAULT NULL,
  `libraian` smallint(5) DEFAULT NULL,
  `school_theme` varchar(10) DEFAULT NULL,
  `school_logo` varchar(30) DEFAULT NULL,
  `school_sub_cutoff` tinyint(3) NOT NULL,
  `translator` varchar(30) DEFAULT NULL,
  `screen_timer` varchar(10) DEFAULT NULL,
  `ewallet` enum('0','1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_schoolinfo`
--

INSERT INTO `wizgrade_schoolinfo` (`school_id`, `school_name`, `school_address`, `reg_prefix`, `school_cutoff`, `school_head`, `bursary`, `libraian`, `school_theme`, `school_logo`, `school_sub_cutoff`, `translator`, `screen_timer`, `ewallet`) VALUES
(1, 'fobrain AI SCHOOL', 'NO 1 fobrain DRIVE, ABUJA', 'SDOSMS', 45, '17,6,2', 3, 5, '4B0082', 'ifechi-school-logo.png', 40, 'en/en', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_school_fee_igweze`
--

CREATE TABLE `wizgrade_school_fee_igweze` (
  `sfeeID` int(40) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `feeID` tinyint(3) NOT NULL,
  `session` tinyint(3) DEFAULT NULL,
  `RegNum_ID` int(10) NOT NULL,
  `RegNum` varchar(14) DEFAULT NULL,
  `facultyID` tinyint(3) DEFAULT NULL,
  `deptID` tinyint(3) DEFAULT NULL,
  `program` varchar(30) DEFAULT NULL,
  `level` enum('100','200','300','400','500','600','700','800','900') DEFAULT NULL,
  `semester` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `bank` varchar(30) DEFAULT NULL,
  `tellerID` varchar(15) DEFAULT NULL,
  `amount` varchar(15) DEFAULT NULL,
  `igweze` int(20) DEFAULT NULL,
  `date` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_school_subjects`
--

CREATE TABLE `wizgrade_school_subjects` (
  `sub_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `subjects` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_session`
--

CREATE TABLE `wizgrade_session` (
  `id_sess` int(3) NOT NULL PRIMARY KEY,
  `year` int(4) NOT NULL,
  `fi_term` varchar(20) DEFAULT NULL,
  `se_term` varchar(20) DEFAULT NULL,
  `th_term` varchar(20) DEFAULT NULL,
  `rtf_fi` varchar(20) DEFAULT NULL,
  `rtf_se` varchar(20) DEFAULT NULL,
  `rtf_th` varchar(20) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `current` enum('0','1') NOT NULL DEFAULT '0',
  `cur_term` enum('1','2','3') DEFAULT NULL,
  `lastreg` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_session`
--

INSERT INTO `wizgrade_session` (`id_sess`, `year`, `fi_term`, `se_term`, `th_term`, `rtf_fi`, `rtf_se`, `rtf_th`, `status`, `current`, `cur_term`, `lastreg`) VALUES
(10, 2009, ' 13 September ', ' 16 January ', '21 July', NULL, NULL, NULL, '0', '0', '', NULL),
(11, 2010, '14 September', '17 January', '16 May', NULL, NULL, NULL, '0', '0', NULL, NULL),
(12, 2011, ' 11 September ', ' 18 January ', ' 11 May ', NULL, NULL, NULL, '0', '0', NULL, NULL),
(13, 2012, '10 September', '15 January', '16 May', NULL, NULL, NULL, '0', '0', NULL, NULL),
(14, 2013, '14 September', '17 January', '10 May', NULL, NULL, NULL, '0', '0', '', NULL),
(15, 2014, ' 22 July ', ' 23 July ', '29 May', NULL, NULL, NULL, '0', '0', '', NULL),
(16, 2015, '    ', '    ', '    ', NULL, NULL, NULL, '0', NULL, NULL, NULL),
(17, 2016, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(18, 2017, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(19, 2018, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(20, 2019, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(21, 2020, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', '1', NULL),
(22, 2021, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(23, 2022, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(24, 2023, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(25, 2024, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(26, 2025, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(27, 2026, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(28, 2027, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(29, 2028, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(30, 2029, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL),
(31, 2030, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_sms`
--

CREATE TABLE `wizgrade_sms` (
  `sID` tinyint(3) NOT NULL PRIMARY KEY,
  `gateway` varchar(50) DEFAULT NULL,
  `senderID` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `api` varchar(500) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_sms`
--

INSERT INTO `wizgrade_sms` (`sID`, `gateway`, `senderID`, `user`, `password`, `api`, `status`) VALUES
(1, 'Clickatell', 'sdosms', 'sdosms', 'papapa', 'IPq5TBvPRzG0Xeeu-wYcCQ==', '1'),
(2, '1s2u', NULL, NULL, NULL, NULL, '0'),
(3, 'Bulksmsnigeria', NULL, NULL, NULL, NULL, '0'),
(4, 'Smsclone', NULL, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_sports`
--

CREATE TABLE `wizgrade_sports` (
  `sport_id` int(3) NOT NULL PRIMARY KEY,
  `sport` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_sports`
--

INSERT INTO `wizgrade_sports` (`sport_id`, `sport`, `status`) VALUES
(1, 'Football ', '1'),
(2, 'Volleyball', '1'),
(3, 'Running', '1'),
(4, 'Handball', '1'),
(5, 'Long Jump', '1'),
(6, 'Swimming', '1'),
(7, 'High Jump', '1'),
(8, 'Basket Ball', '1'),
(9, ' Lawn Tennis ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_teachers_record`
--

CREATE TABLE `wizgrade_teachers_record` (
  `t_id` mediumint(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `staff_id` varchar(15) DEFAULT NULL,
  `i_picture` varchar(60) DEFAULT NULL,
  `i_sign` varchar(50) DEFAULT NULL,
  `i_accesspass` varchar(255) DEFAULT NULL,
  `i_salted` char(30) DEFAULT NULL,
  `i_pass` varchar(30) DEFAULT NULL,
  `i_title` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_mar_status` enum('1','2','3','4','5') DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_phone` varchar(20) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(20) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `rank` tinyint(3) DEFAULT NULL,
  `level` enum('N','J','S') NOT NULL DEFAULT 'N',
  `t_grade` enum('0','1','2','3','4','5','6') DEFAULT '0',
  `status` enum('0','1','2','3') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_teacher_rank`
--

CREATE TABLE `wizgrade_teacher_rank` (
  `rank_id` int(3) NOT NULL PRIMARY KEY,
  `ranking` varchar(256) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wizgrade_teacher_rank`
--

INSERT INTO `wizgrade_teacher_rank` (`rank_id`, `ranking`, `status`) VALUES
(1, 'Principal', '1'),
(2, 'Vice Principal', '1'),
(3, 'Head Master', '1'),
(4, 'Head Miss', '1'),
(5, 'Teacher', '1'),
(6, 'Lab Teacher', '1'),
(7, 'Sports Master', '1'),
(8, 'Sports Mistress', '1'),
(9, 'Dean of Studies', '1'),
(10, 'Computer Teacher', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_temp`
--

CREATE TABLE `wizgrade_temp` (
  `tID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `genID` varchar(30) DEFAULT NULL,
  `staffID` smallint(5) DEFAULT NULL,
  `cCount` tinyint(5) DEFAULT NULL,
  `gTime` int(11) DEFAULT NULL,
  `tTitle` varchar(250) DEFAULT NULL,
  `temType` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_temp_data`
--

CREATE TABLE `wizgrade_temp_data` (
  `tdID` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `genID` varchar(30) DEFAULT NULL,
  `regID` varchar(30) DEFAULT NULL,
  `userName` varchar(5) DEFAULT NULL,
  `temData` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wizgrade_tem_student_record`
--

CREATE TABLE `wizgrade_tem_student_record` (
  `stu_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `u_id` varchar(30) NOT NULL,
  `i_firstname` varchar(40) DEFAULT NULL,
  `i_midname` varchar(30) DEFAULT NULL,
  `i_lastname` varchar(40) DEFAULT NULL,
  `i_gender` enum('1','2') DEFAULT NULL,
  `i_dob` date DEFAULT NULL,
  `i_country` varchar(40) DEFAULT NULL,
  `i_state` varchar(30) DEFAULT NULL,
  `i_lga` varchar(40) DEFAULT NULL,
  `i_city` varchar(30) DEFAULT NULL,
  `i_add_fi` varchar(60) DEFAULT NULL,
  `i_add_se` varchar(60) DEFAULT NULL,
  `i_stu_phone` varchar(50) DEFAULT NULL,
  `i_email` varchar(40) DEFAULT NULL,
  `hostel_id` smallint(5) NOT NULL,
  `route_id` smallint(5) NOT NULL,
  `i_sponsor` varchar(60) DEFAULT NULL,
  `i_spo_phone` varchar(50) DEFAULT NULL,
  `i_spo_add` varchar(60) DEFAULT NULL,
  `i_sponsor_ac` char(30) DEFAULT NULL,
  `i_sponsor_p` varchar(50) DEFAULT NULL,
  `bloodgp` enum('1','2','3','4','5','6','7','8') DEFAULT NULL,
  `genotype` enum('1','2','3') DEFAULT NULL,
  `level` tinyint(1) NOT NULL,
  `class` varchar(3) DEFAULT NULL,
  `sessID` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nur_wizgrade_class`
--
ALTER TABLE `nur_wizgrade_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pri_wizgrade_class`
--
ALTER TABLE `pri_wizgrade_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sec_wizgrade_class`
--
ALTER TABLE `sec_wizgrade_class`
  MODIFY `cl_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `wizgrade_bursary`
--
ALTER TABLE `wizgrade_bursary`
  MODIFY `b_id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wizgrade_disability`
--
ALTER TABLE `wizgrade_disability`
  MODIFY `id_dis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `wizgrade_grades`
--
ALTER TABLE `wizgrade_grades`
  MODIFY `gID` smallint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `wizgrade_library_configs`
--
ALTER TABLE `wizgrade_library_configs`
  MODIFY `c_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wizgrade_payment_gateway`
--
ALTER TABLE `wizgrade_payment_gateway`
  MODIFY `gID` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wizgrade_schoolinfo`
--
ALTER TABLE `wizgrade_schoolinfo`
  MODIFY `school_id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `wizgrade_session`
--
ALTER TABLE `wizgrade_session`
  MODIFY `id_sess` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `wizgrade_sms`
--
ALTER TABLE `wizgrade_sms`
  MODIFY `sID` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wizgrade_sports`
--
ALTER TABLE `wizgrade_sports`
  MODIFY `sport_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `wizgrade_teacher_rank`
--
ALTER TABLE `wizgrade_teacher_rank`
  MODIFY `rank_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;