-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 03:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_admin`
--

CREATE TABLE `mst_admin` (
  `id` int(11) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_admin`
--

INSERT INTO `mst_admin` (`id`, `loginid`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mst_result`
--

CREATE TABLE `mst_result` (
  `id` int(10) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `user_id` int(5) DEFAULT NULL,
  `test_date` timestamp NULL DEFAULT NULL,
  `score` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_result`
--

INSERT INTO `mst_result` (`id`, `login`, `user_id`, `test_date`, `score`) VALUES
(17, 'bhushan', 16, '2021-04-20 18:30:00', 10),
(18, 'bhushan1', 17, '2021-04-20 18:30:00', 8),
(76, 'rajashree', 15, '2021-04-20 18:30:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `user_id` int(5) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`user_id`, `login`, `pass`, `username`, `email`) VALUES
(15, 'rajashree', 'rajashree', 'rajashree naik', 'naikraju2009@gmail.com'),
(16, 'bhushan', 'bhushan', 'bhushan shelar', 'bhushan@gmail.com'),
(17, 'bhushan1', 'bhushan', 'bhushan shelar', 'bhushan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mst_useranswer`
--

CREATE TABLE `mst_useranswer` (
  `id` int(10) NOT NULL,
  `uesr_id` int(50) NOT NULL,
  `q_type` varchar(50) NOT NULL,
  `que_des` varchar(200) DEFAULT NULL,
  `true_ans` varchar(255) DEFAULT NULL,
  `your_ans` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_useranswer`
--

INSERT INTO `mst_useranswer` (`id`, `uesr_id`, `q_type`, `que_des`, `true_ans`, `your_ans`) VALUES
(81, 16, 'multiple', 'Which company developed the video game &quot;Borderlands&quot;?', 'Gearbox Software', 'Gearbox Software'),
(82, 16, 'multiple', 'In the movie &ldquo;The Iron Giant,&rdquo; this character is the protagonist.', 'Hogarth Hughes', 'Hogarth Hughes'),
(83, 16, 'boolean', 'French is an official language in Canada.', 'True', 'True'),
(84, 16, 'multiple', 'What is the name of the virus in &quot;Metal Gear Solid 1&quot;?', 'FOXDIE', 'FOXDIE'),
(85, 16, 'multiple', 'Which of these characters was NOT planned to be playable for Super Smash Bros. 64?', 'Peach', 'Peach'),
(86, 16, 'multiple', 'Which modern country is known as &quot;The Graveyard of Empires&quot;?', 'Afghanistan', 'Afghanistan'),
(87, 16, 'multiple', 'Which of these characters is NOT a boss in Crash Bash?', 'Ripper Roo', 'Ripper Roo'),
(88, 16, 'multiple', 'How many countries share a land border with Luxembourg?', '3', '3'),
(89, 16, 'boolean', 'Rhode Island is actually located on the US mainland, despite its name.', 'True', 'True'),
(90, 16, 'boolean', 'The Python programming language gets its name from the British comedy group &quot;Monty Python.&quot;', 'True', 'True'),
(91, 17, 'multiple', 'What is Pikachu&#039;s National Pok&eacute;Dex Number?', '#025', '#025'),
(92, 17, 'boolean', 'The game &quot;Battlefield 1&quot; takes place during World War I.', 'True', 'True'),
(93, 17, 'multiple', 'Which water-type Pok&eacute;mon starter was introduced in the 4th generation of the series?', 'Piplup', 'Piplup'),
(94, 17, 'multiple', 'Which show is known for the songs &quot;You are a Pirate&quot;, &quot;Cooking by the Book&quot; and &quot;We Are Number One&quot;?', 'LazyTown', 'LazyTown'),
(95, 17, 'multiple', 'In &quot;Fallout 4&quot;, what is the name of the dog you find at Red Rocket truck stop?', 'Dogmeat', 'Dogmeat'),
(96, 17, 'boolean', 'Adolf Hitler was accepted into the Vienna Academy of Fine Arts.', 'False', 'True'),
(97, 17, 'multiple', 'In what year was the Oculus Rift revealed to the public through a Kickstarter campaign?', '2012', '2012'),
(98, 17, 'multiple', 'Which anime did Seiji Kishi NOT direct?', 'Another', 'Another'),
(99, 17, 'multiple', 'In the game &quot;Red Dead Redemption&quot;, what is the name of John Marston&#039;s dog?', 'Rufus', 'Rufus'),
(100, 17, 'boolean', 'Is Tartu the capital of Estonia?', 'False', 'True'),
(683, 15, 'multiple', 'Who recorded the 1975 album &#039;Captain Fantastic and the Brown Dirt Cowboy&#039;?', 'Elton John', 'Elton John'),
(684, 15, 'multiple', 'What is the largest organ of the human body?', 'Skin', 'Liver'),
(685, 15, 'multiple', 'Which gas forms about 78% of the Earth&rsquo;s atmosphere?', 'Nitrogen', 'Carbon Dioxide'),
(686, 15, 'multiple', 'In &quot;Undertale&quot;, how many main endings are there?', '3', '13'),
(687, 15, 'multiple', 'When did the last episode of &quot;Futurama&quot; air?', 'September 4, 2013', 'December 25, 2010'),
(688, 15, 'multiple', 'Who is the founder of Team Fortress 2&#039;s fictional company &quot;Mann Co&quot;?', 'Zepheniah Mann', 'Wallace Breem'),
(689, 15, 'multiple', 'The biggest distinction between a eukaryotic cell and a prokaryotic cell is:', 'The presence or absence of a nucleus', 'The presence or absence of certain organelles'),
(690, 15, 'multiple', 'Which day in &quot;Papers, Please&quot; does the man in red appear?', 'Day 23', 'Day 23'),
(691, 15, 'multiple', 'What is the official name of the star located closest to the North Celestial Pole?', 'Polaris', 'Polaris'),
(692, 15, 'multiple', 'Who won the UEFA Champions League in 2016?', 'Real Madrid C.F.', 'Manchester City F.C.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_admin`
--
ALTER TABLE `mst_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_result`
--
ALTER TABLE `mst_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `mst_useranswer`
--
ALTER TABLE `mst_useranswer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_admin`
--
ALTER TABLE `mst_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mst_result`
--
ALTER TABLE `mst_result`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_useranswer`
--
ALTER TABLE `mst_useranswer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
