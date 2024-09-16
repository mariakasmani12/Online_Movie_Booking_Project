-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 03:19 PM
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
  `total_amount` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`b_id`, `show_id`, `seat_class_id`, `user_id`, `total_seats`, `total_amount`, `status`) VALUES
(13, 1, NULL, 2, 4, '39', 0),
(15, 3, NULL, 5, 3, '39', 0),
(16, 3, NULL, 2, 3, '39', 0),
(17, 1, NULL, 2, 3, '39', 0),
(18, 3, NULL, NULL, 4, '39', 0),
(20, 7, NULL, NULL, 1, '39', 0),
(21, 7, NULL, NULL, 3, '39', 0),
(32, 3, NULL, 2, 5, '39', 0),
(33, 3, NULL, 2, 5, '39', 0),
(39, 6, NULL, NULL, 4, '39', 0),
(43, 6, NULL, NULL, 3, '39', 0),
(44, 6, NULL, NULL, 3, '39', 0),
(45, 6, NULL, NULL, 4, '39', 0),
(46, 6, NULL, NULL, 4, '39', 0),
(47, 6, NULL, NULL, 4, '39', 0),
(52, 6, NULL, NULL, 5, '65', 0),
(53, 6, NULL, NULL, 5, '45', 0),
(54, 6, NULL, NULL, 3, '27', 0),
(55, 6, NULL, NULL, 5, '45', 0),
(56, 6, NULL, NULL, 6, '54', 0),
(57, 6, NULL, NULL, 4, '36', 0),
(58, 7, NULL, NULL, 7, '91', 0),
(59, 8, NULL, 17, 2, '26', 0),
(60, 9, 14, 17, 5, '3000', 0),
(61, 10, 14, 17, 6, '3600', 0),
(62, 9, 14, 17, 5, '3000', 0),
(63, 9, 14, 18, 3, '1350', 0),
(64, NULL, NULL, NULL, 0, '0', 0),
(65, 11, 14, 17, 3, '1800', 0),
(66, 14, 14, 18, 4, '1800', 0);

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
(18, 'SOUL', 'Jamie Foxx\r\nTina Fey \r\nPhylicia Rashad \r\nAngela Bassett a\r\nGraham Norton \r\nRichard Ayoade \r\nRachel House', 'Pete Docter', '00:01:00', '2020-12-25', 'https://www.youtube.com/embed/xOsLIiBStEs?si=wVqQup1MTsGq-tjj&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', '&quot;Soul&quot; follows the story of Joe Gardner, a middle school band teacher who dreams of becoming a professional jazz musician. Just when Joe gets his big break, an unexpected accident transports his soul to the &quot;Great Before,&quot; a place where new souls are prepared for life on Earth. Here, he meets 22, a soul who has no interest in living on Earth. Together, they embark on a journey to discover what it means to truly live, with Joe striving to return to his body and pursue his passion for music. ', '../images/soul poster.jfif'),
(19, 'INSIDE OUT', 'Amy Poehler\r\nPhyllis Smith \r\nBill Hader\r\nLewis Black\r\nMindy Kaling \r\nKaitlyn Dias \r\nDiane Lane\r\nKyle MacLachlan', 'Pete Docter', '00:00:00', '2015-06-19', 'https://www.youtube.com/embed/LEjhY15eCx0?si=aRTCo8jIYfP0XY9n&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'inside Out takes place inside the mind of Riley, an 11-year-old girl who is uprooted from her life when her family moves to San Francisco. The story is told from the perspective of Riley&#039;s emotions—Joy, Sadness, Fear, Anger, and Disgust—which live in Headquarters, the control center of Riley&#039;s mind. As Riley struggles with the changes in her life, her emotions battle for control and try to guide her through this difficult transition. Joy tries to keep things positive, but when she and Sadness are accidentally ejected from Headquarters, they must work together to find their way back while Riley&#039;s emotions spiral out of control. ', '../images/insideout poster.jfif'),
(20, 'COCO', 'Anthony Gonzalez \r\nGael García Bernal \r\nBenjamin Bratt \r\nAlanna Ubach \r\nRenée Victor\r\nEdward James Olmos', 'Lee Unkrich', '00:01:05', '2017-11-17', 'https://www.youtube.com/embed/xlnPHQ3TLX8?si=Ad1iCQu3LQJjKTFy&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Coco follows the story of Miguel Rivera, a 12-year-old boy who dreams of becoming a musician, despite his family’s long-standing ban on music. On the Día de los Muertos (Day of the Dead), Miguel accidentally finds himself in the Land of the Dead while trying to borrow the guitar of his idol, Ernesto de la Cruz. In the Land of the Dead, Miguel meets his ancestors and befriends a trickster named Héctor. Together, they embark on a journey to discover the truth about Miguel&#039;s family history, the ban on music, and the connection to Ernesto de la Cruz. ', '../images/coco poster.jfif'),
(21, 'FROZEN', 'Kristen Bell \r\nIdina Menzel \r\nJosh Gad \r\nJonathan Groff \r\nSantino Fontana', 'Chris Buck', '00:01:02', '2013-11-27', 'https://www.youtube.com/embed/FLzfXQSPBOg?si=Oq0Yi7UK1DblLGln&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Frozen follows the story of Anna, a fearless optimist who sets off on a dangerous journey with Kristoff, an ice harvester, and his loyal reindeer Sven to find her estranged sister, Elsa. Elsa, the newly crowned Queen of Arendelle, has accidentally trapped the kingdom in an eternal winter with her ice powers. Along the way, Anna and Kristoff are joined by a magical snowman named Olaf. Together, they face icy conditions and mysterious forces, while Anna tries to convince Elsa to return and stop the winter.', '../images/frozen poster.jfif'),
(22, 'ICE AGE', 'Ray Romano\r\nJohn Leguizamo\r\nDenis Leary \r\nGoran Višnjić\r\nJack Black', 'Chris Wedge', '00:00:00', '2020-02-15', 'https://www.youtube.com/embed/Ohq6NmKMja8?si=YCA_scXuKHFpugaJ&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Ice Age is set during the prehistoric Ice Age, where animals are migrating south to avoid the freezing cold. A woolly mammoth named Manny, a talkative sloth named Sid, and a cunning saber-toothed tiger named Diego team up to return a human baby to its family. Along the way, the unlikely group faces various challenges and dangerous situations. They form a bond as they journey through the harsh, icy environment, with Scrat, the squirrel, constantly chasing his elusive acorn in the background. ', '../images/ice age poster.jfif'),
(23, 'TOY STORY', 'Tom Hanks \r\nTim Allen \r\nJoan Cusack \r\nNed Beatty \r\nDon Rickles \r\nJim Varney \r\nWallace Shawn\r\nJohn Ratzenberger \r\nKristen Schaal \r\nBonnie Hunt', 'Lee Unkrich', '00:01:03', '2010-06-18', 'https://www.youtube.com/embed/ZZv1vki4ou4?si=RCKVxuvA_xXf_B6D&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'In Toy Story 3, Andy is now 17 years old and preparing to leave for college. As he packs up his belongings, his toys are accidentally donated to a daycare center called Sunnyside. At first, the toys are excited about their new environment, but they soon discover that Sunnyside is not as perfect as it seemed, and they are ruled by the dictatorial Lotso, a stuffed bear who harbors a grudge against the world. ', '../images/toy story.jfif'),
(24, 'Trolls', 'Anna Kendrick\r\nJustin Timberlake\r\nZooey Deschanel\r\nChristopher Mintz-Plasse \r\nChristine Baranski \r\nRussell Brand\r\nJames Corden \r\nGwendoline Christie', 'Mike Mitchell and Walt Dohrn', '00:01:00', '2024-11-25', '&quot;https://www.youtube.com/embed/4rdMgJJ2exQ?si=KJz5-XE5MuH4bqCR&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', '&quot;https://www.youtube.com/embed/4rdMgJJ2exQ?si=KJz5-XE5MuH4bqCR&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin ', '../images/trolls poster.jfif'),
(25, 'HOW TO TRAIN YOUR DRAGAN', 'Jay Baruchel\r\nGerard Butler \r\nAmerica Ferrera \r\nCraig Ferguson \r\nT.J. Miller\r\nKristen Wiig \r\nCodie Smith-McPhee \r\nRobin Atkin Downes', 'Chris Sanders and Dean DeBlois', '01:30:00', '2024-12-17', 'https://www.youtube.com/embed/2BP38770KNo?si=-sluoJTai0wEdIOe&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'How to Train Your Dragon is set in the Viking village of Berk, where young Hiccup Horrendous Haddock III struggles to live up to his father Stoick the Vast’s expectations of being a dragon slayer. When Hiccup captures a dragon, he is surprised to discover that the creature, named Toothless, is not the fierce beast he believed but a gentle, intelligent companion. As Hiccup befriends Toothless, he learns about the true nature of dragons and works to bridge the gap between humans and dragons, ultimately challenging the village&#039;s long-standing traditions of dragon hunting. ', '../images/how to trai you poster.jfif'),
(26, 'MADAGASCAR', 'Ben Stiller \r\nChris Rock \r\nDavid Schwimmer \r\nJada Pinkett Smith \r\nSacha Baron Cohen \r\nCedric the Entertainer \r\nAndy Richter \r\nTom McGrath \r\nChris Mille', 'Eric Darnell and Tom McGrath', '01:40:00', '2024-12-12', 'https://www.youtube.com/embed/orAqhC-Hp_o?si=7AI6TcBDRmJf9-P5&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Madagascar follows the story of four animals from the Central Park Zoo in New York City: Alex the Lion, Marty the Zebra, Melman the Giraffe, and Gloria the Hippo. When Marty, yearning for freedom, escapes from the zoo and ends up in the wild, his friends follow him, leading to a series of misadventures. The animals find themselves shipwrecked on the island of Madagascar, where they encounter a group of eccentric lemurs led by King Julien. As they adapt to their new environment, the zoo animals must learn to survive in the wild and find their way back to their comfortable zoo life. ', '../images/magagascar poster.jfif'),
(27, 'WECK IT RALPH', 'John C. Reilly \r\nSarah Silverman\r\nJack McBrayer .\r\nJane Lynch \r\nAlan Tudyk \r\nMindy Kaling\r\nEd O&#039;Neill \r\nDennis Haysbert', 'Rich Moore', '00:01:01', '2025-01-11', 'https://www.youtube.com/embed/_BcYBFC6zfY?si=HQMenH_SCigLTS49&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Wreck-It Ralph tells the story of Ralph, the villain from an 8-bit arcade game called Fix-It Felix Jr., who is tired of being the bad guy and yearns to be a hero. Determined to change his image, Ralph ventures into other game worlds to prove his worth, eventually finding himself in a candy-themed racing game called Sugar Rush. There, he befriends Vanellope von Schweetz, a glitchy racer who dreams of winning the race and finding her place in the game. As Ralph and Vanellope team up, they must thwart a dangerous threat that could destroy the arcade and everything Ralph has worked for ', '../images/wreck it ralph poster.jfif'),
(28, 'TANGLED', 'Mandy Moore as Rapunzel\r\nZachary Levi as Flynn Rider (Eugene Fitzherbert)\r\nRon Perlman as Captain Hook\r\nBetsy Cedric as Mother Gothel\r\nM.C. Gainey \r\nDelaney Peters \r\nPaul F. Tompkins', 'Nathan Greno', '00:01:00', '2025-02-12', 'https://www.youtube.com/embed/ycoY201RTRo?si=ZFkOsh5is1uUd2TX&quot; title=&quot;YouTube video player&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin', 'Tangled is a modern twist on the classic fairy tale of Rapunzel. The story follows Rapunzel, a young princess with magical, long hair that has the power to heal and reverse aging. She has been locked in a tower by the wicked Mother Gothel, who seeks to use Rapunzel&#039;s hair for eternal youth. When a charming thief named Flynn Rider stumbles upon Rapunzel&#039;s tower, Rapunzel makes a deal with him to help her escape and explore the outside world for the first time. As they embark on an adventure together, Rapunzel discovers her true identity, and Flynn learns about courage and redemption. ', '../images/tangled.jfif');

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
(9, 'lkjgfdfghjkhfgh', 2147483647, 123, '2025-09-09', 62),
(10, 'maria naeem', 2147483647, 123, '2024-12-12', 65),
(11, 'maria naeem', 2147483647, 123, '2024-12-12', 65),
(12, 'matia naeem', 2147483647, 321, '2025-02-12', 66);

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
(38, 16, NULL, 6, 'kjhgfds', '2024-09-14 13:50:04'),
(39, 16, 18, 4, 'best movie ever', '2024-09-16 09:42:07');

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
(3, 'IMAX Screen', 49, NULL),
(6, '4DX Screen', 23, NULL);

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
(14, NULL, 'gold', '600'),
(15, NULL, 'platium', '400'),
(16, NULL, 'box', '300');

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
(8, 3, NULL, 3, '2024-09-14', NULL),
(9, 6, NULL, 4, '2024-08-30', 9),
(10, 3, NULL, 4, '0001-01-01', 8),
(11, 3, 18, 4, '2024-09-17', 8),
(13, 6, 18, 3, '2024-09-17', 9),
(14, 6, 19, 4, '2024-09-24', 8),
(15, 3, 20, 5, '2024-09-20', 8),
(16, 6, 21, 4, '2024-09-21', 9),
(17, 3, 22, 3, '2024-09-27', 8),
(18, 6, 23, 4, '2024-09-28', 8);

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
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
