-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 07:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nazocnost`
--

-- --------------------------------------------------------

--
-- Table structure for table `kolegij`
--

CREATE TABLE `kolegij` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `studij_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kolegij`
--

INSERT INTO `kolegij` (`id`, `naziv`, `studij_id`) VALUES
(16, 'Programiranje 2', 14),
(17, 'Fizika', 16),
(18, 'Mikroprocesori', 15),
(19, 'Korisnicka Sucelja <3', 16),
(20, 'Računalna matematika', 14);

-- --------------------------------------------------------

--
-- Table structure for table `prisutnost`
--

CREATE TABLE `prisutnost` (
  `id` int(11) NOT NULL,
  `termin_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `vrijeme_dolazka` time DEFAULT NULL,
  `vrijeme_odlazka` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisutnost`
--

INSERT INTO `prisutnost` (`id`, `termin_id`, `student_id`, `vrijeme_dolazka`, `vrijeme_odlazka`) VALUES
(22, 9, 19, '06:28:46', '00:00:00'),
(23, 12, 19, '07:03:31', '07:03:37'),
(24, 12, 22, '07:04:08', '07:04:14'),
(25, 12, 20, '07:04:38', '07:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `studij`
--

CREATE TABLE `studij` (
  `id` int(11) NOT NULL,
  `naziv` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studij`
--

INSERT INTO `studij` (`id`, `naziv`) VALUES
(14, 'Racunarstvo'),
(15, 'Elektrotehnika'),
(16, 'Strojarstvo');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

CREATE TABLE `termin` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) DEFAULT NULL,
  `predavac_id` int(11) NOT NULL,
  `kolegij_id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `vrijeme_pocetka` time DEFAULT NULL,
  `vrijeme_zavrsetka` time DEFAULT NULL,
  `zavrsen` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`id`, `naziv`, `predavac_id`, `kolegij_id`, `datum`, `vrijeme_pocetka`, `vrijeme_zavrsetka`, `zavrsen`) VALUES
(9, '1. predavanje', 10, 16, '2023-02-19', '06:27:52', '06:29:16', 'DA'),
(12, '1. predavanje', 10, 16, '2023-02-19', '07:02:56', '07:04:49', 'DA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `indeks` varchar(20) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role` enum('admin','professor','student') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `full_name`, `indeks`, `pass`, `role`) VALUES
(15, 'jJagoda', 'Jagoda Jagoda', NULL, '202cb962ac59075b964b07152d234b70', 'admin'),
(16, 'sRamljak', 'Slavko Ramljak', '123-RM', '202cb962ac59075b964b07152d234b70', 'student'),
(17, 'kRakic', 'Kresimir Rakic', '333-RM', '202cb962ac59075b964b07152d234b70', 'professor'),
(19, 'zSeremet', 'Zeljko Seremet', '123-rm', '202cb962ac59075b964b07152d234b70', 'professor'),
(20, 'iKrasic', 'Ivan Krasic', NULL, '202cb962ac59075b964b07152d234b70', 'professor'),
(21, 'pProfesor', 'Profesor Profesor', NULL, '202cb962ac59075b964b07152d234b70', 'professor'),
(22, 'jBakula', 'Jure Bakula', '123-RM', '202cb962ac59075b964b07152d234b70', 'student'),
(23, 'dDrljepan', 'Dragan Dljepan', '444-RM', '202cb962ac59075b964b07152d234b70', 'student'),
(24, 'zMaros', 'Zoran Maros', '454-ST', '202cb962ac59075b964b07152d234b70', 'student'),
(25, 'fTomas', 'Frano Tomas', '886-RM', '202cb962ac59075b964b07152d234b70', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `veza`
--

CREATE TABLE `veza` (
  `id` int(11) NOT NULL,
  `kolegij_id` int(11) NOT NULL,
  `profesor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `veza`
--

INSERT INTO `veza` (`id`, `kolegij_id`, `profesor_id`) VALUES
(10, 16, 17),
(11, 18, 17),
(12, 20, 17),
(13, 17, 20),
(14, 18, 20),
(15, 19, 20);

-- --------------------------------------------------------

--
-- Table structure for table `vezastudent`
--

CREATE TABLE `vezastudent` (
  `id` int(11) NOT NULL,
  `kolegij_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vezastudent`
--

INSERT INTO `vezastudent` (`id`, `kolegij_id`, `student_id`) VALUES
(19, 16, 16),
(20, 16, 22),
(21, 16, 23),
(22, 16, 25),
(23, 20, 16),
(24, 20, 22),
(25, 20, 23),
(26, 20, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kolegij`
--
ALTER TABLE `kolegij`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studij_kolegij_fk` (`studij_id`);

--
-- Indexes for table `prisutnost`
--
ALTER TABLE `prisutnost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prisutnost_termin_fk` (`termin_id`),
  ADD KEY `prisutnost_student_fk` (`student_id`);

--
-- Indexes for table `studij`
--
ALTER TABLE `studij`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `predavac_termin_fk` (`predavac_id`),
  ADD KEY `kolegij_termin_fk` (`kolegij_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `veza`
--
ALTER TABLE `veza`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_kolegij_fk` (`profesor_id`),
  ADD KEY `kolegij_veza_fk` (`kolegij_id`);

--
-- Indexes for table `vezastudent`
--
ALTER TABLE `vezastudent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kolegij_student_fk` (`kolegij_id`),
  ADD KEY `kolegij_userStudent_fk` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kolegij`
--
ALTER TABLE `kolegij`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `prisutnost`
--
ALTER TABLE `prisutnost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `studij`
--
ALTER TABLE `studij`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `termin`
--
ALTER TABLE `termin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `veza`
--
ALTER TABLE `veza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vezastudent`
--
ALTER TABLE `vezastudent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kolegij`
--
ALTER TABLE `kolegij`
  ADD CONSTRAINT `studij_kolegij_fk` FOREIGN KEY (`studij_id`) REFERENCES `studij` (`id`);

--
-- Constraints for table `prisutnost`
--
ALTER TABLE `prisutnost`
  ADD CONSTRAINT `prisutnost_student_fk` FOREIGN KEY (`student_id`) REFERENCES `vezastudent` (`id`),
  ADD CONSTRAINT `prisutnost_termin_fk` FOREIGN KEY (`termin_id`) REFERENCES `termin` (`id`);

--
-- Constraints for table `termin`
--
ALTER TABLE `termin`
  ADD CONSTRAINT `kolegij_termin_fk` FOREIGN KEY (`kolegij_id`) REFERENCES `kolegij` (`id`),
  ADD CONSTRAINT `predavac_termin_fk` FOREIGN KEY (`predavac_id`) REFERENCES `veza` (`id`);

--
-- Constraints for table `veza`
--
ALTER TABLE `veza`
  ADD CONSTRAINT `kolegij_veza_fk` FOREIGN KEY (`kolegij_id`) REFERENCES `kolegij` (`id`),
  ADD CONSTRAINT `profesor_kolegij_fk` FOREIGN KEY (`profesor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vezastudent`
--
ALTER TABLE `vezastudent`
  ADD CONSTRAINT `kolegij_student_fk` FOREIGN KEY (`kolegij_id`) REFERENCES `kolegij` (`id`),
  ADD CONSTRAINT `kolegij_userStudent_fk` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
