-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 07:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theaterbooking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `b_id` int(11) NOT NULL,
  `show_id` int(11) DEFAULT NULL,
  `seat_class_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_seats` int(255) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`b_id`, `show_id`, `seat_class_id`, `user_id`, `total_seats`, `total_amount`) VALUES
(13, 1, NULL, 2, 4, '39'),
(15, 3, NULL, 5, 3, '39'),
(16, 3, NULL, 2, 3, '39'),
(17, 1, NULL, 2, 3, '39'),
(18, 3, NULL, NULL, 4, '39'),
(20, 7, NULL, NULL, 1, '39'),
(21, 7, NULL, NULL, 3, '39'),
(32, 3, NULL, 2, 5, '39'),
(33, 3, NULL, 2, 5, '39'),
(39, 6, NULL, NULL, 4, '39'),
(43, 6, NULL, NULL, 3, '39'),
(44, 6, NULL, NULL, 3, '39'),
(45, 6, NULL, NULL, 4, '39'),
(46, 6, NULL, NULL, 4, '39'),
(47, 6, NULL, NULL, 4, '39'),
(52, 6, NULL, NULL, 5, '65'),
(53, 6, NULL, NULL, 5, '45'),
(54, 6, NULL, NULL, 3, '27'),
(55, 6, NULL, NULL, 5, '45'),
(56, 6, NULL, NULL, 6, '54'),
(57, 6, NULL, NULL, 4, '36'),
(58, 7, NULL, NULL, 7, '91'),
(59, 8, NULL, 17, 2, '26'),
(60, 9, 14, 17, 5, '3000'),
(61, 10, 14, 17, 6, '3600'),
(62, 9, 14, 17, 5, '3000'),
(63, 9, 14, 18, 3, '1350');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender`) VALUES
(1, 'male'),
(2, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `status`, `user_id`) VALUES
('cvb', 'zxcvb', 1, NULL),
('fat12', 'fati', 1, NULL),
('maanan12', 'sdfghjkl', 1, NULL),
('madiha12', 'madiha12', 1, 16),
('mannu', 'maria12', 1, 18),
('mari123', '123456789k', 1, NULL),
('maria', 'maria', 1, 17),
('maria12', 'maria', 1, NULL),
('nimo12', 'hiii', 1, NULL),
('sarah12', 'sarah123', 1, 15),
('zainu12', 'fghjkl;', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cast` text NOT NULL,
  `director` varchar(255) NOT NULL,
  `duration` time NOT NULL,
  `released_date` date NOT NULL,
  `trailer_url` text NOT NULL,
  `synopsis` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `cast`, `director`, `duration`, `released_date`, `trailer_url`, `synopsis`, `image`) VALUES
(17, 'chenai express', 'Shah Rukh Khan \r\nDeepika Padukone \r\nSathyaraj \r\nNikitin Dheer \r\nMukesh Tiwari', 'Rohit Shetty.', '00:01:41', '2013-08-09', 'https://www.youtube.com/embed/rARol7Dk2zo?si=3UYDD2kGMdcJBQ3O&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Chennai Express is an action-comedy film that follows the story of Rahul Mithaiwala (played by Shah Rukh Khan), a 40-year-old man who embarks on a journey to fulfill his late grandfather&#039;s wish of immersing his ashes in Rameswaram. However, his life takes an unexpected turn when he boards the Chennai Express train and meets Meenamma (Deepika Padukone), the daughter of a powerful South Indian don.\r\n\r\nAs Rahul inadvertently gets entangled in Meenamma&#039;s world, he finds himself on the run from her father&#039;s henchmen and her suitor, Tangaballi. Along the way, they face comical and dangerous situations while traveling through the South Indian landscape. Despite their differences, Rahul and Meenamma grow closer, and Rahul must eventually face her father to win her hand.\r\n\r\nThe film blends humor, action, and romance with colorful visuals, and features a mixture of North and South Indian cultures. ', '../images/chenai express.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cardholder_name` text NOT NULL,
  `card_number` int(255) NOT NULL,
  `cvv` int(3) NOT NULL,
  `card_expiry` date NOT NULL,
  `b_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `cardholder_name`, `card_number`, `cvv`, `card_expiry`, `b_id`) VALUES
(1, 'maria', 987654327, 123, '2024-09-03', 56),
(2, 'mhhbnm,', 65432166, 123, '2024-11-11', 57),
(3, 'lkjhgf', 9876543, 122, '2025-03-22', 57),
(4, 'saimnaa', 9531234, 122, '2000-02-22', 57),
(5, 'oiuytrewqqwertyui', 2147483647, 344, '8888-08-08', 58),
(6, 'kjhgfdsasdfghjk', 9876543, 123, '0300-01-01', 59),
(7, 'maria', 1234567890, 123, '2024-10-05', 60),
(8, 'jhgfdsdfgh', 2147483647, 123, '9999-09-09', 61),
(9, 'lkjgfdfghjkhfgh', 2147483647, 123, '2025-09-09', 62);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` int(5) NOT NULL,
  `comments` text NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `movie_id`, `rating`, `comments`, `review_date`) VALUES
(26, NULL, NULL, 4, 'dfghjkl;\'', '2024-09-06 09:34:17'),
(33, NULL, NULL, 5, 'dfghjkl', '2024-09-06 10:23:35'),
(34, NULL, NULL, 5, 'asdfghjkl', '2024-09-06 10:23:45'),
(35, NULL, NULL, 5, 'test', '2024-09-06 17:59:12'),
(36, NULL, NULL, 4, 'kjhgfd', '2024-09-09 07:43:31'),
(37, NULL, NULL, 5, 'best movie have ever seen beforre', '2024-09-09 09:12:27'),
(38, 16, 17, 6, 'kjhgfds', '2024-09-14 13:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role`) VALUES
(1, 'admin'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE `screen` (
  `screen_id` int(11) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `total_seats_available` int(255) NOT NULL,
  `seat_class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`screen_id`, `screen_name`, `total_seats_available`, `seat_class_id`) VALUES
(3, 'IMAX Screen', 52, NULL),
(6, '4DX Screen', 27, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seat_class`
--

CREATE TABLE `seat_class` (
  `seat_id` int(11) NOT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `class_type` varchar(266) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat_class`
--

INSERT INTO `seat_class` (`seat_id`, `screen_id`, `class_type`, `price`) VALUES
(14, NULL, 'gold', '600');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `show_id` int(11) NOT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `show_time_id` int(11) DEFAULT NULL,
  `show_date` date NOT NULL,
  `theater_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`show_id`, `screen_id`, `movie_id`, `show_time_id`, `show_date`, `theater_id`) VALUES
(1, NULL, NULL, NULL, '2024-09-01', NULL),
(3, NULL, NULL, 3, '2024-08-30', NULL),
(6, NULL, NULL, 4, '2024-09-09', NULL),
(7, NULL, NULL, 3, '2024-09-07', NULL),
(8, 3, 17, 3, '2024-09-14', NULL),
(9, 6, 17, 4, '2024-08-30', 9),
(10, 3, 17, 4, '0001-01-01', 8);

-- --------------------------------------------------------

--
-- Table structure for table `show_timing`
--

CREATE TABLE `show_timing` (
  `show_time_id` int(11) NOT NULL,
  `time` text NOT NULL,
  `time_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `show_timing`
--

INSERT INTO `show_timing` (`show_time_id`, `time`, `time_name`) VALUES
(3, '10pm-12am', 'Night'),
(4, '2pm-5pm', 'Afternoon'),
(5, '12am-3am', 'Midnight');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `theater_id` int(11) NOT NULL,
  `theater_name` varchar(255) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`theater_id`, `theater_name`, `location`) VALUES
(8, 'The Arena Cinema', 'Bahria Town Tower, Tariq Rd'),
(9, 'Nueplex Cinemas', 'Nueplex Cinemas Askari IV, Main Rashid Minhas Rd,');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(266) NOT NULL,
  `age` int(100) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `age`, `role_id`, `gender_id`) VALUES
(2, 'test', 'test@gamil.com', 20, 3, 2),
(5, 'nimraa', 'nimra122@gamil.com', 22, 1, 1),
(15, 'sarah', 'sarahshaz12@gmail.com', 23, 3, 2),
(16, 'madiha', 'madihaimam12@gamil.com', 34, 3, 2),
(17, 'Maria kasmani', 'mariakasmani27@gmail.com', 19, 1, 2),
(18, 'mannan Awan', 'mannanawan12@gmail.com', 7, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `seat_class_id` (`seat_class_id`),
  ADD KEY `show_id` (`show_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`b_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
  ADD PRIMARY KEY (`screen_id`),
  ADD KEY `screen_ibfk_1` (`seat_class_id`);

--
-- Indexes for table `seat_class`
--
ALTER TABLE `seat_class`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `screen_id` (`screen_id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`show_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `screen_id` (`screen_id`),
  ADD KEY `show_time_id` (`show_time_id`),
  ADD KEY `theater_id` (`theater_id`);

--
-- Indexes for table `show_timing`
--
ALTER TABLE `show_timing`
  ADD PRIMARY KEY (`show_time_id`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`theater_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `screen`
--
ALTER TABLE `screen`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seat_class`
--
ALTER TABLE `seat_class`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `show_timing`
--
ALTER TABLE `show_timing`
  MODIFY `show_time_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `theater_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`seat_class_id`) REFERENCES `seat_class` (`seat_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`show_id`) REFERENCES `shows` (`show_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `bookings` (`b_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `screen`
--
ALTER TABLE `screen`
  ADD CONSTRAINT `screen_ibfk_1` FOREIGN KEY (`seat_class_id`) REFERENCES `seat_class` (`seat_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `seat_class`
--
ALTER TABLE `seat_class`
  ADD CONSTRAINT `seat_class_ibfk_1` FOREIGN KEY (`screen_id`) REFERENCES `screen` (`screen_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shows_ibfk_2` FOREIGN KEY (`screen_id`) REFERENCES `screen` (`screen_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shows_ibfk_3` FOREIGN KEY (`show_time_id`) REFERENCES `show_timing` (`show_time_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `shows_ibfk_4` FOREIGN KEY (`theater_id`) REFERENCES `theater` (`theater_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
