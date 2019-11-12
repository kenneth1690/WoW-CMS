-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2019 at 09:23 PM
-- Server version: 10.1.38-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bugtracker`
--

CREATE TABLE `bugtracker` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `solved` int(11) NOT NULL DEFAULT '0',
  `solved_by` varchar(255) DEFAULT NULL,
  `solved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) UNSIGNED NOT NULL,
  `category_title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `changelogs`
--

CREATE TABLE `changelogs` (
  `id` int(11) NOT NULL,
  `content` mediumtext NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `giving_id` int(11) NOT NULL,
  `receiving_id` int(11) NOT NULL,
  `type` int(3) NOT NULL COMMENT '0 - negative, 1 - positive',
  `tidorpid` int(3) NOT NULL COMMENT '0 - tid, 1 - pid',
  `tid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs_acc`
--

CREATE TABLE `logs_acc` (
  `logid` int(11) NOT NULL,
  `logger` varchar(33) NOT NULL,
  `logger_id` int(33) NOT NULL,
  `logdetails` mediumtext NOT NULL,
  `logdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `logs_bugs`
--

CREATE TABLE `logs_bugs` (
  `logid` int(11) NOT NULL,
  `logger` varchar(33) NOT NULL,
  `logger_id` int(33) NOT NULL,
  `logdetails` mediumtext NOT NULL,
  `logdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs_forum`
--

CREATE TABLE `logs_forum` (
  `logid` int(11) NOT NULL,
  `logger` varchar(33) NOT NULL,
  `logger_id` int(33) NOT NULL,
  `logdetails` mediumtext NOT NULL,
  `logdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs_gm`
--

CREATE TABLE `logs_gm` (
  `logid` int(11) NOT NULL,
  `logger` varchar(33) NOT NULL,
  `logger_id` int(33) NOT NULL,
  `logger_gmlevel` int(33) NOT NULL,
  `logdetails` mediumtext NOT NULL,
  `logdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logs_tics`
--

CREATE TABLE `logs_tics` (
  `logid` int(11) NOT NULL,
  `logger` varchar(33) NOT NULL,
  `logger_id` int(33) NOT NULL,
  `logdetails` mediumtext NOT NULL,
  `logdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lotteries`
--

CREATE TABLE `lotteries` (
  `id` int(11) UNSIGNED NOT NULL,
  `category` int(3) NOT NULL COMMENT '1 - coins',
  `prize` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `winner` int(255) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '1' COMMENT '1 - active, 2 - finished'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(65) NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_posted` varchar(65) NOT NULL,
  `readed` int(3) NOT NULL DEFAULT '0',
  `readed_by_author` int(3) NOT NULL DEFAULT '1',
  `assigned_to` int(11) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages_answers`
--

CREATE TABLE `messages_answers` (
  `id` int(11) UNSIGNED NOT NULL,
  `mess_id` int(11) NOT NULL,
  `answer` mediumtext NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_posted` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `readed` int(3) NOT NULL DEFAULT '0',
  `user` int(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(3) UNSIGNED NOT NULL,
  `category_id` int(3) UNSIGNED NOT NULL,
  `subcategory_id` int(3) UNSIGNED NOT NULL,
  `topic_id` int(3) UNSIGNED NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date_posted` varchar(16) NOT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `conf_key` varchar(255) NOT NULL,
  `conf_value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`conf_key`, `conf_value`) VALUES
('sitename', 'WoW-CMS'),
('siteonline', 'yes'),
('offlinemessage', 'We are working hard to make everything usable.'),
('realmname', 'Realm Name'),
('realmip', '127.0.0.1'),
('realmport', '8085'),
('realmlist', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcat_id` int(3) UNSIGNED NOT NULL,
  `parent_id` int(3) UNSIGNED NOT NULL,
  `subcategory_title` varchar(128) NOT NULL,
  `subcategory_desc` varchar(255) NOT NULL,
  `special` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(65) NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_posted` varchar(65) NOT NULL,
  `readed` int(3) NOT NULL DEFAULT '1',
  `readed_by_gm` int(3) NOT NULL DEFAULT '0',
  `assigned_to` int(11) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_answers`
--

CREATE TABLE `ticket_answers` (
  `id` int(11) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `answer` mediumtext NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `date_posted` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(8) UNSIGNED NOT NULL,
  `category_id` int(3) UNSIGNED NOT NULL,
  `subcategory_id` int(3) UNSIGNED NOT NULL,
  `author` varchar(16) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` mediumtext NOT NULL,
  `date_posted` varchar(16) NOT NULL,
  `views` int(5) UNSIGNED NOT NULL,
  `replies` int(3) UNSIGNED NOT NULL,
  `locked` int(3) NOT NULL DEFAULT '0',
  `pinned` int(3) NOT NULL DEFAULT '0',
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` int(11) UNSIGNED NOT NULL,
  `seller` varchar(64) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `charid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `race` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `selled` int(11) NOT NULL DEFAULT '0',
  `buyer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bugtracker`
--
ALTER TABLE `bugtracker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `changelogs`
--
ALTER TABLE `changelogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs_acc`
--
ALTER TABLE `logs_acc`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `logs_bugs`
--
ALTER TABLE `logs_bugs`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `logs_forum`
--
ALTER TABLE `logs_forum`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `logs_gm`
--
ALTER TABLE `logs_gm`
  ADD PRIMARY KEY (`logid`);
  
--
-- Indexes for table `logs_gm`
--
ALTER TABLE `logs_tics`
  ADD PRIMARY KEY (`logid`);
  
--
-- Indexes for table `lotteries`
--
ALTER TABLE `lotteries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_answers`
--
ALTER TABLE `messages_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id_2` (`subcategory_id`),
  ADD KEY `topic_id_2` (`topic_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcat_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_answers`
--
ALTER TABLE `ticket_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `subcategory_id_2` (`subcategory_id`);
  
--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bugtracker`
--
ALTER TABLE `bugtracker`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `changelogs`
--
ALTER TABLE `changelogs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_acc`
--
ALTER TABLE `logs_acc`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_bugs`
--
ALTER TABLE `logs_bugs`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_forum`
--
ALTER TABLE `logs_forum`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_gm`
--
ALTER TABLE `logs_gm`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_gm`
--
ALTER TABLE `logs_tics`
  MODIFY `logid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lotteries`
--
ALTER TABLE `lotteries`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_answers`
--
ALTER TABLE `messages_answers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket_answers`
--
ALTER TABLE `ticket_answers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcat_id`),
  ADD CONSTRAINT `replies_ibfk_3` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
