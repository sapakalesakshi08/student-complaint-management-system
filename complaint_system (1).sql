-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 06:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `complaint_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Admin One', 'admin1@gmail.com', 'admin123', '2026-04-29 15:48:40'),
(2, 'Admin Two', 'admin2@gmail.com', 'admin123', '2026-04-29 15:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `complaint` text DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `complaint`, `department`, `status`, `created_at`, `user_id`) VALUES
(1, 'WiFi not working in lab', 'Technical', 'Solved', '2026-04-28 14:48:00', 1),
(2, 'Classroom bench broken', 'Infrastructure', 'Solved', '2026-04-28 14:48:00', 2),
(3, 'Food quality issue in canteen', 'Canteen', 'Pending', '2026-04-28 14:48:00', 3),
(4, 'Washroom not clean', 'Hygiene', 'Solved', '2026-04-28 14:48:00', 4),
(5, 'Security guard not available', 'Security', 'Pending', '2026-04-28 14:48:00', 5),
(6, 'Hostel water problem', 'Hostel', 'Solved', '2026-04-28 14:48:00', 6),
(7, 'Students making noise in class', 'Discipline', 'Pending', '2026-04-28 14:48:00', 7),
(8, 'Bus timing issue', 'Transport', 'Pending', '2026-04-28 14:48:00', 8),
(9, 'Exam schedule confusion', 'Academic', 'Pending', '2026-04-28 14:48:00', 9),
(10, 'Projector not working', 'Technical', 'Solved', '2026-04-28 14:48:00', 10),
(11, 'Fan not working in classroom', 'Infrastructure', 'Pending', '2026-04-28 14:48:00', 11),
(12, 'Canteen delay in service', 'Canteen', 'Solved', '2026-04-28 14:48:00', 12),
(13, 'Campus cleanliness issue', 'Hygiene', 'Pending', '2026-04-28 14:48:00', 13),
(14, 'Unauthorized entry in campus', 'Security', 'Pending', '2026-04-28 14:48:00', 14),
(15, 'Hostel electricity problem', 'Hostel', 'Pending', '2026-04-28 14:48:00', 15),
(16, 'Late coming students issue', 'Discipline', 'Solved', '2026-04-28 14:48:00', 16),
(17, 'Bus overcrowded problem', 'Transport', 'Pending', '2026-04-28 14:48:00', 17),
(18, 'System not working in lab', 'Technical', 'Solved', '2026-04-28 14:48:00', 19),
(19, 'Window glass broken', 'Infrastructure', 'Solved', '2026-04-28 14:48:00', 20),
(20, 'Food hygiene issue', 'Canteen', 'Solved', '2026-04-28 14:48:00', 21),
(21, 'Dustbins not cleaned', 'Hygiene', 'Pending', '2026-04-28 14:48:00', 22),
(22, 'Security camera not working', 'Security', 'Pending', '2026-04-28 14:48:00', 23),
(23, 'Indiscipline during lecture', 'Discipline', 'Pending', '2026-04-28 14:48:00', 25),
(24, 'Faculty attendance issue', 'Academic', 'Pending', '2026-04-28 14:48:00', 27),
(25, 'Internet speed very slow', 'Technical', 'Pending', '2026-04-28 14:48:00', 28),
(26, 'Classroom light not working', 'Infrastructure', 'Pending', '2026-04-28 14:48:00', 29),
(27, 'The food quality in the canteen is poor and not up to the expected standards. Kindly improve the quality and taste of the food served.', 'Canteen', 'Solved', '2026-04-30 13:56:44', 25),
(28, 'Recently, the food served in the canteen caused health issues. Proper food safety and quality checks should be ensured.', 'Canteen', 'Solved', '2026-04-30 15:26:07', 25),
(29, 'The infrastructure facilities in the campus are not properly maintained. Classrooms and common areas need immediate attention and improvement.', 'Infrastructure', 'Solved', '2026-04-30 15:31:09', 25),
(30, 'Recently, the food served in the canteen caused health issues. Proper food safety and quality checks should be ensured.', 'Canteen', 'Pending', '2026-04-30 15:40:12', 25),
(31, 'The hostel room is not properly maintained. There are issues with cleanliness and basic facilities. Kindly take necessary action.', 'Hostel', 'Pending', '2026-04-30 15:42:47', 25),
(38, 'Im a 1st year student in hostel block c. the common washrooms on the 2nd floor havent been cleaned in 3 days.', 'Hygiene', 'Pending', '2026-05-20 15:41:02', 28),
(39, 'On at the security guard at the hostel gate was not present and i noticed an unkown person standing near the back gate .when we informed the duty guard no action was taken as girls staying in hostel we feel unsafe', 'Hostel', 'Solved', '2026-05-20 16:07:19', 2),
(40, 'the college bus for rajarampuri has been arriving 20-25 minutes late for the past 2 weeks because of this many of us are reaching class late and missing attendence', 'Transport', 'Pending', '2026-05-20 16:16:00', 3),
(41, 'only about 40% of the syllabus for has been coverd so far even through exams are next month classes are often used for topics outside the syllabus please share a plan to complete the remaining portions on time \r\n', 'Academic', 'Solved', '2026-05-20 16:21:38', 4),
(42, 'the food served in the canteen has been stale and poorly cooked for the past week many students have faced stomach issues after eating please check the quality and hygiene standards in the kitchen', 'Canteen', 'Pending', '2026-05-20 16:27:34', 5),
(43, 'many computers in the 3rd lab are not turning on or keep freezing during class we are unable to complete the programming practicals on time kindly repair the systems or shift us to another lab', 'Technical', 'Pending', '2026-05-20 16:32:04', 6),
(44, 'the desks and chairs in 55th room are broken and not enough for all students many of us have to stand during lectures please replace the damaged furniture and arranged extra seating', 'Infrastructure', 'Pending', '2026-05-20 16:34:04', 6),
(45, 'the washrooms on the 2nd floor are in very poor condition with no water and broken doors stuents are avoiding using them please arrange immediate cleaning and repairs', 'Infrastructure', 'Solved', '2026-05-20 16:39:28', 7),
(46, 'the projector in 45 room is not displaying properly and the sound system doesnt work faculty are unable to conduct presentations and lectures please get the equipment serviced soon', 'Technical', 'Pending', '2026-05-20 16:44:24', 8),
(47, 'the canteen is charging higher rates than the price list displayed we tea being asked to play extra for basic items like tea and snacks please verify the rates and ensure the menu board is followed', 'Canteen', 'Pending', '2026-05-20 16:47:09', 8),
(48, 'the rooms and corridors are not being cleaned regularly and pets are increasing living conditions are becoming unhygienic please arranged daily cleaning and pest control', 'Hostel', 'Pending', '2026-05-20 17:18:51', 9),
(49, 'the ceiling in room no-32 is leaking during rain and the walls have damp patches its affecting class and damaging books please get the roof and walls repaired before the monsoon worsens', 'Infrastructure', 'Pending', '2026-05-20 17:21:32', 9),
(50, 'students are openly using phones during lectures and exams without any action taken its distracting and unfair to those following rules please enforce the no phone policy more strictly in classroom', 'Discipline', 'Solved', '2026-05-20 17:24:56', 10),
(51, 'the classes scheduled on mon wed and fri have been cancelled for the past 3 weeks without any notice', 'Academic', 'Solved', '2026-05-20 17:30:34', 11),
(52, 'there are long queues and very slow service in the canteen during break time we dont get enough time to eat before the next class ', 'Canteen', 'Solved', '2026-05-20 17:32:11', 11);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `message`, `rating`, `created_at`) VALUES
(1, 'Amol', 'The website design is user friendly and all features are working properly', 3, '2026-05-20 15:34:05'),
(2, 'Amit', 'The complaint status feature is very useful for tracking complaint progress', 4, '2026-05-20 15:59:55'),
(3, 'Sneha kulkarni', 'This system helps students send complaints quickly without visiting the office', 4, '2026-05-20 16:02:40'),
(4, 'Rahul', 'i am satisfied with the response provided by the department staff through this sytem', 3, '2026-05-20 16:13:16'),
(5, 'pooja ', 'Department wise complaint handling is one of the best features of this system', 4, '2026-05-20 16:23:02'),
(6, 'Rohit', 'the sytem reduces paperwork and makes complaint management easier', 5, '2026-05-20 16:24:54'),
(7, 'Priya', 'the feedback module is well designed and improves communication between students and staff', 4, '2026-05-20 16:29:44'),
(8, 'Sagar', 'this system gave me a better way to report issues without waiting in long queues', 4, '2026-05-20 16:37:06'),
(9, 'Neha', 'i liked how my complaints reached the correct department automatically after submission', 5, '2026-05-20 16:41:23'),
(10, 'vikas', 'using this platform feels more comfortable than traditional handwritten complaint methods', 5, '2026-05-20 17:16:09'),
(11, 'Anjali', 'i was able to submit feedback and complaints within a few minutes from my dashboard', 4, '2026-05-20 17:26:30'),
(12, 'Mahesh', 'the digital complaint process is faster safer and more reliable for students', 4, '2026-05-20 17:28:10'),
(13, 'Kavita', 'The website design is user friendly and all features are working properly', 3, '2026-05-20 17:33:59'),
(14, 'Sunil', 'i liked that every complaint is stored properly in the database for future reference', 3, '2026-05-20 17:35:09'),
(15, 'Swati ', 'i found the dashboard features simple interactive and useful for everyday student activities', 4, '2026-05-20 17:36:31'),
(16, 'Ajay', 'college staff responds quickly to complaint', 3, '2026-05-20 17:39:47'),
(17, 'Ganesh', 'good platform for students  to communicate with departments', 3, '2026-05-20 17:40:55'),
(18, 'Madhuri', 'complaint tracking feature is very helpful', 3, '2026-05-20 17:41:55'),
(19, 'Tejas', 'the system reduces paperwork and manual work', 3, '2026-05-20 17:42:40'),
(20, 'Vaishali', 'i am satisfied with the response provided by the department staff through the system', 4, '2026-05-20 17:44:13'),
(21, 'Amol', 'this system helps students to send complaints quickly', 4, '2026-05-20 17:45:12'),
(22, 'Sakshi', 'department wise complaint handling is one of the best features of this system', 5, '2026-05-20 17:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'staff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `password`, `department`, `role`) VALUES
(1, 'Sachin Patil', 'tech@gmail.com', '123456', 'Technical', 'staff'),
(2, 'Priya Deshmukh', 'hostel@gmail.com', '123456', 'Hostel', 'staff'),
(3, 'Amit Jadhav', 'infra@gmail.com', '123456', 'Infrastructure', 'staff'),
(4, 'Snehal Kulkarni', 'canteen@gmail.com', '123456', 'Canteen', 'staff'),
(5, 'Rohit Shinde', 'hygiene@gmail.com', '123456', 'Hygiene', 'staff'),
(6, 'Pooja Pawar', 'security@gmail.com', '123456', 'Security', 'staff'),
(7, 'Vikas More', 'discipline@gmail.com', '123456', 'Discipline', 'staff'),
(8, 'Anjali Bhosale', 'transport@gmail.com', '123456', 'Transport', 'staff'),
(9, 'Rahul Kulkarni', 'academic@gmail.com', '123456', 'Academic', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Amit Patil', 'amit1@gmail.com', '$2y$10$ssgwz2ijoigZc4AwYe.YCeoQ8gc15h2tzw7XDtOMp/jhoBBAj38iW', 'user', '2026-04-28 13:53:04'),
(2, 'Sneha Kulkarni', 'sneha2@gmail.com', '$2y$10$wXkPFpUDvOlbbPrqEPmwmuw.cRHwqz27APG1i4z4xY74pOJnnjvHO', 'user', '2026-04-28 13:53:04'),
(3, 'Rahul Deshmukh', 'rahul3@gmail.com', '$2y$10$FBQ3MKswBktYV2.2FxkeyOAuJ6jHv99vkMNOvdpBO7TrvZ4DWaHIS', 'user', '2026-04-28 13:53:04'),
(4, 'Pooja Joshi', 'pooja4@gmail.com', '$2y$10$SKbRrcl3Y4RLUEr53JiSoOJ0ozwH1QhUvNvIKMBty5tYns1FUn9x2', 'user', '2026-04-28 13:53:04'),
(5, 'Rohit Shinde', 'rohit5@gmail.com', '$2y$10$v4Uo87HgtzxCzQNPgAliJ.yLQTj7MQJs.E9tXBZ1aHIZ0.aoyo/7e', 'user', '2026-04-28 13:53:04'),
(6, 'Priya Jadhav', 'priya6@gmail.com', '$2y$10$6iFtokTzot7G.Vg1BaneZOmcPIlsUhISlsNvBGwZ9VYGLePAVFsKe', 'user', '2026-04-28 13:53:04'),
(7, 'Sagar Pawar', 'sagar7@gmail.com', '$2y$10$WlB01oT4riSjin.MiwQQgeO8/.6ObtRtf2IJ05rYcVN.YSqwFAihS', 'user', '2026-04-28 13:53:04'),
(8, 'Neha kale', 'neha8@gmail.com', '$2y$10$.tA7UY6KqJD3uzkn.FJebufnYhMcC/.ZmhSNeY4QLLg2ponlh/H3.', 'user', '2026-04-28 13:53:04'),
(9, 'Vikas Chavan', 'vikas9@gmail.com', '$2y$10$xVSpZILHVVuDZocE7YbDCuS1gJ3FtXcyol1YRUYYrMAhz9hJSJrAK', 'user', '2026-04-28 13:53:04'),
(10, 'Anjali Patil', 'anjali10@gmail.com', '$2y$10$bC5DcTRU3yx8GzUi8ZGinugzJPT3Ipimz2eQToW03E0C4Kym7vpNa', 'user', '2026-04-28 13:53:04'),
(11, 'Mahesh Gaikwad', 'mahesh11@gmail.com', '$2y$10$bXIXzAjubijKcvSn74Nehezy/AQx6H5qjgoXHuX79lV1m5mBMhaGa', 'user', '2026-04-28 13:53:04'),
(12, 'Kavita Mane', 'kavita12@gmail.com', '$2y$10$ve4pEoC7fVBEo8CH8iajROA1w3sVw/7dg1qe9h7cVfPfGUbnBIR/a', 'user', '2026-04-28 13:53:04'),
(13, 'Sunil Shinde', 'sunil13@gmail.com', '$2y$10$h6QnuvCT6AmTa.wWmNU2VeyPcctnOCHX5RenTNkQTXMu6BVMfGNQ2', 'user', '2026-04-28 13:53:04'),
(14, 'Swati Desai', 'swati14@gmail.com', '$2y$10$n6eHFObcEEkthGwZaAt9cOdIhD3M34u9CbHTMBMOSwYGVdlCoyxQW', 'user', '2026-04-28 13:53:04'),
(15, 'Ajay More', 'ajay15@gmail.com', '123456', 'user', '2026-04-28 13:53:04'),
(16, 'Komal Patil', 'komal16@gmail.com', '$2y$10$IFts57WEaEGYgvorCI.FoenFwHnGe2ETqOtHvOlA2s2YeKupjhM3K', 'user', '2026-04-28 13:53:04'),
(17, 'Nitin Jadhav', 'nitin17@gmail.com', '$2y$10$mtgvfFYoG50S0RYdcB0/J.jAoYw0ArBeHb9s2Jad6mOK5ieHUjEZW', 'user', '2026-04-28 13:53:04'),
(19, 'Sachin Pawar', 'sachin19@gmail.com', '$2y$10$iPdQQBWOkQsxVwilGQkGqevGfemfrATQIHyriVJNQfpdjY0ZmaRQ6', 'user', '2026-04-28 13:53:04'),
(20, 'Pallavi Chavan', 'pallavi20@gmail.com', '$2y$10$p34L/LTH85PI6UoYE206xuNMuktmsHO.BZ7liUcBogjUDiLnJZUuW', 'user', '2026-04-28 13:53:04'),
(21, 'Ganesh Shinde', 'ganesh21@gmail.com', '$2y$10$8mPmjVNy0h8YMFFggb7yu.3O2bM5aRCyFxuQpBpwEGy.Q1Q6at1ya', 'user', '2026-04-28 13:53:04'),
(22, 'Tejas Patil', 'tejas22@gmail.com', '$2y$10$.6/N4iMxNAj77nHhR2OyD.qqMY49k6ADpH0BX96zMrlwRVQTQXXn6', 'user', '2026-04-28 13:53:04'),
(23, 'Madhuri Joshi', 'madhuri23@gmail.com', '$2y$10$FhBP03bLw5scoz0AfSDvRuY5nHFKuZ8cA7Utt8V.qVpTTcCkCUA7K', 'user', '2026-04-28 13:53:04'),
(25, 'Vaishali More', 'vaishali25@gmail.com', '$2y$10$6kok7ICAtuZediaYy7uiUe9Dhd/1PGKLxbtTc.qEPK/OTVxqKCUnW', 'user', '2026-04-28 13:53:04'),
(27, 'Rutuja Patil', 'rutuja27@gmail.com', '$2y$10$k3/PTi1URqRUAXLG9Dgih.0WHlonpHR0rsCk5Epc7jemfqbD5uBRG', 'user', '2026-04-28 13:53:04'),
(28, 'Amol Pawar', 'amol28@gmail.com', '$2y$10$59TmhGmW6u5P3UbizoVJzOZnYfqcB24E3CShmX8nRafN3sSVT8b8e', 'user', '2026-04-28 13:53:04'),
(29, 'Shruti Kulkarni', 'shruti29@gmail.com', 'shruti@123', 'user', '2026-04-28 13:53:04'),
(33, 'krishna', 'krish@gmail.com', '$2y$10$gNtU1utbcL07AU9oZuscveU6.scY86w3yUdxDqPXrw3GIV7gPQfvG', 'user', '2026-04-29 16:00:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
