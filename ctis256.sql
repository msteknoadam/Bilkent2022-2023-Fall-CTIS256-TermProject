-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 01, 2023 at 11:52 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

--
-- Database: `ctis256`
--
CREATE DATABASE IF NOT EXISTS `ctis256` DEFAULT CHARACTER
SET utf8 COLLATE utf8_general_ci;

USE `ctis256`;

-- --------------------------------------------------------
--
-- Table structure for table `projects`
--
DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
    `id` int(11) NOT NULL,
    `name` text NOT NULL,
    `description` text NOT NULL,
    `year` text NOT NULL,
    `semester` text NOT NULL,
    `requirements` text NOT NULL,
    `state` text NOT NULL,
    `required_software` text NOT NULL,
    `required_hardware` text NOT NULL,
    `members` text NOT NULL) ENGINE = InnoDB DEFAULT CHARSET = utf8;

--
-- Dumping data for table `projects`
--
INSERT INTO `projects` (`id`, `name`, `description`, `year`, `semester`, `requirements`, `state`, `required_software`, `required_hardware`, `members`)
    VALUES (1, 'CTIS256 Term Project', 'Term Project of Backend Development Course', '2022-2023', 'Fall', 'Make different userclasses\r\nGive each different permission', 'waiting', 'PHP\r\nMySQL\r\nApache', 'Computer\r\nInternet (actually not a hardware)', 'Ayse\r\nGoktug'), (2, 'CTIS257 Term Project', 'Term Project of CTIS257', '2022-2023', 'Spring', 'Page should load \"fast\" hehe\r\n99.999% Uptime', 'rejected', 'NodeJS\r\nNginx\r\nPostgreSQL', 'Computer\r\nInternet', 'Ayse\r\nGoktug'), (3, 'CTIS255 Term Project', 'Term Project of CTIS255 Lecture', '2021-2022', 'Spring', 'At least 5 different pages\r\nOne of the pages have to include game', 'accepted', 'HTML\r\nCSS\r\nJS\r\njQuery', 'Computer\r\nInternet', 'Ayse\r\nGoktug');

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `username` text NOT NULL,
    `email` text NOT NULL,
    `password` text NOT NULL,
    `userclass` text NOT NULL,
    `name` text,
    `firmname` text,
    `city` text,
    `district` text,
    `address` text) ENGINE = InnoDB DEFAULT CHARSET = utf8;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `username`, `email`, `password`, `userclass`, `name`, `firmname`, `city`, `district`, `address`)
    VALUES (1, 'msteknoadam', 'yesilyurt.gok@gmail.com', 'test', 'student', NULL, NULL, NULL, NULL, NULL), (2, 'msteknoadama', 'yesilyurt.gok@gmail.coma', 'aa', 'student', NULL, NULL, NULL, NULL, NULL), (3, 'msteknoadamaa', 'yesilyurt.gok@gmail.comaa', 'aaa', 'student', NULL, NULL, NULL, NULL, NULL), (4, 'msteknoadamz', 'yesilyurt.gok@gmail.comz', 'z', 'student', NULL, NULL, NULL, NULL, NULL), (5, 'msteknoadamzz', 'yesilyurt.gok@gmail.comzz', 'azz', 'student', NULL, NULL, NULL, NULL, NULL), (6, 'msteknoadamas', 'yesilyurt.gok@gmail.comas', 'as', 'student', NULL, NULL, NULL, NULL, NULL), (7, 'msteknoadamaaaa', 'yesilyurt.gok@gmail.comaaa', 'aaaa', 'student', NULL, NULL, NULL, NULL, NULL), (8, 'msteknoadamaz', 'yesilyurt.gok@gmail.comaz', 'az', 'student', NULL, NULL, NULL, NULL, NULL), (9, 'msteknoadamqq', 'yesilyurt.gok@gmail.comqq', 'qq', 'instructor', NULL, NULL, NULL, NULL, NULL), (10, 'msteknoadamstu1', 'yesilyurt.gok@gmail.comstu1', 'stu1', 'student', 'student5', NULL, NULL, NULL, NULL), (11, 'msteknoadamfirm1', 'yesilyurt.gok@gmail.comfirm1', 'firm1', 'firm', NULL, NULL, NULL, NULL, NULL), (12, 'msteknoadamfirm2', 'yesilyurt.gok@gmail.comfirm2', 'firm2', 'firm', '', 'firm2', 'city', 'district', 'address'), (13, 'msteknoadamfirm3', 'yesilyurt.gok@gmail.comfirm3', 'firm3', 'firm', '', 'firm3', 'city', 'district', 'address'), (14, 'msteknoadaminst1', 'yesilyurt.gok@gmail.cominst1', 'inst1', 'instructor', 'inst1', '', '', '', ''), (15, 'msteknoadamfirm5', 'yesilyurt.gok@gmail.comfirm5', 'firm5', 'firm', '', 'firm5', 'city', 'district', 'address');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 16;

COMMIT;

