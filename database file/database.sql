
-- NRMC Employee Database            

-- Commit comment
-- * alter inefficient data definitions
-- * restructure complex tables
-- * add additional but necessary table fields
-- * add additional but necessary tables
-- * Drop unwanted fields
-- * Create relationships
-- * reduce data redundancy

-- TODO
-- Generate dummy employee dataset


-- Settings
SET time_zone = "+05:30";


-- Create Database and Tables 
CREATE DATABASE IF NOT EXISTS `emp_nrmc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `emp_nrmc`;

-- Change id length from 11 to 2
-- Change division_name length from 300 to 60
-- Alter id to auto increment
CREATE TABLE `divisions` (
  `division_id` int(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `division_name` varchar(60) NOT NULL
);

-- Change id length from 11 to 2
-- Alter id to auto increment
CREATE TABLE `salary_scales` (
  `scale_id` int(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `scale_name` varchar(10) NOT NULL
);

-- Change id length from 11 to 3
-- Alter id to auto increment
-- Alter table name from `post` to `position`
CREATE TABLE `positions` (
  `position_id` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position_name` varchar(250) NOT NULL UNIQUE
);

CREATE TABLE `employee_classes` (
  `class_id` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `class_name` varchar(25) NOT NULL UNIQUE
);

CREATE TABLE `employee_status` (
  `status_id` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `status_name` varchar(25) NOT NULL UNIQUE
);



-- Alter id to auto increment
-- Alter id to length from 11 to 5
-- Alter employee_id to employee_number
-- Alter column name `unit` into `division`. Stablish relation.
-- Alter phone_office length from 11 to 12
-- Alter column name `id_number` to `nic`
-- Alter column name `s_scale` to `salary_scale`
-- Make `nic` primary key
CREATE TABLE `employees` (
  `employee_number` varchar(11) NOT NULL PRIMARY KEY,
  `name_with_initials` varchar(150) NOT NULL,
  `name_denoted_initials` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `nic` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `permanent_address` varchar(100) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `appointment` TINYINT(1) NOT NULL,
  `salary_scale` varchar(10) NOT NULL, -- Table Precence
  `phone_office` int(12) NOT NULL,
  `phone_mobile` int(11) NOT NULL,
  `division_name` varchar(100) NOT NULL, -- Table Precence
  `service_category` varchar(20) NOT NULL,
  `class` varchar(25) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `duties_assigned` varchar(500) NOT NULL,
  `joined_public_date` date NOT NULL,
  `joined_nrmc` date NOT NULL,
  `status` varchar(25) NOT NULL,
  `status_date` date NOT NULL DEFAULT current_timestamp(),
  `subject_to_desciplinary` TINYINT(1) NOT NULL
);

-- Change id length from 11 to 2
-- Drop fields `firstname`, `lastname`, `userunit`
-- Add relationship to employee table
-- Auto incrementing user_id
CREATE TABLE `users` (
  `user_id` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `accounttype` text NOT NULL,
  `employee_number` varchar(11) NOT NULL,
  FOREIGN KEY (employee_number) REFERENCES employees(employee_number)
);




-- Insert Data 
INSERT INTO `divisions` (`division_name`) VALUES
('Administration'),
('Soil Conservation'),
('Agro-Climatology & Climate'),
('Land Use Planning & Geo-Informatics'),
('Land and Water Resouces Management'),
('Knowledge Management');

INSERT INTO `salary_scales` (`scale_name`) VALUES
('SL-03'), 
('SL-01'), 
('MN-7'), 
('MN-6'), 
('MN-4'), 
('MN-3'), 
('MN-2'), 
('MT-1'), 
('MN-1'), 
('PL-2'), 
('PL-1');

INSERT INTO `employee_classes` (`class_name`) VALUES
('SP'),
('I'),
('II'),
('III'),
('I-II'),
('I-III'),
('2-I'),
('2-II'),
('3-I'),
('3-II'),
('3-III');

INSERT INTO `employee_status` (`class_name`) VALUES
('Current Employee'),
('Retired Employee'),
('Transferred Employee');

INSERT INTO `positions` (`position_name`) VALUES
( 'Director'),
( 'Additional Director'),
( 'Principal Agriculture Scientist'),
( 'Principal Agriculturist'),
( 'Deputy Director'),
( 'Lecturer(Tamil Medium) -contract'),
( 'Lecturer(English Medium) -contract'),
( 'Administrative Officer'),
( 'Senior Librarian'),
( 'Agriculture Instructor(Special)'),
( 'Research Assistant(Special)'),
( 'Translator(English/Tamil)'),
( 'Information and Communication Technology Officer'),
( 'Agriculture Monitoring Officer'),
( 'Programme Assistant(Agriculture)'),
( 'Development Officer'),
( 'Librarian(I/II/III)'),
( 'Agriculture Instructor'),
( 'Research Assistant'),
( 'Public Management Assistant'),
( 'Technical Assistant(Extention)'),
( 'Information and Technology Assistant'),
( 'Agriculture Extension Officer'),
( 'Photographer'),
( 'Bee Demonstrator'),
( 'Farm Clerk'),
( 'Male Warden'),
( 'Female Warden'),
( 'Seed Technician'),
( 'Artist'),
( 'Driver'),
( 'Cinema Operator'),
( 'Tractor Operator'),
( 'Storeman'),
( 'Plant Yard Attendant'),
( 'Mechanic'),
( 'Machinist'),
( 'Carpenter'),
( 'Mason'),
( 'Electrician'),
( 'Machine Minder'),
( 'Video Editor'),
( 'Audio Recorder'),
( 'Technician'),
( 'Video Lighting/Electrical Assistant'),
( 'Compositor'),
( 'Research Sub Assistant'),
( 'Book Binder (Press)'),
( 'Bee Keeper'),
( 'Budder'),
( 'Steward'),
( 'Cook'),
( 'Seed Man'),
( 'Circuit  Bungalow Keeper'),
( 'Lorry Cleaner'),
( 'Office Employee Service'),
( 'video Editing Assistant/video Assitant/Demonstration Assistant'),
( 'Waiter'),
( 'Watcher'),
( 'Labourer'),
( 'Labourer(According to 25/2014 circular)'),
( 'Sanitary Labourer'),
( 'Contract Labourer '),
( 'Officer in charge(Women Extension)'),
( 'Officer in charge(optional food crops)'),
( 'Intern');


INSERT INTO `employees` 
(`employee_number`, `name_with_initials`,               `name_denoted_initials`, `date_of_birth`, `nic`,        `email`,                          `appointment`, `salary_scale`, `permanent_address`, `postal_address`, `phone_office`, `phone_mobile`, `division_name`,                       `service_category`, `class`, `designation`, `duties_assigned`, `joined_public_date`, `joined_nrmc`, `status`,           `status_date`, `subject_to_desciplinary`) VALUES \
('TK-0001',         'M.W. Thiwanka Kaushal Munasinghe', 'M... W...',             '1999-06-19',    '991010101v', 'thiwanka.kaushal.mob@gmail.com', '0',           'SP' ,          'Kurunegala',        'Kurunegala',     '777123456',    '777123456',    'Land Use Planning & Geo-Informatics', 'Intern',           'I',     'Intern',      'Developer',       '2024-04-29',         '2024-04-29',  'Current Employee', '2024-04-29',  '0');

INSERT INTO `users` (`username`, `password`, `accounttype`, `employee_number`) VALUES
('TK', 'WhoCares', 'Admin', 'TK-0001')