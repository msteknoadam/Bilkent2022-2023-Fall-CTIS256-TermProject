-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 01, 2023 at 05:30 PM
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
    `members` text NOT NULL,
    `owner_uid` int(11) NOT NULL) ENGINE = InnoDB DEFAULT CHARSET = utf8;

--
-- Dumping data for table `projects`
--
INSERT INTO `projects` (`id`, `name`, `description`, `year`, `semester`, `requirements`, `state`, `required_software`, `required_hardware`, `members`, `owner_uid`)
    VALUES (1, 'Documenting Profit/Loss of TEPE Holding', 'Are we profitting or are we in a loss?', '2023-2024', 'Spring', 'Make a graph of profit/loss over the last 6 months', 'accepted', 'Excel', 'Computer', 'Ayse, Goktug', 2), (2, 'Number of Fired People in 2022', 'Did the number of firings help making our situation better or worse?', '2023-2024', 'Fall', 'Show some graphs', 'waiting', 'Excel', 'Computer', 'Ayse', 2), (3, 'How to prevent CTIS students from taking MATH101?', 'CTIS students should not be able to take MATH101 in any ways and I need automatic email responder bot which says \"Quota is full\" whenever they ask \"Why did you not accept our override form?\"', '2023-2024', 'Spring', 'Need automatic email responder app ASAP', 'rejected', 'Python', 'Internet', 'Goktug', 3), (4, 'How to improve efficiency of CTIS261-262 Lectures?', 'I want to know how can I improve efficiency in lab sessions.', '2023-2024', 'Fall', 'Need a projectile of the future lab sessions\' efficiencies.', 'waiting', 'Excel', 'Computer', 'Ayse, Goktug', 4);

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
    VALUES (1, 'admin', 'admin@example.com', 'admin', 'admin', 'admin', '', '', '', ''), (2, 'firm', 'firm@example.com', 'firm', 'firm', '', 'Bilkent Holding', 'Ankara', 'Cankaya', 'Bilkent Kampusu Ankara'), (3, 'instructor', 'instructor@example.com', 'instructor', 'instructor', 'Fatihcan Atay', '', '', '', ''), (4, 'student', 'student@example.com', 'student', 'student', 'Berk Önder', '', '', '', '');

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
ALTER TABLE `projects` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 5;

COMMIT;

