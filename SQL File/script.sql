-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 12:56 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_assignments`
--

CREATE TABLE `assigned_assignments` (
  `assignment_id` varchar(11) NOT NULL,
  `assignment_name` varchar(20) NOT NULL,
  `marks` int(11) NOT NULL,
  `subject_code` varchar(11) DEFAULT NULL,
  `class_name` int(11) DEFAULT NULL,
  `department` varchar(45) NOT NULL,
  `assigned_date` date NOT NULL,
  `due_date` date NOT NULL,
  `assignment_file` varchar(64) DEFAULT NULL,
  `lecturer` varchar(45) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `vote_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_assignments`
--

INSERT INTO `assigned_assignments` (`assignment_id`, `assignment_name`, `marks`, `subject_code`, `class_name`, `department`, `assigned_date`, `due_date`, `assignment_file`, `lecturer`, `status`, `vote_count`) VALUES
('FMV', 'Create Main Layout', 5, 'VST ', 3, 'Software Engineering', '2020-05-14', '2020-05-31', '../assignments/Main Layout.pdf', 'Shakir Waseeb', 1, 0),
('FPA', 'Presentation', 3, 'AST ', 3, 'Software Engineering', '2020-05-14', '2020-05-31', NULL, 'Ali Serat', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_name` int(11) NOT NULL,
  `section_name` varchar(4) NOT NULL,
  `department` varchar(45) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_name`, `section_name`, `department`, `creation_date`) VALUES
(1, '', 'Software Engineering', '2020-05-14'),
(3, '', 'Database', '2020-04-24'),
(3, '', 'Networking', '2020-12-12'),
(3, '', 'Software Engineering', '2020-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `condidates`
--

CREATE TABLE `condidates` (
  `condidate_id` varchar(11) NOT NULL,
  `assignment_id` varchar(12) NOT NULL,
  `election_round` int(10) NOT NULL,
  `expire_date` date NOT NULL,
  `total_votes` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `condidates`
--

INSERT INTO `condidates` (`condidate_id`, `assignment_id`, `election_round`, `expire_date`, `total_votes`) VALUES
('13st', 'FPA', 1, '2020-05-31', 1),
('1st', 'FPA', 1, '2020-05-31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `done_assignments`
--

CREATE TABLE `done_assignments` (
  `assignment_id` varchar(11) NOT NULL,
  `student_rollno` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `done_assignment_file` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `done_assignments`
--

INSERT INTO `done_assignments` (`assignment_id`, `student_rollno`, `date`, `done_assignment_file`) VALUES
('FPA', '13st', '2020-05-14', 'done_assignments/Marya Presentation.pdf'),
('FPA', '1st', '2020-05-14', 'done_assignments/Mustafa Presentation.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `condidate_id` varchar(11) NOT NULL,
  `assignment_id` varchar(12) NOT NULL,
  `election_round` int(10) NOT NULL,
  `total_votes` int(11) NOT NULL,
  `annoced_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_rollno` varchar(11) NOT NULL,
  `fullname` varchar(64) NOT NULL,
  `class_name` int(11) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `photo` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `register_date` date NOT NULL,
  `email` varchar(64) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(64) NOT NULL,
  `section_name` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_rollno`, `fullname`, `class_name`, `department`, `photo`, `status`, `register_date`, `email`, `gender`, `password`, `section_name`) VALUES
('13ST', 'Marya Shams', 3, 'Software Engineering', '../image/female.png', 1, '2020-05-14', 'email@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', ''),
('15st', 'Sodaba Niazi', 3, 'Software Engineering', '../image/female.png', 1, '2020-04-16', 'female@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('17st', 'Aziza Sharifi', 3, 'Software Engineering', '../image/female.png', 1, '2020-04-16', 'female@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('18ST', 'Uzma Azimi', 3, 'Software Engineering', '../image/female.png', 1, '2020-05-14', 'email@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', ''),
('19st', 'Shahla Nasari', 3, 'Software Engineering', '../image/female.png', 1, '2020-04-16', 'female@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('1st', 'Mohammad Mustafa Hayat', 3, 'Software Engineering', '../image/1587123649BeautyPlus_20190429113807_save.jpg', 1, '2020-04-16', 'hayatzaimustafa@gmail.com', 'Male', '202cb962ac59075b964b07152d234b70', 'A'),
('21st', 'Khadija Hashimi', 3, 'Software Engineering', '../image/female.png', 1, '2020-04-16', 'female@gmail.com', 'Female', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('2st', 'Mohammad Yousuf Masror', 3, 'Software Engineering', '../image/male.png', 1, '2020-04-16', 'example@gmail.com', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('32ST', 'Mustafa Atal ', 3, 'Software Engineering', '../image/male.png', 1, '2020-05-14', 'email@gmail.com', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', ''),
('3st', 'Mohammad Yousuf Arab', 3, 'Software Engineering', '../image/male.png', 1, '2020-04-16', 'example@gmail.com', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('4st', 'Moulagul Hotak', 3, 'Software Engineering', '../image/male.png', 1, '2020-04-16', 'example@gmail.com', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', 'A'),
('5ST', 'Hamid Zazai', 3, 'Software Engineering', '../image/male.png', 1, '2020-05-14', 'example@gmail.com', 'Male', '827ccb0eea8a706c4c34a16891f84e7b', ''),
('HAYAT', 'My Student', 3, 'Software Engineering', '../image/male.png', 1, '2020-05-14', 'hayat@gmail.com', 'Male', '950a56032405dde76776304cc5b9ebca', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_code` varchar(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_name`, `creation_date`) VALUES
('AST', 'Agile Software Devolopment', '2020-04-24'),
('IST', 'Islamic Studies', '2020-05-11'),
('SPST', 'Software Project Management', '2020-04-17'),
('SST', 'Software Quality Assuriance', '2020-04-17'),
('VST', 'Visual Programming', '2020-04-17'),
('WST', 'Web Programming', '2020-05-11');

-- --------------------------------------------------------

--
-- Table structure for table `subject_class`
--

CREATE TABLE `subject_class` (
  `class_name` int(11) NOT NULL,
  `department` varchar(45) NOT NULL,
  `subject_code` varchar(11) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_class`
--

INSERT INTO `subject_class` (`class_name`, `department`, `subject_code`, `status`, `creation_date`) VALUES
(3, 'Software Engineering', 'AST', 1, '2020-05-14'),
(3, 'Software Engineering', 'IST', 1, '2020-05-14'),
(3, 'Software Engineering', 'SPST', 1, '2020-05-14'),
(3, 'Software Engineering', 'SST', 1, '2020-05-14'),
(3, 'Software Engineering', 'VST', 1, '2020-05-14'),
(3, 'Software Engineering', 'WST', 1, '2020-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo` varchar(64) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `photo`, `fullname`) VALUES
(6, 'admin', '202cb962ac59075b964b07152d234b70', '../image/male.png', 'Mohammad Mustafa  Hayat'),
(7, 'khadija', '202cb962ac59075b964b07152d234b70', '../image/male.png', 'Khadija Hayat');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `assignment_id` varchar(12) NOT NULL,
  `student_rollno` varchar(11) NOT NULL,
  `vote_date` date NOT NULL,
  `condidate_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`assignment_id`, `student_rollno`, `vote_date`, `condidate_id`) VALUES
('FPA', '13st', '2020-05-14', '13st'),
('FPA', '1st', '2020-05-14', '1st'),
('FPA', 'admin', '2020-05-14', '1st');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_assignments`
--
ALTER TABLE `assigned_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `assignment_subject_fk` (`subject_code`),
  ADD KEY `assignment_class_fk` (`class_name`,`department`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_name`,`department`);

--
-- Indexes for table `condidates`
--
ALTER TABLE `condidates`
  ADD PRIMARY KEY (`condidate_id`,`assignment_id`,`election_round`);

--
-- Indexes for table `done_assignments`
--
ALTER TABLE `done_assignments`
  ADD PRIMARY KEY (`assignment_id`,`student_rollno`),
  ADD KEY `don_student_fk` (`student_rollno`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_rollno`),
  ADD KEY `students_classes_fk` (`class_name`,`department`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- Indexes for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD PRIMARY KEY (`class_name`,`department`,`subject_code`),
  ADD KEY `subject_class_subjects_fk` (`subject_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`assignment_id`,`condidate_id`,`student_rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_assignments`
--
ALTER TABLE `assigned_assignments`
  ADD CONSTRAINT `assignment_class_fk` FOREIGN KEY (`class_name`,`department`) REFERENCES `classes` (`class_name`, `department`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_subject_fk` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `condidates`
--
ALTER TABLE `condidates`
  ADD CONSTRAINT `condidates_students_fk` FOREIGN KEY (`condidate_id`) REFERENCES `students` (`student_rollno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_condidates` FOREIGN KEY (`condidate_id`,`assignment_id`) REFERENCES `done_assignments` (`student_rollno`, `assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `done_assignments`
--
ALTER TABLE `done_assignments`
  ADD CONSTRAINT `don_assignment_fk` FOREIGN KEY (`assignment_id`) REFERENCES `assigned_assignments` (`assignment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `don_student_fk` FOREIGN KEY (`student_rollno`) REFERENCES `students` (`student_rollno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_classes_fk` FOREIGN KEY (`class_name`,`department`) REFERENCES `classes` (`class_name`, `department`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject_class`
--
ALTER TABLE `subject_class`
  ADD CONSTRAINT `subject_class_classes_fk` FOREIGN KEY (`class_name`,`department`) REFERENCES `classes` (`class_name`, `department`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_class_subjects_fk` FOREIGN KEY (`subject_code`) REFERENCES `subjects` (`subject_code`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
