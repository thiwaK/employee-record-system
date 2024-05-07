----------------------------------------
-- NRMC Employee Database             --
-- Thiwanka Kaushal (GIS Intern 2024) --
----------------------------------------



-- TODO
-- Generate dummy employee dataset


-- NOTE
-- Assume one employee can have many positions with time, one position can have many employees
-- We can't assign phone_office to a employee right? office phone number should belongs to the position/place + room

--------------
-- Settings --
--------------
SET time_zone = "+05:30"; -- SL Timezone

--------------------------------
-- Create Database and Tables --
--------------------------------
CREATE DATABASE IF NOT EXISTS `emp_nrmc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `emp_nrmc`;

-- Change id length from 11 to 2
-- Change division_name length from 300 to 60
-- Alter id to auto increment
CREATE TABLE `division` (
  `division_id` int(2) INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `division_name` varchar(60) NOT NULL
);

-- Change id length from 11 to 2
-- Alter id to auto increment
CREATE TABLE `salary_scale` (
  `scale_id` int(2) INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `scale_name` text NOT NULL
);

-- Change id length from 11 to 3
-- Alter id to auto increment
-- Alter table name from `post` to `position`
CREATE TABLE `position` (
  `position_id` int(3) INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `position_name` text NOT NULL
);

-- Alter email column into a table
-- Alter phone_mobile column into a table
-- Alter id to auto increment
-- Alter id to length from 11 to 5
-- Alter employee_id to employee_number
-- Alter column name `unit` into `division`. Stablish relation.
-- Alter phone_office length from 11 to 12
-- Alter column name `id_number` to `nic`
-- Alter column name `s_scale` to `salary_scale`
-- Make `nic` primary key
CREATE TABLE `employee` (
  -- `employee_id` int(5) INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `employee_number` int(11) NOT NULL,
  `name_with_initials` text NOT NULL,
  `name_denoted_initials` text NOT NULL,
  `date_of_birth` date NOT NULL,
  -- `id_number` text NOT NULL,
  `nic` text NOT NULL PRIMARY KEY,
  -- `email` text NOT NULL,
  `appointment` text NOT NULL,
  `salary_scale` text NOT NULL, -- Table Precence
  `permanent_address` text NOT NULL,
  `postal_address` text NOT NULL,
  `phone_office` int(12) NOT NULL,
  -- `phone_mobile` int(11) NOT NULL,
  -- `unit` text NOT NULL,
  `division_name` text NOT NULL, -- Table Precence
  `service_category` text NOT NULL,
  -- `class` text NOT NULL,
  `designation` text NOT NULL,
  `duties_assigned` text NOT NULL,
  `joined_public_date` date NOT NULL,
  `joined_nrmc` date NOT NULL,
  `status` text NOT NULL,
  `status_date` date NOT NULL DEFAULT current_timestamp(),
  `subject_to_desciplinary` text NOT NULL,
  FOREIGN KEY (division_name) REFERENCES division(division_name)
);


-- Additional Tables
CREATE TABLE email (
  id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  employee_id INT(5) NOT NULL,  -- Foreign key declaration
  FOREIGN KEY (employee_id) REFERENCES employee(employee_id)
);

CREATE TABLE mobile_phone (
  id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  phone_number VARCHAR(12) NOT NULL,
  employee_id INT NOT NULL,
  FOREIGN KEY (employee_id) REFERENCES employee(employee_id),
);

CREATE TABLE employee_class (
  class_id INT(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  class_name VARCHAR(12) NOT NULL,
  employee_id INT NOT NULL,
  change_date DATE NOT NULL,
  FOREIGN KEY (employee_id) REFERENCES employee(employee_id),
);

CREATE TABLE employee_position (
  employee_id INT NOT NULL,
  position_name INT NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE DEFAULT NULL,
  PRIMARY KEY (employee_id, position_name, start_date),
  FOREIGN KEY (employee_id) REFERENCES employee(employee_id),
  FOREIGN KEY (position_name) REFERENCES position(position_name)
);

CREATE TABLE employee_division (
  employee_id INT NOT NULL,
  division_name INT NOT NULL,
  start_date DATE NOT NULL,
  PRIMARY KEY (employee_id, division_name, start_date),
  FOREIGN KEY (employee_id) REFERENCES employee(employee_id),
  FOREIGN KEY (division_name) REFERENCES division(division_name)
);



-----------------
-- Insert Data --
-----------------

INSERT INTO `division` (`division_name`) VALUES
('Administration'),
('Soil Conservation'),
('Agro-Climatology & Climate'),
('Land Use Planning & Geo-Informatics'),
('Land and Water Resouces Management'),
('Knowledge Management');

INSERT INTO `salary_scale` ('scale_name') VALUES
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

INSERT INTO `position` ('position_name') VALUES
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
( 'Video Lighting/Electrical Assistant'),
( 'video Editing Assistant/video Assitant/Demonstration Assistant'),
( 'Waiter'),
( 'Watcher'),
( 'Labourer'),
( 'Labourer(According to 25/2014 circular)'),
( 'Sanitary Labourer'),
( 'Contract Labourer '),
( 'Officer in charge(Women Extension)'),
( 'Officer in charge(optional food crops)');
