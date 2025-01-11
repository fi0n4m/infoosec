-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 02:05 PM
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
-- Database: `lakandula_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `lastname`, `firstname`, `email`, `dob`, `password`, `created_at`) VALUES
(1, 'brinas', 'kerwin', 'kerwinbrinas@gmail.com', '2002-03-18', '$2y$10$JFglhGOj8iOpR7yKkep4oeNe7SuuWuI.I7r8aAPjexKfjtyhXcZ4S', '2025-01-09 08:13:28'),
(2, 'brinas', 'Rodolfo', 'ker@gmail.com', '1993-02-25', '$2y$10$L/xhcTP8KbJVjMsXfELKqOHlNLHqz7D4DvV1uzw2VXgqGoyfIIeAy', '2025-01-09 08:19:26'),
(3, 'Reyes', 'Fiona', 'hugoboss@gmail.com', '2004-06-17', '$2y$10$JS/6h6LlxCRn8NBheCzO0.0U1Wl06VnzMRaxhbqvC9ZC4U9ywYfKa', '2025-01-09 08:45:16'),
(5, 'merabueno', 'dayan', 'dayang@gmail.com', '2009-12-02', '$2y$10$ojW5WklZJvYna3h..eJH3.hKsb6IX6bRhZdT8w37E/ykmHtYaKAEq', '2025-01-09 09:23:40'),
(6, 'ricamara', 'lanz', 'lanz@gmail.com', '2005-06-25', '$2y$10$V6QlomBPF0pW.iaFUkIzuO7cIn6rayvgRViwO3NujGZC626vB9o0W', '2025-01-09 10:06:17'),
(7, 'Martinez', 'Fiona', 'fiona@gmail.com', '2003-07-17', '$2y$10$XxDr5oSySLZHu/XgjXqCPOQHPE8rAvJdUdfpyAb8miPK9j0yYqxRi', '2025-01-10 08:59:17'),
(8, 'Ricamara', 'Lanz', 'Ashlee@gmail.com', '2003-07-17', '$2y$10$Lt3Lpav9yIhPzsMdW6ecJ.eiitmwTdOTEDnk/pqKLugAVELwIjRTm', '2025-01-10 09:02:03'),
(9, 'ricamara', 'lanz', 'brinas@gmail.com', '5788-12-04', '$2y$10$jfOeof6IOk0dgqX88CjB1.9X2/7Uu.7tY/Ms8SYMgPyIhTB5XNuoe', '2025-01-10 09:04:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
