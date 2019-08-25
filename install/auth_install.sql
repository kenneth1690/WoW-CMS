
--
-- Database: `auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

ALTER TABLE `account`
ADD `coins` INT(255) NOT NULL DEFAULT '0',
ADD `posts` INT(255) NOT NULL DEFAULT '0',
ADD `avatar` VARCHAR(255) NOT NULL DEFAULT 'no-avatar.png',
ADD `mailactivated` INT(11) NOT NULL DEFAULT '0';

--
-- Indexes for dumped tables
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
