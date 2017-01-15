-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 dec 2016 om 12:55
-- Serverversie: 10.1.16-MariaDB
-- PHP-versie: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--
CREATE DATABASE IF NOT EXISTS `portfolio` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `portfolio`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `ContentID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Tags` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ContentID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cv`
--

CREATE TABLE IF NOT EXISTS `cv` (
  `CVID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `Name` int(10) NOT NULL,
  `Adres` varchar(40) NOT NULL,
  `Birthday` date NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Experience` text NOT NULL,
  `Education` text NOT NULL,
  `Hobbies` text NOT NULL,
  `Overig` text NOT NULL,
  PRIMARY KEY (`CVID`),
  KEY `UserID` (`UserID`),
  KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `FileID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `UploadDate` date NOT NULL,
  `FileName` varchar(30) NOT NULL,
  `FileType` varchar(30) NOT NULL,
  `Comment` varchar(150) NOT NULL,
  PRIMARY KEY (`FileID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
  `GradeID` int(10) NOT NULL AUTO_INCREMENT,
  `UserID` int(10) NOT NULL,
  `GraderID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Grade` varchar(20) NOT NULL,
  PRIMARY KEY (`GradeID`),
  KEY `UserID` (`UserID`,`GraderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `MessageID` int(10) NOT NULL AUTO_INCREMENT,
  `SourceUserID` int(10) NOT NULL,
  `TargetUserID` int(10) NOT NULL,
  `PostDate` date NOT NULL,
  `Timestamp` time NOT NULL,
  `Message` varchar(255) NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `SourceUserID` (`SourceUserID`),
  KEY `TargetUserID` (`TargetUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL,
  `Adres` varchar(30) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `AccessLevel` enum('Leerling','Docent','Admin', 'SLB') NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
