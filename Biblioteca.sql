-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2016 at 12:19 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Biblioteca`
--
CREATE DATABASE IF NOT EXISTS `Biblioteca` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Biblioteca`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` text NOT NULL,
  `title` text NOT NULL,
  `author` text NOT NULL,
  `gender` text NOT NULL,
  `year` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `author`, `gender`, `year`) VALUES
('9788445000663', 'EL SEÑOR DE LOS ANILLOS I', 'J.R.R. TOLKIEN', 'Fantasy', '2012'),
('9788445073735', 'EL SEÑOR DE LOS ANILLOS II', 'J.R.R. TOLKIEN', 'Fantasy', '2002'),
('9788496208568', 'JUEGO DE TRONOS: CANCION DE HIELO Y FUEGO', 'GEORGE R.R. MARTIN', 'Fantasy', '2007'),
('9788416253968', 'LA INTELIGENCIA DEL EXITO', 'ANXO PEREZ', 'Economics', '2016'),
('9788416588114', 'UN MONSTRUO VIENE A VERME', 'PATRICK NESS', 'Childish', '2016');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`gender`) VALUES
('Thriller'),
('Thriller'),
('Romantic'),
('Adventure'),
('Fantasy'),
('Terror'),
('Reality'),
('Science fiction'),
('Investigation'),
('Biographic'),
('Childish'),
('Erotica'),
('Home'),
('Politics'),
('Economics'),
('Marketing'),
('Society'),
('Sports'),
('Travel'),
('Culture'),
('Other topics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `userType`) VALUES
('Max', '321', 'admin'),
('Lola', '123', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
