-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2019 at 08:54 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_nrmc`
--
CREATE DATABASE IF NOT EXISTS `emp_nrmc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `emp_nrmc`;

-- --------------------------------------------------------

--
-- Table structure for table `divisions_of_nrmc`
--

CREATE TABLE `divisions_of_nrmc` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisions_of_nrmc`
--

INSERT INTO `divisions_of_nrmc` (`unit_id`, `unit_name`) VALUES
(1, 'Administration'),
(2, 'Soil Conservation'),
(3, 'Agro-Climatology climate'),
(4, 'Land use planning & Geo-Informatics'),
(5, 'Land and water Resouces Management'),
(6, 'Knowledge Management');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name_with_initials` text NOT NULL,
  `name_denoted_initials` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_number` text NOT NULL,
  `email` text NOT NULL,
  `appointment` text NOT NULL,
  `s_scale` text NOT NULL,
  `permanent_address` text NOT NULL,
  `postal_address` text NOT NULL,
  `phone_office` int(11) NOT NULL,
  `phone_mobile` int(11) NOT NULL,
  `unit` text NOT NULL,
  `service_category` text NOT NULL,
  `class` text NOT NULL,
  `designation` text NOT NULL,
  `duties_assigned` text NOT NULL,
  `joined_public_date` date NOT NULL,
  `joined_nrmc` date NOT NULL,
  `status` text NOT NULL,
  `status_date` date NOT NULL DEFAULT current_timestamp(),
  `subject_to_desciplinary` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `name_with_initials`, `name_denoted_initials`, `date_of_birth`, `id_number`, `email`, `appointment`, `s_scale`, `permanent_address`, `postal_address`, `phone_office`, `phone_mobile`, `unit`, `service_category`, `class`, `designation`, `duties_assigned`, `joined_public_date`, `joined_nrmc`, `status`, `status_date`, `subject_to_desciplinary`) VALUES
(12, 60080, 'R.M.P.M.B Rathnayake', 'Rathnayake Mudiyanselage Prageeth Malinda Bandara Rathnayake', '1985-03-30', '850902399V', 'prageeth.rathnayake@gmail.com', 'Yes', 'MN-6', 'No 52, Kapuliyadda', 'No 52, Kapuliyadda', 812385555, 774064545, 'Land use planning & Geo-Informatics', 'Srilanka Information and communication Technology Service', '2-II', 'Information and  Communication Technology Officer', 'IT related', '2013-07-04', '0000-00-00', 'Current Employee', '0000-00-00', 'NO'),
(5, 10020, 'S. Kethiswaran', 'Sarojini', '1990-04-25', '904561231V', 'saroji90@yahoo.com', 'Peramanent', 'MN-1', 'Jaffna', 'Pilimathalawa', 812385555, 715555556, 'Land and water management', 'Research Assistant', '3-III', 'Research Assistant', 'Research', '2019-10-24', '0000-00-00', 'Current Employee', '0000-00-00', 'No'),
(13, 10021, 'M.Subramanium', 'Mavi', '1989-04-25', '894561231V', 'saroji90@yahoo.com', 'Yes', 'MN-1', 'Kareinagar Rd,Jaffna', '27,Mahakanda', 812385555, 715222556, 'Land and water Resouces Management', 'Research Assistant', '3-III', 'Research Sub Assistant', 'Research', '2019-10-24', '0000-00-00', 'Current Employee', '0000-00-00', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `position` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `position`) VALUES
(6, 'Director'),
(7, 'Additional Director'),
(12, 'Principal Agriculture Scientist '),
(13, 'Principal Agriculturist '),
(20, 'Deputy Director'),
(31, 'Lecturer (Tamil Medium) -contract'),
(32, 'Lecturer (English Medium) -contract'),
(33, 'Administrative  Officer'),
(34, 'Senior Librarian'),
(35, 'Agriculture Instructor (Special)'),
(36, 'Research Assistant (Special)'),
(38, 'Translator(English/Tamil)'),
(39, 'Information and  Communication Technology Officer'),
(40, 'Agriculture Monitoring Officer'),
(41, 'Programme Assistant( Agriculture)'),
(44, 'Development Officer'),
(45, 'Librarian (I/II/III)'),
(47, 'Agriculture Instructor'),
(48, 'Research Assistant'),
(53, 'Public Management Assistant'),
(54, 'Technical Assistant (Extention)'),
(59, 'Information and Technology Assistant'),
(62, 'Agriculture Extension Officer'),
(63, 'Photographer'),
(64, 'Bee Demonstrator'),
(65, 'Farm Clerk'),
(66, 'Male Warden'),
(67, 'Female Warden'),
(68, 'Seed Technician'),
(69, 'Artist'),
(70, 'Driver'),
(71, 'Cinema Operator'),
(72, 'Tractor Operator'),
(73, 'Storeman'),
(74, 'Plant Yard Attendant'),
(75, 'Mechanic'),
(76, 'Machinist'),
(77, 'Carpenter'),
(78, 'Mason'),
(79, 'Electrician'),
(80, 'Machine Minder'),
(81, 'Video Editor'),
(82, 'Audio Recorder'),
(83, 'Technician'),
(84, 'Video Lighting/Electrical Assistant'),
(85, 'Compositor'),
(86, 'Research Sub Assistant'),
(87, 'Book Binder (Press)'),
(88, 'Bee Keeper'),
(89, 'Budder'),
(90, 'Steward'),
(91, 'Cook'),
(92, 'Seed Man'),
(93, 'Circuit  Bungalow Keeper'),
(94, 'Lorry Cleaner'),
(95, 'Office Employee Service'),
(96, 'Video Lighting/Electrical Assistant'),
(97, 'video Editing Assistant/video Assitant/Demonstration Assistant'),
(98, 'Waiter'),
(99, 'Watcher'),
(100, ' Labourer'),
(101, ' Labourer(According to 25/2014 circular)'),
(102, 'Sanitary Labourer'),
(103, 'Contract Labourer '),
(104, 'Officer in charge(Women Extension)'),
(105, 'Officer in charge(optional food crops)');

-- --------------------------------------------------------

--
-- Table structure for table `salary_scale`
--

CREATE TABLE `salary_scale` (
  `s_scale_id` int(11) NOT NULL,
  `s_scale` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary_scale`
--

INSERT INTO `salary_scale` (`s_scale_id`, `s_scale`) VALUES
(1, 'SL-03'),
(2, 'SL-01'),
(3, 'MN-7'),
(4, 'MN-6'),
(5, 'MN-4'),
(6, 'MN-3'),
(7, 'MN-2'),
(8, 'MT-1'),
(9, 'MN-1'),
(10, 'PL-2'),
(11, 'PL-1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `accounttype` text NOT NULL,
  `userunit` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `accounttype`, `userunit`) VALUES
(1, 'Maxwell', 'Morrison', 'xxx2xy', '10a55271c201e41913764ff95b33248b', 'Admin', NULL),
(3, 'Maxwell', 'Morrison', 'admins', '4a7f064e93e8f12f3d364413af1d3b8c', 'Admin', NULL),
(4, 'lakshi', 'hansi', 'lakshi', 'a81c63ad340d215af51d397175dadc1c', 'Employee', NULL),
(5, 'chamal', 'sachin', 'sachin', 'f264b55ff18a3fb557e91572887b0327', 'superuser', NULL),
(0, 'Mangala', 'Senadheera', 'Mangala', '3839c6205ad2a2dd198c68403ed17850', 'Admin', 'Administration');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `salary_scale`
--
ALTER TABLE `salary_scale`
  ADD PRIMARY KEY (`s_scale_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
