-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 03, 2020 at 02:52 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `mailer_lite`
--
GRANT ALL on rest_api.* to kaszanka@'%';
CREATE DATABASE IF NOT EXISTS `rest_api` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rest_api`;

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `fields_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `value` varchar(256) NOT NULL,
  `fields_types_id` int(11) NOT NULL,
  `subscribers_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`fields_id`, `name`, `value`, `fields_types_id`, `subscribers_id`, `deleted`) VALUES
(1, 'NamePlaceHolder', 'Marcin', 3, 3, 0),
(2, 'SNamePlaceHolder', 'Batmanski', 3, 3, 0),
(3, 'NamePlaceHolder', 'Batman', 3, 3, 0),
(4, 'NamePlaceHolder', 'Ola', 3, 5, 0),
(5, 'NamePlaceHolder', 'Aleksandra', 3, 5, 0),
(6, 'NamePlaceHolder', 'trst', 3, 5, 0),
(7, 'NamePlaceHolder', 'Batman', 3, 8, 0),
(18, 'mail', 'ms', 2, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fields_types`
--

CREATE TABLE `fields_types` (
  `fields_types_id` int(11) NOT NULL,
  `type_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields_types`
--

INSERT INTO `fields_types` (`fields_types_id`, `type_name`) VALUES
(1, 'date'),
(2, 'number'),
(3, 'string'),
(4, 'boolean');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `states_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`states_id`, `name`) VALUES
(1, 'active'),
(2, 'unsubscribed'),
(3, 'junk'),
(4, 'bounced'),
(5, 'unconfirmed'),
(6, 'deleted');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscribers_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email_address` varchar(256) NOT NULL,
  `created_date` datetime NOT NULL,
  `changed_date` datetime NOT NULL,
  `states_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`subscribers_id`, `name`, `email_address`, `created_date`, `changed_date`, `states_id`) VALUES
(3, 'ms', 'suchomski.marcin@gmail.com', '2020-09-03 19:33:37', '2020-09-06 11:33:02', 6),
(4, 'OlaKucab', 'olsak94@gmail.com', '2020-09-03 19:33:37', '2020-09-03 14:26:56', 1),
(5, 'marcin', 'suchomski.marcin@gmail.com', '2020-09-03 19:33:37', '2020-09-06 10:46:00', 3),
(6, 'Ola', 'Kucab@gmail.com', '2020-09-03 19:33:37', '2020-09-03 19:33:37', 2),
(11, 'MSMSM', 'Kucab@gmail.com', '2020-09-03 13:50:23', '2020-09-03 13:50:23', 2),
(12, 'Morning Batman', 'suchomski.marcin@gmail.com', '2020-09-04 06:43:46', '2020-09-04 06:43:46', 5),
(16, 'aaaa', 'aaa@wp.pl', '2020-09-05 17:22:37', '2020-09-05 17:26:43', 6),
(17, 'ms', 'wp.pl@wp.pl', '2020-09-06 11:16:17', '2020-09-06 11:16:17', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`fields_id`);

--
-- Indexes for table `fields_types`
--
ALTER TABLE `fields_types`
  ADD PRIMARY KEY (`fields_types_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`states_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscribers_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `fields_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fields_types`
--
ALTER TABLE `fields_types`
  MODIFY `fields_types_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `states_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `subscribers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
