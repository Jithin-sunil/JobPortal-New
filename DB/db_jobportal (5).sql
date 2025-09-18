-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2025 at 03:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'wolvx', 'wolvx@gmail.com', 'wolvx@2025');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `application_id` int(11) NOT NULL,
  `application_date` varchar(100) NOT NULL,
  `application_file` varchar(500) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`application_id`, `application_date`, `application_file`, `application_status`, `user_id`, `jobpost_id`) VALUES
(1, '2025-07-30', 'resume_orginal.pdf', 0, 1, 0),
(2, '2025-07-30', 'resume_orginal.pdf', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Brand Manager', 0),
(2, 'Accountant', 0),
(3, 'Sales Analyst', 0),
(4, 'Accountant', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `company_email` varchar(30) NOT NULL,
  `company_contact` varchar(30) NOT NULL,
  `company_address` varchar(500) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_license` varchar(500) NOT NULL,
  `company_licensenumber` varchar(50) NOT NULL,
  `company_password` varchar(30) NOT NULL,
  `company_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL,
  `companytype_id` int(11) NOT NULL,
  `companycategory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`, `company_email`, `company_contact`, `company_address`, `company_logo`, `company_license`, `company_licensenumber`, `company_password`, `company_status`, `place_id`, `companytype_id`, `companycategory_id`) VALUES
(6, 'Indeed', 'indeed@gmail.com', '442345555', 'Near Bus Stand,EdappaL(po),Malappuram', 'wp9904510-msi-4k-wallpapers.jpg', '1-58139259-11c5-46a4-8675-a54c81e83e64 (1).pdf', 'A1234B32', 'Indeed@2025', 1, 3, 1, 1),
(7, 'AAA', 'aaa@gmail.com', '123456', ' QWERTYKL2345.//', 'beautiful-mountains-landscape.jpg', 'ML_Main.pdf', '123456', '12W3E45RTYU@Aa', 0, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companycategory`
--

CREATE TABLE `tbl_companycategory` (
  `companycategory_id` int(11) NOT NULL,
  `companycategory_name` varchar(100) NOT NULL,
  `companycategory_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_companycategory`
--

INSERT INTO `tbl_companycategory` (`companycategory_id`, `companycategory_name`, `companycategory_status`) VALUES
(1, 'Private Limited', 0),
(2, 'Public', 0),
(3, 'Government', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companytype`
--

CREATE TABLE `tbl_companytype` (
  `companytype_id` int(11) NOT NULL,
  `companytype_name` varchar(100) NOT NULL,
  `companytype_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_companytype`
--

INSERT INTO `tbl_companytype` (`companytype_id`, `companytype_name`, `companytype_status`) VALUES
(1, 'Software Company', 0),
(2, 'Product-based Company', 0),
(3, 'IT consulting firms', 0),
(4, 'Advertisement Company', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(60) NOT NULL,
  `complaint_content` varchar(60) NOT NULL,
  `complaint_status` int(60) NOT NULL DEFAULT 0,
  `complaint_reply` varchar(60) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(70) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `state_id`, `district_status`) VALUES
(1, 'Malappuram', 1, 0),
(2, 'Palakkad', 0, 0),
(3, 'Coimbatore', 2, 0),
(4, 'Chennai', 2, 0),
(5, 'Ernakulam', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `exam_id` int(11) NOT NULL,
  `exam_date` varchar(50) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `exam_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`exam_id`, `exam_date`, `jobpost_id`, `exam_status`) VALUES
(1, '2025-09-17T09:30', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_joblanguage`
--

CREATE TABLE `tbl_joblanguage` (
  `joblanguage_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `joblanguage_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_joblanguage`
--

INSERT INTO `tbl_joblanguage` (`joblanguage_id`, `jobpost_id`, `language_id`, `joblanguage_status`) VALUES
(1, 0, 1, 0),
(2, 0, 2, 0),
(3, 0, 3, 1),
(4, 0, 3, 1),
(5, 0, 3, 1),
(6, 0, 3, 1),
(7, 0, 3, 0),
(8, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobpost`
--

CREATE TABLE `tbl_jobpost` (
  `jobpost_id` int(11) NOT NULL,
  `jobpost_title` varchar(100) NOT NULL,
  `jobpost_content` varchar(500) NOT NULL,
  `jobpost_salary` varchar(100) NOT NULL,
  `jobpost_date` varchar(50) NOT NULL,
  `jobpost_lastdate` varchar(50) NOT NULL,
  `jobpost_resubmission` varchar(100) NOT NULL,
  `jobpost_recruitment` varchar(50) NOT NULL,
  `jobpost_status` int(11) NOT NULL DEFAULT 0,
  `jobpost_experience` varchar(100) NOT NULL,
  `jobtype_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobpost`
--

INSERT INTO `tbl_jobpost` (`jobpost_id`, `jobpost_title`, `jobpost_content`, `jobpost_salary`, `jobpost_date`, `jobpost_lastdate`, `jobpost_resubmission`, `jobpost_recruitment`, `jobpost_status`, `jobpost_experience`, `jobtype_id`, `company_id`, `category_id`) VALUES
(1, 'Finance Manager', 'hhh', '3.5lakh per annum', '2025-07-30', '2025-08-13', '2025-08-08', 'online', 0, '1yr', 1, 1, 4),
(2, 'Finance Manager', 'Need a full time Employee.', '3.5lakh per annum', '2025-08-21', '2025-08-22', '', '0', 0, '1yr', 0, 6, 0),
(3, 'Accountant', 'Accountant role', '6 lakh per annum', '2025-08-22', '2025-08-31', '', '0', 0, '7', 2, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobqualification`
--

CREATE TABLE `tbl_jobqualification` (
  `jobqualification_id` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `jobqualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobqualification`
--

INSERT INTO `tbl_jobqualification` (`jobqualification_id`, `qualification_id`, `jobpost_id`, `jobqualification_status`) VALUES
(1, 1, 1, 0),
(2, 3, 1, 0),
(3, 2, 1, 1),
(4, 4, 1, 0),
(5, 1, 3, 0),
(6, 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobtechnicalskill`
--

CREATE TABLE `tbl_jobtechnicalskill` (
  `jobtechnicalskill_id` int(11) NOT NULL,
  `technicalskill_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `jobtechnicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobtechnicalskill`
--

INSERT INTO `tbl_jobtechnicalskill` (`jobtechnicalskill_id`, `technicalskill_id`, `jobpost_id`, `jobtechnicalskill_status`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobtype`
--

CREATE TABLE `tbl_jobtype` (
  `jobtype_id` int(11) NOT NULL,
  `jobtype_name` varchar(40) NOT NULL,
  `jobtype_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobtype`
--

INSERT INTO `tbl_jobtype` (`jobtype_id`, `jobtype_name`, `jobtype_status`) VALUES
(1, 'Half Day', 0),
(2, 'Full day', 0),
(3, 'Part time', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(30) NOT NULL,
  `language_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`language_id`, `language_name`, `language_status`) VALUES
(1, 'English', 0),
(2, 'Malayalam', 0),
(3, 'Hindi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_option`
--

CREATE TABLE `tbl_option` (
  `option_id` int(11) NOT NULL,
  `option_options` varchar(200) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_iscorrect` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_option`
--

INSERT INTO `tbl_option` (`option_id`, `option_options`, `question_id`, `option_iscorrect`) VALUES
(1, 'Option 1', 1, 1),
(2, 'Option 2', 1, 0),
(3, 'Option 3', 1, 0),
(4, 'Option 4', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(50) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(50) NOT NULL,
  `place_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`, `place_status`) VALUES
(1, 'Muvattupuzha', 5, 0),
(2, 'Kothamangalam', 5, 0),
(3, 'Edappal', 1, 0),
(4, 'Ponnani', 1, 0),
(5, 'Puthupaddy', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qualification`
--

CREATE TABLE `tbl_qualification` (
  `qualification_id` int(11) NOT NULL,
  `qualification_name` varchar(30) NOT NULL,
  `qualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_qualification`
--

INSERT INTO `tbl_qualification` (`qualification_id`, `qualification_name`, `qualification_status`) VALUES
(1, 'BCA', 0),
(2, 'MCA', 0),
(3, 'BBA', 1),
(4, 'MBA', 0),
(5, 'BBA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `question_id` int(11) NOT NULL,
  `question_title` varchar(100) NOT NULL,
  `question_file` varchar(500) NOT NULL,
  `questioncategory_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`question_id`, `question_title`, `question_file`, `questioncategory_id`, `exam_id`, `question_status`) VALUES
(1, 'Select the odd one in the image', '1-4523181c-aa36-408f-b39e-8cc059d8f047.pdf', 1, 1, 0),
(2, 'pick the odd one in the following', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questionanswer`
--

CREATE TABLE `tbl_questionanswer` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `questionanswer_status` int(11) NOT NULL DEFAULT 0,
  `questionanswer_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questioncategory`
--

CREATE TABLE `tbl_questioncategory` (
  `questioncategory_id` int(11) NOT NULL,
  `questioncategory_name` varchar(100) NOT NULL,
  `questioncategory_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_questioncategory`
--

INSERT INTO `tbl_questioncategory` (`questioncategory_id`, `questioncategory_name`, `questioncategory_status`) VALUES
(1, 'A', 0),
(2, 'B', 0),
(3, 'C', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resubmission`
--

CREATE TABLE `tbl_resubmission` (
  `resubmission_id` int(11) NOT NULL,
  `resubmission_date` varchar(100) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `resubmission_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `state_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`, `state_status`) VALUES
(1, 'Kerala', 0),
(2, 'Tamil Nadu', 0),
(3, 'Karnataka', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(50) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technicalskill`
--

CREATE TABLE `tbl_technicalskill` (
  `technicalskill_id` int(11) NOT NULL,
  `technicalskill_name` varchar(30) NOT NULL,
  `technicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_technicalskill`
--

INSERT INTO `tbl_technicalskill` (`technicalskill_id`, `technicalskill_name`, `technicalskill_status`) VALUES
(1, 'Technical Writing', 0),
(2, 'Web development', 0),
(3, 'Cyber Security ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contact` varchar(50) NOT NULL,
  `user_address` varchar(300) NOT NULL,
  `user_photo` varchar(300) NOT NULL,
  `user_idproofnumber` varchar(50) NOT NULL,
  `user_idproof` varchar(200) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_dob` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `user_photo`, `user_idproofnumber`, `user_idproof`, `user_gender`, `user_dob`, `user_password`, `user_status`, `place_id`) VALUES
(1, 'Arjun PS', 'arjunpsofficial@gmail.com', '8590100757', 'Ponnani', '1000012852.jpg', '', '', 'Male', '2005-06-28', 'Arjun@2025', 0, 3),
(2, 'Abhinav B', 'abhinav@gmail.com', '9958599533', 'Puthuppady', '114153.jpg', '', '', 'Male', '2005-03-15', 'Abhinav@2005', 0, 1),
(3, 'Arjun PS', 'arjun332@gmail.com', '9958599533', 'poroookkara,Edappal(po),Malappuram,Kerala', 'beautiful-mountains-landscape (1).jpg', '123AB321', 'resume.pdf', 'Male', '2005-03-15', 'Arjun@2025', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlanguage`
--

CREATE TABLE `tbl_userlanguage` (
  `userlanguage_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userlanguage_status` int(11) NOT NULL DEFAULT 0,
  `skill_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userlanguage`
--

INSERT INTO `tbl_userlanguage` (`userlanguage_id`, `language_id`, `user_id`, `userlanguage_status`, `skill_level`) VALUES
(1, 1, 1, 0, 'Read,Speak'),
(2, 2, 1, 0, 'Read,Write'),
(3, 3, 1, 0, 'Read');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userqualification`
--

CREATE TABLE `tbl_userqualification` (
  `userqualification_id` int(11) NOT NULL,
  `userqualification_certificate` varchar(500) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userqualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userqualification`
--

INSERT INTO `tbl_userqualification` (`userqualification_id`, `userqualification_certificate`, `qualification_id`, `user_id`, `userqualification_status`) VALUES
(1, '114194.jpg', 1, 1, 0),
(2, 'wp9904538-msi-4k-wallpapers.jpg', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertechnicalskill`
--

CREATE TABLE `tbl_usertechnicalskill` (
  `usertechnicalskill_id` int(11) NOT NULL,
  `technicalskill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usertechnicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_usertechnicalskill`
--

INSERT INTO `tbl_usertechnicalskill` (`usertechnicalskill_id`, `technicalskill_id`, `user_id`, `usertechnicalskill_status`) VALUES
(1, 2, 1, 0),
(2, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_companycategory`
--
ALTER TABLE `tbl_companycategory`
  ADD PRIMARY KEY (`companycategory_id`);

--
-- Indexes for table `tbl_companytype`
--
ALTER TABLE `tbl_companytype`
  ADD PRIMARY KEY (`companytype_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `tbl_joblanguage`
--
ALTER TABLE `tbl_joblanguage`
  ADD PRIMARY KEY (`joblanguage_id`);

--
-- Indexes for table `tbl_jobpost`
--
ALTER TABLE `tbl_jobpost`
  ADD PRIMARY KEY (`jobpost_id`);

--
-- Indexes for table `tbl_jobqualification`
--
ALTER TABLE `tbl_jobqualification`
  ADD PRIMARY KEY (`jobqualification_id`);

--
-- Indexes for table `tbl_jobtechnicalskill`
--
ALTER TABLE `tbl_jobtechnicalskill`
  ADD PRIMARY KEY (`jobtechnicalskill_id`);

--
-- Indexes for table `tbl_jobtype`
--
ALTER TABLE `tbl_jobtype`
  ADD PRIMARY KEY (`jobtype_id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tbl_option`
--
ALTER TABLE `tbl_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_questionanswer`
--
ALTER TABLE `tbl_questionanswer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `tbl_questioncategory`
--
ALTER TABLE `tbl_questioncategory`
  ADD PRIMARY KEY (`questioncategory_id`);

--
-- Indexes for table `tbl_resubmission`
--
ALTER TABLE `tbl_resubmission`
  ADD PRIMARY KEY (`resubmission_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_technicalskill`
--
ALTER TABLE `tbl_technicalskill`
  ADD PRIMARY KEY (`technicalskill_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_userlanguage`
--
ALTER TABLE `tbl_userlanguage`
  ADD PRIMARY KEY (`userlanguage_id`);

--
-- Indexes for table `tbl_userqualification`
--
ALTER TABLE `tbl_userqualification`
  ADD PRIMARY KEY (`userqualification_id`);

--
-- Indexes for table `tbl_usertechnicalskill`
--
ALTER TABLE `tbl_usertechnicalskill`
  ADD PRIMARY KEY (`usertechnicalskill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_companycategory`
--
ALTER TABLE `tbl_companycategory`
  MODIFY `companycategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_companytype`
--
ALTER TABLE `tbl_companytype`
  MODIFY `companytype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_joblanguage`
--
ALTER TABLE `tbl_joblanguage`
  MODIFY `joblanguage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_jobpost`
--
ALTER TABLE `tbl_jobpost`
  MODIFY `jobpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jobqualification`
--
ALTER TABLE `tbl_jobqualification`
  MODIFY `jobqualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_jobtechnicalskill`
--
ALTER TABLE `tbl_jobtechnicalskill`
  MODIFY `jobtechnicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jobtype`
--
ALTER TABLE `tbl_jobtype`
  MODIFY `jobtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_option`
--
ALTER TABLE `tbl_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  MODIFY `qualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_questionanswer`
--
ALTER TABLE `tbl_questionanswer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_questioncategory`
--
ALTER TABLE `tbl_questioncategory`
  MODIFY `questioncategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_resubmission`
--
ALTER TABLE `tbl_resubmission`
  MODIFY `resubmission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_technicalskill`
--
ALTER TABLE `tbl_technicalskill`
  MODIFY `technicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_userlanguage`
--
ALTER TABLE `tbl_userlanguage`
  MODIFY `userlanguage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_userqualification`
--
ALTER TABLE `tbl_userqualification`
  MODIFY `userqualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_usertechnicalskill`
--
ALTER TABLE `tbl_usertechnicalskill`
  MODIFY `usertechnicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
