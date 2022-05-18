-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 03:40 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sampledb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `email_id`, `password`) VALUES
('admin', 'admin123@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Festival', 'different kind of festivals '),
(2, 'Art', ''),
(3, 'Culture', ''),
(4, 'Technology', ''),
(5, 'Sports', ''),
(6, 'Others', ''),
(7, 'Marriage', '');

-- --------------------------------------------------------

--
-- Table structure for table `catering`
--

CREATE TABLE `catering` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `diet` varchar(50) NOT NULL,
  `water` varchar(50) NOT NULL,
  `sweets` varchar(50) NOT NULL,
  `snacks_and_drinks` varchar(50) NOT NULL,
  `ice_cream` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `catering`
--

INSERT INTO `catering` (`user_id`, `event_id`, `type`, `diet`, `water`, `sweets`, `snacks_and_drinks`, `ice_cream`) VALUES
(11, 112, 'seating', 'nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'vanilla'),
(2, 113, 'buffet', 'nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'vanilla'),
(1, 114, 'buffet', 'veg_and_nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'butterscotch blackcurrent pistachio'),
(11, 115, 'buffet_and_seating', 'veg_and_nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'chocolate vanilla butterscotch blackcurrent'),
(2, 116, 'buffet_and_seating', 'veg_and_nonveg', 'cool_water', 'sweets_yes', 'snacks_and_drinks_yes', 'vanilla butterscotch pistachio'),
(11, 117, 'buffet_and_seating', 'veg_and_nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'vanilla butterscotch blackcurrent'),
(11, 118, 'buffet_and_seating', 'nonveg', 'cool_water', 'sweets_yes', 'snacks_and_drinks_yes', 'chocolate strawberry blackcurrent'),
(3, 119, 'buffet', 'veg_and_nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'vanilla butterscotch pistachio'),
(10, 120, 'buffet_and_seating', 'veg_and_nonveg', 'cool_and_normal_water', 'sweets_yes', 'snacks_and_drinks_yes', 'chocolate vanilla strawberry butterscotch blackcur'),
(3, 121, 'buffet', 'veg', 'cool_and_normal_water', 'sweets_yes', 'no', 'chocolate vanilla butterscotch'),
(1, 122, 'buffet', 'veg', 'cool_water', 'no', 'no', 'chocolate vanilla butterscotch');

-- --------------------------------------------------------

--
-- Table structure for table `decorations`
--

CREATE TABLE `decorations` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `lights` varchar(50) NOT NULL,
  `flowers` varchar(50) NOT NULL,
  `balloons` varchar(50) NOT NULL,
  `seating` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `decorations`
--

INSERT INTO `decorations` (`user_id`, `event_id`, `lights`, `flowers`, `balloons`, `seating`) VALUES
(1, 114, 'royal_lights', 'delux_flowers', 'royal_balloons', 'sofa_and_chair'),
(1, 122, 'normal_lights', 'normal_flowers', 'no', 'chair'),
(2, 113, 'delux_lights', 'normal_flowers', 'royal_balloons', 'sofa_and_chair'),
(2, 116, 'delux_lights', 'royal_flowers', 'normal_ballons', 'sofa_and_chair'),
(3, 119, 'normal_lights', 'no', 'no', 'chair'),
(3, 121, 'normal_lights', 'no', 'no', 'chair'),
(10, 120, 'royal_lights', 'no', 'no', 'sofa_and_chair'),
(11, 112, 'royal_lights', 'normal_flowers', 'delux_balloons', 'sofa'),
(11, 115, 'royal_lights', 'delux_flowers', 'normal_balloons', 'sofa_and_chair'),
(11, 117, 'normal_lights', 'no_flowers', 'no_balloons', 'sofa_and_chair'),
(11, 118, 'royal_lights', 'delux_flowers', 'normal_balloons', 'sofa_and_chair');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(155) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_guests` int(30) DEFAULT NULL,
  `venue` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `total_cost` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `username`, `name`, `description`, `category`, `start_date`, `end_date`, `number_of_guests`, `venue`, `status`, `total_cost`) VALUES
(112, 'Aneesha', 'Holi', 'Festival', 'Festival', '2022-03-26', '2022-03-27', 20, 'ABC Palace	', 'Cancelled', 145900),
(113, 'Charles Miles', 'Birthday', 'Friend Birthday', 'Others', '2022-03-30', '2022-03-31', 10, 'HZ Villa	', 'Cancelled', 147700),
(114, 'Ben', 'Marriage', 'Marriage', 'Marriage', '2022-04-07', '2022-04-10', 80, 'PQR Grounds	', 'Completed', 206700),
(115, 'Aneesha', 'Marriage', 'Mrriage', 'Marriage', '2022-03-20', '2022-03-25', 20, 'SJS Palace	', 'Cancelled', 209700),
(116, 'Charles Miles', 'Marriage', 'Friend Marriage', 'Marriage', '2022-04-20', '2022-04-23', 100, 'PQR Grounds	', 'Approved', 172800),
(117, 'Aneesha', 'TechnoFest', 'Tech Fest', 'Technology', '2022-04-15', '2022-04-20', 50, 'SJS Palace	', 'Approved', 152000),
(118, 'Aneesha', 'Cultural Event', 'Cultural Fest', 'Culture', '2022-04-14', '2022-04-18', 100, 'ABC Palace	', 'Completed', 176200),
(119, 'Christine', 'Create Art', 'Art Exhibition', 'Art', '2022-04-23', '2022-04-18', 50, 'HZ Villa', 'Cancelled', 146500),
(120, 'Tony', 'Tech Expo', 'Tech Exhibition', 'Technology', '2022-04-25', '2022-04-30', 250, 'PQR Grounds', '', 189000),
(121, 'Christine', 'Alpha Sports', 'Sports Competions and Felicitation', 'Sports', '2022-05-05', '2022-05-10', 150, 'PQR Grounds', '', 118500),
(122, 'Ben', 'College Fest', 'College fest', 'Others', '2022-04-23', '2022-04-26', 100, 'PQR Grounds', '', 875250);

-- --------------------------------------------------------

--
-- Table structure for table `other_service`
--

CREATE TABLE `other_service` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `mehandhi` varchar(50) NOT NULL,
  `photographs` varchar(50) NOT NULL,
  `band` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other_service`
--

INSERT INTO `other_service` (`user_id`, `event_id`, `mehandhi`, `photographs`, `band`) VALUES
(1, 114, 'mehandhi_yes', 'photographer_yes', 'band_yes'),
(1, 122, 'no', 'photographer_yes', 'no'),
(2, 113, 'mehandhi_no', 'photographer_yes', 'band_no'),
(2, 116, 'mehandhi_no', 'photographer_yes', 'band_yes'),
(3, 119, 'no', 'photographer_yes', 'no'),
(3, 121, 'no', 'photographer_yes', 'no'),
(10, 120, 'no', 'photographer_yes', 'no'),
(11, 112, 'mehandhi_no', 'photographer_no', 'band_yes'),
(11, 115, 'mehandhi_yes', 'photographer_yes', 'band_yes'),
(11, 117, 'mehandhi_no', 'photographer_yes', 'band_no'),
(11, 118, 'mehandhi_no', 'photographer_yes', 'band_no');

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

CREATE TABLE `pricing` (
  `item_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`item_id`, `name`, `price`) VALUES
(1, 'normal_lights', 25000),
(2, 'delux_lights', 35000),
(3, 'royal_lights', 50000),
(4, 'normal_balloons', 1500),
(5, 'delux_balloons', 3700),
(6, 'royal_balloons', 4500),
(7, 'normal_flowers', 3700),
(8, 'delux_flowers', 5200),
(9, 'royal_flowers', 6300),
(10, 'sofa', 10000),
(11, 'chair', 7000),
(12, 'sofa_and_chair', 8000),
(13, 'buffet', 8000),
(14, 'seating', 10000),
(15, 'buffet_and_seating', 13000),
(16, 'veg', 20000),
(17, 'nonveg', 30000),
(18, 'veg_and_nonveg', 40000),
(19, 'normal_water', 3000),
(20, 'cool_water', 4000),
(21, 'cool_and_normal_water', 3500),
(22, 'sweets_yes', 6000),
(23, 'snacks_and_drinks_yes', 7000),
(24, 'chocolate', 4000),
(25, 'vanilla', 2000),
(26, 'strawberry', 3000),
(27, 'butterscotch', 3000),
(28, 'blackcurrent', 4500),
(29, 'pistachio', 5000),
(30, 'mehandhi_yes', 2000),
(31, 'photographer_yes', 40000),
(32, 'band_yes', 20000),
(33, 'no', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ratee`
--

CREATE TABLE `ratee` (
  `id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `feedback` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `category` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_guests` varchar(30) NOT NULL,
  `venue` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `diet` varchar(30) NOT NULL,
  `water` varchar(30) NOT NULL,
  `sweets` varchar(30) NOT NULL,
  `snacks_and_drinks` varchar(30) NOT NULL,
  `ice_cream` varchar(50) NOT NULL,
  `lights` varchar(30) NOT NULL,
  `flowers` varchar(30) NOT NULL,
  `balloons` varchar(30) NOT NULL,
  `seating` varchar(30) NOT NULL,
  `mehandhi` varchar(30) NOT NULL,
  `photographs` varchar(30) NOT NULL,
  `band` varchar(30) NOT NULL,
  `total_cost` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `card_number` bigint(16) NOT NULL,
  `card_holder_name` varchar(30) NOT NULL,
  `expiration_month` int(2) NOT NULL,
  `expiration_year` int(4) NOT NULL,
  `total_amount` int(15) NOT NULL,
  `paid_amount` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `event_id`, `user_id`, `user_name`, `card_number`, `card_holder_name`, `expiration_month`, `expiration_year`, `total_amount`, `paid_amount`) VALUES
(1, 114, 1, 'Ben', 2147483647254987, 'Ben', 6, 2024, 206700, 206700),
(2, 116, 2, 'Charles Miles', 2345678909547362, 'Charles Miles', 6, 2025, 172800, 69120),
(3, 117, 11, 'Aneesha', 345678901248651, 'Aneesha', 4, 2027, 152000, 60800),
(4, 118, 11, 'Aneesha', 345678901843590, 'Aneesha', 4, 2027, 176200, 176200),
(5, 119, 3, 'Christine', 7891567684368456, 'Christine', 6, 2025, 146500, 0),
(6, 120, 10, 'Tony', 5647925496558644, 'Tony', 10, 2028, 189000, 75600),
(7, 121, 3, 'Christine', 7891567684368456, 'Christine', 6, 2025, 118500, 47400),
(8, 122, 1, 'Ben', 5763256547727746, 'Ben', 7, 2025, 875250, 350100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email_id`, `mobile_number`, `address`) VALUES
(1, 'Ben', 'Ben', 'ben117367@gmail.com', '4452574597', 'NewYork'),
(2, 'Charles Miles', 'Charles Miles', 'charlesmiles1458@gmail.com', '1476582115', 'Rome'),
(3, 'Christine', 'Christine', 'Christine@gmail.com', '5454578965', ''),
(4, 'Emma Gadot', 'Emma Gadot', 'Emma@gmail.com', '3545458520', ''),
(5, 'Harry Den', 'Harry Den', 'Harry756@gmail.com', '8467067344', ''),
(6, 'Isabella', 'Isabella', 'Isabella1726@gmail.com', '8525874545', ''),
(7, 'James Wan', 'James Wan', 'James@gmail.com', '2565452102', ''),
(8, 'John Doe', 'John Doe', 'johndoe@gmail.com', '9874545454', ''),
(9, 'Paige Doherty', 'Paige Doherty', 'PaigeDoherty@gmail.com', '0778538358', ''),
(10, 'Tony', 'Tony', 'Tony@gmail.com', '7854885214', ''),
(11, 'Aneesha', 'Aneesha', 'aneesha1287450@gmail.com', '78974584', '');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(10) NOT NULL,
  `venue_name` varchar(50) NOT NULL,
  `venue_dir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`venue_id`, `venue_name`, `venue_dir`) VALUES
(1, 'ABC Palace', 'images/venues/venue1.jpeg'),
(2, 'PQR Grounds', 'images/venues/venue2.jpeg'),
(3, 'HZ Villa', 'images/venues/venue3.jpeg'),
(4, 'SJS Palace', 'images/venues/venue4.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`,`email_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catering`
--
ALTER TABLE `catering`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`user_id`,`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_service`
--
ALTER TABLE `other_service`
  ADD PRIMARY KEY (`user_id`,`event_id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `ratee`
--
ALTER TABLE `ratee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`,`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`,`username`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
