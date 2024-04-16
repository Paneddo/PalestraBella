-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2024 at 12:57 PM
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
-- Database: `palestra`
--

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `idCorso` int(11) NOT NULL,
  `NumeroPosti` int(11) DEFAULT NULL,
  `DescrizioneCorso` varchar(45) DEFAULT NULL,
  `TitoloCorso` varchar(45) DEFAULT NULL,
  `Tipologia_idTipologia` int(11) NOT NULL,
  `Istruttore_idIstruttore` int(11) NOT NULL,
  `Istruttore_Utente Registrato_idUtenteRegistrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `istruttore`
--

CREATE TABLE `istruttore` (
  `Foto` varchar(45) DEFAULT NULL,
  `Utente Registrato_idUtenteRegistrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lezione`
--

CREATE TABLE `lezione` (
  `idLezione` int(11) NOT NULL,
  `Giorno` date DEFAULT NULL,
  `OraInizio` varchar(45) DEFAULT NULL,
  `OraFine` varchar(45) DEFAULT NULL,
  `Corso_idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

CREATE TABLE `prenotazione` (
  `Corso_idCorso` int(11) NOT NULL,
  `Utente Registrato_idUtenteRegistrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipologia`
--

CREATE TABLE `tipologia` (
  `idTipologia` int(11) NOT NULL,
  `PrezzoOrario` int(11) DEFAULT NULL,
  `NomeTipologia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(45) DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `scadenzaCertificatoMedico` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `email`, `password`, `cellulare`, `tipo`, `scadenzaCertificatoMedico`) VALUES
(1, 'Angela', 'Rossi', 'angela@gmail.com', '$2y$10$RrDIwQWF98ANYcYnoJF7iu.r0004F4H7oN6xwKvsthRY7rY.tF/9i', '000 4500 999', 'segretaria', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`idCorso`),
  ADD KEY `fk_Corso_Tipologia1` (`Tipologia_idTipologia`),
  ADD KEY `fk_Corso_Istruttore1` (`Istruttore_Utente Registrato_idUtenteRegistrato`);

--
-- Indexes for table `istruttore`
--
ALTER TABLE `istruttore`
  ADD PRIMARY KEY (`Utente Registrato_idUtenteRegistrato`);

--
-- Indexes for table `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`idLezione`),
  ADD KEY `fk_Lezione_Corso1` (`Corso_idCorso`);

--
-- Indexes for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`Corso_idCorso`,`Utente Registrato_idUtenteRegistrato`),
  ADD KEY `fk_Corso_has_Utente Registrato_Utente Registrato1` (`Utente Registrato_idUtenteRegistrato`);

--
-- Indexes for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`idTipologia`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `fk_Corso_Istruttore1` FOREIGN KEY (`Istruttore_Utente Registrato_idUtenteRegistrato`) REFERENCES `istruttore` (`Utente Registrato_idUtenteRegistrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_Tipologia1` FOREIGN KEY (`Tipologia_idTipologia`) REFERENCES `tipologia` (`idTipologia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `istruttore`
--
ALTER TABLE `istruttore`
  ADD CONSTRAINT `fk_Istruttore_Utente Registrato1` FOREIGN KEY (`Utente Registrato_idUtenteRegistrato`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `fk_Lezione_Corso1` FOREIGN KEY (`Corso_idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `fk_Corso_has_Utente Registrato_Corso1` FOREIGN KEY (`Corso_idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_has_Utente Registrato_Utente Registrato1` FOREIGN KEY (`Utente Registrato_idUtenteRegistrato`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
